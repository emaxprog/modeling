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
            'lab1' => __NAMESPACE__ . '\\modeling\\Lab1Action',
            'lab2' => __NAMESPACE__ . '\\modeling\\Lab2Action',
            'lab3' => __NAMESPACE__ . '\\modeling\\Lab3Action',
            'lab4' => __NAMESPACE__ . '\\modeling\\Lab4Action',
            'lab5' => __NAMESPACE__ . '\\modeling\\Lab5Action',
            'lab6' => __NAMESPACE__ . '\\modeling\\Lab6Action',
        ];
    }
}
