# Week 21 · All the Solids, Density and Graphs

**Lessons:** 5.15 Putting All the Solids Together · 5.16 Surface Area and Volume · 5.17 Volume and Density · 5.18 Volume and Graphing
**Practices:** MP4 (model), MP2 (reason quantitatively), MP5 (use tools)
**Built from:** IM Geometry, Unit 5, Lessons 15–18, in our own words
**Spiral:** every formula of weeks 19–20 returns, now combined; the k² and k³ rules explain why surface area and volume compete; graphs of V against a dimension are the "function" view of scaling; π-approximation (week 17) underlies the sphere formulas we now use.

## What you need to be able to do

- Use the volume formulas for prisms, cylinders, pyramids, cones and spheres, and combine them for composite solids (a silo, an ice-cream cone, a capsule) and for solids with holes.
- Compute surface areas of the same solids and reason about which shape gives the most volume for a given surface, and why surface area matters (packaging, heat, cost).
- Use density = mass ÷ volume to find mass, volume or density, in consistent units, and apply population-style densities.
- Describe and sketch how volume depends on one dimension (linear in height, quadratic in radius for a cylinder, cubic for a scaling factor) and read such graphs.

## Key terms

| Term | Meaning |
|---|---|
| Sphere | All points at distance r from the centre. V = 4/3 πr³, A = 4πr². |
| Hemisphere | Half a sphere. V = 2/3 πr³; curved area 2πr². |
| Composite solid | A solid made from simpler ones joined or removed. |
| Density | Mass per unit volume: ρ = m/V (g/cm³ or kg/m³). Water is 1 g/cm³ = 1000 kg/m³. |
| Population density | People per unit area (a 2D version of the same idea). |
| Surface-to-volume ratio | A/V; falls as objects grow (scales by 1/k). |

## 1. The formulas, all together

| Solid | Volume | Surface area |
|---|---|---|
| Prism | Bh | 2B + (perimeter)h (right prism) |
| Cylinder | πr²h | 2πr² + 2πrh |
| Pyramid | ⅓Bh | B + lateral (½ × perimeter × ℓ for a regular pyramid) |
| Cone | ⅓πr²h | πr² + πrℓ, ℓ = √(r² + h²) |
| Sphere | 4/3 πr³ | 4πr² |
| Hemisphere | 2/3 πr³ | 2πr² (curved) + πr² (flat) |

Where the sphere formulas come from: by Cavalieri, a hemisphere of radius r has the same volume as a cylinder of radius r and height r with a cone removed (at height y both cross sections have area π(r² − y²)): πr³ − ⅓πr³ = 2/3 πr³. The surface area 4πr² is the derivative-like fact that a thin shell of thickness t has volume ≈ 4πr² t; it is also exactly the curved area of the surrounding cylinder (Archimedes).

**Worked example 1 (sphere).** r = 3: V = 36π ≈ 113.1; A = 36π ≈ 113.1 (another coincidence of numbers, not of units).

**Worked example 2 (composite: a silo).** A cylinder of radius 4 and height 12 topped by a hemisphere of radius 4: V = π · 16 · 12 + 2/3 π · 64 = 192π + 42.67π ≈ 737.2.

**Worked example 3 (composite: an ice-cream cone).** Cone of radius 3 and height 10 with a hemisphere of radius 3 on top: V = ⅓ · 9π · 10 + 2/3 · 27π = 30π + 18π = 48π ≈ 150.8.

**Worked example 4 (a hole).** A cube of edge 10 has a cylindrical hole of radius 2 drilled straight through: V = 1000 − π · 4 · 10 ≈ 1000 − 125.7 = 874.3.

**Worked example 5 (a capsule).** A cylinder of radius 1 and length 6 with hemispherical ends: V = 6π + 4/3 π ≈ 23.0; A = 2π · 1 · 6 + 4π ≈ 31.4 (the two hemispherical ends make one sphere's surface).

**Try it 1.1** A sphere has volume 288π. Radius? *(Answer: r³ = 216, r = 6.)*

**Try it 1.2** A cone of radius 4 and height 9 sits on a cylinder of radius 4 and height 5. Total volume? *(Answer: 48π + 80π = 128π ≈ 402.1.)*

## 2. Surface area versus volume

Two boxes with volume 1000: a 10 × 10 × 10 cube has surface area 600; a 20 × 5 × 10 box has 2(100 + 50 + 200) = 700. Same volume, more material. Among boxes of a given volume the cube uses the least surface; among all solids, the sphere does (which is why bubbles are round).

**Why it matters.** Packaging cost is surface area; contents are volume. Heat loss is surface; heat produced is volume. A radiator wants a large surface for its volume (fins); a storage tank wants a small one.

**Worked example 6 (a can).** A can must hold 500 cm³. With r = 3: h = 500/(9π) ≈ 17.7, A = 2π · 9 + 2π · 3 · 17.7 ≈ 56.5 + 333.6 = 390.1. With r = 4.3: h ≈ 8.6, A ≈ 116.2 + 232.4 = 348.6. The second uses less metal; the minimum is near h = 2r (height equal to the diameter).

**Worked example 7.** A cube of edge 5 has A = 150 and V = 125, ratio 1.2. Edge 10: A = 600, V = 1000, ratio 0.6. Doubling the size halves the surface-to-volume ratio (the 1/k rule).

**Try it 2.1** Which has more surface area for its volume: a sphere of radius 3 or a cube of edge 5? *(Answer: sphere: 113.1/113.1 = 1.0; cube: 150/125 = 1.2; the cube.)*

## 3. Volume and density

**density = mass / volume**, so mass = density × volume and volume = mass / density. Keep units consistent: g with cm³, kg with m³. Water: 1 g/cm³. Steel ≈ 7.85 g/cm³. Gold ≈ 19.3 g/cm³. Pine ≈ 0.5 g/cm³ (it floats because it is less dense than water).

**Worked example 8.** A steel rod of radius 1 cm and length 10 cm: V = 10π ≈ 31.4 cm³; mass ≈ 31.4 × 7.85 ≈ 246.6 g.

**Worked example 9.** A gold bar 20 cm × 8 cm × 4 cm: V = 640 cm³; mass = 640 × 19.3 = 12,352 g ≈ 12.4 kg.

**Worked example 10.** A ball of radius 4.5 cm has mass 343 g. V = 4/3 π · 91.125 ≈ 381.7 cm³; density ≈ 0.90 g/cm³, so it floats.

**Worked example 11 (unknown dimension).** A cube of aluminium (2.7 g/cm³) has mass 729 g. V = 270 cm³; edge = ∛270 ≈ 6.46 cm.

**Population density.** A city of 2,400,000 people on 600 km² has density 4000 people per km². A town of 35,000 on 50 km² has 700 per km². Density compares crowding regardless of size.

**Try it 3.1** A concrete block (2.4 g/cm³) is 40 cm × 20 cm × 10 cm. Mass? *(Answer: 8000 × 2.4 = 19,200 g = 19.2 kg.)*

**Try it 3.2** A 1 kg object has volume 1250 cm³. Density? Floats? *(Answer: 0.8 g/cm³; yes.)*

## 4. Volume and graphing

Fix all dimensions but one and watch the volume.

- **Cylinder, radius fixed, height h varies:** V = (πr²) h, a line through the origin with slope πr². Doubling h doubles V.
- **Cylinder, height fixed, radius r varies:** V = (πh) r², a parabola through the origin. Doubling r quadruples V.
- **Cube, edge s varies:** V = s³, a cubic curve; doubling s multiplies V by 8.
- **Sphere, radius r varies:** V = 4/3 πr³, also cubic.
- **Cone, height fixed, r varies:** quadratic; radius fixed, h varies: linear.

```
Figure description: three graphs of V against the varying dimension, all through the origin.
Linear (height of a cylinder): a straight line.
Quadratic (radius of a cylinder): a parabola, flat near 0 then rising faster.
Cubic (edge of a cube): flatter still near 0, then rising fastest.

   V |            cubic /
     |          /     .
     |        /    . quadratic
     |      /   .    _ _ linear
     |    / . _ _
     |_/._____________ dimension
```

**Reading a graph.** If a graph of V against r for a cylinder shows V = 100 at r = 2, then at r = 4 it shows 400 (quadratic), and the height can be recovered: 100 = π · 4 · h, h ≈ 7.96.

**Worked example 12.** A cylindrical tank of radius 1.5 m is filled at a steady rate. The water's volume grows linearly with its depth: V = 2.25π d ≈ 7.07 d (m³ per metre of depth). At depth 2 m, V ≈ 14.1 m³.

**Worked example 13.** A cone-shaped funnel (apex down) fills from the bottom. The water forms a cone similar to the funnel, so V ∝ d³ where d is the depth: the volume graph is cubic, flat at first and then steep, which is why the level rises fast at the beginning and slowly near the top.

**Worked example 14.** Which graph is which? A table shows V doubling when the dimension doubles: linear. Quadrupling: quadratic (the dimension is a radius with everything else fixed). Multiplying by 8: cubic (a scale factor, or the radius of a sphere).

**Try it 4.1** A cylinder's volume is 50 when its height is 4 (radius fixed). Volume when the height is 10? *(Answer: 125, linear.)*

**Try it 4.2** A sphere's volume is 20 when r = 1. Volume when r = 3? *(Answer: 540, cubic.)*

## Common mistakes

- **Using 4/3 πr³ for a hemisphere** (it is half) or forgetting the flat face in a hemisphere's surface area.
- **Adding the hidden faces** of a composite solid's surface area (the cylinder's top under the hemisphere is not surface).
- **Mixing g/cm³ with m³.** 1 g/cm³ = 1000 kg/m³.
- **Expecting V to double when r doubles.** For a cylinder it quadruples (and for a sphere it is ×8).
- **Reading a cubic graph as linear** between two points; check the ratio.

## Where this goes next

The Unit 5 exam covers solids of rotation, cross sections, scaling by k² and k³, all the volume and surface-area formulas, Cavalieri's principle, density and graphs. Unit 6 moves to coordinate geometry: transformations as functions, the distance formula, circles and parabolas as equations, and coordinate proofs.

## Self-check

1. A sphere has radius 6. Volume and surface area?
2. A silo is a cylinder of radius 3 and height 8 topped by a hemisphere. Volume?
3. A cube of edge 4 has a square hole 1 by 1 drilled straight through. Volume and surface area?
4. A silver ring (10.5 g/cm³) has volume 0.8 cm³. Mass?
5. The volume of a cone with fixed height is 30 when r = 2. What is it when r = 5, and what shape is the graph of V against r?

*Answers: (1) 288π ≈ 904.8; 144π ≈ 452.4. (2) 72π + 18π = 90π ≈ 282.7. (3) 64 − 4 = 60; surface 96 − 2 + 4 · 4 = 110 (remove the two 1 × 1 openings, add four 1 × 4 inner walls). (4) 8.4 g. (5) 30 × (5/2)² = 187.5; a parabola through the origin.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 5, Lessons 15–18, https://im.kendallhunt.com/HS/teachers/2/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Densities are rounded reference values. Accessed 2026-10-16.*
