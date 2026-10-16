# Week 09 · SSS, the SSA Trap, Proof Practice and Quadrilaterals

**Lessons:** 2.9 Side-Side-Side Triangle Congruence · 2.10 Practicing Proofs · 2.11 Side-Side-Angle (Sometimes) Congruence · 2.12 Proofs about Quadrilaterals
**Practices:** MP3 (construct arguments), MP1 (persevere), MP7 (structure)
**Built from:** IM Geometry, Unit 2, Lessons 9–12, in our own words
**Spiral:** the perpendicular-bisector justification of the final reflection (weeks 7–8) becomes the SSS proof; SAS and ASA (week 8) are the tools for every quadrilateral proof; the week-1 rhombus and kite return as theorems.

## What you need to be able to do

- State and prove the SSS criterion, using the Perpendicular Bisector Theorem for the final reflection.
- Choose the right criterion (SAS, ASA, AAS, SSS) from the marked information in a figure, and write a complete proof with CPCTC.
- Explain, with a figure, why SSA does not in general guarantee congruence, and state the case where it does (the hypotenuse-leg case for right triangles).
- Prove properties of kites and rhombuses: a diagonal of a kite bisects the angles it joins and is the perpendicular bisector of the other diagonal; the diagonals of a rhombus are perpendicular bisectors of each other.

## Key terms

| Term | Meaning |
|---|---|
| SSS | If the three sides of one triangle are congruent to the three sides of another, the triangles are congruent. |
| SSA (or ASS) | Two sides and a non-included angle. **Not** a criterion in general: two different triangles can share the data. |
| HL (hypotenuse-leg) | For right triangles: if the hypotenuse and one leg are congruent, the triangles are congruent. The one case of SSA that works. |
| Kite | A quadrilateral with two pairs of congruent adjacent sides (ABCD with AB = AD and CB = CD). |
| Rhombus | A quadrilateral with four congruent sides. |
| Diagonal | A segment joining two non-adjacent vertices. |
| Auxiliary segment | A segment added to a figure (usually a diagonal) to create triangles to compare. |

## 1. Side-Side-Side

**SSS criterion.** If AB ≅ DE, BC ≅ EF and CA ≅ FD, then △ABC ≅ △DEF.

**Proof.** Translate A onto D; rotate about D so that B lands on E (AB = DE, unique point on the ray). Call the image of C the point C′. Rigid motions preserve length, so DC′ = AC = DF and EC′ = BC = EF. If C′ = F we are done. Otherwise, D is equidistant from C′ and F, and E is equidistant from C′ and F, so by the converse of the Perpendicular Bisector Theorem both D and E lie on the perpendicular bisector of C′F. Two points determine a line, so line DE is that perpendicular bisector. By the definition of reflection, reflecting across DE sends C′ to F and fixes D and E. ∎

This is the proof that three equal sides force the same shape: the "rigidity of triangles" of week 7, now a theorem.

**Worked example 1.** Figure description: quadrilateral ABCD with AB = CD and AD = CB; diagonal AC is drawn. Prove ∠B ≅ ∠D. AB ≅ CD (given), BC ≅ DA (given), AC ≅ CA (reflexive). So △ABC ≅ △CDA by SSS (note the order: A ↔ C, B ↔ D, C ↔ A). By CPCTC, ∠ABC ≅ ∠CDA, that is, ∠B ≅ ∠D. The same congruence gives ∠BAC ≅ ∠DCA, so AB ∥ CD, and ∠BCA ≅ ∠DAC, so BC ∥ AD: a quadrilateral with both pairs of opposite sides congruent is a parallelogram.

**Try it 1.1** Why does the SSS proof need the Perpendicular Bisector Theorem rather than the equal-angle argument used for SAS? *(Answer: no angles are given; the only information about C′ and F is their distances from D and E.)*

## 2. Choosing the criterion

Read the figure, list what is marked (and what is free: vertical angles, shared sides, parallel-line angles, midpoints, bisectors), and match the pattern:

| Marked | Criterion |
|---|---|
| Two sides and the angle between them | SAS |
| Two angles and the side between them | ASA |
| Two angles and a side not between them | AAS |
| Three sides | SSS |
| Right angle, hypotenuse and a leg | HL |
| Two sides and an angle not between them (no right angle) | none; look for more information |
| Three angles | none for congruence (similarity only) |

**Worked example 2 (ASA with parallels).** Figure description: AB ∥ DC and AD ∥ BC (a parallelogram); diagonal BD is drawn. Prove AB = CD. ∠ABD ≅ ∠CDB (alternate interior, AB ∥ DC, transversal BD); BD ≅ DB (reflexive); ∠ADB ≅ ∠CBD (alternate interior, AD ∥ BC, transversal BD). △ABD ≅ △CDB by ASA. CPCTC: AB ≅ CD. This is the first half of "opposite sides of a parallelogram are congruent" (week 10).

**Worked example 3 (SSS with a circle).** Figure description: circle centred at O; chords AB and CD with AB = CD; radii OA, OB, OC, OD are drawn. Prove ∠AOB ≅ ∠COD. OA ≅ OC and OB ≅ OD (radii of the same circle), AB ≅ CD (given). △OAB ≅ △OCD by SSS. CPCTC gives the central angles. (Unit 7 uses this: equal chords subtend equal central angles.)

**Worked example 4 (spotting a non-proof).** Figure description: △PQR and △PSR share side PR; PQ = PS. A student claims △PQR ≅ △PSR by SSA, using PQ ≅ PS, PR ≅ PR and ∠PRQ ≅ ∠PRS. The angle at R is not between the two sides, so this is SSA: invalid. If instead ∠QPR ≅ ∠SPR were known (PR bisects ∠QPS), SAS would work.

**Try it 2.1** In △ABC and △DEF, ∠B = ∠E = 90°, AC = DF and BC = EF. Which criterion applies? *(Answer: HL; the hypotenuses AC, DF and legs BC, EF match.)*

## 3. Why SSA fails, and when it works

Take side PQ = 6, ∠P = 35°, and side QR = 4. From P draw a ray at 35°; R is 4 from Q, so R is on the circle centred at Q with radius 4. That circle can cross the ray **twice** (because 4 is less than 6 but more than the distance from Q to the ray, which is 6 sin 35° ≈ 3.44). Two different triangles PQR₁ and PQR₂ have the same two sides and the same non-included angle.

```
Figure description: P at the left, ray from P going up-right at 35°.
Q above and right of P with PQ = 6. Circle centred at Q, radius 4, cuts the ray at R₁ (near P) and R₂ (far from P).
Triangles PQR₁ and PQR₂ share PQ, QR and ∠P but are not congruent.

                 Q
               / | \
             /   |   \
           /    R₁----R₂---- ray
         P
```

When does SSA work?

- **The angle is a right angle (HL).** Then the side opposite the right angle is the hypotenuse, the longest side, and the circle centred at Q crosses the ray only once on the correct side. **HL theorem:** if the hypotenuse and a leg of one right triangle are congruent to the hypotenuse and a leg of another, the triangles are congruent. (Proof: the other leg is forced by the Pythagorean theorem, then SSS; or by the perpendicular-bisector argument directly.)
- **The angle is obtuse**, or the side opposite the given angle is at least as long as the other given side. Then the circle meets the ray only once.

**Worked example 5.** Two triangles have sides 10 and 7 and a 90° angle opposite the 10. Are they congruent? Yes: HL, since 10 is the hypotenuse. Two triangles with sides 10 and 7 and a 40° angle opposite the 7? Not necessarily: 7 < 10 and 7 > 10 sin 40° ≈ 6.43, so two triangles exist.

**Try it 3.1** Sides 5 and 9 with a 30° angle opposite the 9. How many triangles? *(Answer: one; 9 ≥ 5, so the circle of radius 9 about the far vertex crosses the ray once on the correct side.)*

## 4. Proofs about kites and rhombuses

**Theorem (kite).** In kite ABCD with AB = AD and CB = CD, the diagonal AC bisects ∠BAD and ∠BCD, and AC is the perpendicular bisector of BD.

*Proof.* △ABC ≅ △ADC by SSS (AB ≅ AD, CB ≅ CD, AC ≅ AC). CPCTC: ∠BAC ≅ ∠DAC and ∠BCA ≅ ∠DCA, so AC bisects both angles. For the second claim: A is equidistant from B and D, and C is equidistant from B and D, so both lie on the perpendicular bisector of BD (converse of the Perpendicular Bisector Theorem); line AC is that bisector. ∎

```
Figure description: kite ABCD, A at top, C at bottom, B left, D right.
AB = AD (short), CB = CD (long). Diagonal AC vertical, diagonal BD horizontal,
crossing at M with BM = MD and AC ⊥ BD.

          A
         / \
        /   \
      B---M---D
        \   /
         \ /
          C
```

**Theorem (rhombus).** The diagonals of a rhombus are perpendicular bisectors of each other, and each diagonal bisects the two angles it joins.

*Proof.* A rhombus is a kite in two ways (AB = AD and CB = CD; also BA = BC and DA = DC), so the kite theorem applies to both diagonals. ∎

**Worked example 6.** Rhombus PQRS has diagonals PR = 16 and QS = 12 meeting at T. Find the side. The diagonals bisect each other at right angles, so PT = 8, QT = 6, and PQ = √(64 + 36) = 10. Perimeter 40. Area = half the product of the diagonals = ½ × 16 × 12 = 96 (four right triangles of area 24).

**Worked example 7 — converse direction.** If the diagonals of a quadrilateral are perpendicular bisectors of each other, is it a rhombus? Let them cross at T. Each vertex is on the perpendicular bisector of the other diagonal, so by the Perpendicular Bisector Theorem each vertex is equidistant from the two ends of the other diagonal: PQ = PS, RQ = RS (P and R on the bisector of QS), and QP = QR, SP = SR (Q and S on the bisector of PR). So all four sides are equal. Yes.

**Try it 4.1** In kite ABCD (AB = AD, CB = CD), ∠BAD = 70° and ∠BCD = 40°. Find ∠ABC. *(Answer: AC bisects both angles; in △ABC, ∠BAC = 35°, ∠BCA = 20°, so ∠ABC = 125°. Check: 70 + 125 + 40 + 125 = 360.)*

## Common mistakes

- **Writing SSS with the vertices in the wrong order.** Match each side to its congruent partner and read off the correspondence from the endpoints.
- **Treating SSA as a criterion.** Unless there is a right angle (HL) or the side opposite the angle is the longer one, look for other information.
- **Forgetting the auxiliary diagonal.** Quadrilateral proofs almost always start with "draw diagonal AC".
- **Using the kite theorem on the wrong diagonal.** Only the diagonal joining the vertices where the congruent sides meet is the axis of symmetry.
- **Assuming a rhombus's diagonals are congruent.** They are perpendicular bisectors of each other; they are congruent only for a square.

## Where this goes next

Week 10 proves the parallelogram theorems in both directions (opposite sides congruent, diagonals bisect each other, and the converses), re-proves the isosceles triangle theorem and the angle bisector theorem as "bisect it" results, and answers the week-7 question of what information determines a quadrilateral. The unit exam follows.

## Self-check

1. Write the SSS proof's final step: why does the reflection across DE send C′ to F?
2. Figure: AB ∥ DC and AB = DC; diagonal AC. Prove △ABC ≅ △CDA and name the criterion.
3. Sides 8 and 5 with a 50° angle opposite the 5. Explain whether two triangles are possible (sin 50° ≈ 0.766).
4. Kite WXYZ has WX = WZ and YX = YZ. Which diagonal is the perpendicular bisector of the other, and why?
5. A rhombus has diagonals 10 and 24. Find its side and area.

*Answers: (1) D and E are each equidistant from C′ and F, so line DE is the perpendicular bisector of C′F, and the reflection across the perpendicular bisector swaps the endpoints. (2) AB ≅ CD (given), ∠BAC ≅ ∠DCA (alternate interior), AC ≅ CA (reflexive): SAS. (3) 8 sin 50° ≈ 6.13 > 5, so the circle of radius 5 does not reach the ray: no triangle at all. (4) WY is the perpendicular bisector of XZ, because W and Y are each equidistant from X and Z. (5) side √(25 + 144) = 13; area ½ × 10 × 24 = 120.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 2, Lessons 9–12, https://im.kendallhunt.com/HS/teachers/2/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
