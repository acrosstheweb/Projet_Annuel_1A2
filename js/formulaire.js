const programExerciceList = document.getElementById('__programExerciceList');
const programContentPreview = document.getElementById('__programContentPreview');


let counter = 1;
const exerciceId = "__programExercice";




//Nom du programme
const programNamePreview = document.getElementById("__programNamePreview");
const programTitle = document.getElementById("__programTitle");

function displayProgramTitle(){
    programNamePreview.innerText = programTitle.value;
};



//Ajout d'un exercice
const addExercice_trigger = document.getElementById('__addExercice');

function addExercice(){
    let exercice = `
    <div id="${exerciceId}${counter}" class="__programExercice my-5 border-top">
    <div class="row my-3">
        <label for="__programExerciceDropdown${counter}" class="form-label fw-bold">Exercice #${counter}</label>
        <select class="form-select" name="programExerciceDropdown" id="__programExerciceDropdown${counter}" required="required" onchange="displayExercice(${counter})"><br>
            <option selected disabled>Exercice</option>
            <option value="1">Biceps Curl</option>
            <option value="2">Developpé couché</option>
            <option value="3">Rowing barre</option>
            <option value="4">Squat</option>
        </select>
        <p>L'exercice n'est pas dans la liste? Créez-le</p>
        <button class="btn btn-primary">+ Créer un exercice</button>
    </div>
    
    <div class="row my-3">
        <div class="col-12 col-md-6">
            <label for="__programSeries${counter}">Série(s) : </label><br>
            <input type="number" name="programSeries" id="__programSeries${counter}">
        </div>
        <div class="col-12 col-md-6">
            <label for="__programReps${counter}">Répétitions : </label><br>
            <input type="number" name="programReps" id="__programReps${counter}">
        </div>
    </div>
    </div>
    `;
    programExerciceList.innerHTML += exercice;

    
    let exercicePreview = `
    <tr id="__programExercicePreview${counter}">
        <td id="__programExerciceNamePreview${counter}"></td>
        <td id="__programExerciceRepsPreview${counter}"></td>
        <td id="__programExerciceDelete${counter}"><i class="fa-solid fa-trash-can"></i></td>
    </tr>
    `;
    programContentPreview.innerHTML += exercicePreview;
};

function displayExercice(n){
    //Nom exercice
    let exercice = document.getElementById(`__programExerciceDropdown${n}`);
    let exercicePreview = document.getElementById(`__programExerciceNamePreview${n}`);
    exercicePreview.innerText = exercice.options[exercice.selectedIndex].text;
};

function displayReps(n){
    //Series
    let series = document.getElementById(`__programSeries${n}`).value;
    let reps = document.getElementById(`__programReps${n}`).value;
    let repsPreview = document.getElementById(`__programExerciceRepsPreview${n}`);
    repsPreview.innerText = `${series}X${reps}`;
};

addExercice_trigger.addEventListener('click', function(){
    counter += 1;
    addExercice();
});


//Suppression d'un exercice