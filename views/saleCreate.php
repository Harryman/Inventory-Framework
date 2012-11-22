<?php
namespace views;
class SaleCreate extends \libs\View {

    protected $table = "saleCreate";
    function __construct(){
        parent::__construct();
    }
 function view(){
     require "html/saleCreate/view.html";
     echo "<script src=\"".URL."js/saleCreate.js\"></script>";
     
 }
}
  