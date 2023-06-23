<?php
namespace App;
class journey extends connect{
    private $queryPost = 'INSERT INTO journey(name_journey, check_in, check_out) VALUES(:journey,:checkIn,:checkOut';
    private $queryGetAll = 'SELECT * FROM journey';
    private $queryGet = 'SELECT * FROM journey WHERE id = ?';
    private $queryDelete = 'DELETE FROM journey WHERE id = ?';
    private $queryUpdate = 'UPDATE journey SET name_journey = ?, check_in = ?, check_out = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(public $name_journey = 1, public $check_in = 1, public $check_out = 1){
        parent::__construct();
    }

    public function postJourney(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("journey", $this->name_journey);
            $res->bindValue("group", $this->check_in);
            $res->bindValue("checkOut", $this->check_out);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllJourney(){
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

    public function getJourney($id){
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

    public function deleteJourney($id){
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

    public function updateJourney( $name_journey, $check_in, $check_out, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$name_journey, $check_in, $check_out, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>