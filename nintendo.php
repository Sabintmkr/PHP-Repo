<?php 
include 'libcommon.php';
include('layout_header.php');

$query = "select * from product";
$p_list = sqlSelectStatement($query);

?>
<div class="container">

    <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4"><b>Nintendo</b></h1>
            <div class="list-group">
                <a href="game.php" class="list-group-item">GAMES</a>
                <a href="accessories.php" class="list-group-item">ACCESSORIES</a>
                <a href="#" class="list-group-item">Nintendo New Release</a>
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <div class="img-body">
                <div class="imgslides fade">
                    <div class="numbering">1 / 3</div>
                    <img src="images/nsfheat.jpg" style="width:100%">
                    <div class="text game-heading">
                        <h1>Coming Soon!!!</h1>
                    </div>
                </div>

                <div class="imgslides fade">
                    <div class="numbering">2 / 3</div>
                    <img src="images/fifa.png" style="width:100%">
                    <div class="text game-heading">
                        <h1>Pre Order NOW!!!!</h1>
                    </div>
                </div>

                <div class="imgslides fade">
                    <div class="numbering">3 / 3</div>
                    <img src="images/thelast.jpg" style="width:100%">
                    <div class="text game-heading">
                        <h1>Release on Aug 14th. GRAB YOUR COPY</h1>
                    </div>
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

            </div>
            <br>

            <div style="text-align:center">
                <span class="ringbar" onclick="currentSlide(1)"></span>
                <span class="ringbar" onclick="currentSlide(2)"></span>
                <span class="ringbar" onclick="currentSlide(3)"></span>
            </div>

            <div class="row">
                <?php
      if(!empty($p_list)){
          foreach($p_list as $list){ 
            if($list['p_category'] == 'Nintendo'){?>
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
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

</div>
<?php 
include('layout_footer.php');
?>