<?php
namespace models\seg;
class Prod_cat extends \libs\Model {
    public $table = "prod_cat";
    function __construct() {
        parent::__construct();
    }
    function insert(){
       $this->db->query("INSERT INTO prod_cat (`p_id`,`cat_id`) VALUES (\"".$_POST['p_id']."\",\"".$_POST['cat_id']."\")");
    }
    function get($id){
        $st = $this->db->query("SELECT `cat_id` FROM prod_cat WHERE `p_id`= '".$id."'");
        $ret = $st->fetchAll(\PDO::FETCH_ASSOC);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function del(){
        $this->db->query("DELETE FROM prod_cat WHERE `p_id` =  '".$_POST['p_id']."' AND `cat_id` = '".$_POST['cat_id']."'");
    }

}