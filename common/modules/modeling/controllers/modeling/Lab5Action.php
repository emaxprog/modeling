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
use common\modules\modeling\forms\Lab1Form;
use common\modules\modeling\services\ModelingService;

/**
 * Class Lab5Action
 * @package common\modules\modeling\controllers\modeling
 */
class Lab5Action extends Action
{
    /**
     * @var ModelingService
     */
    protected $service1;

    /**
     * @var ModelingService
     */
    protected $service2;

    /**
     * Действие для вывода Лабораторной работы №1
     *
     * @return string|\yii\web\Response
     */
    public function run()
    {
        $form1 = new Lab1Form();
        $form2 = new Lab1Form();

        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            if ($form1->load($postData, 'form1') && $form2->load($postData, 'form2')) {
                $this->service1 = new ModelingService($form1->values);
                $this->service2 = new ModelingService($form2->values);
            }
            try {
                $statisticRange = $this->service1->statisticRange();
                return $this->controller->asJson([
                    'statisticRange' => $statisticRange,
                    'statisticFunction' => $this->service->statisticFunction(),
                    'statisticRangeTable' => $this->controller->renderPartial('lab1_table', [
                        'ranges' => array_keys($statisticRange),
                        'frequencies' => array_values($statisticRange)
                    ])
                ]);
            } catch (\Exception $e) {
                Yii::$app->response->statusCode = 403;
                return $this->controller->asJson(['error' => $e->getMessage()]);
            }
        }

        return $this->controller->render('lab5', [
            'form1' => $form1,
            'form2' => $form2
        ]);
    }
}

