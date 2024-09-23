@extends('layouts.app')
@section('content')
<div class="container">
    <div class="pageTitle">Consulte as Condições Climáticas de Qualquer Local Em Menos de Três Cliques!</div>
    @include('searchWeatherForm')
</div>
@endsection
@push('scripts')
    @vite('resources/js/components/form.js')
@endpush