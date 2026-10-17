# Week 22 · Bond Enthalpies, Enthalpies of Formation and Hess's Law

**Topics:** 6.7 Bond Enthalpies · 6.8 Enthalpy of Formation · 6.9 Hess's Law
**Practices:** 1 (Models and Representations), 4 (Model Analysis), 5 (Mathematical Routines), 6 (Argumentation)
**Spiral:** Lewis structures (2.5) tell you which bonds break and form; bond order and bond energy (2.2, 2.6) explain why a triple bond costs more than a single; the thermochemical-equation rules of week 21 (6.6: scaling, reversing) are the whole of Hess's law; the energy diagrams of week 20 (6.2) show why the route does not matter.

## What you need to be able to do

- **6.7** Estimate ΔH of a gas-phase reaction from average bond enthalpies: ΔH ≈ Σ(bonds broken) − Σ(bonds formed); explain why the result is an estimate; use a Lewis structure to count bonds.
- **6.8** Define the standard enthalpy of formation ΔH°f (one mole of a substance from its elements in their standard states; zero for an element in its standard state) and use ΔH°rxn = Σ n ΔH°f(products) − Σ n ΔH°f(reactants).
- **6.9** State Hess's law (ΔH is a state function, independent of path) and combine thermochemical equations, scaling and reversing them, to obtain the ΔH of a target reaction.

## Key terms

| Term | Meaning |
|---|---|
| Bond enthalpy (bond energy) | The energy to break one mole of a particular bond in the gas phase; an average over many compounds for all but diatomic molecules. Always positive. |
| Standard state | The pure substance at 1 atm (1 bar) and, usually, 25 °C; for solutions, 1 M. Denoted by °. |
| Standard enthalpy of formation, ΔH°f | ΔH for forming 1 mol of a compound from its elements in their standard states. ΔH°f of an element in its standard state is 0 by definition. |
| Standard enthalpy of reaction, ΔH°rxn | ΔH for a reaction with all species in their standard states. |
| State function | A property that depends only on the current state, not on how it was reached: enthalpy, internal energy, entropy, free energy. Heat and work are not state functions. |
| Hess's law | If a reaction is the sum of steps, its ΔH is the sum of the steps' ΔH values. |
| Formation reaction | The equation that defines ΔH°f: elements → 1 mol compound, e.g. C(s, graphite) + 2 H₂(g) → CH₄(g). |

## Bond enthalpies (6.7)

Breaking bonds costs energy; forming bonds releases it. If you know the energy of every bond, you can estimate ΔH:

ΔH ≈ Σ (bond enthalpies of bonds broken) − Σ (bond enthalpies of bonds formed)

Count bonds from Lewis structures, not from formulas. Average values (kJ/mol), rounded as on typical data tables:

| Bond | kJ/mol | Bond | kJ/mol | Bond | kJ/mol |
|---|---|---|---|---|---|
| H–H | 436 | C–H | 413 | O–H | 467 |
| C–C | 347 | C=C | 614 | C≡C | 839 |
| C–O | 358 | C=O | 799 | O=O | 495 |
| N–H | 391 | N≡N | 945 | N=N | 418 |
| Cl–Cl | 243 | H–Cl | 431 | C–Cl | 339 |

**Worked example.** Estimate ΔH for CH₄(g) + 2 O₂(g) → CO₂(g) + 2 H₂O(g).
Bonds broken: 4 C–H (4 × 413 = 1,652) + 2 O=O (2 × 495 = 990) = 2,642 kJ.
Bonds formed: 2 C=O (2 × 799 = 1,598) + 4 O–H (4 × 467 = 1,868) = 3,466 kJ.
ΔH ≈ 2,642 − 3,466 = **−824 kJ/mol**. (The accepted value for gaseous water is −802 kJ/mol; the estimate is within 3%.)

**Worked example.** H₂(g) + Cl₂(g) → 2 HCl(g): broken 436 + 243 = 679; formed 2 × 431 = 862; ΔH ≈ 679 − 862 = **−183 kJ** (accepted −185 kJ).

Why only an estimate? A tabulated C–H value is an average over methane, ethane, benzene and so on; the real C–H bond in a given molecule differs by a few per cent. And bond enthalpies are gas-phase quantities: if a reactant or product is a liquid or solid, the enthalpy of vaporisation or lattice energy is missing. For an exact answer use enthalpies of formation.

A useful shortcut for reasoning questions: a reaction is exothermic when the bonds formed are stronger or more numerous than those broken. Combustion makes very strong C=O and O–H bonds; that is why hydrocarbons are fuels. N₂ is inert because its triple bond (945 kJ/mol) is so costly to break.

**Try it.** Estimate ΔH for N₂(g) + 3 H₂(g) → 2 NH₃(g).
*Answer:* broken 945 + 3 × 436 = 2,253; formed 6 × 391 = 2,346; ΔH ≈ −93 kJ (accepted −92 kJ).

## Standard enthalpies of formation (6.8)

Every compound has a tabulated ΔH°f, the heat of making one mole of it from its elements in their standard states. Elements in their standard states (O₂(g), N₂(g), H₂(g), C(s, graphite), Na(s), Hg(l), Br₂(l)) have ΔH°f = 0. A negative ΔH°f means the compound is lower in enthalpy than its elements (most compounds); a positive one means the compound stores energy relative to its elements (NO, O₃, C₂H₂, benzene).

Because enthalpy is a state function, any reaction can be imagined as taking the reactants apart into elements (−ΔH°f of each reactant) and assembling the products (+ΔH°f of each product):

ΔH°rxn = Σ n ΔH°f(products) − Σ n ΔH°f(reactants)

with n the coefficients. Selected values at 25 °C (kJ/mol, NIST data rounded):

| Substance | ΔH°f | Substance | ΔH°f | Substance | ΔH°f |
|---|---|---|---|---|---|
| CO₂(g) | −393.5 | H₂O(l) | −285.8 | H₂O(g) | −241.8 |
| CH₄(g) | −74.8 | C₃H₈(g) | −103.8 | C₂H₅OH(l) | −277.6 |
| NH₃(g) | −45.9 | NO(g) | +90.3 | NO₂(g) | +33.2 |
| SO₂(g) | −296.8 | SO₃(g) | −395.7 | CO(g) | −110.5 |
| CaO(s) | −635.1 | CaCO₃(s) | −1,206.9 | Ca(OH)₂(s) | −985.2 |
| Fe₂O₃(s) | −824.2 | Al₂O₃(s) | −1,675.7 | HCl(g) | −92.3 |

**Worked example.** C₃H₈(g) + 5 O₂(g) → 3 CO₂(g) + 4 H₂O(l).
ΔH° = [3(−393.5) + 4(−285.8)] − [(−103.8) + 5(0)] = (−1,180.5 − 1,143.2) + 103.8 = **−2,219.9 kJ** ≈ −2,220 kJ, the value used in week 21.

**Worked example.** 2 Al(s) + Fe₂O₃(s) → Al₂O₃(s) + 2 Fe(s).
ΔH° = [(−1,675.7) + 2(0)] − [2(0) + (−824.2)] = −1,675.7 + 824.2 = **−851.5 kJ**.

**Worked example (finding a ΔH°f).** The combustion of ethanol, C₂H₅OH(l) + 3 O₂ → 2 CO₂ + 3 H₂O(l), has ΔH° = −1,367 kJ. Find ΔH°f of ethanol.
−1,367 = [2(−393.5) + 3(−285.8)] − [x + 0] = (−787.0 − 857.4) − x = −1,644.4 − x, so x = −1,644.4 + 1,367 = **−277.4 kJ/mol**.

Write the formation equation correctly when asked: one mole of product, elements in standard states, fractional coefficients allowed. For NH₃(g): ½ N₂(g) + 3/2 H₂(g) → NH₃(g), ΔH°f = −45.9 kJ/mol.

**Try it.** Calculate ΔH° for 2 SO₂(g) + O₂(g) → 2 SO₃(g).
*Answer:* 2(−395.7) − [2(−296.8) + 0] = −791.4 + 593.6 = −197.8 kJ.

## Hess's law (6.9)

Enthalpy is a state function: the ΔH from reactants to products is the same by any route, direct or through intermediates. So if you can write a target reaction as the sum of reactions whose ΔH values you know, add their ΔH values. The only manipulations allowed are the two from week 21: multiply an equation (and its ΔH) by a factor, and reverse an equation (changing the sign of its ΔH).

**Method.** (1) Find each target species in the given equations. (2) Arrange each given equation so the target species is on the correct side with the correct coefficient (reverse, scale). (3) Add; species appearing on both sides cancel. (4) Add the ΔH values.

**Worked example.** Find ΔH for C(s) + ½ O₂(g) → CO(g), given
(1) C(s) + O₂(g) → CO₂(g), ΔH = −393.5 kJ
(2) CO(g) + ½ O₂(g) → CO₂(g), ΔH = −283.0 kJ
CO is a product in the target but a reactant in (2): reverse (2) → CO₂ → CO + ½ O₂, ΔH = +283.0. Keep (1). Add: C + O₂ + CO₂ → CO₂ + CO + ½ O₂; cancel CO₂ and ½ O₂: C + ½ O₂ → CO. ΔH = −393.5 + 283.0 = **−110.5 kJ**, which is ΔH°f of CO (and a reaction that cannot be measured directly, because burning carbon always makes some CO₂).

**Worked example.** Find ΔH for 2 NO(g) + O₂(g) → 2 NO₂(g), given
(1) N₂(g) + O₂(g) → 2 NO(g), ΔH = +180.6 kJ
(2) N₂(g) + 2 O₂(g) → 2 NO₂(g), ΔH = +66.4 kJ
Reverse (1): 2 NO → N₂ + O₂, ΔH = −180.6. Add (2): N₂ + 2 O₂ → 2 NO₂, +66.4. Sum: 2 NO + O₂ → 2 NO₂, ΔH = **−114.2 kJ**.

Energy-diagram picture: draw N₂ + 2 O₂ at 0, 2 NO + O₂ at +180.6, 2 NO₂ at +66.4; the drop from the middle level to the top one is −114.2 regardless of which path you trace.

**Try it.** Given H₂ + ½ O₂ → H₂O(l), ΔH = −285.8 kJ, and H₂O₂(l) → H₂O(l) + ½ O₂, ΔH = −98.0 kJ, find ΔH for H₂ + O₂ → H₂O₂(l).
*Answer:* Reverse the second: H₂O + ½ O₂ → H₂O₂, +98.0. Add the first: H₂ + ½ O₂ → H₂O, −285.8. Sum: H₂ + O₂ → H₂O₂, ΔH = −187.8 kJ.

## Choosing the method

| You are given | Use | Exactness |
|---|---|---|
| Bond enthalpies, gas-phase reaction | Σ broken − Σ formed | Estimate (averages) |
| A table of ΔH°f | Σ products − Σ reactants, with coefficients | Exact for standard conditions |
| Other reactions with their ΔH | Hess's law: scale, reverse, add | Exact |
| A calorimeter | q = mcΔT, then per mole | Measured |

Watch the phase: ΔH°f(H₂O(l)) = −285.8 but ΔH°f(H₂O(g)) = −241.8; the 44.0 kJ difference is the enthalpy of vaporisation. A combustion with liquid water is more exothermic than with steam.

## Common mistakes

- Reversing the bond-enthalpy formula (formed − broken) or the formation formula (reactants − products). Check the sign with chemistry: combustion must come out negative.
- Counting bonds from the formula instead of the structure (CO₂ has two C=O, not four C–O; O₂ has one O=O).
- Forgetting the coefficient n in Σ n ΔH°f, or forgetting that elements in their standard states contribute zero.
- Using O(g) or H(g) as "the element"; the standard states are O₂(g) and H₂(g).
- Scaling an equation in Hess's law without scaling its ΔH, or reversing it without changing the sign.
- Applying bond enthalpies to liquids or solids without the phase-change enthalpies.
- Mixing H₂O(l) and H₂O(g) values.

## Where this goes next

Unit 7 (equilibrium) uses the sign of ΔH to predict how K changes with temperature (Le Châtelier). Unit 9 combines ΔH° with ΔS° in ΔG° = ΔH° − TΔS°, using tables of ΔH°f and S° in exactly the Σ products − Σ reactants form you practised here, and bond enthalpies return in reasoning about which products are favoured.

## Self-check

1. Estimate ΔH for C₂H₄(g) + H₂(g) → C₂H₆(g) using bond enthalpies (C=C 614, H–H 436, C–C 347, C–H 413).
2. Write the formation equation for C₂H₅OH(l).
3. Calculate ΔH° for CaCO₃(s) → CaO(s) + CO₂(g).
4. Given 2 H₂ + O₂ → 2 H₂O(g), ΔH = −483.6 kJ, and 2 H₂ + O₂ → 2 H₂O(l), ΔH = −571.6 kJ, find ΔH for H₂O(l) → H₂O(g).
5. Why is ΔH°f of O₃(g) positive (+142.7 kJ/mol) while ΔH°f of O₂(g) is zero?

*Answers:* (1) Broken: C=C 614 + H–H 436 = 1,050 (the four C–H in ethene survive); formed: C–C 347 + 2 C–H 826 = 1,173; ΔH ≈ −123 kJ (accepted −137). (2) 2 C(s, graphite) + 3 H₂(g) + ½ O₂(g) → C₂H₅OH(l). (3) (−635.1) + (−393.5) − (−1,206.9) = +178.3 kJ. (4) Reverse the second and halve both: ½(−483.6) − ½(−571.6) = −241.8 + 285.8 = +44.0 kJ. (5) O₂ is the standard state of oxygen, so its ΔH°f is zero by definition; ozone lies above O₂ in enthalpy, so forming it from O₂ absorbs energy.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 6.7–6.9). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
