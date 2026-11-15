# Week 25 · Vector-Valued Functions and Motion in the Plane

**Topics:** 9.4 Defining and Differentiating Vector-Valued Functions · 9.5 Integrating Vector-Valued Functions · 9.6 Solving Motion Problems Using Parametric and Vector-Valued Functions
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 9, Topics 9.4–9.6, learning objectives in our own words
**Spiral:** Week 24's parametric curves are the paths; this week puts a clock on them. Unit 4's straight-line motion (position, velocity, acceleration, speed) and Unit 8's displacement and distance traveled are done again, once per coordinate, and week 24's arc length integral reappears as distance traveled.

## What you need to be able to do

- **9.4** Differentiate r(t) = ⟨x(t), y(t)⟩ component by component to find velocity and acceleration vectors, and find the slope of the path.
- **9.4** Compute speed as the magnitude of the velocity vector.
- **9.5** Integrate a vector-valued function component by component, with a constant vector or with definite limits.
- **9.6** Recover velocity from acceleration and position from velocity using initial conditions.
- **9.6** Decide the direction of motion, when the particle is at rest, and whether its speed is increasing; distinguish displacement from total distance traveled.

## Key terms

| Term | Meaning |
|---|---|
| Vector-valued function | r(t) = ⟨x(t), y(t)⟩, a vector for each t; its tip traces a path. |
| Position vector | r(t), the location of the particle at time t. |
| Velocity vector | v(t) = r′(t) = ⟨x′(t), y′(t)⟩, tangent to the path, pointing the way the particle moves. |
| Acceleration vector | a(t) = v′(t) = ⟨x″(t), y″(t)⟩. |
| Speed | \|v(t)\| = √((x′)² + (y′)²), a non-negative number. |
| Displacement | r(b) − r(a) = ∫ from a to b of v(t) dt, a vector. |
| Total distance traveled | ∫ from a to b of \|v(t)\| dt, a number. |

## Vector-valued functions and their derivatives (9.4)

A vector-valued function packs a parametric pair into one object: r(t) = ⟨x(t), y(t)⟩. Picture an arrow from the origin to the moving point. Everything you know about parametric curves still applies; the vector notation just makes velocity and acceleration easy to write.

**Derivatives work one component at a time.**

r′(t) = ⟨x′(t), y′(t)⟩ and r″(t) = ⟨x″(t), y″(t)⟩.

When r is a position, r′ = v is the velocity and r″ = a is the acceleration. Three quantities come from the velocity:

- **Slope of the path:** dy/dx = y′(t)/x′(t), the week 24 formula.
- **Speed:** |v(t)| = √((x′(t))² + (y′(t))²), the length of the velocity arrow.
- **Direction of motion:** the signs of x′ (right or left) and y′ (up or down).

**Worked example 1.** A particle has position r(t) = ⟨t² − 6t, t³ − 3t²⟩ for 0 ≤ t ≤ 4.

- v(t) = ⟨2t − 6, 3t² − 6t⟩ and a(t) = ⟨2, 6t − 6⟩.
- At t = 1: v(1) = ⟨−4, −3⟩, so the speed is √(16 + 9) = 5. The particle is moving left (x′ < 0) and down (y′ < 0). The slope of the path is (−3)/(−4) = 3/4.
- At t = 2: a(2) = ⟨2, 6⟩.

**Worked example 2 (chain rule in each component).** If r(t) = ⟨e^(3t), ln(t² + 1)⟩, then r′(t) = ⟨3e^(3t), 2t/(t² + 1)⟩. At t = 0 this is ⟨3, 0⟩: moving right, with a horizontal tangent, at speed 3.

## Integrating vector-valued functions (9.5)

Integrals also work one component at a time:

∫ ⟨f(t), g(t)⟩ dt = ⟨∫ f(t) dt, ∫ g(t) dt⟩ + C, where C = ⟨C₁, C₂⟩ is a constant vector.

∫ from a to b of ⟨f(t), g(t)⟩ dt = ⟨∫ from a to b of f(t) dt, ∫ from a to b of g(t) dt⟩.

For example, ∫ from 0 to π/2 of ⟨cos t, 4 sin t⟩ dt = ⟨sin t, −4 cos t⟩ from 0 to π/2 = ⟨1, 0 − (−4)⟩ = ⟨1, 4⟩.

The integral of velocity is the change in position, so the net change theorem of Unit 6 becomes

**r(b) = r(a) + ∫ from a to b of v(t) dt,**

which in components is x(b) = x(a) + ∫ x′(t) dt and y(b) = y(a) + ∫ y′(t) dt. The same move gets velocity from acceleration: v(b) = v(a) + ∫ from a to b of a(t) dt.

**Worked example 3.** A particle moves with v(t) = ⟨3t², 2/(t + 1)⟩ for t ≥ 0 and r(0) = ⟨1, 5⟩. Find r(2).

- x(2) = 1 + ∫ from 0 to 2 of 3t² dt = 1 + [t³] from 0 to 2 = 1 + 8 = 9.
- y(2) = 5 + ∫ from 0 to 2 of 2/(t + 1) dt = 5 + [2 ln(t + 1)] from 0 to 2 = 5 + 2 ln 3.

So r(2) = ⟨9, 5 + 2 ln 3⟩. The vector ⟨8, 2 ln 3⟩ on its own is the displacement; forgetting to add r(0) is the most common lost point on this kind of question.

**Worked example 4 (from acceleration).** Suppose a(t) = ⟨6t, −2⟩, v(0) = ⟨0, 4⟩ and r(0) = ⟨1, 0⟩. Integrate once: v(t) = ⟨3t², 4 − 2t⟩. Integrate again: r(t) = ⟨1 + t³, 4t − t²⟩. Each integration uses its own initial condition. The particle is highest when y′ = 4 − 2t changes from positive to negative, at t = 2, where it is at (9, 4).

## Motion in the plane (9.6)

This topic combines everything: given a position, velocity or acceleration, answer questions about the motion. The table sums up the AP questions and how to answer each.

| Question | What to compute |
|---|---|
| Velocity, acceleration at t | r′(t), r″(t) |
| Speed at t | √((x′)² + (y′)²) |
| Moving left/right, up/down | sign of x′, sign of y′ |
| At rest | x′ = 0 **and** y′ = 0 at the same t |
| Horizontal / vertical tangent | y′ = 0 with x′ ≠ 0 / x′ = 0 with y′ ≠ 0 |
| Position at t = b | r(a) + ∫ from a to b of v(t) dt |
| Displacement | ∫ from a to b of v(t) dt (a vector) |
| Total distance traveled | ∫ from a to b of √((x′)² + (y′)²) dt (a number) |
| Is speed increasing? | derivative of speed positive, or v · a = x′x″ + y′y″ > 0 |

**Rest needs both components.** For r(t) = ⟨t² − 6t, t³ − 3t²⟩, x′ = 0 only at t = 3 and y′ = 0 only at t = 0 and t = 2. The particle is never at rest: at t = 3 it moves straight up, and at t = 0 and t = 2 it moves straight left.

**Direction on an interval.** Up and to the left needs x′ = 2t − 6 < 0 (t < 3) and y′ = 3t(t − 2) > 0 (t > 2), so 2 < t < 3.

**Distance versus displacement.** The total distance traveled is the integral of speed, which is the arc length of week 24 when the path is traced once. The magnitude of the displacement is the straight-line distance from start to finish and is never larger.

**Worked example 5 (distance with a perfect square).** A particle has velocity v(t) = ⟨1 − t², 2t⟩ for 0 ≤ t ≤ 3, starting at (0, 1).

- Speed: (1 − t²)² + (2t)² = 1 + 2t² + t⁴ = (1 + t²)², so the speed is 1 + t².
- Total distance: ∫ from 0 to 3 of (1 + t²) dt = 3 + 9 = 12.
- Position at t = 3: x = 0 + ∫ from 0 to 3 of (1 − t²) dt = −6, y = 1 + ∫ from 0 to 3 of 2t dt = 10, so (−6, 10).
- Displacement: ⟨−6, 9⟩, of length √117 ≈ 10.8, less than 12.
- The particle moves left when 1 − t² < 0, that is for 1 < t ≤ 3; at t = 1 it moves straight up (vertical tangent).
- Speed increasing at t = 2? The speed 1 + t² has derivative 4 > 0 there, so yes. Check with the dot product: v(2) = ⟨−3, 4⟩, a(2) = ⟨−4, 2⟩, v · a = 12 + 8 = 20 > 0.

**When speed increases.** In one dimension you compared the signs of velocity and acceleration. In the plane, compute the speed s(t) and its derivative, or use s′(t) = (x′x″ + y′y″)/s(t): the speed increases when v · a > 0 and decreases when v · a < 0.

**Calculator questions.** Most AP motion questions in the plane are calculator-active: the distance integral rarely has an antiderivative. Write the integral with its limits, then report the value to three decimal places. For velocity ⟨2t, cos t⟩ on 0 ≤ t ≤ π, for example, the distance ∫ from 0 to π of √(4t² + cos²t) dt ≈ 10.354.

## Common mistakes

- **Adding components for speed.** Speed is √((x′)² + (y′)²), not x′ + y′ or |x′| + |y′|.
- **Rest from one component.** One zero component gives a horizontal or vertical tangent, not rest.
- **Forgetting the initial position.** ∫ v dt is a change; add r(a) to get a position.
- **Displacement for distance.** |∫ v dt| is the straight-line distance between the endpoints; distance traveled is ∫ |v| dt.
- **Dropping the chain rule** in one component while remembering it in the other.
- **Slope versus speed.** y′/x′ is a slope (a direction); √((x′)² + (y′)²) is a speed (a size).
- **Mixing up what a vector and a number are.** Velocity, acceleration and displacement are vectors; speed and distance are numbers. Answer in the form asked.

## Self-check

1. Find v(t), a(t) and the speed at t = 0 for r(t) = ⟨sin(2t), e^t⟩.
2. Evaluate ∫ from 1 to 2 of ⟨1/t, 6t⟩ dt.
3. A particle has v(t) = ⟨2t − 4, 1⟩ and r(0) = ⟨3, 0⟩. Find r(t) and the time the particle is farthest to the left.
4. For v(t) = ⟨t² − 1, t − 1⟩, when is the particle at rest?
5. Set up the total distance traveled from t = 0 to t = 2 by a particle with v(t) = ⟨cos(t²), t⟩.
6. A particle has velocity ⟨−3, 4⟩ and acceleration ⟨2, 1⟩ at some instant. Is its speed increasing or decreasing then?

*Answers:* 1. v = ⟨2 cos(2t), eᵗ⟩, a = ⟨−4 sin(2t), eᵗ⟩; speed at 0 is √(4 + 1) = √5. 2. ⟨ln 2, 9⟩. 3. r(t) = ⟨t² − 4t + 3, t⟩; x′ = 2t − 4 changes from negative to positive at t = 2, so it is farthest left at t = 2, at (−1, 2). 4. x′ = 0 at t = ±1 and y′ = 0 at t = 1, so it is at rest only at t = 1. 5. ∫ from 0 to 2 of √(cos²(t²) + t²) dt. 6. v · a = −6 + 4 = −2 < 0, so the speed is decreasing.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 9, Topics 9.4–9.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
