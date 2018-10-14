<?php
/* @var $coefficients array */

?>
<div class="col-md-12">
    <div class="card card-plain">
        <div class="card-header card-header-danger">
            <h4 class="card-title mt-0">Матрица коэффициентов парных корреляций</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="table-responsive">
                        <table>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>||</td>
                                <td style="text-align: center">1</td>
                                <td style="text-align: center"><?= $coefficients['x-y'] ?></td>
                                <td style="text-align: center"><?= $coefficients['x-z'] ?></td>
                                <td>||</td>
                            </tr>
                            <tr>
                                <td>||r||</td>
                                <td style="text-align: center">=</td>
                                <td>||</td>
                                <td></td>
                                <td style="text-align: center">1</td>
                                <td style="text-align: center"><?= $coefficients['y-z'] ?></td>
                                <td>||</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>||</td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center">1</td>
                                <td>||</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-9">
                    <p><?= !$coefficients['x-y'] ? 'X и Y статистически ЗАВИСИМЫЕ случайные величины' : 'X и Y статистически ЗАВИСИМЫЕ случайные величины' ?></p>
                    <p><?= !$coefficients['x-z'] ? 'X и Z статистически ЗАВИСИМЫЕ случайные величины' : 'X и Z статистически ЗАВИСИМЫЕ случайные величины' ?></p>
                    <p><?= !$coefficients['y-z'] ? 'Y и Z статистически ЗАВИСИМЫЕ случайные величины' : 'Y и Z статистически ЗАВИСИМЫЕ случайные величины' ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
