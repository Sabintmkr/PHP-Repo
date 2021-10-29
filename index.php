<?php 
include 'libcommon.php';
include('layout_header.php');

$blist=getBannerList();
$query = "select * from product";
$p_list = sqlSelectStatement($query);
$ulist = getUpcomingList();
$clist = getCategoryList();
?>
<!--Image Slider-->
<div class="img-body">

    <?php 
         if(!empty($blist)){
            foreach($blist as $list){ 
                if($list['b_status']=="Active"){?>
    <div class="imgslides fade">
        <img src="<?=htmlspecialchars_decode($list['b_image']);?>" style="width:100%">
        <div class="text game-heading">
            <h1><?=$list['b_msg']?></h1>
        </div>
    </div>
    <?php }} } ?>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
    <span class="ringbar" onclick="currentSlide(1)"></span>
    <span class="ringbar" onclick="currentSlide(2)"></span>
    <span class="ringbar" onclick="currentSlide(3)"></span>
</div>
<!--End Image Slider-->
<!-- Start Categories  -->
<div class="game-category">
    <div class="container">
        <h1 class="game-heading">Game Categories</h1>
        <div class="row">
            <?php
                        if(!empty($c_list)){
                            foreach($c_list as $list){ ?>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="game-cat-box">
                    <img class="img-fluid" src="images/ps4.jpg" alt="psimage" />
                    <a class="btn btn_trans-hover"
                        href="catproduct.php?id=<?= $list['cat_id'];?>"><?=$list['cat_platform']?></a>
                </div>
            </div>
            <?php
                            }
                        }
                    ?>


        </div>
    </div>
</div>
<!-- End Categories -->
<!--All products-->
<div class="box-add-products">
    <div class="container">
        <h1 class="game-heading">GAMES</h1>
        <div class="row">
            <?php
                if(!empty($p_list)){
                    foreach($p_list as $list){ 
                        if($list['p_type'] == 'Game'){
                        ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="product.php?id=<?= $list['p_id'];?>"><img
                            src="<?=htmlspecialchars_decode($list['p_image']);?>"
                            alt="<?=htmlspecialchars_decode($list['p_name']);?>" style="width: 100%;" /></a>
                    <div class="card-body" style="text-align: center;">
                        <h4 class="card-title">
                            <a href="#"><?= $list['p_name'];?></a>
                        </h4>
                        <h5><?= $list['p_price'];?></h5>
                        <p class="card-text">Intro lateron</p>
                        <?php
                        if($list['p_sale'] == "Yes"){
                        ?>
                        <p class="card-text" style="color: red; font-weight: 800; font-size: -webkit-xxx-large;">Sale
                        </p>
                        <?php }?>
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
            <?php }}}?>
        </div>
    </div>
</div>
<div class="game-category">
    <div class="container">
        <h1 class="game-heading">Accessories</h1>
        <div class="row">
            <?php
                if(!empty($p_list)){
                    foreach($p_list as $list){ 
                        if($list['p_type'] == 'Accessories'){
                        ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="product.php?id=<?= $list['p_id'];?>"><img
                            src="<?=htmlspecialchars_decode($list['p_image']);?>"
                            alt="<?=htmlspecialchars_decode($list['p_name']);?>" style="width: 100%;" /></a>
                    <div class="card-body" style="text-align: center;">
                        <h4 class="card-title">
                            <a href="#"><?= $list['p_name'];?></a>
                        </h4>
                        <h5><?= $list['p_price'];?></h5>
                        <p class="card-text">Intro lateron</p>
                        <?php
                        if($list['p_sale'] == "Yes"){
                        ?>
                        <p class="card-text" style="color: red; font-weight: 800; font-size: -webkit-xxx-large;">Sale
                        </p>
                        <?php }?>
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
            <?php }}}?>
        </div>
    </div>
</div>
<!--End All products-->
<!--New Release Products-->
<div class="box-add-products">
    <div class="container">
        <h1 class="game-heading">New Release (COMING SOON!!!!)</h1>
        <div class="row">
            <?php
                if(!empty($ulist)){
                    $date=date('Y-m-d');
                    foreach($ulist as $list){ 
                       if($list['u_date']>$date){
                        ?>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="release_info-products">
                    <a href="newreleaseview.php?id=<?= $list['u_id'];?>">
                        <img class="img-fluid" src="<?=htmlspecialchars_decode($list['u_image']);?>"
                            alt="<?=htmlspecialchars_decode($list['u_name']);?>" /></td>
                    </a>
                </div>
            </div>


            <?php }}}?>
        </div>
    </div>
</div>
<!--End New Release Products-->


<?php include('layout_footer.php');