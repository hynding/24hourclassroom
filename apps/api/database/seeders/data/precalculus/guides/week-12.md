# Week 12 · Exponential Models and Choosing Between Models

**Topics:** 2.5 Exponential Function Context and Data Modeling · 2.6 Competing Function Model Validation
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 2, Topics 2.5–2.6, learning objectives in our own words
**Spiral:** Week 10's table tests (constant differences versus constant ratios) and week 11's rewrites (half-lives as (1/2)^(t/h), annual and monthly factors, e^(kt)) are the raw material of every model this week. Week 9 introduced residuals and model assumptions for polynomial and rational models; week 2's second differences identify quadratics. From Algebra 2: percent increase and decrease.

## What you need to be able to do

- **2.5** Build an exponential model from a verbal description: an initial value and a percent rate of growth or decay, a doubling time, a half-life, or a growth factor over some other period.
- **2.5** Use the compound interest formula A = P(1 + r/n)^(nt) and the continuous growth formula A = Pe^(rt), and interpret every parameter in context.
- **2.5** Build an exponential model from two data points or describe how an exponential regression produces one from a data set, and use the model to predict, with units.
- **2.6** Decide whether a linear, quadratic or exponential model suits a data set, using differences, ratios and the context.
- **2.6** Compute and interpret residuals (actual − predicted), and use a residual plot to judge whether a model is appropriate.
- **2.6** Explain the limits of a model: where its predictions are reasonable and why extrapolating far beyond the data is risky.

## Key terms

| Term | Meaning |
|---|---|
| Growth rate r | The percent change per time unit, as a decimal; the growth factor is 1 + r. A decay rate of 15% gives the factor 0.85. |
| Doubling time | The time for an increasing exponential quantity to double; Q(t) = Q₀ · 2^(t/d). |
| Half-life | The time for a decaying quantity to halve; Q(t) = Q₀ · (1/2)^(t/h). |
| Compound interest | Interest added n times per year at annual rate r: A = P(1 + r/n)^(nt). |
| Continuous growth | The limit of compounding infinitely often: A = Pe^(rt). |
| Exponential regression | A calculator procedure that finds the exponential function y = a · bˣ best fitting a data set. |
| Residual | Actual value − predicted value. Positive: the model underestimates. Negative: it overestimates. |
| Residual plot | A graph of residuals against the input. A good model gives small residuals with no pattern. |

## Exponential models from words (2.5)

Every exponential model has the shape **initial value × (factor per period)^(number of periods)**. The work is translating the words into the factor and the period.

| Description (hypothetical) | Model |
|---|---|
| 2,000 users, growing 8% per month, t months | U(t) = 2000(1.08)ᵗ |
| A car worth $24,000 losing 15% of its value per year, t years | V(t) = 24000(0.85)ᵗ |
| 30 cells doubling every 6 hours, t hours | C(t) = 30 · 2^(t/6) |
| 200 g of an isotope with a 30-year half-life, t years | M(t) = 200(1/2)^(t/30) |
| A population tripling every 4 years, t years | P(t) = P₀ · 3^(t/4) |

**Worked example (hypothetical).** For the isotope above, how much remains after 75 years, and what is the yearly decay factor?

75 years is 75/30 = 2.5 half-lives, so M(75) = 200(1/2)^2.5 ≈ 35.36 g. The yearly factor is (1/2)^(1/30) ≈ 0.9772, so about 2.28% decays each year.

**Worked example (hypothetical).** The car above: what is it worth after 3 years, and by how much did it lose value in the third year?

V(3) = 24000(0.85)³ = 24000 · 0.614125 = $14,739. V(2) = 24000 · 0.7225 = $17,340, so it lost $2,601 in year 3 — less than the $3,600 it lost in year 1, because 15% of a smaller value is a smaller amount.

## Compound and continuous interest (2.5)

If an annual interest rate r is paid in n equal instalments per year, each instalment multiplies the balance by 1 + r/n, and there are nt instalments in t years:

**A = P(1 + r/n)^(nt).**

As n grows (yearly, monthly, daily, …) the balance increases, but it levels off at a limit:

**A = Pe^(rt)** (continuous compounding).

**Worked example (hypothetical account).** $5,000 is deposited at 4% annual interest for 10 years. Compare annual, monthly and continuous compounding.

| Compounding | Formula | Balance after 10 years |
|---|---|---|
| Annually | 5000(1.04)¹⁰ | $7,401.22 |
| Monthly | 5000(1 + 0.04/12)¹²⁰ | $7,454.16 |
| Continuously | 5000e^0.4 | $7,459.12 |

The jump from annual to monthly is about $53; the jump from monthly to continuous is only about $5. The extra growth from more frequent compounding is real but limited.

**Effective annual rate.** Monthly compounding at 6% gives (1 + 0.06/12)¹² ≈ 1.0617, so the balance actually grows by about 6.17% per year.

**Try it.**
1. Write a model for a hypothetical lake's fish population: 1,500 fish, decreasing 4% per year.
2. A hypothetical sample has a half-life of 5 days and starts at 64 mg. How much remains after 20 days?
3. $800 is invested at 3% compounded quarterly. Write the balance after t years.

*Answers:* 1. F(t) = 1500(0.96)ᵗ. 2. 20 days is 4 half-lives: 64/16 = 4 mg. 3. A(t) = 800(1 + 0.03/4)^(4t) = 800(1.0075)^(4t).

## Models from data (2.5)

**From two points.** As in week 10, divide the outputs to find the factor. A hypothetical town's population was 1,800 in year 2 and 1,200 in year 5. Then b³ = 1200/1800 = 2/3, so b = (2/3)^(1/3) ≈ 0.8736, and a = 1800/b² ≈ 2359. The model P(t) ≈ 2359(0.8736)ᵗ loses about 12.6% per year. Without a calculator you can still predict year 8: three more years multiply by 2/3 again, so P(8) = 1200 · 2/3 = 800.

**From many points: exponential regression.** With a data set, a graphing calculator's exponential regression (often labelled ExpReg) returns a and b for y = a · bˣ. It works by fitting a line to the logarithms of the outputs (week 17 explains why), so every output must be positive. You should be able to read and use the result: a is the predicted initial value, b is the growth factor per unit of input, and b − 1 is the growth rate.

## Choosing between models (2.6)

Three questions decide between linear, quadratic and exponential:

1. **What does the context suggest?** Constant amount per period → linear. Constant percent per period → exponential. Something that rises and then falls, or area and projectile height → quadratic.
2. **What do the data suggest?** With equally spaced inputs: roughly constant differences → linear; roughly constant second differences → quadratic; roughly constant ratios → exponential.
3. **What do the residuals say?** Compute residual = actual − predicted for each data point. Good models leave small residuals scattered above and below 0 with no pattern. A curved pattern (for example, positive, then negative, then positive) means the model has the wrong shape.

**Worked example (hypothetical data).** The area covered by an invasive plant in a hypothetical pond is recorded weekly.

| t (weeks) | 0 | 1 | 2 | 3 | 4 | 5 |
|---|---|---|---|---|---|---|
| Area (m²) | 50 | 61 | 74 | 91 | 111 | 135 |

Differences: 11, 13, 17, 20, 24 — growing, so not linear. Ratios: 1.22, 1.21, 1.23, 1.22, 1.22 — nearly constant, so exponential is plausible. Two candidate models:

L(t) = 42 + 17t  and  E(t) = 50(1.22)ᵗ.

| t | 0 | 1 | 2 | 3 | 4 | 5 |
|---|---|---|---|---|---|---|
| Residual for L | 8 | 2 | −2 | −2 | 1 | 8 |
| Residual for E | 0 | 0 | −0.42 | 0.21 | 0.23 | −0.14 |

The linear residuals form a U-shape: L overshoots in the middle and undershoots at both ends, the sign of a model that is too straight for curved data. The exponential residuals are tiny and patternless. E is the better model, and its factor 1.22 says the area grows about 22% per week.

**Validity.** E(10) ≈ 365 m² is a reasonable short-term prediction. E(52) ≈ 1.5 million m² is not: the pond has a finite area, so growth must slow. Exponential models describe unrestricted growth and usually fail eventually; say so when you extrapolate.

**Error.** The size of a residual is the error of a prediction. Compare models by the sizes of their residuals, and judge an error relative to the size of the data: an error of 8 m² is about 6% of 135 m² but 16% of 50 m².

**Try it.**
1. A model predicts 240 and the actual value is 228. What is the residual, and did the model over- or underestimate?
2. Residuals for a model are −5, −1, 2, 3, 2, −1, −4. Is the model appropriate? Why?
3. Which kind of model suits "a hypothetical tutoring service charges a $30 sign-up fee plus $25 per session"?

*Answers:* 1. 228 − 240 = −12; it overestimated. 2. No: the residuals form an arch (negative, positive, negative), a pattern showing the wrong shape. 3. Linear: a constant $25 per session.

## Calculator notes

On a graphing calculator, enter inputs in one list and outputs in another, then run linear, quadratic and exponential regression and store each equation. Most calculators can plot residuals directly (the RESID list). The AP exam expects you to interpret regression output and residuals, not to recall keystrokes; in calculator-active questions report values to three decimal places unless told otherwise. On no-calculator items, use exact factors: halving, doubling, factors like 2/3, or powers you can compute by hand.

## Common mistakes

- **Using the rate instead of the factor.** 15% decay means multiplying by 0.85, not by 0.15 or 1.15.
- **Using the wrong number of periods.** For a 30-year half-life after 75 years, the exponent is 75/30 = 2.5, not 75.
- **Forgetting nt in compound interest.** Monthly compounding for 10 years means 120 periods at rate r/12.
- **Residual sign backwards.** Residual = actual − predicted. A negative residual means the model predicted too high.
- **Judging a model by its biggest residual alone.** Look for a pattern; small patterned residuals still say "wrong shape".
- **Extrapolating without comment.** A model fitted to weeks 0–5 says little about week 52.

## Where this goes next

Week 13 builds new functions from old ones with composition and inverses. Logarithms (weeks 14–16) are the inverses of exponential functions: they will let you solve 5000e^(0.04t) = 10000 for the doubling time, and week 17 uses semi-log plots to show why exponential data become linear after taking logarithms.

## Self-check

1. Write a model for a hypothetical investment of $3,000 growing 5% per year, compounded monthly, and find its effective annual growth rate.
2. A hypothetical isotope has a half-life of 12 hours. What fraction remains after 2 days?
3. Explain why a U-shaped residual plot suggests a linear model is not appropriate.
4. A hypothetical bacteria count was 500 at hour 1 and 4,500 at hour 3. Find an exponential model and predict hour 4.
5. Give one reason an exponential model of a city's population might fail after many years.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 2, Topics 2.5–2.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
