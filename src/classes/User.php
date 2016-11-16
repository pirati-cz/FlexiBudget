<?php
/**
 * FlexiBudget - User.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015-2016 Vitex Software
 */

namespace FlexiBudget;

/**
 * System.spoje.net User.
 */
class User extends \Ease\User
{
    public $columns = [
        'login' => ['type' => 'string'],
        'firstname' => ['type' => 'string'],
        'lastname' => ['type' => 'string'],
        'email' => ['type' => 'string']
    ];

    /**
     * Tabulka uživatelů.
     *
     * @var string
     */
    public $myTable = 'user';

    /**
     * Sloupeček obsahující datum vložení záznamu do shopu.
     *
     * @var string
     */
    public $myCreateColumn = 'DatCreate';

    /**
     * Slopecek obsahujici datum poslení modifikace záznamu do shopu.
     *
     * @var string
     */
    public $myLastModifiedColumn = 'DatSave';

    /**
     * Budeme používat serializovaná nastavení uložená ve sloupečku.
     *
     * @var string
     */
    public $settingsColumn = 'settings';

    /**
     * Klíčové slovo.
     *
     * @var string
     */
    public $keyword = 'user';

    /**
     * Jmenný sloupec.
     *
     * @var string
     */
    public $nameColumn = 'login';

    /**
     * Vrací odkaz na ikonu.
     *
     * @return string
     */
    public function getIcon()
    {
        $Icon = $this->GetSettingValue('icon');
        if (is_null($Icon)) {
            return parent::getIcon();
        } else {
            return $Icon;
        }
    }

    /**
     * Vrací ID aktuálního záznamu.
     *
     * @return int
     */
    public function getId()
    {
        return (int) $this->getMyKey();
    }

    /**
     * Give you user name.
     *
     * @return string
     */
    public function getUserName()
    {
        $longname = trim($this->getDataValue('firstname').' '.$this->getDataValue('lastname'));
        if (strlen($longname)) {
            return $longname;
        } else {
            return parent::getUserName();
        }
    }

    public function getEmail()
    {
        return $this->getDataValue('email');
    }

    public function htmlizeData($data)
    {
        return $data;
    }

    /**
     * Místní nabídka uživatele.
     *
     * @return \\Ease\TWB\ButtonDropdown
     */
    public function operationsMenu()
    {
        $id = $this->getMyKey();
        $menu[] = new \Ease\Html\ATag($this->keyword.'.php?action=delete&'.$this->myKeyColumn.'='.$id, \Ease\TWB\Part::glyphIcon('remove').' '._('Smazat'));
        $menu[] = new \Ease\Html\ATag($this->keyword.'.php?'.$this->myKeyColumn.'='.$id, \Ease\TWB\Part::glyphIcon('edit').' '._('Upravit'));

        return new \Ease\TWB\ButtonDropdown(\Ease\TWB\Part::glyphIcon('cog'), 'warning', '', $menu);
    }


}