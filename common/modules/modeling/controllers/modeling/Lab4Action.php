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
use yii\web\NotFoundHttpException;
use common\modules\modeling\helpers\FileHelper;
use common\modules\modeling\services\ModelingService;

/**
 * Класс действие для получения списка советов
 */
class Lab4Action extends Action
{
    /**
     * @var ModelingService
     */
    protected $service;

    /**
     * Действие для вывода Лабораторной работы №3
     *
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function run()
    {
        try {
            $this->service = new ModelingService(FileHelper::getData(), FileHelper::getLaplasTable(), FileHelper::getPirsonTable());
            $probabilities = $this->service->isNormalLawByPirson();
            return $this->controller->render('lab3', [
                'values' => $this->service->getValues(),
                'ranges' => array_keys($probabilities),
                'probabilities' => array_values($probabilities)
            ]);
        } catch (\Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }
}
