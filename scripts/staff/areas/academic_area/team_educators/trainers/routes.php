<?php
class routes extends connect{
    private $queryPost = 'INSERT INTO routes(name_route, start_date, end_date, description, duration_days) VALUES(:nameRoute, :startDate, :endDate, :description, :durationDays)';
    private $queryGetAll = 'SELECT * FROM routes';
    private $queryGet = 'SELECT * FROM routes WHERE id = ?';
    private $queryDelete = 'DELETE FROM routes WHERE id = ?';
    private $queryUpdate = 'UPDATE routes SET  name_route = ?, start_date = ?, end_date = ?, description = ?, duration_days = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(public $name_route = 1, public $start_date = 1, public $end_date = 1, public $description = 1, public $duration_days = 1){
        parent::__construct();
    }

    public function postRoutes(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("nameRoute, ", $this->name_route);
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

    public function getAllRoutes(){
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $this->message = ["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getRoutes($id){
        try{
            $res = $this -> conx -> prepare($this -> queryGet);
            $res -> execute([$id]);
            $this -> message = ["Code" => "200", "Message" => $res -> fetch(PDO::FETCH_ASSOC)];
        }catch(\PDOException $e){
            $this -> message = ["Code" => $e -> getCode(), "Message" => $res -> errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function deleteRoutes($id){
        try{

            $res = $this -> conx -> prepare($this->queryDelete);
            $res -> execute([$id]);
            $this -> message = ["Code" => 200, "Message" => $res -> fetch(PDO::FETCH_ASSOC)];

        }catch(\PDOException $e){
            $this -> message = ["Code" => $e -> getCode(), "Message" => $res -> errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function updateRoutes($name_route, $start_date, $end_date, $description, $duration_days, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$name_route, $start_date, $end_date, $description, $duration_days,$id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>