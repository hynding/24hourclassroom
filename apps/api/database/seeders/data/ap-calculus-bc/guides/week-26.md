# Week 26 · Polar Curves: Slopes and Areas

**Topics:** 9.7 Defining Polar Coordinates and Differentiating in Polar Form · 9.8 Find the Area of a Polar Region or the Area Bounded by a Single Polar Curve · 9.9 Finding the Area of the Region Bounded by Two Polar Curves
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 9, Topics 9.7–9.9, learning objectives in our own words
**Spiral:** A polar curve is a parametric curve in disguise, so week 24's slope formula does all the differentiating. The area formula is a new Riemann sum (sectors instead of rectangles), and the area between two curves is the polar version of Unit 8's "top minus bottom". The power-reducing identities for sin² and cos² from precalculus are needed in almost every area integral.

## What you need to be able to do

- **9.7** Convert between polar (r, θ) and rectangular (x, y) coordinates, including negative r, and recognise common polar curves.
- **9.7** Interpret dr/dθ as the rate the point moves away from or toward the pole, and find the slope dy/dx of r = f(θ).
- **9.8** Find the area of a region bounded by one polar curve, (1/2)∫ from α to β of r² dθ, choosing bounds from where r = 0 for a petal or loop.
- **9.9** Find where two polar curves intersect and the area of a region between them, (1/2)∫ (R² − r²) dθ.

## Key terms

| Term | Meaning |
|---|---|
| Pole | The origin of the polar system. |
| Polar coordinates (r, θ) | Directed distance r from the pole along the ray at angle θ from the positive x-axis. |
| Polar curve | The set of points (f(θ), θ) for θ in an interval. |
| dr/dθ | The rate r changes with θ: positive means moving away from the pole (when r > 0). |
| Sector | A pie-slice of radius r and angle Δθ, area (1/2)r²Δθ. |
| Petal or loop | A part of a curve that starts and ends at the pole, between consecutive zeros of r. |
| Outer and inner curve | On an interval of θ, the curves farther from and nearer to the pole. |

## Polar coordinates and slopes (9.7)

In polar coordinates a point is named by how far it is from the pole and in which direction. The conversions are

**x = r cos θ, y = r sin θ, r² = x² + y², tan θ = y/x.**

A point has many names. (2, π/6), (2, 13π/6) and (−2, 7π/6) are all the rectangular point (√3, 1): adding 2π to θ changes nothing, and a negative r means "go the opposite way", which is the same as adding π to θ. So (−2, π/3) is x = −2 cos(π/3) = −1, y = −2 sin(π/3) = −√3.

**Common curves.**

| Curve | Shape |
|---|---|
| r = a | circle of radius a about the pole |
| r = 2a cos θ, r = 2a sin θ | circles of radius a through the pole |
| r = a + b cos θ (a, b > 0) | limaçon: a cardioid if a = b, an inner loop if a < b, dimpled or convex if a > b |
| r = a sin(nθ), r = a cos(nθ) | rose: n petals if n is odd, 2n if n is even |
| r = kθ | spiral |

**Reading r and dr/dθ.** r is the distance from the pole (when positive). dr/dθ tells you how that distance changes as θ increases: if r > 0 and dr/dθ > 0, the point is moving away from the pole; if r > 0 and dr/dθ < 0, toward it. (When r < 0, the point is on the opposite ray and the reading flips.) dr/dθ is **not** the slope of the curve.

**Slope.** Treat θ as a parameter: x = f(θ) cos θ, y = f(θ) sin θ. By the product rule, with r′ = dr/dθ,

dy/dθ = r′ sin θ + r cos θ,  dx/dθ = r′ cos θ − r sin θ,

**dy/dx = (r′ sin θ + r cos θ)/(r′ cos θ − r sin θ).**

Horizontal and vertical tangents follow the week 24 rules: dy/dθ = 0 (with dx/dθ ≠ 0) and dx/dθ = 0 (with dy/dθ ≠ 0).

**Worked example 1 (a limaçon).** Let r = 3 − 2 cos θ, so r′ = 2 sin θ.

- At θ = π, r = 3 + 2 = 5, and the point is (5 cos π, 5 sin π) = (−5, 0).
- At θ = π/2, r = 3 and r′ = 2. dy/dθ = 2 · 1 + 3 · 0 = 2, dx/dθ = 2 · 0 − 3 · 1 = −3, so dy/dx = −2/3.
- At θ = π/3, r = 2 and r′ = √3 > 0, so the point is moving away from the pole.

**Worked example 2 (a spiral).** For r = 2θ at θ = π/2: r = π, r′ = 2. dy/dθ = 2 sin(π/2) + π cos(π/2) = 2 and dx/dθ = 2 cos(π/2) − π sin(π/2) = −π, so dy/dx = −2/π. Note that dr/dθ = 2 is not the slope.

## Area bounded by one polar curve (9.8)

Rectangles do not fit a region that fans out from the pole, so cut it into thin sectors instead. A sector of radius r and angle Δθ has area (1/2)r²Δθ (a fraction Δθ/(2π) of the circle's πr²). Adding sectors and letting Δθ → 0 gives

**A = (1/2)∫ from α to β of r² dθ = (1/2)∫ from α to β of (f(θ))² dθ,**

for the region swept out by the ray from the pole as θ runs from α to β, provided no part is swept twice. The integrals almost always need the power-reducing identities

sin²θ = (1 − cos 2θ)/2, cos²θ = (1 + cos 2θ)/2,

and over a full period of 2π, ∫ cos θ dθ = 0 while ∫ cos²θ dθ = ∫ sin²θ dθ = π.

**Worked example 3 (the whole limaçon).** The area enclosed by r = 3 − 2 cos θ is

(1/2)∫ from 0 to 2π of (9 − 12 cos θ + 4 cos²θ) dθ = (1/2)(9 · 2π − 0 + 4π) = 11π.

**Choosing the bounds.** For the whole of a closed curve, use one full trace. For one petal or loop, solve r = 0: consecutive zeros are where it leaves and returns to the pole.

**Worked example 4 (one petal).** For r = 4 sin(3θ), r = 0 at θ = 0 and θ = π/3, so one petal is

(1/2)∫ from 0 to π/3 of 16 sin²(3θ) dθ = 8 ∫ from 0 to π/3 of (1 − cos 6θ)/2 dθ = 8 · (π/6) = 4π/3.

The three petals together have area 4π.

**Worked example 5 (an inner loop).** For r = 1 + 2 cos θ, r = 0 when cos θ = −1/2, at θ = 2π/3 and θ = 4π/3. For θ between them r is negative, and the curve traces the small inner loop. Its area is (1/2)∫ from 2π/3 to 4π/3 of (1 + 2 cos θ)² dθ. (Squaring makes the negative r harmless.) Expanding, (1 + 2 cos θ)² = 3 + 4 cos θ + 2 cos 2θ, and the loop's area is π − 3√3/2 ≈ 0.544.

**Retracing.** r = 2 cos θ is a circle of radius 1 traced once on 0 ≤ θ ≤ π. Integrating over 0 to 2π counts it twice and gives 2π instead of π. Always check how many times the interval covers the curve.

## Area between two polar curves (9.9)

If, for α ≤ θ ≤ β, the curve r = R(θ) is farther from the pole than r = r(θ), the region between them has area

**A = (1/2)∫ from α to β of (R² − r²) dθ.**

Square each radius, then subtract; (R − r)² is wrong.

**Finding the bounds.** Solve R(θ) = r(θ) for the intersection angles, then check two things. First, the pole: each curve may pass through it at a different θ, so setting the formulas equal will miss it. Second, the sketch: decide which curve is outside on each interval, and split the integral where that changes.

**Worked example 6.** Find the area inside the circle r = 3 sin θ and outside the cardioid r = 1 + sin θ.

- Intersections: 3 sin θ = 1 + sin θ gives sin θ = 1/2, so θ = π/6 and 5π/6 (r = 3/2).
- Between them, 3 sin θ ≥ 1 + sin θ, so the circle is outside.
- A = (1/2)∫ from π/6 to 5π/6 of (9 sin²θ − (1 + sin θ)²) dθ = (1/2)∫ (8 sin²θ − 2 sin θ − 1) dθ.
- With 8 sin²θ = 4 − 4 cos 2θ, an antiderivative is 3θ − 2 sin 2θ + 2 cos θ. From π/6 to 5π/6 the trigonometric terms cancel, leaving (1/2)(3 · 2π/3) = π.

**Area inside both curves.** Split at the intersection angles and use, on each piece, the curve nearer to the pole; or subtract. For the cardioid r = 2 + 2 cos θ (area 6π) and the circle r = 3, the region inside the cardioid and outside the circle (θ from −π/3 to π/3) has area 9√3/2 − π, so the region inside both has area 6π − (9√3/2 − π) = 7π − 9√3/2.

## Common mistakes

- **Forgetting the 1/2** in (1/2)∫ r² dθ, or integrating r instead of r².
- **Squaring the difference.** Between curves it is R² − r², not (R − r)².
- **Wrong bounds for a petal or loop.** Find where r = 0; a petal of r = 4 sin(3θ) runs from 0 to π/3, not 0 to π/6.
- **Counting a curve twice.** r = 2 cos θ is traced once on [0, π].
- **Missing the pole** as an intersection point.
- **Treating dr/dθ as the slope.** The slope is (dy/dθ)/(dx/dθ).
- **Sign slips in dx/dθ.** The derivative of r cos θ is r′ cos θ − r sin θ.
- **Ignoring negative r** when converting points: (−2, π/3) is in the third quadrant.

## Self-check

1. Convert the rectangular point (−3, 3) to polar form with r > 0 and 0 ≤ θ < 2π.
2. For r = 4 sin θ, find dy/dx at θ = π/6.
3. Find the area enclosed by the cardioid r = 1 − cos θ.
4. Find the area of one petal of r = cos(2θ).
5. Set up the area inside r = 2 and outside r = 2 − 2 sin θ.
6. For r = 2 + sin θ, is the point moving toward or away from the pole at θ = 2π/3?

*Answers:* 1. (3√2, 3π/4). 2. r = 2, r′ = 4 cos θ = 2√3; dy/dθ = 2√3 · (1/2) + 2 · (√3/2) = 2√3, dx/dθ = 2√3 · (√3/2) − 2 · (1/2) = 2, so dy/dx = √3. 3. (1/2)∫ from 0 to 2π of (1 − 2 cos θ + cos²θ) dθ = (1/2)(2π + π) = 3π/2. 4. r = 0 at θ = ±π/4: (1/2)∫ from −π/4 to π/4 of cos²(2θ) dθ = π/8. 5. They meet where sin θ = 0, at θ = 0 and π, and the circle is outside for 0 ≤ θ ≤ π: (1/2)∫ from 0 to π of (4 − (2 − 2 sin θ)²) dθ. 6. dr/dθ = cos(2π/3) = −1/2 < 0 with r > 0, so toward the pole.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 9, Topics 9.7–9.9). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
