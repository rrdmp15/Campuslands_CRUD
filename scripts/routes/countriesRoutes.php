<?php
namespace App;

class countriesRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'countries';

        $this -> configRoutes($router, $className);

        $router -> post('/countries', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\countries::getInstance()->addCountries(
                $data['name_country']
            );
        });

        $router -> put('/countries/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\countries::getInstance()->putCountries(
                $id,
                $data['name_country']
            );
        });
    }
}

?>