{!! Form::hidden('cat[0]',3) !!}
<section>
    <div class="tabs tabs-style-topline">
        <nav>
            <ul>
                <li class="tab-li date"><a href="#section-topline-1" class="icon pe-7s-date"><span>თარიღი</span></a></li>
                <li><a href="#section-topline-2" class="icon pe-7s-id"><span>იდენტიფიცირება</span></a></li>
                <li><a href="#section-topline-3" class="icon pe-7s-edit"><span>დეტალების ჩამონათვალი</span></a></li>
                <li><a href="#section-topline-4" class="icon pe-7s-tools"><span>შესასრულებელი სამუშაო</span></a></li>
                <li><a href="#section-topline-5" class="icon pe-7s-cloud-upload"><span>ფოტო</span></a></li>
            </ul>
        </nav>
        <div class="content-wrap">
            <section id="section-topline-1">
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('recieve_date','ავტომობილის მიღების თარიღი') !!}
                        {!! Form::text('receipted_at',null,['class'=>'datetimepicker form-control']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('executed_at','აქტის შედგენის თარიღი') !!}
                        {!! Form::text('executed_at',null,['class'=>'datetimepicker form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::button('შემდეგი',['class'=>'btn btn-success right next-tab','disabled','data-next'=>2]) !!}
                    </div>
                </div>
            </section>
            <section id="section-topline-2">
                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('cat[1]','მზღვეველი') !!}
                        {!! Form::select('cat[1]',['აირჩიეთ მზღვეველი']+idAsKey($insurer),is_key($category,1)['id'],['class'=>'insurer chosen-select','style'=>'width:100%']) !!}
                        <script>
                            $(function(){
                                $('.insurer').chosen({
                                    disable_search: true,
                                    scroll_on_hover: false
                                });
                            });
                        </script>
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('registration_number','ავტომობილის რეგისტრაციის ნომერი') !!}
                        {!! Form::text('registration_number',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('vincode','ვინკოდი') !!}
                        {!! Form::text('vincode',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('cat[2]','ავტომობილის მარკა') !!}
                        {!! Form::select('cat[2]',['აირჩიეთ მარკა']+idAsKey($categories),is_key($category,2)['id'],['class'=>'mark chosen-select','style'=>'width:100%']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('cat[3]','ავტომობილის მოდელი') !!}
                        {!! Form::select('cat[3]',[],is_key($category,3)['id'],['class'=>'model chosen-select','style'=>'width:100%','data-placeholder'=>'აირჩიეთ მოდელი']) !!}
                        <script>
                            $(function(){
                                $('.model').chosen({
                                    allow_single_deselect: true,
                                    scroll_on_hover: false
                                });
                            });
                        </script>
                        <script>
                            $(function(){
                                $('.mark').chosen({
                                    allow_single_deselect: true,
                                    scroll_on_hover: false
                                }).change(function(){
                                    if($(this).val() > 0){
                                        chose_model($(this));
                                    }
                                });
                                if($('.mark').val() > 0){
                                    chose_model($('.mark'),'{{is_key($category,3)['id']}}');
                                }
                            });
                        </script>
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('year','გამოშვების წელი') !!}
                        {!! Form::text('year',null,['class'=>'yearpicker form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="row no-padding">
                            <div class="col-sm-8 no-padding">
                                {!! Form::label('mileage','გარბენი') !!}
                                {!! Form::text('mileage',null,['class'=>'form-control']) !!}
                            </div>
                            <div class="col-sm-4" style="padding-right:0">
                                {!! Form::label('length','&nbsp;') !!}
                                {!! Form::select('length',[0=>'კმ',1=>'მილი'],null,['class'=>'mileage chosen-select','style'=>'width:100%']) !!}
                                <script>
                                    $(function(){
                                        $('.mileage').chosen({
                                            disable_search: true,
                                            scroll_on_hover: false
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('engine_volume','ძრავის მოცულობა') !!}
                        {!! Form::text('engine_volume',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('law','მფლობელის სტატუსი') !!}
                        {!! Form::select('law',['აირჩიეთ მფლობელის სტატუსი',1=>'ფიზიკური პირი',2=>'იურიდიული პირი'],null,['class'=>'law chosen-select','style'=>'width:100%']) !!}
                        <script>
                            $(function(){
                                $('.law').chosen({
                                    disable_search: true,
                                    scroll_on_hover: false
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::label('owner','ავტომობილის მფლობელი') !!}
                        {!! Form::text('owner',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('phone','საკონტაქტო ტელეფონი') !!}
                        {!! Form::text('phone',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::label('personal_id','მფლობელის პერსონალური აი-დი') !!}
                        {!! Form::text('personal_id',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::button('შემდეგი',['class'=>'btn btn-success right','disabled']) !!}
                    </div>
                </div>
            </section>
            <section id="section-topline-3">
                <div class="details">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>დეტალების ჩამონათვალი</label>
                            {!! Form::select('extra[details][0][name]',[''=>'---'] + nameAsKey(get_options('details'),'value'),null,['class'=>'dt_0 chosen-select','data-type'=>'details','data-action'=>action('OptionsController@ajax'),'data-token'=>csrf_token()]) !!}
                            <script>
                                $(function(){
                                    addCustomTextToChosen('dt_0','დეტალი არ არის სიაში,დააჭირეთ Enter-ს ამ დეტალის დასამატებლად:');
                                });
                            </script>
                        </div>
                        <div class="col-sm-1">
                            <label>რაოდენობა</label>
                            {!! Form::text('extra[details][0][num]',null,['class'=>'form-control d_num','onkeyup'=>'countSum(this)']) !!}
                        </div>
                        <div class="col-sm-2">
                            <label>მდგომარეობა</label>
                            <div class="select">
                                {!! Form::select('extra[details][0][condition]',['---','პირველადი','მეორადი'],null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <label>ფასი</label>
                            {!! Form::text('extra[details][0][price]',null,['class'=>'form-control d_price','onkeyup'=>'countSum(this)']) !!}
                        </div>
                        <div class="col-sm-1">
                            <label>ჯამი</label>
                            {!! Form::text('extra[details][0][sum]',null,['class'=>'form-control d_sum','readonly'=>true]) !!}
                        </div>
                        <div class="col-sm-1">
                            <label>ნარჩ. ღირ.</label>
                            {!! Form::text('extra[details][0][res_value]',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    @if(count($details > 1))
                        @foreach($details as $k=>$d)
                            @if($k > 0)
                                <div class="row">
                                    <div class="col-sm-6">
                                        {!! Form::select('extra[details]['.$k.'][name]',[''=>'---'] + nameAsKey(get_options('details'),'value'),null,['class'=>'dt_'.$k.' chosen-select','data-type'=>'details','data-action'=>action('OptionsController@ajax'),'data-token'=>csrf_token()]) !!}
                                        <script>
                                            $(function(){
                                                addCustomTextToChosen('dt_{{$k}}','დეტალი არ არის სიაში,დააჭირეთ Enter-ს ამ დეტალის დასამატებლად:');
                                            });
                                        </script>
                                    </div>
                                    <div class="col-sm-1">
                                        {!! Form::text('extra[details]['.$k.'][num]',null,['class'=>'form-control d_num','onkeyup'=>'countSum(this)']) !!}
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="select">
                                            {!! Form::select('extra[details]['.$k.'][condition]',['---','პირველადი','მეორადი'],null,['class'=>'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        {!! Form::text('extra[details]['.$k.'][price]',null,['class'=>'form-control d_price','onkeyup'=>'countSum(this)']) !!}
                                    </div>
                                    <div class="col-sm-1">
                                        {!! Form::text('extra[details]['.$k.'][sum]',null,['class'=>'form-control d_sum','readonly'=>true]) !!}
                                    </div>
                                    <div class="col-sm-1">
                                        {!! Form::text('extra[details]['.$k.'][res_value]',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        {!! Form::button('<i class="fa fa-plus"></i> მეტი',['class'=>'btn btn-primary','id'=>'detail']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::button('<i class="fa fa-minus"></i> ბოლოს წაშლა',['class'=>'btn btn-danger','id'=>'del_detail']) !!}
                    </div>
                    <div class="col-sm-2">
                        {!! Form::button('ტოტალი',['class'=>'btn btn-info right','data-toggle'=>'modal','data-target'=>'#TotalModal']) !!}
                    </div>
                    <div class="col-sm-2">
                        {!! Form::button('შემდეგი',['class'=>'btn btn-success right','disabled']) !!}
                    </div>
                </div>
            </section>
            <section id="section-topline-4">
                <div class="work">
                    <div class="row">
                        <div class="col-sm-8">
                            <label>შესასრულებელი სამუშაოები</label>
                            {!! Form::select('extra[work][0][title]',[''=>'---'] + nameAsKey(get_options('works'),'value'),null,['class'=>'wk_0 chosen-select','data-type'=>'works','data-action'=>action('OptionsController@ajax'),'data-token'=>csrf_token()]) !!}
                            <script>
                                $(function(){
                                    addCustomTextToChosen('wk_0','დეტალი არ არის სიაში,დააჭირეთ Enter-ს ამ დეტალის დასამატებლად:');
                                });
                            </script>
                        </div>
                        <div class="col-sm-2">
                            <label>ფასი</label>
                            {!! Form::text('extra[work][0][price]',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-sm-2">
                            <label>სავარაუდო ხარჯები</label>
                            {!! Form::text('extra[work][0][expense]',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    @if(count($work > 0))
                        @foreach($work as $k=>$w)
                            @if($k > 0)
                                <div class="row">
                                    <div class="col-sm-8">
                                        <label>შესასრულებელი სამუშაოები</label>
                                        {!! Form::select('extra[work]['.$k.'][title]',[''=>'---'] + nameAsKey(get_options('works'),'value'),null,['class'=>'wk_'.$k.' chosen-select','data-type'=>'works','data-action'=>action('OptionsController@ajax'),'data-token'=>csrf_token()]) !!}
                                        <script>
                                            $(function(){
                                                addCustomTextToChosen('wk_{{$k}}','დეტალი არ არის სიაში,დააჭირეთ Enter-ს ამ დეტალის დასამატებლად:');
                                            });
                                        </script>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>ფასი</label>
                                        {!! Form::text('extra[work]['.$k.'][price]',null,['class'=>'form-control']) !!}
                                    </div>
                                    <div class="col-sm-2">
                                        <label>სავარაუდო ხარჯები</label>
                                        {!! Form::text('extra[work]['.$k.'][expense]',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        {!! Form::button('<i class="fa fa-plus"></i> მეტი',['class'=>'btn btn-primary','id'=>'work']) !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::button('<i class="fa fa-minus"></i> ბოლოს წაშლა',['class'=>'btn btn-danger','id'=>'del_work']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::button('შემდეგი',['class'=>'btn btn-success right','disabled']) !!}
                    </div>
                </div>
            </section>
            <section id="section-topline-5">
                <div class="images_place">
                    @if(count($images) > 0)
                        @foreach($images as $k=>$img)
                            <div>
                                {!! Form::hidden('extra[image]['.$k.'][dir]',null) !!}
                                {!! Form::hidden('extra[image]['.$k.'][name]',null) !!}
                                {!! Form::hidden('extra[image]['.$k.'][ext]',null) !!}
                                <span onClick="removeImage(this)"><i class="pe-7s-close"></i></span>
                                <img src="{{image_url($img,'_600')}}" width="100%"/>
                            </div>
                        @endforeach
                    @endif
                    <!-- HERE WILL APPEAR IMAGES -->
                </div>
                {!! Form::file('images[]',['class'=>'img_upload_input','style'=>'display:none','multiple'=>true]) !!}
                <p><a class="upload_images"><i class="pe-7s-cloud-upload"></i>  <small>დააჭირეთ აქ</small></a></p>
                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::submit(trans('admin.close'),['class'=>'btn btn-success close_inspection']) !!}
                    </div>
                </div>
            </section>
        </div><!-- /content -->
        <hr>
        <div class="message_place"></div>

    </div><!-- /tabs -->
</section>
<script>
    $(function(){
        var html = '<div class="row"><div class="col-sm-6">{!! Form::select('extra[details][][name]',[''=>'---'] + nameAsKey(get_options('details'),'value'),null,['class'=>'dt_ chosen-select','data-type'=>'details','data-action'=>action('OptionsController@ajax'),'data-token'=>csrf_token()]) !!}</div>'+
                '<div class="col-sm-1"><input type="text" name="extra[details][][num]" class="form-control d_num" onkeyup="countSum(this)"/></div>'+
                '<div class="col-sm-2"><div class="select"><select name="extra[details][][condition]" class="form-control"><option value="0">---</option><option value="1">პირველადი</option><option value="2">მეორადი</option></select></div></div>'+
                '<div class="col-sm-1"><input type="text" name="extra[details][][price]" class="form-control d_price" onkeyup="countSum(this)"/></div>'+
                '<div class="col-sm-1"><input type="text" name="extra[details][][sum]" class="form-control d_sum" readonly="1" /> </div>'+
                '<div class="col-sm-1"><input type="text" name="extra[details][][res_value]" class="form-control"/></div></div>';
        $('#detail').Fields(html,{appendClass:'details',del:'del_detail',chosen_prefix:'dt_'});

        var html = '<div class="row"><div class="col-sm-8">{!! Form::select('extra[work][][title]',[''=>'---'] + nameAsKey(get_options('works'),'value'),null,['class'=>'wk_ chosen-select','data-type'=>'works','data-action'=>action('OptionsController@ajax'),'data-token'=>csrf_token()]) !!}</div>'+
                '<div class="col-sm-2"><input type="text" name="extra[work][][price]" class="form-control"/></div>'+
                '<div class="col-sm-2"><input type="text" name="extra[work][][expense]" class="form-control"/></div></div>';
        $('#work').Fields(html,{appendClass:'work',del:'del_work',chosen_prefix:'wk_'});

        // SHOW IMAGES SCRIPT
        $('.upload_images').click(function(){
            $('.img_upload_input').click();
            $('.img_upload_input').change(function(){
                $.map($(this)[0].files,function(index,value){
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.images_place').append('<div><span onClick="removeImage(this)"><i class="pe-7s-close"></i></span><img src="'+e.target.result+'" width="100%" /></div>');
                    };
                    reader.readAsDataURL(index);
                });
//                if($('.images_place > div').length > 5){
//                    $('.close_inspection').attr('disabled',false);
//                }else{
//                    $('.close_inspection').attr('disabled',true);
//                }

            });
        });


        //inspection tabs on fill
        document.interval = setInterval(formValues,200);



    });

    function formValues(){
            console.log($('#inspect_form').find('input[name="receipted_at"]').val());
            if($('#inspect_form').find('input[name="receipted_at"]').val() != ""){
                $('#inspect_form .tab-current').next('li').addClass('tab-li');
                [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });
                clearInterval(document.interval);
                $('#inspect_form').find('input[name="receipted_at"]').on('keyup',function(){
                    if($(this).val() == ""){
                        return document.interval;
                    }
                });
            }else{
                $('#inspect_form .tab-current').next('li').removeClass('tab-li');
            }
    }

    function chose_model(elem,sel){
        var option = '';
        var li = '';
        option += '<option value="">აირჩიეთ მოდელი</option>';
        $.ajax({
            url:'{{action('Admin\InspectionController@ajax')}}',
            dataType:'JSON',
            type:'POST',
            data:{_method:'POST',_token:'{{csrf_token()}}',action:'model',id:elem.val()},
            success:function(response){
                if(response.length > 0){
                    $.each(response,function(index,value){
                        var selected = (sel == value.id) ? 'selected' : '';
                        option += '<option value="'+value.id+'" '+selected+'>'+value.name+'</option>';
                    });
                }
                $('.model').html(option);
            },
            complete:function(){
                $('.model').trigger("chosen:updated").chosen();
                //$('#model_chosen .chosen-single span').html("აირჩიეთ მოდელი");
            }
        });
    }


</script>
@include('admin.modals.total')
@include('admin.modals.fade.upload')