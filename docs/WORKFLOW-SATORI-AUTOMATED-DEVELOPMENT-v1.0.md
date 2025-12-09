# WORKFLOW-SATORI-AUTOMATED-DEVELOPMENT — Version 1.0  
**Document Type:** Engineering Workflow Standard  
**Applies To:** All SATORI Studio + SATORI Plugins  
**Maintainer:** Andy Garard  
**Status:** Active  

---

# 1. Purpose  
This standard formalises the SATORI automated engineering pipeline — a workflow where humans provide strategic direction and AI systems (Codex, GitHub Copilot, GitHub CI) perform repetitive or mechanical tasks.

The goals are:

- Maximum development velocity  
- Consistent architecture  
- Reduced human error  
- Predictable code quality  
- Reliable CI/CD behaviour  
- A stable engineering culture across all SATORI products  

---

# 2. Core Principles  

### **2.1 Humans define *what*; automation defines *how***  
Architectural intent and naming come from humans; Codex implements.

### **2.2 PRs must be small and scoped**  
Each PR introduces one logical layer or feature (e.g. Environment, Container, Registry, Module).

### **2.3 Codex builds entire features**  
Codex is responsible for generating:

- Directories, classes, namespaces  
- Bootstrap and lifecycle structures  
- Helper functions and service accessors  
- Documentation updates  
- PR summaries and testing notes  

### **2.4 GitHub Copilot enforces correctness**  
Copilot reviews PRs for:

- Anti-patterns  
- Duplicate logic  
- PHP compatibility issues  
- Runtime hazards  
- API inconsistencies  

All accepted suggestions must be resolved before merge.

### **2.5 Humans approve architecture only**  
Human reviewers should spend time evaluating:

- Architecture  
- Naming conventions  
- Performance-sensitive choices  
- Long-term maintainability  

Human reviewers should **not** manually build implementation scaffolding.

### **2.6 The `main` branch is always stable**  
All changes flow through PRs.

### **2.7 Developer workflow is optimised for speed**  
No manual boilerplate, minimal typing, predictable outcomes.

---

# 3. Roles & Responsibilities  

## **3.1 Human (Andy / Satori Engineers)**  
- Define features, layers and naming  
- Approve or reject PRs  
- Direct architectural evolution  
- Maintain documentation vision  
- Define product behaviour  

Humans do *not* manually write large amounts of code unless required.

---

## **3.2 Codex (ChatGPT GitHub Connector)**  
Codex performs:

- Full file creation  
- Namespacing  
- Bootstrap orchestration  
- Service registration  
- Responding to Copilot reviews  
- Maintaining internal consistency  
- Producing PR documentation  

Codex acts as a full engineering member.

---

## **3.3 GitHub Copilot (Automatic Reviewer)**  
Acts as an automated senior engineer:

- Detects bottlenecks  
- Flags design problems  
- Warns about stability issues  
- Suggests better patterns  
- Identifies redundant logic  

All actionable feedback must be implemented by Codex.

---

# 4. Standardised PR Workflow  

## **4.1 Step 1 — Define Feature Layer**  
Human writes a *Codex Task* describing:

- Intention  
- Namespaces  
- New classes  
- Architecture boundaries  
- Expected interactions  

Codex generates the PR.

---

## **4.2 Step 2 — Codex implements entire feature**  
Codex performs:

- File creation  
- Architecture wiring  
- Naming compliance  
- Internal documentation  
- PR summary  
- Testing instructions  

---

## **4.3 Step 3 — Copilot automatic review**  
Copilot suggests:

- Improvements  
- Fixes  
- Architectural refinements  

Codex updates the PR accordingly.

---

## **4.4 Step 4 — Human architectural approval**  
Humans validate:

- Design integrity  
- API surface  
- Maintainability  
- Future scalability  

---

## **4.5 Step 5 — Merge**  
Merge only after:

- All Copilot suggestions resolved  
- Codex confirms readiness  
- `php -l` or CI syntax checks pass  
- No regressions detected  

---

# 5. PR Structure Requirements  

Every PR must include:

### **5.1 Summary**  
Short explanation of what the PR accomplishes.

### **5.2 Testing Instructions**  
Clear manual commands (e.g. `php -l src/...`) to validate syntax.

### **5.3 Architectural Notes**  
Why decisions were made.

### **5.4 Labels**  
- `codex`  
- `enhancement`  
- or others as needed  

### **5.5 PR Scope**  
One concept per PR. No “mega PRs.”

---

# 6. Code Generation Standards  

Codex must follow:

- PSR-4 autoloading  
- Strict naming consistency  
- SATORI namespcing patterns  
- Minimal global state  
- Service container usage  
- Internal documentation requirements  

Codex cannot introduce breaking changes without architectural review.

---

# 7. Error & Fix Handling  

### **7.1 Copilot errors → Codex fixes**  
Codex updates the PR based on Copilot review.  
Typical cases:

- Duplicate initialization warnings  
- Incorrect argument counts  
- Uninitialised variables  
- Style inconsistencies  

### **7.2 Post-merge issues → Codex patch PR**  
If issues arise after merging:

```
@codex create repair PR for <issue>
```

Codex generates a fix PR.

---

# 8. Documentation Requirements  

Any major feature or architectural evolution must be recorded in:

- `SATORI-STUDIO-STANDARDS-vX.X.md`  
- `SATORI-STUDIO-CODEX-DEVELOPMENT-GUIDE.md`  
- `WORKFLOW-SATORI-AUTOMATED-DEVELOPMENT-vX.X.md`  
- `ARCHITECTURE.md` (once created)  

Codex updates docs automatically within PRs.

---

# 9. Future Expansion  

Planned expansions:

- Architecture linting  
- Automated version bumping  
- Automatic doc generation  
- AI-assisted threat modelling  
- CI rules for complex dependency analysis  

---

# 10. Revision Policy  

1. Codex drafts revision  
2. Human reviews  
3. Version number increments  
4. Documentation is updated in `/docs`  

---

**END OF DOCUMENT**  
**WORKFLOW-SATORI-AUTOMATED-DEVELOPMENT — Version 1.0**
