<?php

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Config\Configuration;

class MetaTagsSmartFilter extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        if ($this->StartResultCache()) {

            Loader::includeModule('iblock');
            Loader::includeModule("highloadblock");

            $filters = explode('/', $arParams['SMART_FILTER_PATH']);

            $filterUrlParams = [];

            foreach ($filters as $filter) {

                if (strpos($filter, '-is-',)) {
                    $arFilters = explode('-is-', $filter);
                    $filterUrlParams[] = [
                        'PROPERTY_CODE' => $arFilters[0],
                        'VALUES' => explode('-or-', $arFilters[1])
                    ];
                }

                if (strpos($filter, 'base',)) {
                    if (strpos($filter, 'to') && strpos($filter,'from' )) {
                        $filter = str_replace('price-base-from-', '', $filter);
                        $this->arResult['PRICE'] = [
                            'FROM' => explode('-to-', $filter)[0],
                            'TO' => explode('-to-', $filter)[1]
                        ];
                    } elseif (strpos($filter,'base-to')) {
                        $this->arResult['PRICE'] = [
                            'FROM' => 0,
                            'TO' => explode('-to-', $filter)[1]
                        ];
                    } else {
                        $this->arResult['PRICE'] = [
                            'FROM' => explode('-from-', $filter)[1],
                            'TO' => "M"
                        ];
                    }
                }
            }

            $sectionFilter = [
                'IBLOCK_ID' => $arParams['CATALOG_IBLOCK_ID'],
                'CODE' => $arParams['CATALOG_SECTION_CODE']
            ];

            $section = CIBlockSection::GetList([], $sectionFilter)->fetch();
            $this->arResult['SECTION_NAME'] = $section['NAME'];

            $filterKeys = ['NAME', 'CODE', 'PROPERTY_TYPE', 'XML_ID', 'USER_TYPE', 'USER_TYPE_SETTINGS'];

            $arFilterIBlockProperty = [
                'IBLOCK_ID' => $arParams['CATALOG_IBLOCK_ID'],
            ];

            $propIBlock = CIBlockProperty::GetList([], $arFilterIBlockProperty);

            $propsFields = [];

            while ($prop_fields = $propIBlock->GetNext()) {

                $prop = [];

                foreach ($filterKeys as $nameProperty) {
                    $prop[$nameProperty] = $prop_fields[$nameProperty];
                }

                $propsFields[] = $prop;
            }

            $propsFieldsIblockMain = $propsFields;

            $arrayPropertiesUrl = array_column($filterUrlParams, 'PROPERTY_CODE');

            $propsFieldsIblockSort = array_filter($propsFieldsIblockMain, function ($prop) use ($arrayPropertiesUrl) {
                return in_array(strtolower($prop['CODE']), $arrayPropertiesUrl);
            });

            $resArrProperty = [];

            foreach ($propsFieldsIblockSort as $prop) {

                if ($prop['PROPERTY_TYPE'] == 'L' && empty($prop['USER_TYPE'])) {
                    $enumOfProperty = CIBlockPropertyEnum::GetList([], ['CODE' => $prop['CODE']]);

                    $indexUrlParams = array_search(strtolower($prop['CODE']), $arrayPropertiesUrl);

                    $resArrPropertyItem['VALUES'] = [];

                    while ($itemEnum = $enumOfProperty->GetNext()) {
                        if (in_array($itemEnum['XML_ID'], $filterUrlParams[$indexUrlParams]['VALUES'])) {

                            $resArrPropertyItem['VALUES'][] = $itemEnum['VALUE'];
                        }
                    }
                    if (!empty($resArrPropertyItem['VALUES'])) {
                        $resArrPropertyItem['PROPERTY_NAME'] = $prop['NAME'];
                        $resArrProperty[] = $resArrPropertyItem;
                    }
                } elseif (!empty($prop['USER_TYPE'])) {

                    $hlblock = HighloadBlockTable::getList([
                        'filter' => ['=TABLE_NAME' => $prop['USER_TYPE_SETTINGS']['TABLE_NAME']]
                    ])->fetch();

                    $hlClassName = (HighloadBlockTable::compileEntity($hlblock))->getDataClass();

                    $indexUrlParams = array_search(strtolower($prop['CODE']), $arrayPropertiesUrl);

                    $resArrPropertyItem['VALUES'] = [];

                    foreach ($filterUrlParams[$indexUrlParams]['VALUES'] as $xmlId) {
                        $itemHLDBlock = $hlClassName::getList([
                            'filter' => array(
                                'UF_XML_ID' => $xmlId,
                            ),
                            'select' => array("*"),
                        ])->fetch();
                        $resArrPropertyItem['VALUES'][] = $itemHLDBlock['UF_NAME'];

                    }

                    if (!empty($resArrPropertyItem['VALUES'])) {
                        $resArrPropertyItem['PROPERTY_NAME'] = $prop['NAME'];
                        $resArrProperty[] = $resArrPropertyItem;
                    }

                    //получение простого строкового значения
                } elseif ($prop['PROPERTY_TYPE'] == 'S' && empty($prop['USER_TYPE'])) {
                    $indexUrlParams = array_search(strtolower($prop['CODE']), $arrayPropertiesUrl);

                    $resArrPropertyItem['VALUES'] = $filterUrlParams[$indexUrlParams]['VALUES'];

                    if (!empty($resArrPropertyItem['VALUES'])) {
                        $resArrPropertyItem['PROPERTY_NAME'] = $prop['NAME'];
                        $resArrProperty[] = $resArrPropertyItem;
                    }
                }
            }

            $this->arResult['PROPERTIES'] = $resArrProperty;

            $this->IncludeComponentTemplate();
        }
    }


    public function getFilter()
    {

        $filterResult = Configuration::getValue('smart_filter_template');

        $filterResult = str_replace('{title}', $this->arResult['SECTION_NAME'] . ".", $filterResult);

        if (!empty($this->arResult['PROPERTIES'])) {
            $properties = '';
            foreach ($this->arResult['PROPERTIES'] as $prop) {
                $properties .= ' ' . $prop['PROPERTY_NAME'] . ' - ' .
                    implode(', ', $prop['VALUES']) . "; ";
            }
            $filterResult = str_replace('{smartfilter.params.name} - {smartfilter.params.value}',
                $properties, $filterResult);
        } else {
            $filterResult = str_replace('{smartfilter.params.name} - {smartfilter.params.value}',
                '', $filterResult);
        }

        if (!empty($this->arResult['PRICE'])) {
            $priceValue = 'от ' . $this->arResult['PRICE']['FROM'] .
                ' до ' . $this->arResult['PRICE']['TO'];
            $filterResult = str_replace('{smartfilter.price}', $priceValue, $filterResult);
        } else {
            $filterResult = str_replace('Цена - {smartfilter.price} ', '', $filterResult);
        }

        return $filterResult;
    }

}