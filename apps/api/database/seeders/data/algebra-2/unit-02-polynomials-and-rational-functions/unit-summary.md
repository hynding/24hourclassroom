# Unit 2 · Polynomials and Rational Functions · The night-before sheet

**Exam weight:** about 20–25% of the final · **Lessons:** 2.1 Let's Make a Box · 2.2 Funding the Future · 2.3 Introducing Polynomials · 2.4 Combining Polynomials · 2.5 Connecting Factors and Zeros · 2.6 Different Forms · 2.7 Using Factors and Zeros · 2.8–2.9 End Behavior · 2.10 Multiplicity · 2.11 Finding Intersections · 2.12–2.13 Polynomial Division · 2.14 What Do You Know About Polynomials? · 2.15 The Remainder Theorem · 2.16 Minimizing Surface Area · 2.17–2.18 Graphs of Rational Functions · 2.19 End Behavior of Rational Functions · 2.20–2.22 Rational Equations · 2.23–2.24 Polynomial Identities · 2.25 Summing Up · 2.26 Using the Sum
**Practices:** MP3, MP4, MP7, MP8
**Built from:** IM Algebra 2, Unit 2, in our own words

## The ideas that generate every question

1. **A polynomial is a sum of whole-number powers of x with number coefficients.** Degree, leading coefficient and constant term come from standard form; zeros come from factored form. Sums, differences and products of polynomials are polynomials; quotients usually are not.
2. **Factors and zeros are the same information.** (x − a) is a factor ⟺ p(a) = 0 ⟺ (a, 0) is on the graph. The Remainder Theorem proves it: p(x) = (x − a)q(x) + p(a).
3. **The leading term owns the ends; the factors own the middle.** Even degree: ends match (both up if the leading coefficient is positive, both down if negative). Odd degree: ends oppose (down-left, up-right if positive). Each zero flips the sign if its multiplicity is odd (cross) and leaves it alone if even (bounce).
4. **Intersections are zeros in disguise.** f(x) = g(x) ⟺ f(x) − g(x) = 0; factor or graph.
5. **Division reveals structure.** Divide by a known factor to find the rest; divide a rational function to find its end behaviour (quotient) and the term that blows up near the vertical asymptote (remainder/divisor).
6. **A rational function is a polynomial over a polynomial.** Denominator zeros that do not cancel are vertical asymptotes; cancelled factors are holes; the degrees decide the horizontal or slant asymptote.
7. **Rational equations: restrictions first, then clear denominators, then check.** Multiplying by something that can be zero can create extraneous solutions.
8. **An identity holds for every x.** Prove it by expansion; disprove it with one counterexample. The identity (x − 1)(1 + x + … + xⁿ⁻¹) = xⁿ − 1 gives the geometric sum a(rⁿ − 1)/(r − 1).

## Key formulas and procedures

| Want | Do this |
|---|---|
| Degree, leading coefficient of a product | add the degrees; multiply the leading coefficients |
| Vertical intercept | constant term; in factored form, product of the constants (including any k in front) |
| Zeros from factored form | set each factor to 0: (2x − 3) → x = 3/2; (x + 5) → x = −5 |
| Equation from zeros and a point | p(x) = k · (factors); substitute the point to find k |
| End behaviour | leading term: sign of coefficient fixes the right end; degree parity fixes whether the left end matches |
| Behaviour at a zero | odd multiplicity crosses, even multiplicity bounces; higher multiplicity is flatter |
| Max turning points | degree − 1 |
| Divide by (x − a) | grid or long division; remainder must equal p(a) |
| Test a factor | evaluate p(a); zero means (x − a) is a factor |
| Find k for a factor | set p(a) = 0 and solve for k |
| Vertical asymptote / hole | factor and cancel; surviving denominator zero → asymptote; cancelled → hole |
| Horizontal asymptote | n < d: y = 0; n = d: ratio of leading coefficients; n > d: none (divide for slant/polynomial end behaviour) |
| Slant asymptote | quotient of the division when n = d + 1 |
| Solve a rational equation | restrictions → multiply every term by the LCD → solve → discard restricted values → check |
| Difference of squares / cubes | a² − b² = (a − b)(a + b); a³ ∓ b³ = (a ∓ b)(a² ± ab + b²) |
| Pythagorean triples | (a² − b²)² + (2ab)² = (a² + b²)² |
| Geometric sum | a + ar + … + arⁿ⁻¹ = a(rⁿ − 1)/(r − 1), r ≠ 1, n = number of terms |

## Common errors

- Sign of a zero: (x + 5) gives −5.
- Vertical intercept read from one factor instead of all of them.
- Forgetting k when writing an equation from a graph.
- Flipping the sign at a double zero in a sign table.
- Dividing both sides by x in x³ = 9x (loses x = 0).
- Evaluating p(a) for the divisor (x + a) instead of p(−a).
- Missing 0xⁿ placeholders in division.
- Calling a cancelled factor an asymptote (it is a hole).
- Reading a horizontal asymptote from constants rather than leading terms.
- Multiplying only some terms by the LCD.
- Reporting an extraneous solution.
- Using rⁿ⁻¹ instead of rⁿ in the sum formula; miscounting growth periods in deposit problems.

## Worked examples

**1. From one zero to the full picture.** p(x) = 2x³ − 3x² − 11x + 6; p(3) = 54 − 27 − 33 + 6 = 0. Divide by (x − 3): quotient 2x² + 3x − 2 = (2x − 1)(x + 2). Zeros 3, 1/2, −2; leading coefficient 2, degree 3 (down-left, up-right); p(0) = 6. Sign: negative left of −2, positive on (−2, 1/2), negative on (1/2, 3), positive after 3.

**2. A rational function, start to finish.** r(x) = (x² − x − 2)/(x − 3) = (x − 2)(x + 1)/(x − 3). Domain x ≠ 3; intercepts x = 2, −1 and (0, 2/3); vertical asymptote x = 3 (at 2.9: (0.9)(3.9)/(−0.1) ≈ −35, down on the left; at 3.1: up on the right). Division: x² − x − 2 = (x − 3)(x + 2) + 4, so r(x) = x + 2 + 4/(x − 3): slant asymptote y = x + 2.

**3. A rational equation with a trap.** 5/(x − 2) + 1 = (x + 3)/(x − 2). Restriction x ≠ 2. Multiply by (x − 2): 5 + x − 2 = x + 3, which simplifies to 3 = 3. Every allowed x satisfies it: the solution set is all real numbers except 2. (Compare 5/(x − 2) + 1 = (x + 4)/(x − 2): 5 + x − 2 = x + 4 gives 3 = 4, no solution.)

**4. A geometric sum in context.** $250 at the end of each quarter for 5 years at 1.5% per quarter: a = 250, r = 1.015, n = 20. S = 250(1.015²⁰ − 1)/0.015 = 250(1.34686 − 1)/0.015 ≈ 250 · 23.124 ≈ $5,781.

## What to review from earlier units

Unit 1: geometric sequences and their partial sums (weeks 1–3) are exactly what the geometric sum formula closes out; be ready to count terms (solve for n from the last term) and to tell arithmetic from geometric. From Algebra 1: factoring quadratics, the quadratic formula (discriminant b² − 4ac decides how many real zeros a quadratic factor contributes), and the zero product property.

## Exam-night checklist

- Can you go from factored form to a sketch (zeros, multiplicities, intercept, ends) and from a sketch to an equation with the right k?
- Can you divide by (x − a) two ways and check with p(a)?
- Can you find every asymptote and hole of a rational function and say which side goes up?
- Can you solve a rational equation and explain, not just discard, an extraneous solution?
- Can you prove an identity by expansion and use the xⁿ − 1 identity to get the sum formula?
- Can you set up a deposit or payment problem with the right n and r?

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 2, Lessons 1–26, https://im.kendallhunt.com/HS/teachers/3/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
