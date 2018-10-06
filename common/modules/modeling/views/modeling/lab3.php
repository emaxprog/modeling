<?php
/* @var $values array */
/* @var $ranges array */
/* @var $probabilities array */
?>
<div class="jumbotron">
    <h1>Лабораторная работа №3</h1>
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
    <table class="table table-striped">
        <caption>Теоретические частоты попадания случайной величины в интервалы</caption>
        <tr>
            <td>Границы интервалов</td>
            <?php foreach ($ranges as $range): ?>
                <td><?= $range ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <td>Теоретические частоты</td>
            <?php foreach ($probabilities as $probability): ?>
                <td><?= $probability ?></td>
            <?php endforeach; ?>
        </tr>
    </table>
</div>