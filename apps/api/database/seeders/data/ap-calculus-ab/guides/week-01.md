# Week 01 · Introducing Limits: Instantaneous Change, Graphs and Tables

**Topics:** 1.1 Introducing Calculus: Can Change Occur at an Instant? · 1.2 Defining Limits and Using Limit Notation · 1.3 Estimating Limit Values from Graphs · 1.4 Estimating Limit Values from Tables
**Practices:** 2 (Connecting Representations), 4 (Communication and Notation), 1 (Implementing Mathematical Processes)
**Framework:** AP Calculus AB and BC CED, Unit 1, Topics 1.1–1.4, learning objectives in our own words
**Spiral:** This is the first week. It builds on precalculus: average rate of change as the slope of a secant line, reading piecewise functions and their graphs, function notation, and factoring (a difference of squares in particular).

## What you need to be able to do

- **1.1** Explain why a rate of change at a single instant cannot be computed directly from two values, and how average rates over shrinking intervals approach it.
- **1.2** Read and write limit notation, including one-sided limits, and explain in words what lim (x→c) f(x) = L says.
- **1.2** State when a two-sided limit exists (both one-sided limits exist and agree) and recognise that the limit does not depend on f(c).
- **1.3** Estimate limits and one-sided limits from a graph, including at holes, jumps, vertical asymptotes and oscillations, and tell a limit apart from a function value.
- **1.4** Estimate a limit from a table of values that approach the input from both sides, and explain the limits of what a table can show.

## Key terms

| Term | Meaning |
|---|---|
| Average rate of change | (f(b) − f(a))/(b − a), the slope of the secant line through two points of the graph. |
| Instantaneous rate of change | The value that average rates over [a, a + h] approach as h → 0. |
| Difference quotient | (f(a + h) − f(a))/h, the average rate of change from a to a + h. |
| Limit | lim (x→c) f(x) = L: f(x) can be made as close to L as we like by taking x close enough to c, with x ≠ c. |
| Left-hand limit | lim (x→c⁻) f(x): the value f(x) approaches as x approaches c from below. |
| Right-hand limit | lim (x→c⁺) f(x): the value f(x) approaches as x approaches c from above. |
| Does not exist (DNE) | No single real number L works: the sides disagree, the values are unbounded, or they oscillate. |
| Unbounded behaviour | f(x) grows (or falls) past every number as x → c, written lim (x→c) f(x) = ∞ (or −∞). |

## Can change occur at an instant? (1.1)

Speed is distance divided by time. That works for an interval: if you drive 90 km in 1.5 hours, your average speed is 60 km/h. But a speedometer shows a speed *at an instant*, and an instant has no length. Dividing a change in distance of 0 by a change in time of 0 gives 0/0, which is meaningless.

Calculus resolves this by refusing to divide by zero. Instead, compute average rates over shorter and shorter intervals and watch where they head. The number they approach is the **instantaneous rate of change**. On a graph, each average rate is the slope of a secant line; as the second point slides toward the first, the secant lines pivot toward the **tangent line**, whose slope is the instantaneous rate.

**Worked example.** A hypothetical drone rises so that its height is h(t) = t³ metres after t seconds. Estimate its velocity at t = 2.

Average velocity over [2, 2 + Δt] is (h(2 + Δt) − h(2))/Δt, and h(2) = 8.

| Δt (s) | h(2 + Δt) (m) | average velocity (m/s) |
|---|---|---|
| 1 | 27 | 19 |
| 0.1 | 9.261 | 12.61 |
| 0.01 | 8.120601 | 12.0601 |
| 0.001 | 8.012006001 | 12.006001 |

The averages are closing in on 12. Intervals to the left of 2 tell the same story (over [1.9, 2] the average is 11.41). So the drone's velocity at t = 2 is 12 m/s. Notice what we did *not* do: we never set Δt = 0. The algebra shows why the pattern holds: ((2 + Δt)³ − 8)/Δt = 12 + 6Δt + (Δt)² for Δt ≠ 0, and that expression approaches 12.

That is the whole programme of Unit 1 in miniature. The value 12 is a **limit**: lim (Δt→0) (h(2 + Δt) − h(2))/Δt = 12. Unit 2 will call it the derivative h′(2).

## Limit notation and what it means (1.2)

We write

lim (x→c) f(x) = L

and read it "the limit of f(x) as x approaches c equals L". It means that the outputs f(x) can be made as close to L as we like by taking inputs close enough to c, **from both sides and with x ≠ c**. Three consequences matter all year:

1. **The limit ignores f(c).** The value at c may equal L, may be some other number, or may not exist. The limit only asks where f is heading.
2. **Both sides count.** The **one-sided limits** lim (x→c⁻) f(x) (from the left, x < c) and lim (x→c⁺) f(x) (from the right, x > c) look at one side each. The two-sided limit exists and equals L exactly when both one-sided limits exist and equal L.
3. **∞ is not a number.** If f(x) grows without bound as x → c we write lim (x→c) f(x) = ∞. That is a description of *how* the limit fails to exist, not a value it equals.

**Worked example.** Let g(x) = x² − 1 for x < 2, g(2) = 7, and g(x) = 2x − 1 for x > 2. Find lim (x→2⁻) g(x), lim (x→2⁺) g(x), lim (x→2) g(x) and g(2).

- From the left, g(x) = x² − 1, which approaches 4 − 1 = 3.
- From the right, g(x) = 2x − 1, which approaches 4 − 1 = 3.
- The one-sided limits agree, so lim (x→2) g(x) = 3.
- g(2) = 7, a different number. That does not affect the limit at all.

Change the right-hand piece to 2x + 1 and the right-hand limit becomes 5. Now the sides disagree (3 and 5), and lim (x→2) g(x) does not exist, even though both one-sided limits do.

**Writing it well.** On free-response questions, limits are written with the limit symbol attached to every expression until you have actually taken the limit. Write lim (x→2) (2x − 1) = 3, never "2x − 1 = 3".

## Estimating limits from graphs (1.3)

On a graph, the limit at x = c is the height the curve approaches as you trace toward x = c from each side. Two drawing conventions decide everything:

- An **open circle** marks a point *not* on the graph. The curve heads there, so it shows a limit, but not a value.
- A **solid dot** marks the function value.

A limit at c **fails to exist** in three typical ways:

- **Jump:** the left and right pieces head to different heights.
- **Unbounded:** the graph shoots up or down along a vertical asymptote.
- **Oscillation:** the graph wiggles ever faster and never settles, as y = sin(1/x) does near 0.

**Worked example.** A function f on −3 ≤ x ≤ 5 has this graph: a segment from the solid point (−3, −1) to an open circle at (1, 3); a solid dot at (1, 0); a segment from an open circle at (1, 3) to the solid point (3, 1); and a segment from an open circle at (3, −2) to the solid point (5, 0). Read every limit at x = 1 and x = 3.

| | x = 1 | x = 3 |
|---|---|---|
| Left-hand limit | 3 | 1 |
| Right-hand limit | 3 | −2 |
| Two-sided limit | 3 | does not exist |
| Function value | f(1) = 0 | f(3) = 1 |

At x = 1 the curve heads to the same open circle from both sides, so the limit is 3 even though the dot sits at height 0. At x = 3 the sides head to different heights, so the two-sided limit does not exist, although the left-hand limit happens to equal f(3). At the endpoint x = −3 only a right-hand limit makes sense: lim (x→−3⁺) f(x) = −1.

## Estimating limits from tables (1.4)

When you have a formula but no algebraic trick yet, a table of values can suggest a limit. A good table:

- uses inputs that close in on c from **both** sides, such as c ± 0.1, c ± 0.01, c ± 0.001;
- reads the outputs nearest to c most seriously;
- checks that the left and right columns approach the same number.

**Worked example.** Estimate lim (x→0) (2ˣ − 1)/x.

Substituting x = 0 gives 0/0, which says nothing. Build a table (values to four decimal places).

| x | −0.1 | −0.01 | −0.001 | 0.001 | 0.01 | 0.1 |
|---|---|---|---|---|---|---|
| (2ˣ − 1)/x | 0.6697 | 0.6908 | 0.6929 | 0.6934 | 0.6956 | 0.7177 |

From the left the outputs climb toward a number just above 0.6929; from the right they fall toward a number just below 0.6934. The limit appears to be about 0.693. (It is exactly ln 2 ≈ 0.69315, which you will be able to show in Unit 2.)

**A caution.** A table is evidence, not proof. The function sin(π/x) equals 0 at x = 1, 1/2, 1/3, 1/4, … so a table using only those inputs would suggest a limit of 0 at x = 0, yet the graph oscillates between −1 and 1 and the limit does not exist. Choose inputs that are not suspiciously special, and confirm with algebra (next week) whenever you can.

**Tables that disagree.** If the left-hand outputs approach 4 and the right-hand outputs approach −1, the one-sided limits appear to be 4 and −1 and the two-sided limit does not exist. Never average them.

## Common mistakes

- **Using f(c) as the limit.** The limit is where f is heading; f(c) is where it is. They agree only for continuous functions (week 4).
- **Saying a hole kills the limit.** A missing point does not stop the curve from heading to a height.
- **Averaging one-sided limits.** Different one-sided limits mean "does not exist".
- **Writing "= ∞" and calling it a value.** lim = ∞ means the limit does not exist because the outputs are unbounded.
- **Reading the far end of a table.** Use the inputs closest to c, from both sides.
- **Dropping the limit symbol.** Keep "lim (x→c)" on every line until the limit has been evaluated.
- **Swapping input and output.** In lim (x→4) g(x) = −2, 4 is the input target and −2 is the output target.

## Where this goes next

Week 2 replaces tables with algebra: limit properties, factoring, rationalising and the special trigonometric limit lim (x→0) (sin x)/x = 1. Week 3 adds the squeeze theorem and classifies discontinuities, and week 4 defines continuity as "the limit equals the value".

## Self-check

1. Average velocities of a hypothetical runner over [5, 5 + Δt] are 6.3, 6.03 and 6.003 m/s for Δt = 0.1, 0.01 and 0.001. Estimate the velocity at t = 5 and write the limit it approximates.
2. f has lim (x→−1⁻) f(x) = 2, lim (x→−1⁺) f(x) = 2 and f(−1) undefined. Does lim (x→−1) f(x) exist? What is it?
3. Let k(x) = 3 − x for x < 0 and k(x) = x² + 3 for x ≥ 0. Find lim (x→0) k(x).
4. A graph has an open circle at (2, 5) on a smooth curve and a solid dot at (2, −3). State lim (x→2) of the function and its value at 2.
5. Make a table of (1 − cos x)/x² for x = ±0.1, ±0.01 and estimate the limit at 0.

*Answers:* 1. About 6 m/s; lim (Δt→0) (s(5 + Δt) − s(5))/Δt. 2. Yes; it is 2. 3. Both sides give 3, so the limit is 3. 4. Limit 5, value −3. 5. 0.49958 at ±0.1 and 0.50000 at ±0.01: the limit appears to be 1/2.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 1, Topics 1.1–1.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
