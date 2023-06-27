<?php
namespace App;

class soft_skillsRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'soft_skills';

        $this -> configRoutes($router, $className);

        $router -> post('/soft_skills', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\soft_skills::getInstance()->addSoft_skills(
                $data['id_team_schedule'],
                $data['id_journey'],
                $data['id_psychologist'],
                $data['id_location'],
                $data['id_subject']
            );
        });

        $router -> put('/soft_skills/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\soft_skills::getInstance()->putSoft_skills(
                $id,
                $data['id_team_schedule'],
                $data['id_journey'],
                $data['id_psychologist'],
                $data['id_location'],
                $data['id_subject']
            );
        });
    }
}

?>