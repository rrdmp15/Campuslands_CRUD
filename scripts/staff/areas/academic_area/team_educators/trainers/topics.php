<?php
namespace App;
class topics extends connect{
    private $queryPost = 'INSERT INTO topics(id_module, name_topic, start_date, end_date, description, duration_days) VALUES(:module,:nameTopic, :startDate, :endDate, :description, :durationDays)';

    private $queryGetAll = 'SELECT modules.name_module, topics.name_topic, topics.start_date, topics.end_date, topics.description, topics.duration_days FROM topics INNER JOIN modules ON topics.id_module = modules.id';

    private $queryGet = 'SELECT modules.name_module, topics.name_topic, topics.start_date, topics.end_date, topics.description, topics.duration_days FROM topics INNER JOIN modules ON topics.id_module = modules.id WHERE id = ?';

    private $queryDelete = 'DELETE FROM topics WHERE id = ?';
    private $queryUpdate = 'UPDATE topics SET id_module = ?, name_topic = ?, start_date = ?, end_date = ?, description = ?, duration_days = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(public $id_module = 1, public $name_topic = 1, public $start_date = 1, public $end_date = 1, public $description = 1, public $duration_days = 1){
        parent::__construct();
    }

    public function postTopics(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("module", $this->id_module);
            $res->bindValue("nameTopic, ", $this->name_topic);
            $res->bindValue("startDate", $this->start_date);
            $res->bindValue("endDate", $this->end_date);
            $res->bindValue("description", $this->description);
            $res->bindValue("durationDays", $this->duration_days);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllTopics(){
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

    public function getTopics($id){
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

    public function deleteTopics($id){
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

    public function updateTopics( $id_module, $name_topic, $start_date, $end_date, $description, $duration_days, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_module, $name_topic, $start_date, $end_date, $description, $duration_days,$id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>