<?php
/**
 * @package eсp_plugin
 */
/*
Plugin Name: Парсер калькулятора www.evropa-pol.ru
Description: Плагин парсинга результатов калькулятора с сайта http://www.evropa-pol.ru, вывода результатов.
Version: 1.0.0
*/

function epc_styles_and_scripts_load()
{
    wp_register_style('epc_bootstrap', plugin_dir_url(__FILE__) . 'includes/bootstrap.min.4.2.1.css', []);
    wp_enqueue_style('epc_bootstrap');
    wp_register_style('epc_css_main', plugin_dir_url(__FILE__) . 'includes/main.css', []);
    wp_enqueue_style('epc_css_main');

//    wp_register_script('epc_js_jquery', plugin_dir_url(__FILE__) . 'includes/jquery-3.3.1.min.js', []);
//    wp_enqueue_script('epc_js_jquery');
//    wp_register_script('epc_js_popper', plugin_dir_url(__FILE__) . 'includes/popper.min.js', []);
//    wp_enqueue_script('epc_js_popper');
    wp_register_script('epc_js_bootstrap', plugin_dir_url(__FILE__) . 'includes/bootstrap.min.4.2.1.js', []);
    wp_enqueue_script('epc_js_bootstrap');
    wp_register_script('epc_js_main', plugin_dir_url(__FILE__) . 'includes/main.js', []);
    wp_enqueue_script('epc_js_main');
}


add_shortcode('epc_plugin', 'epc_shortcode');
function epc_shortcode($attrs, $content='')
{
    $attrs = array_change_key_case((array)$attrs, CASE_LOWER);
    $attrs = shortcode_atts([
        'content_after_form' => false,
        'title' => '',
        'proxy' => '',
        'proxy_auth' => '',
        'contact_form_7' => 'epc_info',
    ], $attrs);

    epc_styles_and_scripts_load();

    ob_start();
    require plugin_dir_path(__FILE__) . 'main.php';
    $main = ob_get_clean();
    return $main;
}


//add_action('init', 'epc_shortcodes_init');
//function epc_shortcodes_init()
//{
//    add_shortcode('epc_plugin', 'epc_shortcode');
//}
