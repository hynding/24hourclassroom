# Week 22 · Accumulation of Change and Riemann Sums

**Topics:** 6.1 Exploring Accumulations of Change · 6.2 Approximating Areas with Riemann Sums
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 6, Topics 6.1–6.2, learning objectives in our own words
**Spiral:** Units 2 and 4 taught you to go from a quantity to its rate of change: from position to velocity, from volume to rate of flow. This unit runs that arrow backwards. The geometry of rectangles, triangles and trapezoids from earlier courses becomes the tool for adding up change, and week 18's language of increasing and decreasing (with week 19's concavity) decides whether an approximation is too big or too small.

## What you need to be able to do

- **6.1** Interpret the area between the graph of a rate of change and the horizontal axis as the accumulated change in the underlying quantity, with units.
- **6.1** Treat area above the axis as an increase and area below the axis as a decrease, and tell net change from total change.
- **6.1** Find accumulated change exactly when the rate graph is made of line segments, using rectangles, triangles and trapezoids.
- **6.2** Approximate an accumulated change with left, right and midpoint Riemann sums and with trapezoidal sums, from a formula, a graph or a table.
- **6.2** Use each subinterval's own width when a table has unequal spacing.
- **6.2** Decide whether an approximation is an overestimate or an underestimate, using whether the function is increasing or decreasing (left and right sums) or its concavity (trapezoidal and midpoint sums).

## Key terms

| Term | Meaning |
|---|---|
| Rate of change | How fast a quantity changes per unit of input, such as liters per minute or meters per second. |
| Accumulated change | The total change in a quantity over an interval, built up from its rate. |
| Net change | Increases minus decreases: (area above the axis) − (area below the axis). |
| Partition | A split of [a, b] into subintervals by points a = x₀ < x₁ < … < xₙ = b. |
| Riemann sum | A sum of (width) × (sample height) over the subintervals of a partition. |
| Left / right Riemann sum | Heights taken at the left / right endpoint of each subinterval. |
| Midpoint Riemann sum | Heights taken at the midpoint of each subinterval. |
| Trapezoidal sum | Each strip is a trapezoid with the two endpoint heights as parallel sides. |
| Overestimate / underestimate | An approximation larger / smaller than the exact accumulated change. |

## Accumulation from a rate (6.1)

Suppose water flows into a tank at a constant 15 liters per minute. After 4 minutes, 15 · 4 = 60 liters have come in. On a graph of rate against time, the rate is a horizontal line at height 15, and 60 is the area of the 4-by-15 rectangle under it. That is the whole idea of this unit: **the area under a rate graph is the accumulated change.**

When the rate varies, the same picture holds. Over a very short time the rate is nearly constant, so the change in that short time is nearly (rate) × (short time), the area of a thin strip. Adding the strips adds the changes. So the area between the graph of r and the t-axis from t = a to t = b is the change in the quantity over that interval.

**Units come from the axes.** Area multiplies the vertical units by the horizontal units:

- liters per minute × minutes = liters
- meters per second × seconds = meters
- people per hour × hours = people
- kilowatts × hours = kilowatt-hours

If the answer you are about to write still has "per" in it, you have probably described a rate rather than an amount.

**Signs matter.** If the rate is negative (water draining, a particle moving left), the region lies below the axis and represents a **decrease**. The net change subtracts that area. For velocity, the net change is the displacement; the total distance traveled adds the areas instead.

**Accumulated change is not the amount.** The area tells you how much was added. To know how much is there at the end, you also need the starting amount: final = initial + accumulated change.

**Worked example (a cyclist).** A hypothetical cyclist's velocity v(t), in meters per second, is linear from v(0) = 2 to v(4) = 6, constant at 6 until t = 7, and then linear down to v(9) = 0. How far does the cyclist go in 9 seconds?

Split the region at the corners:

| Interval | Shape | Area |
|---|---|---|
| 0 ≤ t ≤ 4 | trapezoid with sides 2 and 6, width 4 | 4 · (2 + 6)/2 = 16 |
| 4 ≤ t ≤ 7 | rectangle 3 by 6 | 18 |
| 7 ≤ t ≤ 9 | triangle with base 2, height 6 | ½ · 2 · 6 = 6 |

Total 16 + 18 + 6 = 40 meters. Since v is never negative, displacement and distance agree.

**Worked example (a tank that fills and drains).** The net rate at which water enters a tank is R(t) = 6 − 2t liters per minute for 0 ≤ t ≤ 5. Find the net change and the total amount of water that moved.

R is a line crossing zero at t = 3. On 0 ≤ t ≤ 3 the region is a triangle above the axis with base 3 and height 6: area 9, an increase of 9 liters. On 3 ≤ t ≤ 5 it is a triangle below the axis with base 2 and height |R(5)| = 4: area 4, a decrease of 4 liters. Net change 9 − 4 = 5 liters; the water in the tank is greatest at t = 3, where R changes from positive to negative. The total volume of water that moved in or out is 9 + 4 = 13 liters.

## Riemann sums (6.2)

Most rate graphs are not made of straight segments, and often we only know a table of values. Then we approximate the area with shapes we can compute.

1. Split [a, b] into subintervals.
2. On each, pick a height: the function's value at the left endpoint, the right endpoint or the midpoint.
3. Multiply each height by its subinterval's width and add.

With equal subintervals the width is Δx = (b − a)/n. With a table, the widths are whatever the table's spacing gives; they need not match.

**Trapezoidal sums** replace each rectangle with a trapezoid joining the two endpoint heights: on a subinterval of width Δx the area is Δx · (f(left) + f(right))/2. Strip by strip this is the average of the left and right rectangles, so the trapezoidal sum always equals (L + R)/2 on the same partition.

**Worked example (x² on [0, 2]).** Approximate the area under f(x) = x² on [0, 2] with four equal subintervals.

Δx = 0.5, and the partition points are 0, 0.5, 1, 1.5, 2.

| Sum | Heights | Value |
|---|---|---|
| Left | f(0), f(0.5), f(1), f(1.5) = 0, 0.25, 1, 2.25 | 0.5 · 3.5 = 1.75 |
| Right | f(0.5), f(1), f(1.5), f(2) = 0.25, 1, 2.25, 4 | 0.5 · 7.5 = 3.75 |
| Midpoint | f(0.25), f(0.75), f(1.25), f(1.75) = 0.0625, 0.5625, 1.5625, 3.0625 | 0.5 · 5.25 = 2.625 |
| Trapezoidal | average of left and right | (1.75 + 3.75)/2 = 2.75 |

Next week you will see that the exact area is 8/3 ≈ 2.667. The left sum is low, the right sum high, the trapezoidal sum slightly high and the midpoint sum slightly low, for reasons explained below.

**Worked example (unequal widths).** During a hypothetical storm, rain flows into a barrel at r(t) liters per minute.

| t (minutes) | 0 | 2 | 5 | 9 | 10 |
|---|---|---|---|---|---|
| r(t) (L/min) | 4 | 7 | 9 | 6 | 5 |

The widths are 2, 3, 4 and 1.

- Left: 4·2 + 7·3 + 9·4 + 6·1 = 8 + 21 + 36 + 6 = 71 liters.
- Right: 7·2 + 9·3 + 6·4 + 5·1 = 14 + 27 + 24 + 5 = 70 liters.
- Trapezoidal: 2·(4 + 7)/2 + 3·(7 + 9)/2 + 4·(9 + 6)/2 + 1·(6 + 5)/2 = 11 + 24 + 30 + 5.5 = 70.5 liters, which is (71 + 70)/2.

Interpretation: about 70.5 liters of rainwater flow into the barrel during the first 10 minutes. Note what the sentence includes: the quantity (rainwater flowing in), the units (liters) and the time interval. It does **not** say the barrel holds 70.5 liters; we do not know how much was there at t = 0.

**Midpoints from a table.** A midpoint sum needs the function's value at the middle of each subinterval. With a table, pick subintervals whose midpoints are listed. If values are given at x = 0, 1, 2, 4, 6, 7, 8, the subintervals [0, 2], [2, 6] and [6, 8] have midpoints 1, 4 and 7, so the midpoint sum is 2·f(1) + 4·f(4) + 2·f(7).

## Overestimates and underestimates (6.2)

Two different properties decide two different kinds of sum.

**Left and right sums depend on increasing or decreasing.**

- If f is increasing on [a, b], each left endpoint is the lowest point of its strip, so the **left sum underestimates** and the **right sum overestimates**.
- If f is decreasing, it is the other way round: left overestimates, right underestimates.

**Trapezoidal and midpoint sums depend on concavity.**

- If f is concave up, each chord lies above the curve, so the **trapezoidal sum overestimates**; the **midpoint sum underestimates**.
- If f is concave down, the trapezoidal sum underestimates and the midpoint sum overestimates.

Why the midpoint sum behaves this way: a midpoint rectangle has exactly the same area as the trapezoid under the tangent line at the midpoint (the tangent line tilts, but what it adds on one side it removes on the other). A concave up curve lies above its tangent lines, so that area is too small.

For x² on [0, 2] (increasing and concave up), this predicts exactly what the table showed: left low, right high, trapezoid high, midpoint low.

**Justification language.** "The left Riemann sum is an underestimate because r is increasing on 0 ≤ t ≤ 5, so on each subinterval the left endpoint gives the least value of r, and each rectangle lies below the graph." A verdict without the reason earns nothing on the AP exam. If the function increases on part of the interval and decreases on another, you cannot classify a left or right sum over the whole interval; you can classify the pieces separately.

## Common mistakes

- **Using every table value in a left or right sum.** With n subintervals there are n heights. The left sum skips the last value; the right sum skips the first.
- **Using one Δx for a table with unequal spacing.** Multiply each height by its own width.
- **Forgetting to multiply by the width at all.** Adding the heights gives a number with the wrong units.
- **Calling the area under a rate graph a rate.** Area multiplies by the input units: liters per minute becomes liters.
- **Adding areas below the axis when the net change is asked.** Subtract them; add them only for total change (such as total distance).
- **Mixing up which property decides which sum.** Increasing/decreasing decides left and right; concavity decides trapezoid and midpoint.
- **Reporting the accumulated change as the final amount.** Add the initial amount first.

## Self-check

1. A rate of 0.4 kilograms per day is graphed against days. What are the units of the area under the graph over 30 days, and what is the area if the rate is constant?
2. Water leaves a pool at a constant 3 liters per minute from t = 10 to t = 30 minutes. What is the net change in the pool's water over that interval?
3. Find the right Riemann sum for f(x) = 1/x on [1, 3] with two equal subintervals. Is it an overestimate or an underestimate?
4. A table gives g at x = 0, 3, 4, 10 as 5, 8, 6, 2. Compute the trapezoidal sum on [0, 10].
5. A function is decreasing and concave down on [0, 6]. Classify the left, right, trapezoidal and midpoint sums as over- or underestimates.
6. Explain why the left and right sums agree with the trapezoidal sum when f is constant.

*Answers:* 1. Kilograms; 0.4 · 30 = 12 kg. 2. −60 liters (a decrease of 60). 3. Δx = 1, so f(2) + f(3) = 1/2 + 1/3 = 5/6 ≈ 0.833; f is decreasing, so it is an underestimate. 4. 3·(5 + 8)/2 + 1·(8 + 6)/2 + 6·(6 + 2)/2 = 19.5 + 7 + 24 = 50.5. 5. Left over, right under (decreasing); trapezoid under, midpoint over (concave down). 6. Every strip is a rectangle of the same height whichever endpoint you use, and a trapezoid with equal sides is that rectangle.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 6, Topics 6.1–6.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
