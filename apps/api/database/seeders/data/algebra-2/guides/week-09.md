# Week 09 · Rational Equations

**Lessons:** 2.20 Rational Equations (Part 1) · 2.21 Rational Equations (Part 2) · 2.22 Solving Rational Equations
**Practices:** MP1 (make sense of problems), MP4 (model with mathematics), MP6 (attend to precision)
**Built from:** IM Algebra 2, Unit 2, Lessons 20–22, in our own words
**Spiral:** Domains of rational functions (week 8) explain extraneous solutions. Factoring and the zero product property (weeks 5–6) finish most of the equations. From Algebra 1: solving linear and quadratic equations, and the relationship distance = rate × time.

## What you need to be able to do

- **2.20** Write a rational equation from a situation (an average, a speed, a concentration, a shared job) and solve it by graphing or by clearing denominators.
- **2.21** Solve more complicated rational equations, including ones that lead to quadratics, by multiplying both sides by the least common denominator and factoring.
- **2.22** Recognise extraneous solutions: values that appear from the cleared equation but make an original denominator zero, and explain why multiplying by an expression that can be zero introduces them.

## Key terms

| Term | Meaning |
|---|---|
| Rational equation | An equation containing at least one fraction whose denominator has the variable. |
| Clearing denominators | Multiplying both sides by a common multiple of the denominators to get a polynomial equation. |
| Least common denominator (LCD) | The smallest expression every denominator divides; for 1/(x − 2) and 3/x it is x(x − 2). |
| Extraneous solution | A solution of the cleared polynomial equation that is not a solution of the original equation, because it makes a denominator 0. |
| Restriction | A value excluded from the domain before solving: for 1/(x − 2), x ≠ 2. |

## Equations from situations (2.20)

**An average.** A basketball player has made 18 of 30 free throws (60%). How many consecutive free throws must she make to reach 75%?

If she makes x more, she has made 18 + x of 30 + x: (18 + x)/(30 + x) = 0.75. Clear the denominator: 18 + x = 0.75(30 + x) = 22.5 + 0.75x, so 0.25x = 4.5 and x = 18. Check: 36/48 = 0.75.

**A speed.** A boat travels 24 km upstream and 24 km back. The river flows at 2 km/h and the whole trip takes 5 hours. How fast does the boat go in still water?

Let the still-water speed be s. Upstream the speed is s − 2, downstream s + 2, and time = distance/speed:

24/(s − 2) + 24/(s + 2) = 5.

Multiply by (s − 2)(s + 2): 24(s + 2) + 24(s − 2) = 5(s − 2)(s + 2), so 48s = 5(s² − 4) = 5s² − 20, giving 5s² − 48s − 20 = 0. Factor: (5s + 2)(s − 10) = 0, so s = 10 or s = −2/5. A speed must be positive, so s = 10 km/h. Check: 24/8 + 24/12 = 3 + 2 = 5 hours.

**A concentration.** A 10-litre tank holds a 20% salt solution (2 litres of salt). How much pure water must be added to make it 8%?

Adding w litres of water gives 2/(10 + w) = 0.08. So 2 = 0.08(10 + w) = 0.8 + 0.08w, and w = 15 litres. Check: 2/25 = 0.08.

Each equation came from a quantity that is naturally a fraction: a proportion, a time, a concentration. Graphing both sides and finding the intersection is a valid alternative to algebra and a good check.

**Try it.**
1. A student has 42 points out of 60 on quizzes. How many consecutive full-credit 10-point quizzes would bring the average to 80%?
2. A cyclist rides 30 km with a 3 km/h tailwind and returns against it in a total of 4.5 hours. Write the equation for her still-air speed s (do not solve).

*Answers:* 1. (42 + 10n)/(60 + 10n) = 0.8 → 42 + 10n = 48 + 8n → n = 3. 2. 30/(s + 3) + 30/(s − 3) = 4.5.

## Clearing denominators (2.21)

The method for any rational equation:

1. Note the **restrictions**: values that make any denominator 0.
2. Find the LCD and multiply **every term** on both sides by it.
3. Simplify to a polynomial equation and solve (factor, quadratic formula, or technology).
4. **Check** each solution against the restrictions and, ideally, in the original equation.

**Worked example.** Solve 3/x + 1/(x − 2) = 2.

Restrictions: x ≠ 0, 2. LCD x(x − 2). Multiply: 3(x − 2) + x = 2x(x − 2), so 3x − 6 + x = 2x² − 4x, which gives 2x² − 8x + 6 = 0, or x² − 4x + 3 = 0, so (x − 1)(x − 3) = 0. Solutions x = 1 and x = 3; neither is restricted. Check x = 1: 3 + (−1) = 2 ✓. Check x = 3: 1 + 1 = 2 ✓.

**Worked example.** Solve (x + 1)/(x − 3) = 4/(x − 3) + 2.

Restriction: x ≠ 3. Multiply by (x − 3): x + 1 = 4 + 2(x − 3) = 2x − 2, so x = 3. But 3 is restricted. The equation has **no solution**. (Graphing confirms it: the two sides are curves that never meet; both have a vertical asymptote at x = 3.)

**Worked example.** Solve 2/(x + 1) = (x − 1)/4.

Cross-multiplying (which is clearing both denominators at once): 8 = (x + 1)(x − 1) = x² − 1, so x² = 9 and x = ±3. Restriction x ≠ −1; both survive. Check x = 3: 2/4 = 2/4 ✓. Check x = −3: 2/(−2) = −1 and (−4)/4 = −1 ✓.

**Try it.**
1. Solve 5/(x + 2) = 3/(x − 4).
2. Solve 1/x + 1/(x + 1) = 7/12.

*Answers:* 1. 5(x − 4) = 3(x + 2) → 5x − 20 = 3x + 6 → x = 13. 2. 12(x + 1) + 12x = 7x(x + 1) → 7x² − 17x − 12 = 0 → (7x + 4)(x − 3) = 0 → x = 3 or x = −4/7; both allowed.

## Extraneous solutions (2.22)

Why can a correct-looking method produce a wrong answer? Multiplying both sides of an equation by a number that is **not zero** keeps the solutions the same. But x − 3 is an expression that is zero at x = 3, and multiplying by zero turns any equation into 0 = 0, which is true. So the cleared equation can gain the value that makes the multiplier zero. That gained value is **extraneous**.

In the second worked example above, multiplying by (x − 3) produced x = 3; the original equation is undefined there. The symptom is always the same: the candidate makes a denominator zero. Writing the restrictions down **before** you clear denominators means you catch it automatically.

**Worked example.** Solve x/(x − 4) − 2 = 4/(x − 4).

Restriction x ≠ 4. Multiply by (x − 4): x − 2(x − 4) = 4 → x − 2x + 8 = 4 → −x = −4 → x = 4. Extraneous. No solution.

**Worked example.** Solve (x² − 4)/(x − 2) = 5.

Restriction x ≠ 2. Multiply: x² − 4 = 5(x − 2) = 5x − 10 → x² − 5x + 6 = 0 → (x − 2)(x − 3) = 0 → x = 2 or 3. x = 2 is extraneous; the solution is x = 3. Note the left side simplifies to x + 2 for x ≠ 2, and x + 2 = 5 gives x = 3 directly.

**Worked example.** Solve 6/(x² − 9) = 1/(x − 3) + 1/(x + 3).

Restrictions x ≠ ±3. LCD (x − 3)(x + 3). Multiply: 6 = (x + 3) + (x − 3) = 2x, so x = 3. Extraneous: no solution.

A rational equation can have two solutions, one, or none, and can produce candidates that must be thrown out. State what you rejected and why.

**Try it.**
1. Solve 1/(x − 1) + 2 = x/(x − 1).
2. Solve (x + 5)/(x + 1) = 3 + 4/(x + 1).

*Answers:* 1. 1 + 2(x − 1) = x → x = 1, extraneous: no solution. 2. x + 5 = 3(x + 1) + 4 → x + 5 = 3x + 7 → x = −1, extraneous: no solution.

## Common mistakes

- **Multiplying only some terms by the LCD.** Every term on both sides gets multiplied, including whole numbers like the 2 in 3/x + 1/(x − 2) = 2.
- **Forgetting restrictions** and reporting an extraneous value as a solution.
- **Rejecting a valid negative solution** when nothing in the problem forbids it. In 2/(x + 1) = (x − 1)/4, x = −3 is fine; in the boat problem, s = −2/5 is not because speed is positive.
- **Cancelling before clearing.** (x² − 4)/(x − 2) = x + 2 only for x ≠ 2; the restriction still applies.
- **Writing time = speed/distance.** Time is distance divided by speed.

## Where this goes next

Week 10 closes the unit with polynomial identities and the formula for a geometric series. Rational equations return when exponential models are solved in Unit 4 and when trigonometric equations are set up in Unit 6; the discipline of recording restrictions first is the habit that transfers.

## Self-check

1. A team has won 12 of 20 games. How many consecutive wins would raise its winning percentage to 70%?
2. Solve 2/(x − 1) + 3/x = 2, giving all solutions.
3. Solve (2x)/(x + 3) = 1 − 6/(x + 3) and explain what happens.
4. Explain, in your own words, why multiplying by (x − 1) can create an extraneous solution.
5. A plane flies 600 km with a 50 km/h tailwind and returns against the same wind, taking 5 hours in total. Find its still-air speed.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 2, Lessons 20–22, https://im.kendallhunt.com/HS/teachers/3/2/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
