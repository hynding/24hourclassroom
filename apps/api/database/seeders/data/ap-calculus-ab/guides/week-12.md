# Week 12 · Selecting Procedures and Higher-Order Derivatives

**Topics:** 3.5 Selecting Procedures for Calculating Derivatives · 3.6 Calculating Higher-Order Derivatives
**Practices:** 1 (Implementing Mathematical Processes), 4 (Communication and Notation), 2 (Connecting Representations)
**Framework:** AP Calculus AB and BC CED, Unit 3, Topics 3.5–3.6, learning objectives in our own words
**Spiral:** This week pulls together every rule from Unit 2 (power, sum, product, quotient, trig, eˣ, ln x) and from weeks 10 and 11 (chain rule, implicit differentiation, inverse and inverse trig derivatives). Nothing new is added to the toolkit; the new skill is choosing well. Then you apply the toolkit twice or more to get second and higher derivatives, which Unit 4 uses for acceleration and Unit 5 for concavity.

## What you need to be able to do

- **3.5** Identify the top-level structure of an expression and choose the derivative rule (or sequence of rules) that it calls for.
- **3.5** Rewrite an expression before differentiating when that makes the work shorter or safer (negative exponents, dividing out, logarithm properties).
- **3.5** Check a derivative by evaluating it at a convenient point or comparing it with a numerical estimate.
- **3.6** Find second, third and higher derivatives, using the notation f″, f‴, f⁽ⁿ⁾, d²y/dx² and dⁿy/dxⁿ correctly.
- **3.6** Recognise patterns in repeated derivatives of polynomials, exponentials, sines and cosines, and powers of x.
- **3.6** Find the second derivative of an implicitly defined relation, substituting dy/dx and simplifying with the original equation.

## Key terms

| Term | Meaning |
|---|---|
| Top-level structure | The last operation performed when evaluating an expression; it decides which rule to apply first. |
| Second derivative | f″(x) = d/dx [f′(x)], also written y″ or d²y/dx². |
| Third derivative | f‴(x), also written d³y/dx³. |
| nth derivative | f⁽ⁿ⁾(x) or dⁿy/dxⁿ: the result of differentiating n times. |
| Implicit second derivative | d²y/dx² for a relation in x and y, found by differentiating dy/dx with respect to x. |

## Selecting a procedure (3.5)

Before writing any derivative, look at the expression and ask: **what is done last?** That operation is the top level, and it tells you the first rule.

| Top level | First rule | Example |
|---|---|---|
| Sum or difference | Differentiate term by term | x³ + sin(2x) |
| Constant times something | Constant multiple rule | 5e^(x²) |
| Product | Product rule | e^(3x) sin x |
| Quotient | Quotient rule, or rewrite | (2x + 1)³/x² |
| A function of a function | Chain rule | arctan(√x), ln(x² + 1) |
| Equation not solved for y | Implicit differentiation | y³ + y = x |
| Inverse of a known function | (f⁻¹)′(b) = 1/f′(a) | inverse of x³ + x + 2 |

Then go one layer down. Each piece that is itself a composite, product or quotient gets its own rule, inside the first.

**Worked example 1.** Choose the rules and differentiate e^(3x) sin x, arctan(√x) and ln(x² + 1).

e^(3x) sin x: the top level is a product. Product rule, with the chain rule for e^(3x):
d/dx = 3e^(3x) sin x + e^(3x) cos x = e^(3x)(3 sin x + cos x).

arctan(√x): the top level is arctan of something. Chain rule, with the inner derivative 1/(2√x):
d/dx = 1/(1 + (√x)²) · 1/(2√x) = 1/(2√x(1 + x)).

ln(x² + 1): the top level is ln of something. Chain rule: 2x/(x² + 1).

**Rewrite first when it helps.** Three rewrites save the most time.

- **Constant over something:** 5/(x² + 1) = 5(x² + 1)⁻¹, so its derivative is −5(x² + 1)⁻² · 2x = −10x/(x² + 1)². No quotient rule needed.
- **Something over a monomial:** (x³ − 4x)/x = x² − 4 for x ≠ 0, with derivative 2x.
- **Log of a product or quotient:** ln(x(x + 1)) = ln x + ln(x + 1), so its derivative is 1/x + 1/(x + 1).

**Worked example 2.** Differentiate y = (2x + 1)³/x² in two ways and compare.

*Quotient rule.* With the chain rule for the numerator:
dy/dx = [3(2x + 1)² · 2 · x² − (2x + 1)³ · 2x]/x⁴.
Factor 2x(2x + 1)² from the numerator: 2x(2x + 1)²[3x − (2x + 1)]/x⁴ = 2(2x + 1)²(x − 1)/x³.

*Rewrite as a product.* y = (2x + 1)³ · x⁻².
dy/dx = 6(2x + 1)² · x⁻² + (2x + 1)³ · (−2x⁻³) = 2(2x + 1)²x⁻³[3x − (2x + 1)] = 2(2x + 1)²(x − 1)/x³.

Both routes agree. The factored form shows at once that dy/dx = 0 at x = 1 (horizontal tangent at (1, 27)) and at x = −1/2.

**Checking.** On a calculator section, compare your derivative at one point with the calculator's numerical derivative. Without a calculator, a quick sign check helps: if the graph is clearly rising at a point, your derivative should be positive there. You do not need to simplify a derivative on the AP exam unless the question asks you to use it further, but simplifying carelessly is a common way to lose a correct answer, so leave it alone if you are short of time.

## Higher-order derivatives (3.6)

The derivative of f′ is the **second derivative** f″. It tells how fast the slope is changing; in Unit 5 its sign will decide concavity, and in Unit 4 the second derivative of position is acceleration. Keep differentiating to get f‴, f⁽⁴⁾ and so on. From the fourth derivative onward, write the order in parentheses rather than stacking primes.

**Polynomials.** Each derivative lowers the degree by one. For f(x) = x⁵: f′ = 5x⁴, f″ = 20x³, f‴ = 60x², f⁽⁴⁾ = 120x, f⁽⁵⁾ = 120, and every later derivative is 0. A polynomial of degree n has nth derivative aₙ · n! and (n + 1)th derivative 0.

**Exponentials.** d/dx e^(kx) = ke^(kx), so the nth derivative is kⁿe^(kx). For y = e^(3x), y″ = 9e^(3x), which is 9 at x = 0.

**Sines and cosines.** The derivatives of sin x cycle with period four: sin x, cos x, −sin x, −cos x, sin x, … To find a high-order derivative, divide the order by 4 and use the remainder: the 23rd derivative of sin x has remainder 3, so it is −cos x.

**Worked example 3.** Find the first three derivatives of y = sin(2x).

y′ = 2cos(2x), y″ = −4sin(2x), y‴ = −8cos(2x).

Each step multiplies by the chain-rule factor 2 and moves one place along the cycle. The nth derivative carries a factor 2ⁿ.

**Worked example 4.** Let g(x) = ln(x² + 1). Find g″(x) and where g″ is positive or negative.

g′(x) = 2x/(x² + 1). Quotient rule:

g″(x) = [2(x² + 1) − 2x · 2x]/(x² + 1)² = (2 − 2x²)/(x² + 1)².

The denominator is always positive, so g″ has the sign of 2 − 2x²: positive on −1 < x < 1 and negative for |x| > 1, with g″(0) = 2 and g″(±1) = 0. You will see in Unit 5 that this means the graph is concave up between −1 and 1 and concave down outside.

**Worked example 5.** Find the pattern in the derivatives of f(x) = x ln x.

f′(x) = ln x + x · (1/x) = ln x + 1 (product rule)
f″(x) = 1/x
f‴(x) = −1/x²
f⁽⁴⁾(x) = 2/x³
f⁽⁵⁾(x) = −6/x⁴

From the second derivative on, the signs alternate and the coefficients are factorials: for n ≥ 2, f⁽ⁿ⁾(x) = (−1)ⁿ(n − 2)!/xⁿ⁻¹.

## Second derivatives of implicit relations (3.6)

To get d²y/dx² for a relation, differentiate the expression for dy/dx with respect to x. It almost always contains y, so the quotient rule must use dy/dx for the derivative of y. Then substitute the formula for dy/dx and, if possible, simplify with the original equation.

**Worked example 6.** For the circle x² + y² = 4, find d²y/dx² and the concavity at (0, 2).

First derivative: 2x + 2y(dy/dx) = 0, so dy/dx = −x/y.

Second derivative, by the quotient rule:

d²y/dx² = −[y · 1 − x · (dy/dx)]/y² = −[y − x(−x/y)]/y² = −[y + x²/y]/y².

Multiply top and bottom by y: −(y² + x²)/y³. The original equation says x² + y² = 4, so

d²y/dx² = −4/y³.

At (0, 2): −4/8 = −1/2 < 0, so the circle is concave down at the top, as it should be. At the bottom, (0, −2), the value is +1/2: concave up. A result that contradicts the picture means a slip, usually treating y as a constant.

**Inverse functions.** The same thinking gives the second derivative of g = f⁻¹. Differentiate g′(x) = 1/f′(g(x)) with the chain rule:

g″(x) = −f″(g(x)) · g′(x)/[f′(g(x))]².

For f(x) = x³ + x + 2, g(4) = 1, f′(1) = 4, f″(1) = 6, so g′(4) = 1/4 and g″(4) = −6 · (1/4)/16 = −3/32.

## Common mistakes

- **Starting with the wrong rule.** Find the top-level operation first; e^(3x) sin x is a product before it is a composite.
- **Using the quotient rule on a constant numerator.** It works, but rewriting with a negative exponent is faster and safer.
- **Multiplying derivatives in a product.** (x eˣ)′ is (x + 1)eˣ, not eˣ. This error is especially common in second derivatives, where the first derivative is itself a product.
- **Confusing d²y/dx² with (dy/dx)².** The second derivative is the derivative of the derivative, not its square.
- **Treating y as a constant in an implicit second derivative.** Use the quotient rule with dy/dx for y′, then substitute.
- **Losing count of the order.** Write each derivative on its own line and label it.

## Self-check

1. Choose the rules for y = x²arctan x and differentiate.
2. Differentiate y = 7/(3x − 2)² by rewriting first.
3. Find f‴(x) for f(x) = e^(−2x) and for f(x) = x⁴ − 2x³ + x.
4. Find the 30th derivative of cos x.
5. Find d²y/dx² for y² = x, in terms of y.
6. If f′(x) = sin²x, find f″(π/4).

*Answers:* 1. Product rule with arctan's derivative: 2x arctan x + x²/(1 + x²). 2. 7(3x − 2)⁻², so −14(3x − 2)⁻³ · 3 = −42/(3x − 2)³. 3. −8e^(−2x); 24x − 12. 4. 30 has remainder 2 on division by 4, so −cos x. 5. 2y(dy/dx) = 1 gives dy/dx = 1/(2y), and d²y/dx² = −(1/(2y²))(dy/dx) = −1/(4y³). 6. f″(x) = 2 sin x cos x, so f″(π/4) = 2(√2/2)(√2/2) = 1.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 3, Topics 3.5–3.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
