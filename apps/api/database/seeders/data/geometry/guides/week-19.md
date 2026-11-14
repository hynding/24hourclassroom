# Week 19 · Scaling Solids and Cylinder Volumes

**Lessons:** 5.6 Scaling Solids · 5.7 The Root of the Problem · 5.8 Speaking of Scaling · 5.9 Cylinder Volumes · 5.10 Cross Sections and Volume
**Practices:** MP2 (reason quantitatively), MP3 (construct arguments), MP4 (model)
**Built from:** IM Geometry, Unit 5, Lessons 6–10, in our own words
**Spiral:** the k² rule for area (week 18) extends to k³ for volume, and cube roots undo it the way square roots did; the circle area πr² (week 17's polygon argument) gives the cylinder's base; cross sections (week 18) are what Cavalieri's principle compares.

## What you need to be able to do

- Scale a solid by k and state what happens to its lengths (k), surface area (k²) and volume (k³); explain why with a cube.
- Reverse the process: from a volume ratio find k by a cube root; from a surface-area ratio find k by a square root; convert between the two.
- Reason about real objects: why doubling a container's dimensions multiplies its capacity by 8, why a scaled-up animal needs thicker legs, why small things lose heat faster.
- Compute the volume of a right or oblique cylinder, V = πr²h, and find a missing dimension from the volume.
- State Cavalieri's principle and use it to argue that solids with congruent cross sections at every height have equal volumes.

## Key terms

| Term | Meaning |
|---|---|
| Surface area | The total area of the outside of a solid. Scales by k². |
| Volume | The amount of space inside. Scales by k³. |
| Cube root | ∛x is the number whose cube is x. ∛8 = 2, ∛27 = 3, ∛2 ≈ 1.26. |
| Right cylinder | Axis perpendicular to the bases. V = πr²h. |
| Oblique cylinder | Axis tilted; bases still parallel circles. Same volume as the right cylinder with the same base and height. |
| Height | The perpendicular distance between the bases, not the slanted edge. |
| Cavalieri's principle | Two solids between the same two parallel planes have equal volumes if every plane parallel to those planes cuts them in cross sections of equal area. |

## 1. Scaling a solid

Take a cube with edge 1: surface area 6, volume 1. Multiply the edge by k: each of its 6 faces becomes a k-by-k square, so the surface area is 6k² and the volume is k · k · k = k³.

Any solid is approximately a pile of small cubes, and each cube's volume scales by k³, so **volume scales by k³**. Any surface is approximately a patchwork of small squares, so **surface area scales by k²**.

| k | lengths × | surface area × | volume × |
|---|---|---|---|
| 2 | 2 | 4 | 8 |
| 3 | 3 | 9 | 27 |
| 1/2 | 0.5 | 0.25 | 0.125 |
| 1.5 | 1.5 | 2.25 | 3.375 |
| 10 | 10 | 100 | 1000 |

**Worked example 1.** A box 20 cm by 30 cm by 40 cm has volume 24,000 cm³ and surface area 2(600 + 800 + 1200) = 5200 cm². Scaling by k = 1.5: dimensions 30 by 45 by 60, volume 24,000 × 3.375 = 81,000 cm³ (check: 30 · 45 · 60 = 81,000 ✓), surface area 5200 × 2.25 = 11,700 cm².

**Worked example 2.** A cylinder has volume 50 cm³. Doubling its radius and its height multiplies the volume by 8: 400 cm³. Doubling only the radius multiplies by 4 (r² in the formula); doubling only the height multiplies by 2.

**Try it 1.1** A sphere's radius is tripled. Surface area factor? Volume factor? *(Answer: 9 and 27.)*

## 2. The root of the problem

**From volume to k:** k = ∛(volume factor). **From surface area to k:** k = √(area factor).

**Worked example 3.** Two similar bottles hold 250 mL and 2000 mL. Volume factor 8, so k = 2: the big bottle is twice as tall and twice as wide. Its label area is 4 times larger.

**Worked example 4.** A statue is enlarged so that its surface area is multiplied by 6.25. k = 2.5, so its volume (and weight, same material) is multiplied by 2.5³ = 15.625.

**Worked example 5.** A model has 1/1000 of the real object's volume. k = ∛(1/1000) = 1/10. Its surface area is 1/100 of the real one.

**Worked example 6.** A cube's volume is doubled. Its edge is multiplied by ∛2 ≈ 1.26 (not 2, and not √2). Its surface area is multiplied by (∛2)² ≈ 1.587.

**Converting between area and volume factors.** If area × a, then k = √a and volume × a^(3/2). If volume × v, then k = ∛v and area × v^(2/3). Example: volume × 64 ⇒ k = 4 ⇒ area × 16.

**Try it 2.1** Volume × 125: k? area factor? *(Answer: 5; 25.)*

**Try it 2.2** Surface area × 2: volume factor? *(Answer: k = √2, volume × 2√2 ≈ 2.83.)*

## 3. Speaking of scaling: why size matters

**Weight versus strength.** An animal's weight is proportional to its volume (k³); the strength of a leg bone is proportional to its cross-sectional area (k²). Scale an animal up by k = 10 (same shape): weight × 1000, bone strength × 100. The bones carry 10 times more weight per unit area, which is why elephants have proportionally far thicker legs than deer, and why a 10-metre ant could not stand.

**Heat and surface.** Heat produced is proportional to volume; heat lost is proportional to surface area. Surface-to-volume ratio scales by k²/k³ = 1/k: smaller animals have relatively more surface and lose heat faster (mice eat constantly; whales are insulated by size).

**Cooking and cooling.** A potato twice as wide takes much longer than twice as long to cook; the inside is farther from the surface and the volume to heat is 8 times larger while the surface receiving heat is 4 times larger.

**Prices and packaging.** A box with doubled dimensions holds 8 times as much but uses only 4 times as much cardboard.

**Worked example 7.** A 2 kg model of a bridge pillar is a 1 : 20 scale copy. The real pillar's mass (same material) is 2 × 20³ = 16,000 kg. The real pillar's painted surface is 400 times the model's.

**Worked example 8.** A giant in a story is 3 times a person's height with the same proportions. Weight × 27; the cross-section of the leg bones × 9; each square centimetre of bone carries 3 times the usual load.

**Try it 3.1** A sculpture is scaled down by k = 1/4 for a souvenir. If the original weighs 320 kg, what does the souvenir weigh (same material)? *(Answer: 320/64 = 5 kg.)*

## 4. Cylinder volumes

A right cylinder with base radius r and height h has volume **V = πr²h** (base area times height), the same pattern as a prism: a stack of h copies of the base.

**Worked example 9.** r = 3, h = 8: V = 72π ≈ 226.2.

**Worked example 10.** A cylindrical tank has volume 1000 L = 1 m³ and radius 0.5 m. Height: h = 1/(π · 0.25) ≈ 1.27 m.

**Worked example 11.** A can with diameter 8 cm holds 400 cm³. Height: 400 / (π · 16) ≈ 7.96 cm.

**Worked example 12 (a pipe).** Outer radius 5, inner radius 4, length 100: V = π(25 − 16)(100) = 900π ≈ 2827.

**Oblique cylinders.** If the cylinder leans, the volume is still πr²h with h the perpendicular height. A stack of coins pushed sideways has the same volume as the straight stack; the slanted edge is longer than h.

**Try it 4.1** r = 2.5, h = 6: volume? *(Answer: 37.5π ≈ 117.8.)*

**Try it 4.2** A cylinder has volume 200π and height 8: radius? *(Answer: r² = 25, r = 5.)*

## 5. Cross sections and volume: Cavalieri's principle

**Principle.** Place two solids between the same pair of parallel planes. If every plane parallel to them cuts the two solids in cross sections of **equal area**, the solids have **equal volume**.

Why believe it: slice both solids into very thin slabs. Each pair of slabs has the same base area and the same tiny thickness, so the same volume; add them up.

**Consequences.**
- An oblique cylinder (or prism) has the same volume as the right one with the same base and height: every horizontal slice is a congruent circle (or polygon).
- Two cylinders with equal base areas and equal heights have equal volumes, even if one base is a circle and the other a square: V = Bh for any such solid.
- Next week: all pyramids with the same base area and height have the same volume, which is where the 1/3 comes from.

**Worked example 13.** A stack of 50 identical sheets of paper is a right prism; push it into a slanted stack. Volume unchanged: each sheet is a cross section of the same area, and the height (perpendicular) is the same.

**Worked example 14.** Solid A is a cylinder of radius 2 and height 9. Solid B is a square prism with base side 2√π and height 9. Base areas: 4π and 4π. By Cavalieri, equal volumes: 36π ≈ 113.1.

**Try it 5.1** A cylinder leans so that its top is shifted 3 units sideways; the perpendicular height is 7 and the radius is 2. Volume? *(Answer: 28π ≈ 88.0; the shift does not matter.)*

## Common mistakes

- **Scaling volume by k or k².** Three dimensions, three factors.
- **Halving the edge to halve the volume.** Halving the edge divides the volume by 8; to halve the volume use k = ∛(1/2) ≈ 0.794.
- **Using the slant length as the height of an oblique cylinder.** Height is perpendicular.
- **Doubling the diameter and expecting the volume to double.** It quadruples (and × 8 if the height doubles too).
- **Mixing units.** Lengths in cm give volume in cm³; 1 L = 1000 cm³; 1 m³ = 1,000,000 cm³.

## Where this goes next

Week 20 finds volumes of prisms and pyramids, builds the pyramid formula V = ⅓Bh by dissecting a cube and by Cavalieri, and works with pyramids and cones of every kind. Week 21 puts all the solids together (spheres included), relates surface area to volume, and models density and graphs of volume against a dimension.

## Self-check

1. A solid is scaled by k = 4. Surface area factor? Volume factor?
2. Two similar jars hold 300 mL and 8100 mL. How many times taller is the big jar?
3. A cylinder has radius 6 and height 5. Find its volume, and the volume if both dimensions are halved.
4. Why does a mouse need to eat far more, relative to its body weight, than an elephant?
5. State Cavalieri's principle and use it to compare a right and an oblique cylinder with the same base and height.

*Answers: (1) 16; 64. (2) ∛27 = 3. (3) 180π ≈ 565.5; divided by 8: 22.5π ≈ 70.7. (4) Heat loss goes with surface area (k²), heat production with volume (k³); the mouse has far more surface per unit volume. (5) Equal cross-section areas at every height give equal volumes; every horizontal slice of either cylinder is a circle of radius r, so the volumes are both πr²h.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 5, Lessons 6–10, https://im.kendallhunt.com/HS/teachers/2/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
