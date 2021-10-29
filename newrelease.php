<?php 
include 'libcommon.php';
include('layout_header.php');

$date=date('Y-m-d');
//echo($date);
$query = "select * from upcomingitem ";
?>
<div class="box-add-products">
    <div class="container">
        <h1 class="game-heading">Upcoming ITEMS!!!!</h1>
        <div class="row">
            <?php
                $p_list = sqlSelectStatement($query);
                if(!empty($p_list)){
                    foreach($p_list as $list){ 
                        if($list['u_date']>=$date){
            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="newreleaseview.php?id=<?= $list['u_id'];?>"><img
                            src="<?=htmlspecialchars_decode($list['u_image']);?>"
                            alt="<?=htmlspecialchars_decode($list['u_name']);?>" style="width: 100%;" /></a>
                    <div class="card-body" style="text-align: center;">
                        <h4 class="card-title">
                            <a href="newreleaseview.php?id=<?= $list['u_id'];?>"><?= $list['u_name'];?></a>
                        </h4>
                        <p style="tword-wrap:break-word;"> <?php
                                       
                                       //Readmore code
                                      $string = strip_tags($list['u_msg']);
                                      if (strlen($list['u_msg']) > 100) {
                                      
                                          // truncate string
                                          $stringCut = substr($list['u_msg'], 0, 100);
                                          $endPoint = strrpos($stringCut, ' ');
                                      
                                          //if the string doesn't contain any space then it will cut without word basis.
                                          $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                          $string .= '... <a href="newreleaseview.php?id='.$list['u_id'].'">Read More</a>';
                                      }
                                     echo $string;
                                  ?>
                        </p>
                    </div>
                    <div class="card-footer" style="color: #1b3e20; font-weight:700; text-align:center;">
                        <h5>Releasing on :<?= $list['u_date'];?></h5>
                    </div>
                </div>
            </div>
            <?php 
                    }
                }
            }
            ?>
        </div>
    </div>
</div>


<?php 
include('layout_foot.php');
?>