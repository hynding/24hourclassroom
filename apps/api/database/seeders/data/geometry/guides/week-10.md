# Week 10 · Parallelograms, Bisectors and What Determines a Quadrilateral

**Lessons:** 2.13 Proofs about Parallelograms · 2.14 Bisect It · 2.15 Congruence for Quadrilaterals
**Practices:** MP3 (construct arguments), MP7 (structure), MP8 (repeated reasoning)
**Built from:** IM Geometry, Unit 2, Lessons 13–15, in our own words
**Spiral:** SAS, ASA, SSS (weeks 8–9), alternate interior angles and their converse (week 6), the Perpendicular Bisector Theorem (week 8) and the week-2 constructions, which are finally proved to work.

## What you need to be able to do

- Prove the parallelogram theorems: opposite sides congruent, opposite angles congruent, diagonals bisect each other; and their converses, which show a quadrilateral is a parallelogram.
- Prove the isosceles triangle theorem and its converse, and the angle bisector theorem (a point on the bisector is equidistant from the sides) using triangle congruence.
- Justify the angle-bisector and perpendicular-bisector constructions as theorems.
- Decide what information is enough to determine a quadrilateral up to congruence, and give a counterexample when it is not.

## Key terms

| Term | Meaning |
|---|---|
| Parallelogram | A quadrilateral with both pairs of opposite sides parallel. |
| Parallelogram theorems | In a parallelogram: opposite sides are congruent; opposite angles are congruent; consecutive angles are supplementary; the diagonals bisect each other. |
| Converses | A quadrilateral is a parallelogram if: both pairs of opposite sides are congruent; or one pair of opposite sides is both parallel and congruent; or the diagonals bisect each other. |
| Isosceles triangle theorem | If two sides of a triangle are congruent, the angles opposite them are congruent. Converse: if two angles are congruent, the sides opposite them are congruent. |
| Angle bisector theorem (distance form) | A point on the bisector of an angle is equidistant from the two sides of the angle (distance measured perpendicularly), and conversely. |
| Determined up to congruence | A set of measurements determines a figure if any two figures with those measurements are congruent. |

## 1. Parallelogram theorems

Let ABCD be a parallelogram (AB ∥ DC, AD ∥ BC) and draw diagonal BD.

**Theorem 1: opposite sides are congruent.** ∠ABD ≅ ∠CDB (alternate interior, AB ∥ DC, transversal BD). ∠ADB ≅ ∠CBD (alternate interior, AD ∥ BC, transversal BD). BD ≅ DB. So △ABD ≅ △CDB by ASA, and AB ≅ CD, AD ≅ CB by CPCTC. ∎

**Theorem 2: opposite angles are congruent.** From the same congruence, ∠A ≅ ∠C by CPCTC. Drawing the other diagonal gives ∠B ≅ ∠D. ∎ (Consecutive angles such as ∠A and ∠B are co-interior for AD ∥ BC, so they are supplementary.)

**Theorem 3: the diagonals bisect each other.** Let the diagonals AC and BD meet at M. ∠BAM ≅ ∠DCM (alternate interior, AB ∥ DC, transversal AC); AB ≅ CD (Theorem 1); ∠ABM ≅ ∠CDM (alternate interior, transversal BD). △ABM ≅ △CDM by ASA, so AM ≅ CM and BM ≅ DM. ∎

```
Figure description: parallelogram ABCD, A bottom-left, B bottom-right, C top-right, D top-left.
Diagonals AC and BD cross at M, the midpoint of both.

      D-----------C
     / \         /
    /   \   M   /
   /     \     /
  A-----------B
```

## 2. The converses: proving a quadrilateral is a parallelogram

**Converse A: both pairs of opposite sides congruent ⇒ parallelogram.** Week 9, worked example 1: SSS on the two triangles formed by a diagonal, then two pairs of alternate interior angles.

**Converse B: one pair of opposite sides parallel and congruent ⇒ parallelogram.** AB ∥ DC and AB = DC; diagonal AC. ∠BAC ≅ ∠DCA (alternate interior), AB ≅ CD, AC ≅ CA: △ABC ≅ △CDA by SAS. CPCTC: ∠BCA ≅ ∠DAC, so BC ∥ AD. ∎

**Converse C: diagonals bisect each other ⇒ parallelogram.** AM = CM, BM = DM, ∠AMB ≅ ∠CMD (vertical): △AMB ≅ △CMD by SAS. CPCTC: AB ≅ CD and ∠BAM ≅ ∠DCM, so AB ∥ CD (alternate interior converse). Now AB is parallel and congruent to CD, so by Converse B the figure is a parallelogram. ∎

**Worked example 1.** Quadrilateral PQRS has PQ = SR = 7 and PQ ∥ SR. Is it a parallelogram? Yes, by Converse B. What if PQ = SR = 7 and PS = QR = 4 (no parallels given)? Yes, by Converse A. What if PQ = SR = 7 and PS ∥ QR? Not necessarily: an isosceles trapezoid with legs 7 and parallel bases of different lengths satisfies this. One pair congruent and the *other* pair parallel is not enough.

**Worked example 2.** In parallelogram ABCD, ∠A = (3x + 10)° and ∠C = (5x − 30)°. Find the angles. Opposite angles are congruent: 3x + 10 = 5x − 30, x = 20, ∠A = ∠C = 70°, and ∠B = ∠D = 110° (consecutive angles supplementary).

**Worked example 3.** Diagonals of parallelogram EFGH meet at K. EK = 2y + 3, GK = 4y − 5, FH = 18. Find EG and FK. Diagonals bisect each other: 2y + 3 = 4y − 5, y = 4, EK = GK = 11, EG = 22. FK = half of FH = 9.

**Try it 2.1** Give the shortest proof you can that a rhombus is a parallelogram. *(Answer: both pairs of opposite sides are congruent (all four sides are), so Converse A applies.)*

**Try it 2.2** Quadrilateral with diagonals 10 and 10 that bisect each other: what is it? *(Answer: a parallelogram with congruent diagonals, which is a rectangle (Converse C plus the fact, provable by SSS on the triangles along a side, that congruent diagonals in a parallelogram force right angles).)*

## 3. Bisect it: isosceles triangles and angle bisectors

**Isosceles triangle theorem.** If AB = AC in △ABC, then ∠B = ∠C. *Proof.* △ABC ≅ △ACB by SAS (AB ≅ AC, ∠A ≅ ∠A, AC ≅ AB); CPCTC. ∎ (Or: let M be the midpoint of BC; △ABM ≅ △ACM by SSS; CPCTC. Either way.)

**Converse.** If ∠B = ∠C then AB = AC. *Proof.* △ABC ≅ △ACB by ASA (∠B ≅ ∠C, BC ≅ CB, ∠C ≅ ∠B); CPCTC gives AB ≅ AC. ∎

**The three special segments coincide.** In isosceles △ABC with AB = AC, let M be the midpoint of BC. △ABM ≅ △ACM by SSS, so ∠BAM ≅ ∠CAM (AM bisects the apex angle) and ∠AMB ≅ ∠AMC, a congruent linear pair, so AM ⊥ BC. The median from A, the angle bisector from A, the altitude from A and the perpendicular bisector of BC are all the same line.

**Angle bisector theorem (distance form).** If P is on the bisector of ∠AVB, then the perpendicular distances from P to the two sides are equal. *Proof.* Drop perpendiculars from P to the sides, with feet X on VA and Y on VB. ∠XVP ≅ ∠YVP (bisector), ∠VXP ≅ ∠VYP (right angles), VP ≅ VP: △VXP ≅ △VYP by AAS, so PX ≅ PY. ∎ Conversely, if PX = PY (perpendicular distances) then P is on the bisector: △VXP ≅ △VYP by HL (hypotenuse VP shared, legs PX = PY), so ∠XVP ≅ ∠YVP.

So the angle bisector is the set of points equidistant from the two sides, just as the perpendicular bisector is the set of points equidistant from two points.

**Justifying the week-2 angle bisector construction.** Circle at V gives VX = VY; equal circles at X and Y give XZ = YZ; VZ shared. △VXZ ≅ △VYZ by SSS, so ∠XVZ ≅ ∠YVZ by CPCTC. The construction bisects the angle. ∎

**Worked example 4.** In △ABC, AB = AC = 13 and BC = 10. Find the distance from A to BC and the area. The altitude from A hits the midpoint M of BC (special segments coincide), BM = 5, AM = √(169 − 25) = 12. Area = ½ × 10 × 12 = 60.

**Worked example 5.** Point P is on the bisector of a 60° angle at V, with VP = 8. Find the distance from P to each side. The perpendicular from P to a side makes a right triangle with angle 30° at V; the distance is 8 sin 30° = 4 on each side (you will have sine officially in Unit 4; for now, a 30-60-90 triangle has its short leg half the hypotenuse, which follows from the equilateral triangle cut in half).

**Try it 3.1** △DEF has ∠D = ∠F = 50°. Which sides are congruent, and what is ∠E? *(Answer: the sides opposite the equal angles, EF and ED; ∠E = 80°.)*

## 4. What determines a quadrilateral?

For triangles, three well-chosen measurements (SAS, ASA, SSS) determine the figure. For quadrilaterals, four sides are not enough (week 7). How much is?

- **Four sides and one angle**: not enough in general (the fourth vertex can flip across a diagonal, week 7). But **four sides and one diagonal** are enough: the diagonal cuts the figure into two triangles, each determined by SSS, and the two triangles must be on opposite sides of the diagonal for a convex quadrilateral.
- **Three sides and the two included angles** (S-A-S-A-S): enough. The first three sides with their two angles form a zigzag, which is determined (week 8); the fourth side joins its ends.
- **Two sides and three angles**: not enough; a figure and an enlargement with the same angles can share two side lengths only if the sides are placed differently, but a counting argument aside, the simplest view is that angles alone allow scaling, and two sides can fail to pin the scale consistently. Treat "angles plus fewer than three sides in the right places" with suspicion and look for a counterexample.
- **Both diagonals, their crossing point's position on each, and the angle between them**: enough. Four SAS triangles around the crossing.

**Worked example 6.** Two quadrilaterals have sides 5, 6, 7, 8 in order and a diagonal of 9 joining the vertex between the 5 and 8 to the vertex between the 6 and 7. Are they congruent? The diagonal splits each into a 5-6-9 triangle and a 7-8-9 triangle. Each triangle is determined by SSS, and gluing them along the common side 9 on opposite sides gives one convex figure. Yes, congruent (assuming both are convex).

**Worked example 7.** Parallelograms: how much determines one? Two adjacent sides and the included angle (S-A-S). The other sides and angles follow from the theorems. So "a parallelogram with sides 4 and 7 and a 60° angle" is one figure up to congruence, while "a quadrilateral with sides 4, 7, 4, 7" is not.

**Try it 4.1** Rectangles: how many measurements determine one up to congruence? *(Answer: two, the side lengths; the angles are all 90° by definition.)*

**Try it 4.2** Rhombuses? *(Answer: two, the side and one angle (or the two diagonals).)*

## Common mistakes

- **Using a parallelogram property on a quadrilateral not yet proved to be a parallelogram.** State and justify the hypothesis.
- **Mixing up the converses.** "One pair parallel and the other pair congruent" is not a converse; an isosceles trapezoid is the counterexample.
- **Assuming the diagonals of a parallelogram are congruent or perpendicular.** They bisect each other; nothing more unless it is a rectangle or rhombus.
- **Writing the isosceles triangle theorem backwards.** Congruent sides ⇒ the angles *opposite* them are congruent, not the angles between them and the base.
- **Measuring distance to a side along a slant.** The angle bisector theorem uses perpendicular distance.

## Where this goes next

Unit 2 is complete: the congruence criteria and the standard theorems about triangles and quadrilaterals are proved. The unit summary lists them. Unit 3 (Similarity) relaxes "same size": dilations scale lengths by a factor while preserving angles, and the triangle criteria become AA, SAS∼ and SSS∼. Every proof in Unit 3 ends by citing a theorem from Unit 2.

## Self-check

1. Prove that the diagonals of a parallelogram bisect each other.
2. Quadrilateral ABCD has AB ∥ CD and AB = CD. Prove it is a parallelogram.
3. In parallelogram WXYZ, ∠W = 4∠X − 25°. Find all four angles.
4. State the isosceles triangle theorem and its converse, and give the criterion used to prove each.
5. Decide whether "four sides and one diagonal" determines a convex quadrilateral, and explain.

*Answers: (1) see Theorem 3: ASA on the triangles at the crossing, using alternate interior angles and opposite sides. (2) see Converse B: SAS with the alternate interior angle at the diagonal, then CPCTC and the converse of the alternate interior angle theorem. (3) consecutive angles are supplementary: 4x − 25 + x = 180, x = 41; ∠X = ∠Z = 41°, ∠W = ∠Y = 139°. (4) sides ⇒ angles by SAS (self-congruence) or SSS with the midpoint; angles ⇒ sides by ASA. (5) yes; the diagonal splits it into two SSS-determined triangles glued on opposite sides of the diagonal.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 2, Lessons 13–15, https://im.kendallhunt.com/HS/teachers/2/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
