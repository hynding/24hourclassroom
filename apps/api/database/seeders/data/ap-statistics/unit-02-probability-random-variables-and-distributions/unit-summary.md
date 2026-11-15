# Unit 2 · Probability, Random Variables, and Probability Distributions · The night-before sheet

**AP exam weight:** 15–25% of the multiple-choice section
**Topics:** 2.1 Tabular and Graphical Representations for the Distributions of Two Categorical Variables · 2.2 Summary Statistics for Two Categorical Variables · 2.3 Estimating Probabilities Using Simulation · 2.4 Introduction to Probability · 2.5 Mutually Exclusive Events · 2.6 Conditional Probability · 2.7 Independent Events and Unions of Events · 2.8 Introduction to Random Variables and Probability Distributions · 2.9 Parameters of Random Variables · 2.10 The Binomial Distribution · 2.11 The Normal Distribution · 2.12 Sampling Distributions and the Central Limit Theorem
**Practices:** 1 (Formulate Questions), 2 (Collect Data), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 2, Topics 2.1–2.12, in our own words

## The ideas that generate every question

1. **Two categorical variables live in a two-way table (2.1, 2.2).** Marginal distributions use the row or column totals; conditional distributions use one row or column. Association means the conditional distributions differ across groups; compare proportions, never raw counts. Segmented and side-by-side bar charts and mosaic plots show the comparison. An association in observational data is not evidence of cause and effect.
2. **Probability is long-run relative frequency (2.3, 2.4).** Simulation estimates a probability by repeating a chance process many times; more repetitions give a more reliable estimate (the law of large numbers), but short runs do not correct themselves. With equally likely outcomes, P(A) = (outcomes in A)/(total outcomes); always 0 ≤ P(A) ≤ 1 and P(Aᶜ) = 1 − P(A).
3. **"Or" and "and" have rules (2.5–2.7).** Mutually exclusive events cannot happen together: P(A or B) = P(A) + P(B). In general P(A or B) = P(A) + P(B) − P(A and B). P(A | B) = P(A and B)/P(B). A and B are independent when P(A | B) = P(A); then P(A and B) = P(A)P(B). Mutually exclusive events with positive probabilities are never independent.
4. **A random variable assigns a number to each outcome (2.8, 2.9).** A discrete probability distribution lists the values and probabilities (each between 0 and 1, summing to 1). Its mean μ_X = Σx·P(x) is a long-run average; its standard deviation σ_X = √(Σ(x − μ)²·P(x)) is the typical distance from that mean.
5. **The binomial distribution counts successes (2.10).** Binary outcomes, independent trials, fixed n, same p. P(X = k) = nCk pᵏ(1 − p)ⁿ⁻ᵏ; μ = np; σ = √(np(1 − p)). Check the 10% condition when sampling without replacement.
6. **The normal distribution models many continuous variables (2.11).** N(μ, σ) is symmetric and bell-shaped; 68–95–99.7; z = (x − μ)/σ; areas give proportions and percentiles give values. Use it only when the variable is approximately normal.
7. **Statistics vary from sample to sample, predictably (2.12).** p̂ has mean p and SD √(p(1 − p)/n), approximately normal when np ≥ 10 and n(1 − p) ≥ 10. x̄ has mean μ and SD σ/√n, normal when the population is normal and approximately normal for n ≥ 30 by the Central Limit Theorem. Larger n means less variability, not less bias.

## Key formulas and procedures

| Want | Do this |
|---|---|
| Marginal relative frequency | row or column total ÷ grand total |
| Conditional relative frequency | cell ÷ its own row (or column) total |
| Association in a two-way table | compare conditional proportions across groups |
| Simulation | assign digits to outcomes in the right proportions, define one trial, repeat many times, report the relative frequency |
| Complement | P(Aᶜ) = 1 − P(A); "at least one" = 1 − P(none) |
| General addition rule | P(A or B) = P(A) + P(B) − P(A and B) |
| Conditional probability | P(A \| B) = P(A and B)/P(B) |
| Multiplication rule | P(A and B) = P(A) · P(B \| A); = P(A) · P(B) when independent |
| Independence check | P(A \| B) = P(A), or P(A and B) = P(A)P(B) |
| Mean of a discrete X | Σ x · P(x) |
| SD of a discrete X | √(Σ (x − μ)² · P(x)) |
| Binomial | P(X = k) = nCk pᵏ(1 − p)ⁿ⁻ᵏ; μ = np; σ = √(np(1 − p)) |
| Normal area | z = (x − μ)/σ, then the area (normalcdf) |
| Normal percentile | z from the area (invNorm), then x = μ + zσ |
| Sample proportion | mean p; SD √(p(1 − p)/n) if n ≤ 10% of N; normal if np ≥ 10 and n(1 − p) ≥ 10 |
| Sample mean | mean μ; SD σ/√n if n ≤ 10% of N; normal if the population is normal or n ≥ 30 |

## Sentences that earn AP points

- **Association:** "In this sample, 64% of students who eat breakfast feel alert in first period, compared with 38% of those who skip it. Because these conditional proportions differ substantially, there is an association between breakfast and alertness for these students."
- **No causation:** "This was an observational survey with no random assignment of breakfast, so the association does not show that breakfast causes alertness."
- **Independence:** "P(car | grades 11–12) = 0.55 but P(car) = 0.425. Because these are not equal, grade group and travelling by car are not independent."
- **Mean of a random variable:** "If we observed many randomly chosen students, the number of absences per week would average about 0.76 in the long run."
- **SD of a random variable:** "The number of seeds that germinate in a batch of 20 typically varies by about 1.6 seeds from the mean of 17."
- **Binomial judgement:** "If the bus were on time 90% of the time, 10 or fewer on-time days out of 15 would happen with probability 0.013, so the record gives convincing evidence that the on-time rate is less than 90%."
- **z-score:** "A battery life of 20 hours is 0.625 standard deviations above the mean of 18.5 hours."
- **CLT:** "Although delivery times are skewed right, n = 40 ≥ 30, so by the Central Limit Theorem the sampling distribution of x̄ is approximately normal."

## Common mistakes

- Comparing counts instead of conditional proportions; swapping P(A | B) and P(B | A).
- Treating mutually exclusive as independent, or adding probabilities of events that overlap.
- Calling a mean a guaranteed or most likely value.
- Leaving nCk out of a binomial probability; taking 1 − P(X ≤ 8) for "at least 8".
- Using the variance where the SD is asked for (np(1 − p), p(1 − p)/n, σ²).
- Applying the empirical rule or a normal model to a skewed variable.
- Using σ instead of σ/√n for a sample mean; using the CLT for one individual or for small samples from skewed populations.
- Skipping the 10% and Large Counts checks.
- Bare calculator syntax with no distribution, parameters or context.

## Self-test

1. From the transport table of 400 students (car: 60 of 200 in grades 9–10, 110 of 200 in grades 11–12), find P(grades 11–12 | car).
2. P(A) = 0.5, P(B) = 0.3, P(A and B) = 0.15. Are A and B independent? Find P(A or B).
3. A $5 raffle ticket wins $500 (1 ticket), $100 (2) or $20 (5) out of 500 sold. Find the expected net gain.
4. X is binomial with n = 15, p = 0.08. Find the mean, SD and P(X = 0).
5. Bags of trail mix are N(255, 6) grams. Find P(one bag < 250) and P(mean of 4 bags < 250).
6. p = 0.55, n = 150. Find P(p̂ < 0.50).

**Answers.** 1. 110/170 = 0.647. 2. Yes (0.5 × 0.3 = 0.15); 0.65. 3. −$3.40. 4. 1.2, 1.05, 0.286. 5. 0.202 and 0.048. 6. SD = 0.0406, z = −1.23, probability 0.109.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 2, Topics 2.1–2.12). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
