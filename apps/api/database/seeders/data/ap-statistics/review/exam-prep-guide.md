# Exam Prep Guide · AP Statistics

**Use it:** in week 33, before the practice final in week 34
**Covers:** all five units, every one of which the AP Statistics exam tests
**Framework:** AP Statistics Course and Exam Description (effective fall 2026); exam format from AP Central, May 2027 exam

This guide explains the May 2027 AP Statistics exam, how the practice final rehearses it and how free responses are scored, then collects the inference procedures, interpretation sentences and unit-by-unit facts to know cold, and a two-week review plan. If you are taking statistics as a regular course, the whole practice final is your final exam.

## The AP exam in May 2027

The exam is on **Tuesday, May 11, 2027**, in the afternoon session. It is **fully digital** in the Bluebook app: you select multiple-choice answers and **type** your free responses in Bluebook.

| Section | Questions | Time | Share of score |
|---|---|---|---|
| I: Multiple choice | 42, four options each | 1 hour 30 minutes | 50% |
| II: Free response | 4, 10 points each | 1 hour 30 minutes | 50% |

- **Calculators are allowed throughout**, in both sections: an approved graphing calculator, and Desmos is built into Bluebook.
- A **reference booklet** of formulas and tables (standard normal, t and chi-square) is provided. You do not need to memorise the formulas, but you do need to know which one to use and what every symbol means.
- Section I includes **two sets of three questions that share one prompt**: one set on probability, random variables and probability distributions, and one on regression.
- There is no penalty for a wrong multiple-choice answer, so never leave one blank.

### Typing your free responses

- Bluebook's **Ω menu** has x̄, p̂ and other symbols; practise finding them before May.
- Write intervals in words: "from 2.5 to 5.5", not a pair of numbers in parentheses that could be misread.
- Type the formula with the numbers substituted, then the result: "z = (0.352 − 0.30)/√(0.30 · 0.70/250) ≈ 1.79". Calculator keystrokes alone do not show your work.

### What the redesigned exam no longer tests

The geometric distribution, combining random variables, the chi-square goodness-of-fit test, inference for the slope of a regression line, and transformations are gone. Skip them in old review books.

## How the practice final maps onto it

The practice final has 70 questions. **Questions 1–46 are a full mock AP exam** in the order and timing above.

- **Questions 1–42: Section I.** Forty-two four-option multiple-choice questions in roughly the AP unit proportions: 11 on Unit 1, 8 on Unit 2, 9 on Unit 3, 7 on Unit 4 and 7 on Unit 5. Questions 12–14 share a probability distribution (smoothie purchases at a café) and questions 36–38 share a computer regression output (phone use in bed and hours of sleep), like the two shared-prompt sets on the real exam.
- **Question 43:** formulate an investigative question and design a randomized block experiment (Practices 1 and 2).
- **Question 44:** compare two distributions of commute times from summary statistics, choose a measure of center, and explain why an observational study cannot show cause and effect (Practices 3 and 4).
- **Question 45:** inference, a full two-sample t-test for a difference in means, with a p-value interpretation and a Type I error.
- **Question 46:** a multi-focus question on a random sample of runners: bias in an alternative sampling plan, then slope, residual, s and r² interpretations, causation and extrapolation (Practices 2, 3 and 4).

Each free-response question is scored out of 10 with a point-by-point guide in the AP style. Sit questions 1–46 in one block with the AP timings (3 hours, with a short break after question 42). Do not convert your total into a 1–5 score (cut points are not published in advance); note the topic of every lost point instead.

**Questions 47–70** are not AP format: select-all, true/false, numeric, fill-in-the-blank and short-answer items across all five units, including a four-question set on one two-way table. Do them on another day, in about 45 minutes.

## What each unit and practice contributes

| Unit | Multiple-choice weighting | What dominates the questions |
|---|---|---|
| 1 Exploring One-Variable Data and Collecting Data | 20–30% | variables, graphs and summaries, comparing distributions, investigative questions, sampling, bias, experimental design |
| 2 Probability, Random Variables, and Probability Distributions | 15–25% | two-way tables, simulation, probability rules, random variables, binomial and normal distributions, the Central Limit Theorem |
| 3 Inference for Categorical Data: Proportions | 15–25% | intervals and tests for one and two proportions, errors and power, chi-square tests for homogeneity and independence |
| 4 Inference for Quantitative Data: Means | 10–20% | t-intervals and t-tests for one mean, a mean difference (paired) and two means |
| 5 Regression Analysis | 10–20% | scatterplots, correlation, the least-squares line, residuals, interpretation |

The four statistical practices are weighted too: **Formulate Questions 5–10%, Collect Data 20–30%, Analyze Data 25–35%, Interpret Results 25–35%**. Much of the exam is about collecting data and interpreting results: a correct number with a vague sentence earns little.

## The free-response questions and how they are scored

Four questions, 10 points each, about 22 minutes each. The contexts change every year; the shapes are set by the exam:

- **Question 1: Practices 1 and 2 (formulate questions, collect data).** Write or critique an investigative question, describe a sampling method or an experimental design, explain random assignment or blocking, identify bias, and state the scope of inference.
- **Question 2: Practices 3 and 4 (analyze data, interpret results).** Describe or compare distributions, compute and interpret summary statistics or probabilities, and explain what the analysis does and does not show.
- **Question 3: inference.** A complete hypothesis test or confidence interval, often with an extra part on interpretation, errors or a follow-up claim.
- **Question 4: Practices 2, 3 and 4.** A multi-focus question that mixes how the data were collected with an analysis and its interpretation, often in an unfamiliar context.

**How the 10 points work.** Each point is attached to something specific, and the scoring guides in this course name it, so read them after every attempt:

- **Context points.** Every description, interpretation and conclusion must name the variable and the individuals ("commute time of bus riders"), not "the data".
- **Comparison points.** When comparing groups, use comparative words ("greater than", "more variable"); two separate lists earn nothing.
- **Inference points.** On a full test the points usually go to the hypotheses with parameters defined; the named procedure with conditions checked in context; the mechanics (test statistic and p-value, or the interval); and a conclusion that compares the p-value with α and answers the question in context.
- **Language points.** "Predicted", "convincing evidence", "we are 95% confident", "assuming H₀ is true". Leaving out one of these words can cost a whole point.
- **Consistency.** A wrong value carried correctly into later parts can still earn their points, so finish every part.

## The inference toolkit

Every procedure in the course. For each, the **Random** condition (a random sample, or random assignment in an experiment) applies, and when sampling without replacement the **10% condition** (n ≤ 10% of the population) applies too; they are not repeated in each row.

| Procedure | Parameter | Extra conditions | Statistic or interval |
|---|---|---|---|
| One-sample z-interval for p | p | np̂ ≥ 10 and n(1 − p̂) ≥ 10 | p̂ ± z* √(p̂(1 − p̂)/n) |
| One-sample z-test for p | p | np₀ ≥ 10 and n(1 − p₀) ≥ 10 | z = (p̂ − p₀)/√(p₀(1 − p₀)/n) |
| Two-sample z-interval for p₁ − p₂ | p₁ − p₂ | n₁p̂₁, n₁(1 − p̂₁), n₂p̂₂, n₂(1 − p̂₂) all ≥ 10; independent samples | (p̂₁ − p̂₂) ± z* √(p̂₁(1 − p̂₁)/n₁ + p̂₂(1 − p̂₂)/n₂) |
| Two-sample z-test for p₁ − p₂ | p₁ − p₂ | the four counts with the pooled p̂c all ≥ 10 | z = (p̂₁ − p̂₂)/√(p̂c(1 − p̂c)(1/n₁ + 1/n₂)), p̂c = (x₁ + x₂)/(n₁ + n₂) |
| Chi-square test for homogeneity | distributions of one categorical variable in two or more populations | independent random samples (or groups from random assignment); all expected counts ≥ 5 | χ² = Σ (observed − expected)²/expected, df = (rows − 1)(columns − 1) |
| Chi-square test for independence | association between two categorical variables in one population | one random sample classified two ways; all expected counts ≥ 5 | same χ² and df; expected = (row total)(column total)/(table total) |
| One-sample t-interval for μ | μ | n ≥ 30, or sample data show no strong skew or outliers | x̄ ± t* s/√n, df = n − 1 |
| One-sample t-test for μ | μ | as above | t = (x̄ − μ₀)/(s/√n), df = n − 1 |
| Paired t-interval or t-test for μ_diff | mean of the differences | the differences: n ≥ 30 or no strong skew or outliers | one-sample t on the differences: x̄_diff ± t* s_diff/√n, or t = (x̄_diff − 0)/(s_diff/√n) |
| Two-sample t-interval for μ₁ − μ₂ | μ₁ − μ₂ | independent samples or groups; each n ≥ 30 or each sample shows no strong skew or outliers | (x̄₁ − x̄₂) ± t* √(s₁²/n₁ + s₂²/n₂) |
| Two-sample t-test for μ₁ − μ₂ | μ₁ − μ₂ | as above | t = (x̄₁ − x̄₂)/√(s₁²/n₁ + s₂²/n₂); df from the calculator, or the smaller n − 1 |

**Choosing the procedure.** Ask three questions in order. Is the variable categorical (proportions, chi-square) or quantitative (means)? How many groups or samples, and are they paired? Are you estimating (interval) or testing a claim (test)? "The same individuals measured twice" means paired t; "several groups and several categories" means chi-square.

**The four steps of a test**, which earn the four kinds of points: (1) state hypotheses about parameters and define them in context; (2) name the procedure and check the conditions in context; (3) compute the test statistic and p-value; (4) compare the p-value with α, decide, and conclude in context. For an interval, step 1 is defining the parameter and step 4 is the interpretation.

## Interpretation templates

Learn these word for word, then fill in the context.

- **Confidence interval:** "We are 95% confident that the interval from 0.41 to 0.53 captures the true proportion of all [population] who [variable]."
- **Confidence level:** "If we took many random samples of this size and built a 95% interval from each, about 95% of the intervals would capture the true [parameter]."
- **p-value:** "Assuming H₀ is true ([p = 0.30]), there is a [0.012] probability of getting a sample [proportion] of [0.36] or [greater] by chance alone."
- **Conclusion, reject:** "Because the p-value of 0.012 < α = 0.05, we reject H₀. There is convincing evidence that [Hₐ in context]."
- **Conclusion, fail to reject:** "Because the p-value of 0.083 > α = 0.05, we fail to reject H₀. There is not convincing evidence that [Hₐ in context]." Never "accept H₀" and never "prove".
- **Type I error:** concluding [Hₐ in context] when in fact [H₀ in context]. **Type II error:** not finding convincing evidence of [Hₐ in context] when in fact [Hₐ is true]. Add the consequence if asked.
- **Slope:** "For each additional [x unit], the predicted [y] increases (decreases) by [b] [y units]."
- **y-intercept:** "When [x] is 0, the predicted [y] is [a]." Say if x = 0 makes no sense or is outside the data.
- **Correlation:** "There is a [strong, negative, linear] association between [x] and [y], r = −0.80."
- **r²:** "About [64%] of the variation in [y] is accounted for by the linear relationship with [x]."
- **s (standard deviation of the residuals):** "The actual [y] values typically differ from the values predicted by the least-squares line by about [s] [units]."
- **Residual:** "The actual [y] was [|residual|] [units] above (below) the value predicted by the least-squares line for [x = value]."
- **Scope of inference:** random sampling → generalise to the population sampled; random assignment → cause and effect. Say which you have and which you do not.

## Know these cold

### Unit 1

- A **statistical investigative question** names a population, a variable and (often) a comparison, and anticipates variability; a survey question is what you ask one individual.
- Categorical versus quantitative: a number used as a label (a ZIP code, a jersey number) is categorical.
- **Describe a distribution with SOCS in context:** shape, outliers, center, spread. Compare with comparative words.
- Skewed right: mean > median. Use the median and IQR for skewed data or outliers; the mean and SD are not resistant.
- **Outliers:** below Q1 − 1.5 × IQR or above Q3 + 1.5 × IQR. Show the fences.
- Sampling: simple random, stratified (sample within every group), cluster (sample whole groups), systematic. Bias: undercoverage, nonresponse, voluntary response, response bias (wording, self-report). A larger sample does not fix bias.
- Experiments: experimental units, treatments, response, control group, random assignment, replication, blinding, blocking (reduce variability from a known source), matched pairs. Confounding is why observational studies cannot show causation.

### Unit 2

- From a two-way table, read joint, marginal and conditional proportions; P(A | B) uses only the B row or column. Different conditional distributions mean an association.
- **Simulation:** state the model (digits to outcomes), what one trial is, the number of trials, and the estimate.
- Addition rule: P(A or B) = P(A) + P(B) − P(A and B). Mutually exclusive: P(A and B) = 0. Independent: P(A | B) = P(A), or P(A and B) = P(A) · P(B).
- Discrete random variable: μ = Σ x · P(x), σ = √(Σ (x − μ)² P(x)).
- **Binomial** (binary outcomes, independent trials, fixed n, same p): P(X = k) = C(n, k) p^k (1 − p)^(n − k), μ = np, σ = √(np(1 − p)). Know binompdf versus binomcdf, and "at least" versus "more than".
- **Normal:** z = (x − μ)/σ; draw the curve and shade the area asked for.
- **Sampling distributions:** the mean of p̂ is p, SD(p̂) = √(p(1 − p)/n); the mean of x̄ is μ, SD(x̄) = σ/√n. The **Central Limit Theorem**: for large n (n ≥ 30 as a rule), x̄ is approximately normal whatever the population's shape.

### Unit 3

- Unbiased estimator: its sampling distribution is centred on the parameter. Larger n means less variability.
- Margin of error = critical value × standard error; it shrinks with larger n and lower confidence. Sample size for a proportion: n ≥ (z*/ME)² p̂(1 − p̂), with p̂ = 0.5 if no estimate, rounded **up**.
- A value inside the interval is plausible; a value outside it is not. An interval that contains 0 (for a difference) gives no convincing evidence of a difference.
- Tests: SE uses p₀; intervals use p̂. Two-sample tests use the pooled p̂c.
- α = P(Type I error) when H₀ is true. **Power** = P(reject H₀ when Hₐ is true) = 1 − P(Type II error); it increases with larger n, larger α, and a true value farther from p₀.
- Chi-square: homogeneity (separate samples, one variable) versus independence (one sample, two variables). Expected counts, not observed counts, must be at least 5. Large χ² means observed counts far from expected.

### Unit 4

- Use t because s estimates σ; df = n − 1 for one sample or for paired differences.
- **Paired or two-sample?** The same individuals measured twice, or naturally matched pairs → paired. Two independent groups → two-sample.
- Normal condition for small samples: refer to a graph of the data (or of the differences) showing no strong skew or outliers.
- Interpret a mean-difference interval with the direction of subtraction stated: "(old − new)".

### Unit 5

- Describe a scatterplot by direction, form, strength and unusual points, in context.
- r measures the strength of a **linear** association only, is between −1 and 1, has no units, and is unchanged by switching x and y or changing units. Correlation is not causation.
- **Least-squares line:** b = r(s_y/s_x), a = ȳ − b·x̄; it passes through (x̄, ȳ) and minimises the sum of squared residuals.
- Residual = actual − predicted (y − ŷ). A residual plot with no pattern supports a linear model; a curve means a line is not appropriate.
- High-leverage points have x far from x̄; an influential point changes the slope or correlation noticeably when removed. Predicting outside the x range is extrapolation.
- Read computer output: the "Constant" coefficient is a, the coefficient beside the variable name is b, "S" is s and "R-sq" is r².

## A two-week review plan

**Week 33 (this week): rebuild the toolkit.**

- Day 1: Unit 1 summary sheet. Write an investigative question and a survey question for one context; describe a sampling plan and a randomized block design, with the random mechanism.
- Day 2: Unit 2 summary sheet. Twenty minutes of two-way-table and binomial drills, then one normal and one Central Limit Theorem problem with a sketch.
- Day 3: Unit 3 summary sheet. Write out the four steps of a test and the interval and p-value templates from memory, then do one complete one-proportion test and one chi-square test.
- Day 4: Units 4 and 5 summary sheets. One paired and one two-sample t procedure, then interpret slope, r², s and a residual from one computer output.
- Day 5: Free-response day. Redo the free-response questions from two unit exams under time (22 minutes each), typing your answers, then mark them with the scoring guides.

**Week 34: the practice final.**

- Day 1: Sit questions 1–46 under AP timing, in one sitting, with a short break after question 42.
- Day 2: Score it with the explanations and the 10-point scoring guides. For every lost point, write one line: what the question tested and what you will do differently. Count your losses by unit and by practice.
- Day 3: Re-teach yourself the two topics that cost you the most points, using their weekly guides and flashcards.
- Day 4: Questions 47–70, timed at 45 minutes.
- Day 5: Rewrite every free-response answer that scored under 7 out of 10, with full context and the template language, then stop. Rest matters more than one more set.

Until the exam, alternate a timed multiple-choice block with one typed free-response question every other day.

## Test-day reminders

- Bring a charged, approved graphing calculator; know that Desmos is also available in Bluebook and that the reference booklet has the formulas and tables.
- In Section I, mark any question that takes longer than three minutes and come back to it. Answer everything.
- In Section II, read every part before writing, name every procedure, define every parameter, and end every analysis with a sentence in context.

---

*Original study material for this course, organised around the College Board AP Statistics Course and Exam Description (Units 1–5, with the May 2027 exam format from AP Central). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
