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

   
//Initialize variables for order
    if(isset($_GET["id"])){
    $id=$_GET["id"];
    $header_index="Order Details";

    $order_detail = getOrder($id);
    
    

    //order
    $id = $order_detail['o_id'];
    $name = $order_detail['o_name'];
    $email = $order_detail['o_email'];
    $mobile = $order_detail['o_mobile'];
    $address = $order_detail['o_address'];
    $suburb = $order_detail['o_suburb'];
    $city = $order_detail['o_city'];
    $state = $order_detail['o_state'];
    $payment = $order_detail['o_payment'];
    $date = $order_detail['o_date'];
    $status = $order_detail['o_status'];
    $msg = $order_detail['o_msg'];


    //order details

    
    
    }

   

    $list_total=0;
    $delivery = 0;
?>
<style>
.msg-input {
    background-color: #faf7f7 !important;
}
</style>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?=$header_index;?></h3>
    </div>
</div>

<div class="container emp-profile">
    <div class="row">
        <div class="col-lg-6">
            <label>Customer Name:</label>
            <input type="text" class="form-control msg-input" id="input_name" name="input_name" value="<?=$name;?>"
                disabled>
        </div>
        <div class="col-lg-6">
            <label>Email:</label>
            <input type="text" class="form-control msg-input" id="input_email" name="input_email" value="<?=$email;?>"
                disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label>Mobile:</label>
            <input type="text" class="form-control msg-input" id="input_mobile" name="input_mobile"
                value="<?=$mobile;?>" disabled>
        </div>
        <div class="col-lg-6">
            <label>Address:</label>
            <input type="text" class="form-control msg-input" id="input_address" name="input_address"
                value="<?=$address;?>" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label>Suburb:</label>
            <input type="text" class="form-control msg-input" id="input_suburb" name="input_suburb"
                value="<?=$suburb;?>" disabled>
        </div>
        <div class="col-lg-6">
            <label>City:</label>
            <input type="text" class="form-control msg-input" id="input_city" name="input_city" value="<?=$city;?>"
                disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label>Payment:</label>
            <input type="text" class="form-control msg-input" id="input_payment" name="input_payment"
                value="<?=$payment;?>" disabled>
        </div>
        <div class="col-lg-6">
            <label>Date:</label>
            <input type="text" class="form-control msg-input" id="input_date" name="input_date" value="<?=$date;?>"
                disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label>Status:</label>
            <input type="text" class="form-control msg-input" id="input_status" name="input_status"
                value="<?=$status;?>" disabled>
        </div>
        <div class="col-lg-6">

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <label>Message:</label>
            <textarea class="form-control msg-input" id="input_msg" name="input_msg" rows="5" cols="40"
                disabled><?=$msg;?></textarea>
        </div>
    </div>

    <br>

</div>
<?php
$query = "select * from orders o, orderdetails od WHERE o.o_id == od.od_o_id and o.o_id ==".$id;
$a_list = sqlSelectStatement($query);
if (is_array($a_list) || is_object($a_list))
{
     foreach ($a_list as $Tlist){
        
        $list_price = $Tlist["od_qty"]*$Tlist["od_price"];
        $list_total = $list_total + $list_price;
        $delivery = 0.07 * $list_total;
       //echo ($list_price);
    }
}
   
?>
<div class="table-responsive container" style="text-align: center !important;">
    <h2>Orders:</h2>
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th data-sort-ignore="true">Id</th>
                    <th data-sort-ignore="true">Image</th>
                    <th data-sort-ignore="true">Item</th>
                    <th data-sort-ignore="true">Rate</th>
                    <th data-sort-ignore="true">Quantity</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($a_list) || is_object($a_list))
                {
                    if(!empty($a_list)){
                        foreach($a_list as $list){ ?>
                <tr>
                    <td><?= $list['od_id']?></td>
                    <td><img src="<?=htmlspecialchars_decode($list['od_image']);?>"
                            alt="<?=htmlspecialchars_decode($list['od_name']);?>" style="width:182px; height:268px;" />
                    </td>
                    <td><?= $list['od_name']?></td>
                    <td><?= $list['od_price']?></td>
                    <td><?= $list['od_qty']?></td>
                </tr>
                <?php
                        }
                     }
                    }
                ?>
            </tbody>

        </table>
    </div>
    <br />
    <hr />
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Billing</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <tbody>
                    <tr>
                        <td>Total Amount:</td>
                        <td>$<?=number_format((float)$list_total, 2, '.', '');?></td>
                    </tr>
                    <tr>
                        <td>Delivery:</td>
                        <td>$<?=number_format((float)$delivery, 2, '.', '');?></td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td><b>Order Total:</b></td>
                        <td><b>$<?=number_format((float)$list_total+$delivery, 2, '.', '');?></b></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <hr />
</div>




<?php include('dashboard_footer.php'); ?>