# Week 18 · Carrying Out a Test for a Proportion and Errors in Testing

**Topics:** 3.7 Carrying Out a Test for a Population Proportion · 3.8 Potential Errors When Performing Tests
**Practices:** 3 (Analyze Data), 4 (Interpret Results), 1 (Formulate Questions)
**Framework:** AP Statistics CED (effective fall 2026), Unit 3, Topics 3.7–3.8, learning objectives in our own words
**Spiral:** Week 16 judged claims with a confidence interval; week 17 wrote hypotheses, checked conditions and computed and interpreted p-values. This week finishes the significance test: comparing the p-value with α, making a decision and stating the conclusion in context. Then it asks what can go wrong: every decision made from a sample can be wrong in one of two ways, and the chance of each depends on α, the sample size and how far the truth is from H₀.

## What you need to be able to do

- **3.7** Carry out a complete one-sample z-test for a population proportion: hypotheses, conditions, test statistic and p-value, decision and conclusion in context.
- **3.7** Compare the p-value with α to reject or fail to reject H₀, and write the conclusion in "convincing evidence" language without accepting H₀.
- **3.7** Connect a two-sided test at level α with a (1 − α) confidence interval, and state the scope of the conclusion.
- **3.8** Describe a Type I and a Type II error in context and their consequences, and identify which error is possible after a given decision.
- **3.8** State that P(Type I error) = α, define power as 1 − P(Type II error), and explain how α, sample size and the true value of p affect power.

## Key terms

| Term | Meaning |
|---|---|
| Significance level α | The threshold set before collecting data; reject H₀ when the p-value is at most α. It is also P(Type I error). |
| Reject H₀ | The p-value ≤ α: the data give convincing evidence for Hₐ. |
| Fail to reject H₀ | The p-value > α: the data do not give convincing evidence for Hₐ. (Never "accept H₀".) |
| Type I error | Rejecting H₀ when H₀ is actually true: a false alarm. |
| Type II error | Failing to reject H₀ when Hₐ is actually true: a missed detection. |
| β | P(Type II error) for a particular alternative value of p. |
| Power | P(rejecting H₀ when a particular alternative value is true) = 1 − β. |
| Statistically significant | A result with p-value ≤ α: too unlikely under H₀ to put down to chance. |

## Carrying out the test (3.7)

A complete test has four parts. On the AP exam each part earns credit, and the conclusion must link the p-value, α and the context.

1. **State:** name the test (one-sample z-test for p), state H₀ and Hₐ, define p in context, give α.
2. **Plan:** check Random, 10% and Large Counts (np₀ and n(1 − p₀)).
3. **Do:** compute p̂, the test statistic z = (p̂ − p₀)/√(p₀(1 − p₀)/n) and the p-value.
4. **Conclude:** "Because the p-value = ___ < α = ___, we reject H₀. There is convincing evidence that [Hₐ in context]." Or: "Because the p-value = ___ > α = ___, we fail to reject H₀. There is not convincing evidence that [Hₐ in context]."

The conclusion is always about Hₐ, because the test only ever looks for evidence in favour of Hₐ. A large p-value means the evidence was not strong enough; it does not show that H₀ is true. Write "fail to reject H₀", never "accept H₀", and never "proves".

**Worked example (a one-sided test that rejects).** A seed supplier claims that 90% of its tomato seeds germinate. A biology class plants a random sample of 160 seeds from a shipment of several thousand; 136 germinate. At α = 0.05, is there convincing evidence that the germination rate is less than 90%?

1. **State.** One-sample z-test for p. H₀: p = 0.90, Hₐ: p < 0.90, where p = the proportion of all seeds in the shipment that germinate. α = 0.05.
2. **Plan.** Random: a random sample of seeds. 10%: 160 is less than 10% of several thousand seeds. Large Counts: 160(0.90) = 144 and 160(0.10) = 16 are both at least 10.
3. **Do.** p̂ = 136/160 = 0.85. SD = √(0.90 · 0.10 / 160) ≈ 0.0237. z = (0.85 − 0.90)/0.0237 ≈ −2.11. p-value = P(Z ≤ −2.11) ≈ 0.0175.
4. **Conclude.** Because the p-value of 0.0175 is less than α = 0.05, we reject H₀. There is convincing evidence that the proportion of all seeds in the shipment that germinate is less than 0.90.

**Worked example (a two-sided test that fails to reject).** A hypothetical district report says 45% of its seniors plan to attend a four-year college. A counsellor surveys a simple random sample of 220 of the district's 3,400 seniors; 108 plan to attend. Test at α = 0.05 whether the proportion differs from 45%.

1. **State.** One-sample z-test for p. H₀: p = 0.45, Hₐ: p ≠ 0.45, where p = the proportion of all the district's seniors who plan to attend a four-year college. α = 0.05.
2. **Plan.** Random: SRS. 10%: 220 ≤ 340. Large Counts: 220(0.45) = 99 and 220(0.55) = 121.
3. **Do.** p̂ = 108/220 ≈ 0.491. SD = √(0.45 · 0.55 / 220) ≈ 0.0335. z ≈ (0.491 − 0.45)/0.0335 ≈ 1.22. p-value = 2 · P(Z ≥ 1.22) ≈ 0.22.
4. **Conclude.** Because the p-value of 0.22 is greater than α = 0.05, we fail to reject H₀. There is not convincing evidence that the proportion of all the district's seniors who plan to attend a four-year college differs from 0.45.

**Tests and intervals agree.** A 95% confidence interval from the same data is 0.491 ± 1.96√(0.491 · 0.509 / 220) = (0.425, 0.557). It contains 0.45, matching the decision not to reject at α = 0.05. In general a two-sided test at level α and a (1 − α) interval usually reach the same verdict on p₀; the interval also shows which other values are plausible. (The match can fail very near the boundary, because the test's standard deviation uses p₀ and the interval's uses p̂.)

**Scope.** Both examples used random samples, so the conclusions extend to the populations sampled (the shipment, the district's seniors). A test on an observational sample cannot show that a change *caused* anything: if the counsellor's proportion had risen after a new advising programme, the test alone would not show the programme was the reason. Cause and effect needs random assignment.

## Two kinds of error (3.8)

The test's decision is made from a sample, so it can be wrong.

| | H₀ is true | Hₐ is true |
|---|---|---|
| Reject H₀ | Type I error | Correct decision (power) |
| Fail to reject H₀ | Correct decision | Type II error |

Describe each error in context by saying what the test concluded and what is actually true:

**Worked example (errors for the seed test).**

- **Type I error:** the class concludes that the germination rate is less than 90% when in fact it is 90%. Consequence: the class complains to, or stops buying from, a supplier whose claim was accurate.
- **Type II error:** the class finds no convincing evidence that the rate is below 90% when in fact it is below 90%. Consequence: the class keeps buying seeds that germinate less often than advertised and plants fewer tomatoes than planned.

Because the class rejected H₀, the only error it could have made is a **Type I** error. After failing to reject, the only possible error is **Type II**. You never know which (if either) actually happened, because you never know the true p.

## Probabilities of errors and power

- **P(Type I error) = α.** If H₀ is true, the test rejects whenever the p-value falls at or below α, which happens with probability α. Choosing α = 0.01 instead of 0.05 makes false alarms rarer.
- **P(Type II error) = β** depends on the true value of p. It is large when the truth is close to p₀ and small when it is far away.
- **Power = 1 − β:** the probability that the test correctly detects a particular alternative.

Power increases when:

| Change | Why |
|---|---|
| Larger sample size n | Smaller SD of p̂, so a real difference is easier to see. The only change that raises power without raising α. |
| Larger α | Easier to reject H₀, but at the cost of more Type I errors. |
| True p farther from p₀ | Bigger differences are easier to detect. |

Lowering α to avoid Type I errors **increases** the chance of a Type II error, for a fixed sample size. Which error is more serious depends on the context, and that should guide the choice of α: if a false alarm is costly, use a small α; if a miss is dangerous, use a larger α, or better, a larger sample.

**Worked example (computing power).** In the seed test (n = 160, α = 0.05), suppose the true germination rate is 0.85. How likely is the test to detect that?

1. The test rejects H₀ when z ≤ −1.645, that is, when p̂ ≤ 0.90 − 1.645(0.0237) ≈ 0.861.
2. If p = 0.85, p̂ has mean 0.85 and SD √(0.85 · 0.15 / 160) ≈ 0.0282.
3. Power = P(p̂ ≤ 0.861 when p = 0.85) = P(Z ≤ (0.861 − 0.85)/0.0282) = P(Z ≤ 0.39) ≈ 0.65. So β ≈ 0.35.

The same calculation gives a power of about 0.92 with 400 seeds, about 0.43 with 160 seeds at α = 0.01, and about 0.97 with 160 seeds if the true rate is 0.80. Each line matches the table: more data, larger α, or a bigger true difference raise power.

## Common mistakes

- **"We accept H₀."** Write "fail to reject H₀" and "there is not convincing evidence that [Hₐ]".
- **A decision with no context, or context with no decision.** The conclusion needs both, plus the comparison of the p-value with α.
- **Conclusions about the sample.** "There is convincing evidence that the proportion of the 160 seeds..." is wrong; the conclusion is about all the seeds.
- **Describing errors without context, or swapping them.** Type I: rejecting a true H₀. Type II: failing to reject a false H₀.
- **Naming the wrong possible error.** After rejecting, only a Type I error is possible; after failing to reject, only Type II.
- **"Power is the probability H₀ is false."** Power is the probability of rejecting H₀ when a particular alternative is true.
- **Claiming cause and effect from a sample survey.** Only random assignment supports causal conclusions.

## Self-check

1. A test gives p-value = 0.064 at α = 0.05. Write the decision and the general form of the conclusion.
2. The attendance office of a school of 3,200 students tests H₀: p = 0.12 against Hₐ: p < 0.12 for the proportion of chronically absent students after a new programme. A random sample of 300 has 27 chronically absent. Find z and the p-value, and conclude at α = 0.05.
3. In question 2, which error could the office have made? Describe it in context.
4. What is the probability of a Type I error in question 2 if H₀ is true?
5. Give two ways the office could increase the power of its test.
6. A student says the test in question 2 shows the programme had no effect. Explain two problems with that statement.

*Answers:* 1. Fail to reject H₀, because 0.064 > 0.05; there is not convincing evidence that [Hₐ in context]. 2. p̂ = 0.09; z = (0.09 − 0.12)/√(0.12 · 0.88 / 300) ≈ −1.60; p-value ≈ 0.055 > 0.05, so fail to reject H₀; there is not convincing evidence that the proportion of all students who are chronically absent is less than 0.12. 3. Type II: the proportion really is below 0.12 but the office did not find convincing evidence of it. 4. α = 0.05. 5. A larger sample; a larger α (such as 0.10), which also raises the risk of a Type I error. 6. Failing to reject does not show H₀ is true; and with no random assignment (no comparison group), the test could not show the programme caused any change anyway.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 3, Topics 3.7–3.8). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
