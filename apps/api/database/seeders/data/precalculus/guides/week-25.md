# Week 25 · Polar Coordinates and Polar Graphs

**Topics:** 3.13 Trigonometry and Polar Coordinates · 3.14 Polar Function Graphs
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 3, Topics 3.13–3.14, learning objectives in our own words
**Spiral:** Week 18 defined sine and cosine as coordinates on a circle of radius r: that is exactly the conversion x = r cos θ, y = r sin θ. Week 19's unit-circle values give exact conversions, week 22's inverse tangent gives angles (with a quadrant check), and week 23's equation solving finds where a polar curve passes through the origin. Week 24's sum identities explain why multiplying complex numbers in polar form adds their angles. From Algebra 2: complex numbers a + bi and completing the square for circles.

## What you need to be able to do

- **3.13** Locate a point given in polar coordinates (r, θ), including negative r and angles outside [0, 2π), and recognise that one point has many polar names.
- **3.13** Convert points between polar and rectangular coordinates, choosing θ in the correct quadrant.
- **3.13** Convert simple equations between polar and rectangular form, such as r = 6 cos θ and (x − 3)² + y² = 9.
- **3.13** Plot a complex number a + bi in the complex plane and write it in polar form r(cos θ + i sin θ), and convert back.
- **3.14** Sketch a polar graph r = f(θ) from a table of values, and identify circles, roses and limaçons (including cardioids) from their equations.
- **3.14** Connect the graph of r = f(θ) drawn on rectangular θ–r axes to the polar curve: where r = 0 the curve is at the pole; where r < 0 the point is plotted in the opposite direction.

## Key terms

| Term | Meaning |
|---|---|
| Pole | The origin of the polar system. |
| Polar axis | The ray from the pole along the positive x-axis, where θ = 0. |
| Polar coordinates (r, θ) | The point reached by turning through angle θ from the polar axis and moving a directed distance r along that ray (backwards if r < 0). |
| Polar function | A function r = f(θ) giving the directed distance as a function of the angle. |
| Complex plane | A plane with real part on the horizontal axis and imaginary part on the vertical axis; a + bi sits at (a, b). |
| Modulus and argument | For z = a + bi, the modulus is r = |z| = √(a² + b²) and an argument is an angle θ with a = r cos θ and b = r sin θ. |
| Rose curve | r = a cos(nθ) or r = a sin(nθ), with n a positive integer of at least 2. |
| Limaçon | r = a + b cos θ or r = a + b sin θ; a cardioid when |a| = |b|. |

## Polar coordinates (3.13)

A rectangular point (x, y) says "go x across and y up". A polar point (r, θ) says "face direction θ, then walk r". To plot (3, 2π/3): face the direction 2π/3 (in quadrant II) and walk 3 units.

**Negative r.** (−3, 2π/3) means face direction 2π/3, then walk 3 units *backwards*. You end up in the direction 2π/3 + π = 5π/3, in quadrant IV. In general, (−r, θ) is the same point as (r, θ + π).

**Many names for one point.** Adding 2π to the angle changes nothing: (r, θ) = (r, θ + 2πn). Combined with the rule above, (2, π/6), (2, 13π/6), (2, −11π/6) and (−2, 7π/6) all name the same point. The pole itself is (0, θ) for every θ.

### Converting points

From the right triangle (or straight from week 18's definitions):

- **Polar to rectangular:** x = r cos θ, y = r sin θ.
- **Rectangular to polar:** r² = x² + y², and tan θ = y/x (when x ≠ 0), with θ chosen in the quadrant where the point actually is.

**Worked example.** Convert (4, 2π/3) to rectangular coordinates.

x = 4 cos(2π/3) = 4(−1/2) = −2. y = 4 sin(2π/3) = 4(√3/2) = 2√3. The point is (−2, 2√3).

**Worked example.** Convert (−3, 3) to polar coordinates with r > 0 and 0 ≤ θ < 2π.

r = √(9 + 9) = √18 = 3√2. tan θ = 3/(−3) = −1. The calculator's tan⁻¹(−1) = −π/4 points into quadrant IV, but (−3, 3) is in quadrant II. The quadrant II angle with tangent −1 is 3π/4. Answer: (3√2, 3π/4).

**Worked example.** Convert (2, −2√3) to polar coordinates with r > 0 and 0 ≤ θ < 2π.

r = √(4 + 12) = 4. tan θ = −√3, and the point is in quadrant IV, so θ = 5π/3. Answer: (4, 5π/3). (Also correct but outside the stated range: (4, −π/3) or (−4, 2π/3).)

**Try it.**
1. Convert (6, 5π/4) to rectangular coordinates.
2. Convert (−1, −√3) to polar coordinates with r > 0 and 0 ≤ θ < 2π.
3. Give a polar name for (5, π/3) with a negative r.

*Answers:* 1. (6 · (−√2/2), 6 · (−√2/2)) = (−3√2, −3√2). 2. r = 2, quadrant III, θ = 4π/3: (2, 4π/3). 3. (−5, 4π/3).

### Converting equations

Use x = r cos θ, y = r sin θ and x² + y² = r². Multiplying both sides by r is a common first move.

**Worked example.** Write r = 6 cos θ in rectangular form and identify the graph.

Multiply by r: r² = 6r cos θ, so x² + y² = 6x. Complete the square: x² − 6x + 9 + y² = 9, so (x − 3)² + y² = 9. A circle with centre (3, 0) and radius 3, passing through the pole.

**Worked example.** Write the line x = 5 and the line y = x in polar form.

x = 5 becomes r cos θ = 5, or r = 5/cos θ = 5 sec θ. y = x becomes r sin θ = r cos θ, so tan θ = 1: the polar equation θ = π/4 (with r allowed to be negative, this one angle gives the whole line).

## Complex numbers in polar form (3.13)

Plot z = a + bi at the point (a, b) of the complex plane. Its distance from 0 is the **modulus** r = √(a² + b²), and the angle of its ray is an **argument** θ. Then a = r cos θ and b = r sin θ, so

**a + bi = r(cos θ + i sin θ).**

**Worked example.** Write z = 1 + i√3 in polar form.

r = √(1 + 3) = 2. The point (1, √3) is in quadrant I with tan θ = √3, so θ = π/3. z = 2(cos(π/3) + i sin(π/3)).

**Worked example.** Write z = −2 − 2i in polar form.

r = √(4 + 4) = 2√2. The point is in quadrant III with tan θ = 1, so θ = 5π/4. z = 2√2(cos(5π/4) + i sin(5π/4)).

**Worked example.** Write 4(cos(5π/6) + i sin(5π/6)) in the form a + bi.

a = 4 cos(5π/6) = −2√3, b = 4 sin(5π/6) = 2. So z = −2√3 + 2i.

**Why polar form is useful.** Multiply r₁(cos α + i sin α) by r₂(cos β + i sin β). Expanding and using i² = −1 gives r₁r₂[(cos α cos β − sin α sin β) + i(sin α cos β + cos α sin β)], and week 24's sum identities turn the brackets into cos(α + β) + i sin(α + β). So the moduli multiply and the angles add. For example, multiplying by i = 1(cos(π/2) + i sin(π/2)) rotates a point a quarter turn anticlockwise.

**Try it.**
1. Write −5i in polar form with 0 ≤ θ < 2π.
2. Write 6(cos(7π/4) + i sin(7π/4)) as a + bi.

*Answers:* 1. r = 5, the point (0, −5) is straight down: 5(cos(3π/2) + i sin(3π/2)). 2. 3√2 − 3√2 i.

## Polar graphs from tables (3.14)

To graph r = f(θ), make a table of θ and r, plot each (r, θ), and join them in order of increasing θ.

**Worked example.** Sketch r = 2 + 2 cos θ.

| θ | 0 | π/3 | π/2 | 2π/3 | π | 4π/3 | 3π/2 | 5π/3 | 2π |
|---|---|---|---|---|---|---|---|---|---|
| r | 4 | 3 | 2 | 1 | 0 | 1 | 2 | 3 | 4 |

Starting at (4, 0) on the positive x-axis, the curve sweeps up through (0, 2) at θ = π/2, comes into the pole at θ = π, and mirrors itself below the axis back to (4, 0). This heart shape, with a cusp at the pole, is a **cardioid**. Because cos(−θ) = cos θ, the graph is symmetric about the x-axis.

## Families of polar curves (3.14)

| Equation | Shape | What the numbers tell you |
|---|---|---|
| r = a | Circle centred at the pole | radius |a| |
| θ = α | Line through the pole | direction α |
| r = a cos θ | Circle through the pole, centre on the x-axis | diameter |a|, centre (a/2, 0) |
| r = a sin θ | Circle through the pole, centre on the y-axis | diameter |a|, centre (0, a/2) |
| r = a cos(nθ), r = a sin(nθ) | Rose | petal length |a|; n petals if n is odd, 2n petals if n is even |
| r = a + b cos θ, r = a + b sin θ | Limaçon | |a| < |b|: inner loop; |a| = |b|: cardioid; |a| > |b|: no loop (dimpled or convex) |

**Roses.** For r = 3 sin(2θ), n = 2 is even, so there are 4 petals of length 3. For r = 4 cos(3θ), n = 3 is odd, so there are 3 petals of length 4. Why the difference? With odd n, the curve retraces itself between θ = π and θ = 2π (the negative r values land on petals already drawn); with even n, the negative values draw new petals.

**Limaçons.** Compare r = 3 + 2 cos θ (r never reaches 0: no loop), r = 2 + 2 cos θ (r reaches 0 once: cardioid) and r = 1 + 2 cos θ (r goes negative: inner loop). The inner loop is traced exactly while r < 0.

**Symmetry shortcut.** Equations in cos θ give graphs symmetric about the x-axis (the polar axis); equations in sin θ give graphs symmetric about the y-axis (the line θ = π/2).

## Reading r against θ on rectangular axes (3.14)

The CED expects you to move between the polar curve and the graph of r = f(θ) drawn on ordinary axes with θ across and r up. That rectangular graph is often easier to read:

- Where the θ–r graph **crosses r = 0**, the polar curve **passes through the pole**.
- Where the θ–r graph is **above the axis**, the point lies in the direction θ; where it is **below**, the point lies in the direction θ + π.
- The **height |r|** is the distance from the pole.

**Worked example.** Describe r = 2 cos(2θ) using its θ–r graph on [0, π].

On rectangular axes, r = 2 cos(2θ) is a cosine with period π: r = 2 at θ = 0, 0 at θ = π/4, −2 at θ = π/2, 0 at 3π/4, and 2 at π.

- 0 ≤ θ ≤ π/4: r falls from 2 to 0, drawing the upper half of the petal on the positive x-axis into the pole.
- π/4 ≤ θ ≤ π/2: r is negative, so the points are in the directions θ + π, between 5π/4 and 3π/2, in quadrant III. As θ reaches π/2, r = −2 and the point is (0, −2): this draws half of the petal on the negative y-axis.
- π/2 ≤ θ ≤ 3π/4: still negative, now in directions between 3π/2 and 7π/4 (quadrant IV): the other half of the bottom petal.
- 3π/4 ≤ θ ≤ π: r is positive again in quadrant II, drawing half of the petal on the negative x-axis.

Continuing to 2π completes all four petals, as the rule for even n predicts.

**Try it.**
1. How many petals does r = 5 sin(3θ) have, and how long is each?
2. Classify r = 3 − 3 sin θ and r = 2 + 5 cos θ.
3. For which θ in [0, 2π) does r = 1 + 2 cos θ pass through the pole?

*Answers:* 1. 3 petals of length 5. 2. |a| = |b|: cardioid; |a| < |b|: limaçon with an inner loop. 3. cos θ = −1/2: θ = 2π/3 and 4π/3.

## Calculator notes

- Switch to polar (POL) graphing mode and radian mode. Enter r₁ = 2 + 2cos(θ).
- Set θmin = 0 and θmax = 2π for most curves; a θ-step of about π/24 gives a smooth curve. A rose with odd n is complete after θ = π.
- Use a square window (equal scales on both axes), or circles look like ellipses.
- The trace feature reports θ, r and often x and y; this is a good way to check a conversion.
- AP questions about polar graphs are often non-calculator: know the families above and how to make a quick table.

## Common mistakes

- **Taking θ = tan⁻¹(y/x) without a quadrant check.** For (−3, 3), tan⁻¹(−1) = −π/4 points to the wrong quadrant; the answer is 3π/4.
- **Plotting negative r in the direction θ.** It goes in the direction θ + π.
- **Counting petals wrongly.** r = a cos(nθ) has n petals for odd n but 2n for even n.
- **Confusing radius and diameter.** r = 6 cos θ is a circle of radius 3, not 6.
- **Forgetting that the pole has many names.** A curve can pass through the pole at several values of θ.
- **Writing the modulus as a² + b².** It is the square root: |3 + 4i| = 5, not 25.

## Where this goes next

Week 26 asks how fast r changes as θ changes: when the curve is moving away from the pole, when toward it, and what the average rate of change of r means on a polar graph. Unit 4 (week 27 onward) returns to curves in the plane through parametric equations, where x = r cos θ and y = r sin θ reappear as x(t) and y(t).

## Self-check

1. Convert (−4, π/6) to rectangular coordinates, and (−√3, 1) to polar coordinates with r > 0.
2. Write x² + y² = 4y in polar form and describe the graph.
3. Write −3 + 3i in polar form.
4. Sketch r = 3 cos(2θ) and r = 3 cos(3θ). How many petals does each have?
5. On a θ–r graph of r = 1 − 2 sin θ, where would you look to find when the polar curve is inside its inner loop?

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 3, Topics 3.13–3.14). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
