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
$data=$adm->getFixedList();
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
            <th>Basis</th>
            <th>Premium</th>
            <th>Total</th>
            <th>Total_Value</th>
            <th>Shipper</th>
            <th>Shipment</th>
            <th>Remark</th>
            <th>Action</th>
            <th>Lc_Open</th>


        </tr>

        </thead>
        <tbody class="table-sm">
        <?php

        if(isset($data)){
        $i=0;
        $totalQuantity=0;
        $grandTotal=0;

        while($fixedList=mysqli_fetch_assoc($data)){
        $i++;
        ?>

        <tr>
            <td><?php echo $i ?></td>
            <td> <?php echo $fixedList['piNumber'];?> </td>
            <td> <?php echo $fixedList['countryname'];?></td>
            <td> <?php echo $fixedList['contactNumber'];?></td>
            <td> <?php echo $fixedList['quantity'];?></td>
            <td> <?php echo $fixedList['lce'];?></td>
            <td> <?php echo $fixedList['basis'];?></td>
            <td> <?php echo $fixedList['premium'];?></td>
            <td> <?php echo $fixedList['total'];?></td>
            <td> <?php echo $fixedList['totalValue'];?></td>
            <td> <?php echo $fixedList['shipper'];?></td>
            <td> <?php echo $fixedList['shipment'];?></td>
            <td> <?php echo $fixedList['remark'];?></td>
            <td>
                <a class="btn btn-outline-success" href="updateFixedInformation.php?id=<?php echo $fixedList['piNumber'];?> ">Edit</a>
            </td>
            <td>
                <a class="btn btn-outline-success" href="lcOpen.php?id=<?php echo $fixedList ['piNumber'];?>">Lc_Opening</a>
            </td>


            <?php
            $totalQuantity =$totalQuantity+$fixedList['quantity'];
            $grandTotal=$grandTotal+$fixedList['totalValue'];
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