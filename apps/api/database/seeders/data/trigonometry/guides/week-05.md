# Week 5 · Trigonometric Functions of Any Angle

**Topics:** 1.9 Trigonometric Functions of Any Angle · 1.10 Reference Angles and Signs by Quadrant
**Standards:** HSF-TF.A.2 (extending the trigonometric functions to all angles); HSF-TF.A.3 (using special triangles and symmetry to find values for π − x, π + x and 2π − x)
**Spiral:** Week 1 put angles in standard position, named quadrantal angles and found coterminal angles; weeks 2 and 3 defined the six ratios for acute angles in a right triangle and found exact values at 30°, 45° and 60°. Week 4 added radian measure. This week keeps the ratios but frees them from the triangle, so that sin 150°, cos(−π/3) and tan 270° all mean something.

## What you need to be able to do

- **1.9** Given a point (x, y) on the terminal side of an angle in standard position, find r = √(x² + y²) and all six trigonometric functions.
- **1.9** Evaluate the six functions at quadrantal angles (0°, 90°, 180°, 270° and their radian equivalents), and say which values are undefined and why.
- **1.9** Given one function value and a condition that fixes the quadrant, find the other five.
- **1.10** State the sign of each function in each quadrant.
- **1.10** Find the reference angle of any angle, in degrees or radians.
- **1.10** Use a reference angle and a sign to find exact values such as sin 225° and tan(7π/6).

## Key terms

| Term | Meaning |
|---|---|
| Terminal side | The ray where an angle in standard position stops, after rotating from the positive x-axis. |
| r | The distance from the origin to a point (x, y) on the terminal side: r = √(x² + y²), always positive. |
| Quadrantal angle | An angle whose terminal side lies on an axis: a multiple of 90° (π/2). |
| Reference angle | The acute angle between the terminal side and the **x-axis**. Written θ′; always between 0° and 90°. |
| ASTC | A memory aid for signs: **A**ll positive in quadrant I, **S**ine (and cosecant) in II, **T**angent (and cotangent) in III, **C**osine (and secant) in IV. |

## The definitions for any angle (1.9)

Put an angle θ in standard position and choose any point (x, y), other than the origin, on its terminal side. Let r = √(x² + y²). Then

| sin θ = y/r | cos θ = x/r | tan θ = y/x (x ≠ 0) |
|---|---|---|
| csc θ = r/y (y ≠ 0) | sec θ = r/x (x ≠ 0) | cot θ = x/y (y ≠ 0) |

For an acute angle in quadrant I, this is exactly SOH-CAH-TOA: x is the adjacent leg, y the opposite leg, r the hypotenuse. The new part is that x and y may be negative, so the values may be negative. Which point you choose does not matter: a point twice as far out doubles x, y and r together, and the ratios do not change (week 1's similar triangles again).

**Worked example 1.** The terminal side of θ passes through (−8, −15). Find all six trigonometric functions.

r = √(64 + 225) = √289 = 17. Then

sin θ = −15/17, cos θ = −8/17, tan θ = −15/−8 = **15/8**,
csc θ = −17/15, sec θ = −17/8, cot θ = 8/15.

The point is in quadrant III, where only tangent and cotangent are positive, which matches.

## Quadrantal angles and undefined values (1.9)

On an axis one coordinate is 0, so choose the point at distance 1: (1, 0), (0, 1), (−1, 0) or (0, −1).

| θ | point | sin θ | cos θ | tan θ | csc θ | sec θ | cot θ |
|---|---|---|---|---|---|---|---|
| 0° (0) | (1, 0) | 0 | 1 | 0 | undefined | 1 | undefined |
| 90° (π/2) | (0, 1) | 1 | 0 | undefined | 1 | undefined | 0 |
| 180° (π) | (−1, 0) | 0 | −1 | 0 | undefined | −1 | undefined |
| 270° (3π/2) | (0, −1) | −1 | 0 | undefined | −1 | undefined | 0 |

**A value is undefined exactly when its denominator is 0.** Tangent and secant divide by x, so they fail on the y-axis (90°, 270°). Cotangent and cosecant divide by y, so they fail on the x-axis (0°, 180°). Sine and cosine divide by r, which is never 0, so they are defined for every angle.

**Worked example 2.** Evaluate sin 270° + cos 180° and say whether sec 90° exists.

sin 270° = −1 and cos 180° = −1, so the sum is **−2**. sec 90° = r/x = 1/0, which is **undefined**; it is not 0.

## Signs by quadrant (1.10)

Since r > 0, the sign of each function comes from x and y alone.

| Quadrant | x | y | positive functions |
|---|---|---|---|
| I | + | + | all six |
| II | − | + | sin, csc |
| III | − | − | tan, cot |
| IV | + | − | cos, sec |

Read the table backwards to place an angle: if sin θ < 0 and tan θ > 0, sine rules out I and II, tangent rules out II and IV, so θ is in **quadrant III**.

## Reference angles (1.10)

The reference angle θ′ is the acute angle between the terminal side and the x-axis. Always measure to the x-axis, never to the y-axis.

| θ in quadrant | θ′ in degrees | θ′ in radians |
|---|---|---|
| I | θ | θ |
| II | 180° − θ | π − θ |
| III | θ − 180° | θ − π |
| IV | 360° − θ | 2π − θ |

For an angle outside 0° to 360° (or 0 to 2π), first find the coterminal angle in that range.

**Worked example 3.** Find the reference angles of 310°, −150°, 500° and 11π/8.

- 310° is in quadrant IV: θ′ = 360° − 310° = **50°**.
- −150° is coterminal with 210°, in quadrant III: θ′ = 210° − 180° = **30°**.
- 500° − 360° = 140°, in quadrant II: θ′ = 180° − 140° = **40°**.
- 11π/8 is between π = 8π/8 and 3π/2 = 12π/8, so quadrant III: θ′ = 11π/8 − 8π/8 = **3π/8**.

**Why reference angles work.** The point on the terminal side of θ and the point on the terminal side of θ′ (at the same distance r) are mirror images across an axis or through the origin. Their coordinates have the same sizes and differ at most in sign. So:

**trig function of θ = ± (same function of θ′), with the sign chosen by θ's quadrant.**

**Worked example 4.** Find the exact values of sin 225°, cos 300° and tan(7π/6).

- 225° is in quadrant III with θ′ = 45°. Sine is negative in III: sin 225° = −sin 45° = **−√2/2**.
- 300° is in quadrant IV with θ′ = 60°. Cosine is positive in IV: cos 300° = cos 60° = **1/2**.
- 7π/6 is in quadrant III with θ′ = π/6. Tangent is positive in III: tan(7π/6) = tan(π/6) = **√3/3**.

## Finding all six from one value (1.9)

One value fixes the reference triangle; the quadrant fixes the signs. Draw the point, find the missing coordinate with x² + y² = r², and give it the right sign.

**Worked example 5.** sin θ = −2/3 and tan θ > 0. Find the other five values.

Sine negative and tangent positive put θ in quadrant III, where x < 0 and y < 0. Take y = −2, r = 3 (r is always positive). Then x² = 9 − 4 = 5 and x = −√5.

cos θ = −√5/3, tan θ = −2/−√5 = 2/√5 = **2√5/5**, csc θ = −3/2, sec θ = −3/√5 = **−3√5/5**, cot θ = √5/2.

**Try it.**
1. The terminal side of θ passes through (5, −12). Find sin θ, sec θ and cot θ.
2. Find the reference angle of 2π/3 and of −210°.
3. Find cos 135° and sin(−π/6) exactly.
4. cos θ = 1/4 and sin θ < 0. Find tan θ.

*Answers:* 1. r = 13; −12/13, 13/5, −5/12. 2. π/3; −210° is coterminal with 150°, so 30°. 3. −√2/2; −1/2 (quadrant IV). 4. Quadrant IV, y = −√15, tan θ = −√15.

## Common errors

- **Measuring the reference angle to the y-axis.** For 310°, 310° − 270° = 40° is wrong; the reference angle is 50°.
- **Making r negative.** r is a distance. The signs live in x and y.
- **Saying an undefined value is 0.** sec 90° and tan 270° do not exist.
- **Dropping the sign.** sin 225° is −√2/2, not √2/2: find the quadrant every time.
- **Using the wrong reference formula in radians.** In quadrant III subtract π, not 3π/2.
- **Forgetting to reduce a large angle first.** 500° is not in quadrant IV: subtract 360° to get 140°.

## Where this goes next

Week 6 places the point at distance r = 1, the unit circle, where cos θ and sin θ are simply the coordinates; the reference angles and signs from this week generate every special value in both degrees and radians. The identities of week 6 (sin²θ + cos²θ = 1) are x² + y² = r² divided by r². In Unit 2, the sign pattern ASTC becomes the shape of the graphs of sine, cosine and tangent.

## Self-check

1. The terminal side of θ passes through (−1, √3). Find all six functions and θ in [0°, 360°).
2. Which of the six functions are undefined at θ = π?
3. In which quadrant is θ if cot θ < 0 and sec θ > 0?
4. Find the exact values of tan 330° and cos(5π/4).
5. sec θ = −13/5 with θ in quadrant II. Find sin θ and cot θ.

*Answers:* 1. r = 2: sin = √3/2, cos = −1/2, tan = −√3, csc = 2√3/3, sec = −2, cot = −√3/3; θ = 120°. 2. cot π and csc π. 3. Quadrant IV. 4. −√3/3; −√2/2. 5. x = −5, r = 13, y = 12: sin θ = 12/13, cot θ = −5/12.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.A.2, HSF-TF.A.3); its approach follows the trigonometry lessons of IM 9–12 Math by Illustrative Mathematics (© 2019, CC BY 4.0). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
