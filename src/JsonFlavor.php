<?php
namespace vr\environment;

use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class JsonFlavor
 * @package vr\environment
 */
class JsonFlavor extends Flavor
{
    /**
     * @var
     */
    public $filename;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function prepare()
    {
        if (empty($this->filename)) {
            $this->filename = sprintf('@app/' . $this->name . '.flavor.json');
        }

        $filename = \Yii::getAlias($this->filename);

        if (!file_exists($filename)) {
            throw new \Exception('Missing file named ' . $filename);
        }

        $data             = Json::decode(file_get_contents($filename));

        $this->components = ArrayHelper::getValue($data, 'components', []);
        $this->params     = ArrayHelper::getValue($data, 'params', []);
    }
}