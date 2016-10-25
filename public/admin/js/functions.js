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
/**
 * Created by vatia13 on 2/8/16.
 */
//Authentication position
$(function(){
    //Authentication frame position top

    var AuthTop = ($(window).height() - $('.auth').height()) / 2;
    $('.auth').css('margin-top',AuthTop+'px');

    //End Auth position


    //Authentication input left line
    $('.auth input[type="email"]').focus().parent('div').parent('div').find('.col-sm-2 .focus').fadeIn(400);
    $('.auth input[type="email"],.auth input[type="password"]').on('focus',function(){
        $('.auth .focus').fadeOut(300);
        $(this).parent('div').parent('div').find('.col-sm-2 .focus').fadeIn(400);
    });

});

// Cookies
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(name) {
    var cookie = " " + document.cookie;
    var search = " " + name + "=";
    var setStr = null;
    var offset = 0;
    var end = 0;
    if (cookie.length > 0) {
        offset = cookie.indexOf(search);
        if (offset != -1) {
            offset += search.length;
            end = cookie.indexOf(";", offset)
            if (end == -1) {
                end = cookie.length;
            }
            setStr = unescape(cookie.substring(offset, end));
        }
    }
    return(setStr);
}

function delCookie(name) {
    document.cookie = name + "=" + "; expires=Thu, 01 Jan 1970 00:00:01 GMT";
}



//menu
$('.leftSide .block-list').css({position:'relative',height:($(document).height() + 68)+'px'});
$('input[name="active_top_slide"]').click(function(){
    if(this.checked){
        $('.leftSide').toggle('slide',{direction:'left'},500,function(){
            $(this).addClass('topSide').removeClass('leftSide');
            $('.rightSide').addClass('middleSide').removeClass('rightSide');
            $('.topSide .block-list').css({position:'relative',height:'auto'});
            $('.topSide').slideDown(500);
            $('.nav_bars > i').addClass('glyphicon-arrow-up').removeClass('glyphicon-arrow-left');
        });
        setCookie("nav_bar", 1, 360);
    }else{
        $('.topSide').slideUp(500,function(){
            $('.topSide .block-list').css({position:'relative',height:($(document).height() + 68)+'px'});
            $(this).addClass('leftSide').removeClass('topSide');
            $('.middleSide').addClass('rightSide').removeClass('middleSide');
            $('.leftSide').toggle('slide',{direction:'left'},500,function(){
                $('.nav_bars > i').addClass('glyphicon-arrow-left').removeClass('glyphicon-arrow-up');
            });
        });
        delCookie("nav_bar");
    }
});


// Mouse Click Chose File
function ListClick(c){
    $(c+' ul li:last-child input').click();
};


function getPosterView(e){
        var button = $(e).parent('li').parent('ul').parent('div').find('div');
        var preview = $(e).parent('li').find('span');
        var file    = e.files[0];
        var reader  = new FileReader();
        reader.addEventListener("load", function () {
            preview.html('<img src="'+reader.result+'" width="166"/>');
            button.attr('onClick',"ListClick('.files.poster')");
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
};

function getSliderView(e){
    var button = $(e).parent('li').parent('ul').parent('div').find('div');
    var preview = $(e).parent('li').find('span');
    var file    = e.files[0];
    var reader  = new FileReader();
    reader.addEventListener("load", function () {
        preview.html('<img src="'+reader.result+'" width="166"/>');
        button.attr('onClick',"ListClick('.files.slider')");
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
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
            preview.html('<i class="glyphicon glyphicon-remove" onClick="removeItem($(this))"></i><img src="'+reader.result+'" width="166"/>');
            $(e).parent('li').parent('ul').append('<li><span></span><input class="img_'+image_num+'" accept="image/*" onchange="getImageView(this)" name="still['+image_num+']" type="file"></li>');
            button.attr('onClick',"ListClick('.files.images')");
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }

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


function escapeSpecialChars(jsonString) {

    return jsonString.replace(/\n/g, "\\n")
        .replace(/\r/g, "\\r")
        .replace(/\t/g, "\\t")
        .replace(/\f/g, "\\f");

}

////RIGHTSIDE DATA
//$(function(){
//    $('.rightSide').css('width',($('.rightSide').width() - $('#rightSideData > div').width() + 200) + 'px');
//});


function getFieldValue(name,url,seconds){
    $('#'+name).val("");
   var interval = setInterval(function(){
       var value = $('#'+name).val();
       if(value != ""){
           $('.'+name+' > div').html('<img src="'+ url + value + '" width="100%"/>');
           clearInterval(interval);
       };
   },seconds);
}



$.fn.Fields = function(html,options){
    var settings = $.extend({
        del:'del_detail',
        appendClass: 'content',
        tag: 'div'
    },options);

    //hide delete button if there is 1 detail
    $('#'+settings.del).hide();

    //add detail fields
    $(this).on('click',function(){
        var num = $('.'+settings.appendClass+' > '+settings.tag).length;
        html = html.replace(/\[]/g,'['+num+']');
        var pattern = new RegExp(settings.chosen_prefix, 'g');
        $('.'+settings.appendClass).append(html.replace(pattern,settings.chosen_prefix+num));
        if($('.'+settings.appendClass+' > '+settings.tag).length > 1){
            $('.'+settings.chosen_prefix).addClass(settings.chosen_prefix+num).removeClass(settings.chosen_prefix);
            $('.'+settings.chosen_prefix+num).show();
            $('#'+settings.del).show();
            addCustomTextToChosen(settings.chosen_prefix+num,'დეტალი არ არის სიაში,დააჭირეთ Enter-ს ამ დეტალის დასამატებლად:');
        }
    });

    if($('.'+settings.appendClass+' > '+settings.tag).length > 1){
        $('#'+settings.del).show();
    }

    //del detail fields
    $('#'+settings.del).on('click',function(){
        if($('.'+settings.appendClass+' > '+settings.tag).length > 1){
            $('.'+settings.appendClass+' > '+settings.tag+':last-child').remove();
        }
        if($('.'+settings.appendClass+' > '+settings.tag).length < 2) {
            $('#'+settings.del).hide();
        }
    });
};

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
            if(this.value != ""){
                $.ajax({
                    url:select.data('action'),
                    type:'POST',
                    data:{_method:'POST',_token:select.data('token'),action:select.data('type'),type:select.data('type'),value:this.value}
                });
            }
            // Add the new option
            select.prepend(option);
            // Automatically select it
            select.find(option).prop('selected', true);
            // Trigger the update
            select.trigger("chosen:updated");
        }
    });
}


function countSum(input){
    var input = $(input);
    var element = input.parent('div').parent('div');
    var num = element.find('.d_num');
    var price = element.find('.d_price');
    var sum = element.find('.d_sum');

    if(num.val() > 0 && price.val() > 0){
        sum.val(num.val() * price.val());
    }
}

//REMOVE IMAGES
function removeImage(button){
    $(button).parent('div').remove();
}


/*
*
*
*   change name attribute value in upload image text field ----> name='image[0]' .....
*
*
* */

if($("form.myForm").length > 0){

    $("form.myForm").submit(function(e){
        var inputs = $('.myItemImages input');
        $(inputs).each(function(i){
            $(this).attr('name','image['+ i +']');
        });
    });
}

