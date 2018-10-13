<?php
/**
 * Файл класса IndexAction
 *
 * @copyright Copyright (c) 2018, Oleg Chulakov Studio
 * @link http://chulakov.com/
 */

namespace common\modules\modeling\controllers\modeling;

use common\modules\modeling\forms\Lab4Form;
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
        $form = new Lab4Form();

        try {
            $this->service = new ModelingService(FileHelper::getData(), FileHelper::getLaplasTable(), FileHelper::getPirsonTable());
            if ($form->load(Yii::$app->request->post(), '') && $form->validate()) {
                return $this->controller->asJson('Распределение' . ($this->service->isNormalLawByPirson($form->alpha) ? ' НОРМАЛЬНОЕ.' : ' НЕ НОРМАЛЬНОЕ.'));
            }
            return $this->controller->render('lab4', [
                'form' => $form,
                'ranges' => $this->service->ranges(),
                'frequencies' => $this->service->frequencies(),
                'probabilities' => $this->service->calculateProbabilities()
            ]);
        } catch (\Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }
}
