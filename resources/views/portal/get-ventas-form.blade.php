@extends('layout')
@section('content')
@csrf
    <div class="card" style="width: 800px;">
        <div class="card-header">
        Portal api Abonos
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" id="tipoOperacion" name="tipoOperacion" onchange="changeTipoOperacion()" >
                            <option value="1">Ventas en línea de sus comercios</option>
                            <option value="2">Cantidad de ventas para las fechas indicadas</option>
                            <option value="3">Lista de transacciones historicas</option>
                            <option value="4">Resumen de venta por día</option>
                        </select>
                        <label for="tipoOperacion">Tipo Operación</label>
                    </div>
                </div>
            </div>

            <br/>

            <div id="divOp1" style="display: block">
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fechaDesde1" name="fechaDesde1" value="2021-12-05T01:20:53">
                            <label for="fechaDesde1">Desde</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fechaHasta1" name="fechaHasta1" value="2021-12-10T01:20:53">
                            <label for="fechaHasta1">Hasta</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="commerceCodes1" name="commerceCodes1" value="597030993500">
                            <label for="commerceCodes1">Codigos de comercio</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="identificadorTransaccion1" name="identificadorTransaccion1" value="">
                            <label for="identificadorTransaccion1">Identificador Transacción</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" id="tipoTarjeta1" name="tipoTarjeta1" >
                                <option value="">TODOS</option>
                                <option value="CREDITO">CREDITO</option>
                                <option value="DEBITO">DEBITO</option>
                                <option value="PREPAGO">PREPAGO</option>
                            </select>
                            <label for="tipoTarjeta1">Tipo tarjeta</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" id="tipoVenta1" name="tipoVenta1" >
                                <option value="">TODOS</option>
                                <option value="VENTA">VENTA</option>
                                <option value="ANULACION">ANULACION</option>
                            </select>
                            <label for="tipoVenta1">Tipo Venta</label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="divOp2" style="display: none">
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fechaDesde2" name="fechaDesde2" value="2021-12-05">
                            <label for="fechaDesde2">Desde</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fechaHasta2" name="fechaHasta2" value="2021-12-10">
                            <label for="fechaHasta2">Hasta</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="commerceCodes2" name="commerceCodes2" value="597030993500">
                            <label for="commerceCodes2">Codigos de comercio</label>
                        </div>
                    </div>
                </div>
            </div>

            <div id="divOp3" style="display: none">
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fechaDesde3" name="fechaDesde3" value="2021-12-05">
                            <label for="fechaDesde3">Desde</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fechaHasta3" name="fechaHasta3" value="2021-12-10">
                            <label for="fechaHasta3">Hasta</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="commerceCodes3" name="commerceCodes3" value="597030993500">
                            <label for="commerceCodes3">Codigos de comercio</label>
                        </div>
                    </div>
                </div>
            </div>


            <div id="divOp4" style="display: none">
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fechaDesde4" name="fechaDesde4" value="2021-12-05">
                            <label for="fechaDesde4">Desde</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fechaHasta4" name="fechaHasta4" value="2021-12-10">
                            <label for="fechaHasta4">Hasta</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="commerceCodes4" name="commerceCodes4" value="597030993500">
                            <label for="commerceCodes4">Codigos de comercio</label>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="d-grid d-md-flex justify-content-md-center">
                <button class="btn btn-primary me-md-2" type="button" onclick="enviar()">Ejecutar</button>
            </div>
            <br/>
            <div class="border shadow-none p-3 mb-5 bg-light rounded">
                <div id="divResult"></div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cargando!!!!!</h5>
                </div>
                <div class="modal-body">
                    <div class="d-grid d-md-flex justify-content-md-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection



<link rel="stylesheet" href="{{ asset('css/jsonTree.css') }}">
<script src="{{ asset('js/jsonTree.js') }}"></script>

<script>

    let tree=null;
    let modal=null;

    function setVisibleOp(op){
        document.getElementById('divOp1').style.display = 'none';
        document.getElementById('divOp2').style.display = 'none';
        document.getElementById('divOp3').style.display = 'none';
        document.getElementById('divOp4').style.display = 'none';

        document.getElementById('divOp' + op).style.display = 'block';
    }

    function changeTipoOperacion(){
        let op = document.getElementById('tipoOperacion').value;
        setVisibleOp(op);
    }

    function online(){
        post('/portal/online', {
            fechaDesde: document.getElementById('fechaDesde1').value,
            fechaHasta: document.getElementById('fechaHasta1').value,
            commerceCodes: document.getElementById('commerceCodes1').value,
            identificadorTransaccion: document.getElementById('identificadorTransaccion1').value,
            tipoTarjeta: document.getElementById('tipoTarjeta1').value,
            tipoVenta: document.getElementById('tipoVenta1').value
        });
    }

    function totals(){
        post('/portal/totals', {
            fechaDesde: document.getElementById('fechaDesde2').value,
            fechaHasta: document.getElementById('fechaHasta2').value,
            commerceCodes: document.getElementById('commerceCodes2').value
        });
    }

    function history(){
        post('/portal/history', {
            fechaDesde: document.getElementById('fechaDesde3').value,
            fechaHasta: document.getElementById('fechaHasta3').value,
            commerceCodes: document.getElementById('commerceCodes3').value
        });
    }


    function summaryPerDay(){
        post('/portal/summaryPerDay', {
            fechaDesde: document.getElementById('fechaDesde4').value,
            fechaHasta: document.getElementById('fechaHasta4').value,
            commerceCodes: document.getElementById('commerceCodes4').value
        });
    }


    function enviar(){
        let op = document.getElementById('tipoOperacion').value;
        if (op == 1){
            online();
        }
        else if (op == 2){
            totals();
        }
        else if (op == 3){
            history();
        }
        else if (op == 4){
            summaryPerDay();
        }
    }

    async function post(url, params){
        console.log('url', url);
        console.log('params', params);
        showLoading();
        fillJson({});
        const options = {
            method: 'POST',
            body: JSON.stringify(params)
        };
        let resp = await fetch(url, options)
            .then(response => response.json())
            .then(data => {
                fillJson(data);
                hideLoading();
            })
            .catch(error => {
                console.error(error);
                hideLoading();
            });
    }

    function fillJson(jsonString){
        //https://github.com/summerstyle/jsonTreeViewer
        let wrapper = document.getElementById("divResult");
        if (!tree){
            tree = jsonTree.create(jsonString, wrapper);
        }
        else{
            tree.loadData(jsonString);
        }
    }

    function getModal(){
        if (!modal)
            modal = new bootstrap.Modal(document.getElementById('loadingModal'), {});
        return modal;
    }

    function showLoading(){
        getModal().show();
    }

    function hideLoading(){
        getModal().hide();
    }


</script>
