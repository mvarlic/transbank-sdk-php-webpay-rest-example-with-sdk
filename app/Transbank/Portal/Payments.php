<?php

namespace Transbank\Portal;

use Transbank\Utils\InteractsWithWebpayApi;
use Transbank\Webpay\Exceptions\TransbankException;


class Payments
{
    use InteractsWithWebpayApi;

    const ENDPOINT_BY_ACCOUNTS = '/abonos/por-cuentas';
    const ENDPOINT_SALES_FOR_PAYMENTS = '/abonos/ventas';
    const ENDPOINT_UPCOMING_TOTAL_PAYMENTS = '/abonos/totales-proximos';
    const ENDPOINT_TOTAL_PAYMENTS_DONE  = '/abonos/totales-realizados';

    public function byAccounts($fechaDesde, $fechaHasta)
    {
        $params = array();
        $params['fecha-desde'] = $fechaDesde;
        $params['fecha-hasta'] = $fechaHasta;
        try {
            $url = static::ENDPOINT_BY_ACCOUNTS.'?'.http_build_query($params);
            $res = $this->sendRequest('GET', $url);
        } catch (TransbankException $e) {
            throw TransbankException::raise($e);
        }
        return $res;
    }

    public function salesForPayments($fechaAbono, $identificadorTransaccion = null, $commerceCodes = null, $pageNumber = null, $pageSize = null)
    {
        $params = array();
        $params['page-number'] = 1;
        $params['page-size'] = 20;
        $params['fecha-abono'] = $fechaAbono;
        try {
            if (!empty($pageNumber))
                $params['page-number'] = $pageNumber;
            if (!empty($pageSize))
                $params['page-size'] = $pageSize;
            if (!empty($commerceCodes))
                $params['codigos-comercio'] = $commerceCodes;
            if (!empty($identificadorTransaccion))
                $params['identificador-transaccion'] = $identificadorTransaccion;
            $url = static::ENDPOINT_SALES_FOR_PAYMENTS.'?'.http_build_query($params);
            $res = $this->sendRequest('GET', $url);
        } catch (TransbankException $e) {
            throw TransbankException::raise($e);
        }
        return $res;
    }

    public function upcoming($fechaDesde, $fechaHasta)
    {
        $params = array();
        $params['fecha-desde'] = $fechaDesde;
        $params['fecha-hasta'] = $fechaHasta;
        try {
            $url = static::ENDPOINT_UPCOMING_TOTAL_PAYMENTS.'?'.http_build_query($params);
            $res = $this->sendRequest('GET', $url);
        } catch (TransbankException $e) {
            throw TransbankException::raise($e);
        }
        return $res;
    }

    public function completed($fechaAbono)
    {
        $params = array();
        $params['fecha-abono'] = $fechaAbono;
        try {
            $url = static::ENDPOINT_TOTAL_PAYMENTS_DONE.'?'.http_build_query($params);
            $res = $this->sendRequest('GET', $url);
        } catch (TransbankException $e) {
            throw TransbankException::raise($e);
        }
        return $res;
    }

    public static function getDefaultOptions()
    {
        return Options::forIntegration(null, 'a6dc6033fc7811edfa9ed603f5ade55a');
    }

}
