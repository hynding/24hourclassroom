# Week 09 · The Product Rule, the Quotient Rule, and the Other Trigonometric Derivatives

**Topics:** 2.8 The Product Rule · 2.9 The Quotient Rule · 2.10 Finding the Derivatives of Tangent, Cotangent, Secant, and/or Cosecant Functions
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification)
**Framework:** AP Calculus AB and BC CED, Unit 2, Topics 2.8–2.10, learning objectives in our own words
**Spiral:** Week 8 gave you derivatives for sums, differences and constant multiples, and for the basic functions xⁿ, sin x, cos x, eˣ and ln x. Products and quotients are the next combinations, and they do not behave the way sums do. With the quotient rule in hand, the four remaining trigonometric functions follow from week 8's sine and cosine derivatives and the Pythagorean identity. Tangent lines (week 6) and differentiability (week 7) appear again as the places you apply the rules.

## What you need to be able to do

- **2.8** Differentiate a product with the product rule, including from a table of function and derivative values.
- **2.8** Explain why the derivative of a product is not the product of the derivatives.
- **2.9** Differentiate a quotient with the quotient rule, keeping the order of subtraction, and decide when simplifying or rewriting is quicker.
- **2.10** Recall and derive the derivatives of tan x, cot x, sec x and csc x.
- **2.8–2.10** Combine the rules with tangent lines and interpret product and quotient rates in context.

## Key terms

| Term | Meaning |
|---|---|
| Product rule | d/dx [f(x)g(x)] = f′(x)g(x) + f(x)g′(x). |
| Quotient rule | d/dx [f(x)/g(x)] = (f′(x)g(x) − f(x)g′(x))/[g(x)]², for g(x) ≠ 0. |
| sec x, csc x | 1/cos x and 1/sin x. |
| tan x, cot x | sin x/cos x and cos x/sin x. |

## The product rule (2.8)

The derivative of a sum is the sum of the derivatives, but the derivative of a product is **not** the product of the derivatives. The quickest check: x · x = x² has derivative 2x, while 1 · 1 = 1.

The correct rule is

  d/dx [f(x)g(x)] = f′(x)g(x) + f(x)g′(x).

**Why.** Think of f(x)g(x) as the area of a rectangle with sides f and g. When x increases by h, the sides change by Δf and Δg, and the area grows by two thin strips, (Δf)·g and f·(Δg), plus a small corner Δf·Δg. Divide by h: the strips give (Δf/h)·g + f·(Δg/h), which tends to f′g + fg′, while the corner gives (Δf/h)·Δg, which tends to f′(x) · 0 = 0 because g is continuous. Each factor's change is multiplied by the other factor's current size.

**Worked example (a product from a table).** Differentiable functions f and g satisfy f(2) = −1, f′(2) = 4, g(2) = 2 and g′(2) = −3. Find p′(2) for p(x) = f(x)g(x).

p′(2) = f′(2)g(2) + f(2)g′(2) = 4 · 2 + (−1)(−3) = 8 + 3 = 11.

The tempting wrong answers are f′(2)g′(2) = −12 (product of derivatives) and p(2) = −2 (the value, not the rate). Write the rule first, then substitute.

**Worked example (a product of basic functions).** Differentiate k(x) = x³eˣ and find the slope at x = 1.

k′(x) = 3x² · eˣ + x³ · eˣ = x²eˣ(3 + x). At x = 1: k′(1) = 4e ≈ 10.87. Factoring the answer is optional but useful later: it shows at a glance that k′(x) = 0 only at x = 0 and x = −3.

For three factors the pattern extends: (fgh)′ = f′gh + fg′h + fgh′. And a product with a constant factor needs no product rule: d/dx [5 sin x] = 5 cos x by the constant multiple rule.

## The quotient rule (2.9)

For g(x) ≠ 0,

  d/dx [f(x)/g(x)] = (f′(x)g(x) − f(x)g′(x))/[g(x)]².

Order matters. The numerator starts with the derivative of the **top**; swapping the two terms flips the sign of the whole answer. One memory aid is "low d-high minus high d-low, over low squared". The rule follows from the product rule applied to f = (f/g) · g, solved for (f/g)′.

**Worked example (a quotient).** Differentiate y = (2x + 1)/(x − 3).

Top 2x + 1 with derivative 2; bottom x − 3 with derivative 1.

dy/dx = (2(x − 3) − (2x + 1)(1))/(x − 3)² = (2x − 6 − 2x − 1)/(x − 3)² = −7/(x − 3)².

The derivative is negative wherever it is defined, so the graph is falling on each side of its vertical asymptote x = 3.

**Choosing a method.** The quotient rule always works, but it is often not the shortest route:

- A constant over a function is a power: 5/x³ = 5x⁻³, derivative −15x⁻⁴.
- A function over a constant is a constant multiple: (x² + sin x)/4 has derivative (2x + cos x)/4.
- A quotient that divides term by term becomes a sum of powers: (x² + 3x)/√x = x^(3/2) + 3x^(1/2), as in week 8.

On the other hand, eˣ/x or x/(x + 1) genuinely needs the quotient rule. For y = x/(x + 1): y′ = ((1)(x + 1) − x(1))/(x + 1)² = 1/(x + 1)². At x = 1 the point is (1, 1/2) and the slope is 1/4, so the tangent line is y = 1/2 + (1/4)(x − 1).

## Derivatives of tan x, cot x, sec x and csc x (2.10)

| f(x) | f′(x) |
|---|---|
| tan x | sec² x |
| cot x | −csc² x |
| sec x | sec x tan x |
| csc x | −csc x cot x |

Each one comes from the quotient rule and the identity sin² x + cos² x = 1. Notice the pattern: the "co-" functions (cos, cot, csc) all have a minus sign in their derivatives.

**Worked example (deriving tan′ and a tangent line).** Show that d/dx [tan x] = sec² x and find the tangent line to y = tan x at x = π/4.

With top sin x (derivative cos x) and bottom cos x (derivative −sin x):

d/dx [sin x/cos x] = (cos x · cos x − sin x · (−sin x))/cos² x = (cos² x + sin² x)/cos² x = 1/cos² x = sec² x.

At x = π/4: tan(π/4) = 1 and sec²(π/4) = (√2)² = 2, so the tangent line is y = 1 + 2(x − π/4). Since sec² x ≥ 1 everywhere it is defined, tan x is increasing on every interval of its domain.

The same steps with sec x = 1/cos x give (0 · cos x − 1 · (−sin x))/cos² x = sin x/cos² x = sec x tan x. Swapping the roles of sine and cosine gives the cotangent and cosecant results with their minus signs.

Domains matter. tan x and sec x are undefined where cos x = 0 (x = π/2 + kπ); cot x and csc x where sin x = 0 (x = kπ). At those inputs the functions have vertical asymptotes, so they are not continuous and therefore not differentiable (week 7's contrapositive).

## Products and quotients in context

**Worked example (a hypothetical bakery's revenue).** A bakery sells N(t) loaves per day at P(t) dollars each, so daily revenue is R(t) = N(t)P(t). On day 4, N = 120, N′ = −6 loaves per day, P = 15 dollars and P′ = 0.5 dollars per day.

R′(4) = N′(4)P(4) + N(4)P′(4) = (−6)(15) + (120)(0.5) = −90 + 60 = −30.

On day 4 revenue is decreasing at 30 dollars per day, per day. The product rule shows why: raising the price adds 60, but losing sales costs 90. A rising factor does not guarantee a rising product.

If the daily cost is C(t) with C(4) = 900 and C′(4) = 30, the average cost per loaf A = C/N has

A′(4) = (C′N − CN′)/N² = (30 · 120 − 900 · (−6))/120² = 9000/14400 = 0.625,

so the average cost per loaf is rising at 0.625 dollars per loaf per day.

## Common mistakes

- **Multiplying derivatives.** (fg)′ ≠ f′g′; (f/g)′ ≠ f′/g′.
- **Reversing the quotient-rule numerator.** The top's derivative comes first: f′g − fg′.
- **Forgetting to square the denominator.**
- **Using the quotient rule on a constant numerator** when the power rule is faster (and less error-prone).
- **Mixing up the trig derivatives.** tan → sec², sec → sec tan; the "co-" versions carry a minus sign.
- **Dropping a factor at evaluation time.** eˣ at x = 1 is e, not 1.

## Self-check

1. Differentiate y = x ln x and find the slope at x = e.
2. Differentiate y = (x² − 1)/(x² + 1).
3. Use the table from the worked example (f(2) = −1, f′(2) = 4, g(2) = 2, g′(2) = −3) to find the derivative of g(x)/f(x) at x = 2.
4. Show that d/dx [csc x] = −csc x cot x.
5. Find the slope of y = eˣ sin x at x = 0.

*Answers:* 1. ln x + 1; at x = e the slope is 2. 2. 4x/(x² + 1)². 3. (g′f − gf′)/f² = ((−3)(−1) − (2)(4))/1 = −5. 4. (0 · sin x − 1 · cos x)/sin² x = −cos x/sin² x = −(1/sin x)(cos x/sin x). 5. eˣ sin x + eˣ cos x at 0 is 0 + 1 = 1.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 2, Topics 2.8–2.10). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
