# SATORI Studio — Phase B‑2 Asset → File Path Mapping

Version: 1.0  
Status: Active (Phase B)  
Phase: B‑2 — Branding Asset to File Path Mapping  
Depends on: PHASE_B_ASSET_STANDARDS.md

---

## 1. Purpose

This document defines the **exact mapping between branding assets and their corresponding file paths** within the SATORI Studio codebase.

It exists to:
- Remove ambiguity before any asset swap PRs
- Ensure all Phase B work is path‑stable and reversible
- Allow Phase B‑3 PRs to be executed safely and incrementally

This document is **read‑only planning**. It introduces **no changes**.

---

## 2. Phase B‑2 Rules

- No assets are replaced in this phase
- No code, CSS, JS, or PHP is modified
- Paths listed here must remain stable during swaps
- One asset replacement per PR in Phase B‑3
- All assets must comply with PHASE_B_ASSET_STANDARDS.md

---

## 3. Plugin‑Level Branding

### 3.1 Plugin Icon

| Item | Value |
|-----|------|
| Current file path | Not currently present |
| Referenced by | WordPress.org fallback |
| Asset type | Plugin icon |
| Required size | 256×256 |
| Format | SVG / PNG |
| Notes | No explicit plugin icon exists in the repository |

---

### 3.2 Admin Menu Icon

| Item | Value |
|-----|------|
| Current file path | assets/branding/satori-menu-icon.svg |
| Referenced by | add_menu_page() in src/Core/Admin.php |
| Asset type | Admin menu icon |
| Required size | ~16px rendered |
| Format | SVG |
| Notes | Path-stable SVG admin menu icon; optical variants live at `assets/branding/satori-studio-menu.svg` (SP) and `assets/branding/satori-studio-lite-menu.svg` (SL). Canonical SVG sources remain in `/docs/assets/studio-icons/`. |

---

## 4. Builder Interface Assets

### 4.1 Builder Header Logo (Primary)

| Item | Value |
|-----|------|
| Current file path | _To be confirmed_ |
| Referenced by | Builder header template |
| Asset type | Header logo |
| Max dimensions | 160×24 |
| Format | SVG |
| Notes | No layout changes allowed |

---

### 4.2 Builder Header Icon (Compact)

| Item | Value |
|-----|------|
| Current file path | _To be confirmed_ |
| Referenced by | Compact / responsive header |
| Asset type | Icon mark |
| Size | 20×20 |
| Format | SVG |
| Notes | Icon‑only mark |

---

## 5. Module Icons

### 5.1 Core Module Icons

| Module | Current icon path | Notes |
|------|------------------|------|
| Heading | _To be confirmed_ | `/modules/heading/icon.svg` |
| Text | _To be confirmed_ |  |
| Button | _To be confirmed_ |  |
| Image | _To be confirmed_ |  |
| Layout / Column | _To be confirmed_ |  |

All module icons must:
- Use `24×24` SVG canvas
- Preserve file names and paths
- Remain mono / outline

---

## 6. Shared / Inline SVGs

| Location | Description | Notes |
|--------|-------------|------|
| _To be confirmed_ | Inline SVG in builder UI | CSS‑controlled colours |
| _To be confirmed_ | Admin notices | No animation |

---

## 7. Images & Illustrations

| Usage | Current file path | Notes |
|-----|------------------|------|
| Builder empty state | _To be confirmed_ | SVG preferred |
| Admin informational image | _To be confirmed_ | No text baked in |

---

## 8. Documentation Assets

| Usage | File path | Notes |
|-----|----------|------|
| Screenshots | `/docs/assets/` | Branding must be updated |
| Diagrams | `/docs/assets/` | Phase B only |
| Canonical Studio SVG spec | `/docs/SATORI_STUDIO_CANONICAL_SVG_SPEC_PHASE_B.md` | Reference-only |
| Canonical Studio SVG assets (SL/SP) | `/docs/assets/studio-icons/` | Reference-only |

---

## 9. Phase B‑3 Readiness Checklist

Phase B‑2 is complete when:
- All relevant branding file paths are identified
- Each asset type maps to exactly one path
- No behavioural or layout dependencies are introduced
- This document can be used directly to scope Phase B‑3 PRs

---

## 10. Next Phase

**Phase B‑3 — Asset Swap PRs**
- One concern per PR
- One asset or asset group per PR
- Strict adherence to PHASE_B_ASSET_STANDARDS.md

---

End of Document
