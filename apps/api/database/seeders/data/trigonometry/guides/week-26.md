# Week 26 · Polar Coordinates

**Topics:** 5.1 Polar Coordinates · 5.2 Converting Polar and Rectangular Equations
**Standards:** HSN-CN.B.4 (extension: polar coordinates of points), HSF-TF.A.2, HSF-TF.C.8
**Spiral:** Week 5 defined sin θ = y/r and cos θ = x/r for a point (x, y) at distance r from the origin; this week turns those definitions around to locate points by r and θ instead of x and y. Week 6's unit-circle values give exact conversions, week 11's inverse tangent supplies an angle when the values are not special (with the quadrant care it always needs), week 21's Law of Cosines measures the distance between two polar points, and week 23's magnitude and direction angle of a vector are the same calculation as rectangular-to-polar conversion.

## What you need to be able to do

- **5.1** Plot a point (r, θ) on a polar grid, including points with negative r and negative or large θ.
- **5.1** Give several polar names for the same point, using (r, θ + 2πn) and (−r, θ + π + 2πn).
- **5.1** Convert points from polar to rectangular form with x = r cos θ, y = r sin θ.
- **5.1** Convert points from rectangular to polar form with r = √(x² + y²) and tan θ = y/x, choosing θ in the correct quadrant.
- **5.2** Convert equations both ways, and recognise the circles and lines that polar equations such as r = 4 sin θ and r = 3 sec θ describe.

Radians are the default this unit. Degrees appear only where a context (a radar bearing, a vector) asks for them.

## Key terms

| Term | Meaning |
|---|---|
| Pole | The fixed origin of the polar system, the point (0, θ) for every θ. |
| Polar axis | The ray from the pole along the positive x-axis; θ is measured from it, counterclockwise positive. |
| Polar coordinates (r, θ) | The point reached by turning through θ from the polar axis and moving a directed distance r along that ray. |
| Negative r | Move \|r\| units along the ray opposite the terminal ray of θ, that is, along θ + π. |
| Polar equation | An equation in r and θ; its graph is every point with at least one polar name that satisfies it. |
| Conversion formulas | x = r cos θ, y = r sin θ, r² = x² + y², tan θ = y/x (x ≠ 0). |

## Plotting points and naming them many ways (5.1)

Rectangular coordinates say "go across, then up". Polar coordinates say "face this direction, then walk this far". To plot (3, 5π/6): turn 5π/6 (150°) counterclockwise from the polar axis, then walk 3 units out along that ray. The point lands in quadrant II.

A point has infinitely many polar names. Adding a full turn changes nothing, so (3, 5π/6) = (3, 17π/6) = (3, −7π/6). A negative r means "walk backwards": (−3, θ) is 3 units along the ray *opposite* θ, which is the ray θ + π. So (3, 5π/6) is also (−3, 5π/6 − π) = (−3, −π/6) and (−3, 11π/6).

The two rules:

- (r, θ) = (r, θ + 2πn) for every integer n;
- (r, θ) = (−r, θ + π + 2πn) for every integer n.

The pole is special: (0, θ) is the pole for every θ.

**Worked example 1.** Give three other names for (3, 5π/6): one with r > 0 and a negative angle, one with r < 0 and 0 ≤ θ < 2π, and one with r < 0 and a negative angle.

- r > 0, negative angle: 5π/6 − 2π = −7π/6, so (3, −7π/6).
- r < 0, 0 ≤ θ < 2π: add π to the angle and negate r: (−3, 11π/6).
- r < 0, negative angle: (−3, −π/6).

Check (−3, 11π/6): the ray at 11π/6 points into quadrant IV, and walking backwards from the pole lands in quadrant II, at 5π/6. ✓

## Polar to rectangular (5.1)

Week 5's definitions sin θ = y/r and cos θ = x/r, multiplied through by r, give

    x = r cos θ,  y = r sin θ.

These work for negative r too: the signs take care of themselves.

**Worked example 2.** Convert (−4, 2π/3) to rectangular coordinates.

x = −4 cos(2π/3) = −4(−1/2) = 2 and y = −4 sin(2π/3) = −4(√3/2) = −2√3. The point is (2, −2√3), in quadrant IV. That fits the picture: the ray 2π/3 points into quadrant II and r < 0 sends us the opposite way.

## Rectangular to polar (5.1)

Going the other way, r = √(x² + y²) (Pythagoras) and tan θ = y/x. The trap is the angle: tan⁻¹ only returns angles in (−π/2, π/2), the right half of the plane. **Locate the quadrant first**, then use the reference angle.

**Worked example 3.** Write (−3, −3√3) in polar form with r > 0 and 0 ≤ θ < 2π.

r = √(9 + 27) = √36 = 6. tan θ = (−3√3)/(−3) = √3, reference angle π/3. The point is in quadrant III, so θ = π + π/3 = 4π/3. Answer (6, 4π/3). (The angle π/3 also has tangent √3, but it names a quadrant I point.)

**Worked example 4 (calculator).** Write (−2, 5) in polar form with r > 0 and 0 ≤ θ < 2π, to the nearest hundredth.

r = √(4 + 25) = √29 ≈ 5.39. A calculator gives tan⁻¹(5/(−2)) = tan⁻¹(−2.5) ≈ −1.190, a quadrant IV angle. The point is in quadrant II, so add π: θ ≈ −1.190 + π ≈ 1.95. Answer ≈ (5.39, 1.95). In degrees, θ ≈ 111.8°, the same number you would get as the direction angle of the vector ⟨−2, 5⟩ in week 23.

Quadrantal points need no tangent at all: (0, −5) is (5, 3π/2), and (−7, 0) is (7, π).

## Converting equations (5.2)

To turn a **rectangular equation into polar**, substitute x = r cos θ and y = r sin θ and solve for r if you can. To turn a **polar equation into rectangular**, aim for the combinations r cos θ, r sin θ and r², often after multiplying both sides by r.

**Worked example 5.** Convert r = 4 sin θ to rectangular form and identify the graph.

Multiply by r: r² = 4r sin θ. Substitute: x² + y² = 4y. Complete the square: x² + y² − 4y + 4 = 4, so

    x² + (y − 2)² = 4,

a circle of radius 2 centred at (0, 2). It passes through the pole, as r = 4 sin 0 = 0 says. Multiplying by r could add the pole as a new solution, but here the pole is already on the graph, so nothing extraneous appears.

The same steps show that r = 6 cos θ is x² + y² = 6x, or (x − 3)² + y² = 9: a circle of radius 3 centred at (3, 0). In general r = 2a sin θ and r = 2a cos θ are circles of radius |a| through the pole.

**Worked example 6.** Convert x = 3, y = −2 and 2x − 3y = 6 to polar form.

- x = 3: r cos θ = 3, so r = 3/cos θ = 3 sec θ.
- y = −2: r sin θ = −2, so r = −2 csc θ.
- 2x − 3y = 6: 2r cos θ − 3r sin θ = 6, so r(2 cos θ − 3 sin θ) = 6 and r = 6/(2 cos θ − 3 sin θ).

Some conversions are shortcuts. r = 5 is x² + y² = 25. The equation θ = π/3 puts no condition on r, so it allows every r, positive and negative, so its graph is the whole line through the pole with slope tan(π/3) = √3: y = √3x. And xy = 4 becomes r² sin θ cos θ = 4, which week 16's double-angle formula tidies to r² sin 2θ = 8.

## Distance between two polar points

Two points (r₁, θ₁) and (r₂, θ₂) with positive r form a triangle with the pole: two sides r₁ and r₂ with angle θ₂ − θ₁ between them. Week 21's Law of Cosines gives

    d² = r₁² + r₂² − 2r₁r₂ cos(θ₂ − θ₁).

For (5, π/6) and (3, π/2) the included angle is π/3, so d² = 25 + 9 − 30(1/2) = 19 and d = √19 ≈ 4.36. Converting both points to rectangular form and using the distance formula gives the same answer, with more arithmetic.

## Common errors

- **Trusting the calculator's angle.** tan⁻¹(y/x) lands in quadrant I or IV. For points with x < 0, add π.
- **Negating r without moving the angle.** (−2, π/4) is not (2, π/4); it is (2, 5π/4).
- **Forgetting that a polar point has many names.** Testing one name in an equation and finding it fails does not prove the point is off the graph; another name might satisfy it.
- **Dividing by r and losing the pole.** Going from r² = 4r sin θ back to r = 4 sin θ is safe only because the pole already satisfies r = 4 sin θ at θ = 0.
- **Mixing modes.** Use radian mode unless the item gives degrees.

## Where this goes next

Week 27 graphs polar equations whose rectangular forms are hopeless (roses, limaçons, lemniscates) and uses the multiple-names idea in its symmetry tests. Week 28 reuses the conversion formulas exactly: the complex number x + yi in trigonometric form is r(cos θ + i sin θ), with the same r and θ. Week 31 writes conics as polar equations with the pole at a focus.

## Self-check

1. Give two other names for (−5, π/3), one with r > 0 and one with a negative angle.
2. Convert (6, 7π/4) to rectangular coordinates.
3. Write (4, −4) and (−1, −√3) in polar form with r > 0 and 0 ≤ θ < 2π.
4. Convert r = −8 cos θ to rectangular form and give the centre and radius.
5. Convert x + y = 4 to polar form, and explain why θ = 3π/4 is a line, not a ray.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSN-CN.B.4, HSF-TF.A.2, HSF-TF.C.8). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
