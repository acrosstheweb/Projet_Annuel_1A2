const slide = document.getElementById('user-slide');

const button_trigger = document.getElementById('user-profile-button');

button_trigger.addEventListener('click', function(){

    if(slide.style.display == 'block'){

        slide.style.display = 'none';

    }else{

        slide.style.display='block';

    }
});
