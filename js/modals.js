const login_trigger = document.getElementById("login-trigger");
const close_login_modal = document.getElementById("close-login-modal");

const register_trigger = document.getElementById("register-trigger");
const close_register_modal = document.getElementById("close-register-modal");

const login_modal = document.getElementById("login-modal");
const register_modal = document.getElementById("register-modal");

function closeLoginModal(){
    if(login_modal.style.display == 'block'){
        login_modal.style.display = 'none';
    }else{
        login_modal.style.display='block';
    }
}

function closeRegisterModal(){
    if(register_modal.style.display == 'block'){
        register_modal.style.display = 'none';
    }else{
        register_modal.style.display='block';
    }
}

login_trigger.addEventListener("click", closeLoginModal);
close_login_modal.addEventListener("click", closeLoginModal);

register_trigger.addEventListener("click", closeRegisterModal);
close_register_modal.addEventListener("click", closeRegisterModal);