# Week 24 · The Size of K and Equilibrium Concentrations

**Topics:** 7.5 Magnitude of the Equilibrium Constant · 7.6 Properties of the Equilibrium Constant · 7.7 Calculating Equilibrium Concentrations · 7.8 Representations of Equilibrium
**Practices:** 1 (Models and Representations), 2 (Question and Method), 4 (Model Analysis), 5 (Mathematical Routines)
**Spiral:** The ICE table and the Q/K comparison of week 23 (7.3, 7.4); the rules for scaling and reversing equations from thermochemistry (6.6, 6.9), which K obeys in multiplicative form; the quadratic formula; particle-diagram reading (3.8, 4.3); the ideal gas law (3.4) for Kp problems.

## What you need to be able to do

- **7.5** Interpret the magnitude of K: K ≫ 1 means products dominate at equilibrium, K ≪ 1 means reactants dominate, K near 1 means comparable amounts; estimate the composition of a mixture from K without solving.
- **7.6** Use the properties of K: reversing a reaction gives 1/K; multiplying by n gives Kⁿ; adding reactions multiplies their K values; K depends only on temperature.
- **7.7** Calculate equilibrium concentrations or pressures from K and initial amounts with an ICE table, solving exactly (quadratic) or with the small-x approximation when K is small, and check the approximation (x less than 5% of the initial concentration).
- **7.8** Read and draw representations of equilibrium: particle diagrams, concentration–time graphs and bar charts, and match them to K and to initial conditions.

## Key terms

| Term | Meaning |
|---|---|
| Large K | K > about 10³: the reaction lies far to the right; the limiting reactant is nearly used up. |
| Small K | K < about 10⁻³: the reaction barely proceeds; reactants are nearly unchanged. |
| Small-x approximation | Neglecting x against an initial concentration when K is small: [A]₀ − x ≈ [A]₀. |
| 5% rule | The approximation is acceptable when x is less than 5% of the concentration it was dropped from. |
| Quadratic formula | x = [−b ± √(b² − 4ac)]/(2a) for ax² + bx + c = 0; the physically sensible root is the one that leaves every concentration positive. |
| Particle diagram | A box of particles representing an equilibrium mixture; counts stand for concentrations. |

## The magnitude of K (7.5)

K tells you the composition at equilibrium, not how fast it is reached.

| K | Meaning | Example |
|---|---|---|
| 10¹⁰ or more | essentially complete; treat as going to completion then back-calculate a trace of reactant | 2 H₂ + O₂ ⇌ 2 H₂O, K ≈ 10⁸⁰ |
| 10³ to 10¹⁰ | products strongly favoured | |
| 10⁻³ to 10³ | significant amounts of both | H₂ + I₂ ⇌ 2 HI, K = 50 |
| 10⁻¹⁰ to 10⁻³ | reactants strongly favoured | weak acid ionisation, Ka ≈ 10⁻⁵ |
| 10⁻¹⁰ or less | essentially no reaction | N₂ + O₂ ⇌ 2 NO at 25 °C, K ≈ 10⁻³¹ |

Two cautions. First, the comparison is with the coefficients included, so K for a reaction with large exponents is not directly comparable to one with small exponents; the concentrations also matter. Second, a tiny K does not mean "impossible": it means the equilibrium mixture contains little product, which may still matter (the trace of NO formed in engines is enough to make smog).

**Estimating without solving.** If K = 1 × 10⁻⁶ for A ⇌ B + C and [A]₀ = 0.10 M, then [B] = [C] = x with x²/0.10 ≈ 10⁻⁶, x ≈ 3 × 10⁻⁴ M: about 0.3% of A has reacted. If K = 1 × 10⁶, almost all A reacts and you work backwards from the products.

## Properties of K (7.6)

Because K is a ratio of concentrations raised to coefficients, manipulating the equation manipulates K multiplicatively:

| Change to the equation | Change to K |
|---|---|
| Reverse it | K' = 1/K |
| Multiply all coefficients by n | K' = Kⁿ (halving: K' = √K) |
| Add two reactions | K₃ = K₁ × K₂ |
| Change temperature | K changes (see week 25); nothing else changes K |

**Worked example.** For N₂ + 3 H₂ ⇌ 2 NH₃, K = 0.50 at 400 °C. Find K for (a) 2 NH₃ ⇌ N₂ + 3 H₂; (b) ½ N₂ + 3/2 H₂ ⇌ NH₃.
(a) Reverse: 1/0.50 = **2.0**. (b) Halve: √0.50 = **0.71**.

**Worked example (adding reactions).** For a weak diprotic acid, H₂A ⇌ H⁺ + HA⁻ has K₁ = 1.0 × 10⁻³ and HA⁻ ⇌ H⁺ + A²⁻ has K₂ = 1.0 × 10⁻⁷. The overall H₂A ⇌ 2 H⁺ + A²⁻ has K = K₁K₂ = **1.0 × 10⁻¹⁰**. Check: [H⁺][HA⁻]/[H₂A] × [H⁺][A²⁻]/[HA⁻] = [H⁺]²[A²⁻]/[H₂A].

Adding a catalyst, changing concentrations, changing the volume or adding an inert gas does not change K; they change Q, which is why the system shifts (week 25).

**Try it.** Given 2 SO₂ + O₂ ⇌ 2 SO₃ with K = 90 and 2 NO₂ ⇌ 2 NO + O₂ with K = 2.0 × 10⁻³, find K for SO₂ + NO₂ ⇌ SO₃ + NO.
*Answer:* Halve the first (√90 = 9.49) and halve the second (√(2.0 × 10⁻³) = 0.0447); add: K = 9.49 × 0.0447 = 0.42.

## Calculating equilibrium concentrations (7.7)

Now the ICE table runs the other way: K is known, and x is unknown.

**Case 1: small K, use the approximation.** For A ⇌ B + C with [A]₀ = 0.200 M and K = 4.0 × 10⁻⁶:
K = x²/(0.200 − x) ≈ x²/0.200, so x² = 8.0 × 10⁻⁷, x = 8.9 × 10⁻⁴ M. Check: 8.9 × 10⁻⁴/0.200 = 0.45%, far below 5%, so the approximation holds. [B] = [C] = 8.9 × 10⁻⁴ M; [A] = 0.200 − 0.0009 ≈ 0.199 M.

**Case 2: K not small, solve the quadratic.** For H₂ + I₂ ⇌ 2 HI with K = 50 and [H₂]₀ = [I₂]₀ = 0.100 M:
K = (2x)²/((0.100 − x)²) = 50. Because both sides are perfect squares, take the square root: 2x/(0.100 − x) = 7.07, so 2x = 0.707 − 7.07x, 9.07x = 0.707, x = **0.0780 M**. [HI] = 0.156 M, [H₂] = [I₂] = 0.022 M. (The square-root trick works whenever the expression is a perfect-square ratio; otherwise use the quadratic formula.)

**Case 3: quadratic formula.** For PCl₅ ⇌ PCl₃ + Cl₂ with K = 0.040 and [PCl₅]₀ = 0.500 M:
x²/(0.500 − x) = 0.040 → x² + 0.040x − 0.020 = 0 → x = [−0.040 + √(0.0016 + 0.080)]/2 = (−0.040 + 0.2857)/2 = **0.123 M**. (The approximation would give √0.020 = 0.141, which is 28% of 0.500, so it fails the 5% test; that is why the quadratic was needed.) [PCl₅] = 0.377 M, [PCl₃] = [Cl₂] = 0.123 M.

**Case 4: large K, work from completion.** For a reaction with K = 1 × 10⁸, assume the limiting reactant is used up completely, write the resulting concentrations as the new "initial" state, then let a small amount y go backward and apply the small-y approximation to find the trace of reactant that remains.

**Case 5: products present initially.** Nothing changes except that the Equilibrium row has non-zero starting values for products; decide the direction first by comparing Q with K so that x has the right sign.

**Kp problems** use the same tables with partial pressures in atm.

**Try it.** For N₂O₄ ⇌ 2 NO₂, Kc = 0.046 at 298 K. Starting with [N₂O₄] = 0.100 M and no NO₂, find the equilibrium concentrations.
*Answer:* (2x)²/(0.100 − x) = 0.046 → 4x² + 0.046x − 0.0046 = 0 → x = [−0.046 + √(0.002116 + 0.0736)]/8 = (−0.046 + 0.2752)/8 = 0.0286 M. [NO₂] = 0.057 M, [N₂O₄] = 0.071 M. (Approximation check: 4x² = 0.0046 gives x = 0.034, 34% of 0.100, so no.)

## Representations of equilibrium (7.8)

The exam shows equilibrium in three pictures; be able to go from each to K and back.

- **Particle diagrams.** Count particles; the counts are concentrations (same volume) or moles. A diagram with far more product particles than reactant particles goes with a large K. A pair of diagrams, "before" and "at equilibrium", shows how much reacted. If two diagrams are both claimed to be at equilibrium at the same temperature, their Q values must be equal; if they are not, one is mislabelled.
- **Concentration–time graphs.** Flat lines mark equilibrium; the ratio of plateaus gives K. A sudden vertical jump in one curve followed by new plateaus is a disturbance (week 25).
- **Bar charts.** Bars for initial and equilibrium concentrations; reactant bars shrink and product bars grow in the stoichiometric ratio.

Graph description you might get: "Two boxes, each 1 L. Box P at equilibrium holds 1 X₂ and 8 XY₂... " Translate every count to a concentration, write Q, and compare.

**Worked example.** For A ⇌ 2 B with K = 2.0 (counts as molarities), box 1 holds 6 A and 2 B, box 2 holds 2 A and 6 B, box 3 holds 4 A and 4 B, and box 4 holds 2 A and 2 B. Which box is at equilibrium? Box 1: Q = 2²/6 = 0.67 < K, so it will react forward. Box 2: Q = 6²/2 = 18 > K, so it will react in reverse even though it is "full of product". Box 3: Q = 4²/4 = 4.0 > K, reverse. Box 4: Q = 2²/2 = 2.0 = K, so box 4 is the equilibrium mixture. The exercise shows that reading the numbers beats guessing from appearance: the box with the most product particles is not the one at equilibrium.

## Common mistakes

- Using the small-x approximation when K is not small, or forgetting to check the 5% rule.
- Dropping x from the product side (x² ≈ 0) instead of from the reactant side.
- Taking the negative root of the quadratic, or a root that makes a concentration negative.
- Forgetting the 2x and the square for a species with coefficient 2.
- Thinking a larger K means a faster reaction.
- Squaring K when the equation is halved (it is the square root), or adding K values when reactions are added (they multiply).
- Assuming a box with more product particles must be at equilibrium; compute Q.

## Where this goes next

Week 25 asks what happens when an equilibrium is disturbed (Le Châtelier's principle) and explains every shift with Q versus K. Week 26 applies ICE tables to solubility (Ksp), where the small-x approximation is almost always valid. Unit 8 is one long ICE table for weak acids, where the 5% rule earns its keep.

## Self-check

1. Which has more product at equilibrium, a reaction with K = 10⁻⁴ or one with K = 10⁴?
2. K = 4.0 for A ⇌ 2 B. What is K for 2 B ⇌ A, and for ½ A ⇌ B?
3. For A ⇌ B + C, K = 2.5 × 10⁻⁵ and [A]₀ = 0.50 M. Find [B].
4. For A + B ⇌ C, K = 10 and [A]₀ = [B]₀ = 0.10 M, [C]₀ = 0. Is the approximation valid? Find x.
5. A particle box holds 3 A₂ and 6 AB for A₂ + B₂ ⇌ 2 AB with 1 B₂; is Q bigger or smaller than K = 4?

*Answers:* (1) K = 10⁴. (2) 0.25; √4.0 = 2.0. (3) x² = 0.50 × 2.5 × 10⁻⁵ = 1.25 × 10⁻⁵, x = 3.5 × 10⁻³ M (0.7% of 0.50, fine). (4) x/((0.10 − x)²) = 10; the approximation x/0.010 = 10 gives x = 0.10, which is 100% of the initial value, so no; solve 10x² − 3x + 0.1 = 0: x = [3 − √(9 − 4)]/20 = (3 − 2.236)/20 = 0.038 M. (5) Q = 36/(3 × 1) = 12 > 4, so the reaction runs in reverse.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 7.5–7.8). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
