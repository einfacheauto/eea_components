# Integration der Einfach E-Auto Komponenten in TYPO3 13

In dieser Anleitung zeigen wir Ihnen, wie Sie die Komponenten von Einfach E-Auto
in eine TYPO3-Website integrieren. Die Komponenten werden über die TYPO3-Erweiterung
„EEA Components“ eingebunden.

## Voraussetzungen

Damit die Einfach E-Auto-Erweiterung bei Ihnen installiert werden kann, benötigen Sie Folgendes:

1. Eine Installation von TYPO3 13.4 LTS, die mit Composer verwaltet wird.
2. PHP 8.2 oder neuer.
3. Administrator-Rechte für das Backend von TYPO3.
4. Ihren individuellen Partnercode (Kundennummer).

### Welche Version passt zu meiner TYPO3-Installation?

Die Hauptversion der Erweiterung entspricht der unterstützten TYPO3-Version.

| Erweiterung | TYPO3    | Support bis |
|-------------|----------|-------------|
| 13.1 und neuer | 13.4 LTS | 31.12.2027 |
| 12.x        | 12.4 LTS | 30.04.2027  |
| 11.x        | 11.5 LTS | 31.12.2025  |

_Hinweis: Version 13.0.0 unterstützt ausschließlich TYPO3 12.4. Für TYPO3 13 verwenden Sie bitte
Version 13.1.0 oder neuer. Für TYPO3 12 und 11 erscheinen keine neuen Versionen mehr._

## Schritt 1: TYPO3-Erweiterung installieren

Die Erweiterung ist auf [Packagist](https://packagist.org/packages/eea/eeacomponents) veröffentlicht
und wird mit Composer installiert. Ein Download der Erweiterung oder ein eigenes Verzeichnis
für benutzerdefinierte Erweiterungen ist nicht mehr nötig.

Führen Sie im Stammverzeichnis Ihres TYPO3-Projekts (dort, wo die `composer.json` liegt) folgenden Befehl aus:

```shell
composer require eea/eeacomponents:^13.1
```

Richten Sie die Erweiterung anschließend ein. Dabei werden unter anderem die benötigten
Datenbanktabellen angelegt:

```shell
vendor/bin/typo3 extension:setup --extension=eeacomponents
```

Die Erweiterung erscheint nun unter **Verwaltungswerkzeuge > Erweiterungen** als
„EEA Components“ mit dem Schlüssel `eeacomponents`:

<img src="https://media.einfacheauto.de/plugins/documentation/images/TYPO3v13-Erweiterungen.png" width="600"></br></br>

#### Hinweis:
Über Composer installierte Erweiterungen sind automatisch aktiv. Eine Installation über den
Erweiterungsmanager ohne Composer wird nicht unterstützt. Falls Sie TYPO3 ohne Composer betreiben,
wenden Sie sich bitte an **it@einfacheauto.de** oder Ihren Partnermanager.

## Schritt 2: Erweiterung konfigurieren

Die Erweiterung muss erstmalig konfiguriert werden. Falls Sie Ihre individuellen Zugangsdaten
noch nicht erhalten haben, wenden Sie sich bitte an **it@einfacheauto.de** oder Ihren Partnermanager.

Die Erweiterung wird über TypoScript-Konstanten konfiguriert. Diese müssen für jede Root-Seite
Ihrer Website eingerichtet werden.

* Loggen Sie sich dazu als Administrator in das TYPO3-Backend ein.

### Vorbereitung: TypoScript der Erweiterung einbinden

* Öffnen Sie **Seitenverwaltung > TypoScript** und wählen Sie im Seitenbaum Ihre Root-Seite (hier: Home).
* Wählen Sie oben im Auswahlmenü **TypoScript Datensatz bearbeiten** und klicken Sie auf
  **Den gesamten TypoScript Datensatz bearbeiten**.

<img src="https://media.einfacheauto.de/plugins/documentation/images/TYPO3v13-TypoScript-Uebersicht.png" width="600"></br></br>

* Wechseln Sie zum Reiter **Erweiterte Optionen**. Im Abschnitt **TypoScript-Dateien einbinden**
  muss der Eintrag `EEA Components (eeacomponents)` unter **Ausgewählte Objekte** stehen.
  Falls er noch unter **Verfügbare Objekte** aufgeführt ist, klicken Sie ihn an, um ihn zu übernehmen.
  Speichern Sie anschließend.

<img src="https://media.einfacheauto.de/plugins/documentation/images/TYPO3v13-TypoScript-einbinden.png" width="600"></br></br>

### Eingeben der Kundennummer

* Öffnen Sie **Seitenverwaltung > TypoScript**, wählen Sie im Seitenbaum Ihre Root-Seite und
  oben im Auswahlmenü **Konstanten-Editor**.
* Wählen Sie unter **Ausgewählte Kategorie** nacheinander die Kategorien der beiden Komponenten:
  * `plugin.tx_eeacomponents_calculator` für den Rechner
  * `plugin.tx_eeacomponents_productfinder` für den Produktfinder
* Tragen Sie im Abschnitt **Other** in das Feld **Kundennummer**
  (`plugin.tx_eeacomponents_[Name der Komponente].components.customeridnum`) Ihre Kundennummer ein.
  Klicken Sie dazu auf das Stift-Symbol neben dem Feld. Speichern Sie anschließend.

<img src="https://media.einfacheauto.de/plugins/documentation/images/TYPO3v13-Konstanten-Rechner.png" width="600"></br></br>

* Wiederholen Sie diesen Vorgang für alle Root-Seiten.

Die übrigen Felder sind bereits passend vorbelegt und müssen nicht geändert werden.

#### Alternative: Konstanten direkt eintragen
Statt über den Konstanten-Editor können Sie die Werte auch direkt in das Feld **Konstanten**
des TypoScript-Datensatzes Ihrer Root-Seite schreiben:

```
plugin.tx_eeacomponents_calculator.components.customeridnum = IHRE-KUNDENNUMMER
plugin.tx_eeacomponents_productfinder.components.customeridnum = IHRE-KUNDENNUMMER
```

### Optional: Anzeigen der Staging-Umgebung
_Hinweis: Das Anzeigen der Staging-Komponenten sollte niemals in Ihrer Produktionsumgebung
durchgeführt werden. Komponenten in der Staging-Umgebung können sich jederzeit ohne Voranmeldung
ändern oder aufhören zu funktionieren._

* Fragen Sie bei Ihrem zuständigen Partnermanager die Einfach E-Auto Staging-URI an.
* Wählen Sie im Konstanten-Editor die Kategorie der Komponente, die Sie in der Staging-Umgebung
  sehen möchten, und tragen Sie in das Feld **Linker Teil der URL – vor der Kunden-ID**
  (`plugin.tx_eeacomponents_[Name der Komponente].components.sourcescript`) die Staging-URI ein,
  zum Beispiel `https://media.einfacheauto.de/partners/staging` (ohne Schrägstrich am Ende).
* Speichern Sie anschließend.

<img src="https://media.einfacheauto.de/plugins/documentation/images/TYPO3v13-Konstanten-Staging.png" width="600"></br></br>

* Wiederholen Sie diesen Vorgang für alle Root-Seiten und Komponenten.

Um wieder die Produktionsumgebung zu verwenden, setzen Sie das Feld über das Pfeil-Symbol
neben dem Feld auf den Standardwert `https://media.einfacheauto.de/partners/production` zurück.

## Schritt 3: Freischalten der Domains

Um die Komponenten freischalten zu lassen, senden Sie bitte eine **E-Mail an Ihren Partnermanager
oder it@einfacheauto.de** mit der/den jeweiligen **Domains, auf denen die Erweiterung eingebunden** werden soll.

## Schritt 4: Einbinden der Komponenten

Die Einfach E-Auto Komponenten können nun überall auf Ihren Seiten eingebunden werden.

* Öffnen Sie **Web > Seite** und wählen Sie die gewünschte Seite.
* Klicken Sie an der gewünschten Stelle auf die Schaltfläche **Neuen Inhalt erstellen** (Plus-Symbol).
* Wählen Sie im Fenster **Neuer Seiteninhalt** den Reiter **Plugins** und dort
  **EEA Calculator** oder **EEA Product Finder**. Alternativ finden Sie die Komponenten
  über das Suchfeld oben im Fenster.
* Speichern Sie das neue Inhaltselement.

<img src="https://media.einfacheauto.de/plugins/documentation/images/TYPO3v13-Plugin-einfuegen.png" width="600"></br></br>

Anschließend können Sie das Element, wenn nötig, per Drag-and-Drop an die gewünschte Stelle ziehen.

Fertig!
Rufen Sie die Seite im Frontend auf. Die Komponente sollte nun angezeigt werden.

## Hinweise

* Rechner und Produktfinder können gemeinsam auf derselben Seite eingebunden werden.
* Werden die Komponenten im Frontend nicht angezeigt, prüfen Sie bitte, ob die Kundennummer
  korrekt eingetragen und Ihre Domain freigeschaltet ist (Schritt 3).

Wir hoffen, dass Ihnen diese Anleitung geholfen hat. Wenn Sie weitere Fragen haben oder Hilfe
benötigen, stehen wir gerne zur Verfügung.

## Update der Erweiterung

Um neue Funktionen bereitzustellen oder Sicherheitsupdates umzusetzen, aktualisieren wir die
TYPO3-Erweiterung in unregelmäßigen Abständen. Um den neuesten Stand zu installieren,
gehen Sie bitte wie folgt vor:

1. **Backup erstellen:**
   Erstellen Sie eine Sicherung Ihrer gesamten TYPO3-Installation und der Datenbank.

2. **Installierte Version prüfen:**
   ```shell
   composer show eea/eeacomponents
   ```

3. **Erweiterung aktualisieren:**
   ```shell
   composer update eea/eeacomponents
   ```
   Composer installiert dabei die neueste Version, die zu Ihrer TYPO3-Version passt.

4. **Datenbank und Erweiterung einrichten:**
   ```shell
   vendor/bin/typo3 extension:setup --extension=eeacomponents
   ```

5. **Caches leeren:**
   ```shell
   vendor/bin/typo3 cache:flush
   ```
   Alternativ im Backend unter **Verwaltungswerkzeuge > Wartung**, Bereich „Flush TYPO3 and PHP Cache“, Schaltfläche **Flush cache**.

6. **Update prüfen:**
   ```shell
   composer show eea/eeacomponents
   ```

### Upgrade von Version 12.x oder 13.0.0

Ab Version 13.1 sind Rechner und Produktfinder eigene Inhaltselemente und nicht mehr Teil des
„Allgemeinen Plug-Ins“. Wenn Sie von TYPO3 12 bzw. von Version 12.x oder 13.0.0 der Erweiterung kommen,
führen Sie nach dem Update von TYPO3 und der Erweiterung bitte zusätzlich den Upgrade-Wizard aus.
Er stellt bereits eingebundene Komponenten automatisch um:

```shell
vendor/bin/typo3 upgrade:run eeacomponentsPluginListTypeToCTypeUpdate
```

Alternativ im Backend unter **Verwaltungswerkzeuge > Aktualisierung**, Bereich „Upgrade Wizard“,
Schaltfläche **Run Upgrade Wizard…**, den Eintrag „EEA Components: Migrate plugins to content elements“ ausführen.

Ohne diesen Schritt werden bestehende Komponenten nach dem Update im Frontend nicht mehr angezeigt.

## Entwicklung

Voraussetzungen: PHP 8.2+ (mit `intl`, `mbstring`, `pdo_sqlite`) und Composer.

```shell
composer install
composer ci                                          # alle Prüfungen wie in der CI
composer ci:php:stan                                 # PHPStan (Level 8)
composer ci:tests:unit                               # Unit-Tests
typo3DatabaseDriver=pdo_sqlite composer ci:tests:functional   # Funktionstests mit SQLite
```

Die GitHub-Actions-CI (`.github/workflows/ci.yml`) führt Lint, PHPStan, Unit- und Funktionstests
für PHP 8.2 – 8.4 aus, die Funktionstests zusätzlich gegen MariaDB, MySQL und PostgreSQL.

Releases erstellt release-please automatisch aus [Conventional Commits](https://www.conventionalcommits.org/).
Die Hauptversion entspricht der TYPO3-Version und wird nur bewusst per `Release-As: x.y.z` im Commit angehoben.
