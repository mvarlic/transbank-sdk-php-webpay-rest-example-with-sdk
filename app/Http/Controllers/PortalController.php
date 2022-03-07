<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Portal\Sales;
use Transbank\Portal\Payments;

class PortalController extends Controller
{
    public function getVentasForm()
    {
        return view('portal/get-ventas-form');
    }

    public function online(Request $req)
    {
        /*
        $res = array();
        $res['data'] = array();
        //$resp = (new Venta)->getOnlineSales('2021-12-05T01:20:53', '2021-12-10T01:20:53', '597030993500', 'CREDITO', 'ANULACION');
        $res = (new Sales)->online($req["fechaDesde"], $req["fechaHasta"], $req["identificadorTransaccion"], $req["commerceCodes"], $req["tipoTarjeta"], $req["tipoVenta"]);
        //var_dump($resp);
        $params = [
            "fechaDesde" => $req["fechaDesde"],
            "fechaHasta" => $req["fechaHasta"],
            "identificadorTransaccion" => $req["identificadorTransaccion"],
            "commerceCodes" => $req["commerceCodes"],
            "tipoTarjeta" => $req["tipoTarjeta"],
            "tipoVenta" => $req["tipoVenta"]
        ];
        return view('portal/online-result', ["res" => $res['data'], 'req' => $params]);
        */
        curl_setopt($this->curlHandle, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
        try {
            $r = $req->json()->all();
            $res = (new Sales)->online($r["fechaDesde"], $r["fechaHasta"], $r["identificadorTransaccion"], $r["commerceCodes"], $r["tipoTarjeta"], $r["tipoVenta"]);
            return response()->json($res);
        } catch (\Exception $e) {
            return json_encode(array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            ));
        }
    }

    public function totals(Request $req)
    {
        curl_setopt($this->curlHandle, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
        /*
        $res = array();
        $res = (new Sales)->totals($req["fechaDesde"], $req["fechaHasta"], $req["commerceCodes"]);
        $params = [
            "fechaDesde" => $req["fechaDesde"],
            "fechaHasta" => $req["fechaHasta"],
            "commerceCodes" => $req["commerceCodes"]
        ];
        return view('portal/result', ["res" => $res, 'req' => $params]);
        */
        try {
            $r = $req->json()->all();
            $res = (new Sales)->totals($r["fechaDesde"], $r["fechaHasta"], $r["commerceCodes"]);
            return response()->json($res);
        } catch (\Exception $e) {
            return json_encode(array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            ));
        }
    }

    public function history(Request $req)
    {
        /*
        $res = array();
        $res = (new Sales)->history($req["fechaDesde"], $req["fechaHasta"], $req["commerceCodes"]);
        $params = [
            "fechaDesde" => $req["fechaDesde"],
            "fechaHasta" => $req["fechaHasta"],
            "commerceCodes" => $req["commerceCodes"]
        ];
        return view('portal/result', ["res" => $res, 'req' => $params]);
        */
        curl_setopt($this->curlHandle, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
        try {
            $r = $req->json()->all();
            $res = (new Sales)->history($r["fechaDesde"], $r["fechaHasta"], $r["commerceCodes"]);
            return response()->json($res);
        } catch (\Exception $e) {
            return json_encode(array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            ));
        }
    }

    public function summaryPerDay(Request $req)
    {
        /*
        $res = array();
        $res = (new Sales)->summaryPerDay($req["fechaDesde"], $req["fechaHasta"], $req["commerceCodes"]);
        $params = [
            "fechaDesde" => $req["fechaDesde"],
            "fechaHasta" => $req["fechaHasta"],
            "commerceCodes" => $req["commerceCodes"]
        ];
        return view('portal/result', ["res" => $res, 'req' => $params]);*/

        curl_setopt($this->curlHandle, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
        try {
            $r = $req->json()->all();
            $res = (new Sales)->summaryPerDay($r["fechaDesde"], $r["fechaHasta"], $r["commerceCodes"]);
            return response()->json($res);
        } catch (\Exception $e) {
            return json_encode(array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            ));
        }
    }



    public function getAbonosForm()
    {
        return view('portal/get-abonos-form');
    }

    public function byAccounts(Request $req)
    {
        curl_setopt($this->curlHandle, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
        try {
            $r = $req->json()->all();
            $res = (new Payments)->byAccounts($r["fechaDesde"], $r["fechaHasta"]);
            return response()->json($res);
        } catch (\Exception $e) {
            return json_encode(array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            ));
        }
    }

    public function salesForPayments(Request $req)
    {
        curl_setopt($this->curlHandle, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
        try {
            $r = $req->json()->all();
            $res = (new Payments)->salesForPayments($r["fechaAbono"], $r["identificadorTransaccion"], $r["commerceCodes"]);
            return response()->json($res);
        } catch (\Exception $e) {
            return json_encode(array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            ));
        }
    }

    public function upcoming(Request $req)
    {
        curl_setopt($this->curlHandle, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
        try {
            $r = $req->json()->all();
            $res = (new Payments)->upcoming($r["fechaDesde"], $r["fechaHasta"]);
            return response()->json($res);
        } catch (\Exception $e) {
            return json_encode(array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            ));
        }
    }

    public function completed(Request $req)
    {
        curl_setopt($this->curlHandle, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
        try {
            $r = $req->json()->all();
            $res = (new Payments)->completed($r["fechaAbono"]);
            return response()->json($res);
        } catch (\Exception $e) {
            return json_encode(array(
                'msg' => $e->getMessage(),
                'code' => $e->getCode()
            ));
        }
    }

}

