<?php

namespace External;

interface IExternalMoney
{
    public function getDollarValue();
    public function getEuroValue();

    public function getParams(...$funct);

    /** @var  string */
    public function getUrl();
    /** @var  string */
    public function getName();
}
?>