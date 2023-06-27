<?php
namespace App;

class citiesRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'cities';

        $this -> configRoutes($router, $className);

        $router -> post('/cities', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\cities::getInstance()->addCities(
                $data['name_city'],
                $data['id_region']
            );
        });

        $router -> put('/cities/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\cities::getInstance()->putCities(
                $id,
                $data['name_city'],
                $data['id_region']
            );
        });
    }
}

?>