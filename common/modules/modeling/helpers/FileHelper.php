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
     */
    public static function getData()
    {
        return json_decode(file_get_contents(static::getPathFileData()));
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