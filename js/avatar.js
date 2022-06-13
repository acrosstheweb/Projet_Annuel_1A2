const background = document.getElementById("__avatarBackground");
const color = document.getElementById("__avatarColor");
const eyes = document.getElementById("__avatarEyes");
const nose = document.getElementById("__avatarNose");
const glasses = document.getElementById("__avatarGlasses");

const backgroundPreview = document.getElementById("__avatarBackgroundPreview");
const facePreview = document.getElementById("__avatarFacePreview");
const colorPreview = document.getElementById("__avatarColorPreview");
const eyesPreview = document.getElementById("__avatarEyesPreview");
const nosePreview = document.getElementById("__avatarNosePreview");
const glassesPreview = document.getElementById("__avatarGlassesPreview");

const facesTitle = document.getElementById("__avatarFacesTitle");
const roundFaces = document.getElementById("__avatarRoundFaces");
const diamondFaces = document.getElementById("__avatarDiamondFaces");
const squareFaces = document.getElementById("__avatarSquareFaces");

const glassesChoices = document.getElementById("__avatarGlassesChoices");
const monoclesChoices = document.getElementById("__avatarMonoclesChoices");

function hideFace(){
    facePreview.setAttribute('src', '');
};

function hideColor(){
    colorPreview.setAttribute('src', '');
    color.setAttribute('value', '');
};


function showGlasses(){
    monoclesChoices.classList.add('d-none');
    glassesChoices.classList.remove('d-none');
}

function showMonocles(){
    glassesChoices.classList.add('d-none');
    monoclesChoices.classList.remove('d-none');
}


function displayBackground(src){
    backgroundPreview.setAttribute('src', src);
    background.setAttribute('value', src.split('__')[1]);
};

function displayFace(src){
    if (color.value !== ''){
        hideColor();
    };
    facePreview.setAttribute('src', src);
    facesTitle.classList.remove('d-none');
    if (src.split('__')[1] == 'visage-01.png'){
        roundFaces.classList.remove('d-none');
        if (!('d-none' in diamondFaces.classList)){
            diamondFaces.classList.add('d-none');
        }
        if (!('d-none' in squareFaces.classList)){
            squareFaces.classList.add('d-none');
        }
    } else if (src.split('__')[1] == 'visage-02.png'){
        diamondFaces.classList.remove('d-none');
        if (!('d-none' in roundFaces.classList)){
            roundFaces.classList.add('d-none');
        }
        if (!('d-none' in squareFaces.classList)){
            squareFaces.classList.add('d-none');
        }
    } else if (src.split('__')[1] == 'visage-03.png'){
        squareFaces.classList.remove('d-none');
        if (!('d-none' in roundFaces.classList)){
            roundFaces.classList.add('d-none');
        }
        if (!('d-none' in diamondFaces.classList)){
            diamondFaces.classList.add('d-none');
        }
    }
};

function displayColor(src){
    colorPreview.setAttribute('src', src);
    color.setAttribute('value', src.split('__')[1]);
    hideFace();
};

function displayEyes(src){
    eyesPreview.setAttribute('src', src);
    if (src.split('__')[1].substring(5,7) != glasses.value.substring(9,11)){
        glassesPreview.setAttribute('src', '');
        glasses.setAttribute('value', '');
    };
    eyes.setAttribute('value', src.split('__')[1]);
};

function displayNose(src){
    nosePreview.setAttribute('src', src);
    nose.setAttribute('value', src.split('__')[1]);
};

function displayGlasses(src){
    glassesPreview.setAttribute('src', src);
    glasses.setAttribute('value', src.split('__')[1]);
};

function emptyGlasses(){
    glassesPreview.setAttribute('src', '');
    glasses.setAttribute('value', '');
}