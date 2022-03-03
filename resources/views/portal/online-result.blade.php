@extends('layout')
@section('content')
@csrf
<h1> Ejemplo getOnlineSales </h1>

<h3>Parametros recibidos:</h3>
<pre>
    {{ print_r($req) }}
</pre>


<h3>Respuesta:</h3>
    <table class="table table-sm table-striped table-hover">
        <thead>
            <tr>
                <th >nombre Fantasia</th>
                <th >ordenCompra</th>
                <th >tarjeta</th>
                <th >numTarjeta</th>
                <th >monto</th>
                <th >fec Transacción</th>

            </tr>
        </thead>
        <tbody>
        @foreach($res as $item)
            <tr>
                <td>{{ $item['nombreFantasia'] }}</td>
                <td>{{ $item['ordenCompra'] }}</td>
                <td>{{ $item['tarjeta'] }}</td>
                <td>{{ $item['numeroTarjeta'] }}</td>
                <td>{{ $item['montoTransaccion'] }}</td>
                <td>{{ $item['anioTransaccion'].'-'.$item['mesTransaccion'].'-'.$item['diaTransaccion'].' '.$item['horaTransaccion'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection
