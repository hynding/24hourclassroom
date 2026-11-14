# Week 30 · Vectors and Vector-Valued Functions

**Topics:** 4.8 Vectors · 4.9 Vector-Valued Functions
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 4, Topics 4.8–4.9, learning objectives in our own words. Unit 4 is not assessed on the AP exam.
**Spiral:** Week 27's planar motion and the two rates Δx/Δt and Δy/Δt; week 28's parametric circles and segments; weeks 18–19's coordinates (r cos θ, r sin θ) and reference angles; week 22's inverse tangent; week 25's polar coordinates (a vector's magnitude and direction are its polar coordinates). From geometry: the Pythagorean theorem and the law of cosines.

## What you need to be able to do

- **4.8** Represent a vector as a directed segment and in component form ⟨a, b⟩, including the vector from one point to another, and find its magnitude and direction angle.
- **4.8** Go from magnitude and direction to components, and find a unit vector in a given direction.
- **4.8** Add and subtract vectors (tip to tail or by components) and multiply a vector by a scalar; interpret the results geometrically and in contexts such as velocity and force.
- **4.8** Compute the dot product, use it to find the angle between two vectors, and decide whether two vectors are perpendicular.
- **4.9** Describe the position of a moving object with a vector-valued function p(t) = ⟨x(t), y(t)⟩.
- **4.9** Compute the displacement p(b) − p(a) and the average velocity (p(b) − p(a))/(b − a) over an interval, and interpret them, distinguishing displacement from distance travelled.

## Key terms

| Term | Meaning |
|---|---|
| Vector | A quantity with both magnitude (size) and direction, drawn as an arrow. |
| Component form | ⟨a, b⟩: a units horizontally and b units vertically. Also written ai + bj. |
| Magnitude | The length of the vector, ‖⟨a, b⟩‖ = √(a² + b²). |
| Direction angle | The angle θ from the positive x-axis to the vector, measured counterclockwise. |
| Unit vector | A vector of magnitude 1; v/‖v‖ points in the direction of v. |
| Scalar | An ordinary number; multiplying a vector by k stretches it by |k| and reverses it if k < 0. |
| Dot product | ⟨a₁, b₁⟩ · ⟨a₂, b₂⟩ = a₁a₂ + b₁b₂, a number. |
| Vector-valued function | A function whose output is a vector, such as the position p(t) = ⟨x(t), y(t)⟩. |
| Displacement | The change in position p(b) − p(a): where you ended up relative to where you started. |
| Average velocity | Displacement divided by elapsed time: ⟨Δx/Δt, Δy/Δt⟩. |

## Vectors in components (4.8)

A vector records a movement or a push, not a location. The arrow from P(1, 2) to Q(5, −1) represents the vector

PQ = ⟨5 − 1, −1 − 2⟩ = ⟨4, −3⟩.

Any arrow with the same length and direction, wherever it starts, is the same vector. When a vector starts at the origin, its tip is at the point (a, b), so a position like (4, −3) and the vector ⟨4, −3⟩ are closely linked.

**Magnitude and direction.** By the Pythagorean theorem, ‖⟨4, −3⟩‖ = √(16 + 9) = 5. The direction angle satisfies tan θ = b/a, but the inverse tangent only returns angles in (−π/2, π/2), so check the quadrant: ⟨4, −3⟩ is in Quadrant IV, θ = tan⁻¹(−3/4) ≈ −0.644 (or about 5.64 radians, about 323°). For ⟨−4, 3⟩ (Quadrant II) you must add π: θ ≈ π − 0.644 ≈ 2.498.

**From magnitude and direction to components.** This is week 18's circle of radius r: a vector of magnitude m and direction θ is

⟨m cos θ, m sin θ⟩.

A magnitude of 10 at θ = 5π/6 gives ⟨10 · (−√3/2), 10 · (1/2)⟩ = ⟨−5√3, 5⟩.

**Unit vectors.** Divide a vector by its magnitude: for v = ⟨−5, 12⟩, ‖v‖ = 13, so the unit vector is ⟨−5/13, 12/13⟩. The vectors i = ⟨1, 0⟩ and j = ⟨0, 1⟩ are the standard unit vectors; ⟨4, −3⟩ = 4i − 3j.

## Adding and scaling vectors (4.8)

**Addition** works component by component: ⟨a₁, b₁⟩ + ⟨a₂, b₂⟩ = ⟨a₁ + a₂, b₁ + b₂⟩. Geometrically, put the tail of the second at the tip of the first (tip to tail); the sum goes from the first tail to the last tip. It is also the diagonal of the parallelogram the two vectors span.

**Scalar multiplication**: k⟨a, b⟩ = ⟨ka, kb⟩. The magnitude is multiplied by |k|; a negative k reverses the direction. Subtraction is adding the opposite: u − v = u + (−1)v.

**Worked example.** For u = ⟨3, −4⟩ and v = ⟨−2, 6⟩, find 2u − v and its magnitude.

2u = ⟨6, −8⟩, so 2u − v = ⟨6 − (−2), −8 − 6⟩ = ⟨8, −14⟩, with magnitude √(64 + 196) = √260 = 2√65 ≈ 16.1.

**Worked example (velocity).** In a hypothetical flight, a plane points due north with an airspeed of 300 km/h, and a wind blows toward the east at 40 km/h. Find the ground velocity.

Take east as +x and north as +y. Plane ⟨0, 300⟩, wind ⟨40, 0⟩, ground velocity ⟨40, 300⟩. Ground speed √(1600 + 90,000) = √91,600 ≈ 302.7 km/h. The direction angle is tan⁻¹(300/40) ≈ 82.4° from east, so the plane drifts about 7.6° east of north.

**Worked example (crossing a river).** A hypothetical boat heads straight across a 120 m river at 8 m/s relative to the water while the current carries it downstream at 3 m/s. With the far bank in the +x direction and the current in the −y direction, the velocity is ⟨8, −3⟩, speed √73 ≈ 8.54 m/s. Crossing takes 120/8 = 15 s, during which the current carries the boat 3 · 15 = 45 m downstream.

**Try it.**
1. Find the vector from (−2, 7) to (4, −1) and its magnitude.
2. Find the components of a vector of magnitude 6 with direction angle 4π/3.
3. Find a unit vector in the direction of ⟨8, −15⟩.

*Answers:* 1. ⟨6, −8⟩, magnitude 10. 2. ⟨6 cos(4π/3), 6 sin(4π/3)⟩ = ⟨−3, −3√3⟩. 3. ⟨8/17, −15/17⟩.

## The dot product and angles (4.8)

The dot product multiplies matching components and adds: ⟨3, −4⟩ · ⟨−2, 6⟩ = −6 − 24 = −30. The result is a number, not a vector.

Its geometric meaning comes from the law of cosines: if θ is the angle between u and v (0 ≤ θ ≤ π),

u · v = ‖u‖ ‖v‖ cos θ, so cos θ = (u · v)/(‖u‖ ‖v‖).

Consequences:

- u · v > 0: the angle is acute (less than π/2).
- u · v = 0: the vectors are **perpendicular** (orthogonal).
- u · v < 0: the angle is obtuse.
- u · u = ‖u‖².

**Worked example.** Find the angle between ⟨1, 2⟩ and ⟨3, 1⟩.

Dot product 3 + 2 = 5; magnitudes √5 and √10. cos θ = 5/√50 = 1/√2, so θ = π/4.

**Worked example.** For which k is ⟨4, k⟩ perpendicular to ⟨6, −3⟩?

24 − 3k = 0, so k = 8. Check: the slopes 8/4 = 2 and −3/6 = −1/2 are negative reciprocals.

**Try it.**
1. Are ⟨2, 5⟩ and ⟨10, −4⟩ perpendicular?
2. Find the angle between ⟨1, 0⟩ and ⟨−1, √3⟩.

*Answers:* 1. 20 − 20 = 0, yes. 2. cos θ = −1/2, θ = 2π/3.

## Vector-valued functions (4.9)

A parametric function from week 27, x = x(t) and y = y(t), can be packaged as one function whose output is a vector:

p(t) = ⟨x(t), y(t)⟩.

If the tail of p(t) is at the origin, its tip is at the moving point; p(t) is the **position vector**.

**Displacement** over [a, b] is the vector p(b) − p(a) from the starting position to the ending position. **Average velocity** divides by the elapsed time:

(p(b) − p(a))/(b − a) = ⟨(x(b) − x(a))/(b − a), (y(b) − y(a))/(b − a)⟩ = ⟨Δx/Δt, Δy/Δt⟩.

Its components are exactly the two average rates from week 27; its direction is the direction of the segment joining the two positions; its magnitude is the straight-line distance divided by time. Over shorter and shorter intervals, average velocity approaches the instantaneous velocity that calculus computes.

**Displacement is not distance.** If you walk once around a circular track, your displacement is the zero vector, but the distance you travelled is the circumference. The magnitude of the average velocity is at most the average speed (distance travelled divided by time), and equal only for motion in a straight line without turning back.

**Worked example.** p(t) = ⟨2 + 3t, 1 − 4t⟩.

Every second, x increases by 3 and y decreases by 4, so the velocity on any interval is ⟨3, −4⟩, with speed 5. The path is a line through (2, 1).

**Worked example.** p(t) = ⟨3 cos(πt/2), 3 sin(πt/2)⟩, t in seconds.

The point moves counterclockwise around the circle of radius 3, once every 4 seconds. On [0, 2]: p(0) = ⟨3, 0⟩, p(2) = ⟨−3, 0⟩, displacement ⟨−6, 0⟩, average velocity ⟨−3, 0⟩ (magnitude 3 m/s). But the distance travelled is half the circumference, 3π ≈ 9.42, so the average speed is about 4.71. On [0, 4] the displacement is ⟨0, 0⟩.

**Worked example (projectile).** The ball of week 27 has position p(t) = ⟨40t, 6 + 48t − 16t²⟩ feet. On [1, 2]: p(1) = ⟨40, 38⟩, p(2) = ⟨80, 38⟩, so the average velocity is ⟨40, 0⟩: horizontal, because over this interval the ball went up and came back to the same height.

**Try it.**
1. For p(t) = ⟨t², 3t − 1⟩, find the displacement from t = 1 to t = 3 and the average velocity.
2. For p(t) = ⟨4t − 1, t³⟩, find the average velocity on [0, 2] and its magnitude.

*Answers:* 1. p(3) − p(1) = ⟨9, 8⟩ − ⟨1, 2⟩ = ⟨8, 6⟩; average velocity ⟨4, 3⟩. 2. ⟨7, 8⟩ − ⟨−1, 0⟩ = ⟨8, 8⟩ over 2: ⟨4, 4⟩, magnitude 4√2.

## Calculator notes

Many calculators convert between rectangular and polar forms (often called R▸Pθ and P▸Rx, P▸Ry), which gives magnitude and direction from components and back. Check the angle mode. When finding a direction with tan⁻¹ by hand or by calculator, correct for the quadrant; a two-argument conversion does this automatically.

## Common mistakes

- **Subtracting in the wrong order.** The vector from P to Q is Q − P.
- **Adding magnitudes.** ‖u + v‖ is generally less than ‖u‖ + ‖v‖; add components, then find the magnitude.
- **Trusting tan⁻¹ blindly.** ⟨−4, 3⟩ and ⟨4, −3⟩ give the same b/a but point in opposite directions.
- **Treating the dot product as a vector.** u · v is a single number.
- **Confusing displacement with distance**, or average velocity with average speed.
- **Dividing by ‖v‖² for a unit vector.** Divide by ‖v‖.

## Where this goes next

Week 31 introduces matrices, rectangular arrays that act on vectors; week 32 shows that a 2 × 2 matrix times a vector rotates, reflects, stretches or shears it, and uses matrices acting on state vectors to model changes over time. In physics and calculus, vectors carry velocity, acceleration and force.

## Self-check

1. Find the magnitude and direction angle of ⟨−6, 6⟩.
2. For u = ⟨1, −2⟩ and v = ⟨4, 3⟩, find 3u + 2v and u · v, and decide whether the angle between them is acute or obtuse.
3. A force of 50 newtons acts at 30° above horizontal. Write it in component form.
4. For p(t) = ⟨5 cos t, 5 sin t⟩, find the displacement and the distance travelled from t = 0 to t = π.
5. Explain why the average velocity of a ball over an interval symmetric about its highest moment is horizontal.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 4, Topics 4.8–4.9). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
