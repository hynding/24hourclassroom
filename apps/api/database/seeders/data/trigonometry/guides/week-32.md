# Week 32 · Euler's Formula and Rotations

**Topics:** 5.12 Euler's Formula and Rotations
**Standards:** HSN-CN.B.5 (extension), HSN-CN.B.4, HSF-TF.C.9, HSN-VM.A.1
**Spiral:** This week ties the whole course together. Week 28 wrote complex numbers as r cis θ and multiplied them by multiplying moduli and adding arguments; week 29's De Moivre theorem raised them to powers. Week 15's sum formulas, week 16's double-angle formulas and week 6's unit circle all reappear, now derived in one line each. Week 23's vectors and week 26's polar coordinates are rotated here, and week 30's circle x = r cos t, y = r sin t becomes a single complex expression.

## What you need to be able to do

- **5.12** State Euler's formula e^(iθ) = cos θ + i sin θ and explain why it is consistent with the product and power rules for complex numbers in trigonometric form.
- **5.12** Convert between a + bi, r cis θ and re^(iθ), and evaluate e^(iθ) at special angles, including e^(iπ) + 1 = 0.
- **5.12** Derive the sum and double-angle formulas for sine and cosine by expanding e^(i(α + β)) = e^(iα)e^(iβ).
- **5.12** Rotate a point or vector about the origin by θ, by multiplying by e^(iθ) or with (x cos θ − y sin θ, x sin θ + y cos θ), and rotate about another centre by translating first.

## Key terms

| Term | Meaning |
|---|---|
| cis θ | Shorthand for cos θ + i sin θ, the point on the unit circle at angle θ. |
| Euler's formula | e^(iθ) = cos θ + i sin θ, with θ in radians. |
| Exponential form | z = re^(iθ), where r = |z| and θ is an argument of z. |
| Euler's identity | e^(iπ) + 1 = 0, Euler's formula at θ = π. |
| Rotation about the origin | The map sending each point to the point at the same distance from the origin, turned through angle θ (counterclockwise for θ > 0). |
| Conjugate on the unit circle | e^(−iθ) = cos θ − i sin θ, the reflection of e^(iθ) across the real axis. |

## Why cis θ behaves like an exponential (5.12)

From week 28, multiplying complex numbers in trigonometric form adds their arguments:

cis α · cis β = cis(α + β), and (cis θ)ⁿ = cis(nθ) (De Moivre, week 29).

These are exactly the laws of exponents: a^α · a^β = a^(α + β) and (a^θ)ⁿ = a^(nθ). Also cis 0 = 1, like a⁰ = 1. A function that turns addition of inputs into multiplication of outputs is exponential, and the right base turns out to be e, with an i in the exponent. Calculus confirms it, but in this course we **state** the result:

**e^(iθ) = cos θ + i sin θ** (θ in radians).

So every complex number can be written z = re^(iθ), and the rules become

- re^(iα) · se^(iβ) = rs e^(i(α + β));
- re^(iα) / se^(iβ) = (r/s) e^(i(α − β));
- (re^(iθ))ⁿ = rⁿ e^(inθ).

**Worked example 1.** Evaluate e^(iπ/2), e^(iπ), e^(2πi/3) and 2e^(iπ/4) in the form a + bi.

- e^(iπ/2) = cos(π/2) + i sin(π/2) = i.
- e^(iπ) = cos π + i sin π = −1, so e^(iπ) + 1 = 0: one line linking e, i, π, 1 and 0.
- e^(2πi/3) = −1/2 + (√3/2)i.
- 2e^(iπ/4) = 2(√2/2 + (√2/2)i) = √2 + √2 i.

Note that |e^(iθ)| = √(cos²θ + sin²θ) = 1 for every real θ: e^(iθ) always lies on the unit circle. Week 30's circle x = r cos t, y = r sin t is simply z(t) = re^(it).

**Worked example 2.** Write z = −3 + 3√3 i in exponential form, and find z⁴.

r = √(9 + 27) = 6. The point (−3, 3√3) is in quadrant II with reference angle π/3, so θ = 2π/3 and z = 6e^(2πi/3). Then z⁴ = 6⁴ e^(8πi/3) = 1296 e^(2πi/3) (since 8π/3 − 2π = 2π/3) = 1296(−1/2 + (√3/2)i) = −648 + 648√3 i.

## Deriving identities from Euler (5.12)

Euler's formula turns a page of trigonometric identities into algebra.

**Worked example 3 (sum formulas).** Expand both sides of e^(i(α + β)) = e^(iα) · e^(iβ).

Left: cos(α + β) + i sin(α + β).

Right: (cos α + i sin α)(cos β + i sin β) = (cos α cos β − sin α sin β) + i(sin α cos β + cos α sin β), using i² = −1.

Two complex numbers are equal only if their real parts and imaginary parts are equal, so

cos(α + β) = cos α cos β − sin α sin β and sin(α + β) = sin α cos β + cos α sin β,

exactly week 15's formulas. Replacing β by −β (and using e^(−iβ) = cos β − i sin β) gives the difference formulas.

**Double angles.** With α = β = θ: (cos θ + i sin θ)² = cos²θ − sin²θ + 2i sin θ cos θ, so cos 2θ = cos²θ − sin²θ and sin 2θ = 2 sin θ cos θ. Cubing instead gives the triple-angle formulas.

**Cosine and sine as averages.** Adding e^(iθ) = cos θ + i sin θ and e^(−iθ) = cos θ − i sin θ gives

cos θ = (e^(iθ) + e^(−iθ))/2 and sin θ = (e^(iθ) − e^(−iθ))/(2i).

## Rotations (5.12)

Multiplying by e^(iθ) multiplies the modulus by 1 and adds θ to the argument, so it **rotates every point about the origin by θ, counterclockwise**, without changing distances. Multiplying by i = e^(iπ/2) is a 90° turn; by −1 = e^(iπ) a half-turn.

Write the point (x, y) as x + iy and multiply:

(x + iy)(cos θ + i sin θ) = (x cos θ − y sin θ) + i(x sin θ + y cos θ).

So the rotation by θ sends **(x, y) to (x cos θ − y sin θ, x sin θ + y cos θ)**. The same formula rotates a vector ⟨x, y⟩, and its magnitude is unchanged. Rotating by θ and then by φ is one rotation by θ + φ; rotating by −θ undoes a rotation by θ. Angles may be given in degrees for geometry problems; e^(iθ) itself needs radians.

**Worked example 4.** Rotate (4, 2) by 90° counterclockwise about the origin.

(4 + 2i) · i = 4i + 2i² = −2 + 4i, the point (−2, 4). In general a 90° turn sends (x, y) to (−y, x). Check: both points are √20 from the origin, and ⟨4, 2⟩ · ⟨−2, 4⟩ = 0, so they are perpendicular (week 24's dot product).

**Worked example 5.** Rotate (3, 1) by 60° counterclockwise about the origin.

cos 60° = 1/2 and sin 60° = √3/2:

x′ = 3(1/2) − 1(√3/2) = (3 − √3)/2 ≈ 0.634, y′ = 3(√3/2) + 1(1/2) = (3√3 + 1)/2 ≈ 3.098.

**Worked example 6 (another centre).** Rotate P(5, 1) by 90° counterclockwise about C(2, −1).

Translate so C is at the origin: P − C = (3, 2). Rotate by 90°: (−2, 3). Translate back: (−2 + 2, 3 − 1) = (0, 2). In complex numbers: P′ = C + i(P − C).

**Worked example 7 (an equilateral triangle).** O is the origin and A = (4, 2). Find B so that OAB is equilateral, with B counterclockwise from A.

B is A rotated by 60° about O: B = (4 · 1/2 − 2 · √3/2, 4 · √3/2 + 2 · 1/2) = (2 − √3, 2√3 + 1) ≈ (0.268, 4.464). The rotation keeps |OB| = |OA| = √20, and the 60° angle at O makes the triangle equilateral.

**Try it.**
1. Write 5e^(−iπ/2) and 4e^(5πi/6) in the form a + bi.
2. Rotate (−1, 3) by 180° and by 45° about the origin.
3. Use e^(3iθ) = (e^(iθ))³ to find cos 3θ in terms of cos θ and sin θ.

*Answers:* 1. −5i; −2√3 + 2i. 2. (1, −3); ((−1 − 3)(√2/2), (−1 + 3)(√2/2)) = (−2√2, √2). 3. The real part of (cos θ + i sin θ)³: cos 3θ = cos³θ − 3 cos θ sin²θ.

## The course in one table

| Idea | As a complex number |
|---|---|
| Polar point (r, θ) | re^(iθ) |
| Vector of length r at direction θ | r⟨cos θ, sin θ⟩ ↔ re^(iθ) |
| Circle of radius r, counterclockwise (week 30) | z(t) = re^(it) |
| Product and quotient (week 28) | multiply moduli, add (subtract) exponents |
| De Moivre (week 29) | (re^(iθ))ⁿ = rⁿe^(inθ) |
| nth roots of unity (week 29) | e^(2πik/n), k = 0, 1, …, n − 1 |
| Sum formulas (week 15) | real and imaginary parts of e^(iα)e^(iβ) |

## Common errors

- **Using degrees in e^(iθ).** e^(i · 90) is not i; e^(iπ/2) is.
- **Rotating clockwise.** Positive θ turns counterclockwise; e^(−iθ) turns clockwise.
- **Sign slips in the rotation formula.** x′ = x cos θ − y sin θ has the minus; y′ = x sin θ + y cos θ does not.
- **Rotating about the wrong centre.** About C, subtract C first, rotate, then add C back.
- **Adding moduli** when multiplying: re^(iα) · se^(iβ) has modulus rs.
- **Thinking |e^(iθ)| depends on θ.** It is always 1 for real θ.

## Where this goes next

Weeks 33 and 34 review the whole year for the final exam. Euler's formula reappears in calculus, in alternating-current circuits, in signal processing (every wave is a sum of e^(iωt) terms) and in computer graphics, where every rotation of an image uses the formula in this guide.

## Self-check

1. Evaluate e^(7πi/6) and 3e^(iπ/3) in the form a + bi.
2. Show that e^(iπ/4) · e^(iπ/12) = e^(iπ/3), and use it to check that cos(π/4 + π/12) = 1/2.
3. Derive cos(α − β) from Euler's formula.
4. Rotate (2, −5) by 90° about the origin, and by 90° about (1, 1).
5. A vector ⟨6, 8⟩ is rotated by 30°. What is its new magnitude, and what are its new components to two decimal places?

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSN-CN.B.4, HSN-CN.B.5, HSF-TF.C.9, HSN-VM.A.1). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
