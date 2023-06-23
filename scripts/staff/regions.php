<?php
    namespace App;
class regions extends connect{
    private $queryPost = 'INSERT INTO regions(name_region, id_country) VALUES(:regions,:country)';
    private $queryGetAll = 'SELECT * FROM regions';
    private $queryGet = 'SELECT * FROM regions WHERE id = ?';
    private $queryDelete = 'DELETE FROM regions WHERE id = ?';
    private $queryUpdate = 'UPDATE regions SET name_region = ?, id_country = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(public $name_region = 1, public $id_country = 1){
        parent::__construct();
    }

    public function postRegions(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("regions", $this->name_region);
            $res->bindValue("country", $this->id_country);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllRegions(){
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

    public function getRegions($id){
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

    public function deleteRegions($id){
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

    public function updateregions( $name_region, $id_country, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$name_region, $id_country, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>