<?php
//подключаем основные классы для работы с модулем
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Entity\Base;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Alko\Guarantee\GuaranteeTable;
Loc::loadMessages(__FILE__);

class alko_guarantee extends CModule
{
    public function __construct()
    {
        $arModuleVersion = array();
				//подключаем версию модуля (файл будет следующим в списке)
        include __DIR__ . '/version.php';
				//присваиваем свойствам класса переменные из нашего файла
        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
				//пишем название нашего модуля как и директории
        $this->MODULE_ID = 'alko.guarantee';
        // название модуля
        $this->MODULE_NAME = Loc::getMessage('MYMODULE_MODULE_NAME');
        //описание модуля
        $this->MODULE_DESCRIPTION = Loc::getMessage('MYMODULE_MODULE_DESCRIPTION');
        //используем ли индивидуальную схему распределения прав доступа, мы ставим N, так как не используем ее
        $this->MODULE_GROUP_RIGHTS = 'N';
        //название компании партнера предоставляющей модуль
        $this->PARTNER_NAME = Loc::getMessage('MYMODULE_MODULE_PARTNER_NAME');
        $this->PARTNER_URI = 'https://foton.name';//адрес вашего сайта
    }
    public function getRoot()
    {
        return $_SERVER['DOCUMENT_ROOT'] .'/bitrix';
    }    
    public function doInstall()
    {
        CopyDirFiles(__DIR__ . '/components', $this->getRoot() . "/components", true, true);
        CopyDirFiles(__DIR__ . '/page', $_SERVER['DOCUMENT_ROOT'], true, true);
		copy(__DIR__ . '/admin/guarantee_index.php', $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/guarantee_index.php');
        ModuleManager::registerModule($this->MODULE_ID);
        $this->installDB();
    }

    public function doUninstall()
    {
		 DeleteDirFilesEx($this->getRoot(). '/components/guarantee_users');
		 DeleteDirFilesEx($_SERVER['DOCUMENT_ROOT']. '/guarantee');
		 unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/guarantee_index.php');
		 $this->uninstallDB();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }
		//вызываем метод создания таблицы из выше подключенного класса
    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            GuaranteeTable::getEntity()->createDbTable();
            
        }
    }
		//вызываем метод удаления таблицы, если она существует
    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            if (Application::getConnection()->isTableExists(Base::getInstance('\Alko\Guarantee\GuaranteeTable')->getDBTableName())) {
                $connection = Application::getInstance()->getConnection();
                $connection->dropTable(GuaranteeTable::getTableName());
            }
        }
    }
}