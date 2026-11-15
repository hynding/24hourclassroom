# Week 27 · Simple Harmonic Motion: Definition, Frequency and Period

**Topics:** 7.1 Defining Simple Harmonic Motion (SHM) · 7.2 Frequency and Period of SHM
**Practices:** 1 (Creating Representations: force-versus-displacement tables, free-body diagrams of a bob and a cart), 2 (Mathematical Routines: the period equations, functional dependence, linearising period data), 3 (Scientific Questioning and Argumentation: deciding whether a motion is SHM, predicting how the period responds to a change)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 7, Topics 7.1–7.2, learning objectives in our own words
**Spiral:** Week 10 gave Hooke's law, F_s = kΔx, and the equilibrium stretch of a hanging spring; week 9's free-body diagrams and week 7's Newton's second law turn a force into an acceleration; week 11 and week 19 defined period and frequency for circular and rotational motion; week 26 showed that a satellite's period does not depend on its mass. This week those pieces combine into the model of an oscillator.

## What you need to be able to do

- **7.1** Say what makes a motion simple harmonic: a restoring force (or net force) that points toward the equilibrium position and is proportional to the displacement from it.
- **7.1** Identify the equilibrium position, the displacement and the amplitude of an oscillator, and describe the net force and acceleration at equilibrium and at the turning points.
- **7.1** Explain, with a free-body diagram, why a pendulum is close to SHM only for small angles.
- **7.2** Use T = 1/f, the mass–spring period T = 2π√(m/k) and the pendulum period T = 2π√(L/g).
- **7.2** Predict how the period responds when mass, spring constant, length, g or amplitude changes, and check expressions against limiting cases.
- **7.2** Choose what to graph to linearise period data, and interpret the slope.

## Key terms

| Term | Meaning |
|---|---|
| Equilibrium position | Where the net force on the oscillating object is zero; the centre of the motion. |
| Displacement x | Position measured from equilibrium; positive or negative. |
| Amplitude A | The largest displacement from equilibrium; always positive. |
| Restoring force | The force, or net force, that points back toward equilibrium. |
| Simple harmonic motion | Motion under a restoring force proportional to displacement: F = −kx. |
| Period T | Time for one full cycle, back to the same position moving the same way (s). |
| Frequency f | Cycles per second (Hz = s⁻¹); f = 1/T. |
| Simple pendulum | A small bob on a light string of length L, swinging in a vertical plane. |
| Small-angle approximation | For angles below about 15°, sin θ ≈ θ in radians, so a pendulum's restoring force is nearly proportional to its displacement. |

## Equations

| Relation | Symbols and units |
|---|---|
| F_s = −kx | F_s spring force (N), k spring constant (N/m), x displacement from equilibrium (m); the minus sign says the force points back toward equilibrium. |
| a = −(k/m)x | a acceleration (m/s²), m mass (kg): Newton's second law applied to the spring force. |
| T = 1/f | T period (s), f frequency (Hz). |
| T_s = 2π√(m/k) | Period of a mass on a spring (s). |
| T_p = 2π√(L/g) | Period of a simple pendulum at small angles (s); L length from pivot to the bob's centre (m), g = 9.8 m/s². |
| Δy₀ = mg/k | Equilibrium stretch of a hanging spring (m). |

## What makes a motion simple harmonic (7.1)

An oscillation is any motion that repeats about an equilibrium position. Simple harmonic motion is the special, very common case in which the net force on the object always points toward equilibrium and its size is proportional to the distance from equilibrium. Pull twice as far and the restoring force doubles. Written as an equation, F_net = −kx.

Because a = F_net/m, the acceleration is also proportional to the displacement and opposite to it: a = −(k/m)x. That one fact fixes the whole pattern of the motion:

- **At equilibrium** (x = 0): net force zero, acceleration zero, speed greatest.
- **At a turning point** (x = ±A): the object is momentarily at rest, but the net force and acceleration are largest and point toward equilibrium.
- In between, the object speeds up while moving toward equilibrium (force and velocity in the same direction) and slows down while moving away (force and velocity opposite).

Many motions repeat without being simple harmonic. A ball bouncing on a floor feels a constant gravitational force while it is in the air, not a force proportional to its height. A ball rolling in a V-shaped trough feels a constant-sized force down each side. Both are periodic, neither is SHM.

**Worked example 1: a cart on a spring, as a table.** A 0.50 kg cart on a level, low-friction track is attached to a spring with k = 25 N/m. The horizontal force on it at five positions:

| x (m) | −0.08 | −0.04 | 0 | +0.04 | +0.08 |
|---|---|---|---|---|---|
| F_s (N) | +2.0 | +1.0 | 0 | −1.0 | −2.0 |
| a (m/s²) | +4.0 | +2.0 | 0 | −2.0 | −4.0 |

The free-body diagram at x = +0.08 m: a downward arrow labelled F_g, an upward arrow of equal length labelled F_N, and one horizontal arrow labelled F_s pointing in the −x direction, toward equilibrium. A graph of F against x is a straight line through the origin with slope −25 N/m: proportional and opposite, the signature of SHM. Note that the acceleration at x = +0.08 m is 4.0 m/s² toward equilibrium even though, at the instant the cart is released there, its velocity is zero.

**The pendulum.** A bob of mass m hangs on a string of length L. Pulled aside by an angle θ, its free-body diagram has two arrows: the tension F_T along the string toward the pivot and the weight F_g = mg straight down. Split the weight into a component along the string (mg cos θ) and one along the arc (mg sin θ). The arc component is the restoring force, pointing back toward the lowest point. The arc displacement is s = Lθ, so for SHM we would need the restoring force to be proportional to θ. It is proportional to sin θ instead. For small angles sin θ ≈ θ (in radians), so the restoring force is approximately mg(s/L): proportional to the displacement, and the pendulum is approximately simple harmonic.

**Worked example 2: how small is small?** A 0.20 kg bob on a 0.80 m string is pulled 0.050 m along the arc. Then θ = s/L = 0.0625 rad (3.6°). The exact restoring force is mg sin θ = 0.20 × 9.8 × sin(0.0625) ≈ 0.1224 N; the SHM model gives mg(s/L) = 0.1225 N. They agree to 0.1%. Comparing sin θ with θ at larger angles:

| θ | 10° | 30° | 60° |
|---|---|---|---|
| sin θ | 0.174 | 0.500 | 0.866 |
| θ in radians | 0.175 | 0.524 | 1.047 |
| Model too large by | 0.5% | 4.7% | 21% |

At 60° the force is no longer close to proportional, so a pendulum swinging through 60° is periodic but not simple harmonic, and its period is noticeably longer than 2π√(L/g).

## Frequency and period (7.2)

The period T is the time for one complete cycle and the frequency f = 1/T is the number of cycles each second. A playground swing that goes out and back once every 2.5 s has f = 0.40 Hz.

The two period equations on the AP equation sheet come from the force law above. You do not need to derive the 2π, but you must be able to reason with them.

**Mass on a spring: T_s = 2π√(m/k).** More mass means more inertia for the same restoring force, so slower motion and a longer period. A stiffer spring (larger k) pulls harder at each displacement, so the period is shorter. The amplitude does not appear: if you pull twice as far, the force is twice as large and the cart has twice as far to go, and the two effects cancel exactly. Gravity does not appear either, so a mass–spring oscillator has the same period on the Moon.

**Simple pendulum: T_p = 2π√(L/g).** A longer string gives a longer period; a stronger gravitational field gives a shorter one. The mass cancels: a heavier bob has a proportionally larger restoring force (mg sin θ) and proportionally more inertia, the same reasoning that makes all objects fall with the same acceleration. For small angles the amplitude does not matter either.

**Worked example 3: a cart on a spring, with functional dependence.** A 0.30 kg cart is attached to a spring with k = 12 N/m.

- T = 2π√(0.30/12) = 2π√(0.025) ≈ 0.99 s, and f = 1/T ≈ 1.0 Hz.
- Add 0.90 kg so the mass is four times as large: T ∝ √m, so T doubles to about 1.99 s. Check: 2π√(1.20/12) ≈ 1.99 s.
- Limiting cases: as k grows without limit the period goes to zero (an infinitely stiff spring snaps the cart back instantly); as m goes to zero the period also goes to zero. An expression that failed either check would be wrong.

**Worked example 4: a pendulum clock and the Moon.** A clockmaker wants a pendulum with a 2.0 s period. Solve T = 2π√(L/g) for L: L = g(T/2π)² = 9.8 × (2.0/2π)² ≈ 0.99 m. On the Moon, where g = 1.6 m/s², the same pendulum would have T = 2π√(0.99/1.6), which is 2.0 × √(9.8/1.6) ≈ 2.0 × 2.47 ≈ 4.9 s. The clock would run slow, ticking less than half as often. A mass–spring clock would keep the same time on the Moon.

**Worked example 5: a hanging spring.** A 0.40 kg mass hangs from a spring with k = 20 N/m. At equilibrium the spring force balances the weight: kΔy₀ = mg, so Δy₀ = 0.40 × 9.8/20 ≈ 0.20 m. Pull it down a further 0.03 m and release. Measured from the new equilibrium, the extra spring force is k times the extra stretch, while gravity is unchanged, so the net force is −ky: the same law as horizontally. The period is 2π√(0.40/20) ≈ 0.89 s, exactly as it would be on a level track. Gravity only moves the centre of the oscillation.

**Linearising period data.** To find k in the lab, hang several masses and time each period. T against m is a curve (T ∝ √m). Squaring the equation gives T² = (4π²/k)m, so a graph of T² against m is a straight line through the origin with slope 4π²/k, and k = 4π²/slope. For a pendulum, T² = (4π²/g)L, so T² against L has slope 4π²/g. Time 10 or 20 full cycles and divide, rather than timing one: your reaction time is the same for one cycle or twenty, so its share of the measured time shrinks.

## Common mistakes

- **Thinking the acceleration is zero at a turning point** because the velocity is zero there. It is the largest there.
- **Calling every repeating motion SHM.** The restoring force must be proportional to displacement; a bouncing ball is not SHM.
- **Putting mass in the pendulum period** ("a heavier bob swings slower") or **leaving it out of the spring period.**
- **Thinking amplitude changes the period** of an ideal oscillator. It changes the speed, not the time per cycle.
- **Forgetting the square root:** quadrupling L or m doubles T; it does not quadruple it.
- **Inverting the pendulum equation** to √(g/L), which makes a longer pendulum faster. Check: a longer swing is slower.
- **Measuring L to the top of the bob** instead of its centre, or timing a single swing.

## Self-check

1. A 0.50 kg mass on a spring with k = 200 N/m oscillates. Find its period and frequency.
2. A cart oscillating on a spring is at x = −A. Give the direction of its velocity, acceleration and net force.
3. Find the period of a 0.40 m pendulum.
4. A pendulum's length is multiplied by 9. What happens to its period?
5. Is a pendulum released from 50° undergoing SHM? Explain in one sentence.
6. A student graphs T² against m for a spring and gets a slope of 0.80 s²/kg. Find k.

*Answers:* 1. T = 2π√(0.50/200) ≈ 0.31 s; f ≈ 3.2 Hz. 2. Velocity zero (momentarily at rest); acceleration and net force in the +x direction, toward equilibrium, and at their largest. 3. T = 2π√(0.40/9.8) ≈ 1.27 s. 4. It triples (T ∝ √L). 5. Not quite: at 50° the restoring force mg sin θ is no longer close to proportional to θ, so the motion is periodic but not simple harmonic. 6. k = 4π²/0.80 ≈ 49 N/m.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 7, Topics 7.1–7.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
