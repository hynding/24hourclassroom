# Week 01 · Compass, Straightedge and the Definition of a Circle

**Lessons:** 1.1 Build It · 1.2 Constructing Patterns · 1.3 Construction Techniques 1: Perpendicular Bisectors · 1.4 Construction Techniques 2: Equilateral Triangles
**Practices:** MP5 (use tools strategically), MP6 (attend to precision), MP3 (construct arguments)
**Built from:** IM Geometry, Unit 1, Lessons 1–4, in our own words
**Spiral:** none yet; this is week 1. You will lean on middle-school ideas: what a circle is, what "congruent" means informally, and how to name points, segments and angles.

## What you need to be able to do

- Use a compass and a straightedge (no ruler markings, no protractor) to copy a segment and to draw a circle through a given point, and explain why the compass is the right tool for "same distance".
- Build a pattern of overlapping circles (the six-petal "daisy") and recognise the equilateral triangles, rhombuses and regular hexagons hiding inside it.
- Construct the perpendicular bisector of a segment and explain, using the definition of a circle, why every point on it is the same distance from both endpoints.
- Construct an equilateral triangle on a given segment and justify, step by step, why all three sides are congruent.

## Key terms

| Term | Meaning |
|---|---|
| Circle | The set of all points in a plane at a fixed distance (the **radius**) from a fixed point (the **centre**). Euclid, Definition 15: "A circle is a plane figure contained by one line such that all the straight lines falling upon it from one point … are equal." |
| Radius | Either the fixed distance, or any segment from the centre to a point on the circle. Every radius of one circle is the same length. |
| Straightedge | A tool for drawing the line through two points. It has no marks, so it cannot measure. |
| Compass | A tool for drawing a circle with a chosen centre and a chosen radius, or for copying a distance. |
| Construction | A figure built only from circles and lines, each one determined by points you already have. No guessing, no measuring. |
| Congruent segments | Segments of the same length. Written AB ≅ CD; the lengths are written AB = CD. |
| Perpendicular bisector | The line through the midpoint of a segment at a right angle to it. Every point on it is equidistant from the two endpoints. |
| Equidistant | The same distance from two or more things. |
| Equilateral triangle | A triangle with three congruent sides. |
| Regular hexagon | A six-sided polygon with all sides congruent and all angles congruent. |

## 1. Why a compass is a "same distance" machine

A ruler measures; a compass remembers. When you set the compass to the length of segment AB and draw a circle centred at A, every point on that circle is exactly AB away from A, because that is what a circle is. This is the one idea the whole unit rests on:

> **If two points are on the same circle, they are the same distance from the centre.**

Every construction you will ever do is a chain of these statements. You never say "it looks the same length"; you say "both are radii of the circle centred at A, so they are equal".

**Worked example 1 — copying a segment.** You are given segment AB and a ray starting at point P. Place a point Q on the ray so that PQ = AB.

1. Open the compass to the distance AB (point on A, pencil on B).
2. Without changing the opening, put the point on P and draw an arc that crosses the ray. Call the crossing Q.
3. Justification: Q is on the circle centred at P with radius AB, so PQ = AB.

Three steps, and the reason for the result is the definition of a circle. Notice what you did **not** do: you did not read a number off a ruler.

**Try it 1.1** You have segment CD of unknown length and a long line ℓ with a point R on it. Describe how to mark points S and T on ℓ, one on each side of R, so that SR = RT = CD. *(Answer: set the compass to CD; with the point on R, draw a full circle; it meets ℓ twice, at S and T; both are radii, so SR = RT = CD.)*

## 2. The daisy pattern and what it contains

Draw a circle with centre O and radius r. Pick a point A on it. Keeping the same opening r, put the point on A and draw a circle; it crosses the first circle at two points, B and F. Now centre at B with the same radius: it crosses the original circle at A and at a new point C. Keep going around: C gives D, D gives E, E gives F. Six circles, six points A, B, C, D, E, F equally spaced around O.

```
Figure description (the daisy): circle centre O, radius r.
Points A, B, C, D, E, F on the circle, each a distance r from its neighbours.
Six more circles of radius r, centred at A..F, overlap to make six "petals".

          B _____ C
          /\     /\
         /  \   /  \
      A /____\O/____\ D
        \    / \    /
         \  /   \  /
          \/_____\/
          F       E
```

Why are the six points equally spaced? Look at triangle OAB. OA = r (radius of the first circle). OB = r (same circle). AB = r (B is on the circle centred at A with radius r). So triangle OAB is equilateral, and so is every triangle OBC, OCD, …, OFA. Six equilateral triangles fit around O with no gap because 6 × 60° = 360°; you will prove the 60° fact in week 6, but the construction already guarantees the equal spacing without any angle measurement.

What else is hiding in the daisy?

- **Rhombus:** OABC is not one, but OAB together with OBC makes quadrilateral OABC with OA = AB = BC = CO = r. Four congruent sides is the definition of a rhombus.
- **Regular hexagon:** ABCDEF has six congruent sides (all equal to r) and, by the symmetry of the picture, six congruent angles.
- **Perpendicular bisector:** the line through B and F? No; try the line through O and the two crossing points of the circles centred at A and B. That line is the perpendicular bisector of AB (next section).

**Try it 2.1** In the daisy with radius 4 cm, what is the perimeter of hexagon ABCDEF? *(Answer: 6 × 4 = 24 cm, because each side equals the radius.)*

**Try it 2.2** How many equilateral triangles with side r share the vertex O? *(Answer: six: OAB, OBC, OCD, ODE, OEF, OFA.)*

## 3. The perpendicular bisector construction

Given segment AB. Draw the circle centred at A through B, and the circle centred at B through A. They cross at two points; call them P (above) and Q (below). The line PQ is the perpendicular bisector of AB.

```
Figure description: segment AB horizontal. Two circles of radius AB,
centred at A and at B, cross above the segment at P and below it at Q.
Line PQ crosses AB at its midpoint M, at a right angle.

           P
          /|\
         / | \
        A--M--B
         \ | /
          \|/
           Q
```

**Why it works, point by point.**

1. P is on the circle centred at A with radius AB, so PA = AB.
2. P is on the circle centred at B with radius AB, so PB = AB.
3. Therefore PA = PB: P is equidistant from A and B. The same argument gives QA = QB.
4. A point equidistant from A and B lies on the perpendicular bisector of AB. (You will prove this converse carefully in Unit 2; for now, accept it and notice that the construction gives you *two* such points, which is exactly what you need to draw the line.)

The crossing point M of PQ and AB is the midpoint of AB, and ∠PMA is a right angle. So this one construction does three jobs: it finds a midpoint, it draws a perpendicular, and it produces a line of points equidistant from A and B.

You do not have to use radius AB. Any radius bigger than half of AB works, as long as you use the **same** radius for both circles; otherwise step 3 fails. That is the most common error of the week.

**Worked example 2.** Segment AB is 6 cm long. A student draws a circle of radius 4 cm centred at A and a circle of radius 5 cm centred at B. They cross at P and Q. Is PQ the perpendicular bisector of AB?

No. PA = 4 and PB = 5, so P is not equidistant from A and B. Line PQ will cross AB, but not at the midpoint and not at a right angle. Fix: redraw the second circle with radius 4 cm (or both with 5 cm).

**Worked example 3 — finding a midpoint in a real figure.** Figure description: triangle XYZ with XY = 8, YZ = 10, XZ = 12. You want the midpoint of XZ. Draw circles of radius 12 centred at X and at Z; they meet at two points; the line through them cuts XZ at its midpoint M, with XM = MZ = 6. (Any radius larger than 6 would do; 12 is convenient because the compass is already set to XZ.)

**Try it 3.1** Segment GH has length 10. Circles of radius 7 centred at G and at H cross at two points, R and S. What is GR, HR, and the distance from G to the point where RS meets GH? *(Answer: GR = 7, HR = 7, and RS meets GH at its midpoint, 5 from G.)*

**Try it 3.2** Why will circles of radius 4 centred at G and at H, with GH = 10, fail to give a perpendicular bisector? *(Answer: 4 + 4 = 8 < 10, so the circles never meet; there are no points to draw the line through.)*

## 4. The equilateral triangle construction

This is Euclid's very first proposition. Given segment AB:

1. Draw the circle centred at A with radius AB.
2. Draw the circle centred at B with radius AB (that is, through A).
3. Let C be one of the two points where the circles cross. Draw AC and BC.
4. Triangle ABC is equilateral.

**Proof.** AC = AB because both are radii of the circle centred at A. BC = BA because both are radii of the circle centred at B. So AC = AB = BC: three congruent sides.

Notice that the first two steps are exactly the perpendicular bisector construction; C is the point we called P. So the daisy, the perpendicular bisector and the equilateral triangle are all the same two circles looked at three ways.

```
Figure description: segment AB. Circles of radius AB centred at A and at B.
C is the upper crossing point. Triangle ABC has AB = BC = CA.

            C
           / \
          /   \
         A-----B
```

**Worked example 4 — a 30° angle with no protractor.** Construct an equilateral triangle ABC on AB, then construct the perpendicular bisector of AB; it passes through C (because C is equidistant from A and B) and meets AB at the midpoint M. Then ∠ACM is half of ∠ACB. Once you know an equilateral triangle's angles are 60° (week 6), this gives you 30°. The construction itself needs no measuring at all.

**Worked example 5 — a regular hexagon from one circle.** Draw a circle with centre O and radius 5. Mark any point A on it. Without changing the compass, step around the circle: from A mark B, from B mark C, and so on. After six steps you are back at A. Each step is a chord equal to the radius, and each triangle OAB, OBC, … is equilateral by the same argument as in section 2. The hexagon ABCDEF has side 5 and perimeter 30.

**Try it 4.1** In the equilateral-triangle construction on AB, the second crossing point of the circles, call it D, is below AB. What kind of quadrilateral is ACBD? *(Answer: a rhombus: AC = CB = BD = DA = AB. In fact AC = AB and BD = AB, and the diagonals AB and CD cross at right angles.)*

**Try it 4.2** You want an equilateral triangle with side 7 cm on a plain sheet. Describe the full construction, including how you get the 7 cm. *(Answer: use a ruler only once, to mark A and B 7 cm apart; then two circles of radius AB centred at A and B, crossing at C; join. Or copy a given 7 cm segment with the compass as in section 1.)*

## Common mistakes

- **Changing the compass opening between the two circles** of a perpendicular bisector. The two radii must be equal or the crossing points are not equidistant from the endpoints.
- **Using the straightedge as a ruler.** If your justification contains "I measured", it is not a construction.
- **Drawing only arcs and losing track of which circle they belong to.** It is fine to draw arcs instead of full circles, but label the centre and the radius you used, because the justification is "both are radii of the circle centred at …".
- **Saying "equilateral because it looks equal".** The reason is always that the sides are radii of specific circles.
- **Choosing a radius less than half the segment** for the perpendicular bisector; the circles will not meet.

## Where this goes next

Week 2 adds the rest of the basic toolkit: perpendicular through a point, angle bisector, a parallel through a point, a square, and the same constructions in dynamic geometry software. Week 3 turns from building figures to moving them: reflections and translations, which are "rigid" because they preserve exactly the distances the compass is built to copy. The "equidistant from A and B" language of this week becomes the Perpendicular Bisector Theorem in Unit 2 and the equation of a perpendicular bisector in Unit 6.

## Self-check

1. State the definition of a circle, and use it to explain why every radius of a given circle has the same length.
2. Segment AB = 9. Circles of radius 6 centred at A and B cross at P and Q. Give PA, PB, QA, QB, and the length AM where M is the point where PQ meets AB.
3. A student constructs an "equilateral triangle" by drawing the circle centred at A through B, then a circle centred at B with a slightly smaller radius, and joining A and B to a crossing point C. Which side is wrong, and why?
4. In the six-petal daisy of radius r, name two different rhombuses with side r.
5. Describe, in numbered steps with no measuring, how to find the midpoint of a segment.

*Answers: (1) all points at a fixed distance from the centre; a radius is a segment from the centre to a point on the circle, so its length is that fixed distance. (2) PA = PB = QA = QB = 6; AM = 4.5. (3) BC ≠ AB, because C is on a circle centred at B whose radius is not AB; AC = AB still holds. (4) e.g. OABC and OCDE, or ABOF (any two adjacent equilateral triangles joined along a shared side). (5) draw equal-radius circles centred at each endpoint (radius more than half the segment), join their two crossing points, and the line meets the segment at its midpoint.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 1, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/2/1/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Euclid's definition is quoted from the public-domain Heath translation. Accessed 2026-10-16.*
