<?php
defined('TYPO3') or die();

use Eea\Eeacomponents\Controller\CalculatorController;
use Eea\Eeacomponents\Controller\ProductfinderController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(function () {
    ExtensionUtility::configurePlugin(
        'Eeacomponents',
        'Calculator',
        [
            CalculatorController::class => 'list, show, new, create, edit, update, delete'
        ],
        // non-cacheable actions
        [
            CalculatorController::class => 'create, update, delete'
        ],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    ExtensionUtility::configurePlugin(
        'Eeacomponents',
        'Productfinder',
        [
            ProductfinderController::class => 'list, show, new, create, edit, update, delete'
        ],
        // non-cacheable actions
        [
            ProductfinderController::class => 'create, update, delete'
        ],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );
});
