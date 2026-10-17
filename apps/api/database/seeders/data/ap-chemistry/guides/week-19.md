# Week 19 · Mechanisms, Rate-Determining Steps and Catalysis

**Topics:** 5.8 Reaction Mechanism and Rate Law · 5.9 Steady-State Approximation · 5.10 Multistep Reaction Energy Profile · 5.11 Catalysis
**Practices:** 1 (Models and Representations), 4 (Model Analysis), 5 (Mathematical Routines), 6 (Argumentation)
**Spiral:** The elementary-step rate laws and intermediates of week 18 (5.4, 5.7); the measured rate laws of week 17 (5.2) that a mechanism must reproduce; the Arrhenius equation (5.6), because a catalyst works by lowering Ea; Maxwell–Boltzmann (3.5); and acid–base and redox ideas (4.8, 4.9) for the acid-catalysed and enzyme examples.

## What you need to be able to do

- **5.8** Derive the rate law predicted by a mechanism when the first step is rate-determining (write the slow step's rate law) and when a fast equilibrium precedes the slow step (replace the intermediate using the equilibrium of the fast step), and judge whether a mechanism is consistent with the experimental rate law.
- **5.9** Explain the steady-state approximation: when an intermediate is formed slowly and consumed quickly, its concentration stays small and nearly constant, so its rate of formation can be set equal to its rate of consumption; recognise it as an alternative to the fast-equilibrium shortcut.
- **5.10** Read a multistep energy profile: one hill per step, intermediates in the valleys between hills, the rate-determining step as the one with the largest activation energy from its starting point, and ΔH for the overall reaction as the difference between the first and last valleys.
- **5.11** Explain how a catalyst speeds a reaction by providing a different pathway with a lower activation energy without being consumed, and distinguish acid–base catalysis, surface (heterogeneous) catalysis and enzyme catalysis; identify a catalyst in a mechanism (consumed early, regenerated later).

## Key terms

| Term | Meaning |
|---|---|
| Rate-determining step | The slowest step in a mechanism; the overall rate can be no faster than it. |
| Fast equilibrium (pre-equilibrium) | A rapid reversible first step that reaches equilibrium before the slow step; its equilibrium expression is used to replace the intermediate's concentration. |
| Steady-state approximation | The assumption that an intermediate's concentration is constant and small: rate of formation = rate of consumption. |
| Multistep energy profile | A profile with one maximum per elementary step and a valley for each intermediate. |
| Catalyst | A substance that increases the rate by providing an alternative pathway of lower Ea; it is consumed in one step and regenerated in a later one, so it is unchanged overall. |
| Homogeneous catalyst | A catalyst in the same phase as the reactants (acid catalysis of ester hydrolysis; Cl atoms in ozone destruction). |
| Heterogeneous catalyst | A catalyst in a different phase, usually a solid surface on which gas or solution molecules adsorb, react and leave (catalytic converters, hydrogenation on Pt). |
| Enzyme | A biological catalyst, a protein with an active site that binds a specific substrate; often shows zero-order kinetics when saturated. |
| Inhibitor | A substance that slows a reaction, often by binding a catalyst or an enzyme's active site. |

## Mechanisms with a slow first step (5.8)

The overall rate of a multistep reaction is the rate of its slowest step, as a line of people can move only as fast as the slowest gate. When the slow step comes **first**, its rate law *is* the predicted rate law, and because the slow step's reactants are all original reactants, no intermediate appears and the job is done.

**Worked example.** NO₂(g) + CO(g) → NO(g) + CO₂(g) has the experimental rate law rate = k[NO₂]². Proposed mechanism:
Step 1 (slow): NO₂ + NO₂ → NO₃ + NO
Step 2 (fast): NO₃ + CO → NO₂ + CO₂
Sum: 2 NO₂ + NO₃ + CO → NO₃ + NO + NO₂ + CO₂; one NO₂ and the NO₃ cancel, leaving NO₂ + CO → NO + CO₂. The intermediate is NO₃. The slow step is bimolecular in NO₂: rate = k₁[NO₂]². This matches the experimental rate law, including its surprising feature that the rate does not depend on [CO]: CO reacts only after the slow step, so adding more of it cannot speed things up. The mechanism is consistent.

**Try it.** The reaction 2 NO₂Cl → 2 NO₂ + Cl₂ has rate = k[NO₂Cl]. Is the mechanism Step 1 (slow): NO₂Cl → NO₂ + Cl; Step 2 (fast): NO₂Cl + Cl → NO₂ + Cl₂ consistent?
*Answer:* Yes. The slow unimolecular step gives rate = k₁[NO₂Cl], first order, as observed. Cl is the intermediate.

## Mechanisms with a fast first step (5.8)

When the slow step comes **second**, its rate law contains an intermediate, and a rate law may only contain species whose concentrations you can measure and control: reactants (and occasionally products or catalysts). You must replace the intermediate. If the first step is a fast equilibrium, set its forward and reverse rates equal and solve for the intermediate.

**Worked example.** 2 NO(g) + O₂(g) → 2 NO₂(g), experimental rate law rate = k[NO]²[O₂]. Proposed mechanism:
Step 1 (fast, reversible): NO + NO ⇌ N₂O₂ (forward k₁, reverse k₋₁)
Step 2 (slow): N₂O₂ + O₂ → 2 NO₂ (k₂)
The slow step gives rate = k₂[N₂O₂][O₂], but N₂O₂ is an intermediate. At the fast equilibrium, k₁[NO]² = k₋₁[N₂O₂], so [N₂O₂] = (k₁/k₋₁)[NO]². Substitute: rate = k₂(k₁/k₋₁)[NO]²[O₂] = k[NO]²[O₂], with k = k₂k₁/k₋₁. The predicted rate law matches experiment. Notice the mechanism explains a third-order rate law with no termolecular collision.

The equilibrium-constant shortcut is the same thing: K₁ = [N₂O₂]/[NO]², so [N₂O₂] = K₁[NO]².

**Try it.** For Step 1 (fast equilibrium): A ⇌ B; Step 2 (slow): B + C → D, predict the rate law.
*Answer:* rate = k₂[B][C] with [B] = K₁[A], so rate = k₂K₁[A][C] = k[A][C].

## The steady-state approximation (5.9)

The fast-equilibrium trick assumes the first step's reverse reaction is much faster than the second step, so the intermediate piles up to its equilibrium amount. When that is not true (the intermediate is consumed about as fast as it reverts), the better assumption is that the intermediate is **at steady state**: a reactive species that is formed slowly and removed quickly never accumulates, so its concentration is tiny and effectively constant. Set its rate of formation equal to its total rate of consumption and solve.

For the NO/O₂ mechanism above: formation of N₂O₂ = k₁[NO]²; consumption = k₋₁[N₂O₂] + k₂[N₂O₂][O₂]. Steady state: k₁[NO]² = [N₂O₂](k₋₁ + k₂[O₂]), so [N₂O₂] = k₁[NO]²/(k₋₁ + k₂[O₂]) and

rate = k₂[N₂O₂][O₂] = k₁k₂[NO]²[O₂]/(k₋₁ + k₂[O₂]).

If k₋₁ ≫ k₂[O₂] (step 2 slow), the denominator is just k₋₁ and this collapses to the pre-equilibrium answer. If instead k₂[O₂] ≫ k₋₁, the rate becomes k₁[NO]², second order and independent of O₂. The steady-state result contains both limits, which is why it is more general. On the AP exam you are asked to explain the idea and the limiting case, not to grind the algebra under time pressure.

## Multistep energy profiles (5.10)

A two-step mechanism has two hills. Reading one:

- Each **maximum** is a transition state; the number of maxima is the number of steps.
- Each **valley between hills** is an intermediate, a real species.
- The **activation energy of each step** is the climb from the valley before it to its own peak.
- The **rate-determining step** is the one with the largest activation energy, measured from the valley where that step starts (not from the overall reactants, unless that is where it starts). A tall second peak reached from a deep intermediate valley can be rate-determining even if it is not the highest point on the page; usually the highest peak relative to its own starting valley is the slow step.
- **ΔH overall** is the last valley minus the first; the intermediates' energies do not affect it.

Graph description you might get: "reactants at 0 kJ/mol; first maximum at +60; intermediate valley at +20; second maximum at +90; products at −40." Step 1: Ea = 60. Step 2: Ea = 90 − 20 = 70, so step 2 is rate-determining. ΔH = −40 kJ/mol. The reverse reaction's barrier for step 2 is 90 − (−40) = 130 kJ/mol.

A catalysed reaction's profile has *more* hills (extra steps) but *lower* ones. The uncatalysed one-hump curve and the catalysed two-hump curve start and end at the same energies: ΔH does not change.

## Catalysis (5.11)

A catalyst speeds a reaction without being used up. It does this by offering a different mechanism, with its own steps, whose highest barrier is lower than the uncatalysed Ea. From the Arrhenius equation, lowering Ea raises k at the same temperature; on the Maxwell–Boltzmann picture, moving the Ea line to the left puts a much bigger fraction of collisions past it. A catalyst appears in the mechanism as a reactant in an early step and a product in a later one; an intermediate is the reverse (product first, reactant later).

| Type | Where | Example |
|---|---|---|
| Acid–base (homogeneous) | Same phase; H⁺ or OH⁻ transfers a proton to make a better intermediate | Acid-catalysed hydrolysis of esters; H⁺ added to a carbonyl makes it more electrophilic |
| Surface (heterogeneous) | Reactants adsorb onto a solid, bonds weaken, products desorb | Catalytic converter (Pt/Pd/Rh converts CO, NOₓ, hydrocarbons); Haber process on Fe; hydrogenation of alkenes on Ni |
| Enzyme | A protein's active site binds the substrate and holds it in the reactive geometry | Catalase decomposes H₂O₂ millions of times faster than in its absence |

**Worked example.** In the stratosphere, ozone is destroyed by:
Step 1: Cl + O₃ → ClO + O₂
Step 2: ClO + O → Cl + O₂
Sum: O₃ + O → 2 O₂. Cl is consumed in step 1 and regenerated in step 2: a catalyst. ClO is made in step 1 and used in step 2: an intermediate. One Cl atom can destroy many thousands of ozone molecules before it is removed, which is why chlorofluorocarbons were banned.

**Worked example (catalysed rate law).** The decomposition of H₂O₂ is catalysed by I⁻:
Step 1 (slow): H₂O₂ + I⁻ → H₂O + IO⁻
Step 2 (fast): H₂O₂ + IO⁻ → H₂O + O₂ + I⁻
Rate = k₁[H₂O₂][I⁻]. The catalyst appears in the rate law, because it takes part in the slow step; the overall equation, 2 H₂O₂ → 2 H₂O + O₂, does not contain it. Enzymes behave similarly at low substrate concentration, but at high substrate concentration every active site is occupied and the rate becomes zero order in substrate.

**Try it.** A profile for an uncatalysed reaction has one maximum with Ea = 110 kJ/mol. With a catalyst the profile shows two maxima at 45 and 60 kJ/mol above the reactants with an intermediate at 15 kJ/mol. Which catalysed step is rate-determining, and what is the effective Ea?
*Answer:* Step 2, with Ea = 60 − 15 = 45 kJ/mol; step 1 has Ea = 45 kJ/mol from the reactants. The two are equal in this case; the effective barrier is the overall highest point relative to reactants, 60 kJ/mol, compared with 110 uncatalysed.

## Common mistakes

- Leaving an intermediate in a predicted rate law. Replace it using the fast equilibrium (or the steady state).
- Saying a reactant that does not appear in the rate law "does not react". It reacts, but after the rate-determining step.
- Measuring a step's activation energy from the overall reactants instead of from its own starting valley.
- Calling a catalyst an intermediate or the reverse: a catalyst goes in first and comes out later; an intermediate comes out first and goes in later.
- Claiming a catalyst changes ΔH, the equilibrium constant or the position of equilibrium. It changes only the rate (both forward and reverse equally).
- Treating the equilibrium constant of the fast step as if it were the rate constant of the reaction.

## Where this goes next

Unit 6 looks at the vertical axis of the profile: enthalpy, heat flow and how ΔH is measured and calculated. Unit 7's equilibrium is what the fast step above reached, generalised to whole reactions; the statement that a catalyst does not shift equilibrium is proved there. Unit 9 contrasts kinetic control (Ea) with thermodynamic control (ΔG) and shows why a diamond does not turn into graphite.

## Self-check

1. Mechanism: Step 1 (slow) A + B → C; Step 2 (fast) C + B → D. Predict the rate law and the overall equation.
2. Mechanism: Step 1 (fast equilibrium) 2 A ⇌ B; Step 2 (slow) B + C → D. Predict the rate law.
3. On a two-step profile the first peak is 80 kJ/mol above the reactants, the intermediate is 30 above, and the second peak is 50 above. Which step is slower?
4. In the mechanism Step 1: H⁺ + X → HX⁺; Step 2: HX⁺ + Y → Z + H⁺, which species is the catalyst and which is the intermediate?
5. Why does a catalyst not change ΔH?

*Answers:* (1) rate = k[A][B]; A + 2 B → D. (2) rate = k₂[B][C] with [B] = K₁[A]², so rate = k[A]²[C]. (3) Step 1 (Ea = 80) versus step 2 (Ea = 50 − 30 = 20): step 1. (4) H⁺ is the catalyst (consumed in step 1, regenerated in step 2); HX⁺ is the intermediate. (5) ΔH is the difference between the energies of products and reactants, which the catalyst does not change; it only lowers the barrier between them.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 5.8–5.11). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
