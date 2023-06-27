<?php
namespace App;
use App\RoutesConfig;

class areasRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'areas';

        $this -> configRoutes($router, $className);

        $router -> post('/areas', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\areas::getInstance()->addAreas(
                $data['name_area']
            );
        });

        $router -> put('/areas/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\areas::getInstance()->putAreas(
                $id,
                $data['name_area'],
            );
        });
    }
}

?>