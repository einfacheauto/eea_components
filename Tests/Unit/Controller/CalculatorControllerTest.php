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
class CalculatorControllerTest extends UnitTestCase
{
    /**
     * @var \Eea\EeaComponents\Controller\CalculatorController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\Eea\EeaComponents\Controller\CalculatorController::class))
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
    public function listActionFetchesAllCalculatorsFromRepositoryAndAssignsThemToView(): void
    {
        $allCalculators = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $calculatorRepository = $this->getMockBuilder(\Eea\EeaComponents\Domain\Repository\CalculatorRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $calculatorRepository->expects(self::once())->method('findAll')->will(self::returnValue($allCalculators));
        $this->subject->_set('calculatorRepository', $calculatorRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('calculators', $allCalculators);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenCalculatorToView(): void
    {
        $calculator = new \Eea\EeaComponents\Domain\Model\Calculator();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('calculator', $calculator);

        $this->subject->showAction($calculator);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenCalculatorToCalculatorRepository(): void
    {
        $calculator = new \Eea\EeaComponents\Domain\Model\Calculator();

        $calculatorRepository = $this->getMockBuilder(\Eea\EeaComponents\Domain\Repository\CalculatorRepository::class)
            ->onlyMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $calculatorRepository->expects(self::once())->method('add')->with($calculator);
        $this->subject->_set('calculatorRepository', $calculatorRepository);

        $this->subject->createAction($calculator);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenCalculatorToView(): void
    {
        $calculator = new \Eea\EeaComponents\Domain\Model\Calculator();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('calculator', $calculator);

        $this->subject->editAction($calculator);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenCalculatorInCalculatorRepository(): void
    {
        $calculator = new \Eea\EeaComponents\Domain\Model\Calculator();

        $calculatorRepository = $this->getMockBuilder(\Eea\EeaComponents\Domain\Repository\CalculatorRepository::class)
            ->onlyMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $calculatorRepository->expects(self::once())->method('update')->with($calculator);
        $this->subject->_set('calculatorRepository', $calculatorRepository);

        $this->subject->updateAction($calculator);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenCalculatorFromCalculatorRepository(): void
    {
        $calculator = new \Eea\EeaComponents\Domain\Model\Calculator();

        $calculatorRepository = $this->getMockBuilder(\Eea\EeaComponents\Domain\Repository\CalculatorRepository::class)
            ->onlyMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $calculatorRepository->expects(self::once())->method('remove')->with($calculator);
        $this->subject->_set('calculatorRepository', $calculatorRepository);

        $this->subject->deleteAction($calculator);
    }
}
