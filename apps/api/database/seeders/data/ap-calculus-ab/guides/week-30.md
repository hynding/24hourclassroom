# Week 30 · Average Value, Motion and Accumulation in Context

**Topics:** 8.1 Finding the Average Value of a Function on an Interval · 8.2 Connecting Position, Velocity, and Acceleration of Functions Using Integrals · 8.3 Using Accumulation Functions and Definite Integrals in Applied Contexts
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 8, Topics 8.1–8.3, learning objectives in our own words
**Spiral:** Unit 6 gave you the definite integral as accumulated change, Riemann and trapezoidal sums, and the Fundamental Theorem (∫ from a to b of f′(x) dx = f(b) − f(a)). Unit 4 gave you position, velocity and acceleration as derivatives of one another, and the rule that speed increases when velocity and acceleration share a sign. Unit 5's candidates test returns this week for "when is the amount greatest?". This week turns those tools into the three most common integral questions on the AP exam.

## What you need to be able to do

- **8.1** Compute the average value of a continuous function on [a, b] as (1/(b − a)) ∫ from a to b of f(x) dx, and interpret it with units.
- **8.1** Use the Mean Value Theorem for integrals: a continuous f actually attains its average value at some c in [a, b].
- **8.2** Find displacement as ∫ v(t) dt and total distance as ∫ |v(t)| dt, splitting at sign changes of v.
- **8.2** Find position from velocity, and velocity from acceleration, using an initial condition: x(t) = x(a) + ∫ from a to t of v(s) ds.
- **8.3** Find an amount at a given time from its rate of change and an initial amount, including rate-in/rate-out problems.
- **8.3** Interpret a definite integral of a rate, or an average of a rate, in a complete sentence with units and the time interval.

## Key terms

| Term | Meaning |
|---|---|
| Average value of f on [a, b] | (1/(b − a)) ∫ from a to b of f(x) dx; the height of the rectangle on [a, b] with the same signed area as f. |
| Mean Value Theorem for integrals | If f is continuous on [a, b], then f(c) equals the average value for some c in [a, b]. |
| Displacement | Change in position, ∫ from a to b of v(t) dt. Can be negative. |
| Total distance | ∫ from a to b of |v(t)| dt. Never negative. |
| Speed | |v(t)|. |
| Net change theorem | ∫ from a to b of Q′(t) dt = Q(b) − Q(a): integrating a rate gives a change. |
| Rate in / rate out | Two rates affecting one amount; the amount changes at (rate in) − (rate out). |

## Average value of a function (8.1)

Averaging a list of numbers means adding them and dividing by how many there are. A continuous function has infinitely many values, so the integral does the adding and the length of the interval does the dividing:

average value of f on [a, b] = (1/(b − a)) · ∫ from a to b of f(x) dx.

Geometrically, if you level off the region between f and the x-axis into a rectangle with base [a, b], its height is the average value. The units are the units of f: the average value of a temperature function is a temperature.

Keep this separate from the **average rate of change**, (f(b) − f(a))/(b − a), from Unit 2. The average rate of change of f is the average value of f′, because ∫ f′ = f(b) − f(a). A question about "the average velocity" is a question about the average value of v, which is the same as the average rate of change of position.

The **Mean Value Theorem for integrals** says that a continuous function takes its average value at least once. On the AP exam, name the hypothesis: "f is continuous on [a, b], so there is a c in [a, b] with f(c) equal to the average value."

**Worked example.** Find the average value of f(x) = 3√x on [1, 4], and find where f takes that value.

∫ from 1 to 4 of 3x^(1/2) dx = [2x^(3/2)] from 1 to 4 = 2(8) − 2(1) = 14. Divide by 4 − 1 = 3: the average value is 14/3 ≈ 4.67.

Solve 3√c = 14/3: √c = 14/9, so c = 196/81 ≈ 2.42. This lies in [1, 4], as the theorem promises (f is continuous there). Notice that c is not the midpoint 2.5; the theorem guarantees a c exists, not where it is.

**Try it.** Find the average value of x³ on [0, 2]. *(Answer: (1/2)(4) = 2.)*

## Motion along a line with integrals (8.2)

In Unit 4 you differentiated: position x(t), velocity v(t) = x′(t), acceleration a(t) = v′(t). Now go the other way.

- **Displacement** on [a, b] is ∫ from a to b of v(t) dt = x(b) − x(a). Motion to the left (v < 0) counts negatively.
- **Position** at time t needs a starting point: x(t) = x(a) + ∫ from a to t of v(s) ds.
- **Velocity** from acceleration works the same way: v(t) = v(a) + ∫ from a to t of a(s) ds.
- **Total distance** is ∫ from a to b of |v(t)| dt. By hand, find where v changes sign, integrate v on each piece, and add the absolute values. On a calculator, integrate |v| directly.

The units follow the integrand times the variable: metres per second times seconds gives metres.

**Worked example.** A particle moves along the x-axis with v(t) = 3t² − 12t + 9 for 0 ≤ t ≤ 4, and x(0) = −2. Find its position at t = 4 and the total distance travelled.

Factor: v(t) = 3(t − 1)(t − 3). The velocity is positive on (0, 1), negative on (1, 3) and positive on (3, 4). An antiderivative is F(t) = t³ − 6t² + 9t, with F(0) = 0, F(1) = 4, F(3) = 0, F(4) = 4.

Displacement: F(4) − F(0) = 4, so x(4) = −2 + 4 = 2.

Pieces: ∫₀¹ v dt = 4, ∫₁³ v dt = 0 − 4 = −4, ∫₃⁴ v dt = 4 − 0 = 4. Total distance = 4 + 4 + 4 = 12.

The particle moved right 4, left 4, then right 4. The displacement (4) hides two-thirds of the travelling; the distance (12) counts it all.

**Where is it farthest left?** Use the candidates test on x(t): the endpoints and the times v changes sign. x(0) = −2, x(1) = 2, x(3) = −2, x(4) = 2. Farthest left: x = −2, at t = 0 and t = 3.

**Worked example.** A cart has acceleration a(t) = 6t − 4 metres per second per second and velocity v(0) = 1 m/s. Find v(2).

v(2) = v(0) + ∫ from 0 to 2 of (6t − 4) dt = 1 + [3t² − 4t] from 0 to 2 = 1 + (12 − 8) = 5 m/s.

## Accumulation in applied contexts (8.3)

The same idea works for any quantity with a known rate. If Q′(t) is the rate at which Q changes, then

Q(b) = Q(a) + ∫ from a to b of Q′(t) dt.

The integral is the **change** in Q; the initial amount is what turns a change into an amount. Forgetting to add it is the most common lost point in this topic.

When an amount has a **rate in** E(t) and a **rate out** L(t), the amount A satisfies A′(t) = E(t) − L(t), so

A(T) = A(0) + ∫ from 0 to T of (E(t) − L(t)) dt.

- A is **increasing** when E(t) > L(t), decreasing when E(t) < L(t). Compare the rates at that instant.
- A is **greatest** at a time where E − L changes from positive to negative, or at an endpoint. Use the candidates test: evaluate A at each critical point and both endpoints.

**Worked example.** A hypothetical cistern holds 500 litres at t = 0 (hours). Water flows in at a constant 60 L/h and is drawn off at 10t L/h for 0 ≤ t ≤ 10. When does the cistern hold the most water, and how much?

A(t) = 500 + ∫ from 0 to t of (60 − 10s) ds = 500 + 60t − 5t². A′(t) = 60 − 10t is zero at t = 6, positive before and negative after. Candidates: A(0) = 500, A(6) = 500 + 360 − 180 = 680, A(10) = 500 + 600 − 500 = 600. The maximum is 680 litres at t = 6 hours.

### Interpreting integrals in words

AP questions often ask "explain the meaning of ∫ from 2 to 5 of R(t) dt in the context of the problem." A complete answer names three things:

1. **what** accumulates (the quantity, with its units, not the rate's units),
2. the **time interval** in context ("between 10 a.m. and 1 p.m.", "from t = 2 to t = 5 hours"),
3. that it is a **total** or **change**, not an amount at an instant.

An average of a rate, (1/(b − a)) ∫ R(t) dt, is an average rate, in the units of R.

**Worked example (Calculator).** A hypothetical bike-share docking station has 40 bikes at 6 a.m. (t = 0). For 0 ≤ t ≤ 12 hours, bikes are returned at A(t) = 18 + 6 cos(πt/6) bikes per hour and taken out at a constant 20 bikes per hour. Find the number of bikes at t = 12, and the time when the station holds the most bikes.

The number of bikes is B(t) = 40 + ∫ from 0 to t of (A(s) − 20) ds. The cosine runs over one full period on [0, 12], so ∫ from 0 to 12 of 6 cos(πt/6) dt = 0, and B(12) = 40 + 12 · 18 − 12 · 20 = 40 − 24 = 16 bikes.

B′(t) = −2 + 6 cos(πt/6) is zero where cos(πt/6) = 1/3: at t ≈ 2.351 and t ≈ 9.649. B′ changes from positive to negative at t ≈ 2.351 (a candidate for the maximum) and from negative to positive at t ≈ 9.649 (a minimum). The calculator gives B(2.351) ≈ 46.102. Candidates: B(0) = 40, B(2.351) ≈ 46.1, B(12) = 16. The station holds the most bikes, about 46, at t ≈ 2.351 hours (about 8:21 a.m.).

In words: ∫ from 0 to 12 of A(t) dt = 216 is "the total number of bikes returned to the station between 6 a.m. and 6 p.m."; dividing by 12 gives an average return rate of 18 bikes per hour.

## Common mistakes

- **Averaging two endpoint values.** (f(a) + f(b))/2 is not the average value unless f is linear. Integrate and divide by b − a.
- **Dividing by b instead of b − a.** On [1, 3] divide by 2, not 3.
- **Confusing average value with average rate of change.** The average value of f uses ∫ f; the average rate of change uses f(b) − f(a).
- **Reporting displacement as distance.** If v changes sign, |∫ v dt| is smaller than ∫ |v| dt. Always look for sign changes of v first.
- **Splitting at v = 0 without a sign change.** A touching zero (such as v = (t − 2)²) needs no split; but splitting there does no harm.
- **Forgetting the initial condition.** ∫ v dt is a change in position, ∫ R dt a change in amount. Add x(a) or A(0).
- **Mixing rates and amounts.** Adding R(5) litres per minute to 50 litres is adding unlike units. Rates must be integrated before they are added to amounts.
- **Speed from the sign of a alone.** Negative acceleration slows the particle only when velocity is positive.
- **Interpretation without units or interval.** "The integral is the water" earns nothing; "the total gallons of water that entered the tank from t = 0 to t = 12 hours" earns the point.

## Self-check

1. Find the average value of g(x) = 4 − x² on [0, 2], and a value c in [0, 2] where g(c) equals it.
2. A particle has v(t) = t − 2 for 0 ≤ t ≤ 6 and x(0) = 1. Find x(6) and the total distance travelled.
3. Oil leaks from a hypothetical tank at r(t) litres per hour. Write a sentence explaining (1/4) ∫ from 0 to 4 of r(t) dt.
4. A tank's amount satisfies A′(t) = E(t) − L(t). E(3) = 12 and L(3) = 15. Is the amount increasing or decreasing at t = 3?
5. True or false: if ∫ from 0 to 10 of v(t) dt = 0, the particle travelled no distance.

*Answers:* 1. (1/2)(8 − 8/3) = 8/3; 4 − c² = 8/3 gives c = 2/√3 ≈ 1.155. 2. x(6) = 1 + (18 − 12) = 7; distance 2 + 8 = 10. 3. The average rate, in litres per hour, at which oil leaked from the tank over the first 4 hours. 4. Decreasing, because E(3) − L(3) = −3 < 0. 5. False: it returned to its start, but may have travelled any distance.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 8, Topics 8.1–8.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
