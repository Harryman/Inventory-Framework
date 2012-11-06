<?php
namespace models\seg;
class related extends \libs\Model {
    public $table = "related";
    function __construct() {
        parent::__construct();
    }
    
    function insert(){
       $this->db->query("INSERT INTO related (`p_id`,`related_id`) VALUES (\"".$_POST['p_id']."\",\"".$_POST['related_id']."\")");
    }
    function get($id){
        $st = $this->db->query("SELECT `related_id` FROM related WHERE `p_id`= '".$id."'");
        $ret = $st->fetchAll(\PDO::FETCH_ASSOC);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function del(){
        $this->db->query("DELETE FROM related WHERE `p_id` =  '".$_POST['p_id']."' AND `related_id` = '".$_POST['related_id']."'");
    }
}