<?php

namespace Alko\Guarantee;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\DatetimeField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type;
Loc::loadMessages(__FILE__);

class GuaranteeTable extends DataManager
{
    // название таблицы
    public static function getTableName()
    {
        return 'guarantee';
    }
    // создаем поля таблицы
    public static function getMap()
    {
        return array(
            new IntegerField('ID', array(
                'autocomplete' => true,
                'primary' => true
            )),
            new StringField('CHECK', array(
                'required' => false,
                'title' => Loc::getMessage('MYMODULE_CHECK'),
                'default_value' => function () {
                    return Loc::getMessage('MYMODULE_CHECK_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                }              
            )),
            new StringField('USER', array(
                'required' => false,
                'title' => Loc::getMessage('MYMODULE_USER'),
                'default_value' => function () {
                    return Loc::getMessage('MYMODULE_USER_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                }              
            )),
            new StringField('TIME', array(
                'required' => false,
                'title' => Loc::getMessage('MYMODULE_TIME'),
                'default_value' => function () {
                    return Loc::getMessage('MYMODULE_TIME_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                }              
            )),
			new StringField('ACTION', array(
                'required' => false,
                'title' => Loc::getMessage('MYMODULE_ACTION'),
                'default_value' => function () {
                    return Loc::getMessage('MYMODULE_ACTION_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                }              
            )),
            new StringField('NUMBER', array(
                'required' => false,
                'title' => Loc::getMessage('MYMODULE_NUMBER'),
                'default_value' => function () {
                    return Loc::getMessage('MYMODULE_NUMBER_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                }              
            )),
            new StringField('CITY', array(
                'required' => false,
                'title' => Loc::getMessage('MYMODULE_CITY'),
                'default_value' => function () {
                    return Loc::getMessage('MYMODULE_CITY_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                }              
            )),
            new StringField('IMG', array(
                'required' => false,
                'title' => Loc::getMessage('MYMODULE_IMG'),
                'default_value' => function () {
                    return Loc::getMessage('MYMODULE_IMG_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                }              
            )),
            new StringField('SITE', array(
                'required' => false,
                'title' => Loc::getMessage('MYMODULE_SITE'),
                'default_value' => function () {
                    return Loc::getMessage('MYMODULE_SITE_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                }              
            )),
            new StringField('ADRESS', array(
                'required' => false,
                'title' => Loc::getMessage('MYMODULE_ADRESS'),
                'default_value' => function () {
                    return Loc::getMessage('MYMODULE_ADRESS_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                }              
            )),
            new StringField('ARTICLE', array(
                'required' => false,
                'title' => Loc::getMessage('MYMODULE_ARTICLE'),
                'default_value' => function () {
                    return Loc::getMessage('MYMODULE_ARTICLE_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                }              
            )),
            new StringField('EMAIL', array(
                'required' => false,
                'title' => Loc::getMessage('MYMODULE_EMAIL'),
                'default_value' => function () {
                    return Loc::getMessage('MYMODULE_EMAIL_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                }              
            )),
            new StringField('SHOP', array(
                'required' => false,
                'title' => Loc::getMessage('MYMODULE_SHOP'),
                'default_value' => function () {
                    return Loc::getMessage('MYMODULE_SHOP_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                }              
            )),
            //обязательная строка с default значением  и длиной не более 255 символов
            new DatetimeField('UPDATED_AT',array(
                'required' => true)),//обязательное поле даты
            new DatetimeField('CREATED_AT',array(
                'required' => true)),//обязательное поле даты
        );
    }
}