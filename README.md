<a href="https://fyb.ro/" title="Magento2 Custom Developer" ><img src="http://fyb.ro/wp-content/uploads/2022/01/fyb-logo-retina-white.png" width="100" align="right" alt="MagePal Adobe Commerce Extensions" /></a>

# Use Default Product Images for Magento 2 
<img src="https://img.shields.io/badge/magento-2.4-brightgreen.svg?logo=magento&longCache=true" alt="Supported Magento Versions" />
<a href="https://opensource.org/licenses/OSL-3.0" target="_blank"><img src="https://img.shields.io/badge/License-OSL%203.0-blue.svg" /></a>

This module adds Use Default Checkbox support for product images to Magento 2.

# Installation details

## Minimum requirements
We are using strict requirements in the `composer.json` file, to make sure compatibility follows from the `composer` requirements. When you have questions regarding compatibility, install the extension via `composer`. If it works, it is because it is compatible. If it does not work, it is because it is not compatible. When a new version of Magento comes out and the `composer` command fails, while you think it should actually work, open a support ticket so we can look into this.

## Instructions for using composer

Use composer to install this extension. First make sure that Magento is installed via composer, and that there is a valid `composer.json` file present.

Next, install our module using the following command:

    composer require fyb/module-use-default-images

Next, install the new module plus its dependency `Fyb_UseDefaultImages` into Magento itself:

    bin/magento module:enable Fyb_UseDefaultImages
    bin/magento setup:upgrade
    bin/magento setup:di:compile
    bin/magento setup:static-content:deploy

## Instructions for manual copy

Download a ZIP of this repository. Extract the files. Upload the files to the folder `app/code/Fyb/UseDefaultImages` of your site.

Next, install the new module into Magento itself:

    bin/magento module:enable Fyb_UseDefaultImages
    bin/magento setup:upgrade
    bin/magento setup:di:compile
    bin/magento setup:static-content:deploy

Contribution
---
Want to contribute to this extension? The quickest way is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).


Support
---
If you encounter any problems or bugs, please open an issue on [GitHub](https://github.com/magepal/magento2-googletagmanager/issues).

Need help to set up or want to customize our extension to meet your business needs? Please email office@fyb.ro and if we like your idea we will add this feature.

---
© FYB Romania. | [https://fyb.ro](https://fyb.ro)
