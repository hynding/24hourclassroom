# Week 19 · Sine and Cosine Values on the Unit Circle

**Topics:** 3.3 Sine and Cosine Function Values
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 3, Topic 3.3, learning objectives in our own words
**Spiral:** Week 18 defined sin θ = y/r, cos θ = x/r and tan θ = y/x for a point on the terminal ray, and measured angles in radians. This week fixes r = 1 and finds exact values for the angles you will meet again and again. Week 3's even and odd functions reappear as symmetries of the circle. From geometry: the 45°-45°-90° and 30°-60°-90° triangles and the Pythagorean theorem.

## What you need to be able to do

- **3.3** Use the unit circle to state that the point at angle θ is (cos θ, sin θ), so cosine is the horizontal coordinate and sine the vertical coordinate.
- **3.3** Find exact sine, cosine and tangent values for multiples of π/6 and π/4 and for the quadrantal angles 0, π/2, π and 3π/2, using special right triangles.
- **3.3** Find the reference angle of any angle and use it, together with the signs of the coordinates in each quadrant, to get exact values for angles in every quadrant, including negative angles and angles greater than 2π.
- **3.3** Use tan θ = sin θ/cos θ, and the Pythagorean identity sin²θ + cos²θ = 1 to find one value from another when the quadrant is known.
- **3.3** Explain symmetries of the unit circle in function language: cos(−θ) = cos θ, sin(−θ) = −sin θ, sin(π − θ) = sin θ.

## Key terms

| Term | Meaning |
|---|---|
| Unit circle | The circle x² + y² = 1, radius 1, centred at the origin. The point at angle θ is (cos θ, sin θ). |
| Quadrantal angle | An angle whose terminal ray lies on an axis: 0, π/2, π, 3π/2 and their coterminal angles. |
| Special angles | Multiples of π/6 and π/4, whose sines and cosines have exact forms involving 1/2, √2/2 and √3/2. |
| Reference angle | The acute angle between the terminal ray and the x-axis. It is always between 0 and π/2. |
| Exact value | A value written with integers, fractions and radicals, such as −√3/2, rather than a decimal such as −0.866. |
| Pythagorean identity | sin²θ + cos²θ = 1 for every θ. (sin²θ means (sin θ)².) |

## The unit circle: coordinates are cosine and sine (3.3)

On a circle of radius r the point at angle θ is (r cos θ, r sin θ). With r = 1 this becomes **(cos θ, sin θ)**. So reading a sine or cosine value is the same as reading a coordinate:

- cos θ is how far right (positive) or left (negative) the point is;
- sin θ is how far up (positive) or down (negative) it is;
- tan θ = sin θ/cos θ is the slope of the segment from the origin to the point.

Because the point never leaves the unit circle, both sin θ and cos θ stay between −1 and 1.

**Quadrantal angles.** These need no triangle at all:

| θ | 0 | π/2 | π | 3π/2 |
|---|---|---|---|---|
| point | (1, 0) | (0, 1) | (−1, 0) | (0, −1) |
| cos θ | 1 | 0 | −1 | 0 |
| sin θ | 0 | 1 | 0 | −1 |
| tan θ | 0 | undefined | 0 | undefined |

## The special triangles (3.3)

**π/4 (45°).** The terminal ray makes equal angles with the two axes, so the point has equal coordinates a and a. On the unit circle a² + a² = 1, so a = 1/√2 = √2/2. Therefore cos(π/4) = sin(π/4) = √2/2 ≈ 0.707 and tan(π/4) = 1.

**π/6 (30°) and π/3 (60°).** Take an equilateral triangle with sides of length 1 and cut it in half along a line of symmetry. You get a right triangle with hypotenuse 1, short leg 1/2 (opposite the 30° angle) and long leg √(1 − 1/4) = √3/2 (opposite the 60° angle). Placing it on the unit circle:

- at π/6 the point is (√3/2, 1/2): long leg along the x-axis, short leg vertical;
- at π/3 the point is (1/2, √3/2): the triangle is turned the other way.

A quick memory check: the smaller angle has the smaller height. sin(π/6) = 1/2 is less than sin(π/3) = √3/2 ≈ 0.866.

| θ | 0 | π/6 | π/4 | π/3 | π/2 |
|---|---|---|---|---|---|
| cos θ | 1 | √3/2 | √2/2 | 1/2 | 0 |
| sin θ | 0 | 1/2 | √2/2 | √3/2 | 1 |
| tan θ | 0 | √3/3 | 1 | √3 | undefined |

(√3/3 is the same as 1/√3; both forms are acceptable.)

## Reference angles and signs (3.3)

Every special angle outside the first quadrant is a reflection of one inside it. The **reference angle** θ′ is the acute angle between the terminal ray and the x-axis (never the y-axis). For θ between 0 and 2π:

| Quadrant of θ | Reference angle θ′ | Signs (cos, sin, tan) |
|---|---|---|
| I (0 < θ < π/2) | θ | +, +, + |
| II (π/2 < θ < π) | π − θ | −, +, − |
| III (π < θ < 3π/2) | θ − π | −, −, + |
| IV (3π/2 < θ < 2π) | 2π − θ | +, −, − |

The point at θ has the same coordinates as the point at θ′ *up to sign*, and the quadrant decides the signs. That gives a three-step recipe for an exact value:

1. If θ is negative or larger than 2π, replace it with a coterminal angle in [0, 2π).
2. Find the quadrant and the reference angle.
3. Take the first-quadrant value for the reference angle and attach the sign for that quadrant.

**Worked example.** Find sin(5π/6), cos(4π/3) and tan(7π/4).

- 5π/6 is in quadrant II; reference angle π − 5π/6 = π/6; sine is positive there. sin(5π/6) = 1/2.
- 4π/3 is in quadrant III; reference angle 4π/3 − π = π/3; cosine is negative there. cos(4π/3) = −1/2.
- 7π/4 is in quadrant IV; reference angle 2π − 7π/4 = π/4; tangent is negative there. tan(7π/4) = −1.

**Worked example.** Find cos(11π/3) and sin(−3π/4).

11π/3 − 2π = 5π/3, in quadrant IV with reference angle π/3; cosine is positive there, so cos(11π/3) = 1/2.

−3π/4 + 2π = 5π/4, in quadrant III with reference angle π/4; sine is negative, so sin(−3π/4) = −√2/2.

**Worked example.** Find every θ in [0, 2π) with cos θ = −√3/2.

The first-quadrant angle with cosine √3/2 is π/6, so the reference angle is π/6. Cosine is negative in quadrants II and III, giving θ = π − π/6 = 5π/6 and θ = π + π/6 = 7π/6. (Solving equations like this properly is week 23's job; here it is just reading the circle backwards.)

**Try it.**
1. Find exact values of cos(2π/3), sin(7π/6) and tan(5π/4).
2. Find sin(−π/6) and cos(17π/4).
3. Find every θ in [0, 2π) with sin θ = −√2/2.

*Answers:* 1. −1/2, −1/2, 1. 2. −1/2; 17π/4 − 4π = π/4, so √2/2. 3. 5π/4 and 7π/4.

## Symmetries of the circle (3.3)

Reflections of the unit circle turn into identities.

- **Reflect across the x-axis** (θ to −θ): the x-coordinate stays and the y-coordinate flips. So cos(−θ) = cos θ and sin(−θ) = −sin θ. In week 3's language, cosine is an **even** function and sine is an **odd** function.
- **Reflect across the y-axis** (θ to π − θ): the y-coordinate stays and the x-coordinate flips. So sin(π − θ) = sin θ and cos(π − θ) = −cos θ.
- **Rotate a half turn** (θ to θ + π): both coordinates flip. So sin(θ + π) = −sin θ and cos(θ + π) = −cos θ, while tan(θ + π) = tan θ. Tangent repeats every π, a fact week 22 uses.

**Worked example.** Given that sin(0.4) ≈ 0.389, find sin(−0.4), sin(π − 0.4) and sin(π + 0.4).

sin(−0.4) ≈ −0.389 (odd). sin(π − 0.4) ≈ 0.389 (reflection across the y-axis). sin(π + 0.4) ≈ −0.389 (half turn).

## Tangent and the Pythagorean identity (3.3)

Since the point is (cos θ, sin θ), **tan θ = sin θ/cos θ** wherever cos θ ≠ 0. And since the point lies on x² + y² = 1,

**sin²θ + cos²θ = 1** for every θ.

This lets you recover one value from another. The identity gives the size; the quadrant gives the sign.

**Worked example.** sin θ = 3/5 and θ is in quadrant II. Find cos θ and tan θ.

cos²θ = 1 − 9/25 = 16/25, so cos θ = ±4/5. In quadrant II cosine is negative: cos θ = −4/5. Then tan θ = (3/5)/(−4/5) = −3/4.

**Worked example.** cos θ = 0.28 and sin θ < 0. Find sin θ and the quadrant.

sin²θ = 1 − 0.0784 = 0.9216, so sin θ = −0.96 (negative, as given). Cosine positive and sine negative: quadrant IV.

**Worked example.** tan θ = 2 and θ is in quadrant III. Find sin θ and cos θ.

The terminal ray has slope 2, so it passes through (−1, −2) in quadrant III. Then r = √5, cos θ = −1/√5 = −√5/5 and sin θ = −2/√5 = −2√5/5. Check: 1/5 + 4/5 = 1.

**Try it.**
1. cos θ = −5/13 with θ in quadrant III. Find sin θ and tan θ.
2. Is there an angle with sin θ = 0.8 and cos θ = 0.5? Explain.
3. Evaluate sin²(1.2) + cos²(1.2) without a calculator.

*Answers:* 1. sin θ = −12/13, tan θ = 12/5. 2. No: 0.64 + 0.25 = 0.89 ≠ 1, so the point (0.5, 0.8) is not on the unit circle. 3. 1.

## The whole circle at a glance

Putting the reference angles to work gives the familiar unit-circle diagram. Each row lists a quadrant's special angles with their points (cos θ, sin θ).

| Quadrant | Angles | Points |
|---|---|---|
| I | π/6, π/4, π/3 | (√3/2, 1/2), (√2/2, √2/2), (1/2, √3/2) |
| II | 2π/3, 3π/4, 5π/6 | (−1/2, √3/2), (−√2/2, √2/2), (−√3/2, 1/2) |
| III | 7π/6, 5π/4, 4π/3 | (−√3/2, −1/2), (−√2/2, −√2/2), (−1/2, −√3/2) |
| IV | 5π/3, 7π/4, 11π/6 | (1/2, −√3/2), (√2/2, −√2/2), (√3/2, −1/2) |

Learn the first row and the sign pattern; the rest follows.

## Calculator notes

A calculator in radian mode gives decimals such as cos(5π/6) ≈ −0.8660, which you can use to check an exact answer (√3/2 ≈ 0.8660, √2/2 ≈ 0.7071). AP questions about special angles are usually in the no-calculator part and expect exact values. A calculator cannot tell you which quadrant an answer belongs in when you work backwards from a value; the reference-angle reasoning above does that.

## Common mistakes

- **Mixing up π/6 and π/3.** At π/6 the point is low and to the right, (√3/2, 1/2); at π/3 it is high, (1/2, √3/2).
- **Measuring the reference angle from the y-axis.** It is always to the x-axis: the reference angle of 2π/3 is π/3, not π/6.
- **Forgetting the sign.** cos(3π/4) is −√2/2. Decide the quadrant before you write the value.
- **Dropping the ± when using the identity.** cos²θ = 16/25 gives cos θ = ±4/5; the quadrant chooses one.
- **Writing sin²θ as sin(θ²).** sin²θ means the square of sin θ.
- **Calling tan(π/2) "infinity" or 0.** It is undefined, because cos(π/2) = 0.

## Where this goes next

Week 20 plots the unit-circle coordinates against the angle to get the graphs of y = sin θ and y = cos θ, and every value in this week's tables becomes a point on those graphs. Week 22 uses the half-turn symmetry tan(θ + π) = tan θ for the tangent graph and reads this week's tables backwards to define inverse sine, cosine and tangent. Week 24 builds the full set of Pythagorean identities from sin²θ + cos²θ = 1.

## Self-check

1. Give the exact values of sin, cos and tan at 5π/3, and the point on the unit circle.
2. Find the reference angle and exact value of cos(−7π/6).
3. sin θ = −7/25 with θ in quadrant IV. Find cos θ and tan θ.
4. Find every θ in [0, 2π) with tan θ = −1.
5. Explain, using the unit circle, why cos(−θ) = cos θ but sin(−θ) = −sin θ.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 3, Topic 3.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
