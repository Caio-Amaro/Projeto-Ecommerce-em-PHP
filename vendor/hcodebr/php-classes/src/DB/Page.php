<?php

namespace Hcode\DB;

use Rain\Tpl;


class Page {

    private $tpl;
    private $options = [];
    private $defaults = [

        "data" => []

    ];

    public function __construct ($opts = array())
    {

    $this->options = array_merge($this->defaults, $opts);
   
    $config = array(
    
        "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/ecommerce/views/",
		"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/ecommerce/views-cache/",
		"debug"         => false
	);

    Tpl::configure( $config );
    
    $this->Tpl = new Tpl();

    $this->setData($this->options["data"]);

    $this->Tpl->draw("header");

    }

    private function setData($data = array())
    {
        foreach ($data as $key => $value) 
        {
        $this->Tpl->assign($key, $value);
        }

    }

    public function setTpl($name, $data=array(), $returnHtml = false)
    {
        $this->setData($data);

        return $this->Tpl->draw($name, $returnHtml);
    }

    public function __destruct() 
    {

        $this->Tpl->draw("footer");

    }


}

?>