<?php
namespace models;
class SaleCreate extends \libs\Model {
    public $table = "saleCreate";
    public $key = "id";
    function __construct() {
        parent::__construct();
    }
    function add($sku){
       $st = $this->db->query("SELECT * FROM `table 25` WHERE `sku` = '".$sku."'");
       $result = $st->fetch(\PDO::FETCH_ASSOC);
       echo "<tr>
            <td width=\"20%\"><a href=\"http://www.mcssl.com/store/midwestsupercub/".$result['page url']."\"><img border=\"0\" src=\"http://www.mcssl.com/content/177453/".$result['image']."\" width=\"250\"/></a></td>
            <td width=\"10%\"></td>
            <td width=\"70%\" align=\"left\" ><h3><a href=\"http://www.mcssl.com/store/midwestsupercub/".$result['page url']."\">".$result['product']."</a></h3>
            <p>".$result['short description']."</p></td>
          </tr>
          <tr>
            <td align=\"center\" width=\"20%\"> Part Number: <strong>".$result['sku']."</strong></td>
            <td width=\"10%\"></td>
            <td width=\"80%\" align=\"right\" ><h3><s>$".$result['price']." </s> $".$result['sale price']."&nbsp<a href=\"".$result['add to cart url']."\"><img src=\"http://www.mcssl.com/netcart/images/cart_buttons/cart_button_5.gif\"></a></h3></td>
      </tr>";
    }
}