# Week 07 · Newton's Second Law

**Topics:** 2.5 Newton's Second Law
**Practices:** 1 (Creating Representations: free-body diagrams for each object and for a whole system), 2 (Mathematical Routines: writing and solving ΣF = ma, symbolic derivations with limiting cases), 3 (Scientific Questioning and Argumentation: designing an acceleration experiment and linearising its data)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 2, Topic 2.5, learning objectives in our own words
**Spiral:** Week 5 gave systems and free-body diagrams, week 6 the third law (forces in pairs) and the first law (ΣF = 0 means constant velocity). This week answers the obvious next question: what happens when the forces do **not** balance? The answer links the forces of Unit 2 to the accelerations of Unit 1: a non-zero net force produces an acceleration in its own direction, and every kinematics tool from weeks 1–4 can then predict the motion.

## What you need to be able to do

- **2.5** State that the acceleration of a system's center of mass equals the net external force divided by the system's mass, a = ΣF/m, in the direction of the net force.
- **2.5** Apply ΣF = ma along each axis, using a free-body diagram, for one object or for several objects treated as one system.
- **2.5** Solve connected-object problems (pushed blocks, carts linked by strings over pulleys) by choosing a system for the acceleration and a single object for an internal force.
- **2.5** Find the normal force in an accelerating elevator and the acceleration down a frictionless slope.
- **2.5** Derive symbolic expressions and test them with limiting cases and functional dependence.
- **2.5** Design an experiment that tests a = ΣF/m and linearise its data (graph F against a, or a against 1/m) to find a mass from a slope.

## Key terms

| Term | Meaning |
|---|---|
| Net force ΣF | The vector sum of all external forces on the system (N). |
| Newton's second law | a = ΣF/m: the acceleration of the center of mass is in the direction of the net force, proportional to it and inversely proportional to the mass. |
| Newton (N) | The force that gives 1 kg an acceleration of 1 m/s²: 1 N = 1 kg·m/s². |
| Connected objects | Objects linked by strings or contact that share the same magnitude of acceleration. |
| Ideal string and pulley | A massless string that does not stretch, over a massless, frictionless pulley: the tension is the same all along the string. |
| Apparent weight | The reading of a scale under you: the normal force, which differs from mg when you accelerate vertically. |
| Linearisation | Choosing quantities to graph so that a predicted relationship becomes a straight line whose slope has a physical meaning. |

## Equations

| Relation | Symbols and SI units |
|---|---|
| a = ΣF/m, or ΣF = ma | a acceleration of the center of mass (m/s²); ΣF net external force (N); m mass of the system (kg) |
| ΣFₓ = maₓ, ΣF_y = ma_y | the law along each axis |
| Frictionless slope: a = g sin θ | θ slope angle; g = 9.8 m/s² |
| Elevator: F_N = m(g + a) | a positive when the acceleration is upward (m/s²) |
| Cart pulled by hanging mass: a = m_h g/(m_c + m_h) | m_h hanging mass, m_c cart mass (kg); level, frictionless track, ideal string and pulley |

## The law and how to use it

The first law said ΣF = 0 means no change in velocity. The second law says how big the change is when ΣF is not zero:

**a = ΣF/m.**

Three readings of it matter on the AP exam. **Direction:** the acceleration points the same way as the net force, not necessarily the way the object moves (a car braking while moving forward has a backward net force). **Proportionality:** double the net force on the same mass and the acceleration doubles. **Inverse dependence on mass:** the same net force on twice the mass gives half the acceleration. Mass here is inertia: the "resistance" to a change in velocity.

The routine never changes:

1. Choose the system and draw its free-body diagram.
2. Choose axes, with one axis along the acceleration if you know its direction.
3. Write ΣF = ma along each axis, with signs from the diagram.
4. Solve symbolically first, then substitute; check units and limiting cases.

**Worked example 1: the pushed blocks (system, then one object).** A student pushes horizontally with 18 N on a 4.0 kg block, which in turn pushes a 2.0 kg block in front of it across a frictionless floor. Find the acceleration and the force between the blocks.

*System = both blocks.* The contact forces between the blocks are internal, so the only horizontal external force is the 18 N push: a = 18/(4.0 + 2.0) = **3.0 m/s²**.

*System = the front (2.0 kg) block alone.* Its only horizontal force is the push of the rear block, P: P = ma = 2.0 · 3.0 = **6.0 N**.

*Check with the rear block:* its forces are 18 N forward and the front block's 6.0 N push backward (the third-law partner of P), so ΣF = 12 N and a = 12/4.0 = 3.0 m/s². Consistent. Notice that the student's 18 N is **not** passed on whole: the front block needs only enough force to give its own mass the shared acceleration.

**Worked example 2: cart and hanging mass (derive, then check limits).** A 1.5 kg cart on a level, frictionless track is tied by a string over a pulley at the end of the track to a 0.50 kg hanging mass. Released from rest, how fast does it accelerate, and what is the tension?

FBDs in words. Cart: F_g down, F_N up, tension T toward the pulley. Hanging mass: F_g = m_h g down, T up. Both move together, so take the direction of motion (cart toward the pulley, hanging mass down) as positive for each.

- Cart: T = m_c a.
- Hanging mass: m_h g − T = m_h a.
- Add the two equations: m_h g = (m_c + m_h)a, so **a = m_h g/(m_c + m_h)**.

Numbers: a = 0.50 · 9.8/2.0 = **2.45 m/s²**, and T = m_c a = 1.5 · 2.45 ≈ **3.7 N**.

*Limiting cases.* If m_c → 0, a → g: nothing holds the hanging mass back, so it falls freely. If m_h → 0, a → 0: no driving force. And T = m_c m_h g/(m_c + m_h) is always less than m_h g = 4.9 N: if the tension equalled the hanging weight, the hanging mass would not accelerate. *Functional dependence:* doubling m_h to 1.0 kg gives a = 9.8/2.5 = 3.9 m/s², an increase but not a doubling, because the total mass being accelerated also grew.

The quick route is to treat cart + string + hanging mass as **one system** pulled by one external force along the string's path, m_h g, with total mass m_c + m_h. The tension is internal to that system, which is why it vanished when we added the equations.

**Worked example 3: the elevator (apparent weight).** A 60 kg student stands on a bathroom scale in an elevator. The scale reads the normal force, F_N. Take up as positive: F_N − mg = ma, so F_N = m(g + a).

| Motion of the elevator | a (m/s²) | Scale reading F_N (N) |
|---|---|---|
| At rest, or constant velocity either way | 0 | 588 |
| Speeding up while going up | +1.5 | 678 |
| Slowing down while going up | −1.5 | 498 |
| Speeding up while going down | −1.5 | 498 |
| Slowing down while going down | +1.5 | 678 |

The reading depends on the direction of the **acceleration**, not of the velocity. You feel heavier whenever the elevator accelerates upward, whether it is starting up or stopping on the way down. If the cable snapped, a = −g and F_N = 0: the scale reads zero (week 8 picks up this "weightlessness").

**Worked example 4: the frictionless slope.** A skateboarder coasts down a smooth 20° ramp. With x down the slope, the only force with an x component is gravity: mg sin θ = ma, so **a = g sin θ** = 9.8 · sin 20° ≈ **3.4 m/s²**. The mass cancels: a light child and a heavy adult on identical boards accelerate equally. *Limits:* θ = 0 gives a = 0 (a level floor), θ = 90° gives a = g (free fall). The normal force is mg cos θ, so perpendicular to the slope ΣF = 0, as it must be when nothing moves in that direction.

## Testing the second law in the lab

To test a = ΣF/m, change one variable, measure the acceleration, and keep the other fixed. A common design: a cart on a level, low-friction track is pulled by a string attached to a force sensor; a motion sensor (or a phone video) records velocity against time, and the slope of each v–t graph gives the acceleration.

**Worked example 5: finding a cart's mass from a slope.** A lab group pulls the same cart with five different forces and records the accelerations (invented data):

| Force F (N) | 0.20 | 0.40 | 0.60 | 0.80 | 1.00 |
|---|---|---|---|---|---|
| Acceleration a (m/s²) | 0.41 | 0.79 | 1.22 | 1.58 | 2.03 |

The prediction a = F/m says a graph of a against F is a straight line through the origin with slope 1/m. A best-fit line gives a slope of about 2.0 (m/s²)/N, so m = 1/2.0 ≈ **0.50 kg**. A small intercept would suggest a constant friction force the group had not accounted for; here the intercept is essentially zero. To test the mass dependence instead, keep F fixed, add masses to the cart, and graph a against 1/m: another straight line, this time with slope F.

Good design habits that earn AP points: name every instrument, repeat each trial and average, choose a wide range of values (at least five), keep the track level (or tilt it slightly to cancel friction), and say how the graph's slope answers the question.

## Common mistakes

- **Putting "ma" on the free-body diagram** as if it were a force. ma is the result of the forces, not one of them.
- **Using the velocity direction for the force direction.** A ball thrown upward has a downward net force all the way up.
- **Setting tension equal to the hanging weight** in an accelerating system. That is true only at constant velocity.
- **Using the wrong mass:** the mass in a = ΣF/m is the mass of the system whose forces you summed.
- **Including internal forces** when the system is the whole set of connected objects.
- **Thinking heavier objects slide or fall faster.** Gravity's pull grows with mass exactly as the inertia does, so a = g or g sin θ for any mass.

## Self-check

1. A 4.0 kg box is pushed with 20 N to the right while a 8.0 N friction force acts to the left. Find its acceleration.
2. The net force on a cart is doubled and its mass is halved. By what factor does its acceleration change?
3. Two masses, 3.5 kg and 2.5 kg, hang over an ideal pulley. Find the acceleration.
4. A 60 kg student's scale reads 498 N. Describe two ways the elevator could be moving.
5. In the cart-and-hanging-mass lab, why must the tension be smaller than the hanging mass's weight?

*Answers:* 1. a = (20 − 8.0)/4.0 = 3.0 m/s² to the right. 2. Four times as large. 3. a = (3.5 − 2.5) · 9.8/6.0 ≈ 1.6 m/s², the heavier mass moving down. 4. Speeding up on the way down, or slowing down on the way up (acceleration 1.5 m/s² downward either way). 5. The hanging mass accelerates downward, so the net force on it must be downward: m_h g − T = m_h a is positive, so T is less than m_h g.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 2, Topic 2.5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
