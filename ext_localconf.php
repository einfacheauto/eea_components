<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'EeaComponents',
        'Eeacalculator',
        [
            \Eea\EeaComponents\Controller\CalculatorController::class => 'list, show, new, create, edit, update, delete'
        ],
        // non-cacheable actions
        [
            \Eea\EeaComponents\Controller\CalculatorController::class => 'create, update, delete',
            \Eea\EeaComponents\Controller\ProductfinderController::class => 'create, update, delete'
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'EeaComponents',
        'Productfinder',
        [
            \Eea\EeaComponents\Controller\ProductfinderController::class => 'list, show, new, create, edit, update, delete'
        ],
        // non-cacheable actions
        [
            \Eea\EeaComponents\Controller\CalculatorController::class => 'create, update, delete',
            \Eea\EeaComponents\Controller\ProductfinderController::class => 'create, update, delete'
        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    eeacalculator {
                        iconIdentifier = eea_components-plugin-eeacalculator
                        title = LLL:EXT:eea_components/Resources/Private/Language/locallang_db.xlf:tx_eea_components_eeacalculator.name
                        description = LLL:EXT:eea_components/Resources/Private/Language/locallang_db.xlf:tx_eea_components_eeacalculator.description
                        tt_content_defValues {
                            CType = list
                            list_type = eeacomponents_eeacalculator
                        }
                    }
                    productfinder {
                        iconIdentifier = eea_components-plugin-productfinder
                        title = LLL:EXT:eea_components/Resources/Private/Language/locallang_db.xlf:tx_eea_components_productfinder.name
                        description = LLL:EXT:eea_components/Resources/Private/Language/locallang_db.xlf:tx_eea_components_productfinder.description
                        tt_content_defValues {
                            CType = list
                            list_type = eeacomponents_productfinder
                        }
                    }
                }
                show = *
            }
       }'
    );

})();
