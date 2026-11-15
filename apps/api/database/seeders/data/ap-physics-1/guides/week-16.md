# Week 16 · Linear Momentum, Impulse and Change in Momentum

**Topics:** 4.1 Linear Momentum · 4.2 Change in Momentum and Impulse
**Practices:** 1 (Creating Representations: force–time graphs, momentum tables with signs), 2 (Mathematical Routines: impulse from areas, F_net = Δp/Δt), 3 (Scientific Questioning and Argumentation: stopping-time arguments, functional dependence)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 4, Topics 4.1–4.2, learning objectives in our own words
**Spiral:** Week 2 read displacement from the area under a velocity–time graph; weeks 5–7 built free-body diagrams and Newton's second law; week 6 gave the third law; weeks 12–14 developed kinetic energy, work as the area under a force–position graph, and conservation of energy. This week introduces a second conserved-quantity bookkeeping system, momentum, and its "area under a graph" partner, impulse.

## What you need to be able to do

- **4.1** Calculate the momentum p = mv of an object, with a sign that shows its direction in one dimension.
- **4.1** Find the total momentum of a system by adding the momenta of its parts as vectors, and use it to find the velocity of the system's centre of mass.
- **4.1** Contrast momentum (a vector, proportional to v) with kinetic energy (a scalar, proportional to v²).
- **4.2** Use Newton's second law in momentum form, F_net = Δp/Δt, and connect it to F_net = ma.
- **4.2** Calculate impulse as F_avg Δt or as the area under a force–time graph, including negative areas.
- **4.2** Apply the impulse–momentum theorem, J = Δp, including rebounds where the velocity changes sign.
- **4.2** Argue how the average force changes when the stopping time changes for a fixed change in momentum.
- **4.2** Explain why only external forces change a system's total momentum.

## Key terms

| Term | Meaning |
|---|---|
| Linear momentum, p | Mass times velocity, p = mv. A vector in the direction of the velocity. Unit kg·m/s. |
| System momentum | The vector sum of the momenta of every object in the chosen system. |
| Centre-of-mass velocity | v_cm = p_sys/M_total: the velocity of the mass-weighted average position of the system. |
| Impulse, J | The product F_avg Δt, or the area under a force–time graph. A vector. Unit N·s = kg·m/s. |
| Impulse–momentum theorem | The net impulse on an object or system equals its change in momentum: J_net = Δp. |
| Internal force | A force one part of the system exerts on another part. Internal forces cancel in pairs. |
| External force | A force exerted on the system by something outside it. Only these change p_sys. |

## Equations

| Relation | Symbols and units |
|---|---|
| p = mv | p momentum (kg·m/s), m mass (kg), v velocity (m/s) |
| p_sys = m₁v₁ + m₂v₂ + … | sum over every object in the system, with signs |
| v_cm = p_sys / (m₁ + m₂ + …) | v_cm centre-of-mass velocity (m/s) |
| F_net = Δp/Δt | F_net net external force (N), Δt time interval (s) |
| J = F_avg Δt = Δp | J impulse (N·s), F_avg average force (N) |
| K = ½mv² = p²/(2m) | K translational kinetic energy (J) |

## Linear momentum of objects and systems (4.1)

Momentum measures "how much motion" an object carries in a way that keeps track of direction. A 1500 kg car at 20 m/s has p = 30,000 kg·m/s; a 0.15 kg baseball at 40 m/s has p = 6.0 kg·m/s. Because velocity is a vector, so is momentum: in one dimension, pick a positive direction and give every momentum a sign.

The momentum of a **system** is the vector sum of its parts. This is where momentum and kinetic energy part company. Kinetic energy is a scalar that is never negative, so the kinetic energies of a system's parts always add up. Momenta can cancel.

**Worked example 1: carts whose momenta cancel.** On a straight track, cart A (0.50 kg) moves right at 1.2 m/s and cart B (0.30 kg) moves left at 2.0 m/s. Take right as positive.

| Object | m (kg) | v (m/s) | p (kg·m/s) | K (J) |
|---|---|---|---|---|
| Cart A | 0.50 | +1.2 | +0.60 | 0.36 |
| Cart B | 0.30 | −2.0 | −0.60 | 0.60 |
| System | 0.80 | | 0 | 0.96 |

The system has zero momentum but 0.96 J of kinetic energy. The centre-of-mass velocity is v_cm = p_sys/M = 0/0.80 = 0: the centre of mass of the pair is not moving, even though both carts are.

**Centre-of-mass velocity.** Rearranging gives p_sys = M_total v_cm: a system's total momentum is the same as if its whole mass moved with the centre of mass. For a 2.0 kg cart at 3.0 m/s and a 1.0 kg cart at rest, v_cm = 6.0/3.0 = 2.0 m/s, not the plain average 1.5 m/s, because the heavier cart counts for more.

**Momentum versus kinetic energy.** Since K = ½mv² and p = mv, K = p²/(2m). Two consequences show up on the exam all the time:

- Doubling the speed doubles p but quadruples K.
- For equal momenta, the **lighter** object has more kinetic energy. A bicycle and a truck with the same momentum: the bicycle has far more kinetic energy.

## Change in momentum and impulse (4.2)

Newton wrote his second law in terms of momentum: the net external force equals the rate of change of momentum, F_net = Δp/Δt. When the mass is constant, Δp = mΔv, and Δp/Δt = mΔv/Δt = ma, so this is the familiar F_net = ma. The momentum form is more useful whenever forces act for short, messy intervals (kicks, bounces, crashes) where the force is not constant.

Multiplying through by Δt gives the **impulse–momentum theorem**:

J_net = F_avg Δt = Δp.

When the force varies, impulse is the **area between the force–time graph and the time axis**, just as displacement is the area under a velocity–time graph and work is the area under a force–position graph. Area above the axis is positive impulse; area below it is negative.

**Worked example 2: a soccer kick from a force–time graph.** A player kicks a 0.43 kg soccer ball that is at rest. A force plate inside a test boot records a force that rises in a straight line to 1500 N and falls back to zero, lasting 0.010 s in all.

| t (ms) | 0 | 2.5 | 5.0 | 7.5 | 10.0 |
|---|---|---|---|---|---|
| F (N) | 0 | 750 | 1500 | 750 | 0 |

- Impulse = area of the triangle = ½ × 0.010 s × 1500 N = 7.5 N·s.
- Δp = 7.5 kg·m/s, so v = Δp/m = 7.5/0.43 ≈ 17 m/s.
- Average force = J/Δt = 7.5/0.010 = 750 N, half the peak, as for any symmetric triangle.

**Worked example 3: a rebound and the sign trap.** A 0.058 kg tennis ball travels horizontally at 25 m/s, hits a wall, and comes straight back at 20 m/s. Contact lasts 5.0 ms. Take the rebound direction (away from the wall) as positive, so v_i = −25 m/s and v_f = +20 m/s.

- Δp = m(v_f − v_i) = 0.058 × (20 − (−25)) = 0.058 × 45 = 2.61 kg·m/s, away from the wall.
- F_avg on the ball = 2.61/0.0050 ≈ 520 N, away from the wall. By the third law the ball pushes on the wall with 520 N toward the wall.

The common wrong answer is 0.058 × (25 − 20) = 0.29 kg·m/s, which subtracts speeds and forgets that the velocity reversed. A bounce always needs **more** impulse than simply stopping, because the ball has to be stopped and then sent back.

**Worked example 4: the airbag (functional dependence).** A 70 kg crash-test dummy moving at 15 m/s is brought to rest. Its change in momentum is fixed: Δp = 70 × 15 = 1050 kg·m/s in magnitude, whatever stops it.

| Stopped by | Δt (s) | F_avg = Δp/Δt (N) |
|---|---|---|
| Steering wheel | 0.010 | 1.05 × 10⁵ |
| Airbag | 0.15 | 7.0 × 10³ |

Fifteen times the stopping time gives one fifteenth of the average force. The relationship is F_avg ∝ 1/Δt at fixed Δp. The airbag does **not** reduce the impulse; it spreads the same impulse over more time. The same argument explains bending your knees when you land, catching an egg with a soft hand, gym mats, and the crumple zones of cars. Check the limiting case: as Δt approaches zero (a perfectly rigid stop), the average force grows without limit, which is why rigid collisions do so much damage.

**Worked example 5: positive and negative impulse.** A 0.80 kg lab cart moves at +0.50 m/s on a low-friction track. A student pushes it with a force probe: +4.0 N for 0.50 s, then pulls back with −2.0 N for 0.40 s. The force–time graph is a rectangle above the axis followed by a rectangle below it.

- J = (4.0)(0.50) + (−2.0)(0.40) = 2.0 − 0.80 = +1.2 N·s.
- v_f = v_i + J/m = 0.50 + 1.2/0.80 = 0.50 + 1.5 = 2.0 m/s in the positive direction.

**Systems and internal forces.** When the parts of a system push on each other, each push comes with an equal and opposite third-law partner, acting for the same time. Their impulses cancel, so **internal forces cannot change a system's total momentum**. Only a net external impulse can. This idea becomes the conservation law next week. Choosing the system is therefore a real decision: for a ball dropped toward Earth, the ball alone gains momentum (gravity is external), but the ball and Earth together do not.

**Momentum–time graphs.** The slope of a momentum–time graph is Δp/Δt, the net force. A horizontal p–t graph means zero net force; a straight sloped line means a constant net force.

## Common mistakes

- **Subtracting speeds on a rebound.** Use velocities with signs: a reversal makes |Δp| = m(|v_f| + |v_i|).
- **Adding momentum magnitudes in a system.** Opposite momenta cancel; kinetic energies do not.
- **Saying a cushion reduces the impulse.** The impulse equals Δp, which is fixed by the speeds; the cushion lengthens Δt and lowers F_avg.
- **Using the peak force as the average force.** For a triangular pulse, the average is half the peak.
- **Mixing up the two areas.** Area under F–t is impulse (momentum); area under F–x is work (kinetic energy).
- **Forgetting the initial velocity.** J/m is Δv, not v_f.
- **Treating the plain average of velocities as v_cm.** Weight each velocity by its mass.

## Self-check

1. A 0.25 kg puck slides at 8.0 m/s east. What is its momentum?
2. Two skaters, 60 kg at +2.0 m/s and 40 kg at −3.0 m/s. Total momentum and centre-of-mass velocity?
3. A force–time graph is a rectangle, 25 N for 0.40 s, acting on a 2.0 kg cart at rest. Final speed?
4. A 0.50 kg ball hits the floor at 6.0 m/s and leaves at 4.0 m/s upward. Magnitude of Δp?
5. A diver's stopping time in the water doubles when she enters with pointed toes instead of flat. How does the average force change, for the same entry speed?
6. A bicycle (90 kg with rider) and a car (1200 kg) have equal momenta. Which has more kinetic energy, and by what factor?

*Answers:* 1. 2.0 kg·m/s east. 2. p = 120 − 120 = 0; v_cm = 0. 3. J = 10 N·s, v = 10/2.0 = 5.0 m/s. 4. 0.50 × (4.0 + 6.0) = 5.0 kg·m/s, upward. 5. It halves (F_avg ∝ 1/Δt at fixed Δp). 6. The bicycle, by 1200/90 ≈ 13 times, since K = p²/(2m).

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 4, Topics 4.1–4.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
