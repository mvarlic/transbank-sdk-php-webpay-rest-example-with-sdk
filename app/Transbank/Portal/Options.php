<?php

namespace Transbank\Portal;

/**
 * Class Options.
 */
class Options extends \Transbank\Webpay\Options
{
    const BASE_URL_PRODUCTION = 'https://api.transbank.cl/transbank/publico';
    const BASE_URL_INTEGRATION = 'https://api.transbank.cl/transbank/publico';

    /**
     * @return array
     */
    public function getHeaders()
    {
        return [
            'X-Client-Id'    => $this->getApiKey()
        ];
    }
}
