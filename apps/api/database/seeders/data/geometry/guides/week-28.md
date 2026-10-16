# Week 28 · Arcs, Sectors and the Radian

**Lessons:** 7.8 Arcs and Sectors · 7.9 Part to Whole · 7.10 Angles, Arcs, and Radii · 7.11 A New Way to Measure Angles
**Practices:** MP2 (reason quantitatively), MP7 (use structure), MP8 (regularity in repeated reasoning)
**Built from:** IM Geometry, Unit 7, Lessons 8–11, in our own words
**Spiral:** arc measure and central angles come from week 26. Everything about scaling comes from Unit 3 and Unit 5: all circles are similar (week 17), lengths scale by k and areas by k² (weeks 18–19). The circumference and area formulas were approximated with inscribed polygons in week 17 (Archimedes); here they are used as given.

## What you need to be able to do

- Find the length of an arc and the area of a sector from the radius and the central angle, as a fraction of the whole circle.
- Work backwards: from an arc length or a sector area and its angle, find the radius, the circumference and the area of the whole circle.
- Explain why, for a fixed central angle, arc length is proportional to radius (all circles are similar), so that arc length ÷ radius depends only on the angle.
- Define the radian measure of an angle as arc length divided by radius, convert between degrees and radians, and know the benchmark angles.

## Key terms

| Term | Meaning |
|---|---|
| Arc length | The distance along the circle between two points (not the chord). |
| Sector | The "pizza slice" region bounded by two radii and the arc between them. |
| Central angle of a sector | The angle at the centre between the two radii; it sets what fraction of the circle the sector is. |
| Segment of a circle | The region between a chord and its arc: sector minus the triangle. |
| Radian | The measure of a central angle given by arc length ÷ radius. A full turn is 2π radians. |

## 1. Arcs and sectors (7.8)

A central angle of θ degrees cuts off θ/360 of the circle: that fraction of the circumference 2πr is the **arc length**, and that fraction of the area πr² is the **sector area**.

**arc length = (θ/360) · 2πr    sector area = (θ/360) · πr²**

**Worked example 1.** Radius 6, central angle 60°. Fraction 60/360 = 1/6. Arc length = (1/6)(12π) = 2π ≈ 6.28. Sector area = (1/6)(36π) = 6π ≈ 18.85.

**Worked example 2.** Radius 10, central angle 135°. Fraction 135/360 = 3/8. Arc = (3/8)(20π) = 7.5π ≈ 23.56. Sector = (3/8)(100π) = 37.5π ≈ 117.81.

**Worked example 3 — a semicircle and a quarter.** Radius 4: the semicircular arc is 4π, the quarter-circle sector has area 4π too (coincidence of numbers: (1/2)(8π) and (1/4)(16π)).

**Worked example 4 — a segment.** Radius 6, central angle 90°. Sector area 9π ≈ 28.27. The triangle formed by the two radii is right-angled with legs 6 and 6, area 18. Segment area = 9π − 18 ≈ 10.27.

**Worked example 5 — perimeter of a sector.** Radius 8, angle 45°: arc = (1/8)(16π) = 2π ≈ 6.28; perimeter = 8 + 8 + 2π ≈ 22.28. The perimeter includes both radii.

```
Figure description: a circle of radius 6 with centre O. Two radii OA and
OB make a 60° angle. The arc from A to B (length 2π) and the two radii
bound the shaded sector (area 6π). The chord AB is 6, so triangle OAB is
equilateral.

            A
           /  ⌒
          /     ⌒
         O───60°──── B
```

**Try it 1.1** Radius 9, central angle 80°. Find the arc length and the sector area. *(Answer: fraction 2/9; arc = 4π ≈ 12.57; sector = 18π ≈ 56.55.)*

**Try it 1.2** Find the area of the segment cut off by a 60° central angle in a circle of radius 6. *(Answer: sector 6π ≈ 18.85 minus equilateral triangle (√3/4)(36) ≈ 15.59, about 3.26.)*

## 2. Part to whole (7.9)

If a sector is a known fraction of the circle, dividing by that fraction gives the whole.

**Worked example 6.** A sector with central angle 120° has area 15π. The fraction is 1/3, so the whole circle has area 45π: πr² = 45π, r² = 45, r = √45 = 3√5 ≈ 6.71. Circumference 2π · 3√5 = 6√5 π ≈ 42.15.

**Worked example 7.** An arc of 150° has length 5π. Fraction 5/12; circumference = 5π ÷ (5/12) = 12π; r = 6; area 36π.

**Worked example 8 — writing an equation.** A sector of a circle of radius 12 has area 60π. (θ/360)(144π) = 60π, so θ/360 = 60/144 = 5/12 and θ = 150°.

**Worked example 9 — from arc length to angle.** In a circle of radius 5, an arc has length 2π. (θ/360)(10π) = 2π, θ/360 = 1/5, θ = 72°.

**Worked example 10 — enough information?** "A sector has area 8π. Find the radius." Not enough: the angle is missing. "A sector has area 8π and central angle 45°." Enough: whole area 64π, r = 8. Arc length and sector area together, without the angle, are also enough: area = ½ · r · arc (shown in section 4), so r = 2 · area ÷ arc.

**Try it 2.1** A sector with central angle 72° has area 10π. Find the radius. *(Answer: whole area 50π, r = √50 = 5√2 ≈ 7.07.)*

**Try it 2.2** In a circle of radius 15, a sector has area 45π. Find its central angle. *(Answer: 45/225 = 1/5 of the circle, 72°.)*

## 3. Angles, arcs and radii (7.10)

Two circles, radii 9 and 15, each with a 60° sector. Arc lengths: (1/6)(18π) = 3π and (1/6)(30π) = 5π. The arcs differ, but **arc ÷ radius** is the same: 3π/9 = π/3 and 5π/15 = π/3.

Why: all circles are similar. The big circle is a dilation of the small one with scale factor 15/9, which multiplies every length (including the arc) by 15/9 and leaves angles alone. So arc/radius is unchanged by the dilation; it depends only on the angle.

| Central angle | arc ÷ radius |
|---|---|
| 360° | 2π |
| 180° | π |
| 90° | π/2 |
| 60° | π/3 |
| 45° | π/4 |
| 30° | π/6 |
| 270° | 3π/2 |

**Worked example 11 — comparing angles without degrees.** Sector A: arc 6, radius 4, ratio 1.5. Sector B: arc 10, radius 8, ratio 1.25. Sector A has the larger central angle.

**Worked example 12 — progress bars.** Two circular progress bars show arcs of 12 cm and 15 cm. Who is further along? You cannot tell: the first bar might have radius 4 (ratio 3) and the second radius 10 (ratio 1.5). The ratio to the radius, not the arc alone, measures the angle.

**Worked example 13 — circumference over diameter.** Under a dilation, circumference and diameter scale by the same factor, so C/d is the same for every circle: that constant is π, and C = πd = 2πr.

**Try it 3.1** Sector P has arc 9 and radius 6; sector Q has arc 14 and radius 10. Which has the bigger angle? *(Answer: ratios 1.5 and 1.4; P.)*

## 4. A new way to measure angles: radians (7.11)

Since arc ÷ radius depends only on the angle, use it as the angle's measure:

**θ (in radians) = arc length ÷ radius.**

One radian is the angle whose arc equals the radius; it is about 57.3°. A full turn has arc 2πr, so 2π radians = 360°, and **π radians = 180°.**

**Converting.** degrees → radians: multiply by π/180. radians → degrees: multiply by 180/π.

| Degrees | Radians |
|---|---|
| 30° | π/6 |
| 45° | π/4 |
| 60° | π/3 |
| 90° | π/2 |
| 120° | 2π/3 |
| 135° | 3π/4 |
| 150° | 5π/6 |
| 180° | π |
| 270° | 3π/2 |
| 360° | 2π |

**Worked example 14.** 75° = 75π/180 = 5π/12 radians ≈ 1.309. 2 radians = 360/π ≈ 114.6°.

**Worked example 15 — from a sector.** An arc of length 7.5 in a circle of radius 5 subtends 7.5/5 = 1.5 radians ≈ 85.9°.

**Worked example 16 — the formulas become simpler.** With θ in radians, arc length = rθ and sector area = (θ/2π)(πr²) = ½r²θ. Radius 6, θ = π/3: arc 2π, area 6π, matching Worked example 1. Also area = ½ · r · (arc), which is why arc length and area together determine r.

**Try it 4.1** Convert 210° to radians and 5π/8 to degrees. *(Answer: 7π/6; 112.5°.)*

**Try it 4.2** An arc of length 4π in a circle of radius 6 subtends what angle in radians and in degrees? *(Answer: 4π/6 = 2π/3; 120°.)*

## Common mistakes

- **Using the chord instead of the arc.** Arc length is along the curve.
- **Forgetting the ½ in the triangle when computing a segment.**
- **Dividing by the fraction the wrong way.** Sector 15π is one third of the circle, so the whole is 15π ÷ (1/3) = 45π, not 5π.
- **Leaving out both radii in a sector's perimeter.**
- **Comparing angles by arc length alone.** Divide by the radius first.
- **Treating 2π as a number of degrees.** 2π radians is a full turn; π/2 radians is a right angle.
- **Multiplying by the wrong conversion factor.** Degrees to radians: × π/180 (the answer is smaller as a number).

## Where this goes next

Week 29 builds radian sense (how big is 1 radian, which benchmark is 2.5 radians near), uses rθ and ½r²θ in applications, and closes the unit with modelling problems that combine sectors, tangents, inscribed angles and triangle centres. Radians are the standard unit for angles in Algebra 2 and beyond.

## Self-check

1. Radius 12, central angle 150°. Find the arc length and sector area.
2. A sector of central angle 40° has area 4π. Find the radius.
3. Sector X has arc 5 and radius 2; sector Y has arc 9 and radius 4. Which central angle is larger?
4. Convert 300° to radians and 7π/4 to degrees.
5. An arc of length 3 in a circle of radius 2 subtends what angle? Give radians and degrees to one decimal.

*Answers: (1) fraction 5/12; arc 10π ≈ 31.42; area 60π ≈ 188.50. (2) whole area 36π, r = 6. (3) ratios 2.5 and 2.25; X. (4) 5π/3; 315°. (5) 1.5 radians ≈ 85.9°.*

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Geometry, Unit 7, Lessons 8–11, https://im.kendallhunt.com/HS/teachers/2/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
