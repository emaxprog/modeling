<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 26.09.18
 * Time: 17:26
 */

namespace common\modules\modeling\services;

/**
 * Class ModelingService
 * @package common\modules\modeling\services
 */
class ModelingService
{
    /**
     * Значения случайной величины
     *
     * @var array
     */
    protected $values;

    /**
     * ModelingService constructor.
     * @param $values
     */
    public function __construct($values)
    {
        $this->values = $values;
    }

    /**
     * Выборочное среднее или оценка математического ожидания
     *
     * @return float|int
     */
    public function average()
    {
        return array_sum($this->values) / count($this->values);
    }

    /**
     * Среднее квадратическое отклонение
     *
     * @return float
     */
    public function standardDeviation()
    {
        return sqrt($this->dispersionEstimate());
    }

    /**
     * Оценка дисперсии
     *
     * @return float|int
     */
    public function dispersionEstimate()
    {
        $sum = 0;
        foreach ($this->values as $value) {
            $sum += pow($value - $this->average(), 2);
        }
        return $sum / (count($this->values) - 1);
    }

    /**
     * Размах варьирования
     *
     * @return mixed
     */
    public function rangeVariation()
    {
        return $this->max() - $this->min();
    }

    /**
     * Максимальное значение
     *
     * @return mixed
     */
    public function max()
    {
        return max($this->values);
    }

    /**
     * Минимальное значение
     *
     * @return mixed
     */
    public function min()
    {
        return min($this->values);
    }

    /**
     * Шаг по формуле Стерджесса
     *
     * @return float|int
     */
    public function valueInterval()
    {
        return round($this->rangeVariation() / (1 + 3.22 * log10(count($this->values))), 1);
    }

    /**
     * Координаты образующихся интервалов
     *
     * @return array
     */
    public function coordinates()
    {
        $coordinates = [];
        for ($i = 0; $i < count($this->values); $i++) {
            if (!$i) {
                $coordinates[] = $this->min();
            } else {
                $coordinates[] = $this->min() + $i * $this->valueInterval();
            }
        }
        return $coordinates;
    }

    /**
     * Эмпирический закон
     *
     * @return array
     */
    public function statisticRange()
    {
        $frequencies = [];
        $coordinates = $this->coordinates();
        for ($i = 0; $i < count($coordinates); $i++) {
            if (!isset($coordinates[$i + 1])) {
                break;
            }
            $count = 0;
            foreach ($this->values as $value) {
                if ($value >= $coordinates[$i] && $value <= $coordinates[$i + 1]) {
                    $count++;
                }
            }
            $frequencies[$coordinates[$i] . '-' . $coordinates[$i + 1]] = round($count / count($this->values), 1);
        }
        return $frequencies;
    }

    /**
     * Статистическая функция
     *
     * @return array
     */
    public function statisticFunction()
    {
        $values[] = $oldVal = 0;
        $i = 0;
        foreach ($this->statisticRange() as $key => $value) {
            if (!$i++) {
                $values[$this->values[$i]] = 0;
//                $values[] = [
//                    'value' => $this->values[$i],
//                    'functionValue' => 0
//                ];
            } else {
                $values[$this->values[$i]] = $oldVal + $this->statisticRange()[$key];

//                $values[] = [
//                    'value' => $value,
//                    'functionValue' => $oldVal + $this->statisticRange()[$key]
//                ];
                $oldVal = $values[$this->values[$i]];
            }
        }
        return $values;
    }
}