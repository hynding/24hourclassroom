# Week 28 · Representing SHM and the Energy of Oscillators

**Topics:** 7.3 Representing and Analyzing SHM · 7.4 Energy of Simple Harmonic Oscillators
**Practices:** 1 (Creating Representations: position, velocity and acceleration graphs as tables and descriptions, energy bar charts), 2 (Mathematical Routines: x = A cos(2πft), total energy ½kA², maximum speed), 3 (Scientific Questioning and Argumentation: matching graphs to each other, predicting how energy and speed respond to a change in amplitude, mass or spring)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 7, Topics 7.3–7.4, learning objectives in our own words
**Spiral:** Week 27 defined SHM (F_net = −kx) and gave the periods 2π√(m/k) and 2π√(L/g). Week 2 read velocity from the slope of a position–time graph; weeks 12–14 built kinetic energy, spring potential energy ½kx², gravitational potential energy mgh, energy bar charts and conservation of mechanical energy. This week puts those representations onto an oscillator.

## What you need to be able to do

- **7.3** Describe the position of an oscillator over time as a cosine or sine graph (or table), and read amplitude, period and frequency from a graph, a table or an equation x = A cos(2πft).
- **7.3** Sketch, describe or choose the velocity and acceleration graphs that match a position graph, using slopes and a = −(k/m)x.
- **7.3** Locate where in a cycle the speed, the acceleration and the net force are largest and zero.
- **7.4** Track the exchange of kinetic and potential energy during an oscillation with energy bar charts.
- **7.4** Use E = ½kA² and the conservation of mechanical energy to find speeds and positions, including the maximum speed.
- **7.4** Predict how total energy, maximum speed and period respond when amplitude, mass or spring constant changes.

## Key terms

| Term | Meaning |
|---|---|
| Sinusoidal graph | A smooth repeating wave shape, like a cosine or sine curve. |
| Cosine start | x = A cos(2πft): the object starts at x = +A, at rest (released from rest at maximum displacement). |
| Sine start | x = A sin(2πft): the object starts at x = 0, moving in the +x direction at top speed. |
| Turning point | x = ±A: velocity zero, acceleration largest. |
| Total mechanical energy E | K + U for the oscillator system; constant without friction. |
| Energy bar chart | A table or bar diagram of K, U_g, U_s at chosen instants, with any energy transferred in or out. |
| Maximum speed v_max | The speed at equilibrium, where all the energy is kinetic. |

## Equations

| Relation | Symbols and units |
|---|---|
| x = A cos(2πft) or x = A sin(2πft) | x position from equilibrium (m), A amplitude (m), f frequency (Hz), t time (s); the angle 2πft is in radians. |
| K = ½mv² | K kinetic energy (J), m mass (kg), v speed (m/s). |
| U_s = ½kx² | U_s spring potential energy (J), k spring constant (N/m). |
| E = K + U_s = ½kA² | Total energy of a mass–spring oscillator (J). |
| ½mv_max² = ½kA², so v_max = A√(k/m) = 2πA/T | Maximum speed at equilibrium (m/s). |
| U_g = mgh | Gravitational potential energy of a pendulum bob h above its lowest point (J). |

## Representing SHM (7.3)

An object in SHM traces out a sinusoidal position–time graph. Hold a pen against a sheet of paper moving steadily past a bobbing mass and the trace is a cosine wave. The two standard forms on the equation sheet differ only in where the clock starts:

- **x = A cos(2πft)** if the object is released from rest at x = +A at t = 0.
- **x = A sin(2πft)** if at t = 0 the object passes through equilibrium moving in the +x direction.

The angle 2πft is in **radians**: set your calculator to radian mode. After one period, t = T and 2πfT = 2π, one full cycle.

**Matching the three graphs.** Velocity is the slope of the position graph, and acceleration is −(k/m) times the position.

| Instant in the cycle | x | Slope of x–t (velocity) | Acceleration |
|---|---|---|---|
| t = 0 (released at +A) | +A, peak | zero | largest, negative |
| t = T/4 | 0 | steepest downhill: largest speed, moving −x | zero |
| t = T/2 | −A, trough | zero | largest, positive |
| t = 3T/4 | 0 | steepest uphill: largest speed, moving +x | zero |
| t = T | +A | zero | largest, negative |

So for a cosine position graph, the velocity graph starts at zero and goes negative first (an upside-down sine), and the acceleration graph is the position graph flipped upside down (a negative cosine). Velocity peaks a quarter period away from position peaks. A graph of acceleration against position is a straight line through the origin with slope −k/m: that line is the definition of SHM in graphical form.

**Worked example 1: a cart as a table.** A cart on a spring is released from rest at x = +0.10 m and has period 2.0 s, so x = (0.10 m) cos(2π(0.50 Hz)t).

| t (s) | 0 | 0.25 | 0.50 | 0.75 | 1.00 | 1.25 | 1.50 | 1.75 | 2.00 |
|---|---|---|---|---|---|---|---|---|---|
| x (m) | 0.100 | 0.071 | 0 | −0.071 | −0.100 | −0.071 | 0 | 0.071 | 0.100 |
| Moving | at rest | −x | −x, fastest | −x | at rest | +x | +x, fastest | +x | at rest |

Two features to notice. First, the cart covers 0.029 m in the first quarter-second but 0.071 m in the next: it is slow near the turning points and fast near the middle, so the curve is flat at peaks and steep at crossings. Second, the cart travels 4A = 0.40 m in each full period, so its average speed over a cycle is 0.40 m / 2.0 s = 0.20 m/s, less than its maximum speed (worked out below).

**Worked example 2: reading an equation.** An oscillating air-track glider follows x = (0.040 m) cos(2π(5.0 Hz)t). Read off A = 0.040 m and f = 5.0 Hz, so T = 1/f = 0.20 s. At t = 0.025 s (one-eighth of a period) the angle is 2π(5.0)(0.025) = π/4 rad, and x = 0.040 cos(π/4) ≈ 0.028 m. At t = 0.050 s (a quarter period) x = 0, the glider is at top speed; at t = 0.10 s (half a period) x = −0.040 m, momentarily at rest. A frequent slip is reading the 0.040 as the peak-to-peak distance (that is 2A = 0.080 m) or reading 5.0 as the period.

## Energy of simple harmonic oscillators (7.4)

For a mass on a horizontal spring with no friction, the system of block and spring has constant mechanical energy. It moves back and forth between two stores:

- At x = ±A the block is at rest, so K = 0 and all the energy is spring potential energy: **E = ½kA²**.
- At x = 0 the spring is relaxed, so U_s = 0 and all the energy is kinetic: E = ½mv_max².
- Anywhere in between, ½mv² + ½kx² = ½kA².

Since the total energy is fixed by the amplitude, a larger amplitude means more energy. Doubling A multiplies E by 4 and v_max by 2; the period does not change.

**Worked example 3: an energy bar chart.** A 0.50 kg block on a spring with k = 50 N/m is pulled to x = 0.10 m and released on a frictionless surface. Total energy E = ½(50)(0.10)² = 0.25 J.

| Position | U_s (J) | K (J) | E (J) | Speed (m/s) |
|---|---|---|---|---|
| x = 0.10 m (release) | 0.25 | 0 | 0.25 | 0 |
| x = 0.05 m (half the amplitude) | 0.0625 | 0.1875 | 0.25 | 0.87 |
| x = 0 (equilibrium) | 0 | 0.25 | 0.25 | 1.0 |

At half the amplitude, U_s = ½k(A/2)² is only **one quarter** of E, because potential energy goes with x². Three quarters of the energy is kinetic, so v = √(2 × 0.1875/0.50) ≈ 0.87 m/s, or 87% of v_max. The bar chart, if drawn, would show the U_s bar shrinking from 4 units to 1 to 0 while the K bar grows from 0 to 3 to 4, with no energy transferred out of the system.

**Worked example 4: maximum speed and functional dependence.** For that block, v_max = A√(k/m) = 0.10 × √(50/0.50) = 1.0 m/s. The period is T = 2π√(0.50/50) ≈ 0.63 s, and 2πA/T = 2π(0.10)/0.628 ≈ 1.0 m/s, the same result from the period. Now check how v_max = A√(k/m) behaves:

- Double A: E × 4, v_max × 2, T unchanged.
- Double m (same k, same A): E unchanged (it depends on k and A only), v_max ÷ √2, T × √2.
- Limiting case: as m approaches zero, v_max grows without limit, as expected for a massless object pushed by a spring; as A approaches zero, there is no motion and no energy.

**Worked example 5: a pendulum's energy.** A 0.30 kg bob on a 1.0 m string is released from rest at 12° from the vertical. Its height above the lowest point is h = L(1 − cos θ) = 1.0(1 − cos 12°) ≈ 0.022 m. Taking the bob and Earth as the system, with the tension doing no work (it is always perpendicular to the motion):

| Position | U_g (J) | K (J) |
|---|---|---|
| Release, 12° | 0.064 | 0 |
| Lowest point | 0 | 0.064 |

So ½mv² = mgh gives v = √(2gh) = √(2 × 9.8 × 0.022) ≈ 0.65 m/s at the bottom. Notice that the mass cancels, and that the period, 2π√(1.0/9.8) ≈ 2.0 s, did not enter at all. Released from a larger (still small) angle, the bob would be faster at the bottom but would keep the same period.

**Hanging springs.** For a mass bobbing on a vertical spring, the energy has three stores: K, U_s and U_g. The bookkeeping still works, and the bar charts must show all three. A useful shortcut: measured from the hanging equilibrium position, the motion is the same SHM as on a table, with E = ½kA² for the oscillation itself.

## Common mistakes

- **Thinking the acceleration is greatest where the speed is greatest.** They are a quarter cycle apart: speed is largest at x = 0, acceleration at x = ±A.
- **Assuming energy splits evenly at half the amplitude.** At x = A/2, U_s = E/4 and K = 3E/4.
- **Using average speed (4A/T) for the maximum speed**, or forgetting that v_max = 2πA/T.
- **Reading the period from a graph as the time between a peak and the next trough** (that is T/2), or reading A as the peak-to-peak height.
- **Leaving the calculator in degrees** when evaluating cos(2πft).
- **Thinking a heavier block on the same spring at the same amplitude has more energy.** E = ½kA² does not contain m.
- **Leaving U_g out of a hanging spring's or pendulum's bar chart.**

## Self-check

1. A cart follows x = (0.060 m) cos(2π(2.0 Hz)t). Give its amplitude, period, and position at t = 0.25 s.
2. The position graph of an oscillator is a sine curve starting at zero and rising. Describe its velocity graph at t = 0.
3. A spring with k = 80 N/m holds a 0.20 kg block oscillating with amplitude 0.050 m. Find the total energy and the maximum speed.
4. What fraction of the energy is kinetic when the block in question 3 is at x = 0.025 m?
5. A block has v_max = 1.5 m/s with amplitude 0.05 m. How fast is it moving at x = 0.03 m?
6. The amplitude of an oscillator is tripled. What happens to E, v_max and T?

*Answers:* 1. A = 0.060 m, T = 0.50 s; at t = 0.25 s (half a period) x = −0.060 m. 2. It starts at its largest positive value (the slope of the position graph is steepest there); the velocity graph is a cosine. 3. E = ½(80)(0.050)² = 0.10 J; v_max = 0.050√(80/0.20) = 1.0 m/s. 4. Three quarters (U_s is one quarter at half the amplitude). 5. v = v_max√(1 − x²/A²) = 1.5 × √(1 − 0.36) = 1.5 × 0.8 = 1.2 m/s. 6. E × 9, v_max × 3, T unchanged.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 7, Topics 7.3–7.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
