# Week 03 · Polynomial Functions and Rates of Change

**Topics:** 1.4 Polynomial Functions and Rates of Change
**Practices:** 2 (multiple representations), 3 (communication and reasoning), 1 (procedural and symbolic fluency)
**Framework:** AP Precalculus CED, Unit 1, Topic 1.4, learning objectives in our own words
**Spiral:** Week 1's language of increasing, decreasing and concavity, and week 2's difference patterns (constant first differences for linear, constant second differences for quadratic), are extended here to polynomials of any degree. From Algebra 2: polynomial vocabulary, multiplying polynomials, and the idea that a polynomial's graph is smooth and unbroken.

## What you need to be able to do

- **1.4** Identify the degree, leading term, leading coefficient and constant term of a polynomial in standard or factored form.
- **1.4** Locate relative (local) maxima and minima where a polynomial switches between increasing and decreasing, and decide whether an extremum is also global (absolute).
- **1.4** Locate points of inflection where the rate of change switches from increasing to decreasing or the reverse, that is, where the graph changes concavity.
- **1.4** Recognise even functions (symmetric about the y-axis, f(−x) = f(x)) and odd functions (symmetric about the origin, f(−x) = −f(x)) from formulas, graphs and tables.
- **1.4** Use the fact that, for a polynomial of degree n and equally spaced inputs, the nth differences are constant, to decide which degree of polynomial could fit a table.
- **1.4** Use the degree to bound the number of turning points (at most n − 1) and zeros (at most n), and know that between two real zeros a polynomial must have a turning point.

## Key terms

| Term | Meaning |
|---|---|
| Polynomial function | p(x) = aₙxⁿ + aₙ₋₁xⁿ⁻¹ + … + a₁x + a₀, with whole-number exponents and real coefficients. |
| Degree | The highest exponent n with a nonzero coefficient. |
| Leading term / coefficient | aₙxⁿ / aₙ. |
| Relative (local) maximum | An output f(c) at least as large as every output at nearby inputs; f switches from increasing to decreasing at c. |
| Relative (local) minimum | An output f(c) no larger than every output at nearby inputs; f switches from decreasing to increasing at c. |
| Global (absolute) maximum / minimum | The largest / smallest output over the whole domain, if one exists. |
| Extrema | Maxima and minima together. |
| Point of inflection | A point where the graph changes concavity; the rate of change switches between increasing and decreasing there. |
| Even function | f(−x) = f(x) for every x in the domain; the graph is symmetric about the y-axis. |
| Odd function | f(−x) = −f(x) for every x in the domain; the graph is symmetric about the origin. |

## Polynomial vocabulary (1.4)

A polynomial is a sum of terms aₖxᵏ with whole-number exponents. In **standard form** the terms are written from highest to lowest power, so the degree and leading coefficient are visible at once. In **factored form** you multiply out only the leading pieces.

**Worked example.** Give the degree and leading coefficient of p(x) = (2x − 1)³(x + 4).

The leading term is (2x)³ · x = 8x⁴. Degree 4, leading coefficient 8. (Expanding fully gives 8x⁴ + 20x³ − 42x² + 23x − 4, but you never need to.)

A polynomial's graph is **smooth and unbroken**: no gaps, jumps, corners or asymptotes. This is why a sign change between two inputs always produces a zero in between (week 1), and why the graph must turn around between two zeros.

## Extrema: relative and global (1.4)

A **relative maximum** occurs where a function changes from increasing to decreasing; a **relative minimum** where it changes from decreasing to increasing. The output there is the maximum or minimum *value*; the input is *where* it occurs. Answer the question asked: "the relative maximum is 2" and "the relative maximum occurs at x = −1" are different statements.

A **global maximum** is the largest output over the entire domain. For a polynomial on all real numbers:

- **Odd degree:** one end goes to ∞ and the other to −∞, so there is **no** global maximum and **no** global minimum.
- **Even degree, positive leading coefficient:** both ends go to ∞, so there is a global minimum (the lowest of the relative minima) and no global maximum.
- **Even degree, negative leading coefficient:** a global maximum, no global minimum.

On a **closed interval** [a, b] a polynomial always has a global maximum and minimum; they occur either at relative extrema inside the interval or at the endpoints. That matters in modelling, where the context restricts the domain.

**Turning points.** A polynomial of degree n has at most n − 1 turning points (relative extrema) and at most n real zeros. Between two consecutive real zeros there must be at least one turning point.

**Worked example.** The polynomial f(x) = x³ − 3x has these values.

| x | −3 | −2 | −1 | 0 | 1 | 2 | 3 |
|---|---|---|---|---|---|---|---|
| f(x) | −18 | −2 | 2 | 0 | −2 | 2 | 18 |

From the graph (or a calculator), f increases on x < −1, decreases on −1 < x < 1, and increases on x > 1. So f has a relative maximum of 2 at x = −1 and a relative minimum of −2 at x = 1. Because the degree is odd, neither is global: f(3) = 18 > 2 and f(−3) = −18 < −2. Two turning points is the most a cubic can have.

**Worked example.** g(x) = x⁴ − 4x² has relative minima at x = −√2 and x = √2, both with value (√2)⁴ − 4(√2)² = 4 − 8 = −4, and a relative maximum of 0 at x = 0. Degree 4 with positive leading coefficient: the global minimum is −4 (at both x = ±√2) and there is no global maximum. Three turning points, the most a quartic can have.

**Try it.**
1. What is the largest number of relative extrema a degree-6 polynomial can have?
2. Does p(x) = −2x⁴ + x³ + 5 have a global maximum, a global minimum, both or neither?
3. A polynomial has zeros at x = 1 and x = 4 and no zeros in between. What must happen between 1 and 4?

*Answers:* 1. 5. 2. Even degree, negative leading coefficient: a global maximum only. 3. The graph turns around: there is at least one relative extremum on (1, 4).

## Points of inflection (1.4)

Concavity describes how the rate of change behaves. A **point of inflection** is where the rate of change stops increasing and starts decreasing (concave up to concave down), or the reverse.

For f(x) = x³ − 3x, the slopes are steep and positive far left, shrink to 0 at x = −1, become most negative at x = 0, and grow again. The rate of change is decreasing until x = 0 and increasing after: f is concave down on x < 0, concave up on x > 0, and (0, 0) is a point of inflection.

A useful fact for checking: every cubic ax³ + bx² + cx + d has exactly one point of inflection, at x = −b/(3a), and its graph is symmetric about that point. Between a cubic's relative maximum and relative minimum, the inflection point sits exactly halfway.

**Worked example.** p(x) = −x³ + 6x² − 9x + 5 has a relative minimum at (1, 1) and a relative maximum at (3, 5). Find its point of inflection and describe its concavity.

Halfway between x = 1 and x = 3 is x = 2 (and −b/(3a) = −6/(−3) = 2). p(2) = −8 + 24 − 18 + 5 = 3. Point of inflection (2, 3). Before x = 2 the rate of change is increasing (from negative values up through 0 at x = 1), so p is concave up on x < 2; after x = 2 it is concave down.

**From a table.** Look at first differences over equal steps: where they switch from growing to shrinking (or the reverse), there is an inflection point nearby. For the drone table in week 1, the changes 8, 20, 26, 26, 20, 8 peaked around t = 3.

**Rates of change near extrema and inflection points.** At a smooth relative extremum, the rate of change is 0 (the graph is momentarily flat). At a point of inflection, the rate of change itself reaches a relative maximum or minimum: the curve is steepest (or least steep) there.

## Even and odd functions (1.4)

A function is **even** if f(−x) = f(x) for all x: its graph is a mirror image across the y-axis. It is **odd** if f(−x) = −f(x): rotating the graph 180° about the origin leaves it unchanged.

For polynomials there is a quick test:

- Only **even powers** (including a constant, which is x⁰) ⟹ even function. Example: x⁴ − 4x² + 7.
- Only **odd powers** ⟹ odd function. Example: 2x⁵ − 7x. Every odd polynomial passes through the origin.
- A mix of even and odd powers ⟹ neither. Example: x³ + 1, or x² + x.

To check any function, compute f(−x) and compare it with f(x) and −f(x).

**Worked example.** Is h(x) = x³ − 3x odd? h(−x) = (−x)³ − 3(−x) = −x³ + 3x = −(x³ − 3x) = −h(x). Yes. The table above shows it: f(−2) = −2 = −f(2), and f(−3) = −18 = −f(3).

**Worked example.** If f is even and f(3) = −7, then f(−3) = −7. If g is odd and g(3) = −7, then g(−3) = 7.

## Differences and degree (1.4)

Week 2 showed that equal steps give constant first differences for linear and constant second differences for quadratic functions. The pattern continues: **for a polynomial of degree n, the nth differences over equal steps are constant** (and the (n + 1)th differences are 0). With step 1, the constant nth difference is aₙ · n!, so for a cubic it is 6a and for a quartic 24a.

**Worked example.** Use the table of f(x) = x³ − 3x above.

- First differences: 16, 4, −2, −2, 4, 16
- Second differences: −12, −6, 0, 6, 12
- Third differences: 6, 6, 6, 6

Constant third differences: degree 3. With step 1, 6a = 6 gives a = 1. The second differences change sign between x = −1 and x = 1 (around x = 0), matching the inflection point.

**Try it.**
1. A table with input step 1 has constant third differences of −12. What are the degree and leading coefficient?
2. For p(x) = 3x⁴ + x, what is the constant fourth difference with step 1?
3. Is f(x) = x⁶ − 2x² + 1 even, odd or neither? And g(x) = x⁵ + x²?

*Answers:* 1. Degree 3, 6a = −12, so a = −2. 2. 3 · 24 = 72. 3. f is even; g is neither.

## A modelling example (1.4)

**Worked example (calculator).** A hypothetical packaging designer makes an open box from a 20 cm by 12 cm sheet of card by cutting a square of side x cm from each corner and folding up the sides. The volume is V(x) = x(20 − 2x)(12 − 2x) = 4x³ − 64x² + 240x cm³.

- **Domain in context:** the cut must be positive, and 12 − 2x > 0 requires x < 6. So 0 < x < 6.
- **Values:** V(1) = 180, V(2) = 256, V(3) = 252, V(4) = 192.
- **Relative maximum:** a graphing calculator's maximum feature gives x ≈ 2.43, V ≈ 262.7 cm³. On 0 < x < 6 this is also the global maximum, since V falls toward 0 at both ends of the domain.
- **Rates:** on [1, 2] V rises at 76 cm³ per cm of cut; on [3, 4] it falls at 60 cm³ per cm.

As a polynomial on all real numbers V has degree 3 and no global maximum; the context restricts the domain and creates one.

## Calculator notes

To find a relative maximum or minimum on a graphing calculator, graph the function, choose a window that shows the turning point, and use the maximum/minimum feature (give left and right bounds around the turning point). Report the input and output to three decimal places unless told otherwise. On no-calculator questions, extrema will be given or readable from a table or graph, or the function will be a quadratic you can put in vertex form.

## Common mistakes

- **Giving the input when the value is asked (or the reverse).** "The relative maximum value" is an output.
- **Calling every relative extremum global.** Odd-degree polynomials have no global extrema on all real numbers.
- **Confusing a point of inflection with an extremum.** At an extremum the function changes direction; at an inflection point the rate of change changes direction.
- **Testing evenness with one point.** f(2) = f(−2) does not make f even; it must hold for every x. To show a function is *not* even, one counterexample is enough.
- **Forgetting the constant term.** x³ + 1 is not odd: (−x)³ + 1 = −x³ + 1, which is not −(x³ + 1).
- **Using the nth difference as the leading coefficient.** With step 1 the nth difference is aₙ · n!.

## Where this goes next

Week 4 studies the zeros of polynomials in depth: multiplicity (crossing or bouncing at an intercept), complex zeros and the Fundamental Theorem of Algebra. Week 5 makes end behaviour precise with limit notation. The vocabulary of extrema and inflection points returns throughout the course and is central to calculus.

## Self-check

1. State the degree and leading coefficient of −(x + 2)²(3x − 1)³.
2. Explain why a polynomial of odd degree can have no global maximum.
3. A cubic has a relative maximum at (−2, 9) and a relative minimum at (4, −3). Where is its point of inflection?
4. Show algebraically that f(x) = x⁴ − 3x² is even, and describe its symmetry.
5. A table with input step 1 has outputs 1, 2, 9, 28, 65, 126. What degree polynomial fits it, and what is the leading coefficient?

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 1, Topic 1.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
