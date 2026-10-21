<?php

declare(strict_types=1);

namespace Eea\Eeacomponents\Tests\Unit\Domain\Model;

use Eea\Eeacomponents\Domain\Model\Calculator;
use Eea\Eeacomponents\Domain\Model\Productfinder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

final class ComponentModelTest extends UnitTestCase
{
    /**
     * @return array<string, array{class-string<Calculator|Productfinder>}>
     */
    public static function modelClassDataProvider(): array
    {
        return [
            'Calculator' => [Calculator::class],
            'Productfinder' => [Productfinder::class],
        ];
    }

    /**
     * @param class-string<Calculator|Productfinder> $className
     */
    #[Test]
    #[DataProvider('modelClassDataProvider')]
    public function isAnExtbaseEntity(string $className): void
    {
        self::assertInstanceOf(AbstractEntity::class, new $className());
    }

    /**
     * @param class-string<Calculator|Productfinder> $className
     */
    #[Test]
    #[DataProvider('modelClassDataProvider')]
    public function customeridIsEmptyStringByDefault(string $className): void
    {
        self::assertSame('', (new $className())->getCustomerid());
    }

    /**
     * @param class-string<Calculator|Productfinder> $className
     */
    #[Test]
    #[DataProvider('modelClassDataProvider')]
    public function setCustomeridSetsCustomerid(string $className): void
    {
        $subject = new $className();
        $subject->setCustomerid('12345');

        self::assertSame('12345', $subject->getCustomerid());
    }
}
