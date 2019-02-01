<?php

namespace Hcode\Model;

use \Hcode\Db\Sql;

use \Hcode\Model;

class User extends Model {

public static function  login ($login, $senha)
{

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(

            ":LOGIN" => $login
        ));

        if (count($result) === 0) 
        {
            throw new \Exception("Usuário Inexistente ou Senha Inválida");
            
        }

        $data = $result[0];

        if (password_verify($senha, $data["despassaword"]) === true);
        {
            $user = new User();

            $user-> setiduser($data["iduser"]);
        
        } else {
            
            throw new Exception("usuário Inexistente ou Senha Inválida");
            
        }
}

}

?>