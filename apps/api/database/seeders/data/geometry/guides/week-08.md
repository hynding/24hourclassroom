# Week 08 · SAS, ASA and the Perpendicular Bisector Theorem

**Lessons:** 2.5 Points, Segments, and Zigzags · 2.6 Side-Angle-Side Triangle Congruence · 2.7 Angle-Side-Angle Triangle Congruence · 2.8 The Perpendicular Bisector Theorem
**Practices:** MP3 (construct arguments), MP6 (precision), MP7 (structure)
**Built from:** IM Geometry, Unit 2, Lessons 5–8, in our own words
**Spiral:** the four-step rigid-motion proof (week 7) is reused with fewer givens; the "unique point on a ray" and "unique ray on a side at a given angle" facts, linear pairs (week 5) and the isosceles-triangle reflection (week 4) all reappear.

## What you need to be able to do

- Prove the Segment Congruence Theorem and the Angle Congruence Theorem with rigid motions, and use them to prove that polylines ("zigzags") with matching segments and angles are congruent.
- State the Side-Angle-Side (SAS) criterion precisely, prove it, and apply it, checking that the angle is included.
- State the Angle-Side-Angle (ASA) criterion precisely, prove it, and apply it, checking that the side is included.
- State the Perpendicular Bisector Theorem and its converse, prove both using triangle congruence, and use them to justify constructions.
- Write two-column and paragraph proofs that cite SAS, ASA and CPCTC with correct correspondences.

## Key terms

| Term | Meaning |
|---|---|
| Segment Congruence Theorem | If two segments have the same length, they are congruent (a rigid motion carries one onto the other). |
| Angle Congruence Theorem | If two angles have the same measure, they are congruent. |
| SAS | If two sides and the included angle of one triangle are congruent to two sides and the included angle of another, the triangles are congruent. |
| ASA | If two angles and the included side of one triangle are congruent to two angles and the included side of another, the triangles are congruent. |
| AAS | If two angles and a non-included side match, the triangles are congruent (because the third angles then match too, reducing to ASA). |
| Perpendicular Bisector Theorem | A point is on the perpendicular bisector of a segment **if and only if** it is equidistant from the segment's endpoints. |
| Two-column proof | Statements on the left, a reason for each on the right. |
| Reflexive property | Any segment or angle is congruent to itself (a shared side is congruent in both triangles). |

## 1. Segments, angles and zigzags

**Segment Congruence Theorem.** If AB = CD then segment AB ≅ segment CD. *Proof.* Translate by the arrow from A to C; now A is on C. Rotate about C so that the image of B lies on ray CD. The image of B is AB = CD from C, and the only point on ray CD at that distance is D. So the sequence sends A → C and B → D. ∎

**Angle Congruence Theorem.** If ∠ABC = ∠DEF (as measures) then ∠ABC ≅ ∠DEF. *Proof.* Translate B to E. Rotate about E so that the image of ray BA lies along ray ED. The image of ray BC now makes the angle ∠ABC = ∠DEF with ray ED, on one side or the other. If on the same side as F, it is ray EF (one ray per angle per side). If on the opposite side, reflect across line ED; the reflection fixes ray ED and carries the image ray to ray EF. ∎

These two theorems are why "congruent" and "equal measure" are interchangeable for segments and angles. They are also the building blocks for **zigzags**: a path of connected segments. Two zigzags A–B–C–D and W–X–Y–Z are congruent if AB = WX, BC = XY, CD = YZ, ∠ABC = ∠WXY and ∠BCD = ∠XYZ: match the first segment (Segment Congruence Theorem), then the angle at B forces the direction of BC, the length forces C, and so on, reflecting once if the first turn goes the wrong way.

**Worked example 1.** Zigzag P–Q–R with PQ = 4, QR = 6, ∠PQR = 110°, and zigzag S–T–U with ST = 4, TU = 6, ∠STU = 110°. After translating P to S and rotating Q onto T (PQ = ST), the image of R is 6 from T on a ray making 110° with ray TS, on one side or the other of line ST; U is the one on its side. So reflect across ST if needed. The zigzags are congruent, which means triangle PQR ≅ triangle STU as well, and that is exactly SAS.

**Try it 1.1** Why does the Segment Congruence Theorem not need a reflection? *(Answer: after rotation the image of B is already on ray CD at the right distance; a segment has no "side" to be wrong on.)*

## 2. Side-Angle-Side

**SAS criterion.** In △ABC and △DEF, if AB ≅ DE, ∠A ≅ ∠D and AC ≅ DF, then △ABC ≅ △DEF.

The angle must be the one **between** the two sides. Two sides and a non-included angle (SSA) is not a criterion (week 9 explains when it fails).

```
Figure description: △ABC and △DEF side by side.
Tick marks: AB and DE one tick, AC and DF two ticks; angle marks at A and D match.
        C                 F
       /  \              /  \
      /    \            /    \
     A------B          D------E
```

**Proof.** Translate so A lands on D. Rotate about D so the image of B lands on ray DE; since the image of AB has length AB = DE, the image of B is E. Now the image of ray AC makes the angle ∠A = ∠D with ray DE. If it is on the same side of line DE as F, it is ray DF; if not, reflect across line DE, which fixes D and E and moves the image ray onto ray DF (Angle Congruence Theorem argument). The image of C is then on ray DF at distance AC = DF from D, which is F. ∎

**Worked example 2 — applying SAS.** Figure description: segments AC and BD cross at their common midpoint M. Prove △AMB ≅ △CMD.

| Statement | Reason |
|---|---|
| AM ≅ CM | M is the midpoint of AC |
| BM ≅ DM | M is the midpoint of BD |
| ∠AMB ≅ ∠CMD | vertical angles |
| △AMB ≅ △CMD | SAS |

Then by CPCTC, AB ≅ CD and ∠BAM ≅ ∠DCM. The second of these, with the converse of the alternate interior angle theorem, shows AB ∥ CD.

**Worked example 3 — SAS with a shared side.** Figure description: quadrilateral ABCD with AB = AD and AC bisecting ∠BAD. Prove △ABC ≅ △ADC. AB ≅ AD (given), ∠BAC ≅ ∠DAC (AC bisects the angle), AC ≅ AC (reflexive). The angle at A is included between AB and AC, and between AD and AC. SAS. Then BC ≅ DC by CPCTC: a kite's other two sides are congruent.

**Try it 2.1** In △PQR and △XYZ, PQ = XY = 5, QR = YZ = 7 and ∠P = ∠X = 40°. Does SAS apply? *(Answer: no; the equal angle is at P and X, which is not included between PQ and QR. The included angle would be ∠Q and ∠Y.)*

## 3. Angle-Side-Angle

**ASA criterion.** In △ABC and △DEF, if ∠A ≅ ∠D, AB ≅ DE and ∠B ≅ ∠E, then △ABC ≅ △DEF.

**Proof.** Translate so A lands on D; rotate about D so B lands on E (AB = DE; unique point on the ray). Now the image of ray AC makes angle ∠A = ∠D with ray DE at D, and the image of ray BC makes angle ∠B = ∠E with ray ED at E. If the image of C is on the opposite side of line DE from F, reflect across DE (fixing D and E). Now both image rays are on F's side: the ray from D is ray DF and the ray from E is ray EF (one ray per angle per side). The image of C is on both rays; two rays from different points meet in at most one point, and F is on both; so the image of C is F. ∎

**AAS.** If ∠A ≅ ∠D, ∠B ≅ ∠E and BC ≅ EF (a non-included side), then ∠C ≅ ∠F by the angle sum, and △ABC ≅ △DEF by ASA on ∠B, BC, ∠C. So any two angles plus any one corresponding side suffice. AAA does **not**: equal angles with different sizes give similar, not congruent, triangles.

**Worked example 4.** Figure description: lines AB and CD are parallel; segment AD and segment BC cross at E, with E the midpoint of AD. Prove E is also the midpoint of BC.

| Statement | Reason |
|---|---|
| ∠BAE ≅ ∠CDE | alternate interior angles, AB ∥ CD, transversal AD |
| AE ≅ DE | E is the midpoint of AD |
| ∠AEB ≅ ∠DEC | vertical angles |
| △AEB ≅ △DEC | ASA (angle at A/D, included side AE/DE, angle at E) |
| BE ≅ CE | CPCTC |
| E is the midpoint of BC | definition of midpoint |

**Try it 3.1** Two triangles have angles 30°, 70°, 80° and one side of 10 in each. Are they necessarily congruent? *(Answer: only if the 10 is opposite the same angle in both; "a side of 10" must be a corresponding side.)*

## 4. The Perpendicular Bisector Theorem

**Theorem.** If P is on the perpendicular bisector of AB, then PA = PB.

*Proof.* Let the bisector meet AB at its midpoint M. If P = M the claim is immediate. Otherwise AM ≅ BM (midpoint), ∠AMP ≅ ∠BMP (both right angles, since the bisector is perpendicular to AB), PM ≅ PM (reflexive). △AMP ≅ △BMP by SAS, so PA ≅ PB by CPCTC. ∎

**Converse.** If PA = PB, then P is on the perpendicular bisector of AB.

*Proof.* Let M be the midpoint of AB. First, △PAB ≅ △PBA by SAS (PA ≅ PB, ∠APB ≅ ∠BPA, PB ≅ PA), so ∠PAB ≅ ∠PBA (base angles of an isosceles triangle). Now △PAM ≅ △PBM by SAS: PA ≅ PB, ∠PAM ≅ ∠PBM, AM ≅ BM. By CPCTC ∠PMA ≅ ∠PMB; these form a linear pair, so each is 90°. Thus line PM passes through the midpoint of AB and is perpendicular to it: it is the perpendicular bisector, and P is on it. ∎

Together: **P is on the perpendicular bisector of AB if and only if PA = PB.** This is the theorem that was promised in week 1 and used informally ever since (closest-point borders, mirror lines, centres of rotation, the final reflection in congruence proofs). It is now proved.

**Worked example 5.** In △ABC, the perpendicular bisectors of AB and BC meet at O. Prove OA = OC. O is on the bisector of AB, so OA = OB; O is on the bisector of BC, so OB = OC; hence OA = OC. (So O is on the bisector of AC too: the three perpendicular bisectors of a triangle are concurrent, the circumcentre of Unit 7.)

**Worked example 6 — justifying the week-1 construction.** Circles of equal radius centred at A and B cross at P and Q. Then PA = PB (radii), so P is on the perpendicular bisector of AB by the converse; likewise Q. Two points determine a line, so PQ is the perpendicular bisector. The construction is now a theorem, not a recipe.

**Try it 4.1** P is on the perpendicular bisector of AB, PA = 13 and AB = 10. Find the distance from P to line AB. *(Answer: the foot is the midpoint M with AM = 5; PM = √(169 − 25) = 12.)*

## 5. Writing proofs that cite SAS and ASA

Checklist before writing "by SAS" or "by ASA":

1. Name the two triangles with vertices in corresponding order.
2. List three congruences, in the order S-A-S or A-S-A, each with a reason (given, midpoint, bisector, vertical angles, alternate interior angles, reflexive, radii of a circle, …).
3. Confirm the angle is between the two sides (SAS) or the side is between the two angles (ASA).
4. Only then cite the criterion, and only then use CPCTC for the part you actually want.

Common reasons for a congruent part: *given*; *definition of midpoint*; *definition of angle bisector*; *vertical angles are congruent*; *alternate interior angles of parallel lines*; *reflexive property*; *all right angles are congruent*; *radii of the same circle are congruent*; *Perpendicular Bisector Theorem*.

## Common mistakes

- **SAS with a non-included angle.** Check which vertex the angle is at.
- **ASA with a non-included side** without noticing it is AAS (fine) or that the side is not corresponding (not fine).
- **Writing CPCTC before the congruence is established.**
- **Forgetting the reflexive property for a shared side.** It is a legitimate, necessary line.
- **Citing the Perpendicular Bisector Theorem in the wrong direction.** "On the bisector ⇒ equidistant" and "equidistant ⇒ on the bisector" are different statements; both are true, but name the one you use.

## Where this goes next

Week 9 completes the set with SSS, shows when SSA works (the right-angle case, HL) and when it fails, practises proofs, and starts on quadrilaterals. Week 10 proves the parallelogram theorems, revisits the angle and perpendicular bisector constructions as theorems, and asks what information determines a quadrilateral.

## Self-check

1. State SAS and ASA precisely, including the words "included".
2. Segments PR and QS cross at T, with PT = RT and QT = ST. Prove △PTQ ≅ △RTS and conclude PQ ∥ RS.
3. In the ASA proof, why can the image of C be at only one point once both image rays are on F's side of DE?
4. State both directions of the Perpendicular Bisector Theorem and say which one justifies "the three perpendicular bisectors of a triangle meet at a point equidistant from the vertices".
5. Two triangles have two pairs of congruent angles and one pair of congruent sides, but the side is not between the angles. Are they congruent? Why?

*Answers: (1) see the key terms. (2) PT ≅ RT, ∠PTQ ≅ ∠RTS (vertical), QT ≅ ST; SAS; then ∠QPT ≅ ∠SRT by CPCTC, and congruent alternate interior angles give PQ ∥ RS. (3) two rays from different points meet in at most one point, and F is on both. (4) on ⇒ equidistant, and equidistant ⇒ on; the first gives OA = OB = OC from O being on two bisectors; the second then puts O on the third. (5) yes, by AAS: the third angles are congruent by the angle sum, so ASA applies with the given side.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 2, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/2/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
