# Week 27 · Circumscribed Circles, the Incentre and Inscribed Circles

**Lessons:** 7.5 Triangles in Circles · 7.6 A Special Point · 7.7 Circles in Triangles
**Practices:** MP3 (construct arguments), MP5 (use tools strategically), MP7 (use structure)
**Built from:** IM Geometry, Unit 7, Lessons 5–7, in our own words
**Spiral:** the two theorems that carry this week were proved in Unit 2: the Perpendicular Bisector Theorem (week 8) and the angle bisector theorem in its distance form (week 10). Week 25 found a circumcentre with coordinates; this week proves that the construction always works and adds its twin, the incentre. Tangent ⊥ radius (week 26) is what makes the inscribed circle touch the sides. The 30-60-90 triangle (week 15) gives exact radii for equilateral triangles.

## What you need to be able to do

- Prove that the three perpendicular bisectors of a triangle meet at one point (the circumcentre), construct the circumscribed circle, and say where the centre lies for acute, right and obtuse triangles.
- Prove that a point is on an angle's bisector exactly when it is equidistant from the angle's two sides, and use it to prove that the three angle bisectors of a triangle meet at one point (the incentre).
- Construct the inscribed circle of a triangle, explain why it is tangent to all three sides, and compute the inradius from the area and the perimeter.
- Choose the right centre for a situation: equidistant from three points (circumcentre) versus equidistant from three lines (incentre).

## Key terms

| Term | Meaning |
|---|---|
| Circumscribed circle (circumcircle) | The circle through all three vertices of a triangle. Its centre is the circumcentre, its radius the circumradius R. |
| Circumcentre | The common point of the three perpendicular bisectors; equidistant from the vertices. |
| Distance from a point to a line | The length of the perpendicular segment from the point to the line. |
| Incentre | The common point of the three angle bisectors; equidistant from the three sides. |
| Inscribed circle (incircle) | The circle centred at the incentre tangent to all three sides. Its radius is the inradius r. |
| Semiperimeter | Half the perimeter, s = (a + b + c)/2. |

## 1. Triangles in circles: every triangle has a circumscribed circle (7.5)

Given three points not on a line, is there a circle through all three? Week 9's construction said yes; here is the proof.

**Theorem.** The perpendicular bisectors of the sides of a triangle meet at one point, and that point is equidistant from the three vertices.

*Proof.* Let the perpendicular bisectors of AB and BC meet at S. (They do meet: they are perpendicular to AB and BC, which are not parallel, so the bisectors are not parallel either.) By the Perpendicular Bisector Theorem, S on the bisector of AB gives SA = SB, and S on the bisector of BC gives SB = SC. So SA = SC, and by the converse of the theorem S lies on the perpendicular bisector of AC as well. The circle centred at S with radius SA passes through A, B and C. ∎

**Construction.** Construct the perpendicular bisectors of two sides (week 1); mark their intersection S; set the compass to SA and draw.

**Where the centre is.**

| Triangle | Circumcentre |
|---|---|
| acute | inside |
| right | the midpoint of the hypotenuse (the hypotenuse is a diameter: angle in a semicircle) |
| obtuse | outside, beyond the longest side |

```
Figure description: triangle ABC with the perpendicular bisectors of AB
and BC drawn as dashed lines meeting at S inside the triangle; a circle
centred at S passes through A, B and C.

              C
             / \
            /   \     S = circumcentre
           /  S  \
          /       \
         A─────────B
```

**Worked example 1 — a right triangle.** Legs 6 and 8, hypotenuse 10. The circumcentre is the midpoint of the hypotenuse and R = 5. (Compare week 25: for (0, 0), (6, 0), (0, 8) the circumcentre was (3, 4), 5 from each vertex.)

**Worked example 2 — an equilateral triangle.** Side 12. Each perpendicular bisector is also a median and an angle bisector; the centre is 2/3 of the way along a median from a vertex. The height is 6√3 (a 30-60-90 triangle with hypotenuse 12 and short leg 6), so R = (2/3)(6√3) = 4√3 ≈ 6.93. In general R = s/√3 = s√3/3 for side s.

**Worked example 3 — choosing the centre.** A town wants a fire station equally far from three villages that are not in a line. The three villages are points; "equidistant from three points" is the circumcentre of the triangle they form. If the triangle is obtuse the station ends up outside it.

**Worked example 4 — why three points determine one circle.** Two different circles can share at most two points: if they shared three, both centres would be on all three perpendicular bisectors, which meet at only one point, so the centres (and then the radii) would coincide.

**Try it 1.1** A right triangle has legs 9 and 12. Find its circumradius. *(Answer: hypotenuse 15, R = 7.5.)*

**Try it 1.2** Where is the circumcentre of a triangle with angles 30°, 40°, 110°? *(Answer: outside the triangle; it is obtuse.)*

## 2. A special point: the angle bisector as a locus (7.6)

The **distance from a point to a line** is measured along the perpendicular.

**Theorem.** A point is on the bisector of an angle if and only if it is the same distance from the two sides of the angle.

*Proof (on the bisector ⇒ equidistant).* Let P be on the bisector of ∠AVB, and drop perpendiculars from P to the two sides, meeting them at X and Y. Triangles PVX and PVY have right angles at X and Y, equal angles at V (the bisector halves the angle), and the shared side PV. By AAS they are congruent, so PX = PY. ∎
*(Equidistant ⇒ on the bisector.)* If PX = PY with X, Y the perpendicular feet, triangles PVX and PVY are right triangles with the common hypotenuse PV and congruent legs, so they are congruent by HL, giving ∠PVX = ∠PVY: VP bisects the angle. ∎

(Week 10 proved this as "bisect it"; now it becomes the engine of a concurrency theorem.)

**Theorem.** The three angle bisectors of a triangle meet at one point, the **incentre**, which is equidistant from the three sides.

*Proof.* Let the bisectors of ∠A and ∠B meet at I (they do meet, inside the triangle). I on the bisector of ∠A means I is equidistant from sides AB and AC. I on the bisector of ∠B means I is equidistant from AB and BC. So I is equidistant from AC and BC, and by the converse it lies on the bisector of ∠C too. ∎

**The salt-pile picture.** Pour salt onto a cardboard triangle until it stops piling. Each grain slides toward the nearest edge, so grains exactly as far from two edges as from each other stay put: ridges form along the angle bisectors, and they meet at a peak above the incentre.

**Worked example 5 — where is the incentre?** Always inside the triangle (the bisectors of interior angles run into the interior), unlike the circumcentre.

**Worked example 6 — using the locus.** P is on the bisector of ∠AVB and is 4 cm from side VA. Then P is also 4 cm from side VB: no further work.

**Worked example 7 — angles at the incentre.** In triangle ABC with ∠A = 70° and ∠B = 50°, the incentre I makes ∠AIB = 180° − 35° − 25° = 120°. In general ∠AIB = 90° + ½∠C: here 90° + 30° = 120° ✓.

**Try it 2.1** Triangle with ∠A = 40°, ∠B = 60°, ∠C = 80°. Find ∠BIC where I is the incentre. *(Answer: 180° − 30° − 40° = 110°, which is 90° + ½ · 40°.)*

## 3. Circles in triangles: the inscribed circle (7.7)

**Construction.** Bisect two angles to find I. Drop a perpendicular from I to any side, meeting it at F. Draw the circle centred at I with radius IF.

**Why it is tangent to all three sides.** IF is perpendicular to the side at F, and a line perpendicular to a radius at a point of the circle is tangent (week 26). I is the same distance from the other two sides, so the perpendiculars to them also have length r and the circle touches them as well.

**The inradius from area and perimeter.** Join I to the three vertices. The triangle splits into three triangles with bases a, b, c and the same height r (the distance from I to each side). So

Area = ½ar + ½br + ½cr = ½(a + b + c)r = **s · r**, where s is the semiperimeter.

**r = Area / s.**

```
Figure description: triangle ABC with incentre I inside. Segments IA, IB,
IC split it into three triangles; from I, perpendiculars of length r drop
to each side. Each small triangle has area ½(side)(r).

              C
             /|\
            / | \
           /  I  \      r = distance from I to each side
          / /   \ \
         A─────────B
```

**Worked example 8.** A 3-4-5 triangle: area 6, s = 6, r = 1.

**Worked example 9.** A 5-12-13 triangle: area 30, s = 15, r = 2. (For any right triangle with legs a, b and hypotenuse c, r = (a + b − c)/2: here (5 + 12 − 13)/2 = 2 ✓.)

**Worked example 10 — equilateral.** Side 12: area = (√3/4)(144) = 36√3, s = 18, r = 2√3 ≈ 3.46. Compare R = 4√3 from Worked example 2: in an equilateral triangle the circumradius is exactly twice the inradius, and the two centres coincide.

**Worked example 11 — a non-right triangle.** Sides 13, 14, 15: s = 21, area = √(21 · 8 · 7 · 6) = √7056 = 84 (Heron's formula, or drop the height 12 onto the side 14). r = 84/21 = 4.

**Worked example 12 — which circle?** A triangular garden needs the largest possible circular pond. The pond touches the three edges: the inscribed circle, centre at the incentre, radius Area/s. A sprinkler that must reach all three corners at once needs the circumscribed circle instead.

| Want | Use | Centre | Lines to construct |
|---|---|---|---|
| circle through the vertices | circumcircle | circumcentre | perpendicular bisectors |
| circle tangent to the sides | incircle | incentre | angle bisectors |

**Try it 3.1** A triangle has sides 7, 15, 20 and area 42. Find its inradius. *(Answer: s = 21, r = 2.)*

**Try it 3.2** A right triangle has legs 8 and 15. Find its inradius. *(Answer: hypotenuse 17, area 60, s = 20, r = 3; or (8 + 15 − 17)/2 = 3.)*

## Common mistakes

- **Mixing up the two centres.** Perpendicular bisectors → circumcentre → equidistant from *vertices*. Angle bisectors → incentre → equidistant from *sides*.
- **Measuring the distance to a side along a slant.** It is always the perpendicular distance.
- **Expecting the circumcentre inside every triangle.** It leaves the triangle as soon as an angle passes 90°.
- **Using the full perimeter in Area = sr.** s is the semiperimeter.
- **Forgetting that an angle bisector's foot is not the side's midpoint** (except in an isosceles triangle from the apex).
- **Claiming SSA for the HL step.** The converse of the angle bisector locus uses HL, which needs the right angle.

## Where this goes next

Week 28 measures circles: arc length and sector area as fractions of the circumference and area, then the observation that arc length divided by radius depends only on the angle, which becomes the radian. The incircle and circumcircle return in Unit 7's exam and in the final, often combined with the inscribed angle and tangent theorems.

## Self-check

1. Where is the circumcentre of a right triangle, and why?
2. P is on the bisector of ∠XYZ and is 6 units from ray YX. How far is it from ray YZ?
3. Prove in two lines that the incentre is equidistant from all three sides.
4. Find the inradius of a triangle with sides 10, 10, 12.
5. Which centre is equidistant from the three *vertices* of a triangle, and which lines meet there?

*Answers: (1) the midpoint of the hypotenuse: the right angle is inscribed in a semicircle, so the hypotenuse is a diameter. (2) 6. (3) On the bisector of ∠A it is equidistant from AB and AC; on the bisector of ∠B it is equidistant from AB and BC; so it is equidistant from all three. (4) height 8, area 48, s = 16, r = 3. (5) the circumcentre, where the perpendicular bisectors meet.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 7, Lessons 5–7, https://im.kendallhunt.com/HS/teachers/2/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
