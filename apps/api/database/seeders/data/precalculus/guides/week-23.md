# Week 23 · Trigonometric Equations and Inequalities

**Topics:** 3.10 Trigonometric Equations and Inequalities
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 3, Topic 3.10, learning objectives in our own words
**Spiral:** Week 19's unit circle supplies every exact value you will need; week 22's inverse trigonometric functions give one solution, and the symmetry of the circle gives the rest. Week 20's graphs explain why an equation like sin x = k has two solutions per cycle, and week 21's sinusoidal models turn into "when is the height at least 29 m?" questions. From Unit 1: factoring quadratics and sign charts (weeks 4 and 6). From Unit 2: solving an equation by applying an inverse function (week 16).

## What you need to be able to do

- **3.10** Solve an equation such as sin x = k, cos x = k or tan x = k on a stated interval (usually [0, 2π)) by finding a reference angle and using the signs of the functions in each quadrant.
- **3.10** Write the general solution of a trigonometric equation by adding whole multiples of the period: + 2πn for sine and cosine, + πn for tangent, where n is any integer.
- **3.10** Use an inverse trigonometric function to get one solution of a non-special equation, and use the symmetry of the unit circle to get the others in the interval.
- **3.10** Solve equations with an inside multiplier, such as sin(2x) = k, by solving for the angle 2x over the stretched interval first.
- **3.10** Solve equations that are quadratic in sin x or cos x by factoring, and equations with a common trigonometric factor by factoring rather than dividing.
- **3.10** Solve a trigonometric inequality on an interval by finding where equality holds and then reading the graph or the unit circle to decide which pieces satisfy the inequality.
- **3.10** Describe the solutions of a trigonometric equation or inequality in a modelling context, with units, and use a graphing calculator's intersection feature when exact values are not available.

## Key terms

| Term | Meaning |
|---|---|
| Solution on an interval | A value of x in the stated interval, such as [0, 2π), that makes the equation true. |
| General solution | Every solution, written as a family such as x = π/6 + 2πn, where n is any integer. |
| Reference angle | The acute angle between the terminal ray and the x-axis; it fixes the size of the sine and cosine, and the quadrant fixes their signs. |
| Principal value | The single output of sin⁻¹, cos⁻¹ or tan⁻¹, which lies in that function's restricted range. |
| Quadratic in sine | An equation like 2 sin²x − sin x − 1 = 0, which is a quadratic once you call sin x a single letter u. |
| Boundary values | The solutions of the related equation; they split the interval into pieces where an inequality is entirely true or entirely false. |

## One equation, many solutions (3.10)

Algebra equations such as 3x − 5 = 7 usually have one answer. Trigonometric equations usually have infinitely many, because the functions repeat. On the graph, the horizontal line y = 1/2 crosses y = sin x twice in every cycle of length 2π: once while the sine is rising and once while it is falling.

So every trigonometric equation comes with a question: *solutions where?* A problem will say "on [0, 2π)" (find the ones in one cycle) or "find all solutions" (give the general solution).

**The three-step routine for sin x = k or cos x = k**

1. **Isolate** the trigonometric function, so that it equals a number k. If |k| > 1 for sine or cosine, there are no solutions; stop.
2. **Find the reference angle** from the absolute value |k| (a special angle from week 19, or sin⁻¹|k| from a calculator).
3. **Place the angle** in every quadrant where the function has the sign of k, then add the period if all solutions are wanted.

Recall the signs from week 19: sine (the y-coordinate) is positive in quadrants I and II; cosine (the x-coordinate) is positive in quadrants I and IV; tangent (their ratio) is positive in quadrants I and III.

**Worked example.** Solve sin x = −1/2 on [0, 2π), then give the general solution.

The reference angle for 1/2 is π/6. Sine is negative in quadrants III and IV. Quadrant III: π + π/6 = 7π/6. Quadrant IV: 2π − π/6 = 11π/6. So x = 7π/6 or x = 11π/6 on [0, 2π). The general solution is x = 7π/6 + 2πn or x = 11π/6 + 2πn, n any integer.

Notice that sin⁻¹(−1/2) = −π/6, which is not in [0, 2π) at all. Adding 2π gives 11π/6, one of the answers; the other comes from symmetry. An inverse function gives you a starting point, not the full list.

**Worked example.** Solve 2 cos x + √3 = 0 on [0, 2π).

Isolate: cos x = −√3/2. The reference angle for √3/2 is π/6. Cosine is negative in quadrants II and III: x = π − π/6 = 5π/6 and x = π + π/6 = 7π/6.

**Tangent has period π.** Because tan(x + π) = tan x, one solution plus multiples of π gives them all. For tan x = 1: the principal value is π/4, so x = π/4 + πn. On [0, 2π) that is π/4 and 5π/4.

**Worked example.** Find all solutions of tan x = −√3.

The principal value is tan⁻¹(−√3) = −π/3. The general solution is x = −π/3 + πn, which can also be written x = 2π/3 + πn (the same set, starting from a positive angle). On [0, 2π): 2π/3 and 5π/3.

**Try it.**
1. Solve cos x = 1/2 on [0, 2π).
2. Solve √2 sin x − 1 = 0 on [0, 2π).
3. Give the general solution of tan x = 1/√3.

*Answers:* 1. π/3 and 5π/3. 2. sin x = √2/2, so x = π/4 and 3π/4. 3. x = π/6 + πn.

## Non-special values and the calculator (3.10)

When k is not one of the special values, use the inverse function for one solution and symmetry for the rest. Keep the calculator in radian mode.

- **sin x = k:** x₁ = sin⁻¹ k and x₂ = π − sin⁻¹ k (the mirror image across the y-axis), then add 2πn.
- **cos x = k:** x₁ = cos⁻¹ k and x₂ = −cos⁻¹ k, or 2π − cos⁻¹ k (the mirror image across the x-axis), then add 2πn.
- **tan x = k:** x = tan⁻¹ k + πn.

**Worked example.** Solve cos x = 0.3 on [0, 2π), to three decimal places.

cos⁻¹(0.3) ≈ 1.266, which is in quadrant I. The other angle with the same cosine is 2π − 1.266 ≈ 5.017, in quadrant IV. Solutions: x ≈ 1.266 and x ≈ 5.017.

**Worked example.** Solve sin x = −0.6 on [0, 2π), to three decimal places.

sin⁻¹(−0.6) ≈ −0.644, not in the interval. Add 2π: 2π − 0.644 ≈ 5.640 (quadrant IV). The mirror solution is π − (−0.644) = π + 0.644 ≈ 3.785 (quadrant III). Solutions: x ≈ 3.785 and x ≈ 5.640.

**Graphing calculator check.** Graph y₁ = sin x and y₂ = −0.6 on the window 0 ≤ x ≤ 2π and use the intersection feature twice. You should see two crossings, near 3.785 and 5.640. This is also how you solve an equation that cannot be rearranged by hand, such as sin x = x/3; on the AP exam such an equation would appear only in a calculator-allowed section.

## Multiple angles: sin(bx) = k (3.10)

If the input is 2x, 3x or πt/6, solve for the whole input first, then divide. The key is that when x runs over [0, 2π), the input 2x runs over [0, 4π): two full cycles, so twice as many solutions.

**Worked example.** Solve sin(2x) = √3/2 on [0, 2π).

Let u = 2x. Then u runs over [0, 4π). sin u = √3/2 when u = π/3 or 2π/3, and again one cycle later: u = π/3 + 2π = 7π/3 and u = 2π/3 + 2π = 8π/3. Divide by 2: x = π/6, π/3, 7π/6, 4π/3. Four solutions, as expected from a function with period π on an interval of length 2π.

**Worked example.** Solve cos(x/2) = 0 on [0, 2π).

Let u = x/2, so u runs over [0, π). cos u = 0 only at u = π/2 in that range. So x = π. A horizontal stretch means fewer solutions in the same interval.

A quick count check: on an interval of length L, a sinusoid with period P completes L/P cycles, and a horizontal line strictly between the maximum and minimum crosses it twice per cycle.

**Try it.**
1. Solve cos(3x) = 1 on [0, 2π).
2. How many solutions does sin(4x) = 0.2 have on [0, 2π)?

*Answers:* 1. 3x = 0, 2π, 4π, so x = 0, 2π/3, 4π/3. 2. Period π/2, so four cycles, two crossings each: 8.

## Equations that factor (3.10)

**Quadratic in sine or cosine.** Treat sin x (or cos x) as a single unknown u, factor, and solve each factor.

**Worked example.** Solve 2 sin²x − sin x − 1 = 0 on [0, 2π).

With u = sin x: 2u² − u − 1 = (2u + 1)(u − 1) = 0. So sin x = −1/2 or sin x = 1.
sin x = −1/2 gives 7π/6 and 11π/6. sin x = 1 gives π/2. Solutions: π/2, 7π/6, 11π/6.

**A common factor: factor it, never divide by it.** Dividing both sides by cos x silently throws away every solution where cos x = 0.

**Worked example.** Solve 2 sin x cos x = cos x on [0, 2π).

Move everything to one side: 2 sin x cos x − cos x = 0, so cos x (2 sin x − 1) = 0.
cos x = 0 gives π/2 and 3π/2. 2 sin x − 1 = 0 gives sin x = 1/2: π/6 and 5π/6. Four solutions: π/6, π/2, 5π/6, 3π/2. A student who divides by cos x finds only π/6 and 5π/6.

**Using the Pythagorean identity to get one function.** If an equation mixes sin²x and cos x, replace sin²x by 1 − cos²x (or cos²x by 1 − sin²x), from sin²x + cos²x = 1 (week 19).

**Worked example.** Solve 2 cos²x + 3 sin x − 3 = 0 on [0, 2π).

Replace cos²x: 2(1 − sin²x) + 3 sin x − 3 = 0, so −2 sin²x + 3 sin x − 1 = 0, or 2 sin²x − 3 sin x + 1 = 0. Factor: (2 sin x − 1)(sin x − 1) = 0. sin x = 1/2 gives π/6, 5π/6; sin x = 1 gives π/2. Solutions: π/6, π/2, 5π/6.

**Try it.**
1. Solve 2 cos²x − cos x − 1 = 0 on [0, 2π).
2. Solve sin x tan x = sin x on [0, 2π).

*Answers:* 1. (2 cos x + 1)(cos x − 1) = 0: cos x = −1/2 gives 2π/3, 4π/3; cos x = 1 gives 0. 2. sin x (tan x − 1) = 0: sin x = 0 gives 0, π; tan x = 1 gives π/4, 5π/4 (all have tan defined).

## Trigonometric inequalities (3.10)

An inequality such as sin x ≥ 1/2 is solved like a polynomial inequality with a sign chart (week 4):

1. Solve the **equation** to get the boundary values in the interval.
2. The boundary values cut the interval into pieces. On each piece the inequality is either always true or always false (the functions are continuous where defined).
3. Decide each piece from the graph, the unit circle, or a test value. For tangent, the vertical asymptotes are boundaries too.

**Worked example.** Solve sin x ≥ 1/2 on [0, 2π).

Boundaries: sin x = 1/2 at π/6 and 5π/6. Between them the sine graph is above 1/2 (test π/2: sin = 1). Outside them it is below. Solution: π/6 ≤ x ≤ 5π/6, or [π/6, 5π/6].

**Worked example.** Solve 2 cos x + 1 > 0 on [0, 2π).

cos x > −1/2. Boundaries: cos x = −1/2 at 2π/3 and 4π/3. Test x = 0: cos 0 = 1 > −1/2, true. Test x = π: cos π = −1, false. Test x = 3π/2: cos = 0, true. Solution: [0, 2π/3) ∪ (4π/3, 2π).

**Worked example.** Solve tan x > 1 on [0, 2π).

Boundaries: tan x = 1 at π/4 and 5π/4; asymptotes at π/2 and 3π/2. Tangent increases on each branch, so it is above 1 just to the right of π/4 until the asymptote. Solution: (π/4, π/2) ∪ (5π/4, 3π/2).

## A modelling example (3.10)

**Worked example.** A Ferris wheel is modelled (hypothetically) by h(t) = 20 − 18 cos(πt/5), where h is a rider's height in metres and t is minutes after boarding at the bottom. For how long during each revolution is the rider at least 29 m above the ground?

The period is 2π/(π/5) = 10 minutes. Solve h(t) ≥ 29: 20 − 18 cos(πt/5) ≥ 29, so −18 cos(πt/5) ≥ 9 and cos(πt/5) ≤ −1/2 (dividing by −18 reverses the inequality). Let u = πt/5, running over [0, 2π) for one revolution. cos u ≤ −1/2 when 2π/3 ≤ u ≤ 4π/3, so 10/3 ≤ t ≤ 20/3. The rider is at least 29 m up for 20/3 − 10/3 = 10/3 ≈ 3.33 minutes of each 10-minute revolution, from about 3 min 20 s to 6 min 40 s after boarding.

Interpretation matters on the AP exam: give the interval *and* its meaning in context (time, in minutes, during which the height is at least 29 m).

**Try it.**
1. Solve cos x ≤ 0 on [0, 2π).
2. Solve sin x < −√3/2 on [0, 2π).
3. For the Ferris wheel above, during what times in the first revolution is the rider below 11 m?

*Answers:* 1. [π/2, 3π/2]. 2. (4π/3, 5π/3). 3. 20 − 18 cos(πt/5) < 11 gives cos(πt/5) > 1/2, so u in [0, π/3) or (5π/3, 2π): 0 ≤ t < 5/3 or 25/3 < t < 10 minutes.

## Calculator notes

- Use radian mode. A degree-mode answer of 30 for sin⁻¹(0.5) is the classic slip.
- The inverse keys return one principal value: sin⁻¹ in [−π/2, π/2], cos⁻¹ in [0, π], tan⁻¹ in (−π/2, π/2). You must find the other solutions yourself.
- To solve f(x) = k graphically, graph both sides and use *intersect*, or graph f(x) − k and use *zero*. Set the window to the stated interval so you do not miss or add solutions.
- For inequalities, the graph shows which pieces are above or below the line; the calculator gives the boundary values.
- Without a calculator, AP questions stay with the special angles: multiples of π/6 and π/4.

## Common mistakes

- **Stopping at the inverse function's answer.** sin⁻¹(1/2) = π/6, but 5π/6 is also a solution on [0, 2π).
- **Dividing by sin x or cos x.** Factor instead, or you lose the solutions where that factor is zero.
- **Forgetting the stretched interval.** For sin(2x) = k on [0, 2π), solve 2x on [0, 4π), then divide.
- **Using + 2πn for tangent.** Tangent repeats every π; x = π/4 + 2πn misses 5π/4.
- **Reversing an inequality incorrectly.** Dividing by a negative number reverses it; taking cos⁻¹ of both sides also reverses it, because cos⁻¹ is decreasing.
- **Writing |k| > 1 solutions.** sin x = 1.2 has no real solutions.

## Where this goes next

Week 24 adds the reciprocal functions and the identities (Pythagorean, sum and difference, double-angle). Many equations that look unsolvable, such as sin(2x) = sin x, become factorable once an identity rewrites them. Weeks 25 and 26 use the same equation-solving skills to find where a polar curve passes through the origin (r = 0) and where r is largest.

## Self-check

1. Solve 2 sin x + 1 = 0 on [0, 2π) and write the general solution.
2. Solve tan(2x) = 1 on [0, 2π).
3. Solve cos²x − cos x = 0 on [0, 2π) and explain why dividing by cos x would be wrong.
4. Solve cos x > √2/2 on [0, 2π).
5. A hypothetical model of water depth is d(t) = 5 + 3 sin(πt/6), t in hours. During what times in [0, 12) is the depth more than 6.5 m?

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 3, Topic 3.10). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
