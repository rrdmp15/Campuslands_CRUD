<?php
namespace App;
class design_area extends connect{
    private $queryPost = 'INSERT INTO design_area(id_area, id_staff, id_position, id_journey) VALUES(:area,:staff,:position,:journey)';
    private $queryGetAll = 'SELECT * FROM design_area';
    private $queryGet = 'SELECT * FROM design_area WHERE id = ?';
    private $queryDelete = 'DELETE FROM design_area WHERE id = ?';
    private $queryUpdate = 'UPDATE design_area SET id_area = ?, id_staff = ?, id_position = ?, id_journey = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(private $id_area = 1, public $id_staff = 1, public $id_position = 1, public $id_journey = 1){
        parent::__construct();
    }

    public function postDesign_area(){
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

    public function getAllDesign_area(){
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

    public function getDesign_area($id){
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

    public function deleteDesign_area($id){
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

    public function updateDesign_area( $id_area, $id_staff, $id_position, $id_journey, $id){
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