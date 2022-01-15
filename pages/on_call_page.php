<?php

if(($_SESSION['adminname']==null) || ($_SESSION['adminpass']==null))
{
    header("Location:index.php");
}

require_once 'class/Admin.php';
$adm = new Admin;
$data=$adm->getCountryList();

if (isset($_POST['btn'])) {

    $message=$adm->addOnCall($_POST);
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

        <div class="form-group">
            <h4 for="choice">Select Country</h4>
            <select name="selectCountry" class="form-control control" id="choice">
                <?php
                if(isset($data)){
                    while($countryList=mysqli_fetch_assoc($data)){?>

                        <option> <?php echo $countryList['countryname'];?> </option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <h4>Contact Number</h4>
            <input class="form-control"type="text" name="contactNumber" placeholder="Enter Contact Number">
        </div>
        <div class="form-group">
            <h4>Quantity</h4>
            <input class="form-control"type="text" name="quantity" placeholder="Enter Quantity ">
        </div>

        <div class="form-group">
            <h4>Basis</h4>
            <input class="form-control"type="text" name="basis" placeholder="Enter Basis ">
        </div>
        <div class="form-group">
            <h4>Shipper</h4>
            <input class="form-control"type="text" name="shipper" placeholder="Enter Shipper ">
        </div>
        <div class="form-group">
            <h4 for="choice">Quater</h4>
            <select name="quater" class="form-control control" id="choice">
                <option>May</option>
                <option>June</option>
                <option>July</option>

            </select>
        </div>
        <div class="form-group">
            <h4>Quater Year</h4>
            <input class="form-control"type="text" name="quaterYear" placeholder="Enter Quater Year  ">
        </div>
        <div class="form-group">
            <h4>Remark</h4>
            <input class="form-control"type="text" name="remark" placeholder="Enter Shipper ">
        </div>
        <div class=" form-group submit pt-3">

            <input type="submit" class=" btn btn-primary btn-block " name="btn" value="SUBMIT">
        </div>

    </form>
</div>