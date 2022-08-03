<?php
namespace rentalcar\modules\auth;
define("BLOCK_DIRECT_ACCESS", true);
session_start();

interface login_interface
{
    public function login();

}

class login_component implements login_interface
{
    function __construct()
    {
        if(isset($_SESSION['username'])){
        echo"constructor running";
            header("Location: ../agency/agency-component.php");
        }else{
            include __DIR__ . "./login-view.php";
        }
    }

    public function login()
    {
        $_SESSION['username'] = "valid_user";
        echo "token set";
    }


}

$comp = new login_component();
//$temp=$comp->login();
?>
<script>
    async function onLogin() {
        let singinButton = document.getElementById('signin');
        let alertDiv = document.getElementById("alert-div");
        let username = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        let userType =document.getElementById('userType').value;
        alertDiv.style.display = 'none';
        // console.log(userType,username,password);
        let errorMsg = ``;
        singinButton.disabled = true;
        let data = {
            email: username,
            password: password,
            user_type: userType
        }
        let payload = {
            method: 'POST',
            origin: '*',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        };
        let url = `http://localhost/rentalcar/api/auth/agency_user.php`;

        //object destructing of backend data
        let {success, status, message, token} = await fetch(url, payload).then(res => {
            return res.json()
        }).then(res => {
            return res;
        });
        console.log(success,message,status,token);

        //VALID USER
        if (success) {
            let temp="<?php $comp->login();?>";
            console.log(temp);
            singinButton.disabled = false;
                window.location=("http://localhost/rentalcar/modules/agency/agency-component");
        } else {
            // console.log("else block")
            errorMsg = `<strong>${message}</strong> You should check in on some of those fields below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="btn-alert-close" onclick="closeAlertDiv()" ></button>`
            alertDiv.style.display = 'block';
            alertDiv.innerHTML = errorMsg;
           setTimeout(()=>{
               singinButton.disabled = false;
           },3000)
        }
    }

</script>
