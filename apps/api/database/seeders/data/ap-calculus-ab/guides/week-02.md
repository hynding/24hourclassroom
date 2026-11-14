# Week 02 · Determining Limits Algebraically

**Topics:** 1.5 Determining Limits Using Algebraic Properties of Limits · 1.6 Determining Limits Using Algebraic Manipulation · 1.7 Selecting Procedures for Determining Limits
**Practices:** 1 (Implementing Mathematical Processes), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 1, Topics 1.5–1.7, learning objectives in our own words
**Spiral:** Week 1 estimated limits from graphs and tables and showed that a limit ignores the value at the point. This week turns those estimates into exact values. From precalculus: factoring (including sums and differences of cubes), conjugates, combining fractions, and the unit-circle values of sine and cosine.

## What you need to be able to do

- **1.5** Use the sum, difference, constant multiple, product, quotient, power and root properties of limits to combine known limits.
- **1.5** Evaluate limits by direct substitution where the function is defined and well behaved.
- **1.6** Rewrite an expression that gives 0/0 by factoring, rationalising, combining complex fractions, or using trigonometric identities and the special limit lim (x→0) (sin x)/x = 1.
- **1.7** Choose an appropriate method for a given limit, and recognise when a limit does not exist (nonzero number over 0, unequal one-sided limits).

## Key terms

| Term | Meaning |
|---|---|
| Limit properties | Rules for the limit of a sum, difference, constant multiple, product, quotient, power or root, in terms of the separate limits. |
| Direct substitution | Evaluating lim (x→c) f(x) as f(c); valid for polynomials and for rational, root, trigonometric, exponential and logarithmic functions at points of their domains. |
| Indeterminate form 0/0 | A quotient whose numerator and denominator both approach 0; it gives no information until rewritten. |
| Conjugate | For √a − b, the expression √a + b; their product a − b² removes the root. |
| Complex fraction | A fraction with fractions in its numerator or denominator. |
| Special trigonometric limit | lim (x→0) (sin x)/x = 1 (x in radians); also lim (x→0) (1 − cos x)/x = 0. |

## The properties of limits (1.5)

Suppose lim (x→c) f(x) = L and lim (x→c) g(x) = M, both finite. Then, as x → c:

| Property | Statement |
|---|---|
| Sum / difference | lim [f(x) ± g(x)] = L ± M |
| Constant multiple | lim k·f(x) = k·L |
| Product | lim f(x)g(x) = L·M |
| Quotient | lim f(x)/g(x) = L/M, provided M ≠ 0 |
| Power | lim [f(x)]ⁿ = Lⁿ |
| Root | lim ⁿ√f(x) = ⁿ√L (L ≥ 0 when n is even) |

These properties say that limits respect arithmetic, as long as each separate limit exists and you never divide by a limit of 0.

**Worked example.** Given lim (x→2) f(x) = 5 and lim (x→2) g(x) = −2, find each limit.

- lim (x→2) [3f(x) − (g(x))²] = 3(5) − (−2)² = 15 − 4 = 11.
- lim (x→2) f(x)g(x)/(x + 1) = (5)(−2)/(2 + 1) = −10/3, since the denominator's limit is 3 ≠ 0.
- lim (x→2) √(f(x) + 4) = √9 = 3.
- lim (x→2) f(x)/(g(x) + 2): the denominator approaches 0 and the numerator approaches 5, so the quotient property does not apply. The quotient is unbounded and the limit does not exist.

**Direct substitution.** Applying the properties to x itself (lim x = c) and to constants shows that for any polynomial, lim (x→c) p(x) = p(c). The same is true of rational functions where the denominator is nonzero, and of roots, sines, cosines, exponentials and logarithms at inputs in their domains. So lim (x→π) x cos x = π cos π = −π, and lim (x→3) (x² + 1)/(x − 1) = 10/2 = 5. Week 4 names the reason: these functions are continuous on their domains.

## Algebraic manipulation (1.6)

When substitution gives **0/0**, the numerator and denominator share a "zero-making" piece. The goal is to expose it and cancel it. Cancelling is legitimate because the new expression agrees with the old one at every x ≠ c, and a limit never looks at x = c.

**Factoring.** Find lim (x→−3) (x² + x − 6)/(x + 3).

Substitution gives (9 − 3 − 6)/0 = 0/0. Factor: x² + x − 6 = (x + 3)(x − 2). For x ≠ −3,

(x² + x − 6)/(x + 3) = x − 2, so lim (x→−3) (x² + x − 6)/(x + 3) = lim (x→−3) (x − 2) = −5.

Graphically, y = (x² + x − 6)/(x + 3) is the line y = x − 2 with a hole at (−3, −5).

**Rationalising.** Find lim (x→9) (√x − 3)/(x − 9).

Multiply top and bottom by the conjugate √x + 3:

(√x − 3)(√x + 3) / ((x − 9)(√x + 3)) = (x − 9)/((x − 9)(√x + 3)) = 1/(√x + 3) for x ≠ 9.

Now substitute: 1/(3 + 3) = 1/6. (A table check: at x = 9.01 the original expression is about 0.16662.)

**Complex fractions.** Find lim (x→0) (1/(x + 2) − 1/2)/x.

Combine the top over the common denominator 2(x + 2):

1/(x + 2) − 1/2 = (2 − (x + 2))/(2(x + 2)) = −x/(2(x + 2)).

Dividing by x gives −1/(2(x + 2)) for x ≠ 0, which approaches −1/(2 · 2) = −1/4.

**Trigonometric limits.** The basic fact, with x in radians, is

lim (x→0) (sin x)/x = 1.

(A table makes it believable: sin(0.01)/0.01 ≈ 0.99998. Week 3 proves it with the squeeze theorem.) To use it, the angle inside the sine must match the denominator.

**Worked example.** Find lim (x→0) sin(5x)/x and lim (x→0) tan(3x)/(2x).

- sin(5x)/x = 5 · sin(5x)/(5x). As x → 0, 5x → 0 too, so sin(5x)/(5x) → 1 and the limit is 5.
- tan(3x)/(2x) = sin(3x)/(2x cos 3x) = [sin(3x)/(3x)] · 3/(2 cos 3x). This approaches 1 · 3/(2 · 1) = 3/2.

A companion fact is lim (x→0) (1 − cos x)/x = 0. Multiply by (1 + cos x)/(1 + cos x) to get sin²x/(x(1 + cos x)) = (sin x/x) · sin x/(1 + cos x) → 1 · 0/2 = 0.

## Selecting a procedure (1.7)

You will meet limits in no particular order, so build a habit:

1. **Substitute first.** If you get a number, that is the limit (for the well-behaved functions listed above).
2. **Nonzero over zero** (like 2/0): the quotient is unbounded near c, and the limit does not exist. Signs on each side tell you whether it heads to ∞ or −∞ (week 5).
3. **0/0:** rewrite. A polynomial quotient → factor. A square root → conjugate. Fractions inside fractions → common denominator. Sine, cosine or tangent near 0 → the special limits.
4. **Piecewise functions at a break point:** take each one-sided limit with its own piece and its own method, then compare.
5. **Still stuck?** A graph or table can guide you; the squeeze theorem (week 3) handles products like x² sin(1/x).

**Worked example.** Let f(x) = (x² − x − 2)/(x − 2) for x < 2, f(2) = 1, and f(x) = (√(x + 7) − 3)/(x − 2) for x > 2. Find lim (x→2) f(x), if it exists.

- Left: substitution gives 0/0; factor (x − 2)(x + 1)/(x − 2) = x + 1, so the left-hand limit is 3.
- Right: substitution gives 0/0; there is a root, so rationalise. (x + 7 − 9)/((x − 2)(√(x + 7) + 3)) = 1/(√(x + 7) + 3), so the right-hand limit is 1/6.
- 3 ≠ 1/6, so lim (x→2) f(x) does not exist. f(2) = 1 is irrelevant.
- By contrast, lim (x→0) f(x) needs no tricks: the left piece gives (−2)/(−2) = 1 by substitution.

**Communicating a limit.** On the AP exam, write the limit symbol on every line until you substitute, and give a reason when you claim a limit fails to exist ("the one-sided limits are 3 and 1/6, which are not equal").

## Common mistakes

- **Reading 0/0 as 0 or as "does not exist".** It means "rewrite and try again".
- **Using the quotient property with a denominator that approaches 0.**
- **Cancelling terms instead of factors.** (x² − 9)/(x − 3) is not x − 3, and (x + 9)/x is not 9.
- **Splitting roots over sums.** √(x + 9) is not √x + 3.
- **Mismatched trigonometric limits.** sin(5x)/x → 5, not 1; sin(5x)/(5x) → 1.
- **Using degrees.** The special trigonometric limits assume radians.
- **Assuming lim f(g(x)) follows from lim f and lim g at the same point.** f must be examined near lim g, not near c.

## Where this goes next

Week 3 adds the squeeze theorem (and uses it to prove the sine limit), connects graphs, tables and formulas for one limit, and classifies discontinuities as removable, jump or infinite. Unit 2 uses exactly these 0/0 techniques to compute derivatives from the definition.

## Self-check

1. Given lim (x→−1) f(x) = 4 and lim (x→−1) g(x) = 3, find lim (x→−1) [f(x) − 2g(x)]/(f(x) + g(x)).
2. Find lim (x→5) (x² − 3x − 10)/(x − 5).
3. Find lim (x→0) (√(x + 9) − 3)/x.
4. Find lim (x→0) (1/(x + 4) − 1/4)/x.
5. Find lim (x→0) sin(4x)/(3x).
6. Does lim (x→3) (x + 1)/(x − 3) exist? Explain.

*Answers:* 1. (4 − 6)/(4 + 3) = −2/7. 2. (x − 5)(x + 2)/(x − 5) → 7. 3. 1/(√(x + 9) + 3) → 1/6. 4. −1/(4(x + 4)) → −1/16. 5. 4/3. 6. No: substitution gives 4/0, so the quotient is unbounded near 3.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 1, Topics 1.5–1.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
