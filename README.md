# Integration der Einfach E-Auto Komponenten in TYPO3

In dieser Anleitung zeigen wir Ihnen, wie Sie die Komponenten von Einfach E-Auto
in eine TYPO3 Website integrieren können. Diese werden über eine TYPO3-Erweiterung eingebunden.

## Voraussetzungen

- **TYPO3**: 12.4 oder höher
- **PHP**: 8.1 oder höher

---

## Installation

1. **Extension-Installation über Composer**:
   ```bash
   composer require eea/eea_components


## Erweiterung konfigurieren
Die Erweiterung muss erstmalig konfiguriert werden. Falls Sie Ihre individuellen Zugangsdaten noch nicht erhalten haben, 
wenden Sie sich bitte an **it@einfacheauto.de** oder Ihren Partnermanager.

#### Einstellung der Erweiterungen
Die Erweiterung wird über Template-Konstanten konfiguriert. Deshalb müssen Sie sicherstellen, dass diese für die 
jeweiligen Root-Seiten konfiguriert sind.  

* Loggen Sie sich dazu als Administrator in das TYPO3-Backend ein. 

##### Vorbereitung: Template-Konstanten für die Erweiterung aktivieren
* Navigieren Sie sich zum Template Tool (Web > Template und wählen Sie dann die Root-Seite (hier: Home) > Info/Bearbeiten) 
und klicken dort auf "Vollständigen Template-Datensatz bearbeiten".

<img src="images/TYPO3SettingsConfigureExtensions.png" width="600"></br></br>
* Aktivieren Sie dort unter dem Reiter "Enthält" die Konstanten für die Erweiterung. 
Falls die Erweiterung nicht unter 'Ausgewählte Objekte', sondern unter 'Verfügbare Objekte' aufgeführt wird, 
aktivieren Sie diese bitte, indem Sie den Eintrag der Erweiterung (`EEA Components (eea_components)`) anklicken 
und die Änderungen speichern:

<img src="images/TYPO3SettingsConfigureExtensions2.png" width="600"></br></br>

##### Eingeben der CustomerID
* Navigieren Sie sich zum Constant Editor (Web > Template und wählen Sie dann die Root-Seite (hier: Home) > Constant Editor)

<img src="images/TYPO3SettingsConfigureExtensions3.png" width="600"></br></br>
* Im Kategorie-Dropdown-Menü tragen Sie bitte für jedes Plugin der Erweiterung `PLUGIN.TX_EEA_COMPONENTS*` in das Feld CUSTOMER ID 
(plugin.tx_eeacomponents_[name des plugins].components.customeridnum) die Kundennummer (CustomerID) ein. 
Speichern Sie anschließend.

<img src="images/TYPO3SettingsConfigureExtensions4.png" width="600"></br></br>
* Wiederholen Sie diesen Vorgang für alle Root-Seiten.

##### Optional: Anzeigen der Staging-Umgebung
_Hinweis: Das Anzeigen der Staging-Komponenten sollte niemals in Ihrer Produktionsumgebung durchgeführt werden. 
Komponenten in der Staging-Umgebung können sich jederzeit ohne Voranmeldung ändern oder aufhören zu funktionieren._

* Fragen Sie bei Ihrem zuständigen Partnermanager die Einfach E-Auto Staging-URI an. 
* Im Kategorie-Dropdown-Menü tragen Sie bitte für jedes Plugin der Erweiterung `PLUGIN.TX_EEA_COMPONENTS*`, das 
Sie in der Staging-Phase sehen möchten, in das Feld SOURCE SCRIPT (Linker Teil der URL)
(plugin.tx_eeacomponents_[name des plugins].components.sourcescript) die Staging-URI an. 
* Speichern Sie anschließend.

<img src="images/TYPO3SettingsConfigureExtensions5.png" width="600"></br></br>

* Wiederholen Sie diesen Vorgang für alle Root-Seiten und Komponenten

## Freischalten der Domains

Um die Komponenten freischalten zu lassen, senden Sie bitte eine **E-Mail an Ihren Partnermanager 
oder it@einfacheauto.de** mit der/den jeweiligen **Domains, auf denen die Erweiterung eingebunden** werden soll. 


## Schritt 4: Einbinden der Komponenten

Die Einfach E-Auto Komponenten können nun ganz bequem überall auf CMS-Seiten eingebunden werden. Dazu müssen Sie auf
der jeweiligen Landingpage oder Website die Komponente über das jeweilige Plugin einfügen. 
Das Plugin finden Sie am schnellsten über die Suche in den Plugins: 

<img src="images/TYPO3AddPlugins.png" width="600"></br></br>


Anschließend können Sie, wenn nötig, das Modul per Drag-and-Drop an die gewünschte Stelle ziehen.

## Hinweise und Einschränkungen

*Bei der Implementierung der Components gibt es eine Einschränkung.
In der aktuellen Version ist es lediglich möglich, jeweils nur einen Komponente
je `Seite` zu implementieren.*

Fertig!
Gehen Sie auf die Frontend-Seite Ihrer Typo-3-Seite und die Webkomponente sollte erfolgreich integriert sein.

Wir hoffen, dass Ihnen diese Anleitung geholfen hat. Wenn Sie weitere Fragen haben oder Hilfe benötigen, stehen wir
gerne zur Verfügung.


## Copyright

Copyright (c) 2019-2025 [Einfach E-Auto Mobility Solutions GmbH](https://einfacheauto.de)