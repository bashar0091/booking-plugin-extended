jQuery(document).ready(function($){
    
    $('.pilar_card_btn').click(function() {
        $('.pilar_modal').removeClass('show');
        $(this).parent().find('.pilar_modal').addClass('show');
    });

    $('.pilar_modal_close').click(function() {
        $('.pilar_modal').removeClass('show');
    });
    
});