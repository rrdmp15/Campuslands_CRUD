<?php
class levels extends connect{
    private $queryPost = 'INSERT INTO levels(name_level, group_level) VALUES(:levels,:group)';
    private $queryGetAll = 'SELECT * FROM levels';
    private $queryGet = 'SELECT * FROM levels WHERE id = ?';
    private $queryDelete = 'DELETE FROM levels WHERE id = ?';
    private $queryUpdate = 'UPDATE levels SET name_level = ?, group_level = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(public $name_level = 1, public $group_level = 1){
        parent::__construct();
    }

    public function postLevels(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("levels", $this->name_level);
            $res->bindValue("group", $this->group_level);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllLevels(){
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

    public function getLevels($id){
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

    public function deleteLevels($id){
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

    public function updateLevels( $name_level, $group_level, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$name_level, $group_level, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>