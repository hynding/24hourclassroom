# Week 27 · Confidence Intervals for the Difference Between Two Population Means

**Topics:** 4.7 Constructing a Confidence Interval for the Difference Between Two Population Means · 4.8 Justifying a Claim Based on a Confidence Interval for the Difference Between Two Population Means
**Practices:** 3 (Analyze Data), 4 (Interpret Results), 1 (Formulate Questions)
**Framework:** AP Statistics CED (effective fall 2026), Unit 4, Topics 4.7–4.8, learning objectives in our own words
**Spiral:** Week 26 described the sampling distribution of x̄₁ − x̄₂ and its standard error √(s₁²/n₁ + s₂²/n₂). Week 24 built one-sample and paired t-intervals and used them to judge claims; weeks 19–20 did the same for p₁ − p₂. This week combines them: a two-sample t-interval for μ₁ − μ₂, and what it can and cannot tell us about a claim.

## What you need to be able to do

- **4.7** Identify a two-sample t-interval for μ₁ − μ₂ as the right procedure (two independent random samples or two randomly assigned groups, quantitative response), and tell it apart from a paired t-interval.
- **4.7** Check the Random, 10% and Normal / large sample conditions for both groups, in context.
- **4.7** Calculate (x̄₁ − x̄₂) ± t* · √(s₁²/n₁ + s₂²/n₂), stating whether t* comes from the calculator's unpooled df or the conservative df = smaller n − 1.
- **4.7** Interpret the interval and the confidence level in context, with the order of subtraction stated.
- **4.8** Use the interval to judge a claim: whether 0 (or any claimed value) is plausible, whether there is convincing evidence of a difference, and what scope of inference the design allows.
- **4.8** Explain how the confidence level and the sample sizes change the width.

## Key terms

| Term | Meaning |
|---|---|
| Two-sample t-interval for μ₁ − μ₂ | (x̄₁ − x̄₂) ± t* √(s₁²/n₁ + s₂²/n₂), an interval of plausible values for the difference in population (or true treatment) means. |
| Point estimate | x̄₁ − x̄₂, the center of the interval. |
| Margin of error | t* × SE: the half-width of the interval. |
| Calculator (unpooled) df | The df that 2-SampTInt computes from both samples (Pooled: No); usually not a whole number. |
| Conservative df | Smaller n − 1; gives a slightly larger t* and a slightly wider interval. |
| Plausible value | Any value inside the interval. |
| Convincing evidence of a difference | The whole interval lies on one side of 0. |

## Building the interval (4.7)

Every confidence interval on the AP exam is written in four steps. For two means they look like this.

1. **State.** Name the procedure and define the parameter, with the order of subtraction: "a two-sample t-interval for μ₁ − μ₂, where μ₁ = the true mean ... of all ... and μ₂ = ...", plus the confidence level.
2. **Plan (conditions).**
   - *Random:* two independent random samples, or two groups formed by random assignment.
   - *10%:* when sampling without replacement, each sample is no more than 10% of its population.
   - *Normal / large sample:* n₁ ≥ 30 and n₂ ≥ 30, or, for a small sample, a graph of that sample's data (dotplot, boxplot) shows no strong skew and no outliers. Check each group separately.
3. **Do.** (x̄₁ − x̄₂) ± t* √(s₁²/n₁ + s₂²/n₂). Say which df gives t*.
4. **Conclude.** "We are C% confident that the interval from ___ to ___ captures the true difference (group 1 minus group 2) in the mean ... of all ..."

**Choosing df.** The calculator's 2-SampTInt (Pooled: No) uses a df computed from both standard deviations and sample sizes; it always lies between the smaller n − 1 and n₁ + n₂ − 2. If you work by hand from a t table, use the **conservative df = smaller n − 1**. Both are acceptable on the AP exam as long as you say which one you used; this course reports the calculator df first and the conservative interval for comparison. Never use the "pooled" option.

**Worked example 1 (two random samples).** A district researcher takes independent random samples of 35 9th graders and 32 12th graders from the district's thousands of high school students and records daily recreational screen time. The 9th graders have x̄₁ = 212 minutes, s₁ = 58; the 12th graders have x̄₂ = 187 minutes, s₂ = 64. Construct a 95% confidence interval for the difference in means.

- *State:* two-sample t-interval for μ₁ − μ₂, where μ₁ = the true mean daily screen time of all 9th graders in the district and μ₂ = that of all 12th graders; 95% confidence.
- *Plan:* two independent random samples; 35 and 32 are each far less than 10% of the district's 9th and 12th graders; both samples have at least 30 students, so the sampling distribution of x̄₁ − x̄₂ is approximately normal.
- *Do:* x̄₁ − x̄₂ = 25 minutes. SE = √(58²/35 + 64²/32) = √(96.11 + 128.00) ≈ 14.97. Calculator df ≈ 62.8, t* ≈ 1.998, margin of error ≈ 29.9. Interval: **(−4.9, 54.9) minutes**. (Conservative df = 31, t* = 2.040, interval (−5.5, 55.5).)
- *Conclude:* we are 95% confident that the interval from −4.9 to 54.9 minutes captures the true difference (9th graders minus 12th graders) in mean daily screen time for all students in the district.

**Worked example 2 (an experiment with small groups).** A biology class randomly assigns 24 basil seedlings, 12 to grow under LED lights and 12 under fluorescent lights, and measures growth (cm) after three weeks.

| Light | Growth (cm) |
|---|---|
| LED | 14.2, 16.8, 15.1, 17.9, 13.6, 16.2, 18.4, 15.7, 14.9, 17.1, 16.5, 15.4 |
| Fluorescent | 12.9, 14.1, 13.3, 15.8, 11.7, 13.9, 14.6, 12.4, 15.2, 13.1, 14.8, 12.6 |

Summary: LED x̄ = 15.98, s = 1.445; fluorescent x̄ = 13.70, s = 1.241. Construct a 90% interval for μ_LED − μ_F.

- *Plan:* the seedlings were randomly assigned to the two lights (Random). There is no 10% condition, because no sampling from a population took place. The samples are small (12 each), so look at the data: dotplots of both groups are roughly symmetric with no outliers (the 1.5 × IQR fences are about 12.3 to 19.6 cm for LED and 10.1 to 17.4 cm for fluorescent, and every value is inside), so the Normal condition is reasonable.
- *Do:* difference 2.28 cm, SE = √(1.445²/12 + 1.241²/12) ≈ 0.550. Calculator df ≈ 21.5, t* ≈ 1.719, interval **(1.34, 3.23) cm**. (Conservative df = 11, t* = 1.796, interval (1.30, 3.27).)
- *Conclude:* we are 90% confident that the interval from 1.34 to 3.23 cm captures the true difference (LED minus fluorescent) in mean three-week growth for seedlings like these.

**Interpreting the confidence level.** "90% confident" describes the **method**: if we repeated the random assignment many times and built a 90% interval each time, about 90% of those intervals would capture the true difference in means. It is not a 90% probability that this particular interval is right, and it says nothing about 90% of individual plants.

**What changes the width.** The margin of error is t* × √(s₁²/n₁ + s₂²/n₂).

| Change | Effect on width |
|---|---|
| Higher confidence level | Wider (larger t*) |
| Larger samples (either or both) | Narrower (smaller SE, slightly smaller t*) |
| More variable data (larger s) | Wider |
| Conservative instead of calculator df | Slightly wider |

## Justifying a claim with the interval (4.8)

An interval is a list of plausible values of μ₁ − μ₂. A claim about the difference is supported or undermined depending on whether its value is in that list.

- **0 inside the interval:** "no difference" is plausible. There is **not** convincing evidence of a difference in means. This does not prove the means are equal: other values in the interval are plausible too.
- **Whole interval above 0:** convincing evidence that μ₁ > μ₂ (at the matching significance level, α = 1 − C for a two-sided claim).
- **Whole interval below 0:** convincing evidence that μ₁ < μ₂.
- **A specific claimed difference (say, 10 minutes):** plausible if it lies inside the interval, not plausible if it lies outside.

**Worked example 3.** Return to the screen-time interval (−4.9, 54.9) minutes.

- *Claim: "9th graders and 12th graders have different mean screen times."* The interval contains 0, so a difference of 0 is plausible. The data do **not** give convincing evidence of a difference at the 95% level. Most of the interval is positive, which is suggestive, but "suggestive" is not "convincing".
- *Claim: "9th graders average an hour more."* 60 minutes is above the interval, so this specific claim is not plausible.

For the basil interval (1.34, 3.23) cm, every value is positive, so there is convincing evidence that LED light produces greater mean growth than fluorescent light for seedlings like these. A claim of "at least 1 cm more growth on average" is consistent with the interval; a claim of "4 cm more" is not.

**Scope of inference.** The design decides what the conclusion can say.

| Design | Generalise to a population? | Cause and effect? |
|---|---|---|
| Random samples from two populations (screen time) | Yes, to all 9th and 12th graders in the district | No: grade is not assigned, so other differences may explain it |
| Random assignment of available units (basil seedlings) | Only to units like these | Yes: the light caused the difference in growth |

**Worked example 4 (a claim with a two-sided test in mind).** A café owner compares random samples of weekday and weekend orders and gets a 99% interval for μ_weekend − μ_weekday (mean order total, dollars) of (0.42, 3.86). At the 99% level, 0 is outside the interval, so there is convincing evidence that weekend orders have a higher mean total; a two-sided test at α = 0.01 would reject H₀: μ_weekend − μ_weekday = 0. A 95% interval from the same data would be narrower and would also exclude 0. The owner cannot say that weekends **cause** bigger orders: the days were not randomly assigned to customers.

## Paired or two-sample?

Before computing, decide whether the data are paired (weeks 24–25) or independent (this week). Paired data come from the same subjects measured twice or from matched pairs, and the interval is x̄_d ± t* · s_d/√n with df = n − 1, a one-sample procedure on the differences. Two independent groups use the two-sample interval with √(s₁²/n₁ + s₂²/n₂). Using the wrong one usually changes the answer a lot: pairing removes subject-to-subject variability, so a paired interval is often much narrower.

## Common mistakes

- **Leaving out the order of subtraction.** "μ₁ − μ₂" means nothing until μ₁ and μ₂ are defined in context; the sign of every value in the interval depends on it.
- **Checking Normal with the total sample size,** or checking only one group's graph.
- **Using z* or the pooled option.** Two means with sample SDs use t* and the unpooled SE.
- **Not saying which df you used.**
- **"0 is in the interval, so the means are equal."** Write "a difference of 0 is plausible; there is not convincing evidence of a difference."
- **Interpreting the confidence level as a probability about this interval or as a statement about individuals.**
- **Claiming cause and effect from two random samples,** or generalising an experiment on volunteers to a whole population.

## Self-check

1. Two random samples: n₁ = 40, x̄₁ = 82, s₁ = 10; n₂ = 45, x̄₂ = 76, s₂ = 12. What is the point estimate and the SE?
2. With conservative df, what df and 95% t* would you use for question 1?
3. A 95% interval for μ_A − μ_B is (−3.2, 1.1). Is there convincing evidence of a difference?
4. The same data give a 90% interval. Will it be wider or narrower?
5. A 95% interval for μ_new − μ_old is (2.5, 9.0) seconds of reaction time. Is a true difference of 5 seconds plausible? Is 0?
6. Twelve students each type a passage on two keyboards. Which interval should you use?

*Answers:* 1. 6; √(100/40 + 144/45) = √(2.5 + 3.2) = √5.7 ≈ 2.387. 2. df = 39, t* ≈ 2.023. 3. No: 0 is inside, so no difference is plausible. 4. Narrower. 5. 5 is plausible; 0 is not, so there is convincing evidence the new mean is higher. 6. A paired t-interval for the mean difference (each student types on both).

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 4, Topics 4.7–4.8). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
