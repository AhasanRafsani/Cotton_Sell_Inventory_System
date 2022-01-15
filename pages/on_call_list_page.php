<?php

if(($_SESSION['adminname']==null) || ($_SESSION['adminpass']==null))
{
    header("Location:index.php");
}
require_once 'class/Admin.php';

$adm = new Admin;
if(isset($_GET['delete'])){
    $id=$_GET['id'];
    $adm->deleteOnCallListInformation($id);

}

$data=$adm->getOnCallList();
?>
<div class="tabl">
    <table class="table table-dark  table-striped table-responsive text-center ">
        <thead style="background:darksalmon;color: black">
        <tr>
            <th>Serial_No</th>
            <th>PI_No</th>
            <th>Country</th>
            <th>Contact_No</th>
            <th>Quantity</th>
            <th>Basis</th>
            <th>Total</th>
            <th>Total_Value</th>
            <th>Shipper</th>
            <th>Quater</th>
            <th>Quater_Year</th>
            <th>Remark</th>
            <th colspan="2">Action</th>
            <th></th>


        </tr>

        </thead>
        <tbody class="table-sm">
        <?php

        if(isset($data)){
        $i=0;
        $totalQuantity=0;
        $grandTotal=0;
        $average="";
        while($onCallList=mysqli_fetch_assoc($data)){
        $i++;
        ?>

        <tr>
            <td><?php echo $i ?></td>
            <td> <?php echo $onCallList['piNumber'];?> </td>
            <td> <?php echo $onCallList['selectCountry'];?></td>
            <td> <?php echo $onCallList['contactNumber'];?></td>
            <td> <?php echo $onCallList['quantity'];?></td>
            <td> <?php echo $onCallList['basis'];?></td>
            <td> <?php echo $onCallList['total'];?></td>
            <td> <?php echo $onCallList['totalValue'];?></td>
            <td> <?php echo $onCallList['shipper'];?></td>
            <td> <?php echo $onCallList['quater'];?></td>
            <td> <?php echo $onCallList['quaterYear'];?></td>
            <td> <?php echo $onCallList['remark'];?></td>
            <td>
                <a class="btn btn-success text-warning" href="updateOncallInformation.php?id=<?php echo $onCallList ['piNumber'];?> ">Edit</a>
            </td>
            <td>
                <a class="btn btn-success text-warning" href="?delete=true&id=<?php echo $onCallList['piNumber'];?>">Delete</a>
            </td>


            <?php    $totalQuantity =$totalQuantity+$onCallList['quantity'];
            $grandTotal=$grandTotal+$onCallList['totalValue'];
            $average=($grandTotal/($totalQuantity*10))/2.2046;

            }

            }?>

        </tr>
        </tbody>
    </table >
</div>
<div class="tabl">
    <table class="table table-dark">
        <tr>
            <td class="text-warning">Total Quantity</td>
            <td> <?php echo $totalQuantity;?></td>
        </tr>
        <tr>
            <td class="text-warning"> Grand Total</td>
            <td> <?php echo $grandTotal;?></td>
        </tr>
        <tr>
            <td class="text-warning">Average</td>
            <td> <?php echo $average;?></td>
        </tr>

    </table>
</div>