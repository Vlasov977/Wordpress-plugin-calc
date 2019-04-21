<?php
$title = EPC_SC_ATTRS['title'];
?>
<div class="row justify-content-center pl-0 pr-0 mb-3 mr-0 ml-0 rounded bg-light border">

    <?php if ($title): ?>
        <div class="form-row border-bottom col-12 p-2 pt-3 justify-content-center"><h3><?= esc_html($title) ?></h3>
        </div>
    <?php endif; ?>

    <div class="form-row border-bottom col-12 pt-2 pb-3">
        <div class="col-md-6 col-sm-12">Выполнить расчет материала для сухой стяжки:</div>
        <div class="col-md-6 col-sm-12">
            <?php
            $checked = isset($_POST['raschet']) ? $_POST['raschet'] : '1';
            ?>
            <div class="form-check form-check-inline">
                <input class="form-check-input epc-radio-trigger--js
                    <?php if ($checked == '1'): ?>
                        epc-radio-trigger-onload--js
                    <?php endif; ?>"
                       type="radio" id="epc_raschet1"
                       name="raschet" value="1"
                       data-trigger-id="raschet" data-trigger-status="true"
                    <?php if ($checked == '1'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_raschet1">Материал с монтажом сухой
                    стяжки</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input epc-radio-trigger--js
                    <?php if ($checked == '0'): ?>
                        epc-radio-trigger-onload--js
                    <?php endif; ?>"
                       type="radio" id="epc_raschet0"
                       name="raschet" value="0"
                       data-trigger-id="raschet" data-trigger-status="false"
                    <?php if ($checked == '0'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_raschet0">Материал без монтажа сухой
                    стяжки</label>
            </div>
        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3">
        <div class="col-md-6 col-sm-12">
            <label class="font-weight-normal" for="epc_ploschat">Укажите площадь помещения без запаса:</label>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="input-group">
                <input type="text" class="form-control" id="epc_ploschat"
                       name="ploschat" value="<?= isset($_POST['ploschat']) ? $_POST['ploschat'] : '' ?>">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-white rounded-right">м&sup2;</div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3">
        <div class="col-md-6 col-sm-12">
            <label class="font-weight-normal" for="epc_type_elem_pol">Выбрать тип элементов пола:</label>
        </div>
        <div class="col-md-6 col-sm-12">
            <select class="custom-select" name="type_elem_pol" id="epc_type_elem_pol">
                <?php
                $selected = isset($_POST['type_elem_pol']) ? $_POST['type_elem_pol'] : '';
                foreach (EPC_FORM_FLOOR_ELEMS as $elem) {
                    ?>
                    <option value="<?= $elem[0] ?>"
                        <?php if ($selected == $elem[0]): ?>
                            selected
                        <?php endif; ?>><?= $elem[1] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3">
        <div class="col-md-6 col-sm-12">
            <label class="font-weight-normal" for="epc_type_zas">Выбрать тип сухой засыпки:</label>
        </div>
        <div class="col-md-6 col-sm-12">
            <select class="custom-select" id="epc_type_zas" name="type_zas">
                <?php
                $selected = isset($_POST['type_zas']) ? $_POST['type_zas'] : '';
                foreach (EPC_FORM_BACKFILLING_ELEMS as $elem) {
                    ?>
                    <option value="<?= $elem[0] ?>"
                        <?php if ($selected == $elem[0]): ?>
                            selected
                        <?php endif; ?>><?= $elem[1] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3">
        <div class="col-md-6 col-sm-12">
            <label class="font-weight-normal" for="epc_sloi_zas">Укажите толщину сухой стяжки, вместе с элементами
                пола:</label>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control"
                           name="sloi_zas" id="epc_sloi_zas"
                           value="<?= isset($_POST['sloi_zas']) ? $_POST['sloi_zas'] : '' ?>">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-white rounded-right">см (от 4 до 36)</div>
                    </div>
                </div>
                <div>сухая засыпка + элементы пола</div>
            </div>
        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3">
        <div class="col-md-6 col-sm-12">Дополнительная жесткость сухой стяжки:</div>
        <div class="col-md-6 col-sm-12">
            <?php
            $checked = isset($_POST['ukrep_list']) ? $_POST['ukrep_list'] : 'none';
            ?>
            <div class="form-check form-check-inline ecp-limited--js">
                <input class="form-check-input" type="radio"
                       name="ukrep_list" id="epc_ukrep_list1"
                       value="none"
                    <?php if ($checked == 'none'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_ukrep_list1">Не нужна</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"
                       name="ukrep_list" id="epc_ukrep_list2"
                       value="gvlv"
                    <?php if ($checked == 'gvlv'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_ukrep_list2">Лист ГВЛВ 10мм</label>
            </div>
            <div class="form-check form-check-inline ecp-limited--js">
                <input class="form-check-input" type="radio"
                       name="ukrep_list" id="epc_ukrep_list3"
                       value="fanera"
                    <?php if ($checked == 'fanera'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_ukrep_list3">Лист фанеры 10мм</label>
            </div>
        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3">
        <div class="col-md-6 col-sm-12">Периметр помещения:</div>
        <div class="col-md-6 col-sm-12">
            <?php
            $post_values = isset($_POST['plenka_lenta']) ? $_POST['plenka_lenta'] : [];
            $fields = [['lenta', 'Кромочная лента'], ['pena', 'Монтажная пена']];
            foreach ($fields as $field) {
                ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox"
                           id="epc_plenka_lenta_<?= $field[0] ?>" name="plenka_lenta[]"
                           value="<?= $field[0] ?>"
                        <?php if (in_array($field[0], $post_values)): ?>
                            checked
                        <?php elseif (!count($post_values) and $field[0] == 'lenta'): ?>
                            checked
                        <?php endif; ?>>
                    <label class="form-check-label font-weight-normal" for="epc_plenka_lenta_<?= $field[0] ?>">
                        <?= $field[1] ?>
                    </label>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3 epc-radio-elem--js"
         data-elem-id="raschet" data-elem-status="false">
        <?php
        $checked = isset($_POST['tool']) ? $_POST['tool'] : '0';
        ?>
        <div class="col-md-6 col-sm-12">Инструмент для сухой стяжки Кнауф:</div>
        <div class="col-md-6 col-sm-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tool" id="tool1"
                       value="1"
                    <?php if ($checked == '1'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="tool1">Нужен</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tool" id="tool0"
                       value="0"
                    <?php if ($checked == '0'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="tool0">Не нужен</label>
            </div>

        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3 epc-radio-elem--js"
         data-elem-id="raschet" data-elem-status="false">
        <div class="col-md-6 col-sm-12">
            <label class="font-weight-normal" for="epc_tool_list">Инструмент:</label>
        </div>
        <div class="col-md-6 col-sm-12">
            <select name="tool_list" id="epc_tool_list" class="custom-select">
                <?php
                $selected = isset($_POST['tool_list']) ? $_POST['tool_list'] : '';
                foreach (EPC_FORM_TOOLS_ELEMS as $elem) {
                    ?>
                    <option value="<?= $elem[0] ?>"
                        <?php if ($selected == $elem[0]): ?>
                            selected
                        <?php endif; ?>><?= $elem[1] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3 epc-radio-elem--js"
         data-elem-id="raschet" data-elem-status="false">
        <?php
        $checked = isset($_POST['uplot_instrum']) ? $_POST['uplot_instrum'] : '0';
        ?>
        <div class="col-md-6 col-sm-12">Уплотнительный инструмент для засыпки:</div>
        <div class="col-md-6 col-sm-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="uplot_instrum" id="epc_uplot_instrum1"
                       value="1"
                    <?php if ($checked == '1'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_uplot_instrum1">Нужен</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="uplot_instrum" id="epc_uplot_instrum0"
                       value="0"
                    <?php if ($checked == '0'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_uplot_instrum0">Не нужен</label>
            </div>

        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3">
        <div class="col-md-6 col-sm-12">Разгрузка материала на объект (в квартиру):</div>
        <?php
        $checked = isset($_POST['razg_mat']) ? $_POST['razg_mat'] : '0';
        ?>
        <div class="col-md-6 col-sm-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="razg_mat" id="epc_razg_mat1"
                       value="1"
                    <?php if ($checked == '1'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_razg_mat1">Нужна</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="razg_mat" id="epc_razg_mat0"
                       value="0"
                    <?php if ($checked == '0'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_razg_mat0">Не нужна</label>
            </div>
        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3">
        <div class="col-md-6 col-sm-12">
            <label class="font-weight-normal" for="epc_lift_etaju">Наличие лифта</label>
        </div>
        <?php
        $checked = isset($_POST['lift']) ? $_POST['lift'] : '1';
        ?>
        <div class="col-md-6 col-sm-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input epc-radio-trigger--js
                    <?php if ($checked == '1'): ?>
                        epc-radio-trigger-load--js
                    <?php endif; ?>"
                       type="radio" id="epc_lift1"
                       name="lift" value="1"
                       data-trigger-id="lift" data-trigger-status="true"
                    <?php if ($checked == '1'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_lift1">Есть</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input epc-radio-trigger--js
                    <?php if ($checked == '0'): ?>
                        epc-radio-trigger-load--js
                    <?php endif; ?>"
                       type="radio" id="epc_lift0"
                       name="lift" value="0"
                       data-trigger-id="lift" data-trigger-status="false"
                    <?php if ($checked == '0'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_lift0">Нет</label>
            </div>
            <div class="form-check form-check-inline epc-radio-elem--js"
                 data-elem-id="lift" data-elem-status="false">
                <select class="custom-select" name="lift_etaju" id="epc_lift_etaju">
                    <?php
                    for ($i = 2; $i < 9; ++$i) {
                        ?>
                        <option value="<?= $i ?>"><?= $i ?> этаж</option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3">
        <div class="col-md-6 col-sm-12">Доставка материала:</div>
        <?php
        $checked = isset($_POST['dostavka']) ? $_POST['dostavka'] : 'none';
        ?>
        <div class="col-md-6 col-sm-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input epc-radio-trigger--js
                    <?php if ($checked == 'none'): ?>
                        epc-radio-trigger-load--js
                    <?php endif; ?>"
                       type="radio" id="epc_dostavka1"
                       name="dostavka" value="none"
                       data-trigger-id="dostavka" data-trigger-status="false"
                    <?php if ($checked == 'none'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_dostavka1">Самовывоз со склада</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input epc-radio-trigger--js
                    <?php if ($checked == 'za_3'): ?>
                        epc-radio-trigger-load--js
                    <?php endif; ?>"
                       type="radio" id="epc_dostavka2"
                       name="dostavka" value="za_3"
                       data-trigger-id="dostavka" data-trigger-status="false"
                    <?php if ($checked == 'za_3'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_dostavka2">
                    Доставка материала за 3-е кольцо (Москва центр)
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input epc-radio-trigger--js
                    <?php if ($checked == 'do_3'): ?>
                        epc-radio-trigger-load--js
                    <?php endif; ?>"
                       type="radio" id="epc_dostavka3"
                       name="dostavka" value="do_3"
                       data-trigger-id="dostavka" data-trigger-status="false"
                    <?php if ($checked == 'do_3'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_dostavka3">
                    Доставка материала до 3-го кольца (Москва)
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input  epc-radio-trigger--js
                    <?php if ($checked == 'za_mkad'): ?>
                        epc-radio-trigger-load--js
                    <?php endif; ?>"
                       type="radio" id="epc_dostavka4"
                       name="dostavka" value="za_mkad"
                       data-trigger-id="dostavka" data-trigger-status="true"
                    <?php if ($checked == 'za_mkad'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_dostavka4">
                    Доставка материала в Московскую область
                </label>
            </div>
        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3 epc-radio-elem--js"
         data-elem-id="dostavka" data-elem-status="true">
        <div class="col-md-6 col-sm-12">
            <label class="font-weight-normal" for="epc_dostavka_mkad">Расстояние от МКАД:</label>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="input-group">
                <input type="text" class="form-control"
                       name="dostavka_mkad" id="epc_dostavka_mkad"
                       value="<?= isset($_POST['dostavka_mkad']) ? $_POST['dostavka_mkad'] : '' ?>">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-white rounded-right">км</div>
                </div>
            </div>

        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3 epc-radio-elem--js"
         data-elem-id="raschet" data-elem-status="true">
        <div class="col-md-6 col-sm-12">Демонтаж пола:</div>
        <?php
        $checked = isset($_POST['old_floor']) ? $_POST['old_floor'] : '0';
        ?>
        <div class="col-md-6 col-sm-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input epc-radio-trigger--js
                    <?php if ($checked == '0'): ?>
                        epc-radio-trigger-load--js
                    <?php endif; ?>"
                       type="radio" id="epc_old_floor0"
                       name="old_floor" value="0"
                       data-trigger-status="false" data-trigger-id="old_floor"
                    <?php if ($checked == '0'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_old_floor0">Не нужен</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input epc-radio-trigger--js
                    <?php if ($checked == '1'): ?>
                        epc-radio-trigger-load--js
                    <?php endif; ?>"
                       type="radio" id="epc_old_floor1"
                       name="old_floor" value="1"
                       data-trigger-status="true" data-trigger-id="old_floor"
                    <?php if ($checked == '1'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_old_floor1">Нужен</label>
            </div>
        </div>
    </div>

    <div class="form-row border-bottom col-12 pt-2 pb-3 epc-radio-elem--js"
         data-elem-id="old_floor" data-elem-status="true">
        <div class="col-md-6 col-sm-12">Выбрать вариант:</div>
        <?php
        $checked = isset($_POST['old_floor_var']) ? $_POST['old_floor_var'] : '0';
        ?>
        <div class="col-md-6 col-sm-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="old_floor_var" id="epc_old_floor_var0"
                       value="0"
                    <?php if ($checked == '0'): ?>
                    checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_old_floor_var0">На улицу</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="old_floor_var" id="epc_old_floor_var1"
                       value="1"
                    <?php if ($checked == '1'): ?>
                        checked
                    <?php endif; ?>>
                <label class="form-check-label font-weight-normal" for="epc_old_floor_var1">На лестницу</label>
            </div>
        </div>
    </div>

    <?php
    foreach (EPC_FORM_FLOOR_DISASSEMBLING_ELEMS as $elem) {
        ?>
        <div class="form-row border-bottom col-12 pt-2 pb-3 epc-radio-elem--js"
             data-elem-id="old_floor" data-elem-status="true">
            <div class="col-md-6 col-sm-12">
                <label class="font-weight-normal" for="epc_<?= $elem[0] ?>"><?= $elem[1] ?>:</label>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control"
                           id="epc_<?= $elem[0] ?>" name="<?= $elem[0] ?>"
                           value="<?= isset($_POST[$elem[0]]) ? $_POST[$elem[0]] : '' ?>">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-white rounded-right">м&sup2;</div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <button class="col btn btn-outline-primary btn-submit-epc--js" type="submit" name="epc_action" value="submit">
        Рассчитать стоимость
    </button>
    <a id="epc_form_results"></a>
</div>