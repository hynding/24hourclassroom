# Week 04 · Vectors and Motion in Two Dimensions

**Topics:** 1.5 Vectors and Motion in Two Dimensions
**Practices:** 1 (Creating Representations: vector diagrams, component tables, trajectories described as x–y tables), 2 (Mathematical Routines: resolving vectors with sine and cosine, projectile equations), 3 (Scientific Questioning and Argumentation: arguing from the independence of horizontal and vertical motion)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 1, Topic 1.5, learning objectives in our own words
**Spiral:** Week 1 treated vectors on a line with signs; week 2 built the constant-acceleration equations and free fall; week 3 added perpendicular velocities with a right triangle and described a dropped ball on a train as a forward-moving curve. This week splits any vector into perpendicular components and runs the week 2 equations twice, once horizontally and once vertically, to describe projectiles.

## What you need to be able to do

- **1.5** Resolve a vector of magnitude A at angle θ into components A cos θ and A sin θ, and rebuild a vector from its components (magnitude and direction).
- **1.5** Add two-dimensional vectors (displacements, velocities) by adding components.
- **1.5** Explain that horizontal and vertical motions of a projectile are independent: constant velocity horizontally, free fall vertically, linked only by the shared time.
- **1.5** Solve horizontally launched and angled-launch projectile problems: time of flight, maximum height, range, and velocity at any point.
- **1.5** Predict how time, height and range depend on launch speed and angle, and check results against limiting cases (θ = 0°, 90°, complementary angles).

## Key terms

| Term | Meaning |
|---|---|
| Component | The part of a vector along one axis; in 2D, an x-component and a y-component. |
| Resultant | The single vector equal to the sum of two or more vectors. |
| Projectile | An object moving under gravity alone after launch (air resistance negligible). |
| Trajectory | The path of a projectile: a parabola. |
| Range | Horizontal distance from launch to landing. |
| Time of flight | Time from launch to landing, set entirely by the vertical motion. |
| Launch angle θ | The angle of the initial velocity above the horizontal. |
| Independence of motion | Horizontal and vertical motions do not affect each other; only time connects them. |

## Equations

- **Components of a vector A at angle θ above the +x axis:** A_x = A cos θ, A_y = A sin θ.
- **From components:** A = √(A_x² + A_y²), θ = tan⁻¹(A_y/A_x) (check the quadrant from the signs).
- **Projectile, horizontal (no acceleration):** x = x₀ + v₀ₓt, with v₀ₓ = v₀ cos θ constant (m/s).
- **Projectile, vertical (a = −g, up positive):** v_y = v₀ᵧ − gt; y = y₀ + v₀ᵧt − ½gt²; v_y² = v₀ᵧ² − 2g(y − y₀), with v₀ᵧ = v₀ sin θ.
- **Level ground only (launch and landing at the same height):** time of flight T = 2v₀ sin θ/g; maximum height H = (v₀ sin θ)²/(2g); range R = v₀ₓT.

Symbols: v₀ is the launch speed (m/s), θ the launch angle, g = 9.8 m/s², x and y positions (m), t time (s).

## Vectors in two dimensions (1.5)

A two-dimensional vector needs two numbers: either a magnitude and a direction, or two components. Moving between the forms is right-triangle trigonometry. **Draw the triangle every time** and decide from the picture which side is opposite the angle (sine) and which is adjacent (cosine). If the angle is measured from the vertical, the roles swap.

**Worked example 1: components of a velocity and a walk across a field.**

A soccer ball leaves the ground at 12 m/s, 30° above the horizontal. Horizontal component 12 cos 30° ≈ **10.4 m/s**; vertical component 12 sin 30° = **6.0 m/s**. Check: √(10.4² + 6.0²) ≈ 12 m/s.

A student walks 400 m north across a park, then 300 m east. Adding components:

| Leg | East (m) | North (m) |
|---|---|---|
| First | 0 | 400 |
| Second | 300 | 0 |
| Resultant | 300 | 400 |

Magnitude √(300² + 400²) = **500 m**, direction tan⁻¹(300/400) ≈ **37° east of north**. Distance walked: 700 m. The same component method adds any number of vectors at any angles: resolve each, add the x's, add the y's, rebuild.

## Projectile motion: two independent motions (1.5)

Once a projectile is released, the only acceleration is g, straight down. So:

- **Horizontally:** no acceleration. v_x stays equal to v₀ cos θ for the whole flight.
- **Vertically:** free fall, exactly as in week 2, starting from v₀ sin θ.
- **The clock is shared.** Find the time from whichever direction gives it (usually the vertical), then use it in the other.

A ball rolled off a table and a ball dropped from the same height at the same instant hit the floor together: their vertical motions are identical; the rolled ball also happens to be moving sideways. This is the train-and-ball idea from week 3, seen from the ground.

**Worked example 2: a marble rolled off a lab bench (horizontal launch, functional dependence).** A marble rolls off a bench 1.25 m high at 2.0 m/s.

- Vertical: starts with v₀ᵧ = 0 and falls 1.25 m: 1.25 = ½(9.8)t², t = √(2.5/9.8) ≈ **0.51 s**.
- Horizontal: x = 2.0 × 0.505 ≈ **1.0 m** from the foot of the bench.
- Velocity at the floor: v_x = 2.0 m/s, v_y = −9.8 × 0.505 ≈ −4.9 m/s; speed √(2.0² + 4.9²) ≈ **5.3 m/s**, directed tan⁻¹(4.9/2.0) ≈ **68° below the horizontal**.
- **Functional dependence:** double the launch speed to 4.0 m/s and the fall time is unchanged (it depends only on the height), so the landing distance doubles to 2.0 m. Quadruple the height and the time doubles, so the landing distance doubles too.

**Worked example 3: a soccer kick on level ground (a trajectory as a table).** A ball is kicked at 20 m/s, 30° above level ground. v₀ₓ = 20 cos 30° ≈ 17.3 m/s, v₀ᵧ = 20 sin 30° = 10.0 m/s.

| t (s) | 0 | 0.50 | 1.02 | 1.50 | 2.04 |
|---|---|---|---|---|---|
| x (m) | 0 | 8.7 | 17.7 | 26.0 | 35.3 |
| y (m) | 0 | 3.8 | 5.1 | 4.0 | 0 |
| v_x (m/s) | 17.3 | 17.3 | 17.3 | 17.3 | 17.3 |
| v_y (m/s) | +10.0 | +5.1 | 0 | −4.7 | −10.0 |

- Time to the top: v_y = 0 at t = 10.0/9.8 ≈ 1.02 s. Maximum height H = 10.0²/(2 × 9.8) ≈ **5.1 m**.
- Time of flight: twice the time to the top, ≈ 2.04 s. Range R = 17.3 × 2.04 ≈ **35 m**.
- At the top the velocity is not zero: it is 17.3 m/s horizontal. Only v_y is zero there. The acceleration is 9.8 m/s² downward at every row of the table.
- The table shows the symmetry: equal heights on the way up and down at equal times before and after the top, with v_y equal in size and opposite in sign.

**Worked example 4: changing the angle (limiting cases).** Same 20 m/s kick, now at 60°.

- v₀ᵧ = 20 sin 60° ≈ 17.3 m/s, v₀ₓ = 10.0 m/s. Time of flight 2(17.3)/9.8 ≈ 3.5 s; height 17.3²/19.6 ≈ 15.3 m; range 10.0 × 3.53 ≈ **35 m**, the same as at 30°.
- On level ground, complementary angles (30° and 60°, 20° and 70°) give equal ranges; the steeper kick goes higher and stays up longer. The largest range is at 45°: v₀²/g ≈ 41 m here.
- **Limiting cases:** at θ = 90° the ball goes straight up and lands where it started (range 0, maximum height v₀²/2g); at θ = 0° from the ground it never leaves (time of flight 0). Both fall out of T = 2v₀ sin θ/g and R = v₀ₓT, which is a good check on the formulas.
- **Speed dependence:** every range is proportional to v₀²: kicking 10% faster sends the ball about 21% farther.

These level-ground shortcuts only apply when launch and landing heights are equal. For a launch from a cliff or onto a roof, use y = y₀ + v₀ᵧt − ½gt² with the actual heights.

## Common mistakes

- **Swapping sine and cosine.** Draw the triangle: the component adjacent to the angle uses cosine.
- **Giving the horizontal velocity an acceleration**, or letting it change at the top. With air resistance negligible, v_x is constant.
- **Saying the velocity is zero at the top of an angled flight.** Only the vertical component is zero.
- **Using the full launch speed in vertical equations.** Only v₀ sin θ goes into the vertical motion.
- **"A faster horizontal throw falls more slowly."** Fall time depends only on height and g.
- **Using level-ground formulas for a cliff launch.**
- **Adding magnitudes of perpendicular vectors** instead of components.

## Self-check

1. A hiker's displacement is 2.0 km at 60° north of east. Find its east and north components.
2. A ball is thrown horizontally at 8.0 m/s from a 19.6 m tall building. How long is it in the air, and how far from the base does it land?
3. In question 2, what are the horizontal and vertical components of its velocity just before landing?
4. A golf ball is hit at 25 m/s, 40° above level ground. Find its time of flight and range.
5. Which other launch angle gives the same range as 40° at the same speed?
6. Two balls leave a table at the same moment: one is dropped, the other is rolled off at 3 m/s. Which lands first?

*Answers:* 1. East: 2.0 cos 60° = 1.0 km; north: 2.0 sin 60° ≈ 1.7 km. 2. t = √(2 × 19.6/9.8) = 2.0 s; distance 8.0 × 2.0 = 16 m. 3. v_x = 8.0 m/s, v_y = 9.8 × 2.0 = 19.6 m/s downward. 4. T = 2(25 sin 40°)/9.8 ≈ 3.3 s; R = (25 cos 40°)(3.28) ≈ 63 m. 5. 50°. 6. They land together.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 1, Topic 1.5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
