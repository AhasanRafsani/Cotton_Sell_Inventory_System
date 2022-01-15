<?php
require_once "class/Database.php";
class Admin extends Database{

public function Admin_login($data)
{
	
	$i=0;
	$arr=[];
    $user=$data['username'];
    $pass=$data['password'];


if($user=="" || $pass==""){
    if($user==''){
	    $arr[$i]='Please enter Username ';
		$i++;

    }
    if($pass==''){
	   $arr[$i]='Please enter Password';
	
    }

}
else{
   $sql="select * from admin where username='$user' && password=md5('$pass')";

   $query = mysqli_query($this->dbConnection(),$sql);
   if($data){
           $total = mysqli_num_rows($query);
           $data = mysqli_fetch_assoc($query);



         if($total==1)
         {   session_start();
                 $_SESSION['admincat']=$data['admincategory'];
                 $_SESSION['adminname']=$user;
                 $_SESSION['adminpass']= $pass;

                 header('Location:dashboard.php');

         }
         else
	     $arr[$i]="Invalid Username and Password";
    }

   else
     die("connection problem".mysqli_error($this->dbConnection()));
}

   return $arr;

}

public  function adminLogout(){
    session_destroy();
    header("location:index.php");

}
 public function AddNewAdmin($data){
      $arr=[];
      $i=0;
      $user=$data['username'];
      $pass=$data['password'];
      $cat=$data['category'];

      if($user=="" || $pass=="" || $cat=="" ){
          if($user==''){
              $arr[$i]='Username Is Required';
              $i++;

          }
          if($pass==''){
              $arr[$i]='Password Is Required';
              $i++;
          }
          if($cat==''){
              $arr[$i]=' Admin Category Is Required';

          }
      }
      else{

          $sql = "insert into  admin (username,password,admincategory) values ('$user',md5('$pass'),'$cat')";
          $data = mysqli_query($this->dbConnection(), $sql);
          if($data){
            $arr[$i]="Successfully Done" ;
          }
          else
              die("connection problem".mysqli_error($this->dbConnection()));

      }

      return $arr;

}

public function getAdminList()
{
   $sql="select * from admin";

   if(mysqli_query($this->dbConnection(),$sql)){
       $data=mysqli_query($this->dbConnection(),$sql);
       return $data;
   }
   die("Connection Problem".mysqli_error($this->dbConnection(),$sql));


}
  public function AddOrgin($data){

        $countryName=$data['countryname'];
        if( $countryName==""){
            return "Country Name Require";

        }
        else{
            $sql="select * from country where countryname='$countryName'";
            $query = mysqli_query($this->dbConnection(), $sql);
            $data=mysqli_num_rows($query);
             if($data>=1){

                Return "This country Name already exist";
            }
             else {
               $sql = "insert into  country (countryname) values ('$countryName')";
               $data = mysqli_query($this->dbConnection(), $sql);
               if ($data) {
                   return " Successfully Done ";
               }
           }
            die("connection problem" . mysqli_error($this->dbConnection()));
        }
}
  public function getCountryList()
    {
        $sql="select * from country";
        if(mysqli_query($this->dbConnection(),$sql))
        {
            $data=mysqli_query($this->dbConnection(),$sql);
            return $data;
        }
        else
            die("connection problem".mysqli_error($this->dbConnection()));

    }
public function getCountryInformationById($id){
    // $id=$data['id'];
     $sql="select * from country where id='$id'";
     if(mysqli_query($this->dbConnection(),$sql))
     {
         $data=mysqli_query($this->dbConnection(),$sql);
         return $data;
     }
     else
         die("connection problem".mysqli_error($this->dbConnection()));

 }
public function UpdateCountry($data){

    $countryName=$data['countryname'];
    $id=$data['id'];

    $sql="update country set countryname='$countryName' where id='$id'";
    if(mysqli_query($this->dbConnection(),$sql))
    {
       header('Location:originList.php');
    }
    else
        die("connection problem".mysqli_error($this->dbConnection()));


}
public function deleteCountryName($id){

    $sql="delete from country where id='$id'";
    if(mysqli_query($this->dbConnection(),$sql))
    {
        header('Location:countryList.php');
    }
    else
        die("connection problem".mysqli_error($this->dbConnection()));
}
public function addOnCall($data){
    $i=0;
    $arr=[];

    $country=$data['selectCountry'];
    $contactNumber=$data['contactNumber'];
    $quantity=$data['quantity'];
    $basis=$data['basis'];
    $shipper=$data['shipper'];
    $quater=$data['quater'];
    $quaterYear=$data['quaterYear'];
    $remark=$data['remark'];

    $total=(float)$basis;
    $totalValue=(((float)$total*2.2046)*( (float)$quantity*10));

    $quantityCheck=0;
    $basisCheck=0;

   if(($quantity != "") || ($basis != "")){

           if(filter_var($quantity,FILTER_VALIDATE_FLOAT)){
               $quantityCheck=1;
           }
           else{
               $arr[$i]="Floating Number Quantity is Required";
               $i++;
           }



           if(filter_var($basis,FILTER_VALIDATE_FLOAT)){
               $basisCheck=1;
           }
           else{
               $arr[$i]="Floating Number Basis is Required";
               $i++;
           }

       }


  if( ($contactNumber=="")  || ($quantity == "") || ($basis == "") || ($shipper=="") ){

       if($contactNumber==""){
          $arr[$i]="Contact Number is Required";
          $i++;
       }
      if($quantity==""){
          $arr[$i]="Quantity is Required";
          $i++;
      }
      if($basis==""){
          $arr[$i]="Basis is Required";
          $i++;
      }

       if($shipper==""){
          $arr[$i]="Shipper is Required";
       }
  }
  else{
       if( ($quantityCheck==1) && ($basisCheck==1) ) {
           $sql = " insert into oncall (selectCountry,contactNumber,quantity,basis,total,totalValue,shipper,quater,quaterYear,remark) values ('$country','$contactNumber','$quantity','$basis',' $total','$totalValue','$shipper','$quater',' $quaterYear','$remark')";
           $data = mysqli_query($this->dbConnection(), $sql);
           if ($data) {
               $arr[$i] = 'Successfully Done';
           } else
               die("Connection Problem" . mysqli_error($this->dbConnection(), $sql));
       }
    }
      return $arr;

}
public  function getOnCallList(){

    $sql="select * from oncall";
    if(mysqli_query($this->dbConnection(),$sql))
    {
        $data=mysqli_query($this->dbConnection(),$sql);
        return $data;
    }
    else
        die("connection problem".mysqli_error($this->dbConnection(),$sql));
}
    public  function getOnCallListInformationById($id){

    $Sql="select * from oncall where piNumber='$id'";
    if(mysqli_query($this->dbConnection(),$Sql)){
        $data=mysqli_query($this->dbConnection(),$Sql);
        return $data;
    }
    else
        die("Connection Problem".mysqli_error($this->dbConnection(), $Sql));


    }


public function updateOnCallListInformation($data)
{
    $country=$data['selectCountry'];
    $contactNumber=$data['contactNumber'];
    $quantity=$data['quantity'];
    $basis=$data['basis'];
    $shipper=$data['shipper'];
    $quater=$data['quater'];
    $quaterYear=$data['quaterYear'];
    $remark=$data['remark'];
    $id=$data['id'];

    $total=$basis;
    $totalValue=(($total*2.2046)*( $quantity*10));

    $sql="update oncall set selectCountry='$country',contactNumber='$contactNumber',quantity='$quantity',basis='$basis',total='$total',totalValue='$totalValue',shipper='$shipper',quater='$quater', quaterYear='$quaterYear',remark='$remark' where piNumber='$id'";
   if(mysqli_query($this->dbConnection(),$sql)){

    header("Location:onCallList.php");

   }
    else

       die("Connection Problem".mysqli_error($this->dbConnection(),$sql));

}

    public function deleteOnCallListInformation($id){

        $sql="delete from oncall where piNumber='$id'";
        if(mysqli_query($this->dbConnection(),$sql))
        {
            header('Location:onCallList.php');
        }
        else
            die("connection problem".mysqli_error($this->dbConnection(),$sql));
    }

    public function addFixed($data){
        $i=0;
        $arr=[];


        $country=$data['selectCountry'];
        $contactNumber=$data['contactNumber'];
        $quantity=$data['quantity'];
        $lce=$data['lce'];
        $basis=$data['basis'];
        $premium=$data['premium'];
        $shipper=$data['shipper'];
        $shipment=$data['shipment'];
        $remark=$data['remark'];


        $total=((float)$basis+(float)$lce+(float)$premium);
        $totalValue=(((float)$total*2.2046)*((float)$quantity*10));

        $quantityCheck=0;
        $basisCheck=0;

        if(($quantity != "") || ($basis != "")){

            if(filter_var($quantity,FILTER_VALIDATE_FLOAT)){
                $quantityCheck=1;
            }
            else{
                $arr[$i]="Floating Number Quantity is Required";
                $i++;
            }



            if(filter_var($basis,FILTER_VALIDATE_FLOAT)){
                $basisCheck=1;
            }
            else{
                $arr[$i]="Floating Number Basis is Required";
                $i++;
            }

        }

        if($contactNumber=="" || $quantity=="" || $basis=="" || $shipper=="" || $shipment=="") {

            if ($contactNumber == "") {
                $arr[$i] = "Contact Number is Required";
                $i++;
            }
            if ($quantity == "") {
                $arr[$i] = "Quantity is Required";
                $i++;
            }
            if ($basis == "") {
                $arr[$i] = "Basis is Required";
                $i++;
            }
            if ($shipper == "") {
                $arr[$i] = "Shipper is Required";
                $i++;
            }
            if ($shipment == "") {
                $arr[$i] = "shipment is Required";
            }
        }
        else{
            if( ($quantityCheck==1) && ($basisCheck==1) ) {
                $sql = " insert into  fixed (countryname,contactNumber,quantity,lce,basis,premium,total,totalValue,shipper,shipment,remark) values ('$country','$contactNumber','$quantity','$lce','$basis','$premium','$total','$totalValue','$shipper','$shipment','$remark')";
                $data = mysqli_query($this->dbConnection(), $sql);
                if ($data) {
                    $arr[$i] = "Successfully Done";
                }
                else {
                    die("connection problem" . mysqli_error($this->dbConnection(), $sql));
                }
            }

        }

        return $arr;

    }
public function getFixedList(){

    $sql="select * from fixed";
    if(mysqli_query($this->dbConnection(),$sql)){

        $data=mysqli_query($this->dbConnection(),$sql);
        return $data;
    }
    else
        die("connection error".mysqli_error($this->dbConnection(),$sql));
}
 public function getFixedListInformationById($id){
   $sql="select * from fixed  where piNumber='$id'";

    if(mysqli_query($this->dbConnection(),$sql)){
      $data=mysqli_query($this->dbConnection(),$sql);
      return $data;

     }
    else
        die("Connection error".mysqli_error($this->dbConnection(),$sql));

 }
    public function updateFixedListInformation($data){
        $country=$data['selectCountry'];
        $contactNumber=$data['contactNumber'];
        $quantity=$data['quantity'];
        $lce=$data['lce'];
        $basis=$data['basis'];
        $premium=$data['premium'];
        $shipper=$data['shipper'];
        $shipment=$data['shipment'];
        $remark=$data['remark'];
        $id=$data['id'];


        $total=((float)$basis+(float)$lce+(float)$premium);
        $totalValue=(((float)$total*2.2046)*((float)$quantity*10));
        $sql=" update fixed set countryname='$country',contactNumber='$contactNumber',quantity='$quantity',lce='$lce',basis='$basis',premium='$premium',total='$total',totalValue='$totalValue',shipper='$shipper',shipment='$shipment',remark='$remark' where piNumber='$id'";
        if(mysqli_query($this->dbConnection(),$sql)){
            header("Location:fixedList.php");
        }
        else
           die("Connection error".mysqli_error($this->dbConnection(),$sql));
    }
public function getAdminInformationById($id){
    $sql="select * from admin  where id='$id'";
   if (mysqli_query($this->dbConnection(),$sql)){
       $data=mysqli_query($this->dbConnection(),$sql);
       return $data;
   }
    else
        die("Connection error".mysqli_error($this->dbConnection(),$sql));
}
public function UpdateAdminInformation($data){
    $user=$data['username'];
    $cat=$data['category'];
    $id=$data['id'];
    $sql="update admin set username='$user',admincategory='$cat' where id='$id'";
    if (mysqli_query($this->dbConnection(),$sql)){
       header("Location:adminList.php");
    }
    die("Connection error".mysqli_error($this->dbConnection(),$sql));
}
 public function deleteAdminInformation($id){
     $sql="delete from admin where id='$id'";
     if(mysqli_query($this->dbConnection(),$sql))
     {
         header('Location:adminList.php');
     }
     else
         die("connection problem".mysqli_error($this->dbConnection(),$sql));
 }
    public function lcOpening($data){
        $i=0;
        $arr=[];

        $lcDate=$data['lcDate'];
        $ipIssuDate=$data['ipIssueDate'];
        $id=$data['piNumber'];

        if($lcDate=="" || $ipIssuDate==""){

            if($lcDate==""){
                $arr[$i]="Lc Date is Required" ;
                $i++;
            }
            if($ipIssuDate==""){
                $arr[$i]="Ip Issue Date is Required" ;

            }

        }
        else
        {
            $sql="select * from lcopening where piNumber='$id'";
               if(mysqli_query($this->dbConnection(),$sql)){
                $check=mysqli_query($this->dbConnection(),$sql);
                $total=mysqli_num_rows($check);
                if($total>0){

                    $arr[$i]="already exist";

                }
                else {
                    $sql1 = "insert into lcopening(lcDate,ipIssueDate,piNumber) values ('$lcDate','$ipIssuDate','$id')";
                    $data = mysqli_query($this->dbConnection(), $sql1);
                    if ($data) {
                        $arr[$i] = "Successfully Done";
                    } //else
                        die("connection problem".mysqli_error($this->dbConnection(),$sql1));
                }

            }



        }
        return $arr;
    }
 public function getLcOpeningList(){
    $sql="select fix.*,lc.* from fixed fix,lcopening lc where fix.piNumber=lc.piNumber";
    if(mysqli_query($this->dbConnection(),$sql)){
        $data=mysqli_query($this->dbConnection(),$sql);
        return $data;
    }
    else
        die("connection problem".mysqli_error($this->dbConnection(),$sql));
 }
public function searchCountryWiseInformation($country){
    $sql="select * from fixed where countryname='$country'";

    if(mysqli_query($this->dbConnection(),$sql)){
       $data=mysqli_query($this->dbConnection(),$sql);
       return $data;
    }
    else
        die("connection problem".mysqli_error($this->dbConnection(),$sql));
}
    public function getFixedListInformationByCountryName($countryname){
        $sql="select * from fixed  where countryname='$countryname'";

        if(mysqli_query($this->dbConnection(),$sql)){
            $data=mysqli_query($this->dbConnection(),$sql);
            return $data;

        }
        else
            die("Connection error".mysqli_error($this->dbConnection(),$sql));

    }
public function getLcOpeningInformationById($id){
   $sql="select * from lcopening where lcNumber='$id'";
   if(mysqli_query($this->dbConnection(),$sql)){
       $data=mysqli_query($this->dbConnection(),$sql);
       return $data;
   }
   else
       die("connection problem".mysqli_error($this->dbConnection(),$sql));
}
    public function updateLcOpeningtInformation($data){
        $country=$data['selectCountry'];
        $contactNumber=$data['contactNumber'];
        $quantity=$data['quantity'];
        $lce=$data['lce'];
        $basis=$data['basis'];
        $premium=$data['premium'];
        $shipper=$data['shipper'];
        $shipment=$data['shipment'];
        $remark=$data['remark'];
        $lcdate=$data['lcDate'];
        $IpIsudate=$data['ipIssueDate'];
        $id=$data['id'];


        $total=((float)$basis+(float)$lce+(float)$premium);
        $totalValue=(((float)$total*2.2046)*((float)$quantity*10));
        $sql=" update fixed set countryname='$country',contactNumber='$contactNumber',quantity='$quantity',lce='$lce',basis='$basis',premium='$premium',total='$total',totalValue='$totalValue',shipper='$shipper',shipment='$shipment',remark='$remark' where piNumber='$id'";
        if(mysqli_query($this->dbConnection(),$sql)){
            $sql1="update lcopening set lcDate='$lcdate',ipIssueDate='$IpIsudate' where piNumber='$id'";
            if(mysqli_query($this->dbConnection(),$sql1)){
            header("Location:lcOpeningList.php");}
            else
                echo "nothing";
        }
        else
            die("Connection error".mysqli_error($this->dbConnection(),$sql));
    }

}

?>