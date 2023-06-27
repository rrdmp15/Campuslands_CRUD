<?php
namespace App;

class teachersRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'teachers';

        $this -> configRoutes($router, $className);

        $router -> post('/teachers', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\teachers::getInstance()->addTeachers(
                $data['id_staff'],
                $data['id_route'],
                $data['id_academic_area'],
                $data['id_position'],
                $data['id_team_educator']
            );
        });

        $router -> put('/teachers/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\teachers::getInstance()->putTeachers(
                $id,
                $data['id_staff'],
                $data['id_route'],
                $data['id_academic_area'],
                $data['id_position'],
                $data['id_team_educator']
            );
        });
    }
}

?>