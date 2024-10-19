<?php
defined('TYPO3') or die();

use Eea\EeaComponents12\Controller\ProductfinderController;

call_user_func(function () {
    // Register a plugin
    /*
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Vendor.YourExtension',
        'PluginName',
        [\Vendor\YourExtension\Controller\YourController::class => 'list, show']
    );
    */

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'EeaComponents12',
        'Calculator',
        [
            \Eea\EeaComponents12\Controller\CalculatorController::class => 'list, show, new, create, edit, update, delete'
        ],
        // non-cacheable actions
        [
            \Eea\EeaComponents12\Controller\CalculatorController::class => 'create, update, delete',
            \Eea\EeaComponents12\Controller\ProductfinderController::class => 'create, update, delete'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'EeaComponents12',
        'Productfinder',
        [
            \Eea\EeaComponents12\Controller\ProductfinderController::class => 'list, show, new, create, edit, update, delete'
        ],
        // non-cacheable actions
        [
            \Eea\EeaComponents12\Controller\ProductfinderController::class => 'create, update, delete',
            \Eea\EeaComponents12\Controller\CalculatorController::class => 'create, update, delete',
        ]
    );


    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    calculator {
                        iconIdentifier = eea_components12-plugin-calculator
                        title = LLL:EXT:eea_components12/Resources/Private/Language/locallang_db.xlf:tx_eea_components_eeacalculator.name
                        description = LLL:EXT:eea_components12/Resources/Private/Language/locallang_db.xlf:tx_eea_components_eeacalculator.description
                        tt_content_defValues {
                            CType = list
                            list_type = eeacomponents12_calculator
                        }
                    }
                    productfinder {
                        iconIdentifier = eea_components12-plugin-productfinder
                        title = LLL:EXT:eea_components12/Resources/Private/Language/locallang_db.xlf:tx_eea_components_productfinder.name
                        description = LLL:EXT:eea_components12/Resources/Private/Language/locallang_db.xlf:tx_eea_components_productfinder.description
                        tt_content_defValues {
                            CType = list
                            list_type = eeacomponents12_productfinder
                        }
                    }
                }
                show = *
            }
       }'
    );
});