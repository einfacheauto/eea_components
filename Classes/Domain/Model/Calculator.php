<?php

declare(strict_types=1);

namespace Eea\EeaComponents12\Domain\Model;


/**
 * This file is part of the "EEA Components" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2024 Tashko Valkov <softtechwebseo@gmail.com>, Einfacheauto
 */

/**
 * Calculator
 */
class Calculator extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * customerid
     *
     * @var string
     */
    protected $customerid = null;

    /**
     * Returns the customerid
     *
     * @return string
     */
    public function getCustomerid()
    {
        return $this->customerid;
    }

    /**
     * Sets the customerid
     *
     * @param string $customerid
     * @return void
     */
    public function setCustomerid(string $customerid)
    {
        $this->customerid = $customerid;
    }
}
