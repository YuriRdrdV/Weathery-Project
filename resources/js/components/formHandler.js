// Função para salvar a busca
function saveSearch(searchData, csrfToken) {
    $.ajax({
        url: '/savesearch',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        contentType: 'application/json',
        data: JSON.stringify({
            searchData
        }),
        success: function () {
            alert('Dados salvos com sucesso!');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Erro ao salvar dados:', errorThrown);
            alert('Ocorreu um erro ao salvar os dados: ' + errorThrown);
        }
    });
}

// Evento para salvar busca ao clicar no botão
$(document).on('click', '#wSaveData', function () {
    const searchData = $(this).data('searchData');
    const csrfToken = $('input[name="_token"]').val();
    saveSearch(searchData, csrfToken);
});

// Função para o formulário de busca para o weatherstack
export function handleFormSubmit(displayWeather, displayError) {
    const cidade = $('#city').val();
    const csrfToken = $('input[name="_token"]').val();
    $.ajax({
        url: 'http://127.0.0.1:8080/weather',
        data: { city: cidade, _token: csrfToken },
        method: 'POST',
        dataType: 'json',
        success: function (data) {
            if (data.success === false && data.error) {
                switch (data.error.code) {
                    case 404:
                        displayError(404, "Credencial de usuário inválida.");
                        break;
                    case 101:
                        displayError(101, "Credencial não informada.");
                        break;
                    case 429:
                        displayError(429, "Limite de buscas mensais excedido.");
                        break;
                    case 601:
                        displayError(601, "Região inválida informada.");
                        break;
                    default:
                        displayError(data.error.code, "Erro desconhecido.");
                }
            } else {
                console.log(data);
                displayWeather(data, csrfToken);
                const searchData = {
                    name: data.location.name,
                    country: data.location.country,
                    region: data.location.region,
                    localtime: data.location.localtime,
                    temperature: data.current.temperature,
                    feelslike: data.current.feelslike,
                    weather: data.current.weather_descriptions[0],
                    icon: data.current.weather_icons[0],
                    wind_speed: data.current.wind_speed,
                    humidity: data.current.humidity,
                    precip: data.current.precip
                };
                $('#wSaveData').data('searchData', searchData);
            }
        },
        error: function (xhr) {
            displayError(xhr.status, "Erro interno na aplicação Wheatery.");
        }
    });
}
