<?php
namespace KB\SEOHelpers;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Config\Config;
use SilverStripe\ORM\ArrayList;
use SilverStripe\SiteConfig\SiteConfig;
use QuinnInteractive\Seo\Extensions\PageSeoExtension;
use QuinnInteractive\Seo\Seo;

/**
 * Created by PhpStorm.
 * User: herbertcuba
 * Date: 2019-12-11
 * Time: 17:45
 */

class KBPageSeoExtension extends PageSeoExtension
{
    private static $use_siteconfig_default = true;
    //default image to show, this should be overwritten by the different page types on what to use
    public function DefaultOGImage(){
        $OGImage = Image::create();
        if(Config::inst()->get(get_class(), 'use_siteconfig_default_image')){
            $sc=SiteConfig::current_site_config();
            if($sc->OGImageID){
                $OGImage = $sc->OGImage();
            }
        }
        return $OGImage;
    }

    /**
     * Extension point for SiteTree to merge all tags with the standard meta tags
     *
     * @param $tags
     */
    public function MetaTags(&$tags)
    {
        $tags = explode(PHP_EOL, $tags);
        $tags = array_merge(
            $tags,
            SeoInjector::getCanonicalUrlLink($this->owner),
            SeoInjector::getFacebookMetaTags($this->owner),
            SeoInjector::getTwitterMetaTags($this->owner),
            SeoInjector::getArticleTags($this->owner),
            SeoInjector::getGoogleAnalytics(),
            SeoInjector::getPixels()
        );

        $tags = implode(PHP_EOL, $tags);
    }
}
