# SATORI Studio — Canonical SVG Asset Reference (Phase B)

**Version:** 1.0  
**Status:** Active (Phase B)  
**Scope:** Documentation-only, reference artefacts

---

## 1. Purpose

This document enumerates the **canonical Studio SVG source assets** for Phase B. These files define what “correct” looks like for downstream work and are the source for runtime Studio icon copies.

---

## 2. Canonical Asset Locations

| Asset | Path | Description |
|---|---|---|
| SL canonical mark | `/docs/assets/studio-icons/satori-studio-lite.canonical.svg` | S + L lettermark with canonical geometry |
| SP canonical mark | `/docs/assets/studio-icons/satori-studio-pro.canonical.svg` | S + P lettermark with canonical geometry |

---

## 3. Specification Link

The construction rules, geometry, and placement values for these assets are defined in:

```
/docs/SATORI_STUDIO_CANONICAL_SVG_SPEC_PHASE_B.md
```

---

## 4. Reference-Only Rules

- Canonical files are stored in `docs/assets/studio-icons/` and are the locked source of truth.
- Runtime files `assets/branding/satori-icon.svg` (Lite) and `assets/branding/satori-icon-pro.svg` (Pro) must be verbatim copies of the matching canonical SVGs.
- Do **not** edit runtime icon files directly; make changes in canonical sources first, then copy forward.
- Geometry edits are only allowed through canonical source updates.

---

## 5. Quick Verification Checklist

- Canonical files live under `docs/assets/studio-icons/`.
- Runtime icon files match canonical sources byte-for-byte.
- Canonical and runtime icon files do not include Illustrator/tool metadata comments.
- SVG dimensions are 256 × 256 with `viewBox="0 0 256 256"`.
- Colours match the canonical palette: frame `#77787B`, panel `#BEBEBE`, glyphs `#FFFFFF`.
- Letter geometry matches the canonical spec (SL/SP).

---

**End of Document**
