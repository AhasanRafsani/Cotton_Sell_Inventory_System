<?php

if(($_SESSION['adminname']==null) || ($_SESSION['adminpass']==null))
{
    header("Location:index.php");
}

require_once 'class/Admin.php';
if (isset($_POST['btn'])) {
    $adm = new Admin;
    $message=$adm->AddOrgin($_POST);
}

?>


<div class="form-style content">

    <?php
    if(isset($message))
    {?>
        <div class="message" >
            <?php
            echo "<h5>".$message."</h5>";
            ?>
        </div>
    <?php }

    ?>

    <form action="" method="post">
        <div class="form-group">
            <h4>Country Name</h4>
            <input class="form-control"type="text" name="countryname" placeholder="Enter Country Name">
        </div>

        <div class=" form-group submit pt-3">
            <input type="submit" class=" btn btn-secondary btn-block " name="btn" value="SUBMIT">
        </div>
    </form>
</div>