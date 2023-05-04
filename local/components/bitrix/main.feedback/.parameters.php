<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
$arFilter = Array("TYPE_ID" => "FEED_FORM", "ACTIVE" => "Y");
if($site !== false)
    $arFilter["LID"] = $site;

$arEvent = Array();
$dbType = CEventMessage::GetList("id", "desc", $arFilter);
while($arType = $dbType->GetNext())
    $arEvent[$arType["ID"]] = "[".$arType["ID"]."] ".$arType["SUBJECT"];

$arComponentParameters = array(
    "PARAMETERS" => array(
        "IBLOCK_ID" => Array(
            "NAME" => GetMessage("MFP_IBLOCK_ID"),
            "TYPE" => "STRING",
            "DEFAULT" => "",
            "PARENT" => "BASE",
        ),
        "OK_TEXT" => Array(
            "NAME" => GetMessage("MFP_OK_MESSAGE"),
            "TYPE" => "STRING",
            "DEFAULT" => GetMessage("MFP_OK_TEXT"),
            "PARENT" => "BASE",
        ),
        "EMAIL_TO" => Array(
            "NAME" => GetMessage("MFP_EMAIL_TO"),
            "TYPE" => "STRING",
            "DEFAULT" => htmlspecialcharsbx(COption::GetOptionString("main", "email_from")),
            "PARENT" => "BASE",
        ),
        "EVENT_MESSAGE_ID" => Array(
            "NAME" => GetMessage("MFP_EMAIL_TEMPLATES"),
            "TYPE"=>"LIST",
            "VALUES" => $arEvent,
            "DEFAULT"=>"",
            "MULTIPLE"=>"Y",
            "COLS"=>25,
            "PARENT" => "BASE",
        ),
    )
);

?>
