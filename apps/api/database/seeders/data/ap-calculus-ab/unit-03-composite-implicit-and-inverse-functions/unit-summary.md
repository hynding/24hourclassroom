# Unit 3 · Differentiation: Composite, Implicit, and Inverse Functions · The night-before sheet

**AP exam weight:** 5–10% of the AB exam (the CED range for Unit 3), though the chain rule and implicit differentiation reappear in almost every later unit
**Topics:** 3.1 The Chain Rule · 3.2 Implicit Differentiation · 3.3 Differentiating Inverse Functions · 3.4 Differentiating Inverse Trigonometric Functions · 3.5 Selecting Procedures for Calculating Derivatives · 3.6 Calculating Higher-Order Derivatives
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 3, Topics 3.1–3.6, in our own words

## The ideas that generate every question

1. **Rates through a chain multiply (3.1).** If y depends on u and u depends on x, then dy/dx = (dy/du)(du/dx). In function notation, d/dx f(g(x)) = f′(g(x)) · g′(x): the outer derivative, evaluated at the inner function, times the inner derivative. Every layer of a composite contributes one factor.
2. **y is a function of x even when it is not isolated (3.2).** Differentiate both sides of an equation with respect to x; every y-term picks up a factor dy/dx by the chain rule; then solve for dy/dx. The slope depends on the point (x, y), not on x alone.
3. **Inverse functions swap rise and run (3.3).** The graph of f⁻¹ is the reflection of f's graph in y = x, so slopes become reciprocals at matching points: if f(a) = b, then (f⁻¹)′(b) = 1/f′(a). The algebraic reason is the chain rule applied to f(f⁻¹(x)) = x.
4. **Inverse trig derivatives come from implicit differentiation (3.4).** From sin y = x, cos y · y′ = 1, and cos y = √(1 − x²) on the restricted range. Similar steps give arccos and arctan. With the chain rule, each formula takes an inner function u and a factor u′.
5. **Read the structure before you differentiate (3.5).** The last operation performed decides the first rule. Rewrite when it helps (negative exponents, dividing through, log properties), and nest rules as deep as the expression requires.
6. **Derivatives can be differentiated again (3.6).** f″ measures how fast the slope changes; f‴, f⁽⁴⁾, … follow. Polynomials eventually give 0, exponentials repeat with a factor, sines and cosines cycle every four. For implicit relations, differentiate dy/dx again, using dy/dx for y′, and substitute.

## Key formulas and procedures

| Want | Do this |
|---|---|
| d/dx f(g(x)) | f′(g(x)) · g′(x) |
| d/dx [u(x)]ⁿ | n[u(x)]ⁿ⁻¹ · u′(x) |
| d/dx √u | u′/(2√u) |
| d/dx sin u, cos u, tan u | cos u · u′, −sin u · u′, sec²u · u′ |
| d/dx e^u, ln u | e^u · u′, u′/u |
| h′(a) from a table, h = f∘g | look up g(a), then f′(g(a)), then multiply by g′(a) |
| d/dx [y²], [y³], [xy] (implicit) | 2y · y′, 3y² · y′, y + x · y′ |
| Implicit dy/dx | differentiate, collect y′ terms, factor, divide |
| Horizontal / vertical tangent, y′ = N/D | N = 0, D ≠ 0 / D = 0, N ≠ 0; solve with the curve's equation |
| (f⁻¹)′(b) | find a with f(a) = b, then 1/f′(a) |
| f′(a) = 0 | f⁻¹ has a vertical tangent at b = f(a) (not differentiable there) |
| d/dx arcsin u | u′/√(1 − u²) |
| d/dx arccos u | −u′/√(1 − u²) |
| d/dx arctan u | u′/(1 + u²) |
| nth derivative of e^(kx) | kⁿe^(kx) |
| Derivatives of sin x | cycle sin, cos, −sin, −cos; use the order's remainder on division by 4 |
| Degree-n polynomial | nth derivative aₙ · n!, then 0 |
| Implicit d²y/dx² | differentiate y′ with the quotient rule (y′ for the derivative of y), substitute y′, simplify with the curve |
| g″ for g = f⁻¹ | −f″(g(x)) · g′(x)/[f′(g(x))]² |

## Classic question types and how to attack them

**"Find h′(2), where h(x) = f(g(x)), from the table."** Write h′(2) = f′(g(2)) · g′(2) before substituting. Look up g(2) first; it is the column for f′.

**"Find the derivative of [a nested expression]."** Count the layers from the outside in; write one factor per layer. Keep each outer function's input unchanged.

**"Write the equation of the tangent line to the curve at the point."** Differentiate implicitly, substitute both coordinates into dy/dx, then use y − y₁ = m(x − x₁).

**"Find all points where the tangent is horizontal (or vertical)."** Set the numerator (or denominator) of dy/dx to zero, substitute into the original equation, solve, and check the other part is nonzero.

**"g is the inverse of f. Find g′(b)."** Find the matching input a from a table, a graph or by inspection (try small integers). Answer 1/f′(a). Watch for distractors that evaluate f′ at b or forget the reciprocal.

**"Find d²y/dx² at the point."** Find dy/dx, differentiate it again treating y as a function of x, substitute the point and the numerical value of dy/dx. Then use the sign to state concavity.

**"Find the nth derivative" or "the 99th derivative of sin x."** Compute a few derivatives, spot the pattern, and use it.

**In context (calculator section).** A composite such as temperature at a diver's depth, D(t) = W(d(t)), is differentiated with the chain rule; the value D′(t₀) is interpreted with units (output units per input unit) and a direction (increasing or decreasing). An inverse function T of depth gives "minutes per meter" as the reciprocal of "meters per minute".

## Justifications that earn points

- **Show the chain-rule setup.** "h′(2) = f′(g(2)) · g′(2) = f′(3) · 5 = 10." A bare number often loses the point if it is wrong, and sometimes even if it is right.
- **Inverse derivative.** "Since f(2) = 3, g(3) = 2, so g′(3) = 1/f′(2) = 1/3." State the matching input.
- **Invertibility.** "f′(x) = 3x² + 1 > 0 for all x, so f is increasing and therefore one-to-one; it has an inverse."
- **Horizontal tangents.** "dy/dx = 0 requires 2x + y = 0. Substituting y = −2x into the curve gives 3x² = 7 … At these points x + 2y ≠ 0, so the tangent is horizontal."
- **No such point.** "A horizontal tangent needs y = 0, but substituting y = 0 into e^y + xy = e gives 1 = e, which is false, so there is none."
- **Concavity from the second derivative.** "d²y/dx² = −42/125 < 0 at (1, 2), so the curve is concave down there."
- **Interpretation.** "D′(2) ≈ −0.458: at t = 2 minutes, the temperature at the diver's location is decreasing at about 0.458 °C per minute."

## Common mistakes

- Forgetting the inner derivative: d/dx e^(3x) = 3e^(3x), not e^(3x).
- Evaluating the outer derivative at x instead of at g(x); in tables, reading the wrong column.
- Writing cos(3x²) for the derivative of sin(x³); the angle stays x³.
- Applying the power rule to an exponential.
- Leaving dy/dx off a y-term, or missing the product rule on xy.
- Reporting horizontal-tangent x-values without finding the points on the curve.
- In the inverse rule, using f′(b) instead of f′(a), or forgetting the reciprocal.
- Dropping arccos's minus sign; not squaring the whole inner function in 1 − u² or 1 + u².
- Multiplying derivatives in a product, especially when taking a second derivative of something like x eˣ.
- Treating y as a constant in an implicit second derivative.
- Confusing d²y/dx² with (dy/dx)².

## Calculator or not?

Most of Unit 3 is no-calculator work: symbolic derivatives, implicit differentiation, inverse derivatives from tables, and higher derivatives. The calculator appears when a context gives a messy composite (exponential of a sine, for example) and asks for a derivative's value at a point, a time when a rate equals zero, or a numerical second derivative. Use the calculator's numerical derivative to check symbolic work, store intermediate values instead of rounding them, and report three decimal places.

## Self-test

1. Differentiate y = (x² − 3x)⁵ and y = e^(√x).
2. With f(1) = 3, f′(1) = −2, g(1) = 1, g′(1) = 4 and f′(3) = 6, find (f∘f)′(1) and (f∘g)′(1).
3. Find dy/dx for x³ − xy + y² = 7, and the slope at (1, 3).
4. f(x) = x³ + 3x has inverse g. Find g′(4).
5. Differentiate y = arcsin(5x) and y = arctan(√x).
6. Find d²y/dx² for y = sin(x²).
7. For x² − y² = 1, find d²y/dx² in terms of y.
8. Find the 50th derivative of e^(−2x).

**Answers.** 1. 5(x² − 3x)⁴(2x − 3); e^(√x)/(2√x). 2. (f∘f)′(1) = f′(f(1)) · f′(1) = f′(3)(−2) = −12; (f∘g)′(1) = f′(g(1)) · g′(1) = f′(1) · 4 = −8. 3. 3x² − y − xy′ + 2yy′ = 0, so y′ = (y − 3x²)/(2y − x); at (1, 3): 0/5 = 0. 4. f(1) = 4 and f′(1) = 6, so 1/6. 5. 5/√(1 − 25x²); 1/(2√x(1 + x)). 6. 2cos(x²) − 4x²sin(x²). 7. y′ = x/y, y″ = (y − xy′)/y² = (y² − x²)/y³ = −1/y³. 8. (−2)⁵⁰e^(−2x) = 2⁵⁰e^(−2x).

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 3, Topics 3.1–3.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
