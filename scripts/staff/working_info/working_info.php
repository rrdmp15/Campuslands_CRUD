<?php
namespace App;
class working_info extends connect{
    private $queryPost = 'INSERT INTO working_info(id_staff, years_exp, months_exp, id_work_reference, id_personal_ref, start_contract, end_contract) VALUES(:idStaff,:years_exp,:months_exp,:id_work_reference,:id_personal_ref, :start_contract, :end_contract)';
    private $queryGetAll = 'SELECT * FROM working_info';
    private $queryGet = 'SELECT * FROM working_info WHERE id = ?';
    private $queryDelete = 'DELETE FROM working_info WHERE id = ?';
    private $queryUpdate = 'UPDATE working_info SET id_staff = ?, years_exp = ?, months_exp = ?, id_work_reference = ?, id_personal_ref = ?, start_contract = ?, end_contract = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(private $id_staff = 1, public $years_exp = 1, public $months_exp = 1, public $id_work_reference = 1, public $id_personal_ref = 1, public $start_contract = 1,public $end_contract = 1){
        parent::__construct();
    }

    public function postWorking_info(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("idStaff", $this->id_staff);
            $res->bindValue("years_exp", $this->years_exp);
            $res->bindValue("months_exp", $this->months_exp);
            $res->bindValue("id_work_reference", $this->id_work_reference);
            $res->bindValue("id_personal_ref", $this->id_personal_ref);
            $res->bindValue("start_contract", $this->start_contract);
            $res->bindValue("end_contract", $this->end_contract);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllWorking_info(){
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

    public function getWorking_info($id){
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

    public function deleteWorking_info($id){
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

    public function updateWorking_info( $id_staff, $years_exp, $months_exp, $id_work_reference, $id_personal_ref, $start_contract, $end_contract, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_staff, $years_exp, $months_exp, $id_work_reference, $id_personal_ref, $start_contract, $end_contract, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>