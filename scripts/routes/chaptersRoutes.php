<?php
namespace App;

class chaptersRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'chapters';

        $this -> configRoutes($router, $className);

        $router -> post('/chapters', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\chapters::getInstance()->addChapters(
                $data['id_thematic_units'],
                $data['name_chapter'],
                $data['start_date'],
                $data['end_date'],
                $data['description'],
                $data['duration_days']
            );
        });

        $router -> put('/chapters/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\chapters::getInstance()->putChapters(
                $id,
                $data['id_thematic_units'],
                $data['name_chapter'],
                $data['start_date'],
                $data['end_date'],
                $data['description'],
                $data['duration_days']
            );
        });
    }
}

?>