# 📸 Fotobooth Turbo

> **Status:** 🚧 In Entwicklung (Pre-Alpha / Konzept-Phase)

**Fotobooth Turbo** ist die All-in-One SaaS-Lösung für professionelle Fotoautomaten-Vermieter. Sie kombiniert Projektmanagement mit einem leistungsstarken Layout-Builder. Nutzer können Kundenaufträge verwalten und direkt die passenden Layouts und technischen Konfigurationen exportieren.

---

## 🧩 Das Projekt-Konzept (4-W-Prinzip)

Jedes Projekt in Fotobooth Turbo ist eine zentrale Akte, die vier Fragen beantwortet:

1.  **Wer? (Kunde)**
    * Erfassung von Kundendaten, Ansprechpartnern und Firmennamen.
2.  **Wann & Wo? (Vermietung)**
    * Datum des Events, Location/Venue und spezifische Notizen zur Logistik.
3.  **Was? (Das Layout)**
    * Das visuelle Design (Overlay, Hintergrund) und die Anordnung der Fotos.
4.  **Wie? (Die Config)**
    * Die technische Steuerung: Countdown, Trigger, Drucker-Settings und Filter.

---

## 🌟 Kern-Features

### 1. 🗂 Management Dashboard
* Übersicht aller aktiven, geplanten und archivierten Vermietungen.
* Such- und Filterfunktion nach Datum oder Kundenname.

### 2. 🪄 Smart Design Wizard
Der Weg zum Layout:
* **Template-Modus:** Zeit sparen durch Auswahl geprüfter Vorlagen (z.B. "Hochzeit", "Messe").
* **Custom-Modus:** Maximale Flexibilität durch Upload eigener Grafiken für spezielle Kundenwünsche.

### 3. 🎨 Visual Editor ("Turbo Builder")
Ein intuitives Split-Screen-Interface:
* **Rechts (Live Preview):** WYSIWYG-Vorschau des Druck-Ergebnisses in Echtzeit.
* **Links (Toolbox):**
    * **Layer-Kontrolle:** Design als Hintergrund oder Overlay (Vordergrund) setzen.
    * **Foto-Justierung:** Präzises Verschieben (X/Y) und Skalieren der Foto-Slots.
    * **Elemente:** Hinzufügen von Texten und Platzhaltern.

### 4. 📦 Export Engine
* **One-Click Download:** Generiert ein fertiges `.zip`-Paket.
* **Auto-Config:** Erstellt automatisch die nötigen XML/JSON-Dateien für die Ziel-Software (z.B. dslrBooth), basierend auf den visuellen und technischen Einstellungen.

---

## 🗺 Der Workflow

1.  **Start:** Neues Projekt anlegen -> Eingabe von **"Wer?"** und **"Wann/Wo?"**.
2.  **Design:** Wechsel in den Builder -> Festlegen von **"Was?"** (Layout wählen oder bauen).
3.  **Setup:** Konfiguration der Technik -> Festlegen von **"Wie?"** (Settings).
4.  **Finish:** Export der ZIP-Datei für den Einsatz am Event.

---

## 🛠 Tech-Stack

* **Backend:** [Symfony 7](https://symfony.com) (PHP 8.2+)
* **Frontend:** Webpack Encore, Stimulus, Bootstrap 5
* **Canvas-Engine:** [Fabric.js](http://fabricjs.com/) (v6)
* **Datenbank:** MySQL 8.0 (via Docker)

---

## 📝 Roadmap

- [ ] **Phase 1: Core & Datenstruktur**
    - [x] Projekt-Setup (Symfony, Docker, Make)
    - [ ] Entity `Project` erstellen (Kunde, Datum, Location).
    - [ ] Entity `Design` erstellen (Layout-Daten).

- [ ] **Phase 2: Management UI**
    - [ ] Dashboard-Ansicht programmieren.
    - [ ] "Neues Projekt"-Formular (Wer/Wann/Wo) erstellen.

- [ ] **Phase 3: Der Editor**
    - [ ] Integration Fabric.js (Split-Screen).
    - [ ] Logik für Layering & Positioning.

- [ ] **Phase 4: Export**
    - [ ] XML-Generator Service implementieren.
    - [ ] ZIP-Archivierung.

---

## 🚀 Installation & Entwicklung

Dank **Docker** und **Make** ist das Aufsetzen der Umgebung extrem einfach.

### Voraussetzungen
* Docker Desktop (gestartet)
* PHP 8.2+ & Composer
* Node.js & NPM

### Setup (Nur beim ersten Mal)

1.  **Repository klonen**
    ```bash
    git clone [https://github.com/dein-user/fotobooth-turbo.git](https://github.com/dein-user/fotobooth-turbo.git)
    cd fotobooth-turbo
    ```

2.  **Initialisieren**
    Dieser Befehl startet Docker, installiert alle Pakete und richtet die Datenbank ein:
    ```bash
    make init
    ```

### Täglicher Workflow

* **Starten:** Startet Webserver, Datenbank und Asset-Watcher.
    ```bash
    make start
    ```
  *Die App läuft unter: `https://127.0.0.1:8000`*

* **Stoppen:** Beendet Server und Container.
    ```bash
    make stop
    ```

* **Datenbank-Update:** Nach Änderungen an Entities (neue Tabellen).
    ```bash
    make migration  # Erstellt die Migrations-Datei
    make db         # Führt die Migration aus
    ```

---

## 📄 Lizenz

Proprietär / Copyright © 2026 Fotobooth Turbo
