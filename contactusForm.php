<?php 
include 'libcommon.php';
include('layout_header.php');



$cname = "";
$cemail = "";
$cmessage = "";
$cdate = "";

?>
<div class="container">
    <div class="one withsmallpadding ppb_text"
        style="text-align:center;padding:0px 0 0px 0;margin-top:20px;margin-bottom:60px;">
        <div class="standard_wrapper">
            <div class="page_content_wrapper">
                <div class="inner">
                    <div style="margin:auto;width:80%">
                        <h4 class="p1"><span class="s1"><b>Stay connected with us </b></span></h4>
                        <br>
                        <div class="page_tg">
                            <p>
                                Our mailing address : gameland_contact@abc.com
                            </p>
                            <br />
                            <div class="container" style="margin-left:25%">
                                <form action="contactuscontroller.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Name:</label>
                                            <input type="text" class="form-control" id="input_name" name="input_name"
                                                value="<?=$cname;?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Email:</label>
                                            <input type="text" class="form-control" id="input_email" name="input_email"
                                                value="<?=$cemail;?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>Message:</label>
                                            <textarea class="form-control" id="input_msg" name="input_msg"
                                                value="<?=$cmessage;?>" required rows="5" cols="40"></textarea>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group"><input type="submit" class="btn btn-primary"
                                                    value="Submit" id="btnSubmit" name="btnSubmit" /></div>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include('layout_foot.php');
?>