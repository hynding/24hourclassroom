# Week 29 · Conic Sections and Their Parametrizations

**Topics:** 4.6 Conic Sections · 4.7 Parametrization of Implicitly Defined Functions
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 4, Topics 4.6–4.7, learning objectives in our own words. Unit 4 is not assessed on the AP exam.
**Spiral:** Week 28's parametric circles and implicitly defined curves (a circle is the simplest conic); week 8's transformations (every conic in standard form is a shifted and stretched basic curve); week 24's Pythagorean identities, including sec²t − tan²t = 1; week 5's asymptotes and end behaviour, which return as the asymptotes of a hyperbola. From Algebra 2: completing the square and the distance formula.

## What you need to be able to do

- **4.6** Recognise the standard forms of a parabola, an ellipse and a hyperbola, and read off the centre or vertex, the vertices, the axes, the foci, and (for a parabola) the directrix or (for a hyperbola) the asymptotes.
- **4.6** Use c² = a² − b² for an ellipse and c² = a² + b² for a hyperbola to locate the foci, and use the focus–directrix property of a parabola in context.
- **4.6** Complete the square to rewrite a general second-degree equation in standard form, and classify a conic from the signs of its squared terms.
- **4.7** Parametrize an ellipse with x = h + a cos t, y = k + b sin t, a hyperbola with x = h + a sec t, y = k + b tan t, and a parabola (or any graph y = f(x)) with x = t, y = f(t), and check a parametrization by substituting into the implicit equation.
- **4.7** Explain why a parametrization can describe an entire implicit curve that no single function of x can.

## Key terms

| Term | Meaning |
|---|---|
| Conic section | A curve formed by slicing a double cone with a plane: circle, ellipse, parabola or hyperbola. |
| Focus (plural foci) | A fixed point used to define a conic. |
| Directrix | The fixed line that, with the focus, defines a parabola: every point is equally far from both. |
| Ellipse | All points whose distances to two foci add to a constant 2a. |
| Hyperbola | All points whose distances to two foci differ by a constant 2a (in absolute value). |
| Vertices | The endpoints of the major axis (ellipse) or transverse axis (hyperbola); for a parabola, the turning point. |
| Co-vertices | The endpoints of an ellipse's minor axis. |
| Asymptotes of a hyperbola | Two lines through the centre that the branches approach far from the centre. |

## Parabolas (4.6)

A parabola is the set of points equally far from a focus and a directrix. With vertex (h, k) and p the signed distance from the vertex to the focus:

| Opens | Equation | Focus | Directrix |
|---|---|---|---|
| up (p > 0) or down (p < 0) | (x − h)² = 4p(y − k) | (h, k + p) | y = k − p |
| right (p > 0) or left (p < 0) | (y − k)² = 4p(x − h) | (h + p, k) | x = h − p |

The vertex sits halfway between the focus and the directrix.

**Worked example.** Find the focus and directrix of x² = 8y.

4p = 8, so p = 2. Vertex (0, 0), focus (0, 2), directrix y = −2. Check one point: (4, 2) is on the parabola (16 = 16); its distance to the focus is 4 and its distance to the line y = −2 is also 4.

**Worked example (a reflector).** A hypothetical satellite dish has a parabolic cross-section 60 cm wide and 9 cm deep. Where should the receiver go?

Put the vertex at the origin, opening up: x² = 4py. The rim is at (30, 9), so 900 = 36p and p = 25. Every incoming signal parallel to the axis reflects through the focus, so the receiver goes 25 cm above the vertex.

## Ellipses (4.6)

Centre (h, k), with a > b > 0:

| Major axis | Equation | Vertices | Co-vertices | Foci |
|---|---|---|---|---|
| horizontal | (x − h)²/a² + (y − k)²/b² = 1 | (h ± a, k) | (h, k ± b) | (h ± c, k) |
| vertical | (x − h)²/b² + (y − k)²/a² = 1 | (h, k ± a) | (h ± b, k) | (h, k ± c) |

and c² = a² − b². The larger denominator tells you the direction of the major axis. If a = b the ellipse is a circle and c = 0: both foci are at the centre.

**Worked example.** Describe (x + 2)²/25 + (y − 4)²/9 = 1.

Centre (−2, 4). a² = 25 under x, so the major axis is horizontal with a = 5; b = 3. Vertices (3, 4) and (−7, 4); co-vertices (−2, 7) and (−2, 1). c² = 25 − 9 = 16, c = 4, foci (2, 4) and (−6, 4).

**The sum of distances.** For any point on an ellipse, the distances to the two foci add to 2a, the length of the major axis. That is why a string tied to two pins traces an ellipse, and why a sound made at one focus of an elliptical room reflects to the other.

## Hyperbolas (4.6)

Centre (h, k):

| Opens | Equation | Vertices | Foci | Asymptotes |
|---|---|---|---|---|
| left–right | (x − h)²/a² − (y − k)²/b² = 1 | (h ± a, k) | (h ± c, k) | y − k = ±(b/a)(x − h) |
| up–down | (y − k)²/a² − (x − h)²/b² = 1 | (h, k ± a) | (h, k ± c) | y − k = ±(a/b)(x − h) |

and c² = a² + b². Here the positive term (not the larger denominator) tells you the direction. Far from the centre the 1 on the right becomes negligible, so the hyperbola hugs the lines where the left side equals 0: those are the asymptotes. A quick sketch uses the "box" of half-width a and half-height b around the centre; the asymptotes are its diagonals.

**Worked example.** Describe 9x² − 4y² = 36.

Divide by 36: x²/4 − y²/9 = 1. Opens left and right; a = 2, b = 3; vertices (±2, 0). c² = 4 + 9 = 13, foci (±√13, 0). Asymptotes y = ±(3/2)x.

**Worked example.** Describe (y − 1)²/16 − (x + 2)²/9 = 1.

The y-term is positive, so it opens up and down. Centre (−2, 1), a = 4, b = 3. Vertices (−2, 5) and (−2, −3). c = 5, foci (−2, 6) and (−2, −4). Asymptotes y − 1 = ±(4/3)(x + 2).

## Identifying a conic by completing the square (4.6)

A second-degree equation Ax² + Cy² + Dx + Ey + F = 0 (no xy term) is:

- an **ellipse** if A and C have the same sign (a **circle** if A = C);
- a **hyperbola** if A and C have opposite signs;
- a **parabola** if exactly one of A, C is 0.

(Degenerate cases, such as a single point or no graph at all, can occur; completing the square reveals them.)

**Worked example.** Write x² + 4y² − 6x + 16y + 9 = 0 in standard form.

Group and complete the square: (x² − 6x) + 4(y² + 4y) = −9. Add 9 inside the x-group and 4 inside the y-group (which adds 16 to the left because of the factor 4): (x − 3)² + 4(y + 2)² = −9 + 9 + 16 = 16. Divide by 16:

(x − 3)²/16 + (y + 2)²/4 = 1.

An ellipse with centre (3, −2), a = 4 (horizontal), b = 2, c = √12 = 2√3, foci (3 ± 2√3, −2).

**Worked example.** Identify 4x² − 9y² − 8x − 36y − 68 = 0.

Opposite signs on x² and y²: a hyperbola. 4(x − 1)² − 4 − 9(y + 2)² + 36 = 68, so 4(x − 1)² − 9(y + 2)² = 36, and (x − 1)²/9 − (y + 2)²/4 = 1. Centre (1, −2), opening left and right, a = 3, b = 2.

**Try it.**
1. Find the focus and directrix of y² = −12x.
2. Find the foci of x²/169 + y²/144 = 1.
3. Write x² + y² − 6x + 4y − 12 = 0 in standard form and describe it.
4. Give the asymptotes of x²/16 − y²/9 = 1.

*Answers:* 1. 4p = −12, p = −3: focus (−3, 0), directrix x = 3. 2. c² = 169 − 144 = 25, foci (±5, 0). 3. (x − 3)² + (y + 2)² = 25: circle, centre (3, −2), radius 5. 4. y = ±(3/4)x.

## Parametrizing conics (4.7)

An implicit equation such as x²/9 + y²/4 = 1 is not a function of x, but it is easy to describe parametrically, because trigonometric identities have exactly the right shape.

**Ellipse.** Since cos²t + sin²t = 1, the point x = h + a cos t, y = k + b sin t satisfies ((x − h)/a)² + ((y − k)/b)² = 1. For 0 ≤ t ≤ 2π it traces the ellipse once counterclockwise from (h + a, k). This is week 28's circle with different stretches in the two directions. (Note that t is not the angle the point makes at the centre unless a = b.)

**Hyperbola.** Since sec²t − tan²t = 1 (divide sin²t + cos²t = 1 by cos²t), the point x = h + a sec t, y = k + b tan t satisfies ((x − h)/a)² − ((y − k)/b)² = 1. For −π/2 < t < π/2, sec t > 0 and the right branch is traced from bottom to top; for π/2 < t < 3π/2, sec t < 0 and the left branch is traced. For an up–down hyperbola swap the roles: x = h + b tan t, y = k + a sec t.

**Parabola and any function.** If y = f(x), then x = t, y = f(t) works. For a sideways parabola x = g(y), use y = t, x = g(t). Sometimes a shifted parameter gives a neater form: for y = x² − 4x = (x − 2)² − 4, x = t + 2, y = t² − 4 puts the vertex at t = 0.

**Worked example.** Parametrize (x + 2)²/25 + (y − 4)²/9 = 1 and find the point at t = π/2.

x = −2 + 5 cos t, y = 4 + 3 sin t. At t = π/2: (−2, 7), the top co-vertex.

**Worked example.** Parametrize (x − 1)²/9 − (y + 2)²/4 = 1 and verify the point at t = π/4.

x = 1 + 3 sec t, y = −2 + 2 tan t. At t = π/4: sec = √2, tan = 1, so (1 + 3√2, 0). Check: (3√2)²/9 − (2)²/4 = 2 − 1 = 1.

**Why parametrize?** One parametrization traces the whole ellipse; as functions of x you would need two branches, y = 4 ± 3√(1 − (x + 2)²/25). Parametrizations also give direction and timing, which matters in motion problems: a hypothetical planet on an elliptical orbit, or a point on a gear.

**Try it.**
1. Parametrize x²/49 + y²/4 = 1 clockwise.
2. Parametrize y²/9 − x² = 1.
3. Check that x = t², y = t³ satisfies y² = x³.

*Answers:* 1. x = 7 cos t, y = −2 sin t. 2. x = tan t, y = 3 sec t. 3. y² = t⁶ = (t²)³ = x³.

## Calculator notes

Conics in standard form graph most easily in parametric mode: ellipse with X₁T = h + a cos T, Y₁T = k + b sin T; hyperbola with sec T written as 1/cos T. Use a square window and a small T-step, and expect a stray line joining the two branches of a hyperbola near T = π/2 if the T-range crosses it; graph the two branches over separate T-intervals to avoid it.

## Common mistakes

- **Using the ellipse rule for a hyperbola.** Ellipse: c² = a² − b². Hyperbola: c² = a² + b².
- **Taking the radius or semi-axis from the denominator directly.** In x²/25 + y²/9 = 1, a = 5, not 25.
- **Misjudging the direction.** For an ellipse the larger denominator decides; for a hyperbola the positive term decides.
- **Completing the square inside a factor.** In 4(y² + 4y), adding 4 inside adds 16 to that side.
- **Asymptote slopes inverted.** For x²/a² − y²/b² = 1 the slopes are ±b/a.
- **Forgetting that sec t > 0 traces only one branch** of a hyperbola; the full curve needs t on both sides of π/2.

## Where this goes next

Week 30 turns positions into vectors: the point (x(t), y(t)) becomes the position vector ⟨x(t), y(t)⟩, and parametric motion on lines, circles and ellipses becomes the study of vector-valued functions and their displacement and average velocity.

## Self-check

1. Find the vertex, focus and directrix of (x − 1)² = −8(y + 3).
2. Find the centre, vertices and foci of 4x² + y² = 36.
3. Identify and write in standard form: x² − y² + 4x + 6y − 9 = 0.
4. Parametrize the hyperbola x²/16 − y²/25 = 1 and state which t-values trace its left branch.
5. Explain why the distances from any point of an ellipse to its two foci add to 2a, using a vertex as the test point.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 4, Topics 4.6–4.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
