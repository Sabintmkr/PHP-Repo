<?php 
include 'libcommon.php';
include('layout_header.php');

if(!empty($_POST["action"])){
    wish($_POST["action"],$_POST["id"]);
    //echo($_POST["action"]);
    //echo($_POST["p_id"]);
  }
  
  
  //Check if Items exists in Cart
  if(!empty($_SESSION["wish_product"])) {
    //print_r($_SESSION["cart_product"]);
  
 
?>
<div class="container">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">My Wishlist</h3>
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
                    foreach ($_SESSION["wish_product"] as $list){
                    
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
                            <form method="post" action="wishlist.php">
                                <input type="hidden" name="id" id="id" value="<?=$list['p_id'];?>" />
                                <input type="hidden" name="action" id="action" value="remove" />

                                <input type="submit" class="btn btn-warning" value="Remove from List" />
                                <input type="button" class="btn btn-warning" value="Add to Cart" onClick="goCart('add','<?= $list['p_id'];?>')"/>
                            </form>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>

            </table>

        </div>
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
                            <h4 class="p1"><span class="s1"><b>My Wishlist</b></span></h4>
                            <br>
                            <div class="page_tg">
                                <p>
                                    Sorry.... No products are in your wishlist....
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


<?php 
include('layout_foot.php');
?>
