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

$query = "select * from upcomingitem";
$u_list = sqlSelectStatement($query);
?>

<!--Section for User Actions for Logged In Users-->
<?php if(isset($_SESSION['current_session'])){ ?>
  <div class="box">
    <div class="box-header"><h3 class="box-title">Upcoming Item Index</h3></div>
    <div class="box-body row">
         <div class="col-md-3">
            <form method="get" action="upcomingform.php">
                <input type="submit" class="btn btn-primary" value="Add New"/>
            </form>
        </div>
    </div>
  </div>
<?php }?>

<br><br>
<!--New Release Index-->
<div class="table-responsive container" style="text-align: center !important;">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th data-sort-ignore="true">Image</th>
                    <th data-sort-ignore="true">Name</th>
                    <th data-sort-ignore="true">Release Date</th>
                    <th data-sort-ignore="true">Message</th>
                    <th data-sort-ignore="true">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($u_list)){
                        foreach($u_list as $list){ ?>
                            <tr>
                                <td><img src="<?=htmlspecialchars_decode($list['u_image']);?>" alt="<?=htmlspecialchars_decode($list['u_name']);?>" style="width:182px; height:268px;"/></td>
                                <td><?= $list['u_name']?></td>
                                <td><?= $list['u_date']?></td>
                                <td style="text-align: left !important; width:400px; word-wrap:break-word;">
                                    <?php
                                       
                                         //Readmore code
                                        $string = strip_tags($list['u_msg']);
                                        if (strlen($list['u_msg']) > 100) {
                                        
                                            // truncate string
                                            $stringCut = substr($list['u_msg'], 0, 100);
                                            $endPoint = strrpos($stringCut, ' ');
                                        
                                            //if the string doesn't contain any space then it will cut without word basis.
                                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string .= '... <a href="upcomingform.php?id='.$list['u_id'].'">Read More</a>';
                                        }
                                       echo $string;
                                    ?>
                                </td>
                                <td>
                                    <form method="get" action="upcomingform.php">
                                    <input type="button" class="btn btn-primary" value="Edit" onclick="location.href='upcomingform.php?id=<?= $list['u_id'];?>'"/>
                                    <input type="button" class="btn btn-danger btnDelete" value="Delete" id="btnDelete" name="btnDelete"/>
                                    <input type="hidden" id="id" name="id" value="<?= $list['u_id']?>"/>
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
<script>
    $(document).ready(function(){
        $('.btnDelete').click(function(){
            if(confirm("Are you sure to delete the Item?")){
                var plat_id = "<?= $list['u_id']?>"
                alert(plat_id);
                $.ajax({
                    method:"POST",
                    url: 'upcomingajax.php',
                    data: {pid:plat_id,action:"delete"},
                    success: function (data, status, xhr) {
                        var resp = data.split("||");
                        alert(resp[1]);
                        if(resp[0]=="0"){
                        window.location.replace("upcoming.php");
                        }

                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                        alert("Server Connection Lost. Please try again");
                    }
                });
            }
         });
    });
</script>

