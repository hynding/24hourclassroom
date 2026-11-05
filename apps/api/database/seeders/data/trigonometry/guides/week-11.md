# Week 11 · Inverse Trigonometric Functions

**Topics:** 2.9 Inverse Sine, Cosine and Tangent · 2.10 Compositions with Inverse Trigonometric Functions
**Standards:** HSF-TF.B.6 (restrict a trigonometric function to a domain where it is always increasing or always decreasing so that its inverse can be constructed), HSF-TF.B.7 (use inverse functions to solve trigonometric equations from modelling contexts and evaluate the solutions with technology)
**Spiral:** Week 3 used the calculator's sin⁻¹ key as "the angle whose sine is", for acute angles in right triangles. Weeks 5 and 6 gave reference angles, signs by quadrant and the unit-circle values. Weeks 7 and 9 drew the graphs of sine, cosine and tangent, and week 10 needed cos⁻¹ to answer "when". This week makes the inverse functions precise: exactly which angle they return, and why.

## What you need to be able to do

- **2.9** Explain why sine, cosine and tangent are not one-to-one, and state the restricted domain each uses to define an inverse.
- **2.9** State the domain and range of sin⁻¹, cos⁻¹ and tan⁻¹, and sketch their graphs from the restricted graphs reflected across y = x.
- **2.9** Evaluate inverse functions exactly at the unit-circle values and with a calculator elsewhere, always answering inside the range.
- **2.10** Evaluate compositions: f(f⁻¹(x)) and f⁻¹(f(θ)), knowing when each simply returns its input.
- **2.10** Evaluate expressions such as cos(tan⁻¹ x) with a reference triangle, getting the sign from the quadrant, and write them as algebraic expressions in x.

## Key terms

| Term | Meaning |
|---|---|
| One-to-one | Each output comes from exactly one input; the condition for an inverse function. |
| Restricted domain | An interval on which a trigonometric function is always increasing or always decreasing and takes each of its values once. |
| sin⁻¹ x (arcsin x) | The angle in [−π/2, π/2] whose sine is x; defined for −1 ≤ x ≤ 1. |
| cos⁻¹ x (arccos x) | The angle in [0, π] whose cosine is x; defined for −1 ≤ x ≤ 1. |
| tan⁻¹ x (arctan x) | The angle in (−π/2, π/2) whose tangent is x; defined for every real x. |
| Principal value | The one angle an inverse function returns, the one inside its range. |

Notation warning: the −1 in sin⁻¹ x marks an inverse function, not a reciprocal. 1/sin x is csc x, and (sin x)⁻¹ is written that way on purpose when a reciprocal is meant.

## Restricting the domain (2.9)

Sine repeats: sin(π/6) = sin(5π/6) = sin(13π/6) = 1/2. A horizontal line y = 1/2 meets its graph infinitely often, so "the angle whose sine is 1/2" is ambiguous. To build an inverse we keep one piece of the graph that

- is always increasing or always decreasing (so it passes the horizontal line test),
- covers every output value once, and
- includes the first-quadrant angles 0 to π/2, where right-triangle trigonometry lives.

| Function | Restricted domain | Behaviour there | Inverse | Domain of inverse | Range of inverse |
|---|---|---|---|---|---|
| sin x | [−π/2, π/2] | increasing, −1 to 1 | sin⁻¹ x | [−1, 1] | [−π/2, π/2] |
| cos x | [0, π] | decreasing, 1 to −1 | cos⁻¹ x | [−1, 1] | [0, π] |
| tan x | (−π/2, π/2) | increasing, all reals | tan⁻¹ x | all reals | (−π/2, π/2) |

Cosine cannot use [−π/2, π/2]: there it takes each positive value twice and never goes negative. On [0, π], the top half of the unit circle, it falls from 1 to −1 exactly once.

A useful picture: **sin⁻¹ and tan⁻¹ answer on the right half of the unit circle** (quadrants I and IV, negative angles for negative inputs); **cos⁻¹ answers on the top half** (quadrants I and II, so never a negative angle).

**Graphs.** Swap the coordinates of the restricted graph.

- y = sin⁻¹ x rises from (−1, −π/2) through (0, 0) to (1, π/2). It is odd.
- y = cos⁻¹ x falls from (−1, π) through (0, π/2) to (1, 0). It is neither odd nor even.
- y = tan⁻¹ x rises through (0, 0) with **horizontal** asymptotes y = −π/2 and y = π/2: tangent's vertical asymptotes, reflected.

## Exact values (2.9)

Ask "which angle in the range has this value?" and use week 6's unit circle.

**Worked example 1.** Evaluate sin⁻¹(√3/2), cos⁻¹(−1/2), tan⁻¹(−1) and sin⁻¹(−√2/2).

- sin⁻¹(√3/2) = π/3.
- cos⁻¹(−1/2): the angle must be in [0, π], and a negative cosine puts it in quadrant II with reference angle π/3: 2π/3.
- tan⁻¹(−1): the range is (−π/2, π/2), so the answer is in quadrant IV: −π/4, not 3π/4 or 7π/4.
- sin⁻¹(−√2/2) = −π/4, for the same reason.

For non-special inputs, use a calculator in radian mode: cos⁻¹(−0.4) ≈ 1.982, tan⁻¹(2.5) ≈ 1.190, sin⁻¹(−0.7) ≈ −0.775. The calculator always returns the principal value. An input outside [−1, 1] for sin⁻¹ or cos⁻¹ is an error, because no angle has sine 1.3.

## Function after inverse, and inverse after function (2.10)

Because each inverse undoes its function only on the restricted domain, the two orders behave differently.

- **sin(sin⁻¹ x) = x** for every x in [−1, 1]. Whatever angle sin⁻¹ returns, its sine is x. The same holds for cos(cos⁻¹ x) on [−1, 1] and tan(tan⁻¹ x) for all x.
- **sin⁻¹(sin θ) = θ only if θ is in [−π/2, π/2].** Otherwise, evaluate the inside first, then find the angle in the range with that value. Likewise cos⁻¹(cos θ) = θ only on [0, π] and tan⁻¹(tan θ) = θ only on (−π/2, π/2).

**Worked example 2.** Evaluate sin⁻¹(sin(2π/3)), cos⁻¹(cos(−π/4)) and tan⁻¹(tan(5π/6)).

- sin(2π/3) = √3/2, and sin⁻¹(√3/2) = π/3. The answer is π/3, the angle in [−π/2, π/2] sharing 2π/3's sine.
- cos(−π/4) = √2/2, and cos⁻¹(√2/2) = π/4. cos⁻¹ never returns −π/4.
- tan(5π/6) = −√3/3, and tan⁻¹(−√3/3) = −π/6. (Tangent has period π, so 5π/6 − π = −π/6 lands in the range.)

## Reference triangles (2.10)

To evaluate a trigonometric function of an inverse function, name the angle, place it in its quadrant, and draw a reference triangle.

**Worked example 3.** Evaluate cos(tan⁻¹(−5/12)) and sin(cos⁻¹(−3/5)).

Let θ = tan⁻¹(−5/12). Then tan θ = −5/12 with θ in (−π/2, π/2), so θ is in quadrant IV: use x = 12, y = −5. Then r = √(144 + 25) = 13 and cos θ = 12/13 (positive in quadrant IV).

Let φ = cos⁻¹(−3/5). Then cos φ = −3/5 with φ in [0, π], so φ is in quadrant II: x = −3, r = 5, y = 4. sin φ = 4/5. The sine of any cos⁻¹ value is never negative, because the top half of the circle has y ≥ 0.

**Worked example 4 (algebraic expressions).** Write tan(sin⁻¹ x) and cos(tan⁻¹ x) as algebraic expressions in x.

Let θ = sin⁻¹ x, so sin θ = x = x/1. Draw a right triangle with opposite side x and hypotenuse 1; the adjacent side is √(1 − x²). Then

tan(sin⁻¹ x) = x/√(1 − x²), for −1 < x < 1.

The formula carries the sign correctly: θ is in quadrant I or IV, where cosine (and so √(1 − x²)) is positive, and tangent has the sign of x. At x = ±1 the tangent is undefined, which is why those inputs are excluded.

Let α = tan⁻¹ x, so tan α = x/1: opposite x, adjacent 1, hypotenuse √(1 + x²). Then cos(tan⁻¹ x) = 1/√(1 + x²), positive for every x, as it must be for an angle in (−π/2, π/2).

## Inverse functions in context (2.9)

**Worked example 5 (hypothetical launch).** An observer stands 5 km from a launch pad. When a rocket rising vertically is h km high, its angle of elevation from the observer is θ(h) = tan⁻¹(h/5), in radians. Find θ when h = 8, and explain why θ can never reach π/2.

θ(8) = tan⁻¹(1.6) ≈ 1.012 radians (about 58°). As h grows without bound, h/5 → ∞ and tan⁻¹ approaches its horizontal asymptote π/2 but never reaches it: the rocket is never directly overhead from a point 5 km away.

**Worked example 6 (one solution, then the rest).** Solve sin x = 0.3 on [0, 2π).

sin⁻¹(0.3) ≈ 0.305 is one solution, in quadrant I. Sine is also positive in quadrant II, at π − 0.305 ≈ 2.837. So x ≈ 0.305 or 2.837. The inverse gave only the principal value; the unit circle gave the other. Unit 3 does this systematically.

## Common errors

- **Answers outside the range.** tan⁻¹(−1) is −π/4, not 3π/4; cos⁻¹(−1/2) is 2π/3, not −2π/3 or 4π/3.
- **Cancelling blindly.** sin⁻¹(sin(5π/6)) is π/6, not 5π/6.
- **Reading sin⁻¹ x as 1/sin x.**
- **Sign errors in triangles.** sin(cos⁻¹(−3/5)) is +4/5; cos(sin⁻¹(−0.6)) is +0.8. Decide the quadrant first.
- **Degree mode.** sin⁻¹(0.5) should read 0.524, not 30, in this unit.
- **Undefined inputs.** sin⁻¹(1.3) and cos⁻¹(−2) do not exist; tan⁻¹ accepts any input.

## Where this goes next

Week 12 completes the family with cot⁻¹, sec⁻¹ and csc⁻¹, evaluated through reciprocals, and adds sums of sinusoids and damped oscillation. In Unit 3, every trigonometric equation starts with an inverse function's principal value and builds the full solution set from it, and in Unit 4 the angles of triangles and the directions of vectors come from inverse functions with careful attention to the range.

## Self-check

1. Evaluate cos⁻¹(√2/2), sin⁻¹(−1/2) and tan⁻¹(√3).
2. Evaluate cos⁻¹(cos(4π/3)) and sin⁻¹(sin(−π/5)).
3. Evaluate tan(cos⁻¹(−5/13)).
4. Write sin(tan⁻¹ x) as an algebraic expression in x.
5. Explain why cos⁻¹ cannot use the restricted domain [−π/2, π/2].

*Answers:* 1. π/4, −π/6, π/3. 2. cos(4π/3) = −1/2, so 2π/3; −π/5 is in the range, so −π/5. 3. Quadrant II, y = 12: tan = −12/5. 4. x/√(1 + x²). 5. On [−π/2, π/2] cosine is not one-to-one (cos(−θ) = cos θ) and never negative.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.B.6, HSF-TF.B.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
