<?php
    include 'libcommon.php';
    
    $user_action =$_POST["action"];
if($user_action == "advanceSearch"){
	$p_name = $_POST["p_name"];
	$p_cat = $_POST["p_cat"];
	$p_type = $_POST["p_type"];
	$p_price = $_POST["p_price"];
	$p_sale = $_POST["p_sale"];
	$p_date = $_POST["p_date"];
 

	$sql = "select p.* FROM product p LEFT JOIN category a ON p.p_category=a.cat_platform WHERE 1=1";

	if(!empty($p_name))
		$sql = $sql." and p.p_name like '%".$p_name."%'";

	if(!empty($p_cat))
		$sql = $sql." and a.cat_platform= '".$p_cat."'";

	if(!empty($p_type))
		$sql = $sql." and p.p_type = '".$p_type."'";

	if(!empty($p_price))
    $sql = $sql." and p.p_price = '".$p_price."'";
  
  if(!empty($p_sale))
  $sql = $sql." and p.p_sale = '".$p_sale."'";
  
  if(!empty($p_date))
		$sql = $sql." and p.p_date = '".$p_date."'";
	else {
		$sql = $sql." group by p.p_name";
	}
	$sql = $sql." order by p.p_name";
//echo $sql;
//exit();
	$products = sqlSelectStatement($sql);

	$res= "";
	foreach ($products as $list) {
	
	//	$res = $res."<div class=\"row\">";
    $res = $res."<div class=\"col-lg-4 col-md-6 mb-4\">";
    $res = $res."<div class=\"card h-100\">";
		$res = $res."<a href=\"\"><img src=\"".htmlspecialchars_decode($list["p_image"])."\" alt=\"".htmlspecialchars_decode($list["p_name"])."\" style=\"width: 100%\"></a>";
    $res = $res."<div class=\"card-body\" style=\"text-align: center;\">";
    $res = $res."<h4 class=\"card-title\"><a href=\"#\">".htmlspecialchars_decode($list["p_name"])."</a></h4>";
    $res = $res."<h5 class=\"card-text\">".htmlspecialchars_decode($list["p_price"])."</a></h5>";
    $res = $res."<p class=\"card-text\">Intro Lateron</p>";
    if(htmlspecialchars_decode($list["p_sale"]) == "Yes"){
	$res = $res." <p class=\"card-text\" style=\"color: red; font-weight: 800; font-size: -webkit-xxx-large;\">Sale</p><?php }?>";
	}
    $res = $res."</div>";
    $res = $res." <div class=\"card-footer\" style=\"color: red; font-weight:700; text-align:center;\"><input type=\"button\" class=\"btn btn-warning\" value=\"Add to Cart\" onClick=\"goCart('add','".htmlspecialchars_decode($list['p_id'])."')\"></div>";  
    $res = $res."</div>";
    $res = $res."</div>";
	}
	echo ($res);
	exit();
}

?>
 