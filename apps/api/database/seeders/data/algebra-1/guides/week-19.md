# Week 19 · Exponential Growth and Decay

**Lessons:** 5.1 Growing and Growing · 5.2 Patterns of Growth · 5.3 Representing Exponential Growth · 5.4 Understanding Decay
**Practices:** MP7 (see repeated multiplication inside a table), MP8 (express a pattern as a · bⁿ), MP2 (interpret the starting value and the factor)
**Built from:** IM Algebra 1, Unit 5, Lessons 1–4, in our own words
**Spiral:** Linear functions from units 2 and 4 add the same amount each step. This week's functions multiply by the same amount each step. Average rate of change (week 16) is the tool that shows the difference: constant for a line, growing for exponential growth.

## What you need to be able to do

- **5.1** Compare a quantity that grows by adding with one that grows by doubling, and explain why repeated multiplication eventually overtakes any repeated addition.
- **5.2** Recognise exponential growth in a table (each output is the previous one times a fixed factor) and describe it with a growth factor.
- **5.3** Write an expression or equation a · bˣ for exponential growth, identify a and b from a table or description, and graph it.
- **5.4** Describe exponential decay with a factor between 0 and 1, write and use its equation, and relate "loses a fraction" to the factor.

## Key terms

| Term | Meaning |
|---|---|
| Linear growth | The same amount is added each step: y = a + mx. |
| Exponential growth | The same factor multiplies each step: y = a · bˣ with b > 1. |
| Growth factor | The number b each output is multiplied by per step. |
| Initial (starting) value | The output when x = 0; the a in a · bˣ, since b⁰ = 1. |
| Exponential decay | Repeated multiplication by a factor between 0 and 1. |
| Decay factor | The factor b with 0 < b < 1; "loses one third each step" means b = 2/3. |

## Adding versus multiplying (5.1)

Two offers: $100 a day for 30 days, or 1 cent on day 1, doubled every day for 30 days. The first gives 100 × 30 = $3,000. The second gives on day n an amount of 0.01 · 2ⁿ⁻¹ dollars: day 10 is $5.12, day 20 is $5,242.88, day 30 is $5,368,709.12. Doubling starts tiny and ends enormous.

The reason: a linear pattern adds the same amount no matter how large the quantity is, while a doubling pattern adds an amount proportional to the current size. Eventually the doubling quantity is so large that one more doubling adds more than the linear pattern adds in all its steps put together.

**Worked example.** Savings plan A: $500 now, plus $50 a month. Plan B: $500 now, growing by 5% a month. After 1 month: A 550, B 525. After 12 months: A 1,100, B ≈ 898. After 36 months: A 2,300, B ≈ 2,896. B is behind at first and ahead later.

**Try it.** A pond has 10 lily pads and the number doubles each week. How many after 5 weeks? After how many weeks will it exceed 1,000?
*Answers:* 10 · 2⁵ = 320; 10 · 2⁷ = 1,280, so 7 weeks.

## Patterns of growth (5.2)

In a table, check how outputs change:

| x | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| Linear | 3 | 7 | 11 | 15 | 19 |
| Exponential | 3 | 6 | 12 | 24 | 48 |

Linear: differences 4, 4, 4, 4. Exponential: ratios 6/3 = 2, 12/6 = 2, 24/12 = 2, 48/24 = 2. A constant difference means linear; a constant ratio means exponential; that ratio is the growth factor.

Growth factors need not be whole numbers. A population that grows by 10% a year has factor 1.1: 1,000 → 1,100 → 1,210 → 1,331. "Triples" means factor 3; "grows by a quarter" means factor 1.25.

**Worked example.** Outputs 5, 15, 45, 135 at x = 0, 1, 2, 3. Ratio 3 every step: exponential, growth factor 3, starting value 5. Next value 405.

**Worked example.** Outputs 8, 12, 18, 27. Ratios 1.5, 1.5, 1.5: exponential with factor 3/2. Differences 4, 6, 9 are not constant, so it is not linear.

**Try it.** Is 2, 6, 10, 14 linear or exponential? Is 2, 6, 18, 54?
*Answers:* Linear (adds 4). Exponential (multiplies by 3).

## Representing exponential growth (5.3)

If the starting value is a and the growth factor is b, the value after x steps is

**f(x) = a · bˣ.**

From the table above: f(x) = 3 · 2ˣ. Check: f(3) = 3 · 8 = 24. For the 10%-a-year population, P(t) = 1,000 · 1.1ᵗ.

Reading a and b from an equation: g(x) = 50 · 1.08ˣ starts at 50 and grows 8% per step. h(x) = 2 · 5ˣ starts at 2 and multiplies by 5.

Reading from a table that does not include x = 0: if f(1) = 12 and f(2) = 36, the factor is 3, and f(0) = 12/3 = 4, so f(x) = 4 · 3ˣ.

**The graph** of a · bˣ with b > 1 starts at (0, a), rises slowly at first and then steeply, and never touches the x-axis on the left (outputs get close to 0 but stay positive). A larger b gives a steeper curve; a larger a lifts the whole curve.

**Order of operations.** 3 · 2ˣ means 3 times (2 to the x), not (3 · 2) to the x. 3 · 2³ = 24, while (3 · 2)³ = 216.

**Worked example.** A culture has 400 bacteria and doubles every hour. Write the equation and find the count after 6 hours.
B(h) = 400 · 2ʰ; B(6) = 400 · 64 = 25,600.

**Try it.** A table gives f(0) = 7, f(1) = 28, f(2) = 112. Write the equation and find f(4).
*Answers:* f(x) = 7 · 4ˣ; f(4) = 7 · 256 = 1,792.

## Understanding decay (5.4)

If a quantity loses the same fraction each step, it decays exponentially with a factor between 0 and 1. "Loses half" → factor 1/2. "Loses 20%" → factor 0.8, because 80% remains. "Loses a third" → factor 2/3.

A medicine dose of 200 mg is reduced by one quarter each hour: M(h) = 200 · (3/4)ʰ. M(1) = 150, M(2) = 112.5, M(3) = 84.375. The amounts fall quickly at first and then by less and less, because each step removes a quarter of a smaller amount. The quantity never reaches 0.

| h | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| M(h) | 200 | 150 | 112.5 | 84.4 | 63.3 |

**The graph** of a · bˣ with 0 < b < 1 starts at (0, a), falls steeply, then flattens toward the x-axis without reaching it.

**Worked example.** A car worth $24,000 loses 15% of its value each year. Equation and value after 3 years?
V(t) = 24,000 · 0.85ᵗ; V(3) = 24,000 · 0.614125 ≈ $14,739.

**Worked example.** A table shows 640, 160, 40, 10 at x = 0, 1, 2, 3. Ratio 1/4 each step: f(x) = 640 · (1/4)ˣ.

**Try it.** A ball bounces to 60% of its previous height each time. Dropped from 250 cm, how high is the third bounce?
*Answer:* 250 · 0.6³ = 54 cm.

## Common mistakes

- Treating "grows by 5%" as factor 5 or 0.05 instead of 1.05.
- Treating "loses 20%" as factor 0.2 instead of 0.8.
- Computing (a · b)ˣ instead of a · bˣ.
- Testing for exponential growth with differences; use ratios.
- Saying an exponential decay reaches 0; it only approaches it.
- Reading the starting value from the first row of a table that begins at x = 1.

## Where this goes next

Week 20 represents decay and growth on graphs in detail, introduces negative exponents (what happened before x = 0), and writes exponential situations as functions with domain and range. Weeks 21 to 23 interpret exponential functions, compare their rates with linear ones, and handle percent change and compound interest.

## Self-check

1. Is the table 4, 12, 36, 108 linear or exponential? Give the factor or the difference.
2. Write the equation for a quantity starting at 25 that triples each step. Find its value at x = 4.
3. A population grows 6% a year from 8,000. Write P(t) and find P(2).
4. "Loses 35% each step" → factor?
5. A 500 g sample halves every day. How much is left after 4 days?

*Answers:* (1) Exponential, factor 3. (2) f(x) = 25 · 3ˣ; f(4) = 2,025. (3) P(t) = 8,000 · 1.06ᵗ; P(2) = 8,988.8, about 8,989. (4) 0.65. (5) 500 · (1/2)⁴ = 31.25 g.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 5, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/1/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
