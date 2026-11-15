# Unit 3 · Inference for Categorical Data: Proportions · The night-before sheet

**AP exam weight:** 15–25% of the multiple-choice section
**Topics:** 3.1 Estimators · 3.2 Sampling Distributions for Sample Proportions · 3.3 Constructing a Confidence Interval for a Population Proportion · 3.4 Justifying a Claim Based on a Confidence Interval for a Population Proportion · 3.5 Setting Up a Test for a Population Proportion · 3.6 p-Values · 3.7 Carrying Out a Test for a Population Proportion · 3.8 Potential Errors When Performing Tests · 3.9 Sampling Distributions for the Difference Between Sample Proportions · 3.10 Constructing a Confidence Interval for the Difference Between Two Population Proportions · 3.11 Justifying a Claim Based on a Confidence Interval for the Difference Between Two Population Proportions · 3.12 Setting Up a Test for the Difference Between Two Population Proportions · 3.13 Carrying Out a Test for the Difference Between Two Population Proportions · 3.14 Setting Up a Chi-Square Test for Homogeneity or Independence · 3.15 Carrying Out a Chi-Square Test for Homogeneity or Independence
**Practices:** 1 (Formulate Questions), 2 (Collect Data), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 3, Topics 3.1–3.15, in our own words

## The ideas that generate every question

1. **Statistics estimate parameters, and they vary (3.1).** A good estimator is unbiased (its sampling distribution is centered at the parameter) and has low variability (larger samples shrink the spread). Bias comes from the method, not the sample size.
2. **p̂ has a predictable sampling distribution (3.2).** Mean p, SD √(p(1 − p)/n) when n ≤ 10% of the population, approximately normal when np ≥ 10 and n(1 − p) ≥ 10.
3. **A confidence interval is estimate ± margin of error (3.3, 3.10).** The margin of error z* · SE accounts for sampling variability only, shrinks like 1/√n and grows with the confidence level.
4. **An interval is a list of plausible values (3.4, 3.11).** A claimed value inside is plausible; outside is not. For p₁ − p₂, the key value is 0.
5. **A test asks whether chance alone explains the data (3.5–3.7, 3.12–3.13).** Assume H₀, measure how far the statistic is from what H₀ predicts, and find the p-value: the probability, under H₀, of a result at least as extreme.
6. **Decisions can be wrong (3.8).** Type I: reject a true H₀ (probability α). Type II: fail to reject a false H₀. Power = 1 − P(Type II) rises with n, α and the distance between the truth and H₀.
7. **Two groups double everything (3.9–3.13).** The parameter is p₁ − p₂; intervals use the separate p̂'s; tests pool them because H₀ says p₁ = p₂.
8. **Chi-square tests handle whole two-way tables (3.14–3.15).** Homogeneity (several samples, one variable) or independence (one sample, two variables); χ² measures the total disagreement between observed and expected counts.

## Procedures and formulas

| Procedure | Statistic or interval | Conditions |
|---|---|---|
| One-sample z-interval for p | p̂ ± z* √(p̂(1 − p̂)/n) | Random; n ≤ 10% of population; np̂ ≥ 10 and n(1 − p̂) ≥ 10 |
| One-sample z-test for p | z = (p̂ − p₀)/√(p₀(1 − p₀)/n) | Random; 10%; np₀ ≥ 10 and n(1 − p₀) ≥ 10 |
| Two-sample z-interval for p₁ − p₂ | (p̂₁ − p̂₂) ± z* √(p̂₁(1 − p̂₁)/n₁ + p̂₂(1 − p̂₂)/n₂) | Random (two samples or random assignment); 10% for each sample; four counts ≥ 10 |
| Two-sample z-test for p₁ − p₂ | z = (p̂₁ − p̂₂)/√(p̂_c(1 − p̂_c)(1/n₁ + 1/n₂)), p̂_c = (x₁ + x₂)/(n₁ + n₂) | Random; 10%; n₁p̂_c, n₁(1 − p̂_c), n₂p̂_c, n₂(1 − p̂_c) ≥ 10 |
| Chi-square test (homogeneity or independence) | χ² = Σ (O − E)²/E, E = (row total)(column total)/(table total), df = (r − 1)(c − 1) | Random; 10%; every expected count ≥ 5 |

| Other facts | Value |
|---|---|
| z* for 90%, 95%, 99% | 1.645, 1.960, 2.576 |
| Sample size for margin of error m | n ≥ (z*/m)² p*(1 − p*); use p* = 0.5 if no guess; round up |
| SD of p̂₁ − p̂₂ | √(p₁(1 − p₁)/n₁ + p₂(1 − p₂)/n₂), mean p₁ − p₂ |
| p-value | one tail for a one-sided Hₐ; double the tail for ≠; always the upper tail for χ² |
| 2 × 2 table | χ² = z² for the two-sided two-sample z-test |

## Sentences that earn AP points

- **Parameter:** "p = the proportion of all students in the district who ate breakfast every day last week." For two groups, define both and state the order.
- **Interval:** "We are 95% confident that the interval from 0.323 to 0.417 captures the true proportion of all students in the district who …"
- **Confidence level:** "If we took many random samples of this size and built a 95% interval from each, about 95% of the intervals would capture the true proportion."
- **Claim from an interval:** "Because every value in the interval is positive, there is convincing evidence that p₁ > p₂." / "Because 0 is in the interval, we do not have convincing evidence of a difference."
- **p-value:** "Assuming 40% of all students eat breakfast daily (p = 0.40), there is a 0.110 probability of getting a sample proportion of 0.37 or less by chance alone."
- **Conclusion:** "Because the p-value of 0.034 < α = 0.05, we reject H₀. There is convincing evidence that the pass rates differ for students like these." / "Because 0.110 > 0.05, we fail to reject H₀. There is not convincing evidence that fewer than 40% …"
- **Chi-square:** "There is convincing evidence of an association between plan type and main device among all the service's customers." Follow up with the largest contribution: "More premium customers watch on a computer than independence would predict (52 observed, 36 expected)."
- **Errors:** "A Type I error would be concluding that tutoring changes the pass rate when it actually does not; a Type II error would be missing a real difference."
- **Scope:** random sampling → generalise to the population; random assignment → cause and effect, for subjects like these.

## Classic question types

**"Construct and interpret an interval."** Four steps: State (procedure, parameter, level), Plan (all conditions in context), Do (estimate, SE, interval), Conclude (interpretation). A calculator result with no procedure name and no inputs earns little.

**"Does the interval support the claim?"** Locate the claimed value (or 0) relative to the whole interval. Inside: plausible. Outside: not plausible. For a size claim, every plausible value must satisfy it.

**"Carry out a test."** Hypotheses about parameters, conditions (p₀ or p̂_c for Large Counts), test statistic, p-value, comparison with α, conclusion in context. Choose the alternative from the question, not from the data.

**"Which error, and what consequence?"** Reject → only Type I possible; fail to reject → only Type II. Describe both in context, and pick a smaller α when a Type I error is the more serious one.

**"Which chi-square test?"** Ask how the data were collected. Then expected counts ≥ 5, χ², df, upper-tail p-value, conclusion, follow-up.

## Common mistakes

- Hypotheses or conclusions about p̂ instead of p.
- Using p̂ in a one-sample test's SD (use p₀), or separate p̂'s in a two-sample test's SD (pool).
- Checking Large Counts with only the successes, with n ≥ 30, or (for χ²) with observed counts.
- Applying the 10% condition to a randomized experiment.
- Adding SDs instead of adding p(1 − p)/n terms under one square root.
- "95% probability the parameter is in the interval"; "the p-value is the probability H₀ is true".
- "Accepting" H₀, or saying an interval containing 0 proves equality.
- One-sided p-value for a two-sided alternative; df = cells − 1 in a two-way table.
- Causal language from random samples; generalising an experiment on volunteers to everyone.
- Teaching yourself a test this course does not use: the chi-square goodness-of-fit test is not part of the redesigned course.

## Self-test

1. p = 0.30, n = 200. Find the mean and SD of p̂, and P(p̂ ≥ 0.35).
2. How large a sample gives a 95% margin of error of at most 0.03 with no prior estimate?
3. A 95% interval for p_A − p_B is (−0.02, 0.09). Is there convincing evidence of a difference?
4. 99 of 150 tutored and 81 of 150 video-only students pass. Find p̂_c, z and the two-sided p-value.
5. Which error is possible after failing to reject H₀?
6. A 3 × 3 table has χ² = 18.85. Find df and the p-value.

**Answers.** 1. Mean 0.30, SD ≈ 0.0324, z ≈ 1.54, P ≈ 0.061. 2. (1.96/0.03)² · 0.25 ≈ 1,067.1, so 1,068. 3. No: 0 is plausible. 4. p̂_c = 0.60, z ≈ 2.12, p ≈ 0.034. 5. Type II. 6. df = 4, p ≈ 0.0008.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 3, Topics 3.1–3.15). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
