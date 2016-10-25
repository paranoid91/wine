function checkLogin(form){
    if(form.find('input[name="email"]').val() != ""){
        form.find('input[name="email"]').css('border','1px solid rgba(0, 0, 0, 0.15)');
    }else{
        form.find('input[name="email"]').css('border', '1px solid red');
    }
    if(form.find('input[name="password"]').val() != ""){
        form.find('input[name="password"]').css('border','1px solid rgba(0, 0, 0, 0.15)');
    }else{
        form.find('input[name="password"]').css('border','1px solid red');
    }
    if(form.find('input[name="email"]').val() != "" && form.find('input[name="password"]').val() != ""){
        $.ajax({
            url:form.attr('action'),
            type:'POST',
            data:form.serialize(),
            success:function(response){
                if(response != "success"){
                    var errors = JSON.parse(response);
                    var i = 0;
                    var message = 'error';
                    $.each(errors,function(index,value){
                        if(i == 0){
                            if(index == 'password_expired'){
                                message = 'info';
                            }else if(index == "email_password"){
                                form.find('input[name="email"]').css('border','1px solid red');
                                form.find('input[name="password"]').css('border','1px solid red');
                            }else{
                                form.find('input[name="'+index+'"]').css('border','1px solid red');
                            }
                            $('.login-message').html('<span class="'+message+'">'+value+'</span>');
                        }

                        i++;
                   });
                }else{
                    $('.login-message').html("");
                    window.location.href = window.location.pathname;
                }

            }
        })
    }
}

/*
  Registration
 */

function checkRegister(form){
    if(form.find('input[name="email"]').val() != ""){
        form.find('input[name="email"]').css('border','1px solid rgba(0, 0, 0, 0.15)');
    }else{
        form.find('input[name="email"]').css('border', '1px solid red');
    }
    if(form.find('input[name="password"]').val() != ""){
        form.find('input[name="password"]').css('border','1px solid rgba(0, 0, 0, 0.15)');
    }else{
        form.find('input[name="password"]').css('border','1px solid red');
    }

    if(form.find('input[name="password_confirmation"]').val() != ""){
        form.find('input[name="password_confirmation"]').css('border','1px solid rgba(0, 0, 0, 0.15)');
    }else{
        form.find('input[name="password_confirmation"]').css('border','1px solid red');
    }

    if(form.find('input[name="email"]').val() != "" && form.find('input[name="password"]').val() != "" && form.find('input[name="password_confirmation"]').val() != ""){
        $.ajax({
            url:form.attr('action'),
            type:'POST',
            data:form.serialize(),
            success:function(response){

                if(response != "success"){
                    var errors = JSON.parse(response);
                    var i = 0;
                    $.each(errors,function(index,value){
                        if(i == 0){
                            form.find('input[name="'+index+'"]').css('border','1px solid red');
                            $('.register-message').html('<span class="error">'+value+'</span>');
                        }

                        i++;
                    });
                }else{
                    $('.register-message').html('<span class="success">'+$('.register-message').data('success')+'</span>');
                    $('#error_popup span').html(form.data('popup'));
                    $('#error_popup').popup({
                        transition: 'all 0.3s',
                        autoopen: true
                    });
                    //window.location.href = window.location.pathname;
                }

            }
        })
    }
}


var favorite = function(button,product_id){
     if(product_id > 0){
         var option = $(button).attr('data-option');
         $.ajax({
             url:$(button).data('action'),
             type:'POST',
             data:{_method:'POST',_token:$(button).data('token'),product_id:product_id,option:option},
             success:function(data){
                 if(option == 'del'){
                     $(button).attr('data-option','add');
                     $(button).removeClass('fav')
                 }else{
                     $(button).attr('data-option','del');
                     $(button).addClass('fav');
                 }
                 $(button).find('span').html(data);
             }
         })
     }
};

var activateKey = function(button){
    if($(button).data('id') > 0 && $(button).data('action') && $("#key").val() != ""){
        $.ajax({
            url:$(button).data('action'),
            type:'GET',
            data:{_method:'GET',key:$("#key").val(),event_id:$(button).data('id')},
            success:function(data){
                if(data == 1){
                    window.location.href = window.location.pathname;
                }else{
                    $("#key").css('border','1px solid red');
                }
            }
        });
    }
};

$('.selectProduct').click(function(e){
    e.preventDefault();
    if($(this).find('.check-product').val() > 0){
        $(this).find('img').css('border','none');
        $(this).find('.check-product').val('');
    }else{
        $(this).find('.check-product').val($(this).find('.check-product').attr('data-id'));
        $(this).find('img').css('border','2px solid green');
    }
});



var participateProducts = function(form){
    var form = $(form);
    $.ajax({
        url:form.attr('action'),
        type:'POST',
        data:form.serialize(),
        success:function(data){
            if(data == 1){
                $("#ProductsModal").modal('hide');
                $('#error_popup span').html(form.attr('data-success'));
                $('#error_popup').popup({
                    transition: 'all 0.3s',
                    autoopen: true
                });
            }
        }
    })
};

function ajaxData(form,create) {
    var formData = new FormData();
    var other_data = $(form).serializeArray();
    if(create == true){
        $(form).find('input[type="submit"]').attr('disabled',true);
    }
    $.each(other_data,function(key,input){
        formData.append(input.name,input.value);
    });
    var files = $('input[type="file"]',$(form));
    for (var i = 0; i < files.length; i++) {
        if(typeof files[i].files[0] != 'undefined') {
            formData.append(files[i].getAttribute("name"), files[i].files[0]);
        }
    }
    $.ajax({
        xhr: function()
        {
            var xhr = new window.XMLHttpRequest();
            $("#upload_popup").popup({blur:false});
            $("#upload_popup").popup('show');

            //Upload progress
            xhr.upload.addEventListener("progress", function(evt){
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total * 100;
                    //Do something with upload progress
                    $("#upload_popup .percents").html(percentComplete.toFixed(0) + '%');
                    $("#upload_popup .progress-line div").css('width',percentComplete.toFixed(0) + '%');

                    if(percentComplete.toFixed(0) == 100){
                        $('.converting').html('<span style="margin-top:10px;text-align:center">'+$('.converting').attr('data-text')+'<b></b></span><button onClick="$(\'#upload_popup\').popup(\'hide\');window.location.href=$(\'.converting\').attr(\'data-action\')">OK</button>');
                    }

                }
            }, false);
            return xhr;
        },
        url: $(form).attr('action'),
        type: 'POST',
        headers: { 'X-XSRF-TOKEN' : $('input[name="_token"]',form).val() },
        data: formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,   // tell jQuery not to set contentType
        success:function(data){
            if(data.url != ""){
               window.location.href = data.url;
            }
        },
        error:function(data){
            var error = $.parseJSON(data.responseText);
            var html = '<ul class="alert alert-danger">';
            $.each(error,function(index,value){
                html += '<li>'+value+'</li>';
            });
            html += '</ul>';
            $(".message_place").html(html);
            $("#upload_popup").popup('hide');
            $(form).find('input[type="submit"]').attr('disabled',false);
        }
    });
}


/* Child Categories */
function getChildCat(cat,child,cl,selected){
    if(selected != ""){ selected = JSON.parse(selected) };
    var sel = '';
    $.ajax({
        url: $(cat).data('url'),
        type: 'GET',
        data: {
            _method: 'GET',
            type: 'cat',
            value: $(cat + " option:selected").val()
        },
        success: function (data) {
            $(cl).attr('multiple',true);
            $(child).html("");
            $.each(data,function(index,value){
                if(selected.length > 0){
                    if($.inArray( parseInt(index), selected ) > -1){
                        //console.log(selected);
                        sel = 'selected="selected"';
                    }else{
                        sel = '';
                    }
                }
                $(child).append('<option value="'+index+'" '+sel+'>'+value+'</option>');
            });
            $(cl).trigger("chosen:updated").chosen({keep_opened:true});
        }
    });
}
$('.top-navigation .navbar-right .dropdown .dropdown-menu .nav-tabs').click(function(e) {
    e.stopPropagation();
});

var toggleItem = function(cl){
   $(cl).slideToggle(200);
};

var addRating = function(rating){
    $(".star_rating").attr("data-rating",rating);
    var url = $(".star_rating").attr('data-action');
    var token = $(".star_rating").attr('data-token');
    var id = $(".star_rating").attr('data-id');
    if(rating > 0 && id > 0){
        $.ajax({
            url: url,
            type:'POST',
            data:{_method:'POST',_token:token,id:id,rating:rating},
            success:function(data){
                console.log(data);
            }
        });
    }
};

function getImage(img){
    var place = $(img).attr('data-id');
    var file    = img.files[0];
    var reader  = new FileReader();
    reader.addEventListener("load", function () {
        console.log(this.width);
        $('#'+place).html('<img src="'+reader.result+'" width="230"/>');
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
};

function fileClick(cl){
    $(cl).click();
};


var image_num = 1;
//chose Image File
function getImageView(e){
    image_num++;
    if(countSize($('.files.images input[type="file"]')) > 20){
        var message = $('.files.images').data('size');
        $("#error_popup span").html(message);
        $("#error_popup").popup('show');
        $(e).val('');
    }else{
        var button = $(e).parent('li').parent('ul').parent('div').find('div');
        var preview = $(e).parent('li').find('span');
        var file    = e.files[0];
        var reader  = new FileReader();
        reader.addEventListener("load", function () {
            preview.html('<i class="glyphicon glyphicon-remove" onClick="removeItem($(this))"></i><img src="'+reader.result+'" width="140"/>');
            $(e).parent('li').parent('ul').append('<li><span></span><input class="img_'+image_num+'" accept="image/*" onchange="getImageView(this)" name="still['+image_num+']" type="file"></li>');
            button.attr('onClick',"ListClick('.files.images')");
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }

};


function ListClick(c){
    $(c+' ul li:last-child input').click();
};

var screening_num = 1;
//chose Screening
function getScreeningView(e){
    screening_num = screening_num + 1;
    if($(e).parent('li').parent('ul').find('li').length > 3){
        var message = $('.files.screenings').data('num');
        $("#error_popup span").html(message);
        $("#error_popup").popup('show');
        $(e).val('');
    }else if(countSize($('.files.screenings input[type="file"]')) > 300){
        var message = $('.files.screenings').data('size');
        $("#error_popup span").html(message);
        $("#error_popup").popup('show');
        $(e).val('');
    }else{
        var button = $(e).parent('li').parent('ul').parent('div').find('div');
        var preview = $(e).parent('li').find('span');
        preview.html('<i class="glyphicon glyphicon-remove" onClick="removeItem($(this))"></i><div><i class="glyphicon glyphicon-film"></i><small>'+e.files[0].name+'</small></div>');
        $(e).parent('li').parent('ul').append('<li><span></span><input class="screening_'+screening_num+'" accept="video/*" onchange="getScreeningView(this)" name="screening['+screening_num+']" type="file"></li>');
        button.attr('onClick',"ListClick('.files.screenings')");
    }
};


var trailer_num = 1;
// chose trailers
function getTrailerView(e){
    trailer_num = trailer_num + 1;

    if($(e).parent('li').parent('ul').find('li').length > 3){
        var message = $('.files.trailers').data('num');
        $("#error_popup span").html(message);
        $("#error_popup").popup('show');
        $(e).val('');
    }else if(countSize($('.files.trailers input[type="file"]')) > 300){
        var message = $('.files.trailers').data('size');
        $("#error_popup span").html(message);
        $("#error_popup").popup('show');
        $(e).val('');
    }else{
        var button = $(e).parent('li').parent('ul').parent('div').find('div');
        var preview = $(e).parent('li').find('span');
        preview.html('<i class="glyphicon glyphicon-remove" onClick="removeItem($(this))"></i><div><i class="glyphicon glyphicon-film"></i><small>'+e.files[0].name+'</small></div>');
        $(e).parent('li').parent('ul').append('<li><span></span><input class="trailer_'+trailer_num+'" accept="video/*" onchange="getTrailerView(this)" name="trailer['+trailer_num+']" type="file"></li>');
        button.attr('onClick',"ListClick('.files.trailers')");
    }
};
//remove files
function removeItem(e){
    e.parent('span').parent('li').remove();
};

//count size
function  countSize(input){
    var length = input.length;
    var sum = 0;
    if(length > 0){
        for(var i = 0; i<length;i++){
            sum += input[i].files[0].size;
        }
    }
    return sum / 1000000;
};

// $("#runtime").on('keyup',function(){
//     if (date.match(/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/)) {
//         alert("Valid date");
//     } else {
//         alert("Invalide date: dat should be in HH:MM:SS format!");
//     }
// });


function addCustomTextToChosen(cl,text){
    var select, chosen;

// Cache the select element as we'll be using it a few times
    select = $("."+cl);

// Init the chosen plugin
    select.chosen({
        allow_single_deselect: true,
        scroll_on_hover: false,
        no_results_text: text
    });

// Get the chosen object
    chosen = select.data('chosen');

// Bind the keyup event to the search box input
    chosen.dropdown.find('input').on('keyup', function(e)
    {
        // If we hit Enter and the results list is empty (no matches) add the option
        if (e.which == 13 && chosen.dropdown.find('li.no-results').length > 0)
        {
            var option = $("<option>").val(this.value).text(this.value);

            // Add the new option
            select.prepend(option);
            // Automatically select it
            select.find(option).prop('selected', true);
            // Trigger the update
            select.trigger("chosen:updated");
        }
    });
}