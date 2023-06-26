<?php
namespace App;
class team_schedule extends connect{
    private $queryPost = 'INSERT INTO team_schedule(team_name, check_in_skills, check_out_skills, check_in_soft, check_out_soft, check_in_english, check_out_english, check_in_review, check_out_review, id_journey) VALUES(:teamName,:InSkills,:outSkills,:inSoft,:outSoft, :inEnglish, :outEnglish, :inReview, :outReview, :idJourney)';

    private $queryGetAll = 'SELECT team_schedule.team_name, team_schedule.check_in_skills, team_schedule.check_out_skills, team_schedule.check_in_soft, team_schedule.check_out_soft, team_schedule.check_in_english, team_schedule.check_out_english, team_schedule.check_in_review, team_schedule.check_out_review, journey.name_journey FROM team_schedule INNER JOIN journey ON team_schedule.id_journey = journey.id';

    private $queryGet = 'SELECT team_schedule.team_name, team_schedule.check_in_skills, team_schedule.check_out_skills, team_schedule.check_in_soft, team_schedule.check_out_soft, team_schedule.check_in_english, team_schedule.check_out_english, team_schedule.check_in_review, team_schedule.check_out_review, journey.name_journey FROM team_schedule INNER JOIN journey ON team_schedule.id_journey = journey.id WHERE id = ?';

    private $queryDelete = 'DELETE FROM team_schedule WHERE id = ?';

    private $queryUpdate = 'UPDATE team_schedule SET team_name = ?, check_in_skills = ?, check_out_skills = ?, check_in_soft = ?, check_out_soft = ?, check_in_english = ?, check_out_english = ?, check_in_review = ?, check_out_review = ?, id_journey = ? WHERE id = ?';

    private $message;
    use getInstance;
    function __construct(public $team_name = 1, public $check_in_skills = 1, public $check_out_skills = 1, public $check_in_soft = 1, public $check_out_soft = 1, public $check_in_english = 1,public $check_out_english = 1, public $check_in_review = 1, public $check_out_review = 1, public $id_journey = 1){
        parent::__construct();
    }

    public function postTeam_schedule(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("teamName", $this->team_name);
            $res->bindValue("inSkills", $this->check_in_skills);
            $res->bindValue("outSkills", $this->check_out_skills);
            $res->bindValue("inSoft", $this->check_in_soft);
            $res->bindValue("outSoft", $this->check_out_soft);
            $res->bindValue("inEnglish", $this->check_in_english);
            $res->bindValue("outEnglish", $this->check_out_english);
            $res->bindValue("inReview", $this->check_in_review);
            $res->bindValue("outReview", $this->check_out_review);
            $res->bindValue("idJourney", $this->id_journey);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }

    public function getAllTeam_schedule(){
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

    public function getTeam_schedule($id){
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

    public function deleteTeam_schedule($id){
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

    public function updateTeam_schedule( $team_name, $check_in_skills, $check_out_skills, $check_in_soft, $check_out_soft, $check_in_english, $check_out_english, $check_in_review, $check_out_review, $id_journey,$id){
        try{
          $res = $this->conx->prepare($this->queryUpdate);
            $res->execute([$team_name, $check_in_skills, $check_out_skills, $check_in_soft, $check_out_soft, $check_in_english, $check_out_english, $check_in_review,$check_out_review, $id_journey, $id]);
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>