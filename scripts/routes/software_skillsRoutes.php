<?php
namespace App;

class software_skillsRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'software_skills';

        $this -> configRoutes($router, $className);

        $router -> post('/software_skills', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\software_skills::getInstance()->addSoftware_skills(
                $data['id_team_schedule'],
                $data['id_journey'],
                $data['id_trainer'],
                $data['id_location'],
                $data['id_subject']
            );
        });

        $router -> put('/software_skills/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\software_skills::getInstance()->putSoftware_skills(
                $id,
                $data['id_team_schedule'],
                $data['id_journey'],
                $data['id_trainer'],
                $data['id_location'],
                $data['id_subject']
            );
        });
    }
}

?>