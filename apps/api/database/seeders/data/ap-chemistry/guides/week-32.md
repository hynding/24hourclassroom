# Week 32 · Cell Potential, the Nernst Equation and Electrolysis

**Topics:** 9.8 Cell Potential and Free Energy · 9.9 Cell Potential Under Nonstandard Conditions · 9.10 Electrolysis and Faraday's Law
**Practices:** 1 (Models and Representations), 4 (Model Analysis), 5 (Mathematical Routines), 6 (Argumentation)
**Spiral:** the anode/cathode anatomy of a cell (9.7) is assumed; ΔG° = −RT ln K (9.5) and ΔG = ΔG° + RT ln Q (9.5) reappear with E° and E in place of free energy; Q and K (7.3, 7.10) decide which way a cell runs; oxidation numbers and balanced half-reactions (4.9) supply n; the mole and molar mass (1.1) and stoichiometry (4.5) are what Faraday's law reduces to.

## What you need to be able to do

- **9.8** Calculate a standard cell potential from standard reduction potentials (E°cell = E°cathode − E°anode); explain why E° is not multiplied when a half-reaction is scaled; relate E° to ΔG° through ΔG° = −nFE° and to K; recognise that E° > 0 means a thermodynamically favourable reaction (ΔG° < 0, K > 1).
- **9.9** Use the Nernst equation, E = E° − (RT/nF) ln Q, to find the potential of a cell at non-standard concentrations; predict qualitatively how E changes as a cell runs or as concentrations are changed; explain a concentration cell; connect E = 0 to Q = K.
- **9.10** Describe an electrolytic cell and identify the products of electrolysing a molten salt or an aqueous solution; use Faraday's law, q = I·t and mol e⁻ = q/F, to relate current, time, moles of electrons and the mass or volume of a product; state the minimum voltage an external supply must exceed.

## Key terms

| Term | Meaning |
|---|---|
| Standard reduction potential, E° | The potential of a half-cell under standard conditions (1 M, 1 atm, 298 K) measured against the standard hydrogen electrode, defined as 0.00 V. A more positive E° means a stronger oxidising agent on the left of the half-reaction. |
| Standard cell potential, E°cell | E°cathode − E°anode, both taken as written in the reduction table; positive for a galvanic cell. |
| Faraday's constant, F | 96,485 C per mole of electrons: the charge carried by one mole of electrons. |
| n | The number of moles of electrons transferred in the balanced overall equation as written. |
| ΔG° = −nFE° | The link between cell potential and free energy; in J when E° is in volts and F in C/mol. |
| Nernst equation | E = E° − (RT/nF) ln Q; at 298 K, E = E° − (0.0592/n) log Q. |
| Concentration cell | Two half-cells of the same material at different concentrations; E° = 0, but E ≠ 0 until the concentrations equalise. |
| Electrolysis | Driving a non-spontaneous redox reaction with an external power supply whose voltage exceeds the magnitude of the cell's negative E. |
| Overpotential | The extra voltage, beyond the thermodynamic minimum, needed in practice to make a gas-evolving half-reaction go at a useful rate; the reason aqueous NaCl electrolysis gives Cl₂ rather than O₂ at the anode. |
| Coulomb, C | The unit of charge; 1 C = 1 A × 1 s. |

## 9.8 Cell potential: a voltage is a free energy per electron

Every half-reaction has a **standard reduction potential**. The table always lists them as reductions, from the strongest oxidising agent (F₂, +2.87 V) at the top to the weakest (Li⁺, −3.04 V) at the bottom. A short table you should be able to read:

| Reduction half-reaction | E° (V) |
|---|---|
| Ag⁺(aq) + e⁻ → Ag(s) | +0.80 |
| Cu²⁺(aq) + 2 e⁻ → Cu(s) | +0.34 |
| 2 H⁺(aq) + 2 e⁻ → H₂(g) | 0.00 |
| Pb²⁺(aq) + 2 e⁻ → Pb(s) | −0.13 |
| Ni²⁺(aq) + 2 e⁻ → Ni(s) | −0.25 |
| Zn²⁺(aq) + 2 e⁻ → Zn(s) | −0.76 |
| Al³⁺(aq) + 3 e⁻ → Al(s) | −1.66 |
| Mg²⁺(aq) + 2 e⁻ → Mg(s) | −2.37 |

In a galvanic cell, the half-reaction with the **higher** E° runs as written (reduction, cathode) and the one with the lower E° runs backwards (oxidation, anode):

E°cell = E°cathode − E°anode

Both values go in as they appear in the reduction table; you never flip the sign of the anode value and then subtract. Three things about E° that students get wrong:

1. **E° is intensive.** Doubling a half-reaction (2 Ag⁺ + 2 e⁻ → 2 Ag) does not double its E° (+0.80 V, not +1.60 V). A potential is a free energy *per electron*, and doubling the reaction doubles both the energy and the electrons.
2. **Sign and favourability.** E°cell > 0 means ΔG° < 0 and K > 1: the reaction as written is thermodynamically favourable. E°cell < 0 means it runs the other way.
3. **The bridge to free energy** is ΔG° = −nFE°, where n is the moles of electrons in the balanced equation and F = 96,485 C/mol. Because 1 V × 1 C = 1 J, the answer comes out in joules. And since ΔG° = −RT ln K, you also have nFE° = RT ln K, so a cell potential measures the equilibrium constant: at 298 K, log K = nE°/0.0592.

**Worked example (9.8).** A cell is built from Zn/Zn²⁺ and Cu/Cu²⁺ half-cells under standard conditions. Find E°cell, ΔG° and K at 298 K.

- Cu²⁺ has the higher E° (+0.34 V), so copper is the cathode; zinc (−0.76 V) is the anode. E°cell = 0.34 − (−0.76) = **+1.10 V**.
- Overall: Zn(s) + Cu²⁺(aq) → Zn²⁺(aq) + Cu(s), n = 2.
- ΔG° = −nFE° = −(2)(96,485 C/mol)(1.10 V) = −212,000 J = **−212 kJ/mol**.
- ln K = nFE°/(RT) = 212,267 / (8.314 × 298) = 85.7, so K = e^85.7 ≈ **10³⁷**. (Check with the shortcut: log K = 2 × 1.10 / 0.0592 = 37.2.) A potential of just over a volt corresponds to a reaction that goes essentially to completion.

**Try it.** Repeat for Mg(s) + 2 Ag⁺(aq) → Mg²⁺(aq) + 2 Ag(s). (E°cell = 0.80 − (−2.37) = 3.17 V; n = 2 because two electrons are transferred per Mg, even though the silver half-reaction is doubled; ΔG° = −2 × 96,485 × 3.17 = −612 kJ.)

## 9.9 The Nernst equation: potential away from standard conditions

Take ΔG = ΔG° + RT ln Q, substitute ΔG = −nFE and ΔG° = −nFE°, and divide through by −nF:

E = E° − (RT/nF) ln Q

This is the **Nernst equation**, and it is on the equations sheet. At 298 K, RT/F = 0.0257 V, and converting to base-10 logarithms gives the form most people compute with: E = E° − (0.0592/n) log Q.

What it says, in words:

- **Q < 1** (more reactant than product, relative to standard) makes ln Q negative, so E > E°. A galvanic cell with concentrated reactant ions and dilute product ions produces a *higher* voltage than the standard value.
- **Q > 1** makes E < E°.
- **As the cell runs**, reactant ions are consumed and product ions accumulate, so Q rises, E falls, and the voltage reaches **zero when Q = K**. A "dead" battery is a cell at equilibrium, not a cell that has run out of electrons.
- **The effect is small per decade.** Each factor-of-10 change in Q shifts E by 0.0592/n volts. For n = 2 that is 30 mV; large concentration changes make only modest voltage changes, which is why battery voltages hold nearly steady until near the end.

A **concentration cell** has the same electrode material and ion on both sides but at different concentrations, so E° = 0 and the only driving force is the entropy of mixing: the dilute side is the anode (it makes more ions), the concentrated side is the cathode (it consumes them), and E = −(0.0592/n) log([dilute]/[concentrated]), positive.

**Worked example (9.9).** The Zn/Cu cell above is run with [Zn²⁺] = 1.0 M and [Cu²⁺] = 0.010 M. Find E at 298 K.

- Q = [Zn²⁺]/[Cu²⁺] = 1.0 / 0.010 = 100 (solids are omitted).
- E = 1.10 − (0.0592/2) log 100 = 1.10 − (0.0296)(2) = 1.10 − 0.059 = **1.04 V**. Lower than standard because the reactant ion Cu²⁺ is dilute, as expected.

**Worked example (concentration cell).** Cu(s) | Cu²⁺(0.010 M) || Cu²⁺(1.0 M) | Cu(s). Here E° = 0; the overall reaction is Cu²⁺(1.0 M) → Cu²⁺(0.010 M), so Q = 0.010/1.0 and E = 0 − (0.0592/2) log(0.010) = −(0.0296)(−2) = **+0.059 V**.

**Try it.** For Ni(s) + 2 Ag⁺(aq) → Ni²⁺(aq) + 2 Ag(s), E° = 1.05 V. Find E when [Ni²⁺] = 0.10 M and [Ag⁺] = 0.010 M. (Q = 0.10/(0.010)² = 1,000; E = 1.05 − (0.0296)(3) = 0.96 V.)

## 9.10 Electrolysis and Faraday's law

An **electrolytic cell** uses an external power supply to force a reaction with E < 0. The supply's voltage must exceed |E|; in practice it must exceed it by the overpotential as well. Oxidation still happens at the anode and reduction at the cathode, but now the anode is connected to the positive terminal of the supply and the cathode to the negative one.

**Predicting the products** is a matter of comparing reduction potentials of everything present:

- **Molten salt**: only the salt's ions are present. NaCl(l) gives Na(l) at the cathode and Cl₂(g) at the anode. This is how sodium, magnesium, aluminium (from Al₂O₃ dissolved in molten cryolite) and chlorine are made.
- **Aqueous solution**: water competes. At the cathode, water (2 H₂O + 2 e⁻ → H₂ + 2 OH⁻, about −0.83 V at pH 14, −0.41 V at pH 7) is reduced in preference to any metal ion with a more negative E° (Na⁺, K⁺, Mg²⁺, Al³⁺); metals with E° above that of water (Cu²⁺, Ag⁺) are deposited instead. At the anode, water (2 H₂O → O₂ + 4 H⁺ + 4 e⁻, +1.23 V) is oxidised in preference to anions that are harder to oxidise (SO₄²⁻, NO₃⁻, F⁻). Chloride is a special case: O₂ should form first on thermodynamic grounds, but its large overpotential means concentrated brine gives Cl₂.
- So: aqueous Na₂SO₄ → H₂ and O₂ (just water electrolysis, with the salt carrying current); aqueous CuSO₄ with inert electrodes → Cu at the cathode and O₂ at the anode; aqueous NaCl → H₂ and NaOH at the cathode, Cl₂ at the anode (the chlor-alkali process).

**Faraday's law** is stoichiometry with electrons as a reagent. The chain of conversions is always:

current (A) × time (s) = charge (C) → ÷ 96,485 C/mol = mol e⁻ → × (mol substance / mol e⁻ from the half-reaction) = mol substance → × molar mass or × 22.4 L/mol at STP.

Run it in either direction: from current and time to mass deposited, or from mass to the time or current needed.

**Worked example (9.10, forward).** A current of 2.00 A passes through aqueous CuSO₄ for 30.0 min. What mass of copper is deposited?

- q = I·t = (2.00 A)(30.0 × 60 s) = 3,600 C.
- mol e⁻ = 3,600 / 96,485 = 0.0373 mol.
- Cu²⁺ + 2 e⁻ → Cu, so mol Cu = 0.0373 / 2 = 0.01866 mol.
- mass = 0.01866 × 63.55 g/mol = **1.19 g**.

**Worked example (9.10, reverse).** How long will it take to plate 5.00 g of silver from AgNO₃(aq) at 1.50 A?

- mol Ag = 5.00 / 107.87 = 0.0464 mol; Ag⁺ + e⁻ → Ag, so mol e⁻ = 0.0464 mol.
- q = 0.0464 × 96,485 = 4,470 C.
- t = q / I = 4,470 / 1.50 = 2,980 s = **49.7 min**.

**Try it.** Aluminium is produced by reducing Al³⁺ in molten cryolite. What mass of Al forms from 10.0 A for 1.00 h? (q = 36,000 C; mol e⁻ = 0.373; mol Al = 0.124; mass = 3.36 g. The factor of 3 is what makes aluminium so energy-hungry to make.)

**One picture to carry.** A galvanic cell and an electrolytic cell built from the same two half-cells are the same reaction run in opposite directions: the galvanic cell runs the E > 0 direction and delivers up to nFE joules of electrical work per mole; the electrolytic cell is forced through the E < 0 direction and consumes at least that much. Charging a rechargeable battery is exactly this reversal.

## Common mistakes

- **Multiplying E° when a half-reaction is doubled.** Never. Only n changes, and it appears in ΔG° = −nFE° and in the Nernst equation.
- **Subtracting in the wrong order.** E°cell = E°cathode − E°anode with both from the reduction table. If you get a negative number for a cell you were told is galvanic, you have the electrodes backwards.
- **Forgetting the sign in ΔG° = −nFE°.** A positive potential gives a negative free energy. Check: E° > 0 must mean favourable.
- **Using F in the wrong unit chain.** F is in C/mol; current is in A = C/s; time must be in seconds, not minutes or hours.
- **Dropping the electron ratio.** A 3+ ion needs three moles of electrons per mole of metal; a 2+ ion needs two; silver needs one.
- **Thinking E = 0 means no electrons remain.** E = 0 means Q = K: the cell is at equilibrium.
- **Putting solids into Q.** Only aqueous ions and gases appear.
- **Electrolysing aqueous Na⁺ to sodium metal.** Water is reduced first; sodium is only made from the molten salt.

## Where this goes next

This is the last topic of the course. The next two weeks are the exam-prep guide and the full practice exam. Electrochemistry appears on the real exam both as multiple-choice items (reading a table of potentials, predicting products of electrolysis, a Faraday's-law calculation) and inside long free-response questions, typically combined with thermodynamics (ΔG°, K), equilibrium (Q, Le Châtelier reasoning about E) and stoichiometry (mass or gas volume from charge).

## Self-check

1. A cell is built from Pb/Pb²⁺ (E° −0.13 V) and Cu/Cu²⁺ (E° +0.34 V). Which metal is the anode, and what is E°cell?
2. Calculate ΔG° for the Pb/Cu cell reaction (n = 2).
3. For the Zn/Cu cell (E° = 1.10 V), will E be greater or less than 1.10 V if [Zn²⁺] = 0.10 M and [Cu²⁺] = 1.0 M? By how much?
4. What are the products at the anode and cathode when aqueous Na₂SO₄ is electrolysed with platinum electrodes?
5. How many moles of electrons pass when 5.00 A flows for 2.00 h, and what mass of chromium is deposited from Cr³⁺?

**Answers.** (1) Lead is the anode (lower E°); E°cell = 0.34 − (−0.13) = 0.47 V. (2) ΔG° = −(2)(96,485)(0.47) = −90,700 J = −90.7 kJ. (3) Greater: Q = 0.10/1.0 = 0.10, log Q = −1, so E = 1.10 + 0.0296 = 1.13 V, about 0.03 V higher. (4) Anode: O₂ (water oxidised); cathode: H₂ (water reduced); Na⁺ and SO₄²⁻ are spectators that carry the current. (5) q = 5.00 × 7,200 = 36,000 C; 36,000 / 96,485 = 0.373 mol e⁻; Cr³⁺ + 3 e⁻ → Cr, so 0.124 mol Cr × 52.00 g/mol = 6.47 g.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 9.8–9.10). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
