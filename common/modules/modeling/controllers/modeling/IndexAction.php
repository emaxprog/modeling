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
use common\modules\modeling\helpers\FileHelper;
use common\modules\modeling\forms\RandomValueForm;
use common\modules\modeling\services\ModelingService;

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
     * Действие для парсинга отчета
     *
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function run()
    {
        $form = new RandomValueForm();

        if ($form->load(Yii::$app->request->post(), '')) {
            FileHelper::saveData($form->values);
            try {
                $this->service = new ModelingService(FileHelper::getData());

                return $this->controller->asJson([
                    'statisticRange' => $this->service->statisticRange(),
                    'statisticFunction' => $this->service->statisticFunction()
                ]);
            } catch (\Exception $e) {
                Yii::$app->response->statusCode = 403;
                return $this->controller->asJson(['error' => $e->getMessage()]);
            }
        }

        return $this->controller->render('index', ['form' => $form]);
    }
}
