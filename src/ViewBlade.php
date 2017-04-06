<?php

namespace awheel\ViewBlade;

use Xiaoler\Blade\Factory;
use Xiaoler\Blade\FileViewFinder;
use Xiaoler\Blade\Engines\CompilerEngine;
use Xiaoler\Blade\Compilers\BladeCompiler;

/**
 * View Blade
 *
 * @package awheel
 */
class ViewBlade
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
     * @var Factory
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

        if (!file_exists($config['cache'])) {
            @mkdir($config['cache'], 0777, true);
        }

        $compiler = new BladeCompiler($config['cache']);
        $engine = new CompilerEngine($compiler);
        $finder = new FileViewFinder([$config['path']]);
        $this->view = new Factory($engine, $finder);

        return $this;
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

        return $this->view->make($this->viewName, $this->viewVars)->render();
    }

    /**
     * 给模板赋值
     *
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function assign($key, $value)
    {
        // todo throw error
        if ($this->rendered === true) {
            return $this;
        }

        $this->viewVars = array_merge($this->viewVars, [$key => $value]);

        return $this;
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
