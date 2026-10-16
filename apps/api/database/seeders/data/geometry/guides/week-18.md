# Week 18 · Solids, Cross Sections and Scaling Area

**Lessons:** 5.1 Solids of Rotation · 5.2 Slicing Solids · 5.3 Creating Cross Sections by Dilating · 5.4 Scaling and Area · 5.5 Scaling and Unscaling
**Practices:** MP7 (structure), MP2 (reason quantitatively), MP4 (model)
**Built from:** IM Geometry, Unit 5, Lessons 1–5, in our own words
**Spiral:** rotations (week 4) generate solids of rotation; dilations (week 11) generate the cross sections of pyramids and cones; "area scales by k²" (week 12) is now the central tool, and square roots undo it.

## What you need to be able to do

- Name the solid produced by rotating a plane figure about an axis, and sketch or describe the figure that produces a given solid.
- Describe the cross section made by slicing a solid with a plane (parallel to the base, perpendicular to the base, at an angle) and recognise which solids give circles, rectangles, triangles, trapezoids or ellipses.
- Explain why a cross section of a pyramid or cone parallel to its base is a dilation of the base from the apex, and find its dimensions from the heights.
- Scale lengths by k and areas by k², in both directions: find the area factor from a length factor and the length factor from an area ratio (square root).

## Key terms

| Term | Meaning |
|---|---|
| Solid of rotation | The solid swept out by rotating a plane region 360° about a line (the axis). |
| Cross section | The plane figure where a plane cuts a solid. |
| Prism | A solid with two congruent parallel polygon bases joined by parallelograms (rectangles if the prism is right). |
| Cylinder | Like a prism but with circular bases. |
| Pyramid | A polygon base with triangular faces meeting at the apex. |
| Cone | A circular base with a curved surface to the apex. |
| Scale factor k | Length multiplier. Area multiplier k². (Volume multiplier k³, next week.) |

## 1. Solids of rotation

Rotating a region about an axis sweeps a solid. The axis becomes the solid's axis of symmetry, and every cross section perpendicular to the axis is a circle (or a ring).

| Region (axis along one edge unless stated) | Solid |
|---|---|
| Rectangle, axis along a side | Cylinder: radius = other side, height = that side |
| Right triangle, axis along a leg | Cone: radius = other leg, height = that leg |
| Half-disc, axis along the diameter | Sphere |
| Quarter-disc, axis along a radius | Hemisphere |
| Rectangle, axis parallel to a side but outside the rectangle | A cylindrical shell (a tube) |
| Isosceles triangle, axis along the altitude | Cone (the altitude is the height) |
| Trapezoid with two right angles, axis along the perpendicular side | Frustum (a cone with the top cut off) |
| Disc, axis outside the disc in its plane | Torus (a ring doughnut) |

```
Figure description: a rectangle 3 wide and 8 tall stands with its left side on the vertical axis.
Rotating it sweeps a cylinder of radius 3 and height 8.

      axis
       |####
       |####   8
       |####
       |####
        3
```

**Worked example 1.** A right triangle with legs 5 (vertical, on the axis) and 2 (horizontal) rotated about the vertical leg: a cone with height 5, radius 2, slant height √29.

**Worked example 2.** Which region gives a cone of radius 6 and height 8 with its apex at the top? A right triangle with the vertical leg 8 on the axis and the horizontal leg 6 at the bottom. (Horizontal leg at the top gives the cone upside down.)

**Worked example 3.** Rotate the region between y = 2 and y = 5, for 0 ≤ x ≤ 4, about the x-axis (the region is a 4-by-3 rectangle not touching the axis). The solid is a tube: outer radius 5, inner radius 2, length 4.

**Try it 1.1** What solid comes from rotating a semicircle of radius 4 about its diameter? *(Answer: a sphere of radius 4.)*

**Try it 1.2** Describe the region that rotates into a cylinder of radius 1 and height 10 with a cone of height 3 on top. *(Answer: a 1-by-10 rectangle on the axis with a right triangle of legs 3 (on the axis) and 1 on top of it.)*

## 2. Slicing solids

Slice with a plane; the cross section depends on the solid and on the plane's direction.

| Solid | Plane parallel to the base | Plane perpendicular to the base, through the axis | Tilted plane |
|---|---|---|---|
| Cube | Square | Rectangle | Triangle, pentagon or hexagon are possible |
| Rectangular prism | Rectangle congruent to the base | Rectangle | Parallelogram, triangle, … |
| Cylinder | Circle | Rectangle | Ellipse (or a cut-off ellipse) |
| Cone | Circle (smaller near the apex) | Isosceles triangle | Ellipse, parabola or hyperbola |
| Square pyramid | Square (smaller near the apex) | Isosceles triangle | Trapezoid (if parallel to one base edge), triangle |
| Sphere | Circle (always) | Circle | Circle |
| Triangular prism | Triangle congruent to the base | Rectangle | Triangle or quadrilateral |

**Worked example 4.** A cube of side 6 is sliced by a plane through the midpoints of three edges meeting at one vertex. Cross section: an equilateral triangle with side 3√2 (each side is the hypotenuse of a 3-3 right triangle). A plane through the midpoints of six edges (not touching any vertex) gives a regular hexagon.

**Worked example 5.** A cylinder of radius 3 and height 10 is sliced by a vertical plane 1 unit from the axis. Cross section: a rectangle of height 10 and width 2√(9 − 1) = 2√8 ≈ 5.66 (a chord at distance 1 from the centre).

**Try it 2.1** A cone is sliced by a plane through the apex and perpendicular to the base. Cross section? *(Answer: an isosceles triangle with base the diameter and height the cone's height.)*

## 3. Cross sections by dilating

Slice a pyramid or cone with a plane parallel to its base at distance d below the apex, where the full height is h. The cross section is the image of the base under a dilation centred at the apex with scale factor k = d/h.

Why: every point of the base lies on a ray from the apex; the plane at height d cuts each ray at the fraction d/h of its length (side-splitter in the vertical triangle through that ray), which is exactly what the dilation does.

So the cross section is similar to the base, with lengths × k and area × k².

**Worked example 6.** A square pyramid has base side 12 and height 9. A cut parallel to the base, 3 units below the apex: k = 3/9 = 1/3, cross section a square of side 4, area 16 (base area 144, times 1/9 ✓).

**Worked example 7.** A cone has radius 5 and height 15. The cross section 6 units above the base is 9 units below the apex: k = 9/15 = 0.6, radius 3, area 9π.

**Worked example 8 (a frustum).** A cone of height 10 and radius 4 has its top 4 units removed. The cut is at k = 4/10 = 0.4 from the apex: top radius 1.6. The remaining frustum has radii 4 and 1.6 and height 6.

**Try it 3.1** A triangular pyramid has base area 50 and height 8. Area of the cross section 2 units above the base? *(Answer: k = 6/8 = 0.75, area 50 × 0.5625 = 28.125.)*

## 4. Scaling area, and unscaling it

If every length of a figure is multiplied by k, its area is multiplied by k². This holds for any figure (a region can be approximated by small squares, each of which scales by k²).

**Forward.** Length × 3 ⇒ area × 9. Length × 0.5 ⇒ area × 0.25. Length × 1.1 ⇒ area × 1.21 (a 10 % increase in lengths is a 21 % increase in area).

**Backward (unscaling).** Area × 16 ⇒ length × 4. Area × 2 ⇒ length × √2 ≈ 1.414. Area × 0.36 ⇒ length × 0.6. In general k = √(area factor).

**Worked example 9.** A photo 10 cm by 15 cm is enlarged so that its area is 600 cm². Original area 150; factor 4; k = 2; new size 20 cm by 30 cm.

**Worked example 10.** A pizza of diameter 30 cm costs 12 dollars; one of diameter 40 cm costs 18 dollars. Area ratio (40/30)² = 16/9 ≈ 1.78; price ratio 1.5. The large pizza is the better value per square centimetre.

**Worked example 11.** A circle's area is to be tripled. Multiply the radius by √3 ≈ 1.732.

**Worked example 12.** A model's floor area is 1/400 of the real building's. Length scale: 1/20.

**Try it 4.1** A triangle's sides are multiplied by 2.5. Area factor? *(Answer: 6.25.)*

**Try it 4.2** A square's area goes from 50 to 200. Side factor? *(Answer: 2.)*

## Common mistakes

- **Rotating about the wrong line.** The axis is part of the description; a rectangle rotated about a side gives a solid cylinder, about a parallel line outside it gives a tube.
- **Assuming all cross sections of a cone are circles.** Only planes parallel to the base give circles.
- **Measuring the dilation from the base instead of the apex.** k = (distance from apex)/(height).
- **Scaling area by k.** Area is k². And going backwards requires a square root, not division by 2.
- **Confusing "area × 9" with "lengths × 9".** Lengths × 3.

## Where this goes next

Week 19 scales volumes by k³ and surface areas by k², explains why large animals have proportionally thicker legs, and derives the volume of a cylinder and the principle (Cavalieri) that solids with equal cross sections at every height have equal volumes. Week 20 handles prisms and pyramids; week 21 puts all the solids together with density and graphing.

## Self-check

1. A right triangle with legs 3 and 7 is rotated about the leg of length 7. Describe the solid.
2. What cross section does a plane parallel to the base make in a triangular pyramid? Perpendicular to the base through the apex?
3. A cone has height 12 and base radius 8. Find the radius of the cross section 3 units below the apex.
4. A rectangle's area is multiplied by 2.25 after a dilation. What is the scale factor?
5. If a square's side is increased by 20 %, by what percent does its area increase?

*Answers: (1) a cone with height 7 and radius 3. (2) a triangle similar to the base; a triangle with one vertex at the apex. (3) k = 3/12 = 1/4, radius 2. (4) 1.5. (5) 1.2² = 1.44, so 44 %.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 5, Lessons 1–5, https://im.kendallhunt.com/HS/teachers/2/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
