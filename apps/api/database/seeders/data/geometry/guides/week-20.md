# Week 20 · Prisms and Pyramids

**Lessons:** 5.11 Prisms Practice · 5.12 Prisms and Pyramids · 5.13 Building a Volume Formula for a Pyramid · 5.14 Working with Pyramids
**Practices:** MP1 (persevere), MP3 (construct arguments), MP7 (structure)
**Built from:** IM Geometry, Unit 5, Lessons 11–14, in our own words
**Spiral:** V = Bh for cylinders and Cavalieri's principle (week 19) carry straight over to prisms and pyramids; the dilated cross sections of week 18 are why all pyramids with the same base area and height agree; the Pythagorean theorem and trigonometry (Units 3–4) find slant heights and lateral areas.

## What you need to be able to do

- Compute the volume of any prism as base area times height, including triangular, trapezoidal and hexagonal prisms and oblique prisms, and solve for a missing dimension.
- Explain the relationship between a prism and a pyramid with the same base and height, and give two justifications for V = ⅓Bh: the three-pyramid dissection of a cube and the Cavalieri argument.
- Compute volumes of pyramids and cones, including oblique ones and frustums (by subtraction).
- Find slant heights, lateral areas and total surface areas of right pyramids and cones.

## Key terms

| Term | Meaning |
|---|---|
| Prism | Two congruent parallel polygon bases joined by parallelogram faces. Right if the side faces are rectangles. |
| Base area B | The area of one base (prism) or the base (pyramid, cone). |
| Height h | The perpendicular distance between the bases, or from apex to base plane. |
| Lateral area | The area of the side faces (everything except the bases). |
| Slant height ℓ | For a right pyramid or cone: the distance from the apex to the midpoint of a base edge (pyramid) or to the base circle (cone). |
| Frustum | A pyramid or cone with the top cut off by a plane parallel to the base. |
| Apex | The top vertex of a pyramid or cone. |

## 1. Prisms: V = Bh

A prism is a stack of copies of its base, so its volume is base area times height. This works for every base shape and, by Cavalieri, for oblique prisms too.

**Worked example 1 (triangular prism).** Base: a right triangle with legs 6 and 8 (area 24). Height 10. V = 240. Surface area: two bases (48) plus three rectangles of width 10 and lengths 6, 8, 10 (lateral area 24 × 10 = 240): total 288.

**Worked example 2 (trapezoidal prism, like a water trough).** Base: a trapezoid with parallel sides 30 cm and 50 cm and height 20 cm, area ½(30 + 50)(20) = 800 cm². Length 120 cm. V = 96,000 cm³ = 96 L.

**Worked example 3 (hexagonal prism).** Base: a regular hexagon of side 4, area (3√3/2)(16) = 24√3 ≈ 41.57. Height 10. V ≈ 415.7.

**Worked example 4 (missing dimension).** A rectangular prism has volume 720, length 12 and width 6. Height = 720/72 = 10.

**Worked example 5 (oblique).** A prism with base area 35 leans so that its top is shifted; the perpendicular height is 9. V = 315, regardless of the lean (Cavalieri).

**Lateral area of a right prism** = (perimeter of base) × height. Total surface area = lateral area + 2B.

**Try it 1.1** Rectangular prism 5 by 7 by 11: volume and surface area? *(Answer: 385; 2(35 + 55 + 77) = 334.)*

**Try it 1.2** A triangular prism has volume 300 and height 12. Base area? *(Answer: 25.)*

## 2. Prisms and pyramids with the same base and height

Fill a pyramid with sand and pour it into a prism with the same base and height: it takes exactly three pours. So **V(pyramid) = ⅓ V(prism) = ⅓Bh**. The same holds for a cone inside a cylinder: V(cone) = ⅓πr²h.

Two arguments make the 1/3 certain.

**Argument 1: a cube is three pyramids.** Take a cube of edge s. Choose one vertex V. The three square faces not containing V are each the base of a pyramid with apex V; those three pyramids are congruent (a rotation of the cube about the diagonal through V carries each to the next) and fill the cube exactly. So each has volume s³/3 = ⅓ · s² · s = ⅓Bh. ∎ (A square pyramid with base s² and height s.)

**Argument 2: Cavalieri.** Any two pyramids with the same base area B and the same height h have the same volume: at height y above the base, each cross section is a dilation of its base from its apex with k = (h − y)/h, so both cross sections have area B k², equal. Hence every pyramid of base area s² and height s has the volume of the cube-pyramid above, s³/3. Scaling the base and height separately (a stretch in each direction scales volume by that factor) gives ⅓Bh for any B and h. ∎

```
Figure description: a cube with vertex V at the top back corner. Three pyramids
share apex V; their bases are the bottom face, the front face and the right face.
Together they fill the cube.
```

**Worked example 6.** Square pyramid, base 10 by 10, height 12: V = ⅓ · 100 · 12 = 400.

**Worked example 7.** Cone, radius 6, height 8: V = ⅓ · 36π · 8 = 96π ≈ 301.6.

**Worked example 8.** Triangular pyramid, base a triangle of area 18, height 7: V = 42.

**Try it 2.1** A cone has volume 100π and radius 5. Height? *(Answer: ⅓ · 25π · h = 100π, h = 12.)*

## 3. Working with pyramids: slant height and surface area

For a **right square pyramid** with base side s and height h, the slant height ℓ runs from the apex to the midpoint of a base edge: ℓ² = h² + (s/2)². Each triangular face has area ½ s ℓ, so the lateral area is 4 · ½ s ℓ = 2sℓ, and the total surface area is s² + 2sℓ.

The **edge** from the apex to a base corner is longer: e² = h² + (s√2/2)² = h² + s²/2.

For a **right cone** with radius r and height h: ℓ² = h² + r², lateral area = πrℓ (a sector of radius ℓ whose arc is the base circumference 2πr), total surface area = πr² + πrℓ.

**Worked example 9.** Square pyramid, s = 10, h = 12: ℓ = √(144 + 25) = 13; lateral area 2 · 10 · 13 = 260; total 360. Edge: √(144 + 50) ≈ 13.93.

**Worked example 10.** Cone, r = 6, h = 8: ℓ = 10; lateral area 60π ≈ 188.5; total 96π ≈ 301.6. (It is a coincidence that this equals the volume number 96π; the units differ.)

**Worked example 11 (from slant height to height).** A cone has radius 9 and slant height 15: h = √(225 − 81) = 12; V = ⅓ · 81π · 12 = 324π.

**Worked example 12 (angle).** The faces of the pyramid in example 9 make an angle with the base of tan⁻¹(12/5) ≈ 67.4° (the right triangle with legs h = 12 and s/2 = 5).

**Worked example 13 (frustum).** A cone of radius 6 and height 12 has its top cut off at height 6. The removed cone has k = 1/2: radius 3, height 6, volume ⅓ · 9π · 6 = 18π. The whole cone's volume is ⅓ · 36π · 12 = 144π. The frustum: 144π − 18π = 126π ≈ 395.8. (Equivalently, the removed cone is 1/8 of the whole, so the frustum is 7/8.)

**Worked example 14 (oblique pyramid).** A pyramid's apex is not above the centre of its base; base area 50, perpendicular height 9. V = 150. The lean changes the surface area but not the volume.

**Try it 3.1** Square pyramid, s = 16, h = 6: slant height, lateral area, volume? *(Answer: 10; 320; 512.)*

**Try it 3.2** A square pyramid has base 20 by 20 and its top is cut off halfway up. What fraction of the volume remains? *(Answer: 7/8.)*

## Common mistakes

- **Forgetting the ⅓.** Pyramids and cones are one third of the matching prism or cylinder.
- **Using the slant height as the height in a volume**, or the height as the slant height in a surface area.
- **Using the edge instead of the slant height.** The slant height goes to the midpoint of a base edge.
- **Counting the base twice** for a pyramid's surface area (one base) or once for a prism's (two bases).
- **Mixing the frustum's height with the removed cone's height.** Work out the scale factor of the cut first.

## Where this goes next

Week 21 adds spheres (V = 4/3 πr³, A = 4πr²), combines solids, relates surface area to volume for real containers, and models density (mass = density × volume) and graphs of volume against a changing dimension. Then the unit exam.

## Self-check

1. A prism's base is a triangle with sides 5, 5, 6 (area 12) and its height is 9. Volume? Lateral area?
2. State the two arguments for V = ⅓Bh in one sentence each.
3. A cone has radius 5 and height 12. Volume, slant height, total surface area?
4. A square pyramid has base 14 and slant height 25. Height and volume?
5. A cone of height 15 has its top 5 cut off. What fraction of the volume is removed?

*Answers: (1) 108; 16 × 9 = 144. (2) Three congruent pyramids fill a cube, so each is a third; by Cavalieri every pyramid with the same B and h has the same volume, so the third is universal. (3) 100π ≈ 314.2; 13; 25π + 65π = 90π ≈ 282.7. (4) h = √(625 − 49) = 24; V = ⅓ · 196 · 24 = 1568. (5) k = 1/3, so (1/3)³ = 1/27 is removed.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 5, Lessons 11–14, https://im.kendallhunt.com/HS/teachers/2/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
