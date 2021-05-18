<?php

namespace NorthCreationAgency\SEOHelper;

use NorthCreationAgency\SEOHelper\SeoInjector;
use QuinnInteractive\Seo\Analysis\WordCountAnalysis;

class WordCountAnalysisInjector extends WordCountAnalysis
{
    public function getWordCount()
    {
        return count(array_filter(explode(' ', SeoInjector::collateContentFields($this->getPage()))));
    }
}
