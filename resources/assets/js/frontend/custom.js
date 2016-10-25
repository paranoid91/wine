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