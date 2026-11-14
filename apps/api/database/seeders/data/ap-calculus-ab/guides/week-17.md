# Week 17 · The Mean Value Theorem, the Extreme Value Theorem and Critical Points

**Topics:** 5.1 Using the Mean Value Theorem · 5.2 Extreme Value Theorem, Global Versus Local Extrema, and Critical Points
**Practices:** 3 (Justification), 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 5, Topics 5.1–5.2, learning objectives in our own words
**Spiral:** Unit 1's Intermediate Value Theorem (week 5) was the first existence theorem: check the hypotheses, then claim that something exists. This week's two theorems work the same way. You also need week 7's link between differentiability and continuity, the derivative rules of weeks 8–12, and week 7's habit of estimating a derivative from a table with a difference quotient.

## What you need to be able to do

- **5.1** State both hypotheses of the Mean Value Theorem (MVT) and check them for a given function and interval.
- **5.1** Find a value c guaranteed by the MVT for a formula, and say whether the MVT applies when a hypothesis fails.
- **5.1** Use the MVT on a table of a differentiable function to justify that the derivative takes a particular value somewhere, including the value 0 when two outputs are equal (Rolle's theorem).
- **5.2** State the Extreme Value Theorem (EVT) and explain, with an example, why each hypothesis is needed.
- **5.2** Distinguish relative (local) extrema from absolute (global) extrema, and report an extreme value and where it occurs.
- **5.2** Find every critical point of a function: inputs in its domain where f′ is zero or undefined.

## Key terms

| Term | Meaning |
|---|---|
| Mean Value Theorem | If f is continuous on [a, b] and differentiable on (a, b), there is a c in (a, b) with f′(c) = (f(b) − f(a))/(b − a). |
| Rolle's theorem | The MVT in the case f(a) = f(b): some c in (a, b) has f′(c) = 0. |
| Extreme Value Theorem | If f is continuous on a closed interval [a, b], then f attains an absolute maximum and an absolute minimum on [a, b]. |
| Relative (local) maximum | f(c) ≥ f(x) for every x in some open interval around c. |
| Absolute (global) maximum | f(c) ≥ f(x) for every x in the interval or domain under discussion. |
| Critical point | An input c in the domain of f at which f′(c) = 0 or f′(c) does not exist. |
| Existence theorem | A theorem that guarantees something exists without saying where it is. |

## The Mean Value Theorem (5.1)

The average rate of change of f on [a, b] is the slope of the secant line, (f(b) − f(a))/(b − a). The MVT says that if the graph has no breaks on [a, b] and no corners, cusps or vertical tangents strictly between a and b, then somewhere strictly inside the interval the tangent line is parallel to the secant line. In rate language: **at some instant the instantaneous rate equals the average rate.**

Read the hypotheses carefully.

1. **Continuous on the closed interval [a, b].** The endpoints matter: a jump at an endpoint can break the theorem.
2. **Differentiable on the open interval (a, b).** The endpoints do not need derivatives. √x on [0, 4] satisfies the MVT although √x has no derivative at 0.

Because differentiability implies continuity (week 7), the phrase "f is differentiable on [a, b]" or "f is differentiable for all x" covers both hypotheses at once. On a table problem the stem usually says "f is differentiable", and you are expected to say why that matters.

The theorem guarantees **at least one** c. There may be several, and the MVT never tells you where they are: not the midpoint, not any specific point.

**Worked example 1 (formula).** Let f(x) = x² − 4x + 1 on [1, 4]. Show the MVT applies and find c.

f is a polynomial, so it is continuous on [1, 4] and differentiable on (1, 4). f(1) = 1 − 4 + 1 = −2 and f(4) = 16 − 16 + 1 = 1, so the secant slope is (1 − (−2))/(4 − 1) = 1. Solve f′(c) = 2c − 4 = 1: c = 5/2, which lies in (1, 4). (Check the answer is inside the open interval; a solution outside it does not count.)

**Rolle's theorem** is the special case f(a) = f(b): the secant line is horizontal, so the conclusion is f′(c) = 0 for some c in (a, b). Between two equal outputs a differentiable function must have a horizontal tangent.

**Worked example 2 (table, hypothetical data).** A delivery van's distance along a route is given by a differentiable function D, with D(t) in kilometers and t in hours.

| t (hours) | 0 | 0.5 | 1.5 | 2 | 3 |
|---|---|---|---|---|---|
| D(t) (km) | 0 | 22 | 70 | 70 | 115 |

(a) Must there be a time in (0.5, 1.5) when the van's velocity is 48 km/h? The secant slope on [0.5, 1.5] is (70 − 22)/(1.5 − 0.5) = 48. The justification that earns credit:

> D is differentiable, so D is continuous on [0.5, 1.5] and differentiable on (0.5, 1.5). By the Mean Value Theorem there is a time c in (0.5, 1.5) with D′(c) = (D(1.5) − D(0.5))/(1.5 − 0.5) = 48 km/h.

(b) Must the van ever have velocity 0? Yes: D(1.5) = D(2) = 70, so by the MVT (Rolle) D′(c) = 0 for some c in (1.5, 2).

(c) Must the van have velocity 50 km/h at t = 2.5? No. The secant slope on [2, 3] is 45, and even so the MVT names no particular time.

**When a hypothesis fails.** The theorem may then fail, so you cannot use it.

**Worked example 3.** On [−1, 1] each of these has secant slope 0 (equal endpoint values) or fails a hypothesis:

- f(x) = |x|: continuous, but not differentiable at 0 (corner). f′ is −1 or 1, never 0, although f(−1) = f(1). The conclusion genuinely fails.
- g(x) = 1/x: not defined at 0, so not continuous on [−1, 1]. The MVT says nothing.
- h(x) = x^(2/3): continuous, but h′(x) = (2/3)x^(−1/3) does not exist at 0 (a cusp). h(−1) = h(1) = 1 and h′ is never 0.

A failed hypothesis does not prove that no such c exists; it only means the theorem gives no guarantee. Sometimes the conclusion happens to hold anyway.

**MVT or IVT?** The IVT (continuity only) guarantees a value of **f**. The MVT (continuity and differentiability) guarantees a value of **f′**. "The tank held 30 liters at some time" is IVT; "the tank was filling at 6 liters per hour at some time" is MVT.

## The Extreme Value Theorem (5.2)

**If f is continuous on a closed interval [a, b], then f has an absolute maximum value and an absolute minimum value on [a, b].** Both are attained: there are inputs c and d in [a, b] with f(c) ≥ f(x) ≥ f(d) for every x in [a, b].

Each hypothesis is needed:

- **Closed interval.** x² on (0, 2) gets as close to 4 and to 0 as you like, but never reaches either, so it has no absolute maximum or minimum there.
- **Continuity.** 1/(x − 2) on [0, 3] is unbounded near x = 2, so it has no absolute maximum.

Like the MVT, the EVT is an existence theorem: it does not tell you where the extrema are. Next week's candidates test finds them.

## Local versus global extrema (5.2)

A **relative (local) maximum** at c means f(c) is at least as large as every nearby output, on some open interval around c. An **absolute (global) maximum** on an interval means f(c) is at least as large as every output on the whole interval. On the AP exam a relative extremum needs inputs on both sides, so it is never at an endpoint; an absolute extremum on a closed interval may well be at an endpoint.

Report extrema in two parts: the **value** is the output; the **location** is the input. "The absolute maximum value is 8, and it occurs at x = 2 and x = −2."

## Critical points (5.2)

A **critical point** of f is an input c **in the domain of f** where f′(c) = 0 or f′(c) does not exist.

**Fermat's theorem.** If f has a relative extremum at c, then c is a critical point. So relative extrema can only occur at critical points. The converse is false: f(x) = x³ has f′(0) = 0 but is increasing through 0. A critical point is a **candidate**, not a conclusion.

For a continuous function on a closed interval, the absolute extrema occur either at critical points inside the interval or at the endpoints. That is the whole basis of next week's candidates test.

**Worked example 4.** Find the critical points of f(x) = x^(2/3)(x − 5).

Write f(x) = x^(5/3) − 5x^(2/3). Then f′(x) = (5/3)x^(2/3) − (10/3)x^(−1/3) = (5x − 10)/(3x^(1/3)) = 5(x − 2)/(3x^(1/3)).

- f′(x) = 0 when x = 2.
- f′(x) does not exist when x = 0, and f(0) = 0 exists, so 0 is in the domain.

Critical points: x = 0 and x = 2. (The zeros of f itself, 0 and 5, are irrelevant; x = 5 is not a critical point.)

**Worked example 5.** Find the absolute extrema of f(x) = x⁴ − 2x² on [−2, 2].

f is a polynomial, continuous on the closed interval, so by the EVT both extrema exist. f′(x) = 4x³ − 4x = 4x(x − 1)(x + 1), so the critical points are −1, 0 and 1. Compare values:

| x | −2 | −1 | 0 | 1 | 2 |
|---|---|---|---|---|---|
| f(x) | 8 | −1 | 0 | −1 | 8 |

Absolute maximum 8, at x = −2 and x = 2 (the endpoints). Absolute minimum −1, at x = −1 and x = 1. The value 0 at x = 0 is a relative maximum but not an absolute one.

**Watch the domain.** 1/x has derivative −1/x², undefined at 0, but 0 is not in the domain of 1/x, so it is not a critical point. Likewise if f is defined only for x > 0 and f′(x) = (x − 4)/√x, the only critical point is 4.

## Common mistakes

- **Leaving out the hypotheses.** On the AP exam, "by the MVT, f′(c) = 3" without continuity and differentiability on the right intervals earns no justification point.
- **Naming a specific point.** The MVT guarantees some c; "f′(7) = 3 because 7 is the midpoint" is wrong.
- **Mixing up IVT and MVT.** A value of f needs the IVT; a value of f′ needs the MVT.
- **Using an open interval for continuity.** Continuity is required on the closed interval [a, b]; differentiability only on (a, b).
- **Forgetting where f′ is undefined.** Critical points include corners, cusps and vertical tangents, provided the point is in the domain of f.
- **Calling every critical point an extremum.** x³ at 0 is the standard counterexample.
- **Ignoring endpoints.** A global extremum on a closed interval can sit at an endpoint.
- **Answering the input when the value is asked.** "The maximum is 2" is not the same as "the maximum occurs at x = 2".

## Self-check

1. Does the MVT apply to f(x) = x^(1/3) on [−8, 8]? Explain, and decide whether its conclusion holds anyway.
2. Find the value c guaranteed by the MVT for f(x) = x³ on [0, 3].
3. A differentiable function P has P(4) = 12 and P(9) = 12. What can you conclude, and which theorem justifies it?
4. Give an example of a function on a closed interval with no absolute maximum, and say which EVT hypothesis it breaks.
5. Find the critical points of g(x) = x√(6 − x) (domain x ≤ 6).
6. Explain why f(x) = x³ + x has no relative extrema.

*Answers:* 1. No: x^(1/3) is not differentiable at 0 (vertical tangent). The secant slope is (2 − (−2))/16 = 1/4, and f′(x) = 1/(3x^(2/3)) = 1/4 at x = ±(4/3)^(3/2) ≈ ±1.54, so the conclusion happens to hold. 2. Secant slope 27/3 = 9; 3c² = 9 gives c = √3. 3. P′(c) = 0 for some c in (4, 9), by the MVT (Rolle), since P is continuous on [4, 9] and differentiable on (4, 9). 4. For example f(x) = 1/x for x ≠ 0 with f(0) = 0, on [0, 1]: not continuous at 0. 5. g′(x) = (12 − 3x)/(2√(6 − x)): x = 4 (g′ = 0) and x = 6 (g′ undefined, in the domain). 6. f′(x) = 3x² + 1 > 0 for every x, so f has no critical points, and relative extrema occur only at critical points.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 5, Topics 5.1–5.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
