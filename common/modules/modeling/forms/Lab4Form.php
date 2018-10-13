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
 * Class Lab4Form
 * @package common\modules\modeling\forms
 */
class Lab4Form extends Model
{
    /**
     * @var float
     */
    public $alpha;

    public function rules()
    {
        return [
            [['alpha'],'required'],
            [['alpha'], 'number'],
        ];
    }
}