# Week 17 · Reaction Rates and Rate Laws

**Topics:** 5.1 Reaction Rates · 5.2 Introduction to Rate Law · 5.3 Concentration Changes Over Time
**Practices:** 3 (Representing Data and Phenomena), 4 (Model Analysis), 5 (Mathematical Routines)
**Spiral:** Stoichiometry (4.5) sets the ratio between the rates of different species in one reaction; molarity and the ideal gas law (3.4, 3.7) are how concentration gets measured; Beer–Lambert (3.13) is how a spectrometer follows a coloured reactant with time.

## What you need to be able to do

- **5.1** Define a reaction rate as the change in concentration of a species per unit time, relate the rates of different species through the coefficients of the balanced equation, and explain how temperature, concentration, surface area, solvent and catalysts change the rate.
- **5.2** Read a rate law, rate = k[A]ᵐ[B]ⁿ, as an experimental fact: determine the orders m and n from initial-rate data, find k with its units, and explain that orders are not read from coefficients.
- **5.3** Use the integrated rate laws and their straight-line plots (ln[A] vs t for first order, 1/[A] vs t for second order, [A] vs t for zero order) to identify an order from concentration–time data, calculate concentrations at later times, and use the first-order half-life, t½ = 0.693/k, which does not depend on concentration.

## Key terms

| Term | Meaning |
|---|---|
| Rate of reaction | −Δ[reactant]/Δt or +Δ[product]/Δt, usually in M/s (mol/(L·s)). Positive by convention. |
| Instantaneous rate | The slope of a tangent to the concentration–time curve at one moment; the initial rate is the tangent at t = 0. |
| Rate law | rate = k[A]ᵐ[B]ⁿ, found from experiment. The exponents are the orders. |
| Order with respect to A | The exponent m; doubling [A] multiplies the rate by 2ᵐ. |
| Overall order | The sum of the exponents, m + n. |
| Rate constant, k | The proportionality constant; it depends on temperature and on the catalyst, never on concentration. Its units make the rate come out in M/s. |
| Integrated rate law | The concentration–time equation that follows from a rate law: ln[A]ₜ = −kt + ln[A]₀ (first order), 1/[A]ₜ = kt + 1/[A]₀ (second order), [A]ₜ = −kt + [A]₀ (zero order). |
| Half-life, t½ | The time for [A] to fall to half its value. First order: t½ = 0.693/k, constant. Second order: t½ = 1/(k[A]₀), grows as the reaction proceeds. Zero order: t½ = [A]₀/(2k), shrinks. |
| Method of initial rates | Comparing the initial rates of experiments that differ in one concentration at a time to extract each order. |
| Pseudo-first-order | A reaction that looks first order because every other reactant is in such excess that its concentration is effectively constant. |

## Defining and measuring a rate (5.1)

A rate is a change in concentration over an interval of time. For the decomposition

2 N₂O₅(g) → 4 NO₂(g) + O₂(g)

the species disappear and appear at rates fixed by the coefficients: every two N₂O₅ that vanish make four NO₂ and one O₂. To give the reaction a single rate, divide each species' rate by its coefficient:

rate = −(1/2) Δ[N₂O₅]/Δt = +(1/4) Δ[NO₂]/Δt = +Δ[O₂]/Δt

So if O₂ is forming at 0.010 M/s, N₂O₅ is disappearing at 0.020 M/s and NO₂ is forming at 0.040 M/s. The rule on the exam is simple: a species with a bigger coefficient changes faster, by exactly that ratio.

Rates are measured by following anything proportional to concentration: the absorbance of a coloured species (Beer–Lambert, A = εbc), the pressure of a gas at fixed volume and temperature (PV = nRT, so P is proportional to n/V), the conductivity of a solution of ions, or the volume of gas collected. Because concentrations change as the reaction proceeds, so does the rate. An **average rate** over an interval is Δ[A]/Δt from a table; an **instantaneous rate** is the slope of the tangent at one time, and almost every rate-law problem uses the **initial rate**, the tangent at t = 0, because the concentrations are then exactly what you mixed.

Five factors change the rate: concentration (more molecules per litre means more collisions per second), temperature (a larger fraction of collisions carries enough energy, week 18), surface area of a solid reactant (only the surface can react), the solvent (which can stabilise or destabilise a transition state), and a catalyst (a lower-energy pathway, week 19). All of these are explained by the collision model next week; this week the job is to turn data into equations.

**Worked example.** In the reaction 2 H₂O₂(aq) → 2 H₂O(l) + O₂(g), the O₂ concentration rises from 0 to 0.0150 M in the first 30.0 s. What is the average rate of disappearance of H₂O₂?
O₂ forms at 0.0150 M / 30.0 s = 5.00 × 10⁻⁴ M/s. H₂O₂ has twice the coefficient, so it disappears at 2 × 5.00 × 10⁻⁴ = **1.00 × 10⁻³ M/s**.

**Try it.** For 4 NH₃(g) + 5 O₂(g) → 4 NO(g) + 6 H₂O(g), if NH₃ is consumed at 0.24 M/s, at what rate is water produced?
*Answer:* (6/4) × 0.24 = 0.36 M/s.

## Rate laws from initial-rate data (5.2)

A rate law is a statement about how the rate depends on concentration, and it comes only from experiment. For A + B → products the general form is

rate = k[A]ᵐ[B]ⁿ

The orders m and n are whatever the data say: 0, 1, 2, occasionally 3 or a fraction. They are **not** the coefficients of the balanced equation (that works only for a single elementary step, week 18). To find m, compare two experiments in which [A] changes and [B] does not:

rate₂/rate₁ = ([A]₂/[A]₁)ᵐ

If doubling [A] doubles the rate, m = 1; if it quadruples the rate, m = 2; if the rate does not change, m = 0. Tripling [A] and seeing the rate go up by 9 also says m = 2 (3² = 9).

**Worked example.** Initial-rate data for 2 NO(g) + O₂(g) → 2 NO₂(g):

| Experiment | [NO]₀ (M) | [O₂]₀ (M) | Initial rate (M/s) |
|---|---|---|---|
| 1 | 0.010 | 0.010 | 2.5 × 10⁻⁵ |
| 2 | 0.020 | 0.010 | 1.0 × 10⁻⁴ |
| 3 | 0.010 | 0.020 | 5.0 × 10⁻⁵ |

Experiments 1 and 2: [NO] doubles, [O₂] fixed, rate goes from 2.5 × 10⁻⁵ to 1.0 × 10⁻⁴, a factor of 4 = 2². So the order in NO is 2. Experiments 1 and 3: [O₂] doubles, rate doubles. Order in O₂ is 1. Rate law: rate = k[NO]²[O₂], overall third order.

Now k, from experiment 1: k = rate/([NO]²[O₂]) = 2.5 × 10⁻⁵ / ((0.010)² × 0.010) = 2.5 × 10⁻⁵ / 1.0 × 10⁻⁶ = **25 M⁻²·s⁻¹**. Check the units: M/s divided by M³ is M⁻²·s⁻¹. In general the units of k for an overall order p are M¹⁻ᵖ·s⁻¹: s⁻¹ for first order, M⁻¹·s⁻¹ for second, M/s for zero.

Two cautions. First, use experiments that differ in only one concentration; if both change, solve for one order first and substitute. Second, if the ratio of concentrations is not a clean 2 or 3, take logarithms: m = log(rate₂/rate₁) / log([A]₂/[A]₁).

**Try it.** For a reaction A + B → C, tripling [A] with [B] fixed increases the rate by a factor of 3, and doubling [B] with [A] fixed leaves the rate unchanged. Write the rate law and the units of k.
*Answer:* rate = k[A]; first order overall; k in s⁻¹.

## Integrated rate laws: concentration versus time (5.3)

A rate law tells you the rate now; an integrated rate law tells you the concentration later. The three you need are on the AP equations sheet:

| Order | Rate law | Integrated form | Straight-line plot | Slope | Half-life |
|---|---|---|---|---|---|
| 0 | rate = k | [A]ₜ = −kt + [A]₀ | [A] vs t | −k | [A]₀/(2k) |
| 1 | rate = k[A] | ln[A]ₜ = −kt + ln[A]₀ | ln[A] vs t | −k | 0.693/k |
| 2 | rate = k[A]² | 1/[A]ₜ = kt + 1/[A]₀ | 1/[A] vs t | +k | 1/(k[A]₀) |

To find an order from a table of [A] against t, make the three plots (or the three columns [A], ln[A], 1/[A]) and see which one is a straight line. Quick tests without plotting: if [A] drops by equal amounts in equal times, zero order; if it drops by the same *fraction* in equal times (constant half-life), first order; if successive half-lives double, second order.

**Worked example (first order).** The decomposition of N₂O₅ at 45 °C has k = 6.2 × 10⁻⁴ s⁻¹. Starting at 0.100 M, what is [N₂O₅] after 20.0 minutes, and what is the half-life?
t = 20.0 min × 60 s/min = 1,200 s.
ln[A]ₜ = −kt + ln[A]₀ = −(6.2 × 10⁻⁴)(1,200) + ln(0.100) = −0.744 + (−2.303) = −3.047.
[A]ₜ = e⁻³·⁰⁴⁷ = **0.0475 M**.
t½ = 0.693/k = 0.693/(6.2 × 10⁻⁴) = 1,118 s ≈ **18.6 min**. Check: 20 min is just over one half-life, so a little under 0.050 M is right.

**Worked example (second order).** A reaction 2 A → products is second order in A with k = 0.050 M⁻¹·s⁻¹. If [A]₀ = 0.40 M, how long until [A] = 0.10 M?
1/[A]ₜ = kt + 1/[A]₀ → 1/0.10 = 0.050 t + 1/0.40 → 10.0 = 0.050 t + 2.5 → t = 7.5/0.050 = **150 s**.
Notice that the first half-life (0.40 → 0.20 M) takes 1/(k[A]₀) = 1/(0.050 × 0.40) = 50 s, and the second (0.20 → 0.10) takes 100 s: 150 s in total, as the equation says.

**Worked example (which order?).** Concentration–time data for a reactant:

| t (s) | 0 | 100 | 200 | 300 |
|---|---|---|---|---|
| [A] (M) | 0.800 | 0.400 | 0.200 | 0.100 |

Every 100 s the concentration halves: a constant half-life of 100 s, so the reaction is **first order** with k = 0.693/100 s = 6.93 × 10⁻³ s⁻¹. A zero-order reaction would lose 0.400 M every 100 s and be gone at t = 200 s; a second-order one would take 200 s for the second halving.

**Try it.** A first-order reaction has a half-life of 40.0 s. What fraction of the reactant remains after 120 s?
*Answer:* 120 s is three half-lives: (1/2)³ = 1/8 = 0.125, or 12.5%.

## Reading graphs on the exam

The exam gives you a graph and asks what it means. Three patterns to recognise:

- **ln[A] versus t is a straight line with negative slope:** first order; k = −slope. The y-intercept is ln[A]₀.
- **1/[A] versus t is a straight line with positive slope:** second order; k = +slope. The intercept is 1/[A]₀.
- **[A] versus t is a straight line:** zero order, common for a reaction on a saturated catalyst surface or an enzyme working at full capacity; the rate does not change until the reactant runs out.

A curved [A] versus t plot that flattens out is first or second order; you cannot tell which without linearising. A question that gives two half-lives is a gift: equal half-lives mean first order, a doubling half-life means second order.

Graph description you will see: "A plot of ln[A] against time is linear with slope −0.0231 min⁻¹." That sentence alone tells you first order, k = 0.0231 min⁻¹ and t½ = 0.693/0.0231 = 30.0 min.

## Common mistakes

- Reading orders from the coefficients of the overall balanced equation. Orders come from data (or from a single elementary step, week 18).
- Forgetting the coefficient ratio when converting between the rate of one species and another.
- Writing the units of k the same way for every order. Work them out: M/s divided by Mᵖ.
- Using t½ = 0.693/k for a reaction that is not first order.
- Mixing minutes and seconds inside one calculation; convert before substituting.
- Taking the slope of ln[A] vs t as k instead of −k, or of 1/[A] vs t as −k instead of +k.
- Assuming a rate law with [A]² means the mechanism has two A molecules colliding; it might, but the rate law alone does not prove it.

## Where this goes next

Week 18 explains *why* rate laws look as they do: the collision model, activation energy and the Arrhenius equation, and elementary steps whose rate laws do follow from their coefficients. Week 19 assembles steps into mechanisms and tests them against the rate law you learned to measure this week, then adds catalysts. Half-lives return in Unit 9's kinetic-versus-thermodynamic control, and every equilibrium calculation in Unit 7 starts with the idea that forward and reverse rates become equal.

## Self-check

1. For 2 SO₂(g) + O₂(g) → 2 SO₃(g), SO₃ forms at 0.060 M/s. How fast is O₂ consumed?
2. Doubling [A] quadruples the rate and doubling [B] doubles it. Write the rate law and the units of k.
3. A first-order reaction has k = 2.0 × 10⁻³ s⁻¹. What is its half-life?
4. A reaction's 1/[A] vs t plot is a straight line with slope 0.20 M⁻¹·s⁻¹. If [A]₀ = 0.50 M, what is [A] at 10.0 s?
5. [A] falls from 1.00 M to 0.50 M in 25 s and from 0.50 M to 0.25 M in 50 s. What is the order?

*Answers:* (1) 0.030 M/s. (2) rate = k[A]²[B]; M⁻²·s⁻¹. (3) 0.693/0.0020 = 347 s. (4) 1/[A] = 0.20 × 10.0 + 1/0.50 = 2.0 + 2.0 = 4.0 M⁻¹, so [A] = 0.25 M. (5) The half-life doubles as the concentration halves: second order.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 5.1–5.3). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
