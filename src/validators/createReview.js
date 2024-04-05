"use strict";

const nombreInput = document.getElementById('txtReview');

console.log("holi");

const removeError = () =>{
    const error = document.querySelector('#error-message');
    if(error){
        error.remove();
    }
}


const putError = (element, message) => {
    const parent = element.parentElement;
    const messageElement = document.createElement('p');
    messageElement.style.color = 'red';
    messageElement.textContent = message;
    messageElement.id = 'error-message';
    if(document.querySelector('#error-message')){
        return;
    }
    parent.append(messageElement);
}

nombreInput.addEventListener("keydown", (e) =>{
    if(nombreInput.value.length < 3){
        putError(nombreInput, 'El nombre debe tener al menos 3 caracteres');
        return;
    }
    if(nombreInput.value.length > 255){
        putError(nombreInput, 'El nombre no debe exeder los 255 caracteres');
        if(e.key != 'Backspace'){
            e.preventDefault();
        }
        return;
    }
    removeError();
})
