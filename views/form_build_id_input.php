<?php
$form_build_id = isset($form_build_id) ? $form_build_id : '';
if ($form_build_id) {
    ?>
    <input type="hidden" name="form_build_id" value="<?= $form_build_id ?>">
    <?php
}
?>