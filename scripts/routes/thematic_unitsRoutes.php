<?php
namespace App;

class thematic_unitsRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'thematic_units';

        $this -> configRoutes($router, $className);

        $router -> post('/thematic_units', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\thematic_units::getInstance()->addThematic_units(
                $data['id_route'],
                $data['name_thematics_units'],
                $data['start_date'],
                $data['end_date'],
                $data['description'],
                $data['duration_days']
            );
        });

        $router -> put('/Thematic_units/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\Thematic_units::getInstance()->putThematic_units(
                $id,
                $data['id_route'],
                $data['name_thematics_units'],
                $data['start_date'],
                $data['end_date'],
                $data['description'],
                $data['duration_days']
            );
        });
    }
}

?>