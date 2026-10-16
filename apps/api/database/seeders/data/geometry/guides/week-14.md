# Week 14 · Pythagoras, Unknown Values and the Bank Shot

**Lessons:** 3.13 Using the Pythagorean Theorem and Similarity · 3.14 Proving the Pythagorean Theorem · 3.15 Finding All the Unknown Values in Triangles · 3.16 Bank Shot
**Practices:** MP1 (persevere), MP3 (construct arguments), MP4 (model)
**Built from:** IM Geometry, Unit 3, Lessons 13–16, in our own words
**Spiral:** the AA criterion (week 13) applied to the altitude-on-hypotenuse figure proves the Pythagorean theorem; reflections (week 2) explain why a ball "banks" off a wall at equal angles; the side-splitter proportions (weeks 12–13) solve the unknown-values problems.

## What you need to be able to do

- Use the Pythagorean theorem together with similarity to find lengths in figures with nested right triangles.
- Prove the Pythagorean theorem with the altitude to the hypotenuse and similar triangles (the "three similar triangles" proof), and know one other proof (rearrangement).
- Use the geometric-mean relations in a right triangle: h² = pq, a² = pc, b² = qc.
- Find every unknown length and angle in a triangle from a few given ones, using the angle sum, the Pythagorean theorem, similar triangles and the special right triangles 45-45-90 and 30-60-90.
- Model a bank shot: reflect the target across the cushion, draw the straight line, and use similar triangles to find the bounce point.

## Key terms

| Term | Meaning |
|---|---|
| Pythagorean theorem | In a right triangle with legs a, b and hypotenuse c, a² + b² = c². |
| Converse | If a² + b² = c² for the sides of a triangle, the angle opposite c is right. |
| Altitude to the hypotenuse | The perpendicular from the right-angle vertex to the hypotenuse; foot H splits the hypotenuse into pieces p and q. |
| Geometric mean | x is the geometric mean of p and q when x² = pq. |
| 45-45-90 triangle | Legs equal; hypotenuse = leg × √2. |
| 30-60-90 triangle | Hypotenuse = 2 × short leg; long leg = short leg × √3. |
| Bank shot | A path that bounces off a wall with angle of incidence equal to angle of reflection. |

## 1. Three similar triangles in one right triangle

Let △ABC have a right angle at C and let the altitude from C meet AB at H. Write AH = p, HB = q, AB = c = p + q, BC = a, AC = b, CH = h.

```
Figure description: hypotenuse AB horizontal, C above it, altitude CH perpendicular to AB.
Pieces: AH = p (left), HB = q (right). Legs: AC = b (left), BC = a (right).

            C
           /|\
        b / | \ a
         /  |h \
        A---H---B
          p   q
```

△ACH ∼ △ABC: both have a right angle (at H and at C) and share ∠A. So AC/AB = AH/AC, i.e. **b² = pc**.
△CBH ∼ △ABC: right angles and shared ∠B. So BC/AB = BH/BC, i.e. **a² = qc**.
△ACH ∼ △CBH (both similar to △ABC): AH/CH = CH/BH, i.e. **h² = pq**.

Each leg is the geometric mean of the hypotenuse and the piece next to it; the altitude is the geometric mean of the two pieces.

**Worked example 1.** p = 4, q = 9. Then h² = 36, h = 6; c = 13; b² = 4 × 13 = 52, b = 2√13 ≈ 7.21; a² = 9 × 13 = 117, a = 3√13 ≈ 10.82. Check: a² + b² = 117 + 52 = 169 = 13² ✓.

**Worked example 2.** A right triangle has legs 6 and 8, hypotenuse 10. The altitude to the hypotenuse: area two ways, ½ · 6 · 8 = ½ · 10 · h, so h = 4.8. The pieces: p = b²/c = 36/10 = 3.6 (next to the leg 6) and q = 64/10 = 6.4. Check h² = 3.6 × 6.4 = 23.04 = 4.8² ✓.

**Try it 1.1** p = 2, q = 8. Find h and both legs. *(Answer: h = 4; legs √20 = 2√5 and √80 = 4√5.)*

## 2. Proving the Pythagorean theorem

**Proof by similar triangles.** From section 1, a² = qc and b² = pc. Add: a² + b² = qc + pc = (p + q)c = c · c = c². ∎

That is the whole proof: the two leg relations come from AA, and p + q = c because H lies on the hypotenuse.

**Proof by rearrangement (for comparison).** Four copies of the right triangle placed inside a square of side a + b leave a tilted square of side c in the middle: (a + b)² = 4 · ½ab + c², so a² + 2ab + b² = 2ab + c², hence a² + b² = c². The tilted shape is a square because its angles are 180° minus the two acute angles, which add to 90°.

**Converse.** If a² + b² = c², build a right triangle with legs a and b; its hypotenuse is √(a² + b²) = c; SSS makes it congruent to the original, so the original's angle opposite c is right.

**Worked example 3.** Is a triangle with sides 7, 24, 25 right? 49 + 576 = 625 = 25² ✓. Sides 8, 9, 12? 64 + 81 = 145 ≠ 144: not right (145 > 144 means the angle opposite 12 is slightly less than 90°).

**Try it 2.1** In the similar-triangles proof, which similarity gives b² = pc? *(Answer: △ACH ∼ △ABC, from AC/AB = AH/AC.)*

## 3. Finding all the unknown values

A triangle has six measurements: three sides, three angles. Strategy:

1. **Angles:** if two are known, the third is 180° minus their sum.
2. **Right triangles:** two sides give the third by Pythagoras.
3. **Special right triangles:** one side gives all.
   - 45-45-90 (an isosceles right triangle, half a square): legs x, hypotenuse x√2.
   - 30-60-90 (half an equilateral triangle): short leg x (opposite 30°), long leg x√3, hypotenuse 2x.
4. **Non-right triangles with an altitude:** drop a perpendicular to create two right triangles; share the altitude.
5. **Similar triangles:** if the triangle is similar to one you know, scale.

**Worked example 4.** Right triangle, hypotenuse 10, one angle 30°. Short leg (opposite 30°) = 5, long leg = 5√3 ≈ 8.66, other angle 60°. All six known.

**Worked example 5.** Isosceles triangle with equal sides 13 and base 10. The altitude to the base bisects it (5 and 5) and is √(169 − 25) = 12. Area = ½ · 10 · 12 = 60. The base angles: not a special triangle, so the angle needs trigonometry (Unit 4). Everything else is known.

**Worked example 6.** A triangle has sides 8 and 15 with a right angle between them: hypotenuse 17. Its altitude to the hypotenuse: 8 · 15 / 17 = 120/17 ≈ 7.06. Pieces: 64/17 ≈ 3.76 and 225/17 ≈ 13.24.

**Worked example 7 (an equilateral triangle).** Side 12. Height = 6√3 ≈ 10.39 (a 30-60-90 half). Area = ½ · 12 · 6√3 = 36√3 ≈ 62.35. Every angle 60°.

**Worked example 8 (a square's diagonal).** Side 9: diagonal 9√2 ≈ 12.73. Conversely, diagonal 10 means side 10/√2 = 5√2 ≈ 7.07.

**Try it 3.1** Right triangle with legs 9 and 40: hypotenuse? *(Answer: 41.)*

**Try it 3.2** 30-60-90 triangle with long leg 12: short leg and hypotenuse? *(Answer: 12/√3 = 4√3 ≈ 6.93; hypotenuse 8√3 ≈ 13.86.)*

**Try it 3.3** 45-45-90 triangle with hypotenuse 14: legs? *(Answer: 7√2 ≈ 9.90.)*

## 4. The bank shot

A ball at point P must bounce off a straight cushion (line m) and reach point Q on the same side. The bounce obeys "angle of incidence = angle of reflection": the incoming and outgoing paths make equal angles with the cushion.

**Method.** Reflect Q across m to Q′. The straight line from P to Q′ crosses m at the bounce point B. Then BQ = BQ′ (reflection preserves distance) and the two angles at B are equal (the reflection swaps them), so the path P → B → Q is a legal bank shot, and it is the shortest such path (a straight line is shortest from P to Q′).

**Computing B with similar triangles.** Put the cushion on the x-axis, P = (0, 3) and Q = (8, 5). Then Q′ = (8, −5). Drop perpendiculars from P and Q′ to the axis: △P-foot-B and △Q′-foot-B are similar (right angles, vertical angles at B), so distance-from-P-foot : distance-from-Q′-foot = 3 : 5. The feet are 8 apart, so B is 8 × 3/(3 + 5) = 3 units from P's foot: B = (3, 0). Check the angles: from P the path drops 3 over 3 (45°); from B to Q it rises 5 over 5 (45°) ✓.

**General rule.** With P at height a, Q at height b and horizontal separation d, the bounce point is d · a/(a + b) from P's foot. (Same formula as the shadow problem: the heights are the "objects" and the distances are their "shadows".)

**Worked example 9.** P = (1, 2), Q = (13, 4), cushion y = 0. B is 12 × 2/6 = 4 from x = 1: B = (5, 0). Path length = PQ′ = √(12² + 6²) = √180 ≈ 13.42.

**Worked example 10 (two cushions).** Reflect Q across the second cushion, then that image across the first (or reflect P and Q once each across their own cushions); draw the line; read both bounce points. Two reflections, two bounces.

**Try it 4.1** P = (0, 4), Q = (10, 1), cushion y = 0. Bounce point? *(Answer: 10 × 4/5 = 8; B = (8, 0).)*

## Common mistakes

- **h² = pq used with p and q as the legs.** p and q are the pieces of the hypotenuse.
- **Adding a² + b² to get the hypotenuse without the square root.** c = √(a² + b²).
- **Pythagoras in a non-right triangle.** Drop an altitude first.
- **30-60-90 with √3 on the wrong leg.** The long leg (opposite 60°) carries √3; the short leg is opposite 30°.
- **Bank shot: reflecting the wrong point.** Reflect the target (or the start) across the cushion the ball will hit, then draw a straight line.

## Where this goes next

Unit 4 (weeks 15–17) names the side ratios of a right triangle — sine, cosine and tangent — and shows they depend only on the angle because all right triangles with that angle are similar (AA). The unknown-values problems that needed "trigonometry" in this week's examples become routine. Unit 5 uses scale factors on areas and volumes; Unit 7 proves theorems about circles with the same similar-triangle tools.

## Self-check

1. In right triangle ABC (right angle at C), the altitude from C splits the hypotenuse into pieces 3 and 12. Find the altitude, the hypotenuse and both legs.
2. Prove a² + b² = c² in one line, given b² = pc and a² = qc.
3. A 30-60-90 triangle has hypotenuse 18. Find both legs and the area.
4. P = (2, 6) and Q = (14, 3) on the same side of cushion y = 0. Find the bounce point.
5. Is a triangle with sides 10, 24, 26 a right triangle?

*Answers: (1) h = 6, c = 15, legs √45 = 3√5 and √180 = 6√5. (2) a² + b² = qc + pc = (p + q)c = c². (3) 9 and 9√3 ≈ 15.59; area ½ · 9 · 9√3 ≈ 70.15. (4) 12 × 6/9 = 8 from x = 2, so (10, 0). (5) Yes: 100 + 576 = 676 = 26².*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 3, Lessons 13–16, https://im.kendallhunt.com/HS/teachers/2/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
