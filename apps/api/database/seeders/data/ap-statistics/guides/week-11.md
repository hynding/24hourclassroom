# Week 11 · Random Variables, Probability Distributions and Their Parameters

**Topics:** 2.8 Introduction to Random Variables and Probability Distributions · 2.9 Parameters of Random Variables
**Practices:** 3 (Analyze Data), 4 (Interpret Results)
**Framework:** AP Statistics CED (effective fall 2026), Unit 2, Topics 2.8–2.9, learning objectives in our own words
**Spiral:** Week 7 described distributions of data by shape, center and variability, using the mean and the standard deviation. Weeks 9 and 10 built probability models and the rules for "and", "or" and "given". This week attaches a number to each outcome of a random process, so that a probability model becomes a distribution with its own mean and standard deviation: a model for what the data would look like in the long run.

## What you need to be able to do

- **2.8** Define a random variable in context and say whether it is discrete or continuous.
- **2.8** Build the probability distribution of a discrete random variable from a random process (a table, a formula or a probability histogram), check that it is valid, and find probabilities such as P(X ≥ 2) and P(X < 1), including cumulative probabilities.
- **2.9** Compute the mean (expected value) μ_X = Σ x · P(x) of a discrete random variable and interpret it as a long-run average.
- **2.9** Compute the standard deviation σ_X = √(Σ (x − μ_X)² · P(x)) and interpret it as the typical distance of the values from the mean in the long run.
- **2.9** Use an expected value to compare options or to judge whether a game is fair.

## Key terms

| Term | Meaning |
|---|---|
| Random variable | A variable whose numerical value is determined by the outcome of a random process (usually written X). |
| Discrete random variable | Takes a countable set of separate values, such as 0, 1, 2, 3. |
| Continuous random variable | Takes any value in an interval, such as a time or a length; probabilities are areas under a density curve. |
| Probability distribution | The possible values of a random variable and their probabilities. |
| Cumulative probability | P(X ≤ x): the probability that X is at most a given value. |
| Mean (expected value) μ_X | Σ x · P(x): the long-run average value of X over many repetitions. |
| Variance σ²_X | Σ (x − μ_X)² · P(x): the probability-weighted average squared distance from the mean. |
| Standard deviation σ_X | √(variance): the typical distance between a value of X and μ_X in the long run. |

## Random variables and their distributions (2.8)

A **random variable** turns each outcome of a random process into a number: the number of correct guesses on a quiz, the number of people in a car, the net amount won in a game. Always define it in context: "X = the number of people in a randomly chosen car at the school drop-off."

A **discrete** random variable has separate values you can list. A **continuous** random variable can take any value in an interval (the time it takes to run a mile, the weight of an apple). For a continuous random variable, probabilities are areas under a density curve, and the probability of any single exact value is 0; week 13's Normal distribution is the main example. This week works with discrete random variables.

A discrete probability distribution is valid when every probability is between 0 and 1 and the probabilities add to 1, exactly as for any probability model (week 9). It can be shown as a table or as a **probability histogram**, with one bar per value and bar heights equal to the probabilities. Describe its shape the way you described data in Unit 1: symmetric, skewed right, skewed left.

**Worked example 1 (guessing on two questions).** A student guesses at random on two multiple-choice questions, each with four options, and the guesses are independent. Let X = the number of correct answers.

- P(X = 0) = (3/4)(3/4) = 9/16 = 0.5625.
- P(X = 1) = (1/4)(3/4) + (3/4)(1/4) = 6/16 = 0.375. There are two orders: right then wrong, wrong then right.
- P(X = 2) = (1/4)(1/4) = 1/16 = 0.0625.

| x | 0 | 1 | 2 |
|---|---|---|---|
| P(X = x) | 0.5625 | 0.375 | 0.0625 |

The probabilities add to 1. The probability histogram is skewed right: most of the probability sits at 0. P(X ≥ 1) = 1 − 0.5625 = 0.4375.

**Worked example 2 (cars at drop-off).** At a hypothetical school, let X = the number of people in a randomly chosen car at morning drop-off (including the driver).

| x | 1 | 2 | 3 | 4 |
|---|---|---|---|---|
| P(X = x) | 0.45 | 0.30 | 0.15 | 0.10 |

- Valid: each value is between 0 and 1, and 0.45 + 0.30 + 0.15 + 0.10 = 1.
- P(X ≥ 3) = 0.15 + 0.10 = 0.25. P(X < 3) = 0.45 + 0.30 = 0.75.
- Cumulative distribution: P(X ≤ 1) = 0.45, P(X ≤ 2) = 0.75, P(X ≤ 3) = 0.90, P(X ≤ 4) = 1.
- Watch the inequalities: "at least 3" includes 3; "more than 3" does not, so P(X > 3) = 0.10.

## The mean and standard deviation of a random variable (2.9)

The **mean** (or **expected value**) of a discrete random variable weights each value by its probability:

> μ_X = Σ x · P(x).

It is the average value of X you would see over a very large number of repetitions (the law of large numbers from week 9 again). It need not be a possible value of X.

The **standard deviation** measures how far the values typically fall from that mean:

> σ²_X = Σ (x − μ_X)² · P(x), and σ_X = √σ²_X.

There is no n − 1 here: these are parameters of a probability model, not statistics computed from a sample. On a calculator, put the values in one list and the probabilities in another and use one-variable statistics with the probabilities as frequencies.

**Worked example 2, continued.**

- μ_X = 1(0.45) + 2(0.30) + 3(0.15) + 4(0.10) = 0.45 + 0.60 + 0.45 + 0.40 = 1.90 people.
- σ²_X = (1 − 1.9)²(0.45) + (2 − 1.9)²(0.30) + (3 − 1.9)²(0.15) + (4 − 1.9)²(0.10) = 0.3645 + 0.003 + 0.1815 + 0.441 = 0.99.
- σ_X = √0.99 ≈ 0.995 people.

**Interpretations (AP language).**

- Mean: "If we observed many, many randomly chosen cars at drop-off, the average number of people per car would be about 1.90."
- Standard deviation: "The number of people in a randomly chosen car typically varies from the mean of 1.90 by about 0.995 people."

Do not say "we expect 1.90 people in the next car": no car holds 1.9 people. The expected value describes the long run.

**Worked example 3 (a raffle).** A hypothetical school club sells 500 raffle tickets at $5 each. One ticket wins $500, two tickets win $100, and five tickets win $20. Let X = the net gain for a person who buys one ticket.

| Outcome | Net gain x | P(X = x) |
|---|---|---|
| $500 prize | 500 − 5 = 495 | 1/500 = 0.002 |
| $100 prize | 95 | 2/500 = 0.004 |
| $20 prize | 15 | 5/500 = 0.010 |
| No prize | −5 | 492/500 = 0.984 |

- μ_X = 495(0.002) + 95(0.004) + 15(0.010) + (−5)(0.984) = 0.99 + 0.38 + 0.15 − 4.92 = −3.40 dollars.
- σ_X ≈ $23.27 (calculator, values weighted by the probabilities).
- **Interpretation:** over many, many tickets bought, the average net gain would be about −$3.40 per ticket; that is, ticket buyers lose about $3.40 per ticket in the long run, and the club gains it. The large standard deviation reflects the rare large prizes: a single ticket's net gain typically differs from −$3.40 by about $23.27.

### Fair games and decisions

A game is **fair** if the expected net gain is 0. Expected values also compare choices. Suppose a hypothetical repair plan for a $300 phone costs $40 a year, and without it there is a 0.12 probability of a $250 repair in a year. The expected repair cost without the plan is 0.12 × 250 = $30, less than the $40 plan, so in the long run, people who skip the plan pay less on average. (Someone who could not afford a surprise $250 bill might still buy the plan; the standard deviation captures that risk.)

## Common mistakes

- **Not defining the random variable.** Write "X = the number of ..." in context before computing anything.
- **Averaging the values instead of weighting them.** The mean of 0, 1, 2, 3, 4 with unequal probabilities is not 2.
- **Reporting the variance as the standard deviation.** Take the square root.
- **Treating the expected value as a prediction for one trial.** It is a long-run average and need not be a possible value.
- **Mixing up "at least", "more than", "at most" and "fewer than".** Write the inequality with the values it includes.
- **Forgetting the cost in a net-gain problem.** Subtract the price of the ticket from every outcome, including the winning ones.
- **Using n − 1 for a probability distribution.** σ_X weights by probabilities; there is no sample size.

## Where this goes next

Week 12 meets a special discrete distribution, the binomial, with ready-made formulas for its mean and standard deviation. Week 13 moves to a continuous one, the Normal distribution, and week 14 uses both to describe sampling distributions.

## Self-check

1. Classify each as discrete or continuous: (a) the number of goals in a soccer match; (b) the time a student spends on homework tonight.
2. X takes the values 0, 1, 2 and 3 with probabilities 0.1, 0.3, k and 2k. Find k.
3. For the distribution in question 2, find μ_X.
4. In worked example 2, find P(X ≤ 2) and P(X > 2).
5. A game costs $3. You win $10 with probability 0.2 and nothing otherwise. Find the expected net gain. Is the game fair?
6. Interpret σ_X = 1.2 for X = the number of AP exams a randomly chosen junior takes.

*Answers:* 1. (a) discrete; (b) continuous. 2. 0.4 + 3k = 1, so k = 0.2. 3. 0(0.1) + 1(0.3) + 2(0.2) + 3(0.4) = 1.9. 4. 0.75; 0.25. 5. 7(0.2) + (−3)(0.8) = 1.4 − 2.4 = −$1.00 per play; not fair (players lose $1 per play in the long run). 6. The number of AP exams a randomly chosen junior takes typically varies from the mean by about 1.2 exams.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Unit 2, Topics 2.8–2.9). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
