<?php
/**
 * Файл класса Lab6Action
 *
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace common\modules\modeling\controllers\modeling;

use Yii;
use yii\base\Action;
use common\modules\modeling\forms\Lab6Form;
use common\modules\modeling\services\ModelingService;

/**
 * Class Lab5Action
 * @package common\modules\modeling\controllers\modeling
 */
class Lab6Action extends Action
{
    /**
     * @var ModelingService
     */
    protected $service;

    /**
     * Действие для вывода Лабораторной работы №5
     *
     * @return string|\yii\web\Response
     * @throws \Exception
     */
    public function run()
    {
        $form = new Lab6Form();

        if (Yii::$app->request->isPost) {
            if ($form->load(Yii::$app->request->post(), '')) {
                $this->service = new ModelingService($form->values);
            }
            try {
                return $this->controller->renderPartial('lab6_table', ['coefficients' => $this->service->pairCorrelationCoefficients()]);
            } catch (\Exception $e) {
                Yii::$app->response->statusCode = 403;
                return $this->controller->asJson(['error' => $e->getMessage()]);
            }
        }

        return $this->controller->render('lab6', [
            'form' => $form,
        ]);
    }
}

