<?php

namespace KB\SEOHelpers;

use function get_class;
use SilverStripe\Core\Config\Config;
use Vulcan\Seo\Seo;
use Vulcan\Seo\Builders\FacebookMetaGenerator;

/**
 * Created by PhpStorm.
 * User: herbertcuba
 * Date: 2019-12-13
 * Time: 09:49
 */
class SeoInjector extends Seo
{
    private static $show_canonical = true;


    /**
     * Creates the canonical url link
     *
     * @param \Page|PageSeoExtension|Object $owner
     *
     * @return array
     */
    public static function getCanonicalUrlLink($owner)
    {
        if (Config::inst()->get(get_class(), 'show_canonical')) {
            return [
                sprintf('<link rel="canonical" href="%s"/>', $owner->AbsoluteLink())
            ];
        }
        return [];
    }

    /**
     * Creates the Facebook/OpenGraph meta tags
     *
     * @param \Page|PageSeoExtension|Object $owner
     *
     * @return array
     */
    public static function getFacebookMetaTags($owner)
    {
        if ($owner->FacebookPageImage()->exists()) {
            $OGImage = $owner->FacebookPageImage();
        } else {
            $OGImage = $owner->DefaultOGImage();
        }
        $imageWidth = $OGImage->exists() ? $OGImage->getWidth() : null;
        $imageHeight = $OGImage->exists() ? $OGImage->getHeight() : null;

        $generator = FacebookMetaGenerator::create();
        $generator->setTitle($owner->FacebookPageTitle ?: $owner->Title);
        $generator->setDescription($owner->FacebookPageDescription ?: $owner->MetaDescription ?: $owner->Content);
        $generator->setImageUrl(($OGImage->exists()) ? $OGImage->AbsoluteLink() : null);
        $generator->setImageDimensions($imageWidth, $imageHeight);
        $generator->setType($owner->FacebookPageType ?: 'website');
        $generator->setUrl($owner->OGUrl() ?: $owner->AbsoluteLink());

        return $generator->process();
    }
}
