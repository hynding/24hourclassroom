# Week 05 · Sequences of Rigid Motions and the Start of Proof

**Lessons:** 1.17 Working with Rigid Transformations · 1.18 Practicing Point by Point Transformations · 1.19 Evidence, Angles, and Proof
**Practices:** MP3 (construct arguments), MP6 (precision), MP8 (repeated reasoning)
**Built from:** IM Geometry, Unit 1, Lessons 17–19, in our own words
**Spiral:** every transformation from weeks 3 and 4 is used in sequence; the "point by point" procedure is the template for the congruence proofs of Unit 2. The angle facts rest on the 180° rotation and on the definition of a reflection.

## What you need to be able to do

- Describe a sequence of rigid transformations that carries one figure exactly onto another, naming each transformation precisely (mirror line, arrow, centre and angle).
- Use the point-by-point method: translate to match one vertex, rotate to match a second, reflect across the matched side if the third is on the wrong side.
- State the transformation definition of congruence and explain why a sequence of rigid motions proves two figures congruent.
- Tell the difference between evidence (measuring, "it looks like") and proof (a chain of statements each justified by a definition or an earlier fact).
- Define and use linear pairs, supplementary and complementary angles, and vertical angles; prove the vertical angle theorem.

## Key terms

| Term | Meaning |
|---|---|
| Sequence (composition) of transformations | Applying one transformation, then another to the result. |
| Congruent figures | Two figures are congruent if there is a sequence of rigid transformations that carries one exactly onto the other. Written △ABC ≅ △DEF, with vertices in corresponding order. |
| Corresponding parts | Vertices, sides or angles matched by the sequence: A ↔ D, AB ↔ DE, ∠B ↔ ∠E. |
| Evidence | Measurements or examples that make a claim plausible. They cannot prove a claim is always true. |
| Proof | A chain of statements, each justified by a definition, a postulate, or a previously proved result, that establishes a claim for every case. |
| Conjecture | A claim you believe from evidence but have not proved. |
| Theorem | A claim that has been proved. |
| Linear pair | Two angles that share a vertex and a side and whose other sides form a straight line. Their measures sum to 180°. |
| Supplementary angles | Two angles whose measures add to 180° (they need not be adjacent). |
| Complementary angles | Two angles whose measures add to 90°. |
| Vertical angles | The two non-adjacent angles formed when two lines cross. They are congruent. |

## 1. Carrying one figure onto another

Two triangles look congruent. To *show* it, you must name a sequence of rigid transformations that lands one exactly on the other. "Slide it over and turn it a bit" is not a sequence; "translate by the directed segment from A to D, then rotate about D by 40° counter-clockwise" is.

**Worked example 1.** Triangle ABC with A = (0, 0), B = (3, 0), C = (0, 2). Triangle DEF with D = (5, 1), E = (5, 4), F = (3, 1). Find a sequence carrying ABC onto DEF with A → D, B → E, C → F.

Step 1, translate A to D: by the arrow (5, 1). Images: A₁ = (5, 1), B₁ = (8, 1), C₁ = (5, 3).
Step 2, rotate about D to send B₁ to E: B₁ is 3 units to the right of D, E is 3 units above D. A 90° counter-clockwise rotation about D does it. Rotating (x, y) about (5, 1) by 90° counter-clockwise: subtract the centre, apply (x, y) → (−y, x), add the centre. C₁ − D = (0, 2) → (−2, 0) → + D = (3, 1) = F. ✓
So: translate by (5, 1), then rotate 90° counter-clockwise about D. Two steps, every vertex checked.

**Worked example 2 — when a reflection is needed.** Same ABC; now G = (5, 1), H = (5, 4), I = (7, 1). After the same translation and rotation, C lands at (3, 1), but I = (7, 1) is on the *other* side of line GH (the vertical line x = 5). Reflect across line GH (x = 5): (3, 1) → (7, 1) = I ✓, and G, H are on the mirror so they stay. Three steps.

**Try it 1.1** Describe a sequence that carries the segment from (0, 0) to (0, 4) onto the segment from (2, 2) to (6, 2). *(Answer: for example, rotate 90° clockwise about the origin to get (0, 0) to (4, 0), then translate by (2, 2). Many answers are correct; check the endpoints.)*

## 2. The point-by-point method

For triangles ABC and DEF known to have AB = DE, BC = EF, CA = FD:

1. **Translate** by the directed segment from A to D. Now A is on D.
2. **Rotate** about D by the angle from ray DB₁ to ray DE. Because AB = DE, the image of B lands exactly on E (both are DE from D on the same ray).
3. **Check C.** The image C₂ is at distance DF from D and EF from E, just like F. Only two points in the plane have those two distances (the two intersections of the circle at D of radius DF and the circle at E of radius EF). If C₂ = F, done. If not, C₂ is the reflection of F across line DE, so **reflect** across DE.

This procedure is the heart of the proof that three equal sides force congruence (SSS, Unit 2). The reason step 3 works is the week-1 fact: two circles cross in at most two points, mirror images of each other across the line of centres.

**Worked example 3.** Why, in step 2, does B land exactly on E and not just on the ray DE? After translation, DB₁ = AB (translations preserve length). After rotation, DB₂ = DB₁ = AB = DE, and B₂ is on ray DE. The only point on ray DE at distance DE from D is E.

**Try it 2.1** Triangles PQR and XYZ have PQ = XY = 5, QR = YZ = 7, RP = ZX = 9. After translating P to X and rotating so Q lands on Y, R lands at a point 9 from X and 7 from Y. How many such points are there, and how are they related? *(Answer: two, mirror images across line XY; if R did not land on Z, one reflection across XY finishes.)*

## 3. Congruence by rigid motions

**Definition.** Two figures are **congruent** if there is a sequence of rigid transformations that takes one onto the other.

Because rigid transformations preserve lengths and angles, congruent figures have all corresponding sides and angles congruent. The order of letters in △ABC ≅ △DEF records the correspondence: A ↔ D, B ↔ E, C ↔ F, so AB ≅ DE, ∠C ≅ ∠F, and so on. Writing △ABC ≅ △EFD would be a different (and here false) claim.

**Worked example 4.** △ABC ≅ △RST, with AB = 7, BC = 4, ∠A = 30°. What is RS? ST? ∠R? RS = AB = 7, ST = BC = 4, ∠R = ∠A = 30°. And ∠T = ∠C, whatever that is.

**Try it 3.1** Is a square with side 3 congruent to a rhombus with side 3 and a 60° angle? *(Answer: no; rigid motions preserve angles, and the square has 90° angles. Equal sides are not enough for quadrilaterals.)*

## 4. Evidence versus proof

Measuring a few examples is **evidence**. If you measure the angles of five triangles and each sums to 180°, you have a good conjecture, not a theorem; the sixth might differ, and measuring is never exact anyway. A **proof** explains why the claim holds in every case: each statement follows from a definition, an accepted fact, or an earlier statement.

What may you use as justification?

- Definitions (circle, reflection, perpendicular bisector, linear pair …).
- Properties of rigid transformations (they preserve distance and angle; a 180° rotation about O sends every line through O to itself …).
- Theorems already proved (from this point on, each week adds some).
- Facts about angle measure: angles on a straight line sum to 180°; angle measures add when angles are adjacent.

What may you not use? "It looks like." "I measured." "It worked for my example." Those are evidence.

**Worked example 5 — a claim and its status.** Claim: "the diagonals of a rectangle are congruent." A student draws three rectangles and measures: evidence. A proof: reflect across the line through the midpoints of the two longer sides; it carries the rectangle onto itself and sends diagonal AC onto diagonal BD (A ↔ B, C ↔ D), and reflections preserve length. That is a proof, using the rectangle's symmetry (week 4) and the definition of a rigid transformation.

## 5. Angle facts and the first proofs

**Linear pair.** If rays VA and VB point in opposite directions (A, V, B collinear) and VC is any other ray, then ∠AVC and ∠CVB form a linear pair and ∠AVC + ∠CVB = 180°.

```
Figure description: line through A, V, B with V between. Ray VC goes up from V.
∠AVC and ∠CVB together make the straight angle AVB.

          C
          |
    A-----V-----B
```

**Vertical angles.** Lines AB and CD cross at V. ∠AVC and ∠BVD are vertical angles; so are ∠AVD and ∠CVB.

```
Figure description: lines AB and CD crossing at V.
A upper-left, B lower-right; C upper-right, D lower-left.

    A       C
      \   /
        V
      /   \
    D       B
```

**Theorem (vertical angles).** Vertical angles are congruent.

*Proof 1 (linear pairs).* ∠AVC + ∠CVB = 180° (linear pair along line AB). ∠CVB + ∠BVD = 180° (linear pair along line CD). So ∠AVC + ∠CVB = ∠CVB + ∠BVD, and subtracting ∠CVB from both sides gives ∠AVC = ∠BVD.

*Proof 2 (rotation).* Rotate the figure 180° about V. A 180° rotation sends each line through V to itself and swaps the two rays of each line: ray VA → ray VB and ray VC → ray VD. So ∠AVC → ∠BVD. Rotations preserve angle measure, so ∠AVC = ∠BVD.

Both proofs are valid. Proof 1 uses only arithmetic on a straight angle; proof 2 uses what we know about rotations. You should be able to write either.

**Worked example 6.** Lines cross at V. ∠AVC = (3x + 10)° and its vertical angle ∠BVD = (5x − 30)°. Find x and the four angles. Vertical angles are congruent: 3x + 10 = 5x − 30, so 2x = 40, x = 20. ∠AVC = ∠BVD = 70°. The other pair: 180 − 70 = 110° each. Check: 70 + 110 + 70 + 110 = 360 ✓.

**Worked example 7.** Two angles are complementary and one is 4 times the other. Find them. x + 4x = 90, x = 18: the angles are 18° and 72°.

**Try it 5.1** ∠1 and ∠2 form a linear pair and ∠1 = 2∠2 + 15°. Find both. *(Answer: 2∠2 + 15 + ∠2 = 180, ∠2 = 55°, ∠1 = 125°.)*

**Try it 5.2** Explain why two angles that are both supplementary to the same angle are congruent to each other. *(Answer: each equals 180° minus the common angle.)*

## Common mistakes

- **Describing a transformation vaguely.** "Rotate it" needs a centre, angle and direction. "Reflect it" needs the line.
- **Matching vertices in the wrong order.** If the sequence sends A to E, write △ABC ≅ △E… accordingly; the labels carry the correspondence.
- **Forgetting the possible final reflection.** After matching two vertices, the third can still be on the wrong side.
- **Treating measurements as proof.** Measurements support a conjecture; a proof needs justified statements.
- **Confusing supplementary with linear pair.** Every linear pair is supplementary, but supplementary angles need not be adjacent.

## Where this goes next

Week 6 proves the facts about parallel lines cut by a transversal (alternate interior angles, corresponding angles) with a 180° rotation about the midpoint of the transversal segment, and then the big one: the angles of a triangle sum to 180°. That closes Unit 1. Unit 2 turns the point-by-point method into the triangle congruence criteria (SAS, ASA, SSS) and the proofs that use them.

## Self-check

1. Give a precise sequence of rigid transformations carrying the segment from (1, 1) to (1, 5) onto the segment from (4, 0) to (8, 0), with (1, 1) → (4, 0).
2. △KLM ≅ △NOP with KL = 6, LM = 8, ∠M = 40°. State NO, OP and ∠P.
3. Two lines cross and one of the angles formed is 37°. Give the other three.
4. ∠A and ∠B are supplementary and ∠A = ∠B − 48°. Find both.
5. A student says "I measured the vertical angles in four drawings and they were equal each time, so vertical angles are always congruent." Is this a proof? What would be?

*Answers: (1) rotate 90° clockwise about (1, 1): (1, 5) → (5, 1); then translate by (3, −1): (1, 1) → (4, 0), (5, 1) → (8, 0). (2) NO = 6, OP = 8, ∠P = 40°. (3) 37°, 143°, 143°. (4) ∠B = 114°, ∠A = 66°. (5) no, evidence only; a proof uses linear pairs (both angles are 180° minus the same angle) or a 180° rotation about the crossing point.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 1, Lessons 17–19, https://im.kendallhunt.com/HS/teachers/2/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
