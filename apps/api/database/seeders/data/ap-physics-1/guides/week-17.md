# Week 17 · Conservation of Linear Momentum

**Topics:** 4.3 Conservation of Linear Momentum
**Practices:** 1 (Creating Representations: before/after momentum tables and bar charts, component diagrams), 2 (Mathematical Routines: solving conservation equations, 2D components), 3 (Scientific Questioning and Argumentation: choosing and justifying a system, testing conservation with lab data)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 4, Topic 4.3, learning objectives in our own words
**Spiral:** Week 5 defined systems and the centre of mass; week 6 gave Newton's third law; week 4 resolved vectors into components; week 16 defined momentum, system momentum and impulse, and showed that internal impulses cancel. This week turns that last fact into a conservation law.

## What you need to be able to do

- **4.3** State when a system's total momentum is conserved: the net external force is zero, or the net external impulse over the interval is negligible.
- **4.3** Choose a system so that the large interaction forces are internal, and justify the choice.
- **4.3** Explain why internal forces cannot change a system's momentum, using Newton's third law.
- **4.3** Show that the centre-of-mass velocity of an isolated system is constant.
- **4.3** Solve recoil, explosion and sticking problems with p_sys,before = p_sys,after, and represent them with momentum tables or bar charts.
- **4.3** Apply conservation separately to the x and y components in two dimensions.
- **4.3** Design and analyse an experiment that tests momentum conservation, including linearising data.

## Key terms

| Term | Meaning |
|---|---|
| Isolated system (for momentum) | A system with zero net external force, so its total momentum is constant. |
| Internal force | A force between two objects that are both inside the system; its third-law partner is inside too. |
| External force | A force from an object outside the system; only these can change p_sys. |
| Short-collision approximation | During a brief collision, small external forces (friction, drag) deliver negligible impulse. |
| Recoil | The backward motion of one part of a system when another part is pushed forward. |
| Momentum bar chart | Bars for each object's momentum before and after; the system totals must match when momentum is conserved. |

## Equations

| Relation | Symbols and units |
|---|---|
| Σp before = Σp after | when the net external impulse is zero; p in kg·m/s |
| m₁v₁ᵢ + m₂v₂ᵢ = m₁v₁f + m₂v₂f | m in kg, v in m/s, with signs for direction |
| Δp_sys = F_net,ext Δt | for a non-isolated system; F in N, Δt in s |
| v_cm = Σ(mv)/Σm | constant for an isolated system; m/s |
| Σp_x and Σp_y each conserved | two-dimensional interactions; components in kg·m/s |
| p = √(p_x² + p_y²), tan θ = p_y/p_x | magnitude and direction from components |

## Why momentum is conserved

Picture any two objects in a system interacting: carts colliding, skaters pushing, a gun and its bullet. By Newton's third law, the force A exerts on B is equal and opposite to the force B exerts on A, and the two forces act for exactly the same time. So their impulses are equal and opposite: whatever momentum B gains, A loses. Added over every pair of objects in the system, the internal impulses cancel completely. The only thing that can change the system's total momentum is an impulse from outside:

Δp_sys = F_net,ext Δt.

When that external impulse is zero or negligible, p_sys is constant. That is the whole law. Notice what it does **not** say: it says nothing about kinetic energy, and nothing about the momentum of any single object in the system.

**Choosing the system is the key decision.** Momentum is conserved for some systems and not others in the same situation.

**Worked example 1: a dropped ball and Earth.** A 0.50 kg ball falls from rest and reaches 10 m/s.

- System = ball only: Earth's gravity is external. The ball's momentum goes from 0 to 5.0 kg·m/s downward. Not conserved.
- System = ball + Earth: gravity is internal. Earth gains 5.0 kg·m/s upward, so the total stays zero. Earth's speed is 5.0/(5.97 × 10²⁴) ≈ 8 × 10⁻²⁵ m/s, far too small ever to notice.

**The short-collision approximation.** On a real track, friction is an external force. But a collision lasts a few milliseconds and friction is small, so friction's impulse F_f Δt during the collision is tiny next to the large internal impulses. Momentum just before ≈ momentum just after. The approximation fails over long intervals: friction will eventually stop the carts.

## Recoil and explosions

When a system starts at rest, its total momentum is zero and stays zero. Pieces that fly apart must have equal and opposite momenta: m₁v₁ = m₂v₂ in magnitude, so v₁/v₂ = m₂/m₁. The lighter piece is faster.

**Worked example 2: the skateboarder's throw.** A 55 kg student stands at rest on a 3.0 kg skateboard on a smooth floor and throws a 4.0 kg medicine ball forward at 6.0 m/s. System: student + board + ball (the throwing forces are internal; the vertical forces balance).

| Object | m (kg) | v before (m/s) | p before | v after (m/s) | p after |
|---|---|---|---|---|---|
| Ball | 4.0 | 0 | 0 | +6.0 | +24 |
| Student + board | 58 | 0 | 0 | v | 58v |
| System | 62 | | 0 | | 24 + 58v |

Setting 24 + 58v = 0 gives v ≈ −0.41 m/s: 0.41 m/s backward. Common errors are dividing by 55 kg (forgetting that the board recoils too) or by 62 kg (counting the ball, which is no longer moving with the student).

Energy check: the system's kinetic energy goes from 0 to ½(4.0)(6.0)² + ½(58)(0.41)² ≈ 72 + 5 = 77 J, supplied by the student's muscles. Momentum is conserved while kinetic energy increases, which is normal for an explosion.

## The centre of mass of an isolated system

Since p_sys = M v_cm and p_sys is constant, **the centre of mass of an isolated system moves at constant velocity**, however the parts push, collide or fly apart.

**Worked example 3: skaters pushing apart.** A 60 kg skater and a 40 kg skater stand at rest at x = 0 on smooth ice and push apart. The 40 kg skater moves at +1.5 m/s.

- Conservation: 0 = 40(1.5) + 60v, so v = −1.0 m/s.
- After 2.0 s, the 40 kg skater is at +3.0 m and the 60 kg skater at −2.0 m. The centre of mass is at (40 × 3.0 + 60 × (−2.0))/100 = (120 − 120)/100 = 0. It has not moved, as predicted.

## Sticking collisions

**Worked example 4: carts that couple.** A 0.50 kg cart at +0.80 m/s hits a 0.25 kg cart at rest; magnets lock them together. A momentum bar chart, written as a table:

| | Cart 1 | Cart 2 | System |
|---|---|---|---|
| Before (kg·m/s) | +0.40 | 0 | +0.40 |
| After (kg·m/s) | 0.50v | 0.25v | 0.75v |

0.75v = 0.40, so v ≈ +0.53 m/s. Cart 1 lost 0.40 − 0.27 = 0.13 kg·m/s and cart 2 gained 0.13 kg·m/s: the transfer between them is exactly what the third law requires. (Next week we will see that this collision loses kinetic energy.)

## Conservation in two dimensions

Momentum is a vector, so conservation holds for each component separately. Set up axes, conserve Σp_x and Σp_y, then combine.

**Worked example 5: the icy intersection.** A 1200 kg car heading east at 15 m/s and an 1800 kg truck heading north at 10 m/s collide and lock together.

| | p_x (kg·m/s) | p_y (kg·m/s) |
|---|---|---|
| Car before | 1200 × 15 = 18,000 | 0 |
| Truck before | 0 | 1800 × 10 = 18,000 |
| Wreck after | 18,000 | 18,000 |

- Magnitude: p = √(18,000² + 18,000²) ≈ 25,500 kg·m/s; v = 25,500/3000 ≈ 8.5 m/s.
- Direction: tan θ = 18,000/18,000 = 1, so 45° north of east.

The direction comes from the momentum components, not the speeds: tan⁻¹(10/15) ≈ 34° is a classic wrong answer. Limiting-case check: if the truck had no mass, the wreck would continue due east at 15 m/s, and the formula gives exactly that (p_y = 0, v = 18,000/1200).

## Testing conservation in the lab

**Worked example 6: linearising sticky-collision data.** A lab group launches cart A (0.50 kg) at different speeds into cart B (0.30 kg) at rest; they stick. Conservation predicts m_A v_i = (m_A + m_B)v_f, so v_f = [m_A/(m_A + m_B)] v_i.

| v_i (m/s) | 0.40 | 0.60 | 0.80 | 1.00 | 1.20 |
|---|---|---|---|---|---|
| v_f (m/s) | 0.23 | 0.36 | 0.47 | 0.60 | 0.71 |

Graphing v_f against v_i should give a straight line through the origin with slope 0.50/0.80 = 0.625. The best-fit slope is 0.60, about 4% low. Because the measured v_f values are a little small, a small external impulse is the likely cause: friction acting between the two velocity measurements. The fix is to level the track and measure velocities as close to the collision as possible. Agreement within a few percent supports the conservation law.

## Common mistakes

- **Choosing a system that leaves out an interacting object** and then claiming conservation (the ball alone in free fall, the ball alone bouncing off a wall).
- **Assuming equal speeds after an explosion.** Momenta are equal in magnitude; speeds are in inverse proportion to mass.
- **Dropping signs.** Objects moving apart or toward each other have momenta of opposite sign.
- **Assuming kinetic energy is conserved because momentum is.** The two laws have different conditions.
- **Averaging speeds in 2D** or combining momenta that are perpendicular by simple addition.
- **Forgetting that the recoiling mass includes everything that moves together** (student plus board).

## Self-check

1. A 2.0 kg toy cannon on smooth wheels fires a 0.050 kg ball forward at 20 m/s. Recoil speed?
2. A 0.40 kg cart at 1.5 m/s couples to a 0.60 kg cart at rest. Common velocity?
3. Why is momentum of the ball + floor + Earth system conserved during a bounce, but not momentum of the ball alone?
4. A 3.0 kg object at rest explodes into 1.0 kg and 2.0 kg pieces; the 1.0 kg piece moves east at 4.0 m/s. Velocity of the other piece?
5. Two pucks (0.20 kg each) collide; before, one moves +x at 3.0 m/s and the other +y at 4.0 m/s. If they stick, what is their speed?
6. In the sticky-collision lab, what graph slope would conservation predict if cart B were 0.50 kg?

*Answers:* 1. (0.050 × 20)/2.0 = 0.50 m/s backward. 2. 0.60/1.0 = 0.60 m/s. 3. The floor's force on the ball is external to the ball alone; including floor and Earth makes it internal. 4. 2.0 m/s west. 5. p_x = 0.60, p_y = 0.80, p = 1.0 kg·m/s; v = 1.0/0.40 = 2.5 m/s. 6. 0.50/1.00 = 0.50.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 4, Topic 4.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
