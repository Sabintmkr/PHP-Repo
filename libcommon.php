<?php
    session_start();
    require("common.php");

    function get_dbConnection(){
        return new PDO('sqlite:'.dirname(__FILE__).'/'.db_game);
    }

    function end_dbConnection($db_con){
        $db_con = null;
    }
//login
    function emp_Login($usr_name,$usr_password){
        $mydb = get_dbConnection();
        $query = "SELECT * FROM employee WHERE emp_username ='" .$usr_name. "' AND emp_password = '" .$usr_password. "'";
        if($mydb){
            $result = $mydb->query($query);
            return $result->fetch();
        }
        else{
            print "Connection Error!. There is not database connection. Please check the database is connected.\n";
        }
        end_dbConnection();
    }
//customer login
    function customer_Login($cus_name,$cus_password){
      $mydb = get_dbConnection();
      $query = "SELECT * FROM client WHERE cl_username ='" .$cus_name. "' AND cl_password = '" .$cus_password. "'";
      if($mydb){
          $result = $mydb->query($query);
          return $result->fetch();
      }
      else{
          print "Connection Error!. There is not database connection. Please check the database is connected.\n";
      }
      end_dbConnection();
    }

//check userdetail for dash home page.
    function getUserDetail($id){
      $mydb = get_dbConnection();
    
      $query = "SELECT * from employee WHERE emp_id=".$id;
      if ($mydb) {
        $result = $mydb->query($query);
    
        return $result->fetch();
    
      } else {
          print "Database connection failed!\n";
      }
      closeDBConnection();
    }

    
    function generateRandomNumber($length){
        $digits = "";
        $numbers = range(0,9);
        shuffle($numbers);
        for($i = 0; $i < $length; $i++){
            global $digits;
            $digits .= $numbers[$i];
        }
        return $digits;
    }

    //cart updates
function goCart($action,$id){
  switch ($action) {
    case 'add':
      if(!empty($id)) {
        $product_detail = getProduct($id);
        $itemArray = array($product_detail["p_id"]=>array('p_id'=>$product_detail["p_id"],'p_name'=>$product_detail["p_name"],'p_image'=>$product_detail['p_image'],
        'p_quantity'=>'1','p_price'=>$product_detail["p_price"]));

        if(!empty($_SESSION["cart_product"])) {
			    if(in_array($product_detail["p_id"],array_keys($_SESSION["cart_product"]))) {

				    foreach($_SESSION["cart_product"] as $k => $v) {
						  if($product_detail["p_id"] == $k) {
							  if(empty($_SESSION["cart_product"][$k]["p_quantity"])) {
								  $_SESSION["cart_product"][$k]["p_quantity"] = 0;
							  }
						    $_SESSION["cart_product"][$k]["p_quantity"]++;
						  }
				    }
			    } else {
            $_SESSION["cart_product"] = $_SESSION["cart_product"]+$itemArray;
			    }
		    } else {
			    $_SESSION["cart_product"] = $itemArray;
		    }
    }
    break;
    case 'remove':
      if(!empty($id)) {
        foreach($_SESSION["cart_product"] as $k => $v) {

			    if($id == $k)
				    unset($_SESSION["cart_product"][$k]);
			    if(empty($_SESSION["cart_product"]))
				    unset($_SESSION["cart_product"]);
		    }

    }
    break;

    default:
      // code...
      break;
  }
}

function wish($action,$id){
  switch ($action) {
    case 'add':
      if(!empty($id)) {
        $product_detail = getProduct($id);
        $itemArray = array($product_detail["p_id"]=>array('p_id'=>$product_detail["p_id"],'p_name'=>$product_detail["p_name"],'p_image'=>$product_detail['p_image'],
        'p_quantity'=>'1','p_price'=>$product_detail["p_price"]));

        if(!empty($_SESSION["wish_product"])) {
			    if(in_array($product_detail["p_id"],array_keys($_SESSION["wish_product"]))) {

				    foreach($_SESSION["wish_product"] as $k => $v) {
						  if($product_detail["p_id"] == $k) {
							  if(empty($_SESSION["wish_product"][$k]["p_quantity"])) {
								  $_SESSION["wish_product"][$k]["p_quantity"] = 0;
							  }
						    $_SESSION["wish_product"][$k]["p_quantity"]++;
						  }
				    }
			    } else {
            $_SESSION["wish_product"] = $_SESSION["wish_product"]+$itemArray;
			    }
		    } else {
			    $_SESSION["wish_product"] = $itemArray;
		    }
    }
    break;
    case 'remove':
      if(!empty($id)) {
        foreach($_SESSION["wish_product"] as $k => $v) {

			    if($id == $k)
				    unset($_SESSION["wish_product"][$k]);
			    if(empty($_SESSION["wish_product"]))
				    unset($_SESSION["wish_product"]);
		    }

    }
    break;

    default:
      // code...
      break;
  }
}


// Category
    function addCategory($val){
      $mydb = get_dbConnection();
      $query = $val;
      if($mydb){
        $mydb->exec($query);
        $id = $mydb->lastInsertId();
        return $id;
      }
      else{
        print "Database connection failed!\n";
      }
      closeDBConnection();
    }

    function getCategory($id){
      $mydb = get_dbConnection();
    
      $query = "SELECT * from category WHERE cat_id=".$id;
      if ($mydb) {
        $result = $mydb->query($query);
    
        return $result->fetch();
    
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

    function updateCategory($val){
      $mydb = get_dbConnection();
      $query = $val;
      if ($mydb) {
        $mydb->exec($query);
        return;
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

    function getCategoryList(){
      $mydb = get_dbConnection();
    
      if ($mydb) {
        $result = $mydb->query("select c.cat_platform from category c ");
        return $result;
    
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

// Employee
    function addEmployee($val){
      $mydb = get_dbConnection();
      $query = $val;
      if($mydb){
        $mydb->exec($query);
        $id = $mydb->lastInsertId();
        return $id;
      }
      else{
        print "Database connection failed!!!\n";
      }
      closeDBConnection();
    }

    function getEmployee($id){
      $mydb = get_dbConnection();
    
      $query = "SELECT * from employee WHERE emp_id=".$id;
      if ($mydb) {
        $result = $mydb->query($query);
    
        return $result->fetch();
    
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

    function updateEmployee($val){
      $mydb = get_dbConnection();
      $query = $val;
      if ($mydb) {
        $mydb->exec($query);
        return;
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

    //product

    function addProduct($val){
      $mydb = get_dbConnection();
      $query = $val;
      if($mydb){
        $mydb->exec($query);
        $id = $mydb->lastInsertId();
        return $id;
      }
      else{
        print "Database connection failed!!!\n";
      }
      closeDBConnection();
    }

    function getProduct($id){
      $mydb = get_dbConnection();
    
      $query = "SELECT * from product WHERE p_id=".$id;
      if ($mydb) {
        $result = $mydb->query($query);
    
        return $result->fetch();
    
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

    function updateProduct($val){
      $mydb = get_dbConnection();
      $query = $val;
      if ($mydb) {
        $mydb->exec($query);
        return;
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

    function getProductList(){
      $mydb = get_dbConnection();
    
      if ($mydb) {
        $result = $mydb->query("select p.p_name from product p ");
        return $result;
    
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

    //contactus
    function addcontactus($val){
      echo "<script type='text/javascript'>alert('$val');</script>";
      $mydb = get_dbConnection();
      $query = $val;
      if($mydb){
        $mydb->exec($query);
        $id = $mydb->lastInsertId();
        echo "<script type='text/javascript'>alert('$id');</script>";
        return $id;
      }
      else{
        print "Database connection failed!!!\n";
      }
      closeDBConnection();
    }

    function getContactList(){
      $mydb = get_dbConnection();
    
      if ($mydb) {
        $result = $mydb->query("select * from contactus ");
        return $result;
    
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

    function getCustomerquery($id){
      $mydb = get_dbConnection();
    
      $query = "SELECT * from contactus WHERE con_id=".$id;
      if ($mydb) {
        $result = $mydb->query($query);
    
        return $result->fetch();
    
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

    //Customer
    function addCustomer($val){
      $mydb = get_dbConnection();
      $query = $val;
      if($mydb){
        $mydb->exec($query);
        $id = $mydb->lastInsertId();
        return $id;
      }
      else{
        print "Database connection failed!!!\n";
      }
      closeDBConnection();
    }

    function getCustomer($id){
      $mydb = get_dbConnection();
    
      $query = "SELECT * from client WHERE cl_id=".$id;
      if ($mydb) {
        $result = $mydb->query($query);
    
        return $result->fetch();
    
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

    function getCustomerbyname($nm){
      $mydb = get_dbConnection();
    
      $query = "SELECT * from client WHERE cl_username=".$nm;
      if ($mydb) {
        $result = $mydb->query($query);
    
        return $result->fetch();
    
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }


    function updateCustomer($val){
      $mydb = get_dbConnection();
      $query = $val;
      if ($mydb) {
        $mydb->exec($query);
        return;
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

    //banner
    function addBanner($val){
      $mydb = get_dbConnection();
      $query = $val;
      if($mydb){
        $mydb->exec($query);
        $id = $mydb->lastInsertId();
        return $id;
      }
      else{
        print "Database connection failed!!!\n";
      }
      closeDBConnection();
    }

    function getBanner($id){
      $mydb = get_dbConnection();
    
      $query = "SELECT * from banner WHERE b_id=".$id;
      if ($mydb) {
        $result = $mydb->query($query);
    
        return $result->fetch();
    
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

    function updateBanner($val){
      $mydb = get_dbConnection();
      $query = $val;
      if ($mydb) {
        $mydb->exec($query);
        return;
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

    function getBannerList(){
      $mydb = get_dbConnection();
    
      if ($mydb) {
        $result = $mydb->query("select * from banner ");
        return $result;
    
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }

 //Upcoming item
 function addUpcoming($val){
  $mydb = get_dbConnection();
  $query = $val;
  if($mydb){
    $mydb->exec($query);
    $id = $mydb->lastInsertId();
    return $id;
  }
  else{
    print "Database connection failed!!!\n";
  }
  closeDBConnection();
}

function getUpcoming($id){
  $mydb = get_dbConnection();

  $query = "SELECT * from upcomingitem WHERE u_id=".$id;
  if ($mydb) {
    $result = $mydb->query($query);

    return $result->fetch();

  } else {
      print "Database Connection failed!\n";
  }
  closeDBConnection();
}

function updateUpcoming($val){
  $mydb = get_dbConnection();
  $query = $val;
  if ($mydb) {
    $mydb->exec($query);
    return;
  } else {
      print "Database Connection failed!\n";
  }
  closeDBConnection();
}

function getUpcomingList(){
  $mydb = get_dbConnection();

  if ($mydb) {
    $result = $mydb->query("select * from upcomingitem ");
    return $result;

  } else {
      print "Database Connection failed!\n";
  }
  closeDBConnection();
}
//add order
function addOrder($val){
  $mydb = get_dbConnection();
  $query = $val;
  if($mydb){
    $mydb->exec($query);
    $id = $mydb->lastInsertId();
    return $id;
  }
  else{
    print "Database connection failed!!!\n";
  }
  closeDBConnection();
}

//add order details
function addOrderdetails($val){
  $mydb = get_dbConnection();
  $query = $val;
  if($mydb){
    $mydb->exec($query);
    $id = $mydb->lastInsertId();
    return $id;
  }
  else{
    print "Database connection failed!!!\n";
  }
  closeDBConnection();
}

function getOrder($id){
  $mydb = get_dbConnection();

  $query = "select * from ORDERS o, orderdetails od WHERE o.o_id == od.od_o_id and o.o_id =".$id;
  if ($mydb) {
    $result = $mydb->query($query);

    return $result->fetch();

  } else {
      print "Database Connection failed!\n";
  }
  closeDBConnection();
}

//
    function sqlSelectStatement($val){
      $mydb = get_dbConnection();
      $query = $val;
      if ($mydb) {
        $result = $mydb->query($query);
    
        return $result->fetchAll();
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    }
    
    function sqlExecuteStatement($val){
      $mydb = get_dbConnection();
      $query = $val;
      if ($mydb) {
        $mydb->exec($query);
        return;
      } else {
          print "Database Connection failed!\n";
      }
      closeDBConnection();
    
    }

    function singleQuote($string){
      $return_string = $string;
      $return_string = str_replace(";", "", $string);
      $return_string = str_replace("'", "''", $string);
      //$return_string = str_replace('"', '""', $return_string);
    
      $return_string = htmlentities($return_string);
      return "'".$return_string."'";
    }

    
    
?>