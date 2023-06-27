<?php
namespace App;

class optional_topicsRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'optional_topics';

        $this -> configRoutes($router, $className);

        $router -> post('/optional_topics', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\optional_topics::getInstance()->addOptional_topics(
                $data['id_topic'],
                $data['id_team'],
                $data['id_subject'],
                $data['id_camper'],
                $data['id_team_educator']
            );
        });

        $router -> put('/optional_topics/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\optional_topics::getInstance()->putOptional_topics(
                $id,
                $data['id_topic'],
                $data['id_team'],
                $data['id_subject'],
                $data['id_camper'],
                $data['id_team_educator']
            );
        });
    }
}

?>