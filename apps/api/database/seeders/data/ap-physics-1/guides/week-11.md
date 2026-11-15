# Week 11 · Circular Motion

**Topics:** 2.9 Circular Motion
**Practices:** 1 (Creating Representations: free-body diagrams at points on a circle, linearised graphs), 2 (Mathematical Routines: a_c = v²/r, period and speed, Newton's second law toward the centre), 3 (Scientific Questioning and Argumentation: explaining "feeling lighter", why objects fly off along tangents, and what limits the speed on a curve)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 2, Topic 2.9, learning objectives in our own words
**Spiral:** Week 2 represented motion with graphs; week 4 treated velocity as a vector with components; weeks 5–8 built free-body diagrams and Newton's laws; weeks 9 and 10 gave friction and spring forces. This week applies all of it to an object whose speed may be constant but whose velocity is not: something must supply a net force toward the centre.

## What you need to be able to do

- **2.9** Explain why an object moving in a circle at constant speed accelerates, and give the direction (toward the centre) and size (a_c = v²/r) of that centripetal acceleration.
- **2.9** Relate speed, radius, period and frequency: v = 2πr/T, f = 1/T.
- **2.9** Identify which real force or combination of forces supplies the net inward force (tension, friction, normal force, gravity, a spring force) and write ΣF toward the centre = mv²/r.
- **2.9** Analyse the top and bottom of vertical circles (hills, dips, loops, swings), including the minimum speed at the top of a loop.
- **2.9** Distinguish tangential acceleration (changing speed) from centripetal acceleration (changing direction).
- **2.9** Predict functional dependence (double the speed, quadruple the force) and linearise circular-motion data.

## Key terms

| Term | Meaning |
|---|---|
| Uniform circular motion | Motion in a circle at constant speed. The velocity's direction changes continuously, so it is accelerated motion. |
| Centripetal acceleration a_c | The acceleration toward the centre of the circle, of size v²/r, that changes the direction of the velocity. |
| Tangential acceleration | The acceleration along the direction of motion, which changes the speed; zero in uniform circular motion. |
| Net inward (centripetal) force | The sum of the force components toward the centre; it equals mv²/r. It is not a new kind of force. |
| Period T | Time for one revolution, in s. |
| Frequency f | Revolutions per second, in Hz (s⁻¹); f = 1/T. |
| Apparent weight | The normal force (or seat, scale or chain force) a person feels, which can be more or less than mg on a curved path. |

## Equations

| Relation | Symbols and units |
|---|---|
| a_c = v²/r | a_c centripetal acceleration (m/s²); v speed (m/s); r radius of the circle (m) |
| ΣF_toward centre = mv²/r | m mass (kg); forces toward the centre count positive, away from it negative |
| v = 2πr/T | T period (s) |
| f = 1/T | f frequency (Hz) |
| Flat curve, friction only: v_max = √(μ_s g r) | μ_s coefficient of static friction; g = 9.8 m/s² |
| Top of a loop, minimum speed: v_min = √(g r) | gravity alone supplies the inward force |

## Why circular motion needs a net force (2.9)

Velocity is a vector. A car circling a roundabout at a steady 10 m/s has a velocity that points north, then west, then south: its direction keeps changing, so it **accelerates** even though the speedometer is steady. Compare the velocity a moment before and a moment after any point and the change in velocity points toward the centre. Its size works out to **a_c = v²/r**: twice the speed means four times the acceleration; twice the radius at the same speed means half.

Newton's second law then demands a **net force toward the centre** of size mv²/r. That inward net force always comes from real forces you can draw on a free-body diagram:

| Situation | What supplies the inward force |
|---|---|
| Ball whirled on a string in a horizontal circle | Tension |
| Car on a flat curve | Static friction from the road |
| Rider at the bottom of a dip or a swing | Normal (or chain) force minus gravity |
| Clothes against the wall of a spinning washer drum | Normal force from the drum |
| Puck on an air table tied to a central spring | Spring force |

There is **no outward "centrifugal" force** in this analysis. When a car turns left and you slide right across the seat, nothing pushes you right: your body tends to keep going straight (Newton's first law) while the car turns under you, until the door pushes you inward. If the inward force vanishes, the object moves off along the **tangent**, in a straight line, not outward along the radius.

**Worked example 1: a ball on a string.** A 0.15 kg ball on a frictionless table is tied to a 0.60 m string and moves in a horizontal circle at 4.0 m/s.

*Free-body diagram (in words):* a downward arrow F_g, an upward arrow F_N of equal length, and a horizontal arrow T along the string, pointing toward the centre. No arrow points along the velocity.

a_c = v²/r = 16/0.60 ≈ 26.7 m/s², so T = ma_c = 0.15 × 26.7 = 4.0 N. *Functional dependence:* at 8.0 m/s the tension needed is four times larger, 16 N; with a 1.2 m string at 4.0 m/s it would be half, 2.0 N.

**Worked example 2: a merry-go-round.** A child stands 2.0 m from the centre of a merry-go-round that turns once every 4.0 s. Her speed is v = 2πr/T = 2π(2.0)/4.0 ≈ 3.14 m/s, and her centripetal acceleration is v²/r ≈ 4.9 m/s², about half of g. A child at 1.0 m from the centre has the same period but half the speed and half the acceleration (a_c = 4π²r/T² is proportional to r at fixed period).

## Friction on curves (2.9)

**Worked example 3: the flat curve.** A 1500 kg car rounds a level curve of radius 60 m at 15 m/s.

The road's static friction, pointing toward the centre, is the only horizontal force, so F_f = mv²/r = 1500 × 225/60 = 5625 N. The friction is static because the tyres roll without slipping sideways. Vertically, F_N = mg = 14,700 N. The car stays on the curve only if 5625 N ≤ μ_s × 14,700 N, that is μ_s ≥ 0.38.

On dry pavement with μ_s = 0.70, the fastest the car can take the curve is v_max = √(μ_s g r) = √(0.70 × 9.8 × 60) ≈ 20 m/s. The mass cancels, so a loaded truck with the same tyres has the same limit. Doubling the speed needs four times the friction; on a wet road (smaller μ_s) the safe speed drops. Banking a curve tilts the normal force so part of it points toward the centre, which raises the safe speed.

## Vertical circles (2.9)

On a vertical circle, write the second law **at the top and at the bottom**, taking toward the centre as positive.

**Worked example 4: a roller-coaster loop.** A 70 kg rider goes around a vertical loop of radius 8.0 m.

| Point | Forces (toward centre positive) | Speed (m/s) | Normal force on rider |
|---|---|---|---|
| Bottom | F_N up (toward centre) and F_g down (away) | 20 | F_N − mg = mv²/r, so F_N = 70 × (50 + 9.8) ≈ 4190 N |
| Top (upside down) | F_N down and F_g down, both toward centre | 12 | F_N + mg = mv²/r, so F_N = 70 × (18 − 9.8) ≈ 574 N |

At the bottom the seat pushes with about six times the rider's weight (she feels very heavy); at the top it pushes with less than her weight. **Limiting case:** if the speed at the top falls to v = √(gr) = √(78.4) ≈ 8.9 m/s, the normal force becomes zero and gravity alone supplies the inward force. Any slower and the required inward force mv²/r is less than mg: the track would have to pull up on the rider, which a seat cannot do, so without restraints the rider would leave the track. The same reasoning tells you why a bucket of water swung overhead fast enough keeps its water in.

The same structure gives the **crest of a hill**: F_g points toward the centre (down) and F_N away (up), so mg − F_N = mv²/r and F_N = m(g − v²/r), less than mg. Passengers feel lighter. If v² = gr the car loses contact with the road. In a **dip** or at the **bottom of a swing**, F_N − mg = mv²/r and riders feel heavier.

## Speeding up on a circle (2.9)

If a car speeds up while it rounds a curve, it has both a tangential acceleration (along the velocity, changing the speed) and a centripetal acceleration (toward the centre, changing the direction). The total acceleration is their vector sum and points ahead of the centre. Only the inward part obeys a_c = v²/r. In uniform circular motion the tangential part is zero.

## Linearising circular-motion data (2.9)

**Worked example 5: force against speed.** A lab group ties a 0.20 kg puck on an air table to a force sensor at the centre with a 0.40 m string, spins it at different speeds (found from the time for ten revolutions, v = 2πr/T) and records the sensor force:

| Speed v (m/s) | 1.2 | 1.6 | 2.0 | 2.4 | 2.8 |
|---|---|---|---|---|---|
| v² (m²/s²) | 1.44 | 2.56 | 4.00 | 5.76 | 7.84 |
| Force F (N) | 0.70 | 1.31 | 1.97 | 2.91 | 3.88 |

A graph of F against v curves upward; the model F = (m/r)v² predicts that **F against v² is a straight line through the origin with slope m/r**. The best-fit slope is about 0.50 kg/m with an intercept near zero, so m = slope × r = 0.50 × 0.40 ≈ 0.20 kg, matching the puck's measured mass. Timing ten revolutions instead of one reduces the relative uncertainty of the reaction-time error in each period.

## Common mistakes

- Saying an object at constant speed in a circle has zero acceleration or zero net force.
- Drawing a separate "centripetal force" or an outward "centrifugal force" on a free-body diagram. Draw only real forces; their inward sum equals mv²/r.
- Thinking a released object flies outward along the radius. It moves along the tangent.
- Writing F_N = mg at the top of a hill or the bottom of a dip.
- Thinking the normal force at the top of a loop must point up. Upside down, the seat pushes the rider down, toward the centre.
- Forgetting that a_c depends on v squared: doubling the speed quadruples the needed force, not doubles it.
- Using kinetic friction for a car on a curve that is not skidding.

## Self-check

1. A 0.50 kg ball moves in a horizontal circle of radius 1.2 m at 3.0 m/s. What net force acts on it, and in what direction?
2. A turntable turns once every 1.8 s. What is the speed of a point 0.15 m from its centre?
3. A 900 kg car goes over a hilltop of radius 30 m at 12 m/s. What is the normal force on it?
4. What is the minimum speed at the top of a vertical loop of radius 5.0 m?
5. A car on a flat curve doubles its speed. By what factor must the friction force increase?

*Answers:* 1. mv²/r = 0.50 × 9.0/1.2 = 3.75 N, toward the centre. 2. v = 2π(0.15)/1.8 ≈ 0.52 m/s. 3. F_N = m(g − v²/r) = 900 × (9.8 − 4.8) = 4500 N. 4. √(9.8 × 5.0) ≈ 7.0 m/s. 5. Four.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 2, Topic 2.9). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
