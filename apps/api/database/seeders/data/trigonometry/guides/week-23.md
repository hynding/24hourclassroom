# Week 23 · Vectors

**Topics:** 4.6 Vectors, Magnitude and Direction · 4.7 Vector Operations and Unit Vectors
**Standards:** HSN-VM.A.1, HSN-VM.A.2, HSN-VM.A.3, HSN-VM.B.4, HSN-VM.B.5
**Spiral:** Week 3's bearings (N 35° E and the azimuth 035°) and week 5's point-on-the-terminal-side definitions are exactly what turns a vector into components and back: a vector of length r at direction angle θ has components r cos θ and r sin θ. Week 11's inverse tangent gives a direction angle, but only after the quadrant check from week 5. Weeks 20–22 solved triangles with the laws of sines and cosines; this week the same navigation problems are solved a second way, by adding components.

## What you need to be able to do

- **4.6** Tell a vector (magnitude and direction) from a scalar (size only), and recognise equivalent directed segments.
- **4.6** Write a vector in component form ⟨a, b⟩ from its initial and terminal points, and find its magnitude |v| = √(a² + b²).
- **4.6** Find the direction angle of a vector, placing it in the correct quadrant, and convert between direction angles and bearings.
- **4.6** Write a vector from its magnitude and direction: v = |v|⟨cos θ, sin θ⟩.
- **4.7** Add and subtract vectors, by components and with the triangle and parallelogram pictures, and multiply a vector by a scalar.
- **4.7** Find a unit vector in a given direction, and write vectors as ai + bj.

## Key terms

| Term | Meaning |
|---|---|
| Vector | A quantity with both magnitude (size) and direction, such as a velocity or a force. Drawn as an arrow, a directed segment. |
| Scalar | A quantity with size only: a speed, a mass, a temperature, a real number multiplying a vector. |
| Initial and terminal point | The tail and the head of the arrow. The vector from P to Q is written PQ. |
| Equivalent vectors | Two directed segments with the same length and the same direction, wherever they sit. They are the same vector. |
| Component form | ⟨a, b⟩: the horizontal and vertical change from tail to head. Position vector: the arrow from the origin to (a, b). |
| Magnitude | The length of the vector, |v| = √(a² + b²). |
| Direction angle | The angle θ, 0° ≤ θ < 360°, from the positive x-axis to the vector, measured counterclockwise. |
| Unit vector | A vector of magnitude 1. The standard unit vectors are i = ⟨1, 0⟩ and j = ⟨0, 1⟩. |
| Resultant | The sum of two or more vectors: the single vector with the same overall effect. |

## Vectors in component form (4.6)

Two arrows that point the same way and have the same length represent the same vector, even if one starts at (0, 0) and the other at (7, −2). So the only information a vector carries is how far it goes across and how far it goes up. For the vector from P(x₁, y₁) to Q(x₂, y₂):

PQ = ⟨x₂ − x₁, y₂ − y₁⟩ (terminal minus initial).

The magnitude is the distance from P to Q, by the Pythagorean theorem: |⟨a, b⟩| = √(a² + b²).

**Worked example 1.** Find the component form, magnitude and direction angle of the vector from P(−2, 1) to Q(4, −7).

v = ⟨4 − (−2), −7 − 1⟩ = ⟨6, −8⟩. |v| = √(36 + 64) = √100 = 10.

The vector points right and down, so it lies in quadrant IV. The reference angle is tan⁻¹(8/6) ≈ 53.13°, so the direction angle is 360° − 53.13° = 306.87°. (A calculator's tan⁻¹(−8/6) gives −53.13°, which is the same direction measured clockwise; add 360° to report it in [0°, 360°).)

## Direction angles: the quadrant check (4.6)

For v = ⟨a, b⟩, tan θ = b/a, but tan⁻¹ only returns angles between −90° and 90° (week 11). That is fine for vectors pointing right (a > 0). For vectors pointing left it is off by 180°. The safe procedure:

1. Sketch the vector, or just read the signs of a and b, to find its quadrant.
2. Find the reference angle θ′ = tan⁻¹(|b|/|a|).
3. Place it: quadrant I θ = θ′; II θ = 180° − θ′; III θ = 180° + θ′; IV θ = 360° − θ′.

On an axis, read the angle directly: ⟨0, −3⟩ points straight down, θ = 270°.

**Worked example 2.** Find the magnitude and direction angle of v = ⟨−5, 12⟩.

|v| = √(25 + 144) = 13. The vector points left and up: quadrant II. Reference angle tan⁻¹(12/5) ≈ 67.38°, so θ = 180° − 67.38° = 112.62°. The calculator's tan⁻¹(12/(−5)) = −67.38° points into quadrant IV, the exact opposite direction; that is the error the quadrant check catches.

## From magnitude and direction to components (4.6)

The point at angle θ on a circle of radius r is (r cos θ, r sin θ) (week 5). A vector of length |v| at direction angle θ ends at exactly that point, so

v = ⟨|v| cos θ, |v| sin θ⟩ = |v|⟨cos θ, sin θ⟩.

Navigation problems give a bearing instead. A bearing is measured **clockwise from north**; a direction angle is measured **counterclockwise from east**. Convert with θ = 90° − bearing (adding 360° if the result is negative). N 40° E is the bearing 040°, so θ = 50°. S 30° W is the bearing 210°, so θ = 90° − 210° = −120°, which is 240°.

**Worked example 3.** (a) Write the vector of magnitude 20 with direction angle 210° in component form. (b) An airplane flies at 300 mph on a bearing of N 40° E. Write its velocity in component form (east and north components).

(a) v = ⟨20 cos 210°, 20 sin 210°⟩ = ⟨20(−√3/2), 20(−1/2)⟩ = ⟨−10√3, −10⟩ ≈ ⟨−17.32, −10⟩. Both components are negative, as a quadrant III vector requires.

(b) The direction angle is 90° − 40° = 50°. v = ⟨300 cos 50°, 300 sin 50°⟩ ≈ ⟨192.84, 229.81⟩: about 192.84 mph east and 229.81 mph north.

## Operations: scaling, adding, subtracting (4.7)

**Scalar multiplication.** kv = ⟨ka, kb⟩. The length is multiplied by |k|: |kv| = |k||v|. If k > 0 the direction is unchanged; if k < 0 it reverses. So −v is v turned around, and 3v is three times as long.

**Addition.** u + v = ⟨u₁ + v₁, u₂ + v₂⟩. Geometrically:

- *Triangle (head-to-tail) rule:* place the tail of v at the head of u. The sum runs from the tail of u to the head of v. This is what happens when a ship sails one leg and then another.
- *Parallelogram rule:* place both tails at one point and complete the parallelogram. The sum is the diagonal from the common tail. This is what happens when two forces pull on one object.

Both pictures give the same vector, and both show that |u + v| is usually **less** than |u| + |v|: the two sides of a triangle are longer than the third side. Only when u and v point the same way are they equal.

**Subtraction.** u − v = u + (−v) = ⟨u₁ − v₁, u₂ − v₂⟩. With both tails at one point, u − v runs from the head of v to the head of u.

**Worked example 4.** For u = ⟨3, −2⟩ and v = ⟨−1, 4⟩, find 2u − 3v and its magnitude.

2u = ⟨6, −4⟩ and 3v = ⟨−3, 12⟩. 2u − 3v = ⟨6 − (−3), −4 − 12⟩ = ⟨9, −16⟩. |2u − 3v| = √(81 + 256) = √337 ≈ 18.36.

## Unit vectors and i, j (4.7)

To get a vector of length 1 pointing the same way as v, divide v by its own length:

unit vector in the direction of v = v/|v|.

Every vector can be written with the standard unit vectors: ⟨a, b⟩ = a⟨1, 0⟩ + b⟨0, 1⟩ = ai + bj. So ⟨6, −8⟩ = 6i − 8j. Every unit vector is ⟨cos θ, sin θ⟩ for its direction angle θ, a point on the unit circle.

**Worked example 5.** Find the unit vector in the direction of v = −5i + 12j, and the vector of length 39 in the same direction.

|v| = 13, so the unit vector is (−5/13)i + (12/13)j. Check: (25 + 144)/169 = 1. The vector of length 39 is 39 times the unit vector: −15i + 36j.

## A resultant two ways (4.7 and week 21)

**Worked example 6.** Vector u has magnitude 8 and direction angle 30°; vector v has magnitude 5 and direction angle 135°. Find the magnitude and direction angle of u + v.

Components: u ≈ ⟨6.928, 4.000⟩ and v = ⟨5 cos 135°, 5 sin 135°⟩ ≈ ⟨−3.536, 3.536⟩. Sum: u + v ≈ ⟨3.393, 7.536⟩.

Magnitude √(3.393² + 7.536²) ≈ 8.26. The sum is in quadrant I, so θ = tan⁻¹(7.536/3.393) ≈ 65.76°.

Check with the law of cosines: the angle between u and v is 135° − 30° = 105°, so in the parallelogram the angle opposite the diagonal is 180° − 105° = 75°, and |u + v|² = 64 + 25 − 80 cos 75° ≈ 68.29, giving 8.26 again. Components are usually quicker, and they give the direction at the same time.

## Common errors

- **Initial minus terminal.** PQ is Q − P. Reversing it gives −PQ, the same length pointing the other way.
- **Trusting tan⁻¹ for a vector that points left.** ⟨−5, 12⟩ is at 112.62°, not −67.38°. Always check the quadrant.
- **Using a bearing as a direction angle.** N 40° E is θ = 50°, not 40°: bearings start at north and turn clockwise.
- **Adding magnitudes.** |u + v| = |u| + |v| only when u and v point the same way. Add components, then find the length.
- **Forgetting to divide by the magnitude.** ⟨−5, 12⟩/13, not ⟨−5, 12⟩, is the unit vector; a unit vector's components satisfy a² + b² = 1.
- **Scaling by a negative.** |−3v| = 3|v|, not −3|v|; a magnitude is never negative. The negative sign reverses the direction.

## Where this goes next

Week 24 multiplies two vectors to get a number, the dot product, which measures how much they point the same way: it gives the angle between vectors, tests for perpendicularity, splits a vector into pieces along and across a direction, and computes work. Week 25 puts all of this to use on forces in equilibrium, objects on ramps, and airplanes and boats pushed off course by wind and current. Unit 5 reuses ⟨r cos θ, r sin θ⟩ for polar coordinates and for complex numbers in trigonometric form.

## Self-check

1. Find the component form and magnitude of the vector from (3, −1) to (−5, 5).
2. Find the direction angle of ⟨−4, −7⟩ to the nearest tenth of a degree.
3. A boat's velocity is 18 knots on a bearing of S 25° E. Write it in component form.
4. For u = 2i − j and v = −3i + 4j, find 4u + v and |4u + v|.
5. Find the unit vector in the direction of ⟨7, −24⟩.

*Answers:* 1. ⟨−8, 6⟩, magnitude 10. 2. Quadrant III, 180° + tan⁻¹(7/4) ≈ 240.3°. 3. Bearing 155°, θ = −65°: ⟨18 cos(−65°), 18 sin(−65°)⟩ ≈ ⟨7.61, −16.31⟩. 4. ⟨5, 0⟩ = 5i, magnitude 5. 5. ⟨7/25, −24/25⟩.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSN-VM.A.1–3, HSN-VM.B.4–5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
