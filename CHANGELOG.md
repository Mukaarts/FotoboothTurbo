# Changelog

All notable changes to the **Fotobooth Turbo** project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
*Next Steps*
- Creation of `Project` Entity ("Wer & Wann").
- Implementation of the Management Dashboard.

## [0.3.0-devops] - 2026-01-16
### Added
- **Automation:** Added `Makefile` to simplify development commands (init, start, stop).
- **Infrastructure:** Configured `compose.yaml` for local **MySQL 8.0** support via Docker.
- **Environment:** Updated `.env` configuration to connect to the Docker container.

## [0.2.0-alpha] - 2026-01-16
### Added
- **Framework:** Initialized Symfony 7 Web-App skeleton.
- **Backend:** Created basic structure for Entities and Controllers.

## [0.1.0-concept] - 2026-01-16
### Added
- **Documentation:** Created comprehensive `README.md` including features, roadmap, and tech stack.
- **Concept:** Defined the **"4-W-Principle"** (Wer, Wann/Wo, Was, Wie) for project management.
- **Workflow:** Established the "Smart Project Wizard" logic (Template vs. Custom Upload).
- **UI Design:** Conceptualized the "Turbo Builder" with Split-Screen layout (Toolbox left, Preview right).
