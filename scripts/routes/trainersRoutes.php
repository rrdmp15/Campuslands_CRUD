<?php
namespace App;

class trainersRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'trainers';

        $this -> configRoutes($router, $className);

        $router -> post('/trainers', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\trainers::getInstance()->addTrainers(
                $data['id_staff'],
                $data['id_level'],
                $data['id_route'],
                $data['id_academic_area'],
                $data['id_position'],
                $data['id_team_educator']
            );
        });

        $router -> put('/trainers/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\trainers::getInstance()->putTrainers(
                $id,
                $data['id_staff'],
                $data['id_level'],
                $data['id_route'],
                $data['id_academic_area'],
                $data['id_position'],
                $data['id_team_educator']
            );
        });
    }
}

?>