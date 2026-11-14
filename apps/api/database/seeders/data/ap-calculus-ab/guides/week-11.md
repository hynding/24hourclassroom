# Week 11 · Implicit Differentiation and Inverse Functions

**Topics:** 3.2 Implicit Differentiation · 3.3 Differentiating Inverse Functions · 3.4 Differentiating Inverse Trigonometric Functions
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification)
**Framework:** AP Calculus AB and BC CED, Unit 3, Topics 3.2–3.4, learning objectives in our own words
**Spiral:** Everything this week is the chain rule from week 10 used in a new setting. Implicit differentiation treats y as an unknown inner function of x; the inverse function rule comes from differentiating f(g(x)) = x; and the inverse trigonometric derivatives come from implicit differentiation. From Unit 2 you need the basic derivatives and the product rule; from Precalculus, inverse functions as reflections in y = x and the restricted ranges of arcsin, arccos and arctan.

## What you need to be able to do

- **3.2** Differentiate an equation in x and y implicitly, attaching dy/dx to the derivative of every term containing y, and solve for dy/dx.
- **3.2** Find the slope of a curve at a point, write a tangent line, and locate points with horizontal or vertical tangent lines.
- **3.3** Find the derivative of an inverse function at a point using (f⁻¹)′(b) = 1/f′(a), where f(a) = b, from a formula, a table or a graph.
- **3.4** Differentiate arcsin x, arccos x and arctan x, and composites such as arcsin(3x) or arctan(x²), and explain where the formulas come from.

## Key terms

| Term | Meaning |
|---|---|
| Explicit function | y written as a formula in x, such as y = √(25 − x²). |
| Implicit relation | An equation linking x and y without isolating y, such as x² + y² = 25. |
| Implicit differentiation | Differentiating both sides of an equation with respect to x, treating y as a function of x. |
| Inverse function f⁻¹ | The function that undoes f: f⁻¹(b) = a exactly when f(a) = b. Its graph is f's graph reflected in y = x. |
| Matching input | For (f⁻¹)′(b), the value a with f(a) = b. |
| arcsin, arccos, arctan | Inverses of sine on [−π/2, π/2], cosine on [0, π], and tangent on (−π/2, π/2). |

## Implicit differentiation (3.2)

Some curves cannot be written as a single function y = f(x). The circle x² + y² = 25 fails the vertical line test; a curve like y³ + xy = 10 can't be solved for y without a lot of pain. But near most points, the curve still behaves like the graph of a differentiable function, so it has a slope. Implicit differentiation finds that slope without solving for y.

The key idea: **y is a function of x**, even if you never write the formula. So any expression in y is a composite, and the chain rule applies:

- d/dx [y²] = 2y · dy/dx
- d/dx [y³] = 3y² · dy/dx
- d/dx [sin y] = cos y · dy/dx
- d/dx [e^y] = e^y · dy/dx
- d/dx [xy] = y + x · dy/dx (product rule)

The method has four steps: (1) differentiate both sides with respect to x; (2) attach dy/dx to the derivative of every y-term; (3) gather all dy/dx terms on one side and everything else on the other; (4) factor out dy/dx and divide.

**Worked example 1.** For the curve y² = x³ − 2x + 5, find dy/dx and the tangent line at (1, 2).

Check the point: 2² = 4 and 1 − 2 + 5 = 4. It is on the curve.

Differentiate: 2y(dy/dx) = 3x² − 2, so dy/dx = (3x² − 2)/(2y).

At (1, 2): dy/dx = (3 − 2)/4 = 1/4. Tangent line: y = 2 + (1/4)(x − 1).

The slope formula depends on both x and y. At x = 2 the curve passes through (2, 3) and (2, −3), with slopes 10/6 = 5/3 and −5/3. The curve is symmetric about the x-axis (replacing y by −y changes nothing), and the slopes reflect that.

**Horizontal and vertical tangents.** When dy/dx = N/D, the tangent is horizontal where N = 0 and D ≠ 0, and vertical where D = 0 and N ≠ 0. In both cases the point must lie on the curve, so solve the condition **together with** the curve's equation. For y² = x³ − 2x + 5, horizontal tangents occur where 3x² − 2 = 0, at x = ±√(2/3) (both give positive values of x³ − 2x + 5, so the points exist), and vertical tangents occur where y = 0.

**Worked example 2.** Find all points on x² − 2xy + 3y² = 18 where the tangent line is horizontal or vertical.

Differentiate, using the product rule on −2xy:

2x − 2[y + x(dy/dx)] + 6y(dy/dx) = 0
2x − 2y + (6y − 2x)(dy/dx) = 0
dy/dx = (2y − 2x)/(6y − 2x) = (y − x)/(3y − x).

Horizontal: y − x = 0. Substituting y = x: x² − 2x² + 3x² = 2x² = 18, so x = ±3, giving (3, 3) and (−3, −3). At these points 3y − x = ±6 ≠ 0, so the slope really is 0.

Vertical: 3y − x = 0. Substituting x = 3y: 9y² − 6y² + 3y² = 6y² = 18, so y = ±√3, giving (3√3, √3) and (−3√3, −√3). The numerator y − x is not zero there.

The curve is a tilted ellipse, and these four points are where it is "widest" in each direction.

## Differentiating inverse functions (3.3)

If f is invertible, the graph of f⁻¹ is the graph of f reflected in the line y = x. Reflection swaps x and y, so it swaps rise and run: a slope of m becomes a slope of 1/m. The point (a, b) on f becomes (b, a) on f⁻¹. That gives the rule:

**If f(a) = b and f′(a) ≠ 0, then (f⁻¹)′(b) = 1/f′(a).**

The algebraic reason is one line of chain rule. Let g = f⁻¹, so f(g(x)) = x for every x in g's domain. Differentiate both sides: f′(g(x)) · g′(x) = 1, so g′(x) = 1/f′(g(x)).

The hard part is never the formula; it is finding the matching input. To find (f⁻¹)′(b), first solve f(a) = b for a. Then evaluate f′ at a, not at b.

**Worked example 3.** Let f(x) = x³ + 2x + 1, and let g be its inverse. Find g′(4).

Find a with f(a) = 4. Try small integers: f(1) = 1 + 2 + 1 = 4. So a = 1 and g(4) = 1.

f′(x) = 3x² + 2, so f′(1) = 5. Therefore g′(4) = 1/5.

(We know f has an inverse because f′(x) = 3x² + 2 > 0 for every x, so f is increasing and one-to-one. You cannot easily solve y = x³ + 2x + 1 for x, so this rule is the only practical route.)

**Worked example 4.** A differentiable, invertible function f has f(2) = 5, f(5) = 9, f′(2) = 4 and f′(5) = 7. Find the derivative of g = f⁻¹ at x = 5.

The inverse's input is 5. Which input of f gives output 5? f(2) = 5, so the matching input is 2. g′(5) = 1/f′(2) = 1/4. The tempting answer 1/f′(5) = 1/7 uses the wrong column; the values f(5) and f′(5) are a distraction here.

**When it fails.** If f′(a) = 0, f has a horizontal tangent at (a, b), and its reflection has a vertical tangent at (b, a). Then f⁻¹ is not differentiable at b. For example, f(x) = x³ has f′(0) = 0, and its inverse ∛x has a vertical tangent at the origin.

## Derivatives of inverse trigonometric functions (3.4)

The inverse trig functions undo sine, cosine and tangent on restricted domains: arcsin x gives the angle in [−π/2, π/2] whose sine is x; arccos x the angle in [0, π] whose cosine is x; arctan x the angle in (−π/2, π/2) whose tangent is x.

**Worked example 5.** Derive the derivative of y = arcsin x.

Rewrite as sin y = x, with −π/2 ≤ y ≤ π/2. Differentiate implicitly: cos y · (dy/dx) = 1, so dy/dx = 1/cos y.

Now express cos y in terms of x. Since sin²y + cos²y = 1, cos y = ±√(1 − sin²y) = ±√(1 − x²). On [−π/2, π/2] cosine is non-negative, so take the positive root:

d/dx arcsin x = 1/√(1 − x²), for −1 < x < 1.

The same method gives the other two:

| Function | Derivative | Valid for |
|---|---|---|
| arcsin x | 1/√(1 − x²) | −1 < x < 1 |
| arccos x | −1/√(1 − x²) | −1 < x < 1 |
| arctan x | 1/(1 + x²) | all real x |

The arccos derivative is the negative of arcsin's because arcsin x + arccos x = π/2, a constant.

With the chain rule, each formula takes a u in place of x and a factor u′ on top:

d/dx arcsin u = u′/√(1 − u²), d/dx arccos u = −u′/√(1 − u²), d/dx arctan u = u′/(1 + u²).

**Worked example 6.** Differentiate arcsin(3x) and arctan(x²), and evaluate d/dx arccos x at x = 1/2.

d/dx arcsin(3x) = 3/√(1 − (3x)²) = 3/√(1 − 9x²).

d/dx arctan(x²) = 2x/(1 + (x²)²) = 2x/(1 + x⁴).

d/dx arccos x at 1/2 = −1/√(1 − 1/4) = −1/√(3/4) = −2/√3 ≈ −1.155.

In each, square the **whole** inner function. Writing 3/√(1 − 3x²) or 2x/(1 + x²) is the commonest slip.

## Common mistakes

- **Forgetting dy/dx on y-terms.** d/dx [y²] = 2y(dy/dx), not 2y. Every y-term carries the factor.
- **Missing the product rule** on terms like xy or x²y. d/dx [xy] = y + x(dy/dx), not just dy/dx or x(dy/dx).
- **Reporting horizontal tangents without checking the curve.** N = 0 gives a condition, not a point; substitute into the original equation and check D ≠ 0.
- **Using the wrong input in the inverse rule.** For (f⁻¹)′(b), evaluate f′ at the a with f(a) = b, never at b itself.
- **Forgetting to take the reciprocal.** The inverse's slope is 1/f′(a), not f′(a).
- **Dropping arccos's minus sign** or confusing the arcsin and arctan formulas.
- **Not squaring the whole inner function** in an inverse-trig derivative.

## Self-check

1. Find dy/dx for x³ + y³ = 9 and evaluate it at (1, 2).
2. Find dy/dx for xy + y² = 6, and give the slope at (1, 2).
3. Let f(x) = x⁵ + 3x − 2 and g = f⁻¹. Find g′(2).
4. The graph of an invertible function f has tangent line y = 3x − 1 at x = 2. Find the slope of the inverse's graph at the corresponding point, and name that point.
5. Differentiate y = arctan(eˣ) and y = arcsin(x/2).
6. Why is d/dx arcsin x undefined at x = 1?

*Answers:* 1. dy/dx = −x²/y²; −1/4. 2. y + x(dy/dx) + 2y(dy/dx) = 0, so dy/dx = −y/(x + 2y); at (1, 2): −2/5. 3. f(1) = 2 and f′(1) = 8, so 1/8. 4. f(2) = 5 and f′(2) = 3, so the inverse has slope 1/3 at (5, 2). 5. eˣ/(1 + e^(2x)); 1/√(4 − x²). 6. The denominator √(1 − x²) is 0 there: the graph of arcsin has a vertical tangent at (1, π/2), matching sine's horizontal tangent at (π/2, 1).

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 3, Topics 3.2–3.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
