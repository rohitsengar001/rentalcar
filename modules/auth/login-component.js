console.log("login-component.js running");
let email = document.getElementById("email");
let password = document.getElementById('password');
let userType = document.getElementById('userType');

(function(){
    let alertDiv = document.getElementById("alert-div");
    alertDiv.style.display='none';
})();
let validEmail = false;
let validPassword = false;
let validUserType = false;

email.addEventListener("blur", (event) => {
    // console.log("event running");
    let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
    let str = email.value;
    let result = regex.test(str); //?return type :Boolean
    let emailFeedback = document.getElementById("email-feedback");
    let alertMsg = "";
    event.stopPropagation();
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
    validEmail = result;
    emailFeedback.innerHTML = alertMsg;
});

password.addEventListener('blur', (event) => {
    // console.log("password validate")
    let regex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{8,16}$/;
    let str = password.value;
    let result = regex.test(str);
    let passwordFeedback = document.getElementById("password-feedback");
    let alertMsg = '';
    event.stopPropagation();
    if (str === '') {
        console.log("string is empty");
        alertMsg = 'Password is Empty';
        password.classList.add("is-invalid");
    } else {
        if (!result) {
            if (str.length < 8) {
                alertMsg = 'Password is smaller than 8 characters!';
            } else if (str.length > 20) {
                alertMsg = 'Password is greater than 20 characters!';
            } else {
                alertMsg = "Special character is not available";
            }
            password.classList.add("is-invalid");
        } else {
            password.classList.remove("is-invalid");
        }
    }
    passwordFeedback.innerHTML = `<b>${alertMsg}<b>`;
    validPassword = result;
});

userType.addEventListener('blur', (event) => {
    let msg = userType.value === "Select User" ? "kindly Select user type" : '';
    let userFeedback = document.getElementById('user-feedback');
    event.stopPropagation();
    if (userType.value === "Select User") {
        alert("kindly Select user type");
        validUserType = false;
    } else {
        validUserType = true;
    }
    userFeedback.innerHTML = `<b>${msg}</b>`;
    console.log("user blur:", msg);
});

let signInBtn = document.getElementById("signin");
signInBtn.addEventListener('click', (event) => {
    if (validUserType && validEmail && validPassword) {
        //navigate next routing
    } else {
        alert("please fill the all details correctly ");
    }
});

function closeAlertDiv(){
    let alertDiv = document.getElementById("alert-div");
    alertDiv.style.display = 'none';
}

