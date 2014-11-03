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

In AppKernel.php file add this:
    <?php
    // in AppKernel::registerBundles()
    $bundles = array(
        // ...
        new Tutto\Bundle\DataGridBundle\TuttoDataGridBundle(),
        new Tutto\Bundle\XhtmlBundle\TuttoXhtmlBundle(),
        new \Tutto\Bundle\UtilBundle\TuttoUtilBundle()
        // ...
    );
