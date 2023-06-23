<?php
namespace App;
class work_reference extends connect{
    private $queryPost = 'INSERT INTO work_reference(full_name, cel_number, position, company) VALUES(:fullName,:celNumber,:position,:company)';
    private $queryGetAll = 'SELECT * FROM work_reference';
    private $queryGet = 'SELECT * FROM work_reference WHERE id = ?';
    private $queryDelete = 'DELETE FROM work_reference WHERE id = ?';
    private $queryUpdate = 'UPDATE work_reference SET full_name = ?, cel_number = ?, position = ?, company = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(private $full_name = 1, public $cel_number = 1, public $position = 1, public $company = 1){
        parent::__construct();
    }

    public function postWork_reference(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("idStaff", $this->full_name);
            $res->bindValue("cel_number", $this->cel_number);
            $res->bindValue("position", $this->position);
            $res->bindValue("company", $this->company);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllWork_reference(){
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

    public function getWork_reference($id){
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

    public function deleteWork_reference($id){
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

    public function updateWork_reference( $full_name, $cel_number, $position, $company, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$full_name, $cel_number, $position, $company, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>