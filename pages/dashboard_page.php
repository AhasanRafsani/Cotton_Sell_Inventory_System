<?php

if (($_SESSION['adminname'] == null) || ($_SESSION['adminpass'] == null)) {
    header("Location:index.php");
}

require_once 'class/Admin.php';
$adm = new Admin;
$data = $adm->getCountryList();
?>



<div>
    <?php
    if(isset($data)){

        while($country=mysqli_fetch_assoc($data)){

            $countryData=$adm->getFixedListInformationByCountryName($country['countryname']);
            $check=mysqli_num_rows($countryData);

            if($check>0){

                $totalQuantity=0;
                $grandTotal=0;
                $average=0;

                while($countryname=mysqli_fetch_assoc($countryData))
                {  $coName=$countryname['countryname'];
                    $totalQuantity = $totalQuantity + $countryname['quantity'];
                    $grandTotal = $grandTotal + $countryname['totalValue'];
                    $average = ($grandTotal / ($totalQuantity * 10)) / 2.2046;
                }

                ?>


                <div class="col-10 col-sm-4 col-md-3 col-lg-3 box">
                    <div class="box-body">
                        <h4>  <?php
                            echo $coName;
                            ?></h4>
                    </div>
                    <table>
                        <tr>
                            <th>Total_Quantity_Sell  : </th>
                            <td> <?php echo round($totalQuantity)?></td>
                        </tr>
                        <tr>
                            <th>Grand_Total :</th>
                            <td><?php echo  round ($grandTotal) ?></td>
                        </tr>
                        <tr>
                            <th>Avarage :</th>
                            <td><?php echo round($average)  ?>
                        </tr>

                    </table>
                </div>
                <?php
            }

        }
    }
    ?>
</div>

