# Week 20 · Solving Problems with Graphs and Logarithms, and Logarithmic Functions

**Lessons:** 4.15 Using Graphs and Logarithms to Solve Problems (Part 1) · 4.16 Using Graphs and Logarithms to Solve Problems (Part 2) · 4.17 Logarithmic Functions · 4.18 Applications of Logarithmic Functions
**Practices:** MP4 (model with mathematics), MP5 (use appropriate tools strategically), MP2 (reason abstractly and quantitatively)
**Built from:** IM Algebra 2, Unit 4, Lessons 15–18, in our own words
**Spiral:** Everything in this week combines earlier tools: writing a model from data (week 17), the solving routine with logarithms (week 19), and the meaning of a logarithm as an exponent (week 18). The graph of a logarithmic function is the reflection of an exponential graph across y = x, so the asymptote and intercept of week 16's graphs come back swapped.

## What you need to be able to do

- **4.15** Find doubling times and half-lives, and the time for a quantity to reach a target, both by reading a graph and by solving with a logarithm; explain why the two methods agree.
- **4.16** Build an exponential model from two data points, use it to answer "when" questions including inequalities, and judge whether an answer is reasonable.
- **4.17** Describe the graph of y = log_b(x): domain x > 0, vertical asymptote x = 0, through (1, 0) and (b, 1), increasing slowly; explain its relationship to y = bˣ.
- **4.18** Use logarithmic scales (pH, decibels, earthquake magnitude) and explain why a difference of 1 on such a scale is a factor of 10.

## Key terms

| Term | Meaning |
|---|---|
| Doubling time | The time for a growing quantity to double; solve bᵗ = 2. |
| Half-life | The time for a decaying quantity to halve; solve bᵗ = 1/2. |
| Logarithmic function | f(x) = log_b(x), the inverse of the exponential function bˣ. |
| Vertical asymptote | For log_b(x), the line x = 0: outputs plunge to −∞ as x approaches 0 from the right. |
| Logarithmic scale | A scale on which equal steps mean equal factors (usually ×10), such as pH, decibels and earthquake magnitude. |

## Doubling times, half-lives and targets (4.15)

**Two methods, one answer.** To find when P(t) = 500(1.5)ᵗ reaches 10,000, either graph y = 500(1.5)ᵗ and y = 10,000 and read the intersection, or solve: 1.5ᵗ = 20, t = log₁.₅(20) ≈ 7.39. The graph gives a quick estimate (between 7 and 8); the logarithm gives the exact value. They agree because the intersection point is exactly where the equation holds.

**Doubling time.** It does not depend on the starting amount. At 7% per year: 1.07ᵗ = 2, t = log₁.₀₇(2) ≈ 10.24 years. For P(t) = 400 · 2ᵗ the doubling time is 1 hour by inspection.

**Half-life.** At 12% decay per year (factor 0.88): 0.88ᵗ = 0.5, t = log₀.₈₈(0.5) ≈ 5.42 years. For caffeine with C(t) = 200(0.87)ᵗ mg after t hours: 0.87ᵗ = 0.5, t ≈ 4.98 hours, about 5 hours.

**Working from a known half-life.** Carbon-14 has a half-life of 5730 years, so the fraction remaining after t years is (1/2)^(t/5730). If a sample has 30% of its original carbon-14: (1/2)^(t/5730) = 0.3, so t/5730 = log₀.₅(0.3) ≈ 1.737 and t ≈ 9950 years.

**Worked example.** A culture has P(t) = 400 · 2ᵗ cells after t hours. When does it reach 10,000?

2ᵗ = 25, t = log₂(25) ≈ 4.64 hours. Check against a bracket: 2⁴ = 16 < 25 < 32 = 2⁵, so between 4 and 5 hours.

**Try it.**
1. Find the doubling time for 4% annual growth.
2. A medication decays 15% per hour. Find its half-life.

*Answers:* 1. log₁.₀₄(2) ≈ 17.67 years. 2. log₀.₈₅(0.5) ≈ 4.27 hours.

## Models from data and "when" questions (4.16)

**Building the model.** A sample has 120 units at t = 0 and 30 units at t = 4 hours. Then b⁴ = 30/120 = 0.25, so b = 0.25^(1/4) ≈ 0.707: N(t) = 120(0.707)ᵗ. Since 0.25 = (1/2)², the sample halves every 2 hours, so an equivalent form is N(t) = 120(1/2)^(t/2). Then N(6) = 120(1/2)³ = 15.

**Inequalities.** When is 300(0.8)ᵗ below 30? 0.8ᵗ < 0.1. Since 0.8ᵗ decreases, this holds for t > log₀.₈(0.1) ≈ 10.3: after about 10.3 units. On a graph, it is where the curve y = 300(0.8)ᵗ drops below the line y = 30.

**Comparing two models.** Two cultures: A(t) = 400 · 2ᵗ and B(t) = 1000(1.5)ᵗ. B starts larger but A grows faster. They are equal when 400 · 2ᵗ = 1000(1.5)ᵗ, that is (2/1.5)ᵗ = 2.5, so t = log₄/₃(2.5) ≈ 3.19 hours; after that A is larger. A graph shows the two curves crossing once.

**Reasonableness.** A model is only as good as its assumptions: a medication model stops applying once the dose is gone; a population model fails when resources run out. State the domain where the answer makes sense.

**Worked example.** Caffeine follows C(t) = 200(0.87)ᵗ mg. When is less than 50 mg left?

0.87ᵗ < 0.25, so t > log₀.₈₇(0.25) ≈ 9.95: after about 10 hours. (Two half-lives of 4.98 hours each give 50 mg, which matches.)

**Try it.**
1. A quantity is 80 at t = 0 and 20 at t = 6. Write a model and find its half-life.
2. When does 50(1.2)ᵗ exceed 500?

*Answers:* 1. b⁶ = 0.25, b = 0.25^(1/6) ≈ 0.794; equivalently 80(1/2)^(t/3), half-life 3. 2. 1.2ᵗ > 10, t > log₁.₂(10) ≈ 12.63.

## Logarithmic functions (4.17)

The function f(x) = log_b(x) undoes bˣ: if y = bˣ then x = log_b(y). So the graph of y = log_b(x) is the graph of y = bˣ reflected across the line y = x. Every feature swaps:

| y = bˣ (b > 1) | y = log_b(x) |
|---|---|
| domain: all real x | domain: x > 0 |
| range: y > 0 | range: all real y |
| passes through (0, 1) and (1, b) | passes through (1, 0) and (b, 1) |
| horizontal asymptote y = 0 | vertical asymptote x = 0 |
| grows faster and faster | grows slower and slower |
| point (3, 8) on y = 2ˣ | point (8, 3) on y = log₂(x) |

Key values to plot for y = log₂(x): (1/4, −2), (1/2, −1), (1, 0), (2, 1), (4, 2), (8, 3), (16, 4). For y = log(x): (0.1, −1), (1, 0), (10, 1), (100, 2). For y = ln(x): (1, 0), (e, 1), (0.5, −0.69), (20, 3.0).

The graph is increasing everywhere (for b > 1) but very slowly: log₂(x) reaches 10 only at x = 1024. Near x = 0 it drops without bound: log₂(0.001) ≈ −9.97. There is no y-intercept, because log_b(0) is undefined.

**Worked example.** Sketch y = log₃(x) and y = 3ˣ on the same axes.

y = 3ˣ: through (0, 1), (1, 3), (−1, 1/3), flat on the left. y = log₃(x): through (1, 0), (3, 1), (1/3, −1), steep near the y-axis. They are mirror images across y = x.

**Try it.**
1. Give the domain and the vertical asymptote of y = log₅(x), and two points on its graph.
2. If (2, 25) is on y = 5ˣ, which point is on y = log₅(x)?

*Answers:* 1. x > 0; x = 0; (1, 0) and (5, 1). 2. (25, 2).

## Logarithmic scales (4.18)

Some quantities range over many powers of 10, so scientists measure them with logarithms: equal steps on the scale are equal *factors*, not equal amounts.

**pH.** pH = −log[H⁺], where [H⁺] is the hydrogen-ion concentration in moles per litre.
- [H⁺] = 3.2 × 10⁻⁴: pH = −log(3.2 × 10⁻⁴) ≈ 3.49.
- pH 2.5 means [H⁺] = 10⁻²·⁵ ≈ 0.00316.
- Each decrease of 1 in pH multiplies [H⁺] by 10: pH 3 is ten times more acidic than pH 4, a hundred times more than pH 5.

**Decibels.** L = 10 log(I/10⁻¹²), with I the sound intensity in W/m².
- I = 10⁻⁵: L = 10 log(10⁷) = 70 dB.
- A 70 dB sound has 100 times the intensity of a 50 dB sound (20 dB = 2 factors of 10), and 10,000 times that of a 30 dB sound.

**Earthquake magnitude.** Each whole unit of magnitude is a factor of 10 in measured wave amplitude. A magnitude 7.0 quake has 10^(7.0 − 5.5) = 10^1.5 ≈ 31.6 times the amplitude of a magnitude 5.5 quake.

**Why use a log scale?** The intensities of sounds humans hear span 10⁻¹² to 10 W/m², thirteen powers of ten; the decibel scale turns that into 0 to 130. The scale compresses an enormous range into manageable numbers and matches how perception works (each ×10 feels like a similar step).

**Worked example.** Lemon juice has pH about 2 and milk about 6.5. Compare their hydrogen-ion concentrations.

The pH difference is 4.5, so lemon juice has 10^4.5 ≈ 31,600 times the concentration.

**Try it.**
1. Find the pH of a solution with [H⁺] = 2 × 10⁻⁸.
2. How many times more intense is 85 dB than 65 dB?

*Answers:* 1. −log(2 × 10⁻⁸) ≈ 7.70. 2. 20 dB difference → 10² = 100 times.

## Common mistakes

- **Thinking doubling time depends on the starting amount.** It depends only on the growth factor.
- **Solving bᵗ < c with the inequality the wrong way.** For 0 < b < 1, bᵗ decreases, so bᵗ < c holds for t *greater* than log_b(c).
- **Giving a logarithmic graph a horizontal asymptote.** It has a vertical one, at x = 0, and keeps rising (slowly) forever.
- **Reading "10 dB more" as "10 times louder in dB arithmetic only".** It is 10 times the intensity; 20 dB more is 100 times.
- **Treating pH differences as ratios.** pH 3 versus pH 5 is a factor of 100, not of 5/3.

## Where this goes next

The Unit 4 exam covers weeks 16–20. Unit 5 then studies transformations of functions, including shifting, stretching and reflecting exponential and logarithmic graphs, and formalises the idea that log_b and bˣ are inverse functions.

## Self-check

1. Find the half-life of a substance decaying 9% per day, and check it on a sketch.
2. A quantity is 500 at t = 0 and 2000 at t = 3. Write a model and find when it reaches 6000.
3. Describe the graph of y = log₄(x): domain, asymptote, three points, and its relationship to y = 4ˣ.
4. A solution has pH 4.2. Find [H⁺], and compare it with a solution of pH 6.2.
5. Explain why graphing and solving with a logarithm must give the same answer to "when does 300(0.8)ᵗ equal 30?"

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 4, Lessons 15–18, https://im.kendallhunt.com/HS/teachers/3/4/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
