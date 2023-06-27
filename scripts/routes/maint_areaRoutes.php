<?php
namespace App;

class maint_areaRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'maint_area';

        $this -> configRoutes($router, $className);

        $router -> post('/maint_area', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\maint_area::getInstance()->addMaint_area(
                $data['id_area'],
                $data['id_staff'],
                $data['id_position'],
                $data['id_journey']
            );
        });

        $router -> put('/design_area/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\maint_area::getInstance()->putMaint_area(
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