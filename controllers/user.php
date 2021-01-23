<?php 

/* Display page */
function signIn($get)
{
    $connect = new Models\Connect();
    if(isset($get['error']) AND $get['error'] == 'connexionError')
    {
        $time = $connect->getOne('last_register', 'tryconnect', 'id_user', $get['id']);
        $now = time();
        $time = $time->last_register;
        $time = ($now - $time) / 60;
        $time = round(30-$time);
    }
    require("views/users/signIn.php");
}

/* Try to connect user with some protections */
function tryConnect($get, $post)
{
    $user = new Models\User();
    $connect = new Models\Connect();
    $userTools = new Utils\UserTools();

    $username = $post['username'];
    $password = $post['password'];

    /* get user and add one attempt */
    $connected = $user->getOne('*', 'users', 'name', $username);
    $numberTryConnect = $connect->getOne('tentatives', 'tryconnect', 'id_user', $connected->id);
    $now = time();

    /* if no attempt, add 1 and try connect, else, check if not > 7 */
    if(!$numberTryConnect)
    {
        $connect->addConnection($connected->id, $_SERVER['REMOTE_ADDR'], 1, $now);
    }
    else
    {
        /* Verif if user is enable to connect, else, update timestamp for others 30minutes */
        $isEnableToConnect = $userTools->isEnableToConnect($numberTryConnect, $connected);
    }

    if($isEnableToConnect)
    {
        if($userTools->verifPassUser($password, $connected))
        {        
            header("location:home");
        }
        else
        {
            header("location:signIn-errorLogin");
        } 
    }
}

/* display page sign up */
function signUp($get)
{
    require("views/users/signUp.php");
    if(isset($get['error']))
    {
        if($get["error"] == "errorName")
        {
            echo '<script>alert("Nom déjà utilisé")</script>';
        }
    }
}

/* Signout user */
function signOut()
{
    $user = new Utils\UserTools();
    $user->logout($_SESSION['id']);
    header('location:home');
}

/* Add new user in DB */
function newUser($get, $post)
{   
    $username = $post["username"];
    $password = $post["password"];    
    $hashed = hash('sha512', $password); 
    $hashed = password_hash($hashed, PASSWORD_DEFAULT);
    $user = new Models\User();

    $userExist = $user->getOne('*', 'users', 'name', $username);

    if($userExist)
    {
        header("location:signUp-errorName");
    }
    else
    {
        $user->addNewUser($username, $hashed);
        header("location:home");
    }
}

/* Check if user exist in DB */
function userExist($get, $post)
{
    $username = $post["name"];
    $user = new Models\User();
    $result = $user->getOne('*', 'users', 'name', $username);

    if(!$result)
    {
        echo "ok";
    }
}

/* Display page profil */
function userProfil()
{
    $userTool = new Utils\UserTools();
    $userTool->userIsConnected();
    $user = new Models\user();
    $user = $user->getOne('*', 'profil', 'id_user', $_SESSION['id']);
    $created = 'true';
    if(!$user)
    {
        $user = new \stdClass();
        $user->mail = false;
        $user->dci = false;
        $user->commander = false;
        $user->legacy = false;
        $user->standard = false;
        $user->modern = false;
        $user->vintage = false;
        $user->newTournament = false;
        $created = 'false';
    }
    require("views/users/userProfil.php");
}

/* Update user profil */
function updateProfil($get, $post)
{
    $userTool = new Utils\UserTools();
    $user = new Models\user();
    $userTool->userIsConnected();
    
    $favorites = ['commander' => false, 'legacy' => false, 'standard' => false, 'modern' => false, 'vintage' => false];
    for ($i=0; $i < count($post['favoritesTournament']); $i++) { 
        $a = $post['favoritesTournament'][$i];
        $favorites[$a] = true;
    }    
    if($post['created'] == "false")
    {
        $user->createProfil($_SESSION['id'], $post, $favorites);
    }
    else
    {
        $user->updateProfil($_SESSION['id'], $post, $favorites);
    }
    header('location:home');
}