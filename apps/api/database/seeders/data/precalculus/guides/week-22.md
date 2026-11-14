# Week 22 · The Tangent Function and Inverse Trigonometric Functions

**Topics:** 3.8 The Tangent Function · 3.9 Inverse Trigonometric Functions
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 3, Topics 3.8–3.9, learning objectives in our own words
**Spiral:** Week 18 introduced tan θ as the slope of the terminal ray, and week 19 gave its exact values and the half-turn identity tan(θ + π) = tan θ. Week 21's transformations work for tangent with one change: the period. Week 6's vertical asymptotes and one-sided limits describe the tangent graph near its breaks, and week 13's rule that only one-to-one functions have inverses, often after restricting the domain, is exactly how inverse sine, cosine and tangent are built.

## What you need to be able to do

- **3.8** Explain tan θ as the slope of the terminal ray and as sin θ/cos θ, and use either view to find values and signs.
- **3.8** Describe the graph of y = tan θ: period π, vertical asymptotes at θ = π/2 + kπ, zeros at θ = kπ, always increasing between asymptotes, concave down to the left of each zero and concave up to the right, and symmetric about the origin.
- **3.8** Find the period, asymptotes and key points of a transformed tangent function f(θ) = a tan(b(θ + c)) + d.
- **3.9** Explain why sine, cosine and tangent need restricted domains to have inverses, and state those domains, which become the ranges of sin⁻¹, cos⁻¹ and tan⁻¹.
- **3.9** Evaluate inverse trigonometric functions at special values, and evaluate compositions such as sin⁻¹(sin θ) and cos(tan⁻¹ x), using the ranges and right triangles.
- **3.9** Describe the graphs, domains and ranges of the inverse trigonometric functions.

## Key terms

| Term | Meaning |
|---|---|
| Tangent function | tan θ = sin θ/cos θ, defined wherever cos θ ≠ 0; the slope of the terminal ray of θ. |
| Vertical asymptote of tan | A line θ = π/2 + kπ, where cos θ = 0 and tan θ is undefined; the outputs grow without bound nearby. |
| Restricted domain | A piece of a function's domain chosen so the function is one-to-one there and takes every output value once. |
| Inverse sine, sin⁻¹ x (also arcsin x) | The angle in [−π/2, π/2] whose sine is x, for x in [−1, 1]. |
| Inverse cosine, cos⁻¹ x (also arccos x) | The angle in [0, π] whose cosine is x, for x in [−1, 1]. |
| Inverse tangent, tan⁻¹ x (also arctan x) | The angle in (−π/2, π/2) whose tangent is x, for any real x. |

Warning about notation: sin⁻¹ x means the inverse function, not 1/sin x. The reciprocal 1/sin x has its own name, csc x, in week 24.

## Tangent as slope and as a ratio (3.8)

For an angle θ in standard position with a point (x, y) on its terminal ray, tan θ = y/x: rise over run, the **slope** of the ray. On the unit circle the point is (cos θ, sin θ), so tan θ = sin θ/cos θ.

The slope view explains the signs and the size at once:

- In quadrant I the ray climbs, so tan θ > 0. It gets steeper as θ approaches π/2, so tan θ grows without bound.
- At θ = π/2 the ray is vertical: no slope, so tan(π/2) is undefined.
- In quadrant II the ray (extended back through the origin) falls from left to right, so tan θ < 0.
- θ and θ + π give opposite rays that lie on the **same line**, with the same slope. That is why tan(θ + π) = tan θ and the period of tangent is π, half the period of sine and cosine.

**Worked example.** A line through the origin makes an angle of 2π/3 with the positive x-axis. Find its slope.

The slope is tan(2π/3) = sin(2π/3)/cos(2π/3) = (√3/2)/(−1/2) = −√3.

## The graph of y = tan θ (3.8)

Tabulate tan θ on (−π/2, π/2):

| θ | −π/2 | −π/3 | −π/4 | −π/6 | 0 | π/6 | π/4 | π/3 | π/2 |
|---|---|---|---|---|---|---|---|---|---|
| tan θ | undefined | −√3 ≈ −1.73 | −1 | −√3/3 ≈ −0.58 | 0 | 0.58 | 1 | 1.73 | undefined |

and look at what happens near the ends. As θ → π/2⁻, sin θ → 1 and cos θ → 0⁺, so tan θ → ∞. As θ → −π/2⁺, tan θ → −∞. One branch of the graph rises from −∞ to ∞ between the asymptotes θ = −π/2 and θ = π/2, passing through (0, 0); the graph repeats this branch every π.

| Feature | y = tan θ |
|---|---|
| Domain | all θ except π/2 + kπ |
| Range | all real numbers |
| Period | π |
| Vertical asymptotes | θ = π/2 + kπ |
| Zeros | θ = kπ |
| Increasing / decreasing | increasing on every interval between consecutive asymptotes |
| Concavity | concave down on (−π/2, 0), concave up on (0, π/2), and the same on every shift by π |
| Symmetry | odd: tan(−θ) = −tan θ |

Unlike sine and cosine, tangent has no maximum, no minimum and no amplitude. Its rate of change is smallest at the zeros (where the slope of the graph is 1) and grows without bound near the asymptotes: from θ = 0 to π/4 the value rises by 1, from π/4 to π/3 by about 0.73 in a much shorter step, and from π/3 to π/2 by "infinity".

**Transformations.** In f(θ) = a tan(b(θ + c)) + d:

- the **period is π/|b|** (not 2π/|b|);
- the asymptotes are where b(θ + c) = π/2 + kπ;
- the "centre" points, where the inside is kπ, have f = d;
- a stretches the graph vertically (there is no amplitude to speak of), and a < 0 turns every branch into a decreasing one.

**Worked example.** For f(θ) = 3 tan(θ − π/4) + 1, find the period, the asymptotes, the centre point between them, and f(π/2).

Period π. Asymptotes where θ − π/4 = π/2 + kπ, that is θ = 3π/4 + kπ (…, −π/4, 3π/4, 7π/4, …). The centre of the branch on (−π/4, 3π/4) is where θ − π/4 = 0, at (π/4, 1). f(π/2) = 3 tan(π/4) + 1 = 3 + 1 = 4. As θ → 3π/4⁻, f(θ) → ∞.

**Worked example.** For g(θ) = 2 tan(θ/2), find the period and the asymptotes, and g(π/2).

Period π/(1/2) = 2π. Asymptotes where θ/2 = π/2 + kπ: θ = π + 2kπ. g(π/2) = 2 tan(π/4) = 2.

**Try it.**
1. State the period and two asymptotes of y = tan(3θ).
2. On which interval inside (0, π) is y = tan θ increasing and concave down?
3. Find the asymptotes and the zero of h(θ) = −tan(θ + π/6) on the branch containing θ = 0, and say whether h is increasing or decreasing there.

*Answers:* 1. Period π/3; θ = π/6 and θ = −π/6 (or any π/6 + kπ/3). 2. (π/2, π). 3. Asymptotes θ = π/3 and θ = −2π/3; zero at θ = −π/6; decreasing, because a = −1.

## Why inverses need restricted domains (3.9)

A function has an inverse only if it is one-to-one (week 13). Sine, cosine and tangent are periodic, so they repeat every output infinitely often: sin(π/6) = sin(5π/6) = sin(13π/6) = 1/2. To define an inverse we choose a piece of the domain where the function

- takes every one of its output values exactly once, and
- is easy to work with (it contains the first-quadrant angles and is one unbroken interval).

The standard choices are:

| Function | Restricted domain | Inverse | Domain of inverse | Range of inverse |
|---|---|---|---|---|
| sin θ | [−π/2, π/2] | sin⁻¹ x | [−1, 1] | [−π/2, π/2] |
| cos θ | [0, π] | cos⁻¹ x | [−1, 1] | [0, π] |
| tan θ | (−π/2, π/2) | tan⁻¹ x | all real x | (−π/2, π/2) |

So an inverse trigonometric function returns an **angle in a specific interval**: inverse sine and inverse tangent give angles in quadrants I and IV (right half of the circle); inverse cosine gives angles in quadrants I and II (top half), because cosine values must cover −1 to 1 and the top half does that once.

**Graphs.** Reflect each restricted graph across y = x. y = sin⁻¹ x runs from (−1, −π/2) to (1, π/2), increasing. y = cos⁻¹ x runs from (−1, π) down to (1, 0), decreasing. y = tan⁻¹ x is defined for every x, increasing, with **horizontal** asymptotes y = −π/2 and y = π/2: the vertical asymptotes of tangent become horizontal ones.

## Evaluating inverse trigonometric functions (3.9)

To evaluate sin⁻¹ x, ask "which angle in [−π/2, π/2] has sine x?" and similarly for the others, using week 19's tables.

**Worked example.** Evaluate sin⁻¹(1/2), sin⁻¹(−1/2), cos⁻¹(−√2/2) and tan⁻¹(−√3).

- sin⁻¹(1/2) = π/6.
- sin⁻¹(−1/2) = −π/6: the angle must be in [−π/2, π/2], so the answer is in quadrant IV, written as a negative angle, not 11π/6.
- cos⁻¹(−√2/2) = 3π/4: the answer must be in [0, π], so a negative cosine gives a quadrant II angle.
- tan⁻¹(−√3) = −π/3.

**Compositions.** Because the inverse undoes the function only on the restricted domain:

- sin(sin⁻¹ x) = x for every x in [−1, 1], and similarly for cos and tan;
- sin⁻¹(sin θ) = θ only when θ is in [−π/2, π/2]. Otherwise find the angle in the restricted range with the same sine.

**Worked example.** Evaluate sin⁻¹(sin(5π/6)) and cos⁻¹(cos(5π/3)).

sin(5π/6) = 1/2 and sin⁻¹(1/2) = π/6, so sin⁻¹(sin(5π/6)) = π/6, not 5π/6. cos(5π/3) = 1/2 and cos⁻¹(1/2) = π/3.

**Worked example (a triangle).** Evaluate cos(sin⁻¹(3/5)) and tan(cos⁻¹(−1/2)).

Let θ = sin⁻¹(3/5): θ is in [−π/2, π/2] with sin θ = 3/5, so θ is in quadrant I. Draw a right triangle with opposite 3 and hypotenuse 5; the adjacent side is 4. So cos θ = 4/5.

Let φ = cos⁻¹(−1/2) = 2π/3. Then tan φ = tan(2π/3) = −√3.

**Worked example (non-special values).** A ladder 6 m long leans against a wall with its top 5.2 m above the ground. Find the angle it makes with the ground.

sin θ = 5.2/6, so θ = sin⁻¹(5.2/6) ≈ 1.05 radians (about 60°). An acute angle is what the context needs, and sin⁻¹ returns one.

**Try it.**
1. Evaluate cos⁻¹(√3/2), tan⁻¹(1) and sin⁻¹(−1).
2. Evaluate sin⁻¹(sin(4π/5)) and tan⁻¹(tan(3π/4)).
3. Evaluate sin(cos⁻¹(5/13)) and cos(tan⁻¹(3/4)).

*Answers:* 1. π/6, π/4, −π/2. 2. π/5; tan(3π/4) = −1, so −π/4. 3. 12/13; 4/5.

## Calculator notes

The sin⁻¹, cos⁻¹ and tan⁻¹ keys always return the value in the restricted range, in radians when the calculator is in radian mode. For example, cos⁻¹(−0.4) ≈ 1.982 and tan⁻¹(−2) ≈ −1.107. If a problem needs an angle in a different interval (say [0, 2π)), use the calculator's answer as a reference and the symmetries of the circle to find the others; week 23 does this systematically. Calculators show sin⁻¹(2) as an error, because no angle has sine 2.

## Common mistakes

- **Period of tangent.** It is π, and π/|b| after a dilation, not 2π/|b|.
- **Looking for an amplitude or maximum of tangent.** Its range is all real numbers.
- **Answers outside the range.** sin⁻¹(−1/2) is −π/6, not 7π/6 or 11π/6; cos⁻¹ never returns a negative angle.
- **Cancelling blindly.** sin⁻¹(sin θ) = θ only on [−π/2, π/2]; cos⁻¹(cos θ) = θ only on [0, π].
- **Reading sin⁻¹ x as 1/sin x.** The −1 is inverse-function notation.
- **Forgetting the triangle's sign.** For cos(sin⁻¹(−3/5)), the angle is in quadrant IV, where cosine is still positive: 4/5.

## Where this goes next

Week 23 solves trigonometric equations and inequalities: an inverse function supplies one solution, and the symmetries and periods from weeks 19 to 22 supply the rest. Week 24 meets the reciprocal functions secant, cosecant and cotangent, whose graphs share tangent's asymptotes, and uses identities to rewrite expressions. In Unit 4, the direction angle of a vector is found with inverse tangent.

## Self-check

1. Give the period, asymptotes and zeros of y = tan(2θ) on [0, π].
2. For f(θ) = −2 tan(θ + π/3) + 1, find the asymptotes on the branch containing θ = 0 and decide whether f is increasing or decreasing there.
3. Evaluate sin⁻¹(√2/2), cos⁻¹(−1) and tan⁻¹(√3/3).
4. Evaluate cos⁻¹(cos(−π/4)) and sin(tan⁻¹(−2)).
5. Explain why the range of cos⁻¹ is [0, π] rather than [−π/2, π/2].

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 3, Topics 3.8–3.9). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
