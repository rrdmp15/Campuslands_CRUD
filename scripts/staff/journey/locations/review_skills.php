<?php
namespace App;
class review_skills extends connect{
    private $queryPost = 'INSERT INTO review_skills(id_team_schedule, id_journey, id_tutor, id_location) VALUES(:teamSchedule,:journey,:tutor,:location)';
    private $queryGetAll = 'SELECT * FROM review_skills';
    private $queryGet = 'SELECT * FROM review_skills WHERE id = ?';
    private $queryDelete = 'DELETE FROM review_skills WHERE id = ?';
    private $queryUpdate = 'UPDATE review_skills SET id_team_schedule = ?, id_journey = ?, id_tutor = ?, id_location = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(private $id_team_schedule = 1, public $id_journey = 1, public $id_tutor = 1, public $id_location = 1){
        parent::__construct();
    }

    public function postReview_skills(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("teamSchedule", $this->id_team_schedule);
            $res->bindValue("journey", $this->id_journey);
            $res->bindValue("tutor", $this->id_tutor);
            $res->bindValue("location", $this->id_location);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllReview_skills(){
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

    public function getReview_skills($id){
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

    public function deleteReview_skills($id){
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

    public function updateReview_skills( $id_team_schedule, $id_journey, $id_tutor, $id_location, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_team_schedule, $id_journey, $id_tutor, $id_location, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>