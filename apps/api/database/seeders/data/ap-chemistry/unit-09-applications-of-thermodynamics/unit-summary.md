# Unit 9 · Applications of Thermodynamics · The night-before sheet

**Exam weight:** about 7–9% of the AP exam · **CED topics:** 9.1 Introduction to Entropy · 9.2 Absolute Entropy and Entropy Change · 9.3 Gibbs Free Energy and Thermodynamic Favorability · 9.4 Thermodynamic and Kinetic Control · 9.5 Free Energy and Equilibrium · 9.6 Coupled Reactions · 9.7 Galvanic (Voltaic) and Electrolytic Cells · 9.8 Cell Potential and Free Energy · 9.9 Cell Potential Under Nonstandard Conditions · 9.10 Electrolysis and Faraday's Law
**Practices:** 1 (Models and Representations), 2 (Question and Method), 4 (Model Analysis), 5 (Mathematical Routines), 6 (Argumentation)
**Weeks:** 30 (entropy, ΔS°, ΔG° and favourability, kinetic control), 31 (ΔG° and K, coupled reactions, cell anatomy), 32 (E°cell, ΔG° = −nFE°, Nernst, electrolysis)

## The ideas that generate every question

1. **Entropy is dispersal of matter and energy.** S rises with temperature, with gas moles, with volume, on melting and boiling, on dissolving most solids, and with molecular complexity. ΔS°rxn = Σ S°(products) − Σ S°(reactants), and the sign is usually readable from the gas-mole count alone.
2. **Favourability is ΔG° = ΔH° − TΔS°.** Four sign cases: (−, +) always favourable; (+, −) never; (−, −) favourable at low T; (+, +) favourable at high T. The crossover is T = ΔH°/ΔS°. ΔG° can also be built from ΔG°f values, exactly like ΔH° from ΔH°f.
3. **Favourable is not fast.** ΔG° says where equilibrium lies; Ea says how quickly it is reached. Diamond, H₂ + O₂ at room temperature and glucose in air are thermodynamically favourable and kinetically stalled. Catalysts change the rate, never ΔG° or K.
4. **ΔG° and K are the same number in different clothes.** ΔG° = −RT ln K: negative ΔG° means K > 1, positive means K < 1, zero means K = 1. Away from standard conditions, ΔG = ΔG° + RT ln Q, and the mixture moves toward Q = K where ΔG = 0.
5. **An unfavourable step can be driven.** Add a favourable reaction that shares an intermediate (ΔG° values add, K values multiply), or supply electrical work (electrolysis) or light (photosynthesis). ATP, ore smelting with carbon and the charging of a battery are the three stock examples.
6. **A cell separates oxidation from reduction.** Anode = oxidation, cathode = reduction, in every cell. Electrons leave the anode through the wire; ions move through the salt bridge (anions toward the anode). Galvanic: E > 0, anode negative, does work. Electrolytic: E < 0, anode positive (wired to the supply's + terminal), consumes work.
7. **A voltage is a free energy per electron.** E°cell = E°cathode − E°anode (both as reductions, never scaled); ΔG° = −nFE°; nFE° = RT ln K. Non-standard: E = E° − (RT/nF) ln Q, so E falls as a cell discharges and reaches zero at Q = K.
8. **Electrons are a reagent.** q = I·t; mol e⁻ = q/F; the half-reaction's ratio converts mol e⁻ to mol product. In water, compare every candidate with water's own reduction (−0.41 V at pH 7) and oxidation (+1.23 V); chloride is the overpotential exception.

## Key formulas and data

| Quantity | Formula or value | Notes |
|---|---|---|
| Entropy change of reaction | ΔS° = Σ S°(products) − Σ S°(reactants) | J/(mol·K); elements have S° > 0 |
| Gibbs free energy | ΔG° = ΔH° − TΔS° | convert ΔS° to kJ/K; T in kelvin |
| From formation data | ΔG° = Σ ΔG°f(products) − Σ ΔG°f(reactants) | ΔG°f of an element in its standard state is 0 |
| Crossover temperature | T = ΔH°/ΔS° | where ΔG° = 0 for the (−, −) and (+, +) cases |
| Free energy and K | ΔG° = −RT ln K | R = 8.314 J/(mol·K); K from ΔG°: K = e^(−ΔG°/RT) |
| Non-standard | ΔG = ΔG° + RT ln Q | ΔG = 0 at Q = K |
| Cell potential | E°cell = E°cathode − E°anode | both from the reduction table; E° intensive |
| Potential and free energy | ΔG° = −nFE° | F = 96,485 C/mol; 1 V·C = 1 J |
| Potential and K | ln K = nFE°/(RT); log K = nE°/0.0592 at 298 K | E° of 1 V ≈ K of 10³⁴ for n = 2 |
| Nernst equation | E = E° − (RT/nF) ln Q = E° − (0.0592/n) log Q | 0.0592/n volts per tenfold change in Q |
| Concentration cell | E° = 0; E = −(0.0592/n) log([dilute]/[conc]) | dilute side is the anode |
| Faraday's law | q = I·t; mol e⁻ = q/F | time in seconds; then the half-reaction ratio |
| Useful constants | R = 8.314 J/(mol·K); F = 96,485 C/mol; RT/F = 0.0257 V at 298 K | all on the equations sheet except 0.0592 |
| E° values used here | Ag⁺/Ag +0.80; Cu²⁺/Cu +0.34; H⁺/H₂ 0.00; Pb²⁺/Pb −0.13; Ni²⁺/Ni −0.25; Zn²⁺/Zn −0.76; Al³⁺/Al −1.66; Mg²⁺/Mg −2.37; O₂/H₂O +1.23 | given on the exam |

## Reading the three kinds of picture

- **Table of S° or ΔG°f values:** products minus reactants, each multiplied by its coefficient; check the sign of ΔS° against the gas-mole count and the sign of ΔG° against what you know of the reaction. A ΔG°f of zero marks an element in its standard state.
- **Cell diagram:** find the two half-reactions in the table; the higher E° is the cathode. Label electrons (anode → wire → cathode), ion flow (anions → anode compartment), the electrode that loses mass (anode) and gains mass (cathode), and the signs (galvanic: anode −; electrolytic: anode +). Line notation reads anode | anode solution || cathode solution | cathode.
- **Table of reduction potentials:** top-left is the strongest oxidising agent, bottom-right the strongest reducing agent. A reaction is favourable when its oxidising agent sits above its reducing agent. Predict electrolysis products by inserting water's two half-reactions into the ranking.

## Common errors

- Writing ΔS° in J and ΔH° in kJ in the same equation; the −TΔS° term is then off by 1,000.
- Reading "ΔG° > 0" as "nothing happens"; it means K < 1, and the reaction still runs toward Q = K.
- Reading "ΔG° < 0" as "fast"; thermodynamics is silent on rate.
- Letting a catalyst change ΔG°, K or the equilibrium position.
- Multiplying E° when a half-reaction is scaled; only n and ΔG° scale.
- Subtracting the potentials in the wrong order, or flipping the anode sign and then subtracting again.
- Dropping the minus sign in ΔG° = −nFE°, or using n = 1 for a two-electron reaction.
- Thinking a dead battery has no electrons left; it is at Q = K.
- Including solids or liquid water in Q; counting minutes as seconds in Faraday's law.
- Expecting sodium metal from aqueous NaCl, or O₂ instead of Cl₂ from brine.

## Worked example: one problem, every method

**The reaction.** 2 Ag⁺(aq) + Cu(s) → 2 Ag(s) + Cu²⁺(aq), the reaction of a copper strip in silver nitrate.

**From potentials.** E°cell = 0.80 − 0.34 = **+0.46 V**; silver is the cathode, copper the anode; n = 2.

**To free energy.** ΔG° = −nFE° = −(2)(96,485)(0.46) = −88,800 J = **−88.8 kJ**. Favourable, as a positive E° demands.

**To the equilibrium constant.** log K = (2)(0.46)/0.0592 = 15.5, so K ≈ **3 × 10¹⁵**: the copper dissolves and silver plates out essentially to completion.

**Away from standard.** With [Ag⁺] = 0.10 M and [Cu²⁺] = 0.10 M, Q = [Cu²⁺]/[Ag⁺]² = 0.10/0.010 = 10; E = 0.46 − (0.0296)(log 10) = **0.43 V**. As the reaction proceeds, [Ag⁺] falls, [Cu²⁺] rises, Q climbs and E drops toward zero.

**As a cell.** Cu(s) | Cu²⁺(aq) || Ag⁺(aq) | Ag(s). Electrons flow from the copper strip through the wire to the silver electrode; NO₃⁻ moves from the salt bridge into the copper compartment; the silver electrode gains mass.

**In reverse.** To plate copper back out of Cu²⁺ and dissolve silver, apply more than 0.46 V with silver as the anode (+ terminal) and copper as the cathode. Passing 0.750 A for 20.0 min in the original galvanic direction moves (0.750)(1,200)/96,485 = 0.00933 mol e⁻ and deposits 0.00933 mol × 107.87 g/mol = **1.01 g of silver**.

**The entropy view.** ΔS° for this reaction is small and slightly negative (two aqueous ions become one plus a solid), so ΔG° is dominated by ΔH°; the (−, −) case means the reaction would eventually become unfavourable at very high temperature, but not anywhere near room temperature.

## What to review from earlier units

- **Unit 4:** oxidation numbers, half-reactions and balancing redox equations (4.9) give n; mole-ratio stoichiometry (4.5) is the last step of every Faraday's-law problem.
- **Unit 6:** ΔH° from Hess's law and formation data (6.8, 6.9) is the first term of ΔG°; the state-function logic carries over to ΔG° and to coupled reactions.
- **Unit 7:** Q versus K (7.3, 7.10) is the reason a cell voltage changes and the meaning of ΔG = ΔG° + RT ln Q; Ksp (7.11–7.14) was the first use of ΔG° = −RT ln K.
- **Unit 5:** Ea and catalysts (5.6, 5.11) are what "kinetic control" refers to.

## The unit exam

Forty-two items, about 85 minutes, every topic from 9.1 to 9.10 plus review. Three stimulus sets (a table of S° and ΔH°f data for the decomposition of calcium carbonate; a galvanic cell with a table of reduction potentials; an electrolysis of aqueous copper sulfate with time and mass data), stand-alone multiple choice, select-all, true/false, fill-in-the-blank and five numeric calculations (ΔS° from S° data, a crossover temperature, K from ΔG°, ΔG° from E°, and a Faraday's-law mass), two short-answer questions (ΔG°, K and ΔG at a given Q for the Haber process; a cell's E°, ΔG° and Nernst potential) and one long free-response question that takes the electrolysis of aqueous CuSO₄ from products and minimum voltage through a Faraday's-law calculation and its thermodynamic interpretation. The equations sheet carries ΔG° = ΔH° − TΔS°, ΔG° = −RT ln K, ΔG° = −nFE°, the Nernst equation, q = I·t and the constants R and F.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 9.1–9.10). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
