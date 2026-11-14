# Week 13 · The Derivative in Context and Straight-Line Motion

**Topics:** 4.1 Interpreting the Meaning of the Derivative in Context · 4.2 Straight-Line Motion: Connecting Position, Velocity, and Acceleration
**Practices:** 4 (Communication and Notation), 2 (Connecting Representations), 3 (Justification), 1 (Implementing Mathematical Processes)
**Framework:** AP Calculus AB and BC CED, Unit 4, Topics 4.1–4.2, learning objectives in our own words
**Spiral:** Week 6 defined the derivative as an instantaneous rate of change and contrasted it with the average rate of change; weeks 8 to 12 gave you every rule needed to compute derivatives, including the chain rule and second derivatives. This week those rules stop being symbol-pushing: every derivative now measures something, and you will be asked to say what, in words, with units.

## What you need to be able to do

- **4.1** State the units of f′(x) and f″(x) from the units of f and x.
- **4.1** Write a complete interpretation of a derivative value in context: the time or input, the quantity, whether it is increasing or decreasing, the rate and its units.
- **4.1** Tell apart an instantaneous rate f′(a), an average rate (f(b) − f(a))/(b − a) and a total change f(b) − f(a).
- **4.1** Interpret a second derivative in context as the rate at which a rate is changing.
- **4.2** Find velocity and acceleration from position by differentiation, and speed as the absolute value of velocity.
- **4.2** Decide when a particle is at rest, moving right or left, changing direction, speeding up or slowing down, and justify each with signs of v and a.
- **4.2** Compute displacement and total distance from a position function, splitting the interval where the particle turns around.

## Key terms

| Term | Meaning |
|---|---|
| Rate of change in context | f′(a): how fast the quantity f is changing at the input a, in output units per input unit. |
| Average rate of change | (f(b) − f(a))/(b − a): the rate over a whole interval. |
| Position x(t) | Where a particle is on a line at time t, relative to a chosen origin. |
| Velocity v(t) | x′(t): rate of change of position; its sign gives the direction of motion. |
| Acceleration a(t) | v′(t) = x″(t): rate of change of velocity. |
| Speed | \|v(t)\|: how fast, regardless of direction. |
| At rest | v(t) = 0. |
| Displacement | x(b) − x(a): net change in position. |
| Total distance | The sum of the lengths of every leg of the trip, counting back-and-forth. |

## Interpreting the derivative in context (4.1)

The derivative f′(a) is the limit of average rates of change over shrinking intervals around a. In a context, that makes it the **instantaneous rate** at which the quantity is changing at that moment (or at that input). Its **units** are always the output units divided by the input units: if V is in litres and t in minutes, V′(t) is in litres per minute. The second derivative is a rate of a rate, so its units carry the input unit twice: litres per minute per minute.

An interpretation sentence that earns AP credit has five ingredients:

1. **When:** "at time t = 5 minutes" (or "when 40 kilograms have been produced").
2. **What:** the quantity, by name: "the temperature of the tea".
3. **Direction:** "is increasing" or "is decreasing", carried by the sign.
4. **How fast:** the size of the derivative.
5. **Units:** "degrees Celsius per minute".

Never write "is increasing at a rate of −2.4". The word *decreasing* already holds the sign, so give the size.

**Worked example (a cooling cup of tea).** A hypothetical cup of tea has temperature T(t) degrees Celsius, t minutes after it is poured. T(0) = 85, T(5) = 70, T(10) = 62, T′(5) = −2.4 and T″(5) = 0.3.

- T′(5) = −2.4: *At time t = 5 minutes, the temperature of the tea is decreasing at a rate of 2.4 °C per minute.*
- T″(5) = 0.3: *At t = 5 minutes, the rate of change of the temperature is increasing at 0.3 °C per minute per minute.* Because T′ is negative and increasing, the tea is cooling, but more slowly: the rate is moving toward 0.
- The average rate on [0, 10] is (62 − 85)/10 = −2.3 °C per minute. This describes the whole ten minutes; it is not the rate at any particular instant, even though it happens to be close to T′(5).
- T(10) − T(0) = −23 °C is a total change. It has plain units, not "per minute".

Three different things, three different kinds of sentence. Questions often hand you all three and ask which one a statement describes.

**The marginal idea.** In economics-style contexts f′(a) estimates the change in f when the input rises by one unit from a. That works because, over a short step, the curve and its tangent line nearly agree (week 16 makes this precise as linearisation).

**Worked example (a bakery's cost).** A hypothetical bakery's cost to produce x kilograms of bread in a day is C(x) = 150 + 6x − 0.03x² dollars, for 0 ≤ x ≤ 80.

C′(x) = 6 − 0.06x, so C′(40) = 6 − 2.4 = 3.6 dollars per kilogram. *When 40 kg are being produced, cost is increasing at $3.60 per kilogram*, so the 41st kilogram costs about $3.60 extra. The exact extra cost is C(41) − C(40) = 6 − 0.03(41² − 40²) = 6 − 2.43 = $3.57, very close. C″(x) = −0.06 dollars per kilogram per kilogram: each extra kilogram costs a little less than the one before.

**Second derivatives without the motion.** If N(t) is a number of app downloads and N′(3) > 0 while N″(3) < 0, downloads are still rising at day 3, but the rate of rise is falling. The sign of N″ says nothing by itself about whether N is rising; it only describes N′.

## Straight-line motion (4.2)

A particle moving on a line has position x(t). Differentiate once for velocity and again for acceleration:

v(t) = x′(t),  a(t) = v′(t) = x″(t).

If x is in metres and t in seconds, v is in m/s and a in m/s². **Speed** is |v(t)|.

The signs answer the standard questions:

| Question | Look at | Condition |
|---|---|---|
| At rest? | v | v(t) = 0 |
| Moving right (positive direction)? | v | v(t) > 0 |
| Moving left? | v | v(t) < 0 |
| Changes direction at t = c? | v | v changes sign at c |
| Speeding up? | v and a | same sign |
| Slowing down? | v and a | opposite signs |

The last two rows are where most errors live. A negative acceleration does **not** mean slowing down. If the particle is already moving left (v < 0) and a < 0, the velocity becomes more negative and the particle moves left faster: it is speeding up. Always compare both signs.

Also note that v(c) = 0 is not enough for a change in direction. For v(t) = (t − 2)², the particle stops at t = 2 but moves right before and after.

**Worked example (a full motion analysis).** A particle has position x(t) = t³ − 6t² + 9t + 1 metres for 0 ≤ t ≤ 4 seconds.

*Velocity and acceleration.* v(t) = 3t² − 12t + 9 = 3(t − 1)(t − 3) and a(t) = 6t − 12 = 6(t − 2).

*At rest.* v(t) = 0 at t = 1 and t = 3.

*Direction.* A sign chart for v:

| Interval | (0, 1) | (1, 3) | (3, 4) |
|---|---|---|---|
| sign of v | + | − | + |
| motion | right | left | right |

v changes sign at t = 1 and at t = 3, so the particle changes direction at both.

*Speeding up or slowing down.* a changes sign at t = 2. Combine:

| Interval | (0, 1) | (1, 2) | (2, 3) | (3, 4) |
|---|---|---|---|---|
| v | + | − | − | + |
| a | − | − | + | + |
| speed | slowing | speeding up | slowing | speeding up |

*Displacement and distance.* x(0) = 1, x(1) = 5, x(3) = 1, x(4) = 5. Displacement on [0, 4] is x(4) − x(0) = 4 metres. Total distance adds each leg: |5 − 1| + |1 − 5| + |5 − 1| = 4 + 4 + 4 = 12 metres. The two numbers differ because the particle went back over ground it had already covered.

*Extreme positions.* The particle is farthest right where x is largest. Candidates are the endpoints and the times where v changes from positive to negative: x(0) = 1, x(1) = 5, x(4) = 5. The largest position is 5 metres, reached at t = 1 and again at t = 4.

**Worked example (acceleration from a table).** A hypothetical cyclist on a straight path has these velocities.

| t (seconds) | 0 | 4 | 6 | 10 |
|---|---|---|---|---|
| v(t) (m/s) | 4 | 6 | 9 | 7 |

To estimate a(5), use the listed times that straddle 5: a(5) ≈ (v(6) − v(4))/(6 − 4) = (9 − 6)/2 = 1.5 m/s². *At t = 5 seconds the cyclist's velocity is increasing at about 1.5 metres per second per second.* For a(8), use [6, 10]: (7 − 9)/4 = −0.5 m/s². With v positive and a negative, the cyclist is slowing down around t = 8. Use only the two closest values: an average over [0, 10] would blur together the speeding up and the slowing down.

**Motion and graphs.** On a graph of v against t: the particle is moving right where the graph is above the axis, changes direction where the graph crosses the axis, and has zero acceleration where the graph has a horizontal tangent. Speed is increasing where the graph moves away from the t-axis, and decreasing where it moves toward it. That picture is a quick check on any sign chart.

## Common mistakes

- **Leaving off units, or giving the wrong ones.** A rate needs "per": m/s, not m. A second derivative needs the input unit twice.
- **Reading f′(a) as a total change.** "V′(10) = −3.5" is a rate at an instant, not "3.5 litres were lost".
- **Writing "increasing at a rate of −2.4".** Say "decreasing at 2.4 …".
- **Deciding speeding up from a alone.** Compare the signs of v and a.
- **Calling every zero of v a change of direction.** v must change sign.
- **Computing total distance as x(b) − x(a).** That is displacement. Split at every turning time and add absolute values.
- **Using x(t) to decide direction.** A particle can be on the negative side of the origin and still be moving right.

## Self-check

1. W(t) is the amount of water in a reservoir, in millions of litres, t days after 1 June. Interpret W′(12) = −0.8.
2. What are the units of W″(t) in question 1?
3. A particle has v(t) = t² − 5t + 4 ft/s for 0 ≤ t ≤ 5. When does it change direction, and on which intervals is it speeding up?
4. For x(t) = t³ − 3t² metres on 0 ≤ t ≤ 3, find the displacement and the total distance.
5. True or false: if a(t) > 0, the particle is speeding up. Explain.

*Answers:* 1. On 13 June (t = 12 days), the amount of water in the reservoir is decreasing at 0.8 million litres per day. 2. Millions of litres per day per day. 3. v = (t − 1)(t − 4), changing sign at t = 1 and t = 4; a = 2t − 5. Speeding up where v and a share a sign: 1 < t < 2.5 and 4 < t < 5. 4. x(0) = 0, x(2) = −4, x(3) = 0: displacement 0 m, distance 4 + 4 = 8 m. 5. False: if v < 0 at the same time, the particle is slowing down.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 4, Topics 4.1–4.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
