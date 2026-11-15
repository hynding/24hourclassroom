# Week 18 · Elastic and Inelastic Collisions

**Topics:** 4.4 Elastic and Inelastic Collisions
**Practices:** 1 (Creating Representations: before/after energy tables and bar charts), 2 (Mathematical Routines: solving collisions with momentum and energy, two-stage problems), 3 (Scientific Questioning and Argumentation: classifying collisions from data, limiting-case reasoning)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 4, Topic 4.4, learning objectives in our own words
**Spiral:** Week 12 defined kinetic energy; weeks 13–14 added potential energy and conservation of energy, including energy that becomes internal energy; week 16 compared momentum with kinetic energy; week 17 established that momentum is conserved for an isolated system. This week asks the next question about every collision: what happened to the kinetic energy?

## What you need to be able to do

- **4.4** Classify a collision as elastic, inelastic or perfectly inelastic by comparing the system's total kinetic energy before and after.
- **4.4** Explain that momentum is conserved in all three kinds when the net external impulse is negligible, and say where "lost" kinetic energy goes.
- **4.4** Calculate the final velocity and the kinetic energy converted in a perfectly inelastic collision.
- **4.4** Use the relative-speed test and the head-on elastic results for a target at rest, and check them against limiting cases.
- **4.4** Solve two-stage problems (a collision followed by a swing, slide or spring compression), using momentum for the collision and energy for the other stage.
- **4.4** Represent a collision with an energy table or bar chart that keeps total energy constant.

## Key terms

| Term | Meaning |
|---|---|
| Elastic collision | The system's total kinetic energy is the same before and after. |
| Inelastic collision | Total kinetic energy decreases; the difference becomes internal energy, sound or deformation. |
| Perfectly inelastic collision | The objects stick together and share one final velocity: the largest possible kinetic-energy loss. |
| Internal energy, E_int | Energy of the random motion and arrangement of a system's particles; it rises when objects warm or deform. |
| Relative speed | The rate at which two objects approach (before) or separate (after). Equal for an elastic head-on collision. |
| Two-stage problem | A collision (momentum conserved) joined to a motion where mechanical energy is conserved. |

## Equations

| Relation | Symbols and units |
|---|---|
| m₁v₁ᵢ + m₂v₂ᵢ = m₁v₁f + m₂v₂f | every collision of an isolated system; m in kg, v in m/s |
| ½m₁v₁ᵢ² + ½m₂v₂ᵢ² = ½m₁v₁f² + ½m₂v₂f² | elastic collisions only; energies in J |
| v_f = (m₁v₁ᵢ + m₂v₂ᵢ)/(m₁ + m₂) | perfectly inelastic (common final velocity) |
| ΔE_int = K_before − K_after | kinetic energy converted, J |
| v₁f = (m₁ − m₂)v/(m₁ + m₂), v₂f = 2m₁v/(m₁ + m₂) | elastic head-on, m₂ at rest, m₁ at velocity v |
| v₁ᵢ − v₂ᵢ = −(v₁f − v₂f) | elastic head-on: relative velocity reverses |

## Classifying collisions

Momentum conservation depends only on external impulse, so it holds in every collision of an isolated system. Kinetic energy is a different story: during a collision the objects deform. If they spring back fully, as steel balls or magnetic bumpers nearly do, the stored energy returns as kinetic energy and the collision is **elastic**. If some deformation is permanent, or the objects warm up and make a sound, kinetic energy becomes internal energy and the collision is **inelastic**. If they stick together it is **perfectly inelastic**. Total energy is always conserved; the question is only how much stays kinetic.

**Worked example 1: carts that stick.** A 0.80 kg cart moving at 1.5 m/s hits a 0.40 kg cart at rest, and Velcro joins them.

- Momentum: (0.80)(1.5) = (1.20)v, so v = 1.0 m/s.
- Energy table for the two-cart system:

| State | K₁ (J) | K₂ (J) | K_total (J) | ΔE_int (J) |
|---|---|---|---|---|
| Before | 0.90 | 0 | 0.90 | 0 |
| After | 0.40 | 0.20 | 0.60 | 0.30 |

One third of the kinetic energy (0.30 J) became internal energy. In general, when a moving object sticks to a target at rest, the fraction lost is m_target/(m_moving + m_target): here 0.40/1.20 = 1/3. Limiting cases check the formula: a tiny target (fraction → 0) barely slows the projectile, and a huge target (fraction → 1) stops it and absorbs almost everything. And two objects with equal and opposite momenta that stick lose **all** their kinetic energy, because they end at rest.

## Elastic collisions

For an elastic collision both conservation laws hold, which gives two equations for the two unknown final velocities. For the common case of a head-on collision with the target at rest, solving them gives

v₁f = (m₁ − m₂)v/(m₁ + m₂) and v₂f = 2m₁v/(m₁ + m₂).

You can also use a quicker test: in an elastic head-on collision **the objects separate at the same speed at which they approached**.

**Worked example 2: magnetic bumpers, checked three ways.** A 0.50 kg cart at 2.0 m/s hits a 0.30 kg cart at rest; magnetic bumpers make the collision elastic.

- v₁f = (0.50 − 0.30)(2.0)/0.80 = 0.50 m/s; v₂f = 2(0.50)(2.0)/0.80 = 2.5 m/s.
- Momentum check: 1.0 kg·m/s before; (0.50)(0.50) + (0.30)(2.5) = 0.25 + 0.75 = 1.0 kg·m/s after.
- Energy check: 1.0 J before; ½(0.50)(0.50)² + ½(0.30)(2.5)² = 0.0625 + 0.9375 = 1.0 J after.
- Relative speed: approach 2.0 m/s; separation 2.5 − 0.50 = 2.0 m/s.

**Limiting cases of the elastic formulas** (a favourite AP reasoning task):

| Situation | v₁f | v₂f | Everyday picture |
|---|---|---|---|
| m₁ = m₂ | 0 | v | Billiard balls exchange velocities |
| m₁ much greater than m₂ | ≈ v | ≈ 2v | Bowling ball hits a table-tennis ball |
| m₁ much less than m₂ | ≈ −v | ≈ 0 | Ball bounces off a wall |

The middle row surprises people: the light target leaves at twice the heavy ball's speed, because it must separate at the approach speed v from a heavy ball that is still moving at about v.

## Classifying from data

**Worked example 3: is this collision elastic?** On a level track, a 1.2 kg cart moving at +0.60 m/s meets a 0.80 kg cart moving at −0.40 m/s. Afterwards the 1.2 kg cart moves at −0.20 m/s. Find the other cart's velocity and classify the collision.

- Momentum before: (1.2)(0.60) + (0.80)(−0.40) = 0.72 − 0.32 = 0.40 kg·m/s.
- After: (1.2)(−0.20) + 0.80v = 0.40, so v = (0.40 + 0.24)/0.80 = +0.80 m/s.
- Kinetic energy before: 0.216 + 0.064 = 0.280 J. After: 0.024 + 0.256 = 0.280 J.
- Equal, so the collision is elastic. Relative-speed check: approach 0.60 − (−0.40) = 1.0 m/s; separation 0.80 − (−0.20) = 1.0 m/s.

## Two-stage problems: the ballistic pendulum

Many exam problems join a collision to another motion. The rule is to **split the problem at the collision**: momentum (not kinetic energy) across the collision, mechanical energy (not momentum) across the swing or slide, where gravity or friction acts as an external force for a long time.

**Worked example 4: dart and block.** A 0.010 kg dart is fired horizontally into a 0.490 kg block hanging from light strings, sticks, and the pair swing up 0.050 m.

- Stage 2, the swing (energy, working backward): ½(m + M)V² = (m + M)gh, so V = √(2gh) = √(2 × 9.8 × 0.050) ≈ 0.99 m/s.
- Stage 1, the collision (momentum): m v_dart = (m + M)V, so v_dart = (0.500/0.010)(0.99) ≈ 49.5 m/s.
- Energy bar chart in words: before, all K (½ × 0.010 × 49.5² ≈ 12.3 J); just after, K ≈ 0.25 J and E_int ≈ 12.0 J; at the top, U_g ≈ 0.25 J and E_int ≈ 12.0 J. About 98% of the dart's kinetic energy (M/(m + M) = 0.490/0.500) became internal energy.

The tempting shortcut ½m v_dart² = (m + M)gh gives about 7.0 m/s, seven times too small, because it pretends the sticking collision kept its kinetic energy.

**Functional dependence:** for a fixed dart and block, v_dart ∝ √h. To double the rise height, the dart must be √2 ≈ 1.4 times as fast.

## Common mistakes

- **"Inelastic, so momentum is not conserved."** Inelastic is about kinetic energy only.
- **Using kinetic-energy conservation across a sticking collision** (the ballistic-pendulum shortcut).
- **Thinking each object keeps its own kinetic energy in an elastic collision.** Only the total is conserved.
- **Adding velocities for the separation speed** when both objects move the same way; subtract them.
- **Assuming a sticking collision loses all the kinetic energy.** It loses all of it only when the total momentum is zero.
- **Forgetting signs** when one object bounces back.

## Self-check

1. A 2.0 kg cart at 3.0 m/s sticks to a 1.0 kg cart at rest. Final velocity, and kinetic energy converted?
2. A 1.0 kg cart at 4.0 m/s hits a 3.0 kg cart at rest elastically. Final velocities?
3. Two carts approach at 1.5 m/s relative to each other and separate at 0.9 m/s. Elastic or inelastic?
4. A ball dropped from 2.0 m rebounds to 1.5 m. What fraction of its kinetic energy survives the bounce?
5. In a ballistic pendulum the block rises 4 times as high in a second trial with the same dart and block. How do the dart speeds compare?
6. Why does the elastic-formula value v₂f → 2v when m₁ is much greater than m₂ make sense?

*Answers:* 1. v = 6.0/3.0 = 2.0 m/s; K goes 9.0 J → 6.0 J, so 3.0 J converted. 2. v₁f = (1.0 − 3.0)(4.0)/4.0 = −2.0 m/s; v₂f = 2(1.0)(4.0)/4.0 = 2.0 m/s. 3. Inelastic (separation slower than approach). 4. 1.5/2.0 = 75%. 5. The second dart is twice as fast (v ∝ √h). 6. The heavy ball keeps moving at about v, and elastic objects separate at the approach speed v, so the light one moves at about 2v.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 4, Topic 4.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
