# Week 11 · Scale Drawings and Dilations

**Lessons:** 3.1 Scale Drawings · 3.2 Scale of the Solar System · 3.3 Measuring Dilations · 3.4 Dilating Lines and Angles
**Practices:** MP2 (reason quantitatively), MP4 (model), MP6 (precision)
**Built from:** IM Geometry, Unit 3, Lessons 1–4, in our own words
**Spiral:** rigid transformations (Unit 1) preserved distance; dilations are the first transformations that do not. Parallel lines and the angles they make (week 6) explain why a dilation preserves angles. The compass construction of a dilated point is a week-1 skill.

## What you need to be able to do

- Use a scale factor to convert between lengths in a scale drawing and real lengths, and explain how areas scale (by the factor squared).
- Build a scale model with a chosen scale factor and judge whether a scale is sensible for a given purpose.
- Define a dilation by its centre and scale factor; dilate a point using a ruler or a compass; find the scale factor from a figure and its image.
- Explain what a dilation does to a line (through the centre: fixed; not through the centre: a parallel line) and to an angle (preserved), and what it does to lengths (multiplied by the factor).

## Key terms

| Term | Meaning |
|---|---|
| Scale factor k | The number every length is multiplied by. k > 1 enlarges, 0 < k < 1 shrinks, k = 1 is the identity. |
| Scale drawing | A drawing in which every length is the real length times a fixed scale factor, and every angle is the real angle. |
| Scale | A statement of the factor, such as "1 cm : 50 km" or "1 : 500". |
| Dilation with centre O and scale factor k | The transformation sending each point P to the point P′ on ray OP with OP′ = k · OP. (For k < 0, P′ is on the opposite ray; we use k > 0 here.) |
| Centre of dilation | The one fixed point O. |
| Image under a dilation | A figure the same shape as the original, k times as large, positioned along rays from O. |

## 1. Scale drawings and scale factors

A map says "1 cm : 4 km". A road 7.5 cm long on the map is 7.5 × 4 = 30 km. A 50 km lake is 50 ÷ 4 = 12.5 cm on the map. Two rules:

- **Length in drawing = real length × k.** For 1 cm : 4 km, k = 1/400,000 when both are in the same unit (4 km = 400,000 cm); in mixed units just use the stated ratio.
- **Area in drawing = real area × k².** A region 3 cm by 2 cm on this map is 6 cm², but in reality 12 km by 8 km = 96 km², and 96 ÷ 6 = 16 = 4².

Angles do not change. A road junction at 60° on the ground is 60° on the map.

**Worked example 1.** A floor plan is drawn at 1 : 50. A room is 4.2 cm by 3.5 cm on the plan. Real dimensions: 4.2 × 50 = 210 cm = 2.1 m and 3.5 × 50 = 175 cm = 1.75 m. Real area: 2.1 × 1.75 = 3.675 m². Check through k²: plan area 14.7 cm² × 2500 = 36,750 cm² = 3.675 m² ✓.

**Worked example 2.** Two scale drawings of the same park are made, one at 1 : 200 and one at 1 : 500. A path is 15 cm long on the 1 : 200 drawing. How long is it on the other? Real length 15 × 200 = 3000 cm = 30 m; at 1 : 500 that is 3000 ÷ 500 = 6 cm. Equivalently, the factor from the first drawing to the second is 200/500 = 0.4, and 15 × 0.4 = 6.

**Try it 1.1** A model car is built at 1 : 24. The real car is 4.5 m long. How long is the model? *(Answer: 4.5 ÷ 24 = 0.1875 m ≈ 18.8 cm.)*

**Try it 1.2** A drawing at scale 1 : 10 has area 20 cm². What is the real area? *(Answer: 20 × 100 = 2000 cm².)*

## 2. Choosing a scale: the solar system

If Earth is a 1 cm marble, what is the model's scale and where is the Sun? Earth's diameter is about 12,700 km, so 1 cm : 12,700 km, or roughly 1 : 1.27 billion. The Sun's diameter (1,390,000 km) becomes 1,390,000 ÷ 12,700 ≈ 109 cm, a ball more than a metre across. The Earth–Sun distance (150 million km) becomes 150,000,000 ÷ 12,700 ≈ 11,800 cm ≈ 118 m. The marble sits more than a football field from the metre-wide Sun. That is why diagrams of the solar system are never to scale for both sizes and distances at once.

| Body | Real diameter (km) | At 1 cm Earth |
|---|---|---|
| Earth | 12,700 | 1 cm |
| Moon | 3,500 | 0.28 cm |
| Jupiter | 140,000 | 11 cm |
| Sun | 1,390,000 | 109 cm |

Choosing a scale is a modelling decision: pick k so the largest thing fits the space and the smallest thing is still visible. If neither is possible, say so.

**Worked example 3.** A hallway is 40 m long. You want a model with the Sun at one end and Neptune (4.5 billion km from the Sun) at the other. Scale: 40 m : 4,500,000,000 km. Earth's orbit (150 million km) is then 40 × 150/4500 ≈ 1.33 m from the Sun. Earth itself (12,700 km) would be 40 × 12,700 / 4,500,000,000 m ≈ 0.00011 m, a tenth of a millimetre: invisible. Distances fit; sizes do not.

**Try it 2.1** At the hallway scale, how far is Mars (228 million km) from the Sun? *(Answer: 40 × 228/4500 ≈ 2.03 m.)*

## 3. Dilations

A **dilation with centre O and scale factor k** sends each point P to the point P′ on ray OP such that OP′ = k · OP. The centre is the only fixed point (for k ≠ 1).

```
Figure description: centre O at the left. Ray from O through P continues to P′.
With k = 2, OP′ = 2 · OP, so P is the midpoint of OP′.

   O --------- P --------- P′
       OP          OP
```

**Dilating a point with a ruler.** Measure OP, multiply by k, mark P′ on ray OP at that distance.

**Dilating a point with a compass (k = 2 or 3).** Draw the circle centred at P through O; it meets ray OP again at P′ with OP′ = 2 · OP. Repeat from P′ for k = 3. For k = 1/2, construct the midpoint of OP (perpendicular bisector).

**Dilating a figure.** Dilate each vertex, then join. For triangle ABC with centre O and factor k, the image A′B′C′ has A′B′ = k · AB, B′C′ = k · BC, C′A′ = k · CA, and the same angles.

**Finding the scale factor.** k = OP′ / OP for any point P, and also k = A′B′ / AB for any segment. Both ratios must agree.

**Finding the centre.** Draw lines PP′ and QQ′ for two points; they meet at O. (If the figure and its image are the same size and parallel, there is no dilation; it is a translation.)

**Worked example 4.** Dilate A = (2, 1), B = (4, 1), C = (2, 4) with centre (0, 0) and k = 3: multiply coordinates by 3. A′ = (6, 3), B′ = (12, 3), C′ = (6, 12). AB = 2, A′B′ = 6 ✓; the right angle at A is still a right angle at A′.

**Worked example 5.** Dilate P = (7, 5) with centre O = (1, 2) and k = 1/2. The arrow from O to P is (6, 3); halve it: (3, 1.5); add to O: P′ = (4, 3.5). Check: OP = √45, OP′ = √(9 + 2.25) = √11.25 = √45 / 2 ✓.

**Worked example 6 — reading k from a figure.** O = (0, 0), P = (3, 0), P′ = (7.5, 0). k = 7.5/3 = 2.5. Then Q = (1, 2) goes to (2.5, 5).

**Try it 3.1** Dilate (−4, 6) with centre (0, 0) and k = 0.25. *(Answer: (−1, 1.5).)*

**Try it 3.2** A dilation with centre O sends segment AB of length 9 to A′B′ of length 6, and OA = 12. Find k and OA′. *(Answer: k = 2/3, OA′ = 8.)*

## 4. What a dilation does to lines and angles

**Lines through the centre** map to themselves: every point of such a line stays on it (P′ is on ray OP).

**Lines not through the centre** map to **parallel** lines. Why: take two points P and Q on line ℓ. Triangles OPQ and OP′Q′ share the angle at O and have OP′/OP = OQ′/OQ = k. In Unit 3 you will prove (SAS similarity) that this makes ∠OPQ = ∠OP′Q′, and congruent corresponding angles along transversal OP make PQ ∥ P′Q′. For now, measure and see: the image of a line is parallel, at k times the distance from O.

**Angles are preserved.** An angle is formed by two rays from a vertex V. The image rays are parallel to the originals (each lies on a line parallel to the original line), and angles with parallel sides are congruent (two applications of corresponding angles). So ∠P′V′Q′ = ∠PVQ.

**Lengths are multiplied by k**, so a dilation with k ≠ 1 is **not** a rigid transformation. Areas are multiplied by k².

| Property | Rigid transformation | Dilation (k ≠ 1) |
|---|---|---|
| Lengths | preserved | × k |
| Angles | preserved | preserved |
| Lines | to lines | to parallel lines (or themselves) |
| Area | preserved | × k² |
| Fixed points | depends | only the centre |

**Worked example 7.** A dilation with k = 2 is applied to square ABCD with side 5 and centre at vertex A. The image A′B′C′D′ has A′ = A (the centre is fixed), side 10, area 100 = 4 × 25. Side B′C′ is parallel to BC, 10 units from A instead of 5.

**Worked example 8.** Triangle PQR has angles 30°, 60°, 90° and the shortest side 4. After a dilation with k = 2.5, the angles are still 30°, 60°, 90°, the shortest side is 10, and the hypotenuse is 20 (twice the shortest side in a 30-60-90 triangle, as it was before: 8 → 20).

**Try it 4.1** Line ℓ: y = 2x + 3 is dilated from the origin by k = 3. Which line is the image? *(Answer: a parallel line, y = 2x + 9, since the y-intercept (0, 3) goes to (0, 9).)*

**Try it 4.2** Under a dilation with k = 4, the area of a figure becomes 80. What was it? *(Answer: 80 ÷ 16 = 5.)*

## Common mistakes

- **Scaling area by k instead of k².** Lengths scale once, areas twice.
- **Dilating from the wrong centre.** The centre is given; coordinates are multiplied by k only when the centre is the origin. Otherwise subtract the centre, multiply, add it back.
- **Forgetting that the centre is fixed.** If a vertex is the centre, it does not move.
- **Thinking the image of a line through the centre is parallel to it.** It is the same line.
- **Inverting a scale.** 1 : 50 means the drawing is smaller; real = drawing × 50.

## Where this goes next

Week 12 uses dilations to split a triangle's sides proportionally, defines **similar** figures as "a dilation followed by a rigid motion carries one onto the other", and asks which figures are always similar (all squares, all circles, not all rectangles). Week 13 proves the AA, SAS and SSS similarity criteria and the side-splitter theorem. Week 14 uses similar right triangles to prove the Pythagorean theorem.

## Self-check

1. A map is 1 : 25,000. Two towns are 8.4 cm apart on the map. How far apart are they in km?
2. A 1 cm Earth model: how big is the Moon (3,500 km) and how far away (384,000 km)?
3. Dilate T = (5, −2) with centre (−1, 4) and k = 3.
4. A dilation sends a line through the centre to what, and a line not through the centre to what?
5. Under a dilation with k = 1.5, a triangle's perimeter becomes 27 and its area becomes 36. Find the original perimeter and area.

*Answers: (1) 8.4 × 25,000 = 210,000 cm = 2.1 km. (2) 0.28 cm across, 384,000/12,700 ≈ 30 cm away. (3) arrow (6, −6) × 3 = (18, −18); T′ = (17, −14). (4) itself; a parallel line. (5) perimeter 18, area 36 ÷ 2.25 = 16.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 3, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/2/3/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Planetary diameters and distances are rounded public figures. Accessed 2026-10-16.*
