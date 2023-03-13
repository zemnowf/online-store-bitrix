<?php

namespace Sprint\Migration;


class Version20230311013908 extends Version
{
    protected $description = "";

    protected $moduleVersion = "4.2.5";

    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $hlblockId = $helper->Hlblock()->saveHlblock(array(
            'NAME' => 'Labels',
            'TABLE_NAME' => 'labels',
            'LANG' =>
                array(
                    'ru' =>
                        array(
                            'NAME' => 'Лейблы',
                        ),
                    'en' =>
                        array(
                            'NAME' => 'Labels',
                        ),
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array(
            'FIELD_NAME' => 'UF_NAME',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array(
                    'SIZE' => 20,
                    'ROWS' => 1,
                    'REGEXP' => '',
                    'MIN_LENGTH' => 0,
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array(
                    'en' => 'Label name',
                    'ru' => 'Название лейбла',
                ),
            'LIST_COLUMN_LABEL' =>
                array(
                    'en' => 'Label name',
                    'ru' => 'Название лейбла',
                ),
            'LIST_FILTER_LABEL' =>
                array(
                    'en' => 'Label name',
                    'ru' => 'Название лейбла',
                ),
            'ERROR_MESSAGE' =>
                array(
                    'en' => '',
                    'ru' => '',
                ),
            'HELP_MESSAGE' =>
                array(
                    'en' => '',
                    'ru' => '',
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array(
            'FIELD_NAME' => 'UF_COLOR_RGB',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array(
                    'SIZE' => 20,
                    'ROWS' => 1,
                    'REGEXP' => '',
                    'MIN_LENGTH' => 0,
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => '0, 255, 0',
                ),
            'EDIT_FORM_LABEL' =>
                array(
                    'en' => 'Label color',
                    'ru' => 'Цвет лейбла',
                ),
            'LIST_COLUMN_LABEL' =>
                array(
                    'en' => 'Label color',
                    'ru' => 'Цвет лейбла',
                ),
            'LIST_FILTER_LABEL' =>
                array(
                    'en' => 'Label color',
                    'ru' => 'Цвет лейбла',
                ),
            'ERROR_MESSAGE' =>
                array(
                    'en' => '',
                    'ru' => '',
                ),
            'HELP_MESSAGE' =>
                array(
                    'en' => '',
                    'ru' => '',
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array(
            'FIELD_NAME' => 'UF_LINK',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array(
                    'SIZE' => 40,
                    'ROWS' => 1,
                    'REGEXP' => '',
                    'MIN_LENGTH' => 0,
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array(
                    'en' => 'Link',
                    'ru' => 'Ссылка ',
                ),
            'LIST_COLUMN_LABEL' =>
                array(
                    'en' => 'Link',
                    'ru' => 'Ссылка',
                ),
            'LIST_FILTER_LABEL' =>
                array(
                    'en' => 'Link',
                    'ru' => 'Ссылка',
                ),
            'ERROR_MESSAGE' =>
                array(
                    'en' => '',
                    'ru' => '',
                ),
            'HELP_MESSAGE' =>
                array(
                    'en' => '',
                    'ru' => '',
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array(
            'FIELD_NAME' => 'UF_XML_ID',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array(
                    'SIZE' => 20,
                    'ROWS' => 1,
                    'REGEXP' => '',
                    'MIN_LENGTH' => 0,
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array(
                    'en' => 'UF_XML_ID',
                    'ru' => 'UF_XML_ID',
                ),
            'LIST_COLUMN_LABEL' =>
                array(
                    'en' => 'UF_XML_ID',
                    'ru' => 'UF_XML_ID',
                ),
            'LIST_FILTER_LABEL' =>
                array(
                    'en' => 'UF_XML_ID',
                    'ru' => 'UF_XML_ID',
                ),
            'ERROR_MESSAGE' =>
                array(
                    'en' => '',
                    'ru' => '',
                ),
            'HELP_MESSAGE' =>
                array(
                    'en' => '',
                    'ru' => '',
                ),
        ));
    }

    public function down()
    {
        //your code ...
    }
}