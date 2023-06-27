<?php
namespace App;

class contact_infoRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'contact_info';

        $this -> configRoutes($router, $className);

        $router -> post('/contact_info', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\contact_info::getInstance()->addContact_info(
                $data['id_staff'],
                $data['whatsapp'],
                $data['instagram'],
                $data['linkedin'],
                $data['email'],
                $data['address'],
                $data['cel_number']
            );
        });

        $router -> put('/contact_info/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\staff::getInstance()->putContact_info(
                $id,
                $data['id_staff'],
                $data['whatsapp'],
                $data['instagram'],
                $data['linkedin'],
                $data['email'],
                $data['address'],
                $data['cel_number']
            );
        });
    }
}

?>