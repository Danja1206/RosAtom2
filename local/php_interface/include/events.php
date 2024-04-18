<?php

require_once __DIR__ . '/const.php';
IncludeModuleLangFile(__FILE__);

AddEventHandler("main", "OnBeforeEventAdd", array("Ex2", "Ex2_51"));
AddEventHandler("main", "OnBeforeProlog", array("Ex2", "Ex2_94"));

class Ex2
{
    static function Ex2_51(&$event, &$lid, &$arFields)
    {
        if ($event == "FEEDBACK_FORM") {
            global $USER;
            if ($USER->isAuthorized()) {
                $arFields["AUTHOR"] = self::getAuthorizedUserMessage($USER, $arFields["AUTHOR"]);
            } else {
                $arFields["AUTHOR"] = self::getUnauthorizedUserMessage($arFields["AUTHOR"]);
            }
            self::logEvent($event, $arFields["AUTHOR"]);
        }
    }
 
    static function Ex2_94()
    {
        global $APPLICATION;
        $curPage = $APPLICATION->GetCurDir();

        if (\Bitrix\Main\Loader::includeModule("iblock")) {
            $arFilter = array(
                "IBLOCK_ID" => IBLOCK_ID,
                "NAME" => $curPage
            );

            $arSelect = array(
                "IBLOCK_ID",
                "ID",
                "PROPERTY_TITLE",
                "PROPERTY_DESCRIPTION" ,
            );



            $ob = CIBlockElement::GetList(
                array(),
                $arFilter,
                false,
                false,
                $arSelect
            );
            
            if ($arRes = $ob->Fetch()) {
                $APPLICATION->SetPageProperty("title", $arRes["PROPERTY_TITLE_VALUE"]);
                $APPLICATION->SetPageProperty("description", $arRes["PROPERTY_DESCRIPTION_VALUE"]);
            }
        }
    }

    static private function getAuthorizedUserMessage($user, $nameForm)
    {
        return GetMessage(
            "EX2_51_AUTH_USER",
            array(
                "ID" => $user->GetID(),
                "LOGIN" => $user->GetLogin(),
                "NAME" => $user->GetFullName(),
                "NAME_FORM" => $nameForm
            )
        );
    }

    static private function getUnauthorizedUserMessage($nameForm)
    {
        return GetMessage(
            "EX2_51_NO_AUTH_USER",
            array(
                "NAME_FORM" => $nameForm
            )
        );
    }

    static private function logEvent($event, $author)
    {
        CEventLog::Add(
            array(
                "SEVERITY" => "SECURITY",
                "AUDIT_TYPE_ID"  => GetMessage("EX2_51_LOG"),
                "MODULE_ID" => "main",
                "ITEM_ID" => $event,
                "DESCRIPTION" => GetMessage("EX2_51_LOG") . '-' . $author
            )
        );
    }
}