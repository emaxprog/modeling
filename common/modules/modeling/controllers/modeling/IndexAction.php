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

/**
 * Class IndexAction
 * @package common\modules\modeling\controllers\modeling
 */
class IndexAction extends Action
{
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
