@extends("Front/app")

@section("title")
<title>Bag</title>
@stop

@section("content")
<div id="content" class="bag-wrapper">
    <div class="container bag-main-wr">
        <div class="row no-margin">
            <div class="col-md-3 col-lg-3">
                <div class="nav-list-menu">
                    <ul class="list-unstyled">
                        <li class="active-link">
                            &nbsp;&nbsp;
                            MY ACCOUNT
                        </li>
                        <li>
                            &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                            <a href="#">Shopping Cart</a>
                        </li>
                        <li>
                            &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                            <a href="#">Wish List</a>
                        </li>
                        <li>
                            &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                            <a href="#">Modify your address</a>
                        </li>
                        <li>
                            &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                            <a href="#">Modify your wish list</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-lg-9">
                <div class="acc-inf">
                    <h4>EDIT YOUR ACCOUNT INFORMATION</h4>
                    <div class="inf-table-wr">
                        <form action="">
                            {!! csrf_field() !!}
                            <div class="table-responsive">
                                <table class="table acc-list-table">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Shipping</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="list-img-wr">
                                                <div class="img-res-block" style="background-image: url('http://images.all-free-download.com/images/graphicthumb/wine_bottle_and_glass_6813488.jpg')"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <span>Donec tellus purus Donec</span>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="text" name=""/>
                                                <div class="inp-icn">
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/img/refresh.png') }}" width="18" />
                                                    </a>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/img/remove-icon.png') }}" width="20" />
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$122.00</td>
                                        <td>$122.00</td>
                                        <td>$122.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="list-img-wr">
                                                <div class="img-res-block" style="background-image: url('http://images.all-free-download.com/images/graphicthumb/wine_bottle_and_glass_6813488.jpg')"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <span>Donec tellus purus Donec</span>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="text" name=""/>
                                                <div class="inp-icn">
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/img/refresh.png') }}" width="18" />
                                                    </a>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/img/remove-icon.png') }}" width="20" />
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$122.00</td>
                                        <td>$122.00</td>
                                        <td>$122.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="list-img-wr">
                                                <div class="img-res-block" style="background-image: url('http://images.all-free-download.com/images/graphicthumb/wine_bottle_and_glass_6813488.jpg')"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <span>Donec tellus purus Donec</span>
                                        </td>
                                        <td>
                                            <div>
                                                <input type="text" name=""/>
                                                <div class="inp-icn">
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/img/refresh.png') }}" width="18" />
                                                    </a>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/img/remove-icon.png') }}" width="20" />
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>$122.00</td>
                                        <td>$122.00</td>
                                        <td>$122.00</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="total-costs">
                                <table>
                                    <tr>
                                        <td>Sub-Total:&nbsp;</td>
                                        <td>$1,234.00</td>
                                    </tr>
                                    <tr>
                                        <td>Eco Tax(-2.00):&nbsp;</td>
                                        <td>$10.00</td>
                                    </tr>
                                    <tr>
                                        <td>VAT(20%):&nbsp;</td>
                                        <td>$278.00</td>
                                    </tr>
                                    <tr>
                                        <td>Total:&nbsp;</td>
                                        <td>$1698.00</td>
                                    </tr>
                                </table>
                                <hr>
                                <div class="form-group chech-btn-wr">
                                    <input type="submit" class="btn checkout-submit" value="Checkout">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop