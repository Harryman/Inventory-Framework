<?php
namespace models\seg;
class TEMPLATE extends \libs\Model {

    function __construct() {
        parent::__construct();
    }
   
    function insert($id){
           $st = $this->db->prepare("INSERT INTO `TEMPLATE`(`doc_id`, `namespace`, `description`) VALUES (:doc_id,:namespace,:description) ON DUPLICATE KEY UPDATE `namespace` = VALUES(`namespace`), `description` = VALUES(`description`)");
           $st->execute([':doc_id'=> $id,':namespace'=>$_POST['namespace'],':description'=>$_POST['description']]);
           $ret = $this->db->lastInsertId();
           echo $ret;
    }
    function get($id){
        $st = $this->db->prepare("SELECT * FROM `TEMPLATE` WHERE `doc_id` = :id");
        $st->execute([':id'=>$id]);
        
       $result = $st->fetch(\PDO::FETCH_ASSOC);
       $result = json_encode($result);
       header('Content-Type: application/json');
        echo($result);
    }
    

    

}