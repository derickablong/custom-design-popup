<div class="popup-step step-3" style="margin-top:30px; display: none">

    <a href="#" class="prev-step">
        <svg baseProfile="tiny" height="24px" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Layer_1"><path d="M17,11H9.414l2.293-2.293c0.391-0.391,0.391-1.023,0-1.414s-1.023-0.391-1.414,0L5.586,12l4.707,4.707   C10.488,16.902,10.744,17,11,17s0.512-0.098,0.707-0.293c0.391-0.391,0.391-1.023,0-1.414L9.414,13H17c0.552,0,1-0.448,1-1   S17.552,11,17,11z"/></g></svg>
    </a>

    <div class="step-title">STEP 3: Set Dimension</div>
    <div class="step-desc">על ידי הגדרת המידות הרצויות של שטיח הבריכה ניתן לראות את גודל השטיח ביחס לגודל הבריכה</div>    
    
    <div class="range-slider-field">
        <input type="range" min="1" max="100" value="50" class="design-slider" id="design-slider">
    </div>
    <div class="step-dimention-field">
        <div class="field">
            <span>Width<br>(cm)</span>
            <input type="number" id="<?php echo WC_CD_WIDTH_INPUT ?>" name="<?php echo WC_CD_WIDTH_INPUT ?>">
        </div>
        <div class="field">
            <span>Height<br>(cm)</span>
            <input type="number" id="<?php echo WC_CD_LENGTH_INPUT ?>" name="<?php echo WC_CD_LENGTH_INPUT ?>" disabled>
        </div>
    </div>

    <div class="pool-mat-image-preview pool-with-design-preview" style="margin-top:30px"></div>
    <div class="cost-payment">
        <div>
            <span>Design Price:</span>
            <span class="design-price">0.00</span>
            <span class="currency"><?php echo get_woocommerce_currency_symbol(); ?></span>
        </div>
        <div>
            <span>Contour Cutting:</span>
            <span class="contour-price">0.00</span>
            <span class="currency"><?php echo get_woocommerce_currency_symbol(); ?></span>
        </div>
        <div>
            <span>Cost for payment:</span>
            <span class="cost-total">0.00</span>
            <span class="currency"><?php echo get_woocommerce_currency_symbol(); ?></span>
        </div>
    </div>

    
    <div class="step-footer">
        <a href="#" class="step-button design-add-to-cart">Add to Cart</a>
        <a href="#" class="step-button start-over">Start Over</a>
    </div>
</div>