# Week 20 · Justifying Claims with an Interval for p₁ − p₂

**Topics:** 3.11 Justifying a Claim Based on a Confidence Interval for the Difference Between Two Population Proportions
**Practices:** 1 (Formulate Questions), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 3, Topic 3.11, learning objectives in our own words
**Spiral:** Week 16 used a one-sample interval to judge a claim about one proportion: a claimed value inside the interval is plausible, one outside is not. Week 19 built the two-sample z-interval for p₁ − p₂. This week puts the two together: the interval for a difference is used to judge claims that two proportions differ, that one is larger, or that the gap is at least some size, and the study design decides how far the conclusion reaches.

## What you need to be able to do

- **3.11** Decide whether a two-sample z-interval for p₁ − p₂ gives convincing evidence of a difference, using whether 0 is a plausible value.
- **3.11** Use the sign of the plausible values (and the order of subtraction) to say which proportion is larger.
- **3.11** Judge claims about the size of a difference ("at least 10 percentage points") by comparing the claimed value with every value in the interval.
- **3.11** Explain how the confidence level changes the conclusion, and why "0 is plausible" never proves the proportions are equal.
- **3.11** State the scope of the conclusion: generalisation from random sampling, cause and effect from random assignment.

## Key terms

| Term | Meaning |
|---|---|
| Plausible value | Any value inside the confidence interval: a value of the parameter consistent with the data at that confidence level. |
| 0 as a benchmark | p₁ − p₂ = 0 means the two population proportions are equal. If 0 is outside the interval, the data give convincing evidence of a difference. |
| Interval entirely above 0 | Every plausible value of p₁ − p₂ is positive: convincing evidence that p₁ > p₂. |
| Interval entirely below 0 | Every plausible value is negative: convincing evidence that p₁ < p₂. |
| Claimed size of a difference | A claim like p₁ − p₂ ≥ 0.10 is supported only if every plausible value meets it. |
| Scope of inference | Who the conclusion applies to (the populations sampled) and whether it is causal (random assignment). |

## Reading an interval for a difference (3.11)

A confidence interval is a list of plausible values for the parameter. For p₁ − p₂ the value that matters most is **0**, because p₁ − p₂ = 0 says the two proportions are the same.

| What the interval for p₁ − p₂ looks like | What you may conclude |
|---|---|
| Both endpoints positive, e.g. (0.03, 0.17) | Convincing evidence that p₁ > p₂; 0 is not plausible. |
| Both endpoints negative, e.g. (−0.21, −0.06) | Convincing evidence that p₁ < p₂. |
| Contains 0, e.g. (−0.04, 0.12) | Not convincing evidence of a difference. 0 is plausible, but so are positive and negative values: the data do **not** show the proportions are equal. |

Always connect the sign to the order of subtraction. An interval of (0.03, 0.17) for p_text − p_email says texts have the higher proportion; the same data as p_email − p_text give (−0.17, −0.03), and the conclusion is identical.

**Worked example 1 (an experiment with a positive interval).** A large hypothetical high school wants to know whether a text-message reminder makes students more likely to hand homework in on time. It randomly assigns 415 volunteer students to two groups: 210 receive an evening text reminder and 205 receive none. Over the next month, 168 of the reminder group and 141 of the no-reminder group hand in every assignment on time. A teacher claims that the reminders raise the on-time proportion.

- **Procedure and parameter.** A two-sample z-interval for p_R − p_N, where p_R and p_N are the true proportions of students like these who hand in every assignment on time with and without the reminder.
- **Conditions.** Random: the students were randomly assigned to the two groups. 10%: not needed, because no population was sampled. Large Counts: 168, 42, 141 and 64 are all at least 10.
- **Interval.** p̂_R = 168/210 = 0.800 and p̂_N = 141/205 ≈ 0.688, a difference of 0.112. SE = √(0.8·0.2/210 + 0.688·0.312/205) ≈ 0.0425. 95% interval: 0.112 ± 1.96(0.0425) = 0.112 ± 0.083, from **0.029 to 0.196**.
- **Claim.** We are 95% confident that the interval from 0.029 to 0.196 captures the true difference (reminder minus no reminder) in on-time proportions. Every value in the interval is positive, so 0 is not plausible: the interval gives convincing evidence that the reminder raises the proportion of students who hand in all their homework on time, by somewhere between about 3 and 20 percentage points.
- **Scope.** Because the treatments were randomly assigned, we may conclude that the reminders *cause* the increase. Because the students were volunteers rather than a random sample of all students, the conclusion applies to students like these volunteers.

**Worked example 2 (an interval that contains 0).** A hypothetical county election office surveys independent random samples of likely voters in two towns about a park bond: 212 of 400 in Ashford and 198 of 380 in Belmont support it (each town has well over 10,000 voters). A local newspaper claims that support differs between the towns.

p̂_A = 0.530 and p̂_B ≈ 0.521, a difference of 0.009. SE = √(0.53·0.47/400 + 0.521·0.479/380) ≈ 0.0358. The 95% interval for p_A − p_B is 0.009 ± 0.070, from **−0.061 to 0.079**.

The interval contains 0, so 0 is a plausible value for p_A − p_B: the data do **not** give convincing evidence that support differs between the towns. The interval also contains values as large as 0.079 and as small as −0.061, so we cannot conclude support is the same either. "Not convincing evidence of a difference" is the whole conclusion. Because the samples were random, the conclusion is about all likely voters in the two towns; it says nothing about causes.

## Claims about the size of a difference

Some claims are not "different or not" but "different by at least this much". Compare the claimed value with the *whole* interval.

**Worked example 3 (is the gap more than 10 points?).** A hypothetical advocacy group claims that the proportion of students who got a smartphone before age 12 is more than 10 percentage points higher in District East than in District West. Independent random samples give 132 of 240 in East and 99 of 250 in West (each district has more than 5,000 students). Large Counts: 132, 108, 99 and 151 are all at least 10.

p̂_E = 0.550, p̂_W = 0.396, difference 0.154; SE ≈ 0.0446. The 95% interval for p_E − p_W is 0.154 ± 0.087, from **0.067 to 0.241**.

- Does East have a higher proportion? Yes: every plausible value is positive, so there is convincing evidence that p_E > p_W.
- Is the gap more than 0.10? Values above 0.10 (such as 0.15 or 0.20) are plausible, but so are values from 0.067 to 0.10. The interval does **not** give convincing evidence that the gap exceeds 10 percentage points. It does not refute the claim either: the claim is plausible, not established.

The rule: a claim is supported with convincing evidence only when *every* plausible value satisfies it, and it is contradicted when *no* plausible value does.

## Confidence level and the conclusion

A higher confidence level gives a wider interval, so a borderline conclusion can change.

**Worked example 4 (one data set, three levels).** A school's student council compares random samples of 160 juniors and 160 seniors from its large school: 75 juniors and 56 seniors say they would attend a weekend study session. p̂_J ≈ 0.469, p̂_S = 0.350, difference 0.119, SE ≈ 0.0546.

| Level | z* | Interval for p_J − p_S | Is 0 plausible? |
|---|---|---|---|
| 90% | 1.645 | (0.029, 0.209) | No |
| 95% | 1.960 | (0.012, 0.226) | No |
| 99% | 2.576 | (−0.022, 0.259) | Yes |

At 90% and 95% confidence the council has convincing evidence that a larger proportion of juniors would attend; at 99% it does not. Nothing about the data changed: demanding more confidence made the list of plausible values longer, and it now reaches 0. Choose the confidence level before looking at the data, and report the one you chose. Week 21 shows the same trade-off from the other side: a 95% interval that excludes 0 matches a two-sided test that rejects H₀: p₁ = p₂ at α = 0.05.

## Scope: who and why

The interval's arithmetic is the same for a survey and an experiment; the conclusion is not.

- **Independent random samples from two populations:** generalise to those populations. A difference is an *association* with group membership; no cause-and-effect claim.
- **Random assignment of subjects to treatments:** a convincing difference can be attributed to the treatments. Generalise only to subjects like those in the study unless they were also randomly selected.
- **Neither:** the interval's conditions fail; any conclusion is limited to the people measured and cannot be causal.

## Common mistakes

- **"The interval contains 0, so the proportions are equal."** 0 is plausible, but so are other values. Say "not convincing evidence of a difference".
- **"0.10 is in the interval, so the gap is 0.10."** A plausible value is not the value.
- **Ignoring the order of subtraction** and naming the wrong group as larger.
- **Supporting a size claim because some plausible values meet it.** All of them must.
- **Claiming causation from two random samples**, or generalising an experiment's volunteers to everyone.
- **Using "prove", "accept" or a probability about the parameter** in the conclusion.

## Self-check

1. A 95% interval for p_A − p_B is (0.01, 0.15). What can you conclude about which proportion is larger?
2. The same study reports (−0.01, 0.17) at 99%. Is that a contradiction?
3. A 95% interval for p_new − p_old is (0.05, 0.21). A company says the new design raises the proportion by at least 0.04. Is the claim supported?
4. A 95% interval for p_city − p_rural is (−0.18, −0.07). Which group has the higher proportion?
5. In worked example 2, a reader writes "the survey proved support is the same in both towns". Correct the sentence.

*Answers:* 1. Convincing evidence that p_A > p_B: all plausible values are positive. 2. No. The 99% interval is wider and can include 0 when the 95% one does not; at 99% confidence the evidence is not convincing. 3. Yes: every plausible value is at least 0.05, which exceeds 0.04 (and random assignment would be needed to say the design causes it). 4. Rural: every plausible value of p_city − p_rural is negative. 5. "The survey did not give convincing evidence that support differs between the towns; a difference of 0 is plausible, but so are differences of several percentage points either way."

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 3, Topic 3.11). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
