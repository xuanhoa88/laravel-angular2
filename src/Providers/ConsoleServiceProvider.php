<?php

namespace Llama\Angular2\Providers;

use Illuminate\Support\ServiceProvider;
use Llama\Angular2\Commands\CreateComponentCommand;
use Llama\Angular2\Commands\CreateDirectiveCommand;
use Llama\Angular2\Commands\CreatePageCommand;
use Llama\Angular2\Commands\CreatePipeCommand;
use Llama\Angular2\Commands\CreateServiceCommand;
use Llama\Angular2\Commands\CreateSubPageCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * The available commands
     *
     * @var array
     */
    protected $commands = [
        CreateComponentCommand::class,
        CreateDirectiveCommand::class,
        CreatePageCommand::class,
        CreatePipeCommand::class,
        CreateServiceCommand::class,
        CreateSubPageCommand::class
    ];

    /**
     * Register the commands.
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return $this->commands;
    }
}
