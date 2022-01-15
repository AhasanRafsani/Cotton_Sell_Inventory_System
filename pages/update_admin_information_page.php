<?php

  if(($_SESSION['adminname']==null) || ($_SESSION['adminpass']==null))
  {
    header("Location:index.php");
  }
 require_once 'class/Admin.php';
 $adm = new Admin;
   if (isset($_GET['id'])) {
     $id=$_GET['id'];
     $data = $adm->getAdminInformationById($id);
     $adminData=mysqli_fetch_assoc($data);
  }

   if (isset($_POST['btn'])) {
    $adm->UpdateAdminInformation($_POST);
  }


?>
<div class="form-style content">
    <form action="" method="post">
        <div class="form-group">
            <h4>Admin Name</h4>
            <input class="form-control"type="text" name="username" value="<?php echo $adminData['username'];?>">
            <input class="form-control"type="hidden" name="id" value="<?php echo $adminData['id'];?>">
        </div>
        <div class="form-group">
            <h4>Admin Category</h4>
            <input class="form-control"type="text" name="category" value="<?php echo $adminData['admincategory'];?>">
        </div>

        <div class=" form-group submit pt-3">
            <input type="submit" class=" btn btn-secondary btn-block " name="btn" value="Update">
        </div>

    </form>
</div>