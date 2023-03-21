<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepositoryController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:rc {name : The name of the model class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository and controller class';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $repositoryClassName = ucwords($name) . 'Repository';
        $controllerClassName = ucwords($name) . 'Controller';

        $repositoryFileName = app_path('Http/Repositories/'.$repositoryClassName.'.php');
        $controllerFileName = app_path('Http/Controllers/API/'.$controllerClassName.'.php');


        if (File::exists($repositoryFileName)) {
            $this->error($repositoryClassName.' already exists.');
            return;
        }

        if (File::exists($controllerFileName)) {
            $this->error($controllerClassName.' already exists.');
            return;
        }

        # create file for repository
        $stub = file_get_contents(base_path().'/stubs/repository.stub');
        $stub = str_replace('{{class}}', $repositoryClassName, $stub);
        $stub = str_replace('{{name}}',ucwords($name), $stub);
        $path = app_path('Http/Repositories/'.$repositoryClassName.'.php');
        file_put_contents($path, $stub);

        # create file for controller
        $stub = file_get_contents(base_path().'/stubs/my-controller.stub');
        $stub = str_replace('{{class}}', $controllerClassName, $stub);
        $stub = str_replace('{{repositoryName}}', $repositoryClassName, $stub);
        $path = app_path('Http/Controllers/API/'.$controllerClassName.'.php');
        file_put_contents($path, $stub);

        $this->info('Repository and Controller created successfully.');

    }
}
