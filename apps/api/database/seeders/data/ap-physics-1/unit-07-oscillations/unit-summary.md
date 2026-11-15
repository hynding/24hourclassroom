# Unit 7 · Oscillations · The night-before sheet

**AP exam weight:** 5–8% of the multiple-choice section; oscillators also turn up in free-response questions as lab-design and energy problems
**Topics:** 7.1 Defining Simple Harmonic Motion (SHM) · 7.2 Frequency and Period of SHM · 7.3 Representing and Analyzing SHM · 7.4 Energy of Simple Harmonic Oscillators
**Practices:** 1 (Creating Representations), 2 (Mathematical Routines), 3 (Scientific Questioning and Argumentation)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 7, Topics 7.1–7.4, in our own words

## The ideas that generate every question

1. **SHM is defined by its force (7.1).** An object moves in simple harmonic motion when the net force on it points toward the equilibrium position and is proportional to the displacement: F_net = −kx. Then a = −(k/m)x. Periodic is not enough: a bouncing ball and a marble in a V-shaped trough repeat, but their forces are not proportional to displacement.
2. **Where things are largest (7.1, 7.3).** At equilibrium: net force and acceleration zero, speed largest. At the turning points x = ±A: velocity zero, net force and acceleration largest, pointing back toward equilibrium. Speed and acceleration peak a quarter of a cycle apart.
3. **A pendulum is SHM only approximately (7.1).** Its restoring force is the component of gravity along the arc, mg sin θ. For small angles sin θ ≈ θ (radians), so the force is nearly proportional to the arc displacement. At large angles (say 60°) the motion is periodic but not SHM.
4. **Two period equations, and what is missing from them (7.2).** T_s = 2π√(m/k) and T_p = 2π√(L/g). Neither contains the amplitude. The spring has no g; the pendulum has no m. Use T = 1/f.
5. **Position is a sinusoid (7.3).** x = A cos(2πft) for release from rest at +A; x = A sin(2πft) for passing equilibrium in the +x direction at t = 0. Velocity is the slope of x–t, and acceleration is −(k/m) times x, so the acceleration graph is the position graph flipped.
6. **Energy sloshes between two stores (7.4).** Without friction, K + U is constant. For a spring, E = ½kA² = ½mv_max², and ½mv² + ½kx² = ½kA² at every point. For a pendulum the stores are K and U_g. A hanging spring has all three.

## Functional dependence at a glance

| Change (others fixed) | Period T | Total energy E | Maximum speed v_max |
|---|---|---|---|
| Mass × 4 (spring) | × 2 | unchanged (same A) | ÷ 2 |
| Spring constant × 4 | ÷ 2 | × 4 (same A) | × 2 |
| Amplitude × 2 | unchanged | × 4 | × 2 |
| Pendulum length × 4 | × 2 | n/a | n/a |
| Pendulum mass × 2 | unchanged | n/a | n/a |
| g ÷ 2 (pendulum) | × √2 | n/a | n/a |
| g changed (spring) | unchanged | unchanged | unchanged |

Check every new expression against a limiting case: a stiffer spring (k growing without limit) should give a shorter period; a massless block should move infinitely fast; zero amplitude should give zero energy.

## Equations to know

| Relation | Use it for |
|---|---|
| F_s = −kx, a = −(k/m)x | Testing for SHM; acceleration at any position. |
| T = 1/f | Converting period and frequency; counting cycles in a time. |
| T_s = 2π√(m/k) | Mass–spring period, horizontal or hanging. |
| T_p = 2π√(L/g) | Small-angle pendulum period; L to the bob's centre. |
| x = A cos(2πft), x = A sin(2πft) | Position at a given time; reading A and f from an equation (radian mode). |
| U_s = ½kx², K = ½mv², U_g = mgh | Energy bar charts. |
| E = ½kA² | Total energy of a mass–spring oscillator. |
| v_max = A√(k/m) = 2πA/T | Speed at equilibrium. |
| v = √((k/m)(A² − x²)) | Speed at any position. |
| Δy₀ = mg/k | Where a hanging spring's oscillation is centred. |

## Representations, and how to read them

**Position–time graph or table.** Amplitude: centre line to peak (not trough to peak). Period: peak to next peak (peak to trough is T/2). The steepest parts, at x = 0, are the fastest moments; the flat peaks and troughs are the turning points. In one period the object travels 4A.

**Velocity and acceleration graphs.** For a cosine position graph, velocity starts at zero and goes negative first (an upside-down sine); acceleration starts at its most negative (an upside-down cosine). A graph of a against x is a straight line through the origin with slope −k/m.

**Energy bar charts (as tables).** At x = ±A: all U_s. At x = 0: all K. At x = A/2: U_s = E/4, K = 3E/4 (not half and half: U_s goes with x²). Even split at x = A/√2 ≈ 0.71A. A pendulum's chart swaps U_g and K; a hanging spring's chart needs K, U_g and U_s, and only their total is constant.

**Free-body diagrams.** Horizontal spring at x > 0: F_g down, F_N up, spring force toward equilibrium. Cart between two springs displaced right: both spring forces point left, giving F_net = −(k₁ + k₂)x. Pendulum bob: tension along the string to the pivot, weight straight down; the restoring force is the weight's component mg sin θ along the arc, not a separate arrow.

## Lab moves that earn points

- **Linearise.** T² = (4π²/k)m: graph T² against m; k = 4π²/slope. T² = (4π²/g)L: graph T² against L; g = 4π²/slope.
- **Reduce uncertainty.** Time 10 or 20 cycles and divide; repeat and average; start the timer as the object passes equilibrium (it is moving fastest there, so the instant is sharpest); keep a pendulum's angle small; measure L to the centre of the bob.
- **Systematic errors.** A constant offset in L (measured to the top of the bob) shifts the line but leaves the slope, and so g, unchanged. A large release angle makes measured periods too long, and the error grows with amplitude.

## Reasoning moves that earn points

- **Claim, evidence, reasoning for "does the period change?"** Name what changes in the force and what changes in the inertia, and say whether they scale together. Heavier pendulum bob: force and inertia both scale with m, so no change. Heavier block on a spring: inertia grows, spring force does not, so the period grows.
- **Use energy for speeds, the period equations for times.** A larger amplitude makes the motion faster but not quicker per cycle.
- **Collisions that start an oscillation.** Use momentum for the collision (it is quick, so the spring's impulse is negligible), then energy for the oscillation. The new period uses the new oscillating mass.
- **Keep the derivation and the paragraph in agreement.** If your argument says mass cancels, your algebra must show m cancelling.

## Common errors

- Zero acceleration at a turning point because the velocity is zero there.
- Calling every periodic motion SHM, or treating a 60° pendulum as SHM.
- Putting mass in the pendulum period, or g in the spring period.
- Forgetting the square roots: × 4 in m or L gives × 2 in T.
- Inverting the pendulum period to √(g/L).
- Using the average speed 4A/T as the maximum speed.
- Splitting energy evenly at half the amplitude.
- Leaving the calculator in degrees for cos(2πft).
- Leaving U_g out of a hanging spring's energy bar chart.

## Quick self-test

1. A 0.25 kg block on a 64 N/m spring: period?
2. A pendulum clock runs fast. Lengthen or shorten the pendulum?
3. x = (0.050 m) cos(2π(4.0 Hz)t): amplitude, period, position at t = 0.125 s?
4. A 0.50 kg block, k = 50 N/m, A = 0.10 m: total energy and speed at x = 0.060 m?
5. Graph that linearises pendulum data, and how g follows from its slope?
6. Amplitude tripled: what happens to E, v_max and T?

**Answers.** 1. 2π√(0.25/64) ≈ 0.39 s. 2. Lengthen it: a fast clock's period is too short, and T ∝ √L. 3. A = 0.050 m, T = 0.25 s; at half a period x = −0.050 m. 4. E = 0.25 J; v = √(100 × (0.010 − 0.0036)) = 0.80 m/s. 5. T² against L; g = 4π²/slope. 6. E × 9, v_max × 3, T unchanged.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 7, Topics 7.1–7.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
