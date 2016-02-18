<?php

use Behat\MinkExtension\Context\MinkContext;
use Laracasts\Behat\Context\DatabaseTransactions;
use PHPUnit_Framework_Assert as PHPunit;


class FeatureConext extends MinkContext implements \Behat\Behat\Context\Context, \Behat\Behat\Context\SnippetAcceptingContext
{
    use DatabaseTransactions;
}