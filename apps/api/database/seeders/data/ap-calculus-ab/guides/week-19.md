# Week 19 · Concavity, Points of Inflection and the Second Derivative Test

**Topics:** 5.6 Determining Concavity of Functions over Their Domains · 5.7 Using the Second Derivative Test to Determine Extrema
**Practices:** 2 (Connecting Representations), 3 (Justification), 1 (Implementing Mathematical Processes), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 5, Topics 5.6–5.7, learning objectives in our own words
**Spiral:** Week 18 used the sign of f′ to decide where f rises and falls. This week applies exactly the same idea one level up: the sign of f″ decides where f′ rises and falls, which is what concavity means. You need week 12's higher-order derivatives, week 16's tangent-line approximations (concavity decides whether they over- or underestimate), and week 18's sign charts.

## What you need to be able to do

- **5.6** Define concave up and concave down in terms of f′ increasing or decreasing, and use the sign of f″ to find the intervals of each.
- **5.6** Find points of inflection and justify them by a change in the sign of f″ (or a change in the direction of f′), not merely by f″ = 0.
- **5.6** Read concavity from a formula, a table, a graph of f′ or f″, or a description in context ("increasing at a decreasing rate").
- **5.7** Apply the Second Derivative Test at a critical point where f′(c) = 0, write its justification, and recognise when it is inconclusive.
- **5.7** Choose between the First and Second Derivative Tests.

## Key terms

| Term | Meaning |
|---|---|
| Concave up on an interval | f′ is increasing on the interval; the graph lies above its tangent lines. |
| Concave down on an interval | f′ is decreasing on the interval; the graph lies below its tangent lines. |
| Point of inflection | A point of a continuous graph where the concavity changes. |
| Inflection candidate | An x in the domain of f where f″ = 0 or f″ does not exist. |
| Second Derivative Test | If f′(c) = 0: f″(c) > 0 ⟹ relative minimum; f″(c) < 0 ⟹ relative maximum; f″(c) = 0 ⟹ no conclusion. |

## Concavity (5.6)

Concavity describes how the slope changes. A graph is **concave up** where its slopes are increasing (left to right the tangent lines turn counterclockwise, the curve "holds water"), and **concave down** where its slopes are decreasing.

Since f′ is increasing when its own derivative f″ is positive (week 18's test applied to f′):

- **f″(x) > 0 on an interval ⟹ the graph of f is concave up there.**
- **f″(x) < 0 on an interval ⟹ the graph of f is concave down there.**

Concavity and direction are independent. A function can be increasing and concave up (rising faster and faster), increasing and concave down (rising but levelling off), decreasing and concave up (falling but levelling off), or decreasing and concave down (falling faster and faster). Keep the two questions separate: f′ answers "rising or falling?", f″ answers "bending which way?".

**Worked example 1.** Find the intervals of concavity of f(x) = x⁴ − 6x².

f′(x) = 4x³ − 12x and f″(x) = 12x² − 12 = 12(x − 1)(x + 1).

| Interval | x < −1 | −1 < x < 1 | x > 1 |
|---|---|---|---|
| Sign of f″ | + | − | + |
| Graph of f | concave up | concave down | concave up |

f″ changes sign at x = −1 and x = 1, and f is continuous there, so both are points of inflection: (−1, −5) and (1, −5).

## Points of inflection (5.6)

A point of inflection is where the concavity changes. Candidates are inputs where f″ = 0 or f″ is undefined (with f defined there); each candidate must then be tested for a **sign change of f″**.

The justification that earns AP credit:

> The graph of f has a point of inflection at x = −2 because f″ changes sign at x = −2.

Equivalent wordings: "because f′ changes from decreasing to increasing at x = −2", or, from a graph of f′, "because f′ has a relative minimum at x = −2". The sentence "because f″(−2) = 0" earns nothing on its own.

**Worked example 2.** Find the point of inflection of f(x) = x eˣ.

f′(x) = eˣ + x eˣ = (x + 1)eˣ, and f″(x) = eˣ + (x + 1)eˣ = (x + 2)eˣ. Because eˣ > 0, the sign of f″ is the sign of x + 2: negative for x < −2, positive for x > −2. The graph is concave down then concave up, with a point of inflection at x = −2, the point (−2, −2e⁻²) ≈ (−2, −0.271).

**Worked example 3 (a repeated factor).** Suppose f″(x) = (x − 1)²(x + 2). Then f″ = 0 at x = 1 and at x = −2. The factor (x − 1)² is never negative, so the sign of f″ is the sign of x + 2. Only x = −2 is a point of inflection; at x = 1 the graph is concave up on both sides. This is week 18's repeated-factor trap, one derivative higher.

**Reading a graph of f′.** Many AP questions give the graph of f′ and ask about f. Translate:

| Feature of the graph of f′ | Meaning for f |
|---|---|
| Above / below the x-axis | f increasing / decreasing |
| Crosses the axis from + to − | relative maximum of f |
| Rising / falling | f concave up / concave down |
| Relative maximum or minimum of f′ | point of inflection of f |

**Concavity in context.** "Increasing at a decreasing rate" means f′ > 0 and f″ < 0: concave down. **Worked example 4 (hypothetical).** N(t) is the number of students who have heard a rumor t hours after it starts, with N′(t) > 0 and N″(t) < 0 for 2 < t < 6. The rumor keeps reaching new students (N increasing), but fewer new students hear it each hour than the hour before (N′ decreasing). Then if N″(t) > 0 earlier, for 0 < t < 2, the spread was accelerating; at t = 2, the moment of fastest spread, the graph of N has a point of inflection.

**Concavity and linear approximation.** A concave-up graph lies above its tangent lines, so a tangent-line approximation **underestimates**; concave down, it **overestimates**. At a point of inflection look at the concavity on the side you are approximating.

## The Second Derivative Test (5.7)

Suppose f′(c) = 0, so the tangent at c is horizontal.

- If **f″(c) > 0**, the graph is concave up near c: a cup with a flat bottom at c. **Relative minimum.**
- If **f″(c) < 0**, the graph is concave down near c: a cap with a flat top. **Relative maximum.**
- If **f″(c) = 0**, the test gives **no information**.

The justification must cite both facts:

> f has a relative minimum at x = 2 because f′(2) = 0 and f″(2) > 0.

**Worked example 5.** Classify the critical points of f(x) = x³ − 12x.

f′(x) = 3x² − 12 = 3(x − 2)(x + 2), so f′ = 0 at x = ±2. f″(x) = 6x.

- f″(2) = 12 > 0, so f has a relative minimum at x = 2 (value f(2) = −16).
- f″(−2) = −12 < 0, so f has a relative maximum at x = −2 (value f(−2) = 16).

**Worked example 6 (inconclusive).** For f(x) = x⁴, f′(0) = 0 and f″(0) = 0. The Second Derivative Test says nothing. The First Derivative Test settles it: f′(x) = 4x³ changes from negative to positive at 0, so f has a relative minimum there. Compare x³ (neither) and −x⁴ (a maximum): all three have f′(0) = f″(0) = 0, which is exactly why the test must stay silent.

**Which test?** Use the Second Derivative Test when f′(c) = 0 and f″(c) is quick to compute and nonzero. Use the First Derivative Test when f″ is messy, when f″(c) = 0, or when f′(c) does not exist (the Second Derivative Test requires f′(c) = 0, so it cannot handle a cusp or corner). The First Derivative Test always works for an isolated critical point of a continuous function; it is the safer default on free-response questions.

The Second Derivative Test finds **relative** extrema. For absolute extrema on a closed interval you still need the Candidates Test.

## Common mistakes

- **Confusing f′ > 0 with concave up.** Concave up means f′ is increasing, that is f″ > 0.
- **Claiming an inflection point from f″(c) = 0 alone.** The sign of f″ must change, and f must be defined at c.
- **Forgetting where f″ is undefined.** x^(1/3) has an inflection point at 0, where f″ does not exist.
- **Reversing the Second Derivative Test.** Positive f″ at a horizontal tangent is a minimum (cup), negative is a maximum (cap).
- **Quoting only f″(c)** in a Second Derivative Test justification, without f′(c) = 0.
- **Treating "inconclusive" as "no extremum".** When f″(c) = 0, switch tests; do not conclude.
- **Reading the graph of f′ as if it were f.** Peaks of f′ are inflection points of f, not maxima.

## Self-check

1. Find the intervals of concavity and the inflection points of f(x) = x³ − 3x² + 4.
2. f″(x) = x(x − 3)² e^(−x). At which x does the graph of f have a point of inflection?
3. Use the Second Derivative Test to classify the critical points of g(x) = 2x³ + 3x² − 12x.
4. The graph of f′ is decreasing on (−∞, 1) and increasing on (1, ∞). What happens to the graph of f at x = 1?
5. A tank's volume V(t) has V′(t) < 0 and V″(t) > 0. Describe the volume in words.
6. Why can the Second Derivative Test not be used on f(x) = |x| at x = 0?

*Answers:* 1. f″ = 6x − 6: concave down for x < 1, concave up for x > 1, inflection point (1, 2). 2. Only x = 0; (x − 3)² does not change sign. 3. g′ = 6(x + 2)(x − 1); g″ = 12x + 6. g″(−2) = −18 < 0: relative maximum at x = −2. g″(1) = 18 > 0: relative minimum at x = 1. 4. f′ changes from decreasing to increasing, so f has a point of inflection (concave down to concave up). 5. The volume is decreasing, but more and more slowly. 6. f′(0) does not exist, and the test needs f′(0) = 0. (The First Derivative Test shows a minimum.)

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 5, Topics 5.6–5.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
