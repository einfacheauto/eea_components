<?php

declare(strict_types=1);

namespace Eea\Eeacomponents\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Tashko Valkov <softtechwebseo@gmail.com>
 */
class ProductfinderTest extends UnitTestCase
{
    /**
     * @var \Eea\Eeacomponents\Domain\Model\Productfinder|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Eea\Eeacomponents\Domain\Model\Productfinder::class,
            ['dummy']
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getCustomeridReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getCustomerid()
        );
    }

    /**
     * @test
     */
    public function setCustomeridForStringSetsCustomerid(): void
    {
        $this->subject->setCustomerid('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('customerid'));
    }
}
