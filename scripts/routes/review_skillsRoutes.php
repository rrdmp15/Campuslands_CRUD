<?php
namespace App;

class review_skillsRoutes{
    use Singleton;
    use RoutesConfig;

    public function configureRoutes($router){

        $className = 'review_skills';

        $this -> configRoutes($router, $className);

        $router -> post('/review_skills', function () {
            $data = json_decode(file_get_contents("php://input"), true);
            \App\review_skills::getInstance()->addReview_skills(
                $data['id_team_schedule'],
                $data['id_journey'],
                $data['id_tutor'],
                $data['id_location']
            );
        });

        $router -> put('/review_skills/{id}', function($id){
            $data = json_decode(file_get_contents("php://input"), true);
            \App\review_skills::getInstance()->putReview_skills(
                $id,
                $data['id_team_schedule'],
                $data['id_journey'],
                $data['id_tutor'],
                $data['id_location']
            );
        });
    }
}

?>