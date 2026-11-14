# Unit 4 Summary · Right Triangle Trigonometry

**Lessons covered:** 4.1–4.11 (weeks 15–17): steepness, the half-square and half-equilateral triangles, the ratio table (4.1–4.4); sine, cosine and tangent, finding sides, applications, complementary angles (4.5–4.8); finding angles, multi-step problems, approximating π (4.9–4.11).

This is the night-before sheet. Every fact below was derived in class; on the exam you may use any of them, and a calculator in degree mode.

## The ideas that generate every question

1. **All right triangles with the same acute angle are similar (AA)**, so each ratio of two sides is a function of the angle alone. That is what sin, cos and tan are.
2. **Choose the ratio by the two sides involved**, never by habit. Opposite and hypotenuse: sine. Adjacent and hypotenuse: cosine. Two legs: tangent.
3. **Multiply when the wanted side is on top; divide when it is underneath.** Side wanted, angle known: ratio. Angle wanted, two sides known: inverse ratio.
4. **The two acute angles are complementary**, so sin θ = cos(90° − θ), the ratio table swaps columns, and a solved triangle can be checked by the angle sum and by Pythagoras.
5. **One right triangle from the centre** (apex angle 180°/n, hypotenuse r if inscribed, apothem r if circumscribed) gives every regular polygon, and the polygons squeeze π.

## Definitions and exact values

| | cos θ = adj/hyp | sin θ = opp/hyp | tan θ = opp/adj |
|---|---|---|---|
| 30° | √3/2 ≈ 0.866 | 1/2 | 1/√3 ≈ 0.577 |
| 45° | √2/2 ≈ 0.707 | √2/2 ≈ 0.707 | 1 |
| 60° | 1/2 | √3/2 ≈ 0.866 | √3 ≈ 1.732 |

- 45-45-90: legs x, hypotenuse x√2. 30-60-90: short leg x (opposite 30°), long leg x√3 (opposite 60°), hypotenuse 2x.
- Steepness = rise/run = tan(angle with the horizontal). Steeper means a bigger ratio and a bigger angle, but not proportionally.
- Identities: sin θ = cos(90° − θ); tan θ = sin θ / cos θ; sin² θ + cos² θ = 1; 0 < sin θ, cos θ < 1; tan θ > 0 and unbounded.
- As θ grows: sine rises from 0 to 1, cosine falls from 1 to 0, tangent rises from 0 without bound; sine and cosine cross at 45°.

## Finding sides

| Wanted from known | Equation |
|---|---|
| opposite from hypotenuse | opp = hyp · sin θ |
| adjacent from hypotenuse | adj = hyp · cos θ |
| opposite from adjacent | opp = adj · tan θ |
| hypotenuse from opposite | hyp = opp / sin θ |
| hypotenuse from adjacent | hyp = adj / cos θ |
| adjacent from opposite | adj = opp / tan θ |

## Finding angles

θ = sin⁻¹(opp/hyp) = cos⁻¹(adj/hyp) = tan⁻¹(opp/adj). Inputs to sin⁻¹ and cos⁻¹ must be between 0 and 1. sin⁻¹ is the inverse function, not 1/sin. Exact cases: sin⁻¹(1/2) = 30°, cos⁻¹(1/2) = 60°, tan⁻¹(1) = 45°, tan⁻¹(√3) = 60°, sin⁻¹(√2/2) = 45°. The 3-4-5 triangle has angles 36.9° and 53.1°.

## Applications

- **Elevation:** height = horizontal distance × tan(elevation) (add eye height if the sight line starts at eye level).
- **Depression:** equals the elevation angle from below (alternate interior angles between parallel horizontals). Distance = height / tan(depression).
- **Ladder of length L at angle θ:** height L sin θ, foot L cos θ. Safety: about 75° (tan θ ≈ 4).
- **Guy wire from height h at angle θ:** length h / sin θ, anchor h / tan θ.
- **Two sightings 20 m apart (angles α nearer, β farther):** h = x tan α = (x + 20) tan β; solve for x.
- **Isosceles triangle:** the altitude bisects the base; base angle = cos⁻¹((base/2)/side).
- **Not right?** Drop an altitude. **Box diagonal:** two Pythagorean steps; angle with the base from tan⁻¹.

## Regular polygons and π

For a regular n-gon, the right triangle at the centre has angle 180°/n.

| | Inscribed (radius r) | Circumscribed (radius r) |
|---|---|---|
| half-side | r sin(180°/n) | r tan(180°/n) |
| perimeter | 2nr sin(180°/n) | 2nr tan(180°/n) |
| apothem | r cos(180°/n) | r |
| area | n r² sin(180°/n) cos(180°/n) | n r² tan(180°/n) |

Hexagon inscribed in radius r: side r, perimeter 6r, area (3√3/2)r². Bounds: n sin(180°/n) < π < n tan(180°/n); n = 12 gives 3.106 < π < 3.215, n = 96 gives 3.1410 < π < 3.1427 (Archimedes: 3 10/71 < π < 3 1/7). One π works for all circles because all circles are similar.

## Common errors

- Radian mode (sin 30° shows −0.988).
- Choosing sine when both known sides are legs, or tangent when the hypotenuse is involved.
- Dividing when the wanted side is on top of the ratio, or multiplying when it is underneath.
- √3 on the short leg; √2 in a 30-60-90 triangle.
- Reading the angle of depression at the base, or measuring it from the vertical.
- Using the full central angle 360°/n in the polygon's right triangle.
- Rounding ratios to one decimal place and carrying the error.

## Worked examples

**1. Side.** Angle 25°, hypotenuse 40: opposite 40 sin 25° ≈ 16.9, adjacent 40 cos 25° ≈ 36.3. Check: 285.6 + 1317.7 ≈ 1600 ✓.

**2. Angle.** Legs 5 and 12: tan⁻¹(5/12) ≈ 22.6° opposite the 5; the other angle 67.4°.

**3. Elevation.** 80 m from a tower, elevation 31°: height 80 tan 31° ≈ 48.1 m.

**4. Two sightings.** Elevations 28° then, 25 m closer, 47°: x tan 47° = (x + 25) tan 28°, x(1.0724 − 0.5317) = 13.29, x ≈ 24.6 m, h ≈ 26.4 m.

**5. Polygon.** Regular octagon inscribed in radius 10: side 20 sin 22.5° ≈ 7.65, perimeter ≈ 61.2, apothem 10 cos 22.5° ≈ 9.24, area ≈ 282.8.

**6. Identity.** cos θ = 0.28 gives sin θ = 0.96 (the 7-24-25 triangle) and tan θ ≈ 3.43; θ ≈ 73.7°.

## What to review from earlier units

From Unit 3: AA similarity (the foundation of the ratios), the Pythagorean theorem (every check and every third side), the 45-45-90 and 30-60-90 facts, shadow problems (tangent in disguise). From Unit 1: alternate interior angles (depression equals elevation) and the angle sum. From Unit 2: the altitude of an isosceles triangle bisects the base.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 4, Lessons 1–11, https://im.kendallhunt.com/HS/teachers/2/4/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
