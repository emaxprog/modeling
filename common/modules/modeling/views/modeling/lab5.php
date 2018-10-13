<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Лабораторная работа №1</h4>
                <p class="card-category">ОЦЕНКА ЧИСЛОВЫХ ХАРАКТЕРИСТИК СЛУЧАЙНЫХ ВЕЛИЧИН И ПОСТРОЕНИЕ ЭМПИРИЧЕСКИХ ЗАКОНОВ ИХ РАСПРЕДЕЛЕНИЯ</p>
            </div>
            <div class="card-body">
                <form id="random-value-form-multiple" action="<?= \yii\helpers\Url::to(['/lab1']) ?>" method="post" enctype='multipart/form-data'>
                    <div class="random-values-container form-horizontal">
                        <div class="random-values"></div>
                        <div class="button-container">
                            <button type="button" class="btn btn-info add-value" data-random-values="1">Добавить значение</button>
                            <button type="submit" class="btn btn-warning" data-loading-text="Loading..." autocomplete="off">Моделирование</button>
                        </div>
                    </div>
                    <div class="random-values-container form-horizontal">
                        <div class="random-values"></div>
                        <div class="button-container">
                            <button type="button" class="btn btn-info add-value"data-random-values="2">Добавить значение</button>
                            <button type="submit" class="btn btn-warning" data-loading-text="Loading..." autocomplete="off">Моделирование</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>