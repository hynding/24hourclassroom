# Unit 9 · Parametric Equations, Polar Coordinates, and Vector-Valued Functions · The night-before sheet

**AP exam weight:** 10–15% of the BC exam
**Topics:** 9.1 Defining and Differentiating Parametric Equations · 9.2 Second Derivatives of Parametric Equations · 9.3 Finding Arc Lengths of Curves Given by Parametric Equations · 9.4 Defining and Differentiating Vector-Valued Functions · 9.5 Integrating Vector-Valued Functions · 9.6 Solving Motion Problems Using Parametric and Vector-Valued Functions · 9.7 Defining Polar Coordinates and Differentiating in Polar Form · 9.8 Find the Area of a Polar Region or the Area Bounded by a Single Polar Curve · 9.9 Finding the Area of the Region Bounded by Two Polar Curves
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 9, Topics 9.1–9.9, in our own words (the whole unit is BC only)

## The ideas that generate every question

1. **A parametric curve is a path traced over time (9.1).** x = x(t) and y = y(t) give a point for each t. The slope of the path is dy/dx = (dy/dt)/(dx/dt), wherever dx/dt ≠ 0. Horizontal tangent: dy/dt = 0 and dx/dt ≠ 0. Vertical tangent: dx/dt = 0 and dy/dt ≠ 0. If both are 0, look further (cancel a common factor or take a limit).
2. **The second derivative takes one more division (9.2).** d²y/dx² = [d/dt (dy/dx)] / (dx/dt). Differentiate the slope with respect to t, then divide by dx/dt again. It is never (d²y/dt²)/(d²x/dt²).
3. **Arc length adds speed (9.3).** L = ∫ from a to b of √((dx/dt)² + (dy/dt)²) dt. A curve traced twice on [a, b] is counted twice: this is distance traveled.
4. **Vector-valued functions are parametric equations in a pair of brackets (9.4).** r(t) = ⟨x(t), y(t)⟩. Differentiate component by component: r′(t) is the velocity (a tangent vector), r″(t) the acceleration.
5. **Integrate component by component too (9.5).** ∫ ⟨f(t), g(t)⟩ dt = ⟨∫ f, ∫ g⟩ + a constant vector. Position from velocity: r(b) = r(a) + ∫ from a to b of v(t) dt. Each component carries its own constant.
6. **Motion in the plane (9.6).** Velocity v = ⟨x′, y′⟩; speed |v| = √((x′)² + (y′)²); acceleration a = ⟨x″, y″⟩. Displacement is the vector ∫ v dt; total distance is the number ∫ |v| dt. Speed increases when v · a > 0 and decreases when v · a < 0. At rest means both components of v are 0 at once.
7. **Polar coordinates (9.7).** A point is (r, θ), with x = r cos θ, y = r sin θ, r² = x² + y². Each point has infinitely many names (add 2π to θ, or negate r and add π). A polar curve r = f(θ) is a parametric curve with θ as the parameter: x = f(θ) cos θ and y = f(θ) sin θ. So dy/dx = (r′ sin θ + r cos θ)/(r′ cos θ − r sin θ), with r′ = dr/dθ. dr/dθ alone says whether the point moves toward or away from the pole (when r > 0), not the slope.
8. **Polar area adds thin sectors (9.8).** Area = (1/2)∫ from α to β of r² dθ, over an interval of θ that traces the region exactly once. Find the limits from where r = 0 (petals, inner loops) or from one full trace of the curve.
9. **Between two polar curves, subtract the squares (9.9).** Area = (1/2)∫ from α to β of (R² − r²) dθ, where R is the curve farther from the pole and r the nearer one on that interval. Find the intersection angles first; split the integral where the outer and inner curves trade places.

## Key formulas and procedures

| Want | Do this |
|---|---|
| Slope of a parametric curve | dy/dx = (dy/dt)/(dx/dt) |
| Tangent line at t = t₀ | point (x(t₀), y(t₀)), slope dy/dx at t₀ |
| Second derivative | d²y/dx² = [d/dt (dy/dx)] / (dx/dt) |
| Arc length, a ≤ t ≤ b | ∫ from a to b of √((dx/dt)² + (dy/dt)²) dt |
| Velocity, acceleration | v = r′(t), a = r″(t), component by component |
| Speed | \|v(t)\| = √((x′)² + (y′)²) |
| Position at t = b | r(a) + ∫ from a to b of v(t) dt |
| Total distance | ∫ from a to b of \|v(t)\| dt |
| Speeding up or slowing down | sign of v · a |
| Polar to rectangular | x = r cos θ, y = r sin θ, x² + y² = r² |
| Slope of r = f(θ) | (r′ sin θ + r cos θ)/(r′ cos θ − r sin θ) |
| Moving toward or away from the pole | sign of dr/dθ (or dr/dt = (dr/dθ)(dθ/dt)) with r > 0 |
| Area inside one polar curve | (1/2)∫ r² dθ over one trace |
| Area between two polar curves | (1/2)∫ (R² − r²) dθ, outer minus inner |
| Circles through the pole | r = 2a cos θ, r = 2a sin θ: radius a, traced once on an interval of length π |
| Rose r = a sin(nθ), n odd | n petals, each petal between consecutive zeros |

## Classic question types and how to attack them

**"Find the slope of the curve, or an equation of the tangent line, at t = 2."** Compute dx/dt and dy/dt at t = 2, divide, and use the point (x(2), y(2)), not (2, something).

**"Where does the curve have horizontal or vertical tangents?"** Solve dy/dt = 0 (horizontal) and dx/dt = 0 (vertical), check the other derivative is not 0, and report points (x, y), not values of t.

**"Find the speed and the acceleration vector at t = 2; find the position at t = 3; find the total distance."** Speed is a number, acceleration a vector; position adds the initial point; distance integrates the speed.

**"When is the particle farthest to the right?"** It is a Candidates Test on x(t): solve x′(t) = 0, then compare x at those times and at both endpoints, using x(t) = x(0) + ∫ from 0 to t of x′(s) ds.

**"Find the area inside one curve and outside the other."** Solve r₁ = r₂ for the angles, decide which curve is outside, integrate (1/2)(R² − r²); use symmetry.

**"A particle moves along the polar curve with dθ/dt = 3. Is it moving toward the pole?"** Use dr/dt = (dr/dθ)(dθ/dt) and the sign of r.

## Justification sentences that earn points

- "dy/dt = 0 at t = −1 while dx/dt = −2 ≠ 0, so the tangent line there is horizontal."
- "d²y/dx² = [d/dt (dy/dx)]/(dx/dt) = 3t/2 > 0 for t > 0, so the curve is concave up there."
- "v(1) · a(1) = −16 < 0, so the speed of the particle is decreasing at t = 1."
- "x′(t) changes from positive to negative at t ≈ 2.171. Comparing x(0) = 2, x(2.171) ≈ 8.772 and x(3) ≈ 6.871, the particle is farthest right at t ≈ 2.171."
- "On −π/3 < θ < π/3 the circle r = 3cos θ is farther from the pole than the limaçon, so the area is (1/2)∫ from −π/3 to π/3 of (9cos²θ − (2 − cos θ)²) dθ."
- "dr/dt = (dr/dθ)(dθ/dt) > 0 and r > 0 at that instant, so the particle is moving away from the pole."

## Common mistakes

- Dividing dx/dt by dy/dt, or reporting dy/dt as the slope.
- Writing the tangent line through (t₀, …) instead of (x(t₀), y(t₀)).
- Computing d²y/dx² as (d²y/dt²)/(d²x/dt²), or forgetting the final division by dx/dt.
- Using positions instead of derivatives inside the arc length integral; using √(1 + (dy/dx)²) with dt.
- Forgetting the initial position, or adding it to only one component.
- Reporting the length of the displacement vector as the distance traveled.
- Declaring "at rest" when only one velocity component is 0.
- Leaving out the 1/2 in polar area, or squaring the difference (R − r)² instead of R² − r².
- Integrating over an interval that traces a curve twice (r = 2cos θ on [0, 2π]).

## Calculator or not?

The calculator free-response question is usually a particle in the plane whose velocity has no elementary antiderivative: expect speed, acceleration, position by an integral, total distance, and a Candidates Test, all to three decimal places. Polar area can show up in either section; when it is no-calculator the integrand simplifies with cos²θ = (1 + cos 2θ)/2. Tangents, second derivatives and coordinate conversion are no-calculator skills.

## Self-test

1. For x = t² + t, y = t³, find dy/dx at t = 1.
2. For the same curve, find d²y/dx² at t = 1.
3. Find the length of x = 3cos t, y = 3sin t for 0 ≤ t ≤ π.
4. v(t) = ⟨2t, 1⟩ and r(0) = ⟨3, 0⟩. Find r(4).
5. Convert the polar point (−4, π/6) to rectangular coordinates.
6. Find the area enclosed by r = 4sin θ.

**Answers.** 1. dy/dt = 3, dx/dt = 3, slope 1. 2. dy/dx = 3t²/(2t + 1); d/dt = (6t(2t + 1) − 6t²)/(2t + 1)² = 12/9 = 4/3 at t = 1; divide by 3: 4/9. 3. Speed 3, length 3π. 4. ⟨3, 0⟩ + ⟨16, 4⟩ = ⟨19, 4⟩. 5. x = −4cos(π/6) = −2√3, y = −4sin(π/6) = −2: (−2√3, −2). 6. (1/2)∫ from 0 to π of 16sin²θ dθ = 4π (a circle of radius 2).

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 9, Topics 9.1–9.9). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
