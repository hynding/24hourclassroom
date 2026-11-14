# Week 19 · Multiple Angles, Identities and Inequalities

**Topics:** 3.11 Equations with Multiple Angles and Identities · 3.12 Trigonometric Inequalities and Calculator Solutions
**Standards:** HSF-TF.B.7, HSF-TF.C.9, HSF-TF.C.8
**Spiral:** Week 18's five-step plan solves every equation this week once it has been reduced to sin u = k, cos u = k or tan u = k. The reduction uses the whole of this unit: Pythagorean identities (week 13), double-angle formulas (week 16), sum-to-product and the combined form R sin(x + φ) (week 17). Week 11's inverse functions supply calculator answers, and week 10's "when is the height above…" questions become exact inequalities.

## What you need to be able to do

- **3.11** Solve equations with a multiple angle, such as sin 2x = 1/2 or tan 3x = 1, finding every solution in a given interval.
- **3.11** Use an identity to rewrite an equation in one function of one angle (Pythagorean, double-angle, sum-to-product or combined form), then solve it.
- **3.12** Solve equations with non-special values using inverse functions in radian mode, and find every solution in the interval from the calculator's single answer.
- **3.12** Solve trigonometric inequalities on an interval by finding the boundary points and testing the intervals between them, including in context.

## Key terms

| Term | Meaning |
|---|---|
| Multiple-angle equation | An equation in which the unknown appears as kx (k ≠ 1), such as cos 3x = 0. |
| Substitution u = kx | Rename the angle so that the equation is a basic one in u; the interval for u is k times the interval for x. |
| Principal value | The single angle a calculator's sin⁻¹, cos⁻¹ or tan⁻¹ key returns, in that function's restricted range. |
| Boundary points | The solutions of the related equation; the sign of an inequality can change only there (or where a function is undefined). |
| Test interval | An interval between consecutive boundary points, all of whose points either satisfy the inequality or fail it. |

## Multiple angles: stretch the interval first (3.11)

Solve for the angle u = kx, then divide by k. If x runs over [0, 2π), u = kx runs over [0, 2kπ), so there are k times as many solutions to find.

**Worked example 1.** Solve sin 2x = 1/2 on [0, 2π).

Let u = 2x, with 0 ≤ u < 4π (two full turns). sin u = 1/2 gives u = π/6, 5π/6 and, one turn later, u = 13π/6, 17π/6. Dividing by 2:

x = π/12, 5π/12, 13π/12, 17π/12.

Check one: sin(2 · 13π/12) = sin(13π/6) = sin(π/6) = 1/2. Stopping after the first turn (only π/12 and 5π/12) is the classic mistake.

**Worked example 2.** Find all solutions of tan 3x = 1, then those in [0, 2π).

3x = π/4 + πn, so x = π/12 + πn/3. The solutions are spaced π/3 apart: in [0, 2π) they are π/12, 5π/12, 3π/4, 13π/12, 17π/12, 7π/4, six in all. Divide the period by k as well as the first solution.

## Using identities to get one function of one angle (3.11)

When an equation has two functions or two different angles, an identity usually makes it a quadratic or a product.

**Worked example 3 (double angle).** Solve cos 2x + sin x = 0 on [0, 2π).

Choose the form of cos 2x that matches the other term: cos 2x = 1 − 2 sin²x. Then

1 − 2 sin²x + sin x = 0, so 2 sin²x − sin x − 1 = 0, so (2 sin x + 1)(sin x − 1) = 0.

sin x = 1 gives π/2; sin x = −1/2 gives 7π/6 and 11π/6. Solutions: π/2, 7π/6, 11π/6.

**Worked example 4 (double angle, factor, do not divide).** Solve sin 2x = sin x on [0, 2π).

2 sin x cos x − sin x = 0, so sin x (2 cos x − 1) = 0. sin x = 0 gives 0 and π; cos x = 1/2 gives π/3 and 5π/3. Solutions: 0, π/3, π, 5π/3. Dividing by sin x would have lost 0 and π.

**Worked example 5 (Pythagorean).** Solve 2 cos²x + 3 sin x − 3 = 0 on [0, 2π).

Replace cos²x with 1 − sin²x: 2 − 2 sin²x + 3 sin x − 3 = 0, so 2 sin²x − 3 sin x + 1 = 0, which factors as (2 sin x − 1)(sin x − 1) = 0. Solutions: π/6, π/2, 5π/6.

**Worked example 6 (sum-to-product).** Solve sin 3x + sin x = 0 on [0, 2π).

sin 3x + sin x = 2 sin 2x cos x, so sin 2x = 0 or cos x = 0. sin 2x = 0 with 0 ≤ 2x < 4π gives 2x = 0, π, 2π, 3π, so x = 0, π/2, π, 3π/2; cos x = 0 adds nothing new. Solutions: 0, π/2, π, 3π/2.

**Worked example 7 (combined form).** Solve sin x + √3 cos x = 1 on [0, 2π).

By week 17, sin x + √3 cos x = 2 sin(x + π/3), so sin(x + π/3) = 1/2. With u = x + π/3 in [π/3, 7π/3): u = 5π/6 or u = 13π/6, so x = π/2 or x = 11π/6. Check x = 11π/6: −1/2 + √3 · √3/2 = 1. This avoids squaring and its extraneous roots.

## Calculator solutions (3.12)

Set the calculator to **radian mode**. The inverse keys return one principal value; the symmetries of the circle give the rest.

| Equation | Calculator gives | Second solution in [0, 2π) |
|---|---|---|
| sin x = k | α = sin⁻¹ k, in [−π/2, π/2] | π − α (and add 2π to α if α < 0) |
| cos x = k | α = cos⁻¹ k, in [0, π] | 2π − α |
| tan x = k | α = tan⁻¹ k, in (−π/2, π/2) | α + π (and add 2π if α < 0) |

**Worked example 8.** Solve 5 sin x − 2 = 0 and 3 cos x + 2 = 0 on [0, 2π), to three decimal places.

sin x = 0.4: α = sin⁻¹ 0.4 ≈ 0.412, and π − 0.412 ≈ 2.730. Solutions 0.412 and 2.730.

cos x = −2/3: α = cos⁻¹(−2/3) ≈ 2.301, and 2π − 2.301 ≈ 3.983. Solutions 2.301 and 3.983.

For a quadratic that does not factor, use the quadratic formula on u = sin x (or cos x), discard values outside [−1, 1], and then use the table.

## Inequalities: boundary points and test intervals (3.12)

1. Solve the related **equation** on the interval: these are the boundary points.
2. They cut the interval into pieces. Pick a **test value** in each piece, or read the unit circle or the graph.
3. Keep the pieces where the inequality holds; include the boundary points for ≤ or ≥.

**Worked example 9.** Solve 2 cos²x − cos x < 0 on [0, 2π).

Factor: cos x (2 cos x − 1) < 0. A product is negative when its factors have opposite signs, which here means 0 < cos x < 1/2. Boundary points: cos x = 0 at π/2, 3π/2; cos x = 1/2 at π/3, 5π/3. Testing (or reading the unit circle) gives

π/3 < x < π/2 or 3π/2 < x < 5π/3.

**Worked example 10 (context, hypothetical).** A Ferris wheel seat is h(t) = 10 − 8 cos(πt/15) metres above the ground, t seconds after boarding; one revolution takes 30 s. When during the first revolution is the seat at least 14 m up?

h(t) ≥ 14 means cos(πt/15) ≤ −1/2. With u = πt/15 in [0, 2π], cos u ≤ −1/2 for 2π/3 ≤ u ≤ 4π/3, so 10 ≤ t ≤ 20. The seat is at least 14 m up for 10 seconds, a third of each revolution. For a non-special level such as 5 m, cos(πt/15) = 5/8 gives t = (15/π) cos⁻¹(0.625) ≈ 4.276 s, and by symmetry 30 − 4.276 ≈ 25.724 s.

## Common errors

- **Not stretching the interval.** sin 2x = 1/2 has four solutions on [0, 2π), not two.
- **Dividing the first solution by k but not the period.** tan 3x = 1 gives x = π/12 + πn/3, not π/12 + πn.
- **Choosing the wrong form of cos 2x.** Pick the one that matches the other function in the equation.
- **Degree mode.** sin⁻¹ 0.4 ≈ 23.578 in degrees is not a radian answer.
- **Trusting the calculator's single value.** Always find the second solution and any negative-angle adjustment.
- **Inequalities solved like equations.** Boundary points alone are not the answer; test the intervals between them.

## Where this goes next

This closes Unit 3. Unit 4 solves triangles, where the ambiguous case is exactly a sine equation with two solutions in (0°, 180°) found by the π − α rule. Unit 5 solves r = 0 for polar graphs and finds complex roots with angles θ/n + 2πk/n, which is this week's "divide the period by k" in another form.

## Self-check

1. Solve cos 2x = −√3/2 on [0, 2π).
2. Solve cos 2x = cos x on [0, 2π).
3. (Calculator.) Solve tan x = −3 on [0, 2π), to three decimal places.
4. Solve sin x ≥ 1/2 on [0, 2π).
5. Solve tan x > 1 on [0, 2π), remembering where tangent is undefined.

*Answers:* 1. 2x = 5π/6, 7π/6, 17π/6, 19π/6, so x = 5π/12, 7π/12, 17π/12, 19π/12. 2. 2cos²x − cos x − 1 = 0: cos x = 1 or −1/2, so x = 0, 2π/3, 4π/3. 3. tan⁻¹(−3) ≈ −1.249, so x ≈ 1.893 and 5.034. 4. π/6 ≤ x ≤ 5π/6. 5. π/4 < x < π/2 or 5π/4 < x < 3π/2.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.B.7, HSF-TF.C.9, HSF-TF.C.8). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
