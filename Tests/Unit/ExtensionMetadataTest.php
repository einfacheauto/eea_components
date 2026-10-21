<?php

declare(strict_types=1);

namespace Eea\Eeacomponents\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Guards the consistency of the version and dependency information spread across
 * composer.json, ext_emconf.php and the release-please configuration.
 */
final class ExtensionMetadataTest extends UnitTestCase
{
    private const EXTENSION_ROOT = __DIR__ . '/../../';

    #[Test]
    public function extEmconfVersionMatchesReleasePleaseManifest(): void
    {
        $manifest = $this->readJson('.release-please-manifest.json');

        self::assertSame($manifest['.'], $this->readExtEmconf()['version']);
    }

    #[Test]
    public function extEmconfVersionIsMarkedForReleasePlease(): void
    {
        self::assertMatchesRegularExpression(
            '/\'version\' => \'\d+\.\d+\.\d+\', \/\/ x-release-please-version/',
            (string)file_get_contents(self::EXTENSION_ROOT . 'ext_emconf.php')
        );
    }

    #[Test]
    public function composerJsonHasNoVersionField(): void
    {
        // Packagist takes the version from the git tag; a version field would only drift apart
        self::assertArrayNotHasKey('version', $this->readJson('composer.json'));
    }

    #[Test]
    public function extensionMajorVersionMatchesSupportedTypo3MajorVersion(): void
    {
        $emconf = $this->readExtEmconf();
        $extensionMajor = (int)explode('.', $emconf['version'])[0];
        [$typo3Min, $typo3Max] = explode('-', $emconf['constraints']['depends']['typo3']);

        self::assertSame($extensionMajor, (int)explode('.', $typo3Min)[0]);
        self::assertSame($extensionMajor, (int)explode('.', $typo3Max)[0]);
    }

    #[Test]
    public function typo3ConstraintsInComposerJsonAndExtEmconfMatch(): void
    {
        $require = $this->readJson('composer.json')['require'];
        [$typo3Min] = explode('-', $this->readExtEmconf()['constraints']['depends']['typo3']);
        $expectedComposerConstraint = '^' . implode('.', array_slice(explode('.', $typo3Min), 0, 2));

        foreach ($require as $package => $constraint) {
            if (str_starts_with($package, 'typo3/cms-')) {
                self::assertSame($expectedComposerConstraint, $constraint, $package);
            }
        }
    }

    #[Test]
    public function phpConstraintsInComposerJsonAndExtEmconfMatch(): void
    {
        [$phpMin] = explode('-', $this->readExtEmconf()['constraints']['depends']['php']);
        $expectedComposerConstraint = '^' . implode('.', array_slice(explode('.', $phpMin), 0, 2));

        self::assertSame($expectedComposerConstraint, $this->readJson('composer.json')['require']['php']);
    }

    #[Test]
    public function extensionKeyIsConsistent(): void
    {
        $composer = $this->readJson('composer.json');

        self::assertSame('eeacomponents', $composer['extra']['typo3/cms']['extension-key']);
        self::assertSame('eea/eeacomponents', $composer['name']);
    }

    /**
     * @return array<string, array{string}>
     */
    public static function xliffFileDataProvider(): array
    {
        $files = glob(self::EXTENSION_ROOT . 'Resources/Private/Language/*.xlf') ?: [];
        $data = [];
        foreach ($files as $file) {
            $data[basename($file)] = [$file];
        }
        return $data;
    }

    #[Test]
    #[DataProvider('xliffFileDataProvider')]
    public function xliffFileIsValidXmlAndReferencesCurrentExtensionKey(string $file): void
    {
        $xml = simplexml_load_file($file);

        self::assertNotFalse($xml, 'Invalid XML in ' . $file);
        self::assertDoesNotMatchRegularExpression('/EXT:eea_components|product-name="eea_components/', (string)file_get_contents($file));
    }

    /**
     * @return array<string, mixed>
     */
    private function readJson(string $file): array
    {
        return json_decode((string)file_get_contents(self::EXTENSION_ROOT . $file), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @return array{version: string, constraints: array{depends: array{typo3: string, php: string}}}
     */
    private function readExtEmconf(): array
    {
        $_EXTKEY = 'eeacomponents';
        /** @var array<string, array{version: string, constraints: array{depends: array{typo3: string, php: string}}}> $EM_CONF populated by the included file */
        $EM_CONF = [];
        include self::EXTENSION_ROOT . 'ext_emconf.php';
        return $EM_CONF[$_EXTKEY];
    }
}
