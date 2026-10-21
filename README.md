# Integration der Einfach E-Auto Komponenten in TYPO3

In dieser Anleitung zeigen wir Ihnen, wie Sie die Komponenten von Einfach E-Auto
in eine TYPO3 Website integrieren können. Diese werden über eine TYPO3-Erweiterung eingebunden.

## Voraussetzungen

Damit die Einfach E-Auto-TYPO3-Erweiterung bei Ihnen installiert werden kann, benötigen Sie Folgendes:

1. Eine Installation von TYPO3 13.4 LTS (für ältere TYPO3-Versionen siehe [Kompatibilität](#kompatibilität)).
2. Administrator-Rechte für das Backend von TYPO3.
3. Die Quelldatei der Erweiterung.
4. Ihren individuellen Partnercode.

## Kompatibilität

Die Hauptversion der Erweiterung entspricht der unterstützten TYPO3-Version.

| Erweiterung | TYPO3    | Branch   | Support bis |
|-------------|----------|----------|-------------|
| 13.1+       | 13.4 LTS | `master` | 31.12.2027  |
| 12.x        | 12.4 LTS | `v12`    | 30.04.2027  |
| 11.x        | 11.5 LTS | `v11`    | 31.12.2025  |

_Hinweis: Version 13.0.0 unterstützt ausschließlich TYPO3 12.4. Für TYPO3 13 verwenden Sie bitte Version 13.1.0 oder neuer._

Für TYPO3 12 und 11 erscheinen keine neuen Versionen mehr.

## Schritt 1: TYPO3 Erweiterung installieren

Um die benutzerdefinierte Einfach E-Auto-Erweiterung in TYPO3 zu installieren, sollten Sie Composer verwenden.


```shell
composer require eea/eeacomponents
```

#### Hinweis:
Ab TYPO3 v11.5 werden alle über Composer installierten Erweiterungen automatisch aktiviert, wenn sie installiert sind. 



## Schritt 2: Erweiterung konfigurieren
Die Erweiterung muss erstmalig konfiguriert werden. Falls Sie Ihre individuellen Zugangsdaten noch nicht erhalten haben, 
wenden Sie sich bitte an **it@einfacheauto.de** oder Ihren Partnermanager.

#### Einstellung der Erweiterungen
Die Erweiterung wird über Template-Konstanten konfiguriert. Deshalb müssen Sie sicherstellen, dass diese für die 
jeweiligen Root-Seiten konfiguriert sind.  

* Loggen Sie sich dazu als Administrator in das TYPO3-Backend ein. 

##### Vorbereitung: Template-Konstanten für die Erweiterung aktivieren
* Navigieren Sie sich zum TypoScript Reiter (Site Management > TypoScript und wählen Sie dann die Root-Seite (hier: Congratulations) im Dropdown Menü "TypoScript Datensatz bearbeiten") 
und klicken dort auf "Den gesamten TypoScript Datensatz bearbeiten".

<img src="https://media.einfacheauto.de/plugins/documentation/images/TYPO3v12SettingsConfigureExtensions.png" width="600"></br></br>
* Aktivieren Sie dort unter dem Reiter "Erweiterte Optionen" unter dem Punkt "TypoScript-Dateien einbinden" 
die Konstanten für die Erweiterung. Falls die Erweiterung nicht unter 'Ausgewählte Objekte', sondern unter 'Verfügbare Objekte' aufgeführt wird, 
aktivieren Sie diese bitte, indem Sie den Eintrag der Erweiterung (`EEA Components (eeacomponents)`) anklicken 
und die Änderungen speichern:

<img src="https://media.einfacheauto.de/plugins/documentation/images/TYPO3v12SettingsConfigureExtensions2.png" width="600"></br></br>

##### Eingeben der CustomerID
* Navigieren Sie sich zum Constant Editor (Site Management > TypoScript und m Dropdown Menü "Konstanten-Editor")

<img src="https://media.einfacheauto.de/plugins/documentation/images/TYPO3v12SettingsConfigureExtensions3.png" width="600"></br></br>
* Im Kategorie-Dropdown-Menü tragen Sie bitte für jedes Plugin der Erweiterung `plugin.tx_eeacomponents_*` in das Feld CUSTOMER ID 
(plugin.tx_eeacomponents_[name des plugins].components.customeridnum) die Kundennummer (CustomerID) ein. 
Speichern Sie anschließend.

* Wiederholen Sie diesen Vorgang für alle Root-Seiten und Komponenten.

##### Optional: Anzeigen der Staging-Umgebung
_Hinweis: Das Anzeigen der Staging-Komponenten sollte niemals in Ihrer Produktionsumgebung durchgeführt werden. 
Komponenten in der Staging-Umgebung können sich jederzeit ohne Voranmeldung ändern oder aufhören zu funktionieren._

* Fragen Sie bei Ihrem zuständigen Partnermanager die Einfach E-Auto Staging-URI an. 
* Im Kategorie-Dropdown-Menü tragen Sie bitte für jedes Plugin der Erweiterung `plugin.tx_eeacomponents_*`, das 
Sie in der Staging-Phase sehen möchten, in das Feld SOURCE SCRIPT (Linker Teil der URL)
(plugin.tx_eeacomponents_[name des plugins].components.sourcescript) die Staging-URI an. 
* Speichern Sie anschließend.

* Wiederholen Sie diesen Vorgang für alle Root-Seiten und Komponenten

## Schritt 3: Freischalten der Domains

Um die Komponenten freischalten zu lassen, senden Sie bitte eine **E-Mail an Ihren Partnermanager 
oder it@einfacheauto.de** mit der/den jeweiligen **Domains, auf denen die Erweiterung eingebunden** werden soll. 


## Schritt 4: Einbinden der Komponenten

Die Einfach E-Auto Komponenten können nun ganz bequem überall auf CMS-Seiten eingebunden werden. Dazu müssen Sie auf
der jeweiligen Landingpage oder Website die Komponente ein Plugin einfügen.

Dazu im Assistenten für neue Inhaltselemente unter dem Reiter "Plug-Ins" das gewünschte Element
("EEA Calculator" oder "EEA Product Finder") auswählen und speichern.


Anschließend können Sie, wenn nötig, das Modul per Drag-and-Drop an die gewünschte Stelle ziehen.

## Hinweise und Einschränkungen

*Bei der Implementierung der Components gibt es eine Einschränkung.
In der aktuellen Version ist es lediglich möglich, jeweils nur einen Finder
je `Seite` zu implementieren.*

Fertig!
Gehen Sie auf die Frontend-Seite Ihrer Typo-3-Seite und die Webkomponente sollte erfolgreich integriert sein.

Wir hoffen, dass Ihnen diese Anleitung geholfen hat. Wenn Sie weitere Fragen haben oder Hilfe benötigen, stehen wir
gerne zur Verfügung.


## Update der Komponente
Um neue Funktionen bereitzustellen oder Sicherheitsupdates umzusetzen, werden wir die Typo3-Erweiterung 
in unregelmäßigen Zeiträumen aktualisieren. 

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
