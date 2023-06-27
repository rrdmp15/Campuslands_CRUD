<?php
namespace App;

class emergency_contactRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'emergency_contact';

        $this -> configRoutes($router, $className);

        $router -> post('/emergency_contact', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\emergency_contact::getInstance()->addEmergency_contact(
                $data['id_staff'],
                $data['cel_number'],
                $data['relationship'],
                $data['full_name'],
                $data['email'],
            );
        });

        $router -> put('/emergency_contact/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\emergency_contact::getInstance()->putEmergency_contact(
                $id,
                $data['id_staff'],
                $data['cel_number'],
                $data['relationship'],
                $data['full_name'],
                $data['email'],
            );
        });
    }
}

?>