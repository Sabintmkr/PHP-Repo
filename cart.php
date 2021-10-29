<?php 
include 'libcommon.php';
include('layout_header.php');

if(!empty($_POST["action"])){
    goCart($_POST["action"],$_POST["id"]);
    //echo($_POST["action"]);
    //echo($_POST["p_id"]);
  }
  
  //Check if Items exists in Cart
  if(!empty($_SESSION["cart_product"])) {
    //print_r($_SESSION["cart_product"]);
  
  $list_total=0;
  $delivery = 0;
?>
<div class="container">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">My Cart</h3>
        </div>
    </div>


    <br><br>
    <!--Customer Index-->
    <div class="table-responsive container" style="text-align: center !important;">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th data-sort-ignore="true">Id</th>
                        <th data-sort-ignore="true">Image</th>
                        <th data-sort-ignore="true">Item</th>
                        <th data-sort-ignore="true">Rate</th>
                        <th data-sort-ignore="true">Quantity</th>
                        <th data-sort-ignore="true">Delete</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                 $id =0;
                    foreach ($_SESSION["cart_product"] as $list){
                        $list_price = $list["p_quantity"]*$list["p_price"];
                        $list_total = $list_total + $list_price;
                        $delivery = 0.07 * $list_total;
                        $id = $id + 1;
                ?>
                    <tr>
                        <td><?=$id?></td>
                        <td><img src="<?=htmlspecialchars_decode($list['p_image']);?>"
                                alt="<?=htmlspecialchars_decode($list['p_name']);?>"
                                style="width:182px; height:268px;" /></td>
                        <td><?=$list['p_name']?></td>
                        <td><?=$list['p_price']?></td>
                        <td><?=$list['p_quantity']?></td>
                        <td>
                            <form method="post" action="cart.php">
                                <input type="hidden" name="id" id="id" value="<?=$list['p_id'];?>" />
                                <input type="hidden" name="action" id="action" value="remove" />

                                <input type="submit" class="btn btn-warning" value="Remove from Cart" />
                            </form>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>

            </table>

        </div>
    </div>
    <div class="container">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Billing</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <tbody>
                        <tr>
                            <td>Product Total:</td>
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
        <br />
        <input type="button" id="btncheck" class="btn btn-success" value="Proceed To checkout">
    </div>
    <?php
}
else{
?>
    <div class="container">
        <div class="one withsmallpadding ppb_text"
            style="text-align:center;padding:0px 0 0px 0;margin-top:20px;margin-bottom:60px;">
            <div class="standard_wrapper">
                <div class="page_content_wrapper">
                    <div class="inner">
                        <div style="margin:auto;width:80%">
                            <h4 class="p1"><span class="s1"><b>My CART</b></span></h4>
                            <br>
                            <div class="page_tg">
                                <p>
                                    Sorry.... No products are in the Cart....
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}


 ?>


    <br />

    <hr />
    <div class="container checkout">
        <h2>Customer Details</h2>
        <form action="cartcontroller.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <label>Name:</label>
                    <input type="text" class="form-control" id="input_name" name="input_name" value="" required>
                </div>
                <div class="col-lg-6">
                    <label>Email:</label>
                    <input type="text" class="form-control" id="input_email" name="input_email" value="" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label>Mobile:</label>
                    <input type="text" class="form-control" id="input_mobile" name="input_mobile" value="" required>
                </div>
                <div class="col-lg-6">
                    <label>Address:</label>
                    <input type="text" class="form-control" id="input_address" name="input_address" value="" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label>Suburb:</label>
                    <input type="text" class="form-control" id="input_suburb" name="input_suburb" value="" required>
                </div>
                <div class="col-lg-6">
                    <label>City:</label>
                    <input type="text" class="form-control" id="input_city" name="input_city" value="" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label>State:</label>
                    <input type="text" class="form-control" id="input_state" name="input_state" value="" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label>Message:</label>
                    <textarea class="form-control msg-input" id="input_msg" name="input_msg" rows="5"
                        cols="40"></textarea>
                </div>
            </div>
            <hr />
            <br />
            <h2>Payment Mode</h2>
            <hr />
            <div class="row">
                <div class="col-lg-6">
                    <label>Payment Type:</label>
                    <select class="form-control" id="input_checkout" name="input_checkout" required>
                        <option value="">--Select--</option>
                        <option value="cod">Cash on Delivery</option>
                        <option value="banktransfer" id="bank_transfer">Bank Transfer</option>
                    </select>
                </div>
                <br />
            </div>
            <br />
            <hr />
            <div class="form-group act">
                <p>Account Name: Gameland</p>
                <p>BSB: 000000</p>
                <p>Account Number: 001122-115</p>
            </div>

            <hr />
            <br />
            <div class="form-group"><input type="submit" class="btn btn-primary" value="Confirm Order" id="btnSubmit"
                    name="btnSubmit" /></div>

        </form>
    </div>
</div>
<?php 
include('layout_foot.php');
?>
<script>
$(document).ready(function() {
    $(".checkout").hide();
    $('#btncheck').click(function() {
        $(".checkout").show();
    });
    $(".act").hide();

    $('#input_checkout').on('change', function() {
        var value = $('#input_checkout option:selected').val();
        //alert(value);
        if (value == "banktransfer") {
            $(".act").show();
        }
    });



});
</script>