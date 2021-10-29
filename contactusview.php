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

   
//Initialize variables for update category
    if(isset($_GET["id"])){
    $id=$_GET["id"];
    $header_index="Customer Queries";

    $customerquery_detail = getCustomerquery($id);

    $name = $customerquery_detail['con_name'];
    $emailadd = $customerquery_detail['con_email'];
    $msg = $customerquery_detail['con_message'];
    $date = $customerquery_detail['con_date'];
    
    $user_action = "edit";
    }

    $datetoday=date('Y-m-d');

   
?>
<style>
.msg-input {
    background-color: #faf7f7 !important;
}
</style>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><?=$header_index;?></h3>
    </div>
</div>

<div class="container emp-profile">
    <form action="contactuscontroller.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <label>Guest Name:</label>
                <input type="text" class="form-control msg-input" id="input_name" name="input_name" value="<?=$name;?>"
                    disabled>
            </div>
            <div class="col-lg-6">
                <label>Email Address:</label>
                <input type="text" class="form-control msg-input" id="input_email" name="input_email"
                    value="<?=$emailadd;?>" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>Date:</label>
                <input type="text" class="form-control msg-input" id="input_date" name="input_date" value="<?=$date;?>"
                    disabled>
            </div>
            <div class="col-lg-6"></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label>Message:</label>
                <textarea class="form-control msg-input" id="input_msg" name="input_msg" rows="5" cols="40"
                    disabled><?=$msg;?></textarea>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-lg-1">
                <div class="form-group"><input type="button" class="btn btn-success btn-reply" value="Reply"
                        id="btn_rep" name="btnReply" /></div>
            </div>
            <div class="col-lg-1">
                <div class="form-group"><input type="button" class="btn btn-danger btn-cancel" value="Cancel"
                        onclick="location.href='contactus.php'" /></div>
            </div>
        </div>

        <!--<div class="form-group"><input type="submit" class="btn btn-primary" value="Save" id="btnSubmit" name="btnSubmit" /></div>
        <input type="hidden" id="id" name="id" value="<?=$id;?>"/>
        <input type="hidden" id="user_action" name="user_action" value="<?=$user_action;?>"/>-->
    </form>
</div>
<div class="container emp-profile reply-container">
    <form action="contactuscontroller.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <label>To:</label>
                <input type="text" class="form-control" id="send_to" name="send_to" required>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label>From:</label>
                <input type="text" class="form-control msg-input" id="send_from" name="send_from"
                    value="gameland_contact@abc.com" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label>Message:</label>
                <textarea class="form-control" id="send_msg" name="send_msg" rows="5" cols="40"></textarea>
            </div>
        </div>

        <br>
        <div class="form-group"><input type="button" class="btn btn-success btn_mail" value="Mail" id="btnMail"
                name="btnMail" /></div>
        <!--<div class="form-group"><input type="submit" class="btn btn-primary" value="Save" id="btnSubmit" name="btnSubmit" /></div>
        <input type="hidden" id="id" name="id" value="<?=$id;?>"/>
        <input type="hidden" id="user_action" name="user_action" value="<?=$user_action;?>"/>-->
    </form>
</div>




<?php include('dashboard_footer.php'); ?>
<script>
$(document).ready(function() {
    $(".reply-container").hide();
    $('#btn_rep').click(function() {
        $(".reply-container").show();
    });

    $('#btnMail').click(function() {
        if (confirm("Your are sending mail")) {
            var to_send = $("#send_to").val();
            var from_send = $("#send_from").val();
            var msg_send = $("#send_msg").val();
            var date_send = "<?= $datetoday?>";

            alert(to_send);
            alert(from_send);
            alert(msg_send);
            alert(date_send);
            $.ajax({
                method: "POST",
                url: 'contactmail.php',
                data: {
                    receiver: to_send,
                    sender: from_send,
                    sdate: date_send,
                    smsg: msg_send,
                    action: "mail"
                },
                success: function(data, status, xhr) {

                    window.location.replace("contactus.php");


                },
                error: function(jqXhr, textStatus, errorMessage) {
                    alert("Server Connection Lost. Please try again");
                }
            });
        }
    });
});
</script>