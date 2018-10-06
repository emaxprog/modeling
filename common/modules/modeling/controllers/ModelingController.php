<?php

namespace common\modules\modeling\controllers;

use yii\web\Controller;

/**
 * Default controller for the `modeling` module
 */
class ModelingController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => __NAMESPACE__ . '\\modeling\\IndexAction',
        ];
    }
}
