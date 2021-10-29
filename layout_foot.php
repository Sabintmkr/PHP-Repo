<!--Start Footer-->
<footer>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-top-box">
                        <h3>Opening</h3>
                        <ul class="list-time">
                            <li>Monday - Friday: 10.00am to 5.00pm</li>
                            <li>Saturday: 10.00am to 12.00pm</li>
                            <li>Sunday: <span>Closed</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-top-box">
                        <h3>Newsletter</h3>
                        <form class="newsletter">
                            <div class="form-group">
                                <input class="" type="email" name="Email" placeholder="Email Here" />
                                <i class="fa fa-envelope"></i>
                            </div>
                            <button class="btn btn_trans-hover" type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-top-box">
                        <h3>Social Media</h3>
                        <p>Do connect with us and give us your love and support on our social media... </p>
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-snapchat" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-des">
                        <h4>About GameLand</h4>
                        <p>
                            GameLand is a gaming store all over Australia established in 2018 with the aim to provide
                            best gaming accessories and game to the local gamers
                            easily. We have all range of game in over all the platform via PlayStation or Xbox or
                            Nitendo
                        </p>
                        <p>
                            Based in Australia we tend to provide and import almost all the accessories required for
                            gaming and build a gaming PC delivering to the customers
                            where the hassel of them searching and assembling or buying waiting for long time is no
                            longer necessary. We deliver quality products where the main aim of
                            store is customer satisfaction and happy gamers all around.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-link">
                        <h4>Information</h4>
                        <ul>
                            <li><a href="aboutus.php"><i class="fas fa-caret-right" style="color:#ffffff"></i>About
                                    Us</a></li>
                            <li><a href="sale.php"><i class="fas fa-caret-right"></i>Sale</a></li>
                            <li><a href="newrelease.php"><i class="fas fa-caret-right"></i>New Release</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i>Discount Policy</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i>Membership Policy</a></li>
                            <li><a href="#"><i class="fas fa-caret-right"></i>Delivery Information</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-address">
                        <h4>Contact Us</h4>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>Address: 123 Stenner Street <br>Grand
                                    Central,<br> Toowoomba </p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+61-000 000
                                        000</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a
                                        href="mailto:contactinfo@gmail.com">gameland_contact@abc.com</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer  -->

<!-- Start copyright  -->
<div class="footer-copyright">
    <p class="subfooter">All Rights Reserved. &copy; 2020 <a href="#">GAMELAND</a></p>
</div>
<!-- End copyright  -->
</body>

</html>

<!-- ALL JS FILES -->
<script src="js/jquery-3.2.1.min.js"></script>
<script>
function loginFunction() {
    document.getElementById("myDropdown").classList.toggle("show");

}

function main_nav_Function() {
    document.getElementById("mainDropdown").classList.toggle("show");

}

function goCart(user_action, id) {
   // alert(id);
    $.ajax({
        method: "POST",
        url: 'gocartajax.php',
        data: {
            pid: id,
            action: user_action
        },
        success: function(data, status, xhr) {
            alert("Cart updated successfully");
        },
        error: function(jqXhr, textStatus, errorMessage) {
            alert("Server Connection Lost. Please try again");
        }
    });
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
</script>