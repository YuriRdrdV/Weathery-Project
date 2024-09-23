// Função para busca de CEP
export function handleCepBlur(displayError) {
    $('#cep').on('blur', function () {
        const cep = $('#cep').val().trim();
        if (cep.length === 8) {
            $.ajax({
                url: `https://viacep.com.br/ws/${cep}/json/`,
                type: 'GET',
                success: function (data) {
                    if (!("erro" in data)) {
                        console.log(data);
                        $('#city').val(data.estado + " " + data.localidade || '');
                    }else{
                        displayError('Conexão',"Erro na busca pelo CEP, digite uma localização.");
                    }
                },
                error: function () {
                    console.log(data);
                    displayError('Conexão',"Erro na busca pelo CEP, digite uma localização.");
                }
            });
        }
    });
}
