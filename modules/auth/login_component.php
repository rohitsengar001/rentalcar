<?php
namespace rentalcar\modules\auth;
define("BLOCK_DIRECT_ACCESS",false);
session_start();

interface login_interface{
    public function login();
    public function logout();
}

class login_component implements login_interface{
    function __construct(){
        include __DIR__."./login-view.php";
    }
    public function login(){
        return 'component login function running';
    }
    public function logout(){
        unset($_SESSION['username']);
        session_destroy();
        header("Location: '".__DIR__."'./login-view.php");
        exit();
    }
}
$comp = new login_component();
//$temp=$comp->login();
echo "<script>
function onLogin(){
    let singinButton = document.getElementById('signin');
    singinButton.disabled=true;
    setTimeout(()=>{
        singinButton.disabled=false;
    },5000)
    console.log('".$comp->login()."')
}
</script>";
