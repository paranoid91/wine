$.fn.chosenOpen = function(cl,chosenEvent){
    $(cl).next('.chosen-container').find('.chosen-single').hide();
    switch(chosenEvent){
        case "hover":
            $(this).hover(function(event){
                event.stopPropagation();
                $(cl).trigger('chosen:open');
            });
            break;
        default:
            $(this).click(function(event){
                event.stopPropagation();
                $(cl).trigger('chosen:open');
            });
            break;
    }
};

$.fn.chosenPlaceholder = function(){
    this.next('.chosen-container').find('.chosen-single').find('span').html(this.data('placeholder'));
};

