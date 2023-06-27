<?php
namespace App;

class positionRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'position';

        $this -> configRoutes($router, $className);

        $router -> post('/position', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\position::getInstance()->addPosition(
                $data['name_position'],
                $data['arl']
            );
        });

        $router -> put('/staff/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\position::getInstance()->putPosition(
                $id,
                $data['name_position'],
                $data['arl']
            );
        });
    }
}

?>