# Week 12 · The Binomial Distribution

**Topics:** 2.10 The Binomial Distribution
**Practices:** 3 (Analyze Data), 4 (Interpret Results), 2 (Collect Data)
**Framework:** AP Statistics CED (effective fall 2026), Unit 2, Topic 2.10, learning objectives in our own words
**Spiral:** Week 9 estimated probabilities by simulation and set out the basic rules; week 10 multiplied probabilities of independent events and added probabilities of mutually exclusive ones; week 11 described a discrete random variable by its probability distribution, mean and standard deviation. A binomial random variable is the first named family of discrete random variables: every one of those tools is used at once, and the mean and standard deviation come from short formulas instead of a long table.

## What you need to be able to do

- **2.10** Decide whether a situation produces a binomial random variable by checking the four conditions in context, including the 10% condition when sampling without replacement.
- **2.10** State the parameters n and p, and define X in words ("X = the number of the 20 seeds that germinate").
- **2.10** Compute P(X = k) with the binomial formula or a calculator, and cumulative probabilities such as P(X ≤ k) and P(X ≥ k), using the complement where it saves work.
- **2.10** Compute and interpret the mean np and the standard deviation √(np(1 − p)) of a binomial random variable.
- **2.10** Describe the shape of a binomial distribution from n and p, and use a binomial probability to judge whether an observed count is unusual under a claim.

## Key terms

| Term | Meaning |
|---|---|
| Trial | One repetition of the chance process: one shot, one seed, one surveyed student. |
| Success / failure | The two outcomes of a trial that we choose to count. "Success" is just the outcome being counted, not a good thing. |
| Binomial setting | A fixed number n of independent trials, each a success or a failure, with the same probability p of success on every trial. |
| Binomial random variable | X = the number of successes in a binomial setting. Its possible values are 0, 1, 2, ..., n. |
| Binomial coefficient | nCk = n! / (k!(n − k)!), the number of ways to arrange k successes among n trials. |
| Cumulative probability | P(X ≤ k), the probability of k or fewer successes (binomcdf on most calculators). |
| 10% condition | When sampling without replacement, trials are close enough to independent if n ≤ 10% of the population. |

## Recognising a binomial setting (2.10)

Many questions ask how many times something happens in a set number of tries: how many of 10 free throws go in, how many of 30 randomly chosen students have a part-time job, how many of 25 guessed answers are right. These counts share a structure. Check four conditions, and write each one in the context of the problem.

1. **Binary:** each trial ends in one of two outcomes, success or failure.
2. **Independent:** the outcome of one trial does not change the probability for another trial.
3. **Number:** the number of trials n is fixed in advance.
4. **Same probability:** p is the same on every trial.

Some students remember the conditions as "BINS". When all four hold, X = the number of successes is a **binomial random variable** with parameters n and p.

Watch for the conditions that fail most often.

- **No fixed n.** "Roll a die until you get a six and count the rolls" has no fixed number of trials, so the count of rolls is not binomial.
- **Not a count of successes.** "The total points a player scores in 10 games" is a sum of quantities, not a count of yes/no outcomes.
- **Dependence from sampling without replacement.** Choosing people without replacement changes the population a little after each pick. If the sample is small compared with the population, the change is tiny and we treat the trials as independent. The rule is the **10% condition**: n ≤ 10% of the population.

**Worked example (checking the conditions).** A hypothetical high school has 2,000 students, and 35% of them have a part-time job. A reporter for the school paper selects 30 students at random and counts X = the number with a part-time job. Is X binomial?

- Binary: each selected student has a part-time job (success) or does not (failure).
- Independent: the sampling is without replacement, but 30 ≤ 10% of 2,000 = 200, so the trials are approximately independent.
- Number: n = 30 is fixed.
- Same probability: each randomly chosen student has a 0.35 chance of having a job.

So X is approximately binomial with n = 30 and p = 0.35. If instead the reporter chose 30 students from a club of 80 members, 30 is more than 10% of 80, and the binomial model would not be appropriate.

## Binomial probabilities (2.10)

Why does P(X = k) have the form it does? Any one particular arrangement of k successes and n − k failures (for example SSF...S) has probability pᵏ(1 − p)ⁿ⁻ᵏ by the multiplication rule for independent events. There are nCk different arrangements, and they are mutually exclusive, so we add them:

> P(X = k) = nCk · pᵏ · (1 − p)ⁿ⁻ᵏ, for k = 0, 1, ..., n.

On a calculator, binompdf(n, p, k) gives P(X = k) and binomcdf(n, p, k) gives P(X ≤ k). Write the setup in words or symbols, not just the calculator syntax: "X is binomial with n = 10 and p = 0.7; P(X = 7) = 0.267".

**Worked example (a single value and an "at least").** A hypothetical high-school basketball player makes 70% of her free throws, and her shots are independent. In a game she takes 10 free throws. Let X = the number she makes, binomial with n = 10, p = 0.7.

- P(X = 7) = 10C7 · 0.7⁷ · 0.3³ = 120 · 0.08235 · 0.027 = 0.267.
- P(X ≥ 8) = P(X = 8) + P(X = 9) + P(X = 10) = 0.2335 + 0.1211 + 0.0282 = 0.383. With a calculator: 1 − binomcdf(10, 0.7, 7) = 1 − 0.6172 = 0.383.

The subtraction step is where most mistakes happen. "At least 8" is the complement of "at most 7", so subtract P(X ≤ 7), not P(X ≤ 8). Saying the inequality in words before you type anything prevents the slip.

The complement is also the fast route to "at least one". In a hypothetical cafeteria, 30% of students choose the vegetarian option. For 12 randomly chosen students, P(at least one vegetarian) = 1 − P(X = 0) = 1 − 0.7¹² = 1 − 0.0138 = 0.986.

## Mean, standard deviation and shape (2.10)

For a binomial random variable,

> mean μ_X = np, standard deviation σ_X = √(np(1 − p)).

You could get these from the week 11 formulas Σx·P(x) and √(Σ(x − μ)²·P(x)) applied to the whole table; the shortcuts give the same answers.

**Worked example (mean and SD in context).** A hypothetical garden-supply company says 85% of its tomato seeds germinate. A class plants 20 seeds. X = number that germinate is binomial with n = 20, p = 0.85.

- μ_X = 20(0.85) = 17. Interpretation: if the class planted many batches of 20 seeds, the number germinating would average about 17 seeds per batch in the long run.
- σ_X = √(20 · 0.85 · 0.15) = √2.55 = 1.60. Interpretation: the number of seeds that germinate in a batch of 20 typically varies by about 1.6 seeds from the mean of 17.

Note that the mean is a long-run average, not a promise: a batch of exactly 17 germinating seeds happens only about 24% of the time.

**Shape.** When p = 0.5 the distribution is symmetric. When p is below 0.5 it is skewed right (the long tail is toward the large counts), and when p is above 0.5 it is skewed left. The seed distribution (p = 0.85) is skewed left: most batches have 16 to 19 germinating seeds, with a thin tail down toward 12 or 13. As n grows, the skew fades and the shape becomes closer to normal, which week 14 uses for the sampling distribution of a sample proportion and Unit 3 uses again.

## Using a binomial probability to judge a claim (2.10)

A binomial probability tells you how surprising an outcome would be if the stated p were true. A very small probability for the observed result or something more extreme is evidence against the claim.

**Worked example (is the student guessing?).** A hypothetical 25-question multiple-choice quiz has four options per question. If a student guesses on every question, X = number correct is binomial with n = 25, p = 0.25, mean 6.25 and SD 2.17. One student gets 12 right. How likely is 12 or more by guessing alone?

P(X ≥ 12) = 1 − binomcdf(25, 0.25, 11) = 1 − 0.9893 = 0.0107.

If the student were purely guessing, there would be only about a 1% chance of 12 or more correct. That result is unusual enough to give convincing evidence that the student was not purely guessing. It does not prove that the student studied, and it says nothing about which questions were guessed.

Two habits make these judgements correct. First, use the tail: compute P(X ≥ 12), not P(X = 12). Any single value can be unlikely when n is large, so the question is how likely a result **this extreme or more** would be. Second, phrase the conclusion conditionally: "if p were 0.25, ...". The binomial probability is about the data, assuming the claim, never the probability that the claim is true.

## Common mistakes

- Calling a count binomial without checking all four conditions, or checking them without context.
- Forgetting the 10% condition when the sample is drawn without replacement.
- Leaving out nCk, so that P(X = 7) becomes 0.7⁷ · 0.3³ = 0.0022 instead of 0.267.
- Taking 1 − P(X ≤ 8) for "at least 8". The complement of "8 or more" is "7 or fewer".
- Computing the standard deviation as np(1 − p) (that is the variance) or as √(p(1 − p)/n) (that is the SD of a sample proportion, a week 14 idea).
- Swapping success and failure halfway through: if p is the probability of a defect, X counts defects.
- Interpreting the mean as the most likely or guaranteed count.
- Using P(X = k) instead of a tail probability to decide whether a result is unusual.

## Self-check

1. A coin is flipped until it lands heads, and X counts the flips. Is X binomial? **Answer:** No. There is no fixed number of trials.
2. X is binomial with n = 5 and p = 0.3. Find P(X = 2). **Answer:** 5C2 · 0.3² · 0.7³ = 10 · 0.09 · 0.343 = 0.309.
3. For the same X, find the mean and the standard deviation. **Answer:** μ = 1.5 and σ = √(5 · 0.3 · 0.7) = 1.02.
4. The basketball player above shoots 10 free throws. What is P(X ≤ 5)? **Answer:** binomcdf(10, 0.7, 5) = 0.150.
5. In the part-time-job example (n = 30, p = 0.35), would 15 or more students with jobs be surprising? **Answer:** P(X ≥ 15) = 0.065. That is somewhat unlikely but not rare; it would not be strong evidence that more than 35% of the school's students have jobs.
6. Is B(20, 0.85) skewed left or right? **Answer:** Left, because p is above 0.5.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 2, Topic 2.10). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
