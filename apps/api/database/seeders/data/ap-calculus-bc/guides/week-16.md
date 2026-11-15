# Week 16 · Integration by Parts and Linear Partial Fractions

**Topics:** 6.11 Integrating Using Integration by Parts · 6.12 Integrating Using Linear Partial Fractions
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 6, Topics 6.11–6.12, learning objectives in our own words
**Spiral:** Weeks 13–15 built the AB toolkit for antiderivatives: the basic rules, u-substitution (the chain rule run backwards), long division and completing the square. This week adds the two BC techniques. Integration by parts is the product rule of Unit 2 run backwards, and partial fractions finish the job long division started on rational functions. Both lean on the logarithm and exponential antiderivatives you already know, and next week's improper integrals use both.

## What you need to be able to do

- **6.11** State and use ∫ u dv = uv − ∫ v du, choosing u and dv so that the new integral is simpler.
- **6.11** Apply integration by parts to definite integrals, evaluating the boundary term uv at both limits.
- **6.11** Use the "dv = dx" setup for ln x and arctan x, and apply parts more than once (including the tabular shortcut) when a polynomial factor has degree 2 or more.
- **6.12** Decompose a proper rational function whose denominator is a product of distinct linear factors into a sum A/(x − a) + B/(x − b), and integrate each piece as a logarithm.
- **6.12** Recognise when long division must come first (numerator degree ≥ denominator degree) and when partial fractions do not apply (an irreducible quadratic or a repeated factor).

## Key terms

| Term | Meaning |
|---|---|
| Integration by parts | ∫ u dv = uv − ∫ v du, the integrated form of the product rule. |
| u and dv | The factor you differentiate (u) and the factor you integrate (dv); their choice decides whether parts helps. |
| Boundary term | The uv part of a definite integration by parts, evaluated as u(b)v(b) − u(a)v(a). |
| Tabular method | A bookkeeping table for repeated parts: derivatives of u down one column, antiderivatives of dv down the other, signs alternating. |
| Proper rational function | A fraction of polynomials whose numerator has lower degree than its denominator. |
| Partial fraction decomposition | Rewriting a proper rational function as a sum of simpler fractions, here one constant over each distinct linear factor. |
| Distinct linear factors | A denominator such as (x − 2)(x + 1), with no factor repeated and no irreducible quadratic. |

## Integration by parts (6.11)

The product rule says d/dx [u · v] = u′v + uv′, or in differential form d(uv) = v du + u dv. Integrate both sides and rearrange:

**∫ u dv = uv − ∫ v du.**

The formula trades one integral for another. It helps only when the new integral ∫ v du is easier than the one you started with, so the whole skill is the choice of u.

**Choosing u.** Pick u to be the factor that gets simpler when you differentiate it, and dv to be a factor you can integrate easily.

- Polynomials make good u's: each derivative lowers the degree.
- ln x and inverse trig functions make excellent u's: their derivatives are algebraic (1/x, 1/(1 + x²)), and they are hard to integrate on their own.
- eˣ, sin x and cos x make good dv's: they integrate without getting worse.

The word LIATE (Logarithmic, Inverse trig, Algebraic, Trigonometric, Exponential) lists the usual priority for u. Treat it as a hint. The real test is whether ∫ v du is simpler.

A quick check that you chose badly: the power of x goes **up** in the new integral. For ∫ x eˣ dx, taking u = eˣ and dv = x dx gives v = x²/2 and a new integral ∫ (x²/2)eˣ dx, which is worse. Swap the roles.

**Worked example (a basic parts integral).** Find ∫ x cos(3x) dx.

Let u = x and dv = cos(3x) dx. Then du = dx and v = (1/3) sin(3x) (divide by the inside derivative 3). So

∫ x cos(3x) dx = (x/3) sin(3x) − ∫ (1/3) sin(3x) dx = (x/3) sin(3x) + (1/9) cos(3x) + C.

Check by differentiating: (1/3) sin(3x) + x cos(3x) − (1/3) sin(3x) = x cos(3x). Always run this check on a parts answer; the product rule makes it quick.

**The definite form.** On [a, b], the boundary term is evaluated at both limits:

∫ from a to b of u dv = [uv] from a to b − ∫ from a to b of v du.

**Worked example (dv = dx for a logarithm).** Evaluate ∫ from 1 to e of ln x dx.

There is only one factor, so make the other one 1: u = ln x, dv = dx, so du = (1/x) dx and v = x.

∫ from 1 to e of ln x dx = [x ln x] from 1 to e − ∫ from 1 to e of x · (1/x) dx = (e · 1 − 1 · 0) − (e − 1) = 1.

The same trick finds ∫ arctan x dx = x arctan x − (1/2) ln(1 + x²) + C, where the leftover integral ∫ x/(1 + x²) dx is a u-substitution from week 14.

**Repeated parts and the table.** When u is a polynomial of degree 2, one round of parts leaves a degree-1 polynomial times something, so you need a second round. A table keeps the signs straight:

1. List u and its derivatives down the left until you reach 0.
2. List dv and its successive antiderivatives down the right.
3. Multiply each left entry by the right entry one row lower, with signs +, −, +, −, ...

**Worked example (a table).** Find ∫ x² e^(−x) dx.

| Sign | Derivatives of x² | Antiderivatives of e^(−x) |
|---|---|---|
| + | x² | e^(−x) |
| − | 2x | −e^(−x) |
| + | 2 | e^(−x) |
| | 0 | −e^(−x) |

Diagonal products: (+)(x²)(−e^(−x)) + (−)(2x)(e^(−x)) + (+)(2)(−e^(−x)) = −x²e^(−x) − 2xe^(−x) − 2e^(−x). So

∫ x² e^(−x) dx = −e^(−x)(x² + 2x + 2) + C.

Differentiating gives e^(−x)(x² + 2x + 2) − e^(−x)(2x + 2) = x² e^(−x), as it should. Watch the signs twice: once from the table and once from the antiderivatives of e^(−x), which alternate in sign themselves.

**When is parts the right tool?** Look for a product of two different kinds of function (polynomial times exponential, polynomial times trig, polynomial times logarithm) where neither factor is the derivative of the other's inside. If one factor is the derivative of an inside function, as in ∫ x e^(x²) dx, use u-substitution instead.

## Linear partial fractions (6.12)

Adding fractions is easy: 2/(x − 2) + 3/(x + 1) = (5x − 4)/((x − 2)(x + 1)). Partial fractions run that addition backwards, because each simple piece integrates to a logarithm:

∫ k/(x − a) dx = k ln|x − a| + C.

**When it applies directly.** The fraction must be **proper** (numerator degree less than denominator degree) and the denominator must factor into **distinct linear factors**. Then

(px + q)/((x − a)(x − b)) = A/(x − a) + B/(x − b).

**Finding the constants.** Multiply through by the denominator to clear fractions:

px + q = A(x − b) + B(x − a).

This holds for every x, so substitute the zeros of the factors. x = a makes the B term vanish and gives A at once; x = b makes the A term vanish and gives B. (Matching coefficients of x and of the constant also works, but the substitution is faster.)

**Worked example (distinct linear factors).** Find ∫ (5x − 4)/(x² − x − 2) dx.

Factor: x² − x − 2 = (x − 2)(x + 1). Write 5x − 4 = A(x + 1) + B(x − 2).

- x = 2: 10 − 4 = 3A, so A = 2.
- x = −1: −5 − 4 = −3B, so B = 3.

So the integrand is 2/(x − 2) + 3/(x + 1), and

∫ (5x − 4)/(x² − x − 2) dx = 2 ln|x − 2| + 3 ln|x + 1| + C.

Check the decomposition by recombining: 2(x + 1) + 3(x − 2) = 5x − 4.

**Long division first.** If the numerator's degree is at least the denominator's, divide first (week 15), then split only the proper remainder.

**Worked example (division, then partial fractions).** Evaluate ∫ from 2 to 3 of x²/(x² − 1) dx.

Divide: x²/(x² − 1) = 1 + 1/(x² − 1). Split the remainder: 1 = A(x + 1) + B(x − 1); x = 1 gives A = 1/2 and x = −1 gives B = −1/2. So

x²/(x² − 1) = 1 + (1/2)/(x − 1) − (1/2)/(x + 1).

Then

∫ from 2 to 3 of x²/(x² − 1) dx = [x + (1/2) ln|x − 1| − (1/2) ln|x + 1|] from 2 to 3
= (3 + (1/2) ln 2 − (1/2) ln 4) − (2 + 0 − (1/2) ln 3)
= 1 + (1/2) ln(3/2) ≈ 1.203.

The interval [2, 3] avoids both zeros of the denominator, so the integrand is continuous there and the Fundamental Theorem applies. If an interval contains a zero of the denominator, the integral is improper; that is next week.

**When it does not apply.** x² + 9 has no real zeros, so 1/(x² + 9) is an arctangent: (1/3) arctan(x/3) + C. A repeated factor such as (x − 1)² is outside the BC topic. And before you decompose anything, ask whether the numerator is a constant multiple of the denominator's derivative: ∫ 2x/(x² − 4) dx = ln|x² − 4| + C by substitution, with no splitting needed.

## Choosing a technique

With this week the BC toolkit is complete. A short decision order:

1. Is it a basic rule (power, eˣ, trig, 1/x, arctan, arcsin)? Use it.
2. Is there an inside function whose derivative is (a multiple of) another factor? Substitute.
3. Is it a rational function? Divide if improper; complete the square if the denominator is an irreducible quadratic; split by partial fractions if the denominator has distinct linear factors.
4. Is it a product of unlike functions, or a lone ln x or arctan x? Use parts.

## Common mistakes

- **Choosing u so that the new integral is worse.** If the power of x goes up, swap u and dv.
- **Integrating each factor separately.** ∫ x cos x dx is not (x²/2) sin x. There is no product rule for integrals except parts.
- **Sign slips in ∫ v du.** The formula subtracts it. With v = −cos x, the minus signs combine to a plus.
- **Losing the chain-rule constant in v.** The antiderivative of e^(2x) is (1/2)e^(2x), and of cos(3x) is (1/3) sin(3x).
- **Forgetting to evaluate uv at the limits** in a definite integral, or forgetting the lower limit when it looks like 0 (e⁰ = 1, cos 0 = 1).
- **Swapping the partial fraction constants.** A goes over the factor whose zero you substituted to find it.
- **Writing ln|x² − 4| for ∫ 1/(x² − 4) dx.** That needs numerator 2x.
- **Splitting an improper fraction** without dividing first, or trying to split over an irreducible quadratic.

## Self-check

1. Find ∫ x e^(−x) dx.
2. Evaluate ∫ from 0 to π/2 of x cos x dx.
3. Find ∫ 1/(x(x + 1)) dx.
4. Evaluate ∫ from 0 to 1 of (x + 3)/((x + 1)(x + 2)) dx.
5. Find ∫ x sec²x dx.
6. Which technique would you use first for ∫ (x³ + 1)/(x² − 1) dx, and why?

*Answers:* 1. u = x, v = −e^(−x): −x e^(−x) − e^(−x) + C = −(x + 1)e^(−x) + C. 2. [x sin x + cos x] from 0 to π/2 = (π/2 + 0) − (0 + 1) = π/2 − 1. 3. 1/(x(x + 1)) = 1/x − 1/(x + 1), so ln|x| − ln|x + 1| + C. 4. (x + 3)/((x + 1)(x + 2)) = 2/(x + 1) − 1/(x + 2); the integral is 2 ln 2 − (ln 3 − ln 2) = 3 ln 2 − ln 3 = ln(8/3). 5. u = x, dv = sec²x dx, v = tan x: x tan x − ∫ tan x dx = x tan x + ln|cos x| + C. 6. Long division, because the numerator's degree (3) is higher than the denominator's (2); then split the proper remainder by partial fractions over (x − 1)(x + 1).

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 6, Topics 6.11–6.12). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
