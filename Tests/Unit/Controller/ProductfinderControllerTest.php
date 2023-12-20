<?php

declare(strict_types=1);

namespace Eea\EeaComponents\Tests\Unit\Controller;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Test case
 *
 * @author Tashko Valkov <softtechwebseo@gmail.com>
 */
class ProductfinderControllerTest extends UnitTestCase
{
    /**
     * @var \Eea\EeaComponents\Controller\ProductfinderController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Eea\EeaComponents\Controller\ProductfinderController::class))
            ->onlyMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllProductfindersFromRepositoryAndAssignsThemToView(): void
    {
        $allProductfinders = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $productfinderRepository = $this->getMockBuilder(\Eea\EeaComponents\Domain\Repository\ProductfinderRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $productfinderRepository->expects(self::once())->method('findAll')->will(self::returnValue($allProductfinders));
        $this->subject->_set('productfinderRepository', $productfinderRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('productfinders', $allProductfinders);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenProductfinderToView(): void
    {
        $productfinder = new \Eea\EeaComponents\Domain\Model\Productfinder();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('productfinder', $productfinder);

        $this->subject->showAction($productfinder);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenProductfinderToProductfinderRepository(): void
    {
        $productfinder = new \Eea\EeaComponents\Domain\Model\Productfinder();

        $productfinderRepository = $this->getMockBuilder(\Eea\EeaComponents\Domain\Repository\ProductfinderRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $productfinderRepository->expects(self::once())->method('add')->with($productfinder);
        $this->subject->_set('productfinderRepository', $productfinderRepository);

        $this->subject->createAction($productfinder);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenProductfinderToView(): void
    {
        $productfinder = new \Eea\EeaComponents\Domain\Model\Productfinder();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('productfinder', $productfinder);

        $this->subject->editAction($productfinder);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenProductfinderInProductfinderRepository(): void
    {
        $productfinder = new \Eea\EeaComponents\Domain\Model\Productfinder();

        $productfinderRepository = $this->getMockBuilder(\Eea\EeaComponents\Domain\Repository\ProductfinderRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $productfinderRepository->expects(self::once())->method('update')->with($productfinder);
        $this->subject->_set('productfinderRepository', $productfinderRepository);

        $this->subject->updateAction($productfinder);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenProductfinderFromProductfinderRepository(): void
    {
        $productfinder = new \Eea\EeaComponents\Domain\Model\Productfinder();

        $productfinderRepository = $this->getMockBuilder(\Eea\EeaComponents\Domain\Repository\ProductfinderRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $productfinderRepository->expects(self::once())->method('remove')->with($productfinder);
        $this->subject->_set('productfinderRepository', $productfinderRepository);

        $this->subject->deleteAction($productfinder);
    }
}
