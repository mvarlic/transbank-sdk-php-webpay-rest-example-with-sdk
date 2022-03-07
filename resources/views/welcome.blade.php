@extends('layout')
@section('content')

    <div class="main_content home">
        <h2 class="header">
            Webpay Plus
        </h2>

        @if (!$data['production'] || ($data['production'] && $data['webpay_plus_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Webpay Plus
                </span>
                <span class="operation_link">
                    <a href="webpayplus/create">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>
        @endif

        @if (!$data['production'] || ($data['production'] && $data['webpay_plus_deferred_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Webpay Plus Captura Diferida
                </span>
                <span class="operation_link">
                    <a href="/webpayplus/diferido/create">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>
        @endif

        @if (!$data['production'] || ($data['production'] && $data['webpay_plus_mall_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Webpay Plus Mall
                </span>
                <span class="operation_link">
                    <a href="webpayplus/createMall">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>
        @endif


        @if (!$data['production'] || ($data['production'] && $data['webpay_plus_mall_deferred_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Webpay Plus Mall Captura Diferida
                </span>
                <span class="operation_link">
                    <a href="webpayplus/mall/diferido/create">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>

            </div>
        @endif


        <h2 class="header">
            Webpay OneClick
        </h2>

        @if (!$data['production'] || ($data['production'] && $data['oneclick_mall_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Oneclick mall
                </span>
                <span class="operation_link">
                    <a href="oneclick/startInscription">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>

            </div>
        @endif

        @if (!$data['production'] || ($data['production'] && $data['oneclick_mall_deferred_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Oneclick mall diferido
                </span>
                <span class="operation_link">
                    <a href="oneclick/diferido/startInscription">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>

            </div>
        @endif

        <h2 class="header">
            Transacción Completa
        </h2>

        @if (!$data['production'] || ($data['production'] && $data['transaccion_completa_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Transacción Completa Captura Simultánea
                </span>
                <span class="operation_link">
                    <a href="transaccion_completa/create">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>
        @endif

        @if (!$data['production'] || ($data['production'] && $data['transaccion_completa_mall_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Transacción Completa Mall
                </span>
                <span class="operation_link">
                    <a href="transaccion_completa/mall_create">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>
        @endif

        <h2 class="header">
            Patpass
        </h2>

        @if (!$data['production'] || ($data['production'] && $data['patpass_comercio_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">Patpass Comercio</span>

                <span class="operation_link">
                    <a href="patpass_comercio/create-form">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>
        @endif

        <h2 class="header">
            Webpay Modal
        </h2>

        @if (!$data['production'] || ($data['production'] && $data['webpay_modal_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">Webpay Modal</span>

                <span class="operation_link">
                    <a href="modal/create-form">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>
        @endif

        <h2 class="header">
            Webpay Modal
        </h2>

        <div class="examples_container">
            <span class="operation_title">Api Portal Ventas</span>

            <span class="operation_link">
                <a href="portal/get-ventas-form">Iniciar <i class="fa fa-arrow-right"></i></a>
            </span>
        </div>

        <div class="examples_container">
            <span class="operation_title">Api Portal Abonos</span>

            <span class="operation_link">
                <a href="portal/get-abonos-form">Iniciar <i class="fa fa-arrow-right"></i></a>
            </span>
        </div>

    </div>

    @php
    function get_tls_version($sslversion = null)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, "https://www.howsmyssl.com/a/check");
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    if ($sslversion !== null) {
        curl_setopt($c, CURLOPT_SSLVERSION, $sslversion);
    }
    $rbody = curl_exec($c);
    if ($rbody === false) {
        $errno = curl_errno($c);
        $msg = curl_error($c);
        curl_close($c);
        return "Error! errno = " . $errno . ", msg = " . $msg;
    } else {
        $r = json_decode($rbody);
        curl_close($c);
        return $r->tls_version;
    }
}

echo "OS: " . PHP_OS . "\n";
echo "uname: " . php_uname() . "\n";
echo "PHP version: " . phpversion() . "\n";
$curl_version = curl_version();
echo "curl version: " . $curl_version["version"] . "\n";
echo "SSL version: " . $curl_version["ssl_version"] . "\n";
echo "SSL version number: " . $curl_version["ssl_version_number"] . "\n";
echo "OPENSSL_VERSION_NUMBER: " . dechex(OPENSSL_VERSION_NUMBER) . "\n";
echo "TLS test (default): " . get_tls_version() . "\n";
echo "TLS test (TLS_v1): " . get_tls_version(1) . "\n";
echo "TLS test (TLS_v1_2): " . get_tls_version(6) . "\n";
   @endphp

@endsection
