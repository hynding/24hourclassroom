# Week 16 · Exponential and Logarithmic Equations and Inequalities

**Topics:** 2.13 Exponential and Logarithmic Equations and Inequalities
**Practices:** 1 (procedural and symbolic fluency), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 2, Topic 2.13, learning objectives in our own words
**Spiral:** Week 14's conversion between log_b c = a and bᵃ = c is the basic move for every equation this week. Week 15's product, quotient and power properties let you condense logs and bring exponents down. Week 13's method for finding inverses (swap the variables, solve for the new output) is applied to exponential and log functions. Week 6's habit of checking restrictions after solving a rational equation returns as checking for extraneous solutions. Week 12's exponential models supply the contexts.

## What you need to be able to do

- **2.13** Solve exponential equations by rewriting both sides with a common base when possible, and otherwise by isolating the exponential and taking a logarithm of both sides.
- **2.13** Solve equations that are quadratic in an exponential, such as e^(2x) − 5eˣ + 6 = 0, by substitution.
- **2.13** Solve logarithmic equations by isolating a single log (condensing with the properties if needed) and rewriting in exponential form, then check every candidate in the original equation and reject extraneous solutions.
- **2.13** Solve exponential and logarithmic inequalities using the fact that these functions are monotonic, reversing the inequality when the base is between 0 and 1, and respecting the domain of a logarithm.
- **2.13** Find the inverse of an exponential or logarithmic function algebraically, and state the domain and range of both.
- **2.13** Interpret solutions in context, with units, and give exact and decimal forms as appropriate.

## Key terms

| Term | Meaning |
|---|---|
| Exponential equation | An equation with the unknown in an exponent, such as 3·2ˣ = 48. |
| Logarithmic equation | An equation with the unknown inside a logarithm, such as log₂(x − 1) = 3. |
| Isolate | Rearrange so that the exponential (or the logarithm) stands alone on one side. |
| Extraneous solution | A value produced by correct algebra that does not satisfy the original equation, usually because it makes a log argument zero or negative. |
| Monotonic | Always increasing or always decreasing. bˣ and log_b x are increasing for b > 1 and decreasing for 0 < b < 1. |
| Exact form | An answer written with logs, such as x = ln 40 / ln 5, rather than a decimal approximation. |

## Exponential equations (2.13)

The guiding idea: an exponential function is one-to-one, so **bᵘ = bᵛ exactly when u = v**, and when the unknown is stuck in an exponent, a logarithm brings it down.

### Method 1: a common base

If both sides are powers of the same number, rewrite them and set the exponents equal.

**Worked example.** Solve 2^(x+1) = 8^(x−1).

8 = 2³, so the right side is 2^(3(x−1)) = 2^(3x−3). Then x + 1 = 3x − 3, so 2x = 4 and x = 2. Check: 2³ = 8 and 8¹ = 8.

**Worked example.** Solve 9ˣ = 1/27.

9ˣ = 3^(2x) and 1/27 = 3⁻³, so 2x = −3 and x = −3/2.

### Method 2: isolate, then take a logarithm

When there is no common base, isolate the exponential expression first (undo any addition and multiplication outside it), then either rewrite in log form or take ln of both sides.

**Worked example.** Solve 5ˣ = 40 exactly and to three decimal places.

x = log₅ 40 = ln 40 / ln 5 ≈ 2.292. (Week 14 estimated it between 2 and 3; now it is pinned down.)

**Worked example.** Solve 3 · 2ˣ − 4 = 20.

Isolate: 3 · 2ˣ = 24, so 2ˣ = 8 and x = 3. A common mistake is to "take logs" before isolating; log(3 · 2ˣ − 4) cannot be split.

**Worked example.** A hypothetical model gives the number of users of a service as N(t) = 4e^(0.2t) thousand, t months after launch. When does N reach 30 thousand?

4e^(0.2t) = 30, so e^(0.2t) = 7.5. Take ln: 0.2t = ln 7.5, so t = 5 ln 7.5 ≈ 10.07. About 10.1 months after launch.

**Worked example.** Solve 3ˣ = 2^(x+1).

Take ln of both sides and use the power property: x ln 3 = (x + 1) ln 2. Collect the x terms: x ln 3 − x ln 2 = ln 2, so x(ln 3 − ln 2) = ln 2 and x = ln 2 / (ln 3 − ln 2) = ln 2 / ln 1.5 ≈ 1.710. When the unknown appears in exponents on both sides with different bases, this is the pattern: logs, expand, collect, factor.

### Method 3: equations quadratic in an exponential

Since e^(2x) = (eˣ)² and 4ˣ = (2ˣ)², some equations become quadratics after a substitution.

**Worked example.** Solve e^(2x) − 5eˣ + 6 = 0.

Let u = eˣ: u² − 5u + 6 = 0, so (u − 2)(u − 3) = 0 and u = 2 or 3. Then eˣ = 2 gives x = ln 2, and eˣ = 3 gives x = ln 3.

**Worked example.** Solve 4ˣ − 2^(x+1) − 8 = 0.

4ˣ = (2ˣ)² and 2^(x+1) = 2 · 2ˣ. With u = 2ˣ: u² − 2u − 8 = 0, so (u − 4)(u + 2) = 0. u = 4 gives x = 2. u = −2 is impossible, because 2ˣ is always positive, so it gives no solution.

**Try it.**
1. Solve 25^(x−1) = 125.
2. Solve 7 · 10^(2t) = 350 exactly.
3. Solve 2e^(0.5x) + 1 = 9, exactly and to the nearest hundredth.
4. Solve e^(2x) − e^x − 12 = 0.

*Answers:* 1. 5^(2x−2) = 5³, so 2x − 2 = 3 and x = 5/2. 2. 10^(2t) = 50, so t = (log 50)/2 ≈ 0.849. 3. e^(0.5x) = 4, x = 2 ln 4 = 4 ln 2 ≈ 2.77. 4. (eˣ − 4)(eˣ + 3) = 0, so eˣ = 4 and x = ln 4; eˣ = −3 has no solution.

## Logarithmic equations and extraneous solutions (2.13)

To solve an equation with the unknown inside a logarithm:

1. Use the properties to combine everything into a single log on one side (or one log on each side).
2. Rewrite log_b M = c as M = bᶜ, or use log_b M = log_b N ⟹ M = N (the log function is one-to-one).
3. Solve the resulting equation.
4. **Check every candidate in the original equation.** Every log argument must be positive.

**Worked example.** Solve log₂(x − 1) = 3.

x − 1 = 2³ = 8, so x = 9. Check: log₂ 8 = 3.

**Worked example.** Solve log₂ x + log₂(x − 2) = 3.

Condense: log₂(x(x − 2)) = 3, so x(x − 2) = 8, x² − 2x − 8 = 0 and (x − 4)(x + 2) = 0. Candidates: 4 and −2.
Check x = 4: log₂ 4 + log₂ 2 = 2 + 1 = 3. ✓
Check x = −2: log₂(−2) is undefined. Reject it; it is extraneous.
Solution: x = 4.

Why did −2 appear? The original equation is defined only for x > 2 (both arguments positive), but the condensed equation log₂(x(x − 2)) = 3 is defined wherever x(x − 2) > 0, which includes x < 0. Using the product property enlarged the domain, and the algebra found a solution in the extra part.

**Worked example.** Solve ln(x + 1) − ln(x − 1) = ln 3.

ln((x + 1)/(x − 1)) = ln 3, so (x + 1)/(x − 1) = 3, x + 1 = 3x − 3 and x = 2. Check: ln 3 − ln 1 = ln 3. ✓

**Worked example.** Solve log(x²) = 2, and compare with 2 log x = 2.

log(x²) = 2 means x² = 100, so x = 10 or x = −10. Both check, since (−10)² = 100 > 0. But 2 log x = 2 means log x = 1, so x = 10 only. Rewriting log(x²) as 2 log x before solving would have lost the solution −10. The domain matters in both directions: rewriting can add false solutions or lose true ones.

**Worked example.** Solve 2 log₃(x + 1) = 4 − log₃ 9.

First evaluate the constant log: log₃ 9 = 2, so 2 log₃(x + 1) = 2, log₃(x + 1) = 1, x + 1 = 3 and x = 2. Check: 2 log₃ 3 = 2 = 4 − 2. ✓

**Try it.**
1. Solve ln(2x − 3) = 0.
2. Solve log₆ x + log₆(x + 5) = 2, and identify any extraneous candidate.
3. Solve log(2x + 1) = log(x + 4).

*Answers:* 1. 2x − 3 = e⁰ = 1, so x = 2. 2. x(x + 5) = 36, x² + 5x − 36 = 0, (x + 9)(x − 4) = 0; x = 4 works, x = −9 is extraneous. 3. 2x + 1 = x + 4, so x = 3; both arguments equal 7 > 0.

## Inequalities (2.13)

Because bˣ and log_b x are monotonic, you can apply them (or their inverses) to both sides of an inequality, as long as you track the direction:

- If b > 1, the functions are increasing: u < v ⟺ bᵘ < bᵛ ⟺ log_b u < log_b v (for positive u, v).
- If 0 < b < 1, they are decreasing, and **the inequality reverses**.
- Dividing by a negative number, such as ln 0.8 ≈ −0.223, also reverses the inequality.
- For a log inequality, the argument must be positive, which adds a second condition.

**Worked example.** Solve 3ˣ > 20.

ln is increasing, so x ln 3 > ln 20 and x > ln 20 / ln 3 ≈ 2.727.

**Worked example.** A hypothetical medication level is 100(0.8)ᵗ percent of the initial dose after t hours. When is it below 25%?

100(0.8)ᵗ < 25 ⟺ (0.8)ᵗ < 0.25. Take ln: t ln 0.8 < ln 0.25. Since ln 0.8 < 0, dividing flips the inequality: t > ln 0.25 / ln 0.8 ≈ 6.21. So after about 6.21 hours. This matches intuition: a decaying quantity stays below a level once it passes it.

**Worked example.** Solve log₂(x − 3) ≤ 4.

Domain: x − 3 > 0, so x > 3. Since log₂ is increasing, x − 3 ≤ 2⁴ = 16, so x ≤ 19. Solution: 3 < x ≤ 19.

**Worked example.** Solve log_(1/2) x > −3.

The base 1/2 makes the log decreasing, so applying (1/2)^(…) reverses the inequality: x < (1/2)⁻³ = 8. With the domain x > 0, the solution is 0 < x < 8.

**Try it.**
1. Solve 5 · 2ˣ ≤ 160.
2. Solve (1/3)ˣ ≥ 9.
3. Solve ln(x + 2) < 1.

*Answers:* 1. 2ˣ ≤ 32, x ≤ 5. 2. 3⁻ˣ ≥ 3², so −x ≥ 2 and x ≤ −2. 3. 0 < x + 2 < e, so −2 < x < e − 2 ≈ 0.718.

## Inverses of exponential and logarithmic functions (2.13)

Use week 13's procedure: write y = f(x), swap x and y, and solve for y. The tools from this week do the solving.

**Worked example.** Find the inverse of f(x) = 3 · 2^(x−1) + 5, with domains and ranges.

Swap: x = 3 · 2^(y−1) + 5. Isolate the exponential: (x − 5)/3 = 2^(y−1). Rewrite in log form: y − 1 = log₂((x − 5)/3). So f⁻¹(x) = 1 + log₂((x − 5)/3).
f has domain all real numbers and range y > 5 (its asymptote is y = 5). So f⁻¹ has domain x > 5 and range all real numbers, which matches the requirement (x − 5)/3 > 0.

**Worked example.** Find the inverse of g(x) = ln(x + 2) − 1.

Swap: x = ln(y + 2) − 1, so ln(y + 2) = x + 1, y + 2 = e^(x+1) and g⁻¹(x) = e^(x+1) − 2. g has domain x > −2 and range all reals; g⁻¹ has domain all reals and range y > −2. Check: g(g⁻¹(0)) = g(e − 2) = ln e − 1 = 0. ✓

**Try it.**
1. Find the inverse of h(x) = 10^(x/2).
2. Find the inverse of k(x) = 4 log₃(x) + 1 and state its range.

*Answers:* 1. h⁻¹(x) = 2 log x (x > 0). 2. x = 4 log₃ y + 1 gives log₃ y = (x − 1)/4, so k⁻¹(x) = 3^((x−1)/4), with range y > 0.

## Calculator notes

The exact answers (ln 7.5 / 0.2, ln 2 / ln 1.5) are usually acceptable, but a context question wants a decimal with units. To solve graphically, enter each side as a function (Y1 = 4e^(0.2X), Y2 = 30) and use the intersect feature; for an inequality, read off where one graph lies above the other. A graph is also a quick way to spot an extraneous solution: a candidate outside the domain of the original log will not appear as an intersection. On the no-calculator section, expect common bases, quadratic-in-eˣ equations with exact log answers, and inequalities with nice powers.

## Common mistakes

- **Taking a log before isolating.** In 3 · 2ˣ − 4 = 20, divide and subtract first. ln(3 · 2ˣ − 4) does not simplify.
- **Dividing logs incorrectly.** ln 40 / ln 5 is not ln 8 and not ln 35. Leave it as a quotient or compute it.
- **Not checking log solutions.** Always substitute each candidate back into the original equation.
- **Forgetting that bˣ > 0.** An equation like 2ˣ = −2 has no solution; in a substitution, discard negative values of u = bˣ.
- **Forgetting to flip.** Dividing by ln 0.8 (negative) or applying a base between 0 and 1 reverses an inequality.
- **Ignoring the domain in a log inequality.** log₂(x − 3) ≤ 4 also needs x > 3.
- **Rewriting log(x²) as 2 log x before solving,** which loses negative solutions.

## Where this goes next

Week 17 turns these skills on models: solving a decibel or acidity-style log model for the input, and using logarithms to straighten exponential data on a semi-log plot so that its slope and intercept give the base and initial value. The unit exam then pulls together all of Unit 2. Later, in Unit 3, you will solve trigonometric equations with the same strategy of isolating the function and applying its inverse.

## Self-check

1. Solve 4^(x+2) = 32^x and 6e^(−0.3t) = 2 exactly.
2. Solve 2^(2x) − 6 · 2ˣ + 8 = 0.
3. Solve log₃(x + 4) + log₃(x − 4) = 2 and explain why one candidate is rejected.
4. Solve 200(0.95)ᵗ < 100 and explain where the inequality reverses.
5. Find the inverse of f(x) = 5 − e^(2x) and give the domain and range of f and f⁻¹.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 2, Topic 2.13). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
