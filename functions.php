<?php

function get_form_build_id($html)
{
    $form_build_id = $html->find('input[name="form_build_id"]', 0);
    if ($form_build_id) {
        return $form_build_id->value;
    }
    return null;
}


function data_to_html($data)
{
    // Create a DOM object
    $html = new simple_html_dom();
    // Load HTML from a string
    $html->load($data);
    $html = str_get_html($html);
    return $html;
}

// ==============================================


function get_table_rows_with_t_cls($html, $cls)
{
    if (!($html instanceof simple_html_dom_node)) {
        return null;
    }
    $table = $html->find('table[class="' . $cls . '"]', 0);
    if (!$table) {
        return null;
    }
    $tbody = $table->find('tbody', 0);
    if (!$tbody) {
        return null;
    }
    return $tbody->find('tr');
}

function get_table_data($nodes)
{
    $data = [];
    foreach ($nodes as $node) {
        $item = [];

        $label = $node->find('td[class="label"]', 0);
        $unit = $node->find('td[class="ed_izm"]', 0);
        $count = $node->find('td[class="count"]', 0);
        $price = $node->find('td[class="price"]', 0);
        $sum = $node->find('td[class="price_sum"]', 0);

        $item['label'] = $label ? $label->plaintext : '';
        $item['unit'] = $unit ? $unit->plaintext : '';
        $item['count'] = $count ? $count->plaintext : '';
        $item['price'] = $price ? $price->plaintext : '';
        $item['sum'] = $sum ? $sum->plaintext : '';

        $data[] = $item;
    }
    return $data;
}

function get_table_data_with_inputs($nodes)
{
    foreach ($nodes as $node) {
        $item = [];
        $label = $node->find('td[class="label"]', 0);
        $unit = $node->find('td[class="ed_izm"]', 0);
        $price = $node->find('td[class="price"]', 0);
        $sum = $node->find('td[class="price_sum"]', 0);

        $item['label'] = $label ? $label->plaintext : '';
        $item['unit'] = $unit ? $unit->plaintext : '';
        $item['price'] = $price ? $price->plaintext : '';
        $item['sum'] = $sum ? $sum->plaintext : '';

        $input = $node->find('input', 0);
        if ($input) {
            $item['count'] = [
                'name' => $input->name,
                'value' => $input->value,
            ];
        } else {
            $count = $node->find('td[class="count"]', 0);
            $item['count'] = $count ? $count->plaintext : '';
        }

        $data[] = $item;

    }
    return $data;
}


function get_data_ajax_response($arr)
{
    $data = [];
    if (is_array($arr)) {
        foreach ($arr as $elem) {
            $method = $elem->method;
            $command = $elem->command;
            if (!isset($method) and $command == 'insert') {
                $data = $elem->data;
                if ($data) {
                    break;
                }
            }
        }
    }
    return $data;
}


function get_all($html)
{
    $data = [];
    $node = $html->find('#calc_tables', 0);

    if ($node) {
        $montaj_table_rows = get_table_rows_with_t_cls($node, 'montaj_table');
        $data['montaj_table_data'] = $montaj_table_rows ? get_table_data($montaj_table_rows) : [];

        $calc_table_rows = get_table_rows_with_t_cls($node, 'calc_table');
        $data['calc_table_data'] = $calc_table_rows ? get_table_data_with_inputs($calc_table_rows) : [];

        $materials = $node->find('*[class="total_materials"]', 0);
        $data['materials'] = $materials ? $materials->plaintext : '';

        $work = $node->find('*[class="total_materials"]', 1);
        $data['work'] = $work ? $work->plaintext : '';

        $sum_node = $node->find('*[class="total_all_text"]', 0);
        $sum_text_cont = $sum_node ? $sum_node->find('div[!class]', 0) : null;
        $data['sum'] = $sum_text_cont ? $sum_text_cont->plaintext : '';

    }
    return $data;
}

function main_parsing($response)
{
    $data = get_data_ajax_response(json_decode($response));

    if ($data) {
        $html = data_to_html($data);
        return get_all($html);
    }
    return [];
}

function post_request_epc($url, $post_fields, $proxy, $proxy_auth)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);

    if ($proxy) {
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
    }
    if ($proxy and $proxy_auth) {
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_auth);
    }

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

function get_request_epc($url, $proxy, $proxy_auth)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_URL, $url);


    if ($proxy) {
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
    }
    if ($proxy and $proxy_auth) {
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_auth);
    }

    $response = curl_exec($ch);

    curl_close($ch);
    return $response;
}


function epc_error($msg)
{
    $message = $msg;
    ob_start();
    require EPC_VIEWS_DIR . '/error.php';
    echo ob_get_clean();
}

function render_info_card($message)
{
    ob_start();
    require EPC_VIEWS_DIR . '/info_card.php';
    return ob_get_clean();
}


function render_table($data)
{
    $data = is_array($data) ? $data : [];
    ob_start();
    require EPC_VIEWS_DIR . '/table.php';
    return ob_get_clean();
}

function render_table_for_msg($data)
{
    $data = is_array($data) ? $data : [];
    ob_start();
    require EPC_VIEWS_DIR . '/message_table.php';
    return ob_get_clean();
}

function render_grid_for_msg($data)
{
    $data = is_array($data) ? $data : [];
    ob_start();
    require EPC_VIEWS_DIR . '/message_table_custom_grid.php';
    return ob_get_clean();
}

function render_recount_button($trigger)
{
    ob_start();
    require EPC_VIEWS_DIR . '/recount_button.php';
    return ob_get_clean();
}
