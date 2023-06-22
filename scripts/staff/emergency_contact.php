<?php
class emergency_contact extends connect{
    private $queryPost = 'INSERT INTO emergency_contact(id_staff, cel_number, relationship, full_name, email) VALUES(:idStaff,:celNumber,:relationship,:fullName,:email)';
    private $queryGetAll = 'SELECT * FROM emergency_contact';
    private $queryGet = 'SELECT * FROM emergency_contact WHERE id = ?';
    private $queryDelete = 'DELETE FROM emergency_contact WHERE id = ?';
    private $queryUpdate = 'UPDATE emergency_contact SET id_staff = ?, cel_number = ?, relationship = ?, full_name = ?, email = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(public $id_staff = 1, private $cel_number = 1, private $relationship = 1, public $full_name = 1, public $email = 1){
        parent::__construct();
    }

    public function postEmergency_contact(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("idStaff", $this->id_staff);
            $res->bindValue("celNumber", $this->cel_number);
            $res->bindValue("relationship", $this->relationship);
            $res->bindValue("fullName", $this->full_name);
            $res->bindValue("email", $this->email);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllEmergency_contact(){
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

    public function getEmergency_contact($id){
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

    public function deleteEmergency_contact($id){
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

    public function updateEmergency_contact($id_staff, $cel_number, $relationship, $full_name, $email, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_staff, $cel_number, $relationship, $full_name, $email, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>