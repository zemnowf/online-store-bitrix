<?php

namespace Lib\ActionFilter;

use Bitrix\Main\Context;
use Bitrix\Main\Engine\ActionFilter\Base;
use Bitrix\Main\Error;
use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Bitrix\Main\HttpRequest;

class Validator extends Base
{
    private array $fields;
    private HttpRequest $request;

    public function __construct(array $fields)
    {
        $this->fields = $fields;
        $this->request = Context::getCurrent()->getRequest();
        parent::__construct();
    }

    public function onBeforeAction(Event $event): ?EventResult
    {
        $arErrors = [];
        foreach ($this->fields as $key => $value) {
            if (strlen($this->request[$key]) < $value) {
                $arErrors[$key] = 'Значение должно быть не менее ' . $value . ' символов';
            }
        }

        if (!empty($arErrors)) {
            $this->addError(new Error($arErrors));
            return new EventResult(EventResult::ERROR, null, null, $this);
        }

        return null;
    }


}