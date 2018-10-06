<?php
/**
 * Файл класса IndexAction
 *
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace common\modules\modeling\controllers\modeling;

use Yii;
use yii\base\Action;
use yii\web\Controller;

/**
 * Класс действие для получения списка советов
 */
class IndexAction extends Action
{
    protected $service;

    public function __construct($id, Controller $controller, array $config = [])
    {
        parent::__construct($id, $controller, $config);
    }

    /**
     * Действие для вывода списка лабораторных работ
     *
     * @return string|\yii\web\Response
     */
    public function run()
    {
        return $this->controller->render('index');
    }
}
