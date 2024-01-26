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
                        
                        <div class="image_uploader">
                            <label>
                                <svg height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M23 4C23 2.34315 21.6569 1 20 1H4C2.34315 1 1 2.34315 1 4V20C1 21.6569 2.34315 23 4 23H20C21.6569 23 23 21.6569 23 20V4ZM21 4C21 3.44772 20.5523 3 20 3H4C3.44772 3 3 3.44772 3 4V20C3 20.5523 3.44772 21 4 21H20C20.5523 21 21 20.5523 21 20V4Z" fill="#0F0F0F"></path> <path d="M4.80665 17.5211L9.1221 9.60947C9.50112 8.91461 10.4989 8.91461 10.8779 9.60947L14.0465 15.4186L15.1318 13.5194C15.5157 12.8476 16.4843 12.8476 16.8682 13.5194L19.1451 17.5039C19.526 18.1705 19.0446 19 18.2768 19H5.68454C4.92548 19 4.44317 18.1875 4.80665 17.5211Z" fill="#0F0F0F"></path> <path d="M18 8C18 9.10457 17.1046 10 16 10C14.8954 10 14 9.10457 14 8C14 6.89543 14.8954 6 16 6C17.1046 6 18 6.89543 18 8Z" fill="#0F0F0F"></path> </g></svg>
                                upload Image
                                <input type="file" class="additional_image_upload" accept="image/*">
                            </label>

                            <div class="image_previewer"></div>
                        </div>

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

            //====
            jQuery('table tbody tr').each(function() {
                var relationText = jQuery(this).find('.relation_text').text().trim();
                var relationLink = jQuery(this).find('.relation_link').text().trim();
                var uploaded_image_column = jQuery(this).find('.uploaded_image_column').html().trim();
            
                // Loop through each zoom link in the collapsible sections
                jQuery('.pilar_additional_wrapper .am-value-link').each(function() {
                    var link = jQuery(this).attr('href');
            
                    // Check if the link matches with relationLink
                    if (link === relationLink) {
                        // Find the nearest show_text textarea and append the text
                        jQuery(this).closest('.pilar_additional_wrapper .el-collapse-item').find('.additiona_info_text').val(relationText);
                        jQuery(this).closest('.pilar_additional_wrapper .el-collapse-item').find('.image_previewer').html(uploaded_image_column);
                    }
                });
            });

        });
        jQuery(document).on('click','.pilar_additional_box_close',function(e) {
            jQuery('.pilar_additional_box').removeClass('show');
        });

        var zoom_link_get = jQuery(this).find('.am-value-link').attr('href');
        jQuery('.zoom_link_val').val(zoom_link_get);

    });

    

    // =====================================================........
    jQuery(document).on('change', '.additional_image_upload', function (event) {
        var get_this = jQuery(this);
        var isUploading = false; // Flag to track ongoing upload
        var allowedTypes = ['image/jpeg', 'image/png', 'application/pdf']; // Allowed file types
    
        var file = event.target.files[0];
        if (allowedTypes.includes(file.type)) {
            if (!isUploading) {
                isUploading = true; // Set the flag to true to indicate an upload is in progress
    
                var formData = new FormData();
                formData.append('action', 'image_upload_handler');
                formData.append('file', file); // Append the file to the form data
    
                $.ajax({
                    type: 'POST',
                    url: bookAjax.ajaxurl,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        var data = JSON.parse(response);

                        $append_item = `
                        <span>
                            <input type="hidden" class="uploaded_image_id" value="${data.id}" name="uploaded_image_id[]"/>
                            <input type="hidden" value="${data.url}" name="uploaded_image[]"/>
                            <img src="${data.url}">
                            <button class="remove_image_upload">x</button>
                        </span>
                        `;

                        get_this.parent().parent().find('.image_previewer').append($append_item);

                        isUploading = false; // Reset the flag once the upload is complete
                    },
                    error: function (error) {
                        console.error('Error occurred:', error);
                        isUploading = false; // Reset the flag on error as well
                    }
                });
            }
        } else {
            alert('Please upload only JPG, PNG, or PDF files.');
            // Clear the file input
            $(this).val('');
        }
    });


    jQuery(document).on('click', '.remove_image_upload', function (event) {
        event.preventDefault();
        var get_this = jQuery(this);
        var image_id = get_this.parent().find('.uploaded_image_id').val();
        
        // AJAX request
        jQuery.ajax({
            type: 'POST',
            url: bookAjax.ajaxurl,
            data: {
                action: 'delete_image_action', // Action to be called in PHP
                image_id: image_id // Pass the image ID
            },
            success: function (response) {
                get_this.parent().remove();
            },
            error: function (errorThrown) {
                // Handle error
                console.log(errorThrown);
            }
        });
    });
    

    //set other page not date 
    if (window.location.pathname !== '/varaa-etavastaanotto/') {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
    
        const formattedDate = `${year}-${month}-${day}`;
        console.log(formattedDate);
    
        sessionStorage.setItem("date_set_click", formattedDate);
    }    

});