<?php
/**
 * Файл класса Lab5Action
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
    protected $service;

    /**
     * Действие для вывода Лабораторной работы №5
     *
     * @return string|\yii\web\Response
     * @throws \Exception
     */
    public function run()
    {
        $form = new Lab1Form();

        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            if ($form->load($postData, '')) {
                $this->service = new ModelingService($form->values, null, null, FileHelper::geFisherTableByAlpha($postData['alpha']));
            }
            try {
                return $this->controller->asJson($this->service->isDispersionEqual() ? 'Дисперсии РАВНЫ' : 'Дисперсии НЕ РАВНЫ');
            } catch (\Exception $e) {
                Yii::$app->response->statusCode = 403;
                return $this->controller->asJson(['error' => $e->getMessage()]);
            }
        }

        return $this->controller->render('lab5', [
            'form' => $form,
        ]);
    }
}

