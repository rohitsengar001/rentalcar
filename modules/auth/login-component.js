console.log("login-component.js running");
let email = document.getElementById("email");
let password = document.getElementById('password');
let validEmail = false;

email.addEventListener("blur", () => {
    // console.log("event running");
    let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
    let str = email.value;
    let result = regex.test(str); //?return type :Boolean
    let emailFeedback = document.getElementById("email-feedback");
    let alertMsg = "";
    if (str === "") {
        alertMsg = `<b>Email is empty !</b>`;
        email.classList.add("is-invalid");
        validEmail = false;
    } else {
        if (result) {
            email.classList.remove("is-invalid");
            validEmail = true;
        } else {
            alertMsg = `<b>Email is not valid</b>`;
            email.classList.add("is-invalid");
            validEmail = false;
        }
    }
    emailFeedback.innerHTML = alertMsg;
});

password.addEventListener('blur',()=>{
    // console.log("password validate")
   let regex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/;
   let str = password.value;
   let result = regex.test(str);
   let passwordFeedback = document.getElementById("password-feedback");
   let alertMsg='';
    if(str === ''){
        alertMsg = '*Password is Empty';

    }else{
        if(!result){
            if(str.length < 8){
                alertMsg='Password is smaller than 8 characters!';
            }
            else if(str.length >20){
                alertMsg ='Password is greater than 20 characters!';
            }else{
                alertMsg="Special character is not available";
            }
        password.classList.add("is-invalid");
        }else{
            password.classList.remove("is-invalid");
        }

    }
   passwordFeedback.innerHTML=`<b>${alertMsg}<b>`;
});

