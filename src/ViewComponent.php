<?php

namespace awheel\ViewBlade;

use awheel\Component;

/**
 * View Blade
 *
 * @package awheel\ViewBlade
 */
class ViewComponent implements Component
{
    /**
     * 组件访问器
     *
     * @return mixed
     */
    public function getAccessor()
    {
        return 'view.blade';
    }

    /**
     * 组件注册方法
     *
     * @return mixed
     */
    public function register()
    {
        $config = app()->configGet('view.blade');
        if (app()->runningInConsole() || !$config) return [];

        return function () use ($config) {
            return new ViewBlade($config);
        };
    }
}
