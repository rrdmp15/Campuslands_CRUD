<?php
namespace App;
class contact_info extends connect{
    private $queryPost = 'INSERT INTO contact_info(id_staff, whatsapp, instagram, linkedin, email, address, cel_number) VALUES(:idStaff,:whatsapp,:instagram,:linkedin,:email, :address, :celNumber)';

    private $queryGetAll = 'SELECT staff.first_name, contact_info.whatsapp, conatct_info.instagram, conatct_info.linkedin, conatct_info.email, conatct_info.address, conatct_info.cel_number FROM contact_info INNER JOIN staff ON conatct_info.id_staff = staff.id';

    private $queryGet = 'SELECT * FROM contact_info SELECT staff.first_name, contact_info.whatsapp, conatct_info.instagram, conatct_info.linkedin, conatct_info.email, conatct_info.address, conatct_info.cel_number FROM contact_info INNER JOIN staff ON conatct_info.id_staff = staff.id WHERE id = ?';

    private $queryDelete = 'DELETE FROM contact_info WHERE id = ?';
    
    private $queryUpdate = 'UPDATE contact_info SET id_staff = ?, whatsapp = ?, instagram = ?, linkedin = ?, email = ?, address = ?, cel_number = ? WHERE id = ?';

    private $message;
    use getInstance;
    
    function __construct(private $id_staff = 1, public $whatsapp = 1, public $instagram = 1, public $linkedin = 1, public $email = 1, public $address = 1,public $cel_number = 1){
        parent::__construct();
    }

    public function postContact_info(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("idStaff", $this->id_staff);
            $res->bindValue("whatsapp", $this->whatsapp);
            $res->bindValue("instagram", $this->instagram);
            $res->bindValue("linkedin", $this->linkedin);
            $res->bindValue("email", $this->email);
            $res->bindValue("address", $this->address);
            $res->bindValue("celNumber", $this->cel_number);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllContact_info(){
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

    public function getContact_info($id){
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

    public function deleteContact_info($id){
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

    public function updateContact_info( $id_staff, $whatsapp, $instagram, $linkedin, $email, $address, $cel_number, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_staff, $whatsapp, $instagram, $linkedin, $email, $address, $cel_number, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>