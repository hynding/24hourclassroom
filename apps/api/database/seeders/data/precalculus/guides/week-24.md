# Week 24 · Secant, Cosecant, Cotangent and Trigonometric Identities

**Topics:** 3.11 The Secant, Cosecant, and Cotangent Functions · 3.12 Equivalent Representations of Trigonometric Functions
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 3, Topics 3.11–3.12, learning objectives in our own words
**Spiral:** The reciprocal functions are built from week 19's unit-circle values and week 22's tangent; their asymptotes come from the zeros of sine and cosine (week 20), exactly as a rational function's vertical asymptotes come from the zeros of its denominator (week 6). The identities finish the equation-solving of week 23: an equation like sin(2x) = sin x only factors once you rewrite sin(2x). From Algebra 2: simplifying complex fractions and factoring.

## What you need to be able to do

- **3.11** Define sec x, csc x and cot x as the reciprocals of cos x, sin x and tan x, find their exact values at special angles, and state their domains.
- **3.11** Describe the graphs of the reciprocal functions: vertical asymptotes where the original function is zero, local extrema where the original has its maxima and minima, period, range, and intervals of increase and decrease.
- **3.12** State and use the three Pythagorean identities, and derive the second and third from the first.
- **3.12** Use the sum and difference identities for sine and cosine to find exact values such as cos(π/12) and to rewrite expressions such as cos(x − π/2).
- **3.12** Use the double-angle identities for sine and cosine, including all three forms of cos(2θ).
- **3.12** Show that two trigonometric expressions are equivalent by transforming one side into the other.
- **3.12** Rewrite a trigonometric equation with identities so that it can be factored and solved on an interval.

## Key terms

| Term | Meaning |
|---|---|
| Secant | sec x = 1/cos x, defined wherever cos x ≠ 0. |
| Cosecant | csc x = 1/sin x, defined wherever sin x ≠ 0. |
| Cotangent | cot x = cos x/sin x = 1/tan x (where tan x ≠ 0), defined wherever sin x ≠ 0. |
| Identity | An equation that is true for every input where both sides are defined, such as sin²x + cos²x = 1. |
| Pythagorean identities | sin²x + cos²x = 1, 1 + tan²x = sec²x, 1 + cot²x = csc²x. |
| Sum and difference identities | Formulas for sin(α ± β) and cos(α ± β) in terms of the sines and cosines of α and β. |
| Double-angle identities | sin(2θ) = 2 sin θ cos θ and cos(2θ) = cos²θ − sin²θ = 2 cos²θ − 1 = 1 − 2 sin²θ. |

## The reciprocal functions (3.11)

Each new function is the reciprocal of one you know:

| Function | Definition | Undefined where | Period |
|---|---|---|---|
| sec x | 1/cos x | cos x = 0: x = π/2 + πn | 2π |
| csc x | 1/sin x | sin x = 0: x = πn | 2π |
| cot x | cos x/sin x | sin x = 0: x = πn | π |

On the unit circle, if the terminal ray of θ meets the circle at (x, y), then sec θ = 1/x, csc θ = 1/y and cot θ = x/y. The signs follow the original functions: sec θ has the sign of cos θ, csc θ the sign of sin θ, and cot θ the sign of tan θ.

**Worked example.** Find the exact values of sec(π/3), csc(7π/6) and cot(3π/4).

cos(π/3) = 1/2, so sec(π/3) = 2. sin(7π/6) = −1/2, so csc(7π/6) = −2. At 3π/4 the point is (−√2/2, √2/2), so cot(3π/4) = (−√2/2)/(√2/2) = −1.

**Worked example.** Angle θ is in quadrant II with sin θ = 3/5. Find all six trigonometric values.

From sin²θ + cos²θ = 1: cos²θ = 1 − 9/25 = 16/25, and cosine is negative in quadrant II, so cos θ = −4/5. Then tan θ = (3/5)/(−4/5) = −3/4, csc θ = 5/3, sec θ = −5/4, cot θ = −4/3.

### Graphs of the reciprocal functions

Think of reciprocals the way you thought of rational functions in Unit 1:

- **Where the original is 0**, the reciprocal has a **vertical asymptote**. cos(π/2) = 0, so y = sec x has the asymptote x = π/2.
- **Where the original is 1 or −1**, the reciprocal equals the same value. These turning points of sine and cosine become turning points of cosecant and secant.
- **Where the original is small (near 0)**, the reciprocal is huge; where the original is near ±1, the reciprocal is near ±1.
- **The reciprocal increases where the original decreases** (with the same sign), and vice versa.

So y = sec x consists of U-shaped branches: opening up with minimum value 1 at x = 0, 2π, … (where cos x = 1) and opening down with maximum value −1 at x = π, 3π, … (where cos x = −1), separated by asymptotes at π/2 + πn. Its range is (−∞, −1] ∪ [1, ∞): it never takes values strictly between −1 and 1, because cos x is never bigger than 1 in size. It has no x-intercepts, since 1/cos x is never 0.

y = csc x looks the same shifted right by π/2: local minimum 1 at π/2 + 2πn, local maximum −1 at 3π/2 + 2πn, asymptotes at x = πn.

y = cot x has period π, asymptotes at x = πn (where sin x = 0), zeros at x = π/2 + πn (where cos x = 0), and is **decreasing** on every branch, the mirror image of tangent's rising branches. Like tangent, cotangent is an odd function: cot(−x) = −cot x.

**Worked example.** On (0, π), where is y = csc x decreasing?

On (0, π/2), sin x increases from 0 to 1 (positive), so csc x decreases from very large values down to 1. On (π/2, π), sin x decreases to 0, so csc x increases. So csc x is decreasing on (0, π/2).

**Try it.**
1. Find sec(5π/6), csc(3π/2) and cot(π/6).
2. Where are the vertical asymptotes of y = sec(2x)?
3. Angle θ is in quadrant III with tan θ = 12/5. Find sec θ.

*Answers:* 1. sec(5π/6) = 1/(−√3/2) = −2/√3 = −2√3/3; csc(3π/2) = −1; cot(π/6) = (√3/2)/(1/2) = √3. 2. cos(2x) = 0 when 2x = π/2 + πn, so x = π/4 + πn/2. 3. 1 + tan²θ = sec²θ gives sec²θ = 169/25; secant is negative in quadrant III, so sec θ = −13/5.

## The Pythagorean identities (3.12)

The point (cos θ, sin θ) is on the unit circle x² + y² = 1, so

**sin²θ + cos²θ = 1.**

Divide every term by cos²θ (where it is not 0): tan²θ + 1 = sec²θ. Divide every term by sin²θ instead: 1 + cot²θ = csc²θ. You only need to memorise the first; the other two take one line each.

Each identity can be rearranged: sin²θ = 1 − cos²θ, cos²θ = 1 − sin²θ, sec²θ − 1 = tan²θ, csc²θ − 1 = cot²θ. These rearrangements are what you substitute when simplifying.

**Worked example.** Simplify (sec²x − 1) cos²x.

sec²x − 1 = tan²x, so the expression is tan²x · cos²x = (sin²x/cos²x) · cos²x = sin²x.

## Sum and difference identities (3.12)

For any angles α and β:

- sin(α + β) = sin α cos β + cos α sin β
- sin(α − β) = sin α cos β − cos α sin β
- cos(α + β) = cos α cos β − sin α sin β
- cos(α − β) = cos α cos β + sin α sin β

Two patterns to remember: sine *mixes* (sin cos, cos sin) and keeps the sign; cosine *matches* (cos cos, sin sin) and flips the sign. And sin(α + β) is **not** sin α + sin β: try α = β = π/2, where sin π = 0 but 1 + 1 = 2.

**Worked example.** Find the exact value of cos(π/12).

π/12 = π/3 − π/4. cos(π/3 − π/4) = cos(π/3)cos(π/4) + sin(π/3)sin(π/4) = (1/2)(√2/2) + (√3/2)(√2/2) = √2/4 + √6/4 = (√6 + √2)/4 ≈ 0.966.

**Worked example.** Find the exact value of cos(7π/12).

7π/12 = π/3 + π/4. cos(π/3)cos(π/4) − sin(π/3)sin(π/4) = √2/4 − √6/4 = (√2 − √6)/4 ≈ −0.259. Negative, as it should be for an angle in quadrant II.

**Worked example.** Show that cos(x − π/2) = sin x.

cos x cos(π/2) + sin x sin(π/2) = cos x · 0 + sin x · 1 = sin x. This is the identity behind week 20's statement that the sine graph is the cosine graph shifted right by π/2.

**Worked example.** Angles α and β satisfy sin α = 3/5 (α in quadrant I) and cos β = 5/13 (β in quadrant I). Find sin(α + β).

cos α = 4/5 and sin β = 12/13. sin(α + β) = (3/5)(5/13) + (4/5)(12/13) = 15/65 + 48/65 = 63/65.

## Double-angle identities (3.12)

Set β = α in the sum identities:

- sin(2θ) = 2 sin θ cos θ
- cos(2θ) = cos²θ − sin²θ, and using sin²θ + cos²θ = 1 this also equals 2 cos²θ − 1 and 1 − 2 sin²θ.

Choose the form of cos(2θ) that matches the rest of the problem: 1 − 2 sin²θ if everything else is in sine, 2 cos²θ − 1 if everything else is in cosine.

**Worked example.** With sin θ = 3/5 and θ in quadrant II (so cos θ = −4/5), find sin(2θ) and cos(2θ).

sin(2θ) = 2(3/5)(−4/5) = −24/25. cos(2θ) = 1 − 2(9/25) = 7/25. Check: (−24/25)² + (7/25)² = (576 + 49)/625 = 1.

## Proving identities (3.12)

To show an equation is an identity, start with one side (usually the more complicated one) and transform it, step by step, into the other side. Do **not** start by assuming the two sides are equal and working on both at once; that only shows the equation is consistent, not that it is true.

Useful moves: rewrite everything in sines and cosines; use a Pythagorean identity; combine fractions over a common denominator; factor.

**Worked example.** Show that sec x − cos x = sin x tan x.

sec x − cos x = 1/cos x − cos x = (1 − cos²x)/cos x = sin²x/cos x = sin x · (sin x/cos x) = sin x tan x.

**Worked example.** Show that tan x + cot x = sec x csc x.

tan x + cot x = sin x/cos x + cos x/sin x = (sin²x + cos²x)/(sin x cos x) = 1/(sin x cos x) = (1/cos x)(1/sin x) = sec x csc x.

**Try it.**
1. Show that (1 − cos²x) csc x = sin x.
2. Find the exact value of sin(π/12).
3. If cos θ = 1/3, find cos(2θ).

*Answers:* 1. (1 − cos²x) csc x = sin²x · (1/sin x) = sin x. 2. sin(π/3 − π/4) = (√3/2)(√2/2) − (1/2)(√2/2) = (√6 − √2)/4. 3. 2(1/9) − 1 = −7/9.

## Using identities to solve equations (3.12)

The aim is always the same as in week 23: get one function of one angle, then factor.

**Worked example.** Solve sin(2x) = sin x on [0, 2π).

Rewrite: 2 sin x cos x − sin x = 0, so sin x (2 cos x − 1) = 0. sin x = 0 gives 0 and π; cos x = 1/2 gives π/3 and 5π/3. Four solutions: 0, π/3, π, 5π/3.

**Worked example.** Solve cos(2x) + cos x = 0 on [0, 2π).

Use the cosine-only form: 2 cos²x − 1 + cos x = 0, so 2 cos²x + cos x − 1 = (2 cos x − 1)(cos x + 1) = 0. cos x = 1/2 gives π/3 and 5π/3; cos x = −1 gives π. Solutions: π/3, π, 5π/3.

**Worked example.** Solve sec²x − 2 tan x = 0 on [0, 2π).

Replace sec²x by 1 + tan²x: tan²x − 2 tan x + 1 = (tan x − 1)² = 0, so tan x = 1: x = π/4 and 5π/4. (Both are in the domain of sec x.)

When a reciprocal function appears, check that each solution is in its domain. For example, an equation containing csc x cannot have solutions where sin x = 0.

## Calculator notes

- Calculators have no sec, csc or cot keys. Enter 1/cos(x), 1/sin(x) and 1/tan(x) (or cos(x)/sin(x)).
- sec⁻¹ is **not** 1/cos⁻¹. To solve sec x = 3, rewrite as cos x = 1/3.
- A quick check of a claimed identity: graph both sides. If the graphs differ anywhere, it is not an identity. Matching graphs suggest an identity but do not prove it; the proof is algebraic.
- Most identity work on the AP exam is non-calculator.

## Common mistakes

- **Treating functions as numbers.** sin(α + β) ≠ sin α + sin β, sin(2x) ≠ 2 sin x, and cos(2x) ≠ 2 cos x.
- **Sign slips in the cosine identities.** cos(α + β) has a minus sign in the middle; cos(α − β) has a plus.
- **Confusing reciprocal and inverse.** sec x = 1/cos x, but cos⁻¹ x is the inverse cosine, an angle.
- **Losing the sign from the quadrant** when finding cos θ from sin θ with the Pythagorean identity.
- **Working on both sides of an identity at once** as if it were an equation already known to be true.
- **Dividing by a trigonometric factor** when solving; factor instead (week 23).

## Where this goes next

Week 25 converts between polar and rectangular coordinates using x = r cos θ and y = r sin θ, and the sum identities explain why multiplying complex numbers in polar form adds their angles. The graphs of r = a cos(nθ) in week 25 also rely on knowing exactly where cosine is 0 and where it is ±1, which is the same information that placed this week's asymptotes and turning points.

## Self-check

1. Find the exact values of sec(4π/3), csc(π/4) and cot(5π/3).
2. Describe the graph of y = csc x on (0, 2π): asymptotes, turning points and range.
3. Show that cos⁴x − sin⁴x = cos(2x). (Hint: factor as a difference of squares.)
4. Use a difference identity to find the exact value of sin(π/4 − π/6), and say which angle in lowest terms this is.
5. Solve cos(2x) = sin x on [0, 2π).

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 3, Topics 3.11–3.12). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
