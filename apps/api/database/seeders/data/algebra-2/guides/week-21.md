# Week 21 · Moving and Reflecting Functions

**Lessons:** 5.1 Matching up to Data · 5.2 Moving Functions · 5.3 More Movement · 5.4 Reflecting Functions
**Practices:** MP7 (look for structure), MP4 (model with mathematics), MP2 (reason abstractly and quantitatively)
**Built from:** IM Algebra 2, Unit 5, Lessons 1–4, in our own words
**Spiral:** The exponential and logarithmic graphs of Unit 4 are the first ones to be moved around here: 2ˣ − 3 has its asymptote moved to y = −3. The vertex form of a quadratic (week 14) is a shift of y = x². Every rule in this week is checked by tracking a single point, the way we tracked (3, 8) between y = 2ˣ and y = log₂(x).

## What you need to be able to do

- **5.1** Explain why a basic function (linear, quadratic, exponential) may need to be shifted to fit a data set, and identify from the data what shift is needed (for example, an exponential decay that levels off at 20 rather than 0).
- **5.2** Describe and write vertical translations f(x) + k and horizontal translations f(x − h) of any function, using graphs, tables and equations; track where a given point goes.
- **5.3** Combine horizontal and vertical translations, read the shifts off an equation such as g(x) = f(x + 1) − 4, and write the equation that produces a described movement.
- **5.4** Describe and write reflections across the x-axis (−f(x)) and across the y-axis (f(−x)); combine a reflection with translations; track points and features such as asymptotes, vertices and intercepts.

## Key terms

| Term | Meaning |
|---|---|
| Translation (shift) | Moving every point of a graph the same distance in the same direction. |
| Vertical translation | y = f(x) + k: up k if k > 0, down if k < 0. |
| Horizontal translation | y = f(x − h): right h if h > 0; so f(x + 3) is left 3. |
| Reflection across the x-axis | y = −f(x): every output changes sign; (a, b) → (a, −b). |
| Reflection across the y-axis | y = f(−x): every input changes sign; (a, b) → (−a, b). |
| Parent function | The basic function being transformed: x², |x|, √x, 2ˣ, log₂(x), x³. |

## Why we move functions: matching data (5.1)

A cup of coffee cools from 100°C toward room temperature, not toward 0°C. The data 100, 60, 40, 30, 25 at t = 0, 1, 2, 3, 4 is not a plain exponential: the ratios 0.6, 0.67, 0.75, 0.83 are not constant. But the amount *above 20* is 80, 40, 20, 10, 5: halving each step. So the model is

**h(t) = 80(0.5)ᵗ + 20**,

an exponential decay shifted up 20. Its horizontal asymptote is y = 20, the room temperature, and h(t) never drops below it.

The general lesson: a basic function often has the right *shape* but the wrong *position*. Translations fix the position without changing the shape.

**Try it.**
1. Data: 5, 7, 11, 19, 35 at t = 0, 1, 2, 3, 4. Subtract a constant to make it a plain exponential and write a model.

*Answers:* 1. Subtracting 3 gives 2, 4, 8, 16, 32 = 2ᵗ⁺¹, so y = 2ᵗ⁺¹ + 3 (or 2 · 2ᵗ + 3).

## Vertical and horizontal translations (5.2)

**Vertical: y = f(x) + k.** Add k to every output. The graph slides up (k > 0) or down (k < 0); x-intercepts move, y-intercept moves, asymptotes move.

- y = x² + 7: the parabola with vertex (0, 7).
- y = 2ˣ − 3: the exponential with asymptote y = −3 and y-intercept −2.
- If (3, 5) is on f, then (3, 9) is on f(x) + 4.

**Horizontal: y = f(x − h).** Replace x by x − h. The graph slides *right* h; so f(x + 3) slides *left* 3. The sign looks backwards because the new function reaches the old output "h later": g(x) = f(x − h) has g(h) = f(0).

- y = (x − 2)²: vertex (2, 0), right 2.
- y = |x + 4|: vertex (−4, 0), left 4.
- y = 2^(x − 1): passes through (1, 1) instead of (0, 1); the asymptote y = 0 is unchanged.
- If (3, 5) is on f, then (7, 5) is on f(x − 4) and (1, 5) is on f(x + 2).

**Tables.** If f has the table x: −2, −1, 0, 1, 2 with f(x): 4, 1, 0, 1, 4, then g(x) = f(x − 2) + 1 has the same outputs plus 1, at inputs 2 larger: x: 0, 1, 2, 3, 4 with g(x): 5, 2, 1, 2, 5.

**Worked example.** Describe y = log₂(x + 3) and give its asymptote and x-intercept.

The graph of log₂(x) shifted left 3. The asymptote x = 0 moves to x = −3; the x-intercept (1, 0) moves to (−2, 0).

**Try it.**
1. Write the equation of y = √x shifted up 4, and of y = √x shifted left 5.
2. The point (−1, 6) is on f. Where is it on f(x) − 2? On f(x + 3)?

*Answers:* 1. √x + 4; √(x + 5). 2. (−1, 4); (−4, 6).

## Combining movements (5.3)

y = f(x − h) + k shifts right h and up k. Read both from the equation:

| Equation | Shift | Key feature |
|---|---|---|
| (x − 1)² − 5 | right 1, down 5 | vertex (1, −5) |
| (x + 4)² − 2 | left 4, down 2 | vertex (−4, −2) |
| \|x − 2\| + 3 | right 2, up 3 | vertex (2, 3) |
| 2^(x − 2) + 1 | right 2, up 1 | asymptote y = 1, through (2, 2) |
| √(x + 1) − 4 | left 1, down 4 | starts at (−1, −4) |
| f(x + 1) − 4 | left 1, down 4 | (3, 5) → (2, 1) |

**Order does not matter for shifts**: right 2 then up 3 lands in the same place as up 3 then right 2.

**Worked example.** Write the equation for y = x³ moved left 1 and down 4, and find its y-intercept.

y = (x + 1)³ − 4. At x = 0: 1 − 4 = −3, so the y-intercept is (0, −3).

**Worked example.** The point (3, 5) lies on f. Find the corresponding point on g(x) = f(x − 1) + 6.

Right 1 and up 6: (4, 11).

**Try it.**
1. Write y = |x| shifted right 2 and up 3.
2. The vertex of y = x² is (0, 0). Find the vertex of y = (x − 6)² + 2 and of y = (x + 3)² − 7.

*Answers:* 1. |x − 2| + 3. 2. (6, 2); (−3, −7).

## Reflections (5.4)

**Across the x-axis: y = −f(x).** Every output changes sign: (a, b) → (a, −b). Peaks become valleys; a graph above the axis flips below.

- −x²: a downward parabola with vertex (0, 0).
- −√x: domain still x ≥ 0, but outputs are now ≤ 0.
- −2ˣ: decreasing toward the asymptote y = 0 from below; y-intercept −1.

**Across the y-axis: y = f(−x).** Every input changes sign: (a, b) → (−a, b). Left and right swap.

- 2^(−x) = (1/2)ˣ: the growth curve becomes a decay curve; y-intercept still 1.
- √(−x): defined for x ≤ 0, the mirror of √x.
- f(x) = x² − 4x: f(−x) = x² + 4x, so g(2) = 4 + 8 = 12 (the same as f(−2)).
- x² is unchanged by this reflection, because (−x)² = x²; next week calls such functions even.

**Combining with shifts.** y = −(x − 2)² + 3: reflect x² across the x-axis, then move right 2 and up 3; vertex (2, 3), opening downward, y-intercept −4 + 3 = −1. y = −√x + 4: a downward square root starting at (0, 4), crossing the x-axis where √x = 4, at x = 16. y = √(−x) + 2: the left-pointing square root starting at (0, 2).

**Worked example.** The point (3, 5) lies on f. Find its image on −f(x), on f(−x), and on −f(−x).

(3, −5); (−3, 5); (−3, −5).

**Try it.**
1. Write the equation of y = x³ reflected across the x-axis, and of y = log₂(x) reflected across the y-axis.
2. f(x) = x² − 4x. Write −f(x) and f(−x) and evaluate each at x = 1.

*Answers:* 1. y = −x³; y = log₂(−x), defined for x < 0. 2. −f(x) = −x² + 4x, value 3; f(−x) = x² + 4x, value 5.

## Common mistakes

- **Reading f(x + 3) as "right 3".** It is left 3; check with a point: g(x) = f(x + 3) has g(−3) = f(0).
- **Moving the asymptote with a horizontal shift.** 2^(x − 1) still has asymptote y = 0; only vertical shifts move a horizontal asymptote.
- **Confusing −f(x) with f(−x).** The first flips outputs (across the x-axis), the second flips inputs (across the y-axis).
- **Forgetting the domain changes under f(−x).** √(−x) lives on x ≤ 0.
- **Applying a shift to only part of the formula.** f(x − 2) replaces *every* x: (x − 2)² − 3(x − 2), not x² − 3(x − 2).

## Where this goes next

Next week studies symmetry (even and odd functions), writes transformations algebraically from graphs, and starts scaling: multiplying outputs by a constant stretches or compresses a graph vertically.

## Self-check

1. Data: 50, 35, 27.5, 23.75 at t = 0, 1, 2, 3 approaches 20. Write a shifted exponential model.
2. Describe y = (x + 5)² − 1 and give its vertex and y-intercept.
3. The point (−2, 7) is on f. Find its image on f(x − 3) + 1, on −f(x), and on f(−x).
4. Write the equation of y = 2ˣ reflected across the x-axis and shifted up 5, and give its asymptote.
5. Explain, using the point (0, 0) on y = x², why f(x + 3) moves the graph left.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 5, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/3/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
