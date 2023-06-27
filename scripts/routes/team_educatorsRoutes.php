<?php
namespace App;

class team_educatorsRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'team_educators';

        $this -> configRoutes($router, $className);

        $router -> post('/team_educators', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\team_educators::getInstance()->addTeam_educators(
                $data['name_rol']
            );
        });

        $router -> put('/team_educators/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\team_educators::getInstance()->putTeam_educators(
                $id,
                $data['name_rol']
            );
        });
    }
}

?>