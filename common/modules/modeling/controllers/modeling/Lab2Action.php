<?php
/**
 * Файл класса Lab2Action
 *
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace common\modules\modeling\controllers\modeling;

use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;
use common\modules\modeling\helpers\FileHelper;
use common\modules\modeling\services\ModelingService;

/**
 * Class Lab2Action
 * @package common\modules\modeling\controllers\modeling
 */
class Lab2Action extends Action
{
    /**
     * @var ModelingService
     */
    protected $service;

    /**
     * Действие для вывода Лабораторной работы №2
     *
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function run()
    {
        try {
            $this->service = new ModelingService(FileHelper::getData());
            return $this->controller->render('lab2', [
                'values' => $this->service->getValues(),
                'isNormalLaw' => $this->service->isNormalLaw()
            ]);
        } catch (\Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }
}
