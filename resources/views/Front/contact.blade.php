@extends("Front/app")

@section("title")
<title>Contact</title>
@stop

@section("content")
<div id="content">
    <div class="contact-wrapper">
        <div class="container contact-container">
            <div class="row contact-main">
                <h3 class="text-left">CONTACT US</h3>
                <div class="col-sm-6 col-md-6 col-lg-6 cont-wr">
                    <form action="">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name" name="name">
                        </div>
                        <textarea class="form-control" name="body" placeholder="Message" rows="10"></textarea>
                        <div class="form-group cont-sub-but">
                            <input type="submit" class="btn btn-default btn-block" value="SUBMIT">
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 cont-texts-right">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                    <p>Mailing Addressbr<br/>
                        Nicholas Desmond Simon Graham<br/>
                        P.O. Box 1230 Georgetown,<br/>
                        Cayman Islands B. W. I.</p>
                </div>
            </div>
            <div class="google-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1770.7752999120355!2d44.77582191744942!3d41.7188528693694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40440cd7e64f626b%3A0x61d084ede2576ea3!2z4YOX4YOR4YOY4YOa4YOY4YOh4YOY!5e0!3m2!1ska!2sge!4v1463478881990" width="100%" height="450" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
@stop