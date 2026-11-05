# Week 4 · Radian Measure and Circular Motion

**Topics:** 1.7 Radian Measure · 1.8 Arc Length, Sector Area and Angular Speed
**Standards:** HSF-TF.A.1 (radian measure as the length of the arc subtended on the unit circle); HSG-C.B.5 (arc length proportional to the radius, sector area)
**Spiral:** Week 1 measured angles as rotations in degrees and found coterminal angles; this week measures the same rotations with a second unit. Week 1's similar-triangle argument, that a ratio of lengths depends only on the angle, is exactly why the ratio arc ÷ radius can serve as an angle measure. Weeks 2 and 3 used degrees on right triangles; that does not change, but from Unit 2 on most angles will be in radians.

## What you need to be able to do

- **1.7** Explain what an angle of 1 radian is, and why a full turn is 2π radians.
- **1.7** Convert between degrees and radians in both directions, exactly (as multiples of π) and as decimals.
- **1.7** Recognise the common radian angles (π/6, π/4, π/3, π/2, π and their multiples) and find coterminal angles in radians.
- **1.8** Use s = rθ to find an arc length, a radius or a central angle, with θ in radians.
- **1.8** Use A = ½r²θ to find the area of a sector.
- **1.8** Find angular speed ω (radians per unit time) and linear speed v = rω, and convert revolutions per minute into radians per second or minute.

## Key terms

| Term | Meaning |
|---|---|
| Radian | The central angle that cuts off an arc equal in length to the radius. About 57.3°. |
| Radian measure of an angle | θ = s/r, the arc length divided by the radius, for any circle centred at the vertex. A ratio of lengths, so it has no unit. |
| Arc length s | The distance along the circle between the two sides of a central angle: s = rθ. |
| Sector | The "pizza slice" region bounded by two radii and the arc between them; area A = ½r²θ. |
| Angular speed ω | The angle turned per unit time: ω = θ/t, in radians per second (or per minute). |
| Linear speed v | The distance a point travels along its circular path per unit time: v = s/t = rω. |
| Revolution | One full turn: 360° = 2π radians. |

## Why a second unit for angles? (1.7)

Degrees split a turn into 360 equal parts, a choice made for convenience. Radians measure an angle by the circle itself. Draw a circle of radius r centred at the vertex of an angle; the angle cuts off an arc of length s. If you double the radius, the arc doubles too (the two pictures are similar), so the ratio s/r does not depend on which circle you drew. That ratio is the **radian measure**:

θ = s / r.

A whole circle has circumference 2πr, so a full turn is 2πr / r = **2π radians**. Therefore

360° = 2π radians, 180° = π radians, 1 radian = 180°/π ≈ 57.30°, 1° = π/180 radians ≈ 0.01745 radians.

Because s/r is length ÷ length, a radian measure is a plain number. Writing "rad" is optional; an angle written with no degree sign is in radians.

## Converting between degrees and radians (1.7)

- Degrees → radians: multiply by **π/180**.
- Radians → degrees: multiply by **180/π**.

Think of it as multiplying by a fraction equal to 1, chosen so the unit you do not want cancels.

**Worked example 1.** Convert 150° and −225° to radians, and 7π/4 and 2.5 radians to degrees.

- 150° · π/180 = 150π/180 = **5π/6**.
- −225° · π/180 = **−5π/4**. The sign carries through: the angle is still clockwise.
- 7π/4 · 180/π = 7 · 45° = **315°**. With π in the angle, the π's cancel and you can work exactly.
- 2.5 · 180/π ≈ **143.24°**. With no π, the answer is a decimal.

A useful shortcut: π/6 = 30°, π/4 = 45°, π/3 = 60°, π/2 = 90°. Then 5π/6 is five 30° pieces, 150°, and 4π/3 is four 60° pieces, 240°.

**Coterminal angles in radians.** Add or subtract 2π (not 360). For 11π/4, subtract 2π = 8π/4 to get 3π/4. For −π/3, add 6π/3 to get 5π/3.

## Arc length and sector area (1.8)

Rearranging θ = s/r gives the arc length formula

s = rθ  (θ in radians).

The sector has the same fraction of the whole circle's area as θ is of a full turn: A = (θ / 2π) · πr², which simplifies to

A = ½ r² θ  (θ in radians).

Both formulas need θ in radians. If an angle is given in degrees, convert it first.

**Worked example 2.** A circle has radius 12 cm. Find the length of the arc cut off by a central angle of 2π/3, and by an angle of 40° on a circle of radius 9 m.

- s = 12 · 2π/3 = **8π ≈ 25.13 cm**.
- 40° = 40π/180 = 2π/9, so s = 9 · 2π/9 = **2π ≈ 6.28 m**. Using 40 in place of 2π/9 would give 360 m, a sure sign that the angle was not converted.

**Worked example 3.** A hypothetical lawn sprinkler throws water 15 ft and sweeps back and forth through 120°. What area does it water?

120° = 2π/3. A = ½ · 15² · 2π/3 = ½ · 225 · 2π/3 = **75π ≈ 235.62 ft²**.

Check: 120° is one third of a turn, and one third of π · 15² = 225π is 75π.

**Worked example 4.** An arc 15 cm long lies on a circle of radius 6 cm. Find the central angle in radians and in degrees.

θ = s/r = 15/6 = **2.5 radians**, which is about **143.24°** (worked example 1). An angle of 2.5 radians is a little less than π ≈ 3.14, so a little less than half a turn, which matches.

## Angular speed and linear speed (1.8)

When something turns steadily, two speeds describe it:

- **Angular speed** ω = θ/t: how fast the angle changes. Every point on a rigid turning object has the same ω.
- **Linear speed** v = s/t: how fast a particular point moves along its path. Dividing s = rθ by t gives

  v = r ω  (ω in radians per unit time).

A point twice as far from the centre moves twice as fast, even though both points turn through the same angle.

Speeds are often given in **revolutions per minute (rpm)**. One revolution is 2π radians, so

ω (radians per minute) = 2π × (revolutions per minute).

**Worked example 5.** A hypothetical bicycle has wheels 26 inches in diameter turning at 180 rpm. Find the angular speed of a wheel and the speed of the bicycle in miles per hour.

- ω = 180 · 2π = **360π radians per minute** (≈ 1,130.97).
- The radius is 13 in, so v = 13 · 360π = 4,680π ≈ 14,702.65 inches per minute. A point on the tyre moves at the speed the bicycle rolls.
- Convert: multiply by 60 minutes per hour and divide by 63,360 inches per mile: 14,702.65 · 60 / 63,360 ≈ **13.92 mph**.

Carry units through every step; in v = rω the "radians" quietly drop out because a radian has no unit, leaving inches per minute.

**Try it.**
1. Convert 210° to radians and 3π/10 to degrees.
2. A central angle of 3 radians cuts off an arc on a circle of radius 4 m. Find the arc length and the sector area.
3. A hypothetical fan blade 30 cm long turns at 600 rpm. Find ω in radians per second and the linear speed of the blade tip in metres per second.

*Answers:* 1. 7π/6; 54°. 2. s = 12 m; A = ½ · 16 · 3 = 24 m². 3. ω = 600 · 2π / 60 = 20π ≈ 62.83 rad/s; v = 0.30 · 20π = 6π ≈ 18.85 m/s.

## Common errors

- **Degrees in s = rθ or A = ½r²θ.** Convert to radians first; the formulas are false for degrees.
- **Forgetting the 2π in rpm.** 45 rpm is 90π radians per minute, not 45 radians per minute.
- **Mixing time units.** If ω is per minute and the question asks for metres per second, divide by 60 at the end.
- **Diameter for radius.** A 26-inch wheel has r = 13 in.
- **Dropping the ½ in sector area.** r²θ alone is twice the area.
- **Coterminal angles with 360 in radian work.** In radians, add or subtract 2π.

## Where this goes next

Week 5 places angles of any size in standard position and defines sine, cosine and tangent for all of them; reference angles will be given in degrees and in radians. Week 6 puts radian angles on the unit circle, where an angle of θ radians is literally an arc of length θ, the idea behind graphing y = sin x in Unit 2. Angular speed returns in week 10, where ω becomes the number inside sin(ωt) for spinning wheels and oscillating springs.

## Self-check

1. Convert −135° and 330° to radians; convert 5π/12 to degrees.
2. Find an angle between 0 and 2π coterminal with 17π/6.
3. A sector of a circle of radius 10 cm has area 40 cm². Find its central angle in radians.
4. An arc of length 22 m on a circle subtends 2.2 radians. Find the radius.
5. A hypothetical merry-go-round turns at 4 rpm, and a child sits 3 m from the centre. Find the child's linear speed in metres per minute, exactly and to the nearest hundredth.

*Answers:* 1. −3π/4, 11π/6; 75°. 2. 5π/6. 3. 40 = ½ · 100 · θ, so θ = 0.8. 4. r = 22/2.2 = 10 m. 5. ω = 8π rad/min, v = 24π ≈ 75.40 m/min.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.A.1, HSG-C.B.5); its approach follows the trigonometry lessons of IM 9–12 Math by Illustrative Mathematics (© 2019, CC BY 4.0). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
