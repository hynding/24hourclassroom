# Unit 3 · Identities and Equations · The night-before sheet

**Topics:** 3.1 Simplifying Trigonometric Expressions · 3.2 Factoring and Rational Trigonometric Expressions · 3.3 Verifying Identities · 3.4 Sum and Difference Formulas · 3.5 Cofunction and Reduction Formulas · 3.6 Double-Angle Formulas · 3.7 Power-Reducing and Half-Angle Formulas · 3.8 Product-to-Sum and Sum-to-Product Formulas · 3.9 Combining a sin x + b cos x · 3.10 Solving Trigonometric Equations · 3.11 Equations with Multiple Angles and Identities · 3.12 Trigonometric Inequalities and Calculator Solutions
**Standards:** HSF-TF.C.8, HSF-TF.C.9, HSF-TF.B.7 (with extensions beyond HSF-TF.C.9)

## The ideas that generate every question

1. **An identity is true for every allowed x; an equation is true for some x.** You *prove* an identity (one counterexample disproves it) and you *solve* an equation (find exactly which x work).
2. **When in doubt, go to sines and cosines.** Rewrite tan, cot, sec and csc as quotients, then use algebra: common denominators, factoring, conjugates, cancelling common factors (never terms).
3. **sin²x + cos²x = 1 has three faces.** 1 − sin²x = cos²x, 1 − cos²x = sin²x, and dividing through gives 1 + tan²x = sec²x and 1 + cot²x = csc²x. A squared term is a signal to use one of them.
4. **Verifying works on one side.** Start from the more complicated side and transform it, step by step, into the other. Do not move terms across the equals sign; that assumes what you are proving.
5. **Everything after the Pythagorean identity comes from cos(α − β).** The sum and difference formulas give the cofunction and reduction formulas (put α = π/2 or π), the double-angle formulas (put β = α), the power-reducing and half-angle formulas (solve cos 2x for sin²x and cos²x), and the product-to-sum formulas (add two sum formulas).
6. **Trigonometric functions are not linear.** sin(α + β) ≠ sin α + sin β, cos 2x ≠ 2 cos x, sin(x/2) ≠ ½ sin x. Every formula in this unit exists because of this.
7. **Two sinusoids of the same period make one.** a sin x + b cos x = R sin(x + φ) with R = √(a² + b²) and φ the direction angle of the point (a, b). The maximum is R, not a + b.
8. **Every equation is reduced to sin u = k, cos u = k or tan u = k.** Then: check the value is possible, find the reference angle, place it in each correct quadrant, add the period (2πn or πn), and list what lies in the interval.
9. **Do not divide by a trigonometric function, and check after squaring.** Factor out the common factor instead; squaring merges a = b with a = −b, so it creates extraneous roots.
10. **Multiple angles stretch the interval.** For kx on [0, 2π), solve u = kx on [0, 2kπ), then divide every solution, and the period, by k.
11. **Calculators give one value; inequalities need intervals.** The principal value from sin⁻¹, cos⁻¹ or tan⁻¹ is a starting point; symmetry gives the second solution. For an inequality, the solutions of the equation are boundary points, and a test value decides each piece.

## Key formulas

| Want | Formula |
|---|---|
| Pythagorean | sin²x + cos²x = 1; 1 + tan²x = sec²x; 1 + cot²x = csc²x |
| Even and odd | cos(−x) = cos x; sin(−x) = −sin x; tan(−x) = −tan x |
| Sum and difference | sin(α ± β) = sin α cos β ± cos α sin β; cos(α ± β) = cos α cos β ∓ sin α sin β |
| Tangent sum | tan(α ± β) = (tan α ± tan β)/(1 ∓ tan α tan β) |
| Cofunction and reduction | sin(π/2 − x) = cos x; cos(π/2 − x) = sin x; sin(π − x) = sin x; cos(π − x) = −cos x; cos(x + π/2) = −sin x |
| Double angle | sin 2x = 2 sin x cos x; cos 2x = cos²x − sin²x = 2cos²x − 1 = 1 − 2sin²x; tan 2x = 2 tan x/(1 − tan²x) |
| Power reducing | sin²x = (1 − cos 2x)/2; cos²x = (1 + cos 2x)/2 |
| Half angle | sin(x/2) = ±√((1 − cos x)/2); cos(x/2) = ±√((1 + cos x)/2); tan(x/2) = (1 − cos x)/sin x; sign from the quadrant of x/2 |
| Product to sum | sin A cos B = ½[sin(A + B) + sin(A − B)]; cos A cos B = ½[cos(A − B) + cos(A + B)]; sin A sin B = ½[cos(A − B) − cos(A + B)] |
| Sum to product | sin u + sin v = 2 sin((u + v)/2) cos((u − v)/2); cos u + cos v = 2 cos((u + v)/2) cos((u − v)/2); cos u − cos v = −2 sin((u + v)/2) sin((u − v)/2) |
| Combined form | a sin x + b cos x = R sin(x + φ), R = √(a² + b²), cos φ = a/R, sin φ = b/R |
| All solutions | sin x = k: α + 2πn, (π − α) + 2πn; cos x = k: ±α + 2πn; tan x = k: α + πn |
| Calculator second solution in [0, 2π) | sine: π − α; cosine: 2π − α; tangent: α + π (add 2π to any negative value) |

## Classic question types and how to attack them

**"Simplify."** Sines and cosines first; then look for 1 − sin²x or 1 − cos²x, a difference of squares, or a trinomial in sin x. Multiply by a conjugate when 1 ± sin x or 1 ± cos x sits in a denominator.

**"Verify the identity."** Work on the messier side only. Write each step with its reason. If you get stuck, convert the other side to sines and cosines too, so you know the target.

**"Is this an identity?"** Test a convenient value such as x = π/4 or π/6. One failure proves it is not; a success proves nothing.

**"Find the exact value."** Split the angle into special angles (75° = 45° + 30°, π/12 = π/3 − π/4) or halve one (15° = 30°/2). For given ratios, draw triangles in the stated quadrants and get the signs right before substituting.

**"Write as a single sinusoid" or "find the maximum."** R from the Pythagorean sum, φ from the signs of a and b, maximum R at x + φ = π/2.

**"Solve on [0, 2π)" or "find all solutions."** Reduce to one function of one angle (identity, factor, combine), stretch the interval for a multiple angle, list every quadrant, and check any squared step.

**"Solve the inequality" or "for how long…?"** Boundary points from the equation, test the pieces, write intervals; in context, a duration is the total length of the kept intervals.

## Common errors

- Cancelling a term instead of a factor: (sin x + cos x)/sin x is not 1 + cos x.
- Moving terms across the equals sign while verifying an identity.
- Distributing a function: sin(α + β) as sin α + sin β; cos 2x as 2 cos x; √(a² + b²) as a + b.
- The sign in cos(α + β) (minus) and in sin A sin B and cos u − cos v.
- The wrong sign in a half-angle formula: decide by the quadrant of x/2, not of x.
- φ from tan⁻¹(b/a) when a < 0 (add π).
- Dropping the ± after a square root, or one of the two solutions per turn.
- Dividing by sin x or cos x and losing solutions.
- Using + 2πn for tangent; forgetting to divide the period by k in a multiple-angle equation.
- Degree mode on the calculator, or stopping at the calculator's single value.

## Calculator or not?

Identities, exact values, simplification and most equations in this unit are meant to be done by hand, with exact answers such as π/12 or (√6 − √2)/4. Use a calculator only for non-special values (sin x = 0.4), for contexts that ask for decimals, and for checking: substitute a decimal value of x into both sides of a claimed identity, or into an equation to confirm a solution. Work in radian mode and round only at the end, to the stated precision.

## Self-test

1. Simplify sec x − sin x tan x.
2. Simplify (cos²x − 1)/(cos x + 1).
3. Verify (sin x + cos x)² = 1 + sin 2x.
4. Find the exact value of sin 15°.
5. If sin θ = 1/3, find cos 2θ.
6. Find the exact value of cos(π/8).
7. Write cos 7x cos 3x as a sum.
8. Write sin x − cos x as R sin(x + φ).
9. Solve 2 sin²x + sin x − 1 = 0 on [0, 2π).
10. Solve cos 2x = 1/2 on [0, 2π).
11. Solve tan x ≤ 1 on [0, π).
12. (Calculator.) Solve 4 cos x = 1 on [0, 2π) to three decimal places.

**Answers.**
1. 1/cos x − sin²x/cos x = cos²x/cos x = cos x.
2. (cos x − 1)(cos x + 1)/(cos x + 1) = cos x − 1.
3. sin²x + 2 sin x cos x + cos²x = 1 + 2 sin x cos x = 1 + sin 2x.
4. sin(45° − 30°) = (√6 − √2)/4.
5. 1 − 2(1/9) = 7/9.
6. cos(π/8) = +√((1 + √2/2)/2) = √(2 + √2)/2 (positive, quadrant I).
7. ½(cos 4x + cos 10x).
8. R = √2, cos φ = 1/√2, sin φ = −1/√2: √2 sin(x − π/4).
9. (2 sin x − 1)(sin x + 1) = 0: π/6, 5π/6, 3π/2.
10. 2x = π/3, 5π/3, 7π/3, 11π/3: x = π/6, 5π/6, 7π/6, 11π/6.
11. 0 ≤ x ≤ π/4 or π/2 < x < π (tangent is undefined at π/2 and negative after it).
12. cos⁻¹(0.25) ≈ 1.318 and 2π − 1.318 ≈ 4.965.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.C.8, HSF-TF.C.9, HSF-TF.B.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
