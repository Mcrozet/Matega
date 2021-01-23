<?php 

namespace Utils;

class UserTools{
    
    function userIsConnected()
    {
        if(!isset($_SESSION['id']) && !isset($_SESSION['name']))
        {
            header('location:home');
            exit;
        }
    }

    function verifPassUser($password, $userInfos)
    {
        $connect = new \Models\connect();
        $now = time();    

        $password = hash('sha512', $password);
        $Verif_Pass = password_verify($password, $userInfos->password);
    
        if ($Verif_Pass) {
            $_SESSION['ouvert']=true;
            $_SESSION['id'] = $userInfos->id;
            $_SESSION['name'] = $userInfos->name;    
            $connect->updateConnection($userInfos->id, 0);
            $connect->updateTimestamp($userInfos->id, $now);
            return true;
        }
        return false;
    }

    function isEnableToConnect($numberTryConnect, $connected)
    {
        $connect = new \Models\Connect();

        $numberConnected = $numberTryConnect->tentatives + 1;
        $connect->updateConnection($connected->id, $numberConnected);
        $lastRegister = $connect->getOne('last_register', 'tryconnect', 'id_user', $connected->id);
        $now = time();    
        
        if($numberTryConnect->tentatives >= 7)
        {     
            if($lastRegister->last_register <= strtotime('now -30 Minutes'))
            {
                $connect->updateConnection($connected->id, 0);
            }
            else
            {
                $connect->updateTimestamp($connected->id, $now);
                header('location:signIn-connexionError-'.$connected->id);
                return false;
            }
        }
        return true;
    }

    
    function logout(){
		$_SESSION = array();
		session_destroy();
    }

}