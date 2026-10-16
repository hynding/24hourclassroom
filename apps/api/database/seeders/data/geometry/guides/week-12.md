# Week 12 · Similarity and Transformations

**Lessons:** 3.5 Splitting Triangle Sides with Dilation, Part 1 · 3.6 Connecting Similarity and Transformations · 3.7 Reasoning about Similarity with Transformations · 3.8 Are They All Similar?
**Practices:** MP3 (construct arguments), MP7 (structure), MP8 (regularity)
**Built from:** IM Geometry, Unit 3, Lessons 5–8, in our own words
**Spiral:** congruence was "a rigid motion carries one figure onto the other" (week 7); similarity adds one dilation to that sentence. The parallel-line angle facts from week 6 do the work in the side-splitting argument, and the proportional reasoning is the scale-factor arithmetic of week 11.

## What you need to be able to do

- Dilate a triangle from one of its vertices and explain why the image of the opposite side is parallel to it and k times as long.
- Use "a segment joining points on two sides, parallel to the third side" to set up and solve proportions.
- State the definition of similar figures and show two figures are similar by naming an explicit sequence: a dilation and rigid motions.
- Find the scale factor between similar figures and use it to find missing lengths; use AA reasoning informally (a full proof comes next week).
- Decide which families of figures are always similar (circles, squares, equilateral triangles, regular n-gons for the same n) and which are not (rectangles, rhombuses, isosceles triangles, general triangles).

## Key terms

| Term | Meaning |
|---|---|
| Similar figures | Figure A is similar to figure B if there is a sequence of rigid motions and dilations that takes A exactly onto B. Written A ∼ B. |
| Scale factor of a similarity | The k of the dilation in that sequence: every length of B is k times the corresponding length of A. |
| Corresponding parts | Matched by the similarity, named by letter order: △ABC ∼ △DEF means A ↔ D, B ↔ E, C ↔ F. |
| Side-splitter setup | A segment with endpoints on two sides of a triangle, parallel to the third side, cuts those two sides proportionally. |
| Midsegment | The segment joining the midpoints of two sides: parallel to the third side and half as long (the side splitter with k = 1/2). |

## 1. Dilating a triangle from a vertex

Take △ABC and dilate it from vertex A with scale factor k. A stays put; B goes to B′ on ray AB with AB′ = k · AB; C goes to C′ on ray AC with AC′ = k · AC. By what we saw last week, line B′C′ is parallel to BC (BC does not pass through the centre A) and B′C′ = k · BC.

```
Figure description: A at the top. Rays from A go down-left to B and down-right to C.
For k = 1/2, B′ is the midpoint of AB and C′ is the midpoint of AC;
B′C′ is parallel to BC and half as long.

            A
           / \
         B′---C′      (k = 1/2)
         /     \
        B-------C
```

Turn it around. Suppose you are given △ABC with a segment DE, D on AB and E on AC, and DE ∥ BC. Then D is the image of B under the dilation from A with k = AD/AB, and the parallel line through D meets AC in exactly one point, which must be the image of C. So E is that image, AE/AC = AD/AB = k, and DE/BC = k too.

**The proportions you can write** when DE ∥ BC with D on AB and E on AC:

- AD/AB = AE/AC = DE/BC (the "whole side" version);
- AD/DB = AE/EC (the "pieces" version, obtained by subtracting: AB/AD = AC/AE, so (AD + DB)/AD = (AE + EC)/AE, so DB/AD = EC/AE).

Do not mix the versions. DE/BC is NOT equal to AD/DB.

**Worked example 1.** In △ABC, AB = 12, AC = 15, D on AB with AD = 8, and DE ∥ BC with E on AC. Find AE and EC. k = AD/AB = 8/12 = 2/3, so AE = (2/3)(15) = 10 and EC = 5. Check the pieces version: AD/DB = 8/4 = 2, AE/EC = 10/5 = 2 ✓.

**Worked example 2.** DE ∥ BC, AD = 6, DB = 9, DE = 10. Find BC. The whole side is AB = 15, k = 6/15 = 2/5, and DE = k · BC gives BC = 10 ÷ (2/5) = 25. (A common wrong answer is 15, from using AD/DB.)

**Worked example 3 (midsegment).** M and N are the midpoints of AB and AC. Then k = 1/2, MN ∥ BC, and MN = BC/2. If BC = 17, MN = 8.5. Joining all three midpoints cuts △ABC into four congruent triangles, each similar to △ABC with k = 1/2.

**Try it 1.1** DE ∥ BC, AD = 5, AB = 20, AC = 28. Find AE. *(Answer: k = 1/4, AE = 7.)*

**Try it 1.2** DE ∥ BC, AD = 9, DB = 3, BC = 16. Find DE. *(Answer: k = 9/12 = 3/4, DE = 12.)*

## 2. The definition of similar

Two figures are **congruent** when a sequence of rigid motions carries one onto the other. Two figures are **similar** when a sequence of rigid motions **and dilations** carries one onto the other. Congruent figures are similar (use k = 1), but not the other way round.

**Showing figures are similar means naming the moves.** For triangles △ABC and △DEF with DE = 2 · AB, EF = 2 · BC, FD = 2 · CA:

1. Dilate △ABC from A by k = 2. The image △AB′C′ has sides 2AB, 2BC, 2CA, which equal DE, EF, FD.
2. △AB′C′ ≅ △DEF by SSS, so some rigid motion carries △AB′C′ onto △DEF.
3. The dilation followed by that rigid motion carries △ABC onto △DEF, so △ABC ∼ △DEF.

Any order works in principle, but "dilate first, then rigid motion" is the standard pattern because step 2 lets you use a congruence criterion.

**What similarity gives you.** If A ∼ B with scale factor k: corresponding angles are equal; every length in B is k times the matching length in A; the ratio of any two lengths within A equals the ratio of the matching two within B; perimeters scale by k; areas scale by k².

**Finding the scale factor** between two similar figures: divide a length in the second by the corresponding length in the first. Make sure you divide corresponding lengths (longest by longest, shortest by shortest).

**Worked example 4.** △PQR has sides 6, 8, 10 and △XYZ has sides 9, 12, 15. Are they similar? 9/6 = 12/8 = 15/10 = 1.5: every ratio is the same, so a dilation with k = 1.5 produces a triangle congruent to △XYZ by SSS, and the triangles are similar. The correspondence is P ↔ X, Q ↔ Y, R ↔ Z (matching sides in size order). Perimeters: 24 and 36, ratio 1.5 ✓. Areas: 24 and 54, ratio 2.25 = 1.5² ✓.

**Worked example 5.** A 4-by-6 rectangle and a 6-by-8 rectangle have all the same angles (90°). Are they similar? 6/4 = 1.5 but 8/6 ≈ 1.33: no single k works, so no. Equal angles alone do not make quadrilaterals similar.

**Try it 2.1** △ABC has AB = 5, BC = 7, CA = 9. △DEF has DE = 12.5, EF = 17.5, FD = 22.5. Find k and the correspondence. *(Answer: k = 2.5; A ↔ D, B ↔ E, C ↔ F.)*

**Try it 2.2** Two similar figures have areas 20 and 125. What is the scale factor from the first to the second? *(Answer: k² = 6.25, k = 2.5.)*

## 3. Reasoning with a dilation plus a rigid motion

Often the figures sit in a picture where the moves are easy to name.

**Worked example 6.** △ABC has a right angle at A, AB = 3, AC = 4. △ADE has D on ray AB with AD = 9 and E on ray AC with AE = 12. The dilation from A with k = 3 sends B to D and C to E, so it sends △ABC onto △ADE. One dilation, no rigid motion needed: △ABC ∼ △ADE with k = 3, and DE = 3 · BC = 15.

**Worked example 7.** Two triangles share vertex O, with the second triangle on the opposite side of O: △OAB and △OCD where C is on ray AO beyond O with OC = 2 · OA, and D is on ray BO beyond O with OD = 2 · OB. Dilate △OAB from O by k = 2: A goes to A′ on ray OA with OA′ = 2 OA. Then rotate 180° about O: A′ goes to C and B′ goes to D. The dilation followed by the rotation carries △OAB onto △OCD, so they are similar with k = 2, and AB ∥ CD (the rotation by 180° maps a line to a parallel line, and so does the dilation).

**Worked example 8 (angles as evidence).** △ABC has angles 50°, 60°, 70° and △DEF has angles 50°, 60°, 70° with DE = 2 · AB (AB opposite the 70° angle in both). Dilate △ABC by k = 2 from any point; the image has angles 50°, 60°, 70° and the side opposite 70° equal to DE. ASA (the 50° and 60° angles at the ends of that side) makes the image congruent to △DEF, so △ABC ∼ △DEF. Notice we needed only two equal angles: that is the AA criterion, proved properly next week.

**Try it 3.1** △ABC with AB = 4, BC = 5, CA = 6 and △KLM with KL = 10, LM = 12, MK = 8. Name the correspondence and the scale factor. *(Answer: AB ↔ MK (4 → 8), BC ↔ KL (5 → 10), CA ↔ LM (6 → 12): A ↔ M, B ↔ K, C ↔ L; k = 2.)*

## 4. Which figures are always similar?

Ask "is there a dilation (plus rigid motion) between any two of them?"

| Family | Always similar? | Why |
|---|---|---|
| Circles | Yes | Translate centres together, dilate by r₂/r₁. |
| Squares | Yes | Rigid motion matches a vertex and two sides' directions; dilate by s₂/s₁. |
| Equilateral triangles | Yes | Same as squares. |
| Regular n-gons (same n) | Yes | Same again. |
| Rectangles | No | 1 × 2 and 1 × 3 have different side ratios. |
| Rhombuses | No | Angles can differ (a square and a flat rhombus). |
| Isosceles triangles | No | Apex angles 20° and 120° cannot match. |
| Right triangles | No | Acute angles can differ. |
| Isosceles right triangles | Yes | Angles 45-45-90 fixed; one length determines all. |
| Triangles with angles 30-60-90 | Yes | All angles fixed. |
| Parabolas | Yes (surprisingly) | A dilation changes y = x² into y = x²/k; every parabola is one of those after rigid motions. |

The rule of thumb: a family is "all similar" when one length determines the whole figure (given the angles are fixed by the family's definition).

**Worked example 9.** Is every regular hexagon similar to every other? Yes: all angles are 120° and all sides equal, so a dilation by (side₂/side₁) followed by a rigid motion matches them. Is every hexagon with all angles 120° similar to every other? No: such a hexagon can have sides 1, 2, 1, 2, 1, 2 (a stretched regular hexagon), and its side ratios differ from a regular one.

**Try it 4.1** Are all rectangles with diagonals of length 10 similar? *(Answer: no; a 6 × 8 and a 1 × √99 both have diagonal 10 but different side ratios.)*

## Common mistakes

- **Using AD/DB = DE/BC.** The segment DE compares with the whole side: DE/BC = AD/AB.
- **Mismatched correspondence.** Divide longest by longest; letters in △ABC ∼ △DEF tell you which angles are equal.
- **"Same angles so similar" for quadrilaterals.** Only works for triangles.
- **Scaling area by k.** It is k². If you are told the areas, take a square root to get k.
- **Writing "they look the same" as a proof.** Name the dilation (centre, k) and the rigid motion.

## Where this goes next

Week 13 proves the three triangle similarity criteria, AA, SAS∼ and SSS∼, and the side-splitter theorem with its converse, then uses them on bearings-free proofs. Week 14 puts similar right triangles to work: the altitude to the hypotenuse, the Pythagorean theorem and proportions in circles.

## Self-check

1. In △ABC, DE ∥ BC with D on AB, E on AC, AD = 4, DB = 6, AE = 6. Find EC and the ratio DE/BC.
2. △ABC has sides 7, 8, 9; △DEF has sides 10.5, 12, 13.5. Similar? Scale factor?
3. Name the moves showing a circle of radius 2 centred at (0, 0) is similar to a circle of radius 5 centred at (3, 4).
4. Give two rectangles that are not similar, and two that are.
5. Similar figures have perimeters 30 and 45. Their areas are in what ratio?

*Answers: (1) AE/EC = AD/DB = 4/6, so EC = 9; DE/BC = AD/AB = 4/10 = 0.4. (2) Yes, every ratio is 1.5. (3) Translate by (3, 4), dilate from (3, 4) by k = 2.5. (4) 1 × 2 and 1 × 3 are not; 1 × 2 and 3 × 6 are. (5) k = 1.5, areas 1 : 2.25 (4 : 9).*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 3, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/2/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
