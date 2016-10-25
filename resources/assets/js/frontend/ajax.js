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