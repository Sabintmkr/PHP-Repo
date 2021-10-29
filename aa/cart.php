<?php include('header.php');

if(!empty($_POST["action"])){
  updateCart($_POST["action"],$_POST["id"]);
}

//Check if Items exists in Cart
if(!empty($_SESSION["cart_item"])) {
  //print_r($_SESSION["cart_item"]);

$item_total=0;
$shipping = 0;
?>

<div class="row">

  <div class="col-md-6">
    <div class="box">
      <div class="box-header"><h3 class="box-title">Current Cart</h3></div>
      <?php
        foreach ($_SESSION["cart_item"] as $item){
          $item_price = $item["quantity"]*$item["price"];
          $item_total = $item_total + $item_price;
      ?>

          <div class="box-body row">
            <div class="col-md-5">
              <img src="<?=$item['profile_image'];?>"/>
            </div>

            <form method="post" action="cart.php">
            <div style="padding:15px">
              <div class="item">
                <p class="message"><h3><?=$item['name'];?></h3></p>
              </div>
              <div class="item">
                <p class="message"><b>Director: </b><?=$item['director'];?></p>
              </div>
              <div class="item">
                <p class="message"><b>Quantity: <?=$item['quantity'];?></b></p>
              </div>
              <div class="item">
                <p class="message"><b>Amount: </b><?=$item_price;?></p>
              </div>
              <input type="hidden" name="id" id="id" value="<?=$item['id'];?>"/>
              <input type="hidden" name="action" id="action" value="remove"/>
              <div class="item">
                <p><input type="submit" class="btn btn-warning" value="Remove from Cart"/></p>
              </div>
            </div>
          </form>
          </div>

          <?php
        }
          ?>



    </div>
  </div>

  <div class="col-md-6">
    <div class="box">
      <div class="box-header"><h3 class="box-title">Summary</h3></div>
        <div class="table-responsive">
          <table class="table table-hover table-striped">
            <tbody>
              <tr><td>Item Total:</td><td>$<?=number_format((float)$item_total, 2, '.', '');?></td></tr>
              <tr><td>Shipping:</td><td>$<?=number_format((float)$shipping, 2, '.', '');?></td></tr>

            </tbody>
            <tfoot><tr><td><b>Order Total:</b></td><td><b>$<?=number_format((float)$item_total+$shipping, 2, '.', '');?></b></td></tr></tfoot>
          </table>
        </div>
    </div>
  </div>
</div>

<?php
}
else{
?>

<div class="row">

  <div class="col-md-12">
    <div class="box">
      <div class="box-header"><h3 class="box-title">Current Cart</h3></div>
        <div class="box-body no-padding">
          <div class="post">
            <p>Sorry, but your cart is empty !!!</p>
          </div>
        </div>
    </div>
  </div>
</div>

<?php
}


 ?>




<?php include('footer.php'); ?>
