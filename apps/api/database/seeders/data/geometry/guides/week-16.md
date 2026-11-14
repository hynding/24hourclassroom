# Week 16 · Sine, Cosine and Tangent

**Lessons:** 4.5 Working with Ratios in Right Triangles · 4.6 Working with Trigonometric Ratios · 4.7 Applying Ratios in Right Triangles · 4.8 Sine and Cosine in the Same Right Triangle
**Practices:** MP2 (reason abstractly and quantitatively), MP4 (model), MP6 (precision)
**Built from:** IM Geometry, Unit 4, Lessons 5–8, in our own words
**Spiral:** the three columns of last week's ratio table get names; the angle sum (week 6) explains the sine–cosine swap for complementary angles; the Pythagorean theorem (week 14) checks every solved triangle; shadows and elevation problems are the indirect-measurement setups of week 13 with angles instead of a second triangle.

## What you need to be able to do

- Define cos θ, sin θ and tan θ as side ratios and read them from any right triangle given two sides.
- Use a calculator in degree mode to find a trigonometric ratio and to find a missing side from an angle and one side.
- Decide which ratio to use from "which sides are involved", set up the equation and solve, multiplying or dividing correctly.
- Solve applied problems with angles of elevation and depression, ladders, ramps and lines of sight.
- Explain and use sin θ = cos(90° − θ), cos θ = sin(90° − θ), tan θ = sin θ / cos θ and sin² θ + cos² θ = 1.

## Key terms

| Term | Meaning |
|---|---|
| cosine, cos θ | adjacent / hypotenuse |
| sine, sin θ | opposite / hypotenuse |
| tangent, tan θ | opposite / adjacent |
| Angle of elevation | The angle above the horizontal from an observer up to an object. |
| Angle of depression | The angle below the horizontal from an observer down to an object; equal to the angle of elevation from the object back up (alternate interior angles). |
| Complementary angles | Two angles that add to 90°; the two acute angles of a right triangle. |
| Solve a right triangle | Find all three sides and both acute angles. |

## 1. Naming the ratios

For an acute angle θ in a right triangle:

```
Figure description: right triangle with the right angle at the bottom right.
The angle θ is at the bottom left. The hypotenuse slopes up from θ.

                     /|
          hyp      /  |
                 /    |  opposite (to θ)
               /θ_____|
              adjacent (to θ)

    cos θ = adjacent / hypotenuse
    sin θ = opposite / hypotenuse
    tan θ = opposite / adjacent
```

A memory aid: **SOH-CAH-TOA** (Sine = Opposite/Hypotenuse, Cosine = Adjacent/Hypotenuse, Tangent = Opposite/Adjacent). The names are new; the numbers are last week's table.

| θ | cos θ | sin θ | tan θ |
|---|---|---|---|
| 30° | √3/2 ≈ 0.866 | 1/2 | 1/√3 ≈ 0.577 |
| 45° | √2/2 ≈ 0.707 | √2/2 ≈ 0.707 | 1 |
| 60° | 1/2 | √3/2 ≈ 0.866 | √3 ≈ 1.732 |

**Reading ratios from a triangle.** Right triangle with legs 5 and 12, hypotenuse 13. Let θ be the angle opposite the leg 5. Then sin θ = 5/13, cos θ = 12/13, tan θ = 5/12. For the other acute angle φ: sin φ = 12/13, cos φ = 5/13, tan φ = 12/5.

**Worked example 1.** Right triangle with hypotenuse 10 and one leg 6. The other leg is 8. For the angle between the leg 6 and the hypotenuse: cos = 6/10 = 0.6, sin = 8/10 = 0.8, tan = 8/6 ≈ 1.33.

**Try it 1.1** Legs 7 and 24, hypotenuse 25. Find the three ratios for the angle opposite 24. *(Answer: sin = 24/25 = 0.96, cos = 7/25 = 0.28, tan = 24/7 ≈ 3.43.)*

## 2. The calculator and finding sides

Put the calculator in **degree** mode. Then cos 40° ≈ 0.766, sin 40° ≈ 0.643, tan 40° ≈ 0.839.

**Finding a side, three steps.**
1. Mark the angle you know. Label the known side and the wanted side as opposite, adjacent or hypotenuse (relative to that angle).
2. Pick the ratio that uses those two sides.
3. Write ratio = calculator value and solve.

| Wanted / Known | Equation | Solve by |
|---|---|---|
| opposite from hypotenuse | sin θ = x/h | x = h sin θ |
| adjacent from hypotenuse | cos θ = x/h | x = h cos θ |
| opposite from adjacent | tan θ = x/a | x = a tan θ |
| hypotenuse from opposite | sin θ = o/x | x = o / sin θ |
| hypotenuse from adjacent | cos θ = a/x | x = a / cos θ |
| adjacent from opposite | tan θ = o/x | x = o / tan θ |

Multiply when the wanted side is on top of the ratio; divide when it is underneath.

**Worked example 2.** Angle 32°, hypotenuse 18. Opposite = 18 sin 32° ≈ 18 × 0.530 ≈ 9.54. Adjacent = 18 cos 32° ≈ 18 × 0.848 ≈ 15.26. Check: 9.54² + 15.26² ≈ 91.0 + 232.9 = 323.9 ≈ 18² = 324 ✓.

**Worked example 3.** Angle 55°, opposite leg 14. Hypotenuse = 14 / sin 55° ≈ 14 / 0.819 ≈ 17.09. Adjacent = 14 / tan 55° ≈ 14 / 1.428 ≈ 9.80.

**Worked example 4.** Angle 25°, adjacent leg 40. Opposite = 40 tan 25° ≈ 40 × 0.466 ≈ 18.65. Hypotenuse = 40 / cos 25° ≈ 40 / 0.906 ≈ 44.13.

**Worked example 5 (solving the whole triangle).** Angle 65°, hypotenuse 9. Other angle 25°. Opposite 65°: 9 sin 65° ≈ 8.16. Adjacent: 9 cos 65° ≈ 3.80. All six measurements known.

**Try it 2.1** Angle 70°, adjacent leg 6. Find the opposite leg and hypotenuse. *(Answer: 6 tan 70° ≈ 16.48; 6 / cos 70° ≈ 17.54.)*

**Try it 2.2** Angle 15°, hypotenuse 100. Both legs? *(Answer: 100 sin 15° ≈ 25.9; 100 cos 15° ≈ 96.6.)*

## 3. Applications

**Angle of elevation.** From a point 50 m from the base of a tower, the top is seen at 28° above the horizontal. Height = 50 tan 28° ≈ 50 × 0.532 ≈ 26.6 m (plus the observer's eye height if the 50 m is measured at eye level).

**Angle of depression.** From a cliff 80 m high, a boat is seen at 10° below the horizontal. The angle of elevation from the boat to the cliff top is also 10° (alternate interior angles with the horizontal lines). Distance from the cliff base: 80 / tan 10° ≈ 80 / 0.176 ≈ 454 m.

**Ladder.** A 6 m ladder leans at 72° to the ground. Height reached: 6 sin 72° ≈ 5.71 m. Foot distance from the wall: 6 cos 72° ≈ 1.85 m.

**Ramp.** A ramp of steepness 1 : 12 makes angle θ with tan θ = 1/12; its length for a 0.6 m rise is 0.6 / sin θ. (Finding θ itself needs next week's inverse tangent; for now use the ratio: run = 7.2 m, length = √(0.6² + 7.2²) ≈ 7.22 m.)

**Guy wire.** A wire from the top of a 20 m mast to the ground makes 50° with the ground. Length = 20 / sin 50° ≈ 26.1 m; anchor distance = 20 / tan 50° ≈ 16.8 m.

**Worked example 6 (two angles, one height).** From a point A on level ground the top of a building is at 35°; from a point B 30 m closer it is at 55°. Let h be the height and x the distance from B. Then h = x tan 55° and h = (x + 30) tan 35°. So x · 1.428 = (x + 30) · 0.700, giving 0.728x = 21.0, x ≈ 28.8 m and h ≈ 41.2 m.

**Try it 3.1** A kite string 90 m long makes 40° with the ground. How high is the kite? *(Answer: 90 sin 40° ≈ 57.9 m.)*

**Try it 3.2** From the top of a 45 m lighthouse, a ship is seen at an angle of depression of 20°. How far is the ship from the base? *(Answer: 45 / tan 20° ≈ 123.6 m.)*

## 4. Sine and cosine in the same triangle

The two acute angles of a right triangle are complementary: θ and 90° − θ. The leg opposite θ is adjacent to 90° − θ, and the hypotenuse is shared, so

- **sin θ = cos(90° − θ)** and **cos θ = sin(90° − θ)**.

That is the whole reason "cosine" has its name: it is the sine of the complement. sin 20° = cos 70°, cos 32° = sin 58°.

Three more facts, each read off the same triangle with legs o, a and hypotenuse h:

- **tan θ = sin θ / cos θ**, because (o/h) / (a/h) = o/a.
- **sin² θ + cos² θ = 1**, because (o/h)² + (a/h)² = (o² + a²)/h² = h²/h² = 1 (Pythagoras).
- **0 < sin θ < 1 and 0 < cos θ < 1** for an acute θ, because a leg is shorter than the hypotenuse; tan θ can be any positive number.

**Worked example 7.** If sin θ = 0.6, then cos θ = √(1 − 0.36) = 0.8 and tan θ = 0.75, without knowing θ. (It is about 36.9°.)

**Worked example 8.** Which is larger, cos 40° or cos 50°? cos 40° ≈ 0.766, cos 50° ≈ 0.643: cosine decreases as the angle grows. And sin 40° = cos 50°, sin 50° = cos 40°.

**Worked example 9.** For which acute angle φ is cos φ = sin 23°? The pattern sin θ = cos φ holds exactly when θ + φ = 90°, so φ = 67°. Check on a calculator: both are about 0.391.

**Try it 4.1** cos θ = 0.28. Find sin θ and tan θ. *(Answer: sin θ = √(1 − 0.0784) = 0.96; tan θ ≈ 3.43.)*

**Try it 4.2** Write sin 73° as a cosine. *(Answer: cos 17°.)*

## Common mistakes

- **Radian mode.** If sin 30° shows −0.988, the calculator is in radians.
- **Choosing the ratio by habit** instead of by the two sides involved.
- **Dividing when you should multiply.** Hypotenuse from a leg: divide. Leg from hypotenuse: multiply.
- **Mixing the angle of depression with the angle at the base.** The depression angle is measured from the horizontal at the top; it equals the elevation angle at the bottom, not the angle between the line of sight and the vertical.
- **Rounding too early.** Keep four decimals in the ratio; round the final answer.

## Where this goes next

Week 17 reverses the process: from a ratio to the angle with arcsin, arccos and arctan, so a ramp's angle, a ladder's safe angle and a hill's grade can be found. It also uses sine and cosine on regular polygons inscribed in a circle to approximate π. Unit 5 then uses trigonometry inside solids.

## Self-check

1. Legs 9 and 40, hypotenuse 41. Give sin, cos and tan of the angle opposite 9.
2. Angle 35°, hypotenuse 22. Find both legs to one decimal place.
3. Angle 60°, opposite leg 15. Find the hypotenuse exactly.
4. From 120 m away, a building's top is at 28° elevation. Height?
5. If cos θ = 0.8, find sin θ and write cos θ as a sine.

*Answers: (1) 9/41 ≈ 0.220, 40/41 ≈ 0.976, 9/40 = 0.225. (2) 22 sin 35° ≈ 12.6; 22 cos 35° ≈ 18.0. (3) 15 / (√3/2) = 30/√3 = 10√3 ≈ 17.3. (4) 120 tan 28° ≈ 63.8 m. (5) sin θ = 0.6; cos θ = sin(90° − θ).*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 4, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/2/4/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
