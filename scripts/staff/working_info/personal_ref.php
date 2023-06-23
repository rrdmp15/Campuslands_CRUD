<?php
namespace App;
class personal_ref extends connect{
    private $queryPost = 'INSERT INTO personal_ref(full_name, cel_number, relationship, occupation) VALUES(:fullName,:celNumber,:relationship,:occupation)';
    private $queryGetAll = 'SELECT * FROM personal_ref';
    private $queryGet = 'SELECT * FROM personal_ref WHERE id = ?';
    private $queryDelete = 'DELETE FROM personal_ref WHERE id = ?';
    private $queryUpdate = 'UPDATE personal_ref SET full_name = ?, cel_number = ?, relationship = ?, occupation = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(private $full_name = 1, public $cel_number = 1, public $relationship = 1, public $occupation = 1){
        parent::__construct();
    }

    public function postPersonal_ref(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("idStaff", $this->full_name);
            $res->bindValue("cel_number", $this->cel_number);
            $res->bindValue("relationship", $this->relationship);
            $res->bindValue("occupation", $this->occupation);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllPersonal_ref(){
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

    public function getPersonal_ref($id){
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

    public function deletePersonal_ref($id){
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

    public function updatePersonal_ref( $full_name, $cel_number, $relationship, $occupation, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$full_name, $cel_number, $relationship, $occupation, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>