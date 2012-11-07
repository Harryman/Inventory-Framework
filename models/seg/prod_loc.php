<?php
namespace models\seg;
class Prod_loc extends \libs\Model {
    public $table = "prod_loc";
    function __construct() {
        parent::__construct();
    }
    
    function insert(){
       $this->db->query("INSERT INTO prod_loc (`p_id`,`id`) VALUES (\"".$_POST['p_id']."\",\"".$_POST['id']."\")");
    }
    function get($id){
        $st = $this->db->query("SELECT `id` FROM prod_loc WHERE `p_id`= '".$id."'");
        $ret = $st->fetchAll(\PDO::FETCH_ASSOC);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function del(){
        $this->db->query("DELETE FROM prod_loc WHERE `p_id` =  '".$_POST['p_id']."' AND `id` = '".$_POST['id']."'");
    }
}