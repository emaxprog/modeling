<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 26.09.18
 * Time: 17:08
 */

namespace common\modules\modeling\forms;

use yii\base\Model;

/**
 * Class Lab6Form
 * @package common\modules\modeling\forms
 */
class Lab6Form extends Model
{
    /**
     * Значения случайных величин
     *
     * @var array
     */
    public $values;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['values'], 'required'],
            [['values'], 'safe'],
        ];
    }
}