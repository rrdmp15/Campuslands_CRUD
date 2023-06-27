<?php
namespace App;

class academic_areaRoutes{
    use getInstance;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'academic_area';

        $this -> configRoutes($router, $className);

        $router -> post('/academic_area', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\academic_area::getInstance()->addAcademic_area(
                $data['id_area'],
                $data['id_staff'],
                $data['id_position'],
                $data['id_journey']
            );
        });

        $router -> put('/academic_area/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\academic_area::getInstance()->putAcademic_area(
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