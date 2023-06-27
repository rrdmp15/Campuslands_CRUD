<?php
namespace App;

class regionsRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'regions';

        $this -> configRoutes($router, $className);

        $router -> post('/regions', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\regions::getInstance()->addRegions(
                $data['name_region'],
                $data['id_country']
            );
        });

        $router -> put('/regions/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\regions::getInstance()->putRegions(
                $id,
                $data['name_region'],
                $data['id_country']
            );
        });
    }
}

?>