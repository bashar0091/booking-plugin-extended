jQuery(document).ready(function($){
    
    $('.pilar_card_btn').click(function() {
        $('.pilar_modal').removeClass('show');
        $(this).parent().find('.pilar_modal').addClass('show');
    });

    $('.pilar_modal_close').click(function() {
        $('.pilar_modal').removeClass('show');
    });

    // calendar show 
    $('#pilar_calendar').bsCalendar();

    $('.date_remove_pilar').click(function(){
        sessionStorage.removeItem('date_set_click');
    });


    $("#search-input").on("input", function () {
        var keyword = $(this).val().toLowerCase();

        $("#service-list .pilar_card_box").each(function () {
            var card = $(this);
            var doctorName = card.find("span").text().toLowerCase();

            if (doctorName.includes(keyword)) {
                card.show();
            } else {
                card.hide();
            }
        });
    });
    

    $('.pilar_humberger').click(function(){
        $('.pilar_sidebar').addClass('show');
    });
    $('.pilar_close_icon').click(function(){
        $('.pilar_sidebar').removeClass('show');
    });

});