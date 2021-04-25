<?php

namespace MoneyVault;

use External\IExternalMoney;
use External\ExternalVaulterCom;

class MoneyVault
{
    /** @var array $VaulterList*/
    public $VaulterList;

    public function  __construct() 
    {
        $this->VaulterList = [];
    }

    public function addExternalMoney(IExternalMoney $externalMoney)
    {
        if($externalMoney != null)
            $this->VaulterList[$externalMoney->getName()] = $externalMoney;
    }

    public function getExtMoneyByName($name): IExternalMoney
    {
        if(!empty($name))
            return $this->VaulterList[$name] ?? null;
    }

    public function getAllValues()
    {
        $values = [];
        foreach($this->VaulterList as $vaulter)
        {
            $values[] = array(
                "VAULTER_NAME" => $vaulter->getName(),
                "DOLLAR_VALUE" => $vaulter->getDollarValue(),
                "EURO_VALUE" => $vaulter->getEuroValue()
            );
        }

        return json_encode($values);
    }

    public function getDollarsValues()
    {
        $values = [];

        foreach($this->VaulterList as $vaulter)
        {
            $values[] = array(
                "VAULTER_NAME" => $vaulter->getName(),
                "DOLLAR_VALUE" => $vaulter->getDollarValue(),
            );
        }

        return json_encode($values);
    }

    public function getEuroValues()
    {
        $values = [];

        foreach($this->VaulterList as $vaulter)
        {
            $values[] = array(
                "VAULTER_NAME" => $vaulter->getName(),
                "EURO_VALUE" => $vaulter->getEuroValue()
            );
        }

        return json_encode($values);
    }

    public function getVaulesByName($name)
    {
        return json_encode(
            array(
                "VAULTER_NAME" =>  $this->getExtMoneyByName($name)->getName(),
                "DOLLAR_VALUE" => $this->getExtMoneyByName($name)->getDollarValue(),
                "EURO_VALUE" => $this->getExtMoneyByName($name)->getEuroValue()
            )
        );
    }
}

?>