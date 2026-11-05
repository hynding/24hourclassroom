# Week 18 · Solving Trigonometric Equations

**Topics:** 3.10 Solving Trigonometric Equations
**Standards:** HSF-TF.B.7, HSF-TF.B.6, HSF-TF.A.2
**Spiral:** Weeks 13–17 were about identities, statements true for every x. This week turns to equations, statements true only for some x, and asks which ones. Week 5's reference angles and quadrant signs place every solution, week 6's unit circle supplies the exact values, week 7's periods turn one solution into infinitely many, and week 11's inverse functions return exactly one angle, which is why they are a starting point and never the whole answer.

## What you need to be able to do

- **3.10** Solve a linear trigonometric equation such as 2 sin x − 1 = 0 exactly, giving all solutions (with + 2πn or + πn, n an integer) or only those in [0, 2π).
- **3.10** Solve equations that are quadratic in form, such as 2 sin²x − sin x − 1 = 0, by factoring or taking square roots.
- **3.10** Solve equations by moving everything to one side and factoring out a common trigonometric factor, never dividing by it.
- **3.10** Recognise equations with no solution, and check for extraneous roots after squaring both sides.

## Key terms

| Term | Meaning |
|---|---|
| Trigonometric equation | An equation containing trigonometric functions of the unknown that is true for some values but not all. |
| General solution | A description of every solution, using the period: for example x = π/6 + 2πn, n an integer. |
| Solutions in an interval | Only the solutions inside a stated interval, usually [0, 2π) (or [0°, 360°) in degree work). |
| Reference angle | The acute angle between the terminal side and the x-axis (week 5); it gives the size of the value, the quadrant gives the sign. |
| Quadratic in form | An equation such as 2u² − u − 1 = 0 where u is sin x, cos x or tan x. |
| Extraneous root | A value produced by an algebra step (usually squaring) that does not satisfy the original equation. |

## The plan for every equation

1. **Isolate** the trigonometric function: sin x = k, cos x = k or tan x = k.
2. **Check** that k is possible: |k| ≤ 1 for sine and cosine. sin x = 5/3 has no solution at all.
3. **Find the reference angle** from |k| (exact values from the unit circle).
4. **Place it** in every quadrant where the function has the sign of k (All Students Take Calculus: sine positive in I and II, cosine in I and IV, tangent in I and III).
5. **Add the period**: + 2πn for sine and cosine, + πn for tangent. For an interval, list only the values that fall inside it.

Sine and cosine produce two solutions per turn (except at ±1 and 0, where the two coincide or sit on an axis). Tangent produces one solution per half-turn, so one formula with + πn covers both quadrants.

## Linear equations (3.10)

**Worked example 1.** Solve 2 sin x − 1 = 0, giving all solutions and the solutions in [0, 2π).

sin x = 1/2. The reference angle is π/6. Sine is positive in quadrants I and II, so x = π/6 or x = π − π/6 = 5π/6.

All solutions: x = π/6 + 2πn or x = 5π/6 + 2πn, n an integer. In [0, 2π): x = π/6 and 5π/6.

Check: 2 sin(5π/6) − 1 = 2(1/2) − 1 = 0.

**Worked example 2.** Solve √3 tan x + 1 = 0.

tan x = −1/√3 = −√3/3. The reference angle is π/6. Tangent is negative in quadrants II and IV: x = 5π/6 or 11π/6, and these differ by exactly π. So the general solution is a single family: x = 5π/6 + πn. (Equivalently x = −π/6 + πn.)

A calculator would give tan⁻¹(−√3/3) = −π/6, a perfectly good member of the family, but not one in [0, 2π). Inverse functions return one angle; the period finds the rest.

## Quadratic in form (3.10)

When the function is squared, treat it as a variable.

**Worked example 3.** Solve 4 cos²x − 3 = 0 on [0, 2π), then give the general solution.

cos²x = 3/4, so cos x = √3/2 **or** cos x = −√3/2. Forgetting the ± is the most common error here. The reference angle is π/6 in every quadrant:

- cos x = √3/2: x = π/6, 11π/6;
- cos x = −√3/2: x = 5π/6, 7π/6.

Four solutions, spaced so that π/6 and 7π/6 are π apart, as are 5π/6 and 11π/6. The general solution compresses to x = π/6 + πn or x = 5π/6 + πn.

**Worked example 4.** Solve 2 sin²x − sin x − 1 = 0 on [0, 2π).

Let u = sin x: 2u² − u − 1 = (2u + 1)(u − 1) = 0, so sin x = −1/2 or sin x = 1.

- sin x = 1: x = π/2 (a single quadrantal angle).
- sin x = −1/2: reference angle π/6, sine negative in III and IV: x = 7π/6, 11π/6.

Solutions: π/2, 7π/6, 11π/6.

If a quadratic does not factor, the quadratic formula gives the values of u; any value outside [−1, 1] is rejected, and non-special values need a calculator (week 19).

## Factoring: never divide by a trigonometric function (3.10)

**Worked example 5.** Solve 2 sin x cos x = cos x on [0, 2π).

The tempting move is to divide both sides by cos x, giving sin x = 1/2 and x = π/6, 5π/6. That loses every solution where cos x = 0, because dividing by zero is not allowed. Instead, move everything to one side and factor:

2 sin x cos x − cos x = 0
cos x (2 sin x − 1) = 0

- cos x = 0: x = π/2, 3π/2.
- sin x = 1/2: x = π/6, 5π/6.

Four solutions: π/6, π/2, 5π/6, 3π/2. Check π/2: 2 · 1 · 0 = 0 = cos(π/2). The divided version found only half of them.

The same rule applies to sin x tan x = sin x: factor as sin x (tan x − 1) = 0 to get x = 0, π (from sin x = 0) as well as π/4, 5π/4.

## Squaring both sides and extraneous roots (3.10)

When an equation mixes sine and cosine with no easy identity, squaring both sides can produce a single function. But squaring is not reversible: a = b and a = −b both become a² = b². So **every candidate must be checked in the original equation**.

**Worked example 6.** Solve sin x + cos x = 1 on [0, 2π).

Square: sin²x + 2 sin x cos x + cos²x = 1. Since sin²x + cos²x = 1, this leaves 2 sin x cos x = 0, so sin x = 0 or cos x = 0. Candidates: 0, π/2, π, 3π/2.

| x | sin x + cos x | Equals 1? |
|---|---|---|
| 0 | 0 + 1 = 1 | yes |
| π/2 | 1 + 0 = 1 | yes |
| π | 0 − 1 = −1 | no (extraneous) |
| 3π/2 | −1 + 0 = −1 | no (extraneous) |

Solutions: x = 0 and x = π/2. The two rejected candidates solve sin x + cos x = −1, which squares to the same thing. (Week 17's method avoids squaring: √2 sin(x + π/4) = 1 gives the same two answers directly.)

## Degrees or radians?

Use whichever the question states. In degree work the periods become + 360°n and + 180°n: 2 cos θ + √2 = 0 gives θ = 135° + 360°n or 225° + 360°n. Never mix the two (writing π/4 + 180°n is an error).

## Common errors

- **One solution only.** sin x = 1/2 has two solutions per turn; the calculator shows one.
- **Missing ±.** cos²x = 3/4 means cos x = ±√3/2.
- **Dividing by sin x or cos x.** Factor instead.
- **Not checking after squaring.** Extraneous candidates are common.
- **Wrong period.** Tangent repeats every π; using + 2πn for tangent loses half the solutions.
- **Impossible values kept.** sin x = 2 and cos x = −3/2 have no solutions; reject them, do not "solve" them.
- **Interval slips.** [0, 2π) includes 0 but not 2π.

## Where this goes next

Week 19 extends the plan to multiple angles (sin 2x = 1/2 has four solutions in [0, 2π)), to equations that need an identity first, to non-special values with a calculator, and to inequalities, which use these equations to find the boundary points. Unit 4's ambiguous case is a trigonometric equation with two solutions in (0°, 180°), and Unit 5 solves polar equations the same way.

## Self-check

1. Solve 2 cos x + 1 = 0: all solutions.
2. Solve tan²x = 3 on [0, 2π).
3. Solve 2 cos²x + cos x − 1 = 0 on [0, 2π).
4. Solve sin²x = sin x on [0, 2π), and explain what dividing by sin x would lose.
5. Solve cos x − sin x = 1 on [0, 2π) by squaring, and identify the extraneous candidates.

*Answers:* 1. x = 2π/3 + 2πn or 4π/3 + 2πn. 2. π/3, 2π/3, 4π/3, 5π/3. 3. (2 cos x − 1)(cos x + 1) = 0: π/3, π, 5π/3. 4. sin x (sin x − 1) = 0: 0, π/2, π; dividing loses 0 and π. 5. Squaring gives sin x cos x = 0, candidates 0, π/2, π, 3π/2; only 0 and 3π/2 work, π/2 and π are extraneous.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.B.7, HSF-TF.B.6, HSF-TF.A.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
