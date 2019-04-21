<?php
$data = isset($data) ? $data : [];
if ($data) {
    ?>
    <div class="pl-0 pr-0 rounded bg-light table-responsive justify-content-center">
        <table class="table table-hover w-100 epc-table-responsive">
            <thead>
            <tr>
                <th class="d-none d-sm-table-cell">Наименование</th>
                <th class="d-none d-sm-table-cell">Единица измерения</th>
                <th class="d-none d-sm-table-cell">Количество</th>
                <th class="d-none d-sm-table-cell">Стоимость</th>
                <th class="d-none d-sm-table-cell">Сумма</th>

                <th class="d-table-cell d-sm-none p-0 pb-1 pt-1">Наим.</th>
                <th class="d-table-cell d-sm-none p-0 pb-1 pt-1">Ед. измерения</th>
                <th class="d-table-cell d-sm-none p-0 pb-1 pt-1">Кол-во</th>
                <th class="d-table-cell d-sm-none p-0 pb-1 pt-1">Стоимость</th>
                <th class="d-table-cell d-sm-none p-0 pb-1 pt-1">Сум.</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $i) {
                $count_field = $i['count'];
                $name = isset($count_field['name']) ? $count_field['name'] : null;
                $value = isset($count_field['value']) ? $count_field['value'] : null;
                ?>
                <tr>

                    <td class="p-0 pb-1 pt-1 p-sm-2"><?= isset($i['label']) ? $i['label'] : ''; ?></td>
                    <td class="p-0 pb-1 pt-1 p-sm-2"><?= isset($i['unit']) ? $i['unit'] : ''; ?></td>
                    <td class="p-0 pb-1 pt-1 p-sm-2">
                        <?php if ($name): ?>
                            <input class="w-100 pr-0 pl-1 pt-1 pb-1" type="text" name="<?= $name ?>" value="<?= $value ?>">
                        <?php else: ?>
                            <?= $count_field ?>
                        <?php endif; ?>
                    </td>
                    <td class="p-0 pb-1 pt-1 p-sm-2"><?= isset($i['price']) ? $i['price'] : ''; ?></td>
                    <td class="p-0 pb-1 pt-1 p-sm-2"><?= isset($i['sum']) ? $i['sum'] : ''; ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
}