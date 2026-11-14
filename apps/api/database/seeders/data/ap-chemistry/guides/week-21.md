# Week 21 · Calorimetry, Phase Changes and Enthalpy of Reaction

**Topics:** 6.4 Heat Capacity and Calorimetry · 6.5 Energy of Phase Changes · 6.6 Introduction to Enthalpy of Reaction
**Practices:** 2 (Question and Method), 3 (Representing Data and Phenomena), 5 (Mathematical Routines), 6 (Argumentation)
**Spiral:** q = mcΔT and heat conservation (6.3) are the engine of every calorimetry calculation; moles and molar mass (1.1), molarity (3.7) and limiting reactants (4.5) convert the heat measured into a ΔH per mole; intermolecular forces (3.1, 3.3) explain the size of enthalpies of fusion and vaporisation; neutralisation (4.8) is the standard calorimetry reaction.

## What you need to be able to do

- **6.4** Use q = mcΔT (and q = C_cal ΔT for a calorimeter with a known heat capacity) to calculate the heat absorbed or released in a calorimeter, relate that heat to the reaction (q_reaction = −q_solution), and convert it into an enthalpy change per mole of a reactant or product; explain the assumptions of a coffee-cup calorimeter.
- **6.5** Explain that during a phase change at constant temperature the energy absorbed or released changes potential energy (particle separation), not kinetic energy; use q = n ΔH_fus and q = n ΔH_vap; interpret a heating curve and calculate the total heat for a multi-stage change.
- **6.6** Interpret ΔH_rxn as the heat per mole of reaction as written (a stoichiometric quantity), scale it with the amount of reactant actually consumed, reverse its sign for the reverse reaction, and write thermochemical equations with ΔH or with heat as a term.

## Key terms

| Term | Meaning |
|---|---|
| Calorimeter | An insulated container in which a process happens and the temperature change of a known mass of water (or solution) is measured. |
| Coffee-cup calorimeter | Nested foam cups, open to the air: constant pressure, so q = ΔH; assumes negligible heat loss and that the solution has water's density and specific heat. |
| Bomb calorimeter | A sealed steel vessel in a water bath for combustion; constant volume; the whole assembly has a heat capacity C_cal in J/°C. |
| Heat capacity, C | Heat needed to raise an object by 1 °C (J/°C); C = m c for a pure substance. |
| Molar enthalpy of fusion, ΔH_fus | Heat to melt one mole at its melting point. Water: 6.01 kJ/mol. |
| Molar enthalpy of vaporisation, ΔH_vap | Heat to boil one mole at its boiling point. Water: 40.7 kJ/mol. |
| Heating curve | Temperature against heat added: sloped segments (one phase warming) and flat plateaus (phase change). |
| Enthalpy of reaction, ΔH_rxn | Heat absorbed or released at constant pressure for the molar amounts in the balanced equation. |
| Thermochemical equation | A balanced equation with ΔH attached, or with heat written as a reactant or product. |

## Calorimetry (6.4)

A calorimeter turns a reaction's heat into a measurable temperature change of water. The logic is always the same three lines:

1. **Heat gained by the water or solution:** q_solution = m c ΔT (m is the mass of the solution, c is usually taken as 4.184 J/(g·°C), ΔT is its rise or fall).
2. **Heat of the reaction:** q_reaction = −q_solution. The reaction and the water are the two halves of an insulated system, so what one loses the other gains. If the water warms, the reaction was exothermic and q_reaction is negative.
3. **Per mole:** ΔH = q_reaction / (moles of the limiting reactant, or moles of reaction as written). Convert J to kJ.

For a bomb calorimeter the first line becomes q_cal = C_cal ΔT, where C_cal (J/°C) is the heat capacity of the whole apparatus, found beforehand by burning a substance of known heat of combustion.

**Worked example (neutralisation).** 50.0 mL of 1.00 M HCl at 22.0 °C is mixed with 50.0 mL of 1.00 M NaOH at 22.0 °C in a coffee-cup calorimeter. The temperature rises to 28.8 °C. Find ΔH for H⁺(aq) + OH⁻(aq) → H₂O(l).
Mass of solution ≈ 100.0 g (density 1.00 g/mL). q_solution = 100.0 × 4.184 × (28.8 − 22.0) = 100.0 × 4.184 × 6.8 = 2,845 J.
q_reaction = −2,845 J.
Moles of water formed: 0.0500 L × 1.00 M = 0.0500 mol (acid and base are equal, neither limits).
ΔH = −2,845 J / 0.0500 mol = −56,900 J/mol = **−56.9 kJ/mol**. (The accepted value is about −57 kJ/mol; heat lost to the cups makes measured values slightly small.)

**Worked example (dissolving).** 5.00 g of NH₄NO₃ (80.04 g/mol) dissolves in 100.0 g of water in a calorimeter; the temperature falls from 23.0 °C to 19.2 °C. Find ΔH_solution per mole.
q_solution = (100.0 + 5.00) g × 4.184 × (19.2 − 23.0) = 105.0 × 4.184 × (−3.8) = −1,669 J. (The solution lost heat.)
q_dissolving = +1,669 J. Moles = 5.00/80.04 = 0.0625 mol. ΔH = 1,669/0.0625 = 26,700 J/mol = **+26.7 kJ/mol**, endothermic.

**Worked example (bomb calorimeter).** Burning 1.50 g of a food sample in a bomb calorimeter with C_cal = 9.50 kJ/°C raises the temperature by 2.40 °C. Heat released = 9.50 × 2.40 = 22.8 kJ, so 15.2 kJ per gram.

**Assumptions to be able to state:** no heat exchange with the room; the cup's own heat capacity is negligible (or is included in C_cal); the solution has the density and specific heat of water; the reaction goes to completion quickly; the thermometer reads the solution's temperature at the moment of maximum change (a temperature–time graph is extrapolated back to the mixing time to correct for cooling).

**Try it.** 25.0 g of a salt dissolves in 100.0 g of water; the temperature rises 4.2 °C. Find q for the dissolving.
*Answer:* q_solution = 125.0 × 4.184 × 4.2 = 2,197 J, so q_dissolving = −2.20 kJ (exothermic).

## Energy of phase changes (6.5)

During melting or boiling the temperature does not change, so the kinetic energy of the particles does not change; the heat goes entirely into **potential energy**, pulling particles apart against their attractions. That is why a plateau appears on a heating curve: heat is being added, but the thermometer is still. The reverse (freezing, condensing) releases the same heat at the same temperature.

| Water | Value | Use |
|---|---|---|
| ΔH_fus | 6.01 kJ/mol (334 J/g) | q = n ΔH_fus at 0 °C |
| ΔH_vap | 40.7 kJ/mol (2,260 J/g) | q = n ΔH_vap at 100 °C |
| c (ice) | 2.09 J/(g·°C) | warming solid |
| c (liquid) | 4.184 J/(g·°C) | warming liquid |
| c (steam) | 2.01 J/(g·°C) | warming gas |

ΔH_vap is much larger than ΔH_fus because boiling separates molecules completely (every hydrogen bond broken, large volume change), while melting only loosens the lattice. Substances with stronger intermolecular forces have larger values: water's ΔH_vap (40.7 kJ/mol) dwarfs methane's (8.2 kJ/mol) because of hydrogen bonding.

**Worked example (heating curve).** How much heat converts 20.0 g of ice at −10.0 °C to steam at 100.0 °C? (Molar mass of water 18.02 g/mol; n = 20.0/18.02 = 1.110 mol.)
1. Warm ice −10.0 → 0.0 °C: 20.0 × 2.09 × 10.0 = 418 J.
2. Melt at 0 °C: 1.110 × 6,010 = 6,671 J.
3. Warm water 0.0 → 100.0 °C: 20.0 × 4.184 × 100.0 = 8,368 J.
4. Boil at 100 °C: 1.110 × 40,700 = 45,177 J.
Total = 418 + 6,671 + 8,368 + 45,177 = 60,634 J ≈ **60.6 kJ**. Notice that boiling takes three quarters of the total.

Graph description of a heating curve: temperature on the vertical axis, heat added on the horizontal; a short rising segment (ice), a short flat plateau at 0 °C (melting), a longer rising segment (water), a long plateau at 100 °C (boiling), then a rising segment (steam). The plateau lengths are proportional to ΔH_fus and ΔH_vap; the slopes are inversely proportional to the specific heats (ice and steam warm about twice as fast as liquid water per joule).

**Try it.** How much heat is released when 36.0 g of steam at 100 °C condenses to water at 100 °C?
*Answer:* n = 2.00 mol; q = −2.00 × 40.7 = −81.4 kJ.

## Enthalpy of reaction as a stoichiometric quantity (6.6)

A thermochemical equation ties ΔH to the molar amounts written:

CH₄(g) + 2 O₂(g) → CO₂(g) + 2 H₂O(l)    ΔH = −890 kJ

This says 890 kJ are released when 1 mol CH₄ reacts with 2 mol O₂ to give 1 mol CO₂ and 2 mol H₂O. The same information can be written with heat as a product: CH₄ + 2 O₂ → CO₂ + 2 H₂O + 890 kJ. An endothermic reaction puts the heat on the left: N₂ + O₂ + 180 kJ → 2 NO, or ΔH = +180 kJ.

Three rules follow:

- **Scaling.** Double the equation, double ΔH. Burning 0.250 mol CH₄ releases 0.250 × 890 = 222 kJ.
- **Reversing.** Reverse the equation, change the sign. 2 H₂O(l) → 2 H₂(g) + O₂(g) has ΔH = +572 kJ because the forward reaction has −572 kJ.
- **Per mole of what?** State it. "ΔH = −890 kJ per mole of methane" or "−445 kJ per mole of water formed". When the equation is 2 H₂ + O₂ → 2 H₂O, ΔH = −572 kJ "per mole of reaction", which is −286 kJ per mole of water.

**Worked example.** 2 Al(s) + Fe₂O₃(s) → Al₂O₃(s) + 2 Fe(s), ΔH = −852 kJ. How much heat is released when 10.0 g of Al (26.98 g/mol) reacts with excess Fe₂O₃?
n(Al) = 10.0/26.98 = 0.371 mol. The equation releases 852 kJ per 2 mol Al, that is 426 kJ per mol Al. q = 0.371 × 426 = **158 kJ released** (q = −158 kJ).

**Worked example (limiting reactant).** 0.40 mol of H₂ and 0.30 mol of O₂ react: 2 H₂ + O₂ → 2 H₂O(l), ΔH = −572 kJ. H₂ needs only 0.20 mol O₂, so H₂ limits. Heat = 0.40 mol H₂ × (572 kJ / 2 mol H₂) = **114 kJ released**.

**Try it.** For N₂(g) + 3 H₂(g) → 2 NH₃(g), ΔH = −92 kJ, how much heat is released when 3.40 g of NH₃ (17.03 g/mol) forms?
*Answer:* n = 0.200 mol NH₃; 92 kJ per 2 mol NH₃ = 46 kJ/mol; q = −9.2 kJ, so 9.2 kJ released.

## Common mistakes

- Using the mass of only the solute, or only the water, for q = mcΔT; the solution's mass (water plus solute, or both solutions) is what warms.
- Forgetting q_reaction = −q_solution: a temperature rise means the reaction is exothermic and ΔH is negative.
- Dividing by the moles of the excess reactant instead of the limiting one.
- Including a temperature change in q = n ΔH_fus; the temperature is constant during a phase change, and these formulas have no ΔT.
- Using 4.184 J/(g·°C) for ice or steam.
- Treating ΔH = −890 kJ as "per gram" or "per reaction regardless of amount"; it belongs to the molar amounts written.
- Forgetting to change the sign when reversing an equation or to scale ΔH when multiplying it.

## Where this goes next

Week 22 gives three ways to calculate ΔH without a calorimeter: bond enthalpies (approximate, gas phase), standard enthalpies of formation (exact, tabulated) and Hess's law (adding equations). The calorimetry skills here also measure ΔH of solution and ΔH of fusion in the lab. In Unit 9, ΔH joins ΔS in ΔG = ΔH − TΔS, and the enthalpy of vaporisation appears again in ΔS_vap = ΔH_vap/T_b.

## Self-check

1. 2.00 g of KOH (56.11 g/mol) dissolves in 100.0 g of water and the temperature rises 4.8 °C. Find ΔH_solution in kJ/mol.
2. How much heat is needed to melt 54.0 g of ice at 0 °C? (ΔH_fus = 6.01 kJ/mol)
3. For C₃H₈(g) + 5 O₂(g) → 3 CO₂(g) + 4 H₂O(l), ΔH = −2,220 kJ, how much heat is released by burning 11.0 g of propane (44.10 g/mol)?
4. Why does a heating curve have flat regions?
5. A bomb calorimeter with C_cal = 6.20 kJ/°C rises 3.50 °C when 1.00 g of a fuel burns. Heat released per gram?

*Answers:* (1) q_soln = 102.0 × 4.184 × 4.8 = 2,048 J; q = −2,048 J; n = 0.03564 mol; ΔH = −57.5 kJ/mol. (2) n = 3.00 mol; q = 18.0 kJ. (3) n = 0.2494 mol; q = 0.2494 × 2,220 = 554 kJ released. (4) Heat added goes into potential energy (separating particles) rather than kinetic energy, so the temperature is constant during a phase change. (5) 6.20 × 3.50 = 21.7 kJ/g.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 6.4–6.6). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
