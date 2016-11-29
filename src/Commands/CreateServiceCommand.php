<?php

namespace Llama\Angular2\Commands;

class CreateServiceCommand extends BaseGeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'angular2:service {name} {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create component files for Angular 2 Service.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->validateInput();

        $name = $this->argument('name');
        $targetDir = $this->getTargetDir('services', $name);
        $type = 'service';

        $this->createTs($name, $type, $targetDir.$name.'.service.ts');
        $this->createSpec($name, $type, $targetDir.$name.'.spec.ts');
        $this->createIndex($name, $type, $targetDir.'index.ts');
        $this->updateUpIndex($name, $type, $targetDir);
    }
}
