<?php 
include 'libcommon.php';
include('layout_header.php');

$search_name = "";

//Capture seacrh parameter if provided
if(isset($_POST["srch"])){
  $search_name = $_POST["srch"];
}
$sql_query = "select * from product WHERE '1'='1'";
if(isset($search_name)){
  $sql_query .= " and p_name LIKE '%".$search_name."%'";
}
$sql_query .= " order by p_name";
//echo($sql_query);
if(isset($_GET["value"])){
    $adsearchval=$_GET["value"];
}

/**Advance Search */
$clist = getCategoryList();
//if(!empty($adsearchval)){
//echo($adsearchval);}
//?>
<!--Normal Search-->
<?php if(empty($adsearchval)){?>
<div class="box-add-products">
	<div class="container">
        <h1 class="game-heading">Products</h1>
        <div class="row">
            <?php
                $p_list = sqlSelectStatement($sql_query);
                if(!empty($p_list)){
                    foreach($p_list as $list){ 
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img src="<?=htmlspecialchars_decode($list['p_image']);?>" alt="<?=htmlspecialchars_decode($list['p_name']);?>" style="width: 100%;"/></a>
                    <div class="card-body" style="text-align: center;">
                        <h4 class="card-title">
                            <a href="#"><?= $list['p_name'];?></a>
                        </h4>
                        <h5><?= $list['p_price'];?></h5>
                        <p class="card-text">Intro lateron</p>
                        <?php
                        if($list['p_sale'] == "Yes"){
                        ?>
                            <p class="card-text" style="color: red; font-weight: 800; font-size: -webkit-xxx-large;">Sale</p>
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
            <?php 
                    }
                }
            ?>
        </div>
    </div>
</div>
<?php 
}
else{
    //echo($adsearchval);
?>
<!--Advance search-->
<div class="container">
    <div class="box-add-products">
        <div class="container">
            <h1 class="game-heading">Advance search</h1>
        </div>
    </div>
    <form>
        <div class="row">
            <div class="col-lg-6">
                <label>Product Name:</label>
                <input type="text" class="form-control" id="input_name" name="input_name">
            </div>
            <div class="col-lg-6">
                <label>Category:</label>
                <select class="form-control" id="input_category" name="input_category"><option value="">--Select--</option>
                <?php
                    foreach($clist as $list){
                    
                    
                ?>
                <option value="<?=$list["cat_platform"];?>"><?=$list["cat_platform"];?></option>

                <?php } ?>
            </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>Type:</label>
                <!--<input type="text" class="form-control" id="input_type" name="input_type" value="<?=$ptype;?>" required>-->
                
                    <select class="form-control" id="input_type" name="input_type"><option value="">--Select--</option>
                    <option value="Game">Game</option>
                    <option value="Accessories">Accessories</option>
                    </select>
               
            </div>
            <div class="col-lg-6">
                <label>Price:</label>
                <input type="text" class="form-control" id="input_price" name="input_price">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>Sale Option:</label>
                <!--<input type="text" class="form-control" id="input_sale" name="input_sale" value="<?=$psale;?>" required>-->
               
                    <select class="form-control" id="input_sale" name="input_sale" ><option value="">--Select--</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    </select>
               
            </div>
      
            <div class="col-lg-6">
                <label>Release Date (YYYY-MM-DD):</label>
                <input type="text" class="form-control" id="input_date" name="input_date">
            </div>
           
        </div>
       
        <br>
        <div class="form-group"><input class="btn btn-primary" type="button" id="btnSearch" name="btnSearch" value="Search"/></div>
        
    </form>
</div>
<?php }?>

<!---Advance search result-->
<div class="container">
    <div class="box-add-products">
        <div class="container">
            <h1 class="game-heading sch">Search Result</h1>
            <div class="row"  id="divProduct">
             </div>
        </div>
    </div>
</div>
<?php 
include('layout_foot.php');
?>  

<script type="text/javascript">

$(document).ready(function () {
    $('.sch').hide();
  $('#btnSearch').click(function(){
    var pname = $('#input_name').val();
    var pcat = $('#input_category').val();
    var ptype = $('#input_type').val();
    var pprice = $('#input_price').val();
    var pdate = $('#input_date').val();
    var psale = $('#input_sale').val();
    
    $.ajax({
        method:"POST",
        url: 'searchajax.php',
        data: {pid:'',p_name:pname,p_cat:pcat,p_type:ptype,p_price:pprice,p_date:pdate,p_sale:psale,action:"advanceSearch"},
        success: function (data, status, xhr) {
          var resp = data;
          //alert(resp);
          if(resp === '')
            resp = "<h4><p class=\"text-center\">Sorry Not Product can be found.</p></h4>"
            $('.sch').show();
          $("#divProduct").html(resp);
        },
        error: function (jqXhr, textStatus, errorMessage) {
          alert("Server Connection Lost. Please try again");
        }
     });
  });
});

</script>