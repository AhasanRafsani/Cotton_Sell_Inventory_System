<?php

if(($_SESSION['adminname']==null) || ($_SESSION['adminpass']==null))
{
    header("Location:index.php");
}

require_once 'class/Admin.php';
$adm = new Admin;
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $onCallListData = $adm->getOnCallListInformationById($id);
    $onCallList=mysqli_fetch_assoc($onCallListData);
}
$countryData=$adm->getCountryList();

if (isset($_POST['btn'])) {
    $mess=$adm->updateOnCallListInformation($_POST);


}


?>

<div class="form-style content">

    <form action="" method="post">

        <h3 class="mt-3"> Update OnCall Information </h3>
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
            <input class="form-control"type="text" name="contactNumber"  value="<?php echo $onCallList['contactNumber'];?>">
            <input class="form-control"type="hidden" name="id" value="<?php echo $onCallList['piNumber'];?>">
        </div>
        <div class="form-group">
            <h4>Quantity</h4>
            <input class="form-control"type="text" name="quantity" value="<?php echo $onCallList['quantity'];?>">
        </div>

        <div class="form-group">
            <h4>Basis</h4>
            <input class="form-control"type="text" name="basis" value="<?php echo $onCallList['basis'];?>">
        </div>
        <div class="form-group">
            <h4>Shipper</h4>
            <input class="form-control"type="text" name="shipper" value="<?php echo $onCallList['shipper'];?>">
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
            <input class="form-control"type="text" name="quaterYear" value="<?php echo $onCallList['quaterYear'];?>">
        </div>
        <div class="form-group">
            <h4>Remark</h4>
            <input class="form-control"type="text" name="remark"value="<?php echo $onCallList['remark'];?>">
        </div>
        <div class=" form-group submit pt-3">

            <input type="submit" name="btn" class="btn btn-primary btn-block" value="Update">
        </div>

    </form>
</div>