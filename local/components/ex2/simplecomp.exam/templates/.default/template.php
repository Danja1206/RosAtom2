<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<p><b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b></p>
<?=GetMessage("CACHE_TIME");?><? echo time(); ?>
</br>
<?php if (count($arResult["CLASSIF"]) > 0): ?>
    <ul>
        <?php foreach ($arResult["CLASSIF"] as $arClassificator): ?>
            <li>
                <b><?=$arClassificator["NAME"]?></b>
                <?php if (count($arClassificator["ELEMENTS"]) > 0): ?>
                    <ul>
                        <?php foreach ($arClassificator["ELEMENTS"] as $arItem): ?>
                            <li>
                                <?=$arItem["NAME"]?> -
                                <?=$arItem["PROPERTY"]["PRICE"]["VALUE"]?> -
                                <?=$arItem["PROPERTY"]["MATERIAL"]["VALUE"]?> -
                                <?=$arItem["PROPERTY"]["ARTNUMBER"]["VALUE"]?> -
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">ссылка на детальный просмотр</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>