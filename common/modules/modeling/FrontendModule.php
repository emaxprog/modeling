<?php

namespace common\modules\modeling;

/**
 * modeling module definition class
 */
class FrontendModule extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->controllerMap = [
            'modeling' => 'common\\modules\\modeling\\controllers\\ModelingController',
        ];
    }
}
