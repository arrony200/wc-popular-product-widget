<?php
/**
* plugin name: Woocommerce Popular Product Widget
* Plugin URI:http://themepuller.com
* Version: 2.1
* description: This is a simple widget plugin to show Woocommerce Popular Product of your WordPress website based on views.
* Author: ThemePuller
* Author URI: http://themepuller.com
* Tested up to: 5.2.2
* Layers Plugin: True
* Layers Required Version: 1.0
* Version: 2.0
* Textdomain: woocommerce-popular-product-widget
*License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * License: GPL2
 * Copyright 2016  ThemePuller  (email : arrony200@gmail.com, skype:barony27)
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
**/
?>
<?php

if(!defined('ABSPATH')){
	exit;
}

function woocommerce_popular_product_style(){
   wp_enqueue_style('popular-product-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css'  );
}
add_action('wp_enqueue_scripts','woocommerce_popular_product_style');


require_once(plugin_dir_path(__FILE__).'/includes/woocommerce-popular-product-widget.php');
require_once(plugin_dir_path(__FILE__).'/includes/helper-function.php');