@extends('layout')
@section('content')
<h3>Request</h3>
<pre> {{  print_r($req, true) }} </pre>
<h3>Response</h3>
<pre> {{  print_r($res, true) }} </pre>
@endsection
