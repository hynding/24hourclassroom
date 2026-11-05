# Week 3 · Solving Right Triangles and Applications

**Topics:** 1.5 Solving Right Triangles · 1.6 Angles of Elevation and Depression and Bearings
**Standards:** HSG-SRT.C.8, with HSG-SRT.C.6 and HSG-SRT.C.7
**Spiral:** Week 2 defined the six ratios and their exact values; this week uses them with a calculator to find unknown sides and angles. Week 1's DMS notation appears in surveying answers, its complementary-angle fact gives the second acute angle for free, and week 2's cofunctions explain why "the angle from north" and "the angle from east" in a bearing problem are complements.

## What you need to be able to do

- **1.5** Solve a right triangle (find every missing side and angle) given one side and one acute angle, or given two sides.
- **1.5** Choose the ratio that links the known and unknown parts, and set up the equation before reaching for the calculator.
- **1.5** Use sin⁻¹, cos⁻¹ and tan⁻¹ on a calculator to find an acute angle from a ratio, reading sin⁻¹(0.6) as "the angle whose sine is 0.6".
- **1.6** Draw and solve problems with angles of elevation and depression, including problems with two right triangles.
- **1.6** Read and write bearings in both forms, quadrant bearings such as N 35° E and three-digit azimuths such as 035°, and use them to find distances and directions.

## Key terms

| Term | Meaning |
|---|---|
| Solve a triangle | Find all three sides and all three angles. |
| Inverse ratio, sin⁻¹ x | The acute angle whose sine is x (for 0 < x < 1); similarly cos⁻¹ and tan⁻¹. A fuller treatment comes in Unit 2. |
| Line of sight | The straight line from the observer's eye to the object. |
| Angle of elevation | The angle from the horizontal **up** to the line of sight. |
| Angle of depression | The angle from the horizontal **down** to the line of sight. |
| Quadrant bearing | N or S, then an acute angle, then E or W: N 35° E is 35° east of north. |
| Azimuth (three-digit bearing) | Angle measured clockwise from north, written with three digits: 035°, 122°, 270°. |

## Solving a right triangle (1.5)

Use the convention: right angle at C, sides a, b, c opposite angles A, B, C, so c is the hypotenuse. Every problem follows the same routine.

1. Sketch and label the triangle; mark what is known.
2. For a side: pick the ratio that contains the unknown side and a known side for a known angle. Write it as an equation and solve.
3. For an angle: form a ratio of two known sides and apply the matching inverse key.
4. Use A + B = 90° for the other angle, and the Pythagorean theorem as a check (not as the main method, so one rounding error does not spread).

Set the calculator to **degree mode** this unit. Keep full calculator values in the middle of a problem and round only at the end.

**Worked example 1 (one side and one angle).** In right triangle ABC, A = 34° and c = 20. Solve the triangle to the nearest hundredth.

B = 90° − 34° = 56°. Side a is opposite A: sin 34° = a/20, so a = 20 sin 34° ≈ 11.18. Side b is adjacent to A: cos 34° = b/20, so b = 20 cos 34° ≈ 16.58. Check: 11.18² + 16.58² ≈ 400.

**Worked example 2 (two sides).** In right triangle ABC, a = 7 and b = 11. Solve the triangle.

c = √(49 + 121) = √170 ≈ 13.04. For A, the known sides are opposite and adjacent, so use tangent: tan A = 7/11 and A = tan⁻¹(7/11) ≈ 32.47°. Then B ≈ 57.53°.

The notation tan⁻¹(7/11) means "the angle whose tangent is 7/11". It is not 1/tan, which is cot. In Unit 2 these inverse functions get a careful definition with domains and ranges; here every angle is acute, so the calculator's answer is the one we want.

**When to divide.** If the unknown is in the denominator, the algebra changes. With A = 28° and a = 9, the hypotenuse satisfies sin 28° = 9/c, so c = 9/sin 28° ≈ 19.17, not 9 sin 28°. A quick sense check catches the slip: the hypotenuse must be longer than either leg.

## Angles of elevation and depression (1.6)

Both angles are measured from a **horizontal** line through the observer's eye, never from the vertical. Looking up gives an angle of elevation; looking down gives an angle of depression. When an observer at the top of a cliff looks down at a boat with angle of depression θ, the boat looks up at the observer with angle of elevation θ: the horizontal through the eye and the level water are parallel, so these are alternate interior angles.

**Worked example 3 (elevation, with eye height).** A hypothetical surveyor's instrument is 1.6 m above level ground and 50 m from the base of a building. The angle of elevation to the roof edge is 38°. How tall is the building?

From the instrument, the horizontal distance is adjacent and the height above the instrument is opposite: tan 38° = h/50, so h = 50 tan 38° ≈ 39.06 m. Add the instrument height: the building is about 40.66 m tall.

**Worked example 4 (depression).** From the top of a 32 m lighthouse, the angle of depression to a boat is 9°. How far is the boat from the base of the lighthouse?

The angle of elevation from the boat is also 9°, so tan 9° = 32/x and x = 32/tan 9° ≈ 202.04 m. A small angle of depression means a long, flat triangle, so a large distance is reasonable.

**Worked example 5 (two triangles: moving closer).** From point P the angle of elevation to the top of a hypothetical radio mast is 25°. After walking 40 m straight towards the mast, the angle is 35°. Find the height of the mast.

Let h be the height and d the distance from the second point to the base. Two right triangles share h:

- h = d tan 35°
- h = (d + 40) tan 25°

Set them equal: d tan 35° = d tan 25° + 40 tan 25°, so d = 40 tan 25°/(tan 35° − tan 25°) ≈ 79.74 m and h = d tan 35° ≈ 55.84 m.

## Bearings (1.6)

Navigators measure directions from north. Two notations are common:

- **Quadrant bearing**: start facing N or S, turn the given acute angle towards E or W. N 35° E, S 58° E, S 40° W, N 72° W.
- **Azimuth**: one angle from 0° to 360° measured **clockwise** from north, written with three digits. N 35° E is 035°; S 58° E is 180° − 58° = 122°; S 40° W is 180° + 40° = 220°; N 72° W is 360° − 72° = 288°.

Due east is 090° (or simply E); due south is 180°. A bearing of 035° is **not** a standard-position angle of 35°: standard position starts at east and turns counterclockwise. The angle from north and the angle from the east axis are complements (35° and 55°), which is why a northward distance uses cosine of the bearing angle and an eastward distance uses sine.

**Worked example 6 (bearing to components and back).** A hypothetical ship sails 12 km on a bearing of 035°. How far north and how far east of its start is it? A second ship sails 8 km due east and then 5 km due south. Find its distance and bearing from its start.

First ship: the 12 km course is the hypotenuse and the angle at the start, between north and the course, is 35°. North: 12 cos 35° ≈ 9.83 km. East: 12 sin 35° ≈ 6.88 km.

Second ship: distance √(64 + 25) = √89 ≈ 9.43 km. The final position is south and east of the start. Measure from south towards east: tan θ = 8/5, so θ = tan⁻¹(1.6) ≈ 57.99°. The bearing is S 58.0° E, or azimuth 180° − 57.99° ≈ 122.0°.

**Try it.**
1. In right triangle ABC, B = 52° and a = 15. Find b to the nearest hundredth.
2. Find the acute angle A, to the nearest tenth of a degree, if sin A = 4/9.
3. Write S 40° W and N 15° W as azimuths.

*Answers:* 1. Side a is adjacent to B and b is opposite it, so b = 15 tan 52° ≈ 19.20. 2. sin⁻¹(4/9) ≈ 26.4°. 3. 220° and 345°.

## Common errors

- **Calculator in radian mode.** sin 34 in radian mode is about 0.53, not 0.56. Check with sin 30 = 0.5.
- **Multiplying when you should divide.** If the unknown is the denominator of the ratio, divide: c = 9/sin 28°.
- **Measuring elevation or depression from the vertical.** Both start at the horizontal.
- **Forgetting the observer's height** when the angle is measured from eye or instrument level.
- **Treating a bearing as a standard-position angle.** 035° is measured clockwise from north, not counterclockwise from east.
- **Rounding early** in a two-triangle problem; keep full values until the final answer.

## Where this goes next

Week 4 moves to radian measure, where an angle is a ratio of arc length to radius, and connects turning to speed. Week 5 extends the ratios to every angle, so a calculator's sin⁻¹ will soon need a quadrant check. In Unit 4 the laws of sines and cosines solve triangles with no right angle, and bearings return for multi-leg navigation and vectors.

## Self-check

1. In right triangle ABC, B = 41° and b = 10. Find a and c to the nearest hundredth.
2. A 6 m ladder reaches 5.5 m up a wall. Find the angle it makes with the ground to the nearest tenth of a degree.
3. From a balcony 18 m up, the angle of depression to a parked car is 27°. How far is the car from the foot of the building?
4. Two sightings of a cliff top, 60 m apart on a straight line towards it, have elevations 20° and 32°. Find the height of the cliff.
5. A hiker walks 3 km on a bearing of 300°. Write this as a quadrant bearing, and find how far north and how far west she is from her start.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSG-SRT.C.6, HSG-SRT.C.7, HSG-SRT.C.8); its approach follows the trigonometry lessons of IM 9–12 Math by Illustrative Mathematics (© 2019, CC BY 4.0). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
