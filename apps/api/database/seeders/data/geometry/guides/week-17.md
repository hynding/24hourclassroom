# Week 17 · Finding Angles and Approximating π

**Lessons:** 4.9 Using Trigonometric Ratios to Find Angles · 4.10 Solving Problems with Trigonometry · 4.11 Approximating Pi
**Practices:** MP1 (persevere), MP5 (use tools strategically), MP8 (regularity)
**Built from:** IM Geometry, Unit 4, Lessons 9–11, in our own words
**Spiral:** the ramp and ladder problems of weeks 15–16 are finished by going from a ratio back to an angle; isosceles triangles split by an altitude (week 9) are how a regular polygon becomes right triangles; the "always similar" circles of week 12 are why one number, π, serves every circle.

## What you need to be able to do

- Use arcsin, arccos and arctan (the inverse trigonometric functions, written sin⁻¹, cos⁻¹, tan⁻¹ on most calculators) to find an acute angle from two sides.
- Decide, for any right-triangle problem, whether a side or an angle is wanted and which ratio connects the given data to it; solve multi-step problems that combine two triangles or trigonometry with the Pythagorean theorem.
- Compute the perimeter and area of a regular polygon inscribed in or circumscribed about a circle, using one right triangle from the polygon's centre.
- Explain how those polygons squeeze the circumference and area of a circle between two bounds and so approximate π.

## Key terms

| Term | Meaning |
|---|---|
| arcsin x (sin⁻¹ x) | The acute angle whose sine is x, for 0 < x < 1. |
| arccos x (cos⁻¹ x) | The acute angle whose cosine is x. |
| arctan x (tan⁻¹ x) | The acute angle whose tangent is x, for any x > 0. |
| Regular polygon | All sides equal and all angles equal; it has a centre equidistant from every vertex. |
| Inscribed polygon | Vertices on a circle; its perimeter is less than the circumference. |
| Circumscribed polygon | Sides tangent to a circle; its perimeter is more than the circumference. |
| Apothem | The distance from the centre of a regular polygon to the midpoint of a side. |
| π | Circumference ÷ diameter of any circle, about 3.14159; also area ÷ radius². |

## 1. From a ratio to an angle

Last week: angle known, side wanted. Now: two sides known, angle wanted.

1. Label the two known sides relative to the wanted angle (opposite, adjacent, hypotenuse).
2. Form the ratio they make: sin, cos or tan.
3. Apply the inverse: θ = sin⁻¹(ratio), cos⁻¹(ratio) or tan⁻¹(ratio). Degree mode.

**Worked example 1.** A ramp rises 1 m over a run of 12 m. tan θ = 1/12 ≈ 0.0833, θ = tan⁻¹(0.0833) ≈ 4.8°.

**Worked example 2.** A 6 m ladder reaches 5.4 m up a wall. sin θ = 5.4/6 = 0.9, θ = sin⁻¹(0.9) ≈ 64.2°. Is it safe? The "4 : 1 rule" says the foot should be a quarter of the height from the wall, giving tan θ = 4 and θ = tan⁻¹ 4 ≈ 76°. This ladder is leaning too far out.

**Worked example 3.** Right triangle with legs 7 and 24. The angle opposite 7: tan⁻¹(7/24) ≈ 16.3°. The other acute angle: 90° − 16.3° = 73.7°, or tan⁻¹(24/7) ≈ 73.7° ✓, or cos⁻¹(7/25) ≈ 73.7° ✓.

**Worked example 4.** Hypotenuse 15, one leg 9. The angle between them: cos θ = 9/15 = 0.6, θ = cos⁻¹(0.6) ≈ 53.1°. (The 3-4-5 triangle has angles about 36.9° and 53.1°; worth remembering.)

**Reading the exact cases.** sin⁻¹(1/2) = 30°, cos⁻¹(1/2) = 60°, tan⁻¹(1) = 45°, tan⁻¹(√3) = 60°, sin⁻¹(√2/2) = 45°.

**A caution.** sin⁻¹ x is a notation for the inverse function, not 1/sin x. And sin⁻¹ only accepts inputs between 0 and 1 (a leg over a hypotenuse); if your ratio is bigger than 1 you have the sides the wrong way round.

**Try it 1.1** A road climbs 30 m over a horizontal 500 m. Angle? *(Answer: tan⁻¹(0.06) ≈ 3.4°.)*

**Try it 1.2** Legs 5 and 12. Both acute angles? *(Answer: tan⁻¹(5/12) ≈ 22.6° and 67.4°.)*

## 2. Solving problems: a decision procedure

```
Figure description: flowchart as text.

  Is the triangle right?  -- no --> drop an altitude to make two right triangles
          | yes
  What is wanted?  side --> angle known? use sin/cos/tan with the side you have
                   angle --> two sides known? inverse of their ratio
                            one side known? use the other angle (90° − θ) or Pythagoras first
  Check: Pythagoras on the sides; acute angles sum to 90°.
```

**Worked example 5 (two triangles sharing a side).** A vertical pole stands on level ground. From a point 24 m from its base the angle of elevation of the top is 35°; a guy wire runs from the top to that point. Height = 24 tan 35° ≈ 16.8 m. Wire = 24 / cos 35° ≈ 29.3 m. A second wire from the top to a point 10 m from the base makes angle tan⁻¹(16.8/10) ≈ 59.2° with the ground.

**Worked example 6 (isosceles triangle).** An isosceles triangle has equal sides 10 and base 12. The altitude to the base makes two right triangles with hypotenuse 10 and leg 6. Height = 8. Base angles: cos⁻¹(6/10) ≈ 53.1°. Apex angle: 180° − 2(53.1°) ≈ 73.7°. Area = 48.

**Worked example 7 (navigation).** A boat sails 15 km east then 8 km north. Its distance from the start is √(15² + 8²) = 17 km, and the straight line back to the start makes an angle of tan⁻¹(8/15) ≈ 28.1° with the east–west direction.

**Worked example 8 (a diagonal in a box).** A box is 30 cm long, 20 cm wide, 15 cm high. The base diagonal is √(900 + 400) ≈ 36.06 cm; the space diagonal is √(36.06² + 15²) ≈ 39.05 cm; the angle the space diagonal makes with the base is tan⁻¹(15/36.06) ≈ 22.6°.

**Try it 2.1** Equal sides 13, base 10: base angles and apex angle? *(Answer: cos⁻¹(5/13) ≈ 67.4°; apex ≈ 45.2°.)*

**Try it 2.2** From a 50 m tower, the angles of depression of two cars on the same side, in line with the tower, are 40° and 25°. How far apart are the cars? *(Answer: 50/tan 25° − 50/tan 40° ≈ 107.2 − 59.6 ≈ 47.6 m.)*

## 3. Regular polygons from one right triangle

Join the centre of a regular n-gon to two adjacent vertices: an isosceles triangle with apex angle 360°/n. Its altitude (the apothem) splits it into two right triangles with apex angle 180°/n. One such right triangle determines everything.

**Inscribed in a circle of radius r** (vertices on the circle): the hypotenuse of the right triangle is r.
- half-side = r sin(180°/n), so side = 2r sin(180°/n) and **perimeter = 2nr sin(180°/n)**;
- apothem = r cos(180°/n);
- **area = ½ · perimeter · apothem = n r² sin(180°/n) cos(180°/n)**.

**Circumscribed about a circle of radius r** (sides tangent to the circle): the apothem is r.
- half-side = r tan(180°/n), so **perimeter = 2nr tan(180°/n)**;
- **area = ½ · perimeter · r = n r² tan(180°/n)**.

**Worked example 9.** Regular hexagon inscribed in a circle of radius 10. Apex angle 60°, half-angle 30°. Side = 2 · 10 · sin 30° = 10 (each triangle is equilateral). Perimeter 60. Apothem 10 cos 30° ≈ 8.66. Area = ½ · 60 · 8.66 ≈ 259.8.

**Worked example 10.** Regular octagon circumscribed about a circle of radius 5. Half-angle 22.5°. Half-side = 5 tan 22.5° ≈ 2.07, side ≈ 4.14, perimeter ≈ 33.1, area = ½ · 33.1 · 5 ≈ 82.8.

**Try it 3.1** Regular pentagon inscribed in a circle of radius 6: side and area? *(Answer: side 12 sin 36° ≈ 7.05; area 5 · 36 · sin 36° cos 36° ≈ 85.6.)*

## 4. Squeezing π

Take a circle of radius 1. Its circumference is 2π and its area is π. An inscribed regular n-gon has perimeter less than the circumference; a circumscribed one has perimeter more. So

  n sin(180°/n) < π < n tan(180°/n)

(both sides are half-perimeters with r = 1). The same for areas: ½ n sin(360°/n) < π < n tan(180°/n).

| n | n sin(180°/n) | n tan(180°/n) |
|---|---|---|
| 6 | 3.0000 | 3.4641 |
| 12 | 3.1058 | 3.2154 |
| 24 | 3.1326 | 3.1597 |
| 96 | 3.1410 | 3.1427 |
| 360 | 3.1416 | 3.1417 |

With 96 sides (Archimedes' count, done without a calculator) π is pinned between 3.1410 and 3.1427, which is 3 10/71 < π < 3 1/7 in his fractions. Doubling n squeezes the gap by about a factor of 4 each time.

**Why one π works for every circle.** All circles are similar (week 12), so circumference/diameter is the same ratio for all of them; the polygons just measure that one number.

**Worked example 11.** Use n = 12 and the inscribed area formula: ½ · 12 · sin 30° = 3. The circumscribed area is 12 tan 15° ≈ 3.215. So 3 < π < 3.215.

**Try it 4.1** Compute the inscribed and circumscribed half-perimeters for n = 8. *(Answer: 8 sin 22.5° ≈ 3.061; 8 tan 22.5° ≈ 3.314.)*

## Common mistakes

- **Using sin⁻¹ when the ratio involves two legs.** Two legs is tangent.
- **Entering a ratio over 1 into sin⁻¹ or cos⁻¹.** The hypotenuse must be the denominator.
- **Reading sin⁻¹ as 1/sin.** It is the inverse function.
- **Using the full central angle 360°/n in the right triangle.** The right triangle has half of it, 180°/n.
- **Mixing up inscribed (hypotenuse = r) and circumscribed (apothem = r).**
- **Forgetting the angle check.** The two acute angles must add to 90°.

## Where this goes next

The unit exam covers steepness, the special triangles, the three ratios, finding sides and angles, applications and the polygon approximation of π. Unit 5 (Solid Geometry) uses right-triangle trigonometry inside cones, pyramids and prisms, and scales areas and volumes by k² and k³.

## Self-check

1. A ladder of length 8 m has its foot 3.5 m from the wall. What angle does it make with the ground?
2. A right triangle has hypotenuse 20 and a leg 12. Find both acute angles.
3. An isosceles triangle has base 16 and height 6. Find the base angles and the equal sides.
4. Regular decagon (10 sides) inscribed in a circle of radius 4: perimeter and area?
5. For n = 48, the inscribed half-perimeter is 3.1394 and the circumscribed is 3.1461. What does this tell you about π, and what happens for n = 96?

*Answers: (1) cos⁻¹(3.5/8) ≈ 64.1°. (2) sin⁻¹(12/20) ≈ 36.9° and 53.1°. (3) tan⁻¹(6/8) ≈ 36.9°; sides 10. (4) side 8 sin 18° ≈ 2.47, perimeter ≈ 24.7; area 10 · 16 · sin 18° cos 18° ≈ 47.0. (5) 3.1394 < π < 3.1461; at n = 96 the bounds tighten to 3.1410 and 3.1427.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 4, Lessons 9–11, https://im.kendallhunt.com/HS/teachers/2/4/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Archimedes' bounds 3 10/71 < π < 3 1/7 are from his Measurement of a Circle. Accessed 2026-10-16.*
