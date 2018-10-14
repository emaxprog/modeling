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
 * Class Lab5Form
 * @package common\modules\modeling\forms
 */
class Lab5Form extends Model
{
    /**
     * Значения случайных величин
     *
     * @var array
     */
    public $values;

    /**
     * Значение Альфа
     *
     * @var float
     */
    public $alpha;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['alpha', 'values'], 'required'],
            [['alpha'], 'number'],
            [['values'], 'safe'],
        ];
    }
}