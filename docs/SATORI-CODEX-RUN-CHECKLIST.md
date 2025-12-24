# SATORI Studio — Codex Run Checklist (Phase A)

This checklist defines the **standard operating procedure** for running Codex jobs safely within SATORI Studio. It prioritizes **core protection, incremental change, and reversibility**, and must be followed unless explicitly overridden.

---

## 0) Pre-flight — confirm branch + clean state

```bash
pwd
git branch --show-current
git status
git fetch origin
```

**Expect:**
- Correct working directory (plugin root)
- Correct branch (e.g. `codex/phase-a-builder-remove-upsell-safely-v4`)
- `working tree clean`

---

## 1) Snapshot baseline (before Codex runs)

```bash
git rev-parse --short HEAD
git log --oneline -5
```

Optional (useful sanity check):
```bash
git diff --stat origin/main..HEAD
```

**Expect:**
- No diff before Codex runs

---

## 2) Run Codex job

- Paste the approved Codex job prompt
- Ensure Codex is targeting the **current branch**
- Confirm the job includes the mandatory SATORI standards directive at the top

---

## 3) Post-Codex — review what changed

```bash
git status
git diff --name-only origin/main..HEAD
git diff --stat origin/main..HEAD
```

**Expected files (depending on task):**
- `includes/ui-js-templates.php`
- `js/fl-builder-ui-main-menu.js` (if required)
- `js/fl-builder.js`
- `js/fl-builder.min.js` (only if absolutely required)

⚠️ **Red flag:** If Codex modifies unrelated files (docs, images, readme, etc.), stop and revert those paths.

---

## 4) Guardrail check — Underscore template safety

This prevents runtime errors such as `missing } in compound statement`.

```bash
php -l includes/ui-js-templates.php
git diff origin/main..HEAD -- includes/ui-js-templates.php | grep -n "<#"
```

Manually verify:
- Every `<# if (...) { #>` has a matching `<# } #>`
- No orphan `<# } #>` blocks
- No removed template IDs that JS may reference
- `<script>` tags remain correctly paired

---

## 5) Minified parity sanity check

Codex must **not** overwrite bundled files incorrectly.

```bash
wc -c js/fl-builder.js js/fl-builder.min.js
```

**Watch for:**
- Suspiciously similar file sizes (indicates bad overwrite)

Optional quick signal check:
```bash
grep -n "UIIFrame" js/fl-builder.min.js | head
```

---

## 6) Local Builder smoke test (Lite)

Open any page with the builder enabled:

```
/some-page/?fl_builder
```

Verify:

### Modules panel
- ❌ No “Pro” section
- ❌ No PRO badges
- ❌ No upsell CTA blocks

### Tools panel
- ❌ No PRO labels or upgrade cues
- ✅ Core tools still function
- ✅ No crashes when clicking items

### Console
- ❌ No JavaScript exceptions (warnings are acceptable)

---

## 7) Cache sanity checks (if UI looks unchanged)

- Hard refresh: `Cmd + Shift + R`
- DevTools → Network tab:
  - Confirm updated JS files are loading
  - Disable cache temporarily if needed

---

## 8) Commit hygiene

If Codex did not commit automatically:

```bash
git add -A
git commit -m "fix: safe Phase A builder UI cleanup (Lite)"
git push
```

If Codex produced multiple commits, keep them **if they are logically separated** (preferred for reversibility).

---

## 9) Open Pull Request

- Base: `main`
- Head: current Codex branch
- Use `docs/pull_request_template-v1.0.1.md`

PR description **must include**:
- Required SATORI standards statement at the top
- What is changing
- Why it belongs in Phase A
- What is explicitly out of scope
- Local test notes

---

## 10) Final merge gate

Before merging:

```bash
git diff origin/main..HEAD --name-only
```

Confirm:
- Only intended files are touched
- No accidental scope creep

---

### Status
This checklist is **authoritative** for Codex-driven development in SATORI Studio Phase A and later, unless superseded by updated standards.

