# Week 25 · Le Châtelier's Principle and Solubility Equilibria

**Topics:** 7.9 Introduction to Le Châtelier's Principle · 7.10 Reaction Quotient and Le Châtelier's Principle · 7.11 Introduction to Solubility Equilibria
**Practices:** 1 (Models and Representations), 3 (Representing Data and Phenomena), 4 (Model Analysis), 5 (Mathematical Routines), 6 (Argumentation)
**Spiral:** Q versus K (7.3, 7.4) is the engine behind every shift this week; the sign of ΔH (6.1, 6.6) decides the temperature response; the ideal gas law (3.4) explains why volume changes partial pressures; dissolution and ionic compounds (3.8, 4.2 net ionic equations) set up Ksp; the small-x approximation (7.7) is the standard tool for Ksp calculations.

## What you need to be able to do

- **7.9** Predict qualitatively how a system at equilibrium responds to a change in concentration, pressure (via volume), or temperature, and to the addition of a catalyst or an inert gas.
- **7.10** Explain every one of those responses by comparing Q with K: a disturbance either changes Q (concentration, volume) so that Q ≠ K, or changes K itself (temperature); the system then moves in the direction that restores Q = K.
- **7.11** Write the solubility-product expression Ksp for a sparingly soluble salt, calculate Ksp from molar solubility and molar solubility from Ksp (including salts with 1:2 and 2:1 ion ratios), and decide whether a precipitate forms by comparing Q with Ksp.

## Key terms

| Term | Meaning |
|---|---|
| Le Châtelier's principle | A system at equilibrium that is disturbed responds in the direction that partly counteracts the disturbance. |
| Shift (right / left) | A net forward (toward products) or net reverse (toward reactants) reaction that re-establishes Q = K. |
| Stress | A change in concentration, volume/pressure or temperature imposed on a system at equilibrium. |
| Ksp | The equilibrium constant for a solid dissolving into its ions; the solid itself is omitted. |
| Molar solubility (s) | Moles of the solid that dissolve per litre of saturated solution. |
| Saturated | A solution in equilibrium with excess solid: Q = Ksp. |
| Precipitation criterion | A solid forms when Q > Ksp; the solution is unsaturated when Q < Ksp. |

## Le Châtelier's principle as a prediction tool (7.9)

The principle is a shortcut; it works because of Q and K, and you should always be able to give the Q/K reason (next section). The standard disturbances:

| Disturbance | Response |
|---|---|
| Add a reactant | shift right (consume some of the added reactant) |
| Add a product | shift left |
| Remove a product | shift right (this is how industry drives reactions to completion) |
| Decrease volume (increase total pressure) | shift to the side with fewer moles of gas |
| Increase volume | shift to the side with more moles of gas |
| Raise temperature | shift in the endothermic direction (absorbs the added heat) |
| Lower temperature | shift in the exothermic direction |
| Add a catalyst | no shift; equilibrium is reached faster |
| Add an inert gas at constant volume | no shift |
| Add an inert gas at constant pressure | the volume increases, so shift toward more moles of gas |

The temperature rule is easiest if you write heat into the equation. For an exothermic reaction, N₂ + 3 H₂ ⇌ 2 NH₃ + heat, raising the temperature is "adding a product", so the system shifts left. For an endothermic reaction, heat + CaCO₃ ⇌ CaO + CO₂, heating shifts right.

**Worked example.** Methanol is made by CO(g) + 2 H₂(g) ⇌ CH₃OH(g), ΔH° = −91 kJ/mol. State the effect on the equilibrium amount of methanol of (a) adding H₂, (b) removing CH₃OH as it forms, (c) compressing the mixture, (d) raising the temperature, (e) adding a catalyst.
(a) More methanol (shift right). (b) More methanol is made to replace what is removed (shift right). (c) Three moles of gas on the left, one on the right: compressing shifts right, more methanol. (d) Exothermic: heating shifts left, less methanol. (e) No change in amount; it forms faster. Industry therefore uses high pressure, a moderate temperature (a compromise between yield and rate) and a catalyst.

The classic laboratory demonstration is the cobalt(II) equilibrium: [Co(H₂O)₆]²⁺(aq, pink) + 4 Cl⁻(aq) ⇌ [CoCl₄]²⁻(aq, blue) + 6 H₂O(l), which is endothermic. Adding concentrated HCl turns the solution blue (added Cl⁻, shift right); adding water turns it pink (dilution lowers [Cl⁻] far more than it affects the other terms, so Q rises above K and the equilibrium shifts left); warming it turns it blue (endothermic, heat shifts right); cooling it in ice turns it pink.

**Try it.** For 2 SO₂(g) + O₂(g) ⇌ 2 SO₃(g), ΔH° < 0, predict the effect on [SO₃] of (a) adding O₂, (b) doubling the container volume, (c) lowering the temperature, (d) adding argon at constant volume.
*Answer:* (a) increases; (b) decreases (3 mol gas → 2 mol gas, so expansion shifts left); (c) increases (exothermic, cooling shifts right); (d) no change.

## Why the principle works: Q versus K (7.10)

The AP exam increasingly asks "explain using Q and K", not "state Le Châtelier". The logic:

1. At equilibrium, Q = K.
2. A disturbance in concentration or volume changes the concentrations (or partial pressures) **instantaneously**, so Q changes while K does not. Now Q ≠ K.
3. If Q < K, the forward reaction proceeds (products form) until Q rises back to K. If Q > K, the reverse reaction proceeds until Q falls to K.
4. A temperature change leaves the concentrations unchanged at first but changes **K** (K rises with temperature for an endothermic reaction, falls for an exothermic one). Now Q ≠ K for the opposite reason, and the system moves toward the new K.

**Worked example (adding a reactant).** For A + B ⇌ C with K = 10, an equilibrium mixture has [A] = 0.10, [B] = 0.10, [C] = 0.10 M (Q = 0.10/0.010 = 10 = K). Add A to make [A] = 0.30 M. Now Q = 0.10/(0.30 × 0.10) = 3.3 < K, so the forward reaction proceeds: [A] and [B] fall, [C] rises, until Q = 10 again. Note that the final [A] is higher than 0.10 M but lower than 0.30 M: the shift counteracts the change only partly.

**Worked example (volume change).** For N₂O₄(g) ⇌ 2 NO₂(g), halve the volume. Every concentration doubles, so Q = (2[NO₂])²/(2[N₂O₄]) = 2 × (old Q) = 2K > K. The reverse reaction proceeds: NO₂ pairs up into N₂O₄, reducing the number of gas molecules. That is the "shift toward fewer moles of gas" rule, derived.

For a reaction with equal numbers of gas moles on each side (H₂ + I₂ ⇌ 2 HI, Δn = 0), doubling every concentration leaves Q unchanged (the factors cancel), so there is no shift. Le Châtelier's principle says the same thing in words: there is no side with "fewer moles" to shift toward.

**Worked example (inert gas).** Add argon at constant volume: the partial pressures of the reacting gases are unchanged, Q is unchanged, no shift. Add argon at constant pressure: the container must expand to keep the total pressure fixed, every reacting gas's partial pressure drops, and the effect is that of a volume increase.

**Worked example (temperature).** For the endothermic reaction N₂O₄ ⇌ 2 NO₂, K is 0.046 at 298 K and about 0.60 at 325 K. Warming an equilibrium mixture from 298 to 325 K leaves the concentrations momentarily unchanged, so Q = 0.046 < new K = 0.60; the forward reaction proceeds and the gas turns darker brown. This is the only disturbance that changes K.

**Try it.** An equilibrium mixture for PCl₅ ⇌ PCl₃ + Cl₂ in a 2.0 L flask has 0.20 mol of each gas (K = 0.10 in molarity units). The flask is expanded to 4.0 L. Calculate Q immediately after the expansion and state the direction of the net reaction.
*Answer:* Before: [each] = 0.10 M, Q = 0.10 × 0.10/0.10 = 0.10 = K. After: [each] = 0.050 M, Q = 0.050 × 0.050/0.050 = 0.050 < K. Forward: more PCl₅ dissociates (toward the side with more gas moles).

## Solubility equilibria (7.11)

A "slightly soluble" or "insoluble" ionic solid dissolves until the solution is saturated: solid and dissolved ions are in dynamic equilibrium. For example:
AgCl(s) ⇌ Ag⁺(aq) + Cl⁻(aq), Ksp = [Ag⁺][Cl⁻] = 1.8 × 10⁻¹⁰ at 25 °C
The solid is omitted (its concentration is constant), so Ksp contains only ion concentrations, raised to their coefficients:
Ca(OH)₂(s) ⇌ Ca²⁺(aq) + 2 OH⁻(aq), Ksp = [Ca²⁺][OH⁻]²
Ag₂CrO₄(s) ⇌ 2 Ag⁺(aq) + CrO₄²⁻(aq), Ksp = [Ag⁺]²[CrO₄²⁻]

**From molar solubility to Ksp.** Molar solubility s is the number of moles of solid that dissolve per litre. Each formula unit of the solid supplies its ions in the stoichiometric ratio, so for AgCl, [Ag⁺] = [Cl⁻] = s and Ksp = s². For Ca(OH)₂, [Ca²⁺] = s and [OH⁻] = 2s, so Ksp = s(2s)² = 4s³. For Ag₂CrO₄, Ksp = (2s)²(s) = 4s³ too. For a 1:3 salt such as Fe(OH)₃, Ksp = s(3s)³ = 27s⁴.

**Worked example.** The molar solubility of Ca(OH)₂ at 25 °C is 0.011 M. Find Ksp.
Ksp = 4s³ = 4(0.011)³ = 4 × 1.33 × 10⁻⁶ = **5.3 × 10⁻⁶**.

**From Ksp to molar solubility.** Reverse the algebra. For AgCl, s = √Ksp = √(1.8 × 10⁻¹⁰) = 1.3 × 10⁻⁵ M. For a 1:2 salt, s = ∛(Ksp/4).

**Worked example.** Ksp for PbI₂ is 9.8 × 10⁻⁹. Find the molar solubility and the mass of PbI₂ (461 g/mol) that dissolves in 500. mL.
Ksp = 4s³ → s³ = 2.45 × 10⁻⁹ → s = 1.35 × 10⁻³ M. In 0.500 L: 6.7 × 10⁻⁴ mol × 461 g/mol = **0.31 g**.

**Comparing solubilities.** You may compare Ksp values directly only for salts with the same ion ratio. AgCl (1.8 × 10⁻¹⁰, s = 1.3 × 10⁻⁵) is *less* soluble by moles than Ag₂CrO₄ (Ksp = 1.1 × 10⁻¹², s = ∛(2.75 × 10⁻¹³) = 6.5 × 10⁻⁵ M) even though its Ksp is larger, because of the different exponents.

**Will a precipitate form?** Compute Q (sometimes written Qsp or the ion product) from the concentrations *immediately after mixing* (account for dilution!) and compare with Ksp. Q > Ksp: precipitate forms until Q = Ksp. Q < Ksp: no precipitate; the solution is unsaturated. Q = Ksp: exactly saturated.

**Worked example.** 50.0 mL of 1.0 × 10⁻³ M AgNO₃ is mixed with 50.0 mL of 1.0 × 10⁻⁴ M NaCl. Does AgCl precipitate?
After mixing (total 100.0 mL), [Ag⁺] = 5.0 × 10⁻⁴ M and [Cl⁻] = 5.0 × 10⁻⁵ M. Q = (5.0 × 10⁻⁴)(5.0 × 10⁻⁵) = 2.5 × 10⁻⁸ > 1.8 × 10⁻¹⁰, so **yes**, AgCl precipitates.

Le Châtelier applies to Ksp equilibria too, which is next week: adding one of the ions shifts the equilibrium toward the solid (common-ion effect), and removing an ion by reaction (an acid consuming OH⁻ or CO₃²⁻) dissolves more solid.

**Try it.** Ksp for BaSO₄ is 1.1 × 10⁻¹⁰. (a) Find its molar solubility. (b) Will BaSO₄ precipitate when equal volumes of 2.0 × 10⁻⁴ M BaCl₂ and 2.0 × 10⁻⁴ M Na₂SO₄ are mixed?
*Answer:* (a) s = √(1.1 × 10⁻¹⁰) = 1.0 × 10⁻⁵ M. (b) After mixing each is 1.0 × 10⁻⁴ M; Q = 1.0 × 10⁻⁸ > Ksp, so yes.

## Common mistakes

- Saying a catalyst shifts the equilibrium. It changes the rate only, equally in both directions.
- Treating "add an inert gas" as a pressure increase that shifts the equilibrium; at constant volume nothing happens.
- Forgetting that a volume change has no effect when Δn(gas) = 0, and that solids and liquids do not count as gas moles.
- Getting the temperature direction backwards: write heat as a reactant (endothermic) or product (exothermic) and treat it like any other species.
- Claiming that a temperature change changes Q; it changes K.
- Writing the solid's concentration into Ksp.
- Forgetting the 2s and its square for a 1:2 salt (Ksp = 4s³, not s²).
- Comparing Ksp values of salts with different ion ratios as if they were solubilities.
- Not halving concentrations when equal volumes are mixed before computing Q for precipitation.

## Where this goes next

Week 26 finishes the unit with the common-ion effect, the effect of pH on solubility (basic anions dissolve in acid) and the thermodynamics of dissolving (ΔG° = −RT ln K, previewing unit 9). Unit 8 is the biggest application of the Q/K logic: acid–base equilibria, buffers (which are the common-ion effect for weak acids) and titrations. Unit 9 derives the temperature dependence of K from ΔG° = ΔH° − TΔS°.

## Self-check

1. For the endothermic reaction 2 HI(g) ⇌ H₂(g) + I₂(g), which of these increase the amount of H₂ at equilibrium: raising T; adding HI; compressing; adding a catalyst?
2. Why does decreasing the volume shift N₂ + 3 H₂ ⇌ 2 NH₃ to the right? Answer with Q.
3. Does a temperature change alter Q or K?
4. Write Ksp for Mg(OH)₂, and relate it to the molar solubility.
5. Ksp for CaF₂ is 3.5 × 10⁻¹¹. Find its molar solubility.

*Answers:* (1) Raising T (endothermic) and adding HI increase H₂; compressing has no effect (Δn = 0); the catalyst has no effect. (2) Halving the volume doubles every concentration: Q = (2[NH₃])²/((2[N₂])(2[H₂])³) = 4/16 × old Q = K/4 < K, so the forward reaction proceeds. (3) K. (4) Ksp = [Mg²⁺][OH⁻]² = s(2s)² = 4s³. (5) s = ∛(3.5 × 10⁻¹¹/4) = ∛(8.75 × 10⁻¹²) = 2.1 × 10⁻⁴ M.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 7.9–7.11). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
