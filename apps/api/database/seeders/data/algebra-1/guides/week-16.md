# Week 16 · Features of Graphs and Average Rate of Change

**Lessons:** 4.6 Features of Graphs · 4.7 Using Graphs to Find Average Rate of Change · 4.8 Interpreting and Creating Graphs · 4.9 Comparing Graphs
**Practices:** MP2 (connect a feature of a graph to a fact about the situation), MP4 (sketch a graph that fits a story), MP6 (state intervals and rates with units)
**Built from:** IM Algebra 1, Unit 4, Lessons 6–9, in our own words
**Spiral:** The slope of a line (unit 2) was a constant rate. The average rate of change extends the same formula, change in output over change in input, to any function over any interval. Interpreting intercepts in context continues the unit 3 habit of reading a model.

## What you need to be able to do

- **4.6** Identify and interpret the key features of a graph: intercepts, maximum and minimum values, and intervals where the function is increasing, decreasing or constant.
- **4.7** Compute the average rate of change of a function between two inputs from a graph, table or rule, and interpret it with units.
- **4.8** Interpret a graph of a situation in detail and sketch a graph from a verbal description, including the shape of each stage.
- **4.9** Compare two functions presented in different ways (graph, table, rule, description) on their features and rates.

## Key terms

| Term | Meaning |
|---|---|
| Vertical intercept | The output when the input is 0; the point where the graph meets the vertical axis, written f(0). |
| Horizontal intercept (zero) | An input where the output is 0; where the graph meets the horizontal axis; a solution of f(x) = 0. |
| Maximum / minimum | The largest / smallest output the function takes; also used for the high or low point of a local hill or valley. |
| Increasing on an interval | As the input moves right through the interval, the output rises. |
| Decreasing on an interval | As the input moves right, the output falls. |
| Average rate of change from a to b | (f(b) − f(a))/(b − a): the slope of the line through (a, f(a)) and (b, f(b)). |

## Features of graphs (4.6)

Take h(t), the height in metres of a drone t minutes after launch, with this graph: starts at (0, 0), rises to a peak of 60 m at t = 4, descends to 20 m at t = 7, holds at 20 m until t = 10, then descends to the ground at t = 12.

- **Vertical intercept** h(0) = 0: the drone starts on the ground.
- **Horizontal intercepts** t = 0 and t = 12: the drone is on the ground at launch and at landing. (Solutions of h(t) = 0.)
- **Maximum** 60 m at t = 4: the highest point of the flight.
- **Increasing** on 0 < t < 4; **decreasing** on 4 < t < 7 and 10 < t < 12; **constant** on 7 < t < 10 (hovering).

Each feature answers a different question: "where did it start?" (vertical intercept), "when was it on the ground?" (zeros), "how high did it get?" (maximum), "when was it climbing?" (increasing interval).

**Worked example.** The graph of a company's profit P(m) in thousands, m months into the year, crosses the horizontal axis at m = 3 and m = 9, has a low of −8 at m = 1 and a high of 20 at m = 6. Interpret.
P(3) = 0 and P(9) = 0: the company broke even in months 3 and 9. The minimum −8 at m = 1: the worst month lost $8,000. The maximum 20 at m = 6: the best month earned $20,000. Profit was positive between months 3 and 9.

**Try it.** For the drone, on which intervals is h(t) > 20?
*Answer:* Between the time it passes 20 m on the way up (before t = 4) and t = 7, when it comes back down to 20; it never exceeds 20 after that.

## Average rate of change (4.7)

Between two inputs a and b, the average rate of change of f is

**(f(b) − f(a)) ÷ (b − a)**,

the slope of the line segment joining the two points. For a line it is the slope everywhere; for a curve it depends on which interval you pick.

**Worked example.** The drone: from t = 0 to t = 4, (60 − 0)/(4 − 0) = 15 m per minute (climbing). From t = 4 to t = 7, (20 − 60)/(7 − 4) = −40/3 ≈ −13.3 m per minute (descending). From t = 7 to t = 10, 0 m per minute (hovering). From t = 0 to t = 12, (0 − 0)/12 = 0: over the whole flight the net change is zero, even though the drone moved a lot.

**Worked example.** A town's population: P(2000) = 12,400 and P(2020) = 15,600. Average rate of change = 3,200/20 = 160 people per year.

**From a table.** Values of f: f(1) = 5, f(3) = 11, f(6) = 14. From 1 to 3: 6/2 = 3 per unit. From 3 to 6: 3/3 = 1 per unit. The function grew faster over the first interval.

**Try it.** g(x) = x². Find the average rate of change from x = 1 to x = 3 and from x = 3 to x = 5.
*Answers:* (9 − 1)/2 = 4; (25 − 9)/2 = 8. The curve gets steeper.

## Interpreting and creating graphs (4.8)

To read a story from a graph, go left to right and describe each piece: rising fast, rising slowly, flat, falling. To draw a graph from a story, mark the key points first (start, turning points, end), then connect them with pieces of the right shape.

**Worked example.** "Lin walks to the library, 1.5 km away, in 20 minutes, spends 40 minutes there, then jogs home in 10 minutes." Distance from home against time: a segment from (0, 0) up to (20, 1.5); flat at 1.5 until t = 60; a steeper segment down to (70, 0). The jog is steeper than the walk because the same distance is covered in less time.

**Worked example.** A graph of a cup of coffee's temperature starts at 90 °C and falls steeply at first, then more and more slowly, levelling out near 20 °C. Interpret: the coffee cools fastest when it is hottest and approaches room temperature, 20 °C, without going below it.

**Try it.** Sketch in words: the height of water in a cone-shaped cup being filled at a steady rate (point of the cone at the bottom).
*Answer:* Rises quickly at first (the narrow tip fills fast) and more slowly as the cup widens: an increasing curve that flattens.

## Comparing graphs (4.9)

Two functions can be compared on any feature: which starts higher (vertical intercepts), which reaches its maximum first, which grows faster over an interval (average rate of change), where one overtakes the other (where the graphs cross).

**Worked example.** Two savings accounts: A(m) = 50 + 20m from a rule; B is given by a table: B(0) = 200, B(6) = 260, B(12) = 320. Compare.
A starts at 50, B at 200. A's rate is 20 per month; B's average rate is 60/6 = 10 per month. A overtakes B when 50 + 20m = 200 + 10m, so m = 15 months. Before month 15, B is larger; after, A is.

**Try it.** Runner X finishes 5 km in 25 minutes at a steady pace; runner Y's graph of distance against time starts steeper than X's but flattens and finishes at 28 minutes. Who was ahead at 5 minutes? Who finished first?
*Answers:* Y (steeper start means more distance early); X (25 < 28).

## Common mistakes

- Reporting the input where the maximum occurs when the question asks for the maximum value (or the reverse).
- Describing an increasing interval by the outputs ("from 0 to 60") rather than the inputs ("from t = 0 to t = 4").
- Computing the average rate of change as f(b) − f(a) without dividing by b − a, or dividing the other way round.
- Drawing a flat segment for "walks slowly" (slow means a gentle slope, not zero slope).
- Comparing two functions by a single value when the question is about rates.

## Where this goes next

Week 17 names the set of allowed inputs (domain) and possible outputs (range), and introduces functions built in pieces and the absolute value function, whose graph has the sharp corner you may have noticed in distance-from-home graphs. Average rate of change returns in unit 5 to contrast linear and exponential growth.

## Self-check

1. A graph of f has f(0) = 4, zeros at x = 2 and x = 8, a maximum of 10 at x = 5. Between which inputs is f positive?
2. Find the average rate of change of f(x) = 3x + 1 from x = 2 to x = 10.
3. Find the average rate of change of g(x) = x² − 1 from x = 0 to x = 4.
4. A bath's depth graph is flat from t = 8 to t = 28. What is happening?
5. Account P: starts at 100, gains 25 a month. Account Q: starts at 400, gains 10 a month. When are they equal?

*Answers:* (1) 2 < x < 8. (2) (31 − 7)/8 = 3. (3) (15 − (−1))/4 = 4. (4) The depth is constant: the water is neither filling nor draining. (5) 100 + 25m = 400 + 10m, m = 20 months.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 4, Lessons 6–9, https://im.kendallhunt.com/HS/teachers/1/4/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
