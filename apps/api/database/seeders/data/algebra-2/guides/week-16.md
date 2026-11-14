# Week 16 · Exponential Growth, Decay and Rational Inputs

**Lessons:** 4.1 Growing and Shrinking · 4.2 Representations of Growth and Decay · 4.3 Understanding Rational Inputs · 4.4 Representing Functions at Rational Inputs
**Practices:** MP4 (model with mathematics), MP2 (reason abstractly and quantitatively), MP7 (look for structure)
**Built from:** IM Algebra 2, Unit 4, Lessons 1–4, in our own words
**Spiral:** Geometric sequences (Unit 1) are exponential functions sampled at whole numbers. Rational exponents (week 11) are exactly what let us evaluate an exponential function halfway between two whole-number inputs: 2^(1/2) = √2. Exponent rules (3.1) justify every "equivalent growth factor" calculation.

## What you need to be able to do

- **4.1** Recognise exponential growth and decay in situations, tables and graphs; write f(x) = a · bˣ with a the starting value and b the growth factor; convert a percent change to a growth factor (up 5% → 1.05, down 20% → 0.8) and back.
- **4.2** Move between a description, a table, a graph and an equation of an exponential function; find a and b from any two of them.
- **4.3** Explain what f(1/2), f(3/2) or f(1/12) means for an exponential function (growth over a fraction of a time unit) and evaluate using rational exponents.
- **4.4** Rewrite an exponential function so it uses a different time unit (annual to monthly, hours to minutes), using b^(1/n) as the per-smaller-unit factor, and evaluate at rational inputs in context.

## Key terms

| Term | Meaning |
|---|---|
| Exponential function | f(x) = a · bˣ with a ≠ 0 and b > 0, b ≠ 1. |
| Initial value a | f(0); the y-intercept of the graph. |
| Growth factor b | The ratio f(x + 1)/f(x), the same for every x. b > 1 is growth, 0 < b < 1 is decay. |
| Growth rate / percent change | b − 1 as a percent. b = 1.05 is 5% growth; b = 0.8 is 20% decay. |
| Horizontal asymptote | The line y = 0, which the graph approaches but never reaches. |
| Rational input | A non-integer x such as 1/2 or 2.5; bˣ is evaluated with a rational exponent, b^(1/2) = √b. |

## Growing and shrinking (4.1)

A quantity grows **exponentially** when it is multiplied by the same factor over every equal time step, and **linearly** when the same amount is added. Starting at 1000:

| Step | Linear: + 50 | Exponential: × 1.05 |
|---|---|---|
| 0 | 1000 | 1000 |
| 1 | 1050 | 1050 |
| 2 | 1100 | 1102.5 |
| 3 | 1150 | 1157.63 |

The exponential column pulls ahead because each 5% is taken of a bigger number. Over long stretches exponential growth beats any linear growth; exponential decay shrinks toward zero without reaching it.

**Percent to factor.** "Up 5% each year" means new = old + 0.05 · old = 1.05 · old, so b = 1.05. "Down 20% each day" means new = 0.8 · old, so b = 0.8. Going back: b = 0.88 means 12% decay; b = 1.5 means 50% growth; b = 2 means doubling (100% growth). A 35% decrease is b = 0.65.

**Worked example.** A dose of 80 mg of a medicine decreases by 20% every hour. How much remains after 3 hours?

Each hour multiplies by 0.8: 80 · 0.8³ = 80 · 0.512 = 40.96 mg.

**Try it.**
1. Write the growth factor for: up 3% per year; down 45% per week; tripling every day.
2. f(x) = 200(0.9)ˣ. Find f(0), f(1) and f(2), and describe the change.

*Answers:* 1. 1.03; 0.55; 3. 2. 200, 180, 162: down 10% each step (not down 20 each step).

## Four representations (4.2)

**From a table.** Divide consecutive outputs. If the ratio is constant, the function is exponential with that ratio as b, and a is the output at 0.

| x | 0 | 1 | 2 | 3 |
|---|---|---|---|---|
| f(x) | 3 | 12 | 48 | 192 |

Ratios 12/3 = 48/12 = 192/48 = 4, so f(x) = 3 · 4ˣ.

| x | 0 | 1 | 2 |
|---|---|---|---|
| g(x) | 400 | 300 | 225 |

Ratios 300/400 = 225/300 = 0.75, so g(x) = 400(0.75)ˣ, a 25% decrease per step. Then g(4) = 400(0.75)⁴ = 126.5625.

**From a graph.** Read the y-intercept for a; then use any other clear point. If the graph passes through (0, 5) and (2, 45), then 5b² = 45, b² = 9, b = 3: f(x) = 5 · 3ˣ. If the graph passes through (1, 6) and (3, 24) with no clear intercept, then b² = 24/6 = 4, b = 2, and a = 6/2 = 3.

**From a description.** "A $5000 deposit earns 3% per year": A(t) = 5000(1.03)ᵗ. After 7 years, 5000(1.03)⁷ ≈ 6149.37.

**Graph features.** An exponential graph has y-intercept a, no x-intercept, and the x-axis as a horizontal asymptote: for decay it flattens toward 0 on the right; for growth it flattens toward 0 on the left. It never crosses the x-axis because a · bˣ is never zero.

**Worked example.** Decide whether each table is linear, exponential or neither: (i) 5, 10, 20, 40; (ii) 5, 10, 15, 20; (iii) 5, 10, 17, 26.

(i) ratios all 2: exponential, 5 · 2ˣ. (ii) differences all 5: linear. (iii) differences 5, 7, 9 and ratios 2, 1.7, 1.53: neither (it is quadratic).

**Try it.**
1. A graph passes through (0, 80) and (1, 60). Write the equation and find f(3).
2. A table gives h(0) = 2, h(2) = 50. If h is exponential, find b.

*Answers:* 1. b = 0.75; h(x) = 80(0.75)ˣ; f(3) = 33.75. 2. 2b² = 50, b = 5.

## Rational inputs (4.3)

If P(t) = 500 · 2ᵗ gives a bacteria population after t hours, what is P(1/2)? It is the population after half an hour: 500 · 2^(1/2) = 500√2 ≈ 707. The factor over half an hour is √2 ≈ 1.414, because two half-hours must multiply to one full doubling: √2 · √2 = 2.

The same logic gives any fraction of a time unit:

- Over a third of an hour the factor is 2^(1/3) ≈ 1.26, since three of them make 2.
- Over 1.5 hours the factor is 2^(3/2) = 2√2 ≈ 2.83.
- Over 2.5 hours the factor is 2^(5/2) ≈ 5.66.

| x | −1 | 0 | 1/2 | 1 | 3/2 | 2 |
|---|---|---|---|---|---|---|
| 100 · 2ˣ | 50 | 100 | 141.4 | 200 | 282.8 | 400 |

With a base of 9 the values are exact: 9^(1/2) = 3, 9^(3/2) = 27, 9^(−1/2) = 1/3.

**Worked example.** f(x) = 16 · (1/2)ˣ. Find f(1/2), f(3/2) and f(−2).

f(1/2) = 16/√2 ≈ 11.31; f(3/2) = 16/2^(3/2) = 16/2.828 ≈ 5.66; f(−2) = 16 · 4 = 64.

**Try it.**
1. A quantity doubles every year. By what factor does it grow in 6 months? In 1 month?
2. Evaluate 400(0.75)^(1/2).

*Answers:* 1. 2^(1/2) ≈ 1.414; 2^(1/12) ≈ 1.0595, about 5.95% per month. 2. 400 · 0.866 ≈ 346.4.

## Changing the time unit (4.4)

Suppose an account grows 6% per year: A(t) = A₀(1.06)ᵗ with t in years. What is the monthly growth factor m? Twelve months must multiply to a year, so m¹² = 1.06 and m = 1.06^(1/12) ≈ 1.00487: about 0.487% per month. Notice this is **not** 6%/12 = 0.5%; dividing the rate ignores compounding. (Equivalently, A(t) = A₀(1.06^(1/12))¹²ᵗ when t is in years, or A₀(1.00487)ⁿ when n counts months.)

More examples:

| Given | Smaller unit | Factor |
|---|---|---|
| 8% per year | month | 1.08^(1/12) ≈ 1.00643 |
| 8% per year | quarter | 1.08^(1/4) ≈ 1.0194 |
| half-life 10 days | day | (1/2)^(1/10) ≈ 0.933, about 6.7% loss per day |
| triples every 4 hours | hour | 3^(1/4) ≈ 1.316 |
| doubles every year | month | 2^(1/12) ≈ 1.0595 |

Going the other way, if a quantity grows by factor 1.02 per month, it grows by 1.02¹² ≈ 1.268 per year, about 26.8%, not 24%.

**Worked example.** A car bought for $24,000 loses 15% of its value each year. What is it worth after 2.5 years?

V(t) = 24000(0.85)ᵗ, so V(2.5) = 24000 · 0.85^2.5 ≈ 24000 · 0.6661 ≈ $15,987.

**Worked example.** Bacteria triple every 4 hours, starting from 100. Write a function of t in hours and find the population after 6 hours.

Per hour the factor is 3^(1/4), so P(t) = 100 · 3^(t/4). P(6) = 100 · 3^(1.5) ≈ 100 · 5.196 ≈ 520.

**Try it.**
1. A population grows 4.5% per year. Find the quarterly growth factor.
2. A substance loses 30% every 5 hours. Find the hourly decay factor.
3. An investment grows 1.5% per month. What is the annual percent growth?

*Answers:* 1. 1.045^(1/4) ≈ 1.0111. 2. 0.7^(1/5) ≈ 0.931. 3. 1.015¹² ≈ 1.196, about 19.6%.

## Common mistakes

- **Adding instead of multiplying.** "Down 10% each year" from 200 gives 180 then 162, not 180 then 160.
- **Using 0.2 for a 20% decrease.** The factor is 0.8; 0.2 is what is lost, not what remains.
- **Dividing a rate to change units.** 6% per year is not 0.5% per month; the monthly factor is 1.06^(1/12).
- **Reading b^(1/2) as half of b.** 2^(1/2) ≈ 1.41, not 1.
- **Thinking exponential decay reaches zero.** a · bˣ is never 0; the graph only approaches the x-axis.

## Where this goes next

Next week studies how exponential functions change over rational intervals, writes equations from two data points, and meets the problem of an unknown exponent (solve 2ˣ = 10), which Unit 4 answers with logarithms in week 18.

## Self-check

1. Convert: 7% growth → factor; factor 0.94 → percent change; "halves every step" → factor.
2. A table reads 6, 9, 13.5 at x = 0, 1, 2. Is it exponential? If so, write the equation and find f(4).
3. Explain what f(1/3) means for P(t) = 500 · 2ᵗ and compute it.
4. A quantity grows 10% per year. Find the monthly factor and explain why it is not 1.00833.
5. V(t) = 24000(0.85)ᵗ. Find V(1.5) and V(4).

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 4, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/3/4/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
