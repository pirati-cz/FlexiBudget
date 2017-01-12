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
        'icon' => ['type' => 'image'],
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
        $icon = $this->getDataValue('icon');
        if (is_null($icon)) {
            $icon = parent::getIcon();
        }
        if (is_null($icon)) {
            $icon = 'images/users_150.png';
        }
        return $icon;
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

    /**
     * Vrací všechny záznamy jako html
     *
     * @param array $data
     * @return array
     */
    public function htmlizeData($data)
    {
        if (is_array($data) && count($data)) {
            foreach ($data as $rowId => $row) {
                $htmlized = $this->htmlizeRow($row);
                if (is_array($htmlized)) {
                    foreach ($htmlized as $key => $value) {
                        if (!is_null($value)) {
                            $data[$rowId][$key] = $value;
                        } else {
                            if (!isset($data[$rowId][$key])) {
                                $data[$rowId][$key] = $value;
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }

    /**
     * Prepare Row Data to show as html
     * 
     * @param array $data
     * @return \Ease\Html\ImgTag
     */
    public function htmlizeRow($data)
    {
        $data['icon'] = '<img src="'.$data['icon'].'" class="list-icon" alt="'.$data['login'].'" title="'.$data['firstname'].' '.$data['lastname'].'">';
        return $data;
    }

    /**
     * Místní nabídka uživatele.
     *
     * @return \\Ease\TWB\ButtonDropdown
     */
    public function operationsMenu()
    {
        $id     = $this->getMyKey();
        $menu[] = new \Ease\Html\ATag($this->keyword.'.php?action=delete&'.$this->myKeyColumn.'='.$id,
            \Ease\TWB\Part::glyphIcon('remove').' '._('Smazat'));
        $menu[] = new \Ease\Html\ATag($this->keyword.'.php?'.$this->myKeyColumn.'='.$id,
            \Ease\TWB\Part::glyphIcon('edit').' '._('Upravit'));

        return new \Ease\TWB\ButtonDropdown(\Ease\TWB\Part::glyphIcon('cog'),
            'warning', '', $menu);
    }

    /**
     * User Icon linked to User page
     * 
     * @param \FlexiBudget\User $user
     * @param array $properties
     * @return \Ease\Html\ATag
     */
    static public function icoLink($user, $properties = [])
    {
        if (!is_object($user)) {
            $user = new User((int) $user);
        }
        if (!isset($properties['title']) && is_object($user)) {
            $properties['title'] = $user->getUserName();
        }
        return new \Ease\Html\ATag('user.php?id='.$user->getId(),
            new \Ease\Html\ImgTag($user->getIcon(), $user->getUserLogin(),
            $properties), ['data-name' => $properties['title']]);
    }
}
