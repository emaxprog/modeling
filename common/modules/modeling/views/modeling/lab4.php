<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Лабораторная работа №4</h4>
                <p class="card-category">СТАТИСТИЧЕСКАЯ ПРОВЕРКА ГИПОТЕЗЫ О ЗАКОНЕ РАСПРЕДЕЛЕНИЯ СЛУЧАЙНЫХ ВЕЛИЧИН ПО КРИТЕРИЮ СОГЛАСИЯ (КРИТЕРИЮ ПИРСОНА)</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="card-header card-header-danger">
                                <h4 class="card-title mt-0">Теоретические и эмпирические частоты попадания случайной величины в заданные интервалы</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="">
                                        <tbody>
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
                                        <tr>
                                            <td>Эмипирические частоты</td>
                                            <?php foreach ($frequencies as $frequency): ?>
                                                <td><?= $frequency ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <form id="lab4-form" action="<?= \yii\helpers\Url::to(['/lab4']) ?>" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Уровень значимости Альфа</label>
                                <select name="alpha" class="form-control">
                                    <option value="0.01">0.01</option>
                                    <option value="0.025">0.025</option>
                                    <option value="0.05">0.05</option>
                                    <option value="0.95">0.95</option>
                                    <option value="0.975">0.975</option>
                                    <option value="0.99">0.99</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
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