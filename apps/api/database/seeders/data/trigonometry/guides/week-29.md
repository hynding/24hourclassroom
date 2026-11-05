# Week 29 · De Moivre's Theorem and Complex Roots

**Topics:** 5.7 De Moivre's Theorem · 5.8 Roots of Complex Numbers
**Standards:** HSN-CN.B.5 (extension: powers and roots in trigonometric form), HSN-CN.B.4, HSN-CN.C.7
**Spiral:** Week 28's product rule (multiply moduli, add arguments) applied to a number times itself is De Moivre's theorem. Week 28's conversions to and from trigonometric form start and finish every problem, week 27's polar circles r = constant are where the roots of a number sit, week 16's double-angle formulas fall out of De Moivre with n = 2, and Algebra 2's quadratic formula gives a check on square roots and cube roots of real numbers.

## What you need to be able to do

- **5.7** Raise a complex number to a whole-number power with De Moivre's theorem, and convert the answer to a + bi.
- **5.7** Use De Moivre's theorem to derive multiple-angle identities such as cos 3θ = 4 cos³θ − 3 cos θ.
- **5.8** Find all n of the nth roots of a nonzero complex number, in trigonometric form and, at special angles, in the form a + bi.
- **5.8** Describe the nth roots as the vertices of a regular n-gon centred at 0, and use the nth roots of unity.
- **5.8** Solve equations such as z³ = 8 and z⁴ = −16 over the complex numbers.

## Key terms

| Term | Meaning |
|---|---|
| De Moivre's theorem | [r cis θ]ⁿ = rⁿ cis(nθ) for every positive integer n. |
| nth root of w | Any complex number z with zⁿ = w. A nonzero w has exactly n distinct nth roots. |
| Principal root | The root with k = 0 in the root formula (smallest argument when θ is taken in [0, 2π)). |
| nth roots of unity | The n solutions of zⁿ = 1: cis(2πk/n) for k = 0, 1, …, n − 1. |
| Regular n-gon | A polygon with n equal sides and equal angles; the nth roots of any w ≠ 0 are its vertices. |

## De Moivre's theorem (5.7)

Week 28's product rule, applied to z · z, gives z² = r² cis(2θ). Multiplying by z again gives z³ = r³ cis(3θ), and so on:

    [r(cos θ + i sin θ)]ⁿ = rⁿ(cos nθ + i sin nθ).

**Raise the modulus to the power; multiply the argument by the power.** Expanding (a + bi)⁸ by the binomial theorem takes nine terms; De Moivre takes two lines.

**Worked example 1.** Find (1 + i)⁸.

1 + i = √2 cis(π/4). So (1 + i)⁸ = (√2)⁸ cis(8 · π/4) = 16 cis(2π) = 16(1 + 0i) = 16.

Quick check: (1 + i)² = 1 + 2i + i² = 2i, so (1 + i)⁸ = (2i)⁴ = 16i⁴ = 16. ✓

**Worked example 2.** Find (√3 − i)⁶.

|√3 − i| = 2, and the point (√3, −1) is in quadrant IV with reference angle π/6, so √3 − i = 2 cis(11π/6). Then (√3 − i)⁶ = 2⁶ cis(66π/6) = 64 cis(11π). Since 11π = π + 5 · 2π, this is 64 cis π = −64. (Using the argument −π/6 instead gives 64 cis(−π) = −64 too: any argument works.)

**Worked example 3.** Write (−1 + √3 i)⁵ in the form a + bi.

−1 + √3 i = 2 cis(2π/3). The fifth power is 32 cis(10π/3) = 32 cis(4π/3), because 10π/3 − 2π = 4π/3. cos(4π/3) = −1/2 and sin(4π/3) = −√3/2, so the answer is −16 − 16√3 i.

**Identities from De Moivre.** With r = 1 and n = 3, (cos θ + i sin θ)³ = cos 3θ + i sin 3θ. Expand the left side with the binomial theorem:

cos³θ + 3i cos²θ sin θ − 3 cos θ sin²θ − i sin³θ.

Matching real parts: cos 3θ = cos³θ − 3 cos θ sin²θ = cos³θ − 3 cos θ(1 − cos²θ) = 4 cos³θ − 3 cos θ. Matching imaginary parts gives sin 3θ = 3 sin θ − 4 sin³θ. With n = 2 the same move produces week 16's cos 2θ = cos²θ − sin²θ and sin 2θ = 2 sin θ cos θ.

## nth roots (5.8)

To solve zⁿ = w with w = r cis θ, write z = s cis φ. De Moivre gives sⁿ cis(nφ) = r cis θ, so

- the moduli match: sⁿ = r, so s = ⁿ√r (the ordinary positive real root);
- the arguments match up to full turns: nφ = θ + 2πk, so φ = (θ + 2πk)/n.

The values k = 0, 1, …, n − 1 give n different angles; k = n repeats k = 0. So

    the nth roots of r cis θ are ⁿ√r cis((θ + 2πk)/n),  k = 0, 1, …, n − 1.

All the roots have the same modulus, so they lie on the circle of radius ⁿ√r, and consecutive arguments differ by 2π/n: **the roots are the vertices of a regular n-gon** centred at 0. Find the first one, then keep adding 2π/n.

**Worked example 4.** Solve z³ = 8.

8 = 8 cis 0. The cube roots are ∛8 cis(2πk/3) = 2 cis 0, 2 cis(2π/3), 2 cis(4π/3), that is,

    z = 2,  z = −1 + √3 i,  z = −1 − √3 i.

They form an equilateral triangle on the circle of radius 2. Check with algebra: z³ − 8 = (z − 2)(z² + 2z + 4), and the quadratic formula on z² + 2z + 4 = 0 gives z = −1 ± √3 i. ✓

**Worked example 5.** Solve z⁴ = −16.

−16 = 16 cis π. The fourth roots are ⁴√16 cis((π + 2πk)/4) = 2 cis(π/4 + kπ/2):

| k | argument | root |
|---|---|---|
| 0 | π/4 | √2 + √2 i |
| 1 | 3π/4 | −√2 + √2 i |
| 2 | 5π/4 | −√2 − √2 i |
| 3 | 7π/4 | √2 − √2 i |

They are the corners of a square of "radius" 2. Note that 2i is *not* a root, even though |2i| = 2: (2i)⁴ = 16i⁴ = 16, not −16. A root needs the right modulus **and** the right argument.

**Worked example 6.** Find the cube roots of 8i.

8i = 8 cis(π/2). The cube roots are 2 cis((π/2 + 2πk)/3) = 2 cis(π/6), 2 cis(5π/6), 2 cis(3π/2):

    √3 + i,  −√3 + i,  −2i.

**Roots of unity.** The sixth roots of 1 are cis(πk/3): 1, 1/2 + (√3/2)i, −1/2 + (√3/2)i, −1, −1/2 − (√3/2)i, 1/2 − (√3/2)i, a regular hexagon with a vertex at 1. Two useful facts: the nth roots of unity add up to 0 (the polygon is balanced about its centre), and every nth root of w is the principal root multiplied by an nth root of unity, which is just a rotation by a multiple of 2π/n.

**Square roots without trigonometry.** Sometimes algebra is quicker: to find the square roots of −5 + 12i, try (a + bi)² = a² − b² + 2abi, so a² − b² = −5 and ab = 6, giving a = 2, b = 3. The roots are ±(2 + 3i). The trigonometric method gives the same pair, opposite each other on a circle of radius √13.

## Common errors

- **Multiplying the modulus by n.** De Moivre raises it to the power: |z⁴| = |z|⁴, so |z| = 3 gives |z⁴| = 81, not 12.
- **Stopping at one root.** A nonzero number has n nth roots; z⁴ = −16 has four solutions, none of them real.
- **Dividing only θ by n.** The general argument is (θ + 2πk)/n; forgetting the 2πk gives a single root.
- **Using a negative real root for the modulus.** The modulus of each root is the positive real root ⁿ√r.
- **Leaving arguments unreduced.** cis(11π) is cis π; reduce before evaluating.

## Where this goes next

Week 30 leaves the complex plane for parametric equations, where a point's x- and y-coordinates both depend on time; the unit circle reappears as x = cos t, y = sin t. Week 32 rewrites cis θ as e^(iθ), so that De Moivre's theorem becomes the exponent law (e^(iθ))ⁿ = e^(inθ), and the roots of unity become e^(2πik/n).

## Self-check

1. Find (1 − √3 i)⁴ in the form a + bi.
2. Find (2 cis(5π/12))⁶.
3. Find all cube roots of −27 and draw them.
4. Solve z⁶ = 64 and say which polygon the solutions form.
5. Use De Moivre with n = 2 to derive the double-angle formulas for cos 2θ and sin 2θ.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSN-CN.B.4, HSN-CN.B.5, HSN-CN.C.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
