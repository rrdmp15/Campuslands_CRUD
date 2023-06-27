<?php
namespace App;

class modulesRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'modules';

        $this -> configRoutes($router, $className);

        $router -> post('/modules', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\modules::getInstance()->addModules(
                $data['name_module'],
                $data['start_date'],
                $data['end_date'],
                $data['description'],
                $data['duration_days'],
                $data['id_theme']
            );
        });

        $router -> put('/modules/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\modules::getInstance()->putModules(
                $id,
                $data['name_module'],
                $data['start_date'],
                $data['end_date'],
                $data['description'],
                $data['duration_days'],
                $data['id_theme']
            );
        });
    }
}

?>