# Week 28 · Significance Tests for the Difference Between Two Population Means

**Topics:** 4.9 Setting Up a Test for the Difference Between Two Population Means · 4.10 Carrying Out a Test for the Difference Between Two Population Means
**Practices:** 1 (Formulate Questions), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 4, Topics 4.9–4.10, learning objectives in our own words
**Spiral:** Week 26 gave the sampling distribution of x̄₁ − x̄₂ and its standard error; week 27 built two-sample t-intervals. Week 25 carried out one-sample and paired t-tests, and weeks 21 and 18 did the same for two proportions and covered Type I and Type II errors. This week finishes Unit 4 with the two-sample t-test for μ₁ − μ₂, and with the decision every Unit 4 problem starts with: paired or two-sample?

## What you need to be able to do

- **4.9** Identify a two-sample t-test for μ₁ − μ₂ as the right procedure, and distinguish it from a paired t-test.
- **4.9** Define μ₁ and μ₂ in context and write H₀: μ₁ − μ₂ = 0 with a one- or two-sided Hₐ that matches the question.
- **4.9** Check the Random, 10% and Normal / large sample conditions for both groups.
- **4.10** Compute t = (x̄₁ − x̄₂ − 0)/√(s₁²/n₁ + s₂²/n₂), the df (calculator or conservative, named) and the p-value.
- **4.10** Interpret the p-value, compare it with α, and state the conclusion in context with "convincing evidence" language and the right scope.
- **4.10** Describe Type I and Type II errors and the effect of sample size on power in a two-sample setting, and connect the test to a confidence interval.

## Key terms

| Term | Meaning |
|---|---|
| Two-sample t-test for μ₁ − μ₂ | A test of H₀: μ₁ − μ₂ = 0 using two independent random samples or two randomly assigned groups. |
| Test statistic | t = ((x̄₁ − x̄₂) − 0) / √(s₁²/n₁ + s₂²/n₂): how many standard errors the observed difference is from 0. |
| p-value | Assuming H₀ is true, the probability of a difference in sample means at least as extreme as the one observed, in the direction of Hₐ. |
| Significance level α | The cut-off chosen in advance; reject H₀ when p-value < α. |
| Type I error | Rejecting H₀ when the means are really equal. |
| Type II error | Failing to reject H₀ when the means really differ. |
| Power | The probability of correctly rejecting H₀ when a particular difference is true. |

## Setting up the test (4.9)

A two-sample t-test answers a question of the form "Is the mean of one population (or treatment) different from, greater than or less than the mean of another?"

**Parameters.** Define both in context: "μ₁ = the true mean ___ for all ___; μ₂ = the true mean ___ for all ___." In an experiment, the parameters are the true mean responses under each treatment.

**Hypotheses.** H₀: μ₁ − μ₂ = 0 (equivalently μ₁ = μ₂). Hₐ is one of μ₁ − μ₂ > 0, μ₁ − μ₂ < 0 or μ₁ − μ₂ ≠ 0, chosen from the question **before** looking at the data. Hypotheses are always about parameters (μ), never statistics (x̄).

**Worked example 1 (writing hypotheses).**

1. *"Do students who eat breakfast have a higher mean quiz score than those who skip it?"* μ_B = true mean score of breakfast eaters, μ_S = that of skippers. H₀: μ_B − μ_S = 0; Hₐ: μ_B − μ_S > 0.
2. *"Is the mean delivery time different for the two pizza shops?"* H₀: μ_A − μ_B = 0; Hₐ: μ_A − μ_B ≠ 0.
3. *"Does a new bus route shorten the mean ride?"* H₀: μ_new − μ_old = 0; Hₐ: μ_new − μ_old < 0.

**Conditions.** The same three as week 27, checked for both groups:

- *Random:* two independent random samples, or random assignment to two treatments.
- *10%:* each sample ≤ 10% of its population (sampling without replacement only).
- *Normal / large sample:* each n ≥ 30, or the small sample's graph shows no strong skew and no outliers.

## Carrying out the test (4.10)

**Do.** t = (x̄₁ − x̄₂ − 0)/√(s₁²/n₁ + s₂²/n₂). Find the p-value from a t distribution with the calculator's unpooled df (2-SampTTest, Pooled: No) or the conservative df = smaller n − 1. The conservative df gives a slightly larger p-value, so it never makes a result look stronger than it is. Say which one you used.

**Conclude.** Compare the p-value with α, decide, and state the conclusion about the parameters in context: "Because p-value = ___ < α = ___, we reject H₀. There is convincing evidence that the true mean ___ is greater for ___ than for ___." If p-value > α: "we fail to reject H₀. There is not convincing evidence that ..." Never "accept H₀".

**Worked example 2 (an experiment, one-sided).** Sixty student volunteers are randomly assigned, 30 to study a vocabulary list in silence and 30 to study while listening to music with lyrics. Each then takes the same 100-point vocabulary test. Hypothetical results: silence x̄ = 76.2, s = 9.6; music x̄ = 71.4, s = 10.8. At α = 0.05, is there convincing evidence that studying in silence leads to a higher mean score?

- *State:* two-sample t-test for μ_S − μ_M, where μ_S = the true mean score for students like these who study in silence and μ_M = the true mean score for those who study with music. H₀: μ_S − μ_M = 0; Hₐ: μ_S − μ_M > 0; α = 0.05.
- *Plan:* Random: the volunteers were randomly assigned to the two conditions. 10%: not needed (no sampling from a population). Normal: 30 ≥ 30 in each group.
- *Do:* SE = √(9.6²/30 + 10.8²/30) ≈ 2.638. t = (76.2 − 71.4)/2.638 ≈ 1.82. Calculator df ≈ 57.2, p-value ≈ 0.037. (Conservative df = 29: p-value ≈ 0.040.)
- *Conclude:* because p-value ≈ 0.037 < α = 0.05, we reject H₀. There is convincing evidence that studying in silence produces a higher mean vocabulary score than studying with music, for students like these volunteers. Random assignment supports a cause-and-effect conclusion; the volunteers were not a random sample, so we should not generalise to all students.

*Interpreting the p-value:* assuming studying condition has no effect on the mean score (μ_S − μ_M = 0), there is about a 0.037 probability of getting a difference in sample means of 4.8 points or more in favour of silence by chance alone, from the random assignment.

**Worked example 3 (small random samples, raw data).** A student suspects Shop B delivers faster than Shop A. She takes random samples of past orders from each shop's records (thousands of orders each): delivery times in minutes.

| Shop | Times (minutes) |
|---|---|
| A | 38, 42, 35, 47, 40, 44, 39, 51, 36, 43, 41, 45 |
| B | 34, 37, 31, 40, 36, 33, 39, 35, 30, 38, 36, 42, 32, 35 |

Summary: A x̄ = 41.75, s = 4.615, n = 12; B x̄ = 35.57, s = 3.458, n = 14.

- H₀: μ_A − μ_B = 0; Hₐ: μ_A − μ_B > 0, where μ_A and μ_B are the true mean delivery times of all orders from each shop. α = 0.05.
- Conditions: random samples from each shop's orders; 12 and 14 are far below 10% of thousands; both samples are small, but dotplots show no strong skew and no outliers (fences 30.5–52.5 minutes for A and 26.5–44.5 for B contain every value).
- t = (41.75 − 35.57)/√(4.615²/12 + 3.458²/14) = 6.18/1.621 ≈ 3.81. Calculator df ≈ 20.2, p-value ≈ 0.0005 (conservative df = 11: p ≈ 0.0014).
- Because p-value ≈ 0.0005 < 0.05, reject H₀. There is convincing evidence that Shop B's mean delivery time is shorter than Shop A's, for all orders from these shops.

**Worked example 4 (a two-sided test that fails to reject).** Random samples of 45 students in a rural district and 50 in an urban district report weekly minutes of reading for pleasure: rural x̄ = 148, s = 62; urban x̄ = 126, s = 71. Is there a difference in means at α = 0.05?

- H₀: μ_R − μ_U = 0; Hₐ: μ_R − μ_U ≠ 0. Conditions: independent random samples, each far below 10% of its district, both n ≥ 30.
- SE ≈ 13.65, t ≈ 1.61, calculator df ≈ 92.9, two-sided p-value ≈ 0.110 (conservative df = 44: 0.114).
- Because 0.110 > 0.05, we fail to reject H₀. There is not convincing evidence that the mean weekly reading time differs between the two districts. This is not evidence that the means are equal.
- *Link to an interval:* the 95% two-sample t-interval is (−5.1, 49.1) minutes. It contains 0, matching the two-sided test's decision at α = 0.05.

## Errors and power in a two-sample test

In worked example 2:

- A **Type I error** would be concluding that silence raises the mean score when, in truth, study condition makes no difference. Its probability is α = 0.05.
- A **Type II error** would be failing to find convincing evidence when silence really does raise the mean score.

Power rises with larger samples in both groups, a larger true difference, less variable responses and a larger α. Because we rejected H₀, the only error we could have made in worked example 2 is a Type I error; in worked example 4, where we failed to reject, only a Type II error is possible.

## Paired or two-sample? Getting it right matters

**Worked example 5.** Eight students take a timed math quiz once with a basic calculator and once with a graphing calculator (order randomised). Scores:

| Student | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 |
|---|---|---|---|---|---|---|---|---|
| Basic | 68 | 74 | 59 | 81 | 65 | 77 | 70 | 62 |
| Graphing | 71 | 78 | 61 | 84 | 66 | 81 | 72 | 66 |

Every student scored higher with the graphing calculator; the differences (graphing − basic) are 3, 4, 2, 3, 1, 4, 2, 4, with x̄_d = 2.875 and s_d = 1.126.

- **Correct (paired t-test):** t = 2.875/(1.126/√8) ≈ 7.22, df = 7, two-sided p-value ≈ 0.0002. Very strong evidence of a difference.
- **Wrong (two-sample t-test):** t ≈ 0.74, p-value ≈ 0.47. The large student-to-student spread (s ≈ 7.5 and 8.1) swamps the consistent 3-point gain.

The design decides the procedure: the same students were measured twice, so the data are paired. Use a two-sample test only when the groups contain different, unlinked individuals.

## Common mistakes

- **Hypotheses with x̄₁ and x̄₂,** or choosing the direction of Hₐ after seeing the data.
- **Undefined parameters** or no order of subtraction.
- **Treating paired data as two samples** (or two independent samples as paired).
- **Forgetting to name the df,** or using the pooled option.
- **Doubling or halving the p-value wrongly:** a one-sided Hₐ uses one tail.
- **"Accepting H₀",** or "the p-value is the probability that H₀ is true".
- **Claiming cause and effect from random samples,** or generalising an experiment on volunteers to a population.

## Self-check

1. A study compares mean nightly sleep for random samples of athletes and non-athletes, asking whether athletes sleep more. Write the hypotheses.
2. In question 1, the samples have 25 and 40 students. What must be checked for the athletes?
3. x̄₁ − x̄₂ = 3.2 and SE = 1.6. What is t?
4. With conservative df = 24 and a two-sided Hₐ, is t = 2.0 significant at α = 0.05?
5. A test gives p-value = 0.21. Write the decision and conclusion template.
6. Which error is possible after rejecting H₀?

*Answers:* 1. H₀: μ_A − μ_N = 0; Hₐ: μ_A − μ_N > 0, with μ_A, μ_N the true mean nightly sleep of all athletes and all non-athletes. 2. A graph of the 25 athletes' data with no strong skew or outliers (or a normal population). 3. 2.0. 4. No: the two-sided p-value with df = 24 is about 0.057 > 0.05. 5. "Because 0.21 > α, we fail to reject H₀; there is not convincing evidence that ...". 6. A Type I error.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 4, Topics 4.9–4.10). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
