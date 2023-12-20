<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_eeacomponents_domain_model_calculator', 'EXT:eea_components/Resources/Private/Language/locallang_csh_tx_eeacomponents_domain_model_calculator.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_eeacomponents_domain_model_calculator');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_eeacomponents_domain_model_productfinder', 'EXT:eea_components/Resources/Private/Language/locallang_csh_tx_eeacomponents_domain_model_productfinder.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_eeacomponents_domain_model_productfinder');

/*
    // FlexForms - begin
    $pluginSignature = 'eeacomponents_eeacalculator';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        $pluginSignature,
        'FILE:EXT:eea_components/Configuration/FlexForms/eeacalculator.xml'
    );

    $pluginSignature2 = 'eeacomponents_productfinder';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature2] = 'pi_flexform';
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        $pluginSignature2,
        'FILE:EXT:eea_components/Configuration/FlexForms/eeaproductfinder.xml'
    );
    // FlexForms - end
*/    

})();
