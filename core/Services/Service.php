<?php

namespace Evention\Services;

use Illuminate\Contracts\Foundation\Application;

abstract class Service
{
    /**
     * Application instance
     *
     * @var Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}