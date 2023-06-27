<?php
namespace App;

class locationsRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'locations';

        $this -> configRoutes($router, $className);

        $router -> post('/locations', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\locations::getInstance()->addLocations(
                $data['name_location']
            );
        });

        $router -> put('/locations/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\locations::getInstance()->putLocations(
                $id,
                $data['name_location']
            );
        });
    }
}

?>