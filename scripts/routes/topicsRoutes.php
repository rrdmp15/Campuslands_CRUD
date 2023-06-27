<?php
namespace App;

class topicsRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'topics';

        $this -> configRoutes($router, $className);

        $router -> post('/topics', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\topics::getInstance()->addTopics(
                $data['id_module'],
                $data['name_topic'],
                $data['start_date'],
                $data['end_date'],
                $data['description'],
                $data['duration_days']
            );
        });

        $router -> put('/topics/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\topics::getInstance()->putTopics(
                $id,
                $data['id_module'],
                $data['name_topic'],
                $data['start_date'],
                $data['end_date'],
                $data['description'],
                $data['duration_days']
            );
        });
    }
}

?>