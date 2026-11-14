# Unit 3 · Trigonometric and Polar Functions · The night-before sheet

**AP exam weight:** 30–35% of the AP Precalculus exam (CED weighting)
**Topics:** 3.1 Periodic Phenomena · 3.2 Sine, Cosine, and Tangent · 3.3 Sine and Cosine Function Values · 3.4 Sine and Cosine Function Graphs · 3.5 Sinusoidal Functions · 3.6 Sinusoidal Function Transformations · 3.7 Sinusoidal Function Context and Data Modeling · 3.8 The Tangent Function · 3.9 Inverse Trigonometric Functions · 3.10 Trigonometric Equations and Inequalities · 3.11 The Secant, Cosecant, and Cotangent Functions · 3.12 Equivalent Representations of Trigonometric Functions · 3.13 Trigonometry and Polar Coordinates · 3.14 Polar Function Graphs · 3.15 Rates of Change in Polar Functions
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 3, Topics 3.1–3.15, learning objectives in our own words

## The ideas that generate every question

1. **Periodic means the outputs repeat over equal-length input intervals.** The period is the length of one full cycle. Anything you know about one cycle (where it rises, falls, bends, peaks) is true in every cycle.
2. **Sine and cosine are coordinates on a circle.** A point at angle θ on a circle of radius r is (r cos θ, r sin θ); tangent is sin θ/cos θ, the slope of the terminal ray. On the unit circle the special angles (multiples of π/6 and π/4) give exact values, and the quadrant gives the sign.
3. **Radians measure angles by arc length.** θ = s/r, so s = rθ, and a full turn is 2π.
4. **Every sinusoid is a transformed sine.** f(θ) = a sin(b(θ + c)) + d: amplitude |a|, period 2π/|b|, phase shift −c, midline y = d. Cosine is sine shifted left by π/2. Rates of change: a sinusoid increases fastest as it crosses the midline going up, and changes concavity on the midline.
5. **Models come from four numbers.** Midline = (max + min)/2, amplitude = (max − min)/2, b = 2π/period, and the horizontal shift places a known maximum, minimum or midline crossing. Interpret every parameter in context, with units.
6. **Tangent has period π and vertical asymptotes where cos θ = 0.** It is increasing on every branch. Its transformations follow the same rules, with period π/|b|.
7. **Inverse trigonometric functions need restricted domains.** sin⁻¹ returns angles in [−π/2, π/2], cos⁻¹ in [0, π], tan⁻¹ in (−π/2, π/2). They give one solution of an equation, never all of them.
8. **Equations have families of solutions.** Isolate, find the reference angle, place it in each correct quadrant, then add the period (2πn for sine and cosine, πn for tangent). Inside multipliers stretch the interval; quadratic and common-factor forms factor (never divide by a trig function). Inequalities: boundary values, then test the pieces.
9. **Reciprocals and identities are rewriting tools.** sec, csc and cot have asymptotes at the zeros of cos, sin and tan's numerator. The Pythagorean, sum, difference and double-angle identities turn an expression into the form a question needs.
10. **Polar coordinates describe points by direction and directed distance.** x = r cos θ, y = r sin θ, r² = x² + y²; negative r points the opposite way. a + bi = r(cos θ + i sin θ).
11. **Polar graphs are read from r against θ.** Circles, roses and limaçons have recognisable equations. Where r = 0 the curve is at the pole; |r| is the distance from the pole; the distance increases when r and its change have the same sign.

## Key formulas and procedures

| Want | Do this |
|---|---|
| Arc length | s = rθ, θ in radians; degrees to radians: multiply by π/180 |
| Coordinates on a circle of radius r | (r cos θ, r sin θ); tan θ = y/x |
| Exact values | reference angle π/6, π/4, π/3 → 1/2, √2/2, √3/2; sign from quadrant (sine + in I, II; cosine + in I, IV; tangent + in I, III) |
| Pythagorean identities | sin²θ + cos²θ = 1; 1 + tan²θ = sec²θ; 1 + cot²θ = csc²θ |
| Sinusoid features of a sin(b(θ + c)) + d | amplitude |a|; period 2π/|b|; phase shift −c; midline y = d; range [d − |a|, d + |a|] |
| Build a sinusoidal model | d = (max + min)/2; |a| = (max − min)/2; b = 2π/period; shift to a known max (cosine) or rising midline crossing (sine) |
| Tangent a tan(b(θ + c)) + d | period π/|b|; asymptotes where b(θ + c) = π/2 + πn |
| Inverse trig ranges | sin⁻¹: [−π/2, π/2]; cos⁻¹: [0, π]; tan⁻¹: (−π/2, π/2) |
| Solve sin x = k | x = sin⁻¹ k or π − sin⁻¹ k, + 2πn |
| Solve cos x = k | x = ± cos⁻¹ k, + 2πn |
| Solve tan x = k | x = tan⁻¹ k + πn |
| Solve sin(bx) = k on [0, 2π) | solve u = bx on [0, 2π|b|), then divide by b |
| Reciprocal functions | sec = 1/cos, csc = 1/sin, cot = cos/sin |
| Sum and difference | sin(α ± β) = sin α cos β ± cos α sin β; cos(α ± β) = cos α cos β ∓ sin α sin β |
| Double angle | sin 2θ = 2 sin θ cos θ; cos 2θ = cos²θ − sin²θ = 2cos²θ − 1 = 1 − 2sin²θ |
| Polar ↔ rectangular | x = r cos θ, y = r sin θ; r² = x² + y², tan θ = y/x with a quadrant check |
| Complex polar form | a + bi = r(cos θ + i sin θ), r = √(a² + b²) |
| Rose a cos(nθ) | petal length |a|; n petals (n odd) or 2n (n even) |
| Limaçon a + b cos θ | |a| < |b| inner loop; |a| = |b| cardioid; |a| > |b| no loop |
| Average rate of change of r | (f(θ₂) − f(θ₁))/(θ₂ − θ₁), units of r per radian |

## Classic question types and how to attack them

**"Find the exact value."** Draw the angle, find its reference angle and quadrant, write the unit-circle point, and take the coordinate or ratio you need. For an inverse function, answer inside its range: cos⁻¹(−1/2) = 2π/3, not 4π/3.

**"Write a sinusoidal function for this context."** List max, min, the time of one max (or min) and the period. Compute d, a, b; use cosine from a maximum, −cosine from a minimum. Check by substituting the time of the max. State units for each parameter.

**"Interpret a parameter or a value of the model."** Name the quantity, the units and the time: "the depth oscillates 2 m above and below its average of 6 m" for amplitude 2 and midline 6.

**"Solve on [0, 2π)" or "find all solutions."** Isolate; if the angle is bx, widen the interval first; list every quadrant; add the period for "all". For a product, set each factor to zero.

**"Solve the inequality" or "for how long is ... above ...?"** Solve the equation for the boundaries, then decide each piece by a test value or the graph. In context, the length of an interval answers "for how long".

**"Rewrite" or "show that ... is equivalent".** Pick the identity that removes the obstacle: a double angle when the angles differ, a Pythagorean identity when squares appear, sines and cosines when reciprocals appear. Transform one side only.

**"Convert this point, equation or complex number."** Use x = r cos θ, y = r sin θ; for r and θ, compute √(x² + y²) and check the quadrant before trusting tan⁻¹.

**"Describe the polar graph" or "is the curve getting closer to the pole?"** Sketch or imagine r against θ. Sign of r and direction of change together decide distance. Farthest point: largest |r|, which may be a negative r.

## Common mistakes

- Degree mode on the calculator; or giving angles in degrees when radians are expected.
- Taking the inverse function's single answer as the whole solution set.
- Period errors: 2π·b instead of 2π/b; using 2π for tangent.
- Amplitude as max − min instead of half of it; amplitude reported as negative.
- Phase shift sign: f(θ) = sin(θ − π/3) moves right by π/3; sin(2θ − π/3) = sin(2(θ − π/6)) moves right by π/6, not π/3.
- Dividing by sin x or cos x in an equation, losing solutions.
- Treating trigonometric functions as linear: sin(α + β) ≠ sin α + sin β, cos 2x ≠ 2 cos x.
- Quadrant errors in rectangular-to-polar conversion; plotting negative r in the direction θ.
- Petal counts: n for odd n, 2n for even n.
- Saying the curve moves away from the pole just because r is increasing.

## Calculator or not?

Most Unit 3 questions on the AP exam are non-calculator in spirit: exact values, transformations, identities, polar families and qualitative rate questions. A graphing calculator matters for non-special equations (sin x = 0.4), for modelling with sinusoidal regression, and for finding intersections such as when a model reaches a given value. Always set radian mode, give answers to three decimal places unless told otherwise, and report what the calculator does ("using the intersect feature") in a free-response answer.

## Self-test

1. Find the exact values of sin(7π/6), cos(3π/4) and tan(5π/3).
2. State the amplitude, period, phase shift and midline of y = −3 cos(2(θ − π/4)) + 5.
3. A hypothetical buoy bobs between 1.2 m and 3.8 m above the sea floor, with a peak at t = 2 s and a period of 6 s. Write a model for its height.
4. Evaluate tan⁻¹(−√3) and cos⁻¹(−√2/2).
5. Solve 2 sin²x − 3 sin x + 1 = 0 on [0, 2π).
6. Solve cos(2x) ≤ 1/2 on [0, π).
7. Show that (1 + tan²x) cos²x = 1.
8. Find the exact value of sin(π/12).
9. Convert (−2√3, 2) to polar coordinates with r > 0, 0 ≤ θ < 2π, and write −2√3 + 2i in polar form.
10. For r = 1 − 2 sin θ, find where the curve passes through the pole and say whether the distance from the pole is increasing or decreasing on (π/6, π/2).

**Answers.**
1. −1/2, −√2/2, −√3.
2. Amplitude 3, period π, shift right π/4, midline y = 5.
3. Midline 2.5, amplitude 1.3, b = 2π/6 = π/3: h(t) = 2.5 + 1.3 cos(π(t − 2)/3).
4. −π/3; 3π/4.
5. (2 sin x − 1)(sin x − 1) = 0: x = π/6, π/2, 5π/6.
6. With u = 2x on [0, 2π): cos u ≤ 1/2 for π/3 ≤ u ≤ 5π/3, so π/6 ≤ x ≤ 5π/6.
7. 1 + tan²x = sec²x, and sec²x · cos²x = 1.
8. sin(π/3 − π/4) = (√6 − √2)/4.
9. r = √(12 + 4) = 4; quadrant II with tan θ = −1/√3, so θ = 5π/6: (4, 5π/6), and −2√3 + 2i = 4(cos(5π/6) + i sin(5π/6)).
10. r = 0 when sin θ = 1/2: θ = π/6 and 5π/6. On (π/6, π/2), r falls from 0 to −1: negative and decreasing, so the distance from the pole is increasing.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 3, Topics 3.1–3.15). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
