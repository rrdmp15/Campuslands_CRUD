<?php
namespace App;
class cities extends connect{
    private $queryPost = 'INSERT INTO cities(name_city, id_region) VALUES(:cities,:region)';
    private $queryGetAll = 'SELECT cities.name_city, regions.name_region FROM cities INNER JOIN regions ON cities.id_region = regions.id';
    private $queryGet = 'SELECT cities.name_city, regions.name_region FROM cities INNER JOIN regions ON cities.id_region = regions.id WHERE id = ?';
    private $queryDelete = 'DELETE FROM cities WHERE id = ?';
    private $queryUpdate = 'UPDATE cities SET name_city = ?, id_region = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(public $name_city = 1, public $id_region = 1){
        parent::__construct();
    }

    public function postCities(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("cities", $this->name_city);
            $res->bindValue("region", $this->id_region);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllCities(){
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

    public function getCities($id){
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

    public function deleteCities($id){
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

    public function updateCities( $name_city, $id_region, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$name_city, $id_region, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>