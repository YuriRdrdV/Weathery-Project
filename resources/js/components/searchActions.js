// Evento para a deleção de item da listagem pelo ID
$(document).on('click', '.delete-search', function () {
    const searchId = $(this).data('id');
    const csrfToken = $('input[name="_token"]').val();
    if (confirm('Você realmente deseja excluir esta busca?')) {
        $.ajax({
            url: '/searches/' + searchId,
            type: 'DELETE',
            data: {
                _token: csrfToken,
            },
            success: function (response) {
                if (response.success) {
                    $('#search-' + searchId).remove();
                    alert('Busca excluída com sucesso!');
                    location.reload();
                } else {
                    alert('Erro ao excluir a busca.');
                }
            },
            error: function (xhr) {
                alert('Ocorreu um erro. Por favor, tente novamente.');
            }
        });
    }
});

// Evento para construção da modal e bind do item1 de comparação
$(document).on('click', '.compare-search', function () {
    const searchId = $(this).data('id');
    $('#compareBtn').data('search-id', searchId);
    $('#compareModal').modal('show');
});

// Evento de ação para a comparação
$('#compareBtn').on('click', function () {
    const searchId = $(this).data('search-id');
    const compareWithId = $('#compareWithId').val();
    const comparisonType = $('#comparisonType').val();
    const csrfToken = $('input[name="_token"]').val();
    if (compareWithId && comparisonType) {
        $.ajax({
            url: '/compare',
            type: 'POST',
            data: {
                searchId: searchId,
                compareWithId: compareWithId,
                comparisonType: comparisonType,
                _token: csrfToken,
            },
            success: function (data) {
                $('#comparisonResults').html(`
                    <p>${data.result}</p>
                `);
            },
            error: function (xhr) {
                alert('Ocorreu um erro durante a comparação. Por favor, tente novamente.');
            }
        });
    } else {
        alert("Por favor, selecione um registro e um tipo de comparação.");
    }
});