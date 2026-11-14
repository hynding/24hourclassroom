# Unit 4 · Oblique Triangles and Vectors · The night-before sheet

**Topics:** 4.1 The Law of Sines · 4.2 The Ambiguous Case · 4.3 The Law of Cosines · 4.4 Triangle Area and Heron's Formula · 4.5 Surveying and Navigation · 4.6 Vectors, Magnitude and Direction · 4.7 Vector Operations and Unit Vectors · 4.8 The Dot Product and the Angle Between Vectors · 4.9 Projections and Work · 4.10 Forces, Equilibrium and Velocity
**Standards:** HSG-SRT.D.9, HSG-SRT.D.10, HSG-SRT.D.11, HSN-VM.A.1–3, HSN-VM.B.4–5 (extended to the dot product)
**Angles:** degrees throughout, unless an item says otherwise.

## The ideas that generate every question

1. **Every triangle is two right triangles.** Drop an altitude and h = b sin A = a sin B; that one line gives the law of sines, the SSA test and the area formula ½ab sin C.
2. **Pick the law from what you know.** Two angles and any side (AAS, ASA): law of sines. Two sides and the angle between them (SAS) or three sides (SSS): law of cosines. Two sides and an angle not between them (SSA): the ambiguous case, so test before solving.
3. **SSA can give 0, 1 or 2 triangles.** Compare a with h = b sin A. With A acute: a < h, none; a = h, one right triangle; h < a < b, two (B and 180° − B); a ≥ b, one. With A obtuse or right: one triangle if a > b, none otherwise.
4. **sin⁻¹ hides the second answer, cos⁻¹ never does.** sin B = 0.8 fits both B and 180° − B. The law of cosines gives an angle in (0°, 180°) with no ambiguity, which is why it is safest for the largest angle.
5. **Area needs an included angle or three sides.** ½ab sin C for SAS; Heron's √(s(s − a)(s − b)(s − c)) for SSS. Parallelograms are two triangles (ab sin θ); regular polygons are n congruent triangles from the centre.
6. **Navigation is triangle-building.** Turn bearings into the angles inside one triangle (draw a north line at every vertex), then choose the law. The reverse bearing differs by 180°.
7. **A vector is a length and a direction, stored as components.** v = ⟨a, b⟩ = ai + bj = |v|⟨cos θ, sin θ⟩. Magnitude √(a² + b²); direction from tan⁻¹ with a quadrant check.
8. **Vectors add by components.** Head-to-tail and parallelogram pictures explain it; components compute it. Scaling by k multiplies the length by |k| and reverses direction when k < 0.
9. **The dot product measures alignment.** u · v = u₁v₁ + u₂v₂ = |u||v| cos θ. Positive, acute; zero, orthogonal; negative, obtuse.
10. **Projections split a vector along a direction.** projᵥ u = ((u · v)/|v|²) v; what is left is orthogonal to v. Work is the projection idea with forces: W = F · d.
11. **Physics is vector addition.** Equilibrium: forces add to zero, so both component sums are zero. Ramps: w sin θ along, w cos θ into. Ground velocity = air velocity + wind; bank velocity = boat velocity + current.

## Key formulas and procedures

| Want | Do this |
|---|---|
| Law of sines | a/sin A = b/sin B = c/sin C |
| Law of cosines (side) | c² = a² + b² − 2ab cos C |
| Law of cosines (angle) | cos C = (a² + b² − c²)/(2ab) |
| SSA test (A acute) | h = b sin A; compare a with h and b |
| Area, SAS | ½ab sin C |
| Heron's formula | s = (a + b + c)/2; area = √(s(s − a)(s − b)(s − c)) |
| Parallelogram, sides a, b, angle θ | ab sin θ |
| Regular n-gon, circumradius R | ½nR² sin(360°/n) |
| Bearing → direction angle | θ = 90° − bearing (add 360° if negative) |
| Vector from P to Q | ⟨x₂ − x₁, y₂ − y₁⟩ |
| Magnitude, direction | |v| = √(a² + b²); θ from tan⁻¹(b/a) placed in v's quadrant |
| From magnitude and direction | v = ⟨|v| cos θ, |v| sin θ⟩ |
| Unit vector | v/|v| |
| Dot product | u · v = u₁v₁ + u₂v₂ = |u||v| cos θ |
| Angle between vectors | cos θ = (u · v)/(|u||v|), 0° ≤ θ ≤ 180° |
| Orthogonal | u · v = 0 |
| Scalar component, projection | compᵥ u = (u · v)/|v|; projᵥ u = ((u · v)/|v|²) v |
| Work | W = F · d = |F||d| cos θ |
| Equilibrium | ΣF = ⟨0, 0⟩: horizontal sum 0 and vertical sum 0 |
| Ramp at θ, weight w | along slope w sin θ; into slope w cos θ |
| Symmetric cables at θ | T = w/(2 sin θ) |
| Cancel a cross-wind or current | aim into it by α with (your speed) · sin α = (cross speed) |

## Classic question types and how to attack them

**"Solve the triangle."** Label a sketch, mark what is given, name the case (AAS, ASA, SAS, SSS, SSA). For SSS find the largest angle first with the law of cosines; the other two are then acute and the law of sines is safe. Carry unrounded values.

**"How many triangles?"** Compute h = b sin A and compare. If two, solve both: B₂ = 180° − B₁, and each gives its own C and c.

**"Find the area."** Look for an included angle (½ab sin C) or three sides (Heron). If neither, find one more part first.

**"How far apart, what bearing back?"** Draw north lines at each vertex, use alternate angles to find the angle at the turn, then the law of cosines for the distance and the law of sines (or components) for the direction.

**"How tall is the tower you cannot reach?"** Two sightings a known distance apart make an oblique triangle with angles α, 180° − β and β − α. The law of sines gives a slant distance; one right-triangle step gives the height.

**"Find the resultant / ground speed / course."** Convert every vector to components, add, convert back. State the direction the way the question asks: a direction angle or a bearing.

**"Find the angle between, test for perpendicular, project."** Dot product first; the rest follows from the formulas above. Check a projection by confirming the leftover part has dot product 0 with v.

**"Find the tensions."** Draw every force from the object, write both component equations, solve the 2 × 2 system, and check that the steeper cable carries more.

## Common mistakes

- Solving SSA with one answer from sin⁻¹ and missing the obtuse triangle (or inventing one when a ≥ b).
- Using the law of sines to find the largest angle when it might be obtuse.
- Law of cosines sign slips: −2ab cos C, and cos of an obtuse angle is negative, which makes the side longer.
- Heron's formula with the perimeter instead of the semiperimeter.
- Measuring a bearing from east, or a direction angle from north; reading N 40° E as 40°.
- Terminal minus initial reversed; tan⁻¹ answers for vectors pointing left.
- Adding magnitudes: |u + v| = |u| + |v| only for vectors in the same direction.
- Writing a dot product as a vector; projᵥ u divided by |v| instead of |v|².
- Ramp components swapped; a wind "from the north" drawn pointing north; heading confused with course.
- Rounding mid-problem: keep four or more significant figures until the final answer.

## Calculator or not?

Exact-value items use the special angles (cos 120° = −1/2, sin 150° = 1/2) and integer vectors; expect to compute dot products, magnitudes, 3-4-5 and 5-12-13 lengths and simple projections by hand. Everything with a non-special angle needs a calculator in **degree mode**: store intermediate results rather than retyping rounded ones, and round only at the end, to the place the question asks.

## Self-test

1. In triangle ABC, A = 35°, a = 12 and b = 18. How many triangles are there? Find each value of B.
2. A triangle has sides 7, 8 and 13. Find its largest angle and its area exactly.
3. In triangle ABC, b = 10, c = 14 and A = 72°. Find a.
4. A ship sails 40 nautical miles on a bearing of 075°, then 25 nautical miles on 200°. How far is it from its start?
5. Find the magnitude and direction angle of ⟨5, −12⟩.
6. For u = ⟨5, −1⟩ and v = ⟨2, 3⟩, find u · v, the angle between them, and projᵥ u.
7. An 80 N force at 25° above the horizontal pulls a cart 15 m along level ground. Find the work.
8. A 300 N load hangs from two cables, each 20° above the horizontal. Find each tension.

**Answers.**
1. h = 18 sin 35° ≈ 10.32 < 12 < 18: two triangles, B ≈ 59.36° or 120.64°.
2. cos C = (49 + 64 − 169)/112 = −1/2, so C = 120°; area ½ · 7 · 8 · sin 120° = 14√3 (Heron: s = 14, √(14 · 7 · 6 · 1) = √588 = 14√3).
3. a² = 100 + 196 − 280 cos 72° ≈ 209.47, a ≈ 14.47.
4. Interior angle at the turn 55°: d² = 1600 + 625 − 2000 cos 55° ≈ 1077.8, d ≈ 32.83 nautical miles.
5. 13; quadrant IV, 360° − tan⁻¹(12/5) ≈ 292.62°.
6. 7; cos θ = 7/(√26 · √13) ≈ 0.3807, θ ≈ 67.62°; projᵥ u = (7/13)⟨2, 3⟩ = ⟨14/13, 21/13⟩.
7. 80 · 15 · cos 25° ≈ 1087.57 J.
8. T = 300/(2 sin 20°) ≈ 438.57 N each.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSG-SRT.D.9–11, HSN-VM.A.1–3, HSN-VM.B.4–5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
