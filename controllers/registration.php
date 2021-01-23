<?php 

/**
 * Add new player in bdd 
 *
 * @param [array] $get
 * @param [array] $post
 * @return void
 */
function newRegister($get, $post)
{
    $tournament = new Models\Tournaments();
    $tournament->addNewPlayer($post); 
    header('location:index.php?action=tournament&id='.$post['idt'].'&registered=true');
}

/**
 * Display registration page
 *
 * @param [array] $get
 * @return void
 */
function registration($get)
{
    $userTool = new Utils\UserTools();
    $userTool->userIsConnected();
    require('views/registrations/register.php');
}

/**
 * update bank datas about user
 *
 * @param [array] $get
 * @param [array] post
 * @return void
 */
function updateBankDatas($get, $post)
{
    $databaseObject = new Models\DatabaseObject();
    $registration = new Models\Registrations();

    $iban = htmlspecialchars($post['iban']);
    $bic = htmlspecialchars($post['bic']);
    $name = htmlspecialchars($post['nameBank']);
    $bank = htmlspecialchars($post['bank']);

    $array = ["iban" => $iban];

    if(checkIban(null, $array) == "valid")
    {
        $userDatasRegistered = $databaseObject->getOne("*", "bankDatas", "idUser", $_SESSION['id']);
        if($userDatasRegistered)
        {
            $registration->updateBankDatas($_SESSION['id'], $name, $iban, $bic, $bank);
        }
        else{
            $registration->addBankDatas($_SESSION['id'], $name, $iban, $bic, $bank);
        }
        header("location:userEvents-".$post['idContest']);
    }
    else{
        header("location:userEvents-".$post['idContest']."-errorIban");
    }

}

/**
 * check if iban is valid
 *
 * @param [array] $get
 * @param [array] post
 * @return void
 */
function checkIban($get, $post)
{
    $iban = htmlspecialchars($post['iban']);
    $bankTool = new Utils\BankTools();

    if($bankTool->isValidIban($iban))
    {
        echo "valid";
        return true;
    }
    else{
        echo "notValid";
        return false;
    }
}