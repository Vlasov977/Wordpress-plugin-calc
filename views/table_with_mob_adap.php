<?php
$data = isset($data) ? $data : [];
if (count($data)) {
    ?>
    <div class="col pl-0 pr-0 rounded bg-light table-responsive justify-content-center">
        <table class="table table-hover w-100 d-block d-sm-table epc-font-size-sm epc-table-font-size">
            <thead class="">
            <tr>
                <th class="d-none d-sm-table-cell p-1 p-sm-3">Наименование</th>
                <th class="d-none d-sm-table-cell p-1 p-sm-3">Единица измерения</th>
                <th class="p-1 p-sm-3 w-auto col-6">Количество</th>
                <th class="p-1 p-sm-3 w-auto col-6 col-sm-auto">Стоимость</th>
                <th class="d-none d-sm-table-cell p-1 p-sm-3">Сумма</th>
            </tr>
            </thead>
            <tbody class="">
            <?php
            foreach ($data as $i) {
                $count_field = $i['count'];
                $name = isset($count_field['name']) ? $count_field['name'] : null;
                $value = isset($count_field['value']) ? $count_field['value'] : null;
                ?>
                <tr>

                    <td class="d-none d-sm-table-cell p-1 p-sm-3"><?= isset($i['label']) ? $i['label'] : ''; ?></td>
                    <td class="d-none d-sm-table-cell p-1 p-sm-3"><?= isset($i['unit']) ? $i['unit'] : '' ?></td>

                    <td class="d-table-cell p-1 p-sm-3">
                        <div class="d-block d-sm-none"><?= isset($i['label']) ? $i['label'] : ''; ?></div>
                        <?php if ($name): ?>
                            <div class="input-group input-group-sm mb-1 mb-sm-3">
                                <input class="form-control w-100" type="text" name="<?= $name ?>" value="<?= $value ?>">
                                <small class="form-text text-muted d-table-cell d-sm-none epc-font-size-13"><?= isset($i['unit']) ? $i['unit'] : '' ?></small>
                            </div>
                        <?php else: ?>
                            <b class="d-block d-sm-none"><?= $count_field ?></b>
                            <p class="d-none d-sm-block"><?= $count_field ?></p>
                        <?php endif; ?>
                    </td>

                    <td class="d-table-cell epc-w-50-auto d-sm-none p-1 p-sm-3">
                        <div class="text-nowrap"><?= isset($i['price']) ? $i['price'] : '' ?></div>
                        <div class="text-nowrap">X <?= $value ? $value : $count_field ?> =</div>
                        <div class="text-nowrap"><b><?= isset($i['sum']) ? $i['sum'] : '' ?></b></div>
                    </td>

                    <td class="d-none d-sm-table-cell p-1 p-sm-3"><?= isset($i['price']) ? $i['price'] : '' ?></td>
                    <td class="d-none d-sm-table-cell p-1 p-sm-3"><?= isset($i['sum']) ? $i['sum'] : '' ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
}