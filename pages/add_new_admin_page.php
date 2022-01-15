<?php
if (($_SESSION['adminname'] == null) || ($_SESSION['adminpass'] == null)) {
    header("Location:index.php");
}
require_once 'class/Admin.php';
if (isset($_POST['btn'])) {
    $adm = new Admin;
    $message = $adm->AddNewAdmin($_POST);
}
?>


<div class="form-style content ">
    <?php
    if(isset($message))
    {?>
        <div class="message" ><?php
            $length=count($message);
            for($i=0;$i<$length;$i++){
                echo "<h5>".$message[$i]."</h5>";
            }?>
        </div>
    <?php   }

    ?>
    <form action="" method="post">
        <div class="form-group pt-4">
            <h4>User Name</h4>
            <input class="form-control"type="text" name="username" placeholder="Enter username">
        </div>
        <div class="form-group">
            <h4>Password</h4>
            <input class="form-control"type="password" name="password" placeholder="Enter password">
        </div>
        <div class="form-group">
            <h4>Admin Category</h4>
            <input class="form-control"type="text" name="category" placeholder="Enter Category">
        </div>
        <div class=" form-group submit pt-3">

            <input type="submit" class=" btn btn-primary btn-block " name="btn" value="SUBMIT">
        </div>

    </form>
</div>