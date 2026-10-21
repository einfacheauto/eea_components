<?php

declare(strict_types=1);

namespace Eea\Eeacomponents\Tests\Functional;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Localization\LanguageServiceFactory;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Verifies how the extension integrates into TYPO3: plugins, TCA, icons, labels and TypoScript.
 */
final class ExtensionRegistrationTest extends FunctionalTestCase
{
    protected array $coreExtensionsToLoad = ['install'];

    protected array $testExtensionsToLoad = ['eea/eeacomponents'];

    /**
     * @return array<string, array{string, string, string}>
     */
    public static function pluginDataProvider(): array
    {
        return [
            'Calculator' => ['Calculator', 'eeacomponents_calculator', 'eeacomponents-plugin-calculator'],
            'Productfinder' => ['Productfinder', 'eeacomponents_productfinder', 'eeacomponents-plugin-productfinder'],
        ];
    }

    #[Test]
    public function extensionIsLoaded(): void
    {
        self::assertTrue(ExtensionManagementUtility::isLoaded('eeacomponents'));
    }

    #[Test]
    #[DataProvider('pluginDataProvider')]
    public function pluginIsConfiguredAsContentElement(string $pluginName, string $signature, string $iconIdentifier): void
    {
        $pluginConfiguration = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['extbase']['extensions']['Eeacomponents']['plugins'][$pluginName];

        // "list_type" plugins are deprecated since TYPO3 v13.4 and removed in v14
        self::assertSame(ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT, $pluginConfiguration['pluginType']);
    }

    #[Test]
    #[DataProvider('pluginDataProvider')]
    public function listIsTheDefaultActionOfThePlugin(string $pluginName, string $signature, string $iconIdentifier): void
    {
        $controllers = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['extbase']['extensions']['Eeacomponents']['plugins'][$pluginName]['controllers'];
        $controller = reset($controllers);

        self::assertSame('list', $controller['actions'][0]);
        self::assertSame(['create', 'update', 'delete'], $controller['nonCacheableActions']);
    }

    #[Test]
    #[DataProvider('pluginDataProvider')]
    public function pluginIsSelectableAsContentType(string $pluginName, string $signature, string $iconIdentifier): void
    {
        $items = $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'];
        $item = current(array_filter($items, static fn(array $item): bool => ($item['value'] ?? null) === $signature));

        self::assertIsArray($item, 'CType item "' . $signature . '" is not registered');
        self::assertSame($iconIdentifier, $item['icon']);
        self::assertSame('plugins', $item['group']);
        self::assertNotSame('', $this->getLanguageService()->sL($item['label']));
        self::assertNotSame('', $this->getLanguageService()->sL($item['description']));
    }

    #[Test]
    #[DataProvider('pluginDataProvider')]
    public function contentTypeHasTypeIconAndFormConfiguration(string $pluginName, string $signature, string $iconIdentifier): void
    {
        self::assertSame($iconIdentifier, $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$signature]);
        self::assertNotEmpty($GLOBALS['TCA']['tt_content']['types'][$signature]['showitem']);
    }

    #[Test]
    #[DataProvider('pluginDataProvider')]
    public function pluginIconIsRegisteredWithExistingFile(string $pluginName, string $signature, string $iconIdentifier): void
    {
        $iconRegistry = $this->get(IconRegistry::class);

        self::assertTrue($iconRegistry->isRegistered($iconIdentifier));
        $source = $iconRegistry->getIconConfigurationByIdentifier($iconIdentifier)['options']['source'];
        self::assertFileExists(GeneralUtility::getFileAbsFileName($source));
    }

    #[Test]
    #[DataProvider('pluginDataProvider')]
    public function frontendRenderingDefinitionIsGenerated(string $pluginName, string $signature, string $iconIdentifier): void
    {
        $typoScript = $GLOBALS['TYPO3_CONF_VARS']['FE']['defaultTypoScript_setup.']['defaultContentRendering'];

        self::assertStringContainsString('tt_content.' . $signature . ' =< lib.contentElement', $typoScript);
        self::assertStringNotContainsString('tt_content.list.20.' . $signature, $typoScript);
    }

    #[Test]
    public function staticTypoScriptTemplateIsRegistered(): void
    {
        $values = array_column($GLOBALS['TCA']['sys_template']['columns']['include_static_file']['config']['items'], 'value');

        self::assertContains('EXT:eeacomponents/Configuration/TypoScript', $values);
    }

    /**
     * @return array<string, array{string}>
     */
    public static function tableDataProvider(): array
    {
        return [
            'calculator' => ['tx_eeacomponents_domain_model_calculator'],
            'productfinder' => ['tx_eeacomponents_domain_model_productfinder'],
        ];
    }

    #[Test]
    #[DataProvider('tableDataProvider')]
    public function tableLabelsAndIconResolve(string $table): void
    {
        $tca = $GLOBALS['TCA'][$table];

        self::assertNotSame('', $this->getLanguageService()->sL($tca['ctrl']['title']));
        self::assertNotSame('', $this->getLanguageService()->sL($tca['columns']['customerid']['label']));
        self::assertFileExists(GeneralUtility::getFileAbsFileName($tca['ctrl']['iconfile']));
    }

    #[Test]
    #[DataProvider('tableDataProvider')]
    public function tableUsesCurrentTcaSyntax(string $table): void
    {
        $tca = $GLOBALS['TCA'][$table];

        self::assertArrayNotHasKey('cruser_id', $tca['ctrl']);
        self::assertSame('datetime', $tca['columns']['starttime']['config']['type']);
        self::assertSame('datetime', $tca['columns']['endtime']['config']['type']);
    }

    #[Test]
    public function allExtensionLabelReferencesResolve(): void
    {
        $files = [
            ...glob(__DIR__ . '/../../Configuration/TCA/*.php') ?: [],
            ...glob(__DIR__ . '/../../Configuration/TCA/Overrides/*.php') ?: [],
            __DIR__ . '/../../Configuration/TypoScript/constants.typoscript',
        ];
        $references = [];
        foreach ($files as $file) {
            preg_match_all('/LLL:EXT:[a-z0-9_]+\/[^\'"\s]+:[A-Za-z0-9_.-]+/', (string)file_get_contents($file), $matches);
            $references = [...$references, ...$matches[0]];
        }

        self::assertNotEmpty($references);
        foreach (array_unique($references) as $reference) {
            self::assertStringStartsNotWith('LLL:EXT:eea_components', $reference);
            self::assertNotSame('', $this->getLanguageService()->sL($reference), 'Label not found: ' . $reference);
        }
    }

    private function getLanguageService(): LanguageService
    {
        return $this->get(LanguageServiceFactory::class)->create('default');
    }
}
