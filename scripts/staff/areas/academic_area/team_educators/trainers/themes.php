<?php
namespace App;
class themes extends connect{
    private $queryPost = 'INSERT INTO themes(id_chapter, name_theme, start_date, end_date, description, duration_days) VALUES(:chapter,:nameTheme, :startDate, :endDate, :description, :durationDays)';
    private $queryGetAll = 'SELECT * FROM themes';
    private $queryGet = 'SELECT * FROM themes WHERE id = ?';
    private $queryDelete = 'DELETE FROM themes WHERE id = ?';
    private $queryUpdate = 'UPDATE themes SET id_chapter = ?, name_theme = ?, start_date = ?, end_date = ?, description = ?, duration_days = ? WHERE id = ?';
    private $message;
    use getInstance;
    function __construct(public $id_chapter = 1, public $name_theme = 1, public $start_date = 1, public $end_date = 1, public $description = 1, public $duration_days = 1){
        parent::__construct();
    }

    public function postThemes(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("chapter", $this->id_chapter);
            $res->bindValue("nameTheme, ", $this->name_theme);
            $res->bindValue("startDate", $this->start_date);
            $res->bindValue("endDate", $this->end_date);
            $res->bindValue("description", $this->description);
            $res->bindValue("durationDays", $this->duration_days);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllThemes(){
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

    public function getThemes($id){
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

    public function deleteThemes($id){
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

    public function updateThemes( $id_chapter, $name_theme, $start_date, $end_date, $description, $duration_days, $id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$id_chapter, $name_theme, $start_date, $end_date, $description, $duration_days,$id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>