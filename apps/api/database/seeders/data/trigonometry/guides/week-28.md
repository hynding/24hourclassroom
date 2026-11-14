# Week 28 · Complex Numbers in Trigonometric Form

**Topics:** 5.4 The Complex Plane · 5.5 Trigonometric Form of a Complex Number · 5.6 Products and Quotients in Trigonometric Form
**Standards:** HSN-CN.B.4, HSN-CN.B.5, HSN-CN.B.6
**Spiral:** Algebra 2 introduced i with i² = −1 and arithmetic on a + bi. Week 26's conversions between rectangular and polar points are used here unchanged: the complex number a + bi is the point (a, b), and its trigonometric form uses the same r and θ. Week 15's sum formulas for sine and cosine are the reason products of complex numbers multiply moduli and add arguments, and week 23's vectors give the parallelogram picture of addition.

## What you need to be able to do

- **5.4** Plot a + bi in the complex plane; find its modulus |a + bi| = √(a² + b²); find the distance |z − w| and midpoint of two complex numbers.
- **5.5** Find an argument of a complex number with the correct quadrant, and write z in trigonometric form z = r(cos θ + i sin θ) = r cis θ.
- **5.5** Convert from trigonometric form back to a + bi, exactly at special angles and with a calculator otherwise.
- **5.6** Multiply and divide complex numbers in trigonometric form, and interpret multiplication as a rotation combined with a scaling.

## Key terms

| Term | Meaning |
|---|---|
| Complex plane | A plane with a horizontal real axis and a vertical imaginary axis; a + bi is the point (a, b). |
| Modulus \|z\| | The distance from 0 to z: \|a + bi\| = √(a² + b²). Also called the absolute value. |
| Argument of z | An angle θ from the positive real axis to the ray through z. Any two arguments differ by a multiple of 2π; this course takes 0 ≤ θ < 2π unless an item says otherwise. |
| Trigonometric (polar) form | z = r(cos θ + i sin θ) with r = \|z\| ≥ 0 and θ an argument. |
| cis θ | Shorthand for cos θ + i sin θ. |
| Conjugate z̄ | a − bi, the mirror image of z across the real axis: same modulus, argument −θ. |

## The complex plane (5.4)

The number 3 − 5i sits at the point (3, −5): real part across, imaginary part up. Real numbers lie on the horizontal axis, pure imaginary numbers on the vertical axis.

Because a + bi is a point, Pythagoras gives its distance from 0: the **modulus** |a + bi| = √(a² + b²). For example |7 − 24i| = √(49 + 576) = √625 = 25. Adding complex numbers adds coordinates, exactly like adding vectors (week 23): z + w is the fourth corner of the parallelogram on 0, z and w. Subtracting gives the vector from w to z, so

- the **distance** between z and w is |z − w|;
- the **midpoint** of z and w is (z + w)/2.

**Worked example 1.** Find the distance and midpoint between 1 + 2i and 4 − 2i.

z − w = (1 − 4) + (2 − (−2))i = −3 + 4i, so the distance is |−3 + 4i| = √(9 + 16) = 5. The midpoint is ((1 + 4) + (2 − 2)i)/2 = 5/2 + 0i = 2.5.

## Trigonometric form (5.5)

If z = a + bi has modulus r and argument θ, then a = r cos θ and b = r sin θ (week 26), so

    z = r cos θ + (r sin θ)i = r(cos θ + i sin θ) = r cis θ.

To convert **to** trigonometric form: r = √(a² + b²); then locate the quadrant and use the reference angle from tan θ = b/a. Points on the axes need no tangent: 5i = 5 cis(π/2), −7 = 7 cis π, −5i = 5 cis(3π/2).

**Worked example 2.** Write z = −2 + 2√3 i in trigonometric form.

r = √(4 + 12) = 4. tan θ = 2√3/(−2) = −√3, reference angle π/3. The point (−2, 2√3) is in quadrant II, so θ = π − π/3 = 2π/3. So z = 4 cis(2π/3) = 4(cos(2π/3) + i sin(2π/3)).

**Worked example 3 (calculator).** Write 3 − 4i in trigonometric form, with θ in [0, 2π) to the nearest hundredth.

r = 5. tan⁻¹(−4/3) ≈ −0.927, which is already in quadrant IV, the quadrant of 3 − 4i. To bring it into [0, 2π), add 2π: θ ≈ 5.36. So 3 − 4i ≈ 5 cis 5.36.

To convert **from** trigonometric form, evaluate cosine and sine and distribute.

**Worked example 4.** Write 6 cis(5π/4) in the form a + bi.

cos(5π/4) = sin(5π/4) = −√2/2, so 6 cis(5π/4) = 6(−√2/2) + 6(−√2/2)i = −3√2 − 3√2 i.

Trigonometric form is not unique: 4 cis(2π/3) = 4 cis(8π/3) = 4 cis(−4π/3). When an item asks for 0 ≤ θ < 2π, give that one. Keep r ≥ 0: an expression like −2 cis(π/6) is a correct value (it equals 2 cis(7π/6)) but it is not in trigonometric form.

## Products and quotients (5.6)

Multiply z₁ = r₁ cis θ₁ and z₂ = r₂ cis θ₂ by FOIL:

    z₁z₂ = r₁r₂[(cos θ₁ cos θ₂ − sin θ₁ sin θ₂) + i(sin θ₁ cos θ₂ + cos θ₁ sin θ₂)].

The brackets are week 15's sum formulas, so

    z₁z₂ = r₁r₂ cis(θ₁ + θ₂)    and    z₁/z₂ = (r₁/r₂) cis(θ₁ − θ₂)  (z₂ ≠ 0).

**Multiply the moduli, add the arguments; divide the moduli, subtract the arguments.** Geometrically, multiplying by r₂ cis θ₂ **stretches** by r₂ and **rotates** counterclockwise by θ₂. Multiplying by i = cis(π/2) rotates every point a quarter turn without changing its modulus.

**Worked example 5.** Multiply z₁ = 2 cis(π/3) and z₂ = 5 cis(π/6), and check in rectangular form.

z₁z₂ = 10 cis(π/3 + π/6) = 10 cis(π/2) = 10i.

Check: z₁ = 1 + √3 i and z₂ = 5√3/2 + (5/2)i. FOIL: 5√3/2 + (5/2)i + (15/2)i + (5√3/2)i² = (5√3/2 − 5√3/2) + 10i = 10i. ✓

**Worked example 6.** Find (−2 + 2√3 i)/(1 + i) in trigonometric form, then in rectangular form.

−2 + 2√3 i = 4 cis(2π/3) and 1 + i = √2 cis(π/4). The quotient is (4/√2) cis(2π/3 − π/4) = 2√2 cis(5π/12). Using cos(5π/12) = (√6 − √2)/4 and sin(5π/12) = (√6 + √2)/4 from week 15:

2√2 · (√6 − √2)/4 = (√12 − 2)/2 = √3 − 1, and 2√2 · (√6 + √2)/4 = √3 + 1.

So the quotient is (√3 − 1) + (√3 + 1)i ≈ 0.73 + 2.73i. Multiplying top and bottom by the conjugate 1 − i gives the same answer, and running the comparison the other way is a neat way to *derive* cos 75° and sin 75°.

The conjugate fits the pattern: z̄ = r cis(−θ), so z·z̄ = r² cis 0 = r² = |z|², a real number.

## Common errors

- **Wrong quadrant for the argument.** tan⁻¹(b/a) returns only quadrant I or IV angles. For a < 0, add π.
- **Modulus without the square root.** |3 − 4i| = 5, not 25; and not 3 + 4 = 7.
- **Adding moduli when multiplying.** Moduli multiply; arguments add.
- **Subtracting arguments in the wrong order.** For z₁/z₂ it is θ₁ − θ₂, numerator minus denominator.
- **Negative r.** −3 cis θ is not in trigonometric form; rewrite it as 3 cis(θ + π).
- **Leaving an argument outside the requested interval.** 2π/3 + 5π/3 = 7π/3; reduce it to π/3 if asked for [0, 2π).

## Where this goes next

Week 29 multiplies a number by itself: De Moivre's theorem says (r cis θ)ⁿ = rⁿ cis(nθ), and running it backwards finds all n roots of a complex number, spread evenly round a circle. Week 32 writes r cis θ as re^(iθ) (Euler's formula) and uses multiplication by cis θ to rotate points and vectors.

## Self-check

1. Find |−6 + 8i| and the distance between 2 + i and −1 + 5i.
2. Write −3 − 3i and 4i in trigonometric form with 0 ≤ θ < 2π.
3. Write 8 cis(5π/6) in the form a + bi.
4. Given z = 3 cis(5π/12) and w = 6 cis(π/12), find zw and z/w in trigonometric form and in rectangular form.
5. Explain, with a picture in mind, why multiplying by −1 rotates a point by π.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSN-CN.B.4, HSN-CN.B.5, HSN-CN.B.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
