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
 * Class Lab1Form
 * @package common\modules\modeling\forms
 */
class Lab1Form extends Model
{
    /**
     * @var array
     */
    public $values;

    public function rules()
    {
        return [
            [['values'], 'safe'],
        ];
    }
}