<?php
if(($_SESSION['adminname']==null) || ($_SESSION['adminpass']==null))
{
    header("Location:index.php");
}
require_once 'class/Admin.php';

$adm = new Admin;
if(isset($_GET['delete'])){
    $id=$_GET['id'];
    $adm->deleteCountryName($id);

}

$data=$adm->getCountryList();
?>



<div class="tabl">
    <table class="table table-dark table-striped text-center table-sm table-responsive-sm">
        <thead class="text-center" style="background:darksalmon;color: black">
        <tr>
            <th>Serial No</th>
            <th>Country Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=0;
        if(isset($data)){
            while($country=mysqli_fetch_assoc($data)){
                $i++
                ?>

                <tr>
                    <td><?php echo $i ?></td>
                    <td> <a class="btn  btn-outline-success" href="countryWiseSellInformatoin.php?country=<?php echo $country['countryname'];?>"><?php echo $country['countryname'];?></a> </td>
                    <td>
                        <a class="btn btn-success text-warning" href="updateOriginInformation.php?id=<?php echo $country['id'];?> ">Edit</a>
                        <a class="btn btn-success text-warning" href="?delete=true&id=<?php echo $country['id'];?>">Delete</a>
                    </td>
                </tr>
            <?php  }
        }?>
        </tbody>

    </table>
</div>