# Week 17 · Rational Intervals, Writing Equations and Unknown Exponents

**Lessons:** 4.5 Changes Over Rational Intervals · 4.6 Writing Equations for Exponential Functions · 4.7 Interpreting and Using Exponential Functions · 4.8 Unknown Exponents
**Practices:** MP2 (reason abstractly and quantitatively), MP4 (model with mathematics), MP1 (make sense of problems)
**Built from:** IM Algebra 2, Unit 4, Lessons 5–8, in our own words
**Spiral:** Last week's b^(1/n) becomes the general rule b^d for an interval of length d. Writing an equation from two points uses the root idea from Unit 3 (b³ = 27 gives b = 3). Average rate of change is the slope idea from Algebra 1 applied to a curve. Unknown exponents like 4ˣ = 8 are solved with the rational exponents of week 11.

## What you need to be able to do

- **4.5** Explain and use the fact that for f(x) = a · bˣ, the factor over any interval of length d is b^d, no matter where the interval starts; convert a percent change per unit into a percent change per fraction or multiple of that unit.
- **4.6** Write an equation for an exponential function from two points, including points that do not include x = 0, by finding b from the ratio of outputs and the gap between inputs.
- **4.7** Interpret the parameters of an exponential model in context, compute and compare average rates of change over intervals, and use a model to answer questions and judge its limits.
- **4.8** Solve equations with an unknown exponent exactly when the answer is a nice fraction or integer (2ˣ = 32, 4ˣ = 8, 3ˣ = 1/9), and bracket the answer between consecutive integers otherwise (10ˣ = 50 has 1 < x < 2).

## Key terms

| Term | Meaning |
|---|---|
| Factor over an interval | For f(x) = a · bˣ, f(x + d)/f(x) = b^d for any x and any d. |
| Average rate of change | (f(b) − f(a))/(b − a): the slope of the line through two points on the graph. |
| Parameters | The numbers a and b in a · bˣ; in context, the starting amount and the per-unit growth factor. |
| Unknown exponent | An equation such as bˣ = c where x is in the exponent. |
| Bracketing | Finding integers n and n + 1 with bⁿ < c < bⁿ⁺¹, so n < x < n + 1. |

## Changes over any interval (4.5)

If f(x) = a · bˣ, then f(x + d)/f(x) = a · bˣ⁺ᵈ / (a · bˣ) = b^d. The starting point x cancels: an exponential function changes by the same factor over every interval of the same length. For f(x) = 7(1.1)ˣ the factor over any 3-unit interval is 1.1³ = 1.331, a 33.1% increase (not 30%).

**Fractions and multiples of a unit.** A quantity growing 20% per year has b = 1.2.

| Interval | Factor | Percent change |
|---|---|---|
| 1 year | 1.2 | +20% |
| 6 months | 1.2^(1/2) ≈ 1.095 | +9.5% |
| 3 months | 1.2^(1/4) ≈ 1.047 | +4.7% |
| 2.5 years | 1.2^(5/2) ≈ 1.577 | +57.7% |
| 5 years | 1.2⁵ ≈ 2.488 | +148.8% |

A quantity losing 15% per year has b = 0.85; over half a year the factor is 0.85^(1/2) ≈ 0.922, a 7.8% loss (not 7.5%).

**Worked example.** A culture doubles every 3 hours. By what factor does it grow in 1 hour? In 5 hours?

Per hour: 2^(1/3) ≈ 1.26. In 5 hours: (2^(1/3))⁵ = 2^(5/3) ≈ 3.17.

**Try it.**
1. f(x) = 50(0.8)ˣ. What is f(x + 2)/f(x)? Does it depend on x?
2. Growth is 30% per decade. Find the percent change per year and per 25 years.

*Answers:* 1. 0.8² = 0.64, a 36% decrease over every 2-unit interval; it does not depend on x. 2. 1.3^(1/10) ≈ 1.0266, about 2.66% per year; 1.3^(2.5) ≈ 1.927, about 92.7% per 25 years.

## Writing equations from two points (4.6)

If the points include x = 0, a is the y-value there and b comes from one more point. If not, use the ratio of outputs and the gap between inputs:

**Through (2, 90) and (5, 2430).** The gap is 3, so b³ = 2430/90 = 27 and b = 3. Then a · 3² = 90 gives a = 10: f(x) = 10 · 3ˣ.

**Through (1, 50) and (4, 6.25).** b³ = 6.25/50 = 0.125, b = 0.5. Then a · 0.5 = 50, a = 100: f(x) = 100(0.5)ˣ.

**Through (0, 12) and (3, 96).** a = 12; b³ = 8, b = 2: f(x) = 12 · 2ˣ. Then f(5) = 12 · 32 = 384 and f(1/2) = 12√2 ≈ 16.97.

**Through (1, 20) and (3, 45).** b² = 45/20 = 2.25, b = 1.5. Then a · 1.5 = 20, a = 40/3 ≈ 13.33: f(x) = (40/3)(1.5)ˣ.

**Worked example.** A population was 8000 in 2010 and 9680 in 2012. Assuming exponential growth, write P(t) with t in years since 2010 and find the annual growth rate.

b² = 9680/8000 = 1.21, so b = 1.1 and the rate is 10% per year: P(t) = 8000(1.1)ᵗ.

**Try it.**
1. Write the exponential function through (0, 5) and (4, 405).
2. Write the exponential function through (2, 36) and (4, 4).

*Answers:* 1. b⁴ = 81, b = 3: 5 · 3ˣ. 2. b² = 1/9, b = 1/3; a · (1/9) = 36, a = 324: 324(1/3)ˣ.

## Interpreting and using models (4.7)

**Reading parameters.** For A(t) = 500(1.04)ᵗ dollars after t years: 500 is the initial deposit and 1.04 means 4% interest per year. Over 6 months the factor is 1.04^(1/2) ≈ 1.0198, about 1.98%.

**Average rate of change.** The average rate of change of f over [a, b] is (f(b) − f(a))/(b − a), the slope of the line joining the two points. For A(t):

- Over [0, 10]: A(10) ≈ 740.12, so the average rate is (740.12 − 500)/10 ≈ $24.01 per year.
- Over [10, 20]: A(20) ≈ 1095.56, so (1095.56 − 740.12)/10 ≈ $35.54 per year.

The second decade's average rate is larger because 4% of a bigger balance is more money. For growth, average rates increase from interval to interval; for decay, they are negative and shrink in size.

For P(t) = 100 · 2ᵗ: over [0, 2] the average rate is (400 − 100)/2 = 150 per unit; over [2, 4] it is (1600 − 400)/2 = 600 per unit, four times as large.

For M(t) = 3000(0.92)ᵗ over [0, 5]: M(5) ≈ 1977.24, so the average rate is about −204.55 per unit.

**Limits of a model.** Exponential growth cannot continue forever (a population runs out of food; a price cannot rise 10% a year for a century without consequence). State the domain where the model is sensible.

**Worked example.** A town's population is P(t) = 2000(1.035)ᵗ, t in years since 2020. Interpret the parameters, find P(10), and compare the average rates of change over [0, 10] and [10, 20].

2000 people in 2020, growing 3.5% per year. P(10) = 2000(1.035)¹⁰ ≈ 2821. P(20) ≈ 3980. Average rates: (2821 − 2000)/10 ≈ 82 people per year, then (3980 − 2821)/10 ≈ 116 per year.

**Try it.**
1. V(t) = 24000(0.85)ᵗ. Find the average rate of change over [0, 2] and over [2, 4].
2. A model says a video's views are 300 · 3ᵗ after t days. Why does the model have to fail eventually?

*Answers:* 1. V(2) = 17340, V(4) ≈ 12528.15: rates −3330 and about −2405.9 per year. 2. 300 · 3ᵗ exceeds the number of people on Earth after about 15 days.

## Unknown exponents (4.8)

Sometimes the exponent is the unknown: 2ˣ = 32. Since 2⁵ = 32, x = 5. Rewrite both sides as powers of the same base whenever you can:

| Equation | Same base | Solution |
|---|---|---|
| 2ˣ = 32 | 2ˣ = 2⁵ | 5 |
| 3ˣ = 1/9 | 3ˣ = 3⁻² | −2 |
| 10ˣ = 1000 | 10ˣ = 10³ | 3 |
| 4ˣ = 8 | (2²)ˣ = 2³ | 3/2 |
| 8ˣ = 2 | (2³)ˣ = 2¹ | 1/3 |
| 100ˣ = 10 | (10²)ˣ = 10¹ | 1/2 |
| 9ˣ = 3 | (3²)ˣ = 3¹ | 1/2 |
| 25ˣ = 5 | (5²)ˣ = 5¹ | 1/2 |
| 16ˣ = 8 | (2⁴)ˣ = 2³ | 3/4 |
| 2ˣ = 1/√2 | 2ˣ = 2^(−1/2) | −1/2 |

**When the bases do not match.** 10ˣ = 50 has no neat answer, but 10¹ = 10 < 50 < 100 = 10², so 1 < x < 2 (in fact x ≈ 1.70). For 5ˣ = 100: 5² = 25 < 100 < 125 = 5³, so 2 < x < 3 (x ≈ 2.86). For 2ˣ = 10: 2³ = 8 < 10 < 16 = 2⁴, so 3 < x < 4 (x ≈ 3.32). A graph of y = bˣ, or trial and improvement, narrows it further. Next week gives these answers a name: logarithms.

**Worked example.** When does P(t) = 2000(1.035)ᵗ reach 4000?

1.035ᵗ = 2. Since 1.035²⁰ ≈ 1.99 and 1.035²¹ ≈ 2.06, t is just over 20 years (about 20.1).

**Try it.**
1. Solve 27ˣ = 3 and 5ˣ = 1/125.
2. Between which two integers is the solution of 3ˣ = 40?

*Answers:* 1. 1/3; −3. 2. 3³ = 27 < 40 < 81 = 3⁴, so 3 < x < 4 (x ≈ 3.36).

## Common mistakes

- **Multiplying the percent by the interval length.** 20% per year over 2.5 years is 57.7%, not 50%; factors multiply.
- **Dividing outputs by the wrong gap.** Through (2, 90) and (5, 2430), the ratio 27 covers 3 units, so b = 27^(1/3), not 27/3.
- **Average rate of change as f(b)/f(a).** It is the difference divided by the interval length, with units of "output per input".
- **Solving 4ˣ = 8 as x = 2.** 4² = 16; rewrite with base 2 to get x = 3/2.
- **Reading 3ˣ = 1/9 as x = 1/9 or −9.** The exponent is −2.

## Where this goes next

Next week names the solution of bˣ = c: it is the logarithm log_b(c). You will read and write logarithmic equations, evaluate logarithms exactly and with a calculator, and use them to solve the equations that this week could only bracket.

## Self-check

1. g(x) = 90(1.15)ˣ. Find the percent change over any 4-unit interval and over any half-unit interval.
2. Write the exponential function through (1, 6) and (4, 162).
3. A(t) = 500(1.04)ᵗ. Compute the average rate of change over [5, 15].
4. Solve 32ˣ = 4 and 7ˣ = 1/49.
5. Bracket the solution of 2ˣ = 100 between two integers and explain.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 4, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/3/4/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
