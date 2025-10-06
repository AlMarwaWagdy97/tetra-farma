<?php

namespace App\View\Components;

use App\Models\Menue;
use App\Models\SettingsValues;
use App\Settings\SettingSingleton;
use Illuminate\Support\Facades\App;
use Illuminate\View\Component;

class Footer extends Component
{
    public $footerLinks;
    public $footerTitle;
    public $footerDescription;
    public $cards;
    public $settings;
    public $facebookLink; // Added property for Facebook link
    public $instagramLink; // Added property for Instagram link

    public function __construct()
    {
        $this->footerLinks = Menue::with('trans')->footer()->active()->get();

        $currentLang = App::getLocale();

        $this->settings = SettingSingleton::getInstance();

        $this->footerTitle = $this->settings->getItem('footer_title_' . $currentLang);
        $this->footerDescription = $this->settings->getItem('footer_description_' . $currentLang);

        $this->facebookLink = $this->settings->getItem('facebook') ?? 'not found';
        $this->instagramLink = $this->settings->getItem('instagram') ?? 'not found';

        $this->cards = [];
        for ($i = 1; $i <= 4; $i++) {
            $this->cards[$i] = [
                'title' => $this->settings->getInfo("section{$i}_title" . $currentLang),
                'image' => $this->settings->getInfo("section{$i}_image"),
                'description' => $this->settings->getInfo("section{$i}_description" . $currentLang),
            ];
        }
    }

    public function render()
    {
        return view('components.footer');
    }
}