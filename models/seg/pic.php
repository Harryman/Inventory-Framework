<?php
namespace models\seg;
class Pic extends \libs\Model {
    public $table = "pic";
    function __construct() {
        parent::__construct();
    }
    function update($p_id, $id){
        $this->db->query("UPDATE pic SET `primary`= '0' WHERE `p_id`= '".$p_id."' AND `primary` = '1'");
        $this->db->query("UPDATE pic SET `primary`= '1' WHERE `id`= '".$id."'"); 
    }
    function get($id){
        $st = $this->db->query("SELECT * FROM pic WHERE `p_id`= '".$id."'");
        $ret = $st->fetchAll(\PDO::FETCH_ASSOC);
        $result = json_encode($ret,JSON_FORCE_OBJECT);
        header('Content-Type: application/json');
        echo $result;
        return $ret;
    }
    function del(){
        $this->db->query("DELETE FROM pic WHERE `id` = '".$_POST['id']."'");
    }
 
 function thumb_size($w,$h,$scale){
            $k = $scale / max($w, $h);
            return $k;
    }
    function upload(){
        $file = $this->getNormalizedFILES();
        $p_id = $_POST['p_id'];
        foreach($file['pic'] as $src){
            list($w,$h,$type,$atrb) = getimagesize($src['tmp_name']);
            $src_img = imagecreatefromjpeg($src['tmp_name']);
            $base = 125;
            $st = $this->db->query("INSERT INTO pic (`p_id`) VALUES (".$p_id.")");
            $pic_id = $this->db->lastInsertId();
            for($i=0; $i<3; $i++){
                $scale1 = $this->thumb_size($w,$h,$base);
                $w1 = $w*$scale1;
                $h1 = $h*$scale1;
                $img1 = imagecreatetruecolor($w1, $h1);
                imagecopyresampled($img1, $src_img,0,0,0,0,$w1,$h1,$w,$h);
                imagejpeg($img1,'uploads/images/product/'.$pic_id.'_'.$base.'.jpg');
                $base = $base * 2;
                imagedestroy($img1);
            }
            imagejpeg($src_img,'uploads/images/product/'.$pic_id.'.jpg');
            imagedestroy($src_img);
            $ret[] = $pic_id;
        }
        header('Content-Type: application/json');
        echo json_encode($ret);
    }
}