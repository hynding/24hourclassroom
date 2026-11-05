# Week 31 · Projectile Motion and Polar Conics

**Topics:** 5.10 Projectile Motion and Parametric Models · 5.11 Polar Equations of Conics
**Standards:** HSN-VM.A.1, HSN-VM.A.3, HSF-TF.C.8 (extension), HSG-GPE.A.3 (extension)
**Spiral:** Week 30's parametric equations give the language: x and y as functions of time, a starting point, and eliminating the parameter. Week 23 split a vector into horizontal and vertical components, |v| cos θ and |v| sin θ, which is exactly how a launch velocity is split. Week 3's right-triangle work and week 5's signs by quadrant appear when you resolve a velocity; weeks 26 and 27's polar coordinates, negative r and symmetry tests are what you need to read a conic written in polar form.

## What you need to be able to do

- **5.10** Write the parametric model of a projectile launched with speed v₀ at angle θ above the horizontal from height h, in feet or metres.
- **5.10** Find the maximum height, the time it occurs, the time of flight and the horizontal range, and decide whether a projectile clears an obstacle.
- **5.10** Eliminate t to show that the path is a parabola, and interpret every constant in context.
- **5.11** Recognise r = ed/(1 ± e cos θ) and r = ed/(1 ± e sin θ), read off the eccentricity e and the directrix, and classify the conic.
- **5.11** Find the vertices of a polar conic, rewrite an equation such as r = 8/(4 − 2 cos θ) in standard form, and write the equation of a conic from its eccentricity and directrix.

## Key terms

| Term | Meaning |
|---|---|
| Projectile | An object moving under gravity alone after launch (air resistance ignored). |
| Launch angle θ | The angle between the initial velocity and the horizontal. |
| Range | The horizontal distance travelled before the projectile returns to the ground (y = 0). |
| Time of flight | The time from launch to landing. |
| Focus–directrix property | A conic is the set of points P with distance(P, focus) = e · distance(P, directrix). |
| Eccentricity e | The constant ratio above: e < 1 ellipse, e = 1 parabola, e > 1 hyperbola. |

## The projectile model (5.10)

Split the launch velocity into components, as with any vector (week 23):

- horizontal velocity v₀ cos θ, which stays constant because nothing pushes sideways;
- vertical velocity v₀ sin θ, which gravity reduces at 32 ft/s² or 9.8 m/s².

Integrating is not needed; the standard models are

| Units | x(t) | y(t) |
|---|---|---|
| feet, seconds | (v₀ cos θ) t | h + (v₀ sin θ) t − 16t² |
| metres, seconds | (v₀ cos θ) t | h + (v₀ sin θ) t − 4.9t² |

The 16 and 4.9 are half of g. Use degrees for θ here, and make sure your calculator is in degree mode.

**Worked example 1.** A hypothetical ball is hit from 4 ft above the ground at 80 ft/s, at 30° above the horizontal. Write the model, and find the maximum height and the range.

v₀ cos 30° = 80(√3/2) = 40√3 ≈ 69.28 and v₀ sin 30° = 40, so x = 40√3 t, y = 4 + 40t − 16t².

Maximum height: y is a quadratic in t, with vertex at t = −40/(2 · (−16)) = 1.25 s. y(1.25) = 4 + 50 − 25 = 29 ft.

Landing: solve 4 + 40t − 16t² = 0, that is 16t² − 40t − 4 = 0. The quadratic formula gives t = (40 + √1856)/32 ≈ 2.596 s (the negative root is before launch). The range is x(2.596) ≈ 69.28 × 2.596 ≈ 179.88 ft.

**Worked example 2.** A hypothetical ball is kicked from the ground at 25 m/s at 50°. Find the time of flight, the range and the maximum height, to the nearest hundredth.

v₀ cos 50° ≈ 16.070 and v₀ sin 50° ≈ 19.151, so x = 16.070t, y = 19.151t − 4.9t². From the ground, y = t(19.151 − 4.9t) = 0 at t = 0 and t = 19.151/4.9 ≈ 3.91 s. Range = x(3.908) ≈ 62.81 m. The top comes halfway through the flight, at t ≈ 1.954 s, where y ≈ 18.71 m.

When h = 0 these become formulas: time of flight 2v₀ sin θ/g, range v₀² sin 2θ/g (week 16's double angle), which is greatest at θ = 45°.

**Worked example 3 (clearing an obstacle).** In example 1, a 10 ft fence stands 150 ft away. Does the ball clear it?

First find **when** the ball reaches the fence: 40√3 t = 150 gives t ≈ 2.165 s. Then find **how high** it is then: y ≈ 4 + 40(2.165) − 16(2.165)² ≈ 15.60 ft. That is more than 10 ft, so it clears the fence by about 5.6 ft.

**Worked example 4 (the path is a parabola).** Eliminate t in example 1. From x = 40√3 t, t = x/(40√3). Substituting,

y = 4 + 40 · x/(40√3) − 16 · x²/4800 = 4 + x/√3 − x²/300.

In general y = h + (tan θ)x − 16x²/(v₀² cos²θ) (or 4.9 in metres): a downward parabola in x. The parametric form is still more useful, because it says when.

## Conics with a focus at the pole (5.11)

Take the focus at the pole and a vertical directrix x = d (d > 0). For a point (r, θ), the distance to the focus is r and the distance to the directrix is d − r cos θ. The focus–directrix property r = e(d − r cos θ) rearranges to r = ed/(1 + e cos θ). The four standard forms are

| Equation | Directrix |
|---|---|
| r = ed/(1 + e cos θ) | x = d (to the right of the pole) |
| r = ed/(1 − e cos θ) | x = −d (to the left) |
| r = ed/(1 + e sin θ) | y = d (above) |
| r = ed/(1 − e sin θ) | y = −d (below) |

**The constant in the denominator must be 1** before you read e. Then e decides the type: 0 < e < 1 ellipse, e = 1 parabola, e > 1 hyperbola. The vertices lie on the axis through the focus, at θ = 0 and π (cosine forms) or θ = π/2 and 3π/2 (sine forms).

**Worked example 5.** Classify r = 8/(4 − 2 cos θ), give its directrix and vertices, and find the length of the major axis.

Divide top and bottom by 4: r = 2/(1 − 0.5 cos θ). So e = 1/2 (an ellipse) and ed = 2, so d = 4: directrix x = −4. At θ = 0, r = 8/2 = 4, the point (4, 0). At θ = π, r = 8/6 = 4/3, the point (−4/3, 0). The major axis runs from x = −4/3 to x = 4, a length of 16/3, with centre (4/3, 0). Check: the focus (the pole) is 4/3 from the centre and a = 8/3, so c/a = 1/2 = e.

**Worked example 6.** Classify r = 6/(2 + 3 sin θ) and find its vertices.

r = 3/(1 + 1.5 sin θ): e = 3/2, a hyperbola; ed = 3 gives d = 2, directrix y = 2. At θ = π/2, r = 6/5: the point (0, 6/5). At θ = 3π/2, r = 6/(2 − 3) = −6, and the polar point (−6, 3π/2) is (0, 6) in rectangular form, because negative r points the opposite way (week 26). Both vertices are on the positive y-axis, one on each branch.

**Worked example 7 (writing an equation).** Write the polar equation of the conic with focus at the pole, eccentricity 2/3 and directrix y = −3.

A horizontal directrix below the pole uses 1 − e sin θ. r = (2/3)(3)/(1 − (2/3) sin θ) = 2/(1 − (2/3) sin θ) = 6/(3 − 2 sin θ). It is an ellipse, since e < 1.

**Parabolas.** r = 5/(1 − cos θ) has e = 1 and d = 5, directrix x = −5; its vertex is at θ = π, where r = 5/2: the point (−5/2, 0), halfway between focus and directrix. At θ = 0 the denominator is 0: the parabola opens to the right and never meets that direction.

**Try it.**
1. A hypothetical stone is thrown from a 20 m cliff at 15 m/s, horizontally (θ = 0°). When does it land, and how far out?
2. Classify r = 10/(5 + 5 sin θ) and give its directrix.
3. Find the vertices of r = 12/(3 + cos θ).

*Answers:* 1. 20 − 4.9t² = 0 gives t ≈ 2.02 s; x = 15 × 2.020 ≈ 30.30 m. 2. r = 2/(1 + sin θ): a parabola with directrix y = 2. 3. r = 4/(1 + (1/3) cos θ), an ellipse; vertices (3, 0) at θ = 0 and (−6, 0) at θ = π.

## Common errors

- **Using −16t² with metres** (or −4.9t² with feet). Check the units in the problem first.
- **Calculator in radian mode** with a launch angle in degrees.
- **Putting the 16 or 4.9 into x(t).** Gravity acts only vertically.
- **Giving the time of the maximum as the maximum height.** Substitute that time into y.
- **Reading e before making the constant 1.** In r = 8/(4 − 2 cos θ), e is 1/2, not 2.
- **Treating ed as d.** In r = 2/(1 − 0.5 cos θ), ed = 2, so d = 4.
- **Plotting a negative r in the direction θ.** (−6, 3π/2) is (0, 6), above the pole.

## Where this goes next

Week 32 uses Euler's formula to write complex numbers as re^(iθ), reproves the sum formulas from it, and rotates points and curves; a rotated conic is one application. The Unit 5 exam asks for projectile models with obstacles and for polar conics with their vertices.

## Self-check

1. A hypothetical arrow is shot from 1.5 m above the ground at 40 m/s and 12°. Write the model and find its maximum height.
2. In example 1, would the ball clear a 25 ft wall 120 ft away?
3. Show that the range of a projectile launched from the ground is v₀² sin 2θ/g, using the formula for time of flight.
4. Classify r = 9/(3 − 6 sin θ) and give its directrix and vertices.
5. Write the polar equation of the parabola with focus at the pole and directrix x = 3.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSN-VM.A.1, HSN-VM.A.3, HSF-TF.C.8, HSG-GPE.A.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
