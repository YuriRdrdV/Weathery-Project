// Função de construção do retorno do weatherstack
export function displayWeather(data) {
    var $localtime = new Date(data.location.localtime).toLocaleString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
    let weatherHtml = `
        <div class="weather-card">
            <div class="d-flex justify-content-between">
                <h2 class="p-2">${data.location.name}, ${data.location.country}</h2> 
                <p><img class="p-2 weatherIconSearch" src="${data.current.weather_icons[0]}" alt="Weather Icon"></p>
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row" class="wlabel">Região</th>
                        <td>${data.location.region}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="wlabel">Temperatura</th>
                        <td>${data.current.temperature}°C</td>
                    </tr>
                    <tr>
                        <th scope="row" class="wlabel">Sensação Térmica</th>
                        <td>${data.current.feelslike}°C</td>
                    </tr>
                    <tr>
                        <th scope="row" class="wlabel">Clima</th>
                        <td>${data.current.weather_descriptions[0]}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="wlabel">Velocidade do Vento</th>
                        <td>${data.current.wind_speed} km/h</td>
                    </tr>
                    <tr>
                        <th scope="row" class="wlabel">Humidade</th>
                        <td>${data.current.humidity}%</td>
                    </tr>
                    <tr>
                        <th scope="row" class="wlabel">Precipitação</th>
                        <td>${data.current.precip}%</td>
                    </tr>
                    <tr>
                        <th scope="row" class="wlabel">Hora Local</th>
                        <td>${$localtime}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="button" id="wSaveData" class="btn btn-primary wBtn">Salvar Pesquisa</button>
    `;
    $('#weather-container').html(weatherHtml);
}
// função para as mensagens de erro
export function displayError(errorCode, errorMessage) {
    $('#error-message').css('display', 'block').html('Erro ' + errorCode + ': ' + errorMessage);
    setTimeout(() => {
        $('#error-message').css('display', 'none').html('');
    }, 2000);
}
