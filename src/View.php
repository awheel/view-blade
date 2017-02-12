<?php

namespace light\ViewBlade;

use duncan3dc\Laravel\Blade;
use duncan3dc\Laravel\BladeInstance;

/**
 * View 层
 *
 * @package light
 */
class View
{
    /**
     * 配置
     *
     * @var array
     */
    protected $config = [];

    /**
     * 实例
     *
     * @var Blade
     */
    protected $view;

    /**
     * 传递给 View 的数据
     *
     * @var array
     */
    protected $viewVars = [];

    /**
     * View 名称
     *
     * @var
     */
    protected $viewName;

    /**
     * 模板是否已经渲染过
     *
     * @var bool
     */
    protected $rendered = false;

    /**
     * View constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;

        $this->view = new BladeInstance($config['path'], $config['cache']);

        return $this->view;
    }

    /**
     * 渲染
     *
     * @param $viewName
     * @param array $vars
     *
     * @return string
     */
    public function render($viewName, $vars = [])
    {
        $this->viewName = $viewName;
        $this->viewVars = array_merge($this->viewVars, (array) $vars);
        $this->rendered = true;

        return $this->view->render($this->viewName, $this->viewVars);
    }

    /**
     * 给模板赋值
     *
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public function assign($key, $value)
    {
        // todo throw error
        if ($this->rendered === true) {
            return false;
        }

        $this->viewVars = array_merge($this->viewVars, [$key => $value]);

        return true;
    }

    /**
     * 获取当前 View 配置
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
}
