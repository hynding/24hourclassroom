# Unit 5 · Analytical Applications of Differentiation · The night-before sheet

**AP exam weight:** 15–20% of the exam, tied with Unit 6 for the largest share of any AB unit
**Topics:** 5.1 Using the Mean Value Theorem · 5.2 Extreme Value Theorem, Global Versus Local Extrema, and Critical Points · 5.3 Determining Intervals on Which a Function Is Increasing or Decreasing · 5.4 Using the First Derivative Test to Determine Relative (Local) Extrema · 5.5 Using the Candidates Test to Determine Absolute (Global) Extrema · 5.6 Determining Concavity of Functions over Their Domains · 5.7 Using the Second Derivative Test to Determine Extrema · 5.8 Sketching Graphs of Functions and Their Derivatives · 5.9 Connecting a Function, Its First Derivative, and Its Second Derivative · 5.10 Introduction to Optimization Problems · 5.11 Solving Optimization Problems · 5.12 Exploring Behaviors of Implicit Relations
**Practices:** 3 (Justification), 2 (Connecting Representations), 1 (Implementing Mathematical Processes), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 5, Topics 5.1–5.12, in our own words

## The ideas that generate every question

1. **Existence theorems need their hypotheses stated (5.1, 5.2).** The Mean Value Theorem: if f is continuous on [a, b] and differentiable on (a, b), some c in (a, b) has f′(c) = (f(b) − f(a))/(b − a). The Extreme Value Theorem: if f is continuous on [a, b], it attains an absolute maximum and minimum there. Neither says where. "f is differentiable" covers both MVT hypotheses, because differentiability implies continuity.
2. **Critical points are the only interior candidates (5.2).** A critical point is an input in the domain where f′ = 0 or f′ does not exist. Every relative extremum is at a critical point; not every critical point is an extremum (x³ at 0).
3. **The sign of f′ gives direction (5.3, 5.4).** f′ > 0: increasing. f′ < 0: decreasing. A sign change of f′ at a critical point is a relative extremum: + to − is a maximum, − to + is a minimum. No sign change, no extremum.
4. **Absolute extrema come from comparison (5.5).** On a closed interval, evaluate f at every interior critical point and both endpoints; the largest and smallest values win. On an open interval, use a single critical point together with the First Derivative Test.
5. **The sign of f″ gives concavity (5.6, 5.7).** f″ > 0: concave up (f′ increasing). f″ < 0: concave down. A point of inflection is where f″ changes sign. At a horizontal tangent, concave up means a minimum and concave down a maximum; if f″(c) = 0, the Second Derivative Test says nothing.
6. **One picture, three graphs (5.8, 5.9).** The height of the f′ graph is the slope of f; the slope of the f′ graph is f″. Zeros of f′ with a sign change are extrema of f; peaks and valleys of f′ are inflection points of f.
7. **Implicit curves are analysed with dy/dx (5.12).** Horizontal tangent: numerator of dy/dx zero, denominator not. Vertical tangent: denominator zero, numerator not. d²y/dx² comes from differentiating dy/dx and substituting dy/dx back in.
8. **Optimization is a modelling problem plus a justification (5.10, 5.11).** Write the objective in one variable using the constraint, state the domain, find the critical points, prove which gives the absolute extremum, and answer with units.

## Key facts and procedures

| Want | Do this |
|---|---|
| A value of f′ guaranteed on [a, b] | MVT: check continuity on [a, b] and differentiability on (a, b); value is the secant slope |
| A guaranteed f′ = 0 | equal outputs f(a) = f(b) plus the MVT (Rolle's theorem) |
| Critical points | solve f′ = 0; find where f′ is undefined; keep only points in the domain of f |
| Where f increases | sign chart of f′ split at critical points and domain gaps |
| Relative extrema | First Derivative Test (always works) or Second Derivative Test (needs f′(c) = 0, f″(c) ≠ 0) |
| Absolute extrema on [a, b] | Candidates Test: interior critical points and endpoints |
| Concavity and inflection | sign chart of f″; inflection needs a sign change and f defined there |
| Read f from the f′ graph | above/below axis → up/down; rising/falling → concave up/down |
| Horizontal / vertical tangent (implicit) | dy/dx numerator = 0 / denominator = 0, solved with the curve's equation |
| Optimize | objective + constraint → one variable + domain → critical points → justify absolute → answer with units |
| Distance problems | minimize D² instead of D |

## Justification sentences that earn the point

- **MVT (table):** "f is differentiable, so it is continuous on [2, 5] and differentiable on (2, 5). By the Mean Value Theorem there is a c in (2, 5) with f′(c) = (f(5) − f(2))/(5 − 2) = 4."
- **EVT:** "f is continuous on the closed interval [0, 6], so by the Extreme Value Theorem f has an absolute maximum on [0, 6]."
- **Increasing:** "f is increasing on (1, 4) because f′(x) > 0 on (1, 4)."
- **Relative maximum (First Derivative Test):** "f has a relative maximum at x = 3 because f′ changes from positive to negative at x = 3."
- **No extremum:** "f has no relative extremum at x = 0 because f′ does not change sign at x = 0."
- **Second Derivative Test:** "f has a relative minimum at x = 2 because f′(2) = 0 and f″(2) > 0."
- **Point of inflection:** "The graph of f has a point of inflection at x = 1 because f″ changes sign at x = 1" (or "because f′ changes from increasing to decreasing at x = 1").
- **Absolute extremum (closed interval):** a table of f at the critical points and endpoints, then "the absolute maximum is 10, at x = 4."
- **Absolute extremum (one critical point):** "x = 10 is the only critical point on x > 0, and L′ changes from negative to positive there, so L(10) is the absolute minimum."

Always name the function whose sign you are using (f′ or f″), the direction of the change, and the location.

## Common errors

- Stating "by the MVT" without the two hypotheses, or naming a particular point (the midpoint) as c.
- Using the MVT where the IVT is needed: a value of f needs the IVT, a value of f′ the MVT.
- Concluding an extremum from f′(c) = 0, or an inflection point from f″(c) = 0, without a sign change.
- Forgetting critical points where f′ is undefined (cusps, corners), or including points outside the domain.
- Ignoring repeated factors: (x − 2)² in f′ or f″ gives a zero without a sign change.
- Leaving out the endpoints in the Candidates Test, or keeping critical points outside the interval.
- Reversing the Second Derivative Test, or citing only f″(c) without f′(c) = 0.
- Reading the graph of f′ as though it were the graph of f.
- Giving the input when the extreme value is asked, or reporting one location when the value is attained twice.
- Optimization: two variables left in the objective, no domain, no justification, no units.
- Implicit curves: stopping at "y = 2x" without finding points on the curve; differentiating −x/y as −1/y.

## Calculator or not?

Most Unit 5 reasoning is done by hand and is about signs. Expect a calculator when the critical points of a model cannot be found algebraically (solve f′(t) = 0 numerically), when the MVT asks you to find the time c, or when candidate values involve e or trigonometric functions. Report three decimal places, and still write the justification: a calculator finds the number; the theorem or test earns the point.

## Self-test

1. Does the MVT apply to f(x) = 1/(x − 2) on [0, 4]? Explain.
2. Find the critical points of g(x) = x^(4/3) − 4x^(1/3).
3. f′(x) = (x − 2)(x + 1)²e^x. Classify each critical point of f.
4. Find the absolute extrema of h(x) = x³ − 3x on [0, 2].
5. Find the inflection points of f(x) = x⁴ − 4x³.
6. f′(5) = 0 and f″(5) = −3. What can you conclude?
7. The graph of f′ is a line with positive slope crossing the x-axis at x = −1. Describe f.
8. Find the points on x² + y² − 6x = 0 where the tangent line is vertical.
9. A rectangle with perimeter 20 has the largest possible area. Find it, with a justification.

**Answers.** 1. No: f is not continuous at x = 2, inside [0, 4]. 2. g′(x) = (4/3)x^(1/3) − (4/3)x^(−2/3) = 4(x − 1)/(3x^(2/3)): x = 1 (zero) and x = 0 (undefined). 3. x = 2: f′ changes − to +, relative minimum; x = −1: f′ negative on both sides, no extremum. 4. h′ = 3x² − 3 = 0 at x = 1; h(0) = 0, h(1) = −2, h(2) = 2: maximum 2 at x = 2, minimum −2 at x = 1. 5. f″ = 12x(x − 2): inflection points at x = 0 and x = 2. 6. A relative maximum at x = 5 (Second Derivative Test). 7. f decreases for x < −1, increases for x > −1, has a relative (and absolute) minimum at x = −1, and is concave up everywhere. 8. dy/dx = (3 − x)/y; vertical tangents where y = 0: x² − 6x = 0, so (0, 0) and (6, 0). 9. A = x(10 − x), A′ = 10 − 2x = 0 at x = 5; A(0) = A(10) = 0, so the maximum area is 25, for a 5 by 5 square.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 5, Topics 5.1–5.12). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
