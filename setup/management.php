<?php

if ( is_admin() ) {
    add_action( 'admin_menu', 'wc_cd_add_products_menu_entry', 100 );
}

# Add menu entry under admin products
function wc_cd_add_products_menu_entry() {
    add_submenu_page(
        'edit.php?post_type=product',
        __( 'Pool Mat' ),
        __( 'Pool Mat' ),
        'manage_woocommerce',
        'wc-cd-management',
        'wc_cd_management'
    );
}

# Admin management
function wc_cd_management() {
    wp_enqueue_style('wc-cd-admin-css');
    do_action('cd-management');
}

# Admin management view
add_action('cd-management', function() {    
    include WC_CD_SETUP_DIR . '/parts/admin.php';
});

# Admin management save settings changes
add_action('wc-cd-settings', function() {
    if (!isset($_POST['wc-cd'])) return;

    $settings = $_POST['wc-cd'];
    update_option( WC_CD_SETTINGS, $settings );
    echo '<div class="wc-cd-notice">Settings saved.</div>';
});