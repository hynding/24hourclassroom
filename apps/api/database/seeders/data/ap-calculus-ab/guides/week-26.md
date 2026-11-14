# Week 26 · Long Division, Completing the Square and Choosing a Technique

**Topics:** 6.10 Integrating Functions Using Long Division and Completing the Square · 6.14 Selecting Techniques for Antidifferentiation
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 6, Topics 6.10 and 6.14, learning objectives in our own words (Topics 6.11–6.13 are BC only and are not part of this course)
**Spiral:** Week 25 gave you the basic antiderivative rules and u-substitution. This week adds two pieces of algebra you met in Algebra 2 and Precalculus, polynomial division and completing the square, so that more rational functions fit those rules. The arctangent and arcsine patterns come from the inverse trigonometric derivatives of week 11. The week ends with a routine for choosing a technique, which is what the AP exam actually tests.

## What you need to be able to do

- **6.10** Recognise when a rational integrand needs polynomial long division (numerator degree at least the denominator's), carry out the division, and integrate the quotient and the remainder term.
- **6.10** Complete the square in a quadratic so that an integrand fits ∫ 1/(u² + a²) du or ∫ 1/√(a² − u²) du, and use the right constant.
- **6.14** Choose among algebraic rewriting, the basic rules, u-substitution, long division and completing the square, and split a numerator so that different parts use different techniques.
- **6.14** Check every antiderivative by differentiating.

## Key terms

| Term | Meaning |
|---|---|
| Proper rational function | Numerator degree less than denominator degree. |
| Improper rational function | Numerator degree at least the denominator degree; divide first. |
| Quotient and remainder | Numerator = (divisor)(quotient) + remainder, with the remainder of lower degree than the divisor. |
| Completing the square | Rewriting x² + bx + c as (x + b/2)² + (c − b²/4). |
| Arctangent pattern | ∫ 1/(u² + a²) du = (1/a) arctan(u/a) + C. |
| Arcsine pattern | ∫ 1/√(a² − u²) du = arcsin(u/a) + C, a > 0. |

## Long division (6.10)

The basic rules handle 1/(x + 1) (a logarithm) but not (x² + 3x + 5)/(x + 1). When the numerator's degree is at least the denominator's, divide first, exactly as you would divide numbers to get a mixed number:

numerator/divisor = quotient + remainder/divisor.

The quotient is a polynomial, and the remainder term is a proper fraction that a basic rule can handle.

**Worked example.** Find ∫ (x² + 3x + 5)/(x + 1) dx.

Divide x² + 3x + 5 by x + 1:

- x² ÷ x = x. Multiply: x(x + 1) = x² + x. Subtract: (x² + 3x) − (x² + x) = 2x. Bring down 5: 2x + 5.
- 2x ÷ x = 2. Multiply: 2(x + 1) = 2x + 2. Subtract: 5 − 2 = 3.

So (x² + 3x + 5)/(x + 1) = x + 2 + 3/(x + 1). Check: (x + 1)(x + 2) + 3 = x² + 3x + 5. Integrate term by term:

∫ (x + 2 + 3/(x + 1)) dx = x²/2 + 2x + 3 ln |x + 1| + C.

For the definite integral from 0 to 2: (2 + 4 + 3 ln 3) − 0 = 6 + 3 ln 3 ≈ 9.296.

**Shortcut for a linear divisor.** You can often see the division by rewriting the numerator: 2x + 5 = 2(x + 2) + 1, so (2x + 5)/(x + 2) = 2 + 1/(x + 2), and the integral is 2x + ln |x + 2| + C. Equal degrees still count: (x² + 2)/(x² + 1) = 1 + 1/(x² + 1), which integrates to x + arctan x + C.

**When not to divide.** If the numerator is a constant multiple of the denominator's derivative, substitution is faster: ∫ (2x + 4)/(x² + 4x + 7) dx = ln(x² + 4x + 7) + C. And if the numerator's degree is already lower, division does nothing.

## Completing the square (6.10)

Two inverse-trigonometric patterns, from the derivatives of arctan and arcsin with the chain rule:

- ∫ 1/(u² + a²) du = (1/a) arctan(u/a) + C
- ∫ 1/√(a² − u²) du = arcsin(u/a) + C, for a > 0

Check the first by differentiating: d/du [(1/a) arctan(u/a)] = (1/a) · (1/a)/(1 + u²/a²) = 1/(a² + u²). In the arcsine pattern the factor 1/a from the chain rule cancels the a that comes out of the square root, so there is no constant in front. These two constants are the most common error this week.

A quadratic that does not factor over the reals can be put into one of these shapes by completing the square: x² + bx + c = (x + b/2)² + (c − b²/4).

**Worked example (arctangent).** Find ∫ 1/(x² + 6x + 13) dx.

Half of 6 is 3, and 3² = 9: x² + 6x + 13 = (x + 3)² + 4 = (x + 3)² + 2². With u = x + 3 (du = dx) and a = 2:

∫ 1/(x² + 6x + 13) dx = (1/2) arctan((x + 3)/2) + C.

**Worked example (arcsine).** Find ∫ 1/√(4x − x²) dx.

Factor out the minus sign before completing the square: 4x − x² = −(x² − 4x) = −((x − 2)² − 4) = 4 − (x − 2)². With u = x − 2 and a = 2:

∫ 1/√(4 − (x − 2)²) dx = arcsin((x − 2)/2) + C.

**Why only these quadratics?** If the denominator factors into real linear factors, as x² − 1 = (x − 1)(x + 1) does, the integral needs partial fractions, a BC-only technique. AB problems choose quadratics with no real zeros, which is exactly when completing the square leaves a positive constant.

## Choosing a technique (6.14)

On the exam no one tells you which method to use. Work through these questions in order; stop at the first yes.

1. **Is it a basic rule as written?** Powers, 1/x, eˣ, the six trigonometric patterns, the two inverse-trig patterns.
2. **Does simple algebra make it a basic rule?** Expand a product of polynomials, split a fraction with a single-term denominator, rewrite roots as powers. Example: (x + 1)²/x = x + 2 + 1/x.
3. **Is there an inner function whose derivative is a factor?** Then substitute. Example: x/(x² + 9), with u = x² + 9.
4. **Is it a rational function with numerator degree ≥ denominator degree?** Divide.
5. **Is the denominator (or the expression under a root) an irreducible quadratic with a constant numerator?** Complete the square.

The same denominator can need different techniques depending on the numerator:

| Integral | Technique | Result |
|---|---|---|
| ∫ x/(x² + 9) dx | u = x² + 9 | (1/2) ln(x² + 9) + C |
| ∫ 1/(x² + 9) dx | arctangent, a = 3 | (1/3) arctan(x/3) + C |
| ∫ x²/(x² + 9) dx | divide: 1 − 9/(x² + 9) | x − 3 arctan(x/3) + C |

**Worked example (one quadratic, three techniques).** Let q(x) = x² + 4x + 7 = (x + 2)² + 3.

- ∫ (x² + 4x + 7)/(x + 2) dx: improper, so divide. q(x) = (x + 2)(x + 2) + 3, so the integrand is x + 2 + 3/(x + 2), giving x²/2 + 2x + 3 ln |x + 2| + C.
- ∫ (x + 2)/q(x) dx: the numerator is half of q′(x) = 2x + 4, so substitute: (1/2) ln(x² + 4x + 7) + C.
- ∫ 1/q(x) dx: constant numerator, irreducible quadratic, so complete the square: (1/√3) arctan((x + 2)/√3) + C.

**Splitting a numerator.** For ∫ (x + 5)/q(x) dx, write x + 5 = (x + 2) + 3. The first part is the logarithm case and the second is three times the arctangent case:

∫ (x + 5)/(x² + 4x + 7) dx = (1/2) ln(x² + 4x + 7) + √3 arctan((x + 2)/√3) + C.

**Recognise and stop.** Some integrands need techniques outside AB: a product such as x eˣ or x cos x (integration by parts), or 1/(x² − 1) (partial fractions). If one of these seems to appear on an AB problem, look again: there is usually a substitution or an algebraic simplification you have missed.

## Where this goes next

This week closes Unit 6. Unit 7 (differential equations) asks you to integrate both sides of an equation such as dy/dx = x/y or dy/dt = k·y, and the integrals that appear there are exactly the ones practised in weeks 25 and 26: powers, logarithms from 1/y, exponentials and simple substitutions. Unit 8 uses definite integrals for average value, motion, area between curves and volume; there the hard part is usually setting up the integral, and the antiderivative itself should feel routine. A good habit to carry forward: before integrating anything, spend five seconds deciding the technique with the five questions above, and after integrating, spend ten seconds differentiating your answer.

## Common mistakes

- **Integrating numerator and denominator separately.** Never valid; divide or substitute.
- **Errors in the subtraction step of long division.** Check by multiplying back: divisor × quotient + remainder must equal the numerator.
- **Putting the remainder over the wrong denominator.** It goes over the divisor.
- **Dropping the 1/a in the arctangent pattern, or adding one to the arcsine pattern.**
- **Completing the square with the wrong sign under a root.** Factor out the minus first: 4x − x² = 4 − (x − 2)².
- **Forcing a substitution when the factor of x is missing.** ∫ 1/(x² + 9) dx is an arctangent, not a logarithm.
- **Forgetting + C, or forgetting to check by differentiating.**

## Self-check

1. Find ∫ (x² − 1)/(x + 2) dx.
2. Find ∫ 1/(x² + 2x + 5) dx.
3. Find ∫ 1/√(6x − x² − 5) dx.
4. Find ∫ (3x + 7)/(x + 2) dx and ∫ 3/(x + 2)² dx. Which needs division?
5. For each, name the technique before integrating: ∫ x²/(x³ + 1) dx, ∫ (x³ + x)/x dx, ∫ 1/(x² + 16) dx, ∫ (x² + 16)/(x + 1) dx.
6. Evaluate ∫ from 0 to 3 of x²/(x² + 9) dx.

*Answers:* 1. x² − 1 = (x + 2)(x − 2) + 3, so x²/2 − 2x + 3 ln |x + 2| + C. 2. (x + 1)² + 4: (1/2) arctan((x + 1)/2) + C. 3. 6x − x² − 5 = 4 − (x − 3)²: arcsin((x − 3)/2) + C. 4. 3x + 7 = 3(x + 2) + 1, so 3x + ln |x + 2| + C (division); the second is a substitution with u = x + 2: −3/(x + 2) + C. 5. u = x³ + 1; split to x² + 1; arctangent with a = 4; long division. 6. (x − 3 arctan(x/3)) from 0 to 3 = 3 − 3(π/4) = 3 − 3π/4 ≈ 0.644.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 6, Topics 6.10 and 6.14). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
