<?php
$error_msg = isset($message) ? $message : '';
?>

<div class="alert alert-warning text-center">
    <h3>Извините, что-то пошло не так...</h3>
    <?php if ($error_msg): ?>
        <p><?= $error_msg ?></p>
    <?php else: ?>
        <p>Пожалуйста, попробуйте позже.</p>
    <?php endif; ?>
</div>
