# Week 26 · The Sampling Distribution of x̄₁ − x̄₂

**Topics:** 4.6 Sampling Distributions for the Difference Between Two Sample Means
**Practices:** 3 (Analyze Data), 4 (Interpret Results), 2 (Collect Data)
**Framework:** AP Statistics CED (effective fall 2026), Unit 4, Topic 4.6, learning objectives in our own words
**Spiral:** Week 14 introduced sampling distributions and the Central Limit Theorem; week 19 built the sampling distribution of p̂₁ − p̂₂ for two proportions; week 23 described the sampling distribution of one sample mean x̄; weeks 24 and 25 used t procedures for one mean and for the mean of paired differences. This week puts two independent means side by side, which is the foundation for the two-sample t-interval (week 27) and the two-sample t-test (week 28).

## What you need to be able to do

- **4.6** Recognise when a question compares two independent groups (two random samples, or two treatment groups formed by random assignment) and when it is really one set of paired differences.
- **4.6** State the center, spread and shape of the sampling distribution of x̄₁ − x̄₂, using the formula-sheet standard deviation √(σ₁²/n₁ + σ₂²/n₂).
- **4.6** Check the conditions that make the formula and the normal model trustworthy: Random, independence (10% condition for each sample), and Normal / large sample for each group.
- **4.6** Calculate and interpret probabilities about x̄₁ − x̄₂ with a normal model, and judge whether an observed difference is surprising.
- **4.6** Replace σ₁ and σ₂ with s₁ and s₂ to get the standard error, and explain why that leads to a t distribution.

## Key terms

| Term | Meaning |
|---|---|
| x̄₁ − x̄₂ | The difference between the means of two independent samples; it changes from sample to sample. |
| μ₁ − μ₂ | The difference between the two population (or true treatment) means: the parameter. |
| Sampling distribution of x̄₁ − x̄₂ | The distribution of x̄₁ − x̄₂ over all possible pairs of samples of sizes n₁ and n₂. |
| SD(x̄₁ − x̄₂) | √(σ₁²/n₁ + σ₂²/n₂): how far x̄₁ − x̄₂ typically falls from μ₁ − μ₂. |
| Standard error SE(x̄₁ − x̄₂) | √(s₁²/n₁ + s₂²/n₂): the estimate of that standard deviation when σ₁ and σ₂ are unknown. |
| Independent samples | Choosing the members of one sample tells you nothing about who is in the other. |
| Paired data | Two measurements linked by subject (same person twice, twins, matched pairs); analysed as one list of differences. |

## Center, spread and shape (4.6)

Suppose we take a random sample of size n₁ from population 1 and, separately, a random sample of size n₂ from population 2, and compute x̄₁ − x̄₂. Repeat that many times and the differences form the **sampling distribution of x̄₁ − x̄₂**. Three facts describe it.

- **Center.** The mean of the sampling distribution of x̄₁ − x̄₂ is μ₁ − μ₂. The statistic x̄₁ − x̄₂ is an **unbiased estimator** of μ₁ − μ₂ (week 15's idea of an estimator, now for two means).
- **Spread.** When the two samples are independent, SD(x̄₁ − x̄₂) = √(σ₁²/n₁ + σ₂²/n₂). This formula is on the AP formula sheet. Notice that the two terms are **added**: each sample mean wobbles on its own, so the difference wobbles more than either one. You do not need to derive it; you do need to know that it requires independent samples.
- **Shape.** The sampling distribution of x̄₁ − x̄₂ is approximately normal when **each** population is approximately normal, or when **each** sample is large (n₁ ≥ 30 and n₂ ≥ 30) so that the Central Limit Theorem applies to both sample means. One large sample and one small sample from a skewed population is not enough.

This mirrors week 19 exactly: there, p̂₁ − p̂₂ had mean p₁ − p₂ and SD √(p₁(1 − p₁)/n₁ + p₂(1 − p₂)/n₂). The pattern "center = difference of parameters, spread = square root of the sum of the two squared SDs" is the same for both kinds of data.

**Worked example 1.** In a hypothetical school district, the nightly sleep of juniors at School A has mean 7.2 hours and standard deviation 1.1 hours; at School B the mean is 6.8 hours and the standard deviation is 1.3 hours. A researcher takes independent random samples of 40 juniors from School A and 50 from School B. Find the probability that the School B sample sleeps more on average than the School A sample, that is, P(x̄A − x̄B < 0).

1. **Center:** μA − μB = 7.2 − 6.8 = 0.4 hours.
2. **Spread:** SD(x̄A − x̄B) = √(1.1²/40 + 1.3²/50) = √(0.03025 + 0.0338) = √0.06405 ≈ 0.2531 hours. (Both schools have hundreds of juniors, so each sample is less than 10% of its population and the samples are independent of each other.)
3. **Shape:** both samples have at least 30 students, so by the Central Limit Theorem the sampling distribution of x̄A − x̄B is approximately normal, even though individual sleep times may be skewed.
4. **Probability:** z = (0 − 0.4)/0.2531 ≈ −1.58, and P(z < −1.58) ≈ 0.057.

*Interpretation:* in about 5.7% of all possible pairs of random samples like these, the School B sample mean would be larger than the School A sample mean, even though School A sleeps 0.4 hours more on average. Sampling variability alone can reverse the order of two means fairly often when the difference is small relative to the spread.

## Checking the conditions (4.6)

The formula and the normal shape each rest on conditions, and on the exam you check them **in context**, not by listing names.

| Condition | What to check | Why it matters |
|---|---|---|
| Random | Two independent random samples, or two groups formed by random assignment | Makes x̄₁ − x̄₂ unbiased and the probability model valid |
| Independence (10%) | When sampling without replacement, n₁ ≤ 10% of population 1 and n₂ ≤ 10% of population 2; the two samples are independent of each other | Makes √(σ₁²/n₁ + σ₂²/n₂) the right spread |
| Normal / large sample | Each population approximately normal, or n₁ ≥ 30 and n₂ ≥ 30 | Makes the normal (later t) model reasonable |

**Worked example 2.** A horticulture class grows two tomato varieties. Hypothetically, six-week heights of variety R are approximately normal with mean 62 cm and SD 5 cm; variety Y heights are approximately normal with mean 58 cm and SD 6 cm. The class grows 10 plants of each, chosen at random from a large batch of seedlings, in separate trays. Find P(x̄R − x̄Y ≥ 7).

- Center: 62 − 58 = 4 cm. Spread: √(5²/10 + 6²/10) = √(2.5 + 3.6) = √6.1 ≈ 2.470 cm.
- Shape: the samples are small, but **both populations are approximately normal**, so x̄R and x̄Y are each exactly normal and so is their difference. No n ≥ 30 is needed.
- z = (7 − 4)/2.470 ≈ 1.21, so P(x̄R − x̄Y ≥ 7) ≈ 0.112.

About 11% of the time, the variety R trays would out-grow the variety Y trays by 7 cm or more on average: not unusual.

**Worked example 3 (when the normal model fails).** Wait times at two walk-in clinics are strongly right-skewed: most patients are seen within 20 minutes, a few wait over an hour. A student takes random samples of 12 patients at one clinic and 15 at the other and wants P(x̄₁ − x̄₂ > 10). Neither population is normal and neither sample reaches 30, so the Central Limit Theorem gives no guarantee: a normal calculation would be unjustified. The fix is a larger sample from **each** clinic (30 or more each) or a simulation of the sampling distribution. Taking 60 patients from one clinic and still 12 from the other does not fix it: the small, skewed sample mean still has a skewed sampling distribution.

## Independent or paired? (4.6)

The formula √(σ₁²/n₁ + σ₂²/n₂) assumes the two samples are **independent**. When the two measurements come in linked pairs, they are not: a student who scores high before a review session usually scores high after it too. Paired data are analysed as **one** sample of differences, with the one-sample methods of weeks 23–25 (mean difference μ_d, standard deviation of the differences s_d).

**Worked example 4.** Decide whether each design gives two independent samples or paired data.

1. Thirty students take a vocabulary quiz, use a flashcard app for two weeks, and take a parallel quiz. **Paired**: each student gives a before and an after score; analyse the 30 differences.
2. Thirty students are randomly split into two groups of 15: one group uses the app, the other studies with a printed list; both take the same quiz. **Independent**: different students in each group, so x̄₁ − x̄₂ with the formula above.
3. Twenty pairs of twins; one twin in each pair (chosen by coin flip) uses the app and the other the printed list. **Paired**: the twins are matched, so analyse the 20 within-pair differences.

The question to ask is: "Is each value in group 1 naturally linked to one particular value in group 2?" If yes, pair them. Different sample sizes (n₁ ≠ n₂) are a strong hint of independent samples, because pairs always give equal counts.

## From σ to s: the standard error and t (4.6)

In practice we rarely know σ₁ and σ₂. We replace them with the sample standard deviations and get the **standard error**

SE(x̄₁ − x̄₂) = √(s₁²/n₁ + s₂²/n₂).

The standardized statistic t = ((x̄₁ − x̄₂) − (μ₁ − μ₂)) / SE then follows (approximately) a **t distribution**, not a normal one, because the SE itself varies from sample to sample. Its degrees of freedom come from one of two choices, and you should always say which you used:

- **Calculator (unpooled) df:** the 2-SampTInt and 2-SampTTest commands (with "Pooled: No") compute a df from both s values and both sample sizes. It is usually not a whole number and always lies between the smaller n − 1 and n₁ + n₂ − 2.
- **Conservative df = smaller n − 1:** easy by hand; it gives a slightly larger t* (wider intervals) and slightly larger p-values, so conclusions are on the safe side.

Do **not** use the "pooled" option: the AP course uses the unpooled standard error.

**Worked example 5.** In hypothetical random samples of commuters, 36 students who drive to school have mean commute 24.5 minutes (s = 8.2) and 30 students who take the bus have mean 21.0 minutes (s = 6.9). How many standard errors apart are the sample means?

- SE = √(8.2²/36 + 6.9²/30) = √(1.8678 + 1.5870) = √3.4548 ≈ 1.859 minutes.
- (24.5 − 21.0)/1.859 ≈ 1.88 standard errors.
- Degrees of freedom: calculator df ≈ 64.0; conservative df = 30 − 1 = 29.

Week 27 turns this into an interval and week 28 into a test. For now, the point is that 1.88 standard errors is a moderate gap: suggestive, but not overwhelming.

**Sample size and spread.** Because each term is σ²/n, quadrupling **both** sample sizes halves SD(x̄₁ − x̄₂). Making only one sample bigger helps less, because the other term does not shrink.

## Common mistakes

- **Subtracting the variances or the SDs.** SD(x̄₁ − x̄₂) = √(σ₁²/n₁ + σ₂²/n₂). The terms always add, even though the statistic is a difference.
- **Adding SDs instead of variances.** σ₁/√n₁ + σ₂/√n₂ is too big; square, add, then take the root.
- **Using σ instead of σ/√n inside the formula.** Each term divides by its own sample size.
- **Checking "n₁ + n₂ ≥ 30".** The large-sample condition applies to each sample separately.
- **Treating paired data as two independent samples.** Before/after or matched designs need one-sample methods on the differences.
- **Writing a probability about the population.** Probabilities here describe x̄₁ − x̄₂, a statistic; μ₁ − μ₂ is a fixed number.
- **Not saying which df you used.** Write "calculator df ≈ 64.0" or "conservative df = 29".

## Self-check

1. Population 1 has μ = 80, σ = 12; population 2 has μ = 75, σ = 9. Independent random samples of 36 and 36. Give the mean and SD of x̄₁ − x̄₂.
2. In question 1, is the sampling distribution approximately normal? Why?
3. Two populations are strongly skewed. Samples of 50 and 18. Is a normal model justified for x̄₁ − x̄₂?
4. Ten students each run a timed mile in old shoes and in new shoes. Independent samples or paired?
5. Using question 1, find P(x̄₁ − x̄₂ > 10).
6. s₁ = 4, n₁ = 16, s₂ = 6, n₂ = 25. Find the standard error and the conservative df.

*Answers:* 1. Mean 5; SD = √(144/36 + 81/36) = √(4 + 2.25) = √6.25 = 2.5. 2. Yes: both samples have 36 ≥ 30 members, so the Central Limit Theorem applies to each sample mean, whatever the population shapes. 3. No: the second sample (18) is small and its population is skewed. 4. Paired: each student gives two times. 5. z = (10 − 5)/2.5 = 2.00, P ≈ 0.023. 6. SE = √(1 + 1.44) = √2.44 ≈ 1.562; conservative df = 15.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 4, Topic 4.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
