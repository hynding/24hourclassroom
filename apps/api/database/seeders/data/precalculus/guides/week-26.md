# Week 26 · Rates of Change in Polar Functions

**Topics:** 3.15 Rates of Change in Polar Functions
**Practices:** 2 (multiple representations), 3 (communication and reasoning), 1 (procedural and symbolic fluency)
**Framework:** AP Precalculus CED, Unit 3, Topic 3.15, learning objectives in our own words
**Spiral:** This week applies week 1's rate-of-change ideas (increasing and decreasing, average rate of change as the slope of a secant, estimating a rate at a point from nearby average rates) to the polar functions of week 25. Week 23's equation solving finds where r = 0, and week 20's graphs of sine and cosine tell you where r increases and decreases.

## What you need to be able to do

- **3.15** Decide from a formula, a table or a θ–r graph whether r is increasing or decreasing on an interval of θ.
- **3.15** Decide whether the distance between a point on a polar curve and the pole is increasing or decreasing, using both the sign of r and the direction of change of r.
- **3.15** Identify where a polar curve is farthest from or closest to the pole, using the extreme values of r and of |r|.
- **3.15** Compute the average rate of change of r with respect to θ over an interval, give its units, and interpret it in terms of the polar curve.
- **3.15** Estimate the rate of change of r at a particular θ using average rates of change over small intervals, from a formula or a table.

## Key terms

| Term | Meaning |
|---|---|
| Polar function | r = f(θ): for each angle θ, a directed distance r. |
| Distance from the pole | |r|, the absolute value of r, whatever the sign of r. |
| Increasing r | Larger θ gives larger r (more positive or less negative). |
| Average rate of change of r | (f(θ₂) − f(θ₁))/(θ₂ − θ₁): the change in r per radian of change in θ, the slope of a secant on the θ–r graph. |
| Relative maximum distance | A point of the curve farther from the pole than nearby points; it happens where |r| has a relative maximum. |

## r versus distance: the four cases (3.15)

The value r is a *directed* distance. The actual distance between the point (r, θ) and the pole is |r|. So "r is increasing" and "the point is moving away from the pole" are not the same statement. There are four cases:

| Sign of r | r is ... | Distance |r| is ... | The point is moving ... |
|---|---|---|---|
| positive | increasing | increasing | away from the pole |
| positive | decreasing | decreasing | toward the pole |
| negative | increasing (toward 0) | decreasing | toward the pole |
| negative | decreasing (more negative) | increasing | away from the pole |

A short rule: **the distance is increasing when r and its change have the same sign, and decreasing when they have opposite signs.**

**Worked example.** For r = 3 + 2 sin θ, describe the distance from the pole on (0, π/2) and on (π/2, π).

r is always positive here (it never drops below 3 − 2 = 1). On (0, π/2), sin θ increases, so r increases from 3 to 5: the point moves away from the pole. On (π/2, π), sin θ decreases, so r decreases from 5 to 3: the point moves toward the pole. The farthest point from the pole is at θ = π/2, distance 5.

**Worked example.** For r = 1 + 2 cos θ, describe the distance from the pole on (2π/3, π) and on (π, 4π/3).

On (2π/3, π): cos θ decreases from −1/2 to −1, so r decreases from 0 to −1. r is negative and decreasing, so the distance |r| increases from 0 to 1: the point moves away from the pole (this is the first half of the inner loop, in quadrant IV).

On (π, 4π/3): cos θ increases from −1 to −1/2, so r increases from −1 to 0. r is negative and increasing, so the distance decreases back to 0: the point returns to the pole.

**Try it.**
1. For r = 4 cos θ, is the point moving toward or away from the pole on (0, π/2)? On (π/2, π)?
2. If r < 0 and r is decreasing on an interval, what is happening to the distance from the pole?

*Answers:* 1. On (0, π/2), r is positive and decreasing: toward the pole. On (π/2, π), r is negative and decreasing (from 0 to −4): away from the pole. 2. It is increasing.

## Reading the θ–r graph (3.15)

The graph of r = f(θ) on rectangular axes, with θ across and r up, is the best tool for rate questions:

- **Rising graph:** r increasing. **Falling graph:** r decreasing.
- **Above the axis:** r positive. **Below the axis:** r negative.
- **Distance from the pole:** the height of the graph from the θ-axis, |r|. The point is moving away from the pole exactly when the θ–r graph is moving away from the θ-axis.
- **Crossing the θ-axis:** the curve passes through the pole.

So the farthest points of a polar curve correspond to the highest peaks *and* the deepest troughs of the θ–r graph, and the pole is reached wherever the θ–r graph touches the axis.

**Worked example.** Where is the curve r = −1 + 3 cos θ farthest from the pole?

On [0, 2π), r ranges from −1 + 3 = 2 (at θ = 0) to −1 − 3 = −4 (at θ = π). The largest value of |r| is 4, at θ = π, where r = −4. That point is 4 units from the pole in the direction π + π = 2π, so it is the rectangular point (4, 0). The point at θ = 0, (2, 0), is only 2 units away. The maximum of r is not the maximum distance here: the minimum of r is.

**Worked example.** For r = 3 sin(2θ) on [0, π/2], describe the motion relative to the pole.

On (0, π/4), 2θ runs over (0, π/2), so r rises from 0 to 3: moving away. On (π/4, π/2), r falls from 3 to 0: moving toward the pole. This is one full petal, traced out from the pole and back, with its tip (distance 3) at θ = π/4.

## Average rate of change of r (3.15)

Exactly as in week 1, the average rate of change of r = f(θ) over [θ₁, θ₂] is

**(f(θ₂) − f(θ₁)) / (θ₂ − θ₁).**

Its units are units of r per radian. It is the slope of the secant line on the θ–r graph. On the polar curve, it tells you how much r changes, on average, for each radian the angle turns.

**Worked example.** Find the average rate of change of r = 3 + 2 sin θ over [0, π/2] and interpret it.

f(0) = 3, f(π/2) = 5. (5 − 3)/(π/2 − 0) = 2/(π/2) = 4/π ≈ 1.27. As θ increases from 0 to π/2, r increases on average by about 1.27 units per radian; since r is positive, the curve moves away from the pole at that average rate.

**Worked example.** Find the average rate of change of r = 1 + 2 cos θ over [2π/3, π] and interpret it.

f(2π/3) = 0 and f(π) = −1. (−1 − 0)/(π − 2π/3) = −1/(π/3) = −3/π ≈ −0.95. The rate is negative, so r is decreasing on average; but r is negative on this interval, so the distance from the pole is *increasing* on average, by about 0.95 units per radian.

**Interpreting a sign.** A negative average rate of change of r does not by itself mean the point is approaching the pole. Combine it with the sign of r, using the four-case rule.

**A modelling example.** A garden sprinkler (hypothetical) waters a region whose edge, in metres, is r = 4 + 2 cos θ, measured from the sprinkler head. Over [0, π/2] the average rate of change is (4 − 6)/(π/2) = −4/π ≈ −1.27 metres per radian: as the spray direction turns from θ = 0 to θ = π/2, its reach shrinks by about 1.27 metres per radian on average. Since r stays positive (between 2 and 6), the edge of the watered region is getting closer to the sprinkler.

## Estimating the rate at a single angle (3.15)

The rate of change of r at one value of θ is estimated, as in week 1, from average rates over small intervals around it. The most reliable simple estimate uses an interval centred on the angle.

**Worked example.** Estimate the rate of change of r = 3 + 2 sin θ at θ = π/6, using θ = π/6 ± 0.01.

f(π/6 + 0.01) ≈ 3 + 2 sin(0.53360) ≈ 4.01727 and f(π/6 − 0.01) ≈ 3 + 2 sin(0.51360) ≈ 3.98263. Average rate ≈ (4.01727 − 3.98263)/0.02 ≈ 1.73 units per radian. (Smaller intervals settle near the same value, 1.732.)

**Worked example (table).** A hypothetical polar function g has these values. Estimate the rate of change of r at θ = π/2.

| θ | π/3 | π/2 | 2π/3 |
|---|---|---|---|
| r = g(θ) | 2.6 | 3.4 | 3.7 |

Use the two neighbours: (3.7 − 2.6)/(2π/3 − π/3) = 1.1/(π/3) = 3.3/π ≈ 1.05 units per radian. Since r is positive and increasing near π/2, the curve is moving away from the pole there.

**Try it.**
1. Find the average rate of change of r = 2θ + 1 over [0, π].
2. Find the average rate of change of r = 5 sin(2θ) over [0, π/4].
3. For r = 2 − 4 cos θ, is the distance from the pole increasing or decreasing on (0, π/3)?

*Answers:* 1. ((2π + 1) − 1)/π = 2. 2. (5 − 0)/(π/4) = 20/π ≈ 6.37. 3. r runs from −2 to 0, negative and increasing: the distance is decreasing (the point approaches the pole).

## Calculator notes

- Graph r = f(θ) twice: once in polar mode (the curve) and once in function mode with x playing the role of θ (the θ–r graph). The second graph answers increasing/decreasing questions at a glance.
- For an average rate of change, evaluate f at the two endpoints on the home screen; keep radian mode.
- For an estimate at a point, use a small symmetric interval such as θ ± 0.001; many calculators also have a numerical derivative feature, which gives the same idea in one step.

## Common mistakes

- **Treating "r is increasing" as "moving away from the pole".** It is true only when r is positive.
- **Taking the maximum of r as the maximum distance.** Check the minimum of r too: |r| decides distance.
- **Dividing by degrees.** The rate is per radian; θ₂ − θ₁ is measured in radians.
- **Reversing the subtraction.** Use (f(θ₂) − f(θ₁))/(θ₂ − θ₁), later value minus earlier value on top and bottom.
- **Forgetting units and meaning.** On the AP exam, "interpret" means a sentence with the quantity, the interval and the units.

## Where this goes next

This completes Unit 3. The unit summary pulls together periodic functions, equations, identities and polar curves, and the unit exam tests all of 3.1 to 3.15. Unit 4 opens with parametric functions (week 27), where the rate of change of each coordinate with respect to a parameter t extends this week's rate of change of r with respect to θ.

## Self-check

1. For r = 2 + 3 sin θ, on which intervals of [0, 2π) is r decreasing? On which is the distance from the pole decreasing?
2. Where is r = −2 + 5 sin θ farthest from the pole, and how far is that point?
3. Find and interpret the average rate of change of r = 4 + 2 cos θ over [π/2, π].
4. Explain why a negative average rate of change of r can go with a point that is moving away from the pole.
5. Estimate the rate of change of r = θ sin θ at θ = π/2 using θ = π/2 ± 0.01.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 3, Topic 3.15). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
