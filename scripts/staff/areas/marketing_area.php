<?php
class marketing_area extends connect{
    private $queryPost = 'INSERT INTO marketing_area(id_area, id_staff, id_position, id_journey) VALUES(:area,:staff,:position,:journey)';
    private $queryGetAll = 'SELECT * FROM marketing_area';
    private $queryGet = 'SELECT * FROM marketing_area WHERE id = ?';
    private $queryDelete = 'DELETE FROM marketing_area WHERE id = ?';
    private $queryUpdate = 'UPDATE marketing_area SET id_area = ?, id_staff = ?, id_position = ?, id_journey = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(private $id_area = 1, public $id_staff = 1, public $id_position = 1, public $id_journey = 1){
        parent::__construct();
    }

    public function postMarketing_area(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("area", $this->id_area);
            $res->bindValue("staff", $this->id_staff);
            $res->bindValue("position", $this->id_position);
            $res->bindValue("journey", $this->id_journey);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllMarketing_area(){
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

    public function getMarketing_area($id){
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

    public function deleteMarketing_area($id){
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

    public function updateMarketing_area( $id_area, $id_staff, $id_position, $id_journey, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_area, $id_staff, $id_position, $id_journey, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>