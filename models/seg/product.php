<?php
namespace models\seg;
class Product extends \libs\Model {
    public $table = "product";
    public $key = "id";
    function __construct() {
        parent::__construct();
    }
    
    function insert($id){
       $ret = $this->insertSeg([$this->key,"short_name","part_num","desc","short_desc","qty","price","cost","loc_desc","ship_note","order_info","other_info","weight","jn_number","active","sold","date"],$id);
       echo $ret; 
    }
    function get($id){
        $ret = $this->getSeg($this->key, $id);
        $result = json_encode($ret);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function del($id){
        $this->delSeg($this->key, $id);
    }
    function getFkey($fkey){
        $ret = $this->getColWhere("CHILD ID", "CHILD TABLE", "FOREIGN KEY COLMN", $fkey);
        return $ret;
    }
    function ac($field){
        $field = "%".$field."%";
        $st = $this->db->prepare("SELECT * FROM product WHERE `id` LIKE :field OR `short_name` LIKE :field  OR `part_num` LIKE :field");
        $st->execute([":field"=> $field]);
        $result = $st->fetchAll(\PDO::FETCH_ASSOC);
        $i = 0;
        foreach($result as $iter){
            $coded[$i]['label'] = $iter['short_name'];
            $coded[$i]['value'] = $iter['id'];
            $i++;
        }
        $coded = json_encode($coded);
        header('Content-Type: application/json');
        echo $coded;
    }
}