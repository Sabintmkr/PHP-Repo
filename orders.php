<?php

include('dashboard_header.php');
include 'libcommon.php';

$id=$_SESSION['usr'];

if(!isset($_SESSION['usr']) || empty($_SESSION['usr'])){
  header("Location: error.php?msg=Access Denied!!! Please Login");
  die();
}

$currentuser_detail = getUserDetail($id);

if(empty($currentuser_detail)){
  header("Location: error.php?msg=Unauthorized Access are denied..");
}

$query = "select * from orders o, orderdetails od WHERE o.o_id == od.od_o_id;";
$o_list = sqlSelectStatement($query);
?>

<!--Section for User Actions for Logged In Users-->
<?php if(isset($_SESSION['current_session'])){ ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Order List</h3>
    </div>
    <div class="box-body row">
    </div>
</div>
<?php }?>

<br><br>
<!--Order Index-->
<div class="table-responsive container" style="text-align: center !important;">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th data-sort-ignore="true">Image</th>
                    <th data-sort-ignore="true">Product Name</th>
                    <th data-sort-ignore="true">Customer Name</th>
                    <th data-sort-ignore="true">Msg</th>
                    <th data-sort-ignore="true">Date</th>
                    <th data-sort-ignore="true">Rate</th>
                    <th data-sort-ignore="true">Qty</th>
                    <th data-sort-ignore="true">Payment</th>
                    <th data-sort-ignore="true">Status</th>
                    <th data-sort-ignore="true">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($o_list)){
                        foreach($o_list as $list){ ?>
                <tr>
                    <td><img src="<?=htmlspecialchars_decode($list['od_image']);?>"
                            alt="<?=htmlspecialchars_decode($list['od_name']);?>" style="width:182px; height:268px;" />
                    </td>
                    <td><?= $list['od_name']?></td>
                    <td><?= $list['o_name']?></td>
                    <td style="text-align: left !important; width:400px; word-wrap:break-word;">
                                    <?php
                                       
                                         //Readmore code
                                        $string = strip_tags($list['o_msg']);
                                        if (strlen($list['o_msg']) > 100) {
                                        
                                            // truncate string
                                            $stringCut = substr($list['o_msg'], 0, 100);
                                            $endPoint = strrpos($stringCut, ' ');
                                        
                                            //if the string doesn't contain any space then it will cut without word basis.
                                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string .= '... <a href="orderview.php?id='.$list['o_id'].'">Read More</a>';
                                        }
                                       echo $string;
                                    ?>
                                </td>
                    <td><?= $list['o_date']?></td>
                    <td><?= $list['od_price']?></td>
                    <td><?= $list['od_qty']?></td>
                    <td><?= $list['o_payment']?></td>
                    <td><?= $list['o_status']?></td>
                    <td>
                        <form method="get" action="orderview.php">
                            <input type="button" class="btn btn-success" value="View"
                                onclick="location.href='orderview.php?id=<?= $list['o_id'];?>'" />
                            <input type="hidden" id="id" name="id" value="<?= $list['o_id']?>" />
                        </form>
                    </td>
                </tr>
                <?php
                        }
                     }
                ?>
            </tbody>

        </table>
    </div>
</div>

<?php include('dashboard_footer.php'); ?>
