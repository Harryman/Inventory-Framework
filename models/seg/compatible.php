<?php
namespace models\seg;
class Compatible extends \libs\Model {
    public $table = "compatible";
    function __construct() {
        parent::__construct();
    }
    
    function insert(){
       $this->db->query("INSERT INTO compatible (`p_id`,`compatible_id`) VALUES (\"".$_POST['p_id']."\",\"".$_POST['compatible_id']."\")");
    }
    function get($id){
        $st = $this->db->query("SELECT `compatible_id` FROM compatible WHERE `p_id`= '".$id."'");
        $ret = $st->fetchAll(\PDO::FETCH_ASSOC);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function del(){
        $this->db->query("DELETE FROM compatible WHERE `p_id` =  '".$_POST['p_id']."' AND `compatible_id` = '".$_POST['compatible_id']."'");
    }
}