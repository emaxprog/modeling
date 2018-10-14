<?php
/* @var $values array */
/* @var $isNormalLaw boolean */

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Лабораторная работа №2</h4>
                <p class="card-category">СТАТИСТИЧЕСКАЯ ПРОВЕРКА ГЕПОТЕЗЫ О ЗАКОНЕ РАСПРЕДЕЛЕНИЯ СЛУЧАЙНОЙ ВЕЛИЧИНЫ С ПОМОЩЬЮ КОЭФФИЦИЕНТА АСИМЕТРИИ А И ЭКСЦЕССА Е</p>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="card card-plain">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title mt-0">Эмпирический закон распределения случайной величины</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="text-dark">
                                    <th>Номер опыта</th>
                                    <th>Наблюдаемые значения случайной величины</th>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($values as $key => $value): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">info</i> Эмпирический закон случайной величины <?= $isNormalLaw ? '' : ' НЕ'; ?> СООТВЕТСТВУЕТ теоретическому нормальному закону по значениям коэффициента асимметрии и эксцесса.
                </div>
            </div>
        </div>
    </div>
</div>