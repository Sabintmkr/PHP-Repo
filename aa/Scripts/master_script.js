function setUserAction(val){
  document.getElementById("user_action").value= val;
}

function goBack(){
  history.back();
}

function updateCart(user_action,id){
  $.ajax({
      method:"POST",
      url: 'update_cart_ajax.php',
      data: {mid:id,action:user_action},
      success: function (data, status, xhr) {
        alert("Cart updated successfully");
      },
      error: function (jqXhr, textStatus, errorMessage) {
        alert("Server Connection Lost. Please try again");
      }
   });
}

function validateEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}