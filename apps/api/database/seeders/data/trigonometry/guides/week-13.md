# Week 13 · Simplifying Trigonometric Expressions

**Topics:** 3.1 Simplifying Trigonometric Expressions · 3.2 Factoring and Rational Trigonometric Expressions
**Standards:** HSF-TF.C.8 (the Pythagorean identity and its use), with the algebraic structure of HSA-SSE.A.2 applied to trigonometric expressions
**Spiral:** Week 6 gave the reciprocal, quotient and Pythagorean identities as facts about the unit circle; this week they become tools for rewriting. Week 5's signs by quadrant decide which square root to take, and week 11's inverse functions return in the substitution x = 3 sin θ, where the restricted range of sin⁻¹ is what makes √(9 − x²) = 3 cos θ true. The factoring, common denominators and conjugates are Algebra 2 moves with a trigonometric function in place of x.

## What you need to be able to do

- **3.1** Rewrite an expression using only sines and cosines, and simplify it to a single function, a constant or a short product.
- **3.1** Replace 1 − sin²x, 1 − cos²x, sec²x − 1, 1 + tan²x, csc²x − 1 and 1 + cot²x by the matching single square, in either direction.
- **3.2** Factor trigonometric expressions: common factors, differences of squares, and trinomials that are quadratic in sin x, cos x or tan x.
- **3.2** Add, subtract and simplify trigonometric fractions with a common denominator, and use a conjugate such as 1 + cos x to clear 1 − cos x from a denominator.
- **3.1–3.2** State where a simplified expression agrees with the original: the original's domain does not grow when you cancel.

## Key terms

| Term | Meaning |
|---|---|
| Simplify | Rewrite with fewer functions, terms or fractions, without changing the value at any x where the original is defined. |
| Reciprocal identities | csc x = 1/sin x, sec x = 1/cos x, cot x = 1/tan x. |
| Quotient identities | tan x = sin x/cos x, cot x = cos x/sin x. |
| Pythagorean identities | sin²x + cos²x = 1, 1 + tan²x = sec²x, 1 + cot²x = csc²x. |
| Quadratic in sin x | An expression such as 2 sin²x + sin x − 1, which factors like 2u² + u − 1 with u = sin x. |
| Conjugate | For a ± b, the expression a ∓ b; their product a² − b² often becomes a single square by a Pythagorean identity. |

## Toolkit: the identities as rewriting rules (3.1)

Every Pythagorean identity can be read three ways. From sin²x + cos²x = 1:

| You see | Replace with |
|---|---|
| 1 − sin²x | cos²x |
| 1 − cos²x | sin²x |
| sin²x + cos²x | 1 |

Dividing sin²x + cos²x = 1 by cos²x gives tan²x + 1 = sec²x, so sec²x − 1 = tan²x; dividing by sin²x gives 1 + cot²x = csc²x, so csc²x − 1 = cot²x. You do not need to memorise six separate facts: memorise one and divide.

The default strategy when nothing else suggests itself is **convert everything to sines and cosines**, then clear the compound fractions. It is rarely the shortest route, but it always gives you something to work with.

**Worked example 1.** Simplify (sec x − cos x)/sin x.

Write sec x as 1/cos x and combine the numerator over cos x:

sec x − cos x = 1/cos x − cos x = (1 − cos²x)/cos x = sin²x/cos x.

Dividing by sin x leaves sin²x/(cos x sin x) = sin x/cos x = **tan x**. The original is undefined where cos x = 0 or sin x = 0; the simplified tan x is undefined only where cos x = 0. So the two agree at every x that is **not** a multiple of π/2, and at x = π, for example, tan π = 0 exists while the original is 0/0.

**Worked example 2.** Simplify (1 − sin²x)(1 + tan²x).

Each factor is one side of a Pythagorean identity: 1 − sin²x = cos²x and 1 + tan²x = sec²x. The product is cos²x · sec²x = cos²x · (1/cos²x) = **1**, wherever cos x ≠ 0.

## Factoring (3.2)

Treat sin x, cos x or tan x as a single variable u. The patterns are the ones from Algebra 2:

- common factor: sin x cos²x − sin x = sin x(cos²x − 1) = −sin x sin²x = −sin³x;
- difference of squares: a² − b² = (a − b)(a + b);
- trinomial: 2u² + u − 1 = (2u − 1)(u + 1).

**Worked example 3.** (a) Simplify sin⁴x − cos⁴x. (b) Simplify (2 sin²x + sin x − 1)/(sin x + 1).

(a) It is a difference of squares in sin²x and cos²x:

sin⁴x − cos⁴x = (sin²x − cos²x)(sin²x + cos²x) = (sin²x − cos²x)(1) = **sin²x − cos²x**.

If a single function is wanted, replace cos²x by 1 − sin²x to get 2 sin²x − 1.

(b) With u = sin x the numerator is 2u² + u − 1 = (2u − 1)(u + 1). So

(2 sin²x + sin x − 1)/(sin x + 1) = (2 sin x − 1)(sin x + 1)/(sin x + 1) = **2 sin x − 1**,

valid wherever sin x ≠ −1, that is for x ≠ 3π/2 + 2πn. At x = 3π/2 the original is 0/0, even though 2 sin x − 1 = −3 there.

## Combining fractions (3.2)

Add trigonometric fractions exactly as you add rational expressions: find the least common denominator, rewrite each fraction over it, combine numerators, then look for a Pythagorean identity in the result.

**Worked example 4.** Simplify cos x/(1 + sin x) + (1 + sin x)/cos x.

The common denominator is cos x(1 + sin x):

[cos²x + (1 + sin x)²] / [cos x(1 + sin x)] = [cos²x + 1 + 2 sin x + sin²x] / [cos x(1 + sin x)].

Group cos²x + sin²x = 1, so the numerator is 2 + 2 sin x = 2(1 + sin x). Cancel 1 + sin x:

2(1 + sin x)/[cos x(1 + sin x)] = 2/cos x = **2 sec x**.

## Conjugates (3.2)

A denominator such as 1 − cos x or 1 + sin x does not simplify on its own. Multiplying top and bottom by its conjugate produces 1 − cos²x = sin²x or 1 − sin²x = cos²x, a single term.

**Worked example 5.** Rewrite sin x/(1 − cos x) without a sum or difference in the denominator.

Multiply by (1 + cos x)/(1 + cos x):

sin x(1 + cos x)/(1 − cos²x) = sin x(1 + cos x)/sin²x = (1 + cos x)/sin x = 1/sin x + cos x/sin x = **csc x + cot x**.

## A substitution that needs a quadrant (3.1)

Calculus courses rewrite radicals with a trigonometric substitution, and the Pythagorean identities do the work. Let x = 3 sin θ with −π/2 ≤ θ ≤ π/2, the range of sin⁻¹ from week 11. Then

√(9 − x²) = √(9 − 9 sin²θ) = √(9 cos²θ) = 3|cos θ| = 3 cos θ,

and the absolute value can be dropped **because** cos θ ≥ 0 on [−π/2, π/2]. Without the restriction the answer would be 3|cos θ|, which is −3 cos θ in quadrants II and III. Whenever you take the square root of a square, ask what sign the function has on the angles allowed.

**Try it.**
1. Simplify cot x sec x sin x.
2. Factor tan²x − 5 tan x + 6.
3. Simplify 1/(1 + cos x) + 1/(1 − cos x).

*Answers:* 1. (cos x/sin x)(1/cos x)(sin x) = 1. 2. (tan x − 2)(tan x − 3). 3. [(1 − cos x) + (1 + cos x)]/(1 − cos²x) = 2/sin²x = 2 csc²x.

## Common mistakes

- **Cancelling terms instead of factors.** (sin x + cos x)/sin x is not 1 + cos x; it is 1 + cot x. Only a common factor of the whole numerator and denominator cancels.
- **Splitting a square root.** √(sin²x + cos²x) is 1, but √(1 − sin²x) is |cos x|, not 1 − sin x.
- **Squaring a sum term by term.** (1 + sin x)² = 1 + 2 sin x + sin²x; the middle term is the one that makes worked example 4 work.
- **Reading sin²x − cos²x as (sin x − cos x)².** The first is a difference of squares, (sin x − cos x)(sin x + cos x).
- **Forgetting where the original was undefined.** A simplified form may be defined at points where the original was 0/0; state the restriction when asked.
- **Dropping an absolute value.** √(cos²θ) = |cos θ| unless the allowed angles make cos θ ≥ 0.

## Where this goes next

Week 14 turns these moves into proofs: verifying an identity means simplifying one side until it is the other, using exactly the toolkit above. Weeks 15 to 17 add the sum, double-angle and product formulas to the list of rewriting rules, and week 18 solves equations by factoring expressions like 2 sin²x + sin x − 1 = 0 instead of simplifying them.

## Self-check

1. Simplify csc x tan x, and say where your answer agrees with the original.
2. Simplify (sec²x − 1)/(sec x + 1).
3. Simplify (cos x sin²x + cos³x)/sin x.
4. Rewrite cos x/(1 − sin x) without a difference in the denominator.
5. With x = 2 sin θ and −π/2 ≤ θ ≤ π/2, write √(4 − x²) in terms of θ and explain why no absolute value is needed.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.C.8, HSA-SSE.A.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
