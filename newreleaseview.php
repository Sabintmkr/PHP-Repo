<?php 
include 'libcommon.php';
include('layout_header.php');

if(isset($_GET["id"])){
    $id=$_GET["id"];
    

    $list = getUpcoming($id);
        
   
    
}
?>  
<div class="container">

<div class="row">

  <div class="col-lg-3">

      <div class="list-group">
      <a href="game.php" class="list-group-item">GAMES</a>
      <a href="accessories.php" class="list-group-item">ACCESSORIES</a>
      <a href="sale.php" class="list-group-item">SALE ITEMS</a>
    </div>

  </div>
  <!-- /.col-lg-3 -->

  <div class="col-lg-9">
        <div class="img-body">
            <img src="<?=htmlspecialchars_decode($list['u_image']);?>" alt="<?=htmlspecialchars_decode($list['u_name']);?>" >
        </div>
        <br>
        <h2><?=$list['u_name']?></h2>
        <p><?=$list['u_msg']?></p>
    </div>

</div>
<!-- /.row -->

      
     
         
</div>
<?php 
include('layout_footer.php');
?>  