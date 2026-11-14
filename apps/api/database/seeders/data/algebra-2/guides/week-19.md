# Week 19 · The Number e and Solving Exponential Equations

**Lessons:** 4.12 The Number e · 4.13 Exponential Functions with Base e · 4.14 Solving Exponential Equations
**Practices:** MP8 (regularity in repeated reasoning), MP2 (reason abstractly and quantitatively), MP6 (attend to precision)
**Built from:** IM Algebra 2, Unit 4, Lessons 12–14, in our own words
**Spiral:** Changing the compounding period (week 16: 6% per year is 1.06^(1/12) per month) is pushed to its limit to produce e. Logarithms (week 18) now finish the equations that week 17 could only bracket: 2ᵗ = 50 has the exact answer t = log₂(50).

## What you need to be able to do

- **4.12** Describe where e comes from (compounding more and more often, (1 + 1/n)ⁿ approaching 2.71828…), know that e is irrational and between 2 and 3, and recognise it as a base like 2 or 10.
- **4.13** Interpret f(t) = a · e^(kt): a is the initial value, k the continuous rate, e^k the per-unit growth factor; evaluate such functions, convert between the continuous rate and the percent change per unit, and sketch base-e graphs alongside other bases.
- **4.14** Solve exponential equations exactly with logarithms: isolate the power, then rewrite in log form, using log for base 10, ln for base e, and log_b or technology for other bases; interpret the answer in context.

## Key terms

| Term | Meaning |
|---|---|
| e | An irrational constant, e ≈ 2.71828, the limiting value of (1 + 1/n)ⁿ. |
| Continuous growth | Growth described by a · e^(kt); the compounding happens "at every instant". |
| Continuous rate k | The exponent coefficient in e^(kt). The actual per-unit change is e^k − 1. |
| Natural logarithm ln | log base e: ln(y) is the exponent x with eˣ = y. ln(e) = 1, ln(1) = 0. |
| Isolating the power | Dividing or subtracting so the equation reads bˣ = c before taking a logarithm. |

## Where e comes from (4.12)

Put $1 in an account paying 100% per year. Compounded once, you have 2. Compounded twice (50% each half year): (1.5)² = 2.25. Compounded n times: (1 + 1/n)ⁿ.

| n | 1 | 2 | 10 | 100 | 1000 | 1,000,000 |
|---|---|---|---|---|---|---|
| (1 + 1/n)ⁿ | 2 | 2.25 | 2.594 | 2.705 | 2.717 | 2.71828 |

The values climb but level off at a number that is called **e ≈ 2.718281828…**. Like π it is irrational: its decimals never repeat and it is not a fraction. Compounding "continuously" (at every instant) multiplies the balance by e each year.

Compounding at rate r instead of 100% gives (1 + r/n)ⁿ, which approaches e^r. So continuous growth at rate r multiplies by e^r per year. For $1000 at 6% over 10 years:

- yearly compounding: 1000(1.06)¹⁰ ≈ 1790.85
- monthly compounding: 1000(1 + 0.06/12)¹²⁰ ≈ 1819.40
- continuous compounding: 1000e^(0.06 · 10) = 1000e^0.6 ≈ 1822.12

More frequent compounding helps, but the gains shrink and stop at the continuous value.

**Worked example.** Which is larger, 2ˣ, eˣ or 3ˣ, for x > 0?

Since 2 < e < 3, for positive x we have 2ˣ < eˣ < 3ˣ; the graph of y = eˣ runs between the other two. At x = 2: 4 < 7.39 < 9.

**Try it.**
1. Compute (1 + 1/4)⁴ and say how it compares with e.
2. Without a calculator, order e², 2³ and 3².

*Answers:* 1. 2.4414, below e; more compounding periods push it up toward 2.718. 2. 3² = 9 > 2³ = 8 > e² ≈ 7.39.

## Functions with base e (4.13)

An exponential function with base e is usually written **f(t) = a · e^(kt)**:

- a = f(0), the initial value;
- k is the **continuous rate**; the per-unit growth factor is e^k.

| Function | Per-unit factor | Percent change per unit |
|---|---|---|
| 1000e^(0.05t) | e^0.05 ≈ 1.0513 | +5.13% |
| 50e^(0.03t) | e^0.03 ≈ 1.0305 | +3.05% |
| 200e^(−0.2t) | e^(−0.2) ≈ 0.8187 | −18.13% |
| 1000e^(0.06t) | e^0.06 ≈ 1.0618 | +6.18% |

Notice that a continuous rate of 5% gives slightly more than 5% per year, because the growth compounds within the year. Going the other way, 7% per year (factor 1.07) corresponds to a continuous rate k = ln(1.07) ≈ 0.0677.

**Evaluating.** A(t) = 1000e^(0.05t) after 8 years: A(8) = 1000e^0.4 ≈ 1491.82. B(t) = 500e^(0.08t) after 3 years: 500e^0.24 ≈ 635.62. M(t) = 200e^(−0.2t) after 5 units: 200e^(−1) ≈ 73.58.

**Graphs.** y = eˣ has y-intercept 1, passes through (1, e) ≈ (1, 2.72), rises faster than 2ˣ and slower than 3ˣ, and has the x-axis as a horizontal asymptote on the left. y = e^(−x) is its mirror image, decaying to the right. Multiplying by a scales the intercept; k > 0 grows, k < 0 decays.

**Worked example.** A culture satisfies g(t) = 50e^(0.03t). Find g(0), g(10), the percent growth per unit, and whether g doubles every 3 units.

g(0) = 50. g(10) = 50e^0.3 ≈ 67.49. Per unit factor e^0.03 ≈ 1.0305, about 3.05%. Doubling needs e^(0.03t) = 2, t = ln(2)/0.03 ≈ 23.1 units, so no, it takes about 23 units, not 3.

**Try it.**
1. For h(t) = 800e^(−0.15t), find h(4) and the percent change per unit.
2. Rewrite P(t) = 300(1.04)ᵗ in the form 300e^(kt).

*Answers:* 1. 800e^(−0.6) ≈ 439.0; e^(−0.15) ≈ 0.8607, a 13.9% decrease per unit. 2. k = ln(1.04) ≈ 0.0392.

## Solving exponential equations (4.14)

Last week's logarithm turns bracketing into solving. The routine:

1. **Isolate the power**: divide away any coefficient, move constants.
2. **Rewrite in logarithmic form** (or "take the log of both sides").
3. **Evaluate**: exactly if possible, otherwise with technology.

| Equation | Isolated | Solution |
|---|---|---|
| 2ᵗ = 50 | — | t = log₂(50) ≈ 5.64 |
| 5 · 3ᵗ = 200 | 3ᵗ = 40 | t = log₃(40) ≈ 3.36 |
| 1.08ᵗ = 3 | — | t = log₁.₀₈(3) ≈ 14.27 |
| 10ᵗ = 0.004 | — | t = log(0.004) ≈ −2.40 |
| e^(0.2t) = 7 | — | 0.2t = ln(7), t = ln(7)/0.2 ≈ 9.73 |
| 1000e^(0.05t) = 2000 | e^(0.05t) = 2 | 0.05t = ln 2, t = ln(2)/0.05 ≈ 13.86 |
| 0.9ᵗ = 0.25 | — | t = log₀.₉(0.25) ≈ 13.16 |
| 3eᵗ = 15 | eᵗ = 5 | t = ln 5 ≈ 1.609 |
| e^(2t) = 25 | — | 2t = ln 25, t = ln(25)/2 = ln 5 |

Natural logs you should know: ln(e) = 1, ln(1) = 0, ln(e³) = 3, ln(1/e) = −1, ln(√e) = 1/2, ln 2 ≈ 0.693, ln 10 ≈ 2.303. For a base that is not 10 or e, technology evaluates log_b directly; most calculators also accept log(c)/log(b), which gives the same number.

**Checking.** Always substitute: 1.08^14.27 ≈ 3.00. And bracket: 1.08¹⁴ ≈ 2.94 < 3 < 1.08¹⁵ ≈ 3.17, so 14 < t < 15.

**A negative answer.** 10ᵗ = 0.004 gives t ≈ −2.40: the output is below 1, so the exponent is negative. In a model with t measured from "now", that means about 2.4 units in the past.

**Worked example.** A population P(t) = 2000(1.035)ᵗ. Exactly when does it reach 4000?

1.035ᵗ = 2, so t = log₁.₀₃₅(2) ≈ 20.15 years, consistent with last week's bracket of 20 < t < 21.

**Worked example.** Solve 4 · 2^(x + 1) = 100.

2^(x + 1) = 25, so x + 1 = log₂(25) ≈ 4.64, giving x ≈ 3.64.

**Try it.**
1. Solve 7ᵗ = 500.
2. Solve 20e^(0.1t) = 80.
3. Solve 6 · 0.5ᵗ = 1.5.

*Answers:* 1. t = log₇(500) ≈ 3.19. 2. e^(0.1t) = 4, t = ln(4)/0.1 ≈ 13.86. 3. 0.5ᵗ = 0.25, t = 2 exactly.

## Common mistakes

- **Taking the log before isolating the power.** For 5 · 3ᵗ = 200, divide by 5 first; log(5 · 3ᵗ) is not 5 · log(3ᵗ).
- **Treating the continuous rate as the percent change.** e^0.05 is 5.13% growth, not 5%.
- **Confusing ln and log.** ln is base e; log (no base) is base 10. ln(e³) = 3 but log(e³) ≈ 1.30.
- **Writing e as 2.718 exactly.** It is irrational; 2.718 is an approximation.
- **Ignoring a negative or fractional answer.** t ≈ −2.40 is a legitimate solution; whether it makes sense depends on the context.

## Where this goes next

Next week uses graphs and logarithms to solve problems: half-lives, doubling times, and models built from data. Then logarithmic functions get their own graphs and applications (4.17–4.18), and the unit exam follows.

## Self-check

1. Explain in two sentences what e is and where it comes from.
2. For f(t) = 120e^(−0.05t), find f(10) and the percent change per unit.
3. Solve 3 · 5ᵗ = 60 exactly and approximately.
4. Solve 250e^(0.04t) = 1000.
5. Explain why 10ᵗ = 0.3 has a negative solution and find it.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 4, Lessons 12–14, https://im.kendallhunt.com/HS/teachers/3/4/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
