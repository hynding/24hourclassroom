# Week 06 · Parallel Lines, Transversals and the 180° Triangle

**Lessons:** 1.20 Transformations, Transversals, and Proof · 1.21 One Hundred and Eighty · 1.22 Now What Can You Build?
**Practices:** MP3 (construct arguments), MP7 (structure), MP5 (tools)
**Built from:** IM Geometry, Unit 1, Lessons 20–22, in our own words
**Spiral:** the 180° rotation (week 4) and vertical angles and linear pairs (week 5) do all the proving; the parallel-line construction (week 2) is what lets you draw the auxiliary line in the triangle proof; the final lesson sends you back to every construction in the unit.

## What you need to be able to do

- Name the angle pairs formed when a transversal crosses two lines: alternate interior, alternate exterior, corresponding, co-interior (same-side interior).
- Prove that when the two lines are parallel, alternate interior angles are congruent (by a 180° rotation), and deduce that corresponding angles are congruent and co-interior angles are supplementary.
- Use the converse: if a pair of alternate interior angles is congruent, the lines are parallel.
- Prove that the angles of a triangle sum to 180°, and use it with the exterior angle theorem to find unknown angles.
- Plan and justify a design built from constructions (regular polygons, inscribed figures, tilings), explaining each step with the facts of the unit.

## Key terms

| Term | Meaning |
|---|---|
| Transversal | A line that crosses two other lines at two distinct points. |
| Interior angles | The four angles between the two lines (on the inside). |
| Exterior angles | The four angles outside the two lines. |
| Alternate interior angles | A pair of interior angles on opposite sides of the transversal, one at each crossing. |
| Corresponding angles | A pair of angles in the same position at each crossing (for example both upper-left). |
| Co-interior (same-side interior) angles | A pair of interior angles on the same side of the transversal. |
| Parallel postulate (in the form we use) | Through a point not on a line there is exactly one line parallel to the given line. |
| Auxiliary line | A line added to a figure to make a proof possible, such as the parallel through a vertex. |
| Exterior angle of a triangle | The angle between one side and the extension of an adjacent side; it forms a linear pair with the interior angle at that vertex. |
| Remote interior angles | For an exterior angle at C, the interior angles at A and B. |

## 1. Angles at a transversal

```
Figure description: lines ℓ (upper) and m (lower), transversal t crossing ℓ at P and m at Q.
At P the four angles are numbered 1 (upper-left), 2 (upper-right), 3 (lower-left), 4 (lower-right).
At Q: 5 (upper-left), 6 (upper-right), 7 (lower-left), 8 (lower-right).

          t
      1  /  2
   ------P------  ℓ
      3 /  4
       /
      5  /  6
   ------Q------  m
      7 /  8
```

- Interior: 3, 4, 5, 6. Exterior: 1, 2, 7, 8.
- Alternate interior pairs: 3 & 6, 4 & 5.
- Alternate exterior pairs: 1 & 8, 2 & 7.
- Corresponding pairs: 1 & 5, 2 & 6, 3 & 7, 4 & 8.
- Co-interior pairs: 3 & 5, 4 & 6.

These names apply whether or not ℓ ∥ m. The *theorems* need the parallel.

## 2. The alternate interior angle theorem

**Theorem.** If ℓ ∥ m and t is a transversal meeting them at P and Q, then alternate interior angles are congruent: ∠4 = ∠5 and ∠3 = ∠6.

**Proof.** Let M be the midpoint of PQ. Rotate the figure 180° about M.

- M is the midpoint of PQ, so the rotation sends P to Q and Q to P; it sends line t to itself (t passes through the centre).
- The rotation sends line ℓ (through P) to a line through Q. A 180° rotation sends every line to a parallel line (or to itself). So the image of ℓ is a line through Q parallel to ℓ. By the parallel postulate there is only one such line, and m is it. So ℓ → m, and likewise m → ℓ.
- Angle 4 is formed at P by the ray along t toward Q and the ray along ℓ to the right. Its image is formed at Q by the ray along t toward P and the ray along m to the left: that is angle 5.
- Rotations preserve angle measure, so ∠4 = ∠5. The same argument gives ∠3 = ∠6.

**Corollaries.**

- **Corresponding angles are congruent.** ∠1 = ∠4 (vertical angles) and ∠4 = ∠5 (alternate interior), so ∠1 = ∠5.
- **Co-interior angles are supplementary.** ∠3 + ∠4 = 180° (linear pair) and ∠4 = ∠5, so ∠3 + ∠5 = 180°.
- **Alternate exterior angles are congruent.** ∠1 = ∠4 = ∠5 = ∠8 using vertical angles twice.

**Converse.** If a transversal makes a pair of congruent alternate interior angles with two lines, the lines are parallel. (Sketch: if they were not parallel they would meet, forming a triangle whose exterior angle would equal a remote interior angle, impossible by section 4. For now you may cite the converse as a theorem.)

**Worked example 1.** ℓ ∥ m, and ∠3 = 115°. Find all eight angles. ∠3 = 115°, so ∠4 = 65° (linear pair), ∠1 = 65° (vertical with 4), ∠2 = 115° (vertical with 3). By alternate interior angles, ∠6 = ∠3 = 115° and ∠5 = ∠4 = 65°; then ∠7 = 65°, ∠8 = 115°. Every angle is either 65° or 115°, and any two that share a side are supplementary.

**Worked example 2.** Two lines are cut by a transversal; one pair of alternate interior angles measures (2x + 20)° and (3x − 5)°. For what x are the lines parallel? Set them equal: 2x + 20 = 3x − 5, x = 25. Then each angle is 70°. For any other x the lines are not parallel.

**Try it 2.1** ℓ ∥ m and a pair of co-interior angles measures (x + 30)° and (2x)°. Find x. *(Answer: x + 30 + 2x = 180, x = 50; the angles are 80° and 100°.)*

## 3. The triangle angle sum

**Theorem.** The angles of any triangle sum to 180°.

**Proof.** Let the triangle be ABC. Construct the line through C parallel to AB (week 2: double perpendicular, or in a proof simply "the line through C parallel to AB", which exists and is unique by the parallel postulate). Call it ℓ. Mark points D and E on ℓ with D on the same side as A and E on the same side as B, so that D, C, E are in order.

```
Figure description: triangle ABC with AB horizontal at the bottom and C at the top.
Line ℓ through C is parallel to AB. D is on ℓ to the left of C, E to the right.
Angle DCA (call it ∠1) sits between ℓ and CA; angle ECB (∠3) between CB and ℓ; ∠ACB (∠2) is between.

     D-------C-------E   ℓ
           /1 2 3\
          /       \
         A---------B
```

- ∠DCA = ∠CAB (alternate interior angles, transversal AC crossing the parallels ℓ and AB).
- ∠ECB = ∠CBA (alternate interior angles, transversal BC).
- ∠DCA + ∠ACB + ∠BCE = 180° because D, C, E are collinear (the three angles fill a straight angle).
- Substituting: ∠CAB + ∠ACB + ∠CBA = 180°. ∎

The line ℓ is an **auxiliary line**: not part of the problem, added because it lets the alternate interior angle theorem move ∠A and ∠B up to C where they sit next to ∠C on a straight line.

**Exterior angle theorem.** Extend side AB beyond B to a point F. The exterior angle ∠CBF equals the sum of the two remote interior angles: ∠CBF = ∠A + ∠C. Proof: ∠CBF + ∠CBA = 180° (linear pair) and ∠A + ∠C + ∠CBA = 180° (angle sum); subtract.

**Worked example 3.** In triangle ABC, ∠A = 48° and ∠B = 2∠C. Find ∠B and ∠C. 48 + 2x + x = 180, 3x = 132, x = 44. ∠C = 44°, ∠B = 88°.

**Worked example 4.** The angles of a triangle are in the ratio 2 : 3 : 4. Find them. 2k + 3k + 4k = 180, k = 20: 40°, 60°, 80°.

**Worked example 5.** In triangle PQR, side QR is extended to S. ∠PQR = 35° and ∠PRS = 112°. Find ∠QPR. Exterior angle: 112 = 35 + ∠QPR, so ∠QPR = 77°. Check with the interior angle at R: 180 − 112 = 68°, and 35 + 77 + 68 = 180 ✓.

**Consequences you will use constantly.**

- A triangle has at most one right or obtuse angle.
- The acute angles of a right triangle are complementary.
- Each angle of an equilateral triangle is 60° (all three are congruent by symmetry, week 4, and sum to 180°).
- The angles of a quadrilateral sum to 360° (cut it into two triangles by a diagonal); of an n-gon, (n − 2) × 180°.
- Each interior angle of a regular n-gon is (n − 2) × 180°/n: 108° for a pentagon, 120° for a hexagon, 135° for an octagon.

**Try it 3.1** A right triangle has one acute angle of 23°. Find the other. *(Answer: 67°.)*

**Try it 3.2** Find each interior angle of a regular dodecagon (12 sides). *(Answer: 10 × 180 ÷ 12 = 150°.)*

## 4. Now what can you build?

The last lesson of the unit asks you to design something with the tools you now have and to justify it. The point is not the drawing but the justification: every length and angle in your design should trace back to a circle, a line, or a theorem.

**Design example — a regular hexagon tiling.** Start with a circle of radius r; the daisy construction (week 1) gives a regular hexagon with side r. Translate the hexagon by the arrow from one vertex to the opposite vertex of an adjacent hexagon; more simply, note that three hexagons meet at every vertex because each interior angle is 120° and 3 × 120° = 360°, which is why the tiling has no gaps. The 120° comes from the angle sum of a hexagon, (6 − 2) × 180° ÷ 6, proved this week.

**Design example — a square and its inscribed circle.** Construct a square ABCD on AB (week 2). The perpendicular bisectors of AB and BC meet at the centre O. The circle centred at O through the midpoint of AB touches all four sides, because O is equidistant from the sides by the symmetry of the square (week 4).

**Design example — a 15° angle.** 60° (equilateral triangle) minus 45° (bisected right angle) gives 15°; or bisect 30° (which is bisected 60°). Both are legitimate; the second is fewer steps.

**Worked example 6 — justifying a tiling with equilateral triangles.** Six equilateral triangles meet at a point. Why do they fit exactly? Each angle is 60° (angle sum and symmetry), and 6 × 60° = 360°, a full turn. Could five regular pentagons meet at a point? 5 × 108° = 540° > 360°, no; three give 324° < 360°, a gap; so regular pentagons do not tile the plane.

**Try it 4.1** Which regular polygons tile the plane by themselves? *(Answer: the ones whose interior angle divides 360°: triangle (60°), square (90°), hexagon (120°). 108° and 135° and anything larger do not divide 360°.)*

## Common mistakes

- **Using the alternate-interior theorem without a parallel.** The angle names exist for any two lines; the congruence needs ℓ ∥ m, and you must say so.
- **Confusing the theorem with its converse.** "Parallel ⇒ congruent alternate interior angles" and "congruent alternate interior angles ⇒ parallel" are different statements, both true, each needing its own justification.
- **Forgetting that an exterior angle is a linear pair with the interior angle.** The exterior angle at B is 180° − ∠B, not ∠B.
- **Claiming the angle sum is 180° "because that is the rule."** The reason is the parallel through a vertex plus alternate interior angles.
- **Adding regular polygon angles wrongly.** The interior angle of a regular n-gon is (n − 2)180°/n; the exterior angle is 360°/n; they are supplementary.

## Where this goes next

Unit 1 is complete: you can construct, transform, and prove. Unit 2 (Congruence) takes the point-by-point method and asks exactly which measurements force two triangles to coincide: SAS, ASA and SSS. Every proof there will cite rigid transformations, vertical angles, alternate interior angles or the triangle angle sum from this unit. The unit summary sheet collects every definition and theorem in one place; use it to prepare for the unit exam.

## Self-check

1. ℓ ∥ m with transversal t. One interior angle is 71°. State the measures of the other seven, naming the relationship you use for each of the three at the other crossing.
2. Prove that the angles of a triangle sum to 180°, in your own words, naming the auxiliary line and the theorem used twice.
3. Triangle angles are (x + 10)°, (2x − 30)° and (3x + 20)°. Find x and the angles.
4. An exterior angle of a triangle is 130° and one remote interior angle is 55°. Find the other remote interior angle and the interior angle adjacent to the exterior angle.
5. Explain why regular octagons alone cannot tile the plane, and name a pair of regular polygons that together can fill the space around a vertex.

*Answers: (1) 109°, 71°, 109° at the first crossing; at the second, 71° (alternate interior or corresponding), 109°, 71°, 109° (linear pairs and vertical angles). (2) line through the apex parallel to the base; alternate interior angles (twice); three angles on a straight line. (3) 6x = 180, x = 30: 40°, 30°, 110°. (4) 75° and 50°. (5) 135° does not divide 360° (two octagons leave 90°), so two octagons and one square meet at each vertex.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 1, Lessons 20–22, https://im.kendallhunt.com/HS/teachers/2/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
