# Week 7 · Graphs of Sine and Cosine

**Topics:** 2.1 Periodic Functions and the Graphs of Sine and Cosine · 2.2 Amplitude and Period
**Standards:** HSF-TF.A.2, HSF-TF.A.4, HSF-TF.B.5
**Spiral:** Week 4 made radians the natural input for these functions, and week 6 placed every special angle on the unit circle as the point (cos θ, sin θ). This week turns that circle into two graphs. Week 6's periodicity (adding 2π lands on the same point) and its even/odd rules (cos(−θ) = cos θ, sin(−θ) = −sin θ) now become visible features: repetition and symmetry. Week 5's signs by quadrant tell you where each graph sits above or below the axis.

## What you need to be able to do

- **2.1** Say what makes a function periodic, and find its period from a graph, a table or a rule.
- **2.1** Build the graphs of y = sin x and y = cos x from the unit circle, and plot their five key points on [0, 2π].
- **2.1** State the domain, range, zeros, maximum and minimum points and symmetry of each graph, and use periodicity to evaluate values such as sin(17π/6).
- **2.2** Find the amplitude |a| and the period 2π/|b| of y = a sin(bx) and y = a cos(bx), and explain what a negative a does.
- **2.2** Sketch one full cycle of such a function by marking the four quarter-period steps.

## Key terms

| Term | Meaning |
|---|---|
| Periodic function | A function with a positive number P such that f(x + P) = f(x) for every x in the domain. |
| Period | The smallest such positive P: the horizontal length of one complete cycle. |
| Cycle | One copy of the repeating pattern, for example from one maximum to the next. |
| Midline | The horizontal line halfway between the maximum and minimum values; y = 0 this week. |
| Amplitude | The vertical distance from the midline to a maximum: |a| for y = a sin(bx). Always positive. |
| Key points | The five points that start, quarter, halve, three-quarter and finish one cycle: zeros, maximum and minimum. |

## From the circle to the graph (2.1)

Walk a point around the unit circle, starting at (1, 0) and turning counterclockwise. After turning x radians the point is (cos x, sin x). Now plot two graphs against the angle x on a horizontal axis:

- the **height** of the point gives y = sin x;
- the **horizontal position** of the point gives y = cos x.

Reading off the quadrantal angles gives the key points.

| x | 0 | π/2 | π | 3π/2 | 2π |
|---|---|---|---|---|---|
| sin x | 0 | 1 | 0 | −1 | 0 |
| cos x | 1 | 0 | −1 | 0 | 1 |

Between the key points the special angles fill in the curve: sin(π/6) = 0.5, sin(π/4) ≈ 0.71, sin(π/3) ≈ 0.87. The graph is not made of straight segments. It rises steeply near the zeros and flattens near the peaks, because the point on the circle moves mostly upward near (1, 0) and mostly sideways near (0, 1).

After one full turn (x = 2π) the point is back where it began, so both graphs repeat: sin(x + 2π) = sin x and cos(x + 2π) = cos x. Neither repeats sooner, so the period of each is 2π.

| Feature | y = sin x | y = cos x |
|---|---|---|
| Domain | all real numbers | all real numbers |
| Range | [−1, 1] | [−1, 1] |
| Period | 2π | 2π |
| Zeros | x = kπ | x = π/2 + kπ |
| Maximum value 1 at | x = π/2 + 2kπ | x = 2kπ |
| Minimum value −1 at | x = 3π/2 + 2kπ | x = π + 2kπ |
| Symmetry | odd: about the origin | even: about the y-axis |

Here k is any integer. Notice that the cosine graph is the sine graph slid π/2 to the left: cos x = sin(x + π/2). Week 8 makes that kind of slide precise.

**Worked example 1 (using the period).** Find sin(17π/6) and list the zeros of y = cos x on [−2π, 2π].

17π/6 is more than one turn: 17π/6 − 2π = 5π/6. Because the period is 2π, sin(17π/6) = sin(5π/6) = 1/2. For the zeros, cosine is 0 at π/2 + kπ; on [−2π, 2π] that gives x = −3π/2, −π/2, π/2 and 3π/2.

## Amplitude: stretching vertically (2.2)

In y = a sin x, every output of sin x is multiplied by a. The zeros stay where they are, the maximum becomes |a| and the minimum becomes −|a|. The **amplitude** is |a|, and the range is [−|a|, |a|].

If a is negative, every output also changes sign: the graph is reflected across the x-axis. y = −sin x starts at 0 and goes **down** first. The amplitude of y = −2 sin x is 2, not −2.

**Worked example 2.** Sketch one cycle of y = 3 cos x.

Multiply each key output of cos x by 3: (0, 3), (π/2, 0), (π, −3), (3π/2, 0), (2π, 3). The amplitude is 3, the range is [−3, 3] and the period is still 2π.

## Period: stretching horizontally (2.2)

In y = sin(bx) with b > 0, the inside reaches 2π when bx = 2π, that is when x = 2π/b. So one full cycle fits into a length of **2π/|b|**.

- b > 1 squeezes the graph: sin(3x) has period 2π/3, so it completes three cycles where sin x completes one.
- 0 < b < 1 stretches it: sin(x/2) has period 2π/(1/2) = 4π.
- A negative b reflects: sin(−bx) = −sin(bx) and cos(−bx) = cos(bx), by week 6's odd and even rules.

To sketch a cycle, divide the period by 4. Starting at x = 0, each step of period ÷ 4 moves you to the next key point.

**Worked example 3.** Sketch one cycle of y = −2 sin(3x).

Amplitude |−2| = 2. Period 2π/3, so each quarter step is (2π/3)/4 = π/6. Sine's pattern is zero, max, zero, min, zero; the negative a flips it to zero, min, zero, max, zero. Key points: (0, 0), (π/6, −2), (π/3, 0), (π/2, 2), (2π/3, 0). Check one: at x = π/6, 3x = π/2 and −2 sin(π/2) = −2.

**Worked example 4 (a period that is not a multiple of π).** Sketch one cycle of y = 4 cos(πx/2).

Here b = π/2, so the period is 2π ÷ (π/2) = 4, a whole number. Quarter step 1. Key points: (0, 4), (1, 0), (2, −4), (3, 0), (4, 4). When b contains π, the period usually comes out free of π; this is how models in week 10 get periods like 12 hours.

**Worked example 5 (reading an equation from a graph).** A graph passes through the origin rising, reaches a maximum of 5 at x = 3π/2 and first returns to the origin, rising, at x = 6π. Write an equation.

It starts at the midline going up, so it is a sine with positive a. Amplitude 5. One cycle runs from 0 to 6π, so the period is 6π and b = 2π/6π = 1/3. The equation is y = 5 sin(x/3). Check: at x = 3π/2, x/3 = π/2 and 5 sin(π/2) = 5.

## Common errors

- **Multiplying instead of dividing.** The period of sin(3x) is 2π/3, not 6π. A larger b means a shorter period.
- **A negative amplitude.** Amplitude is a distance, |a|. The sign of a decides whether the graph starts by going up or down.
- **Amplitude as max minus min.** The full height of the wave is 2|a|. The amplitude is half of it.
- **Key points every π/2 no matter what.** The step is period ÷ 4; it is π/2 only when the period is 2π.
- **Swapping the patterns.** Sine starts at the midline; cosine starts at a maximum (or a minimum when a < 0).
- **Degree-mode thinking.** This week x is in radians. In degrees, the period of sin x would be 360°, and sin(π/2) on a calculator in degree mode is not 1.

## Where this goes next

Week 8 adds the last two transformations, a horizontal shift and a vertical shift, to get y = a sin(b(x − h)) + k, and works backwards from a graph or table to an equation. Week 9 graphs tangent and the reciprocal functions, using the sine and cosine graphs as guides. Week 10 fits these curves to Ferris wheels, tides and springs.

## Self-check

1. Use periodicity to find the exact value of cos(25π/6).
2. Give the amplitude, period and five key points of y = −5 cos(2x).
3. What is the period of y = 7 sin(πx/6)? How many full cycles fit on [0, 36]?
4. Explain, using the unit circle, why y = cos x is symmetric about the y-axis.
5. A sine graph with positive a has amplitude 0.5 and period π/2. Write its equation.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.A.2, HSF-TF.A.4, HSF-TF.B.5); its approach follows the trigonometry lessons of IM 9–12 Math by Illustrative Mathematics (© 2019, CC BY 4.0). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
