<?php

if(($_SESSION['adminname']==null) || ($_SESSION['adminpass']==null))
{
    header("Location:index.php");
}
if(isset($_GET['piNumber'])){
    $id=$_GET['piNumber'];
}
require_once 'class/Admin.php';
if (isset($_POST['btn'])) {
    $adm = new Admin;
    $message=$adm->lcOpening($_POST);
}
?>
<div class="form-style content">
    <?php
    if(isset($message))
    {?>
        <div class="message"><?php
            $length=count($message);
            for($i=0;$i<$length;$i++){
                echo "<h5>".$message[$i]."</h5>";
            }?>
        </div>
    <?php   }

    ?>
    <form action="" method="post">

        <h2 class="mt-3"> Lc Opening </h2>

        <div class="form-group">
            <h4>Lc Date</h4>
            <input class="form-control"type="date" name="lcDate">
            <input class="form-control"type="hidden" name="piNumber" value="<?php echo $id;?>">
        </div>
        <div class="form-group">
            <h4>Ip Issue Date</h4>
            <input class="form-control"type="date" name="ipIssueDate">
        </div>

        <div class=" form-group submit pt-3">
            <input type="submit" class=" btn btn-primary btn-block " name="btn" value="SUBMIT">
        </div>

    </form>
</div>
