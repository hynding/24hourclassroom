# Week 23 · Scaling Inputs, Combining Functions and Modeling Data

**Lessons:** 5.9 Scaling the Inputs · 5.10 Combining Functions · 5.11 Making a Model for Data
**Practices:** MP4 (model with mathematics), MP7 (look for structure), MP5 (use appropriate tools strategically)
**Built from:** IM Algebra 2, Unit 5, Lessons 9–11, in our own words
**Spiral:** Last week's vertical scaling k · f(x) has a horizontal twin, f(kx), with the same backwards sign logic as horizontal shifts (week 21). Adding functions revisits polynomial arithmetic (Unit 2). Modeling data pulls together every parent function of the course: linear, quadratic, exponential (Unit 4) and their transformations.

## What you need to be able to do

- **5.9** Describe and write horizontal scalings f(kx): compression toward the y-axis by a factor of 1/k when k > 1, stretch when 0 < k < 1, reflection when k < 0; track points and zeros; recognise when a horizontal scaling equals a vertical one.
- **5.10** Add, subtract and multiply functions given by formulas, tables or graphs, evaluate the result, and interpret combined functions in context (total, difference, profit).
- **5.11** Choose a parent function for a data set from its shape and pattern (constant differences, constant ratios, levelling off), transform it to fit, check the fit against the data, and use the model to predict while noting its limits.

## Key terms

| Term | Meaning |
|---|---|
| Horizontal scaling | y = f(kx): every input divided by k; (a, b) → (a/k, b). |
| Horizontal compression | k > 1: the graph squeezes toward the y-axis; f(2x) is half as wide. |
| Horizontal stretch | 0 < k < 1: the graph widens; f(x/3) is three times as wide. |
| Sum / difference / product of functions | (f + g)(x) = f(x) + g(x), (f − g)(x) = f(x) − g(x), (f · g)(x) = f(x) · g(x). |
| Residual | Data value minus model value; small residuals of mixed sign mean a good fit. |

## Scaling the inputs (5.9)

**y = f(kx)** replaces x by kx. To get the output f(6), the new function needs only x = 6/k. So the point (a, b) on f becomes (a/k, b):

| Transformation | (6, 4) becomes | Effect |
|---|---|---|
| f(2x) | (3, 4) | compressed toward the y-axis, half as wide |
| f(3x) | (2, 4) | one third as wide |
| f(x/3) | (18, 4) | stretched, three times as wide |
| f(−x) | (−6, 4) | reflected across the y-axis (week 21) |
| f(−2x) | (−3, 4) | reflected and compressed |

**Zeros move too.** If f(9) = 0, then f(3x) is zero at x = 3; if f(6) = 0, then f(x/2) is zero at x = 12. Compare with vertical scaling, which leaves zeros alone.

**Formulas.** For f(x) = x² − 9, g(x) = f(3x) = 9x² − 9, with zeros at ±1 (the zeros ±3 of f divided by 3). For √x: √(4x) = 2√x, so a horizontal compression by 1/4 equals a vertical stretch by 2. For x²: (2x)² = 4x², so f(2x) = 4f(x). These coincidences happen for powers and roots but not in general: for f(x) = x² + 1, f(2x) = 4x² + 1 is not 4f(x) = 4x² + 4.

**Worked example.** The graph of f has a maximum at (4, 7) and zeros at 1 and 10. Describe g(x) = f(2x).

Maximum at (2, 7); zeros at 0.5 and 5. Heights unchanged, widths halved.

**Try it.**
1. The point (8, 3) is on f. Where is it on f(4x)? On f(x/2)?
2. f(x) = x² − 9. Write f(3x) and find its zeros.

*Answers:* 1. (2, 3); (16, 3). 2. 9x² − 9 = 9(x² − 1); zeros ±1.

## Combining functions (5.10)

Functions with the same input can be added, subtracted and multiplied output by output.

Let f(x) = x² − 4 and g(x) = 2x + 1:

- (f + g)(x) = x² + 2x − 3, so (f + g)(3) = 5 + 7 = 12.
- (f − g)(x) = x² − 2x − 5, so (f − g)(2) = 0 − 5 = −5.
- (f · g)(x) = (x² − 4)(2x + 1) = 2x³ + x² − 8x − 4, so (f · g)(−1) = (−3)(−1) = 3.

**From tables.** If f(2) = 5 and g(2) = −3, then (f + g)(2) = 2 and (f − g)(2) = 8; no formula is needed.

**In context.** A company's revenue is R(x) = 50x dollars for x items and its cost is C(x) = 200 + 30x. Profit is P(x) = R(x) − C(x) = 20x − 200. Break-even is where P(x) = 0, at x = 10 items; P(25) = 300. Two towns with populations A(t) = 5000(1.02)ᵗ and B(t) = 8000(0.99)ᵗ have combined population A(t) + B(t), and the gap B(t) − A(t) shrinks over time.

**Graphs.** To graph f + g, add the heights at each x. Where g is zero, f + g equals f; where f and g have opposite signs the sum is smaller than either in size.

**Worked example.** h(t) = 70(0.9)ᵗ + 20 is the sum of a decaying exponential d(t) = 70(0.9)ᵗ and the constant function 20. Explain what each part contributes.

The constant sets the long-run level (the horizontal asymptote y = 20); the exponential part is the excess above that level, which shrinks by 10% each unit.

**Try it.**
1. f(x) = 3x − 1, g(x) = x². Find (f + g)(2), (f − g)(−1) and (f · g)(1).
2. Write a formula for the profit when revenue is 12x and cost is 150 + 7x, and find the break-even point.

*Answers:* 1. 5 + 4 = 9; −4 − 1 = −5; 2 · 1 = 2. 2. P(x) = 5x − 150; x = 30.

## Making a model for data (5.11)

**Choose the shape.** Look at the data's pattern:

| Pattern in equally spaced data | Parent function |
|---|---|
| constant first differences | linear |
| constant second differences | quadratic |
| constant ratios | exponential |
| constant ratios after subtracting a level | shifted exponential, a · bᵗ + c |
| rises then falls symmetrically | reflected quadratic, −a(t − h)² + k |

**Fit by transforming.** Cooling data: 90, 83, 76.7, 71.0, 65.9 at t = 0, …, 4 in a 20° room. Subtract 20: 70, 63, 56.7, 51.0, 45.9, ratios all 0.9. Model: T(t) = 70(0.9)ᵗ + 20. Predictions: T(5) ≈ 61.3, T(10) ≈ 44.4. When is T = 30? 70(0.9)ᵗ = 10, t = log₀.₉(1/7) ≈ 18.5 minutes.

A ball's height data peaks at 25 m at t = 2 s and was 5 m at t = 0: model h(t) = −5(t − 2)² + 25, a reflected, stretched and shifted parabola. Check h(0) = −20 + 25 = 5 ✓. It hits the ground when (t − 2)² = 5, t = 2 + √5 ≈ 4.24 s.

**Check the fit.** Compute residuals (data − model). If they are small and change sign irregularly, the model is good; if they drift in one direction, the parent function or the parameters are wrong.

**Know the limits.** A cooling model is fine until the coffee is drunk; a ball model stops at the ground; an exponential growth model stops when the resource runs out. Say where the model applies.

**Worked example.** Data: 3, 7, 15, 27, 43 at x = 0, 1, 2, 3, 4. Choose a model.

First differences 4, 8, 12, 16; second differences all 4: quadratic. Try y = 2x² + 2x + 3: at x = 2, 8 + 4 + 3 = 15 ✓; at x = 4, 32 + 8 + 3 = 43 ✓.

**Try it.**
1. Data: 100, 110, 121, 133.1 at t = 0, 1, 2, 3. Choose and write a model.
2. Data levelling off at 50 from below: 10, 30, 40, 45, 47.5. Write a model.

*Answers:* 1. Ratios 1.1: y = 100(1.1)ᵗ. 2. 50 − (amount below): 40, 20, 10, 5, 2.5 halves, so y = 50 − 40(0.5)ᵗ.

## Common mistakes

- **Reading f(2x) as "twice as wide".** It is half as wide: inputs are divided by 2.
- **Moving the heights under a horizontal scaling.** f(kx) keeps every y-value; only x-coordinates change.
- **Subtracting functions in the wrong order.** Profit is revenue minus cost; (f − g)(x) = f(x) − g(x).
- **Fitting a plain exponential to data that levels off at a nonzero value.** Subtract the level first.
- **Trusting a model outside its range.** Check that predictions make physical sense.

## Where this goes next

The Unit 5 exam covers weeks 21–23. Unit 6 introduces trigonometric functions, whose graphs are transformed in exactly this way: amplitude is a vertical scaling, period is a horizontal scaling, and midline is a vertical shift.

## Self-check

1. The point (−6, 5) is on f. Find its image on f(3x), f(x/2) and f(−2x).
2. f(x) = 4 − x², g(x) = x + 2. Find (f + g)(1), (f − g)(−2) and (f · g)(0).
3. A company's revenue is 80x and its cost is 500 + 55x. Write the profit function and find the break-even quantity.
4. Data: 12, 18, 27, 40.5 at t = 0, 1, 2, 3. Choose a model and predict t = 5.
5. Data rising to a ceiling of 100: 20, 60, 80, 90, 95. Write a model.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 5, Lessons 9–11, https://im.kendallhunt.com/HS/teachers/3/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
