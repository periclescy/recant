/** Global Variables **/
const preloader_time = 3;  // Pre-loader time in seconds
const change_image_threshold  = 3; // how many times the  image changed in order to show Questionnaire button.
const execute_threshold  = 3; // how many times execute button is clicked in order to show Questionnaire button.

/** Set variables for elements **/
const loader_element = document.getElementById("loader-presentation");
const results_element = document.getElementById("results-presentation");
const results_button = document.getElementById("results-button");
const questionnaire_button = document.getElementById("questionnaire-button");
const image_cards = document.getElementsByClassName('card');

/** Set variables for localStorage **/
let change_image_counter = Number(localStorage.getItem("change-image-counter"));
let execute_counter = Number(localStorage.getItem("execute-counter"));

/** Functions **/
function showResults() {
    loader_element.classList.add("d-none");
    results_element.classList.remove("d-none");
}
function preloadFunc() {
    loader_element.classList.remove("d-none");
    setTimeout(showResults, preloader_time*1000);
    results_button.classList.remove("btn-success");
    results_button.classList.add("btn-outline-success");
    results_button.disabled = true;
}
function ShowQuestionnaireImageChange() {
    if (change_image_counter ) {
        let z = change_image_counter;
        z++;
        z=z.toString();
        localStorage.setItem("change-image-counter", z);
    }
    else {
        localStorage.setItem("change-image-counter", "1");
    }
}
function ShowQuestionnaireExecute() {
    if (!execute_counter && !change_image_counter) {
        localStorage.setItem("execute-counter", "1");
    }
    else {
        let i = execute_counter;
        i++;
        if (i >= execute_threshold || change_image_counter >= change_image_threshold) {
            questionnaire_button.classList.remove("d-none");
        }
        i=i.toString();
        localStorage.setItem("execute-counter", i);
    }
}

/** Clear Local Storage when visiting homepage **/
if ( window.location.pathname === '/' ) {
    localStorage.clear();
}

/** Functions Execution **/
if (results_button) {
    results_button.addEventListener("click", () => {
        preloadFunc();
        ShowQuestionnaireExecute();
    });
}
if (image_cards) {
    let element;
    for (element of image_cards) {
        element.addEventListener('click', ShowQuestionnaireImageChange);
    }
}