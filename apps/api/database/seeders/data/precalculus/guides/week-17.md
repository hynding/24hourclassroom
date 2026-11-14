# Week 17 · Logarithmic Models and Semi-log Plots

**Topics:** 2.14 Logarithmic Function Context and Data Modeling · 2.15 Semi-log Plots
**Practices:** 2 (multiple representations), 3 (communication and reasoning), 1 (procedural and symbolic fluency)
**Framework:** AP Precalculus CED, Unit 2, Topics 2.14–2.15, learning objectives in our own words
**Spiral:** Week 15's "multiply the inputs, add to the outputs" signature is how you recognise logarithmic data, and its log properties are what straighten exponential data. Week 16's equation solving answers the questions models ask ("when does the level reach 40?"). Week 14's logarithmic scales return as the vertical axis of a semi-log plot. Week 12's exponential models and residual reasoning, and week 9's habit of stating assumptions and limits of a model, frame the whole week.

## What you need to be able to do

- **2.14** Decide when a logarithmic model suits a context or a data set: inputs that span several powers of ten, or outputs that rise by equal amounts when inputs are multiplied by a constant factor, or a quantity that grows quickly at first and then ever more slowly.
- **2.14** Build a model of the form y = a + b ln x or y = a + b log x from two data points or from a stated pattern, and describe what logarithmic regression on a calculator produces.
- **2.14** Use logarithmic scales in context (acidity, sound level, a magnitude scale) to compare quantities: a difference of levels corresponds to a ratio of the underlying quantities.
- **2.14** Use a model to predict, solve for the input, interpret parameters with units, and state limitations.
- **2.15** Explain why exponential data appear linear on a semi-log plot (vertical axis logarithmically scaled), and read the slope and intercept of that line to recover the initial value and base of the exponential.
- **2.15** Linearize exponential data by computing log y (or ln y) and use the linear model to write the exponential model.

## Key terms

| Term | Meaning |
|---|---|
| Logarithmic model | A function y = a + b log_c x used to describe data; often written with ln x or log x. |
| Logarithmic regression | A calculator fit of y = a + b ln x to data; it reports a, b and a measure of fit. |
| Semi-log plot | A graph with an ordinary horizontal axis and a logarithmically scaled vertical axis, or equivalently a plot of (x, log y). |
| Linearization | Transforming data so a non-linear pattern becomes a straight line; here, replacing y by log y. |
| Level (on a log scale) | A number defined as a logarithm of a quantity, such as a sound level in decibels; equal level differences mean equal ratios. |
| Reference value | The fixed quantity in a log-scale definition, such as I₀ in 10 log(I/I₀). |

## When is a logarithmic model appropriate? (2.14)

Three signs point to a logarithmic model.

1. **Inputs multiply, outputs add.** If doubling the input (or multiplying it by 10) always adds about the same amount to the output, the data are logarithmic. This is the inverse of the exponential pattern.
2. **Fast, then slow, without levelling off completely.** A log function rises steeply at first and then ever more slowly, but it never reaches a ceiling (unlike a function with a horizontal asymptote). Skill gained from practice and some growth processes behave like this over a limited range.
3. **The inputs range over several orders of magnitude.** When the inputs run from 0.001 to 1,000, describing them by their logarithm is often the natural choice. Scientists define *levels* this way.

A logarithmic model is the inverse of an exponential one. If time to reach a size follows a log of the size, then size follows an exponential of time.

### Building a model from two points

A model y = a + b log x has two parameters, so two points determine it.

**Worked example.** A hypothetical data set contains the points (10, 3) and (1,000, 7). Find a model y = a + b log x.

At x = 10: a + b · 1 = 3. At x = 1,000: a + b · 3 = 7. Subtract: 2b = 4, so b = 2 and a = 1. The model is y = 1 + 2 log x. Each factor of 10 in x adds 2 to y.

**Worked example.** In a hypothetical study, a beginner's typing speed after x hours of practice is modelled by S(x) = 12 + 8 ln x words per minute, for 1 ≤ x ≤ 40.

(a) Interpret 12: at x = 1 hour, ln 1 = 0, so the speed is 12 words per minute after one hour.
(b) Predict the speed after 20 hours: S(20) = 12 + 8 ln 20 ≈ 36.0 words per minute.
(c) When does the model predict 40 words per minute? 12 + 8 ln x = 40 gives ln x = 3.5 and x = e^3.5 ≈ 33.1 hours.
(d) Interpret 8: each time the practice time is multiplied by e ≈ 2.718, the speed rises by 8 words per minute. Equivalently, doubling the hours adds 8 ln 2 ≈ 5.5 words per minute.
(e) Limitation: the model predicts speed increasing without bound, which cannot continue forever, and it is undefined at x = 0. Use it only on its stated domain.

### Logarithmic regression

When data look logarithmic, a graphing calculator's logarithmic regression (often labelled LnReg) fits y = a + b ln x by least squares. It reports a and b; you then write the model, check the residual plot for a pattern, and use the model only within (or slightly beyond) the range of the data. Regression requires every input to be positive. On the AP exam you may be given the regression output rather than asked to run it.

**Try it.**
1. Find a model y = a + b ln x through (1, 5) and (e³, 11).
2. A hypothetical table has x = 2, 8, 32 and y = 4, 10, 16. Explain why it suggests a logarithmic model and give one.

*Answers:* 1. a = 5, 3b = 6 so b = 2: y = 5 + 2 ln x. 2. Each input is 4 times the last and each output is 6 more, so y rises 3 per doubling: y = 1 + 3 log₂ x (check: at x = 2, 1 + 3 = 4).

## Logarithmic scales in context (2.14)

A *level* is a logarithm of a quantity, so the arithmetic of week 14's scales applies: equal differences in level mean equal ratios in the quantity.

**Acidity (pH).** The standard definition is pH = −log H, where H is the hydrogen-ion concentration in moles per litre. A solution with H = 10⁻⁴ has pH 4. Because of the minus sign, a lower pH means a higher concentration. A hypothetical sample with H = 3.2 × 10⁻⁴ has pH = −log(3.2 × 10⁻⁴) ≈ 3.49. A solution of pH 3.5 has 10 times the concentration of one of pH 4.5.

**Sound level.** Sound level in decibels is L = 10 log(I/I₀), where I is intensity and I₀ is a fixed reference intensity. If I = 10⁷ I₀ then L = 70 dB. Multiplying the intensity by 100 adds 10 log 100 = 20 dB; doubling it adds 10 log 2 ≈ 3 dB.

**A magnitude scale.** Consider a hypothetical magnitude scale M = log(A/A₀), where A is a measured amplitude and A₀ is a reference amplitude. An event of magnitude 5.8 has amplitude 10^(5.8 − 3.4) = 10^2.4 ≈ 251 times that of an event of magnitude 3.4.

**Worked example.** Two hypothetical machines produce sound levels of 70 dB and 85 dB. How many times as intense is the louder one?

85 − 70 = 15 = 10 log(I₂/I₁), so log(I₂/I₁) = 1.5 and I₂/I₁ = 10^1.5 ≈ 31.6.

**Try it.**
1. A hypothetical solution has pH 2.8. Another has pH 5.8. Compare their hydrogen-ion concentrations.
2. A sound's intensity is multiplied by 1,000. How many decibels does its level increase by?

*Answers:* 1. The pH 2.8 solution has 10³ = 1,000 times the concentration. 2. 10 log 1,000 = 30 dB.

## Semi-log plots (2.15)

Suppose y = a · bˣ. Take the common log of both sides and use the product and power properties:

log y = log a + x · log b.

That is a linear function of x: **if you plot log y against x, exponential data fall on a straight line** with

- slope m = log b, so b = 10ᵐ, and
- vertical intercept k = log a, so a = 10ᵏ.

The same works with natural logs: ln y = ln a + x ln b, so b = e^(slope) and a = e^(intercept).

A semi-log plot does this automatically: its vertical axis is marked 1, 10, 100, 1,000 at equal spacing, so it plots log y while labelling the values of y. Exponential growth appears as a rising line, exponential decay as a falling line. Data that are linear in y, by contrast, look concave down on a semi-log plot, and data that grow faster than exponential look concave up.

**Worked example.** A hypothetical culture is measured each hour.

| t (hours) | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| y (cells, thousands) | 50 | 75 | 112.5 | 168.75 | 253.125 |
| log y | 1.699 | 1.875 | 2.051 | 2.227 | 2.403 |

The log y values rise by 0.176 each hour, so the points (t, log y) lie on a line with slope 0.176 and intercept 1.699. Then b = 10^0.176 ≈ 1.5 and a = 10^1.699 ≈ 50, giving y = 50 · (1.5)ᵗ. (The ratios 75/50 = 112.5/75 = 1.5 confirm it.)

**Worked example.** On a semi-log plot of hypothetical data, the line of best fit is log y = 1.2 + 0.3x. Write an exponential model.

y = 10^(1.2 + 0.3x) = 10^1.2 · (10^0.3)ˣ ≈ 15.85 · (1.995)ˣ. The quantity roughly doubles with each unit of x.

**Worked example.** A linearized model with natural logs is ln y = 2.5 − 0.4x. Write the exponential model and say whether it shows growth or decay.

y = e^2.5 · (e^(−0.4))ˣ ≈ 12.18 · (0.670)ˣ. The slope is negative, so b < 1: decay, losing about 33% per unit of x.

**Worked example.** Reading a semi-log graph. A line on a semi-log plot passes through (0, 4) and (5, 400), where the vertical values are the actual y-values on a log-scaled axis. Find the exponential model.

In log form the points are (0, log 4) and (5, log 400). Slope = (log 400 − log 4)/5 = (log 100)/5 = 2/5 = 0.4, so b = 10^0.4 ≈ 2.512, and a = 4. Model: y = 4 · (10^0.4)ˣ ≈ 4 · (2.512)ˣ. Check: 4 · 10² = 400 at x = 5. ✓

### Linearization and checking a model

To test whether data are exponential, compute log y for each point and look at the transformed data: if (x, log y) is close to linear, with no pattern in the residuals of a line fitted to it, an exponential model is appropriate. This is the logic behind a calculator's exponential regression. Linear data are tested on an ordinary plot; exponential data on a semi-log plot.

**Try it.**
1. A semi-log line is log y = 3 − 0.5x. Write y as an exponential function and give y at x = 2.
2. Data satisfy y = 6 · 4ˣ. What are the slope and intercept of (x, log y)?

*Answers:* 1. y = 1,000 · (10^(−0.5))ˣ ≈ 1,000 · (0.316)ˣ; at x = 2, y = 10^(3 − 1) = 100. 2. Slope log 4 ≈ 0.602, intercept log 6 ≈ 0.778.

## Calculator notes

For logarithmic regression, enter x in L1 and y in L2 and choose LnReg; it returns a and b in y = a + b ln x. To make a semi-log plot by hand, create L3 = log(L2) and plot L1 against L3; a linear regression on (L1, L3) gives slope m and intercept k, and then y = 10ᵏ · (10ᵐ)ˣ. ExpReg on (L1, L2) gives the same a and b directly. Some calculators report ln-based results; then use e instead of 10. Keep several decimal places in intermediate values, because 10ᵏ magnifies rounding errors.

## Common mistakes

- **Reading a semi-log axis as linear.** The value halfway between the marks 10 and 100 is about 31.6, not 55.
- **Using the slope of the semi-log line as the base.** The slope is log b; the base is 10^(slope) (or e^(slope) for ln).
- **Using the intercept as a.** The intercept is log a, so a = 10^(intercept).
- **Forgetting the minus sign in pH.** Higher concentration means lower pH.
- **Treating a level difference as a ratio.** A 20 dB increase is a factor of 100 in intensity, not 20.
- **Extrapolating a log model far outside the data.** Log models grow without bound and are undefined at 0.

## Where this goes next

This week ends Unit 2. The unit summary and exam pull together sequences, exponential and logarithmic functions, composition and inverses, equations and inequalities, and modelling. Unit 3 turns to periodic phenomena and the trigonometric functions, where modelling returns with sinusoidal data; semi-log thinking returns whenever you meet a quantity that ranges over powers of ten.

## Self-check

1. A hypothetical data set has the points (e, 7) and (e⁴, 13). Find a model y = a + b ln x and interpret b.
2. Two hypothetical solutions have pH 4.2 and 6.7. Which has the higher hydrogen-ion concentration, and by what factor?
3. A sound level rises from 62 dB to 74 dB. By what factor did the intensity change?
4. On a semi-log plot, data fall on the line log y = 0.9 + 0.15x. Write the exponential model and interpret the base as a percent change.
5. Explain how you would use a table of log y values to decide whether a data set is better described as linear or exponential.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 2, Topics 2.14–2.15). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
