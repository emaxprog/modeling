<div class="jumbotron">
    <h1>Лабораторная работа №1</h1>
</div>
<form id="random-value-form" action="<?= \yii\helpers\Url::to(['/lab1']) ?>" method="post" enctype='multipart/form-data'>
    <div class="form-container form-horizontal"></div>
    <div class="button-container">
        <button type="button" class="btn btn-info add-value">Добавить значение</button>
        <button type="submit" class="btn btn-primary" data-loading-text="Loading..." autocomplete="off">Моделирование</button>
    </div>
</form>

<div class="chart__container">
    <div id="statistic-range-chart"></div>
    <div id="statistic-function-chart"></div>
</div>