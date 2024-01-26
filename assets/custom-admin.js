jQuery(document).ready(function($){

// additional information added in doctor panel js
    var buttonAppended = false;
    jQuery(document).on('click','.am-front-appointment',function(e) {

        var additionalInfo = shortcodeData.additionalInfo;
        $content = `
            <div class="additiona_infor">
                <button class="pilar4 pilar_add_note_btn">Katso lisätietoja</button>

                <div class="pilar_additional_box">
                   <div class="form">
                    <button href="#!" class="pilar_additional_box_close">x</button>

                    <h2>Lisätietoja</h2>
                    <textarea name="additiona_info_text" class="additiona_info_text" required=""></textarea>
                    <div class="image_previewer"></div>
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

            //====
            jQuery('table tbody tr').each(function() {
                var relationText = jQuery(this).find('.relation_text').text().trim();
                var relationLink = jQuery(this).find('.relation_link').text().trim();
                var uploaded_image_column = jQuery(this).find('.uploaded_image_column').html().trim();
            
                // Loop through each zoom link in the collapsible sections
                jQuery('.am-link').each(function() {
                    var link = jQuery(this).attr('href');
            
                    // Check if the link matches with relationLink
                    if (link === relationLink) {
                        // Find the nearest show_text textarea and append the text
                        jQuery(this).closest('.am-appointment-details').find('.additiona_info_text').val(relationText);
                        jQuery(this).closest('.am-appointment-details').find('.image_previewer').html(uploaded_image_column);
                    }
                });
            });
        });
        jQuery(document).on('click','.pilar_additional_box_close',function(e) {
            jQuery('.pilar_additional_box').removeClass('show');
        });

        var zoom_link_get = jQuery(this).find('.am-value-link').attr('href');
        jQuery('.zoom_link_val').val(zoom_link_get);


        jQuery('.am-link').attr('target', '_blank');
    });



// only admin.php?page=wpamelia-employees this page run this code 
    if (window.location.href.indexOf('admin.php?page=wpamelia-employees') > -1) {
        
        setTimeout(function() { 

            // get employee id on mouseover
            jQuery('.am-employee-card').click(function(){

                var get_id = jQuery(this).find('.am-employee-id').text();
                var match_id = get_id.match(/\d+/);
                
                if (match_id) {
                    var numeric_id = parseInt(match_id[0], 10);

                    jQuery.ajax({
                        type: 'POST',
                        url: adminAjax.ajaxurl,
                        data: {
                            action: 'get_hourly_rate_value',
                            'numeric_id': numeric_id,
                        },
                        success: function (response) {

                            var data = JSON.parse(response);

                            // hourly rate added 
                            setTimeout(function() { 
                                if (!jQuery('#hourly_rate_wrapper').length) {
                                    var rate_field = `
                                        <div class="el-form-item" id="hourly_rate_wrapper">
                                            <label for="hourly_rate" class="el-form-item__label">Tuntitaksa:</label>
                                            <div class="el-form-item__content">
                                                <div class="el-input">
                                                    <input type="number" class="el-input__inner" id="hourly_rate" value="${data.hourly_rate_data}" />
                                                    <!---->
                                                </div>
                                                <!---->
                                            </div>
                                        </div>
                                    `;
                            
                                    jQuery('#pane-details').append(rate_field);

                                    // delete field after append 
                                        $('.am-dialog-close').click(function(){
                                            $('#hourly_rate_wrapper').remove();
                                        });

                                    // hourly rate update in database
                                        jQuery('#hourly_rate').change(function(){
                                            
                                            var new_hourly_rate = jQuery(this).val();
                                            
                                            jQuery.ajax({
                                                type: 'POST',
                                                url: adminAjax.ajaxurl,
                                                data: {
                                                    action: 'update_hourly_rate_value',
                                                    'numeric_id': numeric_id,
                                                    'new_hourly_rate': new_hourly_rate,
                                                },
                                                success: function (response) {
                                                    
                                                },
                                                error: function (errorThrown) {
                                                }
                                            });

                                        });

                                }
                            }, 4000);

                        },
                        error: function (errorThrown) {
                        }
                    });
                }

            });

        }, 4000);

    }
            

});


// earning Pdf Generate
function pdf_generate() {
    // Get the element.
    var element = document.getElementById('pdf_generate');

    // Generate the PDF.
    html2pdf().from(element).set({
        margin: 0.1,
        filename: 'earning.pdf',
        jsPDF: {orientation: 'portrait', unit: 'in', format: 'A4', compressPDF: true}
    }).save();
}