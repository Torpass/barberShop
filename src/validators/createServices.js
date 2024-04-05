"use strict";

const priceInput = document.getElementById('txtPrecio');
const descriptionInput = document.getElementById('txtDetalles');
const duracionInput = document.getElementById('txtDuracion'); 


const removeError = () =>{
    const error = document.querySelector('#error-message');
    if(error){
        error.remove();
    }
}

console.log("holi")

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


duracionInput.addEventListener("keydown", (e) =>{
    if(duracionInput.value > 200){
        putError(duracionInput, 'La duracion no debe ser mayor a 200 minutos');
        if(e.key != 'Backspace'){
            e.preventDefault();
        }
        return;
    }
    removeError();
})

descriptionInput.addEventListener("keydown", (e) =>{
    if(descriptionInput.value.length < 3){
        putError(descriptionInput, 'La descripcion debe tener al menos 3 caracteres');
        return;
    }
    if(descriptionInput.value.length > 200){
        putError(descriptionInput, 'La descripcion no debe exeder los 200 caracteres');
        if(e.key != 'Backspace'){
            e.preventDefault();
        }
        return;
    }
    removeError();
})

priceInput.addEventListener("keydown", (e) =>{
    if(priceInput.value > 1000){
        putError(priceInput, 'El precio no debe ser mayor a 1000$');
        if(e.key != 'Backspace'){
            e.preventDefault();
        }
        return;
    }
    removeError();
})
