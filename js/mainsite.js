/*Dropdown*/

function loginFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
  
}

function main_nav_Function() {
  document.getElementById("mainDropdown").classList.toggle("show");
  
}


window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var drpdown = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < drpdown.length; i++) {
      var slidedrp = drpdown[i];
      if (slidedrp.classList.contains('show')) {
        slidedrp.classList.remove('show');
      }
    }
  }
}


/*dropdown end*/
/*Image Slider*/
var imgIndex = 0;
showimg_scroll();

function showimg_scroll() {
  var i;
  var img_scroll = document.getElementsByClassName("imgslides");
  var bullets = document.getElementsByClassName("ringbar");
  for (i = 0; i < img_scroll.length; i++) {
    img_scroll[i].style.display = "none";  
  }
  imgIndex++;
  if (imgIndex > img_scroll.length) {imgIndex = 1}    
  for (i = 0; i < bullets.length; i++) {
    bullets[i].className = bullets[i].className.replace(" active", "");
  }
  img_scroll[imgIndex-1].style.display = "block";  
  bullets[imgIndex-1].className += " active";
  setTimeout(showimg_scroll, 2000); 
}
/*End Image Slider*/



