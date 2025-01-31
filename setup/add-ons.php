<?php

# Get settings
function wc_cd_get_settings() {
    return get_option(WC_CD_SETTINGS, [
        'product-id'        => 0,
        'target-element-id' => '',
        'price'             => 500,
        'cutting-price'     => 300,
        'max-width'         => 116,
        'max-length'        => 300
    ]);
}

# Get design cost
function wc_cd_design_dimension( $item ) {
    $width           = $item[WC_CD_WIDTH_INPUT] * 0.01;
    $length          = $item[WC_CD_LENGTH_INPUT] * 0.01;
    return ($width * $length);
}

# Get contour price
function wc_cd_contour_price( $cart_item ) {
    $is_contour = $cart_item[WC_CD_CONTOUR_INPUT] == 'yes';
    if ($is_contour) {
        # Get settings 
        $settings = wc_cd_get_settings();

        $total_dimension = wc_cd_design_dimension( $cart_item );       
        return wc_price($total_dimension * $settings['cutting-price']);        

    }
    return '0.00<span class="woocommerce-Price-currencySymbol">₪</span>';
}


# Product add on custom fields validation
add_filter( 'woocommerce_add_to_cart_validation', 'product_add_on_custom_fields_validation', 10, 3 );
function product_add_on_custom_fields_validation( $passed, $product_id, $quantity ){
    
    
    if( isset( $_POST[WC_CD_WIDTH_INPUT] )) {
        if ( ! function_exists( 'wp_handle_upload' ) ) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
        }

        $uploadedfile = $_FILES[WC_CD_FILE_INPUT];
        $movefile = wp_handle_upload($uploadedfile, array('test_form' => false));

        if ( $movefile && !isset( $movefile['error'] ) ) {
            $_POST[WC_CD_FILE_INPUT] = $movefile;                       
            $passed = true;
        } else {
            wc_add_notice( '<strong>Design image</strong> is a required field', 'error' );
            $passed = false;
        }
    }
    return $passed;
}

# Add custom cart item data
add_filter( 'woocommerce_add_cart_item_data', 'add_custom_cart_item_data', 10, 2 );
function add_custom_cart_item_data( $cart_item_data, $product_id ){

    if( isset($_POST[WC_CD_WIDTH_INPUT]) ) {
        $cart_item_data[WC_CD_POOL_WIDTH]    = sanitize_text_field($_POST[WC_CD_POOL_WIDTH]);
        $cart_item_data[WC_CD_POOL_LENGTH]   = sanitize_text_field($_POST[WC_CD_POOL_LENGTH]);
        $cart_item_data[WC_CD_FILE_INPUT]    = $_POST[WC_CD_FILE_INPUT];
        $cart_item_data[WC_CD_WIDTH_INPUT]   = sanitize_text_field( $_POST[WC_CD_WIDTH_INPUT] );
        $cart_item_data[WC_CD_LENGTH_INPUT]  = sanitize_text_field( $_POST[WC_CD_LENGTH_INPUT] );
        $cart_item_data[WC_CD_CONTOUR_INPUT] = $_POST[WC_CD_CONTOUR_INPUT];
        $cart_item_data['wc-cd-unique-key']  = md5( microtime().rand() );
    }
    return $cart_item_data;
}

// Display custom cart item data on cart and checkout
add_filter( 'woocommerce_get_item_data', 'display_custom_cart_item_data', 10, 2 );
function display_custom_cart_item_data( $cart_item_data, $cart_item ) {      
    if ( isset( $cart_item[WC_CD_WIDTH_INPUT] ) ){   
        
        if (array_key_exists(WC_CD_POOL_WIDTH, $cart_item)) {
            $cart_item_data[] = array(
                'name' => 'Pool width (m)',
                'value' => $cart_item[WC_CD_POOL_WIDTH]
            );
        }
        if (array_key_exists(WC_CD_POOL_LENGTH, $cart_item)) {
            $cart_item_data[] = array(
                'name' => 'Pool length (m)',
                'value' => $cart_item[WC_CD_POOL_LENGTH]
            ); 
        }        
        if (array_key_exists(WC_CD_WIDTH_INPUT, $cart_item)) {
            $cart_item_data[] = array(
                'name' => __('Design width (cm)', 'woocommerce'),
                'value' => $cart_item[WC_CD_WIDTH_INPUT]
            );
        }
        if (array_key_exists(WC_CD_LENGTH_INPUT, $cart_item)) {
            $cart_item_data[] = array(
                'name' => __('Design length (cm)', 'woocommerce'),
                'value' => $cart_item[WC_CD_LENGTH_INPUT]
            );
        }
        
        $cart_item_data[] = array(
            'name' => 'Contour Cutting',
            'value' => wc_cd_contour_price( $cart_item )
        );
        
        if (array_key_exists(WC_CD_FILE_INPUT, $cart_item)) {
            $cart_item_data[] = array(
                'name' => __('Design image', 'woocommerce'),
                'value' => '<img src="'.$cart_item[WC_CD_FILE_INPUT]['url'].'" alt="" width="50" />'
            );        
        }
    }
    return $cart_item_data;
}

# Save and display custom item data everywhere on orders and email notifications
add_action( 'woocommerce_checkout_create_order_line_item', 'add_product_custom_field_as_order_item_meta', 10, 4 );
function add_product_custom_field_as_order_item_meta( $item, $cart_item_key, $values, $order ) {
    if ( isset($values[WC_CD_WIDTH_INPUT]) ) {        
        $item->update_meta_data('Pool width (m)', $values[WC_CD_POOL_WIDTH] );
        $item->update_meta_data('Pool length (m)', $values[WC_CD_POOL_LENGTH] );       
        $item->update_meta_data('Design width (cm)', $values[WC_CD_WIDTH_INPUT] );
        $item->update_meta_data('Design length (cm)', $values[WC_CD_LENGTH_INPUT] );
        $item->update_meta_data('Contour Cutting', wc_cd_contour_price( $values ) );
        $item->update_meta_data('Design image', '<img src="'.$values[WC_CD_FILE_INPUT]['url'].'" alt="" width="50" />' );        
    }
}

# Add design fee
add_action('woocommerce_before_calculate_totals', 'customize_cart_item_prices');
function customize_cart_item_prices( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    // Avoiding the hook repetition for price calculations
    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;    

    # Get settings 
    $settings = wc_cd_get_settings();
    
    // Loop through cart items
    $cart_items = $cart->get_cart();
    foreach ( $cart_items as $item ) {
        if (isset($item[WC_CD_WIDTH_INPUT])) {           
            
            $total_dimension = wc_cd_design_dimension( $item );
            $total           = $total_dimension * $settings['price'];
            $contour_total   = $item[WC_CD_CONTOUR_INPUT] == 'yes' ? $total_dimension * $settings['cutting-price'] : 0;
            $grand_total     = $total + $contour_total;

            $item['data']->set_price( $grand_total );

        }
    }
    
}
