# Week 21 · The Law of Cosines and Triangle Area

**Topics:** 4.3 The Law of Cosines · 4.4 Triangle Area and Heron's Formula
**Standards:** HSG-SRT.D.9, HSG-SRT.D.10, HSG-SRT.D.11
**Spiral:** Week 20's law of sines needs a side paired with its opposite angle; this week handles the two cases where no such pair is given. The law of cosines is the Pythagorean theorem with a correction term, and week 5's signs by quadrant explain why that term changes sign for an obtuse angle. The area formula ½ab sin C is week 3's "height = hypotenuse × sine" once more.

## What you need to be able to do

- **4.3** State the law of cosines in all three forms and explain how it extends the Pythagorean theorem.
- **4.3** Solve SAS and SSS triangles, finding the largest angle first in SSS.
- **4.3** Decide whether a triangle is acute, right or obtuse from its three sides.
- **4.3** Choose the right law for any set of given data.
- **4.4** Find the area of a triangle from two sides and the included angle, and from three sides with Heron's formula.
- **4.4** Find the areas of parallelograms and regular polygons by splitting them into triangles.

## Key terms

| Term | Meaning |
|---|---|
| Law of cosines | c² = a² + b² − 2ab cos C, and likewise a² = b² + c² − 2bc cos A, b² = a² + c² − 2ac cos B. |
| Solved-for-angle form | cos C = (a² + b² − c²)/(2ab). |
| SAS | Two sides and the angle between them (the included angle). |
| SSS | All three sides. A triangle exists only if each side is less than the sum of the other two. |
| Semiperimeter | s = (a + b + c)/2, half the perimeter. |
| Heron's formula | Area = √(s(s − a)(s − b)(s − c)). |
| Central angle of a regular n-gon | 360°/n, the angle at the centre subtended by one side. |

## Where the law of cosines comes from (4.3)

Place angle C at the origin with side a along the positive x-axis, so B = (a, 0). Vertex A is at distance b from the origin in the direction of angle C, so A = (b cos C, b sin C). The length c is the distance from A to B:

  c² = (b cos C − a)² + (b sin C)²
   = b² cos² C − 2ab cos C + a² + b² sin² C
   = a² + b²(cos² C + sin² C) − 2ab cos C
   = a² + b² − 2ab cos C,

using sin² C + cos² C = 1 (week 6). The coordinates work for any C, acute or obtuse.

Read the formula as "Pythagoras plus a correction":

- C = 90°: cos C = 0, and c² = a² + b², the Pythagorean theorem.
- C acute: cos C > 0, so c² is less than a² + b²; the side across from an acute angle is shorter than the hypotenuse would be.
- C obtuse: cos C < 0, so subtracting a negative makes c² greater than a² + b².

That last pair gives a quick test. If c is the longest side, the triangle is acute when c² < a² + b², right when c² = a² + b², obtuse when c² > a² + b².

## Solving SAS and SSS triangles (4.3)

**Worked example 1 (SAS).** In triangle ABC, a = 8, b = 11 and C = 47°. Solve the triangle.

c² = 8² + 11² − 2(8)(11) cos 47° ≈ 64 + 121 − 120.03 ≈ 64.97, so c ≈ 8.06.

Now find an angle. The safest choice is the **smaller** of the remaining angles, the one opposite the shorter side a = 8, because a smaller angle in a triangle must be acute and sin⁻¹ will not mislead you. Using the cosine form avoids the issue completely:

cos A = (b² + c² − a²)/(2bc) = (121 + 64.97 − 64)/(2 · 11 · 8.06) ≈ 0.688, so A ≈ 46.5°. Then B ≈ 180° − 47° − 46.5° = 86.5°.

(Keep c unrounded in the calculator; with full precision A ≈ 46.54° and B ≈ 86.46°.)

**Worked example 2 (SSS).** A triangle has sides 7, 9 and 13. Find all three angles.

Start with the **largest** angle, opposite 13. If any angle is obtuse it is this one, and cosine (unlike sine) shows it by going negative.

cos C = (7² + 9² − 13²)/(2 · 7 · 9) = (49 + 81 − 169)/126 = −39/126 ≈ −0.3095, so C ≈ 108.0°.

The other two angles are now certainly acute, so either law works. cos A = (9² + 13² − 7²)/(2 · 9 · 13) = 201/234, A ≈ 30.8°, and B ≈ 180° − 108.0° − 30.8° ≈ 41.2°.

Quick check with the shortcut: 13² = 169 > 49 + 81 = 130, so the triangle is obtuse. ✓

## Which law to use

| Given | First step | Then |
|---|---|---|
| AAS or ASA | Angle sum for the third angle | Law of sines for the sides |
| SSA | Law of sines, testing B and 180° − B (week 20) | Or the law of cosines as a quadratic in the third side |
| SAS | Law of cosines for the third side | Law of cosines (or sines, for the smaller angle) |
| SSS | Law of cosines for the largest angle | Either law for the rest |
| AAA | No unique triangle | Similar triangles of every size fit |

The rule of thumb: if you know a side and the angle across from it, the law of sines is quicker; if not, use the law of cosines.

## Area from two sides and the included angle (4.4)

Area = ½ × base × height. Take side a as the base. The height from A to that base is b sin C (week 3: opposite side = hypotenuse × sine), so

  Area = ½ab sin C,

and by symmetry also ½bc sin A and ½ac sin B. The angle must be the one **between** the two sides. If C is obtuse, sin C = sin(180° − C) is still positive, so the formula needs no adjustment.

**Worked example 3.** Find the area of the triangle in worked example 1 (a = 8, b = 11, C = 47°).

Area = ½(8)(11) sin 47° ≈ 32.18 square units.

## Heron's formula (4.4)

When only the three sides are known, Heron's formula gives the area directly. Compute the semiperimeter s = (a + b + c)/2, then

  Area = √(s(s − a)(s − b)(s − c)).

**Worked example 4.** Find the area of the triangle with sides 7, 9 and 13.

s = (7 + 9 + 13)/2 = 14.5. Area = √(14.5 × 7.5 × 5.5 × 1.5) = √897.1875 ≈ 29.95 square units.

Check with the angle from worked example 2: ½(7)(9) sin 108.03° ≈ 29.95. ✓

A useful sanity check: every factor s − a, s − b, s − c must be positive. A zero or negative factor means the "triangle" fails the triangle inequality.

## Parallelograms and regular polygons (4.4)

A diagonal splits a parallelogram with sides p and q and angle θ into two congruent triangles, each of area ½pq sin θ, so

  Area of parallelogram = pq sin θ.

A regular n-gon whose vertices lie on a circle of radius r splits into n congruent isosceles triangles meeting at the centre, each with two sides r and included angle 360°/n:

  Area of regular n-gon = ½ n r² sin(360°/n).

**Worked example 5 (parallelogram).** A parallelogram has sides 10 and 6 with an angle of 70° between them. Find its area and both diagonals.

Area = 10 × 6 × sin 70° ≈ 56.38. The diagonals are third sides of SAS triangles, one using 70° and one using the adjacent angle 110°:

- short diagonal² = 10² + 6² − 2(10)(6) cos 70° ≈ 94.96, so it is ≈ 9.74;
- long diagonal² = 10² + 6² − 2(10)(6) cos 110° ≈ 177.04, so it is ≈ 13.31.

**Worked example 6 (regular polygons).** Find the area of a regular octagon inscribed in a circle of radius 5, and of a regular pentagon with side 6.

Octagon: ½ × 8 × 5² × sin 45° = 100 sin 45° ≈ 70.71.

Pentagon: first find the radius. Each central triangle has apex angle 72° and base 6; half of it is a right triangle with angle 36° opposite 3, so r = 3/sin 36° ≈ 5.104. Area = ½ × 5 × r² × sin 72° ≈ 61.94.

## Common errors

- **Dropping the minus sign or the 2.** It is −2ab cos C, and the angle is the one **opposite** the side you are finding.
- **Evaluating left to right.** 64 + 121 − 176 cos 47° is not (64 + 121 − 176) cos 47°; multiply first.
- **Using sin⁻¹ for the largest angle in SSS.** A 108° angle would come back as 72°. Find the largest angle with cosine first.
- **Using a non-included angle in ½ab sin C.** The angle must sit between the two sides.
- **Forgetting the square root in Heron's formula,** or using the full perimeter instead of s.
- **Polygon areas with the wrong angle.** The central angle of a regular n-gon is 360°/n, not the interior angle.

## Where this goes next

Week 22 uses both laws, and these area formulas, for surveying and navigation: multi-leg courses, distances across water and land you cannot measure directly. In week 23 the law of cosines reappears as the magnitude of a sum of two vectors, and in week 24 its form c² = a² + b² − 2ab cos C turns into the dot-product formula for the angle between vectors.

## Self-check

1. Find c when a = 12, b = 9 and C = 125°, and say why c is the longest side.
2. Find the largest angle of the triangle with sides 4, 6 and 9, and classify the triangle.
3. Find the area of the triangle with sides 13, 14 and 15 by Heron's formula.
4. A parallelogram has sides 12 and 7 with a 135° angle. Find its area.
5. Find the area of a regular hexagon with side 4, and explain why its radius is also 4.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSG-SRT.D.9, HSG-SRT.D.10, HSG-SRT.D.11). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
