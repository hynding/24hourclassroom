# Week 22 · Percent Change and Compound Interest

**Lessons:** 5.14 Recalling Percent Change · 5.15 Functions Involving Percent Change · 5.16 Compounding Interest · 5.17 Different Compounding Intervals · 5.18 Expressed in Different Ways
**Practices:** MP7 (see a percent change as one multiplication), MP6 (keep the rate per period straight), MP2 (compare equivalent forms of one function)
**Built from:** IM Algebra 1, Unit 5, Lessons 14–18, in our own words
**Spiral:** A percent increase is the growth factor of week 19 written as a percentage. Equivalent expressions (unit 2) return as equivalent forms of one exponential function. Interpreting parameters (week 21) now includes the compounding period.

## What you need to be able to do

- **5.14** Compute a percent increase or decrease in one step by multiplying by (1 + r) or (1 − r), and reverse it.
- **5.15** Write a function for repeated percent change, f(x) = a · (1 + r)ˣ, and distinguish it from repeated addition of the same amount.
- **5.16** Model compound interest: an amount P earning rate r per period grows to P(1 + r)ⁿ after n periods; contrast with simple interest.
- **5.17** Convert an annual rate to a per-period rate for monthly, quarterly or daily compounding, and compute the amount after a given time.
- **5.18** Rewrite an exponential expression in different equivalent forms (per month, per year) and read the growth rate from each.

## Key terms

| Term | Meaning |
|---|---|
| Percent increase of r | Multiply by (1 + r): a 7% increase is a factor of 1.07. |
| Percent decrease of r | Multiply by (1 − r): a 7% decrease is a factor of 0.93. |
| Simple interest | The same interest, a fixed percentage of the original amount, is added each period: linear. |
| Compound interest | Interest is added to the balance and earns interest itself: exponential. |
| Nominal annual rate | The quoted yearly rate, divided among the compounding periods: 6% a year compounded monthly is 0.5% a month. |
| Effective annual rate | The actual percentage growth over a year once compounding is included. |

## Percent change (5.14)

Increase $80 by 15%: 80 · 1.15 = 92. Decrease $80 by 15%: 80 · 0.85 = 68. The multiplier does the whole job in one step; there is no need to compute 15% separately and add.

**Reversing.** A coat costs $63 after a 30% discount. Original price: 63 ÷ 0.7 = 90. Do not add 30% back (63 · 1.3 = 81.9 is wrong): a 30% decrease is undone by dividing by 0.7.

**Chains.** A price rises 10% then falls 10%: factor 1.1 · 0.9 = 0.99, a 1% overall decrease, not back to the start.

**Worked example.** A town of 25,000 grows 4% in a year. New population? A different town shrinks from 25,000 by 4%. New population?
26,000; 24,000.

**Try it.** After a 20% increase an item costs $54. What was it before? What single factor represents a 25% increase followed by a 20% decrease?
*Answers:* 54 ÷ 1.2 = 45; 1.25 · 0.8 = 1.

## Functions involving percent change (5.15)

A quantity that changes by the same percent each period follows f(x) = a · (1 + r)ˣ, or a · (1 − r)ˣ for a decrease. A city of 300,000 growing 2% a year: C(t) = 300,000 · 1.02ᵗ. A phone worth $900 losing 25% a year: V(t) = 900 · 0.75ᵗ.

Contrast with adding the same amount: a club with 40 members adding 5 a year is M(t) = 40 + 5t (linear); a club growing 12.5% a year is M(t) = 40 · 1.125ᵗ (exponential). Both add 5 in the first year, but the second adds more and more.

**Worked example.** A website's visits grow 6% a month from 15,000. Visits after 8 months?
15,000 · 1.06⁸ ≈ 23,908.

**Worked example.** A lake's fish population drops 8% a year from 5,000. When does it fall below 3,000?
5,000 · 0.92ᵗ < 3,000: t = 6 gives about 3,032; t = 7 gives about 2,789. In the seventh year.

**Try it.** Rent is $1,400 a month and rises 3% each year. Write R(t) and find the rent after 5 years.
*Answers:* R(t) = 1,400 · 1.03ᵗ; R(5) ≈ $1,623.

## Compound interest (5.16)

$1,000 in an account paying 5% a year, compounded annually: after 1 year 1,050; after 2 years 1,050 · 1.05 = 1,102.50; after n years 1,000 · 1.05ⁿ. The interest in year 2 ($52.50) is more than in year 1 ($50) because it is earned on the interest too.

**Simple interest** would pay $50 every year: 1,000 + 50n. After 10 years: simple 1,500; compound 1,000 · 1.05¹⁰ ≈ 1,628.89. After 30 years: simple 2,500; compound ≈ 4,321.94.

**Worked example.** $2,500 at 3% compounded annually for 6 years: 2,500 · 1.03⁶ ≈ $2,985.13.

**Worked example.** A loan of $800 charges 2% interest per month, compounded, and nothing is paid. Amount owed after a year?
800 · 1.02¹² ≈ $1,014.58.

**Try it.** $600 at 4% a year, compounded annually. Balance after 3 years? Interest earned?
*Answers:* 600 · 1.04³ ≈ 674.92; $74.92.

## Different compounding intervals (5.17)

A nominal annual rate of 6% compounded monthly means 0.5% each month: twelve periods a year. After t years there are 12t periods:

**A(t) = P · (1 + 0.06/12)^(12t) = P · 1.005^(12t).**

For $1,000: after 1 year, 1,000 · 1.005¹² ≈ 1,061.68, slightly more than the 1,060 from annual compounding. The effective annual rate is about 6.17%.

| Compounding | Per-period rate | Periods per year | $1,000 after 1 year |
|---|---|---|---|
| Annually | 6% | 1 | 1,060.00 |
| Quarterly | 1.5% | 4 | 1,061.36 |
| Monthly | 0.5% | 12 | 1,061.68 |
| Daily | 6%/365 | 365 | 1,061.83 |

More frequent compounding earns a little more, but the gains shrink quickly.

**Worked example.** $3,000 at 4% a year compounded quarterly for 5 years: 3,000 · 1.01²⁰ ≈ $3,660.57.

**Try it.** $500 at 8% a year compounded monthly for 2 years.
*Answer:* 500 · (1 + 0.08/12)²⁴ ≈ $586.43.

## Expressed in different ways (5.18)

The same function can be written in several forms, and each exposes a different rate.

Monthly compounding at 0.5%: A(t) = 1,000 · 1.005^(12t), t in years. Since 1.005¹² ≈ 1.0617, this is also A(t) = 1,000 · 1.0617ᵗ: the yearly factor is 1.0617, an effective 6.17% a year. Both forms give the same values; the first shows the monthly rate, the second the yearly.

Going the other way: a population P(t) = 8,000 · 1.21ᵗ (t in years). Since 1.21 = 1.1², P(t) = 8,000 · 1.1^(2t): the population grows 10% every half-year.

A decay example: 500 · 0.64ᵗ = 500 · 0.8^(2t): 36% loss per year is 20% loss per half-year.

**Worked example.** Write 2,000 · 1.08ᵗ with t in years as a function of m months, and state the monthly rate.
1.08 = (1.08^(1/12))¹² ≈ 1.00643¹², so A(m) = 2,000 · 1.00643ᵐ: about 0.64% a month.

**Try it.** Rewrite 300 · 9ᵗ as a function with base 3. What is the growth per half-step?
*Answer:* 300 · 3^(2t); tripling every half unit.

## Common mistakes

- Adding a percentage back to undo a decrease; divide by the factor instead.
- Treating "10% up then 10% down" as no change.
- Using the annual rate as the monthly rate (6% a month instead of 0.5%).
- Forgetting to multiply the years by the periods per year in the exponent.
- Confusing simple interest (linear) with compound interest (exponential).
- Reading 1.21ᵗ as 21% per half-year; it is 21% per year and 10% per half-year.

## Where this goes next

Week 23 asks which of two functions changes faster, compares exponential growth over equal intervals, and models populations with exponential functions, finishing unit 5. Percent-change factors are used throughout unit 7's applications.

## Self-check

1. Increase 240 by 35%. Decrease 240 by 35%.
2. After a 15% discount a bag costs $51. Original price?
3. $1,500 at 4% compounded annually for 3 years. Balance?
4. $1,500 at 4% a year compounded monthly for 3 years. Balance?
5. Write 1,000 · 1.0404ᵗ (t in years) as a function with a half-year step, given 1.0404 = 1.02².

*Answers:* (1) 324; 156. (2) 60. (3) 1,500 · 1.04³ ≈ 1,687.30. (4) 1,500 · (1 + 0.04/12)³⁶ ≈ 1,690.91. (5) 1,000 · 1.02^(2t): 2% per half-year.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 5, Lessons 14–18, https://im.kendallhunt.com/HS/teachers/1/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
