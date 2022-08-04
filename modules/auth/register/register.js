console.log("register js working");
let email = document.getElementById('email');
let password = document.getElementById('password');
let phone = document.getElementById('phone');
let alertDiv = document.getElementById("alert-div");
let validEmail = false;
let validPassword = false;
let validPhone = false;
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

phone.addEventListener("blur", (event) => {
    event.stopPropagation();
    let phoneFeedback = document.getElementById('phone-feedback');
    let reg = /^\d{10}$/;
    let result = reg.test(phone.value);
    let msg = '';
    if (result) {
        validPhone = true;
        phoneFeedback.classList.remove('is-invalid')
    } else {
        validPhone = false;
        phoneFeedback.classList.add('is-invalid')
        msg = `<b>Enter Valid Phone!<b>`;
    }
    console.log("phone-validation:", msg);
    phoneFeedback.innerHTML = msg;
});
let gridCheck = document.getElementById("gridCheck");
gridCheck.addEventListener('click', (event) => {
    console.log("checkbtnclick", validPhone, validEmail, validPassword);
    let registerBtn = document.getElementById("registerBtn");
    if (validPhone && validEmail && validPassword) {
        registerBtn.disabled = false;
    } else {
        console.log("else case");
        alert("please fill the all details mandatory fields correctly");
        gridCheck.checked =false;
    }
});
