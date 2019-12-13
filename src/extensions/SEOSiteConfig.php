<?php
namespace KB\SEOHelpers;
use SilverStripe\ORM\DataExtension;

// Custom fields
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;

// Logo
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;


class SEOSiteConfig extends DataExtension
{

	private static $has_one = [
		'OGImage' => Image::class,
	];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab(
			'Root.VulcanSEO',
			[
				UploadField::create('OGImage', 'OG:Image (Used when sharing content)')->setAllowedMaxFileNumber(1)->setAllowedFileCategories('image'),
			]
		);
    }  
}
