# Week 18 · Collisions, Activation Energy and Elementary Steps

**Topics:** 5.4 Elementary Reactions · 5.5 Collision Model · 5.6 Reaction Energy Profile · 5.7 Introduction to Reaction Mechanisms
**Practices:** 1 (Models and Representations), 4 (Model Analysis), 5 (Mathematical Routines), 6 (Argumentation)
**Spiral:** The Maxwell–Boltzmann distribution from kinetic molecular theory (3.5) is the reason temperature changes the rate; bond enthalpies and potential energy (2.2) are what the vertical axis of an energy profile measures; the rate laws of week 17 (5.2) are what a mechanism must reproduce.

## What you need to be able to do

- **5.4** Explain that an elementary reaction happens in a single collision event, that its rate law can be written from its molecularity (unimolecular, bimolecular; termolecular steps are rare), and why rate laws for overall reactions cannot be written this way.
- **5.5** Use the collision model to explain how concentration, temperature and orientation determine the rate: a successful collision needs enough energy and the right geometry, and the Maxwell–Boltzmann distribution tells you what fraction of collisions have that energy.
- **5.6** Read and draw a reaction energy profile for a single step: reactants, transition state (activated complex), activation energy Ea, products and ΔH; use the Arrhenius equation, k = A e^(−Ea/RT), qualitatively and in its two-temperature form.
- **5.7** Describe a reaction mechanism as a sequence of elementary steps that add to the overall equation, identify intermediates and the molecularity of each step, and explain why a proposed mechanism is a hypothesis tested against the rate law.

## Key terms

| Term | Meaning |
|---|---|
| Elementary reaction (step) | A reaction that occurs exactly as written, in one molecular event; its rate law follows from its coefficients. |
| Molecularity | The number of particles that collide in an elementary step: unimolecular (one), bimolecular (two), termolecular (three, rare because three-body collisions are improbable). |
| Collision model | Particles react only when they collide with enough kinetic energy along the reaction coordinate and in an orientation that lets the new bonds form. |
| Activation energy, Ea | The minimum energy a collision must supply to reach the transition state; the hill on an energy profile. |
| Transition state (activated complex) | The highest-energy arrangement along the path, with old bonds partly broken and new bonds partly formed; it cannot be isolated. |
| Reaction energy profile | A plot of potential energy against reaction progress (the reaction coordinate), showing Ea (forward and reverse) and ΔH. |
| Arrhenius equation | k = A e^(−Ea/RT): the rate constant grows with temperature and shrinks with activation energy. A is the frequency factor (collision rate × orientation fraction). |
| Maxwell–Boltzmann distribution | The spread of molecular kinetic energies at a temperature; the area beyond Ea is the fraction of collisions that can react, and it grows steeply with T. |
| Mechanism | A proposed sequence of elementary steps whose sum is the overall balanced equation. |
| Intermediate | A species produced in one step and consumed in a later one; it appears in the mechanism but not in the overall equation. |
| Rate-determining step | The slowest elementary step, which limits the overall rate (developed fully in week 19). |

## Elementary reactions and molecularity (5.4)

Last week's rule was that orders come from experiment, never from coefficients. There is one exception, and it is the whole point of mechanisms: for an **elementary** step, the coefficients *are* the orders, because the step describes an actual collision. If one molecule of NO₂ collides with one molecule of CO and the products form in that single event, then the number of such events per second is proportional to [NO₂] × [CO].

| Elementary step | Molecularity | Rate law |
|---|---|---|
| A → products | unimolecular | rate = k[A] |
| A + B → products | bimolecular | rate = k[A][B] |
| 2 A → products | bimolecular | rate = k[A]² |
| A + B + C → products | termolecular | rate = k[A][B][C] (rare) |

A unimolecular step is a molecule falling apart or rearranging after it has gained enough energy from earlier collisions (ozone splitting, cyclopropane opening into propene). Bimolecular steps are the common case. Termolecular steps are rare because the chance that three particles meet at once, with the right energy and geometry, is tiny; a proposed mechanism with a termolecular step needs a good reason.

The overall equation 2 NO₂(g) + F₂(g) → 2 NO₂F(g) is **not** a statement that two NO₂ molecules and one F₂ molecule collide together. Its measured rate law is rate = k[NO₂][F₂], first order in each, which says the first collision is one NO₂ with one F₂. The second NO₂ enters later. You cannot tell that from the overall equation; only the rate law and a mechanism can say it.

**Try it.** Write the rate law for the elementary step O₃(g) + O(g) → 2 O₂(g).
*Answer:* rate = k[O₃][O], bimolecular.

## The collision model (5.5)

Why does a reaction have a rate at all, rather than happening instantly? Because particles must collide, and most collisions fail. The collision model names three requirements:

1. **Collision frequency.** Particles must meet. Raising a concentration raises the number of collisions per second in proportion (which is where the rate law's concentration dependence comes from); raising the temperature raises the collision frequency modestly, because particles move faster.
2. **Energy.** A collision must carry at least the activation energy Ea along the line of approach, enough to stretch and break the bonds that must break and to reach the transition state. Most collisions at room temperature do not.
3. **Orientation.** Even an energetic collision fails if the atoms that must bond do not meet. For NO + O₃, the N atom must hit an O of the ozone; an O-end approach bounces off. The fraction with useful geometry is folded into the Arrhenius frequency factor A.

Temperature is the lever with the largest effect, and the Maxwell–Boltzmann distribution explains why. At any temperature, molecules have a spread of kinetic energies: a hump at moderate energies and a long tail at high energies. Only the molecules in the tail beyond Ea can react. Raising the temperature flattens and broadens the curve and shifts its peak to the right; the area beyond Ea grows much faster than the average energy does. That is why a 10 °C rise can roughly double the rate of a typical reaction although it raises the average kinetic energy by only about 3%.

Graph description you should be able to draw: two Maxwell–Boltzmann curves, the higher-temperature one lower and wider with its peak to the right; a vertical line at Ea; the shaded area to the right of Ea visibly larger for the higher-temperature curve. Changing concentration does not change this curve at all; a catalyst moves the Ea line to the left (week 19).

## Reaction energy profiles and the Arrhenius equation (5.6)

An energy profile is the collision model drawn as a landscape. Reaction progress runs left to right; potential energy runs up. Reactants sit in a valley on the left, products in a valley on the right, and the pass between them is the **transition state**, the top of the hill. Three numbers live on the diagram:

- **Ea (forward):** from the reactant valley to the top.
- **Ea (reverse):** from the product valley to the top.
- **ΔH:** products minus reactants. Exothermic reactions end in a lower valley (ΔH < 0), endothermic ones in a higher valley (ΔH > 0).

The two activation energies and ΔH are linked: Ea(reverse) = Ea(forward) − ΔH. For an exothermic reaction with Ea(forward) = 50 kJ/mol and ΔH = −30 kJ/mol, the reverse barrier is 50 − (−30) = 80 kJ/mol. A larger Ea means a slower reaction at a given temperature; ΔH says nothing about speed, only about the energy released.

The **Arrhenius equation** makes the temperature dependence quantitative:

k = A e^(−Ea/RT)

e^(−Ea/RT) is the fraction of collisions with energy at least Ea, exactly the Maxwell–Boltzmann tail area; A, the frequency factor, carries the collision rate and the orientation probability. Taking logarithms gives the form you can plot: ln k = −(Ea/R)(1/T) + ln A, a straight line of ln k against 1/T with slope −Ea/R. Measure k at several temperatures, plot, and the slope gives Ea. For two temperatures:

ln(k₂/k₁) = −(Ea/R)(1/T₂ − 1/T₁)

Use R = 8.314 J/(mol·K), temperatures in kelvin, and Ea in J/mol.

**Worked example.** A reaction has k = 2.5 × 10⁻³ s⁻¹ at 300 K and k = 2.0 × 10⁻² s⁻¹ at 330 K. Find Ea.
ln(k₂/k₁) = ln(2.0 × 10⁻²/2.5 × 10⁻³) = ln 8.0 = 2.079.
1/T₂ − 1/T₁ = 1/330 − 1/300 = 0.0030303 − 0.0033333 = −3.030 × 10⁻⁴ K⁻¹.
Ea = −R × ln(k₂/k₁)/(1/T₂ − 1/T₁) = −8.314 × 2.079 / (−3.030 × 10⁻⁴) = 5.70 × 10⁴ J/mol = **57 kJ/mol**.

**Worked example.** A reaction with Ea = 75 kJ/mol has k = 1.0 × 10⁻⁴ s⁻¹ at 298 K. What is k at 318 K?
ln(k₂/k₁) = −(75,000/8.314)(1/318 − 1/298) = −(9,021)(0.0031447 − 0.0033557) = −(9,021)(−2.110 × 10⁻⁴) = 1.903.
k₂ = k₁ e¹·⁹⁰³ = 1.0 × 10⁻⁴ × 6.71 = **6.7 × 10⁻⁴ s⁻¹**, about a 6.7-fold increase for a 20 K rise, which is the "doubling every 10 °C" rule of thumb for a fairly high barrier.

**Try it.** Graph description: a plot of ln k against 1/T is a straight line with slope −9.6 × 10³ K. What is Ea?
*Answer:* slope = −Ea/R, so Ea = 9.6 × 10³ × 8.314 = 8.0 × 10⁴ J/mol = 80 kJ/mol.

## Mechanisms: the first look (5.7)

A **mechanism** is a hypothesis about how an overall reaction happens, written as elementary steps. Three rules:

1. The steps must **add up** to the overall balanced equation. Species that appear on the product side of one step and the reactant side of a later step cancel; those are the **intermediates**.
2. Each step is elementary, so each has a molecularity and a rate law you can write from its coefficients.
3. The mechanism must be **consistent with the experimental rate law** (week 19 shows how to check), and it must be chemically reasonable (no termolecular steps without cause, no impossible species). A mechanism can be disproved by data; it can never be proved, only supported.

**Worked example.** The reaction 2 NO₂(g) + F₂(g) → 2 NO₂F(g) is proposed to occur by:
Step 1: NO₂ + F₂ → NO₂F + F (slow)
Step 2: NO₂ + F → NO₂F (fast)
Adding: NO₂ + F₂ + NO₂ + F → NO₂F + F + NO₂F. The F atom cancels (made in step 1, used in step 2), leaving 2 NO₂ + F₂ → 2 NO₂F. The intermediate is the F atom. Both steps are bimolecular. Step 1 has the rate law rate = k₁[NO₂][F₂], which matches the measured rate law, so the mechanism is consistent with experiment.

An intermediate is a real molecule or atom that exists briefly between steps; it is not the transition state, which is a fleeting arrangement at the top of a hill, not a species in a valley. On a two-step energy profile (week 19) the intermediate sits in the dip between two hills.

**Try it.** For the mechanism Step 1: O₃ → O₂ + O; Step 2: O + O₃ → 2 O₂, write the overall equation and name the intermediate.
*Answer:* 2 O₃ → 3 O₂; the intermediate is the O atom.

## Common mistakes

- Writing a rate law from the coefficients of an overall equation. Only elementary steps allow that.
- Saying that raising the temperature raises the rate because collisions become more frequent. Frequency rises a little; the big effect is the much larger fraction of collisions with energy above Ea.
- Confusing Ea with ΔH. Ea controls speed; ΔH controls heat released or absorbed. A reaction can be strongly exothermic and extremely slow (paper in air at room temperature).
- Confusing an intermediate (a valley on the profile, a real species that cancels between steps) with a transition state (a peak, never isolated).
- Forgetting to convert °C to K and kJ to J in the Arrhenius equation, or mixing up which temperature is T₁.
- Claiming a mechanism is proved because it matches the rate law. Agreement is consistency, not proof.

## Where this goes next

Week 19 finishes mechanisms: the rate-determining step, deriving rate laws for mechanisms with a fast first step (and the steady-state idea), multistep energy profiles, and catalysts, which lower Ea by adding steps. Unit 6 turns to ΔH itself, the vertical gap between the two valleys. Unit 9 revisits Ea when it asks why a thermodynamically favourable reaction can sit unreacted for years (kinetic control).

## Self-check

1. Write the rate law for the elementary step 2 NO(g) → N₂O₂(g) and give its molecularity.
2. On a profile, Ea(forward) = 120 kJ/mol and ΔH = +40 kJ/mol. What is Ea(reverse)?
3. Why does doubling the concentration of a reactant not change the fraction of collisions with energy above Ea?
4. k doubles when the temperature rises from 300 K to 310 K. Estimate Ea.
5. In the mechanism Step 1: Cl₂ → 2 Cl; Step 2: Cl + CHCl₃ → HCl + CCl₃; Step 3: Cl + CCl₃ → CCl₄, name every intermediate and write the overall equation.

*Answers:* (1) rate = k[NO]², bimolecular. (2) 120 − 40 = 80 kJ/mol. (3) Concentration changes how many collisions occur, not the energy distribution, which depends only on temperature. (4) ln 2 = −(Ea/8.314)(1/310 − 1/300) = (Ea/8.314)(1.075 × 10⁻⁴); Ea = 0.693 × 8.314/1.075 × 10⁻⁴ = 5.4 × 10⁴ J/mol ≈ 54 kJ/mol. (5) Intermediates: Cl and CCl₃. Overall: Cl₂ + CHCl₃ → HCl + CCl₄.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 5.4–5.7). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
