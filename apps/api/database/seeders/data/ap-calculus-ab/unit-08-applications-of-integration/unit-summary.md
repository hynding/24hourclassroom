# Unit 8 · Applications of Integration · The night-before sheet

**AP exam weight:** 10–15% of the AP Calculus AB exam
**Topics:** 8.1 Finding the Average Value of a Function on an Interval · 8.2 Connecting Position, Velocity, and Acceleration of Functions Using Integrals · 8.3 Using Accumulation Functions and Definite Integrals in Applied Contexts · 8.4 Finding the Area Between Curves Expressed as Functions of x · 8.5 Finding the Area Between Curves Expressed as Functions of y · 8.6 Finding the Area Between Curves That Intersect at More Than Two Points · 8.7 Volumes with Cross Sections: Squares and Rectangles · 8.8 Volumes with Cross Sections: Triangles and Semicircles · 8.9 Volume with Disc Method: Revolving Around the x- or y-Axis · 8.10 Volume with Disc Method: Revolving Around Other Axes · 8.11 Volume with Washer Method: Revolving Around the x- or y-Axis · 8.12 Volume with Washer Method: Revolving Around Other Axes
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 8, Topics 8.1–8.12, in our own words

## The ideas that generate every question

1. **An integral adds up thin pieces.** Every application in this unit is the same move: cut the quantity into slices, write the size of one slice, and integrate. A rate times a small time is a small amount; a height times a small width is a small area; a cross-sectional area times a small thickness is a small volume.
2. **Average value is integral divided by length (8.1).** The average value of f on [a, b] is (1/(b − a)) ∫ from a to b of f(x) dx, in the units of f. If f is continuous, the Mean Value Theorem for integrals guarantees f actually takes that value somewhere in [a, b].
3. **Integrating velocity gives change in position (8.2).** Displacement is ∫ v dt; total distance is ∫ |v| dt; position is x(a) + ∫ from a to t of v. Velocity from acceleration works the same way.
4. **Integrating any rate gives a change, never an amount (8.3).** Amount at time T = amount at the start + ∫ of the net rate. Rate-in/rate-out problems use (rate in − rate out); the amount is greatest where that net rate changes from positive to negative, checked against the endpoints.
5. **Area between curves is ∫ (top − bottom) dx or ∫ (right − left) dy (8.4, 8.5).** Limits come from intersections. Pick the variable that keeps one top and one bottom (or one right and one left) across the whole region.
6. **When curves cross, split (8.6).** A net integral counts the pieces where the "wrong" curve is on top as negative. Split at every crossing, or integrate |f − g| on a calculator.
7. **Volume is ∫ A(x) dx (8.7–8.12).** Known cross sections: build the shape on the slice length s. Solids of revolution: a disc (πR²) when the region touches the axis, a washer (πR² − πr²) when there is a gap. Radii are always distances from the axis of rotation.

## Key formulas

| Want | Use |
|---|---|
| Average value of f on [a, b] | (1/(b − a)) ∫ from a to b of f(x) dx |
| Displacement on [a, b] | ∫ from a to b of v(t) dt |
| Total distance on [a, b] | ∫ from a to b of |v(t)| dt |
| Position at time t | x(t) = x(a) + ∫ from a to t of v(s) ds |
| Velocity at time t | v(t) = v(a) + ∫ from a to t of a(s) ds |
| Amount with rate in E, rate out L | A(T) = A(0) + ∫ from 0 to T of (E − L) dt |
| Area, vertical slices | ∫ from a to b of (top − bottom) dx |
| Area, horizontal slices | ∫ from c to d of (right − left) dy |
| Area when curves cross | ∫ |f − g| dx, or split at each crossing |
| Volume with known cross sections | ∫ A(x) dx, with A built on s = top − bottom (or right − left) |
| Square / rectangle of height k·s | s² / k·s² |
| Semicircle on diameter s | (π/8)s² |
| Equilateral triangle on side s | (√3/4)s² |
| Isosceles right triangle: leg s / hypotenuse s | s²/2 / s²/4 |
| Disc | π ∫ R² (R = distance from axis to the curve) |
| Washer | π ∫ (R² − r²) (R to the far boundary, r to the near one) |
| Axis below the region, y = −k | R = upper + k, r = lower + k |
| Axis above the region, y = k | R = k − lower, r = k − upper |

## Justification sentences that earn the points

- **Mean Value Theorem for integrals:** "f is continuous on [a, b], so there is a value c in [a, b] with f(c) = (1/(b − a)) ∫ from a to b of f(x) dx."
- **Increasing or decreasing amount:** "A′(6) = E(6) − L(6) = −2 < 0, so the amount of water is decreasing at t = 6." Compare rates at that instant; do not compare amounts.
- **Absolute maximum of an amount:** "A′(t) = E(t) − L(t) = 0 at t = c. Candidates: A(0) = …, A(c) = …, A(T) = …. The greatest amount is … at t = c." Or: "A′ changes from positive to negative at t = c, the only critical point on the interval, so A has its absolute maximum there."
- **Change of direction:** "v(t) changes sign from negative to positive at t = 4, so the particle changes direction there." A zero of v without a sign change is not enough.
- **Speeding up or slowing down:** "v(1) > 0 and a(1) < 0 have opposite signs, so the speed is decreasing at t = 1."
- **Interpreting an integral:** name the quantity and its units, the interval in context, and that it is a total or change: "∫ from 2 to 5 of R(t) dt is the total number of cubic metres of rainwater that enter the pond from t = 2 to t = 5 hours."
- **Interpreting an average:** "(1/30) ∫ from 20 to 50 of v(t) dt is the cyclist's average velocity, in metres per second, over 20 ≤ t ≤ 50."
- **Calculator answers:** write the integral with its limits and integrand first, then the value to three decimal places.

## Classic question types and how to attack them

**"Find the total distance travelled."** Find where v changes sign. Integrate v on each piece and add absolute values, or on a calculator integrate |v| directly.

**"Find the position at time t = 5."** Starting position plus ∫ v. If the starting time is not 0, start the integral at the time you know.

**"How much is in the tank at t = 12, and when is it greatest?"** Write A(t) = A(0) + ∫ (in − out). Set in = out for critical points, then run the candidates test with both endpoints.

**"Find the area of the region R."** Sketch, find intersections, decide which curve is on top (test a point), and integrate. If the bottom or top boundary changes partway, switch to dy or split.

**"Find the volume when R is revolved about the line y = −1."** Draw one slice perpendicular to the axis. Label the outer and inner radii as distances from y = −1, then write π ∫ (R² − r²).

**"R is the base of a solid with semicircle cross sections."** Find the slice length s across the base, then use (π/8)s². There is no revolving: the base stays flat and the shapes stand up on it.

**"Write, but do not evaluate, an integral."** The setup is the whole point: π, both radii squared and subtracted in the right order, limits, and the differential.

## Errors that cost the most points

- Averaging two endpoint values instead of integrating; dividing by b instead of b − a.
- Reporting displacement as distance, or forgetting the starting position.
- Adding a rate (litres per minute) to an amount (litres).
- Using y-values as limits for a dx integral, or forgetting to rewrite curves as x = g(y) for dy.
- Taking the absolute value outside the integral, |∫ (f − g)|, so the pieces cancel first.
- Writing π(R − r)² for a washer, or expanding (4 − x²)² as 16 − x⁴.
- Measuring a radius from the x-axis when the axis is y = −1 or y = 4.
- Using the slice length as a radius for semicircles, or a triangle's height as its area.
- Slicing parallel to the axis of rotation: a vertical axis needs horizontal slices and an integral in y.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 8, Topics 8.1–8.12). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
