<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/api/Vaulter/autoload.php");

define("VAULTER_IBLOCK_ID", 3);

CModule::IncludeModule('iblock');
$ELEMENT = new CIBlockElement;

// Создаём сервис для работы с сайтами апи курса валют
$vaulter = new MoneyVault\MoneyVault();

// Подключаем один из сайтов с его апишкой
// сразу получаем значения доллара и евро с данного сервиса
$vaulter->addExternalMoney(new External\ExternalVaulterCom());

// Api для backenda и фронтэнда
if(isset($_POST['function']) && isset($_POST['type']))
{
    $type = $_POST['type'];
    $function = $_POST['function'];
    switch($type)
    {
        case 'front':
        {
            header('Content-type: application/json');
            switch($function)
            {
                // Получит текущую выгрузку данных с нашего сайта
                case 'get_all_data':
                {
                    $values = array();

                    $result = CIBlockElement::GetList(array(""), array(
                        "IBLOCK_ID" => VAULTER_IBLOCK_ID,
                        "!ACTIVE_DATE" => "Y"
                    ));


                    while($elem = $result->GetNextElement())
                    {
                        $fields = $elem->GetFields();
                        $props = $elem->GetProperties();

                        $dater = new DateTime($fields['ACTIVE_FROM']);
                        $values['OLD'][] = array(
                            "NAME" => $props['VAULTER_NAME']['VALUE'],
                            "DOLLAR" => $props['DOLLAR_VALUE']['VALUE'],
                            "EURO" => $props['EURO_VALUE']['VALUE'],
                            "FULLTIME" => $fields['ACTIVE_FROM'],
                            "DATE" => $dater->format("d.m.Y"),
                            "TIME" => $dater->format("H:i:s")
                        );
                    }
                    

                    $result = CIBlockElement::GetList(array(""), array(
                        "IBLOCK_ID" => VAULTER_IBLOCK_ID,
                        "ACTIVE_DATE" => "Y"
                    ));

                    while($elem = $result->GetNextElement())
                    {
                        $fields = $elem->GetFields();
                        $props = $elem->GetProperties();
                        $dater = new DateTime($fields['ACTIVE_FROM']);
                        $values['FRESH'][] = array(
                            "NAME" => $props['VAULTER_NAME']['VALUE'],
                            "DOLLAR" => $props['DOLLAR_VALUE']['VALUE'],
                            "EURO" => $props['EURO_VALUE']['VALUE'],
                            "FULLTIME" => $fields['TIMESTAMP_X'],
                            "DATE" => $dater->format("d.m.Y"),
                            "TIME" => $dater->format("H:i:s")
                        );
                    }

                    exit(json_encode($values));
                    break;
                }
            }
            break;
        }
        case 'back':
        {
            header('Content-type: application/json');
            switch($function)
            {
                // Загружаем все данные со всех сайтов к нам на сайт на текущий период времени
                case 'load':
                {
                    // Сначала получаем последний добавленный элемент
                    // Проверяем, когда он был добавлен
                    // Если менее чем 25 минут, то не загружаем новый элемент, если более
                    // То подгружаем свежие данные в админку
                    $vaules = json_decode($vaulter->getAllValues(), false);

                    $active_from = date("d.m.Y H:i:s");
                    $active_to = date("d.m.Y H:i:s", strtotime('+6 hours'));

                    foreach($vaules as $vault)
                    {
                        $arFields = array(
                            'NAME' => 'Выгрузка данных с сайта '.$vault->VAULTER_NAME,
                            'ACTIVE' => 'Y',
                            'IBLOCK_ID' => 3,
                            'ACTIVE_FROM' => $active_from,
                            'ACTIVE_TO' => $active_to
                        );

                        $id = $ELEMENT->Add($arFields);
                        CIBlockElement::SetPropertyValuesEx($id, 3, array("VAULTER_NAME" => $vault->VAULTER_NAME));
                        CIBlockElement::SetPropertyValuesEx($id, 3, array("DOLLAR_VALUE" => $vault->DOLLAR_VALUE));
                        CIBlockElement::SetPropertyValuesEx($id, 3, array("EURO_VALUE" => $vault->EURO_VALUE));
                    }
                    exit(json_encode(array("status" => "success", "load_vaules" => $vaules, "last_id" => $id)));
                    break;
                }
                // Загружаем все данные с одного сайта по его имени к нам на сайт на текущий период времени
                case 'load_by_name':
                {
                    if(isset($_POST['name']) && !empty($_POST['name']))
                    {
                        $name = $_POST['name'];
                        $vault = $vaulter->getVaulesByName($name);

                        $arFields = array(
                            'NAME' => 'Выгрузка данных с сайта '.$vault->VAULTER_NAME,
                            'ACTIVE' => 'Y',
                            'IBLOCK_ID' => 3
                        );

                        $id = $ELEMENT->Add($arFields);
                        CIBlockElement::SetPropertyValuesEx($id, 3, array("VAULTER_NAME" => $vault->VAULTER_NAME));
                        CIBlockElement::SetPropertyValuesEx($id, 3, array("DOLLAR_VALUE" => $vault->DOLLAR_VALUE));
                        CIBlockElement::SetPropertyValuesEx($id, 3, array("EURO_VALUE" => $vault->EURO_VALUE));
                    }
                    break;
                }
            }
            break;
        }
    }
}

?>