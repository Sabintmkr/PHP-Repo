<?php

include('dashboard_header.php');
include 'libcommon.php';

$id=$_SESSION['usr'];

if(!isset($_SESSION['usr']) || empty($_SESSION['usr'])){
  header("Location: error.php?msg=Access Denied!!! Please Login");
  die();
}

$currentuser_detail = getUserDetail($id);

if(empty($currentuser_detail)){
  header("Location: error.php?msg=Unauthorized Access are denied..");
}

$query = "select * from contactus";
$contact_list = sqlSelectStatement($query);
?>

<!--Section for User Actions for Logged In Users-->
<?php if(isset($_SESSION['current_session'])){ ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Message from Customers</h3>
    </div>
    <div class="box-body row">
        <div class="col-md-3">
            <!--<form method="get" action="categoryForm.php">
                <input type="submit" class="btn btn-primary" value="Add New"/>
            </form>-->
        </div>
    </div>
</div>
<?php }?>

<br><br>
<!--Contactus Index-->
<div class="table-responsive container" style="text-align: center !important;">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th data-sort-ignore="true">Name</th>
                    <th data-sort-ignore="true">Email</th>
                    <th data-sort-ignore="true">Message</th>
                    <th data-sort-ignore="true">Date</th>
                    <th data-sort-ignore="true">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($contact_list)){
                        foreach($contact_list as $list){ ?>
                <tr>
                    <td><?= $list['con_name']?></td>
                    <td><?= $list['con_email']?></td>
                    <td style="text-align: left !important; width:400px; word-wrap:break-word;">
                        <?php
                                       
                                         //Readmore code
                                        $string = strip_tags($list['con_message']);
                                        if (strlen($list['con_message']) > 100) {
                                        
                                            // truncate string
                                            $stringCut = substr($list['con_message'], 0, 100);
                                            $endPoint = strrpos($stringCut, ' ');
                                        
                                            //if the string doesn't contain any space then it will cut without word basis.
                                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string .= '... <a href="contactusview.php?id='.$list['con_id'].'">Read More</a>';
                                        }
                                       echo $string;
                                    ?>
                    </td>
                    <td><?= $list['con_date']?></td>
                    <td>
                        <form method="get" action="contactusview.php">
                            <input type="button" class="btn btn-success" value="View"
                                onclick="location.href='contactusview.php?id=<?= $list['con_id'];?>'" />
                            <!--<input type="button" class="btn btn-danger btnDelete" value="Delete" id="btnDelete" name="btnDelete"/>-->
                            <input type="hidden" id="id" name="id" value="<?= $list['con_id']?>" />
                    </td>
                </tr>
                <?php
                        }
                     }
                ?>
            </tbody>

        </table>
    </div>
</div>
<?php include('dashboard_footer.php'); ?>