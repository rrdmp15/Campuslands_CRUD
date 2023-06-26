<?php
namespace App;
class software_skills extends connect{
    private $queryPost = 'INSERT INTO software_skills(id_team_schedule, id_journey, id_trainer, id_location, id_subject) VALUES(:teamSchedule,:journey,:trainer,:location,:subject)';
    private $queryGetAll = 'SELECT team_schedule.team_name, journey.name_journey, trainer.first_name, locations.name_location, subjects.name_subject FROM software_skills INNER JOIN team_schedule ON software_skills.id_team_schedule = team_schedule.id INNER JOIN journey ON software_skills.id_journey = journey.id INNER JOIN trainers ON software_skills.id_trainer = trainers.id INNER JOIN staff as trainer ON trainers.id_staff = trainer.id INNER JOIN locations ON software_skills.id_location = locations.id INNER JOIN subjects ON software_skills.id_subject = subjects.id';

    private $queryGet = 'SELECT team_schedule.team_name, journey.name_journey, trainer.first_name, locations.name_location, subjects.name_subject FROM software_skills INNER JOIN team_schedule ON software_skills.id_team_schedule = team_schedule.id INNER JOIN journey ON software_skills.id_journey = journey.id INNER JOIN trainers ON software_skills.id_trainer = trainers.id INNER JOIN staff as trainer ON trainers.id_staff = trainer.id INNER JOIN locations ON software_skills.id_location = locations.id INNER JOIN subjects ON software_skills.id_subject = subjects.id WHERE id = ?';
    
    private $queryDelete = 'DELETE FROM software_skills WHERE id = ?';
    private $queryUpdate = 'UPDATE software_skills SET id_team_schedule = ?, id_journey = ?, id_trainer = ?, id_location = ?, id_subject = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(private $id_team_schedule = 1, public $id_journey = 1, public $id_trainer = 1, public $id_location = 1, public $id_subject = 1){
        parent::__construct();
    }

    public function postSoftware_skills(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("teamSchedule", $this->id_team_schedule);
            $res->bindValue("journey", $this->id_journey);
            $res->bindValue("trainer", $this->id_trainer);
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

    public function getAllSoftware_skills(){
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

    public function getSoftware_skills($id){
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

    public function deleteSoftware_skills($id){
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

    public function updateSoftware_skills( $id_team_schedule, $id_journey, $id_trainer, $id_location, $id_subject, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_team_schedule, $id_journey, $id_trainer, $id_location, $id_subject, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>