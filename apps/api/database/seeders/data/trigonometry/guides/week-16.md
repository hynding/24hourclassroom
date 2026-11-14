# Week 16 · Double-Angle, Power-Reducing and Half-Angle Formulas

**Topics:** 3.6 Double-Angle Formulas · 3.7 Power-Reducing and Half-Angle Formulas
**Standards:** HSF-TF.C.9 (extension: formulas derived from the addition formulas), HSF-TF.C.8 (the Pythagorean identity)
**Spiral:** Every formula this week comes from week 15's sum formulas with β = α, followed by week 6's Pythagorean identity. Week 5's quadrant signs choose the ± in every half-angle formula, week 14's verification methods prove the new identities, and week 7's amplitude and period reappear when sin²x is rewritten as a sinusoid with period π.

## What you need to be able to do

- **3.6** Derive and use sin 2x = 2 sin x cos x, the three forms of cos 2x, and tan 2x = 2 tan x/(1 − tan²x).
- **3.6** Given one ratio and a quadrant for θ, find sin 2θ, cos 2θ and tan 2θ and the quadrant of 2θ.
- **3.6** Build triple-angle formulas such as sin 3x = 3 sin x − 4 sin³x from a sum and the double-angle formulas.
- **3.7** Rewrite sin²x, cos²x and tan²x, and higher even powers such as cos⁴x, without exponents, using power-reducing formulas.
- **3.7** Use half-angle formulas to find exact values such as sin 15° and cos 22.5°, choosing the sign from the quadrant of the half angle.

## Key terms

| Term | Meaning |
|---|---|
| Double-angle formula | A formula for sin 2x, cos 2x or tan 2x in terms of functions of x. |
| Power-reducing formula | A formula that replaces sin²x, cos²x or tan²x by first powers of cos 2x. |
| Half-angle formula | A formula for sin(x/2), cos(x/2) or tan(x/2) in terms of cos x (and sin x). |
| Quadrant of the half angle | The quadrant of x/2, found by halving the interval that contains x; it decides the ± sign. |

## Double-angle formulas (3.6)

Set β = α in the sum formulas:

- sin 2x = sin(x + x) = sin x cos x + cos x sin x = **2 sin x cos x**.
- cos 2x = cos x cos x − sin x sin x = **cos²x − sin²x**.
- tan 2x = **2 tan x/(1 − tan²x)**.

Using sin²x + cos²x = 1, cos 2x has two more forms:

| Form | When to use it |
|---|---|
| cos 2x = cos²x − sin²x | both sin x and cos x are known |
| cos 2x = 2cos²x − 1 | only cos x is known, or you want an expression in cosine |
| cos 2x = 1 − 2sin²x | only sin x is known, or you want an expression in sine |

Doubling the angle does **not** double the value: sin(2 · π/6) = sin(π/3) = √3/2 ≈ 0.866, but 2 sin(π/6) = 1.

**Worked example 1.** sin θ = 5/13 with θ in quadrant II. Find sin 2θ, cos 2θ, tan 2θ and the quadrant of 2θ.

First cos θ = −12/13 (quadrant II).

- sin 2θ = 2(5/13)(−12/13) = **−120/169**.
- cos 2θ = 1 − 2(5/13)² = 1 − 50/169 = **119/169**.
- tan 2θ = (−120/169)/(119/169) = **−120/119**.
- sin 2θ < 0 and cos 2θ > 0, so 2θ is in **quadrant IV**. Check with intervals: π/2 < θ < π gives π < 2θ < 2π, which allows III or IV; the signs pick IV.

**Worked example 2 (triple angle).** Express sin 3x in terms of sin x.

sin 3x = sin(2x + x) = sin 2x cos x + cos 2x sin x
= (2 sin x cos x)cos x + (1 − 2 sin²x)sin x
= 2 sin x cos²x + sin x − 2 sin³x
= 2 sin x(1 − sin²x) + sin x − 2 sin³x
= **3 sin x − 4 sin³x**.

Check at x = π/6: sin(π/2) = 1, and 3(1/2) − 4(1/8) = 3/2 − 1/2 = 1 ✓.

## Power-reducing formulas (3.7)

Solve the last two forms of cos 2x for the squares:

- cos 2x = 1 − 2sin²x gives **sin²x = (1 − cos 2x)/2**;
- cos 2x = 2cos²x − 1 gives **cos²x = (1 + cos 2x)/2**;
- dividing, **tan²x = (1 − cos 2x)/(1 + cos 2x)**.

These trade a square for a first power of a double angle. Calculus uses them to integrate sin²x; here they also explain graphs. For example, y = sin²x = 1/2 − (1/2)cos 2x is a sinusoid with midline 1/2, amplitude 1/2 and period π, which is why the graph of sin²x never goes below 0 and repeats twice as often as sin x.

**Worked example 3.** Write cos⁴x with no powers higher than 1.

cos⁴x = (cos²x)² = ((1 + cos 2x)/2)² = (1 + 2 cos 2x + cos²2x)/4.

Apply power reduction again to cos²2x = (1 + cos 4x)/2:

cos⁴x = [1 + 2 cos 2x + (1 + cos 4x)/2]/4 = (2 + 4 cos 2x + 1 + cos 4x)/8 = **(3 + 4 cos 2x + cos 4x)/8**.

Check at x = 0: cos⁴0 = 1, and (3 + 4 + 1)/8 = 1 ✓.

## Half-angle formulas (3.7)

Replace x with x/2 in the power-reducing formulas and take square roots:

- **sin(x/2) = ±√((1 − cos x)/2)**
- **cos(x/2) = ±√((1 + cos x)/2)**
- **tan(x/2) = (1 − cos x)/sin x = sin x/(1 + cos x)**, which needs no sign choice.

The ± is not "both": it is **one** sign, chosen by the quadrant of x/2, not the quadrant of x.

**Worked example 4.** Find sin 15° exactly with a half-angle formula, and compare with week 15.

15° = 30°/2 is in quadrant I, so the sign is +:

sin 15° = √((1 − cos 30°)/2) = √((1 − √3/2)/2) = √((2 − √3)/4) = **√(2 − √3)/2** ≈ 0.259.

Week 15 gave (√6 − √2)/4 ≈ 0.259. They are the same number: squaring (√6 − √2)/4 gives (8 − 2√12)/16 = (2 − √3)/4. Two correct methods can give different-looking exact forms.

**Worked example 5 (choosing signs).** cos θ = −7/25 with π < θ < 3π/2. Find sin(θ/2), cos(θ/2) and tan(θ/2).

Halve the interval: π/2 < θ/2 < 3π/4, so θ/2 is in **quadrant II**: sine positive, cosine negative.

- sin(θ/2) = +√((1 + 7/25)/2) = √(16/25) = **4/5**.
- cos(θ/2) = −√((1 − 7/25)/2) = −√(9/25) = **−3/5**.
- tan(θ/2) = (4/5)/(−3/5) = **−4/3**. Check with the sign-free formula: sin θ = −24/25 in quadrant III, so (1 − cos θ)/sin θ = (32/25)/(−24/25) = −4/3 ✓.

Notice that θ itself is in quadrant III, where both sine and cosine are negative; using θ's quadrant instead of θ/2's would have given the wrong sign for sin(θ/2).

**Try it.**
1. Simplify 2 sin(π/12)cos(π/12).
2. Find cos 22.5° exactly.
3. If 3π/2 < θ < 2π, give the signs of sin(θ/2) and cos(θ/2).

*Answers:* 1. sin(π/6) = 1/2. 2. √((1 + √2/2)/2) = √(2 + √2)/2 ≈ 0.924. 3. 3π/4 < θ/2 < π, quadrant II: sine positive, cosine negative.

## Common mistakes

- **Doubling the value.** sin 2x ≠ 2 sin x; cos 2x ≠ 2 cos x.
- **Wrong form of cos 2x.** Pick the form that matches what you know: 1 − 2sin²x when only the sine is given.
- **Sign from the wrong quadrant.** The half-angle sign comes from x/2, not from x.
- **Writing both signs.** sin(x/2) = ±√… means "choose one"; a final answer with ± is incomplete.
- **Losing a factor of 1/2.** sin²x = (1 − cos 2x)/2, not 1 − cos 2x.
- **Stopping halfway on cos⁴x.** The cos²2x term needs a second power reduction.

## Where this goes next

Week 17 combines sum and difference formulas into product-to-sum formulas, and writes a sin x + b cos x as a single sinusoid; sin 2x and cos 2x often appear there after a power reduction. Week 19 solves equations such as sin 2x = cos x and cos 2x = sin x, where the first step is a double-angle formula that turns the equation into one function of x. In Unit 5, De Moivre's theorem produces the double- and triple-angle formulas in one line.

## Self-check

1. If cos θ = 4/5 with θ in quadrant IV, find sin 2θ and cos 2θ.
2. Verify (sin x + cos x)² = 1 + sin 2x.
3. Verify cos⁴x − sin⁴x = cos 2x.
4. Write sin²x cos²x using only first powers of cosine.
5. Find tan(π/8) exactly using tan(x/2) = (1 − cos x)/sin x.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.C.9 (extension), HSF-TF.C.8). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
