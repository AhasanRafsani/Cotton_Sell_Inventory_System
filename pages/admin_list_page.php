<?php

if (($_SESSION['adminname'] == null) || ($_SESSION['adminpass'] == null)) {
header("Location:index.php");
}
require_once 'class/Admin.php';

$adm = new Admin;
if (isset($_GET['delete'])) {
$id = $_GET['id'];
$adm->deleteAdminInformation($id);

}

$data = $adm->getAdminList();
?>

<div class="tabl">
    <table class="table table-dark table-striped text-center table-sm ">
        <thead style="background:darksalmon;color: black">
        <tr>
            <th>Serial No</th>
            <th>Admin Name</th>
            <th>Admin Category</th>
            <th>Action</th>
        </tr>
        </thead >
        <tbody >
        <?php
        $i=0;
        if(isset($data)){
            while($adminList=mysqli_fetch_assoc($data)){

                if($adminList['username']=='SuperAdmin') {
                    continue;
                }
                else{
                    $i++;
                    ?>

                    <tr>
                        <td><?php echo $i ?></td>
                        <td> <?php echo $adminList['username'];?> </td>
                        <td> <?php echo $adminList['admincategory'];?></td>
                        <td>
                            <a class="btn btn-success text-warning" href="updateAdminInformation.php?id=<?php echo $adminList ['id'];?> ">Edit</a>
                            <a class="btn btn-success text-warning" href="?delete=true&id=<?php echo $adminList['id'];?>">Delete</a>
                        </td>
                    </tr>
                <?php  }
            }
        }?>
        </tbody>

    </table>
</div>
