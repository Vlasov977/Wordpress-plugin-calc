

<?php
if (count($data)) {
    ?>
===========================================================
| Наименование | Единица измерения | Количество | Стоимость | Сумма |
===========================================================
<?php
    foreach ($data as $i) {
        $count_field = $i['count'];
        $name = isset($count_field['name']) ? $count_field['name'] : null;
        $value = isset($count_field['value']) ? $count_field['value'] : null;
?>| <?= isset($i['label']) ? $i['label'] : ''; ?> | <?= isset($i['unit']) ? $i['unit'] : '' ?> | <?php if ($name): ?><?= $value ?><?php else: ?><?= $count_field ?><?php endif; ?> | <?= isset($i['price']) ? $i['price'] : '' ?> | <?= isset($i['sum']) ? $i['sum'] : '' ?> |
--------------------------------------------------------------------------------------------------------
<?php
    }
}?>

