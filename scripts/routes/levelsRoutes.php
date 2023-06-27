<?php
namespace App;

class levelsRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'levels';

        $this -> configRoutes($router, $className);

        $router -> post('/levels', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\levels::getInstance()->addLevels(
                $data['name_level'],
                $data['group_level']
            );
        });

        $router -> put('/levels/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\levels::getInstance()->putLevels(
                $id,
                $data['name_level'],
                $data['group_level']
            );
        });
    }
}

?>