<?php
namespace rental\modules\agency;
session_start();
define("BLOCK_DIRECT_ACCESS", true);
class agency_component
{
    function __construct()
    {
        if (isset($_SESSION['username'])) {
            echo "session:".$_SESSION['username'];
            include  './agency-view.php';
        } else {

            echo "you're not valid user";
            header("Refresh: 5;url= http://localhost/rentalcar/modules/auth/login-component");
        }
    }
    public function logout()
    {
        echo "logout-calling";
        unset($_SESSION['username']);
        session_destroy();
        exit();
//        header("Location: http://localhost/rentalcar/modules/auth/login-component");
    }
}

$agency_component = new agency_component();

?>

<script>
    let logoutBtn = document.getElementById("logout-btn");
    function logout(){
        console.log("logout : from js");
        //let msg ="<?php //$agency_component->logout();?>//";
    }
</script>

