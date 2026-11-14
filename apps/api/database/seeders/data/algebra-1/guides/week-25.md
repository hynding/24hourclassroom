# Week 25 · Quadratic Functions for Situations and Their Forms

**Lessons:** 6.5 Building Quadratic Functions to Describe Situations (Part 1) · 6.6 Building Quadratic Functions to Describe Situations (Part 2) · 6.7 Building Quadratic Functions to Describe Situations (Part 3) · 6.8 Equivalent Quadratic Expressions · 6.9 Standard Form and Factored Form
**Practices:** MP4 (model falling objects and revenue), MP2 (interpret each term of an expression in context), MP7 (see the structure in a product of two factors)
**Built from:** IM Algebra 1, Unit 6, Lessons 5–9, in our own words
**Spiral:** The second-difference test from week 24 confirms every table here is quadratic. Average rate of change (week 16) measures how a thrown ball slows. Function notation and domain (weeks 15 and 17) say what h(3) means and which inputs make sense. Equivalent expressions pick up the distributive property from unit 2.

## What you need to be able to do

- **6.5** Write the distance a dropped object has fallen as 16t² feet (about 5t² metres), write its height as h₀ − 16t², and explain why the table is quadratic.
- **6.6** Write the height of a launched object as h₀ + vt − 16t², read the starting height and launch speed from the expression, and find the maximum height from a table using symmetry.
- **6.7** Build a revenue function as price times quantity sold, find its zeros and its vertex, interpret them, and choose a domain that fits the situation.
- **6.8** Show that two quadratic expressions are equivalent by expanding with an area diagram or the distributive property.
- **6.9** Recognise and convert between the standard form ax² + bx + c and the factored form (x + p)(x + q).

## Key terms

| Term | Meaning |
|---|---|
| Free fall | Motion under gravity alone; the distance fallen in t seconds is about 16t² feet. |
| Launch speed | The upward speed at the moment of release, the coefficient v in h₀ + vt − 16t². |
| Vertex | The point of a quadratic function's graph where the output is greatest or least. |
| Zeros | Inputs that make the output 0. |
| Equivalent expressions | Expressions with the same value for every input. |
| Standard form | ax² + bx + c, with a ≠ 0. |
| Factored form | A product of two linear factors, such as (x + 3)(x − 2) or 2x(x − 5). |

## Falling objects (6.5)

Drop a rock and record how far it has fallen each second.

| t (s) | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| Distance fallen (ft) | 0 | 16 | 64 | 144 | 256 |

Every entry is 16 times a perfect square: d = 16t². The first differences 16, 48, 80, 112 grow by 32 each time, so the table is quadratic, and the growing differences say the rock is speeding up. In metres the rule is about 5t².

If the rock is dropped from a height of h₀ feet, its **height** after t seconds is the starting height minus the distance fallen: h(t) = h₀ − 16t². From a 400-foot bridge, h(t) = 400 − 16t²; the rock reaches the water when 16t² = 400, that is t² = 25, t = 5 seconds.

**Worked example.** An object is dropped from 576 feet. How high is it after 4 seconds, and when does it land?
After 4 seconds it has fallen 16 · 16 = 256 feet, so it is 576 − 256 = 320 feet up. It lands when 16t² = 576, so t² = 36 and t = 6 seconds.

**Try it.** How far does a dropped object fall during its third second (from t = 2 to t = 3)?
*Answer:* 144 − 64 = 80 feet.

## Launched objects (6.6)

Throw a ball upward instead of dropping it. Two things now push the height: the launch carries the ball up at v feet per second, contributing vt, and gravity still pulls it down by 16t². Starting from a height h₀:

h(t) = h₀ + vt − 16t².

For h(t) = 6 + 64t − 16t² the ball leaves a 6-foot platform at 64 feet per second. A table shows the flight:

| t (s) | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| h(t) (ft) | 6 | 54 | 70 | 54 | 6 |

The heights are symmetric: 54 at t = 1 and again at t = 3, 6 at t = 0 and t = 4. The maximum, 70 feet, sits halfway between matching heights, at t = 2. The ball rises as fast as it later falls, which is why the two halves mirror each other. The average rate of change from 0 to 1 is 48 feet per second; from 1 to 2 it is only 16: the ball slows as it climbs. The ball hits the ground a little after t = 4, when h(t) = 0.

**Worked example.** h(t) = 4 + 48t − 16t². Find the maximum height.
h(1) = 36 and h(2) = 36, so the peak is at t = 1.5: h(1.5) = 4 + 72 − 36 = 40 feet.

**Try it.** A ball is thrown from the ground at 32 feet per second: h(t) = 32t − 16t². When is it back on the ground, and what is its maximum height?
*Answers:* h(2) = 64 − 64 = 0, so after 2 seconds; the peak is at t = 1, h(1) = 16 feet.

## Revenue and the right domain (6.7)

A club finds that at a ticket price of p dollars it sells 200 − 10p tickets: raise the price and fewer people come. Revenue is price times quantity:

r(p) = p(200 − 10p) = 200p − 10p².

| p ($) | 0 | 5 | 10 | 15 | 20 |
|---|---|---|---|---|---|
| r(p) ($) | 0 | 750 | 1,000 | 750 | 0 |

The **zeros** are p = 0 (free tickets) and p = 20 (nobody buys). The **vertex** is halfway between them at p = 10, where revenue is $1,000, the most the club can make. The **domain** that makes sense is 0 ≤ p ≤ 20: a negative price or a negative number of tickets describes nothing.

The same three questions, zeros, vertex and domain, apply to every quadratic model. For a thrown ball, the zeros are the times at ground level, the vertex is the highest point, and the domain runs from the throw to the landing.

**Worked example.** Tickets at d dollars sell 300 − 50d. Find the best price.
r(d) = d(300 − 50d); zeros at d = 0 and d = 6; best price d = 3, revenue 3 · 150 = $450.

**Try it.** A bakery sells 120 − 20p dozen cookies at p dollars a dozen. Write R(p), find its zeros, and give the best price.
*Answers:* R(p) = 120p − 20p²; zeros 0 and 6; best price $3, revenue $180.

## Equivalent expressions (6.8)

Two expressions are equivalent when they agree for every input. A product of two linear factors can be expanded with an area diagram: a rectangle with sides x + 3 and x + 5 splits into four pieces.

```
        x       5
    +-------+------+
 x  |  x²   |  5x  |
    +-------+------+
 3  |  3x   |  15  |
    +-------+------+
```

So (x + 3)(x + 5) = x² + 5x + 3x + 15 = x² + 8x + 15. The distributive property says the same thing: multiply every term of the first factor by every term of the second. Watch the signs: (x − 2)(x + 6) = x² + 6x − 2x − 12 = x² + 4x − 12, and (x − 3)(x + 3) = x² + 3x − 3x − 9 = x² − 9, where the middle terms cancel.

Checking a single input can only show two expressions are **not** equivalent (x² + 15 and (x + 3)(x + 5) differ at x = 1: 16 against 24). To show they are equivalent, expand.

**Worked example.** Is 2x(x − 4) equivalent to 2x² − 8x? to 2x² − 4x?
2x · x − 2x · 4 = 2x² − 8x: yes to the first. The second drops the 2 from the second product, so no.

**Try it.** Expand (x − 1)(x − 7).
*Answer:* x² − 7x − x + 7 = x² − 8x + 7.

## Standard form and factored form (6.9)

Every quadratic expression can be written in **standard form** ax² + bx + c, where a ≠ 0. In 3x² − 5x + 2, a = 3, b = −5, c = 2; in x² − 9, b = 0. Many can also be written in **factored form**, a product of two linear factors: (x + 3)(x + 4), (x − 5)(x + 3), 2(x − 1)(x + 5).

Going from factored to standard form is expanding. Going the other way, for x² + bx + c, means finding two numbers whose product is c and whose sum is b:

- x² + 7x + 12: 3 · 4 = 12 and 3 + 4 = 7, so (x + 3)(x + 4).
- x² − 2x − 15: (−5)(3) = −15 and −5 + 3 = −2, so (x − 5)(x + 3).

Why keep both forms? Factored form shows at a glance which inputs make the expression 0: (x − 5)(x + 3) is 0 when x = 5 or x = −3. Standard form shows the value at x = 0, the constant c. Next week connects both facts to the graph.

**Worked example.** Write 2(x − 1)(x + 5) in standard form.
(x − 1)(x + 5) = x² + 5x − x − 5 = x² + 4x − 5; times 2 gives 2x² + 8x − 10.

**Try it.** Write x² + 9x + 20 in factored form.
*Answer:* 4 · 5 = 20 and 4 + 5 = 9: (x + 4)(x + 5).

## Common mistakes

- Writing h₀ − 16t for a dropped object; the loss grows with t², not t.
- Reading the starting height from the coefficient of t instead of the constant term.
- Taking the maximum height from the largest value in a table whose steps miss the peak; use symmetry to locate the vertex between equal outputs.
- Writing revenue as 200 − 10p (that is the number sold) instead of p(200 − 10p).
- Allowing every real number in the domain of a model; prices, times and quantities have limits.
- Expanding (x + 3)(x + 5) as x² + 15 and forgetting the middle terms.
- Mixing up which number is the product and which is the sum when factoring.

## Where this goes next

Week 26 draws the graphs: factored form gives the x-intercepts, standard form the y-intercept, and the coefficients a, b and c move the parabola about. Week 27 adds vertex form. Unit 7 solves quadratic equations such as h(t) = 0 exactly rather than by reading a table.

## Self-check

1. A stone is dropped from 144 feet. Write its height function and find when it lands.
2. In h(t) = 10 + 40t − 16t², what are the starting height and the launch speed? Find h(1) and h(2).
3. A stall sells 80 − 8p items at p dollars each. Write the revenue function, its zeros and the best price.
4. Expand (x + 4)(x − 6).
5. Write x² − 8x + 15 in factored form.

*Answers:* (1) h(t) = 144 − 16t²; 16t² = 144, t = 3 seconds. (2) 10 feet; 40 feet per second; h(1) = 34, h(2) = 26. (3) r(p) = p(80 − 8p) = 80p − 8p²; zeros 0 and 10; best price $5, revenue $200. (4) x² − 2x − 24. (5) (x − 3)(x − 5).

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 6, Lessons 5–9, https://im.kendallhunt.com/HS/teachers/1/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
