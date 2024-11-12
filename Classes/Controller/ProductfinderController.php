<?php

declare(strict_types=1);

namespace Eea\EeaComponents\Controller;

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
 * ProductfinderController
 */
class ProductfinderController extends ActionController
{

    /**
     * productfinderRepository
     *
     * @var \Eea\EeaComponents\Domain\Repository\ProductfinderRepository
     */
    protected $productfinderRepository = null;

    /**
     * @param \Eea\EeaComponents\Domain\Repository\ProductfinderRepository $productfinderRepository
     */
    public function injectProductfinderRepository(\Eea\EeaComponents\Domain\Repository\ProductfinderRepository $productfinderRepository)
    {
        $this->productfinderRepository = $productfinderRepository;
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
        //$productfinders = $this->productfinderRepository->findAll();
        //$backendConfig = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('eea_components');

        $this->view->assignMultiple([
            //'productfinders' => $productfinders,
            'customeridnum' => $this->settings['customeridnum'],
            'sourcescript' => $this->settings['sourcescript'],
            'mjsfile' => $this->settings['mjsfile'],
        ]);

        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \Eea\EeaComponents\Domain\Model\Productfinder $productfinder
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\Eea\EeaComponents\Domain\Model\Productfinder $productfinder): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('productfinder', $productfinder);
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
     * @param \Eea\EeaComponents\Domain\Model\Productfinder $newProductfinder
     */
    public function createAction(\Eea\EeaComponents\Domain\Model\Productfinder $newProductfinder)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productfinderRepository->add($newProductfinder);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Eea\EeaComponents\Domain\Model\Productfinder $productfinder
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("productfinder")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editAction(\Eea\EeaComponents\Domain\Model\Productfinder $productfinder): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('productfinder', $productfinder);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @param \Eea\EeaComponents\Domain\Model\Productfinder $productfinder
     */
    public function updateAction(\Eea\EeaComponents\Domain\Model\Productfinder $productfinder)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productfinderRepository->update($productfinder);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Eea\EeaComponents\Domain\Model\Productfinder $productfinder
     */
    public function deleteAction(\Eea\EeaComponents\Domain\Model\Productfinder $productfinder)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/p/friendsoftypo3/extension-builder/master/en-us/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->productfinderRepository->remove($productfinder);
        $this->redirect('list');
    }
}