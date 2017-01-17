<?php
/**
 * FlexiBudget - BootStrap Menu.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015-2016 Vitex Software
 */

namespace FlexiBudget\ui;

class BootstrapMenu extends \Ease\TWB\Navbar
{
    /**
     * Navigace.
     *
     * @var \Ease\Html\UlTag
     */
    public $nav = null;

    /**
     * Hlavní menu aplikace.
     *
     * @param string $name
     * @param mixed  $content
     * @param array  $properties
     */
    public function __construct($name = null, $content = null,
                                $properties = [])
    {
        parent::__construct('Menu',
            new \Ease\Html\ImgTag('images/poklad.svg', _('FlexiBudget'),
            ['class' => 'img-rounded', 'width' => 24, 'height' => 24]),
            ['class' => 'navbar-fixed-top']);

        $user = \Ease\Shared::user();
        \Ease\TWB\Part::twBootstrapize();
        if (!$user->getUserID()) {
            if (get_class($user) != 'EaseAnonym') {
                $this->addMenuItem(new \Ease\Html\ATag('about.php', _('About')),
                    'right');
            }
        } else {
            $userMenu = '<li class="dropdown" style="width: 120px; text-align: right; background-image: url( '.$user->getIcon().' ) ;  background-repeat: no-repeat; background-position: left center; background-size: 40px 40px;"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$user->getUserLogin().' <b class="caret"></b></a>
<ul class="dropdown-menu" style="text-align: left; left: -60px;">
<li><a href="settings.php">'.\Ease\TWB\Part::GlyphIcon('wrench').'<i class="icon-cog"></i> '._('Settings').'</a></li>
';

            if ($user->getSettingValue('admin')) {
//                $userMenu .= '<li><a href="overview.php">'.\Ease\TWB\Part::GlyphIcon('list').' '._('Přehled konfigurací').'</a></li>';
            }

            $this->addMenuItem($userMenu.'
<li><a href="changepassword.php">'.\Ease\TWB\Part::GlyphIcon('lock').' '._('Password change').'</a></li>
<li><a href="about.php">'.\Ease\TWB\Part::GlyphIcon('info-sign').' '._('About FlexiBudget').'</a></li>
<li class="divider"></li>
<li><a href="logout.php">'.\Ease\TWB\Part::GlyphIcon('off').' '._('Sign Off').'</a></li>
</ul>
</li>
', 'right');
        }
    }

    /**
     * Show Status Messages.
     */
    public function draw()
    {
        $statusMessages = $this->webPage->getStatusMessagesAsHtml();
        if ($statusMessages) {
            $this->addItem(new \Ease\Html\Div($statusMessages,
                ['id' => 'StatusMessages', 'class' => 'well', 'title' => _('Click to hide messages'),
                'data-state' => 'down']));
            $this->addItem(new \Ease\Html\Div(null, ['id' => 'smdrag']));
            $this->webPage->cleanMessages();
        }
        parent::draw();
    }

}
