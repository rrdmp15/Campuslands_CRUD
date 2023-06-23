<?php
namespace App;
class positions extends connect{
    private $queryPost = 'INSERT INTO positions(name_position, arl) VALUES(:positions,:arl)';
    private $queryGetAll = 'SELECT * FROM positions';
    private $queryGet = 'SELECT * FROM positions WHERE id = ?';
    private $queryDelete = 'DELETE FROM positions WHERE id = ?';
    private $queryUpdate = 'UPDATE positions SET name_position = ?, arl = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(public $name_position = 1, public $arl = 1){
        parent::__construct();
    }

    public function postPositions(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("positions", $this->name_position);
            $res->bindValue("arl", $this->arl);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllPositions(){
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

    public function getPositions($id){
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

    public function deletePositions($id){
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

    public function updatePositions( $name_position, $arl, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$name_position, $arl, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>