# Unit 6 · Trigonometric Functions · The night-before sheet

**Exam weight:** about 15–18% of the final · **Lessons:** 6.1 Moving in Circles · 6.2 Revisiting Right Triangles · 6.3 The Unit Circle (Part 1) · 6.4 The Unit Circle (Part 2) · 6.5 The Pythagorean Identity (Part 1) · 6.6 The Pythagorean Identity (Part 2) · 6.7 Finding Unknown Coordinates on a Circle · 6.8 Rising and Falling · 6.9 Introduction to Trigonometric Functions · 6.10 Beyond 2π · 6.11 Extending the Domain of Trigonometric Functions · 6.12 Tangent · 6.13 Amplitude and Midline · 6.14 Transforming Trigonometric Functions · 6.15 Features of Trigonometric Graphs (Part 1) · 6.16 Features of Trigonometric Graphs (Part 2) · 6.17 Comparing Transformations · 6.18 Modeling Circular Motion · 6.19 Beyond Circles
**Practices:** MP2, MP4, MP6, MP7
**Built from:** IM Algebra 2, Unit 6, in our own words

## The ideas that generate every question

1. **A point on a circle is (r cos θ, r sin θ).** Cosine is the x-coordinate and sine the y-coordinate of the unit-circle point at angle θ, measured counterclockwise from the positive x-axis; a bigger circle just scales both. Every other fact in the unit is this one in disguise.
2. **Radians are arc length on the unit circle.** A full turn is 2π, a half turn π, a quarter turn π/2; multiply degrees by π/180. The labelled points sit at multiples of π/6 and π/4, and their coordinates come from the 30-60-90 and 45-45-90 triangles with hypotenuse 1.
3. **Reference angles and quadrant signs do the rest of the circle.** A point's coordinates are those of its reference angle with the signs of its quadrant: (+, +), (−, +), (−, −), (+, −) for I to IV. Reflections give the rules cos(−θ) = cos θ, sin(−θ) = −sin θ, sin(π − θ) = sin θ, cos(π − θ) = −cos θ.
4. **cos²θ + sin²θ = 1** because the point is on the unit circle. It gives one coordinate from the other up to sign; the quadrant chooses the sign.
5. **Sine and cosine are functions of any real angle,** with range [−1, 1] and period 2π; angles beyond 2π or below 0 are coterminal with an angle in [0, 2π). Their graphs are waves: sine starts at the midline going up, cosine starts at a peak. Tangent is the slope of the ray, sin θ / cos θ, undefined at odd multiples of π/2, with period π and all real values.
6. **Four features describe any transformed wave:** y = a sin(b(θ − h)) + k has midline y = k, amplitude |a|, period 2π/b and horizontal shift h. Read them from an equation; build them from a graph with midline = (max + min)/2, amplitude = (max − min)/2, period = peak to peak, shift = where the cycle starts. Factor the inside before reading the shift.
7. **Periodic situations are transformed waves in time.** A wheel with period T has b = 2π/T; start at the top with +cos, at the bottom with −cos, level and rising with +sin. Daylight, tides, the Moon and temperatures fit the same recipe, approximately.

## Key formulas and procedures

| Want | Do this |
|---|---|
| Missing coordinate on a circle | x² + y² = r², then choose the sign from the position |
| Point at angle θ, radius r | (r cos θ, r sin θ) |
| Degrees ↔ radians | × π/180 to radians, × 180/π to degrees |
| Arc length for angle θ (radians) | rθ |
| Exact values | π/6: (√3/2, 1/2); π/4: (√2/2, √2/2); π/3: (1/2, √3/2); axes: 0, ±1 |
| Other quadrants | reference angle + quadrant signs |
| sin θ from cos θ | sin θ = ±√(1 − cos²θ); quadrant picks the sign |
| Angle from a point (x, y) | α = arccos(|x|/r); θ = α, π − α, π + α, 2π − α by quadrant |
| Angle beyond 2π or negative | add or subtract 2π until in [0, 2π) |
| tan θ | sin θ / cos θ = y/x; undefined where cos θ = 0 |
| Midline, amplitude | k, |a|; from a graph (max + min)/2, (max − min)/2 |
| Period | 2π/b; b = 2π/period |
| Shift | h in a sin(b(θ − h)) + k; factor b out first |
| Wheel in time, period T | b = 2π/T; +cos top, −cos bottom, +sin level rising |
| All solutions of sin θ = c | the two angles in [0, 2π), each + 2πk |
| All solutions of tan θ = c | one angle + πk |

## Common errors

- Swapping sine and cosine: cosine is x, sine is y.
- Degree mode on a calculator when the angle is in radians (and the reverse).
- Dropping the ± when solving cos²θ = k, or trusting arccos for a quadrant III or IV angle.
- Treating sin(−θ) as sin θ; only cosine is even.
- Giving tan θ period 2π, or giving tan(π/2) a value.
- Amplitude as max − min (it is half) and midline as the minimum (it is the average).
- Reading the shift of sin(2θ − π/2) as π/2 (it is π/4).
- b = period instead of 2π/period; peak-to-trough as a full period (it is half).
- Starting a bottom-boarding Ferris wheel with +sin instead of −cos; check h(0).
- Forgetting the second solution: a height is reached once going up and once going down in each turn.

## Worked examples

**Coordinates.** Radius 10 at 120°: (10 cos 120°, 10 sin 120°) = (−5, 5√3). Radius 13 with y = −12 and x < 0: x = −5. Point (−3, 4) on radius 5: θ = arccos(−0.6) ≈ 2.21; point (−3, −4): θ = π + 0.93 ≈ 4.07.

**Identity.** sin θ = −7/25 in quadrant IV: cos θ = 24/25, tan θ = −7/24. cos θ = −5/13 with π < θ < 3π/2: sin θ = −12/13, tan θ = 12/5.

**Evaluate.** sin(17π/4) = sin(π/4) = √2/2; cos(10π/3) = cos(4π/3) = −1/2; sin(−5π/6) = −1/2; tan(7π/6) = √3/3; tan(5π/2) undefined.

**Solve.** sin θ = −1/2: θ = 7π/6 + 2πk or 11π/6 + 2πk. cos θ = 0: θ = π/2 + πk. tan θ = 1: θ = π/4 + πk.

**Read features.** y = −3 sin(4(θ + π/8)) + 2: midline 2, amplitude 3, period π/2, left π/8, reflected; maximum 5, minimum −1. y = 2 sin(3θ − π) + 1 = 2 sin(3(θ − π/3)) + 1: shift π/3.

**Write from a graph.** Maximum 9 at θ = 1, minimum 1 at θ = 3: midline 5, amplitude 4, period 4, b = π/2: y = 4 cos((π/2)(θ − 1)) + 5. Check θ = 3: cos π = −1, y = 1 ✓.

**Model a wheel.** Radius 25, centre 30, one turn per 60 s, boarding at the bottom: h(t) = 30 − 25 cos(πt/30); h(10) = 17.5; h = 42.5 when cos(πt/30) = −1/2, t = 20 and 40.

**Model data.** Daylight 15 h on day 172, 9 h on day 355: D(t) = 12 + 3 cos(2π(t − 172)/365); D(80) ≈ 11.96 h. Tide high 5.2 m at 2:00, low 1.0 m 6.2 h later: h(t) = 3.1 + 2.1 cos(2π(t − 2)/12.4).

## What to review from earlier units

- **Unit 5:** the six transformation rules and the order of steps; k · f(x), f(x) + k, f(x − h), f(kx) become amplitude, midline, shift and period. Even and odd symmetry classify cosine and sine.
- **Unit 3:** x² = a has two solutions, which is why the identity gives ± and the quadrant decides; square roots of 2 and 3 in the exact values.
- **Unit 2:** vertical asymptotes and end behavior describe the tangent graph; increasing and decreasing intervals describe a wave.
- **Geometry:** the Pythagorean theorem and sine, cosine, tangent as right-triangle ratios; the 30-60-90 and 45-45-90 triangles.

## Exam-night checklist

1. Can you place every multiple of π/6 and π/4 on the unit circle with exact coordinates, without a table?
2. Can you convert 210°, 315°, 5π/4 and 11π/6 the other way?
3. Can you find sin θ from cos θ and a quadrant, and the angle from a point, with a reference angle?
4. Can you evaluate at 13π/6, −π/3 and 7π/2, and say which of sine, cosine, tangent is even, odd, undefined where?
5. Can you describe the graphs of y = sin θ, y = cos θ and y = tan θ in words, with zeros, extremes, asymptotes and periods?
6. Can you read midline, amplitude, period and shift from y = −2 cos(3(θ − π/4)) + 1, and write an equation from a described wave?
7. Can you turn "one turn every T seconds, boarding at the bottom" into a function of time and solve "when is the height h"?
8. Can you build a daylight or tide model from a high, a low and their times, and say what it cannot predict?

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 6, Lessons 1–19, https://im.kendallhunt.com/HS/teachers/3/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
