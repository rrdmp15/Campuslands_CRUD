<?php
namespace App;
class optional_topics extends connect{
    private $queryPost = 'INSERT INTO optional_topics(id_topic, id_team, id_subject, id_camper, id_team_educator) VALUES(:topic, :team, :subject, :camper, :teamEducator)';

    private $queryGetAll = 'SELECT topics.name_topic, team_schedule.team_name, subjects.name_subject, camper.first_name, team_educators.name_rol FROM optional_topics INNER JOIN topics ON optional_topics.id_topic = topics.id INNER JOIN team_schedule ON optional_topics.id_team = team_schedule.id INNER JOIN subjects ON optional_topics.id_subject = subjects.id INNER JOIN campers ON optional_topics.id_camper = campers.id INNER JOIN staff as camper ON campers.id_staff = camper.id INNER JOIN team_educators ON optional_topics.id_team_educator = team_educators.id';

    private $queryGet = 'SELECT topics.name_topic, team_schedule.team_name, subjects.name_subject, camper.first_name, team_educators.name_rol FROM optional_topics INNER JOIN topics ON optional_topics.id_topic = topics.id INNER JOIN team_schedule ON optional_topics.id_team = team_schedule.id INNER JOIN subjects ON optional_topics.id_subject = subjects.id INNER JOIN campers ON optional_topics.id_camper = campers.id INNER JOIN staff as camper ON campers.id_staff = camper.id INNER JOIN team_educators ON optional_topics.id_team_educator = team_educators.id WHERE id = ?';

    private $queryDelete = 'DELETE FROM optional_topics WHERE id = ?';
    private $queryUpdate = 'UPDATE optional_topics SET  id_topic = ?, id_team = ?, id_subject = ?, id_camper = ?, id_team_educator = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(public $id_topic = 1, public $id_team = 1, public $id_subject = 1, public $id_camper = 1, public $id_team_educator = 1){
        parent::__construct();
    }

    public function postOptional_topics(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("topic, ", $this->id_topic);
            $res->bindValue("team", $this->id_team);
            $res->bindValue("subject", $this->id_subject);
            $res->bindValue("camper", $this->id_camper);
            $res->bindValue("teamEducator", $this->id_team_educator);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllOptional_topics(){
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

    public function getOptional_topics($id){
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

    public function deleteOptional_topics($id){
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

    public function updateOptional_topics($id_topic, $id_team, $id_subject, $id_camper, $id_team_educator, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_topic, $id_team, $id_subject, $id_camper, $id_team_educator,$id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>