<?php
namespace App;

class themesRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'themes';

        $this -> configRoutes($router, $className);

        $router -> post('/themes', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\themes::getInstance()->addThemes(
                $data['id_chapter'],
                $data['name_theme'],
                $data['start_date'],
                $data['end_date'],
                $data['description'],
                $data['duration_days']
            );
        });

        $router -> put('/themes/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\themes::getInstance()->putThemes(
                $id,
                $data['id_chapter'],
                $data['name_theme'],
                $data['start_date'],
                $data['end_date'],
                $data['description'],
                $data['duration_days']
            );
        });
    }
}

?>