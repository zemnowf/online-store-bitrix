<?php

use \Bitrix\Main\Loader;

Loader::registerNamespace(
    "Lib",
    $_SERVER["DOCUMENT_ROOT"] . "/local/lib",
);