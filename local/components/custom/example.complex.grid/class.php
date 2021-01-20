<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== TRUE) {
    die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Engine\Contract\Controllerable;

Loc::loadMessages(__FILE__);

/**
 * Class ExampleComplexGrid
 */
class ExampleComplexGrid extends CBitrixComponent implements Controllerable
{

    /**
     * @var array - контекст запроса.
     */
    protected $request;


    /**
     * Метод интерфейса Controllerable, для работы методов экшенов из текущего класса.
     *
     * @return array[][]
     */
    public function configureActions()
    {
        return [
            'testAction' => ['prefilters' => [],],
        ];
    }

    /**
     * Проверяем параметры компонента, и если параметров не хватает, заполняем их.
     *
     * @param array $arParams
     * @return array|mixed
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public function onPrepareComponentParams($arParams = [])
    {
        // 1. Если ID информационного блока не задан - задаем его
        if (!isset($arParams['IBLOCK_ID'])) {
            $res = \Bitrix\Iblock\IblockTable::getList([
                'select' => ['ID'],
                'filter' => ['CODE' => 'IBLOCK_CODE']]);
            while ($row = $res->fetch()) {
                $arParams['IBLOCK_ID'] = $row['ID'];
            }
        }

        return $arParams;
    }

    // stop here - 20.01.2021 19:57
    public function executeComponent()
    {

    }
}