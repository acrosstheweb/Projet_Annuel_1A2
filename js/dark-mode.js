const trigger = document.getElementById('__darkMode-trigger');

function darkMode(){
    trigger.innerHTML = '<a class="nav-link __navIcon" href="#"><i class="fa-solid fa-sun"></i></a>';
    trigger.setAttribute('data-darkMode', 1);

    document.querySelector(":root").style.setProperty('--green1', '#2F3E46');
    document.querySelector(":root").style.setProperty('--green2', '#354F52');
    document.querySelector(":root").style.setProperty('--green4', '#84A98C');
    document.querySelector(":root").style.setProperty('--green5', '#CAD2C5');

    document.querySelector(":root").style.setProperty('--bs-body-bg', '#212529');
    document.body.style.setProperty('color', 'var(--bs-light)');

    const cards = document.getElementsByClassName('card');
    for(let card of cards){
        card.style.setProperty('background-color', 'var(--bs-body-bg)');
    }
};

function lightMode(){
    trigger.innerHTML = '<a class="nav-link __navIcon" href="#"><i class="fa-solid fa-moon"></i></a>';
    trigger.setAttribute('data-darkMode', 0);
    
    document.querySelector(":root").style.setProperty('--green1', '#CAD2C5');
    document.querySelector(":root").style.setProperty('--green2', '#84A98C');
    document.querySelector(":root").style.setProperty('--green4', '#354F52');
    document.querySelector(":root").style.setProperty('--green5', '#2F3E46');
};

trigger.addEventListener('click', function(){
    console.log(document.getElementsByTagName('body'));

    if (trigger.getAttribute('data-darkMode') == 0){
        darkMode();
    }else if (trigger.getAttribute('data-darkMode') == 1){
        lightMode();
    }
});
