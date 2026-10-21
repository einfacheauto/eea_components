<?php
defined('TYPO3') || die();

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

ExtensionUtility::registerPlugin(
    'Eeacomponents',
    'Calculator',
    'LLL:EXT:eeacomponents/Resources/Private/Language/locallang_db.xlf:tx_eea_components_eeacalculator.name',
    'eeacomponents-plugin-calculator',
    'plugins',
    'LLL:EXT:eeacomponents/Resources/Private/Language/locallang_db.xlf:tx_eea_components_eeacalculator.description'
);

ExtensionUtility::registerPlugin(
    'Eeacomponents',
    'Productfinder',
    'LLL:EXT:eeacomponents/Resources/Private/Language/locallang_db.xlf:tx_eea_components_productfinder.name',
    'eeacomponents-plugin-productfinder',
    'plugins',
    'LLL:EXT:eeacomponents/Resources/Private/Language/locallang_db.xlf:tx_eea_components_productfinder.description'
);
