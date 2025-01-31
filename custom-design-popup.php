<?php
/**
* Plugin Name: Pool Mat Order
* Plugin URI: https://iranh3.sg-host.com/
* Description: The process will allow the end customer to order one or more pool mats according to their personal design, customized to the dimensions they want for their pool, whether for branding purposes or other needs for the pool’s bottom surface.
* Version: 2024.0.1
* Author: Derick Ablong
* Author URI: https://www.onlinejobs.ph/jobseekers/info/118254
* License: GPLv2 or later
* Text Domain: wc-cd
*/

# Important constant IDs 
define('WC_CD_SETTINGS', "wc-cd-settings");  // Admin settings

# Add-on form input names
define('WC_CD_POOL_WIDTH', 'wc-cd-pool-width');
define('WC_CD_POOL_LENGTH', 'wc-cd-pool-height');
define('WC_CD_FILE_INPUT', 'wc-cd-design-file-input');
define('WC_CD_CONTOUR_INPUT', 'wc-cd-design-contour-input');
define('WC_CD_WIDTH_INPUT', 'wc-cd-design-width-input');
define('WC_CD_LENGTH_INPUT', 'wc-cd-design-length-input');

# Core plugin constants
define('WC_CD_PLUGIN', 'custom-design-popup');
define('WC_CD_DIR', plugin_dir_path( __FILE__ ));
define('WC_CD_URL', plugin_dir_url( __FILE__ ));
define('WC_CD_SETUP_DIR', WC_CD_DIR . 'setup/');
define('WC_CD_ASSETS', WC_CD_URL . 'assets/');


// Setup
require_once WC_CD_SETUP_DIR . 'build.php';
