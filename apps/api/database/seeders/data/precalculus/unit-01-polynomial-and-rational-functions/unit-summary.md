# Unit 1 · Polynomial and Rational Functions · The night-before sheet

**AP exam weight:** 30–40% of the multiple-choice section
**Topics:** 1.1 Change in Tandem · 1.2 Rates of Change · 1.3 Rates of Change in Linear and Quadratic Functions · 1.4 Polynomial Functions and Rates of Change · 1.5 Polynomial Functions and Complex Zeros · 1.6 Polynomial Functions and End Behavior · 1.7 Rational Functions and End Behavior · 1.8 Rational Functions and Zeros · 1.9 Rational Functions and Vertical Asymptotes · 1.10 Rational Functions and Holes · 1.11 Equivalent Representations of Polynomial and Rational Expressions · 1.12 Transformations of Functions · 1.13 Function Model Selection and Assumption Articulation · 1.14 Function Model Construction and Application
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 1, Topics 1.1–1.14, in our own words

## The ideas that generate every question

1. **A function is change in tandem.** As the input changes, the output changes with it. Describe that change in words (increasing, decreasing, concave up, concave down), from a graph, from a table, and from a formula, and say where it happens using intervals of the input.
2. **Rates of change measure that change.** The average rate of change over [a, b] is (f(b) − f(a))/(b − a), the slope of the secant line. The rate of change at a point is estimated by average rates over smaller and smaller intervals around it. Increasing rates of change mean concave up; decreasing rates mean concave down.
3. **The pattern of rates identifies the family.** Over equal input steps: linear functions have constant first differences, quadratics constant second differences, and degree-n polynomials constant nth differences.
4. **Polynomials are shaped by their zeros and their leading term.** Factors give zeros (real and complex, counted with multiplicity, n of them for degree n); multiplicity decides cross (odd) or bounce (even); the leading term alone decides end behaviour; there are at most n − 1 turning points.
5. **Rational functions are shaped by the factors of the numerator and denominator.** Factor both and find the domain first. A numerator-only zero is a zero of the function; a denominator-only zero is a vertical asymptote; a shared factor is a hole when the numerator's multiplicity is at least the denominator's. The degrees decide end behaviour: horizontal asymptote y = 0, y = (ratio of leading coefficients), or a slant asymptote found by division.
6. **Limits describe behaviour precisely.** lim as x → ±∞ for end behaviour; one-sided limits lim as x → a⁺ and a⁻ for asymptotes; lim as x → a of f(x) = L at a hole.
7. **Equivalent forms reveal different properties.** Standard, factored, and quotient + remainder/divisor forms are the same function. Division, the remainder and factor theorems, special factoring patterns and the binomial theorem move between them.
8. **Transformations move every feature predictably.** In g(x) = a · f(b(x − h)) + k, a point (x₀, y₀) goes to (x₀/b + h, a·y₀ + k). Input changes move zeros and vertical asymptotes; output changes move horizontal asymptotes and range.
9. **Models are chosen, built, checked and limited.** Pick a function type from data patterns and context, build it from points or regression, check it with residuals, and state its assumptions and contextual domain. Every answer in context needs units.

## Key formulas and procedures

| Want | Do this |
|---|---|
| Average rate of change on [a, b] | (f(b) − f(a))/(b − a); units: output units per input unit |
| Rate of change at x = a | average rate over a small interval around a, such as [a − 0.1, a + 0.1] |
| Concavity from a table | compare consecutive average rates: increasing → concave up; decreasing → concave down |
| Model type from equally spaced data | constant 1st differences → linear; 2nd → quadratic; 3rd → cubic |
| Vertex of y = ax² + bx + c | x = −b/(2a); vertex form a(x − h)² + k has vertex (h, k) |
| Even / odd | f(−x) = f(x) (symmetric about the y-axis) / f(−x) = −f(x) (symmetric about the origin) |
| Zeros of a polynomial | degree n → n complex zeros with multiplicity; non-real zeros of real polynomials come in conjugate pairs |
| Behaviour at a real zero | odd multiplicity crosses, even multiplicity bounces |
| Polynomial end behaviour | leading term: even degree, ends match; odd degree, ends opposite; negative coefficient flips both |
| Rational end behaviour | deg num < deg den → y = 0; equal → ratio of leading coefficients; one more → slant asymptote (divide) |
| Zero / vertical asymptote / hole | numerator-only zero / denominator-only zero / shared factor with numerator multiplicity ≥ denominator multiplicity |
| Hole coordinates | cancel, then evaluate the simplified function at the cancelled input |
| Side of a vertical asymptote | sign of each factor just left and right; even power in the denominator → same infinity on both sides |
| Polynomial or rational inequality | zero on one side, factor, sign chart; denominator zeros always excluded |
| Remainder theorem | remainder of p(x) ÷ (x − a) is p(a); x − a is a factor ⟺ p(a) = 0 |
| Cubes | a³ + b³ = (a + b)(a² − ab + b²); a³ − b³ = (a − b)(a² + ab + b²) |
| Binomial theorem | term C(n, k)aⁿ⁻ᵏbᵏ; coefficients from row n of Pascal's triangle |
| Transformations | g(x) = a · f(b(x − h)) + k; point (x₀, y₀) → (x₀/b + h, a·y₀ + k) |
| Residual | actual − predicted; a pattern in residuals means the wrong model type |

## Classic question types and how to attack them

**"On which interval is f increasing and concave down?"** From a graph: find where it rises with the bend opening downward. From a table: find where outputs increase while successive differences shrink.

**"Estimate the rate of change at x = 3."** Use the two table values that straddle 3 most closely and compute an average rate of change; state units.

**"Which polynomial could be graphed here?"** Read the zeros and whether the graph crosses or bounces (multiplicity), the end behaviour (degree parity and leading sign), and the vertical intercept to find the constant factor.

**"Find all zeros."** Use a given zero and division (or the factor theorem), then factor or use the quadratic formula on the quotient. Remember conjugate pairs.

**"Describe the behaviour near x = a / as x → ∞."** Factor, classify each special input, and write limits. Justify one-sided limits with the signs of the factors.

**"Solve the inequality."** One side zero, single fraction, sign chart, check endpoints (include numerator zeros only for ≥ or ≤; never denominator zeros).

**"Rewrite the expression to show …"** Divide for a slant asymptote, factor for zeros or holes, expand for the leading coefficient and vertical intercept, use the binomial theorem for a single coefficient.

**"g is a transformation of f. Find g(3) / the new asymptote / the domain of g."** Apply the point rule or solve for the input of f; factor out b first.

**"Which model is most appropriate, and why?"** Check differences, extrema, symmetry, asymptotic behaviour and the context. Then state an assumption or limitation and a reasonable domain.

**"Use the model to predict / interpret."** Substitute, include units, say "according to the model", and flag extrapolation.

## Common mistakes

- Average rate of change computed as (b − a)/(f(b) − f(a)), or without units.
- Confusing increasing (outputs rise) with concave up (rates rise).
- Forgetting the conjugate of a complex zero when counting the degree.
- Letting a large middle coefficient decide end behaviour.
- Cancelling before finding the domain, which loses holes.
- Calling a shared numerator zero a zero of the function.
- Including a denominator zero in an inequality solution.
- Using a instead of −a when dividing by x + a, or leaving out zero placeholders.
- Reporting quotient + remainder as the slant asymptote.
- Shifting the wrong way with f(x − h); forgetting to factor out b in f(bx − c).
- Moving zeros sideways under a vertical shift.
- Residual computed as predicted − actual; trusting r alone; extrapolating freely.

## Calculator or not?

The AP exam has calculator and non-calculator parts. In this unit, expect a calculator for regressions, solving a model equation such as h(t) = 10, finding a maximum of a cubic model, and evaluating messy values. Everything structural (zeros from factors, asymptotes and holes, end behaviour, division, transformations, choosing a model type) should be done by hand and justified in words. Calculators also hide holes and draw asymptotes badly, so use a table near the input in question.

## Self-test

1. Find the average rate of change of f(x) = x² − 3x on [1, 4].
2. A table has outputs 2, 5, 10, 17, 26 at x = 0, 1, 2, 3, 4. Which function type fits, and is the function concave up or down?
3. A polynomial with real coefficients has zeros 2, −1 (multiplicity 2) and 3i. What is its least possible degree?
4. State the end behaviour of p(x) = −3x⁴ + x³ − 7 using limit notation.
5. Find the horizontal asymptote of y = (5x² − 1)/(2x² + x).
6. Classify every special input of r(x) = (x² − x − 2)/(x² − 4).
7. Solve (x + 1)/(x − 3) < 0.
8. Find the remainder when x³ − 4x² + x + 5 is divided by x − 3.
9. Find the slant asymptote of (x² + 3x − 2)/(x − 1).
10. f has a vertical asymptote x = 1 and horizontal asymptote y = 2. Find the asymptotes of g(x) = −f(x + 4) + 3.
11. A model predicts 120 and the actual value is 113. Find the residual and say what it means.

**Answers.** 1. f(4) = 4, f(1) = −2: 6/3 = 2. 2. First differences 3, 5, 7, 9; second differences constant 2: quadratic (y = x² + 1), concave up. 3. 2 + 1 + 2 (for 3i and −3i), with −1 counted twice: zeros 2, −1, −1, 3i, −3i, so degree 5. 4. lim as x → ±∞ of p(x) = −∞. 5. y = 5/2. 6. (x − 2)(x + 1)/((x − 2)(x + 2)): zero at −1, hole at (2, 3/4), vertical asymptote x = −2, horizontal asymptote y = 1. 7. −1 < x < 3. 8. p(3) = 27 − 36 + 3 + 5 = −1. 9. Synthetic division with 1: 1, 4 | 2, so x + 4 + 2/(x − 1): slant asymptote y = x + 4. 10. Vertical x = 1 − 4 = −3; horizontal y = −2 + 3 = 1. 11. 113 − 120 = −7: the model overestimated by 7 units.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 1, Topics 1.1–1.14). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
