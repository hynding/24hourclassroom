# Week 26 · Hess's Law and Enthalpies of Formation

**Topics:** 7.3 Hess's Law and Enthalpies of Formation
**Practices:** 2 (Developing and Using Models), 5 (Using Mathematics and Computational Thinking), 7 (Engaging in Argument from Evidence)
**Spiral:** Everything this week rests on last week's definition of ΔH and thermochemical equations (7.1) and on calorimetry (7.2), which is where the numbers in a table of enthalpies come from. Bond energies were introduced with covalent bonding (3.3). Scaling a ΔH to a given mass of reactant is unit 4 stoichiometry (4.4, 4.6), and the equations you manipulate must be balanced (4.1).

## What you need to be able to do

- **7.3** Explain why enthalpy is a state function and state Hess's law; manipulate thermochemical equations (reverse, multiply, add) to find the ΔH of a target reaction from two or three given reactions; define the standard enthalpy of formation and explain why an element in its standard state has ΔH°f = 0; calculate ΔH°rxn from a table of ΔH°f values with the products-minus-reactants equation, including the coefficients; estimate ΔH from average bond energies as bonds broken minus bonds formed; and compare the three methods, saying which is exact and which is an estimate.

## Key terms

| Term | Meaning |
| --- | --- |
| State function | A quantity that depends only on the present state of a system, not on the path taken to reach it. Enthalpy, temperature and pressure are state functions; heat and work are not. |
| Hess's law | If a reaction can be written as the sum of two or more steps, its ΔH is the sum of the ΔH values of those steps. |
| Standard state | The pure form of a substance at 1 bar (about 1 atm) and, by convention in this course, 25 °C. For an element, its most stable form: O₂(g), N₂(g), C(graphite), Br₂(l), Hg(l), Na(s). |
| Standard enthalpy of formation, ΔH°f | The enthalpy change when one mole of a compound forms from its elements in their standard states. Units kJ/mol. Zero for any element in its standard state. |
| Formation equation | A balanced equation with exactly one mole of product on the right and only elements in standard states on the left. Fractional coefficients are allowed and often needed. |
| Average bond energy | The average energy needed to break one mole of a given bond in the gas phase, in kJ/mol. Always positive: breaking bonds costs energy. |
| Bonds broken minus bonds formed | ΔH ≈ Σ(energies of bonds broken) − Σ(energies of bonds formed). An estimate, because the table values are averages across many molecules. |
| Products minus reactants | ΔH°rxn = Σ n·ΔH°f(products) − Σ n·ΔH°f(reactants), with n the coefficient of each substance. Exact for standard conditions. |

## 1. Why a path does not matter

Climb a hill by the steep path or the winding path: you arrive at the same height, and your change in altitude is the same. Enthalpy behaves the same way. The enthalpy of a system is fixed by what it is, how much there is, and its temperature and pressure. So the change in enthalpy between a set of reactants and a set of products is fixed too, regardless of whether the reaction happened in one step, in five, or through an intermediate nobody can isolate.

That property is what makes enthalpy a **state function**, and it has a practical consequence called **Hess's law**: if you can write a target reaction as the sum of reactions whose ΔH values you know, the target's ΔH is the sum of theirs. The reactions you add may be impossible to run cleanly in a lab. It does not matter. Only the beginning and the end count.

Hess's law is the reason thermochemistry tables are so compact. Nobody has measured the ΔH of every possible reaction; instead, chemists measure a few thousand reactions carefully by calorimetry (7.2) and let Hess's law generate the rest.

## 2. Manipulating thermochemical equations

Three moves, each with a rule for what happens to ΔH:

1. **Reverse** an equation: change the sign of ΔH. If forming water releases 285.8 kJ per mole, decomposing water absorbs 285.8 kJ per mole.
2. **Multiply** an equation by a factor: multiply ΔH by the same factor. Doubling the coefficients doubles the heat; halving them halves it. Fractions are fine.
3. **Add** equations: add their ΔH values. When you add, any species that appears on the left of one equation and the right of another cancels, like an intermediate in a mechanism.

The skill is choosing the moves so that the sum is exactly the target. Work species by species: find a species that appears in the target and in only one of the given equations; arrange that equation so that species is on the correct side with the correct coefficient; then move to the next.

**Worked example.** Carbon monoxide is hard to make cleanly because some carbon always burns all the way to CO₂. Find ΔH for C(graphite) + ½O₂(g) → CO(g) using

- (A) C(graphite) + O₂(g) → CO₂(g), ΔH = −393.5 kJ
- (B) CO(g) + ½O₂(g) → CO₂(g), ΔH = −283.0 kJ

The target has C on the left: (A) already has it on the left, so keep (A) as written. The target has CO on the right: (B) has CO on the left, so reverse (B), which makes its ΔH +283.0 kJ. Now add:

C(graphite) + O₂(g) → CO₂(g)  −393.5 kJ
CO₂(g) → CO(g) + ½O₂(g)  +283.0 kJ

CO₂ cancels. On the left, O₂; on the right, ½O₂; net ½O₂ on the left. The sum is C(graphite) + ½O₂(g) → CO(g), ΔH = −393.5 + 283.0 = **−110.5 kJ**. That is the accepted standard enthalpy of formation of carbon monoxide, obtained from two reactions that are easy to measure.

**Try it.** Find ΔH for N₂(g) + 2O₂(g) → 2NO₂(g) from N₂(g) + O₂(g) → 2NO(g), ΔH = +182.6 kJ, and 2NO(g) + O₂(g) → 2NO₂(g), ΔH = −116.2 kJ. (Answer: no reversing or scaling is needed; NO cancels, and the sum is +66.4 kJ.)

## 3. Standard enthalpies of formation

A table of ΔH°f values is a table of Hess's law results, all written against the same reference point: the elements in their standard states. The **standard enthalpy of formation** of a compound is the ΔH for making exactly one mole of it from its elements as they exist at 1 bar and 25 °C. Two rules follow from the definition:

- An element in its standard state has ΔH°f = 0, because "forming" it from itself changes nothing. O₂(g) is 0; O₃(g), which is not the stable form, is +142.7 kJ/mol. C(graphite) is 0; C(diamond) is +1.9 kJ/mol.
- The formation equation always makes **one mole** of product, so the coefficients on the left are whatever that needs, fractions included: H₂(g) + ½O₂(g) → H₂O(l), ΔH°f = −285.8 kJ/mol.

Some values you will meet often (all in kJ/mol at 25 °C, rounded):

| Substance | ΔH°f | Substance | ΔH°f |
| --- | --- | --- | --- |
| H₂O(l) | −285.8 | CO₂(g) | −393.5 |
| H₂O(g) | −241.8 | CO(g) | −110.5 |
| CH₄(g) | −74.8 | NH₃(g) | −45.9 |
| C₃H₈(g) | −103.8 | NO(g) | +91.3 |
| C₂H₅OH(l) | −277.6 | NO₂(g) | +33.2 |
| SO₂(g) | −296.8 | SO₃(g) | −395.7 |
| NaCl(s) | −411.2 | CaCO₃(s) | −1,207.6 |
| CaO(s) | −635.1 | Fe₂O₃(s) | −824.2 |
| MgO(s) | −601.6 | HCl(g) | −92.3 |

Most values are negative: most compounds are more stable than the elements they came from, and heat was released on forming them. A positive ΔH°f (NO, NO₂, O₃) marks a compound that stores energy relative to its elements and tends to decompose, which is why nitrogen oxides are made only at the high temperatures of engines and lightning.

Notice that the phase matters. Liquid water and water vapour differ by 44.0 kJ/mol, which is the enthalpy of vaporisation you met with heating curves (5.5).

## 4. The products-minus-reactants equation

Since every ΔH°f is measured from the same starting line, the ΔH of any reaction between tabulated substances is the difference between where the products sit and where the reactants sit:

ΔH°rxn = Σ n·ΔH°f(products) − Σ n·ΔH°f(reactants)

The n are the coefficients from the balanced equation. The three errors students make are forgetting a coefficient, forgetting that an element is zero (and looking up a value for it anyway), and subtracting in the wrong order. The order is always products first.

**Worked example.** Find ΔH for the complete combustion of propane, C₃H₈(g) + 5O₂(g) → 3CO₂(g) + 4H₂O(l).

Products: 3(−393.5) + 4(−285.8) = −1,180.5 − 1,143.2 = −2,323.7 kJ.
Reactants: (−103.8) + 5(0) = −103.8 kJ.
ΔH°rxn = −2,323.7 − (−103.8) = **−2,219.9 kJ**, or −2,220 kJ per mole of propane, the value used last week for the heat of a propane burner.

Note what the equation does. It imagines taking the propane apart into graphite and hydrogen (that costs +103.8 kJ, the reverse of formation) and then forming three moles of CO₂ and four of water from those elements (that releases 2,323.7 kJ). Hess's law says the imaginary route gives the right answer.

**Try it.** Find ΔH for 2SO₂(g) + O₂(g) → 2SO₃(g), the step in sulfuric acid manufacture. (Answer: 2(−395.7) − [2(−296.8) + 0] = −791.4 + 593.6 = −197.8 kJ.)

## 5. Estimating ΔH from bond energies

When no table value exists, or when you want to see where the energy comes from, use the bond-energy model from unit 3. Breaking a bond costs its bond energy; forming a bond releases it. So:

ΔH ≈ Σ(bond energies of bonds broken) − Σ(bond energies of bonds formed)

Average bond energies (kJ/mol): H–H 436; O=O 498; O–H 463; C–H 413; C–C 347; C=C 614; C≡C 839; C–O 358; C=O 799 (in CO₂); N≡N 945; N–H 391; Cl–Cl 243; H–Cl 432.

**Worked example.** Estimate ΔH for H₂(g) + Cl₂(g) → 2HCl(g).

Bonds broken: one H–H (436) and one Cl–Cl (243) = 679 kJ.
Bonds formed: two H–Cl = 2 × 432 = 864 kJ.
ΔH ≈ 679 − 864 = **−185 kJ**. The products' bonds are stronger, so energy is released. The tabulated value, 2(−92.3) = −184.6 kJ, is almost the same.

**Worked example.** Estimate ΔH for CH₄(g) + 2O₂(g) → CO₂(g) + 2H₂O(g).

Broken: 4 C–H (4 × 413 = 1,652) + 2 O=O (2 × 498 = 996) = 2,648 kJ.
Formed: 2 C=O (2 × 799 = 1,598) + 4 O–H (4 × 463 = 1,852) = 3,450 kJ.
ΔH ≈ 2,648 − 3,450 = **−802 kJ**, against a table value of −802.3 kJ for gaseous water. Methane's combustion is exothermic because the four very strong O–H and two very strong C=O bonds release far more than it costs to break the C–H and O=O bonds.

Two cautions. First, the bond method requires every reactant and product to be a gas made of discrete molecules; it says nothing useful about NaCl(s) or about liquids, where intermolecular forces (3.6) add to the energy. Second, the values are averages: the C–H bond in methane is not exactly the C–H bond in ethanol. Expect the estimate to be within a few percent of the real value, not exact.

## 6. Which method when?

| You are given | Use | Result |
| --- | --- | --- |
| A set of reactions with known ΔH that can be combined | Hess's law | Exact (to the precision of the data) |
| A table of ΔH°f and a balanced equation | Products minus reactants | Exact at standard conditions |
| Lewis structures and a bond energy table | Bonds broken minus formed | Estimate, gas phase only |
| A temperature change in a calorimeter | q = mcΔT, then divide by moles (7.2) | Measurement with experimental error |

A question that gives you a bond energy table expects the estimate method. A question that asks for "the standard enthalpy change" and provides formation values expects products minus reactants. Reading the data provided tells you the method.

## Common mistakes

- **Forgetting to flip the sign** when reversing an equation, or flipping it when the equation was not reversed.
- **Not scaling ΔH** after multiplying an equation by 2 or ½.
- **Looking up a nonzero value for an element.** O₂(g), N₂(g), H₂(g), C(graphite) and metals are all zero. Only non-standard forms such as O₃ or C(diamond) have values.
- **Subtracting reactants minus products.** The sign comes out backwards and an exothermic reaction appears endothermic.
- **Dropping coefficients** in the products-minus-reactants sum, or using the coefficient of the wrong species.
- **Counting bonds wrongly** in the bond-energy method. Draw the Lewis structures (3.3). CO₂ has two C=O bonds; water has two O–H bonds; O₂ has one double bond.
- **Treating bond energies as exact.** They are averages, and the method applies only to gases.
- **Confusing ΔH°f with ΔH°rxn.** The first is for one mole of one compound from its elements; the second is for a reaction as written, with whatever coefficients it has.

## Where this goes next

Week 27 turns from how much energy a reaction releases to how fast it happens. The two questions are independent: the reaction with the most negative ΔH is not the fastest, and the energy diagram you drew last week gains an activation energy hump that collision theory explains. In unit 8, the formation and combustion enthalpies of hydrocarbons return when fuels are compared (8.6), and the enthalpy change of a redox reaction sets the voltage of a battery (8.3). On the final, this topic appears as Hess's law combinations, products-minus-reactants calculations with a supplied table, and bond-energy estimates.

## Self-check

1. If 2H₂O(l) → 2H₂(g) + O₂(g) has ΔH = +571.6 kJ, what is ΔH for H₂(g) + ½O₂(g) → H₂O(l)?
2. Why is ΔH°f of Br₂(l) zero but ΔH°f of Br₂(g) is +30.9 kJ/mol?
3. Write the formation equation for ethanol, C₂H₅OH(l).
4. Using the formation table, find ΔH for CaCO₃(s) → CaO(s) + CO₂(g).
5. Estimate ΔH for N₂(g) + 3H₂(g) → 2NH₃(g) from bond energies.

**Answers.** 1. Reverse and halve: −285.8 kJ. 2. Liquid bromine is the stable form of the element at 25 °C and 1 bar, so it is the reference (zero); the gas is a different, higher-energy state, and 30.9 kJ/mol is its enthalpy of vaporisation. 3. 2C(graphite) + 3H₂(g) + ½O₂(g) → C₂H₅OH(l). 4. (−635.1) + (−393.5) − (−1,207.6) = +179.0 kJ; endothermic, which is why limestone must be heated strongly to make lime. 5. Broken: N≡N (945) + 3 H–H (1,308) = 2,253 kJ; formed: 6 N–H (2,346) kJ; ΔH ≈ −93 kJ (table value −91.8 kJ).

---

*Original study material written for this course. Constants and data values are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded for classroom use.*
