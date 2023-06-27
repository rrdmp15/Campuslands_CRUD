<?php
namespace App;

class design_areaRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'design_area';

        $this -> configRoutes($router, $className);

        $router -> post('/design_area', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\design_area::getInstance()->addDesign_area(
                $data['id_area'],
                $data['id_staff'],
                $data['id_position'],
                $data['id_journey']
            );
        });

        $router -> put('/design_area/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\design_area::getInstance()->putDesign_area(
                $id,
                $data['id_area'],
                $data['id_staff'],
                $data['id_position'],
                $data['id_journey']
            );
        });
    }
}

?>