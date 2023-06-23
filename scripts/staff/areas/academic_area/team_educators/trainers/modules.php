<?php
namespace App;
class modules extends connect{
    private $queryPost = 'INSERT INTO modules(id_theme, name_module, start_date, end_date, description, duration_days) VALUES(:theme,:nameModule, :startDate, :endDate, :description, :durationDays)';
    private $queryGetAll = 'SELECT * FROM modules';
    private $queryGet = 'SELECT * FROM modules WHERE id = ?';
    private $queryDelete = 'DELETE FROM modules WHERE id = ?';
    private $queryUpdate = 'UPDATE modules SET id_theme = ?, name_module = ?, start_date = ?, end_date = ?, description = ?, duration_days = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(public $id_theme = 1, public $name_module = 1, public $start_date = 1, public $end_date = 1, public $description = 1, public $duration_days = 1){
        parent::__construct();
    }

    public function postModules(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("theme", $this->id_theme);
            $res->bindValue("nameModule, ", $this->name_module);
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

    public function getAllModules(){
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

    public function getModules($id){
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

    public function deleteModules($id){
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

    public function updateModules( $id_theme, $name_module, $start_date, $end_date, $description, $duration_days, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_theme, $name_module, $start_date, $end_date, $description, $duration_days,$id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>