<?php

namespace App\Controller;

use light\Routing\Controller;

/**
 * Class HomeController
 *
 * @package App\Controller
 */
class HomeController extends Controller
{
    /**
     * Home
     *
     * @return mixed
     */
    public function home()
    {
        return app('view-blade')->render('home', ['title' => 'Home']);
    }
}
