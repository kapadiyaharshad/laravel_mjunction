<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class CreateRoutePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create-permission-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a permission routes.';

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
        $routes = Route::getRoutes()->getRoutes();

        foreach ($routes as $route) {
            if ($route->getName() != '' && $route->getAction()['middleware']['0'] == 'web') {
                $permission = Permission::where('name', $route->getName())->first();

                if (is_null($permission)) {
                    $getName = explode(".",$route->getName());
                    if($getName[1] == 'index'){
                        $title = ucfirst($getName[0])." "."Read";
                    }
                    if($getName[1] == 'create'){
                        $title = ucfirst($getName[0])." "."Create";
                    }
                    if($getName[1] == 'store'){
                        $title = ucfirst($getName[0])." "."Save";
                    }
                    if($getName[1] == 'show'){
                        $title = ucfirst($getName[0])." "."View";
                    }
                    if($getName[1] == 'edit'){
                        $title = ucfirst($getName[0])." "."Update";
                    }
                    if($getName[1] == 'update'){
                        $title = ucfirst($getName[0])." "."Modification";
                    }
                    if($getName[1] == 'destroy'){
                        $title = ucfirst($getName[0])." "."Delete";
                    }
                    if($getName[1] == 'perform'){
                        $title = ucfirst($getName[0])." "."Form";
                    }

                    permission::create(['name' => $route->getName(),'title' =>$title]);
                }
            }
        }

        $this->info('Permission routes added successfully.');
    }
}
