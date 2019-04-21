<?php
$data = isset($data) ? $data : [];
if (count($data)) {
    ?>
    <table>
    <thead>
    <tr>
        <th><br>Наименование</br></th>
        <th><br>Единица измерения</br></th>
        <th><br>Количество</br></th>
        <th><br>Стоимость</br></th>
        <th><br>Сумма</br></th>
    </tr>
    </thead>
    <tbody><?php
    foreach ($data as $i) {
        $count_field = $i['count'];
        $name = isset($count_field['name']) ? $count_field['name'] : null;
        $value = isset($count_field['value']) ? $count_field['value'] : null;
        ?>
        <tr>
        <td><?= isset($i['label']) ? $i['label'] : ''; ?></td>
        <td><?= isset($i['unit']) ? $i['unit'] : '' ?></td>
        <td><?php if ($name): ?><?= $value ?><?php else: ?><?= $count_field ?><?php endif; ?></td>
        <td><?= isset($i['price']) ? $i['price'] : '' ?></td>
        <td><?= isset($i['sum']) ? $i['sum'] : '' ?></td></tr><?php
    }
    ?></tbody></table><?php
}


