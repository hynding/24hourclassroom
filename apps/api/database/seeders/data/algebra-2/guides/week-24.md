# Week 24 · Circles, Right Triangles and the Unit Circle

**Lessons:** 6.1 Moving in Circles · 6.2 Revisiting Right Triangles · 6.3 The Unit Circle (Part 1) · 6.4 The Unit Circle (Part 2)
**Practices:** MP2 (reason abstractly and quantitatively), MP7 (look for structure), MP6 (attend to precision)
**Built from:** IM Algebra 2, Unit 6, Lessons 1–4, in our own words
**Spiral:** The Pythagorean theorem and the right-triangle ratios sine, cosine and tangent come from Geometry. Square roots and the fact that x² = a has two solutions (week 11) decide the sign of a coordinate on a circle. Transformations of functions (Unit 5) return in week 27 when we stretch and shift sine waves.

## What you need to be able to do

- **6.1** Describe the position of a point moving around a circle by its coordinates, and use the circle's equation x² + y² = r² to find one coordinate from the other.
- **6.2** Use sine, cosine and tangent in a right triangle to find the coordinates of a point on a circle of radius r at a given angle: (r cos θ, r sin θ).
- **6.3** Measure angles in radians as arc length on the unit circle, convert between degrees and radians, and locate the points at multiples of π/6 and π/4.
- **6.4** Give the exact coordinates (cos θ, sin θ) of every labelled point on the unit circle in all four quadrants, using symmetry across the axes.

## Key terms

| Term | Meaning |
|---|---|
| Unit circle | The circle of radius 1 centred at the origin: x² + y² = 1. |
| Radian | The angle that cuts an arc of length 1 on the unit circle. A full turn is 2π radians = 360°. |
| cos θ, sin θ | The x- and y-coordinates of the point on the unit circle at angle θ, measured counterclockwise from the positive x-axis. |
| tan θ | sin θ / cos θ, the slope of the ray at angle θ. |
| Reference angle | The acute angle a ray makes with the x-axis; the point's coordinates are those of the reference angle with signs set by the quadrant. |
| Quadrant | One of the four regions cut out by the axes, numbered I to IV counterclockwise from the upper right. |

## Position on a circle (6.1)

A point on a circle of radius r centred at the origin satisfies **x² + y² = r²**. That one equation, which is the Pythagorean theorem written for the triangle with legs |x| and |y|, lets you recover one coordinate from the other up to sign.

**Worked example.** A point on the circle of radius 5 has x-coordinate 3. Find its y-coordinate.

9 + y² = 25, so y² = 16 and y = 4 or y = −4. There are two such points, (3, 4) above the axis and (3, −4) below. Which one is meant depends on where the point is on its trip around the circle.

A clock is the standard picture. The tip of a minute hand of length 10 cm starts at 12 o'clock, (0, 10), moves to 3 o'clock, (10, 0), then to 6 o'clock, (0, −10), then to 9 o'clock, (−10, 0). Its x-coordinate rises from 0 to 10 and sinks back to −10; its y-coordinate falls from 10 to −10 and climbs back. Neither coordinate changes at a steady rate: near 12 o'clock the x-coordinate changes fast and the y-coordinate barely moves.

**Try it.**
1. A point on the circle of radius 13 has y-coordinate −12 and lies left of the y-axis. Find its coordinates.
2. The tip of a hand of length 6 is at (6, 0). After a quarter turn counterclockwise, where is it?

*Answers:* 1. x² = 169 − 144 = 25, x = −5: (−5, −12). 2. (0, 6).

## Right triangles give the coordinates (6.2)

Draw the ray from the origin at angle θ (counterclockwise from the positive x-axis) to a point P on the circle of radius r, and drop a perpendicular to the x-axis. The right triangle has hypotenuse r, horizontal leg x and vertical leg y, so from Geometry:

cos θ = x/r, sin θ = y/r, tan θ = y/x.

Rearranged: **P = (r cos θ, r sin θ)**. The angle does all the work; the radius just scales.

**Worked example.** A 20-metre Ferris wheel spoke makes an angle of 35° with the positive x-axis. Where is the rider, relative to the centre?

x = 20 cos 35° ≈ 20 · 0.819 = 16.4 m, y = 20 sin 35° ≈ 20 · 0.574 = 11.5 m. Check: 16.4² + 11.5² ≈ 268.9 + 132.3 ≈ 401 ≈ 400 ✓.

**Worked example.** A point on the circle of radius 8 is at (4, 4√3). What angle does its ray make with the positive x-axis?

cos θ = 4/8 = 1/2 and sin θ = 4√3/8 = √3/2, so θ = 60°. (tan θ = √3 agrees.)

**Try it.**
1. Find the point on the circle of radius 10 at 120°.
2. A point on the circle of radius 2 is at (√2, √2). Find its angle.

*Answers:* 1. (10 cos 120°, 10 sin 120°) = (−5, 5√3) ≈ (−5, 8.66). 2. cos θ = √2/2, so θ = 45°.

## Radians (6.3)

On the unit circle an angle can be measured by the **arc it cuts off**. The whole circumference is 2π, so a full turn is 2π radians, a half turn is π, a quarter turn is π/2. One radian is the angle whose arc has length 1; it is about 57.3°.

Conversion: multiply degrees by π/180 to get radians, radians by 180/π to get degrees.

| Degrees | 30° | 45° | 60° | 90° | 120° | 135° | 150° | 180° | 270° | 360° |
|---|---|---|---|---|---|---|---|---|---|---|
| Radians | π/6 | π/4 | π/3 | π/2 | 2π/3 | 3π/4 | 5π/6 | π | 3π/2 | 2π |

The standard labelled points on the unit circle are at every multiple of π/6 and of π/4, twelve and eight of them respectively, sixteen distinct points in all (the multiples of π/2 are shared).

The first-quadrant values come from two triangles. The 30-60-90 triangle with hypotenuse 1 has legs 1/2 and √3/2; the 45-45-90 triangle with hypotenuse 1 has legs √2/2.

| θ | 0 | π/6 | π/4 | π/3 | π/2 |
|---|---|---|---|---|---|
| cos θ | 1 | √3/2 | √2/2 | 1/2 | 0 |
| sin θ | 0 | 1/2 | √2/2 | √3/2 | 1 |

Notice the pattern: as θ increases from 0 to π/2, cos θ falls from 1 to 0 and sin θ rises from 0 to 1, and at π/4 they are equal.

**Worked example.** Convert 225° to radians and 7π/6 to degrees.

225 · π/180 = 5π/4. 7π/6 · 180/π = 210°.

**Worked example.** On a circle of radius 3, how long is the arc cut off by an angle of 2π/3?

Arc length = rθ = 3 · 2π/3 = 2π ≈ 6.28 (the radian measure scales with the radius, which is exactly why radians are convenient).

**Try it.**
1. Convert 300° to radians and 5π/4 to degrees.
2. Give the exact coordinates of the unit-circle point at π/3.

*Answers:* 1. 5π/3; 225°. 2. (1/2, √3/2).

## The whole unit circle (6.4)

Every labelled point outside the first quadrant is the mirror image of a first-quadrant point. The **reference angle** is the acute angle between the ray and the x-axis; the coordinates are the first-quadrant coordinates with the signs of the quadrant.

| Quadrant | θ range | cos θ | sin θ |
|---|---|---|---|
| I | 0 to π/2 | + | + |
| II | π/2 to π | − | + |
| III | π to 3π/2 | − | − |
| IV | 3π/2 to 2π | + | − |

**Worked example.** Find cos(5π/6) and sin(5π/6).

5π/6 is π/6 short of π, so the reference angle is π/6 and the point is in quadrant II: cos negative, sin positive. (cos, sin) = (−√3/2, 1/2).

**Worked example.** Find the coordinates at 4π/3 and at 7π/4.

4π/3 = π + π/3: quadrant III, reference π/3, point (−1/2, −√3/2). 7π/4 = 2π − π/4: quadrant IV, reference π/4, point (√2/2, −√2/2).

**Worked example.** Which angles between 0 and 2π have sin θ = −1/2?

Reference angle π/6 with sine negative: quadrants III and IV, so θ = 7π/6 and 11π/6.

**Symmetry rules** worth memorising: reflecting across the x-axis sends θ to −θ (or 2π − θ) and keeps cos, flips sin; reflecting across the y-axis sends θ to π − θ and keeps sin, flips cos; a half turn sends θ to θ + π and flips both.

**Try it.**
1. Give (cos θ, sin θ) for θ = 3π/4 and θ = 11π/6.
2. Find all θ in [0, 2π) with cos θ = −√2/2.
3. Give the coordinates of the point at 5π/3 on the circle of radius 4.

*Answers:* 1. (−√2/2, √2/2); (√3/2, −1/2). 2. 3π/4 and 5π/4. 3. 4 · (1/2, −√3/2) = (2, −2√3).

## Common mistakes

- **Reading sine as the x-coordinate.** Cosine is x, sine is y: alphabetical order both times.
- **Converting the wrong way.** Degrees → radians multiplies by π/180 (a small number); 60° is π/3, not 60π.
- **Forgetting the sign.** cos(2π/3) = −1/2, not 1/2: quadrant II has negative cosine.
- **Choosing one root of y² = 16.** The circle equation gives y = ±4; the position on the circle decides.
- **Using a calculator in degree mode for radians** (or the reverse). sin(π/6) should give 0.5; if it gives 0.009 the mode is wrong.

## Where this goes next

Next week the identity cos²θ + sin²θ = 1, which is just x² + y² = 1 in new clothes, lets you find one of cos θ and sin θ from the other, and we start watching how the height of a point changes as it travels around a circle. That changing height becomes the graph of y = sin θ in week 26.

## Self-check

1. A point on the circle of radius 25 has x-coordinate −7 and is below the x-axis. Find its coordinates.
2. Find the point on the circle of radius 6 at an angle of 150°.
3. Convert 7π/4 to degrees and 240° to radians.
4. Give exact values of cos θ and sin θ at θ = 5π/4 and θ = 11π/6.
5. Find all θ in [0, 2π) with sin θ = √3/2, and explain how the reference angle leads to both.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 2, Unit 6, Lessons 1–4, https://im.kendallhunt.com/HS/teachers/3/6/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
