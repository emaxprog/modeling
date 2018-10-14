<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Лабораторная работа №5</h4>
                <p class="card-category">СТАТИСТИЧЕСКАЯ ПРОВЕРКА ГИПОТЕЗЫ О РАВЕНСТВЕ ДИСПЕРСИЙ ДВУХ ГЕНЕРАЛЬНЫХ СОВОКУПНОСТЕЙ</p>
            </div>
            <div class="card-body">
                <form id="lab6-form" action="<?= \yii\helpers\Url::to(['/lab6']) ?>" method="post">
                    <div class="form-container form-horizontal">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    Значение случайной величины X
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    Значение случайной величины Y
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    Значение случайной величины Z
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="button" class="btn btn-info add-value">Добавить значение</button>
                        <button type="submit" class="btn btn-warning" data-loading-text="Loading..." autocomplete="off">Проверка</button>
                    </div>
                </form>
                <div class="matrix"></div>
            </div>
        </div>
    </div>
</div>