<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Лабораторная работа №5</h4>
                <p class="card-category">СТАТИСТИЧЕСКАЯ ПРОВЕРКА ГИПОТЕЗЫ О РАВЕНСТВЕ ДИСПЕРСИЙ ДВУХ ГЕНЕРАЛЬНЫХ СОВОКУПНОСТЕЙ</p>
            </div>
            <div class="card-body">
                <form id="lab5-form" action="<?= \yii\helpers\Url::to(['/lab5']) ?>" method="post">
                    <div class="form-container form-horizontal">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Уровень значимости Альфа</label>
                                    <select name="alpha" class="form-control">
                                        <option value="0.01">0.01</option>
                                        <option value="0.05">0.05</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    Значение случайной величины X
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    Значение случайной величины Y
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="button" class="btn btn-info add-value">Добавить значение</button>
                        <button type="submit" class="btn btn-warning" data-loading-text="Loading..." autocomplete="off">Проверка</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="stats">
                </div>
            </div>
        </div>
    </div>
</div>