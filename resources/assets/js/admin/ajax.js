/**
 * Created by vatia13 on 2/8/16.
 */

    // AJAX LOGIN for ADMIN PANEL
//var AdminAjaxLogin = function(e){
//    var e = $(e);
//    $.ajax({
//        url: e.attr('action'),
//        type:'POST',
//        data: e.serialize(),
//        success:function(data){
//           console.log(data);
//        },
//        error: function(data){
//            var errors = $.parseJSON(data.responseText);
//            console.log(data);
//            var i = 0;
//            console.log(data);
//            $.each(errors,function(index,value){
//                i++;
//
//                if(i == 1){
//                    $('.message').addClass('message-error').html(value[0]);
//                }
//            });
//        }
//    });
//    return false;
//};

var message = function(message,num){
    this.message = message;
    this.num = num;
    if(this.message.indexOf('permissions') > -1){
        $('#alert-messages').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+this.message+'</div>');
    }else{
        if(this.num){
            $('.table tbody tr:eq('+this.num+')').remove();
        }
        $('#alert-messages').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+this.message+'</div>');
    }

    $('div.alert').not('.alert-important').delay(3000).slideUp(200);
};

$('div.alert').not('.alert-important').delay(3000).slideUp(300);

$('.remove-modal').click(function(){
    $('.remove-item').attr('data-route',$(this).data('url'));
    var data = $('.remove-item').attr('data-remove',$(this).parent('td').parent('tr').index());
});

$('.remove-item').click(function(){
    var item = $(this);
    var token = item.attr('data-token');
    var route = item.attr('data-route');
    var num = item.attr('data-remove');
    $.ajax({
        url:route,
        type:'post',
        data:{_method:'POST',_token:token},
        success:function(msg){
            var result = new message(msg,num);
        }
    });
});


/* Modules Sort */
$( "#sortable" ).sortable().bind('sortupdate', function(e, ui) {
    var id = $('tbody#sortable tr').map(function(){
        return $(this).data("id");
    }).get();
    var url = $('tbody#sortable').data('route');
    var token = $('tbody#sortable').data('token');
    if(id.length > 0){
        $.ajax({
            url:url,
            type:'put',
            data:{_method:'PUT',_token:token,items:id}
        });
    }
});

$( "ul, li" ).disableSelection();



/* Item Status */
$(".item-status").click(function(){
    var item = $(this);
    var token = item.attr('data-token');
    var route = item.attr('data-route');
    $.ajax({
        url:route,
        type:'put',
        data:{_method:'PUT',_token:token},
        success:function(msg){
            var result = new message(msg,false);

            if(msg.indexOf('unpublished') > -1){
                item.html('<i class="glyphicon glyphicon-eye-close"></i>');
                item.parent('td').parent('tr').find('td:nth-child(2)').find('a').css('color','red');
            }else{
                item.parent('td').parent('tr').find('td:nth-child(2)').find('a').css('color','#2ca02c');
                item.html('<i class="glyphicon glyphicon-eye-open"></i>');
            }
        }
    });
});

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
            $(cl).trigger("chosen:updated").chosen();
        }
    });
}


function ajaxLoadData(url){
    if($("#rightSideData").is(':hidden')){
        $("#rightSideData").toggle('slide',{direction:'right'},200);
        $('.rightSide').css('width',($('.rightSide').width() - $('#rightSideData > div').width() + 120) + 'px');
    }
    $.ajax({
        url:url,
        type:'GET',
        data:{_method:'GET'},
        beforeSend:function(data){
            var preloader = $("#rightSideData").attr("data-preloader");
            $("#rightSideData .ajax-content").html('<img src="'+ preloader +'"/>');
        },
        success:function(data){
            $("#rightSideData .ajax-content").html(data);
        }
    });
}
/*
   Ajax Data Very Important Function !!!!
 */
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
            $("#upload_popup").modal('show');

            //Upload progress
            xhr.upload.addEventListener("progress", function(evt){
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total * 100;
                    //Do something with upload progress
                    $("#upload_popup .percents").html(percentComplete.toFixed(0) + '%');
                    $("#upload_popup .progress-line div").css('width',percentComplete.toFixed(0) + '%');
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
            $("#upload_popup").modal('hide');
            $(form).find('input[type="submit"]').attr('disabled',false);
        }
    });
}

var generateKey = function(button){
    if($(button).attr('data-action') != "" && $(button).attr('data-id') > 0){
        $.ajax({
            url:$(button).attr('data-action'),
            type:'GET',
            data:{_method:'GET',event_id:$(button).attr('data-id'),type:'key'},
            success:function(data){
                var keys = JSON.parse(JSON.stringify(data));
                var html = '';
                $.each(keys,function(index,value){
                    html += '<li>'+value+' <button class="btn btn-danger" onClick="delKey(this)" data-id="'+$(button).attr('data-id')+'" data-key="'+index+'" data-action="'+$(button).attr('data-action')+'"><i class="fa fa-trash"></i></button></li>';
                });
                $(".key_"+$(button).attr('data-id')).html(html);
            }
        })
    }
};

var delKey = function(button){
    if($(button).attr('data-action') != "" && $(button).attr('data-id') > 0){
        $.ajax({
            url:$(button).attr('data-action'),
            type:'GET',
            data:{_method:'GET',event_id:$(button).attr('data-id'),key:$(button).attr('data-key'),type:'del_key'},
            success:function(data){
                var keys = JSON.parse(JSON.stringify(data));
                var html = '';
                $.each(keys,function(index,value){
                    html += '<li>'+value+' <button class="btn btn-danger" onClick="delKey(this)" data-id="'+$(button).attr('data-id')+'" data-key="'+index+'" data-action="'+$(button).attr('data-action')+'"><i class="fa fa-trash"></i></button></li>';
                });
                $(".key_"+$(button).attr('data-id')).html(html);
            }
        })
    }
};