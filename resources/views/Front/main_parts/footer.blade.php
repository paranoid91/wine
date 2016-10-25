<footer>
    <div class="container-fluid no-padding main-footer">
        <div class="container no-padding">
            <div class="row no-margin foot-upper-row">
                <div class="col-sm-6 col-md-3 col-lg-3 about-wine">
                    <h3>About Wine</h3>
                    <p>On this site you will find versions of some classics of early modern philosophy, and a few from the 19th century, prepared with a view to making
                        them easier to read while leaving intact the main arguments, doctrines, and lines of thought.
                    </p>
                    <p>On this site you will find versions of some classics of early modern philosophy, and a few from the 19th century, prepared with a view to making
                        them easier to read while leaving intact the main arguments, doctrines, and lines of thought.
                    </p>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 footer-soc">
                    <h3>FOLLOW US ON</h3>
                    <ul class="list-unstyled soc-icons-list">
                        <li><img src="{{ asset("frontend/img/icon-fb.png") }}"/>&nbsp;<a href="#">Find Us On Facebook</a></li>
                        <li><img src="{{ asset("frontend/img/icon-tw.png") }}"/>&nbsp;<a href="#">Follow us on Twitter</a></li>
                        <li><img src="{{ asset("frontend/img/icon-mail.png") }}"/>&nbsp;<a href="#">Subscribe our channel</a></li>
                        <li><img src="{{ asset("frontend/img/icon-rss.png") }}"/>&nbsp;<a href="#">RSS Feed</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 foot-prod-wr">
                    <h3>PRODUCTS</h3>
                    <div class="fprod_l">
                        <ul class="list-unstyled prod-icons-list">
                            <li><a href="#">Amphora Wines</a></li>
                            <li><a href="#">Reserved</a></li>
                            <li><a href="#">Samshvenisi</a></li>
                            <li><a href="#">Appellation</a></li>
                            <li><a href="#">Varietal</a></li>
                            <li><a href="#">Dessert</a></li>
                            <li><a href="#">Awards</a></li>
                        </ul>
                    </div>
                    <div class="fprod_r">
                        <ul class="list-unstyled prod-icons-list">
                            <li><a href="#">Amphora Wines</a></li>
                            <li><a href="#">Reserved</a></li>
                            <li><a href="#">Samshvenisi</a></li>
                            <li><a href="#">Appellation</a></li>
                            <li><a href="#">Varietal</a></li>
                            <li><a href="#">Dessert</a></li>
                            <li><a href="#">Awards</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 foot-cont-wr">
                    <h3>CONTACT US</h3>
                    <p>On this site you will find versions of some classics of early modern philosophy.</p>
                    <ul class="list-unstyled foot-icons-list">
                        <li><span class="glyphicon glyphicon-home foot-glyph"></span> Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator</li>
                        <li><span class="glyphicon glyphicon-phone-alt foot-glyph"></span> +351 223 345 234<br/>&nbsp;&nbsp;+351 223 345 236</li>
                        <li><span class="glyphicon glyphicon-envelope foot-glyph"></span> info@wineshop.ge<br/>&nbsp;&nbsp;support@wineshop.ge</li>
                        <li><span class="glyphicon glyphicon-map-marker foot-glyph"></span> Find us on the map</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid no-margin foot-bottom">
        <div class="container no-padding">
            <div class="row no-margin">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-left bottom-icn">
                    <a href="http://it-solutions.ge" target="_blank"><img src="{{ asset("frontend/img/it-sol-icon.png") }}"/></a>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 foot-bor-center text-center">
                    <span>&copy; Copyright 2014 - <a href="{{ action('Frontend\PagesController@index') }}">WineShop.ge</a></span>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 foot-bot-r text-right">
                    <span>Accepting: </span><img src="{{ asset("frontend/img/cards-icons.png") }}"/>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<script src="{{ asset("frontend/js/jquery-1.9.1.min.js") }}"></script>
<script src="{{ asset("frontend/js/bootstrap.min.js") }}"></script>
@yield("script")
<script src="{{ asset("frontend/js/lib.js") }}"></script>
</body>
</html>