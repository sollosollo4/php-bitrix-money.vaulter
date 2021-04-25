<?php

namespace External;
use External\IExternalMoney;
use CurlTransmitter\CurlTransmitter;

class ExternalVaulterCom implements IExternalMoney
{
    private $transmitter;

    public function __construct()
    {
        $this->transmitter = new CurlTransmitter();
    }

    public function getDollarValue()
    {
        $json_data = json_decode($this->transmitter->getData(
            $this->getUrl(),
            $this->getParams('get_current_value_dollar')
        ), false);

        if($json_data->success)
        {
            return $json_data->data->value;
        }
        else
        {
            return $json_data->reason;
        }
    }

    public function getEuroValue()
    {
        $json_data = json_decode($this->transmitter->getData(
            $this->getUrl(),
            $this->getParams('get_current_value_euro')
        ), false);

        if($json_data->success)
        {
            return $json_data->data->value;
        }
        else
        {
            return $json_data->reason;
        }
    }

    public function getParams(...$funct)
    {
        return array('funct' => $funct[0]);
    }

    public function getUrl(): string { return $_SERVER['HTTP_HOST'].'/api/vaulter.com.php'; }
    public function getName(): string { return 'Vaulter.com'; }
}
?>