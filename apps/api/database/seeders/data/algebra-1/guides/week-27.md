# Week 27 · Graphs of Situations and the Vertex Form

**Lessons:** 6.14 Graphs That Represent Situations · 6.15 Vertex Form · 6.16 Graphing from the Vertex Form · 6.17 Changing the Vertex
**Practices:** MP4 (read a model's graph in terms of the situation), MP7 (see why a(x − h)² + k puts the vertex at (h, k)), MP8 (generalise what h and k do from repeated trials)
**Built from:** IM Algebra 1, Unit 6, Lessons 14–17, in our own words
**Spiral:** The vertex you found last week by averaging the x-intercepts (week 26) is now read straight from a third form of the expression. Projectile and revenue models (week 25) supply the situations. Equivalent expressions (week 25) let you move between forms, and domain and range (week 17) say which part of the parabola belongs to the model.

## What you need to be able to do

- **6.14** Read the graph of a quadratic model: what the y-intercept, vertex and x-intercepts mean in the situation, and which part of the parabola the model actually uses.
- **6.15** Recognise the vertex form a(x − h)² + k, read the vertex (h, k) with the correct signs, and convert vertex form to standard form.
- **6.16** Sketch a parabola from its vertex form: vertex, direction from a, y-intercept, mirror points, and the x-intercepts when they exist.
- **6.17** Describe how changing h and k moves the graph, and write the equation of a parabola that has been shifted or reflected.

## Key terms

| Term | Meaning |
|---|---|
| Vertex form | a(x − h)² + k, with vertex (h, k). |
| Maximum value | The output at the vertex when a < 0. |
| Minimum value | The output at the vertex when a > 0. |
| Horizontal shift | Moving a graph left or right; controlled by h. |
| Vertical shift | Moving a graph up or down; controlled by k. |

## Reading the graph of a situation (6.14)

A quadratic model's graph has three landmarks, and each means something.

**A ball thrown upward.** Graph description: height in feet against time in seconds, through (0, 5), peaking at (2, 69), crossing the time axis near (4.1, 0). The y-intercept (0, 5) is the launch height; the vertex (2, 69) says the ball is highest, 69 feet, two seconds in; the x-intercept at about 4.1 is the landing. The model's domain is 0 ≤ t ≤ 4.1; the parabola continues in both directions, but the ball does not.

**A revenue curve.** Revenue against ticket price, opening downward, zeros at 0 and 30, peak (15, 2,250). The zeros are prices that earn nothing; the vertex names the best price, $15, and the most it can earn, $2,250.

**A fountain.** h(x) = −0.5(x − 4)² + 8 gives a jet's height at horizontal distance x. h(0) = 0 (the nozzle is at ground level), the peak is 8 feet high at x = 4, and h = 0 again at x = 8, where the water lands. Domain 0 ≤ x ≤ 8, range 0 ≤ h ≤ 8.

**Worked example.** A diver's height is shown by a parabola from (0, 10) through the peak (0.5, 11.25) to (2, 0). Describe the dive.
The platform is 10 m up; the diver rises to 11.25 m after half a second and enters the water after 2 seconds. By symmetry about t = 0.5, the diver is back at platform height at t = 1.

**Try it.** On a height graph a parabola peaks at (3, 150) and crosses the axis at (6, 0). When is the object highest, and when does it land?
*Answer:* Highest at 3 seconds (150 feet); lands at 6 seconds.

## Vertex form (6.15)

A quadratic expression can be written in a third way:

**y = a(x − h)² + k**, with vertex **(h, k)**.

Why? The square (x − h)² is 0 when x = h and positive everywhere else. So a(x − h)² is 0 at x = h and, depending on the sign of a, either positive or negative away from it. The output at x = h is exactly k, and every other output is k plus something of one sign: k is the minimum (a > 0) or the maximum (a < 0).

Read the signs carefully. y = (x + 2)² − 5 is y = (x − (−2))² + (−5): vertex (−2, −5). y = 3(x − 1)² + 4: vertex (1, 4).

| Form | Looks like | Shows at a glance |
|---|---|---|
| Standard | ax² + bx + c | y-intercept c |
| Factored | a(x − p)(x − q) | x-intercepts p and q |
| Vertex | a(x − h)² + k | vertex (h, k) |

All three share the same a, so the direction and width are visible in each.

**Converting to standard form.** Expand the square, multiply by a, add k: (x − 3)² − 4 = x² − 6x + 9 − 4 = x² − 6x + 5. (And x² − 6x + 5 = (x − 1)(x − 5), so this one function has all three forms.)

**Worked example.** Write 2(x + 1)² − 8 in standard form.
2(x² + 2x + 1) − 8 = 2x² + 4x + 2 − 8 = 2x² + 4x − 6.

**Try it.** State the vertex of y = −(x − 6)² + 2, and write it in standard form.
*Answers:* (6, 2); −(x² − 12x + 36) + 2 = −x² + 12x − 34.

## Graphing from vertex form (6.16)

1. Plot the vertex (h, k).
2. The sign of a gives the direction; |a| gives the width (as in week 26).
3. Compute the y-intercept, a · h² + k, and plot its mirror image at x = 2h.
4. For the x-intercepts, set the expression equal to 0, isolate the square, and take both square roots.

**Worked example.** y = −(x − 2)² + 9.
Vertex (2, 9), a maximum. y-intercept: −4 + 9 = 5; mirror point (4, 5). x-intercepts: (x − 2)² = 9, x − 2 = ±3, x = 5 or x = −1. A downward parabola through (−1, 0), (0, 5), (2, 9), (4, 5), (5, 0).

**Worked example.** y = 2(x + 1)² − 8.
Vertex (−1, −8), a minimum. y-intercept 2 − 8 = −6; mirror point (−2, −6). x-intercepts: (x + 1)² = 4, x = 1 or −3.

If isolating the square gives a negative number, as in (x − 1)² = −3, there are no x-intercepts: the parabola sits entirely above (or below) the axis.

**Try it.** Find the vertex, direction, y-intercept and x-intercepts of y = (x − 5)² − 16.
*Answers:* (5, −16); upward; 25 − 16 = 9; (x − 5)² = 16 gives x = 9 or x = 1.

## Changing the vertex (6.17)

Start with y = x², vertex at the origin, and watch each parameter.

- **h slides the graph horizontally.** (x − 3)² moves it right 3; (x + 3)² moves it left 3. Inside the square the sign is backwards from the direction of the move.
- **k slides the graph vertically.** + 5 moves it up 5; − 4 moves it down 4.
- **a** flips and stretches as before, around the new vertex.

So y = x² moved right 3 and down 4 is y = (x − 3)² − 4. A parabola with the shape of 2x² but opening downward and with vertex (3, −1) is y = −2(x − 3)² − 1. Changing k from 2 to −1 in (x − 5)² + k drops the graph 3 units and leaves the axis x = 5 alone. The graphs of (x − 4)² and (x + 4)² are mirror images across the y-axis.

**Finding a from a vertex and one point.** The diver's parabola has vertex (0.5, 11.25) and passes through (0, 10). Write h(t) = a(t − 0.5)² + 11.25 and substitute: 0.25a + 11.25 = 10, so a = −5, and h(t) = −5(t − 0.5)² + 11.25 = −5t² + 5t + 10.

**Worked example.** The graph of y = (x − 2)² + 1 is moved so its vertex is (6, −3). Find the new y-intercept.
New equation y = (x − 6)² − 3; at x = 0, 36 − 3 = 33.

**Try it.** Write the equation of y = x² after a move 1 unit right and 7 units up, and the equation of y = −x² after a move 4 units left.
*Answers:* y = (x − 1)² + 7; y = −(x + 4)².

## Common mistakes

- Reading the vertex of (x + 2)² − 5 as (2, −5); the form is (x − h)².
- Deciding the direction from k instead of a: −(x − 2)² + 9 opens downward.
- Taking the y-intercept as k; it is a · h² + k.
- Forgetting the ± when taking the square root for the x-intercepts.
- Expanding (t − 0.5)² as t² − 0.25 and losing the middle term.
- Using the whole parabola as a model's domain.

## Where this goes next

The unit 6 exam covers weeks 24 to 27. Unit 7 turns from functions to equations: finding the inputs that give a particular output exactly, by reasoning, by factoring, by completing the square (which produces the vertex form from the standard form) and by the quadratic formula.

## Self-check

1. A graph of height against time passes through (0, 12), peaks at (1.5, 48) and crosses the axis at (3.2, 0). Interpret each point and state the domain.
2. State the vertex of y = 4(x + 3)² − 7 and whether it is a maximum or minimum.
3. Find the y-intercept and the x-intercepts of y = (x − 3)² − 25.
4. Write the equation of y = x² moved 6 units left and 2 units down.
5. A parabola has vertex (2, 5) and passes through (4, −3). Find its equation in vertex form.

*Answers:* (1) Launched from 12 feet; highest, 48 feet, at 1.5 s; lands at 3.2 s; domain 0 ≤ t ≤ 3.2. (2) (−3, −7); minimum. (3) 9 − 25 = −16; (x − 3)² = 25, x = 8 or x = −2. (4) y = (x + 6)² − 2. (5) a(2)² + 5 = −3, so 4a = −8, a = −2: y = −2(x − 2)² + 5.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 6, Lessons 14–17, https://im.kendallhunt.com/HS/teachers/1/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
