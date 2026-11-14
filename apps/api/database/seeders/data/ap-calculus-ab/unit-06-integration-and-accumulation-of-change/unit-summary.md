# Unit 6 · Integration and Accumulation of Change · The night-before sheet

**AP exam weight:** 15–20% of the AB exam
**Topics:** 6.1 Exploring Accumulations of Change · 6.2 Approximating Areas with Riemann Sums · 6.3 Riemann Sums, Summation Notation, and Definite Integral Notation · 6.4 The Fundamental Theorem of Calculus and Accumulation Functions · 6.5 Interpreting the Behavior of Accumulation Functions Involving Area · 6.6 Applying Properties of Definite Integrals · 6.7 The Fundamental Theorem of Calculus and Definite Integrals · 6.8 Finding Antiderivatives and Indefinite Integrals · 6.9 Integrating Using Substitution · 6.10 Integrating Functions Using Long Division and Completing the Square · 6.14 Selecting Techniques for Antidifferentiation
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 6, Topics 6.1–6.10 and 6.14, in our own words (6.11–6.13 are BC only)

## The ideas that generate every question

1. **Area under a rate is accumulated change (6.1).** Units multiply: (liters per minute) × (minutes) = liters. Area above the axis adds, area below subtracts. Net change subtracts; total change (total distance) adds absolute areas.
2. **Riemann sums approximate it (6.2).** Width times height, added up: left, right, midpoint, trapezoidal. With a table, use each subinterval's own width. Increasing or decreasing decides left and right; concavity decides trapezoid and midpoint.
3. **The definite integral is the limit (6.3).** ∫ from a to b of f(x) dx = lim (n→∞) ∑ (k = 1 to n) f(a + kΔx)Δx with Δx = (b − a)/n. It is a signed area; lines, absolute values and semicircles can be done by geometry.
4. **Accumulation functions and the first Fundamental Theorem (6.4).** g(x) = ∫ from a to x of f(t) dt has g(a) = 0 and g′(x) = f(x). With a variable limit u(x), multiply by u′(x).
5. **Reading g from f (6.5).** g increases where f > 0, has a relative maximum where f changes from + to −, is concave up where f increases. In context: amount = initial amount + ∫ of net rate.
6. **Properties (6.6).** Reverse limits, change sign; zero width, zero; adjacent intervals add; integrals split over sums and constant multiples, never over products.
7. **The second Fundamental Theorem (6.7).** ∫ from a to b of f(x) dx = F(b) − F(a) for any antiderivative F. Net change: f(b) = f(a) + ∫ from a to b of f′(x) dx.
8. **Antiderivatives (6.8–6.10, 6.14).** Basic rules are derivative rules backwards; substitution is the chain rule backwards; long division and completing the square bring more rational functions into reach. Choose the technique by looking at the integrand's structure, and check by differentiating.

## Key formulas and procedures

| Want | Do this |
|---|---|
| Left / right sum from a table | ∑ (width) × (left / right height); n subintervals use n heights |
| Trapezoidal sum | ∑ Δxₖ (f(left) + f(right))/2 = (L + R)/2 |
| Over or under? | increasing: L under, R over; concave up: T over, M under (reverse each for the opposite property) |
| Limit of a sum as an integral | Δx gives b − a; sample point a + kΔx gives a; the function acts on the sample point |
| d/dx ∫ from a to u(x) of f(t) dt | f(u(x)) · u′(x) |
| d/dx ∫ from x to b of f(t) dt | −f(x) |
| Amount at time t | A(0) + ∫ from 0 to t of (rate in − rate out) ds |
| ∫ from a to b of f(x) dx | F(b) − F(a) |
| ∫ xⁿ dx (n ≠ −1) | xⁿ⁺¹/(n + 1) + C |
| ∫ (1/x) dx, ∫ eˣ dx | ln |x| + C, eˣ + C |
| ∫ cos x dx, ∫ sin x dx | sin x + C, −cos x + C |
| ∫ sec²x dx, ∫ sec x tan x dx | tan x + C, sec x + C |
| ∫ 1/(u² + a²) du | (1/a) arctan(u/a) + C |
| ∫ 1/√(a² − u²) du | arcsin(u/a) + C |
| Substitution | u = inner function, du = u′ dx, fix constant factors, change limits for definite integrals |
| Rational, top degree ≥ bottom | divide: quotient + remainder/divisor |
| Irreducible quadratic, constant top | complete the square, then arctangent (or arcsine under a root) |

## Classic question types and how to attack them

**"Approximate using a left/right/trapezoidal sum with the subintervals indicated by the table."** List the widths first; they are rarely equal. Then answer the follow-up: "is it an over- or underestimate?" needs a stated reason (increasing/decreasing or concavity) on the whole interval.

**"Explain the meaning of ∫ from 0 to 12 of R(t) dt in context."** Name the quantity, the units and the interval: "the number of cubic meters of water that flow in from t = 0 to t = 12 hours."

**"g(x) = ∫ from 0 to x of f(t) dt, with f graphed. Find g(4), g′(4), g″(4)."** g is signed area (walk left by subtracting); g′ is the height of f; g″ is the slope of f.

**"Find the absolute maximum of g (or of the amount in a tank)."** Candidates Test: the endpoints and every point where g′ = f changes sign. Compute each value with areas or integrals and compare.

**"Find the amount at time t / when is the amount least?"** A(t) = A(0) + ∫ from 0 to t of (in − out). Critical points where in = out.

**"Evaluate the integral."** Rewrite, then choose: basic rule, substitution, division, completing the square. With substitution in a definite integral, change the limits.

## Justification sentences that earn points

- "Because R is increasing on 0 ≤ t ≤ 5, each left endpoint gives the least value of R on its subinterval, so the left Riemann sum is an underestimate."
- "Because f is concave down on [a, b], the trapezoidal sum is an underestimate."
- "g′(x) = f(x) by the Fundamental Theorem of Calculus. f changes from positive to negative at x = 3, so g has a relative maximum at x = 3."
- "g″(x) = f′(x). f changes from increasing to decreasing at x = 0, so the graph of g has a point of inflection there."
- "A′(t) = R(t) − 50 = 0 at t ≈ 0.823 and t ≈ 5.460. Comparing A at these times and at both endpoints, the minimum is A(12) ≈ 681.991."
- "W is differentiable, hence continuous, and W(0) = 50 < 60 < 68 = W(4), so by the Intermediate Value Theorem W(t) = 60 for some t in (0, 4)."

## Common mistakes

- Using every table value in a left or right sum, or one Δx for unequal widths.
- Reporting area under a rate in rate units, or forgetting the initial amount.
- Adding areas below the axis when the net change is asked.
- Confusing g(a) = 0 with g′(a) = f(a).
- Forgetting the chain rule factor with a limit like x² or sin x, or the minus sign for a variable lower limit.
- Subtracting integrand values instead of antiderivative values, or F(a) − F(b).
- Leaving off + C; writing ln x for ln |x|.
- Keeping x-limits after a substitution.
- Splitting an integral over a product or a quotient.
- Dropping the 1/a in the arctangent pattern.

## Calculator or not?

Expect a calculator for integrals of messy rate models (such as 40 + 25 sin(t/2)), for solving rate in = rate out, and for integrals with no elementary antiderivative, such as e^(−x²). Report three decimal places. Riemann sums from tables, accumulation functions from graphs, and every antiderivative technique are no-calculator skills, and the justifications must be in words whichever section you are in.

## Self-test

1. A table gives r(t) = 5, 9, 4 at t = 0, 2, 6. Find the trapezoidal sum on [0, 6].
2. Write lim (n→∞) ∑ (k = 1 to n) (2/n)(3 + 2k/n)² as a definite integral.
3. Find d/dx ∫ from 1 to x³ of ln(1 + t²) dt.
4. If ∫ from 0 to 4 of f = 7 and ∫ from 1 to 4 of f = 2, find ∫ from 1 to 0 of 3f(x) dx.
5. Evaluate ∫ from 0 to 1 of (3x² + eˣ) dx.
6. Find ∫ x² cos(x³) dx.
7. Find ∫ (x² + 5)/(x + 1) dx.
8. Find ∫ 1/(x² + 10x + 34) dx.
9. f is increasing and concave up on [0, 4]. Order L, R, T and the exact integral I.

**Answers.** 1. 2·(5 + 9)/2 + 4·(9 + 4)/2 = 14 + 26 = 40. 2. ∫ from 3 to 5 of x² dx (or ∫ from 0 to 2 of (3 + x)² dx). 3. 3x² ln(1 + x⁶). 4. ∫ from 0 to 1 of f = 5, so the answer is −15. 5. 1 + (e − 1) = e. 6. (1/3) sin(x³) + C. 7. x² + 5 = (x + 1)(x − 1) + 6: x²/2 − x + 6 ln |x + 1| + C. 8. (x + 5)² + 9: (1/3) arctan((x + 5)/3) + C. 9. L < I < T < R (T is the average of L and R, and concave up makes T an overestimate).

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 6, Topics 6.1–6.10 and 6.14). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
