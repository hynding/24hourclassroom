# Week 14 · Verifying Identities

**Topics:** 3.3 Verifying Identities
**Standards:** HSF-TF.C.8 (proving and using the Pythagorean identity), with HSA-SSE.A.2 (seeing structure in expressions)
**Spiral:** Week 13's toolkit (rewriting in sines and cosines, Pythagorean substitutions, factoring, common denominators and conjugates) is the whole set of moves you need this week; what changes is the goal. Week 6's even/odd identities and week 5's quadrant signs supply counterexamples, and week 11's inverse compositions are themselves identities that hold only on a stated domain.

## What you need to be able to do

- **3.3** Explain the difference between an identity, true at every value where both sides are defined, and a conditional equation, true at only some values.
- **3.3** Verify an identity by transforming one side, step by step and with a reason for each step, until it matches the other side.
- **3.3** Choose a strategy: start from the more complicated side, convert to sines and cosines, combine fractions, factor, use a conjugate, or work each side separately to a common middle.
- **3.3** Show that an equation is **not** an identity by giving one counterexample, a value where both sides are defined and unequal.
- **3.3** State the domain on which an identity holds.

## Key terms

| Term | Meaning |
|---|---|
| Identity | An equation true for every value of the variable at which both sides are defined, such as sin²x + cos²x = 1. |
| Conditional equation | An equation true for some values and false for others, such as sin x = 1/2. Week 18 solves these. |
| Verify (prove) an identity | Show, by a chain of equal expressions, that one side can be rewritten as the other. |
| Counterexample | A single value at which both sides are defined but have different values; one is enough to disprove an identity. |
| Domain of an identity | The values at which both sides are defined; the identity claims nothing outside it. |

## Identity or equation? (3.3)

The equation sin x = cos x is true at x = π/4 and false at x = 0, so it is a conditional equation: it asks "for which x?". The equation tan x = sin x/cos x is true at every x where tan x is defined, so it is an identity: it says "these two expressions are the same function". Graphically, the two sides of an identity have identical graphs; the two sides of a conditional equation merely cross.

A graph or a table of values can **suggest** an identity, and checking a few angles is a good way to catch a typo before you start. But matching at x = 0, π/6, π/4, π/3 and π/2 proves nothing. The functions sin x and sin x + sin 12x agree at all five of those angles (12x is a multiple of 2π or of π there, so sin 12x = 0), yet at x = π/24 the second is larger by sin(π/2) = 1. Only an algebraic argument proves an identity.

## How to verify an identity (3.3)

The rule that matters most: **treat the identity as a claim, not as an equation to solve.** You may not add, multiply or square both sides, because doing so assumes the equality you are trying to prove. Instead, pick one side and transform it by legitimate rewriting until it becomes the other side.

A strategy list, roughly in the order to try:

1. Start with the more complicated side; it has more to simplify.
2. Look for a Pythagorean expression (1 − sin²x, sec²x − 1 …) and replace it.
3. If there are fractions, combine them over a common denominator; if there is a single fraction with a sum on top, consider splitting it.
4. Factor: common factors, differences of squares, trinomials.
5. If a denominator is 1 ± sin x or 1 ± cos x, or sec x ± tan x, multiply by its conjugate.
6. When stuck, convert everything to sines and cosines.
7. Keep an eye on the target: if the other side has only cosines, steer towards cosines.

Write the work as a vertical chain, one equal sign per line, starting from the side you chose.

**Worked example 1.** Verify sec x − cos x = sin x tan x.

Start from the left, the side with a reciprocal function:

sec x − cos x
= 1/cos x − cos x  (reciprocal identity)
= (1 − cos²x)/cos x  (common denominator)
= sin²x/cos x  (Pythagorean identity)
= sin x · (sin x/cos x)  (factor)
= sin x tan x  (quotient identity) ✓

**Worked example 2.** Verify cos x/(1 − sin x) − tan x = sec x.

The left side has two fractions; combine them over cos x(1 − sin x):

cos x/(1 − sin x) − sin x/cos x
= [cos²x − sin x(1 − sin x)] / [cos x(1 − sin x)]
= [cos²x − sin x + sin²x] / [cos x(1 − sin x)]
= (1 − sin x) / [cos x(1 − sin x)]  (cos²x + sin²x = 1)
= 1/cos x = sec x ✓

The Pythagorean identity appeared only after expanding; that is typical.

**Worked example 3.** Verify tan²x − sin²x = tan²x sin²x.

Start from the left and aim for a product:

tan²x − sin²x
= sin²x/cos²x − sin²x
= sin²x(1/cos²x − 1)  (factor sin²x)
= sin²x(sec²x − 1)
= sin²x tan²x ✓

## Working both sides (3.3)

When neither side is obviously simpler, transform each side separately until both reach the **same** expression. This is legitimate because each chain is a sequence of equalities: if L = M and R = M, then L = R. What is not legitimate is moving terms across the equal sign.

**Worked example 4.** Verify (csc x − cot x)² = (1 − cos x)/(1 + cos x).

Left side: (1/sin x − cos x/sin x)² = (1 − cos x)²/sin²x.

Right side: multiply top and bottom by 1 − cos x: (1 − cos x)²/(1 − cos²x) = (1 − cos x)²/sin²x.

Both sides equal (1 − cos x)²/sin²x, so the identity holds wherever both sides are defined (x not a multiple of π).

## Showing that something is not an identity (3.3)

One counterexample settles it. Choose an angle where values are easy and both sides are defined.

**Worked example 5.** Show that (sin x + cos x)² = 1 is not an identity, and find the identity it should have been.

At x = π/4: (√2/2 + √2/2)² = (√2)² = 2 ≠ 1. So it is not an identity. Expanding correctly, (sin x + cos x)² = sin²x + 2 sin x cos x + cos²x = 1 + 2 sin x cos x, which is an identity. The claim fails because the middle term was forgotten.

Be careful with your choice: at x = 0 both sides equal 1, and at x = π/2 both equal 1 too, so those values do not disprove anything. A counterexample must actually produce different numbers.

## Domains (3.3)

An identity is a claim only where both sides are defined. tan x · cot x = 1 holds for every x that is not a multiple of π/2; at x = π/2 the left side is undefined, and that is not a counterexample. Similarly, (1 − cos x)/sin x = sin x/(1 + cos x) holds wherever sin x ≠ 0. At x = π the left side is 2/0 and the right side is 0/0; both are undefined, so π is simply outside the domain.

When asked "for which x does this identity hold?", list the zeros of every denominator and every point where a function in the identity (tan, sec, csc, cot) is undefined.

**Try it.**
1. Verify sin x(csc x − sin x) = cos²x.
2. Verify (sec x − 1)(sec x + 1) = tan²x.
3. Is sec x + tan x = 1 an identity? Justify.

*Answers:* 1. sin x csc x − sin²x = 1 − sin²x = cos²x. 2. sec²x − 1 = tan²x. 3. No: at x = π/4 the left side is √2 + 1 ≈ 2.41 ≠ 1.

## Common mistakes

- **Doing algebra on both sides.** Cross-multiplying or squaring both sides assumes the identity. Transform one side, or each side separately.
- **Steps without reasons.** Each line should follow from a named identity or an algebra move; a grader cannot award a jump.
- **"Proving" by examples.** Five matching angles are evidence, not proof.
- **A bad counterexample.** It must be a value where both sides are defined and the values differ; a point where one side is undefined does not count.
- **Losing the middle term.** (a + b)² has a 2ab term; (1 + sin x)² = 1 + 2 sin x + sin²x.
- **Ignoring the domain.** An identity with tan x says nothing at x = π/2.

## Where this goes next

Week 15 adds the sum and difference formulas, and much of the week's practice is verifying identities such as sin(x + π) = −sin x with them. Weeks 16 and 17 verify double-angle and product identities the same way. In week 18 the distinction from this week matters in reverse: a conditional equation is solved, and the moves forbidden for identities (adding to both sides, multiplying both sides) become the main tools.

## Self-check

1. Explain why sin x = cos x is not an identity but tan x cot x = 1 is.
2. Verify cos x + sin x tan x = sec x.
3. Verify (1 − cos x)/sin x = sin x/(1 + cos x), and state where it holds.
4. Show that sin x + cos x = 1 is not an identity, choosing a counterexample carefully.
5. Verify sec x + tan x = 1/(sec x − tan x).

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.C.8, HSA-SSE.A.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
