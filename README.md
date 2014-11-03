TuttoDataGridBundle
========

Installation
============

TuttoDataGridBundle can be conveniently installed via Composer. Just add the
following to your `composer.json` file:

    // composer.json
    {
        // ...
        require: {
            // ...
            "tutto/xhtml-bundle": "1.0.*@dev"
        }
    }


    <?php

    // in AppKernel::registerBundles()
    $bundles = array(
        // ...
        new JMS\DiExtraBundle\JMSDiExtraBundle($this),
        new JMS\AopBundle\JMSAopBundle(),
        // ...
    );
