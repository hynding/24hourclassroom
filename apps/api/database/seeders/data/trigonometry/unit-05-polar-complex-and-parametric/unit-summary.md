# Unit 5 · Polar Coordinates, Complex Numbers and Parametric Equations · The night-before sheet

**Topics:** 5.1 Polar Coordinates · 5.2 Converting Polar and Rectangular Equations · 5.3 Graphs of Polar Equations · 5.4 The Complex Plane · 5.5 Trigonometric Form of a Complex Number · 5.6 Products and Quotients in Trigonometric Form · 5.7 De Moivre's Theorem · 5.8 Roots of Complex Numbers · 5.9 Parametric Equations and Eliminating the Parameter · 5.10 Projectile Motion and Parametric Models · 5.11 Polar Equations of Conics · 5.12 Euler's Formula and Rotations
**Standards:** HSN-CN.A.3, HSN-CN.B.4, HSN-CN.B.5, HSN-CN.B.6, HSN-VM.A.1, HSN-VM.A.3, HSF-TF.C.8, HSF-TF.C.9, with extensions (polar graphs and conics, De Moivre's theorem, Euler's formula)
**Spiral:** Everything in this unit rests on Unit 1's x = r cos θ, y = r sin θ and the unit circle, Unit 3's sum formulas and Unit 4's vectors. Radians are the default; projectiles and rotations in geometry problems often use degrees, and every item says which.

## The ideas that generate every question

1. **A point can be named by direction and distance.** (r, θ) means "face θ, walk r"; a negative r walks backwards. Every point has infinitely many polar names: (r, θ + 2πk) and (−r, θ + π + 2πk).
2. **Conversion is Unit 1 trigonometry.** x = r cos θ, y = r sin θ, r² = x² + y², tan θ = y/x, and the quadrant of (x, y) decides θ, not the calculator.
3. **Polar equations convert by substitution.** Multiply by r when it helps (r = 6 cos θ → r² = 6r cos θ → x² + y² = 6x), and use r cos θ = x, r sin θ = y.
4. **Polar graphs are read from a table of r against θ.** Circles r = a cos θ, a sin θ; limaçons a + b cos θ (inner loop if |a| < |b|, cardioid if |a| = |b|); roses a cos nθ (n petals for odd n, 2n for even n); lemniscates r² = a² cos 2θ. Zeros of r are where the curve meets the pole; the largest |r| is the farthest point.
5. **A complex number is a point and a vector.** a + bi sits at (a, b); |z| = √(a² + b²) is its distance from 0; its argument is its direction. Trigonometric form z = r cis θ is polar form.
6. **Multiplying multiplies lengths and adds angles.** Dividing divides lengths and subtracts angles. Powers: (r cis θ)ⁿ = rⁿ cis nθ (De Moivre).
7. **nth roots are equally spaced.** The n roots of r cis θ have modulus ⁿ√r and arguments (θ + 2πk)/n, k = 0, …, n − 1: a regular n-gon centred at 0.
8. **Parametric equations add time.** x = f(t), y = g(t) give where and when; eliminate t by substitution or with sin²t + cos²t = 1, and keep the restrictions the parameter imposes.
9. **Projectiles split into two motions.** Horizontal at constant speed v₀ cos θ; vertical starting at v₀ sin θ and pulled down by gravity (16t² ft or 4.9t² m). Solve x(t) = distance for "when", then use y(t) for "how high".
10. **Conics with a focus at the pole have one formula.** r = ed/(1 ± e cos θ) or ed/(1 ± e sin θ), after making the constant 1. e classifies, d locates the directrix, and θ = 0, π (or π/2, 3π/2) give the vertices.
11. **e^(iθ) = cos θ + i sin θ.** Multiplying by e^(iθ) rotates about the origin by θ; expanding e^(i(α + β)) = e^(iα)e^(iβ) reproduces the sum formulas.

## Key formulas

| Want | Use |
|---|---|
| Polar → rectangular | x = r cos θ, y = r sin θ |
| Rectangular → polar | r = √(x² + y²); tan θ = y/x, then place θ in the quadrant of (x, y) |
| Same point | (r, θ) = (r, θ + 2πk) = (−r, θ + π) |
| Circle through the pole | r = 2a cos θ ↔ (x − a)² + y² = a²; r = 2a sin θ ↔ x² + (y − a)² = a² |
| Vertical / horizontal line | x = a ↔ r = a sec θ; y = b ↔ r = b csc θ |
| Rose a cos nθ or a sin nθ | petal length |a|; n petals (n odd), 2n petals (n even) |
| Limaçon a + b cos θ | |a| < |b| inner loop; = cardioid; |a| ≥ 2|b| convex; otherwise dimpled |
| Modulus and argument | |a + bi| = √(a² + b²); argument from tan θ = b/a with a quadrant check |
| Product, quotient | r₁r₂ cis(θ₁ + θ₂); (r₁/r₂) cis(θ₁ − θ₂) |
| De Moivre | (r cis θ)ⁿ = rⁿ cis(nθ) |
| nth roots | ⁿ√r cis((θ + 2πk)/n), k = 0, 1, …, n − 1 |
| Circle / ellipse, parametric | x = h + a cos t, y = k + b sin t (counterclockwise) |
| Segment P to Q | P + t(Q − P), 0 ≤ t ≤ 1 |
| Projectile | x = (v₀ cos θ)t; y = h + (v₀ sin θ)t − 16t² (ft) or − 4.9t² (m) |
| Top of the flight | t = v₀ sin θ/g (g = 32 ft/s² or 9.8 m/s²) |
| Polar conic | r = ed/(1 ± e cos θ): directrix x = ±d; r = ed/(1 ± e sin θ): directrix y = ±d |
| Euler | e^(iθ) = cos θ + i sin θ; e^(iπ) + 1 = 0 |
| Rotation by θ | (x, y) → (x cos θ − y sin θ, x sin θ + y cos θ); about C: C + e^(iθ)(P − C) |

## Classic question types and how to attack them

**"Convert this point."** Sketch the quadrant first. For (−3, −3√3): r = 6, reference angle π/3, quadrant III, so θ = 4π/3, not tan⁻¹(√3) = π/3.

**"Describe this polar graph."** Name the family from the equation, then find zeros of r, the maximum |r| and the symmetry. For r = 1 + 2 sin θ: inner-loop limaçon, through the pole at 7π/6 and 11π/6, farthest point (0, 3), symmetric about the line θ = π/2.

**"Multiply, divide or raise to a power."** Convert to trigonometric form, work on moduli and arguments, convert back only if asked. (1 − i)⁸ = (√2)⁸ cis(−2π) = 16.

**"Find all the roots."** Write the number in trigonometric form, take the nth root of the modulus, divide the argument by n, and add 2π/n repeatedly until you have n roots. Check one by raising it to the nth power.

**"Eliminate the parameter."** Linear in t: solve and substitute. Sines and cosines: isolate them and square-and-add. Then state the restriction (x = √t ≥ 0, x = 2 sin t on [−2, 2]).

**"Does the projectile clear the wall?"** Find the time from x(t) = distance, then the height from y(t). Compare. For the landing time, solve y(t) = 0 and keep the positive root.

**"Classify the conic and find its vertices."** Divide so the denominator starts with 1. Read e and ed, then d. Evaluate r at the two axis angles and convert to rectangular, minding negative r.

**"Rotate this point."** Multiply x + iy by cos θ + i sin θ, or use the formula. About another centre, translate first and back after.

## Common errors

- Trusting tan⁻¹ for θ when x < 0; the answer is off by π.
- Plotting (−r, θ) in the direction θ instead of θ + π.
- Petal counts: 2n only when n is even.
- Adding moduli when multiplying complex numbers; multiplying arguments instead of adding them.
- Giving only one root, or spacing roots by 2π instead of 2π/n.
- Dropping the restriction after eliminating a parameter, or ignoring orientation.
- −16t² with metres, −4.9t² with feet; radian mode for a launch angle in degrees.
- Reading e from r = 8/(4 − 2 cos θ) as 2: divide by 4 first, e = 1/2.
- Degrees inside e^(iθ); a minus sign lost in x cos θ − y sin θ.

## Calculator or not?

Exact values, conversions at special angles, De Moivre and roots, polar graph features, eliminating parameters and conic classification are all designed to be done by hand. Use a calculator, in the right mode, for non-special arguments (tan⁻¹ with a quadrant check), projectile times and heights, and rotations by angles such as 25°. Round only at the end.

## Self-test

1. Convert (−2, 2√3) to polar form with r > 0, 0 ≤ θ < 2π, and convert r = −4 cos θ to rectangular form.
2. Describe r = 3 cos 2θ: number of petals, petal length and where it meets the pole on [0, 2π).
3. Write −2 + 2√3 i in trigonometric form and find its cube.
4. Find the square roots of −2 + 2√3 i.
5. Eliminate the parameter from x = 3 + 2 cos t, y = −1 + 2 sin t.
6. A ball is struck from the ground at 40 m/s and 30°. Find its maximum height and its range, to the nearest hundredth.
7. Classify r = 12/(3 + 6 cos θ) and find its vertices.
8. Rotate (5, 1) by 90° counterclockwise about (2, −1).

**Answers.**
1. (4, 2π/3); r² = −4r cos θ gives x² + y² = −4x, the circle (x + 2)² + y² = 4.
2. 4 petals of length 3; r = 0 at θ = π/4, 3π/4, 5π/4, 7π/4.
3. 4 cis(2π/3); 64 cis(2π) = 64.
4. 2 cis(π/3) = 1 + √3 i and 2 cis(4π/3) = −1 − √3 i.
5. (x − 3)² + (y + 1)² = 4, a circle of radius 2 traced counterclockwise.
6. x = 20√3 t, y = 20t − 4.9t²: top at t ≈ 2.04 s, height ≈ 20.41 m; lands at t ≈ 4.08 s, range ≈ 141.39 m.
7. r = 4/(1 + 2 cos θ): a hyperbola, e = 2, directrix x = 2; vertices (4/3, 0) and, from r = −4 at θ = π, (4, 0).
8. (0, 2).

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSN-CN.A.3, HSN-CN.B.4–6, HSN-VM.A.1, HSN-VM.A.3, HSF-TF.C.8–9). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
