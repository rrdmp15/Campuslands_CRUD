<?php
namespace App;

class marketing_areaRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'marketing_area';

        $this -> configRoutes($router, $className);

        $router -> post('/marketing_area', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\marketing_area::getInstance()->addMarketing_area(
                $data['id_area'],
                $data['id_staff'],
                $data['id_position'],
                $data['id_journey']
            );
        });

        $router -> put('/marketing_area/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\marketing_area::getInstance()->putMarketing_area(
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