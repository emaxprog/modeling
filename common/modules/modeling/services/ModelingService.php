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
     * Таблица Пирсона
     *
     * @var array
     */
    protected $pirsonTable;

    /**
     * ModelingService constructor.
     * @param $values
     * @param $laplasTable
     * @param $pirsonTable
     */
    public function __construct($values, $laplasTable = null, $pirsonTable = null)
    {
        $this->values = $values;
        $this->laplasTable = $laplasTable;
        $this->pirsonTable = $pirsonTable;
    }

    /**
     * Получить значения
     *
     * @return array
     */
    public function getValues()
    {
        return $this->values;
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
        return round($sum / (count($this->values) - 1), 2);
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
        for ($i = 0; $i <= count($this->values); $i++) {
            if (!$i) {
                $coordinates[] = $this->min();
            } else {
                $coordinates[] = $this->min() + $i * $this->valueInterval();
            }
        }
        return $coordinates;
    }

    /**
     * Частоты
     *
     * @return array
     */
    public function frequencies()
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
            $frequencies[] = $count;
        }
        return $frequencies;
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
                if ($value > $coordinates[$i] && $value < $coordinates[$i + 1]) {
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
        $values = [];
        $oldVal = $i = 0;
        foreach ($this->statisticRange() as $value) {
            if (!$i) {
                $values[$this->values[$i]] = 0;
            } else {
                $oldVal = $values[$this->values[$i]] = $oldVal + $value;
            }
            $i++;
        }

        return $values;
    }

    /**
     * Коэффициент ассиметрии
     *
     * @return float|int
     */
    public function asymmetryCoefficient()
    {
        $sum = 0;
        foreach ($this->values as $value) {
            $sum += pow($value - $this->average(), 3);
        }
        return $sum / ((count($this->values) - 1) * pow($this->standardDeviation(), 3));
    }

    /**
     * Эксцесс
     *
     * @return float|int
     */
    public function excess()
    {
        $sum = 0;
        foreach ($this->values as $value) {
            $sum += pow($value - $this->average(), 4);
        }
        return ($sum / ((count($this->values) - 1) * pow($this->standardDeviation(), 4))) - 3;
    }

    /**
     * Координаты диапазонов
     *
     * @return array
     */
    public function coordinatesOfRanges()
    {
        return array_keys($this->statisticRange());
    }

    /**
     * Вычислить вероятности попадания случайной величины на заданный участок
     *
     * @return array
     */
    public function calculateProbabilities()
    {
        $result = [];
        foreach ($this->coordinatesOfRanges() as $coordinates) {
            list($leftBorder, $rightBorder) = explode('-', $coordinates);
            $laplasValueRightBorder = abs(round(($rightBorder - $this->average()) / $this->dispersionEstimate(), 2));
            $laplasValueRightBorder = is_int($laplasValueRightBorder) || !$laplasValueRightBorder ? $laplasValueRightBorder . '.00' : (string)$laplasValueRightBorder;
            $laplasValueRightBorder = strlen($laplasValueRightBorder) == 4 ? $laplasValueRightBorder : $laplasValueRightBorder . '0';
            $laplasValueLeftBorder = abs(round(($leftBorder - $this->average()) / $this->dispersionEstimate(), 2));
            $laplasValueLeftBorder = is_int($laplasValueLeftBorder) || !$laplasValueLeftBorder ? $laplasValueLeftBorder . '.00' : (string)$laplasValueLeftBorder;
            $laplasValueLeftBorder = strlen($laplasValueLeftBorder) == 4 ? $laplasValueLeftBorder : $laplasValueLeftBorder . '0';
            $fb = $this->laplasTable[$laplasValueRightBorder < 5 ? $laplasValueRightBorder : 5];
            $fa = $this->laplasTable[$laplasValueLeftBorder < 5 ? $laplasValueLeftBorder : 5];
            $result[$coordinates] = abs($fb - $fa);
        }
        return $result;
    }

    public function isNormalLawByPirson()
    {
        $i = 0;
        $sum = 0;
        $frequencies = $this->frequencies();
        foreach ($this->calculateProbabilities() as $key => $value) {
            $sum += pow($frequencies[$i] - count($this->values) * $value, 2) / count($this->values) * $value;
        }
        $x2 = $sum;
    }

    /**
     * Нормальный закон распределения?
     *
     * @return bool
     */
    public function isNormalLaw()
    {
        return !($this->asymmetryCoefficient() && $this->excess());
    }
}