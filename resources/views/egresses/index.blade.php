@extends('layouts.master')

@section('content')
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand">Egresos</a>
    {!! Form::open(['route' => 'egresses.index', 'method' => 'GET', 'class' => 'form-inline', 'role' => 'search']) !!}
        {!! Form::text('Girado', null, ['class' => 'form-control mr-sm-2 buscar-cash', 'placeholder' => 'Buscar']) !!}
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        <a href="{{ route('egresses.create') }}" class="btn btn-outline-primary my-2 my-sm-0">Crear</a>
    {!! Form::close() !!}
</nav>
<br>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<br>
<div class="container container-principal">
    @if($egresses->count())
    <table class="table table-hover">
        <thead>
            <tr>
                <th>N. Egreso</th>              
                <th>Girado</th>
                <th>Tipo de Documento</th>
                <th>Numero de Documento</th>
                <th>Fecha</th>
                <th>Valor</th>
                <th>Descripcion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($egresses as $egress)
            <tr>
                <td>{{$egress->exit_number}}</td>
                <td>{{$egress->turned}}</td>
                <td>{{$egress->document_type}}</td>
                <td>{{$egress->document_number}}</td>
                <td>{{$egress->date}}</td>
                <td>{{ number_format ($egress->value) }}</td>
                <td>{{$egress->description}}</td>
                <td class="text-right">
                    <a href="{{ route('egresses.show', $egress->id) }}" class="btn btn-outline-dark btn-sm">Ver</a>
                    <a href="{{ route('egresses.edit', $egress->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                    <form class="form-inline" method="post" action="{{route('egresses.destroy', $egress)}}"
                                onsubmit="return confirm('Estas seguro que deseas borrar el recibo de caja N° {{$egress->exit_number}}')">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="submit" value="Borrar" class="btn btn-outline-danger btn-sm">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $egresses->render() !!}
    @else
    <div class="egress-empty">
        <p class="egress-empty-title text-center">
            No hay Recibos de Cajas.
            <a href="{{ route('egresses.create') }}">Crea Ahora!</a>
        </p>
    </div>
    @endif
</div>
@endsection