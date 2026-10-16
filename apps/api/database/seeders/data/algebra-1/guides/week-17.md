# Week 17 · Domain, Range, Piecewise and Absolute Value Functions

**Lessons:** 4.10 Domain and Range (Part 1) · 4.11 Domain and Range (Part 2) · 4.12 Piecewise Functions · 4.13 Absolute Value Functions (Part 1) · 4.14 Absolute Value Functions (Part 2)
**Practices:** MP2 (decide which inputs make sense in a situation), MP6 (write a domain precisely, with inequalities), MP7 (see a V-shaped graph as a distance)
**Built from:** IM Algebra 1, Unit 4, Lessons 10–14, in our own words
**Spiral:** Intercepts and maximums (week 16) tell you where the range starts and ends. Inequalities from unit 2 are the language of domains. The mean absolute deviation from unit 1 used absolute value to measure distance, which is exactly what the absolute value function does.

## What you need to be able to do

- **4.10** Describe the domain (allowed inputs) and range (possible outputs) of a function from a situation, using inequalities and whole-number restrictions where they apply.
- **4.11** Read the domain and range from a graph, and sketch a graph with a specified domain and range.
- **4.12** Evaluate and graph a piecewise function, with the correct piece for each input and open or closed endpoints.
- **4.13** Describe the absolute value function as distance from zero, graph f(x) = |x|, and interpret its V shape.
- **4.14** Graph and interpret transformations such as |x − a| and |x| + b, and use absolute value to express "within c of" conditions.

## Key terms

| Term | Meaning |
|---|---|
| Domain | The set of all inputs that make sense or are allowed for the function. |
| Range | The set of all outputs the function actually produces. |
| Discrete domain | Only separate values, such as whole numbers (number of tickets). |
| Continuous domain | Every value in an interval (time, length). |
| Piecewise function | A function defined by different rules on different parts of the domain. |
| Absolute value of x (written with bars) | The distance of x from 0 on the number line; never negative. |
| Vertex of a V graph | The corner point of an absolute value graph, where the minimum (or maximum) occurs. |

## Domain and range from situations (4.10)

The domain is decided by the situation, not by the formula. If C(n) = 12n is the cost of n concert tickets and the venue sells at most 8 per person, the domain is the whole numbers 0 to 8, even though 12n could be computed for any n. The range is the outputs those inputs produce: 0, 12, 24, …, 96.

If h(t) is the height of a ball thrown at t = 0 and caught at t = 3, the domain is 0 ≤ t ≤ 3 (continuous: every instant counts) and the range runs from the lowest height (the hand, say 1.5 m) to the maximum height.

**Worked example.** A 500-litre tank drains at 20 L per minute: V(t) = 500 − 20t. Domain and range?
It is empty when 500 − 20t = 0, t = 25. Domain 0 ≤ t ≤ 25; range 0 ≤ V ≤ 500. Negative time and negative volume make no sense.

**Worked example.** A bakery sells boxes of 6 muffins, at most 30 boxes a day. B(x) = 6x is the number of muffins for x boxes. Domain: whole numbers 0 to 30. Range: multiples of 6 from 0 to 180.

**Try it.** P(n) = 40 − 2.5n is the money left after buying n sandwiches at $2.50 from $40. Give the domain and range.
*Answer:* n is a whole number with 2.5n ≤ 40, so 0 ≤ n ≤ 16; range: 40, 37.5, …, 0.

## Domain and range from graphs (4.11)

On a graph, the domain is the set of x-values the graph covers (read left to right); the range is the set of y-values (read bottom to top). A filled dot includes the endpoint; an open dot excludes it.

**Worked example.** A graph runs from a filled dot at (−2, 3) to an open dot at (4, 7), dipping to a low of −1 in between. Domain −2 ≤ x < 4. Range −1 ≤ y < 7 (the 7 is not reached because the endpoint is open; the −1 is a point on the curve).

**Sketching to order.** "Draw a function with domain 0 ≤ x ≤ 6 and range 2 ≤ y ≤ 5." Any curve that starts at x = 0, ends at x = 6, reaches both y = 2 and y = 5 somewhere, and never leaves that band will do; a zigzag from (0, 2) to (3, 5) to (6, 2) works.

**Try it.** A graph is a horizontal segment from (1, 4) to (5, 4), both endpoints filled. Domain and range?
*Answer:* Domain 1 ≤ x ≤ 5; range the single value 4.

## Piecewise functions (4.12)

A piecewise function uses different rules on different parts of the domain. A parking garage charges $3 for the first hour or part of it, then $2 for each additional hour or part, up to a daily maximum of $15:

- C(t) = 3 for 0 < t ≤ 1
- C(t) = 5 for 1 < t ≤ 2
- C(t) = 7 for 2 < t ≤ 3, and so on, until the cap: C(t) = 15 for t > 6.

To evaluate, find which piece contains the input, then apply that rule: C(2.5) = 7, since 2 < 2.5 ≤ 3. The graph is a set of horizontal steps, with an open dot at the left end of each step and a filled dot at the right end, because the step belongs to the input at its right end.

**Worked example.** f(x) = 2x + 1 for x < 2 and f(x) = 7 − x for x ≥ 2. Find f(0), f(2), f(5).
f(0): 0 < 2, so 2(0) + 1 = 1. f(2): 2 ≥ 2, so 7 − 2 = 5. f(5): 7 − 5 = 2. On the graph, the first piece has an open dot at (2, 5) and the second piece a filled dot at (2, 5); here they coincide, so the graph is connected.

**Worked example.** Postage is $1 for letters up to 30 g, $1.50 for over 30 g up to 60 g, $2.20 for over 60 g up to 100 g. P(30) = 1; P(30.1) = 1.50; P(100) = 2.20.

**Try it.** g(x) = x² for x ≤ 1 and g(x) = 2 − x for x > 1. Find g(−2), g(1), g(3).
*Answers:* 4; 1; −1.

## Absolute value functions (4.13, 4.14)

|x| is the distance of x from 0: |7| = 7 and |−7| = 7. The function f(x) = |x| returns x when x ≥ 0 and −x when x < 0, so it is a piecewise function in disguise. Its graph is a V with its vertex at the origin, going up with slope 1 to the right and slope −1 to the left. Domain: all real numbers. Range: y ≥ 0.

**Shifting the V.**

- g(x) = |x − 3| is the distance of x from 3: vertex at (3, 0). The graph of |x| moved 3 to the right.
- h(x) = |x| + 2: vertex at (0, 2); the V moved up 2. Range y ≥ 2.
- k(x) = |x + 4| − 1: vertex at (−4, −1).
- m(x) = −|x|: the V opens downward, vertex (0, 0), range y ≤ 0, and it has a maximum rather than a minimum.

**Worked example.** A machine should cut rods 50 cm long. The error for a rod of length L is E(L) = |L − 50|. E(48) = 2 and E(53) = 3. Rods with error at most 1 cm pass: |L − 50| ≤ 1 means 49 ≤ L ≤ 51. The graph of E is a V with vertex (50, 0), and the accepted lengths are where the graph is at or below the height 1.

**Worked example.** Solve |x − 3| = 5 using distance. The numbers at distance 5 from 3 are 3 + 5 = 8 and 3 − 5 = −2. On the graph of |x − 3|, the horizontal line y = 5 meets the V at x = −2 and x = 8.

**Try it.** Give the vertex and range of y = |x + 1| + 4. For which x is |x − 10| ≤ 2?
*Answers:* Vertex (−1, 4), range y ≥ 4; 8 ≤ x ≤ 12.

## Common mistakes

- Taking the domain from the formula instead of from the situation (negative tickets, time after the tank is empty).
- Giving the range as "all outputs the formula could make" instead of the outputs the domain actually produces.
- Confusing domain (x-values) and range (y-values) when reading a graph.
- Using the wrong piece at a boundary input: check whether the inequality is strict.
- Thinking |x − 3| shifts the V to the left; the vertex is where the inside equals zero, x = 3.
- Writing |x| as "x without its sign" and then treating |x − 3| as x − 3 for negative x.

## Where this goes next

Week 18 reverses functions: if C gives cost from tickets, the inverse gives tickets from cost. The domain of one is the range of the other, so this week's vocabulary is needed throughout. Piecewise and absolute value graphs reappear in the unit exam and in unit 7's work with square roots.

## Self-check

1. T(n) = 25n is the cost of n tickets, at most 6 per buyer. Domain and range?
2. A graph runs from an open dot at (0, 1) to a filled dot at (5, 9), rising the whole way. Domain and range?
3. f(x) = 3x for x < 1 and f(x) = x + 2 for x ≥ 1. Find f(1) and f(−1).
4. What is the vertex of y = |x − 6| + 1, and what is its minimum value?
5. For which x is |x + 2| = 7?

*Answers:* (1) Whole numbers 0 to 6; range 0, 25, 50, 75, 100, 125, 150. (2) 0 < x ≤ 5; 1 < y ≤ 9. (3) f(1) = 3; f(−1) = −3. (4) (6, 1); minimum 1. (5) Distance 7 from −2: x = 5 or x = −9.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 4, Lessons 10–14, https://im.kendallhunt.com/HS/teachers/1/4/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
