<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");$APPLICATION->SetTitle("Простой компонент");
?>
<?$APPLICATION->IncludeComponent(
	"ex2:simplecomp.exam", 
	".default", 
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CLASSIFICATION_IBLOCK_ID" => "6",
		"PRODUCTS_IBLOCK_ID" => "2",
		"PROPERTIES_IBLOCK_ID" => "FIRMA",
		"TEMPLATE_IBLOCK_ID" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"CLASSIF_IBLOCK_ID" => "6",
		"TEMPLATE" => "",
		"PROPERTY_CODE" => "FIRMA" 
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>