# Unit 5 · Kinetics · The night-before sheet

**Exam weight:** about 7–9% of the AP exam · **CED topics:** 5.1 Reaction Rates · 5.2 Introduction to Rate Law · 5.3 Concentration Changes Over Time · 5.4 Elementary Reactions · 5.5 Collision Model · 5.6 Reaction Energy Profile · 5.7 Introduction to Reaction Mechanisms · 5.8 Reaction Mechanism and Rate Law · 5.9 Steady-State Approximation · 5.10 Multistep Reaction Energy Profile · 5.11 Catalysis
**Practices:** 1 (Models and Representations), 3 (Representing Data and Phenomena), 4 (Model Analysis), 5 (Mathematical Routines), 6 (Argumentation)
**Weeks:** 17 (rates and rate laws), 18 (collisions, Ea, elementary steps), 19 (mechanisms and catalysis)

## The ideas that generate every question

1. **Rate is a slope.** Rate = −Δ[reactant]/Δt = +Δ[product]/Δt, divided by the coefficient so every species gives one number. A species with coefficient 2 changes twice as fast as one with coefficient 1.
2. **Orders come from data, never from the overall equation.** rate = k[A]ᵐ[B]ⁿ; compare two experiments that differ in one concentration and ask what power of the ratio gives the rate ratio. The only exception is an elementary step, whose coefficients are its orders.
3. **Three integrated rate laws, three straight lines.** [A] vs t (zero order, slope −k), ln[A] vs t (first order, slope −k), 1/[A] vs t (second order, slope +k). First-order half-life 0.693/k is constant; second-order half-life doubles each time; zero-order half-life halves.
4. **A collision must be energetic enough and correctly oriented.** Concentration raises the number of collisions; temperature raises the fraction with energy above Ea (the Maxwell–Boltzmann tail), which is why k = A e^(−Ea/RT) is so sensitive to T; orientation lives in A.
5. **The energy profile separates speed from heat.** Ea (reactants to peak) controls rate; ΔH (valley to valley) controls heat. Ea(reverse) = Ea(forward) − ΔH. Catalysts lower the peak and leave the valleys alone.
6. **A mechanism is a hypothesis.** Steps must add to the overall equation (intermediates cancel), each step must be reasonable (uni- or bimolecular), and the rate-determining step must reproduce the measured rate law, with intermediates replaced through a fast equilibrium or the steady state. A match supports; a mismatch refutes.

## Key formulas and data

| Quantity | Formula or value | Notes |
|---|---|---|
| Rate for a A + b B → c C | rate = −(1/a)Δ[A]/Δt = −(1/b)Δ[B]/Δt = (1/c)Δ[C]/Δt | Units M/s |
| Order from two runs | rate₂/rate₁ = ([A]₂/[A]₁)ᵐ, so m = log(rate ratio)/log(conc ratio) | only one concentration changed |
| Units of k | M¹⁻ᵖ·s⁻¹ for overall order p | s⁻¹ (1st), M⁻¹·s⁻¹ (2nd), M/s (0th) |
| Zero order | [A]ₜ = −kt + [A]₀; t½ = [A]₀/(2k) | plot [A] vs t |
| First order | ln[A]ₜ = −kt + ln[A]₀; t½ = 0.693/k | plot ln[A] vs t; fraction left after n half-lives = (1/2)ⁿ |
| Second order | 1/[A]ₜ = kt + 1/[A]₀; t½ = 1/(k[A]₀) | plot 1/[A] vs t |
| Arrhenius | k = A e^(−Ea/RT); ln k = −(Ea/R)(1/T) + ln A | slope of ln k vs 1/T is −Ea/R |
| Two temperatures | ln(k₂/k₁) = −(Ea/R)(1/T₂ − 1/T₁) | R = 8.314 J/(mol·K); T in K; Ea in J/mol |
| Elementary step rate law | A + B → : k[A][B]; 2 A → : k[A]²; A → : k[A] | coefficients = orders only here |
| Pre-equilibrium | [intermediate] = K₁ × (reactant concentrations) | substitute into the slow step's rate law |
| Steady state | formation of intermediate = consumption | contains pre-equilibrium as a limit |
| Ea(reverse) | Ea(forward) − ΔH | both from the same profile |
| Gas concentration | [gas] = P/(RT) | R = 0.08206 L·atm/(mol·K) |

## Reading the three kinds of graph

- **Concentration against time:** curved and flattening for first or second order; straight for zero order. Equal half-lives → first order; doubling half-lives → second order.
- **Linearised plots:** whichever of [A], ln[A], 1/[A] is straight names the order; the slope's magnitude is k (sign negative for zero and first order, positive for second).
- **Energy profiles:** peaks are transition states, valleys between peaks are intermediates, one peak per step, the step with the largest climb from its own valley is rate-determining, ΔH is last valley minus first. A catalysed profile has more, lower hills with the same ends.
- **Maxwell–Boltzmann:** hotter curve is lower, broader, peaked further right, same area; the area beyond Ea is the reacting fraction. A catalyst moves the Ea line left; concentration does nothing to this plot.

## Common errors

- Reading orders from coefficients of the overall equation.
- Forgetting the coefficient ratio when converting rates between species.
- Giving k the wrong units, or using 0.693/k for a reaction that is not first order.
- Mixing minutes and seconds, or °C and K, or kJ and J inside one calculation.
- Taking the slope of ln k vs 1/T as Ea (it is −Ea/R).
- Leaving an intermediate in a predicted rate law.
- Saying a reactant absent from the rate law "does not react" (it reacts after the slow step).
- Confusing intermediate (valley) with transition state (peak), or catalyst (in first, out later) with intermediate (out first, in later).
- Claiming a catalyst changes ΔH, K or the equilibrium position.
- Explaining the temperature effect by collision frequency alone; the fraction above Ea is the main effect.

## Worked example: a complete kinetics problem

The reaction 2 NO(g) + 2 H₂(g) → N₂(g) + 2 H₂O(g) gives these initial rates at 1,000 K:

| Experiment | [NO]₀ (M) | [H₂]₀ (M) | Initial rate (M/s) |
|---|---|---|---|
| 1 | 0.10 | 0.10 | 1.2 × 10⁻³ |
| 2 | 0.20 | 0.10 | 4.8 × 10⁻³ |
| 3 | 0.10 | 0.20 | 2.4 × 10⁻³ |

**Orders.** 1 → 2: [NO] doubles, rate × 4 → second order in NO. 1 → 3: [H₂] doubles, rate × 2 → first order in H₂. Rate = k[NO]²[H₂], third order overall.

**k.** From experiment 1: k = 1.2 × 10⁻³ / ((0.10)² × 0.10) = 1.2 × 10⁻³ / 1.0 × 10⁻³ = 1.2 M⁻²·s⁻¹.

**Mechanism check.** Proposed: Step 1 (fast equilibrium) 2 NO ⇌ N₂O₂; Step 2 (slow) N₂O₂ + H₂ → N₂O + H₂O; Step 3 (fast) N₂O + H₂ → N₂ + H₂O. Sum: 2 NO + 2 H₂ → N₂ + 2 H₂O ✓. Intermediates: N₂O₂ and N₂O. Slow step: rate = k₂[N₂O₂][H₂] = k₂K₁[NO]²[H₂] ✓ matches. Consistent (not proved).

**Temperature.** If k is 1.2 M⁻²·s⁻¹ at 1,000 K and 9.6 M⁻²·s⁻¹ at 1,100 K: ln(9.6/1.2) = ln 8 = 2.079; 1/1,100 − 1/1,000 = −9.09 × 10⁻⁵; Ea = −8.314 × 2.079/(−9.09 × 10⁻⁵) = 1.9 × 10⁵ J/mol = 190 kJ/mol.

**Rate of another species.** When NO is consumed at 1.2 × 10⁻³ M/s, N₂ forms at half that, 6.0 × 10⁻⁴ M/s, and H₂O forms at 1.2 × 10⁻³ M/s.

## What to review from earlier units

- **Unit 3:** the Maxwell–Boltzmann distribution (3.5) is the heart of the temperature argument; PV = nRT (3.4) converts pressure data to concentration; Beer–Lambert (3.13) is how a spectrometer follows a coloured reactant; molarity and dilution (3.7) give the concentrations after mixing.
- **Unit 4:** mole ratios (4.5) link the rates of different species; oxidation numbers (4.9) explain what a catalytic converter does; acid–base ideas (4.8) underlie acid catalysis.
- **Unit 2:** the potential energy of a bond against distance (2.2) is where the vertical axis of a profile comes from.

## The unit exam

Forty items, about 80 minutes, every topic from 5.1 to 5.11 plus review. Three stimulus sets (an initial-rate table, a concentration–time table, a two-step energy profile), stand-alone multiple choice, select-all, true/false, fill-in-the-blank and four numeric calculations (a rate constant with units, a first-order concentration at a later time, an Arrhenius activation energy, a catalysed rate ratio), two short-answer questions (one on deriving a rate law from a mechanism, one on an energy-profile interpretation) and one long free-response question built around a lab data set. Bring the equations sheet: the integrated rate laws and the Arrhenius equation are on it, the units of k are not.

---

*Original study material written for this course and organised around the College Board AP Chemistry Course and Exam Description (topics 5.1–5.11). Constants and data are public domain, from U.S. government sources (NIST Chemistry WebBook, NIST CODATA constants, PubChem), rounded as the AP equations sheet does. Accessed 2026-10-16.*
