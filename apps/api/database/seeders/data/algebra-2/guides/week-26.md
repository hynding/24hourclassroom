# Week 26 · The Graphs of Sine, Cosine and Tangent

**Lessons:** 6.9 Introduction to Trigonometric Functions · 6.10 Beyond 2π · 6.11 Extending the Domain of Trigonometric Functions · 6.12 Tangent
**Practices:** MP7 (look for structure), MP8 (express regularity in repeated reasoning), MP6 (attend to precision)
**Built from:** IM Algebra 2, Unit 6, Lessons 9–12, in our own words
**Spiral:** The rising and falling of a circling point (week 25) is what the graph of sine records. Even and odd symmetry (week 22) names the symmetry of cosine and sine. Vertical asymptotes and end behavior of rational functions (week 8) are the language for the tangent graph, and the unit-circle values (week 24) supply every exact point.

## What you need to be able to do

- **6.9** Define y = cos θ and y = sin θ as functions of the angle, sketch their graphs on [0, 2π] from the unit circle, and read values, zeros, maximums and minimums off those graphs.
- **6.10** Explain why angles larger than 2π give the same point as an angle in [0, 2π), find that angle, and use it to evaluate sine and cosine of any positive angle.
- **6.11** Extend both functions to negative angles, state their domain, range and period, and use cos(−θ) = cos θ and sin(−θ) = −sin θ.
- **6.12** Define tan θ = sin θ / cos θ as the slope of the ray at angle θ, evaluate it at the labelled angles, locate its vertical asymptotes, and describe its graph and period of π.

## Key terms

| Term | Meaning |
|---|---|
| Trigonometric function | A function whose input is an angle: cosine, sine and tangent. |
| Periodic function | A function whose outputs repeat at a fixed interval: f(θ + p) = f(θ) for every θ. The smallest such p > 0 is the period. |
| Period | 2π for sine and cosine (one trip around the circle); π for tangent. |
| Coterminal angles | Angles whose rays coincide: θ and θ + 2πk for any integer k. They have the same sine and cosine. |
| Negative angle | Measured clockwise from the positive x-axis: −π/2 is the bottom of the circle. |
| Vertical asymptote | A line x = a that the graph approaches without crossing, where the function is undefined; tan θ has one at every odd multiple of π/2. |

## From the circle to a graph (6.9)

Last week the height of a circling point rose and fell. Now plot that height against the angle: the horizontal axis is θ (in radians), the vertical axis is y = sin θ. The result is a wave.

**Graph description of y = sin θ on [0, 2π]:** starts at (0, 0), rises to a maximum of 1 at θ = π/2, falls back through (π, 0) to a minimum of −1 at θ = 3π/2, and returns to 0 at θ = 2π. It is steepest where it crosses the axis and flat at the peaks.

**Graph description of y = cos θ on [0, 2π]:** starts at its maximum (0, 1), falls through (π/2, 0) to a minimum of −1 at θ = π, rises back through (3π/2, 0) to (2π, 1). It is the sine wave moved a quarter turn (π/2) to the left.

Every exact point comes from the unit circle. The table is the one from week 24 read as a function table:

| θ | 0 | π/6 | π/4 | π/3 | π/2 | 2π/3 | 3π/4 | 5π/6 | π | 7π/6 | 5π/4 | 4π/3 | 3π/2 | 5π/3 | 7π/4 | 11π/6 | 2π |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| sin θ | 0 | 1/2 | √2/2 | √3/2 | 1 | √3/2 | √2/2 | 1/2 | 0 | −1/2 | −√2/2 | −√3/2 | −1 | −√3/2 | −√2/2 | −1/2 | 0 |
| cos θ | 1 | √3/2 | √2/2 | 1/2 | 0 | −1/2 | −√2/2 | −√3/2 | −1 | −√3/2 | −√2/2 | −1/2 | 0 | 1/2 | √2/2 | √3/2 | 1 |

**Worked example.** Read from the graph of y = sin θ on [0, 2π]: where is sin θ = 1/2?

The horizontal line y = 1/2 meets the rising part of the wave at θ = π/6 and the falling part at θ = 5π/6. Two solutions, symmetric about the peak at π/2: π/2 − π/3 and π/2 + π/3.

**Worked example.** On what intervals of [0, 2π] is cos θ negative?

Where the graph is below the axis: between its zeros π/2 and 3π/2. That matches the circle: quadrants II and III have x < 0.

**Try it.**
1. Give all θ in [0, 2π] with cos θ = −√3/2.
2. Where on [0, 2π] is sin θ increasing and negative at the same time?

*Answers:* 1. 5π/6 and 7π/6. 2. (3π/2, 2π): below the axis and climbing back toward 0.

## Beyond 2π (6.10)

Turning through 2π brings the point back where it started, so the angle 13π/6 lands on the same point as 13π/6 − 2π = π/6. In general **θ and θ + 2πk (k any integer) give the same point**, hence the same sine and cosine. That is what makes the graphs repeat: the wave on [0, 2π] is copied on [2π, 4π], [4π, 6π] and so on. Sine and cosine are **periodic with period 2π**.

To evaluate at a large angle, subtract multiples of 2π until the angle is in [0, 2π):

**Worked example.** Find sin(17π/4) and cos(10π/3).

17π/4 − 2π = 17π/4 − 8π/4 = 9π/4, still more than 2π; subtract again: 9π/4 − 8π/4 = π/4. So sin(17π/4) = sin(π/4) = √2/2.

10π/3 − 2π = 10π/3 − 6π/3 = 4π/3, which is in quadrant III with reference angle π/3. cos(10π/3) = cos(4π/3) = −1/2.

**Worked example.** A wheel turns 4.5 times. Through what angle has a point on it travelled, and where does it end up relative to its start?

4.5 · 2π = 9π. Four full turns are 8π, leaving π: the point is directly opposite its start.

**Worked example.** List three angles, besides π/3, whose sine is √3/2.

π/3 + 2π = 7π/3 and π/3 + 4π = 13π/3 are coterminal with π/3. The other point with height √3/2 is at 2π/3, so 2π/3 is a third. (And 2π/3 + 2π = 8π/3, and so on: infinitely many.)

**Try it.**
1. Find cos(25π/6).
2. Find the angle in [0, 2π) coterminal with 31π/4.

*Answers:* 1. 25π/6 − 4π = π/6, so √3/2. 2. 31π/4 − 6π = 31π/4 − 24π/4 = 7π/4.

## Negative angles and the whole real line (6.11)

A negative angle means turning clockwise. The point at −π/6 is the reflection of the point at π/6 across the x-axis: (√3/2, −1/2). Since reflecting across the x-axis keeps x and flips y:

- **cos(−θ) = cos θ** (cosine is an **even** function; its graph is symmetric about the vertical axis), and
- **sin(−θ) = −sin θ** (sine is an **odd** function; its graph has half-turn symmetry about the origin).

These are the symmetry types of week 22 showing up again. With negative angles and angles past 2π both allowed, the domain of sine and cosine is **all real numbers**, the range is **[−1, 1]**, and the graphs are endless waves in both directions with period 2π.

**Worked example.** Evaluate sin(−5π/6), cos(−5π/6) and cos(−7π/3).

sin(−5π/6) = −sin(5π/6) = −1/2. cos(−5π/6) = cos(5π/6) = −√3/2. For the last one, cos(−7π/3) = cos(7π/3) = cos(7π/3 − 2π) = cos(π/3) = 1/2. (Alternatively, −7π/3 + 4π = 5π/3, and cos(5π/3) = 1/2.)

**Worked example.** Find all solutions of cos θ = 0.

cos θ is 0 at π/2 and 3π/2 in [0, 2π), and the pattern repeats every 2π. The zeros are π/2 + πk for every integer k (they are spaced π apart): …, −3π/2, −π/2, π/2, 3π/2, 5π/2, …

**Try it.**
1. Find sin(−3π/2).
2. Describe all θ with sin θ = 1.

*Answers:* 1. −sin(3π/2) = −(−1) = 1 (the point at −3π/2 is the top of the circle). 2. θ = π/2 + 2πk for any integer k.

## Tangent (6.12)

The ray at angle θ passes through the origin and (cos θ, sin θ), so its slope is sin θ / cos θ. That slope is the **tangent**: **tan θ = sin θ / cos θ**. It is the ratio of the two coordinates and does not depend on the radius, which is why it matches the right-triangle tangent (opposite over adjacent).

| θ | 0 | π/6 | π/4 | π/3 | π/2 | 2π/3 | 3π/4 | 5π/6 | π |
|---|---|---|---|---|---|---|---|---|---|
| tan θ | 0 | √3/3 | 1 | √3 | undefined | −√3 | −1 | −√3/3 | 0 |

Three features follow from the definition:

1. **Undefined where cos θ = 0.** At π/2, 3π/2, −π/2, … the ray is vertical and has no slope. The graph has a vertical asymptote at every odd multiple of π/2.
2. **Period π.** Going half a turn flips both coordinates: cos(θ + π) = −cos θ and sin(θ + π) = −sin θ, so the ratio is unchanged. The ray at θ + π is the same line as the ray at θ, so the slope is the same.
3. **Odd.** tan(−θ) = −sin θ / cos θ = −tan θ.

**Graph description of y = tan θ on (−π/2, π/2):** comes up from very large negative values just right of the asymptote θ = −π/2, passes through (−π/4, −1), (0, 0) and (π/4, 1), increasing the whole way, and shoots up toward very large positive values just left of θ = π/2. That one branch repeats every π. The range is all real numbers; there is no maximum or minimum.

**Worked example.** Find tan(7π/6), tan(−π/3) and tan(5π/2).

7π/6 is in quadrant III with reference angle π/6; sin and cos are both negative, so tan(7π/6) = (−1/2)/(−√3/2) = 1/√3 = √3/3. (Or: tan(7π/6) = tan(7π/6 − π) = tan(π/6).) tan(−π/3) = −tan(π/3) = −√3. 5π/2 = π/2 + 2π, where cos is 0: undefined.

**Worked example.** Where on [0, 2π] is tan θ positive?

Where sin and cos have the same sign: quadrants I and III, that is (0, π/2) and (π, 3π/2).

**Worked example.** The point at angle θ on a circle of radius 8 is (−4√3, −4). Find tan θ without finding θ.

tan θ = y/x = (−4)/(−4√3) = 1/√3 = √3/3. (The angle is 7π/6, consistent with the table.)

**Try it.**
1. Find tan(3π/4) and tan(11π/6).
2. Give all solutions of tan θ = 1.

*Answers:* 1. −1 and −√3/3. 2. θ = π/4 + πk for any integer k, since tangent has period π.

## Common mistakes

- **Reading sin θ as the x-coordinate.** Sine is the height (y); cosine is the horizontal coordinate (x).
- **Subtracting 2π once and stopping.** 17π/4 needs two subtractions to land in [0, 2π). Keep going until the angle is between 0 and 2π.
- **Treating sine as even.** sin(−θ) = −sin θ. Only cosine keeps its value under θ → −θ.
- **Saying tan θ has period 2π.** Its period is π: the ray at θ + π is the same line.
- **Giving tan(π/2) = 0 or 1.** It is undefined; the ray is vertical.
- **Forgetting the range.** sin θ = 1.2 has no solution; tan θ = 1.2 has infinitely many.

## Where this goes next

Next week the three transformation ideas from Unit 5, vertical stretch, vertical shift and horizontal shift, are applied to sine and cosine: amplitude, midline and phase. The week after, horizontal scaling changes the period and the whole package models wheels, tides and daylight.

## Self-check

1. Sketch y = cos θ on [0, 2π] in words: its starting value, zeros, minimum and ending value.
2. Find sin(19π/6) and cos(−11π/4).
3. Give all solutions of sin θ = −1/2.
4. Explain, using the unit circle, why tan θ is undefined at θ = 3π/2 and why tan(θ + π) = tan θ.
5. The graph of y = tan θ on (π/2, 3π/2) passes through which three labelled points, and what are its asymptotes?

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 6, Lessons 9–12, https://im.kendallhunt.com/HS/teachers/3/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
