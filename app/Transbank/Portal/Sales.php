<?php

namespace Transbank\Portal;

use Transbank\Utils\InteractsWithWebpayApi;
use Transbank\Webpay\Exceptions\TransbankException;

class Sales
{
    use InteractsWithWebpayApi;

    const ENDPOINT_ONLINE = '/transacciones/online';
    const ENDPOINT_TOTALS = '/transacciones/totales';
    const ENDPOINT_HISTORY = '/transacciones';
    const ENDPOINT_SUMMARY_PER_DAY = '/transacciones/resumen-ventas';

    public function online($fechaDesde, $fechaHasta, $identificadorTransaccion = null, $commerceCodes = null, $tipoTarjeta = null, $tipoVenta = null, $pageNumber = null, $pageSize = null)
    {
        $params = array();
        $params['page-number'] = 1;
        $params['page-size'] = 20;
        $params['fecha-desde'] = $fechaDesde;
        $params['fecha-hasta'] = $fechaHasta;
        try {
            if (!empty($commerceCodes))
                $params['codigos-comercio'] = $commerceCodes;
            if (!empty($tipoTarjeta))
                $params['tipo-tarjeta'] = $tipoTarjeta;
            if (!empty($tipoVenta))
                $params['tipo-ventas'] = $tipoVenta;
            if (!empty($identificadorTransaccion))
                $params['identificador-transaccion'] = $identificadorTransaccion;
            if (!empty($pageNumber))
                $params['page-number'] = $pageNumber;
            if (!empty($pageSize))
                $params['page-size'] = $pageSize;
            $url = static::ENDPOINT_ONLINE.'?'.http_build_query($params);
            $res = $this->sendRequest('GET', $url);
        } catch (TransbankException $e) {
            throw TransbankException::raise($e);
        }
        return $res;
    }

    public function totals($fechaDesde, $fechaHasta, $commerceCodes)
    {
        $params = array();
        $params['fecha-desde'] = $fechaDesde;
        $params['fecha-hasta'] = $fechaHasta;
        try {
            if (!empty($commerceCodes))
                $params['codigos-comercio'] = $commerceCodes;
            $url = static::ENDPOINT_TOTALS.'?'.http_build_query($params);
            $res = $this->sendRequest('GET', $url);
        } catch (TransbankException $e) {
            throw TransbankException::raise($e);
        }
        return $res;
    }

    public function history($fechaDesde, $fechaHasta, $commerceCodes, $pageNumber = null, $pageSize = null)
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
            $url = static::ENDPOINT_HISTORY.'?'.http_build_query($params);
            $res = $this->sendRequest('GET', $url);
        } catch (TransbankException $e) {
            throw TransbankException::raise($e);
        }
        return $res;
    }

    public function summaryPerDay($fechaDesde, $fechaHasta, $commerceCodes)
    {
        $params = array();
        $params['fecha-desde'] = $fechaDesde;
        $params['fecha-hasta'] = $fechaHasta;
        try {
            if (!empty($commerceCodes))
                $params['codigos-comercio'] = $commerceCodes;
            $url = static::ENDPOINT_SUMMARY_PER_DAY.'?'.http_build_query($params);
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


