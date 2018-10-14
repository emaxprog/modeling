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
     * Частоты
     *
     * @var array
     */
    protected $frequenciesTimes;

    /**
     * Таблица Пирсона
     *
     * @var array
     */
    protected $pirsonTable;

    /**
     * Таблица Лапласа
     *
     * @var array
     */
    protected $laplasTable;

    /**
     * Таблица Фишера
     *
     * @var array
     */
    protected $fisherTable;

    /**
     * ModelingService constructor.
     * @param $values
     * @param $laplasTable
     * @param $pirsonTable
     * @param $fisherTable
     */
    public function __construct($values, $laplasTable = null, $pirsonTable = null, $fisherTable = null)
    {
        $this->values = $values;
        $this->laplasTable = $laplasTable;
        $this->pirsonTable = $pirsonTable;
        $this->fisherTable = $fisherTable;
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
     * @param array $values
     * @return float|int
     */
    public function average($values = null)
    {
        $values = $values ?: $this->values;
        return array_sum($values) / count($values);
    }

    /**
     * Среднее квадратическое отклонение
     *
     * @param $values
     * @return float
     */
    public function standardDeviation($values = null)
    {
        return sqrt($this->dispersionEstimate($values));
    }

    /**
     * Оценка дисперсии
     *
     * @param array $values
     * @return float|int
     */
    public function dispersionEstimate($values = null)
    {
        $sum = 0;
        $values = $values ?: $this->values;
        foreach ($values as $value) {
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
        return array_values($this->statisticRange());
    }

    /**
     * Интервалы
     *
     * @return array
     */
    public function ranges()
    {
        return array_keys($this->statisticRange());
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
            $this->frequenciesTimes[] = $count;
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

    /**
     *  Соответствует теоритеческому нормальному распределению по согласию Пирсона?
     *
     * @param $alpha
     * @return bool
     */
    public function isNormalLawByPirson($alpha)
    {
        $i = 0;
        $sum = 0;
        foreach ($this->calculateProbabilities() as $key => $value) {
            $sum += pow($this->frequenciesTimes[$i] - count($this->values) * $value, 2) / count($this->values) * $value;
        }
        $x = sqrt($sum);
        return $x < $this->pirsonTable[(count($this->values) - 1) . '-' . $alpha];
    }

    /**
     *  Две дисперсии равны?
     *
     * @return bool
     * @throws \Exception
     */
    public function isDispersionEqual()
    {
        $valuesX = $this->values['randomValue1'];
        $valuesY = $this->values['randomValue2'];
        $dispersionX = $this->dispersionEstimate($valuesX);
        $dispersionY = $this->dispersionEstimate($valuesY);

        $k1 = count($valuesX) - 1;
        $k2 = count($valuesY) - 1;
        if (!($k1 && $k2)) {
            throw  new \Exception('Количество значений случайных величин должно быть больше.');
        }
        $f = round($dispersionX > $dispersionY ? $dispersionX / $dispersionY : $dispersionY / $dispersionX, 2);

        return $f < $this->fisherTable[$k2 . '-' . $k1];
    }

    /**
     * Коэффициенты парных корреляций
     *
     * @return array
     * @throws \Exception
     */
    public function pairCorrelationCoefficients()
    {
        $valuesX = $this->values['randomValue1'];
        $valuesY = $this->values['randomValue2'];
        $valuesZ = $this->values['randomValue3'];
        $n = count($valuesX);
        if ($n == 1) {
            throw  new \Exception('Количество значений случайных величин должно быть больше.');
        }
        return [
            'x-y' => round($this->sumPair($valuesX, $valuesY) / (($n - 1) * $this->standardDeviation($valuesX) * $this->standardDeviation($valuesY)), 2),
            'x-z' => round($this->sumPair($valuesX, $valuesZ) / (($n - 1) * $this->standardDeviation($valuesX) * $this->standardDeviation($valuesZ)), 2),
            'y-z' => round($this->sumPair($valuesY, $valuesZ) / (($n - 1) * $this->standardDeviation($valuesY) * $this->standardDeviation($valuesZ)), 2),
        ];
    }

    /**
     * Получить сумму парных величин
     *
     * @param $valuesX
     * @param $valuesY
     * @return float|int
     */
    public function sumPair($valuesX, $valuesY)
    {
        $sum = 0;
        $n = count($valuesX);
        $averageX = $this->average($valuesX);
        $averageY = $this->average($valuesY);
        for ($i = 0; $i < $n; $i++) {
            $sum += ($valuesX[$i] - $averageX) * ($valuesY[$i] - $averageY);
        }
        return $sum;
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