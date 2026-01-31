# SATORI Studio — Canonical SVG Asset Reference (Phase B)

**Version:** 1.0  
**Status:** Active (Phase B)  
**Scope:** Documentation-only, reference artefacts

---

## 1. Purpose

This document enumerates the **canonical Studio SVG reference assets** for Phase B. These files define what “correct” looks like for downstream work and **must not be used as runtime assets**. They are stored under `docs/` for reference only.

---

## 2. Canonical Asset Locations

| Asset | Path | Description |
|---|---|---|
| SL canonical mark | `/docs/assets/studio-icons/satori-studio-lite.canonical.svg` | S + L lettermark with canonical geometry |
| SP canonical mark | `/docs/assets/studio-icons/satori-studio-sp.canonical.svg` | S + P lettermark with canonical geometry |

---

## 3. Specification Link

The construction rules, geometry, and placement values for these assets are defined in:

```
/docs/SATORI_STUDIO_CANONICAL_SVG_SPEC_PHASE_B.md
```

---

## 4. Reference-Only Rules

- Do **not** copy these assets into runtime paths.
- Do **not** replace plugin or admin icons with these assets.
- Use these files exclusively for visual verification and future asset generation.

---

## 5. Quick Verification Checklist

- Files live only under `docs/assets/studio-icons/`.
- SVG dimensions are 256 × 256 with `viewBox="0 0 256 256"`.
- Colours match the canonical palette: background `#7A7A7A`, border `#000000`, text `#FFFFFF`.
- Letter geometry matches the canonical spec (SL/SP).

---

**End of Document**
