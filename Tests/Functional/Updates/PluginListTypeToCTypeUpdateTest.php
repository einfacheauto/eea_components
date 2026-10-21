<?php

declare(strict_types=1);

namespace Eea\Eeacomponents\Tests\Functional\Updates;

use Eea\Eeacomponents\Updates\PluginListTypeToCTypeUpdate;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Install\Service\UpgradeWizardsService;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

final class PluginListTypeToCTypeUpdateTest extends FunctionalTestCase
{
    protected array $coreExtensionsToLoad = ['install'];

    protected array $testExtensionsToLoad = ['eea/eeacomponents'];

    #[Test]
    public function wizardIsAvailableInInstallTool(): void
    {
        $identifiers = array_column($this->get(UpgradeWizardsService::class)->getUpgradeWizardsList(), 'identifier');

        self::assertContains('eeacomponentsPluginListTypeToCTypeUpdate', $identifiers);
    }

    #[Test]
    public function updateIsNotNecessaryWithoutLegacyPlugins(): void
    {
        self::assertFalse($this->get(PluginListTypeToCTypeUpdate::class)->updateNecessary());
    }

    #[Test]
    public function migratesLegacyPluginsAndBackendGroupPermissions(): void
    {
        $this->importCSVDataSet(__DIR__ . '/Fixtures/legacy_plugins.csv');
        $subject = $this->get(PluginListTypeToCTypeUpdate::class);

        self::assertTrue($subject->updateNecessary());
        self::assertTrue($subject->executeUpdate());
        self::assertFalse($subject->updateNecessary());
        $this->assertCSVDataSet(__DIR__ . '/Fixtures/migrated_plugins.csv');
    }
}
