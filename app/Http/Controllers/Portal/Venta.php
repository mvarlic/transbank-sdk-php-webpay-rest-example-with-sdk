<?php

namespace App\Http\Controllers\Portal;

use Transbank\Utils\HttpClient;
use Transbank\Utils\HttpClientRequestService;
use Transbank\Webpay\Options;
use Transbank\Utils\InteractsWithWebpayApi;
use Transbank\Webpay\Exceptions\TransbankException;
use Transbank\Contracts\RequestService;
use GuzzleHttp;


class Venta
{

    const ENDPOINT_BASE = 'https://api.transbank.cl/transbank/publico/transacciones';
    const ENDPOINT_ONLINE_SALES = '/online';
    const ENDPOINT_SALES_QUANTITY = '/totales';
    const ENDPOINT_TRANSACTION_HISTORY = '';
    const ENDPOINT_SUMMARY_SALES_DAY = 'resumen-ventas';

    public function getHeaders()
    {
        return [
            'X-Client-Id' => 'a6dc6033fc7811edfa9ed603f5ade55a'
        ];
    }

    public function request(
        $method,
        $endpoint
    ) {
        $headers = ['headers' => $this->getHeaders()];
        $client = new HttpClient();
        $response = $client->request($method, $endpoint, null, $headers);
        $responseStatusCode = $response->getStatusCode();

        if (!in_array($responseStatusCode, [200, 204])) {
            $reason = $response->getReasonPhrase();
            $message = "Could not obtain a response from Transbank API: $reason (HTTP code $responseStatusCode)";
            $body = json_decode($response->getBody(), true);
            $tbkErrorMessage = null;
            if (isset($body['error_message'])) {
                $tbkErrorMessage = $body['error_message'];
                $message = "Transbank API REST Error: $tbkErrorMessage | $message";
            }
        }
        return json_decode($response->getBody(), true);
    }

    public function getOnlineSales($fechaDesde, $fechaHasta, $commerceCodes, $tipoTarjeta, $tipoVenta, $pageNumber = null, $pageSize = null)
    {
        $params = array();
        $params['page-number'] = 1;
        $params['page-size'] = 20;
        $params['fecha-desde'] = $fechaDesde;
        $params['fecha-hasta'] = $fechaHasta;
        try {
            //identificador-transaccion 37479936213
            if (!empty($commerceCodes))
                $params['codigos-comercio'] = $commerceCodes;//27403611,29921962
            if (!empty($tipoTarjeta))
                $params['tipo-tarjeta'] = $tipoTarjeta;
            if (!empty($tipoVenta))
                $params['tipo-ventas'] = $tipoVenta;
            if (!empty($pageNumber))
                $params['page-number'] = $pageNumber;
            if (!empty($pageSize))
                $params['page-size'] = $pageSize;
            $url = static::ENDPOINT_BASE.static::ENDPOINT_ONLINE_SALES.'?'.http_build_query($params);
            $res = $this->request('GET', $url);
        } catch (TransbankException $e) {
            throw TransbankException::raise($e);
        }
        return $res;
    }

    public function getTotalSales($fechaDesde, $fechaHasta, $commerceCodes)
    {
        $params = array();
        $params['fecha-desde'] = $fechaDesde;
        $params['fecha-hasta'] = $fechaHasta;
        try {
            if (!empty($commerceCodes))
                $params['codigos-comercio'] = $commerceCodes;
            $url = static::ENDPOINT_BASE.static::ENDPOINT_SALES_QUANTITY.'?'.http_build_query($params);
            $res = $this->request('GET', $url);
        } catch (TransbankException $e) {
            throw TransbankException::raise($e);
        }
        return $res;
    }

    public function getTransactions($fechaDesde, $fechaHasta, $commerceCodes, $pageNumber = null, $pageSize = null)
    {
        $params = array();
        $params['fecha-desde'] = $fechaDesde;
        $params['fecha-hasta'] = $fechaHasta;
        try {
            if (!empty($commerceCodes))
                $params['codigos-comercio'] = $commerceCodes;
            if (!empty($pageNumber))
                $params['page-number'] = $pageNumber;
            if (!empty($pageSize))
                $params['page-size'] = $pageSize;
            $url = static::ENDPOINT_BASE.static::ENDPOINT_TRANSACTION_HISTORY.'?'.http_build_query($params);
            $res = $this->request('GET', $url);
        } catch (TransbankException $e) {
            throw TransbankException::raise($e);
        }
        return $res;
    }

    public function getSummarySalesDay($fechaDesde, $fechaHasta, $commerceCodes, $pageNumber = null, $pageSize = null)
    {
        $params = array();
        $params['fecha-desde'] = $fechaDesde;
        $params['fecha-hasta'] = $fechaHasta;
        try {
            if (!empty($commerceCodes))
                $params['codigos-comercio'] = $commerceCodes;
            $url = static::ENDPOINT_BASE.static::ENDPOINT_SUMMARY_SALES_DAY.'?'.http_build_query($params);
            $res = $this->request('GET', $url);
        } catch (TransbankException $e) {
            throw TransbankException::raise($e);
        }
        return $res;
    }

    public function validate($value){
        if (!is_string($value)) {
            throw new InvalidArgumentException('Token parameter given is not string.');
        }
        if (!isset($value) || trim($value) === '') {
            throw new InvalidArgumentException('Token parameter given is empty.');
        }
        return true;
    }

}

//https://api.transbank.cl/transbank/publico/transacciones/online?fecha-desde=2021-12-05T01:20:53&fecha-hasta=2021-12-10T01:20:53&page-number=1&page-size=20&codigos-comercio=597030993500&identificador-transaccion=11&tipo-tarjeta=CREDITO&tipo-ventas=ANULACION
//https://api.transbank.cl/transbank/publico/transacciones/totales?fecha-desde=2021-11-01&fecha-hasta=2021-11-30
//https://api.transbank.cl/transbank/publico/transacciones?fecha-desde=2022-02-01&fecha-hasta=2022-02-07&codigos-comercio=28299257&page-number=1&page-size=10
//https://api.transbank.cl/transbank/publico/transacciones/resumen-ventas?fecha-desde=2022-01-15&fecha-hasta=2022-02-01&codigos-comercio=55555541
