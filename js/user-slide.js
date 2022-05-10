const slide = document.getElementById('__userSlide');

const button_trigger = document.getElementById('__userProfileButton');

button_trigger.addEventListener('click', function(){

    if(slide.style.display == 'block'){

        slide.style.display = 'none';

    }else{

        slide.style.display='block';

    }
});
