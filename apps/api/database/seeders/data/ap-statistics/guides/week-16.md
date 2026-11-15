# Week 16 · Confidence Intervals for a Population Proportion

**Topics:** 3.3 Constructing a Confidence Interval for a Population Proportion · 3.4 Justifying a Claim Based on a Confidence Interval for a Population Proportion
**Practices:** 3 (Analyze Data), 4 (Interpret Results), 2 (Collect Data)
**Framework:** AP Statistics CED (effective fall 2026), Unit 3, Topics 3.3–3.4, learning objectives in our own words
**Spiral:** Week 15 showed that p̂ from a random sample is unbiased, with SD(p̂) = √(p(1 − p)/n) and an approximately normal shape when the counts are large. Week 13's normal calculations supply the critical values. This week turns that description around: instead of asking where p̂ will land given p, we use one observed p̂ to build an interval of plausible values for the unknown p, and use the interval to judge claims about p.

## What you need to be able to do

- **3.3** Name the procedure (a one-sample z-interval for a population proportion), define the parameter in context, and check the Random, 10% and Large Counts conditions.
- **3.3** Find the critical value z* for any confidence level and compute the standard error, margin of error and interval.
- **3.3** Interpret the interval and the confidence level in context, and explain how the sample size and the confidence level change the margin of error.
- **3.3** Find the sample size needed for a given margin of error.
- **3.4** Use a confidence interval to decide whether a claimed value of p is plausible, and to say whether there is convincing evidence for a claim such as "more than half".

## Key terms

| Term | Meaning |
|---|---|
| Point estimate | The single best guess for the parameter: p̂. |
| Confidence interval | point estimate ± margin of error: an interval of plausible values for p. |
| Standard error SE(p̂) | √(p̂(1 − p̂)/n): the estimated SD of p̂, using p̂ because p is unknown. |
| Critical value z* | The number of standard errors needed to capture the middle C% of a standard normal distribution. |
| Margin of error | z* · SE(p̂): the most the estimate is likely to miss p by, because of random sampling alone. |
| Confidence level C | The long-run proportion of intervals made by this method that capture the true p. |
| Plausible value | A value of p inside the interval. |

## Building the interval (3.3)

Every confidence interval in AP Statistics has the same shape:

> statistic ± (critical value) · (standard error of the statistic)

For a proportion that is **p̂ ± z* · √(p̂(1 − p̂)/n)**. Because p is what we are trying to estimate, we cannot use it in SD(p̂); we substitute p̂ and call the result the **standard error**.

**Critical values.** z* cuts off the middle C% of the standard normal curve, leaving (1 − C)/2 in each tail. Find it with invNorm(1 − (1 − C)/2):

| Confidence level | 90% | 95% | 98% | 99% |
|---|---|---|---|---|
| z* | 1.645 | 1.960 | 2.326 | 2.576 |

A non-standard level works the same way: for 92%, invNorm(0.96) ≈ 1.751.

**Conditions** (check each in context):

- **Random:** the data come from a random sample (or a randomized experiment).
- **10%:** when sampling without replacement, n ≤ 10% of the population.
- **Large Counts:** the numbers of successes and failures in the sample, np̂ and n(1 − p̂), are both at least 10. For an interval we use the observed counts, because p is unknown.

On the AP exam a complete interval answer has four parts: **State** (procedure, parameter, confidence level), **Plan** (conditions), **Do** (the calculation), **Conclude** (interpretation in context).

**Worked example (a 95% interval).** A hypothetical school district surveyed a simple random sample of 400 of its 15,000 high school students; 248 said they usually sleep less than 8 hours on school nights. Construct and interpret a 95% confidence interval.

1. **State.** A one-sample z-interval for p, where p = the proportion of all high school students in the district who usually sleep less than 8 hours on school nights; 95% confidence.
2. **Plan.** Random: a simple random sample. 10%: 400 ≤ 10% of 15,000 = 1,500. Large Counts: 248 and 152 are both at least 10.
3. **Do.** p̂ = 248/400 = 0.62. SE = √(0.62 · 0.38 / 400) ≈ 0.0243. Margin of error = 1.96 · 0.0243 ≈ 0.048. Interval: 0.62 ± 0.048 = (0.572, 0.668).
4. **Conclude.** We are 95% confident that the interval from 0.572 to 0.668 captures the true proportion of all high school students in the district who usually sleep less than 8 hours on school nights.

On a calculator, 1-PropZInt with x = 248, n = 400 and C-Level 0.95 gives the same interval. Write the formula and the numbers anyway: "calculator speak" alone does not earn the work point.

## Interpreting the interval and the confidence level

Two different sentences, and both are tested.

- **The interval:** "We are C% confident that the interval from ___ to ___ captures the true proportion of all [population] who [characteristic]."
- **The confidence level:** "If we took many random samples of the same size and built a C% interval from each one, about C% of those intervals would capture the true proportion of all [population] who [characteristic]."

The confidence is in the **method**, not in one finished interval. Once an interval is computed, p is either in it or not; there is no 95% probability left. Never say "there is a 95% chance that p is between 0.572 and 0.668", and never say that 95% of students sleep between those amounts or that 95% of sample proportions fall in the interval.

The margin of error covers only **sampling variability**: the chance differences between random samples. It does nothing about bias from undercoverage, nonresponse or question wording. A poorly designed survey can produce a narrow interval around the wrong value.

## What controls the margin of error

ME = z* · √(p̂(1 − p̂)/n), so:

- **Higher confidence → wider interval.** A larger z* is the price of capturing p more often.
- **Larger sample → narrower interval.** Because n is under a square root, quadrupling n halves the margin of error.
- The population size does not matter (as long as the 10% condition holds).

**Worked example (changing the confidence level).** For the sleep data (p̂ = 0.62, n = 400, SE ≈ 0.0243):

| Confidence level | z* | Margin of error | Interval |
|---|---|---|---|
| 90% | 1.645 | 0.040 | (0.580, 0.660) |
| 95% | 1.960 | 0.048 | (0.572, 0.668) |
| 99% | 2.576 | 0.063 | (0.557, 0.683) |

Same data, same centre; more confidence costs width.

**Worked example (choosing a sample size).** The district wants a 95% margin of error of at most 3 percentage points next year, with no reliable earlier estimate. Solve 1.96 · √(p*(1 − p*)/n) ≤ 0.03. With no earlier estimate use p* = 0.5, which makes p*(1 − p*) = 0.25 as large as possible and so guarantees the margin: n ≥ (1.96/0.03)² · 0.25 ≈ 1,067.1. **Round up**: n = 1,068 students. (Rounding down would give a margin just over 0.03.) If this year's 0.62 is trusted as p*, n ≥ (1.96/0.03)² · 0.62 · 0.38 ≈ 1,005.6, so 1,006 students.

## Justifying a claim with an interval (3.4)

A confidence interval lists the plausible values of p. That makes it a tool for judging claims.

- If a claimed value is **inside** the interval, it is plausible: the data do **not** give convincing evidence against it. (That is not evidence that the claim is true; many other values are plausible too.)
- If a claimed value is **outside** the interval, it is not plausible: the data give convincing evidence that p differs from it, in the direction the interval lies.
- For a one-sided claim ("more than half"), look at where the **whole** interval lies. If every value in it is above 0.5, there is convincing evidence that p > 0.5.

**Worked example (two claims, one interval).** Using the 95% interval (0.572, 0.668) from the sleep survey:

1. **Claim: a majority of the district's students sleep less than 8 hours.** Every value in the interval is greater than 0.50, so there is convincing evidence that more than half of all high school students in the district usually sleep less than 8 hours.
2. **Claim: more than 60% do.** The value 0.60 is inside the interval, and so are values below it, such as 0.58. The interval does not give convincing evidence that the proportion is greater than 0.60; 0.60 itself is plausible.
3. **Claim (a news report): only half do.** 0.50 lies below the interval, so 0.50 is not a plausible value; the data contradict the report.

A full answer always names the value being checked, says whether it is inside or outside the interval, and states the conclusion about p in context.

**Worked example (a narrow claim and the confidence level).** A 99% interval is wider, so a value can be outside the 95% interval but inside the 99% interval. For the sleep data, 0.67 is outside the 95% interval (upper end 0.668) but inside the 99% interval (upper end 0.683). Conclusions drawn from an interval should always name its confidence level.

## Common mistakes

- **Using p in the standard error for an interval.** There is no known p; use p̂. (Next week's tests use p₀.)
- **Interpreting the confidence level as a probability about this interval.** The 95% describes the method's long-run capture rate.
- **Interpreting the interval as a range for individuals or for sample proportions.** It is about the population proportion p.
- **Thinking the margin of error accounts for bias.** It covers random sampling variability only.
- **Rounding a sample size down.** Always round up.
- **"The value is in the interval, so the claim is true."** Inside means plausible, not proven.
- **Wrong z\*.** 1.645 is for 90%, 1.96 for 95%, 2.576 for 99%.

## Self-check

1. A random sample of 250 students from a high school of 2,600 finds 95 who have tried a meal-kit service. Find a 99% confidence interval for the proportion of all students at the school who have tried one.
2. Interpret the confidence level in question 1.
3. What z* goes with 92% confidence?
4. A 95% interval for the proportion of a city's voters who favour a bond is (0.47, 0.55). Is there convincing evidence that a majority favour it?
5. What sample size gives a 95% margin of error of at most 0.04 with no prior estimate?
6. How does going from n = 300 to n = 1,200 change the margin of error, all else equal?

*Answers:* 1. p̂ = 0.38; conditions: random sample, 250 ≤ 260, 95 and 155 ≥ 10; SE = √(0.38 · 0.62 / 250) ≈ 0.0307; 0.38 ± 2.576(0.0307) = (0.301, 0.459). 2. If we took many random samples of 250 students and built a 99% interval from each, about 99% of the intervals would capture the true proportion of all students at the school who have tried a meal-kit service. 3. invNorm(0.96) ≈ 1.751. 4. No: 0.50 is inside the interval, so it is a plausible value; the data do not give convincing evidence of a majority. 5. (1.96/0.04)² · 0.25 = 600.25, so n = 601. 6. The margin of error is halved.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 3, Topics 3.3–3.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
