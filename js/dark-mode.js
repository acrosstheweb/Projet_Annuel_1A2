let today = new Date();
let date = (today.getFullYear()+42)+'-'+today.getMonth()+'-'+today.getDate();

const trigger = document.getElementById('__darkMode-trigger');



// FONCTIONS
function getCookieValue(name){
    let cookie = document.cookie;
    cookie = cookie.split(`; ${name}=`);
    return (cookie[cookie.length-1]);
}

function darkMode(){
    document.cookie = `darkMode=1; expires=Thu, ${date} UTC; path=/`;
    
    trigger.innerHTML = '<a class="nav-link __navIcon" href="#"><i class="fa-solid fa-sun"></i></a>';

    document.querySelector(":root").style.setProperty('--green1', '#2F3E46');
    document.querySelector(":root").style.setProperty('--green2', '#354F52');
    document.querySelector(":root").style.setProperty('--green4', '#84A98C');
    document.querySelector(":root").style.setProperty('--green5', '#CAD2C5');

    document.body.style.setProperty('background-color', 'var(--bs-dark)');
    document.body.style.setProperty('color', 'var(--bs-light)');
    console.log('jaaj0');

    const cards = document.getElementsByClassName('card');
    console.log(cards);
    for(let card of cards){
        console.log('jaaj');
        card.style.setProperty('background-color', 'var(--bs-dark)');
    }

    const navLight = document.getElementsByClassName('navbar-light');
    for(let nav of navLight){
        nav.classList.add('navbar-dark');
        nav.classList.remove('navbar-light');
    }

    const tables = document.getElementsByClassName('table');
    for(let table of tables){
        table.classList.add('table-dark');
    }
};

function lightMode(){
    document.cookie = `darkMode=0; expires=Thu, ${date} UTC; path=/`;

    trigger.innerHTML = '<a class="nav-link __navIcon" href="#"><i class="fa-solid fa-moon"></i></a>';
    
    document.querySelector(":root").style.setProperty('--green1', '#CAD2C5');
    document.querySelector(":root").style.setProperty('--green2', '#84A98C');
    document.querySelector(":root").style.setProperty('--green4', '#354F52');
    document.querySelector(":root").style.setProperty('--green5', '#2F3E46');
    
    document.body.style.setProperty('background-color', 'var(--bs-body-bg)');
    document.body.style.setProperty('color', 'var(--bs-body-color)');

    const cards = document.getElementsByClassName('card');
    for(let card of cards){
        card.style.setProperty('background-color', 'var(--bs-body-bg)');
    }

    const navDark = document.getElementsByClassName('navbar-dark');
    for(let nav of navDark){
        nav.classList.add('navbar-light');
        nav.classList.remove('navbar-dark');
    }

    const tables = document.getElementsByClassName('table');
    for(let table of tables){
        table.classList.remove('table-dark');
    }
};



// INITIALISATION DES PAGES
function init(){
    const value = getCookieValue('darkMode');

    if (value == 1){
        darkMode();
    } else if (value == 0){
        lightMode();
    } else {
        document.cookie = `darkMode=0; expires=Thu, ${date} UTC; path=/`;
    }
}



// TRIGGER
trigger.addEventListener('click', function(){

    if (getCookieValue('darkMode') == 0){
        darkMode();
    }else if (getCookieValue('darkMode') == 1){
        lightMode();
    }
});
