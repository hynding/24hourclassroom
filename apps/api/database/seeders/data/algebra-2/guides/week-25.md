# Week 25 · The Pythagorean Identity and Motion around a Circle

**Lessons:** 6.5 The Pythagorean Identity (Part 1) · 6.6 The Pythagorean Identity (Part 2) · 6.7 Finding Unknown Coordinates on a Circle · 6.8 Rising and Falling
**Practices:** MP7 (look for structure), MP3 (construct arguments), MP4 (model with mathematics)
**Built from:** IM Algebra 2, Unit 6, Lessons 5–8, in our own words
**Spiral:** The identity is x² + y² = 1 from last week in new notation, and solving for one coordinate uses the two-solution fact about x² = a (week 11). The quadrant sign table (week 24) chooses between those two solutions. Describing where a function increases and decreases goes back to Unit 2's polynomial graphs.

## What you need to be able to do

- **6.5** Explain why cos²θ + sin²θ = 1 for every angle θ, and use it to find cos θ from sin θ (or the reverse) up to sign.
- **6.6** Combine the identity with quadrant information to find the exact value and sign of the missing coordinate, and apply the same reasoning on a circle of any radius.
- **6.7** Find unknown coordinates of a point on a circle from its angle and radius, or from one coordinate and the radius; find the angle from the coordinates with a calculator's inverse functions, choosing the right quadrant.
- **6.8** Describe how the height and horizontal position of a point change as it moves around a circle: where each is increasing, decreasing, largest and smallest.

## Key terms

| Term | Meaning |
|---|---|
| Pythagorean identity | cos²θ + sin²θ = 1 for every θ. (cos²θ means (cos θ)².) |
| Identity | An equation true for every value of the variable, not just some. |
| arccos, arcsin (cos⁻¹, sin⁻¹) | Calculator functions that return an angle with the given cosine or sine; arccos gives an angle in [0, π], arcsin in [−π/2, π/2]. |
| Increasing / decreasing | A coordinate is increasing on an interval of θ if it gets larger as θ grows there. |
| Maximum / minimum | The largest and smallest values a coordinate reaches (±r on a circle of radius r). |

## Why cos²θ + sin²θ = 1 (6.5)

The point at angle θ on the unit circle is (cos θ, sin θ). Every point on the unit circle satisfies x² + y² = 1. Put the two together:

**cos²θ + sin²θ = 1** for every θ.

It is the Pythagorean theorem for the right triangle with hypotenuse 1 and legs |cos θ| and |sin θ|, which is why it carries the name. Check it on a known point: at π/6, (√3/2)² + (1/2)² = 3/4 + 1/4 = 1 ✓. At π/4, 1/2 + 1/2 = 1 ✓.

The identity lets you find one coordinate from the other, but only up to sign:

**Worked example.** sin θ = 3/5. Find cos θ.

cos²θ = 1 − 9/25 = 16/25, so cos θ = 4/5 or cos θ = −4/5. Both are possible: there are two points on the unit circle with height 3/5, one in quadrant I and one in quadrant II.

**Worked example.** cos θ = 0.28. Find sin θ to three decimal places.

sin²θ = 1 − 0.0784 = 0.9216, so sin θ = ±0.96. (0.96 exactly, as 0.96² = 0.9216.)

**Try it.**
1. sin θ = 5/13. Find the possible values of cos θ.
2. cos θ = −1/3. Find the possible values of sin θ exactly.

*Answers:* 1. cos²θ = 1 − 25/169 = 144/169, cos θ = ±12/13. 2. sin²θ = 8/9, sin θ = ±2√2/3.

## Choosing the sign (6.6)

If you also know the quadrant, the sign is settled.

| Given | Quadrant | Missing value |
|---|---|---|
| sin θ = 3/5 | II | cos θ = −4/5 |
| cos θ = −5/13 | III | sin θ = −12/13 |
| sin θ = −√3/2 | IV | cos θ = 1/2 |
| cos θ = 0.6 | θ between 3π/2 and 2π | sin θ = −0.8 |

**Worked example.** cos θ = −5/13 and π < θ < 3π/2. Find sin θ and tan θ.

sin²θ = 1 − 25/169 = 144/169. Quadrant III has negative sine: sin θ = −12/13. tan θ = sin θ / cos θ = (−12/13)/(−5/13) = 12/5.

**On a circle of radius r.** The point is (r cos θ, r sin θ), so if you know x and r, then cos θ = x/r and the identity gives sin θ. Equivalently, go straight to x² + y² = r².

**Worked example.** A point on the circle of radius 7 has x-coordinate 2 and is in quadrant IV. Find its y-coordinate exactly.

cos θ = 2/7, so sin²θ = 1 − 4/49 = 45/49 and sin θ = −√45/7 = −3√5/7 (quadrant IV). Then y = 7 sin θ = −3√5 ≈ −6.71. Directly: y² = 49 − 4 = 45, y = −√45 = −3√5. Same answer.

**Try it.**
1. sin θ = −0.6 and θ is in quadrant III. Find cos θ.
2. A point on the circle of radius 10 has y-coordinate 8 and negative x-coordinate. Find x and cos θ.

*Answers:* 1. cos²θ = 0.64, cos θ = −0.8. 2. x² = 100 − 64 = 36, x = −6, cos θ = −0.6.

## Finding unknown coordinates and angles (6.7)

Three situations come up.

**Angle and radius known.** Use (r cos θ, r sin θ), exactly for the special angles and with a calculator (in the right mode) otherwise. On the circle of radius 9 at θ = 2 radians: (9 cos 2, 9 sin 2) ≈ (−3.75, 8.18).

**One coordinate and radius known.** Use x² + y² = r², then choose the sign from the quadrant, as above.

**Coordinates known, angle wanted.** A calculator's arccos (cos⁻¹) returns an angle between 0 and π; arcsin (sin⁻¹) returns one between −π/2 and π/2. Neither knows the quadrant, so adjust.

**Worked example.** A point on the circle of radius 5 is at (−3, 4). Find θ in [0, 2π) to two decimal places.

cos θ = −3/5 = −0.6. arccos(−0.6) ≈ 2.21 radians, and since the point is in quadrant II (x < 0, y > 0) that is the angle: θ ≈ 2.21 (about 126.9°). Check: sin 2.21 ≈ 0.80 = 4/5 ✓.

**Worked example.** A point on the circle of radius 5 is at (−3, −4). Find θ.

arccos(−0.6) ≈ 2.21 again, but now the point is in quadrant III. The reference angle is π − 2.21 ≈ 0.93, so θ = π + 0.93 ≈ 4.07 radians. Equivalently 2π − 2.21 ≈ 4.07, since reflecting the quadrant II point across the x-axis keeps the cosine.

A reliable routine: find the reference angle α = arccos(|x|/r) (always between 0 and π/2), then θ = α, π − α, π + α or 2π − α for quadrants I, II, III, IV.

**Try it.**
1. Find the point on the circle of radius 4 at θ = 3.5 radians, to two decimal places.
2. A point on the circle of radius 13 is at (12, −5). Find θ in [0, 2π) to two decimal places.

*Answers:* 1. (4 cos 3.5, 4 sin 3.5) ≈ (−3.75, −1.40). 2. Reference angle arccos(12/13) ≈ 0.39; quadrant IV, so θ ≈ 2π − 0.39 ≈ 5.89.

## Rising and falling (6.8)

Follow the y-coordinate (height) of a point moving counterclockwise from (r, 0).

- From θ = 0 to π/2 it rises from 0 to r, quickly at first and ever more slowly.
- From π/2 to π it falls back to 0, slowly at first then faster.
- From π to 3π/2 it keeps falling, to −r.
- From 3π/2 to 2π it rises back to 0.

So the height is **increasing** on (0, π/2) and (3π/2, 2π), **decreasing** on (π/2, 3π/2), with maximum r at θ = π/2 and minimum −r at θ = 3π/2.

The x-coordinate does the same thing a quarter turn earlier: it decreases on (0, π), from r to −r, and increases on (π, 2π), with maximum r at θ = 0 (and 2π) and minimum −r at θ = π.

| θ | 0 | π/2 | π | 3π/2 | 2π |
|---|---|---|---|---|---|
| x = r cos θ | r | 0 | −r | 0 | r |
| y = r sin θ | 0 | r | 0 | −r | 0 |

**Worked example.** A Ferris wheel of radius 12 m has its centre 14 m above the ground. A rider starts level with the centre on the right and goes counterclockwise. When is the rider highest, how high, and on which part of the turn is the height decreasing?

Height = 14 + 12 sin θ. Highest at θ = π/2 (a quarter turn), 26 m. Lowest at 3π/2, 2 m. Decreasing from θ = π/2 to 3π/2, the second and third quarters of the turn.

**Why the rate changes.** Near θ = π/2 the point is at the top, moving almost horizontally, so its height barely changes; near θ = 0 it moves almost straight up, so its height changes fastest. In week 26 this becomes the graph of sin θ: steep at the zeros, flat at the peaks.

**Try it.**
1. On which interval of θ in [0, 2π] are both cos θ and sin θ decreasing?
2. A point moves on the circle of radius 3. At which angle is its x-coordinate smallest, and what is it?

*Answers:* 1. (π/2, π): cosine decreases on (0, π) and sine on (π/2, 3π/2); the overlap is quadrant II. 2. θ = π, x = −3.

## Common mistakes

- **Dropping the ± when solving cos²θ = k.** There are two angles with the same sine; the quadrant chooses.
- **Writing cos²θ as cos(θ²).** cos²θ means (cos θ)².
- **Trusting arccos blindly.** It never returns a quadrant III or IV angle; use the reference angle and the point's signs.
- **Confusing the value with the rate.** Sine is largest at π/2 but changing slowest there; it changes fastest at 0 and π where its value is 0.
- **Forgetting the radius.** On a circle of radius 7 the coordinates are 7 cos θ and 7 sin θ, not cos θ and sin θ.

## Where this goes next

Next week the height of the moving point, plotted against the angle, becomes the graph of y = sin θ, and the x-coordinate becomes y = cos θ. Angles beyond 2π and negative angles extend both graphs in both directions, and tangent gets a graph of its own.

## Self-check

1. Show that cos²θ + sin²θ = 1 at θ = 5π/6 by computing both squares.
2. sin θ = −7/25 and θ is in quadrant IV. Find cos θ and tan θ.
3. A point on the circle of radius 6 has x-coordinate −2 and positive y-coordinate. Find y exactly and θ to two decimal places.
4. A point is at (−8, −15) on a circle centred at the origin. Find the radius and the angle in [0, 2π).
5. A rider on a Ferris wheel of radius 20 m with centre 22 m up starts at the 3 o'clock position. Give the height after a quarter, half and three-quarter turn, and state where the height is increasing.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 6, Lessons 5–8, https://im.kendallhunt.com/HS/teachers/3/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
