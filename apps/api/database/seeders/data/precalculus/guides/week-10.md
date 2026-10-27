# Week 10 · Sequences and Linear vs Exponential Change

**Topics:** 2.1 Change in Arithmetic and Geometric Sequences · 2.2 Change in Linear and Exponential Functions
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 2, Topics 2.1–2.2, learning objectives in our own words
**Spiral:** Week 1's average rate of change over an interval is the tool that tells linear and exponential change apart. Week 2 showed that a constant rate of change means linear and constant second differences mean quadratic; this week adds a third pattern, constant *ratios*. From Algebra 2: slope, exponent rules and the meaning of b⁰ = 1.

## What you need to be able to do

- **2.1** Recognise an arithmetic sequence by its constant difference and a geometric sequence by its constant ratio, from a list, a table or a description.
- **2.1** Write the nth term of each kind, aₙ = a₀ + dn and gₙ = g₀rⁿ, and the "anchored" versions aₙ = aₖ + d(n − k) and gₙ = gₖ · r^(n − k) that start from any known term.
- **2.1** Find a missing term, the common difference or the common ratio from two terms that are not next to each other.
- **2.2** Explain that a linear function changes by equal *amounts* over equal-length input intervals, while an exponential function changes by equal *factors* (equal proportions) over equal-length input intervals.
- **2.2** Connect the two ideas: an arithmetic sequence is a linear function restricted to whole-number inputs, and a geometric sequence is an exponential function restricted to whole-number inputs.
- **2.2** Decide from a table (including one with evenly spaced inputs that are not 1 apart) whether a linear model, an exponential model or neither fits, and build the linear or exponential function through two given points.

## Key terms

| Term | Meaning |
|---|---|
| Sequence | A function whose inputs are whole numbers (0, 1, 2, … or 1, 2, 3, …); its outputs are the terms. |
| Arithmetic sequence | Each term is the previous term plus the same number d, the common difference. |
| Geometric sequence | Each term is the previous term times the same nonzero number r, the common ratio. |
| Initial term | The term at n = 0 (a₀ or g₀). Some books start at n = 1; always check which index a problem uses. |
| Linear function | f(x) = b + mx; equal input steps give equal output differences. |
| Exponential function | f(x) = abˣ with a ≠ 0, b > 0, b ≠ 1; equal input steps give equal output ratios. |
| Additive change | Change described by "add this much". |
| Multiplicative change | Change described by "multiply by this factor". |

## Arithmetic sequences (2.1)

An arithmetic sequence grows or shrinks by the same amount every step:

4, 11, 18, 25, 32, …  (d = 7)
50, 46, 42, 38, …  (d = −4)

If the first term is called a₀, then after n steps you have added d exactly n times:

**aₙ = a₀ + dn.**

That is the slope–intercept form of a line in disguise: d plays the role of the slope and a₀ the vertical intercept. If you know some other term aₖ instead of a₀, count steps from there:

**aₙ = aₖ + d(n − k).**

That is point–slope form. To find d from two terms, divide the change in the terms by the number of steps between them:

d = (aₙ − aₖ)/(n − k).

**Worked example.** An arithmetic sequence has a₃ = 17 and a₈ = 42. Find d, a₀, a formula for aₙ, and a₂₀.

Five steps separate a₃ and a₈, and the terms rose by 25, so d = 25/5 = 5. Step back three times from a₃: a₀ = 17 − 3 · 5 = 2. So aₙ = 2 + 5n, and a₂₀ = 2 + 100 = 102. (The anchored form a₂₀ = 17 + 5(20 − 3) = 102 agrees.)

**Worked example.** Is 1, 4, 9, 16, … arithmetic?

The differences are 3, 5, 7: not constant, so no. (They grow by 2 each time, which is the constant-second-difference signature of a quadratic from week 2.)

**Try it.**
1. Write the nth term of 13, 9, 5, 1, … with the first term as a₀.
2. An arithmetic sequence has a₄ = −6 and a₁₀ = 30. Find d and a₀.

*Answers:* 1. aₙ = 13 − 4n. 2. d = 36/6 = 6; a₀ = −6 − 24 = −30.

## Geometric sequences (2.1)

A geometric sequence is multiplied by the same factor every step:

3, 6, 12, 24, 48, …  (r = 2)
800, 200, 50, 12.5, …  (r = 1/4)
5, −15, 45, −135, …  (r = −3)

After n steps from g₀ you have multiplied by r exactly n times:

**gₙ = g₀ · rⁿ,** and from any known term **gₙ = gₖ · r^(n − k).**

To find r from two terms, divide them; the quotient is r raised to the number of steps between them:

gₙ / gₖ = r^(n − k).

**Worked example.** A geometric sequence has g₂ = 18 and g₅ = 486. Find r, g₀ and g₇.

486/18 = 27 = r³, so r = 3. Step back two times: g₀ = 18/3² = 2. So gₙ = 2 · 3ⁿ and g₇ = 2 · 2187 = 4374.

**Worked example (two answers).** A geometric sequence has g₁ = 12 and g₃ = 3. Find r.

3/12 = 1/4 = r², so r = 1/2 or r = −1/2. Both work: 12, 6, 3 and 12, −6, 3. With an even number of steps between the known terms, the sign of r is not determined unless the problem tells you more (for example, that every term is positive).

A geometric sequence with r > 1 and positive terms increases; with 0 < r < 1 it decreases toward 0; with r < 0 the signs alternate.

**Try it.**
1. Write gₙ for 96, 48, 24, 12, … with the first term as g₀.
2. A geometric sequence has positive terms, g₀ = 5 and g₄ = 405. Find r and g₆.

*Answers:* 1. gₙ = 96 · (1/2)ⁿ. 2. r⁴ = 81, r = 3 (positive terms); g₆ = 5 · 729 = 3645.

## Linear versus exponential change (2.2)

Sequences live on whole-number inputs. Functions let the input be any real number, and the same two patterns survive.

**Linear functions change additively.** For f(x) = b + mx, every increase of 1 in x adds m to the output, and every increase of Δx adds m · Δx. Over any two input intervals of the same length the outputs change by the same amount, so the average rate of change is constant.

**Exponential functions change multiplicatively.** For f(x) = abˣ, every increase of 1 in x multiplies the output by b:

f(x + 1) = ab^(x + 1) = abˣ · b = b · f(x).

Every increase of Δx multiplies the output by b^Δx. Over input intervals of the same length the outputs change by the same *factor*, or equivalently by the same *percentage*. The amounts of change are not constant; in fact f(x + 1) − f(x) = abˣ(b − 1), which is itself multiplied by b each step. The average rates of change of an exponential function over consecutive unit intervals form a geometric sequence.

The link to sequences is direct:

| Discrete (whole-number inputs) | Continuous (real inputs) | Equal input steps give |
|---|---|---|
| Arithmetic sequence aₙ = a₀ + dn | Linear function f(x) = b + mx | equal differences |
| Geometric sequence gₙ = g₀rⁿ | Exponential function f(x) = abˣ | equal ratios |

A useful consequence: if the inputs of an exponential function form an arithmetic sequence (0, 2, 4, 6, …), the outputs form a geometric sequence.

### Reading a table

To test a table, first check that the inputs are **evenly spaced**. Then compute successive differences and successive ratios of the outputs.

| x | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| p(x) | 5 | 8 | 11 | 14 | 17 |
| q(x) | 5 | 10 | 20 | 40 | 80 |
| s(x) | 5 | 6 | 9 | 14 | 21 |

- p: differences 3, 3, 3, 3 ⟹ linear, p(x) = 5 + 3x.
- q: ratios 2, 2, 2, 2 ⟹ exponential, q(x) = 5 · 2ˣ.
- s: differences 1, 3, 5, 7 and ratios 1.2, 1.5, 1.56, 1.5 — neither constant, so neither model fits exactly. (Second differences are 2, 2, 2: quadratic.)

**Worked example (inputs 2 apart).** A table gives f(0) = 3, f(2) = 12, f(4) = 48, f(6) = 192. Find an exponential model.

Inputs step by 2 and outputs multiply by 4 each step. So b² = 4 and b = 2 (b must be positive). With f(0) = 3, f(x) = 3 · 2ˣ. Check: f(6) = 3 · 64 = 192.

### Building a function through two points

**Linear through (x₁, y₁) and (x₂, y₂):** slope m = (y₂ − y₁)/(x₂ − x₁), then y = y₁ + m(x − x₁).

**Exponential through (x₁, y₁) and (x₂, y₂)** (both outputs the same sign): the ratio of outputs is b raised to the input gap,

y₂/y₁ = b^(x₂ − x₁), so b = (y₂/y₁)^(1/(x₂ − x₁)), then a = y₁ / b^(x₁).

**Worked example.** Find the linear function and the exponential function through (1, 6) and (4, 48).

Linear: m = 42/3 = 14, y = 6 + 14(x − 1) = 14x − 8.
Exponential: 48/6 = 8 = b³, so b = 2, and a = 6/2 = 3, giving y = 3 · 2ˣ.

Both pass through the two points, but they disagree everywhere else: at x = 6 the line gives 76 while the exponential gives 192. At x = 0 the line gives −8 and the exponential gives 3. Two points are not enough to decide which kind of model is right; context or more data must do that.

**Worked example (context, hypothetical).** A hypothetical lab culture starts with 200 cells and triples every hour; a seedling in the same lab is 4 cm tall and grows 1.5 cm per day. Write a formula for each and say which kind of change it shows.

Cells: C(t) = 200 · 3ᵗ after t hours, multiplicative change (factor 3 per hour). Height: H(d) = 4 + 1.5d after d days, additive change (1.5 cm per day).

**Exponential eventually beats linear.** If b > 1, an exponential function with a > 0 eventually exceeds any increasing linear function, however steep the line and however small a. Compare L(x) = 100x with E(x) = 2ˣ: L is ahead at x = 5 (500 versus 32) and at x = 9 (900 versus 512), but E(10) = 1024 > 1000 = L(10), and the gap widens from then on, because E doubles each step while L only adds 100.

**Try it.**
1. A table has x = 0, 3, 6, 9 and y = 10, 19, 28, 37. Linear, exponential or neither? Give the model if there is one.
2. Find the exponential function through (2, 80) and (5, 10).
3. Over each 1-unit interval, f(x) = 20 · (1.5)ˣ grows by what percent?

*Answers:* 1. Differences 9, 9, 9 over steps of 3: linear with slope 3, y = 10 + 3x. 2. 10/80 = 1/8 = b³, b = 1/2; a = 80/(1/4) = 320; y = 320 · (1/2)ˣ. 3. 50%.

## Calculator notes

Nothing this week needs a graphing calculator. A calculator's table feature is a quick way to check differences and ratios: enter the data in a list and compute the list of ratios L₂/L₁ term by term. Fractional exponents such as (1/8)^(1/3) or 27^(1/3) should be recognised by hand when the numbers are perfect powers, as on the no-calculator part of the AP exam.

## Common mistakes

- **Counting terms instead of steps.** From a₃ to a₈ there are 5 steps, not 6. The gap in index numbers is the number of steps.
- **Dividing when you should subtract (or the reverse).** Arithmetic: subtract to get d, divide the change by the steps. Geometric: divide to get rⁿ⁻ᵏ, then take the root.
- **Forgetting the negative ratio.** r² = 1/4 has two solutions; only extra information picks one.
- **Testing a table with uneven inputs.** Equal differences over unequal steps do not mean linear. Use rates (change ÷ input step) or space the inputs evenly first.
- **Calling any growth "exponential".** "Grows by 40 each year" is linear; "grows by 40% each year" is exponential.
- **Mixing up the starting index.** If the first term is a₁ rather than a₀, the formula is aₙ = a₁ + d(n − 1).

## Where this goes next

Week 11 studies f(x) = abˣ as a function in its own right: its graph, its horizontal asymptote, its concavity and the exponent rules that rewrite it in equivalent forms. Week 12 builds exponential models from context and compares them with linear and quadratic ones using residuals, so the table tests from this week become model-selection evidence.

## Self-check

1. An arithmetic sequence has a₅ = 31 and a₁₂ = 3. Find d, a₀ and the first negative term.
2. A geometric sequence has g₃ = 40 and g₆ = 5. Find r and g₀.
3. Explain, using f(x + 1) and f(x), why an exponential function multiplies by the same factor over every interval of length 1.
4. The inputs of a table are 1, 3, 5, 7 and the outputs are 6, 24, 96, 384. Write a function that fits.
5. Find the linear and exponential functions through (0, 50) and (2, 18), and say which one gives a larger value at x = 4.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 2, Topics 2.1–2.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
