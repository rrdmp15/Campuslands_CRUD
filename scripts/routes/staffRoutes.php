<?php
namespace App;

class staffRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'staff';

        $this -> configRoutes($router, $className);

        $router -> post('/staff', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\staff::getInstance()->addStaff(
                $data['doc'],
                $data['first_name'],
                $data['second_name'],
                $data['first_surname'],
                $data['second_surname'],
                $data['eps'],
                $data['id_area'],
                $data['id_city']
            );
        });

        $router -> put('/staff/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\staff::getInstance()->putStaff(
                $id,
                $data['doc'],
                $data['first_name'],
                $data['second_name'],
                $data['first_surname'],
                $data['second_surname'],
                $data['eps'],
                $data['id_area'],
                $data['id_city']
            );
        });
    }
}

?>