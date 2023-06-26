<?php
namespace App;
class thematic_units extends connect{
    private $queryPost = 'INSERT INTO thematic_units(id_route, name_thematic_units, start_date, end_date, description, duration_days) VALUES(:route,:nameThematicUnits, :startDate, :endDate, :description, :durationDays)';

    private $queryGetAll = 'SELECT routes.name_route, thematic_units.name_topic, thematic_units.start_date, thematic_units.end_date, thematic_units.description, thematic_units.duration_days FROM thematic_units INNER JOIN chapters ON thematic_units.id_chapter = chapters.id';

    private $queryGet = 'SELECT routes.name_route, thematic_units.name_topic, thematic_units.start_date, thematic_units.end_date, thematic_units.description, thematic_units.duration_days FROM thematic_units INNER JOIN chapters ON thematic_units.id_chapter = chapters.id WHERE id = ?';

    private $queryDelete = 'DELETE FROM thematic_units WHERE id = ?';
    private $queryUpdate = 'UPDATE thematic_units SET id_route = ?, name_thematic_units = ?, start_date = ?, end_date = ?, description = ?, duration_days = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(public $id_route = 1, public $name_thematic_units = 1, public $start_date = 1, public $end_date = 1, public $description = 1, public $duration_days = 1){
        parent::__construct();
    }

    public function postThematic_units(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("route", $this->id_route);
            $res->bindValue("nameThematicUnits, ", $this->name_thematic_units);
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

    public function getAllThematic_units(){
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

    public function getThematic_units($id){
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

    public function deleteThematic_units($id){
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

    public function updateThematic_units( $id_route, $name_thematic_units, $start_date, $end_date, $description, $duration_days, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_route, $name_thematic_units, $start_date, $end_date, $description, $duration_days,$id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>