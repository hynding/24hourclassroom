# Week 17 · Product-to-Sum and Combining a sin x + b cos x

**Topics:** 3.8 Product-to-Sum and Sum-to-Product Formulas · 3.9 Combining a sin x + b cos x
**Standards:** HSF-TF.C.9 (extension), HSF-TF.B.5
**Spiral:** Week 15's sum and difference formulas are the only raw material this week needs: every product-to-sum formula is two of them added or subtracted, and the combined form R sin(x + φ) is the expansion of sin(x + φ) read backwards. Week 5's quadrant rules decide the angle φ, week 8's amplitude and phase shift describe the result, and week 12's sums of sinusoids and beats get an exact explanation.

## What you need to be able to do

- **3.8** Rewrite a product such as sin 5x cos 3x or cos 75° cos 15° as a sum or difference, and evaluate it exactly.
- **3.8** Rewrite a sum or difference such as sin 75° + sin 15° or cos 5x + cos x as a product.
- **3.8** Derive any of the formulas from the sum and difference formulas instead of memorising all eight.
- **3.9** Write a sin x + b cos x as R sin(x + φ) with R = √(a² + b²), choosing φ in the correct quadrant from cos φ = a/R and sin φ = b/R.
- **3.9** Read the maximum, minimum, zeros and phase shift of a sin x + b cos x from the combined form, in exact terms or with a calculator.

## Key terms

| Term | Meaning |
|---|---|
| Product-to-sum formula | An identity that turns a product of two sines or cosines into a sum or difference of sines or cosines. |
| Sum-to-product formula | The reverse: a sum or difference of two sines or two cosines written as a product. |
| Combined (amplitude–phase) form | a sin x + b cos x written as a single sinusoid R sin(x + φ). |
| R | The amplitude of the combined form, √(a² + b²); always positive. |
| φ (phase angle) | The angle with cos φ = a/R and sin φ = b/R; the graph of R sin(x + φ) is R sin x shifted φ to the left. |
| Beats | The slow rise and fall in loudness heard when two tones of nearly equal frequency sound together. |

## Products into sums (3.8)

Write down the two cosine formulas from week 15:

cos(A − B) = cos A cos B + sin A sin B
cos(A + B) = cos A cos B − sin A sin B

Add them and the sine terms cancel: cos(A − B) + cos(A + B) = 2 cos A cos B. Subtract them and the cosine terms cancel: cos(A − B) − cos(A + B) = 2 sin A sin B. The sine formulas, added, give 2 sin A cos B. Dividing by 2:

| Product | Equals |
|---|---|
| sin A cos B | ½[sin(A + B) + sin(A − B)] |
| cos A sin B | ½[sin(A + B) − sin(A − B)] |
| cos A cos B | ½[cos(A − B) + cos(A + B)] |
| sin A sin B | ½[cos(A − B) − cos(A + B)] |

Watch the last line: two sines make a *difference* of cosines, with cos(A − B) first. A quick check catches a slip: put A = B and the last formula says sin²A = ½(1 − cos 2A), which is week 16's power-reducing formula.

**Worked example 1.** Write sin 5x cos 3x as a sum.

A = 5x, B = 3x: sin 5x cos 3x = ½[sin 8x + sin 2x]. Check at x = π/4: the left side is sin(5π/4) cos(3π/4) = (−√2/2)(−√2/2) = 1/2; the right side is ½[sin 2π + sin(π/2)] = ½(0 + 1) = 1/2.

**Worked example 2.** Find the exact value of cos 75° cos 15°.

cos 75° cos 15° = ½[cos 60° + cos 90°] = ½[½ + 0] = ¼. No need for the messy exact values of cos 75° and cos 15°.

Products into sums matter later because sums are easier to integrate, graph and solve than products. In this course their main use is evaluation and the beat explanation below.

## Sums into products (3.8)

Substitute u = A + B and v = A − B in the product-to-sum table, so that A = (u + v)/2 and B = (u − v)/2, and multiply by 2:

| Sum or difference | Equals |
|---|---|
| sin u + sin v | 2 sin((u + v)/2) cos((u − v)/2) |
| sin u − sin v | 2 cos((u + v)/2) sin((u − v)/2) |
| cos u + cos v | 2 cos((u + v)/2) cos((u − v)/2) |
| cos u − cos v | −2 sin((u + v)/2) sin((u − v)/2) |

The pattern is "half the sum, half the difference". The minus sign in the last line is the one everybody forgets.

**Worked example 3.** Find the exact value of sin 75° + sin 15°, and write cos 5x + cos x as a product.

sin 75° + sin 15° = 2 sin 45° cos 30° = 2 · (√2/2) · (√3/2) = √6/2 ≈ 1.225.

cos 5x + cos x = 2 cos 3x cos 2x (half the sum is 3x, half the difference is 2x).

The product form is what you want when an expression must equal zero: week 19 solves sin 3x + sin x = 0 by rewriting it as 2 sin 2x cos x = 0.

**Beats.** Two hypothetical tuning forks at 442 Hz and 438 Hz produce a combined signal sin(2π · 442t) + sin(2π · 438t) = 2 sin(2π · 440t) cos(2π · 2t). You hear a 440 Hz tone whose loudness is controlled by the slow factor 2 cos(2π · 2t). Loudness peaks whenever that factor is +2 or −2, which happens twice per cycle of the 2 Hz cosine, so you hear 4 beats per second: the difference of the two frequencies. This is week 12's "beats" made exact.

## Combining a sin x + b cos x into one sinusoid (3.9)

Graph y = sin x + √3 cos x and it looks exactly like a sine wave with amplitude 2. That is no accident. Expand R sin(x + φ) with week 15's formula:

R sin(x + φ) = (R cos φ) sin x + (R sin φ) cos x.

Matching this with a sin x + b cos x needs R cos φ = a and R sin φ = b. Squaring and adding gives R² = a² + b², so

**a sin x + b cos x = R sin(x + φ), where R = √(a² + b²), cos φ = a/R, sin φ = b/R.**

The signs of a and b fix the quadrant of φ: a is the "x-coordinate" and b the "y-coordinate" of the point (a, b), and φ is that point's direction angle. tan φ = b/a is true, but tan⁻¹(b/a) only returns angles in (−π/2, π/2), so it is wrong whenever a < 0.

**Worked example 4.** Write sin x + √3 cos x in the form R sin(x + φ), then find its maximum and the first x ≥ 0 where it occurs (radians).

a = 1, b = √3, so R = √(1 + 3) = 2. cos φ = 1/2 and sin φ = √3/2, so φ = π/3. Hence sin x + √3 cos x = 2 sin(x + π/3).

The maximum is R = 2, when x + π/3 = π/2, so x = π/6. Check: sin(π/6) + √3 cos(π/6) = 1/2 + 3/2 = 2.

**Worked example 5 (quadrant care).** Write −sin x + cos x as R sin(x + φ).

a = −1, b = 1, R = √2. cos φ = −1/√2 and sin φ = 1/√2 place φ in quadrant II: φ = 3π/4. So −sin x + cos x = √2 sin(x + 3π/4).

The tempting shortcut tan⁻¹(b/a) = tan⁻¹(−1) = −π/4 gives √2 sin(x − π/4), which is the *negative* of the right answer. Test x = 0: the original is 1, √2 sin(3π/4) = 1, but √2 sin(−π/4) = −1.

**Worked example 6 (calculator, a hypothetical spring).** A mass on a spring has displacement d(t) = 3 sin 2t + 4 cos 2t centimetres, t in seconds. Find the amplitude and the first time after t = 0 at which the displacement is greatest.

The same method works with 2t in place of x. R = √(9 + 16) = 5. cos φ = 3/5, sin φ = 4/5, so φ is in quadrant I and φ = tan⁻¹(4/3) ≈ 0.927. So d(t) = 5 sin(2t + 0.927): amplitude 5 cm, period π s.

The greatest displacement, 5 cm, occurs when 2t + 0.927 = π/2, so t ≈ (1.571 − 0.927)/2 ≈ 0.322 s.

**What the combined form tells you.** For R sin(x + φ):

- maximum R and minimum −R, so the range is [−R, R];
- the same period as the pieces, 2π (or 2π/|k| if the angle is kx);
- a horizontal shift of φ to the left;
- zeros where x + φ = nπ.

A cosine form also works: a sin x + b cos x = R cos(x − θ) with cos θ = b/R and sin θ = a/R. Either form is fine if you state it clearly.

## Common errors

- **Sign in sin A sin B.** It is ½[cos(A − B) − cos(A + B)], not ½[cos(A + B) − cos(A − B)].
- **Forgetting the ½ or the 2.** Product-to-sum carries ½; sum-to-product carries 2.
- **The lost minus.** cos u − cos v = −2 sin((u + v)/2) sin((u − v)/2).
- **R = a + b.** R = √(a² + b²): the maximum of 3 sin x + 4 cos x is 5, not 7.
- **φ from tan⁻¹ alone.** When a < 0, add π to tan⁻¹(b/a), or use the signs of cos φ and sin φ directly.
- **Degree/radian mix.** If x is in radians, φ must be in radians too.

## Where this goes next

Week 18 solves trigonometric equations; week 19 uses this week's tools to solve harder ones, such as sin 3x + sin x = 0 (sum-to-product) and sin x + √3 cos x = 1 (combine first, then solve one sine equation). In Unit 4, the combined form returns when vector components are added, and in Unit 5, Euler's formula gives the cleanest derivation of all of these identities.

## Self-check

1. Write cos 4x cos 2x as a sum.
2. Find the exact value of sin 105° sin 15°.
3. Write sin 7x − sin 3x as a product.
4. Write √3 sin x − cos x in the form R sin(x + φ), and give its maximum value and the first x ≥ 0 where it occurs.
5. Explain why the maximum of 5 sin x − 12 cos x is 13.

*Answers:* 1. ½(cos 2x + cos 6x). 2. ½(cos 90° − cos 120°) = ½(0 + ½) = ¼. 3. 2 cos 5x sin 2x. 4. R = 2, φ = −π/6: 2 sin(x − π/6); maximum 2 at x = 2π/3. 5. It equals 13 sin(x + φ) for some φ, because √(25 + 144) = 13, and a sine reaches 1.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.C.9, HSF-TF.B.5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
