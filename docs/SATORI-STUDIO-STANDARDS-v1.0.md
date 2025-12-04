# Satori Studio Standards v1.0

## Engineering Practices
- Favor readability and maintainability over micro-optimizations unless performance budgets are at risk.
- Enforce code review for all changes; include tests or rationale when tests are deferred.
- Avoid broad exception handling and never wrap imports in try/catch; fail fast with actionable errors.
- Keep dependencies minimal and pinned where practical to reduce supply chain risk.

## Documentation
- Co-locate docs with code modules and keep versioned references in the `docs/` directory.
- Include configuration examples, failure modes, and rollback steps for operational changes.
- Update changelogs and release notes with user-facing impacts and migration steps.

## Testing & QA
- Maintain unit coverage for critical business logic and smoke tests for UI flows.
- Use fixtures and deterministic data for repeatable results; avoid networked tests by default.
- Capture performance baselines for editor interactions and track regressions per release.
- Record known limitations and mitigations alongside test plans.

## Security & Compliance
- Validate and sanitize all user inputs; follow WordPress nonces and capability checks.
- Rotate secrets and avoid committing credentials; prefer environment variables and key stores.
- Audit third-party packages regularly and document approvals for new dependencies.

## Collaboration
- Prefer small, focused pull requests with clear scope and acceptance criteria.
- Document decisions in the repository to create an accessible knowledge base.
- Keep communication async-friendly; summarize meetings and link to relevant tickets.
