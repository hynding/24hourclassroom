# Week 6 · The Unit Circle and Fundamental Identities

**Topics:** 1.11 The Unit Circle and Exact Values · 1.12 Fundamental Identities
**Standards:** HSF-TF.A.2 (the unit circle extends the functions to all real numbers); HSF-TF.A.3 (exact values at π/6, π/4, π/3 and their reflections); HSF-TF.A.4 (symmetry and periodicity); HSF-TF.C.8 (the Pythagorean identity and using it to find values)
**Spiral:** Week 4 showed that an angle of θ radians cuts off an arc of length θ on a circle of radius 1. Week 5 defined the six functions from any point (x, y) on the terminal side, with signs by quadrant and reference angles. Week 2's exact values at 30°, 45° and 60° are the only numbers you need to memorise: this week turns them into the whole unit circle, and turns x² + y² = r² into identities.

## What you need to be able to do

- **1.11** Explain why the point at angle θ on the unit circle is (cos θ, sin θ).
- **1.11** Give the exact coordinates of every special angle (multiples of 30° and 45°, or π/6 and π/4) in degrees and radians, and the six function values there.
- **1.11** Use periodicity to evaluate functions at angles beyond one turn.
- **1.12** Use the even/odd identities: cos(−θ) = cos θ, sin(−θ) = −sin θ, tan(−θ) = −tan θ.
- **1.12** State and use the reciprocal, quotient and three Pythagorean identities.
- **1.12** Find all function values from one value and a quadrant, using identities instead of a triangle, and simplify short expressions.

## Key terms

| Term | Meaning |
|---|---|
| Unit circle | The circle x² + y² = 1, radius 1, centred at the origin. |
| Periodic function | f(θ + p) = f(θ) for every θ; the least such positive p is the period. Sine and cosine have period 2π (360°); tangent has period π (180°). |
| Even function | f(−θ) = f(θ): cosine and secant. |
| Odd function | f(−θ) = −f(θ): sine, cosecant, tangent and cotangent. |
| Identity | An equation true for every value of the variable for which both sides are defined. |
| Pythagorean identities | sin²θ + cos²θ = 1, 1 + tan²θ = sec²θ, 1 + cot²θ = csc²θ. |

## Why the unit circle (1.11)

In week 5, sin θ = y/r and cos θ = x/r. On the unit circle r = 1, so the definitions collapse:

**the point at angle θ on the unit circle is (cos θ, sin θ).**

Cosine is the x-coordinate and sine is the y-coordinate; tan θ = y/x = sin θ/cos θ. And because the radius is 1, an angle of θ radians cuts off an arc of length exactly θ (s = rθ = θ). That is why the functions can take any real number as input: walk a distance θ around the circle and read off the coordinates.

**Building the circle from three points.** The 30-60-90 and 45-45-90 triangles with hypotenuse 1 give the first-quadrant points:

| θ | 0 | π/6 (30°) | π/4 (45°) | π/3 (60°) | π/2 (90°) |
|---|---|---|---|---|---|
| (cos θ, sin θ) | (1, 0) | (√3/2, 1/2) | (√2/2, √2/2) | (1/2, √3/2) | (0, 1) |
| tan θ | 0 | √3/3 | 1 | √3 | undefined |

Every other special point is a reflection of one of these: same sizes, signs from the quadrant (week 5). For example, the angles with reference angle π/3 are π/3, 2π/3, 4π/3 and 5π/3, with points (1/2, √3/2), (−1/2, √3/2), (−1/2, −√3/2) and (1/2, −√3/2).

**Worked example 1.** Give the unit-circle points for 5π/6, 4π/3 and 7π/4, and find tan(4π/3).

- 5π/6 (150°): quadrant II, reference angle π/6: **(−√3/2, 1/2)**.
- 4π/3 (240°): quadrant III, reference angle π/3: **(−1/2, −√3/2)**.
- 7π/4 (315°): quadrant IV, reference angle π/4: **(√2/2, −√2/2)**.
- tan(4π/3) = (−√3/2)/(−1/2) = **√3**.

A quick check: the coordinate with √3/2 is the one farther from the axis it is measured along. At π/6 the point is close to the x-axis, so its x-coordinate is the big one, √3/2.

## Periodicity and symmetry (1.11, 1.12)

Adding a full turn returns to the same point, so

sin(θ + 2π) = sin θ, cos(θ + 2π) = cos θ, tan(θ + π) = tan θ.

To evaluate at a large angle, remove whole turns first.

Reflecting the point across the x-axis turns θ into −θ: (x, y) becomes (x, −y). So

cos(−θ) = cos θ (even), sin(−θ) = −sin θ (odd), tan(−θ) = −tan θ (odd).

**Worked example 2.** Find sin(25π/6), cos(−2π/3) and tan(−π/3).

- 25π/6 = 24π/6 + π/6 = 4π + π/6, two full turns plus π/6: sin(25π/6) = sin(π/6) = **1/2**.
- Cosine is even: cos(−2π/3) = cos(2π/3) = **−1/2**.
- Tangent is odd: tan(−π/3) = −tan(π/3) = **−√3**.

## The fundamental identities (1.12)

**Reciprocal:** csc θ = 1/sin θ, sec θ = 1/cos θ, cot θ = 1/tan θ.
**Quotient:** tan θ = sin θ/cos θ, cot θ = cos θ/sin θ.
**Pythagorean:** the point (cos θ, sin θ) lies on x² + y² = 1, so

sin²θ + cos²θ = 1.

Divide every term by cos²θ (where cos θ ≠ 0): tan²θ + 1 = sec²θ. Divide instead by sin²θ: 1 + cot²θ = csc²θ. You only need to remember the first; the other two follow in one line. (sin²θ means (sin θ)², not sin(θ²).)

**Worked example 3.** sin θ = 0.6 and θ is in quadrant II. Find cos θ and tan θ.

cos²θ = 1 − 0.6² = 1 − 0.36 = 0.64, so cos θ = ±0.8. In quadrant II cosine is negative: **cos θ = −0.8**. Then tan θ = 0.6/(−0.8) = **−0.75**.

The identity gives the size; the quadrant gives the sign. A square root always produces ± first.

**Worked example 4.** sec θ = −3 and θ is in quadrant III. Find tan θ, cos θ and sin θ.

1 + tan²θ = sec²θ = 9, so tan²θ = 8 and tan θ = ±2√2. Tangent is positive in quadrant III: **tan θ = 2√2**. cos θ = 1/sec θ = **−1/3**. sin θ = tan θ · cos θ = 2√2 · (−1/3) = **−2√2/3**.

Check: sin²θ + cos²θ = 8/9 + 1/9 = 1.

**Worked example 5.** Simplify sec θ − sin θ tan θ.

Write everything in sines and cosines: 1/cos θ − sin θ · sin θ/cos θ = (1 − sin²θ)/cos θ = cos²θ/cos θ = **cos θ** (wherever cos θ ≠ 0).

The strategy, in order: rewrite in sines and cosines, combine fractions, look for sin²θ + cos²θ.

**Try it.**
1. Give the unit-circle point for 3π/4 and find sec(3π/4).
2. Evaluate cos(13π/3) and sin(−5π/6).
3. cos θ = 5/13 with θ in quadrant IV. Find sin θ and cot θ using an identity.
4. Simplify (1 − cos²θ) csc θ.

*Answers:* 1. (−√2/2, √2/2); sec = −2/√2 = −√2. 2. 13π/3 = 4π + π/3, so 1/2; −1/2. 3. sin²θ = 1 − 25/169 = 144/169, sin θ = −12/13; cot θ = −5/12. 4. sin²θ · (1/sin θ) = sin θ.

## Exact values versus calculator values

A calculator will tell you that sin(5π/6) is 0.5 and cos(π/6) is about 0.8660, but on this unit's questions an exact answer is expected: 1/2 and √3/2. Use the calculator only to check. Set it to radian mode for angles such as 5π/6 and to degree mode for angles such as 150°; the same keystrokes in the wrong mode give a different, wrong number. For a value from an identity, such as cos θ = −0.8, keep the exact fraction or decimal through each step and round only at the end, if the question asks for a decimal at all.

## Common errors

- **Swapping coordinates.** The point is (cos θ, sin θ): x first, cosine first.
- **Dropping the ± after a square root.** cos θ = √(1 − sin²θ) is only right in quadrants I and IV.
- **Treating sine as even.** sin(−π/6) = −1/2, not 1/2; only cosine and secant are even.
- **Inventing identities.** tan²θ − 1 is not sec²θ; it is 1 + tan²θ that equals sec²θ.
- **Reading sin²θ as sin(θ²).** The square is on the output.
- **Using 2π as tangent's period.** It is π; tan(θ + π) = tan θ.

## Where this goes next

Unit 2 unrolls the unit circle: plotting (θ, sin θ) for θ from 0 to 2π gives the sine wave, and periodicity and even/odd symmetry become features of the graphs. Unit 3 builds on the Pythagorean, quotient and reciprocal identities to simplify expressions, verify identities and solve equations. This week ends Unit 1, so the unit summary and unit exam come next.

## Self-check

1. List the unit-circle points for 2π/3, 5π/4 and 11π/6.
2. Evaluate sin(−3π/4), cos(19π/6) and tan(7π/3).
3. tan θ = −3/4 with θ in quadrant II. Use 1 + tan²θ = sec²θ to find sec θ, then find cos θ and sin θ.
4. Explain why sin θ can never equal 1.2.
5. Simplify tan θ csc θ.

*Answers:* 1. (−1/2, √3/2), (−√2/2, −√2/2), (√3/2, −1/2). 2. −√2/2; 19π/6 − 2π = 7π/6, so −√3/2; √3. 3. sec²θ = 25/16, sec θ = −5/4, cos θ = −4/5, sin θ = 3/5. 4. sin θ is a y-coordinate on a circle of radius 1, so −1 ≤ sin θ ≤ 1. 5. (sin θ/cos θ)(1/sin θ) = 1/cos θ = sec θ.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.A.2, HSF-TF.A.3, HSF-TF.A.4, HSF-TF.C.8); its approach follows the trigonometry lessons of IM 9–12 Math by Illustrative Mathematics (© 2019, CC BY 4.0). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
