# Week 24 · The Dot Product, Projections and Work

**Topics:** 4.8 The Dot Product and the Angle Between Vectors · 4.9 Projections and Work
**Standards:** HSN-VM.B.4 (extension), HSN-VM.B.5 (extension), HSG-SRT.D.10
**Spiral:** Week 23 built vectors in component form, with magnitudes, direction angles and unit vectors; every calculation this week starts there. The angle formula is the law of cosines from week 21 rewritten for vectors, and week 15's cos(α − β) = cos α cos β + sin α sin β turns out to be a dot product of two unit vectors. Week 11's inverse cosine returns angles in [0°, 180°], exactly the range of possible angles between two vectors, so no quadrant check is needed.

## What you need to be able to do

- **4.8** Compute u · v from components, and use its properties (commutative, distributive, v · v = |v|²).
- **4.8** Find the angle between two vectors with cos θ = (u · v)/(|u||v|), and read the sign of u · v as acute, right or obtuse.
- **4.8** Decide whether two vectors are orthogonal, parallel or neither, and find an unknown component that makes two vectors orthogonal.
- **4.9** Find the projection of u onto v, the scalar component of u along v, and write u as a sum of a vector parallel to v and a vector orthogonal to v.
- **4.9** Compute the work done by a constant force, W = F · d = |F||d| cos θ, from components or from magnitudes and an angle.

## Key terms

| Term | Meaning |
|---|---|
| Dot product | For u = ⟨u₁, u₂⟩ and v = ⟨v₁, v₂⟩, u · v = u₁v₁ + u₂v₂. The result is a scalar, not a vector. |
| Angle between vectors | The angle θ, 0° ≤ θ ≤ 180°, between u and v when their tails are placed together. |
| Orthogonal | Perpendicular: u · v = 0. The zero vector counts as orthogonal to every vector. |
| Parallel | One vector is a scalar multiple of the other; the angle between them is 0° or 180°. |
| Scalar component (compᵥ u) | The signed length of the shadow of u on the line of v: (u · v)/|v|. |
| Projection (projᵥ u) | The vector shadow of u on the line of v: ((u · v)/|v|²) v. |
| Work | The energy transferred by a constant force F moving an object through displacement d: W = F · d. Units: joules (newton-metres) or foot-pounds. |

## The dot product and its properties (4.8)

Multiply matching components and add: ⟨3, −4⟩ · ⟨2, 5⟩ = 3·2 + (−4)·5 = 6 − 20 = −14. The answer is a single number.

The properties follow from the definition and are used constantly:

- u · v = v · u
- u · (v + w) = u · v + u · w
- (ku) · v = k(u · v)
- v · v = v₁² + v₂² = |v|², so |v| = √(v · v)
- 0 · v = 0

**Worked example 1.** For u = ⟨3, −4⟩, v = ⟨2, 5⟩ and w = ⟨−1, 1⟩, find u · v, u · u and u · (v + w).

u · v = −14. u · u = 9 + 16 = 25 = |u|², and |u| = 5. v + w = ⟨1, 6⟩, so u · (v + w) = 3 − 24 = −21; by the distributive property it also equals u · v + u · w = −14 + (−7) = −21.

## The angle between two vectors (4.8)

Put the tails of u and v together. The third side of the triangle they make is u − v, and the law of cosines gives

|u − v|² = |u|² + |v|² − 2|u||v| cos θ.

Expanding the left side with the dot product, |u − v|² = (u − v) · (u − v) = |u|² − 2u · v + |v|². Comparing the two lines:

**u · v = |u||v| cos θ**, so **cos θ = (u · v)/(|u||v|)**.

Because the magnitudes are positive, the sign of u · v is the sign of cos θ:

| u · v | angle θ | |
|---|---|---|
| positive | 0° ≤ θ < 90° | acute: the vectors point "the same way" |
| zero | θ = 90° | orthogonal |
| negative | 90° < θ ≤ 180° | obtuse: they point "against each other" |

The inverse cosine returns an angle in [0°, 180°], which is exactly the set of possible angles between two vectors, so its answer never needs adjusting.

**Worked example 2.** Find the angle between u = ⟨2, 1⟩ and v = ⟨−1, 3⟩.

u · v = −2 + 3 = 1. |u| = √5, |v| = √10. cos θ = 1/(√5 · √10) = 1/√50 ≈ 0.1414, so θ = cos⁻¹(0.1414) ≈ 81.87°. The dot product is positive but small, so the angle is acute but close to a right angle.

**A connection with week 15.** Unit vectors at direction angles α and β are ⟨cos α, sin α⟩ and ⟨cos β, sin β⟩. Their dot product is cos α cos β + sin α sin β, and the angle between them is α − β, so the formula says cos(α − β) = cos α cos β + sin α sin β: the difference formula, recovered in one line.

## Orthogonal and parallel vectors (4.8)

Two vectors are orthogonal exactly when their dot product is 0. Parallel vectors are scalar multiples of each other; for them cos θ = ±1.

**Worked example 3.** (a) Are ⟨6, −4⟩ and ⟨2, 3⟩ orthogonal? (b) Find k so that ⟨k, 3⟩ is orthogonal to ⟨4, −6⟩. (c) Classify ⟨2, −5⟩ and ⟨−6, 15⟩.

(a) 12 − 12 = 0: yes.
(b) 4k − 18 = 0, so k = 4.5.
(c) ⟨−6, 15⟩ = −3⟨2, −5⟩, so they are parallel, pointing in opposite directions (θ = 180°). Check: the dot product is −12 − 75 = −87 and |u||v| = √29 · 3√29 = 87, so cos θ = −1.

A quick way to write a vector orthogonal to ⟨a, b⟩: swap the components and change one sign, ⟨−b, a⟩ or ⟨b, −a⟩.

## Projections: splitting a vector along a direction (4.9)

Shine a light perpendicular to the line of v. The shadow that u casts on that line is the **projection of u onto v**. Its signed length is the scalar component

compᵥ u = |u| cos θ = (u · v)/|v|,

and the projection itself is that length times the unit vector v/|v|:

projᵥ u = ((u · v)/|v|²) v.

What is left over, u − projᵥ u, is orthogonal to v. So every vector splits as

u = (part parallel to v) + (part orthogonal to v) = projᵥ u + (u − projᵥ u).

If u · v < 0, the scalar component is negative and the projection points opposite to v.

**Worked example 4.** Let u = ⟨5, 1⟩ and v = ⟨3, 4⟩. Find compᵥ u and projᵥ u, and write u as a sum of a vector parallel to v and a vector orthogonal to v.

u · v = 15 + 4 = 19, |v| = 5, |v|² = 25.
compᵥ u = 19/5 = 3.8.
projᵥ u = (19/25)⟨3, 4⟩ = ⟨57/25, 76/25⟩ = ⟨2.28, 3.04⟩.
Orthogonal part: u − projᵥ u = ⟨5 − 2.28, 1 − 3.04⟩ = ⟨2.72, −2.04⟩.
Check: ⟨2.72, −2.04⟩ · ⟨3, 4⟩ = 8.16 − 8.16 = 0, and the two parts add back to ⟨5, 1⟩.

Note the order: projᵥ u divides by |v|², the length of the vector you project **onto**. Swapping u and v gives a different vector.

## Work (4.9)

When a constant force moves an object in a straight line, only the part of the force along the motion transfers energy. If the force F makes angle θ with the displacement d, that part has size |F| cos θ, so

W = (|F| cos θ)|d| = |F||d| cos θ = F · d.

A force at right angles to the motion does no work; a force against the motion does negative work.

**Worked example 5.** (a) A child pulls a sled 40 m across level snow with a force of 60 N along a rope that makes 35° with the ground. How much work is done? (b) A force F = ⟨4, 7⟩ newtons moves an object from (1, 2) to (9, 5), distances in metres. Find the work.

(a) W = |F||d| cos θ = 60 · 40 · cos 35° ≈ 1965.96 J. Only 60 cos 35° ≈ 49.15 N of the pull acts along the ground; the rest lifts slightly on the sled.

(b) d = ⟨9 − 1, 5 − 2⟩ = ⟨8, 3⟩. W = F · d = 32 + 21 = 53 J.

**Worked example 6.** A box is pushed 6 m along level ground, displacement d = ⟨6, 0⟩, by a force F = ⟨20, −15⟩ newtons (pushing forward and down). Find the work and the force component along the motion.

W = 20 · 6 + (−15) · 0 = 120 J. The component along d is comp_d F = (F · d)/|d| = 120/6 = 20 N; the downward 15 N only presses the box into the floor and does no work. (|F| = 25 N, so cos θ = 20/25 and θ ≈ 36.87°.)

## Common errors

- **Writing u · v as a vector.** ⟨3, −4⟩ · ⟨2, 5⟩ is −14, not ⟨6, −20⟩.
- **Forgetting to divide by both magnitudes.** cos θ = (u · v)/(|u||v|); dividing by only one gives a "cosine" that can exceed 1.
- **Reading a negative angle.** cos⁻¹ never returns one. A negative dot product means an obtuse angle, between 90° and 180°.
- **projᵥ u with |v| instead of |v|².** ((u · v)/|v|) v has the wrong length unless |v| = 1.
- **Projecting the wrong way round.** proj onto v uses v in the denominator and as the direction.
- **Work with the wrong angle.** Use the angle between the force and the direction of motion, not the angle with the vertical. A 35° pull above the ground uses cos 35°.
- **Units.** Newtons times metres give joules; pounds times feet give foot-pounds.

## Where this goes next

Week 25 applies projections to objects on ramps (the weight splits into a part along the slope and a part pressing into it), and uses vector sums for forces in equilibrium and for airplanes and boats in wind and current. In Unit 5, the rotation of a point and the multiplication of complex numbers rest on the same cosine-and-sine components.

## Self-check

1. Compute ⟨−2, 7⟩ · ⟨4, 1⟩ and say whether the angle between the vectors is acute, right or obtuse.
2. Find the angle between ⟨1, 1⟩ and ⟨1, −√3⟩ exactly.
3. Find c so that ⟨c, −2⟩ and ⟨5, 10⟩ are orthogonal.
4. Find projᵥ u for u = ⟨4, 2⟩ and v = ⟨1, 3⟩.
5. A 30-lb force at 50° above the horizontal drags a crate 25 ft along level floor. Find the work to the nearest foot-pound.

*Answers:* 1. −8 + 7 = −1: obtuse. 2. cos θ = (1 − √3)/(√2 · 2) = (√2 − √6)/4, so θ = 105°. 3. 5c − 20 = 0, c = 4. 4. u · v = 10, |v|² = 10, so projᵥ u = ⟨1, 3⟩. 5. 30 · 25 · cos 50° ≈ 482 ft-lb.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSN-VM.B.4–5, extended to the dot product; HSG-SRT.D.10). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
