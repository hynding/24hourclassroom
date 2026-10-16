# Week 13 · Triangle Similarity Criteria

**Lessons:** 3.9 Conditions for Triangle Similarity · 3.10 Other Conditions for Triangle Similarity · 3.11 Splitting Triangle Sides with Dilation, Part 2 · 3.12 Practice With Proportional Relationships
**Practices:** MP1 (make sense and persevere), MP3 (construct arguments), MP7 (structure)
**Built from:** IM Geometry, Unit 3, Lessons 9–12, in our own words
**Spiral:** the three similarity criteria are the three congruence criteria of Unit 2 with "congruent sides" replaced by "proportional sides"; each proof is "dilate, then cite the congruence criterion". The triangle angle sum (week 6) is why two angles are enough. Parallel-line angle facts justify the side-splitter theorem and its converse.

## What you need to be able to do

- State and prove the Angle-Angle (AA) similarity criterion.
- State SAS∼ and SSS∼, explain how each proof goes, and decide which criterion a given situation calls for.
- Prove the side-splitter theorem and its converse (a segment that cuts two sides proportionally is parallel to the third side).
- Solve for unknown lengths in nested, overlapping and bow-tie similar-triangle figures, and in indirect-measurement problems (shadows, mirrors, river widths).

## Key terms

| Term | Meaning |
|---|---|
| AA criterion | Two triangles with two pairs of congruent angles are similar. |
| SAS∼ criterion | Two pairs of sides in the same ratio with the included angles congruent ⇒ similar. |
| SSS∼ criterion | Three pairs of sides all in the same ratio ⇒ similar. |
| Side-splitter theorem | A line parallel to one side of a triangle that meets the other two sides divides them proportionally. |
| Converse of the side-splitter theorem | If a segment with endpoints on two sides divides them proportionally (AD/DB = AE/EC), it is parallel to the third side. |
| Nested triangles | A small triangle sharing a vertex and two side-directions with a larger one (the side-splitter picture). |
| Bow-tie triangles | Two triangles meeting at a shared vertex with a pair of vertical angles there; similar when one more angle pair matches (for example from a pair of parallel sides). |

## 1. AA: two angles are enough

**Theorem (AA).** If ∠A ≅ ∠D and ∠B ≅ ∠E, then △ABC ∼ △DEF.

**Proof.** Let k = DE/AB and dilate △ABC from A by k. The image △AB′C′ has AB′ = DE, and dilations preserve angles, so ∠A and ∠B′ still equal ∠D and ∠E. Now △AB′C′ and △DEF have two angles and the included side congruent: ASA gives △AB′C′ ≅ △DEF. A rigid motion carries △AB′C′ onto △DEF, and the dilation followed by that rigid motion carries △ABC onto △DEF. ∎

Why not call it AAA? Because the third angle is forced by the 180° angle sum; stating three is redundant.

**Where equal angles come from.** Shared angles (a vertex common to both triangles); vertical angles (bow-tie); corresponding or alternate interior angles of parallel lines; right angles; angles marked equal in the figure; inscribed angles later in Unit 7.

**Worked example 1 (nested).** In △ABC, D is on AB and E is on AC with ∠ADE = ∠ABC. Then △ADE ∼ △ABC by AA (shared angle A, the given equal angles), with correspondence A ↔ A, D ↔ B, E ↔ C. If AD = 6, AB = 15, AE = 8, then AC = 8 × 15/6 = 20.

**Worked example 2 (bow-tie).** AB ∥ CD, and segments AD and BC cross at O. ∠AOB = ∠DOC (vertical) and ∠OAB = ∠ODC (alternate interior). So △OAB ∼ △ODC with A ↔ D, B ↔ C. If OA = 4, OD = 10, OB = 5, then OC = 5 × 10/4 = 12.5. The correspondence matters: OB pairs with OC, not with OD.

**Worked example 3 (right triangles).** In right triangle ABC with the right angle at C, the altitude from C meets AB at H. △ACH and △ABC share ∠A and both have a right angle, so △ACH ∼ △ABC. Likewise △CBH ∼ △ABC. So all three triangles are similar; next week this proves the Pythagorean theorem.

**Try it 1.1** Two triangles have angles 35°, 80°, 65° and 65°, 35°, 80°. Similar? *(Answer: yes, AA; any two matching angles do it.)*

**Try it 1.2** Triangle with angles 40° and 70°; another with angles 70° and 70°. Similar? *(Answer: yes: the first has angles 40, 70, 70 too.)*

## 2. SAS∼ and SSS∼

**Theorem (SAS∼).** If AB/DE = AC/DF and ∠A ≅ ∠D, then △ABC ∼ △DEF.
**Proof.** Dilate △ABC from A by k = DE/AB. The image has AB′ = DE and AC′ = k · AC = (DE/AB) · AC = DF (because AC/DF = AB/DE). The angle at A is preserved. SAS congruence makes the image congruent to △DEF. ∎

**Theorem (SSS∼).** If AB/DE = BC/EF = CA/FD, then △ABC ∼ △DEF.
**Proof.** Dilate by k = DE/AB; all three image sides equal the sides of △DEF; SSS. ∎

**Which one to use.** Count what you know.

| You know | Use |
|---|---|
| Two angle pairs | AA |
| Two side ratios equal and the angle between them | SAS∼ |
| Three side ratios equal | SSS∼ |
| Two side ratios equal, angle not between | nothing (SSA∼ fails, like SSA) |
| Three angles... | AA; the third is automatic |

**Worked example 4.** △ABC has AB = 6, AC = 9, ∠A = 50°. △DEF has DE = 4, DF = 6, ∠D = 50°. Ratios: 6/4 = 1.5 and 9/6 = 1.5, included angles equal. SAS∼ with k = 1.5 from DEF to ABC. BC = 1.5 · EF.

**Worked example 5.** Sides 4, 6, 7 and 6, 9, 10.5. Ratios 1.5, 1.5, 1.5. SSS∼. Sides 4, 6, 7 and 6, 9, 10? Ratios 1.5, 1.5, 1.43: not similar.

**Worked example 6 (a trap).** △ABC with AB = 8, BC = 6, ∠A = 40°; △DEF with DE = 4, EF = 3, ∠D = 40°. The ratios match (2 and 2) but the angle at A is not between AB and BC. This is SSA, which is not a criterion: with DE = 4, ∠D = 40° and EF = 3, two different triangles are possible (3 is between 4 sin 40° ≈ 2.57 and 4), and only one of them is similar to △ABC. Do not cite a criterion that does not exist; find a second angle or the included angle instead.

**Try it 2.1** △PQR: PQ = 10, PR = 15, ∠P = 30°. △XYZ: XY = 4, XZ = 6, ∠X = 30°. Similar? Criterion? *(Answer: yes, SAS∼, k = 2.5.)*

**Try it 2.2** Sides 3, 5, 6 and 9, 15, 18. *(Answer: SSS∼, k = 3.)*

## 3. The side-splitter theorem and its converse

**Theorem.** In △ABC with D on AB and E on AC, if DE ∥ BC then AD/DB = AE/EC (and AD/AB = AE/AC = DE/BC).
**Proof via AA.** ∠ADE = ∠ABC (corresponding angles, DE ∥ BC) and ∠A is shared, so △ADE ∼ △ABC and AD/AB = AE/AC = DE/BC. The pieces version follows by algebra (week 12). ∎

**Converse.** If AD/DB = AE/EC (equivalently AD/AB = AE/AC), then DE ∥ BC.
**Proof.** AD/AB = AE/AC and the shared angle A give △ADE ∼ △ABC by SAS∼. So ∠ADE = ∠ABC. These are corresponding angles for lines DE and BC with transversal AB, and congruent corresponding angles force DE ∥ BC (converse from week 6). ∎

**Worked example 7.** In △ABC, AD = 9, DB = 6, AE = 12, EC = 8. Is DE ∥ BC? 9/6 = 1.5 and 12/8 = 1.5: yes, by the converse. If instead EC = 9: 12/9 = 1.33 ≠ 1.5, so no.

**Worked example 8 (three parallels).** Three parallel lines cut two transversals: the first transversal in segments 4 and 6, the second in segments x and 9. Draw a diagonal to make two side-splitter triangles: x/9 = 4/6, x = 6. (Or x/4 = 9/6.) Parallel lines cut all transversals proportionally.

**Try it 3.1** AD = 5, DB = 7, AE = 10. What EC makes DE ∥ BC? *(Answer: 14.)*

## 4. Proportional relationships in practice

**Shadows.** A 1.8 m person casts a 2.4 m shadow at the same moment a flagpole casts a 12 m shadow. The sun's rays are parallel, so the two triangles (object, shadow, ray) have equal angles: AA. Height/shadow is the same ratio: h/12 = 1.8/2.4, h = 9 m.

**Mirror on the ground.** A mirror lies 3 m from the base of a wall; you stand 1.5 m from the mirror and your eyes are 1.6 m high, and you see the top of the wall in the mirror. Angle of incidence equals angle of reflection, and both triangles have a right angle at the ground: AA. Wall height/3 = 1.6/1.5, wall = 3.2 m.

**River width.** Sight across a river from A to a tree T directly opposite. Walk 40 m along the bank to B, then 10 m further to C. Walk inland from C, perpendicular to the bank, until T and B line up at D, and measure CD = 15 m. Then △ABT ∼ △CBD (right angles at A and C, vertical angles at B), so AT/CD = AB/CB: AT = 15 × 40/10 = 60 m.

**Worked example 9 (overlapping, not nested).** Triangles ABC and ABD share side AB; ∠ACB = ∠ABD and they share ∠A. Then △ACB ∼ △ABD (A ↔ A, C ↔ B, B ↔ D), so AC/AB = AB/AD, i.e. AB² = AC · AD. With AC = 16 and AD = 4, AB = 8. Writing the correspondence in letter order is the only safe way through these.

**Try it 4.1** A 2 m stick casts a 3.5 m shadow; a tree casts 21 m. Tree height? *(Answer: 12 m.)*

## Common mistakes

- **Citing "SSA∼" or "AAA" as if they were criteria.** AA is enough; SSA is nothing.
- **Pairing sides wrongly in a bow-tie.** The vertical angle is at O in both triangles, but the other vertices are swapped: OA ↔ OD, OB ↔ OC when AB ∥ CD.
- **Using AD/DB for DE/BC.** Still the number-one error.
- **Assuming lines are parallel** because they look it. Check the ratio (converse) or an angle fact.
- **Forgetting the shared angle** as one of the two for AA.

## Where this goes next

Week 14 uses the altitude-on-hypotenuse similar triangles to prove the Pythagorean theorem, then solves for every unknown in right and non-right triangles, and finishes with the "bank shot" modelling task where reflection and similar triangles meet. Unit 4 defines the trigonometric ratios as side ratios in similar right triangles, which is why this week's AA criterion is the foundation of trigonometry.

## Self-check

1. Two triangles have angles 48°, 57° and 75°, 48°. Similar? Why?
2. △ABC: AB = 12, BC = 18, ∠B = 70°. △DEF: DE = 8, EF = 12, ∠E = 70°. Criterion and k?
3. AD = 7, DB = 3, AE = 14. Find EC so that DE ∥ BC, and find DE/BC.
4. AB ∥ CD with AD and BC crossing at O; OA = 6, OB = 9, OC = 6. Find OD.
5. A 1.5 m post casts a 2 m shadow while a building casts 30 m. Building height?

*Answers: (1) Yes: third angles are 75° and 57°, so two pairs match (AA). (2) SAS∼, k = 2/3 from ABC to DEF. (3) EC = 6; DE/BC = 7/10. (4) OB/OC = OA/OD gives 9/6 = 6/OD, OD = 4. (5) 22.5 m.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 3, Lessons 9–12, https://im.kendallhunt.com/HS/teachers/2/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
