# Week 27 · Graphs of Polar Equations

**Topics:** 5.3 Graphs of Polar Equations
**Standards:** HSN-CN.B.4 (extension: graphs of polar equations), HSF-TF.B.5, HSF-TF.C.8
**Spiral:** Week 26 gave the polar grid, negative r and the many names of a point; every graph this week is drawn by plotting (r, θ) from a table. Week 7's key points and week 8's amplitude, period and midline describe r as a function of θ before you draw anything, week 6's even/odd identities and week 15's reduction formulas power the symmetry tests, and week 19's multiple-angle equations find the zeros of roses and lemniscates.

## What you need to be able to do

- **5.3** Sketch a polar graph from a table of values, reading r as a directed distance and handling negative r.
- **5.3** Test a polar equation for symmetry about the polar axis, the line θ = π/2 and the pole, and know that a failed test proves nothing.
- **5.3** Recognise and sketch circles, limaçons (with an inner loop, cardioid, dimpled, convex), roses, lemniscates and spirals from their equations.
- **5.3** Find the zeros of r (where the graph passes through the pole) and the maximum value of |r| (the points farthest from the pole), and the θ-interval that traces a graph exactly once.

## Key terms

| Term | Meaning |
|---|---|
| Polar axis symmetry | The graph is its own mirror image across the line θ = 0 (the x-axis). |
| Symmetry about θ = π/2 | The graph is its own mirror image across the y-axis. |
| Pole symmetry | Rotating the graph by π about the pole leaves it unchanged. |
| Limaçon | r = a ± b cos θ or r = a ± b sin θ with a, b > 0; its shape depends on a/b. |
| Cardioid | The limaçon with a = b; heart-shaped, touching the pole once. |
| Rose | r = a cos nθ or r = a sin nθ (n an integer ≥ 2); petals of length \|a\|. |
| Lemniscate | r² = a² cos 2θ or r² = a² sin 2θ; a figure-eight through the pole. |
| Archimedean spiral | r = aθ; each turn adds the same distance 2πa from the pole. |

## Reading r as a function of θ

Before plotting, think of r = f(θ) on an ordinary θr-plane, where it is often a sinusoid with a midline and an amplitude (week 8). The polar graph wraps that curve around the pole: where f is large the point is far out, where f = 0 the graph touches the pole, and where f < 0 the point is plotted on the opposite ray. This saves a lot of guesswork.

**Worked example 1.** Sketch r = 2 + 4 cos θ.

As a function of θ, r is a cosine wave with midline 2 and amplitude 4, ranging from −2 to 6.

| θ | 0 | π/3 | π/2 | 2π/3 | π | 4π/3 | 3π/2 | 5π/3 |
|---|---|---|---|---|---|---|---|---|
| r | 6 | 4 | 2 | 0 | −2 | 0 | 2 | 4 |

From θ = 0 to 2π/3 the point swings from (6, 0) up through (2, π/2) into the pole. From 2π/3 to 4π/3, r is negative, so the points appear on the opposite side: at θ = π, r = −2 plots at the rectangular point (2, 0). This traces a small **inner loop** inside the big one. From 4π/3 to 2π the outer loop closes. Zeros: 2 + 4 cos θ = 0 gives cos θ = −1/2, θ = 2π/3 and 4π/3. Maximum |r| = 6 at θ = 0. The graph is symmetric about the polar axis because cosine is even.

## Symmetry tests

Each test replaces the point (r, θ) by a name of its mirror image and asks whether the equation is unchanged.

| Symmetry about | Replace (r, θ) by | Or by |
|---|---|---|
| polar axis (x-axis) | (r, −θ) | (−r, π − θ) |
| line θ = π/2 (y-axis) | (r, π − θ) | (−r, −θ) |
| pole | (−r, θ) | (r, θ + π) |

If either substitution gives an equivalent equation, the symmetry holds. If one fails, **try the other**: a failed test does not prove the graph is not symmetric, because the mirror point might satisfy the equation under a different name.

**Worked example 2.** Test r = sin 2θ for symmetry about the polar axis.

First test: (r, −θ) gives r = sin(−2θ) = −sin 2θ, which is not the original. Second test: (−r, π − θ) gives −r = sin(2π − 2θ) = −sin 2θ, so r = sin 2θ. ✓ The graph (a four-petal rose) is symmetric about the polar axis after all. In fact it passes all three tests.

Quick rules: cos θ alone (r = f(cos θ)) gives polar-axis symmetry; sin θ alone gives symmetry about θ = π/2; r² = … or a function of 2θ often gives pole symmetry.

## Circles and limaçons

- r = a is a circle of radius |a| centred at the pole.
- r = a cos θ and r = a sin θ are circles of diameter |a| through the pole (week 26), traced once on [0, π).

For a limaçon r = a ± b cos θ (or sin θ) with a, b > 0, the ratio a/b decides the shape:

| a/b | Shape | Example |
|---|---|---|
| a/b < 1 | inner loop (r changes sign) | r = 2 + 4 cos θ |
| a/b = 1 | cardioid (touches the pole once) | r = 3 − 3 sin θ |
| 1 < a/b < 2 | dimpled (an inward dent, no loop) | r = 4 + 3 sin θ |
| a/b ≥ 2 | convex (no dent) | r = 5 − 2 cos θ |

Cosine limaçons are symmetric about the polar axis and stretch along the x-axis; sine limaçons are symmetric about θ = π/2 and stretch along the y-axis. The sign in front of b says which way the big end points.

**Worked example 3.** Describe r = 3 − 3 sin θ.

a/b = 1: a cardioid. Symmetric about θ = π/2 (sine only). r = 0 when sin θ = 1, at θ = π/2, so the cusp is at the pole, pointing up. Maximum r = 6 at θ = 3π/2, the rectangular point (0, −6). At θ = 0 and π, r = 3: the points (3, 0) and (−3, 0). The heart hangs below the pole.

## Roses

For r = a cos nθ or r = a sin nθ with integer n ≥ 2:

- if n is **odd**, there are **n** petals, traced once on [0, π);
- if n is **even**, there are **2n** petals, traced once on [0, 2π);
- each petal has length |a|, with its tip where |cos nθ| or |sin nθ| = 1.

**Worked example 4.** Describe r = 4 sin 3θ.

n = 3 is odd, so 3 petals of length 4. Zeros: sin 3θ = 0, so θ = 0, π/3, 2π/3 on [0, π). Tips where sin 3θ = ±1: θ = π/6 (r = 4), θ = π/2 (r = −4, which plots at the opposite ray, 3π/2), θ = 5π/6 (r = 4). The petals point towards π/6, 5π/6 and 3π/2: a three-leaf shape with one petal pointing straight down. Symmetric about θ = π/2.

Compare r = 2 cos 2θ: n = 2 is even, so 4 petals of length 2, tips at θ = 0, π/2, π, 3π/2 (the ones at π/2 and 3π/2 come from r = −2).

## Lemniscates and spirals

A lemniscate has r² on the left, so it exists only where the right side is not negative.

**Worked example 5.** Describe r² = 9 cos 2θ.

Need cos 2θ ≥ 0: 2θ in [−π/2, π/2] or [3π/2, 5π/2], so θ in [−π/4, π/4] or [3π/4, 5π/4]. The maximum |r| is 3, at θ = 0 and π, and r = 0 at θ = ±π/4 and 3π/4, 5π/4 (week 19's equation cos 2θ = 0). Each allowed θ gives two values r = ±3√(cos 2θ), so the graph is a figure-eight lying along the x-axis, symmetric about both axes and the pole. With sin 2θ instead, the figure-eight lies along the line y = x, in quadrants I and III.

The spiral r = θ (θ ≥ 0) starts at the pole and moves outwards 2π units for every full turn: at θ = π/2, r ≈ 1.57; at θ = 2π, r ≈ 6.28. It has no symmetry and is not periodic, so it is never "traced once".

## Common errors

- **Dropping negative r.** At θ = π, r = 2 + 4 cos π = −2 plots at (2, 0) in rectangular terms, not at (−2, 0).
- **Rose petal count.** r = 5 cos 4θ has 8 petals, not 4; r = 3 sin 5θ has 5, not 10.
- **Treating a failed symmetry test as proof.** Try the alternative substitution, or plot.
- **Limaçon ratio upside down.** It is a/b, the constant over the coefficient: r = 4 + 3 sin θ has a/b = 4/3, dimpled.
- **Lemniscates over all θ.** r² = 9 cos 2θ has no points for π/4 < θ < 3π/4.

## Where this goes next

Week 28 plots complex numbers in a plane where r and θ become the modulus and argument, and week 29's roots of complex numbers sit on a circle r = constant, equally spaced in θ. Week 31's polar conics r = ed/(1 − e cos θ) are another family identified from a ratio, this time the eccentricity e.

## Self-check

1. Classify r = 1 − 2 sin θ and find its zeros on [0, 2π).
2. How many petals has r = 6 cos 5θ, and how long is each? On what interval is it traced once?
3. Test r = 2 + cos θ for symmetry about the polar axis.
4. Find the maximum |r| and the θ where it occurs for r = 3 + 3 cos θ.
5. For which θ in [0, 2π) is r² = 4 sin 2θ defined?

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSN-CN.B.4, HSF-TF.B.5, HSF-TF.C.8). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
