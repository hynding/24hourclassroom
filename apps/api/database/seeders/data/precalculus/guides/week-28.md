# Week 28 · Parametric Circles and Lines; Implicitly Defined Functions

**Topics:** 4.4 Parametrically Defined Circles and Lines · 4.5 Implicitly Defined Functions
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 4, Topics 4.4–4.5, learning objectives in our own words. Unit 4 is not assessed on the AP exam.
**Spiral:** Week 27's parametric functions, directions of motion and slopes of paths; week 19's unit-circle coordinates (cos t, sin t) and the Pythagorean identity cos²t + sin²t = 1; weeks 20–21's period 2π/b and sinusoidal models (a Ferris wheel is a parametric circle); week 25's rectangular form of polar circles. From Algebra 2: the circle equation (x − h)² + (y − k)² = r², completing the square, and solving quadratics.

## What you need to be able to do

- **4.4** Write a parametric function for a circle with given centre and radius, traced counterclockwise or clockwise, from a chosen starting point, at a chosen speed (time per revolution), and for an arc of a circle.
- **4.4** Recover the centre, radius, direction and time per revolution from parametric equations, and eliminate the parameter with cos²t + sin²t = 1.
- **4.4** Write a parametric function for a line segment between two points, and for the whole line through them; find points such as the midpoint from the parameter.
- **4.5** Recognise an implicitly defined relation (an equation in x and y not solved for y), test whether a point lies on its graph, and find the y-values that go with a given x.
- **4.5** Split an implicit curve into pieces that are functions of x, and identify, without calculus, where the curve has horizontal or vertical tangent lines (for circles and ellipses, and from where two branches meet).
- **4.5** Read level curves f(x, y) = c as a family of implicitly defined curves.

## Key terms

| Term | Meaning |
|---|---|
| Standard parametrization of a circle | x = h + r cos t, y = k + r sin t, 0 ≤ t ≤ 2π: centre (h, k), radius r, counterclockwise from (h + r, k). |
| Clockwise parametrization | x = h + r cos t, y = k − r sin t (change the sign of the sine term). |
| Angular rate | In x = h + r cos(bt), y = k + r sin(bt), one revolution takes 2π/b units of t. |
| Line segment parametrization | x = x₁ + (x₂ − x₁)t, y = y₁ + (y₂ − y₁)t, 0 ≤ t ≤ 1, from (x₁, y₁) to (x₂, y₂). |
| Implicitly defined relation | An equation such as x² + xy + y² = 7 that links x and y without isolating y. |
| Branch | A piece of an implicit curve that is the graph of a function of x, such as y = √(25 − x²). |
| Vertical tangent | A point where the tangent line to the curve is vertical; on an implicit curve, often where two branches meet. |
| Level curve | The set of points where a quantity depending on x and y takes one fixed value c. |

## Circles, traced on purpose (4.4)

From week 19, the point (cos t, sin t) lies on the unit circle and moves counterclockwise from (1, 0) as t increases from 0 to 2π. Scale by r and shift by (h, k):

x(t) = h + r cos t, y(t) = k + r sin t, 0 ≤ t ≤ 2π.

This traces the circle with centre (h, k) and radius r once, counterclockwise, starting at (h + r, k), the point directly right of the centre.

**Eliminating the parameter.** cos t = (x − h)/r and sin t = (y − k)/r, and cos²t + sin²t = 1, so

((x − h)/r)² + ((y − k)/r)² = 1, that is, (x − h)² + (y − k)² = r².

**Changing the picture.**

| Change you want | How to write it |
|---|---|
| Clockwise instead | y = k − r sin t (or swap the roles of sine and cosine) |
| Start at the top, (h, k + r) | x = h − r sin t, y = k + r cos t (counterclockwise) or x = h + r sin t, y = k + r cos t (clockwise) |
| One revolution every T units of time | replace t by (2π/T)t |
| Only an arc | restrict t, e.g. 0 ≤ t ≤ π gives the upper semicircle for the standard form |

To check any version, plug in t = 0 to find the start and a small positive t (or t equal to a quarter period) to see which way it moves.

**Worked example.** Describe x(t) = 3 + 5 cos t, y(t) = −1 + 5 sin t, 0 ≤ t ≤ 2π.

Centre (3, −1), radius 5. At t = 0 the point is (8, −1); at t = π/2 it is (3, 4), above the centre, so the motion is counterclockwise. Rectangular equation: (x − 3)² + (y + 1)² = 25.

**Worked example.** Write a parametrization of the circle x² + y² = 4 traced clockwise, starting at (2, 0), once every 2π units of time.

x(t) = 2 cos t, y(t) = −2 sin t. Check: t = 0 gives (2, 0); t = π/2 gives (0, −2), below the centre, so the point went down from the rightmost point: clockwise.

**Worked example (spiral with week 21).** In a hypothetical model, a Ferris wheel of radius 20 m has its centre 22 m above the ground and turns once every 4 minutes. A rider boards at the bottom and first moves to the right. Put the centre at x = 0.

The rider starts at (0, 2). Starting at the bottom and moving right is counterclockwise, so use x(t) = 20 sin(πt/2), y(t) = 22 − 20 cos(πt/2), with b = 2π/4 = π/2. Check: t = 0 gives (0, 2); t = 1 gives (20, 22), the right side; t = 2 gives (0, 42), the top. The height function y(t) alone is exactly the sinusoidal model you wrote in week 21; the parametric version also tracks the rider's horizontal position.

When is the rider 32 m up during the first turn? 22 − 20 cos(πt/2) = 32 gives cos(πt/2) = −1/2, so πt/2 = 2π/3 or 4π/3, and t = 4/3 or 8/3 minutes.

**Try it.**
1. Give the centre, radius, starting point and direction of x = −2 + 3 cos t, y = 4 − 3 sin t.
2. Parametrize the circle with centre (1, 1) and radius 6, counterclockwise from (7, 1), once every 10 seconds.
3. Which arc does x = cos t, y = sin t trace for π/2 ≤ t ≤ π?

*Answers:* 1. Centre (−2, 4), radius 3, start (1, 4), clockwise. 2. x = 1 + 6 cos(πt/5), y = 1 + 6 sin(πt/5), 0 ≤ t ≤ 10. 3. The quarter of the unit circle in Quadrant II, from (0, 1) to (−1, 0).

## Lines and line segments (4.4)

To move from P₁ = (x₁, y₁) to P₂ = (x₂, y₂) in a straight line, start at P₁ and add a fraction t of the change:

x(t) = x₁ + (x₂ − x₁)t, y(t) = y₁ + (y₂ − y₁)t, 0 ≤ t ≤ 1.

At t = 0 you are at P₁, at t = 1 at P₂, and at t = 1/2 at the midpoint. Letting t be any real number gives the whole line. The slope of the path is (y₂ − y₁)/(x₂ − x₁) on every interval, which is why the path is straight. To make the trip take T units of time, use t/T in place of t (so 0 ≤ t ≤ T).

**Worked example.** Parametrize the segment from (2, −1) to (8, 3), and find the point one quarter of the way along.

Changes: Δx = 6 and Δy = 4. So x(t) = 2 + 6t, y(t) = −1 + 4t, 0 ≤ t ≤ 1. At t = 1/4: (3.5, 0).

**Worked example.** A hypothetical robot drives in a straight line from (0, 10) to (12, 1) in 3 seconds at a constant rate. Write its position.

Δx = 12 and Δy = −9 over 3 seconds: x(t) = 4t, y(t) = 10 − 3t, 0 ≤ t ≤ 3. Its horizontal rate is 4 m/s and its vertical rate −3 m/s; the slope of the path is −3/4.

**Try it.**
1. Parametrize the segment from (−3, 5) to (1, −7) with 0 ≤ t ≤ 1 and give its midpoint.
2. Eliminate t from x = 1 + 2t, y = 4 − 6t.

*Answers:* 1. x = −3 + 4t, y = 5 − 12t; midpoint (−1, −1). 2. t = (x − 1)/2, y = 4 − 3(x − 1) = 7 − 3x.

## Implicitly defined relations (4.5)

Many curves are easiest to describe by an equation that ties x and y together without solving for y: x² + y² = 25, xy = 12, x² + 4y² = 16, x² + xy + y² = 7. Such an equation defines y **implicitly**. Its graph is every point (x, y) that makes the equation true.

**Is a point on the curve?** Substitute and check. For x² + xy + y² = 7, the point (2, 1) gives 4 + 2 + 1 = 7, so yes; (1, 1) gives 3, so no.

**Which y-values go with a given x?** Substitute x and solve for y. Often you get a quadratic in y, with zero, one or two solutions.

**Worked example.** For x² + xy + y² = 7, find all points with x = 1.

1 + y + y² = 7, so y² + y − 6 = 0, (y + 3)(y − 2) = 0, y = 2 or y = −3. The points are (1, 2) and (1, −3). Two y-values for one x: the relation is not a function of x.

**Branches.** Solving x² + y² = 25 for y gives y = ±√(25 − x²). The curve splits into two functions: the top semicircle y = √(25 − x²) and the bottom y = −√(25 − x²). Each branch passes the vertical line test on its own. For a general quadratic in y, the quadratic formula produces the two branches.

**Tangent lines, without calculus.** For a circle you know the tangent line at a point is perpendicular to the radius there. On x² + y² = 25 at (3, 4), the radius has slope 4/3, so the tangent has slope −3/4.

- *Horizontal tangents* on a circle are at the top and bottom, (h, k ± r).
- *Vertical tangents* are at the far left and right, (h ± r, k). These are exactly the points where the two branches y = k ± √(r² − (x − h)²) meet, because the square root is 0 there.

The same idea works for other implicit curves: a vertical line x = c that touches the curve at exactly one point at the edge of the curve marks a vertical tangent. Treat the equation as a quadratic in y and ask when it has exactly one solution (discriminant 0).

**Worked example.** Where does x² + xy + y² = 7 have vertical tangent lines?

As a quadratic in y: y² + xy + (x² − 7) = 0. Discriminant x² − 4(x² − 7) = 28 − 3x². Two y-values when 28 − 3x² > 0, none when it is negative, and exactly one when x² = 28/3, x = ±√(28/3) ≈ ±3.06. At those x the two branches meet at the left and right edges of the curve (a tilted ellipse), so the tangent lines there are vertical. At x = √(28/3), y = −x/2 ≈ −1.53.

**Worked example.** For the ellipse x² + 4y² = 16, find the vertical and horizontal tangent points.

y = ±(1/2)√(16 − x²): the branches meet where x = ±4, at (±4, 0), so the vertical tangents are there. The highest and lowest points are at x = 0: (0, ±2), with horizontal tangents.

**Level curves.** Suppose a quantity depends on position, like a hypothetical temperature model on a metal plate T(x, y) = 100 − x² − 2y² (degrees). The points where T = 84 satisfy x² + 2y² = 16, an ellipse; T = 68 gives x² + 2y² = 32, a larger ellipse. Each level curve is an implicitly defined curve, and a family of them (like contour lines on a map) shows how the quantity changes across the plate: the temperature falls as you move outward.

**Try it.**
1. Is (−2, 3) on x²y − y² = 3?
2. Find all y with x = 4 on xy − y² = 3.
3. Where does (x − 1)² + (y + 2)² = 9 have vertical tangent lines?

*Answers:* 1. 4 · 3 − 9 = 3, yes. 2. 4y − y² = 3, y² − 4y + 3 = 0, y = 1 or 3. 3. (4, −2) and (−2, −2).

## Calculator notes

Most graphing calculators do not graph implicit equations directly. Either use parametric mode (a circle is x = h + r cos t, y = k + r sin t) or solve for y and graph both branches, for example Y₁ = √(25 − X²) and Y₂ = −√(25 − X²). A square window (equal scales on both axes) keeps circles from looking like ellipses.

## Common mistakes

- **Wrong direction.** x = cos t, y = sin t is counterclockwise; making the circle clockwise needs a sign change on one component.
- **Speed confusion.** x = cos(2t), y = sin(2t) on 0 ≤ t ≤ 2π goes round twice; one lap takes 2π/2 = π.
- **Segment from the wrong end.** x = x₁ + (x₂ − x₁)t starts at x₁; using x₂ as the base reverses or misplaces the segment.
- **Dropping a branch.** Solving x² + y² = 25 gives y = ±√(25 − x²), not just the positive root.
- **Mixing up horizontal and vertical tangents.** On a circle the top and bottom have horizontal tangents; the left and right edges have vertical ones.
- **Forgetting the xy term** when substituting into an equation such as x² + xy + y² = 7.

## Where this goes next

Week 29 extends both ideas to conic sections: ellipses parametrized by x = h + a cos t, y = k + b sin t, hyperbolas by secant and tangent, and the implicit equations of all three conics found by completing the square. In calculus, implicit differentiation turns this week's tangent-line intuition into a method that works for any implicit curve.

## Self-check

1. Write a parametrization of the circle with centre (−4, 2) and radius 3, traced clockwise once every 6 seconds starting from its rightmost point.
2. Eliminate the parameter from x = 2 + 7 cos t, y = 7 sin t − 5, and state the centre and radius.
3. Parametrize the segment from (5, 0) to (−1, 9) and find the point two thirds of the way along.
4. For x² − xy + y² = 3, find all y-values when x = 1 and decide whether the relation is a function of x.
5. Explain, using branches, why the circle (x − h)² + (y − k)² = r² has vertical tangent lines at (h ± r, k).

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 4, Topics 4.4–4.5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
