<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Задайте вопрос");
?>
	<h2>Задать вопрос</h2>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.feedback",
		".default",
		Array(
			"EMAIL_TO" => "zemnowf@gmail.com",
            "EVENT_MESSAGE_ID" => array(
                0 => "52",
            ),
            "OK_TEXT" => "Спасибо, ваше сообщение принято.",
            "COMPONENT_TEMPLATE" => ".default",
            "IBLOCK_ID" => "4",
		)
	);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>