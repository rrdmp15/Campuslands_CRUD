<?php
namespace App;

class admin_areaRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'admin_area';

        $this -> configRoutes($router, $className);

        $router -> post('/admin_area', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\admin_area::getInstance()->addAdmin_area(
                $data['id_area'],
                $data['id_staff'],
                $data['id_position'],
                $data['id_journey']
            );
        });

        $router -> put('/admin_area/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\admin_area::getInstance()->putAdmin_area(
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