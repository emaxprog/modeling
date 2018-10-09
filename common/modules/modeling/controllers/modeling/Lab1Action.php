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
use common\modules\modeling\helpers\FileHelper;
use common\modules\modeling\forms\RandomValueForm;
use common\modules\modeling\services\ModelingService;

/**
 * Class Lab1Action
 * @package common\modules\modeling\controllers\modeling
 */
class Lab1Action extends Action
{
    /**
     * @var ModelingService
     */
    protected $service;

    /**
     * Действие для вывода Лабораторной работы №1
     *
     * @return string|\yii\web\Response
     */
    public function run()
    {
        $form = new RandomValueForm();

        if (Yii::$app->request->isPost) {
            if ($form->load(Yii::$app->request->post(), '')) {
                FileHelper::saveData($form->values);
            }
            try {
                $this->service = new ModelingService(FileHelper::getData());
                $statisticRange = $this->service->statisticRange();
                return $this->controller->asJson([
                    'statisticRange' => $statisticRange,
                    'statisticFunction' => $this->service->statisticFunction(),
                    'statisticRangeTable' =>$this->controller->renderPartial('lab1_table',[
                        'ranges' => array_keys($statisticRange),
                        'frequencies' => array_values($statisticRange)
                    ])
                ]);
            } catch (\Exception $e) {
                Yii::$app->response->statusCode = 403;
                return $this->controller->asJson(['error' => $e->getMessage()]);
            }
        }

        return $this->controller->render('lab1', ['form' => $form]);
    }
}
