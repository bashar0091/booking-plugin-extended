jQuery(document).ready(function($) {
    
    // append list of employee 
    setTimeout(() => {
        $('.am-service-list-container').append( $('.pilar-employee') );
    }, "1500");
    
    // popup show
    $('.popup_show').click(function() {
        $(this).parent().find('.booking_popup').addClass('show');
    });
    $('.close_popup').click(function() {
        $('.booking_popup').removeClass('show');
    });
    
});