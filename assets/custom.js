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


// remove today date active color 
    let clickedDate = sessionStorage.getItem('clickedDate');
    if(clickedDate == 'removeJsToday'){
        $('.js-today').removeClass('js-today');
    }


// remove and add active class on calendar date
    $('.pilar_date_click').click(function(){
        $('.pilar_date_click').removeClass('active');
        $(this).addClass('active');
    });



// additional box js code
    var buttonAppended = false;
    jQuery(document).on('click','.pilar_additional_wrapper .el-collapse-item',function(e) {

        $content = `
            <div>
                <button class="pilar4 pilar_add_note_btn">LISÄÄ MUISTIINPANO</button>

                <div class="pilar_additional_box">
                    <form method="post" action="">
                        <a href="#!" class="pilar_additional_box_close">x</a>

                        <h2>Lisää lisätietoja</h2>
                        <input type="hidden" class="zoom_link_val" name="zoom_link_val" value="">
                        <textarea name="additiona_info_text" class="additiona_info_text" required=""></textarea>

                        <button name="add_info" class="add_info">Lisää</button>
                    </form>
                </div>
            </div>
        `;

        if (!buttonAppended) {
            jQuery('.pilar_additional_wrapper .el-collapse-item__wrap').append($content);
            buttonAppended = true;
        }

        //===
        jQuery(document).on('click','.pilar_add_note_btn',function(e) {
            jQuery(this).parent().find('.pilar_additional_box').addClass('show');

            jQuery('.zoom_link_val').val( jQuery(this).parent().find('.pilar_zoom_link').attr('href') );
        });
        jQuery(document).on('click','.pilar_additional_box_close',function(e) {
            jQuery('.pilar_additional_box').removeClass('show');
        });

        var zoom_link_get = jQuery(this).find('.am-value-link').attr('href');
        jQuery('.zoom_link_val').val(zoom_link_get);


        //====
        jQuery('table tbody tr').each(function() {
            var relationText = jQuery(this).find('.relation_text').text().trim();
            var relationLink = jQuery(this).find('.relation_link').text().trim();
        
            // Loop through each zoom link in the collapsible sections
            jQuery('.pilar_additional_wrapper .am-value-link').each(function() {
                var link = jQuery(this).attr('href');
        
                // Check if the link matches with relationLink
                if (link === relationLink) {
                    // Find the nearest show_text textarea and append the text
                    jQuery(this).closest('.pilar_additional_wrapper .el-collapse-item').find('.additiona_info_text').val(relationText);
                }
            });
        });

    });




});