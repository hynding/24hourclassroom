# Week 24 · Accumulation in Context, Integral Properties and the Fundamental Theorem

**Topics:** 6.5 Interpreting the Behavior of Accumulation Functions Involving Area · 6.6 Applying Properties of Definite Integrals · 6.7 The Fundamental Theorem of Calculus and Definite Integrals
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 6, Topics 6.5–6.7, learning objectives in our own words
**Spiral:** Week 23 defined accumulation functions and showed that d/dx ∫ from a to x of f(t) dt = f(x). This week puts those functions into context (amounts in tanks, people in parks), using the extrema and concavity tests of weeks 17–19 and the Intermediate Value Theorem of week 5. The second part of the Fundamental Theorem finally lets you compute integrals exactly, using the derivative rules of Unit 2 run backwards.

## What you need to be able to do

- **6.5** Model an amount as initial value plus accumulated net change, A(t) = A(0) + ∫ from 0 to t of R(s) ds, and interpret its value and its derivative in context.
- **6.5** Determine where an accumulation function increases, decreases, has extrema and changes concavity from a graph or formula of its integrand, with justification.
- **6.6** Use the properties of definite integrals: zero-width intervals, reversed limits, adjacent intervals, sums, differences and constant multiples.
- **6.6** Integrate a piecewise-defined function by splitting at its break points.
- **6.7** Evaluate ∫ from a to b of f(x) dx as F(b) − F(a) for an antiderivative F, and use the net change form f(b) = f(a) + ∫ from a to b of f′(x) dx.

## Key terms

| Term | Meaning |
|---|---|
| Net rate | Rate in minus rate out; positive when the amount grows. |
| Initial value | The amount at the starting time, added to the accumulated change. |
| Additivity | ∫ from a to b of f + ∫ from b to c of f = ∫ from a to c of f. |
| Linearity | Integrals split over sums and differences and let constants factor out. |
| Antiderivative | A function F with F′ = f. |
| Fundamental Theorem of Calculus (second part) | If f is continuous on [a, b] and F′ = f, then ∫ from a to b of f(x) dx = F(b) − F(a). |
| Net change theorem | The integral of a rate of change over [a, b] is the net change of the quantity over [a, b]. |

## Accumulation functions in context (6.5)

Week 22 said the area under a rate is the accumulated change; week 23 turned that into a function. Put them together in a context and you have the standard AP setup:

**amount at time t = amount at the start + ∫ from 0 to t of (net rate) ds.**

Differentiating gives the amount's rate of change: the constant drops out and the first Fundamental Theorem returns the integrand. So the amount increases where the net rate is positive, decreases where it is negative, and is concave up where the net rate is increasing.

**Worked example (a tank).** A hypothetical tank holds 50 liters at t = 0. For 0 ≤ t ≤ 8 minutes the net rate of flow R(t), in liters per minute, has a graph of segments joining (0, 6), (2, 6), (5, −3) and (8, 0). Let W(t) be the amount at time t.

Model: W(t) = 50 + ∫ from 0 to t of R(s) ds. The middle segment has slope −3 and crosses zero at t = 4. Signed areas:

| Piece | Shape | Signed area |
|---|---|---|
| 0 ≤ t ≤ 2 | rectangle 2 by 6 | +12 |
| 2 ≤ t ≤ 4 | triangle, base 2, height 6 | +6 |
| 4 ≤ t ≤ 5 | triangle, base 1, height 3, below | −1.5 |
| 5 ≤ t ≤ 8 | triangle, base 3, height 3, below | −4.5 |

So W(2) = 62, W(4) = 68, W(5) = 66.5 and W(8) = 62.

- **When is the water greatest?** W′(t) = R(t) changes from positive to negative only at t = 4. Candidates: W(0) = 50, W(4) = 68, W(8) = 62. Greatest at t = 4, with 68 liters.
- **What does W′(3) mean?** W′(3) = R(3) = 3 liters per minute: at t = 3 the water is increasing at 3 liters per minute.
- **Concavity at t = 6.** W″(t) = R′(t) = 1 > 0 there, so W is concave up: the tank is still losing water (R(6) = −2), but more and more slowly.
- **Does the tank ever hold 60 liters on (0, 4)?** W is continuous (it is differentiable), W(0) = 50 < 60 < 68 = W(4), so yes, by the Intermediate Value Theorem.

**Interpretation sentences.** Keep three things straight:

- W(6) is an **amount** (liters in the tank at t = 6).
- ∫ from 0 to 6 of R(s) ds is a **change** (net liters added during the first 6 minutes).
- W′(6) = R(6) is a **rate** (liters per minute at t = 6).

If a question says the tank started with 40 gallons and W(6) = 85, then 45 gallons (not 85) came in during those hours.

## Properties of definite integrals (6.6)

Each property is what you would expect from signed area or from Riemann sums.

| Property | Statement |
|---|---|
| Zero width | ∫ from a to a of f(x) dx = 0 |
| Reversed limits | ∫ from b to a of f(x) dx = −∫ from a to b of f(x) dx |
| Adjacent intervals | ∫ from a to b of f + ∫ from b to c of f = ∫ from a to c of f |
| Sum and difference | ∫ from a to b of (f ± g) = ∫ from a to b of f ± ∫ from a to b of g |
| Constant multiple | ∫ from a to b of k·f(x) dx = k ∫ from a to b of f(x) dx |
| Constant integrand | ∫ from a to b of k dx = k(b − a) |

There is **no product or quotient property**. With f(x) = g(x) = x on [0, 1], ∫ of the product is 1/3, while the product of the integrals is 1/4.

**Worked example (combining given values).** Suppose ∫ from 0 to 3 of f(x) dx = 5, ∫ from 0 to 7 of f(x) dx = 2 and ∫ from 3 to 7 of g(x) dx = −4.

- ∫ from 3 to 7 of f(x) dx = 2 − 5 = −3 (adjacent intervals).
- ∫ from 7 to 3 of (2f(x) − g(x)) dx = −(2(−3) − (−4)) = −(−2) = 2 (reverse, then linearity).
- ∫ from 3 to 7 of (f(x) + 3) dx = −3 + 3 · 4 = 9 (sum, then constant integrand).

**Piecewise integrands.** Split at the break point and use the right formula on each piece. This is the adjacent-intervals property in action, and it is also how you integrate |x − c|.

## The second Fundamental Theorem (6.7)

Let F be any antiderivative of a continuous f. The accumulation function A(x) = ∫ from a to x of f(t) dt is also an antiderivative (week 23), and two antiderivatives differ by a constant: A(x) = F(x) + C. Since A(a) = 0, C = −F(a). Then

**∫ from a to b of f(x) dx = A(b) = F(b) − F(a).**

So the exact value of any definite integral is one antiderivative evaluated at the top minus at the bottom. The constant of integration is not needed because it cancels. The notation F(x) |ₐᵇ, or [F(x)] from a to b, means F(b) − F(a).

Every basic derivative rule gives an antiderivative rule (week 25 lists them all):

| Integrand | Antiderivative |
|---|---|
| xⁿ (n ≠ −1) | xⁿ⁺¹/(n + 1) |
| 1/x | ln |x| |
| eˣ | eˣ |
| cos x | sin x |
| sin x | −cos x |
| sec²x | tan x |

**Worked example.** Evaluate ∫ from 1 to 4 of (3√x + 1) dx.

Write 3√x = 3x^(1/2), whose antiderivative is 3 · x^(3/2)/(3/2) = 2x^(3/2). So F(x) = 2x^(3/2) + x and the integral is F(4) − F(1) = (2 · 8 + 4) − (2 + 1) = 20 − 3 = 17.

**Worked example (piecewise).** Let f(x) = x² for x ≤ 1 and f(x) = 2x − 1 for x > 1. Evaluate ∫ from −1 to 3 of f(x) dx.

∫ from −1 to 1 of x² dx = 1/3 − (−1/3) = 2/3. ∫ from 1 to 3 of (2x − 1) dx = (x² − x) from 1 to 3 = 6 − 0 = 6. Total 2/3 + 6 = 20/3.

**Net change.** Apply the theorem to a derivative: since f is an antiderivative of f′,

f(b) = f(a) + ∫ from a to b of f′(x) dx.

**Worked example.** f(1) = 4 and ∫ from 1 to 5 of f′(x) dx = −7. Then f(5) = 4 + (−7) = −3. On free-response questions this is the move behind "find the position at t = 6" (week 30) and "find the amount at t = 8" (above).

**Which part of the theorem?** If the question asks for a derivative of an integral with a variable limit, use the first part. If it asks for the value of an integral with numerical limits and you can find an antiderivative, use the second part. If no elementary antiderivative exists, as for e^(t²), only the first part (or a calculator) helps.

## Common mistakes

- **Subtracting integrand values.** ∫ from a to b of f is F(b) − F(a), not f(b) − f(a).
- **Reversing the order.** Top minus bottom: F(b) − F(a).
- **Forgetting F(a) because it is often 0.** Always evaluate it; with lower limit 1 or with eˣ or cos x it rarely vanishes (e⁰ = 1, cos 0 = 1).
- **Losing the constant term's antiderivative.** ∫ 1 dx = x, not 0 or 1.
- **Confusing amount, change and rate** in context sentences. Check units: liters, liters, liters per minute.
- **Splitting a product.** Only sums, differences and constant multiples split.
- **Calling every zero of the net rate a maximum.** Check the sign change, and compare with the endpoints for an absolute maximum.

## Self-check

1. Evaluate ∫ from 1 to 8 of ∛x dx.
2. Evaluate ∫ from 0 to π of sin x dx.
3. If ∫ from 2 to 6 of h(x) dx = 10 and ∫ from 4 to 6 of h(x) dx = 3, find ∫ from 4 to 2 of h(x) dx.
4. A pool holds 1200 liters at t = 0 and water drains at r(t) = 2t liters per minute. Write an expression for the amount at time t and find it at t = 20.
5. Let g(x) = ∫ from 0 to x of (4 − t²) dt for −3 ≤ x ≤ 3. Where does g have its absolute maximum on [−3, 3]?
6. A particle's velocity is v(t) and its position at t = 2 is 7. Write an expression for its position at t = 9.

*Answers:* 1. (3/4)x^(4/3) from 1 to 8 = (3/4)(16 − 1) = 45/4. 2. −cos π + cos 0 = 2. 3. ∫ from 2 to 4 of h = 10 − 3 = 7, so ∫ from 4 to 2 of h = −7. 4. A(t) = 1200 − ∫ from 0 to t of 2s ds = 1200 − t²; A(20) = 800 liters. 5. g′ = 4 − x² changes from positive to negative at x = 2; g(2) = 8 − 8/3 = 16/3, g(−3) = (4t − t³/3) at t = −3 = −12 + 9 = −3, g(3) = 12 − 9 = 3; absolute maximum 16/3 at x = 2. 6. x(9) = 7 + ∫ from 2 to 9 of v(t) dt.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 6, Topics 6.5–6.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
