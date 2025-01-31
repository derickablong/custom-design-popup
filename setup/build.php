<?php
# Pool Mat load scripts
add_action('wp_footer', function() {    
    wp_enqueue_style('wc-cd-frontend-css');             
    wp_enqueue_script('wc-cd-frontend-script');
    
    # Popup form    
    include WC_CD_SETUP_DIR . '/parts/popup.php';    
});

# Admin library
add_action('admin_enqueue_scripts', function() {
    wp_register_style(
        'wc-cd-admin-css',
        WC_CD_ASSETS . 'css/admin.css',
        array(),
        uniqid(),
        'all'
    );
});

# Steps
add_action('cd-step-1', function() {
    include WC_CD_SETUP_DIR . '/parts/step-1.php';
});
add_action('cd-step-2', function() {
    include WC_CD_SETUP_DIR . '/parts/step-2.php';
});
add_action('cd-step-3', function() {
    include WC_CD_SETUP_DIR . '/parts/step-3.php';
});
add_action('cd-step-4', function() {
    include WC_CD_SETUP_DIR . '/parts/step-4.php';
});



# User Library
add_action('wp_enqueue_scripts', function() {
    global $post;
   
    wp_register_style(
        'wc-cd-frontend-css',
        WC_CD_ASSETS . 'css/wc-cd.css',
        array(),
        uniqid(),
        'all'
    );       
    
   
    wp_register_script(
        'wc-cd-frontend-script',
        WC_CD_ASSETS . 'js/wc-cd.js',
        array('jquery'),
        uniqid(),
        true
    );
    
    # Get settings 
    $settings = wc_cd_get_settings();
    

    # Global varialables
    $args = array(                      
        'POOL_BG'           => WC_CD_ASSETS.'css/pool.webp',
        'PRODUCT_ID'        => $settings['product-id'],
        'TARGET_ELEMENT_ID' => $settings['target-element-id'],
        'DESIGN_MAX_WIDTH'  => $settings['max-width'],
        'DESIGN_MAX_HEIGHT' => $settings['max-length'],
        'DESIGN_PRICE'      => $settings['price'],
        'CONTOUR_PRICE'     => $settings['cutting-price'],
        'CHECKOUT_PAGE'     => home_url('/checkout'),

        # add-on form input names
        'WC_CD_POOL_WIDTH'    => WC_CD_POOL_WIDTH,
        'WC_CD_POOL_LENGTH'   => WC_CD_POOL_LENGTH,
        'WC_CD_FILE_INPUT'    => WC_CD_FILE_INPUT,
        'WC_CD_CONTOUR_INPUT' => WC_CD_CONTOUR_INPUT,
        'WC_CD_WIDTH_INPUT'   => WC_CD_WIDTH_INPUT,
        'WC_CD_LENGTH_INPUT'  => WC_CD_LENGTH_INPUT
    );


    wp_localize_script( 'wc-cd-frontend-script', 'WC_CD', $args);
   
});


// Add-on
require_once WC_CD_SETUP_DIR . 'add-ons.php';
// Management
require_once WC_CD_SETUP_DIR . 'management.php';