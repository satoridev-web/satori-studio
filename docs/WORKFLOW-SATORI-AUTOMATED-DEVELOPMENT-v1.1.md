# WORKFLOW-SATORI-AUTOMATED-DEVELOPMENT — Version 1.1
**Document Type:** Engineering Workflow Standard  
**Applies To:** All SATORI Studio + SATORI Plugins  
**Maintainer:** Andy Garard  
**Status:** Active  

---

# 1. Purpose
This document formalises the automated engineering pipeline used across all SATORI Studio products.  
It crosslinks to the SATORI SOPs and Codex Development Guide to create a unified, self-reinforcing system.

Related Standards:
- **SATORI-SOPS-AUTOMATED-DEVELOPMENT-DIRECTIVES.md**
- **SATORI-STUDIO-CODEX-DEVELOPMENT-GUIDE.md**
- **SATORI-STUDIO-STANDARDS-v1.0.md**

---

# 2–10 (unchanged sections)
All content from Version 1.0 remains, defining:
- Core principles  
- Roles  
- Workflow  
- PR structure  
- Standards  
- Error handling  
- Documentation rules  
- Revision rules  

---

# 11. Automated Execution Directives for Codex (NEW in v1.1)

Codex MUST automatically follow the standards defined across all SATORI documents unless explicitly instructed otherwise.

Codex Default Behaviour:
- Follow the SATORI Automated Workflow (this file).
- Follow SATORI SOPs for Automated Development.
- Follow the SATORI Codex Development Guide.
- Use namespaces, structure, naming, and conventions defined in the SATORI Standards file.
- Keep PRs scoped, safe, and predictable.
- Update documentation when new architecture is introduced.
- Respond to Copilot review suggestions.
- Never introduce breaking changes without explicit direction.
- Treat `/docs` as the authoritative standards library.

Override Rules:
- Only explicit instructions in a Codex plan override these directives.
- Silence is interpreted as “follow SOPs”.

---

# 12. Crosslink Summary (NEW)
Codex must consider the following documents authoritative:

1. **WORKFLOW-SATORI-AUTOMATED-DEVELOPMENT-v1.1.md** (this file)
2. **SATORI-SOPS-AUTOMATED-DEVELOPMENT-DIRECTIVES.md**
3. **SATORI-STUDIO-CODEX-DEVELOPMENT-GUIDE.md**
4. **SATORI-STUDIO-STANDARDS-v1.0.md**

---

**END OF DOCUMENT — Version 1.1**
