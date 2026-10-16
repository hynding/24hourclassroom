# Unit 4 · Exponential Functions and Equations · The night-before sheet

**Exam weight:** about 15–18% of the final · **Lessons:** 4.1 Growing and Shrinking · 4.2 Representations of Growth and Decay · 4.3 Understanding Rational Inputs · 4.4 Representing Functions at Rational Inputs · 4.5 Changes Over Rational Intervals · 4.6 Writing Equations for Exponential Functions · 4.7 Interpreting and Using Exponential Functions · 4.8 Unknown Exponents · 4.9 What is a Logarithm? · 4.10 Interpreting and Writing Logarithmic Equations · 4.11 Evaluating Logarithmic Expressions · 4.12 The Number e · 4.13 Exponential Functions with Base e · 4.14 Solving Exponential Equations · 4.15–4.16 Using Graphs and Logarithms to Solve Problems · 4.17 Logarithmic Functions · 4.18 Applications of Logarithmic Functions
**Practices:** MP2, MP4, MP5, MP7
**Built from:** IM Algebra 2, Unit 4, in our own words

## The ideas that generate every question

1. **Exponential change is repeated multiplication.** f(x) = a · bˣ: a is the starting value, b the growth factor. Up p% means b = 1 + p/100; down p% means b = 1 − p/100. Linear change adds; exponential change multiplies.
2. **One factor, any interval.** f(x + d)/f(x) = b^d for every x. A fraction of a unit uses a root (b^(1/12) per month), a multiple uses a power (b^2.5 over 2.5 units). Percents never add or divide across intervals.
3. **Two points determine the function.** b^(gap) = ratio of outputs, so b = ratio^(1/gap); then solve for a.
4. **Average rate of change is a slope**, (f(b) − f(a))/(b − a), and for exponential growth it increases from one interval to the next because the base amount grows.
5. **A logarithm is an exponent.** log_b(y) = x means bˣ = y. log is base 10, ln is base e. log_b(1) = 0, log_b(b) = 1, logs of numbers between 0 and 1 are negative, logs of 0 and of negatives are undefined.
6. **Solving bˣ = c:** isolate the power, rewrite in log form, evaluate (exactly when possible, otherwise with technology). Bracket the answer between integer exponents to check.
7. **e is the continuous-compounding limit.** (1 + 1/n)ⁿ approaches e ≈ 2.71828. In a · e^(kt), k is the continuous rate and e^k is the actual per-unit factor (5% continuous is 5.13% per year).
8. **Doubling time and half-life depend only on b.** Solve bᵗ = 2 or bᵗ = 1/2; the starting amount cancels.
9. **log_b(x) is the inverse of bˣ.** Its graph is the reflection across y = x: domain x > 0, vertical asymptote x = 0, through (1, 0) and (b, 1), increasing ever more slowly.
10. **Logarithmic scales turn factors into steps.** One unit of pH, 10 dB, or one magnitude is a factor of 10.

## Key formulas and procedures

| Want | Do this |
|---|---|
| Percent → factor | up p%: 1 + p/100; down p%: 1 − p/100 |
| Factor → percent | (b − 1) · 100% |
| Test a table | constant ratio → exponential; constant difference → linear |
| Equation from (0, a) and (1, y₁) | b = y₁/a |
| Equation from (x₁, y₁), (x₂, y₂) | b = (y₂/y₁)^(1/(x₂ − x₁)), then a = y₁/b^(x₁) |
| Factor over d units | b^d; per 1/n unit: b^(1/n) |
| Change the time unit | yearly 1.06 → monthly 1.06^(1/12); monthly 1.02 → yearly 1.02¹² |
| Average rate of change | (f(b) − f(a))/(b − a) |
| bˣ = c, matching bases | 4ˣ = 8 → 2²ˣ = 2³ → x = 3/2 |
| bˣ = c, general | x = log_b(c); base 10: log(c); base e: ln(c) |
| a · bˣ = c | divide by a first, then take the log |
| a · e^(kt) = c | kt = ln(c/a), t = ln(c/a)/k |
| Doubling time | log_b(2); continuous: ln(2)/k |
| Half-life | log_b(1/2); known half-life h: fraction = (1/2)^(t/h) |
| Continuous rate ↔ factor | factor = e^k; k = ln(factor) |
| Exact logs | log₂(32) = 5, log₃(1/81) = −4, log₄(2) = 1/2, log₉(27) = 3/2, log(0.001) = −3, ln(e³) = 3 |
| pH | −log[H⁺]; [H⁺] = 10^(−pH) |
| Decibels | 10 log(I/10⁻¹²); +10 dB = ×10 intensity |
| Magnitude difference Δ | amplitude factor 10^Δ |

## Common errors

- Subtracting the same amount each step for "down 10%": 200 → 180 → 160 is wrong; 200 → 180 → 162 is right.
- Using 0.2 as the factor for a 20% decrease (it is 0.8), or 1.5 for a 50% decrease (it is 0.5).
- Dividing a rate to change units: 6% per year is 1.06^(1/12) ≈ 1.00487 per month, not 1.005.
- Solving 5 · 3ᵗ = 200 by taking a log before dividing by 5.
- Treating a continuous rate as the percent change: e^0.05 is 5.13%, not 5%.
- Confusing ln and log, or writing log(1000) = 1000.
- Swapping base and argument: log₄(2) = 1/2, log₂(4) = 2.
- Giving log_b(x) a horizontal asymptote, or a y-intercept; it has a vertical asymptote at x = 0 and an x-intercept at 1.
- Reading a 20 dB difference as "20 times": it is 100 times.
- Reporting an exponential decay as reaching 0; it only approaches 0.

## Worked examples

**Equation from two points.** Through (2, 18) and (4, 162): b² = 9, b = 3; a · 9 = 18, a = 2: f(x) = 2 · 3ˣ.

**Rational inputs.** f(x) = 100 · 4ˣ: f(1/2) = 200, f(3/2) = 800, f(−1/2) = 50.

**Unit change.** 10% per year → monthly factor 1.1^(1/12) ≈ 1.00797, about 0.8% per month.

**Exact exponent.** 27ˣ = 9: 3³ˣ = 3², x = 2/3.

**Logarithm forms.** 2⁻³ = 1/8 ↔ log₂(1/8) = −3. log₄(32) = 5/2 because 4^(5/2) = 2⁵ = 32.

**Solve with a log.** 10ˣ = 0.02 → x = log(0.02) ≈ −1.70. 1.06ᵗ = 2 → t = log₁.₀₆(2) ≈ 11.90. 50e^(0.12t) = 400 → e^(0.12t) = 8 → t = ln(8)/0.12 ≈ 17.33.

**Continuous growth.** N(t) = 50e^(0.12t): per-unit factor e^0.12 ≈ 1.1275 (12.75%); N(5) = 50e^0.6 ≈ 91.1.

**Half-life from a model.** V(t) = 24000(0.85)ᵗ: 0.85ᵗ = 0.5, t = log₀.₈₅(0.5) ≈ 4.27 years.

**Inequality.** 500(1.2)ᵗ > 5000: 1.2ᵗ > 10, t > log₁.₂(10) ≈ 12.63.

**Scales.** I = 10⁻⁸ W/m²: 10 log(10⁴) = 40 dB. Magnitude 7.5 versus 5.5: 10² = 100 times the amplitude. pH 3.7: [H⁺] = 10⁻³·⁷ ≈ 2.0 × 10⁻⁴.

## What to review from earlier units

- **Unit 1:** geometric sequences are exponential functions at whole-number inputs; the nth term a · rⁿ⁻¹.
- **Unit 3:** rational exponents make b^(1/12) and 4^(3/2) meaningful; exponent rules justify b^d over an interval and the matching-bases method.

## Exam-night checklist

1. Can you convert a percent change to a factor and back, including a decrease?
2. Can you write an exponential function from a table, a graph, or two points that do not include x = 0?
3. Can you find the factor for a month, a quarter, or 2.5 years from a yearly factor, without dividing the percent?
4. Can you compute an average rate of change and say why it grows for exponential growth?
5. Can you solve 4ˣ = 8 exactly and 4ˣ = 10 with a logarithm, and bracket the second?
6. Can you evaluate log₂(1/16), log₉(3), log(0.0001) and ln(e⁵) without a calculator?
7. Can you explain what e is, and convert between a continuous rate and a per-unit percent?
8. Can you find a doubling time or half-life, and explain why the starting amount does not matter?
9. Can you sketch y = log₂(x) with its asymptote and two labelled points?
10. Can you compare two pH values, two decibel levels, or two magnitudes as a factor of 10 to some power?

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 4, Lessons 1–18, https://im.kendallhunt.com/HS/teachers/3/4/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
