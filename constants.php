<?php
define('EPC_BASE_URL', 'http://www.evropa-pol.ru/kalkulyator-suhoy-styazhki-zakazhite-suhuyu-styazhku-s-kalkulyatora');

define('EPC_AJAX_URL', 'http://www.evropa-pol.ru/system/ajax');

define('EPC_VIEWS_DIR', plugin_dir_path(__FILE__) . '/views');

define('EPC_FORM_FLOOR_ELEMS', [
    ['knauf', 'Элементы пола Knauf (Германия)'],
    ['gsp', 'Элементы пола ГСП (Россия)']
]);

define('EPC_FORM_BACKFILLING_ELEMS', [
    ['komp', 'Засыпка Компэвит 40 литров'],
    ['knauf', 'Засыпка KNAUF лицензионная 40 литров'],
    ['ker', 'Засыпка Керафлор 40 литров'],
    ['akz', 'Засыпка Гранулин (пеностекло) 40 литров'],
    ['rds', 'Засыпка РДС 50 литров'],
    ['noname_30', 'Засыпка Рязань 30 литров'],
    ['noname_36', 'Куровская засыпка 40 литров']
]);

define('EPC_FORM_TOOLS_ELEMS', [
    ['base_0', 'Базовый Мини'],
    ['base_1', 'Базовый №1'],
    ['base_2', 'Базовый №2'],
    ['base_3', 'Базовый №3'],
    ['prof_1', 'Профи №1'],
    ['prof_2', 'Профи №2'],
    ['prof_3', 'Профи №3']
]);

define('EPC_FORM_FLOOR_DISASSEMBLING_ELEMS', [
    ['ploschat_1', 'Деревянный пол на лагах (без сбора песка)'],
    ['ploschat_2', 'Деревянный пол на лагах (с удалением песка)'],
    ['ploschat_3', 'Штучный паркет, массив'],
    ['ploschat_4', 'Ламинат, паркетная доска'],
    ['ploschat_5', 'Линолеум, ковралин на клеевой основе'],
    ['ploschat_6', 'Линолеум, ковралин без клея'],
    ['ploschat_7', 'Керамическая плитка'],
    ['ploschat_8', 'Бетонная стяжка до 5см'],
    ['ploschat_9', 'Бетонная стяжка до 8см'],
    ['ploschat_10', 'Плинтус'],

]);

define('EPC_FIELDS', [
    'raschet',
    'ploschat',
    'type_elem_pol',
    'type_zas',
    'sloi_zas',
    'ukrep_list',
    'plenka_lenta',
    'tool',
    'tool_list',
    'uplot_instrum',
    'razg_mat',
    'lift',
    'lift_etaju',
    'dostavka',
    'dostavka_mkad',
    'old_floor',
    'old_floor_var',
    'ploschat_1',
    'ploschat_2',
    'ploschat_3',
    'ploschat_4',
    'ploschat_5',
    'ploschat_6',
    'ploschat_7',
    'ploschat_8',
    'ploschat_9',
    'ploschat_10'
]);


define('EPC_RECOUNT_FIELDS', [
    'gvl',
    'fanera',
    'zasupka',
    'gkl',
    'clei',
    'lenta',
    'pena',
    'shyryp_gvl',
    'plenka',
]);

?>
