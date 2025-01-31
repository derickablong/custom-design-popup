<div class="pm-design-popup">
    <div class="pm-popup-container">
        <a href="#" class="close-popup">
            <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M12 12L7 7M12 12L17 17M12 12L17 7M12 12L7 17" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
        </a>
        
        <div class="popup-header">
            <div class="popup-title">Pool Mat Order</div>
            <div class="popup-title-desc">ב 3 שלבים בלבד</div>
        </div>

        <div class="pm-steps">            
            
            <input type="hidden" name="<?php echo WC_CD_CONTOUR_INPUT ?>" id="<?php echo WC_CD_CONTOUR_INPUT ?>" value="no">

            <?php
            do_action('cd-step-1');
            do_action('cd-step-2');
            do_action('cd-step-3');
            do_action('cd-step-4');
            ?>
        </div>
    </div>    
</div>