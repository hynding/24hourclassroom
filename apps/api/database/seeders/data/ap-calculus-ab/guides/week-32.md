# Week 32 · Volumes: Cross Sections, Discs and Washers

**Topics:** 8.7 Volumes with Cross Sections: Squares and Rectangles · 8.8 Volumes with Cross Sections: Triangles and Semicircles · 8.9 Volume with Disc Method: Revolving Around the x- or y-Axis · 8.10 Volume with Disc Method: Revolving Around Other Axes · 8.11 Volume with Washer Method: Revolving Around the x- or y-Axis · 8.12 Volume with Washer Method: Revolving Around Other Axes
**Practices:** 1 (Implementing Mathematical Processes), 2 (Connecting Representations), 3 (Justification), 4 (Communication and Notation)
**Framework:** AP Calculus AB and BC CED, Unit 8, Topics 8.7–8.12, learning objectives in our own words
**Spiral:** Week 31's slices, top − bottom or right − left, are the starting point for every solid this week: the slice length becomes the side of a square, the diameter of a semicircle, or the radius of a disc. Choosing dx or dy works the same way as it did for area. Unit 6's idea that an integral adds up thin pieces (a Riemann sum in the limit) is the whole justification for V = ∫ A(x) dx.

## What you need to be able to do

- **8.7** Find the volume of a solid with a known base and square or rectangular cross sections perpendicular to the x-axis or the y-axis.
- **8.8** Do the same with equilateral triangle, isosceles right triangle and semicircle cross sections.
- **8.9** Use the disc method for a region revolved about the x-axis or the y-axis.
- **8.10** Use the disc method about another horizontal or vertical line, measuring the radius from that line.
- **8.11** Use the washer method, π ∫ (R² − r²), about the x-axis or the y-axis.
- **8.12** Use the washer method about other lines, finding outer and inner radii as distances from the axis.

## Key terms

| Term | Meaning |
|---|---|
| Cross section | The flat shape you see when a solid is cut by a plane perpendicular to an axis. |
| A(x) | The area of the cross section at x; volume = ∫ A(x) dx. |
| Disc | A circular slice of a solid of revolution with no hole: area πR². |
| Washer | A ring-shaped slice: area πR² − πr², with R the outer and r the inner radius. |
| Axis of rotation | The line the region spins around; every radius is measured from it. |
| Slice length s | top − bottom (for dx) or right − left (for dy) across the base region. |

## The one idea behind every solid

Slice the solid into thin pieces perpendicular to an axis. A piece at position x has volume about A(x) · Δx. Adding the pieces and letting Δx → 0:

V = ∫ from a to b of A(x) dx   (or V = ∫ from c to d of A(y) dy).

Every problem this week is a matter of finding A, choosing the variable and finding the limits.

## Cross sections: squares and rectangles (8.7)

For a solid with a known base, find the slice length s across the base at each x, then build the cross section on it.

| Cross section on a side (or diameter) s | Area |
|---|---|
| Square | s² |
| Rectangle of height k·s | k·s² |
| Rectangle of fixed height h | h·s |

**Worked example.** The base of a solid is the region R in the first quadrant under y = 4 − x² (so 0 ≤ x ≤ 2). Cross sections perpendicular to the x-axis are squares. Find the volume.

At x the base runs from y = 0 up to y = 4 − x², so s = 4 − x² and A(x) = (4 − x²)² = 16 − 8x² + x⁴.

V = ∫ from 0 to 2 of (16 − 8x² + x⁴) dx = 32 − 64/3 + 32/5 = (480 − 320 + 96)/15 = 256/15.

**Perpendicular to the y-axis.** Then slices are horizontal: s = right − left, written in y, with y-limits.

## Cross sections: triangles and semicircles (8.8)

| Cross section on s | Area |
|---|---|
| Semicircle with diameter s | (1/2)π(s/2)² = (π/8)s² |
| Equilateral triangle with side s | (√3/4)s² |
| Isosceles right triangle with a leg s | (1/2)s² |
| Isosceles right triangle with hypotenuse s | s²/4 |

Most errors here are geometry, not calculus. Check whether the base slice is a diameter or a radius, and a leg or a hypotenuse.

**Worked example.** Same base R. Cross sections perpendicular to the x-axis are semicircles with diameters in R. Then A(x) = (π/8)(4 − x²)², and

V = (π/8) ∫ from 0 to 2 of (4 − x²)² dx = (π/8)(256/15) = 32π/15.

**Worked example.** Same base R, but cross sections perpendicular to the **y-axis** are equilateral triangles. At height y the base runs from x = 0 to x = √(4 − y), so s = √(4 − y) and A(y) = (√3/4)(4 − y).

V = (√3/4) ∫ from 0 to 4 of (4 − y) dy = (√3/4)(16 − 8) = 2√3.

## Discs about the axes (8.9)

When a region is revolved about a line it touches along its whole length, each slice perpendicular to the axis sweeps out a **disc**. Its radius is the distance from the axis to the far edge of the region.

- About the x-axis: V = π ∫ from a to b of [f(x)]² dx (vertical slices, dx).
- About the y-axis: V = π ∫ from c to d of [g(y)]² dy (horizontal slices, dy, with the curve written as x = g(y)).

The slices must be **perpendicular to the axis of rotation**: vertical slices for a horizontal axis, horizontal slices for a vertical axis.

**Worked example.** Revolve R (first quadrant, under y = 4 − x²) about the x-axis: radius 4 − x², so V = π ∫ from 0 to 2 of (4 − x²)² dx = 256π/15.

Revolve R about the y-axis: slices are horizontal, and y = 4 − x² gives x = √(4 − y). V = π ∫ from 0 to 4 of (√(4 − y))² dy = π ∫ from 0 to 4 of (4 − y) dy = 8π.

## Discs about other lines (8.10)

When the axis is some other line that the region touches, the radius is still the distance from the axis to the far edge:

- Horizontal axis y = k: radius |k − f(x)|, so k − f(x) if the curve is below the line and f(x) − k if it is above.
- Vertical axis x = h: radius |h − g(y)|, with dy.

**Worked example.** The region enclosed by y = x² and y = 1 is revolved about the line y = 1. The region touches y = 1 along its top, so slices are discs. At x, the region runs from the parabola up to the axis, so R = 1 − x², for −1 ≤ x ≤ 1.

V = π ∫ from −1 to 1 of (1 − x²)² dx = π ∫ from −1 to 1 of (1 − 2x² + x⁴) dx = 2π(1 − 2/3 + 1/5) = 16π/15.

## Washers about the axes (8.11)

If there is a gap between the region and the axis, each slice is a **washer**: a disc with a disc removed.

V = π ∫ ([R]² − [r]²), where R = distance from the axis to the **far** boundary and r = distance from the axis to the **near** boundary.

Square each radius, then subtract. Never π(R − r)².

**Worked example.** The region enclosed by y = x and y = x² (0 ≤ x ≤ 1, with x ≥ x²) is revolved about the x-axis. The line is farther from the axis: R = x, r = x².

V = π ∫ from 0 to 1 of (x² − x⁴) dx = π(1/3 − 1/5) = 2π/15.

About the y-axis instead, slice horizontally: the line is x = y and the parabola x = √y, and √y ≥ y on [0, 1], so R = √y, r = y and V = π ∫ from 0 to 1 of (y − y²) dy = π/6.

## Washers about other lines (8.12)

Measure each radius from the axis. Two patterns cover almost every problem:

- **Axis below the region, y = −k:** R = (upper curve) + k, r = (lower curve) + k.
- **Axis above the region, y = k:** R = k − (lower curve), r = k − (upper curve). The lower curve is now the far one.

Vertical axes work the same way in x, with dy.

**Worked example.** Revolve the region between y = x and y = x² about the line y = −1. The axis is below, so R = x + 1 and r = x² + 1:

V = π ∫ from 0 to 1 of [(x + 1)² − (x² + 1)²] dx = π ∫ from 0 to 1 of (2x − x² − x⁴) dx = π(1 − 1/3 − 1/5) = 7π/15.

Revolve it about the line x = −1. The axis is vertical, so slice horizontally: the right curve is x = √y, the left curve x = y, and the axis is 1 unit to the left of x = 0. R = √y + 1, r = y + 1:

V = π ∫ from 0 to 1 of [(√y + 1)² − (y + 1)²] dy = π ∫ from 0 to 1 of (2√y − y − y²) dy = π(4/3 − 1/2 − 1/3) = π/2.

**A sketch saves points.** Draw the region, the axis, and one representative slice. Label R and r on the slice before writing the integral.

## Common mistakes

- **Squaring the difference.** π(R − r)² is not the area of a ring. Use πR² − πr².
- **Squaring each term.** (4 − x²)² is 16 − 8x² + x⁴, not 16 − x⁴.
- **Radius measured from the wrong line.** About y = −1, a curve at height x is x + 1 away, not x − 1 or x.
- **Slices parallel to the axis.** For a vertical axis the slices are horizontal and everything is in y.
- **Radius or diameter, leg or hypotenuse.** Semicircle on diameter s: (π/8)s². Isosceles right triangle with hypotenuse s: s²/4.
- **Using half the base width.** For the base between x = y² and x = 4, a vertical slice runs from y = −√x to y = √x, length 2√x.
- **Forgetting π (or adding it to cross sections).** Discs and washers have π; squares and triangles do not, and semicircles have π/8.

## Self-check

1. The base of a solid is the region under y = 2x for 0 ≤ x ≤ 3. Cross sections perpendicular to the x-axis are squares. Find the volume.
2. Same base, semicircle cross sections perpendicular to the x-axis. Find the volume.
3. The region under y = √x for 0 ≤ x ≤ 9 is revolved about the x-axis. Find the volume.
4. Write the washer integral when the region between y = 2 and y = x² + 1 (for −1 ≤ x ≤ 1) is revolved about the x-axis.
5. Write the integral when the region between y = x and y = x² is revolved about the line y = 2.

*Answers:* 1. ∫ from 0 to 3 of 4x² dx = 36. 2. (π/8) ∫ from 0 to 3 of 4x² dx = 9π/2. 3. π ∫ from 0 to 9 of x dx = 81π/2. 4. π ∫ from −1 to 1 of [4 − (x² + 1)²] dx. 5. π ∫ from 0 to 1 of [(2 − x²)² − (2 − x)²] dx.

---

*Original study material for this course, organised around the College Board AP Calculus AB and BC Course and Exam Description (Unit 8, Topics 8.7–8.12). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
