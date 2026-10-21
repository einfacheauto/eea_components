<?php

declare(strict_types=1);

namespace Eea\Eeacomponents\Tests\Unit\Updates;

use Eea\Eeacomponents\Updates\PluginListTypeToCTypeUpdate;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

final class PluginListTypeToCTypeUpdateTest extends UnitTestCase
{
    #[Test]
    public function isRegisteredAsUpgradeWizardWithStableIdentifier(): void
    {
        $attributes = (new \ReflectionClass(PluginListTypeToCTypeUpdate::class))->getAttributes(UpgradeWizard::class);

        self::assertCount(1, $attributes);
        // The identifier is documented in the README and stored in sys_registry once executed
        self::assertSame('eeacomponentsPluginListTypeToCTypeUpdate', $attributes[0]->newInstance()->identifier);
    }

    #[Test]
    public function mapsAllPluginsToContentElementsWithTheSameSignature(): void
    {
        $subject = new PluginListTypeToCTypeUpdate($this->createMock(ConnectionPool::class));
        $mapping = (new \ReflectionMethod($subject, 'getListTypeToCTypeMapping'))->invoke($subject);

        self::assertSame(
            [
                'eeacomponents_calculator' => 'eeacomponents_calculator',
                'eeacomponents_productfinder' => 'eeacomponents_productfinder',
            ],
            $mapping
        );
    }

    #[Test]
    public function providesTitleAndDescription(): void
    {
        $subject = new PluginListTypeToCTypeUpdate($this->createMock(ConnectionPool::class));

        self::assertNotSame('', $subject->getTitle());
        self::assertNotSame('', $subject->getDescription());
    }
}
