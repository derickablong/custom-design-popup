jQuery(document).ready(function($) {
    
    const $DOC              = $(document);
    const UPLOADED_IMAGE    = new Image();
    const INPUT_DESIGN_FILE = document.getElementById(WC_CD.WC_CD_FILE_INPUT);   
    
    let IS_CONTOUR       = false;
    let IS_LOADING       = true;
    let MAT_MAX_WIDTH_PX = 0;
    let imageWidth       = 0;
    let imageHeight      = 0;
    let design_width_input;
    let design_height_input;
    let design_range_slider_input;

    const stopEvent = e => {
        e.preventDefault();        
        e.stopPropagation();
    };


    
    UPLOADED_IMAGE.onload = function () {   

        // Design fields
        design_width_input        = document.getElementById('wc-cd-design-width-input');
        design_height_input       = document.getElementById('wc-cd-design-length-input');
        design_range_slider_input = document.getElementById('design-slider');

        // Handle design dimension changes
        design_width_input.addEventListener('input', designWidthHandle);
        design_width_input.addEventListener('propertychange', designWidthHandle); 
        
        // Range slider on change
        design_range_slider_input.oninput = function(e) {
            design_width_input.value = e.target.value;
            designWidthHandle(e);
        }

        const ratio = designRatio( 
            UPLOADED_IMAGE.height, 
            UPLOADED_IMAGE.width, 
            parseFloat(WC_CD.DESIGN_MAX_HEIGHT), 
            parseFloat(WC_CD.DESIGN_MAX_WIDTH) 
        );
        
        imageWidth = ratio.width;
        imageHeight = ratio.height;

        design_width_input.value        = imageWidth;
        design_height_input.value       = imageHeight;        
        design_range_slider_input.max   = WC_CD.DESIGN_MAX_WIDTH;
        design_range_slider_input.value = imageWidth;
        
        $('.pool-mat-image-drop-box').hide();
        $('.pool-mat-image-preview')
            .html( UPLOADED_IMAGE )
            .show();        
    
    }


    function designRatio(imgH, imgW, maxh, maxw) {
        var ratio = maxh/maxw;
        if (imgH/imgW > ratio){
            // height is the problem
            if (imgH > maxh){
                return {
                    width: Math.round( (imgW*(maxh/imgH)) * 100 ) / 100,
                    height: maxh
                };                
            }
        } else {
            // width is the problem
            if (imgW > maxh){
                return {
                    height: Math.round( (imgH*(maxw/imgW)) * 100 ) / 100,
                    width: maxw
                };               
            }
        }
        return {
            width: imgW,
            height: imgH
        };
    }

    
    function add_to_cart() {        
        $('.pm-popup-container').addClass('loading');
        $('.pool-with-design-preview').hide();

        var form_data = new FormData();

        form_data.append('product_id', WC_CD.PRODUCT_ID);
        form_data.append('quantity', 1);        
        form_data.append(WC_CD.WC_CD_FILE_INPUT, $('#'+WC_CD.WC_CD_FILE_INPUT)[0].files[0]);         
        form_data.append(WC_CD.WC_CD_POOL_WIDTH, $('#'+WC_CD.WC_CD_POOL_WIDTH).val());
        form_data.append(WC_CD.WC_CD_POOL_LENGTH, $('#'+WC_CD.WC_CD_POOL_LENGTH).val());
        form_data.append(WC_CD.WC_CD_WIDTH_INPUT, $('#'+WC_CD.WC_CD_WIDTH_INPUT).val());
        form_data.append(WC_CD.WC_CD_LENGTH_INPUT, $('#'+WC_CD.WC_CD_LENGTH_INPUT).val());        
        form_data.append(WC_CD.WC_CD_CONTOUR_INPUT, IS_CONTOUR ? 'yes' : 'no');
                

        $.ajax({
        type       : "POST",
        contentType: false,
        processData: false,
        url        : woocommerce_params.wc_ajax_url.toString().replace("%%endpoint%%", "add_to_cart"),
        data       : form_data,
        beforeSend : function (response) {            
            $('.pm-steps').addClass('loading');
        },
        complete: function (response) {                       
            $('.pm-steps').removeClass('loading');          
        },
        success: function (response) {

            if (response.error & response.product_url) {
                console.log('Error');
            }

            // Display step 4
            UPLOADED_IMAGE.src = '';
            $('.pm-design-popup input').val('');
            $('.popup-header, .popup-step').hide();
            $('.step-4').show();
            $('.pm-popup-container').removeClass('loading');
            $('.pm-popup-container').css('min-height', '200px');            
        }
        });

    }


    function uploadDesign( file ) {         
        IS_LOADING = true;
        UPLOADED_IMAGE.removeAttribute('style');
        UPLOADED_IMAGE.src = URL.createObjectURL(file);
    }


    function designWidthHandle(e) {  
        IS_LOADING = false;      
        if (parseFloat(e.target.value) > parseFloat(WC_CD.DESIGN_MAX_WIDTH)) {           
            e.preventDefault();
            e.target.value = (e.target.value).slice(0,-1);
        } else {
            poolWithDesignPreview();
        }        
    }
      

    function poolWithDesignPreview() {      
        
        if (IS_LOADING) {
            $('.pool-mat-image-preview').addClass('loading');
        }

        let _width_cm = parseFloat(design_width_input.value);        

        if (!isNaN(_width_cm)) { 
            
            $('.pool-with-design-preview img').width( _width_cm );
    
            setTimeout(function() {


                const ratio = designRatio( 
                    $('.pool-with-design-preview img').height(), 
                    $('.pool-with-design-preview img').width(), 
                    parseFloat(WC_CD.DESIGN_MAX_HEIGHT), 
                    parseFloat(WC_CD.DESIGN_MAX_WIDTH) 
                );
    
                imageWidth = ratio.width;
                imageHeight = ratio.height;               
                
    
                // Pool dimension convertion from meter to pixel
                var pool_m_width      = parseFloat( $('#wc-cd-pool-width').val() );
                var pool_m_height     = parseFloat( $('#wc-cd-pool-height').val() );
                var pool_m_basis      = pool_m_width > pool_m_height ? pool_m_width : pool_m_height;
                var pool_px_max_width = MAT_MAX_WIDTH_PX;
                var pool_px_width     = (pool_m_width/pool_m_basis) * pool_px_max_width;
                var pool_px_height    = (pool_m_height/pool_m_basis) * pool_px_max_width;                        
                
                $('.pool-with-design-preview img').css('width', imageWidth+'px');
    
                $('.pool-with-design-preview').width(pool_px_width);
                $('.pool-with-design-preview').height(pool_px_height);

                $('.pool-mat-image-preview').removeClass('loading');

                design_width_input.value = Math.round( imageWidth * 100 ) / 100;
                design_height_input.value = Math.round( imageHeight * 100 ) / 100;

                updateGrandTotal();

            }, 500);
        }
    }


    function formatNumberWithCommas(number) {        
        var options = {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2           
        };
        return number.toLocaleString("en-IN", options);
    }


    function updateGrandTotal() {       

        // Let's convert cm to meter first
        var width_to_meter    = parseFloat(design_width_input.value) * 0.01;
        var height_to_meter   = parseFloat(design_height_input.value) * 0.01;
        var price_per_meter   = parseFloat(WC_CD.DESIGN_PRICE);
        var total_dimension   = (width_to_meter * height_to_meter);
        var contour_total     = IS_CONTOUR ? total_dimension * parseFloat(WC_CD.CONTOUR_PRICE) : 0;
        var design_cost_total = total_dimension * price_per_meter;
        var grand_total       = design_cost_total + contour_total;
        
        grand_total = isNaN(grand_total) ? '0.00' : formatNumberWithCommas(grand_total);        

        $('.cost-payment .design-price').text( formatNumberWithCommas(design_cost_total) );
        $('.cost-payment .cost-total').text( grand_total );
        $('.cost-payment .contour-price').text( formatNumberWithCommas(contour_total) );        
    }


    // Upload or drop design file
    INPUT_DESIGN_FILE.onchange = evt => {
        const [file] = INPUT_DESIGN_FILE.files
        if (file) {
            uploadDesign(file);
        }
    }

    $DOC.on('click', '.pool-mat-image-drop-box', function(e) {
        stopEvent(e);
        $('#'+WC_CD.WC_CD_FILE_INPUT).trigger('click');
    });

    $('.pool-mat-image-drop-box').on(
        'dragover',
        stopEvent
    )
    $('.pool-mat-image-drop-box').on(
        'dragenter',
        stopEvent
    )
    $('.pool-mat-image-drop-box').on(
        'drop',
        function(e){
            if(e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length) {
                e.preventDefault();
                e.stopPropagation();                
                const [file] = e.originalEvent.dataTransfer.files;
                uploadDesign(file);
            }
        }
    );


    // Replace image
    $DOC.on('click', '.replace-pic', function(e) {
        stopEvent(e);
        INPUT_DESIGN_FILE.value = '';
        $('.pool-mat-image-preview').html('').hide();
        $('.pool-mat-image-drop-box').show();        
    });

    // Proceed to step 3
    $DOC.on('click', '.step-proceed', function(e) {
        stopEvent(e);
        IS_LOADING = true;
        poolWithDesignPreview();
        $('.popup-header, .popup-step').hide();
        $('.step-3').show();
        $('.pool-with-design-preview').css('display', 'flex');
    });

    // Add to cart
    $DOC.on('click', '.design-add-to-cart', function(e) {
        stopEvent(e);
        add_to_cart();
    });

    // Start over
    $DOC.on('click', '.start-over, .prev-step', function(e) {
        stopEvent(e);       
        $('.pm-popup-container').removeAttr('style'); 
        $('.popup-step').hide();        
        $('.popup-header, .step-1, .step-2').show();        
    });

    // Start new design
    $DOC.on('click', '.start-new-design', function(e) {
        stopEvent(e);
        INPUT_DESIGN_FILE.value = '';
        IS_CONTOUR = false;
        $('.contour-cutting input').prop('checked', false);
        $('.pool-mat-image-preview').html('').hide();
        $('.pool-mat-image-drop-box').show();  
        $('.pm-popup-container').removeAttr('style'); 
        $('.popup-step').hide();        
        $('.popup-header, .step-1, .step-2').show();  
    });

    // Close popup
    $DOC.on('click', '.close-popup', function(e) {
        e.preventDefault();
        $('.pm-design-popup input').val('');        
        $('html, body').removeClass('pm-design-popup-active');   
    });   

    // Contour cutting
    $DOC.on('click', '.contour-cutting', function(e) {
        stopEvent(e);
        $checkbox = $(this).find('input');
        if ($checkbox.is(':checked')) {
            IS_CONTOUR = false;            
        } else {
            IS_CONTOUR = true;
        }

        $checkbox.prop('checked', IS_CONTOUR);
    });


    // Display design popup
    $DOC.on('click', WC_CD.TARGET_ELEMENT_ID, function(e) {
        e.preventDefault();
        $('html, body').addClass('pm-design-popup-active');   
        MAT_MAX_WIDTH_PX = $('.pm-steps').width();    
    });
    
    // Plug target element
    $(WC_CD.TARGET_ELEMENT_ID).addClass('pm-design-target');
});