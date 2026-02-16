# MUMEISHI Deployment Checklist  
SATORI Studio – Lite v1.0.0-MVP

---

## Phase 1 – Pre-Deployment Validation

- [ ] Clean clone of repository
- [ ] Install fresh WordPress instance
- [ ] Activate SATORI Studio – Lite
- [ ] Confirm no fatal PHP errors
- [ ] Confirm admin menu icon renders correctly
- [ ] Confirm welcome screen layout integrity
- [ ] Confirm "Pages → Add New" dynamic link works
- [ ] Confirm no stray <hr> elements
- [ ] Confirm no inline styles leaking outside admin scope

---

## Phase 2 – Functional Validation

- [ ] Create new page
- [ ] Launch SATORI Studio
- [ ] Add basic modules (text, image, button)
- [ ] Save layout
- [ ] Reload page
- [ ] Confirm builder loads correctly
- [ ] Confirm no console errors

---

## Phase 3 – Frontend Output Check

- [ ] Confirm layout renders correctly
- [ ] Confirm CSS output integrity
- [ ] Confirm no admin assets loaded on frontend
- [ ] Confirm theme compatibility

---

## Phase 4 – Governance Validation

- [ ] Confirm GPL notice present
- [ ] Confirm documentation link correct
- [ ] Confirm contact email correct
- [ ] Confirm no Beaver Builder upsell UI remains

---

## Phase 5 – Backup & Snapshot

- [ ] Create full database backup
- [ ] Create full wp-content backup
- [ ] Tag deployment version in Git
- [ ] Record environment notes

---

Deployment Status:
[ ] Approved  
[ ] Pending Fixes  
[ ] Rolled Back  

Deployment Notes:
