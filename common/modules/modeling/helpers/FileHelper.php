<?php

namespace common\modules\modeling\helpers;

use Yii;

/**
 * Class FileHelper
 * @package common\modules\modeling\helpers
 */
class FileHelper
{
    /**
     * Сохранение данных в json
     *
     * @param $data
     * @return string
     */
    public static function saveData($data)
    {
        $outputFile = static::getPathFileData();
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
        if ($data = json_decode(file_get_contents(static::getPathFileData()))) {
            return $data;
        }

        throw new \Exception('Нет значений случайной величины.');
    }

    /**
     * Получить путь к файлу с данными
     *
     * @return string
     */
    public static function getPathFileData()
    {
        return Yii::getAlias('@frontend/web') . '/data/values.json';
    }
}