<?php

declare(strict_types=1);

namespace Eea\Eeacomponents\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;


/**
 * This file is part of the "EEA Components" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2024 Tashko Valkov <softtechwebseo@gmail.com>, Einfacheauto
 */

/**
 * CalculatorController
 */
class CalculatorController extends ActionController
{

    /**
     * calculatorRepository
     *
     * @var \Eea\Eeacomponents\Domain\Repository\CalculatorRepository
     */
    protected $calculatorRepository = null;

    /**
     * @param \Eea\Eeacomponents\Domain\Repository\CalculatorRepository $calculatorRepository
     */
    public function injectCalculatorRepository(\Eea\Eeacomponents\Domain\Repository\CalculatorRepository $calculatorRepository)
    {
        $this->calculatorRepository = $calculatorRepository;
    }

    /**
     * action index
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function indexAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        //$calculators = $this->calculatorRepository->findAll();
        //$backendConfig = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('eea_components');

        $this->view->assignMultiple([
            //'calculators' => $calculators,
            'customeridnum' => $this->settings['customeridnum'],
            'sourcescript' => $this->settings['sourcescript'],
            'mjsfile' => $this->settings['mjsfile'],
        ]);

        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \Eea\Eeacomponents\Domain\Model\Calculator $calculator
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\Eea\Eeacomponents\Domain\Model\Calculator $calculator): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('calculator', $calculator);
        return $this->htmlResponse();
    }

    /**
     * action new
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function newAction(): \Psr\Http\Message\ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @param \Eea\Eeacomponents\Domain\Model\Calculator $newCalculator
     */
    public function createAction(\Eea\Eeacomponents\Domain\Model\Calculator $newCalculator)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->calculatorRepository->add($newCalculator);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Eea\Eeacomponents\Domain\Model\Calculator $calculator
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("calculator")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\Eea\Eeacomponents\Domain\Model\Calculator $calculator): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('calculator', $calculator);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \Eea\Eeacomponents\Domain\Model\Calculator $calculator
     */
    public function updateAction(\Eea\Eeacomponents\Domain\Model\Calculator $calculator)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->calculatorRepository->update($calculator);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Eea\Eeacomponents\Domain\Model\Calculator $calculator
     */
    public function deleteAction(\Eea\Eeacomponents\Domain\Model\Calculator $calculator)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->calculatorRepository->remove($calculator);
        $this->redirect('list');
    }
}
