@extends('layouts.app')

@section('content')
<div class="container">
    <div class="pageTitle">Minhas Buscas</div>
    @if($searches->isEmpty())
        <div class="alert alert-info">Você ainda não fez nenhuma busca.</div>
    @else
        <div class="table-responsive"> <!-- Adicionando a classe table-responsive -->
            <table class="table text-center">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>País</th>
                        <th>Região</th>
                        <th>Data/Hora Local</th>
                        <th>Temperatura</th>
                        <th>Sensação Térmica</th>
                        <th>Clima</th>
                        <th>Velocidade do Vento</th>
                        <th>Umidade</th>
                        <th>Precipitação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($searches as $search)
                        <tr>
                            <td><img src="{{ $search->icon }}" alt="{{ $search->weather }}" class="weatherIcon"></td>
                            <td>{{ $search->name }}</td>
                            <td>{{ $search->country }}</td>
                            <td>{{ $search->region }}</td>
                            <td>{{ $search->localtime }}</td>
                            <td>{{ $search->temperature }} °C</td>
                            <td>{{ $search->feelslike }} °C</td>
                            <td>{{ $search->weather }}</td>
                            <td>{{ $search->wind_speed }} km/h</td>
                            <td>{{ $search->humidity }}%</td>
                            <td>{{ $search->precip }} mm</td>
                            <td>
                            <div class="d-flex">
                                <button class="btn delete-search action d-inline-block" data-id="{{ $search->id }}" title="Excluir">
                                    <i class="fas fa-trash-alt" style="Color:red"></i>
                                </button>
                                <button class="btn compare-search action d-inline-block" data-id="{{ $search->id }}" title="Comparar">
                                    <i class="fas fa-exchange-alt" style="Color:black"></i>
                                </button>
                            </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
<div class="modal fade" id="compareModal" tabindex="-1" aria-labelledby="compareModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="compareModalLabel">Comparar Registros</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="compareWithId">Selecione o registro para comparar:</label>
                    <select id="compareWithId" class="form-control">
                        @foreach($searches as $search)
                            <option value="{{ $search->id }}">{{ $search->name }} - {{ $search->country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="comparisonType">Selecione o tipo de comparação:</label>
                    <select id="comparisonType" class="form-control">
                        <option value="temperature">Temperatura</option>
                        <option value="humidity">Umidade</option>
                        <option value="wind_speed">Velocidade do Vento</option>
                    </select>
                </div>
                <div id="comparisonResults" class="mt-3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="compareBtn" class="btn btn-primary">Comparar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    @vite('resources/js/components/searchActions.js')
@endpush