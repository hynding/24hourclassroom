# Week 1 · Angles and Special Right Triangles

**Topics:** 1.1 Angles, Degrees and Standard Position · 1.2 Similar Triangles and Special Right Triangles
**Standards:** HSG-SRT.A.2, HSG-SRT.B.5, HSG-SRT.C.6 (with HSF-TF.A.2 as the goal angles in standard position are building towards)
**Spiral:** This is the first week. It draws on Geometry: angle measure, the triangle angle sum of 180°, the Pythagorean theorem, and the angle-angle (AA) test for similar triangles. Everything in the course rests on the two ideas here: an angle is an amount of turning, and in a right triangle the shape (and so every ratio of sides) is fixed by one acute angle.

## What you need to be able to do

- **1.1** Describe an angle as a rotation from an initial side to a terminal side, and draw any angle, positive or negative, in standard position.
- **1.1** Convert between decimal degrees and degrees–minutes–seconds (DMS).
- **1.1** Name the quadrant of an angle's terminal side, recognise quadrantal angles, and find coterminal angles by adding or subtracting multiples of 360°.
- **1.1** Find complements and supplements, and say when an angle has none.
- **1.2** Use AA similarity to explain why a ratio of two sides of a right triangle depends only on the acute angle, not on the size of the triangle.
- **1.2** Find every side of a 45°-45°-90° or 30°-60°-90° triangle from any one side, exactly and as a decimal.

## Key terms

| Term | Meaning |
|---|---|
| Initial side, terminal side | The ray an angle starts from and the ray it ends on after the rotation. |
| Standard position | Vertex at the origin, initial side along the positive x-axis. |
| Positive / negative angle | Counterclockwise rotation is positive; clockwise is negative. |
| Degree, minute, second | One full turn is 360°; 1° = 60′ (minutes) and 1′ = 60″ (seconds), so 1° = 3600″. |
| Quadrantal angle | An angle in standard position whose terminal side lies on an axis: 0°, ±90°, ±180°, ±270°, … |
| Coterminal angles | Angles with the same terminal side; they differ by a whole multiple of 360°. |
| Complementary / supplementary | Two positive angles with sum 90° / sum 180°. |
| Similar triangles | Triangles with equal corresponding angles; corresponding sides are in one constant ratio. |

## Angles as rotations (1.1)

In Geometry an angle was a static figure: two rays with a common vertex. In trigonometry an angle is the **amount a ray turns**. Fix the initial side, rotate a copy of it about the vertex, and stop at the terminal side. Turning counterclockwise gives a positive measure; turning clockwise gives a negative one. Because a ray can turn more than once, angles such as 450° or −720° make sense: 450° is one full turn plus a quarter turn.

Put the vertex at the origin and the initial side along the positive x-axis and the angle is in **standard position**. The terminal side then lands in a quadrant (I to IV, counterclockwise from the upper right) or on an axis. Angles that land on an axis are **quadrantal**: 90° points up, 180° left, 270° down, 360° right again.

Angles in standard position are **coterminal** when they share a terminal side. Adding or subtracting 360° leaves the terminal side where it was, so the coterminal angles of θ are θ + 360°k for any integer k.

**Worked example 1 (coterminal angles and quadrants).** Find the angle between 0° and 360° that is coterminal with −510°, and name its quadrant. Then give one positive and one negative angle coterminal with 125°.

Add 360° until the result lands in [0°, 360°): −510° + 360° = −150°, and −150° + 360° = 210°. Since 180° < 210° < 270°, the terminal side is in quadrant III. For 125° (quadrant II): 125° + 360° = 485° and 125° − 360° = −235°.

**Complements and supplements.** The complement of θ is 90° − θ and the supplement is 180° − θ. The complement of 62° is 28°; its supplement is 118°. An angle of 90° or more has no (positive) complement, and an angle of 180° or more has no supplement. In a right triangle the two acute angles are always complementary, because the three angles sum to 180°.

## Degrees, minutes and seconds (1.1)

Surveyors, navigators and astronomers split a degree the way a clock splits an hour: 60 minutes per degree and 60 seconds per minute. To convert DMS to decimal degrees, divide minutes by 60 and seconds by 3600. To go back, peel off the whole degrees, multiply the leftover decimal by 60 to get minutes, then multiply that leftover by 60 to get seconds.

**Worked example 2 (DMS to decimal and back).** Convert 47°15′36″ to decimal degrees, and convert 23.42° to DMS.

47°15′36″ = 47 + 15/60 + 36/3600 = 47 + 0.25 + 0.01 = 47.26°.

23.42° = 23° + 0.42°. Then 0.42 × 60 = 25.2′, so 25′ and 0.2′ left over; 0.2 × 60 = 12″. So 23.42° = 23°25′12″.

A common slip is to read 23.42° as 23°42′. The digits after the decimal point are hundredths of a degree, not minutes: 42′ is 0.7°.

## Similar triangles and why ratios depend on the angle (1.2)

Take two right triangles that both have an acute angle of 35°. Each has a 90° angle, so by the angle sum each also has a 55° angle. Two pairs of equal angles is enough: by **AA similarity** the triangles are similar. Similar triangles are scaled copies, so every side of the larger one is k times the matching side of the smaller one, for one scale factor k.

Now compare the ratio of two sides **within** one triangle, say the side opposite the 35° angle divided by the hypotenuse. In the larger triangle both lengths are multiplied by k, and k cancels: (k·a)/(k·c) = a/c. So that ratio is the same in every right triangle with a 35° angle. It depends only on the angle. Next week gives these ratios names (sine, cosine, tangent and the rest); this week's job is to see why they are well defined.

**Worked example 3 (shadows and similarity).** At the same moment, a hypothetical 1.6 m student casts a shadow 2.4 m long and a tree casts a shadow 18 m long. How tall is the tree?

The sun's rays meet level ground at the same angle for both, and both stand vertically, so the two right triangles (height, shadow, ray) are similar by AA. The ratio height/shadow is the same: 1.6/2.4 = h/18, so h = 18 × 1.6/2.4 = 12 m. Notice that height/shadow = 2/3 for every object at that moment; it is fixed by the sun's angle alone.

## The two special right triangles (1.2)

Two angle choices give side ratios that can be found exactly with the Pythagorean theorem.

**45°-45°-90°.** Cut a square of side a along a diagonal. The legs are both a, and the hypotenuse is √(a² + a²) = a√2. Ratio of sides: **1 : 1 : √2**.

**30°-60°-90°.** Cut an equilateral triangle of side 2s in half with an altitude. The hypotenuse is 2s, the short leg (opposite 30°) is s, and the long leg (opposite 60°) is √((2s)² − s²) = s√3. Ratio of sides: **1 : √3 : 2**, short leg : long leg : hypotenuse.

Two checks prevent most errors: the hypotenuse is always the longest side, and in the 30°-60°-90° triangle the shortest side sits opposite the smallest angle.

**Worked example 4 (45°-45°-90°).** The diagonal of a square tile is 10 cm. Find the side length exactly and to the nearest hundredth.

The diagonal is the hypotenuse of a 45°-45°-90° triangle, so side × √2 = 10 and side = 10/√2 = 10√2/2 = 5√2 ≈ 7.07 cm.

**Worked example 5 (30°-60°-90°).** A 12 ft ramp makes a 30° angle with the level ground. How high does it rise, and how far does it run horizontally?

The ramp is the hypotenuse, 2s = 12, so s = 6. The rise is opposite 30°: the short leg, 6 ft. The run is opposite 60°: the long leg, 6√3 ≈ 10.39 ft.

**Worked example 6 (starting from the long leg).** In a 30°-60°-90° triangle the side opposite 60° is 9. Find the other two sides.

s√3 = 9, so s = 9/√3 = 9√3/3 = 3√3 ≈ 5.20 (short leg), and the hypotenuse is 2s = 6√3 ≈ 10.39.

**Try it.**
1. Convert 108°45′ to decimal degrees and 61.15° to DMS.
2. Find the coterminal angle in [0°, 360°) for 790° and for −45°.
3. An equilateral triangle has side 8. Find its altitude exactly.

*Answers:* 1. 108.75°; 61°9′. 2. 70°; 315°. 3. 4√3 ≈ 6.93.

## Common errors

- **Reading decimals as minutes.** 23.42° is 23°25′12″, not 23°42′.
- **Going the wrong way round.** A negative angle turns clockwise from the positive x-axis: −60° ends in quadrant IV, not quadrant II.
- **Coterminal by 180°.** Coterminal angles differ by multiples of 360°; θ and θ + 180° point in opposite directions.
- **Swapping the legs of a 30°-60°-90° triangle.** The short leg is opposite 30°; the long leg (short × √3) is opposite 60°.
- **Multiplying by √2 the wrong way.** From the hypotenuse of a 45°-45°-90° triangle, divide by √2 to get a leg.
- **Mixing up complement and supplement.** Complement: 90° minus. Supplement: 180° minus.

## Where this goes next

Week 2 names the six ratios of sides of a right triangle (sine, cosine, tangent and their reciprocals) and uses this week's special triangles to find their exact values at 30°, 45° and 60°. The complementary-angle fact returns as the cofunction identities. Week 3 uses the ratios to solve triangles and to find heights and distances, with angles in DMS and bearings measured from north. Week 5 places a right triangle at the origin and uses standard position to define the ratios for any angle, which is why quadrants and coterminal angles matter.

## Self-check

1. Convert 15°20′24″ to decimal degrees.
2. Name the quadrant of −200°, and give a positive angle coterminal with it.
3. Explain, using similarity, why every right triangle with a 50° angle has the same ratio of the leg opposite 50° to the hypotenuse.
4. A 45°-45°-90° triangle has legs of 7. Find the hypotenuse exactly.
5. The hypotenuse of a 30°-60°-90° triangle is 15. Find both legs exactly.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSG-SRT.A.2, HSG-SRT.B.5, HSG-SRT.C.6, HSF-TF.A.2); its approach follows the trigonometry lessons of IM 9–12 Math by Illustrative Mathematics (© 2019, CC BY 4.0). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
