# Week 21 · Testing a Difference Between Two Proportions

**Topics:** 3.12 Setting Up a Test for the Difference Between Two Population Proportions · 3.13 Carrying Out a Test for the Difference Between Two Population Proportions
**Practices:** 1 (Formulate Questions), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 3, Topics 3.12–3.13, learning objectives in our own words
**Spiral:** Weeks 17 and 18 built the one-sample z-test for p: hypotheses about a parameter, a test statistic computed assuming H₀, a p-value, a decision and the errors that decision can make. Weeks 19 and 20 compared two proportions with an interval. This week compares two proportions with a test, the two-sample z-test for p₁ − p₂, and connects its result to the interval.

## What you need to be able to do

- **3.12** Recognise when a two-sample z-test for p₁ − p₂ is appropriate and write its hypotheses about the population (or true treatment) proportions.
- **3.12** Explain why the test uses a pooled (combined) sample proportion p̂_c, and check the Random, 10% and Large Counts conditions with it.
- **3.13** Compute the test statistic and the p-value for one-sided and two-sided alternatives.
- **3.13** Interpret the p-value, make a decision at a stated α, and write the conclusion in context with "convincing evidence" language.
- **3.13** Describe Type I and Type II errors in the context of a two-proportion test, and link a two-sided test to a confidence interval.

## Key terms

| Term | Meaning |
|---|---|
| Two-sample z-test for p₁ − p₂ | A significance test of H₀: p₁ − p₂ = 0 (equivalently p₁ = p₂) using two independent random samples or two randomly assigned groups. |
| Pooled proportion p̂_c | (x₁ + x₂)/(n₁ + n₂): all successes over all observations; the estimate of the common proportion if H₀ is true. |
| Test statistic | z = (p̂₁ − p̂₂ − 0) / √(p̂_c(1 − p̂_c)(1/n₁ + 1/n₂)). |
| One-sided alternative | Hₐ: p₁ − p₂ > 0 or Hₐ: p₁ − p₂ < 0; the p-value is one tail. |
| Two-sided alternative | Hₐ: p₁ − p₂ ≠ 0; the p-value is both tails, twice the one-tail area. |
| Large Counts (test) | n₁p̂_c, n₁(1 − p̂_c), n₂p̂_c and n₂(1 − p̂_c) all at least 10. |

## Setting up the test (3.12)

**When.** A categorical response (success or failure), two independent random samples or two treatment groups formed by random assignment, and a question of the form "is there a difference?" or "is one larger?".

**Parameters and hypotheses.** Define p₁ and p₂ in context and fix the order. The null hypothesis always says there is no difference:

- H₀: p₁ − p₂ = 0 (you may also write p₁ = p₂)
- Hₐ: p₁ − p₂ > 0, < 0, or ≠ 0, chosen from the research question *before* looking at the data.

**Why pool?** The test statistic is computed *assuming H₀ is true*. If p₁ = p₂, the two samples estimate the same proportion, so the best estimate of it combines them: p̂_c = (x₁ + x₂)/(n₁ + n₂). That common value goes into the standard deviation. (An interval makes no such assumption, which is why the week 19 interval uses p̂₁ and p̂₂ separately.)

**Conditions, each in context.**

- **Random:** two independent random samples, or random assignment to two treatments.
- **10%:** when sampling without replacement, each sample is at most 10% of its population. Not needed for random assignment.
- **Large Counts:** n₁p̂_c, n₁(1 − p̂_c), n₂p̂_c, n₂(1 − p̂_c) are all at least 10. (Some teachers accept the observed successes and failures; using p̂_c matches the assumption that H₀ is true.)

## Carrying out the test (3.13)

**Test statistic.** z = (p̂₁ − p̂₂) / √(p̂_c(1 − p̂_c)(1/n₁ + 1/n₂)). It counts how many standard deviations the observed difference lies from 0, the difference H₀ predicts.

**p-value.** For Hₐ: p₁ − p₂ > 0, P(Z ≥ z); for < 0, P(Z ≤ z); for ≠ 0, 2 · P(Z ≥ |z|).

**Decision and conclusion.** Compare the p-value with α. If p-value < α, reject H₀: there is convincing evidence for Hₐ. If not, fail to reject H₀: there is not convincing evidence for Hₐ. Never "accept H₀".

**Worked example 1 (a one-sided test from an experiment).** A hypothetical high school wants to know whether weekly practice quizzes raise the proportion of students who pass a unit test. It randomly assigns 240 volunteer students: 120 take practice quizzes and 120 study as usual. 54 of the quiz group and 39 of the usual group pass. Use α = 0.05.

- **State.** p_Q and p_U are the true proportions of students like these who would pass the unit test with practice quizzes and with usual study. H₀: p_Q − p_U = 0; Hₐ: p_Q − p_U > 0. α = 0.05.
- **Plan.** Two-sample z-test for p_Q − p_U. Random: students were randomly assigned to the treatments. 10%: not needed. Pooled proportion p̂_c = (54 + 39)/240 = 93/240 = 0.3875. Large Counts: 120(0.3875) = 46.5 and 120(0.6125) = 73.5 for each group, all at least 10.
- **Do.** p̂_Q = 0.450, p̂_U = 0.325, difference 0.125. SD = √(0.3875 · 0.6125 · (1/120 + 1/120)) ≈ 0.0629. z = 0.125/0.0629 ≈ 1.99. p-value = P(Z ≥ 1.99) ≈ 0.023.
- **Conclude.** Because the p-value 0.023 < α = 0.05, we reject H₀. There is convincing evidence that practice quizzes increase the proportion of students like these who pass the unit test. Random assignment allows a cause-and-effect conclusion; the volunteers were not a random sample, so it applies to students like them.
- **Interpret the p-value.** Assuming practice quizzes make no difference (p_Q = p_U), there is a 0.023 probability of getting a difference in sample proportions (quiz minus usual) of 0.125 or greater by chance alone, from the random assignment.

**Worked example 2 (a two-sided test from two random samples).** A hypothetical bakery with two locations wonders whether the proportion of customers who buy a pastry differs between them. A random sample of 250 receipts from the Main Street location has 95 with a pastry; a random sample of 230 receipts from the Harbor location has 71. Each location issues thousands of receipts a month. Use α = 0.05.

- p_M and p_H are the proportions of all receipts at each location that include a pastry. H₀: p_M − p_H = 0; Hₐ: p_M − p_H ≠ 0.
- Random: independent random samples of receipts. 10%: 250 and 230 are each less than 10% of the thousands of receipts. p̂_c = 166/480 ≈ 0.346; counts 86.5, 163.5, 79.5 and 150.5 are all at least 10.
- p̂_M = 0.380, p̂_H ≈ 0.309, difference ≈ 0.071. SD = √(0.346 · 0.654 · (1/250 + 1/230)) ≈ 0.0435. z ≈ 1.64. Two-sided p-value = 2 · P(Z ≥ 1.64) ≈ 0.101.
- Because 0.101 > 0.05, we fail to reject H₀. There is not convincing evidence that the proportion of receipts with a pastry differs between the two locations.

Notice the bakery would have had p ≈ 0.050 with a one-sided alternative chosen after seeing the data. Choosing the direction to suit the data roughly halves the p-value and is not allowed: the alternative comes from the question.

**Connecting to the interval.** The 95% two-sample z-interval for p_M − p_H from the same data is 0.071 ± 1.96(0.0432), about (−0.013, 0.156). It contains 0, which agrees with failing to reject H₀ in the two-sided test at α = 0.05. In general, a two-sided test at level α and a (1 − α) confidence interval for p₁ − p₂ almost always agree; they can disagree in rare borderline cases because the test uses the pooled SD and the interval does not. The interval adds what the test cannot: the plausible size of the difference.

## Errors in context

The decision can be wrong in two ways (week 18).

- **Type I error:** rejecting H₀ when it is true. In worked example 1, concluding that practice quizzes raise the pass rate when in truth they make no difference; the school might spend time on quizzes that do not help. Its probability is α.
- **Type II error:** failing to reject H₀ when Hₐ is true. In worked example 2, concluding there is not convincing evidence of a difference when the locations really do differ; the bakery might stock both stores alike when it should not.

Because worked example 1 rejected H₀, only a Type I error is possible there; because worked example 2 failed to reject, only a Type II error is possible. Larger samples, a larger α, or a larger true difference increase the power of a two-proportion test.

**Worked example 3 (planning with power in mind).** A student council plans to compare the proportions of juniors and seniors who would attend a spring dance. Two candidate plans are random samples of 50 from each class or 200 from each class, both at α = 0.05. Which plan is more likely to detect a real difference of 10 percentage points? The larger samples give a smaller SD for p̂₁ − p̂₂ (it halves when each n is quadrupled), so a true difference of 0.10 is a larger number of standard deviations from 0 and is more likely to produce a small p-value: the 200-per-class plan has higher power and a lower chance of a Type II error.

## Common mistakes

- **Hypotheses about statistics** (H₀: p̂₁ = p̂₂). Hypotheses are about p₁ and p₂.
- **Using p̂₁ and p̂₂ separately in the test's SD.** The test assumes H₀, so it pools.
- **Large Counts with the wrong numbers**, or only the successes.
- **A one-sided p-value for a two-sided alternative**, or a direction chosen after seeing the data.
- **"We accept H₀" or "the proportions are equal"** after failing to reject.
- **Interpreting the p-value as the probability that H₀ is true.**
- **Forgetting scope.** Random samples generalise; only random assignment supports causation.

## Self-check

1. Write the hypotheses for testing whether a smaller proportion of all adults in Town A than in Town B own an electric bike.
2. Samples of 150 and 100 have 45 and 35 successes. Find p̂_c.
3. Why is the 10% condition not checked in worked example 1?
4. A two-sided test gives z = −2.30. Find the p-value.
5. A test of H₀: p₁ = p₂ against Hₐ: p₁ ≠ p₂ gives p-value 0.20. Write the conclusion correctly, and name the error that might have been made.

*Answers:* 1. p_A and p_B are the proportions of all adults in each town who own an electric bike; H₀: p_A − p_B = 0, Hₐ: p_A − p_B < 0. 2. 80/250 = 0.32. 3. The students were randomly assigned, not sampled from a population. 4. 2 · P(Z ≤ −2.30) ≈ 0.021. 5. Because 0.20 > α (0.05), fail to reject H₀; there is not convincing evidence that the proportions differ. A Type II error is possible.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 3, Topics 3.12–3.13). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
