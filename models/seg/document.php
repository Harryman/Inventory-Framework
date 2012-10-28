<?php
namespace models\seg;
class Document extends \libs\Model {
    public $table = "document";
    function __construct() {
        parent::__construct();
    }
    
    function insert($id){
       $ret = $this->insertSeg(["doc_id", "namespace", "description", "code"],$id);
       echo $ret; 
    }
    function get($id){
        $ret = $this->getSeg("doc_id", $id);
        echo $ret;
    }
    
    
    
  /*  function insert($id){
           $st = $this->db->prepare("INSERT INTO `document`(`doc_id`, `namespace`, `description`,`code`) VALUES (:doc_id,:namespace,:description,:code) ON DUPLICATE KEY UPDATE `namespace` = VALUES(`namespace`), `description` = VALUES(`description`), `code` = VALUES(`code`)");
           $st->execute([':doc_id'=> $id,':namespace'=>$_POST['namespace'],':description'=>$_POST['description'],':code'=>$_POST['code']]);
           $ret = $this->db->lastInsertId();
           echo $ret;
    }
    function get($id){
        $st = $this->db->prepare("SELECT * FROM `document` WHERE `doc_id` = :id");
        $st->execute([':id'=>$id]);  
       $result = $st->fetch(\PDO::FETCH_ASSOC);
       $result = json_encode($result);
       header('Content-Type: application/json');
        echo($result);
    }*/
}