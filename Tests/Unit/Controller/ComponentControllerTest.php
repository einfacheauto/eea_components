<?php

declare(strict_types=1);

namespace Eea\Eeacomponents\Tests\Unit\Controller;

use Eea\Eeacomponents\Controller\CalculatorController;
use Eea\Eeacomponents\Controller\ProductfinderController;
use Eea\Eeacomponents\Domain\Model\Calculator;
use Eea\Eeacomponents\Domain\Model\Productfinder;
use Eea\Eeacomponents\Domain\Repository\CalculatorRepository;
use Eea\Eeacomponents\Domain\Repository\ProductfinderRepository;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Core\Http\ResponseFactory;
use TYPO3\CMS\Core\Http\StreamFactory;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Core\View\ViewInterface;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Both plugin controllers share the same behaviour, so every test runs against each of them.
 */
final class ComponentControllerTest extends UnitTestCase
{
    /**
     * @return array<string, array{class-string<CalculatorController|ProductfinderController>, class-string<CalculatorRepository|ProductfinderRepository>, class-string<Calculator|Productfinder>, string}>
     */
    public static function controllerDataProvider(): array
    {
        return [
            'Calculator' => [CalculatorController::class, CalculatorRepository::class, Calculator::class, 'calculator'],
            'Productfinder' => [ProductfinderController::class, ProductfinderRepository::class, Productfinder::class, 'productfinder'],
        ];
    }

    /**
     * @param class-string<ActionController> $controllerClass
     * @param class-string<CalculatorRepository|ProductfinderRepository> $repositoryClass
     * @param class-string<Calculator|Productfinder> $modelClass
     */
    #[Test]
    #[DataProvider('controllerDataProvider')]
    public function listActionAssignsComponentSettingsToView(string $controllerClass, string $repositoryClass, string $modelClass, string $name): void
    {
        $subject = $this->createController($controllerClass);
        $this->setProperty($subject, 'settings', [
            'customeridnum' => '12345',
            'sourcescript' => 'https://media.einfacheauto.de/partners/production',
            'mjsfile' => 'component.mjs',
        ]);
        $view = $this->createMock(ViewInterface::class);
        $view->expects(self::once())->method('assignMultiple')->with([
            'customeridnum' => '12345',
            'sourcescript' => 'https://media.einfacheauto.de/partners/production',
            'mjsfile' => 'component.mjs',
        ]);
        $view->method('render')->willReturn('<rendered/>');
        $this->setProperty($subject, 'view', $view);

        $response = $this->callAction($subject, 'listAction');

        self::assertSame(200, $response->getStatusCode());
        self::assertSame('text/html; charset=utf-8', $response->getHeaderLine('Content-Type'));
        self::assertSame('<rendered/>', (string)$response->getBody());
    }

    /**
     * @param class-string<ActionController> $controllerClass
     * @param class-string<CalculatorRepository|ProductfinderRepository> $repositoryClass
     * @param class-string<Calculator|Productfinder> $modelClass
     */
    #[Test]
    #[DataProvider('controllerDataProvider')]
    public function indexAndNewActionRenderView(string $controllerClass, string $repositoryClass, string $modelClass, string $name): void
    {
        $subject = $this->createController($controllerClass);
        $view = $this->createMock(ViewInterface::class);
        $view->expects(self::exactly(2))->method('render')->willReturn('<rendered/>');
        $this->setProperty($subject, 'view', $view);

        self::assertSame('<rendered/>', (string)$this->callAction($subject, 'indexAction')->getBody());
        self::assertSame('<rendered/>', (string)$this->callAction($subject, 'newAction')->getBody());
    }

    /**
     * @param class-string<ActionController> $controllerClass
     * @param class-string<CalculatorRepository|ProductfinderRepository> $repositoryClass
     * @param class-string<Calculator|Productfinder> $modelClass
     */
    #[Test]
    #[DataProvider('controllerDataProvider')]
    public function showAndEditActionAssignModelToView(string $controllerClass, string $repositoryClass, string $modelClass, string $name): void
    {
        $model = new $modelClass();
        $subject = $this->createController($controllerClass);
        $view = $this->createMock(ViewInterface::class);
        $view->expects(self::exactly(2))->method('assign')->with($name, $model);
        $view->method('render')->willReturn('<rendered/>');
        $this->setProperty($subject, 'view', $view);

        self::assertSame(200, $this->callAction($subject, 'showAction', $model)->getStatusCode());
        self::assertSame(200, $this->callAction($subject, 'editAction', $model)->getStatusCode());
    }

    /**
     * @return array<string, array{class-string<CalculatorController|ProductfinderController>, class-string<CalculatorRepository|ProductfinderRepository>, class-string<Calculator|Productfinder>, string, string}>
     */
    public static function persistingActionDataProvider(): array
    {
        $data = [];
        foreach (self::controllerDataProvider() as $label => $arguments) {
            $data[$label . ' create'] = [...$arguments, 'createAction', 'add'];
            $data[$label . ' update'] = [...$arguments, 'updateAction', 'update'];
            $data[$label . ' delete'] = [...$arguments, 'deleteAction', 'remove'];
        }
        return $data;
    }

    /**
     * @param class-string<ActionController> $controllerClass
     * @param class-string<CalculatorRepository|ProductfinderRepository> $repositoryClass
     * @param class-string<Calculator|Productfinder> $modelClass
     */
    #[Test]
    #[DataProvider('persistingActionDataProvider')]
    public function persistingActionsUseRepositoryAndReturnRedirectToList(
        string $controllerClass,
        string $repositoryClass,
        string $modelClass,
        string $name,
        string $action,
        string $repositoryMethod
    ): void {
        $model = new $modelClass();
        $redirect = new RedirectResponse('https://example.com/list');

        $subject = $this->getMockBuilder($controllerClass)
            ->onlyMethods(['redirect', 'addFlashMessage'])
            ->getMock();
        $subject->expects(self::once())->method('addFlashMessage')
            ->with(self::isType('string'), '', ContextualFeedbackSeverity::WARNING);
        $subject->expects(self::once())->method('redirect')->with('list')->willReturn($redirect);

        $repository = $this->createMock($repositoryClass);
        $repository->expects(self::once())->method($repositoryMethod)->with($model);
        $injectMethod = 'inject' . ucfirst($name) . 'Repository';
        $subject->$injectMethod($repository);

        self::assertSame($redirect, $this->callAction($subject, $action, $model));
    }

    /**
     * @param class-string<ActionController> $controllerClass
     * @param class-string<CalculatorRepository|ProductfinderRepository> $repositoryClass
     * @param class-string<Calculator|Productfinder> $modelClass
     */
    #[Test]
    #[DataProvider('controllerDataProvider')]
    public function editActionIgnoresValidationOfModelArgument(string $controllerClass, string $repositoryClass, string $modelClass, string $name): void
    {
        $attributes = (new \ReflectionMethod($controllerClass, 'editAction'))->getAttributes(IgnoreValidation::class);

        self::assertCount(1, $attributes);
        self::assertSame($name, $attributes[0]->newInstance()->argumentName);
    }

    /**
     * @param class-string<ActionController> $controllerClass
     */
    private function createController(string $controllerClass): ActionController
    {
        $subject = new $controllerClass();
        $subject->injectResponseFactory(new ResponseFactory());
        $subject->injectStreamFactory(new StreamFactory());
        return $subject;
    }

    private function setProperty(object $subject, string $property, mixed $value): void
    {
        (new \ReflectionProperty(ActionController::class, $property))->setValue($subject, $value);
    }

    private function callAction(ActionController|MockObject $subject, string $action, mixed ...$arguments): ResponseInterface
    {
        $response = $subject->$action(...$arguments);
        self::assertInstanceOf(ResponseInterface::class, $response);
        return $response;
    }
}
