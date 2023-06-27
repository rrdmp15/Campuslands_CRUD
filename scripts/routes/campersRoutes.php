<?php
namespace App;

class campersRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'campers';

        $this -> configRoutes($router, $className);

        $router -> post('/campers', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\campers::getInstance()->addCampers(
                $data['id_team_schedule'],
                $data['id_route'],
                $data['id_trainer'],
                $data['id_psycologist'],
                $data['id_teacher'],
                $data['id_level'],
                $data['id_journey'],
                $data['id_staff']
            );
        });

        $router -> put('/campers/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\campers::getInstance()->putCampers(
                $id,
                $data['id_team_schedule'],
                $data['id_route'],
                $data['id_trainer'],
                $data['id_psycologist'],
                $data['id_teacher'],
                $data['id_level'],
                $data['id_journey'],
                $data['id_staff']
            );
        });
    }
}

?>