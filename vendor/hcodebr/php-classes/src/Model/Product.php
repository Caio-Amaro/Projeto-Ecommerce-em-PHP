<?php

namespace Hcode\Model;

use \Hcode\Db\Sql;

use \Hcode\Model;

use \Hcode\Mailer;

class Product extends Model {


    public static function listAll()
    {

    $sql = new Sql();

    return $sql->select("SELECT * FROM tb_products ORDER BY desproduct");

    }

    public function save()
    {

         $sql = new Sql();

        $resul = $sql->select("CALL sp_products_save(:idproduct, :desproduct, :vlprice, :vlwidth, :vlheight, :vllength, :vlweight, :desurl)", 
        array(
            ":idproduct"=>$this->getidproduct(),
            ":desproduct"=>$this->getdesproduct(),
            "vlprice"=>$this->getvlprice(),
            "vlwidth"=>$this->getvlwidth(),
            "vlheight"=>$this->getvlheight(),
            "vllength"=>$this->getvllength(),
            "vlweight"=>$this->getvlweight(),
            "desurl"=>$this->getdesurl()
            
            
        ));

        $this->setData($resul[0]);

       
    }


    public function get($idproduct)
    {


        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_products WHERE idproduct = :idproduct", array(

            ":idproduct"=>$idproduct
        ));

        $this->setData($results[0]);

    }

    public function delete()
    {

        $sql = new Sql();

        $sql->query("DELETE FROM tb_categories WHERE idproduct = :idproduct", [

            "idproduct"=>$this->getidproduct()

        ]);

       
    }

    public function checkPhoto()
    {

        if (flie_exists(
            $_SERVER['DOCUMENT_ROOT']).DIRECTORY_SEPARATOR. "res"
             . DIRECTORY_SEPARATOR . "site"
             . DIRECTORY_SEPARATOR . "img"
             . DIRECTORY_SEPARATOR . "product"
             . DIRECTORY_SEPARATOR . $this->getidproduct() . ".jpg"
             ) {

                 $url = "/res/site/img/product/" . $this->getidproduct . ".jpg";
             
                } else {
                    
                    $url = "/res/site/img/product.jpg" ;
                } 

                return $this->setdesphoto($url);


    }

    public function getValues()
    {

        $this->checkPhoto();

        $values = parent::getValues();

        return $values;

    }

    public function setPhoto($file)
    {
        $extension = explode(".", $file['name']);
       $extension = end($extension);

    switch ($extension) {
        case 'jpg':
        case 'jpeg':

        $image = imagecreatefromjpeg($file["tmp_name"]);
            
            break;
        
        case 'gif':
        
        $image = imagecreatefromgif($file["tmp_name"]);
            
            break;
        
        case 'png':

        $image = imagecreatefrompng($file["tmp_name"]);
        
            break;
    }

    $dest = ($_SERVER['DOCUMENT_ROOT']).DIRECTORY_SEPARATOR. "res"
             . DIRECTORY_SEPARATOR . "site"
             . DIRECTORY_SEPARATOR . "img"
             . DIRECTORY_SEPARATOR . "product"
             . DIRECTORY_SEPARATOR . $this->getidproduct() . ".jpg";
             

}
   
}

?>