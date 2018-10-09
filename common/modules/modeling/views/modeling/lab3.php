<?php
/* @var $values array */
/* @var $ranges array */
/* @var $probabilities array */
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Лабораторная работа №3</h4>
                <p class="card-category">ВЫЧИСЛЕНИЕ ВЕРОЯТНОСТИ ПОПАДАНИЯ СЛУЧАЙНОЙ ВЕЛИЧИНЫ РАСПРЕДЕЛЕННОЙ ПО НОРМАЛЬНОМУ ЗАКОНУ, НА ЗАДАННЫЙ УЧАСТОК</p>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="card card-plain">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title mt-0">Выборочные данные случайной величины</h4>
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
                <div class="col-md-12">
                    <div class="card card-plain">
                        <div class="card-header card-header-danger">
                            <h4 class="card-title mt-0">Теоретические частоты попадания случайной величины в интервалы</h4>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>