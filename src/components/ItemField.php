<?php

namespace zacksleo\yii2\cms\components;

use yii\base\Component;
use yii\caching\Cache;
use Yii;

/**
 * @author Aris Karageorgos <aris@phe.me>
 */
class ItemField extends Component
{
    /**
     * @var string settings model. Make sure your settings model calls clearCache in the afterSave callback
     */
    public $modelClass = 'zacksleo\yii2\cms\models\ItemField';

    /**
     * Model to for storing and retrieving settings
     * @var \pheme\settings\models\SettingInterface
     */
    protected $model;

    /**
     * Holds a cached copy of the data for the current request
     *
     * @var mixed
     */
    private $_data = null;

    /**
     * Initialize the component
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->model = new $this->modelClass;
    }

    /**
     * Get's the value for the given key and section.
     * You can use dot notation to separate the section from the key:
     * $value = $settings->get('section.key');
     * and
     * $value = $settings->get('key', 'section');
     * are equivalent
     *
     * @param $key
     * @param string|null $section
     * @param string|null $default
     * @return mixed
     */
    public function get($key, $section, $default = null)
    {
        $data = $this->getRawConfig();

        if (isset($data[$section][$key][0])) {
            if (in_array($data[$section][$key][1], ['boolean', 'bool', 'integer', 'int', 'float', 'string', 'array'])) {
                settype($data[$section][$key][0], $data[$section][$key][1]);
            }
        } else {
            $data[$section][$key][0] = $default;
        }
        return $data[$section][$key][0];
    }

    /**
     * Checks to see if a setting exists.
     * If $searchDisabled is set to true, calling this function will result in an additional query.
     * @param $key
     * @param string|null $section
     * @param boolean $searchDisabled
     * @return boolean
     */
    public function has($key, $section = null, $searchDisabled = false)
    {
        if ($searchDisabled) {
            $setting = $this->model->findSetting($key, $section);
        } else {
            $setting = $this->get($key, $section);
        }
        is_null($setting) ? false : true;
    }

    /**
     * @param $key
     * @param $value
     * @param null $section
     * @param null $type
     * @return boolean
     */
    public function set($key, $value, $section, $type = null)
    {
        return $this->model->setSetting($section, $key, $value, $type);
    }

    /**
     * Deletes a setting
     *
     * @param $key
     * @param null|string $section
     * @return bool
     */
    public function delete($key, $section)
    {
        return $this->model->deleteSetting($section, $key);
    }

    /**
     * Returns the raw configuration array
     *
     * @return array
     */
    public function getRawConfig()
    {
        if ($this->_data === null) {
            $data = $this->model->getSettings();
            $this->_data = $data;
        }
        return $this->_data;
    }
}
