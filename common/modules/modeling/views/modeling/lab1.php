<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Лабораторная работа №1</h4>
                <p class="card-category">ОЦЕНКА ЧИСЛОВЫХ ХАРАКТЕРИСТИК СЛУЧАЙНЫХ ВЕЛИЧИН И ПОСТРОЕНИЕ ЭМПИРИЧЕСКИХ ЗАКОНОВ ИХ РАСПРЕДЕЛЕНИЯ</p>
            </div>
            <div class="card-body">
                <form id="lab1-form" action="<?= \yii\helpers\Url::to(['/lab1']) ?>" method="post" enctype='multipart/form-data'>
                    <div class="form-container form-horizontal"></div>
                    <div class="button-container">
                        <button type="button" class="btn btn-info add-value">Добавить значение</button>
                        <button type="submit" class="btn btn-warning" data-loading-text="Loading..." autocomplete="off">Моделирование</button>
                    </div>
                </form>

                <div class="chart__container">
                    <div id="statistic-range-chart"></div>
                    <div id="statistic-function-chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>