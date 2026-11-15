# Week 09 · Simulation and the Language of Probability

**Topics:** 2.3 Estimating Probabilities Using Simulation · 2.4 Introduction to Probability
**Practices:** 2 (Collect Data), 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 2, Topics 2.3–2.4, learning objectives in our own words
**Spiral:** Week 8 computed relative frequencies from two-way tables. Week 6 used random number generators to choose samples. This week reads a relative frequency over many repetitions as a probability, uses random digits to imitate a chance process, and sets up the vocabulary (sample space, events, complements) that weeks 10 and 11 build on.

## What you need to be able to do

- **2.3** Describe a simulation completely: how random digits or a random number generator model one outcome, what one trial is, what is recorded, and how the probability is estimated.
- **2.3** Estimate a probability as the relative frequency of an event in many simulated trials, and explain why more trials give a better estimate (the law of large numbers).
- **2.3** Use simulation results to judge whether an observed outcome would be surprising under a claimed chance model.
- **2.4** Interpret a probability as a long-run relative frequency.
- **2.4** List a sample space, compute probabilities when outcomes are equally likely, check that a probability model is valid, and use the complement rule.

## Key terms

| Term | Meaning |
|---|---|
| Random process | A process whose individual outcomes are unpredictable but which shows a regular pattern over many repetitions. |
| Probability of an event | The proportion of times the event would occur in a very long series of repetitions of the random process. |
| Law of large numbers | As the number of repetitions grows, the relative frequency of an event gets closer and closer to its true probability. |
| Simulation | Imitating a random process with a model (random digits, a random number generator, cards) to estimate a probability. |
| Trial | One complete repetition of the simulated process, ending in one recorded result. |
| Sample space | The list of all possible outcomes of a random process. |
| Event | A collection of outcomes from the sample space. |
| Complement Aᶜ | The event that A does not occur; P(Aᶜ) = 1 − P(A). |
| Probability model | A sample space with a probability for each outcome; the probabilities are between 0 and 1 and add to 1. |

## Probability as long-run relative frequency (2.4)

Toss a coin ten times and you might see 7 heads. Toss it ten thousand times and the proportion of heads will be very close to 0.5. That is the **law of large numbers**: in the short run, chance outcomes are unpredictable; in the long run, the relative frequency settles down to the probability.

So when a weather app says "a 30% chance of rain", the probability statement means: on many days with conditions like these, it rains on about 30% of them. It does not mean it will rain 30% of the day, and it says nothing certain about tomorrow alone.

The law of large numbers does **not** say that chance corrects itself in the short run. After five heads in a row, a fair coin still has probability 0.5 of heads on the next toss. Believing tails is "due" is the gambler's fallacy.

## Sample spaces, equally likely outcomes and the complement rule (2.4)

When all the outcomes in a sample space are **equally likely**,

> P(A) = (number of outcomes in A) ÷ (number of outcomes in the sample space).

Every probability model must satisfy two rules: each probability is between 0 and 1, and the probabilities of all the outcomes add to 1. From the second rule comes the **complement rule**, P(Aᶜ) = 1 − P(A), which is often the quick way to find "at least one" probabilities.

**Worked example 1 (two dice).** Roll two fair six-sided dice. The sample space has 6 × 6 = 36 equally likely ordered pairs, from (1, 1) to (6, 6).

- P(sum is 8): the pairs (2, 6), (3, 5), (4, 4), (5, 3), (6, 2), so 5/36 ≈ 0.139.
- P(at least one six): the complement is "no six", which happens in 5 × 5 = 25 pairs. So P(at least one six) = 1 − 25/36 = 11/36 ≈ 0.306.
- Why not 1/6 + 1/6 = 1/3? Adding counts the pair (6, 6) twice. Week 10 turns that observation into the general addition rule.

**Worked example 2 (a probability model).** In a hypothetical town, a randomly chosen household's main pet is modelled as: no pet 0.38, dog 0.29, cat 0.21, other ?

- The probabilities must add to 1, so P(other) = 1 − (0.38 + 0.29 + 0.21) = 0.12.
- P(the household has some pet) = 1 − P(no pet) = 1 − 0.38 = 0.62.
- P(main pet is not a dog) = 1 − 0.29 = 0.71.

A list such as 0.40, 0.35, 0.30 for three outcomes cannot be a probability model (it adds to 1.05), and neither can any list with a negative entry.

## Estimating probabilities by simulation (2.3)

Many probabilities are hard to compute exactly. A **simulation** imitates the random process many times and uses the relative frequency as an estimate. A complete description has four parts, and AP scoring expects all of them:

1. **Model one outcome.** Say exactly which digits (or random integers) stand for which outcome, so that each outcome gets the right probability. State any assumptions, such as independent shots.
2. **Describe one trial.** Say how many digits make one trial, whether repeats are allowed, and what you record at the end of the trial.
3. **Repeat many times.** Many trials, such as 100 or 1,000, not 5.
4. **Estimate.** The estimated probability is the number of trials in which the event happened divided by the number of trials.

Matching digits to probabilities: for probability 0.7, use the single digits 0–6 (seven of the ten digits). For probability 0.15, single digits will not work, so use pairs of digits: 00–14 for success and 15–99 for failure (15 of the 100 pairs). When the process samples **without** replacement, such as drawing names from a hat, skip a repeated label within a trial.

**Worked example 3 (free throws).** A hypothetical basketball player makes 70% of her free throws. Estimate the probability that she makes at least 4 of her next 5, assuming the shots are independent.

- **Model:** one random digit per shot; 0–6 = make, 7–9 = miss.
- **Trial:** read 5 digits and count the makes. Record whether the count is at least 4.
- Here are the first ten trials from a line of random digits:

```
Digits:  09225 73227 91253 73976 66461 78600 73350 41856 31173 57675
Makes:     4     3     4     2     5     3     4     4     4     3
4 or 5?  yes    no   yes    no   yes    no   yes   yes   yes    no
```

- Ten trials give 6/10 = 0.6, which is a rough estimate. A computer repeating the trial 1,000 times found 531 trials with at least 4 makes, so the estimate is 531/1,000 ≈ 0.53. (The exact value, which week 12 will show how to compute, is about 0.528: the long run settles where the law of large numbers says it will.)

### Is a result surprising? (2.3)

Simulation also answers a central question of statistics: **could this result easily happen by chance alone, if a claimed model is true?** Simulate the process assuming the claim, and see how often a result at least as extreme as the observed one turns up. If it almost never happens, the observed result is evidence against the claim. If it happens fairly often, chance is a plausible explanation.

**Worked example 4 (presentation order).** A teacher says she picks presenters at random. Her class has 8 juniors and 16 seniors, and the first five names drawn were all seniors. Some juniors suspect she favours seniors.

- **Model:** label the students 01–24, with 01–08 the juniors and 09–24 the seniors. Ignore 00 and 25–99.
- **Trial:** read pairs of digits until five different labels from 01–24 have appeared (skip repeats, because a name cannot be drawn twice). Record whether all five are seniors.
- **Repeat:** a computer ran 1,000 trials and 98 had five seniors, an estimate of 98/1,000 ≈ 0.098.
- **Conclusion:** if the draws really are random, five seniors in a row happens in about 10% of draws. That is not unusual, so this outcome does not give convincing evidence that the teacher favours seniors. (The exact probability is (16/24)(15/23)(14/22)(13/21)(12/20) = 26/253 ≈ 0.103.)

Notice the logic: we **assumed** the claim was true, then asked how surprising the data would be. "Not surprising" does not prove the draws are fair; it only means the data do not give strong evidence against fairness. This is the reasoning of every significance test in Units 3 and 4. A common working rule is that a result happening less than about 5% of the time by chance is surprising enough to doubt the claim.

## Common mistakes

- **Incomplete simulation descriptions.** Say what the digits mean, what one trial is, what you record, and how the estimate is computed.
- **Digit assignments that give the wrong probability.** 0.15 cannot be modelled with single digits; 00–15 is sixteen pairs, which gives 0.16.
- **Allowing repeats when the real process cannot repeat.** Drawing names, choosing a committee and dealing cards are without replacement: skip repeated labels.
- **Too few trials.** Ten trials give a noisy estimate. The law of large numbers needs many repetitions.
- **The gambler's fallacy.** Independent chance outcomes do not even out in the short run.
- **Adding probabilities that overlap.** P(at least one six in two rolls) is not 1/6 + 1/6.
- **Treating "not surprising" as proof the claim is true.** It means only that chance alone could explain the result.

## Where this goes next

Week 10 adds the rules for "or" and "and": mutually exclusive events, conditional probability (back to two-way tables) and independence. Week 11 attaches numbers to outcomes with random variables and finds their means and standard deviations. Week 12 replaces the free-throw simulation with the binomial distribution.

## Self-check

1. Describe how to use random digits to simulate a spinner that lands on red with probability 0.35.
2. Roll two fair dice. What is P(both dice show the same number)?
3. A model for a randomly chosen student's lunch: home 0.40, cafeteria 0.45, off campus ?. What is P(off campus)? P(not cafeteria)?
4. A simulation of 500 trials finds the event in 41 trials. Estimate its probability.
5. Why does a weather forecaster's "70% chance of rain" not turn out to be wrong when it does not rain?
6. Under a claimed model, a simulation finds a result as extreme as the observed one in 3 of 200 trials. What do you conclude?

*Answers:* 1. Use pairs of digits: 00–34 = red, 35–99 = not red; each pair is one spin. 2. 6/36 = 1/6. 3. 0.15; 1 − 0.45 = 0.55. 4. 41/500 = 0.082. 5. Probability describes the long run: on many days like this one, about 70% have rain, so a dry day is expected about 30% of the time. 6. 3/200 = 0.015 is small, so the observed result would be surprising if the model were true: it is convincing evidence against the claimed model.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 2, Topics 2.3–2.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
