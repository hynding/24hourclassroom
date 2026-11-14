# Week 18 · Increasing and Decreasing Functions, the First Derivative Test and the Candidates Test

**Topics:** 5.3 Determining Intervals on Which a Function Is Increasing or Decreasing · 5.4 Using the First Derivative Test to Determine Relative (Local) Extrema · 5.5 Using the Candidates Test to Determine Absolute (Global) Extrema
**Practices:** 3 (Justification), 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 5, Topics 5.3–5.5, learning objectives in our own words
**Spiral:** Last week gave you critical points, Fermat's theorem and the Extreme Value Theorem. This week turns them into tools. The Mean Value Theorem is what proves that a positive derivative means an increasing function, and the derivative rules of Units 2 and 3 produce the f′ you will analyse.

## What you need to be able to do

- **5.3** Find the intervals on which a function is increasing or decreasing from a formula for f, a formula for f′, a table of f′, or a description of the graph of f′, and justify with the sign of f′.
- **5.4** Use the First Derivative Test to classify each critical point as a relative maximum, a relative minimum or neither, and write the justification sentence the AP exam expects.
- **5.4** Handle critical points where f′ is undefined (corners, cusps) and repeated factors where f′ touches zero without changing sign.
- **5.5** Use the Candidates Test to find the absolute maximum and minimum values of a continuous function on a closed interval, and say where they occur.
- **5.5** Recognise when an absolute extremum on an open interval or on all reals can be found from a single critical point.

## Key terms

| Term | Meaning |
|---|---|
| Increasing on an interval | For any x₁ < x₂ in the interval, f(x₁) < f(x₂). |
| Sign chart | A number line split at the critical points (and points outside the domain), labelled with the sign of f′ on each piece. |
| First Derivative Test | At a critical point c of a continuous f: f′ changes + to − ⟹ relative maximum; − to + ⟹ relative minimum; no change ⟹ no extremum. |
| Candidates Test | On [a, b], evaluate continuous f at every critical point in (a, b) and at a and b; the largest output is the absolute maximum and the smallest is the absolute minimum. |
| Candidate | A critical point inside the interval or an endpoint: the only places an absolute extremum can occur. |

## Increasing and decreasing (5.3)

**If f′(x) > 0 for every x in an interval, then f is increasing on that interval. If f′(x) < 0 throughout, f is decreasing.** The proof is the Mean Value Theorem: for any x₁ < x₂ in the interval, f(x₂) − f(x₁) = f′(c)(x₂ − x₁) for some c between them, and that product has the sign of f′(c).

The converse fails at single points: x³ is increasing everywhere but its derivative is 0 at x = 0. An isolated zero of f′ does not interrupt an increasing interval.

**Building a sign chart.**

1. Find f′ and factor it as far as possible.
2. Mark every x where f′ = 0 or f′ is undefined, and every x not in the domain of f.
3. Test the sign of f′ on each piece, either with one test value or by counting negative factors.
4. Read off: positive pieces are where f increases, negative pieces where it decreases.

Factors that can never be negative, such as eˣ, x² + 1 or (x − 2)², do not affect the sign and can be ignored on the chart, although a squared factor still makes f′ equal to 0 at one point.

**Worked example 1.** Find where f(x) = 2x³ − 3x² − 12x is increasing and decreasing.

f′(x) = 6x² − 6x − 12 = 6(x − 2)(x + 1). Zeros: x = −1 and x = 2.

| Interval | x < −1 | −1 < x < 2 | x > 2 |
|---|---|---|---|
| Test value | −2 | 0 | 3 |
| Sign of f′ | + | − | + |
| f | increasing | decreasing | increasing |

Justification: "f is increasing on x < −1 and on x > 2 because f′(x) > 0 there; f is decreasing on −1 < x < 2 because f′(x) < 0 there." Open or closed intervals are both accepted for a continuous f, but never join two intervals with "∪" unless f really increases across the gap (here it does not).

**From the graph of f′.** If you are given the graph of f′ (a common AP setup), f increases where the f′ graph is **above** the x-axis and decreases where it is **below**. Do not read the f′ graph as though it were the graph of f: a peak of f′ is the steepest point of f, not a maximum of f.

## The First Derivative Test (5.4)

Let c be a critical point of a function f that is continuous at c.

- If f′ changes from **positive to negative** at c, f has a **relative maximum** at c.
- If f′ changes from **negative to positive** at c, f has a **relative minimum** at c.
- If f′ does **not change sign** at c, f has **no relative extremum** at c.

**The justification sentence.** AP readers want three things: the function f′ (not f), the sign change in the right direction, and the location. For example:

> f has a relative maximum at x = −1 because f′ changes from positive to negative at x = −1.

Sentences that lose the point: "because f′(−1) = 0" (no sign change); "because the slope goes up then down" (ambiguous: the slope of what?); "because f changes from increasing to decreasing" (accepted by some rubrics, but the safe version names f′); a sign chart with no sentence.

**Worked example 2 (repeated factor).** A differentiable function f has f′(x) = (x + 1)(x − 2)²e^(−x). Classify its critical points.

f′ exists everywhere and is 0 at x = −1 and x = 2. The factors (x − 2)² and e^(−x) are never negative, so the sign of f′ is the sign of x + 1.

| Interval | x < −1 | −1 < x < 2 | x > 2 |
|---|---|---|---|
| Sign of f′ | − | + | + |

- x = −1: f′ changes from negative to positive, so f has a relative minimum at x = −1.
- x = 2: f′ is positive on both sides, so f has no relative extremum at x = 2. The graph flattens momentarily and keeps rising.

**Worked example 3 (cusp).** For f(x) = x^(2/3), f′(x) = (2/3)x^(−1/3), which is undefined at 0 (and 0 is in the domain). f′ < 0 for x < 0 and f′ > 0 for x > 0, so f has a relative minimum at x = 0. Critical points where f′ is undefined are tested exactly the same way.

**A caution on domains.** If f is not defined at a point, f′ may change sign there without giving an extremum. For f(x) = 1/x, f′ = −1/x² is negative on both sides of 0 anyway, but for a function like 1/x² the derivative changes from + to − across x = 0, and there is no maximum: the function is not defined there. Always check that a sign change happens at a point of the domain.

## The Candidates Test (5.5)

The EVT says a continuous function on [a, b] has an absolute maximum and minimum; Fermat's theorem says an extremum inside the interval occurs at a critical point. So the only possible locations are the **critical points in (a, b)** and the **endpoints a and b**. Evaluate f at all of them and compare.

1. Confirm f is continuous on [a, b] (so the extrema exist).
2. Find every critical point of f in (a, b). Discard any outside the interval.
3. Make a table of f at those critical points and at a and b.
4. The largest value is the absolute maximum; the smallest is the absolute minimum. Report each value and **every** input where it occurs.

**Worked example 4.** Find the absolute extrema of g(x) = x + 4/x on [1, 4].

g is continuous on [1, 4] (the only discontinuity, x = 0, is outside). g′(x) = 1 − 4/x² = (x² − 4)/x², which is 0 at x = ±2; only x = 2 is in the interval.

| x | 1 | 2 | 4 |
|---|---|---|---|
| g(x) | 5 | 4 | 5 |

The absolute minimum is 4, at x = 2. The absolute maximum is 5, at both x = 1 and x = 4. (Including x = −2 would add the value −4, which is not on the interval: a classic error.)

**Single critical point.** On an open interval (or all reals) the Candidates Test has no endpoints to check. If a continuous f has exactly one critical point c on an interval and the First Derivative Test shows a relative minimum at c, then f(c) is the absolute minimum on that interval: f decreases all the way to c and increases all the way after. This argument is the backbone of optimization in week 21.

**Worked example 5 (hypothetical model).** A bacteria culture has P(t) = t³ − 9t² + 24t + 10 hundred bacteria at t hours, 0 ≤ t ≤ 5.

- P′(t) = 3(t − 2)(t − 4): positive on (0, 2) and (4, 5), negative on (2, 4). So P increases on 0 < t < 2 and 4 < t < 5.
- First Derivative Test: relative maximum at t = 2 (P′ changes + to −), relative minimum at t = 4 (P′ changes − to +).
- Candidates: P(0) = 10, P(2) = 30, P(4) = 26, P(5) = 30. The absolute maximum, 3,000 bacteria, happens twice, at t = 2 and t = 5; the absolute minimum, 1,000 bacteria, is at t = 0.

Notice that the relative minimum at t = 4 (value 26) is not the absolute minimum: the starting population was smaller. Relative and absolute are different questions with different tests.

## Common mistakes

- **Testing f instead of f′.** The sign that matters for increasing, decreasing and the First Derivative Test is the sign of f′.
- **Concluding an extremum from f′(c) = 0.** A sign change is required; repeated factors such as (x − 2)² give none.
- **Forgetting points where f′ is undefined.** Cusps and corners belong on the sign chart.
- **Dropping the endpoints in the Candidates Test.** Many absolute extrema are at endpoints.
- **Keeping critical points outside the interval.** They are not candidates.
- **Reporting only one location for a tie.** If the maximum value occurs twice, give both inputs.
- **Using the First Derivative Test for an absolute extremum on a closed interval** without comparing endpoint values. It finds relative extrema; the Candidates Test finds absolute ones.

## Self-check

1. Find the intervals on which f(x) = x⁴ − 4x³ is increasing.
2. g′(x) = x²(x − 5)³. Classify each critical point of g.
3. Find the absolute extrema of h(x) = x − 2√x on [0, 9].
4. Explain why f(x) = x³ + 3x has no absolute maximum on (−∞, ∞) but does on [−1, 2].
5. The graph of f′ is a parabola opening downward with x-intercepts at x = 1 and x = 5. Where does f have a relative minimum?

*Answers:* 1. f′ = 4x²(x − 3): increasing for x > 3 (decreasing for x < 3, with no extremum at 0). 2. x = 0: no sign change (x² ≥ 0), no extremum; x = 5: g′ changes − to +, relative minimum. 3. h′ = 1 − 1/√x = 0 at x = 1; h(0) = 0, h(1) = −1, h(9) = 3: minimum −1 at x = 1, maximum 3 at x = 9. 4. f′ = 3x² + 3 > 0, so f is always increasing: on all reals its outputs grow without bound, but on [−1, 2] it is continuous on a closed interval and the maximum is f(2) = 14. 5. At x = 1, where f′ changes from negative to positive.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 5, Topics 5.3–5.5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
