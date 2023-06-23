<?php
namespace App;
class campers extends connect{
    private $queryPost = 'INSERT INTO campers(id_team_schedule, id_team_route, id_trainer, id_psycologist, id_teacher, id_level, id_journey, id_staff) VALUES(:teamSchedule,:teamRoute,:trainer,:psycologist,:teacher, :level, :journey, :staff)';
    private $queryGetAll = 'SELECT * FROM campers';
    private $queryGet = 'SELECT * FROM campers WHERE id = ?';
    private $queryDelete = 'DELETE FROM campers WHERE id = ?';
    private $queryUpdate = 'UPDATE campers SET id_team_schedule = ?, id_team_route = ?, id_trainer = ?, id_psycologist = ?, id_teacher = ?, id_level = ?, id_journey = ?, id_staff = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(private $id_team_schedule = 1, public $id_team_route = 1, public $id_trainer = 1, public $id_psycologist = 1, public $id_teacher = 1, public $id_level = 1,public $id_journey = 1, public $id_staff = 1){
        parent::__construct();
    }

    public function postCampers(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("teamSchedule", $this->id_team_schedule);
            $res->bindValue("teamRoute", $this->id_team_route);
            $res->bindValue("trainer", $this->id_trainer);
            $res->bindValue("psycologist", $this->id_psycologist);
            $res->bindValue("teacher", $this->id_teacher);
            $res->bindValue("level", $this->id_level);
            $res->bindValue("journey", $this->id_journey);
            $res->bindValue("staff", $this->id_staff);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllCampers(){
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

    public function getCampers($id){
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

    public function deleteCampers($id){
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

    public function updateCampers( $id_team_schedule, $id_team_route, $id_trainer, $id_psycologist, $id_teacher, $id_level, $id_journey, $id_staff, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_team_schedule, $id_team_route, $id_trainer, $id_psycologist, $id_teacher, $id_level, $id_journey, $id_staff, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>