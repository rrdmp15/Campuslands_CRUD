<?php
namespace App;

class subjectsRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'subjects';

        $this -> configRoutes($router, $className);

        $router -> post('/subjects', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\subjects::getInstance()->addSubjects(
                $data['name_subject']
            );
        });

        $router -> put('/subjects/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\subjects::getInstance()->putSubjects(
                $id,
                $data['name_subject']
            );
        });
    }
}

?>