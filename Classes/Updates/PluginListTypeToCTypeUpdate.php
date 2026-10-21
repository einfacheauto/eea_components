<?php

declare(strict_types=1);

namespace Eea\Eeacomponents\Updates;

use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\AbstractListTypeToCTypeUpdate;

/**
 * Migrates existing plugin content elements from list_type to CType (TYPO3 v13.4+)
 */
#[UpgradeWizard('eeacomponentsPluginListTypeToCTypeUpdate')]
final class PluginListTypeToCTypeUpdate extends AbstractListTypeToCTypeUpdate
{
    protected function getListTypeToCTypeMapping(): array
    {
        return [
            'eeacomponents_calculator' => 'eeacomponents_calculator',
            'eeacomponents_productfinder' => 'eeacomponents_productfinder',
        ];
    }

    public function getTitle(): string
    {
        return 'EEA Components: Migrate plugins to content elements';
    }

    public function getDescription(): string
    {
        return 'Migrates the "Calculator" and "Product Finder" plugins from list_type to their own CType.';
    }
}
