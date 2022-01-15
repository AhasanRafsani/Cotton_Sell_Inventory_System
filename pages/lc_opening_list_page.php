
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

$data=$adm->getLcOpeningList();
?>


<div class="tabl">
    <table class="table table-dark table-striped table-responsive text-center">
        <thead style="background:darksalmon;color: black">
        <tr>
            <th>Serial_No</th>
            <th>PI_No</th>
            <th>Country</th>
            <th>Contact_No</th>
            <th>Quantity</th>
            <th>LCE</th>
            <th> Basis </th>
            <th>Premium</th>
            <th>Total</th>
            <th>Total_Value</th>
            <th>Shipper</th>
            <th>Shipment</th>
            <th>Remark</th>
            <th>Lc_Date</th>
            <th>Ip_Issue_Date</th>
            <th>Lc_Number</th>
            <th>Action</th>
            <th>Shipped</th>


        </tr>

        </thead>
        <tbody class="table-sm">
        <?php

        if(isset($data)){
        $i=0;
        $totalQuantity=0;
        $grandTotal=0;

        while($lcOpeningList=mysqli_fetch_assoc($data)){
        $i++;
        ?>

        <tr>
            <td><?php echo $i ?></td>
            <td> <?php echo $lcOpeningList['piNumber'];?></td>
            <td> <?php echo $lcOpeningList['countryname'];?></td>
            <td> <?php echo $lcOpeningList['contactNumber'];?></td>
            <td> <?php echo $lcOpeningList['quantity'];?></td>
            <td> <?php echo $lcOpeningList['lce'];?></td>
            <td> <?php echo $lcOpeningList['basis'];?></td>
            <td> <?php echo $lcOpeningList['premium'];?></td>
            <td> <?php echo $lcOpeningList['total'];?></td>
            <td> <?php echo $lcOpeningList['totalValue'];?></td>
            <td> <?php echo $lcOpeningList['shipper'];?></td>
            <td> <?php echo $lcOpeningList['shipment'];?></td>
            <td> <?php echo $lcOpeningList['remark'];?></td>
            <td> <?php echo $lcOpeningList['lcDate'];?></td>
            <td> <?php echo $lcOpeningList['ipIssueDate'];?></td>
            <td> <?php echo $lcOpeningList['LcNumber'];?></td>
            <td>
                <a class="btn btn-outline-success" href="updateLcOpeningInformation.php?piNumber=<?php echo $lcOpeningList['piNumber'];?>">Edit</a>
            </td>
            <td>
                <a class="btn btn-outline-success" href="?piNumber=<?php echo  $lcOpeningList['LcNumber'];?>">Shipped_Opening</a>
            </td>


            <?php
            $totalQuantity =$totalQuantity+$lcOpeningList['quantity'];
            $grandTotal=$grandTotal+$lcOpeningList['totalValue'];
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

