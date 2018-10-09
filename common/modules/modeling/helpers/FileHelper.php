<?php

namespace common\modules\modeling\helpers;

use Yii;
use SplFileObject;

/**
 * Class FileHelper
 * @package common\modules\modeling\helpers
 */
class FileHelper
{
    const RANDOM_VALUES_FILE = 'values.json';
    const LAPLAS_TABLE = 'laplass_values.csv';
    const PIRSON_TABLE = 'pirson_values.csv';

    /**
     * Сохранение данных в json
     *
     * @param $data
     * @return string
     */
    public static function saveData($data)
    {
        $outputFile = static::getPathToRandomValuesFile();
        file_put_contents($outputFile, json_encode($data, JSON_UNESCAPED_UNICODE));
        return $outputFile;
    }

    /**
     * Получить данные из файла
     *
     * @return mixed
     * @throws \Exception
     */
    public static function getData()
    {
        if ($data = json_decode(file_get_contents(static::getPathToRandomValuesFile()))) {
            return $data;
        }

        throw new \Exception('Нет значений случайной величины.');
    }

    /**
     * Получить путь к файлу с данными случайной величины
     *
     * @return string
     */
    public static function getPathToRandomValuesFile()
    {
        return static::getPathToData() . DIRECTORY_SEPARATOR . static::RANDOM_VALUES_FILE;
    }

    /**
     * Получить путь к папке с данными
     *
     * @return string
     */
    public static function getPathToData()
    {
        return Yii::getAlias('@frontend/web') . '/data';
    }

    /**
     * Получить таблицу функции Лапласа
     *
     * @return array
     * @throws \Exception
     */
    public static function getLaplasTable()
    {
        $data = [];
        $file = new SplFileObject(static::getPathToData() . DIRECTORY_SEPARATOR . static::LAPLAS_TABLE);
        while ($row = $file->fgetcsv(',')) {
            $data[$row[0]] = (float)$row[1];
        }

        if ($data) {
            return $data;
        }

        throw new \Exception('Нет таблицы функции Лапласа.');
    }

    /**
     * Получить таблицу функции Лапласа
     *
     * @return array
     * @throws \Exception
     */
    public static function getPirsonTable()
    {
        $data = [];
        $names = [];
        $file = new SplFileObject(static::getPathToData() . DIRECTORY_SEPARATOR . static::PIRSON_TABLE);
        $j = 0;
        while ($row = $file->fgetcsv(',')) {
            if (!$j++) {
                $names = $row;
                continue;
            }
            for ($i = 0; $i < 6; $i++) {
                $data[$row[0] . '-' . (float)$names[1 + $i]] = (float)$row[1 + $i];
            }
        }

        if ($data) {
            return $data;
        }

        throw new \Exception('Нет таблицы функции Лапласа.');
    }
}