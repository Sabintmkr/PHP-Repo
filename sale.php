<?php 
include 'libcommon.php';
include('layout_header.php');


$query = "select * from product where p_sale == 'Yes'";
?>
<div class="box-add-products">
	<div class="container">
        <h1 class="game-heading">Sale Today!!!!</h1>
        <div class="row">
            <?php
                $p_list = sqlSelectStatement($query);
                if(!empty($p_list)){
                    foreach($p_list as $list){ 
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img src="<?=htmlspecialchars_decode($list['p_image']);?>" alt="<?=htmlspecialchars_decode($list['p_name']);?>" style="width: 100%;"/></a>
                    <div class="card-body" style="text-align: center;">
                        <h4 class="card-title">
                            <a href="product.php?id=<?= $list['p_id'];?>"><?= $list['p_name'];?></a>
                        </h4>
                        <h5><?= $list['p_price'];?></h5>
                        <p class="card-text" style="color: red; font-weight: 800; font-size: -webkit-xxx-large;">Sale</p>
                    </div>
                    <div class="card-footer" style="color: red; font-weight:700; text-align:center;">
                    <input type="button" class="btn btn-warning" value="Add to Cart"
                                onClick="goCart('add','<?= $list['p_id'];?>')" />
                            <?php if(isset($_SESSION['cus_session'])){ ?>
                            <input type="button" class="btn btn-primary" value="Wishlist"
                                onClick="wish('add','<?= $list['p_id'];?>')" />
                            <?php }?>
                    </div>
                </div>
            </div>
            <?php 
                    }
                }
            ?>
        </div>
    </div>
</div>


<?php 
include('layout_foot.php');
?>  