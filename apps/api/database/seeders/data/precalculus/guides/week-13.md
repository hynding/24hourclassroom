# Week 13 · Composition and Inverse Functions

**Topics:** 2.7 Composition of Functions · 2.8 Inverse Functions
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 2, Topics 2.7–2.8, learning objectives in our own words
**Spiral:** Week 8's transformations are compositions in disguise: f(x − 3) is f applied after "subtract 3". Week 11's rewrites and week 12's models supply functions to compose and invert (a temperature in a model, a cost as a function of time). Weeks 6 and 7's work on rational functions helps with domains and with inverting rational functions. From Algebra 2: function notation, solving equations for a variable, and square roots.

## What you need to be able to do

- **2.7** Evaluate a composition f(g(x)) from formulas, from tables and from graphs, working from the inside out, and explain why f(g(x)) and g(f(x)) are usually different.
- **2.7** Find a formula for a composition and its domain: inputs allowed by the inner function whose outputs are allowed by the outer function.
- **2.7** Decompose a function into simpler functions, and recognise the identity function I(x) = x, for which f(I(x)) = I(f(x)) = f(x).
- **2.8** Explain that an inverse function reverses the input–output pairs of f, so (a, b) on f means (b, a) on f⁻¹, and the domain and range trade places.
- **2.8** Decide whether a function is invertible (one-to-one), restrict a domain to make it invertible, and find an inverse from a table, a graph (reflection across y = x) or a formula (swap and solve).
- **2.8** Verify that two functions are inverses by showing f(g(x)) = x and g(f(x)) = x on the right domains, and interpret an inverse in context with units.

## Key terms

| Term | Meaning |
|---|---|
| Composition | (f ∘ g)(x) = f(g(x)): apply g first, then f to the result. |
| Inner / outer function | In f(g(x)), g is inner (applied first) and f is outer. |
| Decomposition | Writing a function as a composition of simpler ones. |
| Identity function | I(x) = x; composing with it changes nothing. |
| One-to-one | Different inputs always give different outputs; every horizontal line meets the graph at most once. |
| Inverse function f⁻¹ | The function that undoes f: f⁻¹(b) = a exactly when f(a) = b. |
| Restricted domain | A smaller domain chosen so that a function becomes one-to-one, e.g. x ≥ 0 for x². |

## Composition from formulas (2.7)

To compose, substitute the whole inner expression for the variable of the outer function.

**Worked example.** Let f(x) = x² + 1 and g(x) = 2x − 3. Find f(g(x)), g(f(x)) and f(g(2)).

f(g(x)) = (2x − 3)² + 1 = 4x² − 12x + 10.
g(f(x)) = 2(x² + 1) − 3 = 2x² − 1.
f(g(2)) = f(1) = 2. (Check with the formula: 16 − 24 + 10 = 2.)

The two compositions are different functions. Order matters: f ∘ g means "g, then f".

**Domain of a composition.** An input x is allowed in f(g(x)) when x is in the domain of g *and* g(x) is in the domain of f.

**Worked example.** Let f(x) = √x and g(x) = x − 3. Find the domains of f(g(x)) and g(f(x)).

f(g(x)) = √(x − 3) needs x − 3 ≥ 0: domain x ≥ 3.
g(f(x)) = √x − 3 needs only x ≥ 0 for the inner √x: domain x ≥ 0.

**Worked example.** Let f(x) = 1/(x − 2) and g(x) = x². Find f(g(x)) and its domain.

f(g(x)) = 1/(x² − 2). The inner function accepts every x, but the outer function rejects the input 2, so we need x² ≠ 2: domain all reals except x = ±√2.

## Composition from tables and graphs (2.7)

Work from the inside out: read the inner value first, then use it as the input to the outer function.

| x | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| p(x) | 2 | 3 | 4 | 0 | 1 |
| q(x) | 4 | 4 | 1 | 3 | 0 |

- p(q(2)) = p(1) = 3.
- q(p(2)) = q(4) = 0.
- q(q(0)) = q(4) = 0.
- p(q(4)) = p(0) = 2.

If an inner output is not in the outer table, the composition is undefined there from the given information.

With graphs, read g(a) off the graph of g, then find that value on the x-axis of f's graph and read f there.

## Decomposition and the identity (2.7)

Decomposing means spotting the "inside" of a formula.

| Function | Inner g(x) | Outer f(x) |
|---|---|---|
| h(x) = (3x + 1)⁵ | 3x + 1 | x⁵ |
| k(x) = √(x³ + 2) | x³ + 2 | √x |
| m(x) = 2^(x²) | x² | 2ˣ |
| n(x) = 1/(x − 4) | x − 4 | 1/x |

Decompositions are not unique: (3x + 1)⁵ is also f(g(x)) with g(x) = 3x and f(x) = (x + 1)⁵.

Transformations are compositions. If g(x) = f(x − 3) + 2, then g = A ∘ f ∘ S with S(x) = x − 3 (shift the input) and A(x) = x + 2 (shift the output).

The **identity function** I(x) = x leaves every input alone, so f(I(x)) = f(x) and I(f(x)) = f(x). It plays the role for composition that the number 1 plays for multiplication, which is why inverses are defined by "composing gives the identity".

**Try it.**
1. With p and q from the table, find q(p(1)) and p(p(3)).
2. Let f(x) = 3x − 1 and g(x) = x². Find f(g(x)) and g(f(x)).
3. Find the domain of f(g(x)) for f(x) = √x and g(x) = 6 − 2x.

*Answers:* 1. q(3) = 3; p(0) = 2. 2. 3x² − 1; (3x − 1)² = 9x² − 6x + 1. 3. 6 − 2x ≥ 0, so x ≤ 3.

## Inverse functions (2.8)

A function f sends each input a to one output b. Its inverse f⁻¹, if it exists, sends b back to a:

**f(a) = b ⟺ f⁻¹(b) = a.**

So every point (a, b) on the graph of f gives a point (b, a) on the graph of f⁻¹. Swapping coordinates reflects a point across the line y = x, so **the graph of f⁻¹ is the reflection of the graph of f across y = x.** The domain of f⁻¹ is the range of f, and the range of f⁻¹ is the domain of f.

**When does an inverse exist?** Only when f is **one-to-one**: no output comes from two different inputs. If f(−2) = f(2) = 4, then f⁻¹(4) would have to be both −2 and 2, which a function cannot do. Graphically: every horizontal line meets the graph of f at most once. Strictly increasing or strictly decreasing functions (lines with nonzero slope, x³, every exponential function) are one-to-one.

**Restricting the domain.** f(x) = (x − 1)² is not one-to-one, but on x ≥ 1 it is increasing, so it has an inverse there. Swapping and solving: x = (y − 1)², y − 1 = √x (the positive root, since y ≥ 1), so f⁻¹(x) = 1 + √x with domain x ≥ 0.

**Inverse from a table.** Swap the rows. From p in the table above (outputs 2, 3, 4, 0, 1 are all different, so p is one-to-one):

| x | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| p⁻¹(x) | 3 | 4 | 0 | 1 | 2 |

For example p(2) = 4, so p⁻¹(4) = 2. The function q is not invertible: q(0) = q(1) = 4.

**Inverse from a formula: swap and solve.** Write y = f(x), swap x and y, and solve for y.

**Worked example.** Find the inverse of f(x) = (x − 4)/3.

x = (y − 4)/3, so 3x = y − 4 and y = 3x + 4. f⁻¹(x) = 3x + 4. "Subtract 4, then divide by 3" is undone by "multiply by 3, then add 4": inverse steps in reverse order.

**Worked example (rational).** Find the inverse of f(x) = (2x + 1)/(x − 3).

Swap: x = (2y + 1)/(y − 3). Multiply: x(y − 3) = 2y + 1, so xy − 3x = 2y + 1. Collect y: xy − 2y = 3x + 1, so y(x − 2) = 3x + 1 and f⁻¹(x) = (3x + 1)/(x − 2). Note the domains: f has domain x ≠ 3 and range y ≠ 2 (its horizontal asymptote), and f⁻¹ has domain x ≠ 2 and range y ≠ 3.

**Verifying.** Two functions are inverses exactly when f(g(x)) = x for every x in the domain of g and g(f(x)) = x for every x in the domain of f. For f(x) = (x − 4)/3 and g(x) = 3x + 4: f(g(x)) = (3x + 4 − 4)/3 = x and g(f(x)) = 3 · (x − 4)/3 + 4 = x.

**Inverses in context.** A hypothetical taxi fare is F(m) = 3.50 + 2.25m dollars for a trip of m miles. Its inverse answers the reverse question, "how far can I go for this much money?":

F⁻¹(d) = (d − 3.50)/2.25 miles for d dollars.

F⁻¹(30) = 26.5/2.25 ≈ 11.78, so $30 pays for a trip of about 11.8 miles. The input of F⁻¹ has the units of F's output (dollars), and its output has the units of F's input (miles).

**Try it.**
1. Find the inverse of g(x) = 5 − 2x and verify one composition.
2. If h(3) = −7, what is h⁻¹(−7)? Which point is on the graph of h⁻¹?
3. Find the inverse of k(x) = x³ + 1.

*Answers:* 1. g⁻¹(x) = (5 − x)/2; g(g⁻¹(x)) = 5 − (5 − x) = x. 2. 3; (−7, 3). 3. k⁻¹(x) = ∛(x − 1).

## Calculator notes

A graphing calculator can graph f, a candidate inverse and the line y = x in a square window: the two graphs should be mirror images. Many calculators also draw an inverse directly (DrawInv). For tables, enter f in one list and read the inverse by swapping lists. None of this replaces the algebraic verification f(g(x)) = x, which the AP exam can ask for without a calculator.

## Common mistakes

- **Composing in the wrong order.** f(g(x)) means g first. Read from the inside out.
- **Multiplying instead of composing.** f(g(x)) is not f(x) · g(x).
- **Ignoring the inner function's domain.** For f(x) = x² and g(x) = √x, f(g(x)) = x but only for x ≥ 0.
- **Writing f⁻¹(x) = 1/f(x).** The −1 means "inverse function", not reciprocal. For f(x) = 2x, f⁻¹(x) = x/2 but 1/f(x) = 1/(2x).
- **Inverting a function that is not one-to-one.** Restrict the domain first and choose the matching root.
- **Forgetting to swap the domain and range.** f⁻¹'s domain is f's range.

## Where this goes next

Week 14 defines the logarithm as the inverse of an exponential function: because y = 2ˣ is one-to-one, it has an inverse, y = log₂ x, whose graph is the reflection of 2ˣ across y = x and whose input–output pairs are 2ˣ's pairs swapped. Composition identities such as log₂(2ˣ) = x and 2^(log₂ x) = x are this week's f⁻¹(f(x)) = x in a new notation.

## Self-check

1. Let f(x) = x² − 4 and g(x) = √(x + 1). Find f(g(x)) and g(f(x)) and their domains.
2. Decompose h(x) = 5/(2x + 7)² into two functions in two different ways.
3. Explain, with an example, why a function that is not one-to-one has no inverse.
4. Find the inverse of f(x) = (x + 5)/(2x − 1) and state its domain.
5. A hypothetical phone plan costs C(g) = 15 + 8g dollars for g gigabytes. Find C⁻¹ and interpret C⁻¹(55).

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 2, Topics 2.7–2.8). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
