<?php

namespace Llama\Angular2;

use Countable;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;
use Llama\Modules\Contracts\RepositoryInterface;
use Llama\Modules\Exceptions\ModuleNotFoundException;
use Llama\Modules\Process\Installer;
use Llama\Modules\Process\Updater;

class Repository implements RepositoryInterface, Countable
{
    /**
     * Application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * The module path.
     *
     * @var string|null
     */
    protected $path;

    /**
     * @var string
     */
    protected $stubPath;

    /**
     * The constructor.
     *
     * @param Application $app
     * @param string|null $path
     */
    public function __construct(Application $app, $path = null)
    {
        $this->app = $app;
        $this->path = $path;
    }
    
    /**
     * Get a module path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path ?: $this->config('path');
    }

    /**
     * Register the modules.
     */
    public function register()
    {
    }

    /**
     * Boot the modules.
     */
    public function boot()
    {
    }

    /**
     * Get a specific config data from a configuration file.
     *
     * @param $key
     *
     * @param null $default
     * @return mixed
     */
    public function config($key, $default = null)
    {
        return $this->app['config']->get('angular2.' . $key, $default);
    }

    /**
     * Get stub path.
     *
     * @return string
     */
    public function getStubPath()
    {
        if ($this->stubPath !== null) {
            return $this->stubPath;
        }

        if ($this->config('stubs.enabled') === true) {
            return $this->config('stubs.path');
        }

        return $this->stubPath;
    }

    /**
     * Set stub path.
     *
     * @param string $stubPath
     *
     * @return $this
     */
    public function setStubPath($stubPath)
    {
        $this->stubPath = $stubPath;

        return $this;
    }
}
