<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

?>
<div class="jumbotron">
    <h1>Лабораторные работы</h1>
</div>
<div class="main">
    <?php for ($i = 1; $i <= 6; $i++) { ?>
        <a href="<?= Url::to(['/lab' . $i]) ?>" class="btn">Лабораторная работа №<?= $i ?></a>
    <?php } ?>
</div>
