<?php

use Behat\MinkExtension\Context\MinkContext;
use Laracasts\Behat\Context\DatabaseTransactions;


class FeatureContext extends MinkContext implements \Behat\Behat\Context\Context, \Behat\Behat\Context\SnippetAcceptingContext
{
    use DatabaseTransactions;
}