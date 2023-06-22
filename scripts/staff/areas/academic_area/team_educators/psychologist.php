<?php
class psycologist extends connect{
    private $queryPost = 'INSERT INTO psycologist(id_staff, id_academic_area, id_position) VALUES(:staff,:academicArea, :position)';
    private $queryGetAll = 'SELECT * FROM psycologist';
    private $queryGet = 'SELECT * FROM psycologist WHERE id = ?';
    private $queryDelete = 'DELETE FROM psycologist WHERE id = ?';
    private $queryUpdate = 'UPDATE psycologist SET id_staff = ?, id_academic_area = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(public $id_staff = 1, public $id_academic_area = 1, public $id_position = 1){
        parent::__construct();
    }

    public function postPsycologist(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("staff", $this->id_staff);
            $res->bindValue("academicArea, ", $this->id_academic_area);
            $res->bindValue("position", $this->id_position);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllPsycologist(){
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

    public function getPsycologist($id){
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

    public function deletePsycologist($id){
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

    public function updatePsycologist( $id_staff, $id_academic_area, $id_position, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_staff, $id_academic_area, $id_position, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>