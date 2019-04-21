<div id="epc_plugin">
<?php
// define shortcode parameters
define('EPC_SC_ATTRS', isset($attrs) ? $attrs : []);
define('EPC_SC_CONTENT', isset($content) ? $content : '');
// parsing library
require plugin_dir_path(__FILE__) . '/simple_html_dom.php';
// plugin files
require plugin_dir_path(__FILE__) . '/constants.php';
require plugin_dir_path(__FILE__) . '/functions.php';

$epc_action = isset($_POST['epc_action']) ? $_POST['epc_action'] : '';

// ==================== form start ====================
echo '<form class="form-epc--js" method="POST" action="#epc_form_results">';
// ==========================================================
ob_start();
require EPC_VIEWS_DIR . '/form.php';
echo ob_get_clean();

//if (!EPC_SC_ATTRS['content_after_form'] and EPC_SC_CONTENT) {
//    echo do_shortcode(EPC_SC_CONTENT);
//}

// === Spaghetti input validate ===
$error_exists = false;
if ($epc_action) {
    foreach (['sloi_zas', 'ploschat'] as $field) {
        $value = isset($_POST[$field]) ? $_POST[$field] : '';
        switch ($field) {
            case 'sloi_zas':
                if (empty($value)) {
                    $error_exists = true;
                    epc_error('Заполните полe `толщина сухой стяжки`.');
                } elseif ((intval($value) < 4) or (36 < intval($value))) {
                    $error_exists = true;
                    epc_error('Введите значение от 4 до 36 в поле `толщина сухой стяжки`.');
                }
                break;

            case 'ploschat':
                if (empty($value)) {
                    $error_exists = true;
                    epc_error('Заполните полe `площадь помещения`.');
                }
                break;
        }
    }
}

$show_form = false;

$proxy = EPC_SC_ATTRS['proxy'];
$proxy_auth = EPC_SC_ATTRS['proxy_auth'];
if (!$error_exists and $epc_action) {
    // ===  preparing parameters to sending to evropa-pol ===
    $fields = [];
    foreach (EPC_FIELDS as $field) {
        $value = isset($_POST[$field]) ? $_POST[$field] : '';
        switch ($field) {
            case 'plenka_lenta':
                if (!empty($value)) {
                    if (is_array($value)) {
                        foreach ($value as $i) {
                            $fields[$field . '[' . $i . ']'] = $i;
                        }
                    } else {
                        $fields[$field . '[' . $value . ']'] = $value;
                    }
                }
                break;
            default:
                $fields[$field] = $value;
                break;
        }
    }

    if ($epc_action == 'recount') {
        // === filling request parameters ===
        foreach (EPC_RECOUNT_FIELDS as $field) {
            if (isset($_POST[$field])) {
                $fields[$field] = $_POST[$field];
            }
        }

        foreach (['name', 'phone', 'adres', 'mail', 'message'] as $field) {
            $fields[$field] = '';
        }

        $form_build_id = $_POST['form_build_id'];

        $fields['form_id'] = 'calculation_form';
        $fields['_triggering_element_name'] = 'op';
        $fields['_triggering_element_value'] = 'Пересчитать';
        $fields['form_build_id'] = $form_build_id;

    } elseif ($epc_action == 'submit') {

        // === getting "form_build_id" ===
        $response = get_request_epc(
            EPC_BASE_URL, $proxy, $proxy_auth
        );

        $html = data_to_html($response);
        $form_build_id = get_form_build_id($html);
        // ===============================

        $fields['form_id'] = 'calculation_form';
        $fields['_triggering_element_name'] = 'op';
        $fields['_triggering_element_value'] = 'Рассчитать стоимость';
        $fields['form_build_id'] = $form_build_id;
    }
    //hidden input with form_build_id
    require EPC_VIEWS_DIR . '/form_build_id_input.php';

    $response = post_request_epc(
        EPC_AJAX_URL, $fields,
        $proxy,
        $proxy_auth
    );

    $data = main_parsing($response);


    echo render_table($data['calc_table_data']);

    if (!empty($data['materials'])) {
        echo render_recount_button(isset($_POST['epc_action']) ? $_POST['epc_action'] : false);
        echo render_info_card($data['materials']);
    }

    echo render_table($data['montaj_table_data']);

    if (!empty($data['work'])) {

        echo render_info_card($data['work']);
    }

    if (!empty($data['sum'])) {
        echo render_info_card($data['sum']);
        $show_form = true;
    }



    $message_body = render_grid_for_msg($data['calc_table_data']);
    $message_body .= ' ';
    $message_body .= $data['materials'];
    $message_body .= ' ';
    $message_body .= render_grid_for_msg($data['montaj_table_data']);
    $message_body .= ' ';
    $message_body .= $data['work'];
    $message_body .= ' ';
    $message_body .= $data['sum'];
}
// ==================== form end ====================
echo '</form>';
// ==================================================
if ($show_form) {
    echo do_shortcode(EPC_SC_CONTENT);
}
?>
<?php if (EPC_SC_ATTRS['contact_form_7']): ?>
    <script>
        (function ($) {
            $(document).ready(function ($) {
                $("#<?=EPC_SC_ATTRS['contact_form_7']?>").val(<?=json_encode((strip_tags($message_body)))?>);
            });
        }(jQuery));
    </script>
<?php endif; ?>
</div>
