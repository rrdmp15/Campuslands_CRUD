<?php
namespace App;

class english_skillsRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'english_skills';

        $this -> configRoutes($router, $className);

        $router -> post('/english_skills', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\english_skills::getInstance()->addEnglish_skills(
                $data['id_team_schedule'],
                $data['id_journey'],
                $data['id_teacher'],
                $data['id_location'],
                $data['id_subject']
            );
        });

        $router -> put('/englis_skills/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\englis_skills::getInstance()->putEnglish_skills(
                $id,
                $data['id_team_schedule'],
                $data['id_journey'],
                $data['id_teacher'],
                $data['id_location'],
                $data['id_subject']
            );
        });
    }
}

?>