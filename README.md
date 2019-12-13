# silverstripe-seo

Helper extensions to make Silverstripe-SEO easier to work with in regards to images and canonical settings

**Note:** This module requires Quinn-Interactive/silverstripe-seo ~ 1.0.6  (which replaces version 1.0.3 of `vulcandigital/silverstripe-seo`.)

## Features

* Option to set the OG:image per page type and a fallback on siteconfig if none is set
* Option to disable canonical links

### Example 

In order to disable canonicals. Set the following in your config.yml:
```html
KB\SEOHelpers\SeoInjector:
  show_canonical: false
```

In order to show a page header image as default OG:image, add this method to your Page type:
```html
public function DefaultOGImage()
{
    return $this->HeaderImage();
}
```

