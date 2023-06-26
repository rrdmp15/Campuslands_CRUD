<?php
    namespace App;
    class staff extends connect{
        private $queryPost = 'INSERT INTO staff(doc, first_name, second_name, first_surname, second_surname, eps, id_area, id_city) VALUES(:cc,:firstName,:secondName,:firstSurname,:secondSurname, :eps, :idArea, :idCity)';

        private $queryGetAll = 'SELECT staff.doc, staff.first_name, staff.second_name, staff.first_surname, staff.second_surname, staff.eps, areas.name_area, cities.name_city FROM ((staff INNER JOIN areas ON staff.id_area = areas.id) INNER JOIN cities ON staff.id_city = cities.id)';

        private $queryGet = 'SELECT staff.doc, staff.first_name, staff.second_name, staff.first_surname, staff.second_surname, staff.eps, areas.name_area, cities.name_city FROM ((staff INNER JOIN areas ON staff.id_area = areas.id) INNER JOIN cities ON staff.id_city = cities.id) WHERE id = ?';

        private $queryDelete = 'DELETE FROM staff WHERE id = ?';

        private $queryUpdate = 'UPDATE staff SET doc = ?, first_name = ?, second_name = ?, first_surname = ?, second_surname = ?, eps = ?, id_area = ?, id_city = ? WHERE id = ?';
        
        private $message;
        use getInstance;
        function __construct(private $doc = 1, public $first_name = 1, public $second_name = 1, public $first_surname = 1, public $second_surname = 1, public $eps = 1,public $id_area = 1, public $id_city = 1){
            parent::__construct();
        }

        public function postStaff(){
            try {
                $res = $this->conx->prepare($this->queryPost);
                $res->bindValue("cc", $this->doc);
                $res->bindValue("firstName", $this->first_name);
                $res->bindValue("secondName", $this->second_name);
                $res->bindValue("firstSurname", $this->first_surname);
                $res->bindValue("secondSurname", $this->second_surname);
                $res->bindValue("eps", $this->eps);
                $res->bindValue("idArea", $this->id_area);
                $res->bindValue("idCity", $this->id_city);
                $res->execute();
                $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
            } catch(\PDOException $e) {
                $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
            }finally{
                print_r($this->message);
            }
        }

        public function getAllStaff(){
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

        public function getStaff($id){
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

        public function deleteStaff($id){
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

        public function updateStaff( $doc, $first_name, $second_name, $first_surname, $second_surname, $eps, $id_area, $id_city, $id){
            try{
            $res = $this->conx->prepare($this->queryUpdate);
                $res->execute([$doc, $first_name, $second_name, $first_surname, $second_surname, $eps, $id_area, $id_city, $id]);
                $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
            } catch(\PDOException $e) {
                $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
            }finally{
                print_r($this->message);
            }
        }
    }
?>