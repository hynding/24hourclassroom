# Unit 5 · Introduction to Exponential Functions · The night-before sheet

**Final-exam weight:** about 15–18% · **Lessons:** 5.1 Growing and Growing · 5.2 Patterns of Growth · 5.3 Representing Exponential Growth · 5.4 Understanding Decay · 5.5 Representing Exponential Decay · 5.6 Analyzing Graphs · 5.7 Using Negative Exponents · 5.8 Exponential Situations as Functions · 5.9 Interpreting Exponential Functions · 5.10 Looking at Rates of Change · 5.11 Modeling Exponential Behavior · 5.12–5.13 Reasoning about Exponential Graphs · 5.14 Recalling Percent Change · 5.15 Functions Involving Percent Change · 5.16 Compounding Interest · 5.17 Different Compounding Intervals · 5.18 Expressed in Different Ways · 5.19 Which One Changes Faster? · 5.20 Changes over Equal Intervals · 5.21 Predicting Populations
**Practices:** MP2, MP3, MP4, MP6, MP7, MP8 · **Built from:** IM Algebra 1, Unit 5, in our own words

## The ideas that generate every question

1. **Linear adds; exponential multiplies.** Constant differences in a table mean linear; constant ratios mean exponential, and the ratio is the factor.
2. **f(x) = a · bˣ.** a is the value at x = 0; b is the factor per unit of x. b > 1 grows, 0 < b < 1 decays. Compute the power first: 3 · 2³ = 24.
3. **Percent to factor.** Up r%: factor 1 + r/100. Down r%: factor 1 − r/100. "Loses 20%" is 0.8; "grows 3%" is 1.03. Undo a change by dividing by its factor.
4. **Graphs.** Through (0, a); never touch the x-axis (y = 0 is an asymptote); b sets steepness or speed of decay; a stretches vertically. Two points give a and b (take a root if the points are more than one step apart).
5. **Negative exponents reach into the past.** b⁻ⁿ = 1/bⁿ, b⁰ = 1. 400 · 2⁻² = 100 is the value two steps before the start.
6. **Rates of change.** Over equal intervals, an exponential function's average rate of change is multiplied by the same factor each time; a line's is constant. Every interval of width w multiplies the function by bʷ.
7. **Compound interest.** P(1 + r)ⁿ per period; annual rate R compounded k times a year gives P(1 + R/k)^(kt). Simple interest is linear. The same function can be rewritten per month or per year: 1.005^(12t) = (1.005¹²)ᵗ ≈ 1.0617ᵗ.
8. **Exponential growth eventually beats any linear growth,** and the larger factor eventually beats the larger start. Predictions far beyond the data assume the factor never changes: say so.

## Key formulas and procedures

| Task | Procedure |
|---|---|
| Classify a table | differences constant: linear; ratios constant: exponential |
| Write a · bˣ from a table | b = ratio of consecutive outputs; a = output at 0 (divide back if the table starts at 1) |
| Factor from two values w steps apart | b = (ratio)^(1/w) |
| Percent change | multiply by (1 ± r); reverse by dividing |
| Evaluate for negative x | a · b⁻ⁿ = a/bⁿ |
| Average rate of change | (f(b) − f(a))/(b − a) |
| Factor over width w | bʷ; over half a step, √b |
| Compound interest | P(1 + r)ⁿ; with k periods a year, P(1 + R/k)^(kt) |
| Effective annual rate | (1 + R/k)ᵏ − 1 |
| Rewrite with a different step | bᵗ = (b^(1/k))^(kt); b^(kt) = (bᵏ)ᵗ |
| Compare growth | rates over the interval asked; in the long run the exponential (or larger factor) wins |
| Population model | check ratios between equally spaced counts; a · bᵈ; convert per-decade to per-year by a tenth root |

## Worked examples

**Table.** 5, 15, 45, 135: ratios 3, so 5 · 3ˣ; next 405. 640, 160, 40, 10: 640 · (1/4)ˣ.

**Two values.** 500 at 0 and 320 at 2: b² = 0.64, b = 0.8. (1, 10) and (3, 250): b = 5, a = 2.

**Decay.** Car $24,000 losing 15% a year: 24,000 · 0.85ᵗ; after 3 years ≈ $14,739. Medicine 400 mg losing a quarter each hour: 400 · 0.75ʰ; after 3 hours ≈ 168.8 mg; never 0.

**Negative exponents.** 8 · 2⁻³ = 1; 10 · (1/4)⁻¹ = 40; 3,000 · 1.05⁻³ ≈ 2,592.

**Interpret.** P(t) = 4,000 · 1.03ᵗ, t years since 2015: 4,000 people in 2015, 3% growth a year; P(4) ≈ 4,502 in 2019. Rates: 0–10 about 138 a year; 10–20 about 185 a year.

**Model data.** 120, 178, 262, 395, 590 hourly: ratios ≈ 1.5; N(h) = 120 · 1.5ʰ; N(4) = 607.5 against 590.

**Percent and interest.** $63 after 30% off was $90. $1,000 at 5% compounded annually: 1,628.89 after 10 years (simple: 1,500). $2,000 at 6% compounded monthly: 2,000 · 1.005^(12t) ≈ 2,000 · 1.0617ᵗ; after 1 year $2,123.36. $3,000 at 4% quarterly for 5 years: 3,000 · 1.01²⁰ ≈ $3,660.57.

**Compare.** L = 1,000 + 200t, E = 1,000 · 1.1ᵗ: L ahead until t ≈ 14.5, E ahead for ever after. 500 · 1.2ᵗ versus 100 · 1.5ᵗ: the second wins after t ≈ 7.2.

**Population.** 240, 288, 346, 415 thousand each decade from 1990: P(d) = 240 · 1.2ᵈ; 2030 ≈ 498; per year ≈ 1.84%; the 2060 figure (≈ 860) needs a caution.

## Common errors

- Factor 5 or 0.05 for "grows 5%"; factor 0.2 for "loses 20%".
- (a · b)ˣ instead of a · bˣ.
- Testing for exponential with differences.
- Reading the starting value from a table that begins at x = 1.
- Treating b⁻ⁿ as negative; saying decay reaches 0; range 0 ≤ y ≤ a.
- Taking b = ratio over two steps without a square root.
- Adding a percentage back to undo a discount.
- Annual rate used as the monthly rate; years not multiplied by periods per year.
- Reading 1.21ᵗ as 21% per half-year.
- Deciding the long run from who is ahead at the start.
- Dividing a per-decade factor by 10 for a yearly factor.

## Quick drills (answers at the end)

1. Classify 3, 6, 12, 24 and 3, 6, 9, 12.
2. Write the function for 25 tripling each step; find its value at 4.
3. "Loses 35% per step" → factor? "Grows 2.5% per step" → factor?
4. A graph passes through (0, 50) and (2, 72). Equation?
5. Evaluate 6 · 3⁻².
6. $1,500 at 4% a year compounded monthly for 3 years.
7. Rewrite 8,000 · 1.21ᵗ with a half-year step.
8. 100 at t = 0, 150 at t = 4, exponential: value at t = 8?
9. 12,000 in 2005, 15,000 in 2015: predict 2035.

*Answers:* (1) Exponential (×2); linear (+3). (2) 25 · 3ˣ; 2,025. (3) 0.65; 1.025. (4) 50 · 1.2ˣ. (5) 2/3. (6) 1,500 · (1 + 0.04/12)³⁶ ≈ 1,690.91. (7) 8,000 · 1.1^(2t). (8) 225. (9) 12,000 · 1.25³ ≈ 23,400.

## What to review from earlier units

- Average rate of change and comparing graphs (unit 4) are used in every "which changes faster" question.
- Domain and range (unit 4) apply to every exponential model: continuous time, discrete rounds, outputs never 0.
- Equivalent expressions (unit 2) underlie rewriting 1.005^(12t) as 1.0617ᵗ.
- Residual plots (unit 3): a curved residual plot for a line is the signal to try an exponential model.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 5, https://im.kendallhunt.com/HS/teachers/1/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
