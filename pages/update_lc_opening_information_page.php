<?php

if(($_SESSION['adminname']==null) || ($_SESSION['adminpass']==null))
{
    header("Location:index.php");
}

require_once 'class/Admin.php';
$adm = new Admin;
if (isset($_GET['piNumber'])){
    $id=$_GET['piNumber'];
    $fixedData = $adm->getFixedListInformationById($id);
    $LcOpenData = $adm->getLcOpeningInformationById($id);
    $fixed=mysqli_fetch_assoc($fixedData);
    $LcOpen=mysqli_fetch_assoc($LcOpenData);
}

$countryData=$adm->getCountryList();

if (isset($_POST['btn'])) {
    $mess=$adm->updateLcOpeningtInformation($_POST);
}
?>

<div class="form-style content">

    <form action="" method="post">

        <div class="form-group">

            <h4 for="choice">Select Country</h4>
            <select name="selectCountry" class="form-control control" id="choice">
                <?php
                if(isset($countryData)){
                    while($countryList=mysqli_fetch_assoc($countryData)){?>

                        <option> <?php echo $countryList['countryname'];?>  </option>
                        <?php
                    }
                }
                ?>
            </select>

        </div>
        <div class="form-group">
            <h4>Contact Number</h4>
            <input class="form-control"type="text" name="contactNumber"  value="<?php echo $fixed['contactNumber'];?>">

        </div>
        <div class="form-group">
            <h4>Quantity</h4>
            <input class="form-control"type="text" name="quantity" value="<?php echo $fixed['quantity'];?>">
        </div>

        <div class="form-group">
            <h4>LCE</h4>
            <input class="form-control"type="text" name="lce" value="<?php echo $fixed['lce'];?>">
        </div>

        <div class="form-group">
            <h4>Basis</h4>
            <input class="form-control"type="text" name="basis" value="<?php echo $fixed['basis'];?>">
        </div>

        <div class="form-group">
            <h4>Premium</h4>
            <input class="form-control"type="text" name="premium" value="<?php echo $fixed['premium'];?>" >
        </div>

        <div class="form-group">
            <h4>Shipper</h4>
            <input class="form-control"type="text" name="shipper" value="<?php echo $fixed['shipper'];?>">
        </div>
        <div class="form-group">
            <h4>Shipment</h4>
            <input class="form-control"type="text" name="shipment" value="<?php echo $fixed['shipment'];?>">
        </div>
        <div class="form-group">
            <h4>Remark</h4>
            <input  class="form-control"type="text" name="remark"value="<?php echo $fixed['remark'];?>">
        </div>
        <div class="form-group">
            <h4>Lc Date</h4>
            <input class="form-control"type="date" name="lcDate" value="<?php echo $LcOpen['lcDate'];?>">
        </div>
        <div class="form-group">
            <h4>Ip Issue Date</h4>
            <input class="form-control"type="date" name="ipIssueDate" value="<?php echo $LcOpen['ipIssueDate'];?>">
        </div>

        <div class=" form-group submit pt-3">

            <input type="submit" name="btn" class="btn btn-primary btn-block" value="Update">
        </div>

    </form>
</div>