# Attribution

Every study guide, unit summary, flashcard deck, quiz, unit exam, the exam-prep
guide and the practice exam in this directory is **original writing** for this
course, organised around the College Board *AP Chemistry Course and Exam
Description* (CED): its nine units, topic codes and topic titles are used to
organise the material, and its learning objectives are paraphrased in the
course's own words, never copied. The exam format, timing, calculator policy
and the contents of the equations and constants sheet are taken from AP
Central (the AP Chemistry exam page, accessed 2026-10-16). AP® is a trademark
of the College Board, which does not endorse this material.

Nothing here is adapted from a textbook. OpenStax *Chemistry 2e* and
*Chemistry: Atoms First 2e* are not used: their current licence is
CC BY-NC-SA 4.0 and its terms bar ingestion by language models. Nor was text
taken from commercial review books or College Board released exam questions.

**Data** are limited to the public domain. Every physical constant, molar
mass, isotopic abundance, ionization energy, bond enthalpy, boiling and
melting point, vapour pressure, specific heat, enthalpy of formation,
absolute entropy and free energy of formation is taken from a U.S. government
source and rounded as the AP equations sheet and standard classroom tables
do. Equilibrium constants (Ka, Kb, Ksp) and standard reduction potentials are
the rounded teaching values that every standard tabulation agrees on, and
are consistent with the NIST compilations named below. Items whose `source`
field reads `general knowledge` rest on standard chemical facts (solubility
rules, the list of strong acids and bases, VSEPR shapes, the activity series,
oxidation-number rules, the behaviour of catalysts) that are not attributable
to any single source.

**Laboratory scenarios** (titrations, calorimetry runs, calibration curves,
chromatography, gas collections, initial-rate and concentration–time data
sets, precipitation and electrolysis experiments) are hypothetical teaching
data constructed so that the arithmetic closes; they are not measurements
from any published study. Figures, particle diagrams and graphs are described
in words, not reproduced.

## Sources (all public domain, U.S. government; accessed 2026-10-16, and 2026-10-17 for weeks 13–16)

| Source | URL | Used for |
|---|---|---|
| NIST Chemistry WebBook (SRD 69) | https://webbook.nist.gov/ | Boiling and melting points, vapour pressure of water, specific heats, enthalpies of fusion and vaporisation, standard enthalpies of formation, absolute entropies, free energies of formation, bond energies (all rounded) |
| NIST CODATA Internationally Recommended Values of the Fundamental Physical Constants | https://physics.nist.gov/cuu/Constants/ | R, F, h, c, N_A, electron and proton masses |
| NIST Atomic Weights and Isotopic Compositions | https://www.nist.gov/pml/atomic-weights-and-isotopic-compositions-relative-atomic-masses | Isotopic masses and abundances, average atomic masses |
| NIST Atomic Spectra Database (ASD), ionization energies | https://physics.nist.gov/asd | First and successive ionization energies (rounded to the kJ/mol values commonly tabulated) |
| NIST Computational Chemistry Comparison and Benchmark Database (CCCBDB) | https://cccbdb.nist.gov/ | Bond lengths and average bond enthalpies (rounded) |
| NIST Critically Selected Stability Constants of Metal Complexes (SRD 46) | https://www.nist.gov/srd/nist46 | Consistency check for the rounded Ka, Kb and Ksp teaching values used |
| PubChem (National Library of Medicine) | https://pubchem.ncbi.nlm.nih.gov/ | Molar masses to 0.01 g/mol, formulas and names of compounds |
| AP Central, AP Chemistry exam page (College Board) | https://apcentral.collegeboard.org/courses/ap-chemistry/exam | Exam format, timing, calculator policy, equations and constants sheet (review week only) |

## Per-week table

Directory names are abbreviated: `unit-01` = `unit-01-atomic-structure-and-properties`, `unit-02` = `unit-02-compound-structure-and-properties`, `unit-03` = `unit-03-intermolecular-forces-and-properties`, `unit-04` = `unit-04-chemical-reactions`, `unit-05` = `unit-05-kinetics`, `unit-06` = `unit-06-thermodynamics`, `unit-07` = `unit-07-equilibrium`, `unit-08` = `unit-08-acids-and-bases`, `unit-09` = `unit-09-applications-of-thermodynamics`.

| Week | CED topics | Files | Sources used (beyond general knowledge) |
|---|---|---|---|
| 01 | 1.1 Moles and Molar Mass · 1.2 Mass Spectroscopy of Elements | guides/week-01.md, unit-01/week-01.yaml | NIST CODATA (N_A); NIST Atomic Weights and Isotopic Compositions (isotope masses and abundances of Cl, Cu, Mg, Si, B); PubChem (molar masses) |
| 02 | 1.3 Elemental Composition of Pure Substances · 1.4 Composition of Mixtures | guides/week-02.md, unit-01/week-02.yaml | PubChem (molar masses); NIST Atomic Weights (average atomic masses) |
| 03 | 1.5 Atomic Structure and Electron Configuration · 1.6 Photoelectron Spectroscopy | guides/week-03.md, unit-01/week-03.yaml | NIST CODATA (h, c, N_A); NIST ASD (ionization energies, rounded); binding energies described qualitatively in MJ/mol as on AP PES diagrams |
| 04 | 1.7 Periodic Trends · 1.8 Valence Electrons and Ionic Compounds | guides/week-04.md, unit-01/week-04.yaml | NIST ASD (first and successive ionization energies, rounded); NIST CODATA |
| U1 | 1.1–1.8 | unit-01/unit-summary.md, unit-01/unit-exam.yaml | NIST CODATA; NIST Atomic Weights; NIST ASD; PubChem |
| 05 | 2.1 Types of Chemical Bonds · 2.2 Intramolecular Force and Potential Energy | guides/week-05.md, unit-02/week-05.yaml | NIST Chemistry WebBook and CCCBDB (bond energies and lengths, rounded); PubChem |
| 06 | 2.3 Structure of Ionic Solids · 2.4 Structure of Metals and Alloys · 2.5 Lewis Diagrams | guides/week-06.md, unit-02/week-06.yaml | NIST Chemistry WebBook (melting points, rounded); NIST CODATA |
| 07 | 2.6 Resonance and Formal Charge · 2.7 VSEPR and Bond Hybridization | guides/week-07.md, unit-02/week-07.yaml | NIST CCCBDB (bond lengths, rounded); general knowledge |
| U2 | 2.1–2.7 | unit-02/unit-summary.md, unit-02/unit-exam.yaml | NIST Chemistry WebBook and CCCBDB (bond data, rounded); NIST CODATA; PubChem |
| 08 | 3.1 Intermolecular and Interparticle Forces · 3.2 Properties of Solids · 3.3 Solids, Liquids, and Gases | guides/week-08.md, unit-03/week-08.yaml | NIST Chemistry WebBook (boiling and melting points, rounded); PubChem |
| 09 | 3.4 Ideal Gas Laws · 3.5 Kinetic Molecular Theory · 3.6 Deviation from Ideal Gas Law | guides/week-09.md, unit-03/week-09.yaml | NIST CODATA (R in both unit systems); NIST Chemistry WebBook (vapour pressure of water, rounded); PubChem (molar masses) |
| 10 | 3.7 Solutions and Mixtures · 3.8 Representations of Solutions · 3.9 Separation of Solutions and Mixtures: Chromatography | guides/week-10.md, unit-03/week-10.yaml | PubChem (molar masses); NIST Chemistry WebBook (boiling points of hexane, octane, ethanol, rounded); NIST CODATA (N_A) |
| 11 | 3.10 Solubility · 3.11 Spectroscopy and the Electromagnetic Spectrum | guides/week-11.md, unit-03/week-11.yaml | NIST CODATA (h, c, N_A); general knowledge (solubility behaviour, spectral regions) |
| 12 | 3.12 Photoelectric Effect · 3.13 Beer–Lambert Law | guides/week-12.md, unit-03/week-12.yaml | NIST CODATA (h, c); work functions are approximate teaching values rounded from standard tabulations; calibration data are hypothetical; PubChem |
| U3 | 3.1–3.13 | unit-03/unit-summary.md, unit-03/unit-exam.yaml | NIST Chemistry WebBook (boiling and melting points, vapour pressure of water, rounded); NIST CODATA; PubChem |
| 13 | 4.1 Introduction for Reactions · 4.2 Net Ionic Equations · 4.3 Representations of Reactions | guides/week-13.md, unit-04/week-13.yaml | NIST CODATA (N_A); general knowledge (solubility rules, strong acids and bases) |
| 14 | 4.4 Physical and Chemical Changes · 4.5 Stoichiometry | guides/week-14.md, unit-04/week-14.yaml | PubChem (molar masses); NIST CODATA (R, N_A) |
| 15 | 4.6 Introduction to Titration · 4.7 Types of Chemical Reactions | guides/week-15.md, unit-04/week-15.yaml | PubChem (molar masses of NaOH, KHP, acetic acid); general knowledge (activity series) |
| 16 | 4.8 Introduction to Acid–Base Reactions · 4.9 Oxidation–Reduction (Redox) Reactions | guides/week-16.md, unit-04/week-16.yaml | PubChem (molar masses); NIST ASD (ionization energies of Na and Mg, rounded) |
| U4 | 4.1–4.9 | unit-04/unit-summary.md, unit-04/unit-exam.yaml | PubChem (molar masses); NIST CODATA (R) |
| 17 | 5.1 Reaction Rates · 5.2 Introduction to Rate Law · 5.3 Concentration Changes Over Time | guides/week-17.md, unit-05/week-17.yaml | NIST CODATA (R); kinetic data sets are hypothetical teaching data |
| 18 | 5.4 Elementary Reactions · 5.5 Collision Model · 5.6 Reaction Energy Profile · 5.7 Introduction to Reaction Mechanisms | guides/week-18.md, unit-05/week-18.yaml | NIST CODATA (R); energy-profile values are illustrative |
| 19 | 5.8 Reaction Mechanism and Rate Law · 5.9 Steady-State Approximation · 5.10 Multistep Reaction Energy Profile · 5.11 Catalysis | guides/week-19.md, unit-05/week-19.yaml | NIST CODATA (R); Arrhenius data sets are hypothetical teaching data |
| U5 | 5.1–5.11 | unit-05/unit-summary.md, unit-05/unit-exam.yaml | NIST CODATA (R) |
| 20 | 6.1 Endothermic and Exothermic Processes · 6.2 Energy Diagrams · 6.3 Heat Transfer and Thermal Equilibrium | guides/week-20.md, unit-06/week-20.yaml | NIST Chemistry WebBook (specific heats of water and metals, rounded); PubChem (molar masses) |
| 21 | 6.4 Heat Capacity and Calorimetry · 6.5 Energy of Phase Changes · 6.6 Introduction to Enthalpy of Reaction | guides/week-21.md, unit-06/week-21.yaml | NIST Chemistry WebBook (enthalpies of fusion and vaporisation of water, specific heats, rounded); PubChem (molar masses) |
| 22 | 6.7 Bond Enthalpies · 6.8 Enthalpy of Formation · 6.9 Hess's Law | guides/week-22.md, unit-06/week-22.yaml | NIST Chemistry WebBook (standard enthalpies of formation, rounded; average bond enthalpies rounded from NIST/CCCBDB tabulations) |
| U6 | 6.1–6.9 | unit-06/unit-summary.md, unit-06/unit-exam.yaml | NIST Chemistry WebBook (ΔH°f values, specific heats, rounded); PubChem |
| 23 | 7.1 Introduction to Equilibrium · 7.2 Direction of Reversible Reactions · 7.3 Reaction Quotient and Equilibrium Constant · 7.4 Calculating the Equilibrium Constant | guides/week-23.md, unit-07/week-23.yaml | NIST CODATA (R); equilibrium data sets are hypothetical teaching data |
| 24 | 7.5 Magnitude of the Equilibrium Constant · 7.6 Properties of the Equilibrium Constant · 7.7 Calculating Equilibrium Concentrations · 7.8 Representations of Equilibrium | guides/week-24.md, unit-07/week-24.yaml | NIST CODATA (R); concentration–time data sets are hypothetical teaching data |
| 25 | 7.9 Introduction to Le Châtelier's Principle · 7.10 Reaction Quotient and Le Châtelier's Principle · 7.11 Introduction to Solubility Equilibria | guides/week-25.md, unit-07/week-25.yaml | Ksp values rounded from standard tabulations consistent with NIST SRD 46 (Critically Selected Stability Constants); NIST CODATA (R) |
| 26 | 7.12 Common-Ion Effect · 7.13 pH and Solubility · 7.14 Free Energy of Dissolution | guides/week-26.md, unit-07/week-26.yaml | Ksp values as above; NIST CODATA (R) |
| U7 | 7.1–7.14 | unit-07/unit-summary.md, unit-07/unit-exam.yaml | Ksp values as above; NIST CODATA (R) |
| 27 | 8.1 Introduction to Acids and Bases · 8.2 pH and pOH of Strong Acids and Bases · 8.3 Weak Acid and Base Equilibria | guides/week-27.md, unit-08/week-27.yaml | Ka and Kb values rounded from standard tabulations consistent with NIST SRD 46; Kw from NIST Chemistry WebBook; PubChem (molar masses) |
| 28 | 8.4 Acid–Base Reactions and Buffers · 8.5 Acid–Base Titrations · 8.6 Molecular Structure of Acids and Bases · 8.7 pH and pKa | guides/week-28.md, unit-08/week-28.yaml | Ka and Kb values as above; titration curves are computed teaching data |
| 29 | 8.8 Properties of Buffers · 8.9 Henderson–Hasselbalch Equation · 8.10 Buffer Capacity | guides/week-29.md, unit-08/week-29.yaml | Ka values as above; PubChem (molar masses of phosphate salts) |
| U8 | 8.1–8.10 | unit-08/unit-summary.md, unit-08/unit-exam.yaml | Ka and Kb values as above; PubChem |
| 30 | 9.1 Introduction to Entropy · 9.2 Absolute Entropy and Entropy Change · 9.3 Gibbs Free Energy and Thermodynamic Favorability · 9.4 Thermodynamic and Kinetic Control | guides/week-30.md, unit-09/week-30.yaml | NIST Chemistry WebBook (S° and ΔH°f values for N₂, H₂, NH₃, SO₂, SO₃, O₂, CaCO₃, CaO, CO₂, H₂O, rounded); NIST CODATA (R) |
| 31 | 9.5 Free Energy and Equilibrium · 9.6 Coupled Reactions · 9.7 Galvanic (Voltaic) and Electrolytic Cells | guides/week-31.md, unit-09/week-31.yaml | NIST Chemistry WebBook (ΔG°f values for Fe₂O₃, CO, CO₂, ZnO; ΔH°f and S° of water, rounded); standard reduction potentials rounded from standard tabulations; NIST CODATA (R, F) |
| 32 | 9.8 Cell Potential and Free Energy · 9.9 Cell Potential Under Nonstandard Conditions · 9.10 Electrolysis and Faraday's Law | guides/week-32.md, unit-09/week-32.yaml | NIST CODATA (F, R); standard reduction potentials as above; PubChem (molar masses of Cu, Ag, Al, Ni, Cr) |
| U9 | 9.1–9.10 | unit-09/unit-summary.md, unit-09/unit-exam.yaml | NIST Chemistry WebBook (S° and ΔH°f data, rounded); NIST CODATA (R, F); standard reduction potentials as above; PubChem |
| 33 | Exam preparation | review/exam-prep-guide.md | AP Central (exam format, timing, calculator policy and the equations and constants sheet, accessed 2026-10-16); NIST CODATA (constants listed) |
| 34 | Practice exam, all units | review/practice-exam.yaml | NIST Chemistry WebBook (boiling points, bond enthalpies, ΔH°f and S° values, rounded); NIST Atomic Weights (Mg isotopes); NIST CODATA (R, F, h, c); PubChem (molar masses); standard reduction potentials and Ka/Ksp values as above |

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 1.1–9.10). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
