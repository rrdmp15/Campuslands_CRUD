<?php
namespace App;

class psychologistRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'psychologist';

        $this -> configRoutes($router, $className);

        $router -> post('/psychologist', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\psychologist::getInstance()->addPsychologist(
                $data['id_staff'],
                $data['id_route'],
                $data['id_academic_psycologist'],
                $data['id_position'],
                $data['id_team_educator']
            );
        });

        $router -> put('/psychologist/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\psychologist::getInstance()->putPsychologist(
                $id,
                $data['id_staff'],
                $data['id_route'],
                $data['id_academic_psycologist'],
                $data['id_position'],
                $data['id_team_educator']
            );
        });
    }
}

?>