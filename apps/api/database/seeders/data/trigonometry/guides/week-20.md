# Week 20 · The Law of Sines and the Ambiguous Case

**Topics:** 4.1 The Law of Sines · 4.2 The Ambiguous Case
**Standards:** HSG-SRT.D.10, HSG-SRT.D.11
**Spiral:** Week 3 solved right triangles with sine, cosine and tangent, and this week drops the right angle. The altitude that proves the law of sines is a week 3 right-triangle calculation. Week 5's reference angles give sin(180° − θ) = sin θ, which is the whole reason the ambiguous case exists, and week 11's range of sin⁻¹ explains why a calculator shows only one of the two possible angles.

## What you need to be able to do

- **4.1** Derive the law of sines by drawing an altitude and writing its length two ways.
- **4.1** Solve a triangle given two angles and any side (AAS or ASA), and explain why the angle sum comes first.
- **4.1** Use the fact that the longest side is opposite the largest angle to check an answer.
- **4.2** Given two sides and a non-included angle (SSA), decide whether the data give no triangle, one triangle or two, using the height h = b sin A.
- **4.2** Solve both triangles in the two-triangle case, and explain why the calculator only reports one angle.

## Key terms

| Term | Meaning |
|---|---|
| Oblique triangle | A triangle with no right angle: all three angles acute, or one obtuse. |
| Standard labelling | Angles A, B, C at the vertices; side a opposite A, b opposite B, c opposite C. |
| Law of sines | a/sin A = b/sin B = c/sin C, or equivalently sin A/a = sin B/b = sin C/c. |
| AAS / ASA | Two angles and a side not between them / two angles and the side between them. Always exactly one triangle. |
| SSA | Two sides and an angle opposite one of them. Can give zero, one or two triangles: the ambiguous case. |
| Height test | With A, a and b known, h = b sin A is the distance from C to the line along the third side. |

## Why the law of sines is true (4.1)

Take any triangle ABC and drop the altitude from C to the line through A and B. Call its length h. The altitude splits the figure into two right triangles, and in each one h is the side opposite a known angle:

- in the right triangle containing A, sin A = h/b, so h = b sin A;
- in the right triangle containing B, sin B = h/a, so h = a sin B.

Both expressions equal h, so b sin A = a sin B. Divide both sides by sin A sin B:

  a/sin A = b/sin B.

Dropping the altitude from A instead gives b/sin B = c/sin C in the same way. If angle B is obtuse, the foot of the altitude lands outside the triangle, and the right triangle at B uses the angle 180° − B; since sin(180° − B) = sin B (week 5), the equation is unchanged. So the law holds for every triangle.

Each ratio is "a side over the sine of the angle across from it". You use one pair you know completely (a side and its opposite angle) plus one more piece.

## Solving AAS and ASA triangles (4.1)

Two angles fix the third, because A + B + C = 180°. Then every side has a known opposite angle, and you need just one known side to start.

**Worked example 1 (AAS).** In triangle ABC, A = 40°, B = 65° and a = 12. Solve the triangle.

C = 180° − 40° − 65° = 75°. The known pair is a and A.

- b/sin 65° = 12/sin 40°, so b = 12 sin 65°/sin 40° ≈ 16.92.
- c/sin 75° = 12/sin 40°, so c = 12 sin 75°/sin 40° ≈ 18.03.

Check: the largest angle, C = 75°, is opposite the longest side, c ≈ 18.03, and the smallest angle, A, is opposite the shortest side, a = 12. ✓

**Worked example 2 (ASA).** A = 52°, C = 71° and the side between them is b = 20. Solve the triangle.

The known side b is not opposite a known angle yet, so find B first: B = 180° − 52° − 71° = 57°. Now the pair (b, B) is complete.

- a = 20 sin 52°/sin 57° ≈ 18.79.
- c = 20 sin 71°/sin 57° ≈ 22.55.

Keep full calculator precision until the end. Rounding B or an early side and then reusing it can move the last digit.

## The ambiguous case: SSA (4.2)

Suppose you know A, the side a opposite it, and another side b. Picture it: put angle A at the left end of a horizontal line, run side b up its slanted ray to vertex C, and then swing side a from C like a gate hinged at C. Wherever the swinging side meets the horizontal line is a possible vertex B.

The distance from C down to that line is the height h = b sin A. Compare a with h and with b.

**When A is acute:**

| Comparison | Number of triangles | Picture |
|---|---|---|
| a < h | 0 | The swinging side is too short to reach the line. |
| a = h | 1 (a right triangle) | It just touches the line at a right angle. |
| h < a < b | 2 | It meets the line at two points, on either side of the foot of the altitude. |
| a ≥ b | 1 | The second meeting point falls behind A, which is not a triangle. |

**When A is obtuse (or right):** the side across from it must be the longest side. If a ≤ b there is no triangle; if a > b there is exactly one.

The algebra tells the same story. The law of sines gives sin B = b sin A/a.

- If that value is greater than 1, there is no angle B: no triangle.
- If it is less than 1, there are two angles with that sine, B₁ = sin⁻¹(value), which is acute, and B₂ = 180° − B₁, which is obtuse. Each one is a real triangle only if it leaves room for C, that is, A + B < 180°.

The calculator's sin⁻¹ key returns only B₁, because its range is −90° to 90° (week 11). You must always ask whether B₂ also works.

**Worked example 3 (no triangle).** A = 50°, a = 6, b = 10.

h = 10 sin 50° ≈ 7.66, and a = 6 < 7.66, so no triangle. Algebraically, sin B = 10 sin 50°/6 ≈ 1.277 > 1, which is impossible.

**Worked example 4 (two triangles).** A = 35°, a = 9, b = 14. Solve every triangle.

h = 14 sin 35° ≈ 8.03. Since 8.03 < 9 < 14, expect two triangles.

sin B = 14 sin 35°/9 ≈ 0.8923.

- Triangle 1: B₁ = sin⁻¹(0.8923) ≈ 63.2°, C₁ = 180° − 35° − 63.2° ≈ 81.8°, c₁ = 9 sin C₁/sin 35° ≈ 15.53.
- Triangle 2: B₂ = 180° − 63.2° ≈ 116.8°, C₂ = 180° − 35° − 116.8° ≈ 28.2°, c₂ = 9 sin C₂/sin 35° ≈ 7.40.

Both triangles share A, a and b; they differ in where B sits on the line. Check triangle 2: the obtuse angle B₂ is opposite b = 14, the longest side. ✓

**Worked example 5 (one triangle).** A = 42°, a = 15, b = 11.

Here a ≥ b, so exactly one triangle. sin B = 11 sin 42°/15 ≈ 0.4907, B ≈ 29.4°. The supplement 150.6° would need 42° + 150.6° > 180°, so it fails. Then C ≈ 108.6° and c = 15 sin C/sin 42° ≈ 21.24.

**Worked example 6 (obtuse given angle).** A = 118°, a = 10, b = 13: since A is obtuse, a must be the longest side, but 10 < 13, so no triangle. With a = 20 instead there is one triangle, with B = sin⁻¹(13 sin 118°/20) ≈ 35.0°.

## A routine for any SSA problem

1. Compute sin B = b sin A/a. If it exceeds 1, stop: no triangle.
2. Find B₁ = sin⁻¹(…) and B₂ = 180° − B₁.
3. Keep each B with A + B < 180°.
4. For each surviving B, find C = 180° − A − B and the last side by the law of sines.
5. Check: longest side opposite largest angle in every triangle.

## Common errors

- **Trusting the calculator's single angle.** sin⁻¹ never returns an obtuse angle. In SSA, test 180° − B₁ every time.
- **Using the law of sines before the third angle in ASA.** The given side has no known opposite angle until you subtract.
- **Pairing a side with the wrong angle.** Each ratio is a side over the sine of the angle across from it, never beside it.
- **Calling SSA with a ≥ b ambiguous.** When the side opposite the given acute angle is the longer one, there is exactly one triangle.
- **Degree mode.** Every calculation in this unit is in degrees; a radian-mode calculator gives nonsense like sin 35 ≈ −0.43.
- **Trying SAS or SSS.** The law of sines needs a complete side–angle pair. Two sides and the angle between them, or three sides, need next week's law of cosines.

## Where this goes next

Week 21 adds the law of cosines for SAS and SSS triangles and finds areas with ½ab sin C and Heron's formula; the law of cosines also settles the ambiguous case without any guesswork. Week 22 puts both laws to work on bearings, distances across lakes and heights of towers you cannot reach.

## Self-check

1. Show how the altitude from C proves a/sin A = b/sin B.
2. Solve the triangle with B = 24°, C = 119° and a = 30.
3. For A = 30° and b = 20, which values of a give no triangle, one triangle and two triangles?
4. Solve every triangle with A = 32°, a = 11 and b = 17.
5. Explain why A = 105°, a = 8, b = 9 gives no triangle without doing any calculation.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSG-SRT.D.10, HSG-SRT.D.11). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
