# SATORI Studio — Codex Development Workflow Guide  
Version: 1.0.0  
Last Updated: 2025-12-08  
Maintainer: Satori Graphics Pty Ltd  

---

## Purpose

This document defines the official **SATORI Studio Codex Development Workflow**, a standard operating procedure (SOP) for using the ChatGPT Codex Connector to write, modify, refactor, and extend code across all SATORI Studio repositories.

Codex is a core part of the SATORI Studio development pipeline and must be used consistently, safely, and efficiently.

This SOP ensures:

- Predictable and high-quality PRs  
- Consistent architecture across repositories  
- Faster development cycles  
- Safe refactoring without breaking legacy behaviour  
- Easy onboarding for future Satori developers  

---

# 1. Codex Task Preparation Rules

Every Codex task MUST follow these formatting requirements:

### 1.1 Plain Text Only

Codex /plan messages must:

- NOT contain Markdown formatting  
- NOT contain headings (# Title)  
- NOT contain code fences (```)  
- NOT contain blockquotes  
- NOT contain bold/italic text  

Codex requires plain text only.

### 1.2 Structure of Every Codex Plan

A valid Codex plan must include:

1. Title of the task  
2. Goal  
3. Detailed step-by-step tasks  
4. File paths and namespaces  
5. Verification steps  
6. Branch naming instructions  
7. Commit message instructions  
8. PR summary instructions  
9. Constraints — what Codex must not touch  

---

# 2. Codex Execution Workflow

1. Prepare the /plan  
2. Send plan to Codex  
3. Codex generates branch + PR  
4. Developer reviews PR  
5. Merge PR  
6. Pull changes locally  

---

# 3. SATORI PR Review Checklist

Check:

- Architecture  
- Behaviour  
- Code Quality  
- File paths  
- Stability  
- Safety  

---

# 4. Naming Conventions

### Branch format:

```
codex/{task-name}
```

### Commit messages:

```
feat: ...
fix: ...
refactor: ...
docs: ...
```

---

# 5. Architectural Best Practices

- No direct modification of Beaver Builder internals  
- All new SATORI systems live under `/src/`  
- Modernise incrementally  
- Maintain bootstrap stability  

---

# 6. Future-Proofing Practices

Phase-based architecture:

1. Bootstrap  
2. Environment  
3. Services Container  
4. Asset Manager  
5. Module System  
6. Admin Settings API  
7. Licensing / Pro Layer  
8. UI Overhaul  

---

# 7. Glossary

- Codex  
- Bootstrap Layer  
- Environment  
- Services Container  
- Module System  

---

# Changelog

- **1.0.0 — Initial SOP created.**
