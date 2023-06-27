<?php
namespace App;

class routesRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'routes';

        $this -> configRoutes($router, $className);

        $router -> post('/routes', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\routes::getInstance()->addRoutes(
                $data['name_routes'],
                $data['start_date'],
                $data['end_date'],
                $data['description'],
                $data['duration_month']
            );
        });

        $router -> put('/routes/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\routes::getInstance()->putRoutes(
                $id,
                $data['name_routes'],
                $data['start_date'],
                $data['end_date'],
                $data['description'],
                $data['duration_month']
            );
        });
    }
}

?>