<?php

namespace App\Settings;

use App\Models\Settings;


class SettingSingleton
{
    private static $instance;
    private $settings;
    private $siteSetting, $colorsSetting, $scriptSetting, $infoSetting, $metaSetting, $viewSetting, $couponSetting, $upperNotify;

    private function __construct() {}

    public static function getInstance()

    {
        if (!self::$instance) {
            self::$instance = new SettingSingleton();
            self::$instance->loadSettingDatabase();
        }
        return self::$instance;
    }


    private function loadSettingDatabase()
    {
        // Code to retrieve header and footer content from the database
        // Example:

        $this->settings = Settings::with('values')->get();

        $this->siteSetting = (clone $this->settings)->where('key', 'site_setting')->first()?->values;

        $this->metaSetting = (clone $this->settings)->where('key', 'meta_setting')->first()?->values;

        $this->colorsSetting = (clone $this->settings)->where('key', 'color_setting')->first()?->values;

        $this->infoSetting = (clone $this->settings)->where('key', 'info_setting')->first()?->values;

        $this->viewSetting = (clone $this->settings)->where('key', 'home_setting')->first()?->values;

        $this->couponSetting = (clone $this->settings)->where('key', 'coupon_setting')->first()?->values;

        $this->upperNotify = (clone $this->settings)->where('key', 'upper_notify_setting')->first()?->values;
        $this->scriptSetting = (clone $this->settings)->where('key', 'header_scripts')->first()?->values;
    }

    public function getSiteSetting()
    {
        return $this->siteSetting;
    }

    // public function getsocialSetting()
    // {
    //     return $this->socialSetting;
    // }

    public function getCouponSetting()
    {
        return $this->couponSetting;
    }
    public function getupperNotifySetting()
    {
        return $this->upperNotify;
    }
    public function getScriptSetting()
    {
        return $this->scriptSetting;
    }

    public function getColorSetting()
    {
        return $this->colorsSetting;
    }

    public function getInfoSetting()
    {
        return $this->infoSetting;
    }
    public function getMetaSetting()
    {
        return $this->metaSetting;
    }

    public function getViewSetting()
    {
        return $this->viewSetting;
    }

    public function getItem($val)
    {
        $value = "";
        if (substr($val, -3) == "_en" || substr($val, -2) ==  "_ar") {
            $val = substr($val, 0, -3) . '_' . app()->getLocale();
        }

        switch ($val) {
            case 'site_name':
                $value = $this->siteSetting?->where('key', 'site_name_' . app()->getLocale())->first()?->value;
                break;
            case 'site_name_lower':
                $value = $this->siteSetting?->where('key', 'site_name_lower_' . app()->getLocale())->first()?->value;
                break;
            case 'logo':
                $value = $this->siteSetting?->where('key', 'logo_' . app()->getLocale())->first()?->value;
                break;
            case 'address':
                $value = $this->siteSetting?->where('key', 'address_' . app()->getLocale())->first()?->value;
                break;
            case 'categories':
                $value = $this->siteSetting?->where('key', 'categories_' . app()->getLocale())->first()?->value;
                break;
            case 'occassions':
                $value = $this->siteSetting?->where('key', 'occassions_' . app()->getLocale())->first()?->value;
                break;
            case 'Shop_by_Occasions':
                $value = $this->siteSetting?->where('key', 'Shop_by_Occasions_' . app()->getLocale())->first()?->value;
                break;
            case 'Shop_by_category':
                $value = $this->siteSetting?->where('key', 'Shop_by_category_' . app()->getLocale())->first()?->value;
                break;
            case 'Best_Seller':
                $value = $this->siteSetting?->where('key', 'Best_Seller_' . app()->getLocale())->first()?->value;
                break;
            case 'Best_Offers':
                $value = $this->siteSetting?->where('key', 'Best_Offers_' . app()->getLocale())->first()?->value;
                break;
            case 'show_text_in_product':
                $value = $this->siteSetting?->where('key', 'show_text_in_product_' . app()->getLocale())->first()?->value;
                break;
            case 'tax':
                $value = $this->siteSetting
                    ?->where('key', 'tax')
                    ->first()?->value;
                break;
            case 'shipping_giza':
                $value = $this->siteSetting
                    ?->where('key', 'shipping_giza')
                    ->first()?->value;
                break;
            case 'shipping_cairo':
                $value = $this->siteSetting
                    ?->where('key', 'shipping_cairo')
                    ->first()?->value;
                break;
            case 'Downtown':
                $value = $this->siteSetting
                    ?->where('key', 'Downtown')
                    ->first()?->value;
                break;
            case 'Zamalek':
                $value = $this->siteSetting
                    ?->where('key', 'Zamalek')
                    ->first()?->value;
                break;
            case 'Garden_City':
                $value = $this->siteSetting
                    ?->where('key', 'Garden_City')
                    ->first()?->value;
                break;
            case 'ElManial':
                $value = $this->siteSetting
                    ?->where('key', 'ElManial')
                    ->first()?->value;
                break;
            case 'Nasr_City':
                $value = $this->siteSetting
                    ?->where('key', 'Nasr_City')
                    ->first()?->value;
                break;
            case 'Heliopolis':
                $value = $this->siteSetting
                    ?->where('key', 'Heliopolis')
                    ->first()?->value;
                break;
            case 'Abbassia':
                $value = $this->siteSetting
                    ?->where('key', 'Abbassia')
                    ->first()?->value;
                break;
            case 'Roxy':
                $value = $this->siteSetting
                    ?->where('key', 'Roxy')
                    ->first()?->value;
                break;
            case 'ElNozha':
                $value = $this->siteSetting
                    ?->where('key', 'ElNozha')
                    ->first()?->value;
                break;
            case 'Sheraton':
                $value = $this->siteSetting
                    ?->where('key', 'Sheraton')
                    ->first()?->value;
                break;
            case 'Shubra':
                $value = $this->siteSetting
                    ?->where('key', 'Shubra')
                    ->first()?->value;
                break;
            case 'Maadi':
                $value = $this->siteSetting
                    ?->where('key', 'Maadi')
                    ->first()?->value;
                break;
            case 'Helwan':
                $value = $this->siteSetting
                    ?->where('key', 'Helwan')
                    ->first()?->value;
                break;
            case 'ElRehab':
                $value = $this->siteSetting
                    ?->where('key', 'ElRehab')
                    ->first()?->value;
                break;
            case 'Madinaty':
                $value = $this->siteSetting
                    ?->where('key', 'Madinaty')
                    ->first()?->value;
                break;
            case 'The_fifth_settlement':
                $value = $this->siteSetting
                    ?->where('key', 'The_fifth_settlement')
                    ->first()?->value;
                break;
            case 'Giza':
                $value = $this->siteSetting
                    ?->where('key', 'Giza')
                    ->first()?->value;
                break;
            case 'Dokki':
                $value = $this->siteSetting
                    ?->where('key', 'Dokki')
                    ->first()?->value;
                break;
            case 'Mohandessin':
                $value = $this->siteSetting
                    ?->where('key', 'Mohandessin')
                    ->first()?->value;
                break;
            case 'Agouza':
                $value = $this->siteSetting
                    ?->where('key', 'Agouza')
                    ->first()?->value;
                break;
            case 'Imbaba':
                $value = $this->siteSetting
                    ?->where('key', 'Imbaba')
                    ->first()?->value;
                break;
            case 'Faisal':
                $value = $this->siteSetting
                    ?->where('key', 'Faisal')
                    ->first()?->value;
                break;
            case '6th_of_October_City':
                $value = $this->siteSetting
                    ?->where('key', '6th_of_October_City')
                    ->first()?->value;
                break;
            case 'Sheikh_Zayed':
                $value = $this->siteSetting
                    ?->where('key', 'Sheikh_Zayed')
                    ->first()?->value;
                break;
            case 'Haram':
                $value = $this->siteSetting
                    ?->where('key', 'Haram')
                    ->first()?->value;
                break;
            case 'order_email_1':
                $value = $this->siteSetting
                    ?->where('key', 'order_email_1')
                    ->first()?->value;
                break;
            case 'order_email_2':
                $value = $this->siteSetting
                    ?->where('key', 'order_email_2')
                    ->first()?->value;
                break;

            case 'coupon_description':
                $value = $this->couponSetting
                    ?->where('key', 'coupon_description_' . app()->getLocale())
                    ->first()?->value;
                break;
            case 'coupon_title':
                $value = $this->couponSetting
                    ?->where('key', 'coupon_title_' . app()->getLocale())
                    ->first()?->value;
                break;
            case 'upper_text':
                $value = $this->upperNotify
                    ?->where('key', 'upper_text_' . app()->getLocale())
                    ->first()?->value;
                break;
            case 'upper_text_coupon':
                $value = $this->upperNotify
                    ?->where('key', 'upper_text_coupon_' . app()->getLocale())
                    ->first()?->value;
                break;
            case 'upper_text_sale':
                $value = $this->upperNotify
                    ?->where('key', 'upper_text_sale_' . app()->getLocale())
                    ->first()?->value;
                break;
            case 'upper_text_other':
                $value = $this->upperNotify
                    ?->where('key', 'upper_text_other_' . app()->getLocale())
                    ->first()?->value;
                break;
            case 'upper_text_shipping_cairo_giza':
                $value = $this->upperNotify
                    ?->where('key', 'upper_text_shipping_cairo_giza_' . app()->getLocale())
                    ->first()?->value;
                break;
            case 'upper_show':
                $value = $this->upperNotify
                    ?->where('key', 'upper_show')
                    ->first()?->value;
                break;
            case 'upper_price':
                $value = $this->upperNotify
                    ?->where('key', 'upper_price')
                    ->first()?->value;
                break;
            case 'openTime':
                $value = $this->siteSetting?->where('key', 'open_' . app()->getLocale())->first()?->value;
                break;
          
            default:
                if (substr($val, -3) == "_en" || substr($val, -2) ==  "_ar") {
                    $val = substr($val, 0, -3) . '_' . app()->getLocale();
                }
                $value = $this->siteSetting?->where('key', $val)->first()?->value;
        }
        return $value;
    }


    public function getColor($val)
    {
        return array_filter(json_decode($this->colorsSetting->where('key', $val)->first()?->value));
    }

    public function getInfo($val)
    {
        return $this->infoSetting?->where('key', $val)->first()?->value;
    }

    public function getUpperNotify($val)
    {
        return $this->upperNotify?->where('key', $val)->first()?->value;
    }

    // public function getCoupon($val)
    // {
    //     return $this->couponSetting?->where('key', $val)->first()?->value;
    // }
    public function getCoupon($val)
    {
        if ($val === 'welcome_coupon_id') {
            return $this->couponSetting?->where('key', 'welcome_coupon_id')->first()?->value;
        }
        return $this->couponSetting?->where('key', $val)->first()?->value;
    }

  public function getScript($val)
    {
        return ($this->scriptSetting?->where('key', $val)->first()?->value);
    }

    public function getMeta($val)
    {
        return $this->metaSetting?->where('key', $val)->first()?->value;
    }

    public function getView($val)
    {
        return $this->viewSetting?->where('key', $val)->first()?->value;
    }
}
