# Satori Studio Repository Scaffold v1.0

## Directory Overview
- `blocks/`, `modules/`: Feature modules and reusable blocks for the builder UI.
- `includes/`: Core PHP classes, hooks, and integration glue code.
- `js/`, `css/`, `fonts/`, `img/`: Front-end assets and supporting resources.
- `languages/`: Localization files and translation templates.
- `extensions/`, `classes/`: Optional integrations and auxiliary services.
- `docs/`: Internal specifications, standards, and roadmap artifacts (this folder).

## Contribution Workflow
1. Create a topic branch from the working branch.
2. Update or add documentation alongside any new feature or change.
3. Write tests or document test coverage gaps with clear follow-up tasks.
4. Submit a pull request with a concise summary, testing notes, and affected areas.

## Release Checklist
- Verify changelog entries and version bumps align with release scope.
- Run regression and smoke suites; capture results in release notes.
- Confirm localization files are updated and packaged.
- Generate build artifacts only on release branches; keep source control clean.

## Environment Expectations
- PHP and WordPress versions must match the minimums noted in `readme.txt`.
- Local development should rely on reproducible tooling (containers or scripted setup).
- Feature flags or filters should be used for risky changes to allow controlled rollouts.

## Support & Maintenance
- Track deprecations and removals with clear timelines and alternative guidance.
- Maintain compatibility matrices for popular plugins and themes where possible.
- Keep an open backlog of known issues, triaged weekly to feed roadmap updates.
