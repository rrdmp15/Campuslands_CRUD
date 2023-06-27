<?php
namespace App;

trait RoutesConfig
{
    public function configRoutes($router, $className)
    {
        $directory = "\\App\\$className";
        $router->get("/$className", function () use ($className, $directory) {
            call_user_func([$directory::getInstance(), 'getAll' . ucfirst($className)]);
        });

        $router->get("/$className/{id}", function ($id) use ($className, $directory) {
            call_user_func([$directory::getInstance(), 'getOne' . ucfirst($className)], $id);
        });

        $router->delete("/$className/{id}", function ($id) use ($className, $directory) {
            call_user_func([$directory::getInstance(), 'delete' . ucfirst($className)], $id);
        });
    }
}
?>