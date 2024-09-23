<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form id="cepForm">
                @csrf
                <div class="form-group">
                    <label class="wlabel"for="cep">Possui um CEP?</label>
                    <input class="wInput"type="text" id="cep" name="cep" class="form-control" placeholder="Digite o CEP aqui">
                </div>
                <div class="form-group">
                    <label class="wlabel" for="city">Localização *</label>
                    <input class="wInput" type="text" id="city" name="city" class="form-control" placeholder="Ou digite uma Localização">
                </div>
                <button type="button" id="wSearch" class="btn btn-primary wBtn" >Buscar</button>
            </form>
        </div>
        <div class="col-md-6">
            <div id="error-message" class="alert alert-danger shadow rounded wErrorMsg" style="display: none;"></div>
            <div id="weather-container" class="shadow rounded" style="padding: 20px; min-height: 200px;">
            </div>
        </div>
    </div>
</div>
