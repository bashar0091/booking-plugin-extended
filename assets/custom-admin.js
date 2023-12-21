jQuery(document).ready(function($){

// additional information added in doctor panel js
    var buttonAppended = false;
    jQuery(document).on('click','.am-front-appointment',function(e) {

        var additionalInfo = shortcodeData.additionalInfo;
        $content = `
            <div>
                <button class="pilar4 pilar_add_note_btn">katso lisätietoja</button>

                <div class="pilar_additional_box">
                   <div class="form">
                    <button href="#!" class="pilar_additional_box_close">x</button>

                    <h2>lisätietoja</h2>
                    <textarea name="additiona_info_text" class="additiona_info_text" required=""></textarea>
                   </div>
                </div>
            </div>
            ${additionalInfo}
        `;

        if (!buttonAppended) {
            jQuery('.am-appointment-details').append($content);
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
            jQuery('.am-link').each(function() {
                var link = jQuery(this).attr('href');
        
                // Check if the link matches with relationLink
                if (link === relationLink) {
                    // Find the nearest show_text textarea and append the text
                    jQuery(this).closest('.am-appointment-details').find('.additiona_info_text').val(relationText);
                }
            });
        });

    });


});