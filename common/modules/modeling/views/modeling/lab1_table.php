<?php
/* @var $values array */
/* @var $ranges array */
/* @var $frequencies array */

?>
<div class="col-md-12">
    <div class="card card-plain">
        <div class="card-header card-header-danger">
            <h4 class="card-title mt-0">Эмпирический закон распределения случайной величины</h4>
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
