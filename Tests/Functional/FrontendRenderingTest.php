<?php

declare(strict_types=1);

namespace Eea\Eeacomponents\Tests\Functional;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Configuration\SiteWriter;
use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\InternalRequest;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Renders a page with both content elements through the real TYPO3 frontend.
 */
final class FrontendRenderingTest extends FunctionalTestCase
{
    protected array $coreExtensionsToLoad = ['fluid_styled_content', 'install'];

    protected array $testExtensionsToLoad = ['eea/eeacomponents'];

    protected function setUp(): void
    {
        parent::setUp();
        $this->importCSVDataSet(__DIR__ . '/Fixtures/pages_with_components.csv');
        $this->get(SiteWriter::class)->createNewBasicSite('main', 1, 'http://localhost/');
        $this->setUpFrontendRootPage(
            1,
            [],
            [
                'constants' => implode(LF, [
                    '@import \'EXT:fluid_styled_content/Configuration/TypoScript/constants.typoscript\'',
                    '@import \'EXT:eeacomponents/Configuration/TypoScript/constants.typoscript\'',
                    'plugin.tx_eeacomponents_calculator.components.customeridnum = 4711',
                    'plugin.tx_eeacomponents_productfinder.components.customeridnum = 4712',
                ]),
                'config' => implode(LF, [
                    '@import \'EXT:fluid_styled_content/Configuration/TypoScript/setup.typoscript\'',
                    '@import \'EXT:eeacomponents/Configuration/TypoScript/setup.typoscript\'',
                    'page = PAGE',
                    'page.10 < styles.content.get',
                ]),
            ]
        );
    }

    #[Test]
    public function calculatorWebComponentAndScriptAreRendered(): void
    {
        $body = $this->renderPage();

        self::assertStringContainsString('<eea-calculator-savings></eea-calculator-savings>', $body);
        self::assertStringContainsString(
            '<script type="module" src="https://media.einfacheauto.de/partners/production/4711/components/eea-calculator-savings.mjs"></script>',
            $body
        );
    }

    #[Test]
    public function productfinderWebComponentAndScriptAreRendered(): void
    {
        $body = $this->renderPage();

        self::assertStringContainsString('<eea-product-finder></eea-product-finder>', $body);
        self::assertStringContainsString(
            '<script type="module" src="https://media.einfacheauto.de/partners/production/4712/components/eea-product-finder.mjs"></script>',
            $body
        );
    }

    #[Test]
    public function componentsAreWrappedInExtensionContainer(): void
    {
        self::assertSame(2, substr_count($this->renderPage(), 'class="tx-eea-components"'));
    }

    private function renderPage(): string
    {
        $response = $this->executeFrontendSubRequest(new InternalRequest('http://localhost/'));

        self::assertSame(200, $response->getStatusCode());
        return (string)$response->getBody();
    }
}
