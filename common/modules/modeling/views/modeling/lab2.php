<?php
/* @var $values array */
/* @var $isNormalLaw boolean */

?>
<div class="jumbotron">
    <h1>Лабораторная работа №2</h1>
</div>
<table class="table table-striped">
    <caption>Выборочные данные случайной величины</caption>
    <tr>
        <th>Номер опыта</th>
        <th>Наблюдаемые значения случайной величины</th>
    </tr>
    <?php foreach ($values as $key => $value): ?>
        <tr>
            <td><?= $key + 1 ?></td>
            <td><?= $value ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<div>
    Эмпирический закон случайной величины соответствует теоретическому нормальному закону по значениям коэффициента асимметрии и эксцесса : <?= $isNormalLaw ? 'Да' : 'Нет'; ?>
</div>