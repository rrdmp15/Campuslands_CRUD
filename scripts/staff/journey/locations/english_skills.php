<?php
namespace App;
class english_skills extends connect{
    private $queryPost = 'INSERT INTO english_skills(id_team_schedule, id_journey, id_teacher, id_location, id_subject) VALUES(:teamSchedule,:journey,:teacher,:location,:subject)';

    private $queryGetAll = 'SELECT team_schedule.team_name, journey.name_journey, teacher.first_name, locations.name_location, subjects.name_subject FROM english_skills INNER JOIN team_schedule ON english_skills.id_team_schedule = team_schedule.id INNER JOIN journey ON english_skills.id_journey = journey.id INNER JOIN teachers ON english_skills.id_teacher = teachers.id INNER JOIN staff as teacher ON teachers.id_staff = teacher.id INNER JOIN locations ON english_skills.id_location = locations.id INNER JOIN subjects ON english_skills.id_subject = subjects.id';

    private $queryGet = 'SELECT team_schedule.team_name, journey.name_journey, teacher.first_name, locations.name_location, subjects.name_subject FROM english_skills INNER JOIN team_schedule ON english_skills.id_team_schedule = team_schedule.id INNER JOIN journey ON english_skills.id_journey = journey.id INNER JOIN teachers ON english_skills.id_teacher = teachers.id INNER JOIN staff as teacher ON teachers.id_staff = teacher.id INNER JOIN locations ON english_skills.id_location = locations.id INNER JOIN subjects ON english_skills.id_subject = subjects.id WHERE id = ?';

    private $queryDelete = 'DELETE FROM english_skills WHERE id = ?';
    private $queryUpdate = 'UPDATE english_skills SET id_team_schedule = ?, id_journey = ?, id_teacher = ?, id_location = ?, id_subject = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(private $id_team_schedule = 1, public $id_journey = 1, public $id_teacher = 1, public $id_location = 1, public $id_subject = 1){
        parent::__construct();
    }

    public function postEnglish_skills(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("teamSchedule", $this->id_team_schedule);
            $res->bindValue("journey", $this->id_journey);
            $res->bindValue("teacher", $this->id_teacher);
            $res->bindValue("location", $this->id_location);
            $res->bindValue("subject", $this->id_subject);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllEnglish_skills(){
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $this->message = ["Code"=> 200, "Message"=> $res->fetchAll(\PDO::FETCH_ASSOC)];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getEnglish_skills($id){
        try{
            $res = $this -> conx -> prepare($this -> queryGet);
            $res -> execute([$id]);
            $this -> message = ["Code" => "200", "Message" => $res -> fetch(\PDO::FETCH_ASSOC)];
        }catch(\PDOException $e){
            $this -> message = ["Code" => $e -> getCode(), "Message" => $res -> errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function deleteEnglish_skills($id){
        try{

            $res = $this -> conx -> prepare($this->queryDelete);
            $res -> execute([$id]);
            $this -> message = ["Code" => 200, "Message" => $res -> fetch(\PDO::FETCH_ASSOC)];

        }catch(\PDOException $e){
            $this -> message = ["Code" => $e -> getCode(), "Message" => $res -> errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function updateEnglish_skills( $id_team_schedule, $id_journey, $id_teacher, $id_location, $id_subject, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_team_schedule, $id_journey, $id_teacher, $id_location, $id_subject, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>