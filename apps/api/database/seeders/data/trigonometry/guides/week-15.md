# Week 15 · Sum and Difference Formulas

**Topics:** 3.4 Sum and Difference Formulas · 3.5 Cofunction and Reduction Formulas
**Standards:** HSF-TF.C.9 (prove the addition and subtraction formulas and use them to solve problems), HSF-TF.A.4 (symmetry and periodicity)
**Spiral:** Week 6's unit-circle coordinates are the raw material of the derivation, and its exact values at π/6, π/4 and π/3 are the pieces from which 75°, 15° and π/12 are built. Week 5's quadrant signs decide the missing ratios when only one is given, week 2's cofunctions reappear as special cases, and week 14's verification methods are how you prove the reduction formulas.

## What you need to be able to do

- **3.4** State the sum and difference formulas for sine, cosine and tangent, and sketch why the cosine difference formula is true.
- **3.4** Find exact values at angles such as 75°, 105°, 15° and π/12 by writing them as sums or differences of special angles.
- **3.4** Given one ratio and a quadrant for each of two angles, find sin(α ± β), cos(α ± β) and tan(α ± β), and the quadrant of α ± β.
- **3.4** Recognise an expanded formula in reverse, such as sin 50° cos 20° − cos 50° sin 20° = sin 30°.
- **3.5** Derive cofunction identities and reduction formulas such as sin(π − x) = sin x and cos(x + π/2) = −sin x.

## Key terms

| Term | Meaning |
|---|---|
| Sum formula | A formula for a trigonometric function of α + β in terms of functions of α and β. |
| Difference formula | The same for α − β; it follows from the sum formula with −β and the even/odd identities. |
| Cofunction identity | sin(π/2 − x) = cos x, cos(π/2 − x) = sin x, tan(π/2 − x) = cot x: a function of an angle equals its cofunction of the complement. |
| Reduction formula | A rewriting of a function of x ± π/2, x ± π or x ± 3π/2 as ± a function of x alone. |

## The formulas (3.4)

| | Sum | Difference |
|---|---|---|
| sine | sin(α + β) = sin α cos β + cos α sin β | sin(α − β) = sin α cos β − cos α sin β |
| cosine | cos(α + β) = cos α cos β − sin α sin β | cos(α − β) = cos α cos β + sin α sin β |
| tangent | tan(α + β) = (tan α + tan β)/(1 − tan α tan β) | tan(α − β) = (tan α − tan β)/(1 + tan α tan β) |

Two sign patterns to remember: **sine keeps the sign** of the operation (sum gives +), and the order is "sin cos, cos sin", mixed. **Cosine flips the sign** (sum gives −), and the order is "cos cos, sin sin", matched.

The most important fact on this page is a non-fact: sin(α + β) ≠ sin α + sin β. At α = β = π/2 the left side is sin π = 0 and the right side is 2.

## Why cos(α − β) = cos α cos β + sin α sin β (3.4)

Put P = (cos α, sin α) and Q = (cos β, sin β) on the unit circle. The angle between the rays OP and OQ is α − β. Compute the squared distance PQ² in two ways.

From coordinates:
PQ² = (cos α − cos β)² + (sin α − sin β)² = (cos²α + sin²α) + (cos²β + sin²β) − 2(cos α cos β + sin α sin β) = 2 − 2(cos α cos β + sin α sin β).

From rotation: rotate the picture by −β so that Q lands on (1, 0) and P lands on (cos(α − β), sin(α − β)). Distances do not change, so
PQ² = (cos(α − β) − 1)² + sin²(α − β) = 2 − 2 cos(α − β).

Setting the two equal gives the formula. Everything else follows from it:

- replace β with −β (cosine even, sine odd) to get cos(α + β);
- use the cofunction cos(π/2 − θ) = sin θ with θ = α + β to get sin(α + β);
- divide the sine formula by the cosine formula, then divide top and bottom by cos α cos β, to get tan(α + β).

## Exact values (3.4)

Write the angle as a sum or difference of 30°, 45°, 60° (or π/6, π/4, π/3), then substitute.

**Worked example 1.** Find sin 75° exactly.

sin 75° = sin(45° + 30°) = sin 45° cos 30° + cos 45° sin 30° = (√2/2)(√3/2) + (√2/2)(1/2) = **(√6 + √2)/4** ≈ 0.966.

**Worked example 2.** Find cos(π/12) and tan(π/12) exactly.

π/12 = π/3 − π/4. cos(π/12) = cos(π/3)cos(π/4) + sin(π/3)sin(π/4) = (1/2)(√2/2) + (√3/2)(√2/2) = **(√2 + √6)/4**. Notice this equals sin 75°: 75° and 15° = π/12 are complementary.

tan(π/12) = (tan(π/3) − tan(π/4))/(1 + tan(π/3)tan(π/4)) = (√3 − 1)/(1 + √3). Multiply by the conjugate (√3 − 1)/(√3 − 1): (√3 − 1)²/(3 − 1) = (4 − 2√3)/2 = **2 − √3** ≈ 0.268.

**Reverse recognition.** sin 50° cos 20° − cos 50° sin 20° has the "sin cos − cos sin" shape, so it is sin(50° − 20°) = sin 30° = 1/2. Spotting the pattern is faster than evaluating anything.

## Two angles with quadrants (3.4)

When only one ratio of each angle is given, find the others first (a right triangle or the Pythagorean identity for the size, the quadrant for the sign), then substitute.

**Worked example 3.** sin α = 3/5 with α in quadrant II, and cos β = −5/13 with β in quadrant III. Find sin(α + β), cos(α + β), tan(α + β), the quadrant of α + β, and cos(α − β).

Missing values: cos α = −4/5 (quadrant II, cosine negative); sin β = −12/13 (quadrant III, sine negative).

- sin(α + β) = (3/5)(−5/13) + (−4/5)(−12/13) = −15/65 + 48/65 = **33/65**.
- cos(α + β) = (−4/5)(−5/13) − (3/5)(−12/13) = 20/65 + 36/65 = **56/65**.
- tan(α + β) = (33/65)/(56/65) = **33/56**.
- Both sine and cosine are positive, so α + β (reduced by 2π) is in **quadrant I**.
- cos(α − β) = (−4/5)(−5/13) + (3/5)(−12/13) = 20/65 − 36/65 = **−16/65**.

A quick check: (33/65)² + (56/65)² = (1089 + 3136)/4225 = 1, as it must be.

## Cofunctions and reduction formulas (3.5)

Apply a difference or sum formula with one special angle.

- sin(π/2 − x) = sin(π/2)cos x − cos(π/2)sin x = cos x. This is week 2's cofunction rule, now proved for every x, not only acute angles.
- cos(π/2 − x) = sin x, and tan(π/2 − x) = cot x.

**Worked example 4.** Simplify sin(π − x), cos(x + π/2), tan(x + π) and sin(3π/2 − x).

- sin(π − x) = sin π cos x − cos π sin x = 0 − (−1) sin x = **sin x**.
- cos(x + π/2) = cos x cos(π/2) − sin x sin(π/2) = **−sin x**.
- tan(x + π) = (tan x + tan π)/(1 − tan x tan π) = tan x/1 = **tan x**, the period of tangent.
- sin(3π/2 − x) = sin(3π/2)cos x − cos(3π/2)sin x = **−cos x**.

A shortcut to check signs: picture x as a small acute angle. Then π − x is in quadrant II, where sine is positive, so sin(π − x) = +sin x; x + π/2 is in quadrant II, where cosine is negative, so cos(x + π/2) = −(something), and the function switches to its cofunction because π/2 was added. Adding π or 2π keeps the same function; adding π/2 or 3π/2 switches to the cofunction.

**Worked example 5 (verifying).** Verify sin(x + y) sin(x − y) = sin²x − sin²y.

Multiply the two expansions: (sin x cos y + cos x sin y)(sin x cos y − cos x sin y) = sin²x cos²y − cos²x sin²y. Replace cos²y with 1 − sin²y and cos²x with 1 − sin²x: sin²x − sin²x sin²y − sin²y + sin²x sin²y = sin²x − sin²y ✓.

**Try it.**
1. Find cos 105° exactly.
2. Evaluate cos 100° cos 40° + sin 100° sin 40°.
3. Simplify cos(π − x).

*Answers:* 1. cos(60° + 45°) = (√2 − √6)/4. 2. The shape "cos cos + sin sin" is a difference: cos(100° − 40°) = cos 60° = 1/2. 3. −cos x.

## Common mistakes

- **Distributing.** sin(α + β) ≠ sin α + sin β; cos(α − β) ≠ cos α − cos β.
- **Swapping the cosine signs.** cos(α + β) has a minus; cos(α − β) has a plus.
- **Ignoring the quadrant.** In worked example 3, cos α is −4/5, not 4/5; one wrong sign changes every answer.
- **Not rationalising tan(π/12).** (√3 − 1)/(√3 + 1) is correct but 2 − √3 is the expected simplest form.
- **Forgetting the cofunction switch.** cos(x + π/2) is −sin x, not −cos x.
- **Degrees and radians mixed.** sin(45° + π/6) is meaningless until both are in one unit.

## Where this goes next

Week 16 sets β = α to get the double-angle formulas, and reverses them into the power-reducing and half-angle formulas. Week 17 adds sum and difference formulas to produce product-to-sum formulas, and uses sin(x + φ) to rewrite a sin x + b cos x as a single sinusoid. In Unit 5, Euler's formula gives a second, shorter derivation of everything on this page.

## Self-check

1. Find sin 15° and tan 75° exactly.
2. Evaluate sin(5π/12)cos(π/12) − cos(5π/12)sin(π/12).
3. If cos α = 12/13 with α in quadrant IV and sin β = 4/5 with β in quadrant II, find sin(α + β).
4. Simplify sin(x + 3π/2) and tan(π − x).
5. Use the distance argument to explain why cos(α − β) depends only on α − β.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.C.9, HSF-TF.A.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
