<?php

class Bootstrap {

    function __construct() {

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);   
        
        if (empty($url[0])) {
            require 'controllers/index.php';
            $controller = new Index();
            $controller->index();
            return false;
        }

        if ($url[0] == 'seg') {

            $file = 'controllers/seg/' . $url[1] . '.php';
            if (file_exists($file)) {
                require $file;
            } else {
                $this->error();
            }
            $ns = "\controllers\seg\\".$url[1];
            $controller = new $ns;
       //     $controller->loadSeg($url[1]);

            if (isset($url[2])) {
                if (method_exists($controller, $url[2])) {
                    if (isset($url[5])) {
                        $controller->{$url[2]}($url[3], $url[4], $url[5]);
                    } else {
                        if (isset($url[4])) {
                            $controller->{$url[2]}($url[3], $url[4]);
                        } else {
                            if (isset($url[3])) {
                                $controller->{$url[2]}($url[3]);
                            } else {
                                $controller->$url[2]();
                            }
                        }
                    }
                } else {
                    $this->error("the method " . $url[2] . " doesn't exsist");
                }
            } else {
                $controller->index();
            }
        } else {

            $file = 'controllers/' . $url[0] . '.php';
            if (file_exists($file)) {
                require $file;
            } else {
                $this->error();
            }
            $ns = "\controllers\\".$url[0];
            $controller = new $ns;
         //   $controller->loadModel($url[0]);

            // calling methods
            if (isset($url[2])) {
                if (method_exists($controller, $url[1])) {
                    $controller->{$url[1]}($url[2]);
                } else {
                    $this->error("url2 isset, url1 method does't exsist");
                }
            } else {
                if (isset($url[1])) {
                    if (method_exists($controller, $url[1])) {
                        $controller->{$url[1]}();
                    } else {
                        $this->error("url1 isset, url1 meth doesn't exsist");
                    }
                } else {
                    $controller->index();
                }
            }
        }
    }
        function error($er = "unchecked error") {
            require 'controllers/error.php';
            $controller = new Error();
            $controller->index($er);
            return false;
        }
}
