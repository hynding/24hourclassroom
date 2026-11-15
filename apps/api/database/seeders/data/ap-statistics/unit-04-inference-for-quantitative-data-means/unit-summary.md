# Unit 4 · Inference for Quantitative Data: Means · The night-before sheet

**AP exam weight:** 10–20% of the multiple-choice section, and inference for means is a regular free-response topic
**Topics:** 4.1 Sampling Distributions for Sample Means · 4.2 Constructing a Confidence Interval for a Population Mean or Population Mean Difference · 4.3 Justifying a Claim Based on a Confidence Interval for a Population Mean or Population Mean Difference · 4.4 Setting Up a Test for a Population Mean or Population Mean Difference · 4.5 Carrying Out a Test for a Population Mean or Population Mean Difference · 4.6 Sampling Distributions for the Difference Between Two Sample Means · 4.7 Constructing a Confidence Interval for the Difference Between Two Population Means · 4.8 Justifying a Claim Based on a Confidence Interval for the Difference Between Two Population Means · 4.9 Setting Up a Test for the Difference Between Two Population Means · 4.10 Carrying Out a Test for the Difference Between Two Population Means
**Practices:** 1 (Formulate Questions), 2 (Collect Data), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 4, Topics 4.1–4.10, in our own words

## The ideas that generate every question

1. **Sample means vary predictably (4.1).** The sampling distribution of x̄ has mean μ and standard deviation σ/√n (10% condition). It is normal when the population is normal, and approximately normal for any population when n ≥ 30 (Central Limit Theorem). Larger samples give less variable means; to halve the spread, quadruple n.
2. **Estimating σ with s brings in t (4.2).** The standard error s/√n replaces σ/√n, and the standardized statistic follows a t distribution with df = n − 1. t has heavier tails than z, so t* > z*; as df grows, t approaches z.
3. **Paired data are one sample of differences (4.2–4.5).** Two measurements on the same subject, or on matched pairs, are reduced to differences d, and every one-sample procedure is applied to them: μ_d, x̄_d, s_d, df = n − 1 (n = number of pairs).
4. **An interval gives plausible values; a claim is judged by them (4.3, 4.8).** A value inside the interval is plausible; a value outside is not. An interval that excludes 0 (for a mean difference or a difference of means) is convincing evidence of a difference.
5. **A test measures how surprising the data are if H₀ is true (4.4, 4.5, 4.9, 4.10).** t = (statistic − null value)/SE; the p-value is the tail area in the direction of Hₐ. Small p-value → reject H₀ → convincing evidence for Hₐ.
6. **Two independent groups use x̄₁ − x̄₂ (4.6).** Its sampling distribution has mean μ₁ − μ₂ and standard deviation √(σ₁²/n₁ + σ₂²/n₂): the variances add. It is approximately normal when each population is normal or each n ≥ 30.
7. **Two-sample t procedures (4.7–4.10).** SE = √(s₁²/n₁ + s₂²/n₂), df from the calculator (unpooled) or conservative df = smaller n − 1; always say which. Never pool.
8. **The design decides the procedure and the scope.** Paired or two-sample is fixed by how the data were collected, not by the numbers. Random sampling allows generalising to a population; random assignment allows cause and effect.

## Choosing the procedure

| Situation | Procedure | Parameter | Standard error | df |
|---|---|---|---|---|
| One group, quantitative response | One-sample t | μ | s/√n | n − 1 |
| Same subjects measured twice, or matched pairs | Paired t (one-sample t on differences) | μ_d | s_d/√n | n − 1 (pairs) |
| Two independent random samples or two randomly assigned groups | Two-sample t | μ₁ − μ₂ | √(s₁²/n₁ + s₂²/n₂) | calculator, or smaller n − 1 |

Interval: statistic ± t* · SE. Test statistic: t = (statistic − null value)/SE.

**The deciding question:** is each value in one group naturally linked to one particular value in the other (same person, twin, matched partner)? If yes, paired. Equal sample sizes alone do not make data paired; unequal sample sizes rule pairing out.

## Conditions, checked in context

| Condition | One sample or paired | Two samples |
|---|---|---|
| Random | random sample, or random assignment (of treatment order for paired designs) | two independent random samples, or random assignment to two groups |
| 10% | n ≤ 10% of the population when sampling without replacement | each sample ≤ 10% of its population |
| Normal / large sample | n ≥ 30, or the data (the differences, for paired) show no strong skew or outliers | each n ≥ 30, or each small sample's graph shows no strong skew or outliers |

For paired data, check the **differences**, not the two original lists. For an experiment with random assignment, there is no 10% check.

## Sentences that earn AP points

- **Parameter:** "μ_d = the true mean difference (after − before) in resting heart rate for all students at the school." / "μ₁ − μ₂, where μ₁ = the true mean ... for all ... and μ₂ = ..."
- **Hypotheses:** "H₀: μ₁ − μ₂ = 0; Hₐ: μ₁ − μ₂ > 0" (parameters, never x̄).
- **Interval:** "We are 95% confident that the interval from 0.73 to 3.09 m captures the true difference (Design A minus Design B) in mean flight distance."
- **Confidence level:** "If we repeated the sampling many times and built a 95% interval each time, about 95% of the intervals would capture the true mean."
- **p-value:** "Assuming H₀ is true (μ_S − μ_M = 0), there is a 0.037 probability of getting a difference in sample means of 4.8 points or more by chance alone."
- **Reject:** "Because p-value = 0.014 < α = 0.05, we reject H₀. There is convincing evidence that the mindfulness exercise reduces the mean solving time for students like these."
- **Fail to reject:** "Because p-value = 0.068 > α = 0.05, we fail to reject H₀. There is not convincing evidence that the mean caffeine intake differs between seniors and juniors."
- **Claim from an interval:** "Because 0 is in the interval, a difference of 0 is plausible, so there is not convincing evidence of a difference." / "Because 60 is above the interval, the claim of a 60-minute difference is not plausible."
- **df:** "Calculator df ≈ 17.1" or "conservative df = 9".

## Classic question types and how to attack them

**"Describe the sampling distribution of x̄ (or x̄₁ − x̄₂)."** Give center, spread and shape, each justified: mean μ (or μ₁ − μ₂); SD with the 10% condition; normal because of normal populations or the Central Limit Theorem applied to each sample.

**"Construct and interpret a confidence interval."** State, Plan, Do, Conclude. Name the procedure, define the parameter, check all conditions for every group, show the formula with numbers, name the df, interpret with "confident" and context.

**"Do the data provide convincing evidence ...?"** Hypotheses, conditions, t, df, p-value, decision with α, conclusion in context. Keep the direction of Hₐ consistent with the question and with the order of subtraction.

**"Use the interval to evaluate a claim."** Is the claimed value (or 0) inside? Then plausible; outside, not plausible. Never "proves".

**"Which procedure, and why?"** Decide paired versus two-sample from the design and explain the link (or lack of one) between the measurements.

**"Describe a Type I / Type II error, or how to increase power."** Errors in context of the means; power rises with n, effect size, α, and less variability.

## Common mistakes

- σ instead of σ/√n; adding SDs instead of variances; subtracting variances for x̄₁ − x̄₂.
- Using z* or a z-test with sample standard deviations; using the pooled option.
- Checking "n₁ + n₂ ≥ 30", or checking the original lists instead of the differences for paired data.
- Treating paired data as two samples (the student-to-student spread hides the effect) or two samples as paired.
- Hypotheses written with x̄; Hₐ chosen after seeing the data; one-sided p-values doubled or two-sided ones halved.
- "Accept H₀"; "the p-value is the probability H₀ is true"; "95% probability the mean is in this interval".
- Interpreting an interval for a mean as a range for individual values.
- Causal claims from observational data; generalising from volunteers.

## Self-test

1. σ = 18, n = 36. SD of x̄?
2. 95% t* for a one-sample interval with n = 16?
3. Ten students' scores before and after a review session: which procedure?
4. A 95% interval for μ₁ − μ₂ is (−2.4, 6.1). Convincing evidence of a difference?
5. s₁ = 6, n₁ = 25, s₂ = 8, n₂ = 32. SE of x̄₁ − x̄₂ and conservative df?
6. A two-sided p-value is 0.06 and the data point the way Hₐ: μ₁ − μ₂ > 0 predicts. One-sided p-value?

**Answers.** 1. 3. 2. 2.131 (df = 15). 3. Paired t on the ten differences. 4. No: 0 is plausible. 5. √(1.44 + 2) = √3.44 ≈ 1.855; df = 24. 6. 0.03.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 4, Topics 4.1–4.10). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
