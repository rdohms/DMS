# DMSTwigExtensionBundle

This bundle leverages a collection of Fabien Potencier's Twig Extensions for use in your application.

This bundle is part of the DMS Library, and distributed as a sub-directory split, issues should be reported at the [DMS Repository](https://github.com/rdohms/DMS).

## Extensions

### Fabien's "Twig Extensions"

Available at [Fabien's repository](https://github.com/fabpot/Twig-extensions) these extensions are considered useful but do not belong in the Core of Twig, so they have been moved to this separate repository, they are:

* Text: truncate and wordwrap filter
* Debug: retrieves the token parser
* Intl: localized date filter
* i18n: trans filter and block (this extension conflicts with standard Symfony translator, so it is off by default, see Usage below.)

Further [documentation](https://github.com/fabpot/Twig-extensions/blob/master/doc/index.rst) is available in the repository.

### DMS Extensions

These are custom extensions which I find myself writing over and over for new projects.

* Textual Date: converts timestamp into dates like: `2 days ago` ([docs](/Resources/doc/textual_date.md))

## Installing

Add extension to your composer file:

    {
        "require": {
            "dms/twig-extension-bundle": "1.*"
        }
    }

or use composer's require command

    composer require dms/twig-extension-bundle:1.*
    
Load the bundle in your AppKernel

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new DMS\Bundle\TwigExtensionBundle\DMSTwigExtensionBundle(),
        );
    }
    
## Usage

To control which extensions should be enabled, you can optionally add configuration settings in app/config.yml:

    dms_twig_extension:   
        fabpot:               
            i18n:                 false 
            debug:                false 
            text:                 true 
            intl:                 true 
        dms:                  
            textual_date:         true             
        
Extensions set to `false` will not be loaded. Please refer to the extensions documentation for detailed usage on each one.

