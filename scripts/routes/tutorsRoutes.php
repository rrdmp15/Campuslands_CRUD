<?php
namespace App;

class tutorsRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'tutors';

        $this -> configRoutes($router, $className);

        $router -> post('/tutors', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\tutors::getInstance()->addTutors(
                $data['id_staff'],
                $data['id_academic_area'],
                $data['id_position']
            );
        });

        $router -> put('/tutors/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\tutors::getInstance()->putTutors(
                $id,
                $data['id_staff'],
                $data['id_academic_area'],
                $data['id_position']
            );
        });
    }
}

?>