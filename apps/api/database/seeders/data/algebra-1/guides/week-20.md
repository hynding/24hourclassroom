# Week 20 · Decay Graphs, Negative Exponents and Exponential Functions

**Lessons:** 5.5 Representing Exponential Decay · 5.6 Analyzing Graphs · 5.7 Using Negative Exponents · 5.8 Exponential Situations as Functions
**Practices:** MP2 (connect a graph's points to the starting value and factor), MP7 (extend a pattern backwards with negative exponents), MP6 (state domain and range precisely)
**Built from:** IM Algebra 1, Unit 5, Lessons 5–8, in our own words
**Spiral:** Domain and range (week 17) now apply to exponential models. Reading a and b off a graph uses the same point-reading habits as week 16. Negative exponents extend the table backwards, the same way a line's equation gives values before x = 0.

## What you need to be able to do

- **5.5** Write and graph an equation for exponential decay from a description or table, and find the decay factor from two values.
- **5.6** Read the starting value and the growth or decay factor from a graph, compare graphs, and explain why exponential graphs never cross the horizontal axis.
- **5.7** Use negative exponents (b⁻ⁿ = 1/bⁿ) to extend an exponential pattern to inputs before 0, and evaluate a · bˣ for negative x.
- **5.8** Describe exponential situations with function notation, state a sensible domain and range, and interpret statements such as f(3) = 500.

## Key terms

| Term | Meaning |
|---|---|
| Decay factor | The number b with 0 < b < 1 that multiplies each step: 1 minus the fraction lost. |
| Negative exponent | b⁻ⁿ means 1/bⁿ; for example 2⁻³ = 1/8 and (1/2)⁻² = 4. |
| Zero exponent | b⁰ = 1 for any non-zero b, so f(0) = a in a · bˣ. |
| Horizontal asymptote | The line y = 0 that an exponential graph approaches but never touches. |
| Exponential function | f(x) = a · bˣ with a > 0 and b > 0, b ≠ 1. |

## Representing decay (5.5)

From a description: a kettle's excess temperature above the room drops by 12% a minute from 80 degrees. Factor 0.88. T(m) = 80 · 0.88ᵐ. After 5 minutes: 80 · 0.88⁵ ≈ 42.2 degrees above the room.

From two values: if a quantity is 500 at x = 0 and 320 at x = 2, then b² = 320/500 = 0.64, so b = 0.8. The equation is 500 · 0.8ˣ. (With values one step apart you simply divide.)

**Worked example.** A forest of 6,000 hectares loses 4% a year. Equation, and area after 10 years?
F(t) = 6,000 · 0.96ᵗ; F(10) = 6,000 · 0.96¹⁰ ≈ 6,000 · 0.6648 ≈ 3,989 hectares.

**Worked example.** A table shows 90 at x = 1 and 30 at x = 2. Factor 1/3, so f(0) = 270 and f(x) = 270 · (1/3)ˣ.

**Try it.** A tyre loses 5% of its pressure each week from 36 psi. Write the equation and find the pressure after 4 weeks.
*Answers:* P(w) = 36 · 0.95ʷ; P(4) ≈ 29.3 psi.

## Analysing graphs (5.6)

Given a graph of y = a · bˣ:

1. **Starting value:** read the y-intercept, (0, a).
2. **Factor:** read another point, ideally (1, y₁); then b = y₁/a. If the second point is at x = 2, b² = y₂/a.
3. **Growth or decay:** rising left to right means b > 1; falling means b < 1.

**Worked example.** A graph passes through (0, 200) and (1, 150). a = 200, b = 150/200 = 0.75: y = 200 · 0.75ˣ, decay.

**Worked example.** A graph passes through (0, 4) and (3, 108). b³ = 27, so b = 3: y = 4 · 3ˣ.

**Comparing graphs.** 100 · 1.2ˣ and 100 · 1.5ˣ start together and the second pulls ahead immediately. 100 · 0.9ˣ and 50 · 0.9ˣ fall at the same proportional rate; the first is always twice the second. Two decay graphs with factors 0.5 and 0.8 both approach zero, the 0.5 graph far faster.

**Why no crossing.** Every output of a · bˣ is a positive number times a positive power, so it is positive. The graph gets as close as you like to the x-axis (for decay, as x increases; for growth, as x decreases) but never reaches it: y = 0 is a horizontal asymptote.

**Try it.** A graph passes through (0, 50) and (2, 72). Find the equation.
*Answer:* b² = 1.44, b = 1.2; y = 50 · 1.2ˣ.

## Negative exponents (5.7)

The pattern 2⁴ = 16, 2³ = 8, 2² = 4, 2¹ = 2 divides by 2 each step. Continuing: 2⁰ = 1, 2⁻¹ = 1/2, 2⁻² = 1/4, 2⁻³ = 1/8. In general **b⁻ⁿ = 1/bⁿ**, and for a fraction, (1/2)⁻² = 1/(1/4) = 4.

Why it matters: an exponential model describes the past as well as the future. If a culture has 400 bacteria at hour 0 and doubles hourly, then at hour −2 (two hours before the count began) it had 400 · 2⁻² = 100.

| x | −3 | −2 | −1 | 0 | 1 | 2 |
|---|---|---|---|---|---|---|
| 400 · 2ˣ | 50 | 100 | 200 | 400 | 800 | 1,600 |

For decay the direction reverses: M(h) = 200 · 0.75ʰ gives M(−1) = 200/0.75 ≈ 266.7, more than at hour 0, which makes sense if the quantity was decaying before we started counting.

**Worked example.** Evaluate 5 · 3⁻², 10 · (1/4)⁻¹ and 6⁰.
5 · 1/9 = 5/9; 10 · 4 = 40; 1.

**Worked example.** The population P(t) = 3,000 · 1.05ᵗ, with t years after 2020. Estimate the 2017 population.
P(−3) = 3,000 · 1.05⁻³ = 3,000/1.157625 ≈ 2,592.

**Try it.** Find 8 · 2⁻³ and 100 · (1/5)⁻².
*Answers:* 1; 2,500.

## Exponential situations as functions (5.8)

Write exponential models in function notation and treat them like any function:

- A(h) = 400 · 0.75ʰ: the amount of medicine after h hours. A(3) ≈ 168.8 means "about 168.8 mg after 3 hours". Solving A(h) = 100 asks when 100 mg remains (about 4.8 hours, found by trying values or from a graph).
- **Domain:** the inputs that make sense: h ≥ 0 for the medicine, or 0 ≤ h ≤ 24 if the dose is repeated daily. Time is continuous. A count of doublings is a whole number.
- **Range:** the outputs produced: for A, 0 < A ≤ 400. For growth from 400 with no end, A ≥ 400.

**Worked example.** A video has 1,200 views on day 0 and views grow 30% a day for two weeks. Write V(d), state domain and range, interpret V(7), and find the day views first exceed 10,000.
V(d) = 1,200 · 1.3ᵈ, 0 ≤ d ≤ 14, range 1,200 ≤ V ≤ 1,200 · 1.3¹⁴ ≈ 47,249. V(7) = 1,200 · 1.3⁷ ≈ 7,529: about 7,500 views after a week. V(8) ≈ 9,788; V(9) ≈ 12,725: day 9.

**Try it.** C(n) = 20 · (1/2)ⁿ is the number of players left after n rounds of a knockout. Domain, range, and C(3)?
*Answers:* Whole numbers 0 to about 4 (until one player remains); range 20, 10, 5, 2.5 (really the whole-number rounding of a model); C(3) = 2.5, so the model breaks down at the last rounds.

## Common mistakes

- Reading the factor from a point that is not one step from the intercept without taking the root.
- Writing b⁻ⁿ as a negative number; 2⁻³ is 1/8, not −8.
- Saying a decay graph "ends" at the x-axis.
- Giving the range of a decay model as 0 ≤ y ≤ a; the 0 is never reached.
- Using whole-number domains for continuous time, or continuous domains for counts of rounds.

## Where this goes next

Week 21 interprets parameters in context and studies how the rate of change of an exponential function changes, then graphs exponential functions by reasoning rather than by plotting. Week 22 turns percentages into factors systematically, including compound interest.

## Self-check

1. A quantity falls from 800 at x = 0 to 512 at x = 2. Find the factor and the equation.
2. A graph passes through (0, 30) and (1, 45). Equation?
3. Evaluate 3 · 4⁻² and (1/3)⁻³.
4. P(t) = 500 · 2ᵗ, t in hours. Find P(−1) and interpret it.
5. Give domain and range for A(h) = 400 · 0.75ʰ if the medicine is taken once and tracked for a day.

*Answers:* (1) b² = 0.64, b = 0.8; 800 · 0.8ˣ. (2) 30 · 1.5ˣ. (3) 3/16; 27. (4) 250: one hour before the count began there were 250. (5) 0 ≤ h ≤ 24; 400 · 0.75²⁴ ≈ 0.4 ≤ A ≤ 400.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 5, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/1/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
