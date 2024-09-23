import { handleCepBlur } from './cepHandler';
import { displayWeather, displayError } from './weatherDisplay';
import { handleFormSubmit } from './formHandler';

$(document).ready(function () {
    // Chama a função para lidar com o CEP
    handleCepBlur(displayError);
    // Evento para ação no botão buscar
    $('#wSearch').on('click', function () {
        handleFormSubmit(displayWeather, displayError);
    });
});
