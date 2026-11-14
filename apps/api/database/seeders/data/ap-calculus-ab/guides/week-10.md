# Week 10 · The Chain Rule

**Topics:** 3.1 The Chain Rule
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 3, Topic 3.1, learning objectives in our own words
**Spiral:** Unit 2 gave you derivatives of the basic functions (xⁿ, sin x, cos x, eˣ, ln x, and the other four trig functions) and the rules for sums, constant multiples, products and quotients. Every one of those rules assumes the input is plain x. This week removes that restriction. From Precalculus you need function composition: reading f(g(x)) as "do g first, then f" and splitting a formula into an inner and an outer layer.

## What you need to be able to do

- **3.1** Recognise a composite function and identify its inner and outer functions, including composites of three or more layers.
- **3.1** Differentiate a composite with the chain rule, written either as f′(g(x)) · g′(x) or as dy/dx = (dy/du)(du/dx).
- **3.1** Combine the chain rule with the power, trigonometric, exponential and logarithmic rules, and use it inside the product and quotient rules.
- **3.1** Evaluate the derivative of a composite at a point from a table or graph of values of f, g, f′ and g′.
- **3.1** Write the equation of a line tangent to the graph of a composite function.

## Key terms

| Term | Meaning |
|---|---|
| Composite function | f(g(x)), also written (f∘g)(x): the output of g becomes the input of f. |
| Inner function | The function applied first, g in f(g(x)). |
| Outer function | The function applied last, f in f(g(x)). |
| Chain rule | d/dx [f(g(x))] = f′(g(x)) · g′(x). |
| Leibniz form | If y = f(u) and u = g(x), then dy/dx = (dy/du) · (du/dx). |
| General power rule | d/dx [u(x)]ⁿ = n[u(x)]ⁿ⁻¹ · u′(x), the chain rule with outer function uⁿ. |

## Why the chain rule multiplies (3.1)

Think of a composite as two machines in a row. If u = g(x) changes 2 units for each unit of x, and y = f(u) changes 3 units for each unit of u, then each unit of x makes y change 3 · 2 = 6 units. Rates of change through a chain **multiply**. Leibniz notation makes that look almost like cancelling fractions:

dy/dx = (dy/du) · (du/dx).

It is not really cancellation (these are limits, not fractions), but it is a reliable memory aid. In function notation the same statement is

d/dx [f(g(x))] = f′(g(x)) · g′(x).

Read it in words: **derivative of the outer, evaluated at the inner, times the derivative of the inner.** Two features matter. First, the outer derivative is evaluated at g(x), not at x. Second, the inner derivative appears as a separate factor. Most chain-rule errors drop one of these.

**How to find the layers.** Ask: "If I had to compute this on a calculator for a given x, what would I press last?" That last operation is the outer function. For (3x² − 5)⁴ you compute 3x² − 5 and then raise it to the 4th power, so the outer is u⁴. For sin(x³) you cube first and take the sine last, so the outer is sin u. For sin³x, which means (sin x)³, you take the sine first and cube last, so the outer is u³.

## The chain rule with powers and roots (3.1)

With the outer function uⁿ, the chain rule becomes the general power rule: lower the exponent by one, keep the inside unchanged, multiply by the inside's derivative.

**Worked example 1.** Differentiate y = (3x² − 5)⁴.

Outer: u⁴, with derivative 4u³. Inner: u = 3x² − 5, with derivative 6x.

dy/dx = 4(3x² − 5)³ · 6x = 24x(3x² − 5)³.

Do not expand (3x² − 5)⁴ first. It works, but it is slow and error-prone, and the factored answer is what you want later for finding zeros of the derivative.

Roots and reciprocals are powers in disguise. √u = u^(1/2), so d/dx √u = (1/2)u^(−1/2) · u′ = u′/(2√u). And 1/u = u⁻¹, so d/dx (1/u) = −u⁻² · u′ = −u′/u². For example, d/dx (2x + 1)⁻¹ = −2(2x + 1)⁻².

## The chain rule with trigonometric functions (3.1)

Each trig derivative from Unit 2 gains a factor of the inner derivative:

| Function | Derivative |
|---|---|
| sin u | cos u · u′ |
| cos u | −sin u · u′ |
| tan u | sec²u · u′ |
| sec u | sec u tan u · u′ |

**Worked example 2.** Compare y = sin(x³) with y = sin³x.

For sin(x³), the outer is sine and the inner is x³: dy/dx = cos(x³) · 3x² = 3x² cos(x³). The angle inside the cosine stays x³. A very common error is writing cos(3x²), which differentiates the inside *inside* the cosine.

For sin³x = (sin x)³, the outer is the cube and the inner is sin x: dy/dx = 3 sin²x · cos x.

The same idea gives d/dx cos²x = 2 cos x · (−sin x) = −2 sin x cos x. If you know the identity 2 sin x cos x = sin(2x), you can also write this as −sin(2x); either form is acceptable on the AP exam, which does not require simplification.

## The chain rule with exponential and logarithmic functions (3.1)

Because eˣ is its own derivative, the chain rule leaves e^u unchanged and only adds the inner derivative: d/dx e^u = e^u · u′. For the natural logarithm, d/dx ln u = (1/u) · u′ = u′/u, for u > 0.

**Worked example 3.** Differentiate e^(4x − x²) and ln(x² + 1).

d/dx e^(4x − x²) = e^(4x − x²) · (4 − 2x) = (4 − 2x)e^(4x − x²). The exponent does not change. Do not apply the power rule to an exponential; the power rule needs a variable base and a constant exponent.

d/dx ln(x² + 1) = 2x/(x² + 1). Notice that x² + 1 > 0 for every x, so this derivative exists for every real x.

A useful check: d/dx ln(4x) = 4/(4x) = 1/x, the same as the derivative of ln x. That is no accident, since ln(4x) = ln 4 + ln x and ln 4 is a constant.

## Composites with three or more layers (3.1)

When functions are nested more deeply, peel the layers from the outside in and write one derivative factor for each layer.

**Worked example 4.** Differentiate y = sin²(3x).

Layers, outside in: squaring, then sine, then multiplying by 3. So y = [sin(3x)]².

- Derivative of the square, at the inside: 2 sin(3x)
- Derivative of the sine, at its inside: cos(3x)
- Derivative of 3x: 3

dy/dx = 2 sin(3x) · cos(3x) · 3 = 6 sin(3x) cos(3x).

In general, d/dx f(g(h(x))) = f′(g(h(x))) · g′(h(x)) · h′(x). Count your factors: three layers, three factors.

## The chain rule inside the product and quotient rules (3.1)

Real expressions mix rules. Decide the **top-level structure** first (is the whole thing a product? a quotient? a composite?), then use the chain rule whenever one of the pieces is itself a composite.

For y = x²(4x − 1)³, the top level is a product. The product rule needs the derivative of (4x − 1)³, which is 3(4x − 1)² · 4 = 12(4x − 1)². So

dy/dx = 2x(4x − 1)³ + x² · 12(4x − 1)² = 2x(4x − 1)²[(4x − 1) + 6x] = 2x(4x − 1)²(10x − 1).

Factoring out the common powers, as here, makes the derivative's zeros visible (x = 0, x = 1/4, x = 1/10), which you will need in Unit 5.

## The chain rule from tables and graphs (3.1)

AP questions often give only selected values of f, g, f′ and g′. The rule is the same; the work is careful bookkeeping. For h(x) = f(g(x)), to find h′(a):

1. Look up g(a). This is the input for f′.
2. Look up f′ at that input, f′(g(a)).
3. Look up g′(a).
4. Multiply: h′(a) = f′(g(a)) · g′(a).

**Worked example 5.** Use the table to find h′(1) for h(x) = f(g(x)) and k′(3) for k(x) = g(f(x)).

| x | 1 | 2 | 3 | 4 |
|---|---|---|---|---|
| f(x) | 3 | 4 | 1 | 2 |
| f′(x) | −2 | 5 | 3 | −1 |
| g(x) | 2 | 3 | 4 | 1 |
| g′(x) | 4 | −3 | 6 | 2 |

h′(1) = f′(g(1)) · g′(1) = f′(2) · 4 = 5 · 4 = 20.

k′(3) = g′(f(3)) · f′(3) = g′(1) · 3 = 4 · 3 = 12.

Write the general expression before substituting. On a free-response question, the line "h′(1) = f′(g(1)) · g′(1)" is usually what earns the point, and it protects you from looking up the wrong column.

Two special cases worth knowing: d/dx f(2x) = 2f′(2x), and d/dx f(x²) = 2x f′(x²), so at x = 3 you need f′(9), not f′(3).

## Tangent lines to composites (3.1)

A tangent line needs a point and a slope. For a composite h(x) = f(g(x)) at x = a, the point is (a, f(g(a))) and the slope is f′(g(a))g′(a). Then y = h(a) + h′(a)(x − a).

**Worked example 6.** Find the line tangent to y = √(2x + 5) at x = 2.

Point: y(2) = √9 = 3, so (2, 3).

Slope: dy/dx = 2/(2√(2x + 5)) = 1/√(2x + 5), so at x = 2 the slope is 1/3.

Tangent line: y = 3 + (1/3)(x − 2).

Leaving off the inner derivative 2 would give a slope of 1/6, a line that crosses the curve instead of touching it. A quick sanity check with a calculator graph catches that.

## Common mistakes

- **Forgetting the inner derivative.** d/dx (x² + 1)⁵ is 5(x² + 1)⁴ · 2x, not 5(x² + 1)⁴. The derivative of e^(3x) is 3e^(3x), not e^(3x).
- **Evaluating the outer derivative at x.** f′(g(x)), not f′(x). In table problems this is the error of reading f′ in the wrong column.
- **Differentiating inside the outer function.** d/dx sin(x³) is cos(x³) · 3x², not cos(3x²).
- **Treating an exponential as a power.** d/dx e^(x²) is 2x e^(x²), not x² e^(x² − 1).
- **Confusing sin(x²), sin²x and sin(2x).** They have different layers and different derivatives: 2x cos(x²), 2 sin x cos x, and 2 cos(2x).
- **Stopping one layer early** in a triple composite. One factor per layer.
- **Assuming composition commutes.** f(g(x)) and g(f(x)) are different functions with different derivatives.

## Self-check

1. Differentiate y = (5 − x³)⁶ and y = 1/(x² + 4).
2. Differentiate y = cos(e^x) and y = e^(cos x). Which is the outer function in each?
3. With the table in worked example 5, find the derivative of f(f(x)) at x = 2.
4. Differentiate y = tan³(2x), naming the three layers.
5. Find the equation of the line tangent to y = e^(x² − 1) at x = 1.
6. If g(x) = f(3x) and f′(6) = −4, what is g′(2)?

*Answers:* 1. −18x²(5 − x³)⁵; −2x/(x² + 4)². 2. −e^x sin(e^x) (outer cosine); −sin x · e^(cos x) (outer exponential). 3. f′(f(2)) · f′(2) = f′(4) · 5 = −5. 4. Cube, tangent, 2x: 3 tan²(2x) · sec²(2x) · 2 = 6 tan²(2x) sec²(2x). 5. Point (1, 1), slope 2: y = 1 + 2(x − 1). 6. g′(2) = 3f′(6) = −12.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 3, Topic 3.1). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
