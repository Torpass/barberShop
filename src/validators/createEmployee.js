"use strict";

const descriptionInput = document.getElementById('txtDescripcion');
const horariosTnput = document.getElementById('txtHorarios');
const phoneInput = document.getElementById('txtTelefono');
const emailInput = document.getElementById('txtEmail');
const cedulaInput = document.getElementById('txtCedula');
const lastnameInput = document.getElementById('txtApellido');
const nombreInput = document.getElementById('txtNombre');

console.log("holi");

const removeError = () =>{
    const error = document.querySelector('#error-message');
    if(error){
        error.remove();
    }
}

descriptionInput.addEventListener("keydown", () => {
    if(descriptionInput.value.length < 10){
        putError(descriptionInput, 'La descripción debe tener al menos 10 caracteres');
        return;
    }

    if(descriptionInput.value.length > 255){
        putError(descriptionInput, 'La descripción no debe tener más de 255 caracteres');
        return;
    }

    removeError();
})

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

nombreInput.addEventListener("keydown", () =>{
    if(nombreInput.value.length < 3){
        putError(nombreInput, 'El nombre debe tener al menos 3 caracteres');
        return;
    }
    removeError();
})

cedulaInput.addEventListener("keydown", (e) =>{
    if(cedulaInput.value.length < 6){
        putError(cedulaInput, '¡La cedula debe tener al menos 7 caracteres!');
        return;
    }
    if(cedulaInput.value.length > 7){
        putError(cedulaInput, '¡La cedula no debe tener más de 9 caracteres!');
        if(e.key != 'Backspace'){
            e.preventDefault();
        }
        return;
    }
    removeError();
})

lastnameInput.addEventListener("keydown", () =>{
    if(lastnameInput.value.length < 3){
        putError(lastnameInput, '¡El apellido debe tener al menos 3 caracteres!');
        return;
    }
    removeError();
})

phoneInput.addEventListener("keydown", (e) =>{
    const regex = /^04/;
    if (!regex.test(phoneInput.value)) {
        putError(phoneInput, 'El número de teléfono debe empezar por 04');
        return;
    }
    if(phoneInput.value.length < 10){
        putError(phoneInput, '¡El teléfono debe tener al menos 11 caracteres!');
        return;
    }
    if(phoneInput.value.length > 10){
        putError(phoneInput, '¡El teléfono no debe tener más de 11 caracteres!');
        if(e.key != 'Backspace'){
            e.preventDefault();
        }
        return;
    }

    removeError();
})

horariosTnput.addEventListener("change", () =>{
    if(Array.from(horariosTnput.options).filter(option => option.selected).length < 1){
        putError(horariosTnput, 'Debes tener al menos un horario');
        return;
    }
    removeError();
})
