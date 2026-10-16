# Week 15 · Steepness, Special Triangles and Ratios

**Lessons:** 4.1 Angles and Steepness · 4.2 Half a Square · 4.3 Half an Equilateral Triangle · 4.4 Ratios in Right Triangles
**Practices:** MP7 (structure), MP8 (regularity in repeated reasoning), MP6 (precision)
**Built from:** IM Geometry, Unit 4, Lessons 1–4, in our own words
**Spiral:** AA similarity (week 13) is the reason a right triangle's side ratios depend only on its acute angle. The 45-45-90 and 30-60-90 triangles were met in week 14; now their ratios become the first entries of a table. The Pythagorean theorem supplies the third side whenever two are known.

## What you need to be able to do

- Describe the steepness of a ramp, road or line as a ratio (rise over run) and connect a larger ratio to a larger angle.
- Explain why all right triangles with the same acute angle are similar, and therefore why each side ratio is a function of the angle alone.
- Derive the side ratios of a 45-45-90 triangle (half a square) and a 30-60-90 triangle (half an equilateral triangle) and use them without a calculator.
- Build and read a table of ratios (adjacent/hypotenuse, opposite/hypotenuse, opposite/adjacent) for a given angle, and use it to find a missing side.

## Key terms

| Term | Meaning |
|---|---|
| Steepness | Rise divided by run: how much height is gained per unit of horizontal distance. A 1 : 12 ramp rises 1 for every 12 across. |
| Angle of elevation | The angle a line of sight or ramp makes with the horizontal, measured upward. |
| Opposite leg | For an acute angle of a right triangle, the leg not touching that angle. |
| Adjacent leg | The leg that forms one side of the angle (the other side is the hypotenuse). |
| Hypotenuse | The side opposite the right angle; always the longest. |
| Ratio table | For each acute angle, the three numbers adjacent/hypotenuse, opposite/hypotenuse and opposite/adjacent. Next week they get the names cosine, sine and tangent. |

## 1. Steepness as a ratio

A wheelchair ramp that rises 1 m over 12 m of run has steepness 1/12 ≈ 0.083. A staircase that rises 3 m over 4 m has steepness 0.75. Steeper means a bigger ratio and a bigger angle with the ground; the two go together, but not proportionally: doubling the ratio does not double the angle.

```
Figure description: two ramps from the same base point.
Ramp A rises 1 over 12 (shallow); ramp B rises 3 over 4 (steep).

                         /|
                        / |  3
            ___________/__|       ramp B: rise 3, run 4
           /                     ramp A: rise 1, run 12
    ______/________________
          12
```

**Why the ratio is enough.** Two ramps with the same steepness make the same angle with the ground. Reason: each ramp is the hypotenuse of a right triangle with legs (run, rise); the same ratio rise/run with the right angle between them means SAS∼, so the triangles are similar and their angles agree. Conversely, two right triangles with the same acute angle are similar by AA (the acute angle plus the right angle), so every ratio of sides is the same.

**That sentence is the whole of trigonometry:** in a right triangle, each ratio of two sides depends only on the acute angle you are looking from.

**Worked example 1.** Road sign "8 % grade" means rise/run = 0.08. Over 2 km of horizontal road the climb is 160 m. A 12 % grade is steeper.

**Worked example 2.** Which is steeper, a ladder with foot 1.5 m from a wall reaching 4 m up, or one with foot 2 m from the wall reaching 5 m up? Ratios 4/1.5 ≈ 2.67 and 5/2 = 2.5: the first is steeper.

**Try it 1.1** A ramp must not be steeper than 1 : 12. Can a ramp 0.8 m high have a run of 9 m? *(Answer: 0.8/9 ≈ 0.089 > 0.083: no; it needs at least 9.6 m.)*

## 2. Half a square: the 45-45-90 triangle

Cut a square of side 1 along a diagonal. Each half is a right triangle with legs 1 and 1 and hypotenuse √2 (Pythagoras). Its acute angles are 45° each (the diagonal bisects the right angle by symmetry: the reflection across the diagonal swaps the two legs).

Any 45-45-90 triangle is similar to this one (AA), so its sides are in the ratio **1 : 1 : √2**.

| Given | Legs | Hypotenuse |
|---|---|---|
| leg = x | x | x√2 |
| hypotenuse = h | h/√2 = h√2/2 | h |

From the angle's point of view: opposite/hypotenuse = 1/√2 ≈ 0.707, adjacent/hypotenuse = 1/√2 ≈ 0.707, opposite/adjacent = 1.

**Worked example 3.** A square has side 6: diagonal 6√2 ≈ 8.49. A square has diagonal 9: side 9/√2 ≈ 6.36.

**Worked example 4.** An isosceles right triangle has hypotenuse 20. Legs 20/√2 = 10√2 ≈ 14.14; area ½ · (10√2)² = 100.

**Try it 2.1** A 45-45-90 triangle has leg 7. Hypotenuse? Perimeter? *(Answer: 7√2 ≈ 9.90; 14 + 7√2 ≈ 23.90.)*

## 3. Half an equilateral triangle: the 30-60-90 triangle

Cut an equilateral triangle of side 2 along an altitude. Each half has hypotenuse 2 (a side of the original), short leg 1 (half the base) and long leg √(4 − 1) = √3. Its angles are 30° (half of 60°, at the apex), 60° (an untouched base angle) and 90°.

Any 30-60-90 triangle is similar to this one, so its sides are in the ratio **1 : √3 : 2** (short leg : long leg : hypotenuse). The short leg is opposite the 30° angle, the long leg opposite the 60° angle.

| Given | Short leg | Long leg | Hypotenuse |
|---|---|---|---|
| short leg = x | x | x√3 | 2x |
| long leg = y | y/√3 | y | 2y/√3 |
| hypotenuse = h | h/2 | h√3/2 | h |

From the 30° angle: opposite/hypotenuse = 1/2, adjacent/hypotenuse = √3/2 ≈ 0.866, opposite/adjacent = 1/√3 ≈ 0.577.
From the 60° angle: opposite/hypotenuse = √3/2, adjacent/hypotenuse = 1/2, opposite/adjacent = √3 ≈ 1.732.

**Worked example 5.** A 30-60-90 triangle has hypotenuse 14: short leg 7, long leg 7√3 ≈ 12.12.

**Worked example 6.** Long leg 10: short leg 10/√3 ≈ 5.77, hypotenuse ≈ 11.55. Check: 5.77² + 10² ≈ 33.3 + 100 = 133.3 ≈ 11.55² ✓.

**Worked example 7.** An equilateral triangle has side 8. Height 4√3 ≈ 6.93; area (√3/4) · 64 = 16√3 ≈ 27.71.

**Worked example 8 (a 30° ramp).** A ramp rises at 30° and reaches a platform 1.2 m high. Its length (hypotenuse) is 2.4 m and its run is 1.2√3 ≈ 2.08 m. Steepness = 1.2/2.08 ≈ 0.577 = 1/√3.

**Try it 3.1** 30-60-90 with short leg 5: other sides? *(Answer: 5√3 ≈ 8.66 and 10.)*

**Try it 3.2** A 60° ramp 3 m long: how high does it reach? *(Answer: 3 · √3/2 ≈ 2.60 m.)*

## 4. Ratios in right triangles: the table

For an acute angle θ in a right triangle, define three ratios:

- **adjacent / hypotenuse**
- **opposite / hypotenuse**
- **opposite / adjacent** (this is the steepness when the adjacent leg is horizontal)

They depend only on θ. The special triangles give exact entries, and measuring carefully drawn triangles (or a calculator next week) fills in the rest.

| θ | adjacent/hypotenuse | opposite/hypotenuse | opposite/adjacent |
|---|---|---|---|
| 30° | √3/2 ≈ 0.866 | 1/2 = 0.5 | 1/√3 ≈ 0.577 |
| 45° | √2/2 ≈ 0.707 | √2/2 ≈ 0.707 | 1 |
| 60° | 1/2 = 0.5 | √3/2 ≈ 0.866 | √3 ≈ 1.732 |
| 20° | 0.940 | 0.342 | 0.364 |
| 40° | 0.766 | 0.643 | 0.839 |
| 70° | 0.342 | 0.940 | 2.747 |

Patterns to notice: as θ grows, opposite/hypotenuse grows from 0 toward 1 and adjacent/hypotenuse shrinks from 1 toward 0; opposite/adjacent grows without bound; the 20° and 70° rows are each other's swap, because the adjacent leg for one acute angle is the opposite leg for the other.

**Using the table to find a side.** Identify which two of opposite, adjacent and hypotenuse are involved (one known, one wanted); pick the ratio that uses them; set up ratio = table value; solve.

**Worked example 9.** Right triangle, angle 40°, hypotenuse 25. Opposite leg: opposite/hypotenuse = 0.643, so opposite = 25 × 0.643 ≈ 16.1. Adjacent leg: 25 × 0.766 ≈ 19.2. Check: 16.1² + 19.2² ≈ 259 + 369 = 628 ≈ 625 ✓ (rounding).

**Worked example 10.** Angle 70°, adjacent leg 3. Opposite = 3 × 2.747 ≈ 8.24. Hypotenuse = 3 / 0.342 ≈ 8.77.

**Worked example 11 (the table's symmetry).** A right triangle has acute angles 20° and 70°. The leg opposite 20° is the leg adjacent to 70°. So opposite/hypotenuse for 20° equals adjacent/hypotenuse for 70°: both 0.342.

**Try it 4.1** Angle 20°, hypotenuse 50. Both legs? *(Answer: opposite ≈ 17.1, adjacent ≈ 47.0.)*

**Try it 4.2** Angle 45°, opposite leg 9. Hypotenuse? *(Answer: 9/0.707 ≈ 12.7, exactly 9√2.)*

## Common mistakes

- **Calling the wrong leg "opposite".** Stand at the angle: the leg you are touching is adjacent, the one across the triangle is opposite. The hypotenuse is never a leg.
- **Putting √3 on the short leg.** The long leg is opposite 60° and carries √3.
- **Treating steepness as an angle.** A ratio of 0.5 is not 50°; it is about 26.6°.
- **Dividing when you should multiply.** opposite = hypotenuse × (opposite/hypotenuse); hypotenuse = opposite ÷ (opposite/hypotenuse).
- **Using a table value for the wrong angle.** The row is the angle you are standing at, not the other acute angle.

## Where this goes next

Week 16 names the three ratios cosine, sine and tangent, puts them on the calculator, and solves right triangles in applied settings; it also proves sin θ = cos(90° − θ) and the identity behind the 20°/70° swap. Week 17 goes backwards from a ratio to an angle with the inverse functions, solves multi-step problems, and uses regular polygons to approximate π.

## Self-check

1. Which is steeper: rise 5 over run 8, or rise 7 over run 12?
2. A 45-45-90 triangle has hypotenuse 11. Find the legs and the area.
3. A 30-60-90 triangle has long leg 9√3. Find the short leg and hypotenuse.
4. Using the table, find the opposite leg when the angle is 70° and the hypotenuse is 12.
5. Explain in one sentence why opposite/hypotenuse for 40° equals adjacent/hypotenuse for 50°.

*Answers: (1) 5/8 = 0.625 > 7/12 ≈ 0.583, the first. (2) legs 11/√2 ≈ 7.78; area ½ · 121/2 = 30.25. (3) short leg 9, hypotenuse 18. (4) 12 × 0.940 ≈ 11.3. (5) In a right triangle with acute angles 40° and 50°, the leg opposite 40° is the leg adjacent to 50°, and the hypotenuse is shared.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 4, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/2/4/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
