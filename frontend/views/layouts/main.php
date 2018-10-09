<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

$asset = AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="<?= $asset->baseUrl; ?>/img/sidebar-1.jpg">
        <div class="logo">
            <a href="/" class="simple-text logo-normal">
                Моделирование
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <?php for ($i = 1; $i <= 6; $i++) { ?>
                    <li class="nav-item <?= Yii::$app->controller->action->id == 'lab' . $i ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= Url::to(['/lab' . $i]) ?>">
                            <i class="material-icons"></i>
                            <p>Лабораторная работа №<?= $i ?></p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <span class="navbar-brand">Эм Александр (Лабораторные работы)</span>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <?= $content ?>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright float-right">
                    <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

                    <p class="pull-right"><?= Yii::powered() ?></p>
                </div>
            </div>
        </footer>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
