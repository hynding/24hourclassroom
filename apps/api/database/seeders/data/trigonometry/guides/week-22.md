# Week 22 · Surveying and Navigation

**Topics:** 4.5 Surveying and Navigation
**Standards:** HSG-SRT.C.8, HSG-SRT.D.10, HSG-SRT.D.11
**Spiral:** Week 3 introduced bearings and angles of elevation with right triangles; this week the triangles are oblique. Week 20's law of sines handles any problem with two known angles, week 21's law of cosines handles two known sides with the angle between them, and week 21's area formulas measure land. The work is mostly in turning a word problem into one triangle with the right labels.

## What you need to be able to do

- **4.5** Convert between compass bearings (N 35° E) and three-digit bearings (035°), and find the reverse bearing.
- **4.5** Find the angle inside a triangle formed by two legs of a course from the two bearings.
- **4.5** Find the distance and bearing back to the start after a two-leg course.
- **4.5** Find a distance you cannot walk (across a lake or a ravine) from measurements you can make.
- **4.5** Find the height of an inaccessible tower from two angles of elevation and the distance between the sightings.
- **4.5** Locate an object by triangulation from two stations, and choose the right law for each step.

## Key terms

| Term | Meaning |
|---|---|
| Compass bearing | Start facing north or south, turn a stated angle (less than 90°) towards east or west: N 35° E, S 20° W. |
| Three-digit bearing (azimuth) | The angle measured clockwise from north, written with three digits: 035°, 200°, 315°. |
| Reverse bearing | The bearing from B back to A: add 180° to the bearing from A to B, or subtract 180° if that passes 360°. |
| Leg | One straight stretch of a course, given by a distance and a bearing. |
| Triangulation | Locating a point by measuring the angles to it from the two ends of a known baseline. |
| Baseline | A distance between two observation points that can be measured directly. |

## Bearings revisited (4.5)

A three-digit bearing is the clockwise angle from north. A compass bearing names the starting direction (N or S), the angle, and the direction of turn (E or W).

| Compass | Three-digit | How |
|---|---|---|
| N 35° E | 035° | Start at north, turn 35° clockwise. |
| S 35° E | 145° | South is 180°; turning towards east goes back 35°: 180° − 35°. |
| S 20° W | 200° | 180° + 20°. |
| N 40° W | 320° | 360° − 40°. |

**Reverse bearings.** Travelling from A to B on 060° means travelling from B to A on 240°. The reverse of 300° is 120°.

**The turn angle.** Draw a small north arrow at every point where the course changes direction. North lines at different points are parallel, so alternate angles and the reverse bearing let you find the angle inside the triangle.

**Worked example 1 (two-leg course).** A hypothetical survey boat sails 40 miles from A on a bearing of 060° to B, then 25 miles on a bearing of 110° to C. Find the distance AC and the bearing from A to C.

At B, the boat arrived heading 060°, so the direction back towards A is 240°. The new heading is 110°. The angle inside the triangle at B is the angle between the directions 240° and 110°: 240° − 110° = 130°. (Shortcut: the boat turned 110° − 60° = 50° to the right, and the interior angle is 180° − 50° = 130°.)

Now it is SAS, so use the law of cosines:

AC² = 40² + 25² − 2(40)(25) cos 130° ≈ 1600 + 625 + 1285.6 = 3510.6, so AC ≈ 59.25 miles.

For the bearing, find angle A, opposite the shorter known side, so it is certainly acute: sin A = 25 sin 130°/59.25 ≈ 0.3232, A ≈ 18.9°. The first leg was on 060°, and C lies further clockwise, so the bearing from A to C is 060° + 18.9° ≈ 078.9°. The bearing to return from C to A is 258.9°.

## Distances you cannot walk (4.5)

When a lake, river or building blocks a direct measurement, stand at a third point where you can measure the distance to both ends and the angle between them. That is SAS.

**Worked example 2 (across a lake).** From a point C on shore, a surveyor measures CA = 320 m to a dock at A and CB = 410 m to a boathouse at B across the lake, and the angle ACB = 68°. Find AB.

AB² = 320² + 410² − 2(320)(410) cos 68° ≈ 102 400 + 168 100 − 98 297 ≈ 172 203, so AB ≈ 415.0 m.

If instead the surveyor can walk a baseline along one shore and measure the angles to a far point, that is ASA, and the law of sines is the tool, as in triangulation below.

## The height of an inaccessible tower (4.5)

You cannot reach the base of a tower on the far side of a fence, so you cannot measure the horizontal distance to it. Instead, measure the angle of elevation from two points P and Q on a straight line towards the tower, and the distance PQ between them.

Let α be the angle at the far point P and β the larger angle at the nearer point Q, with T the top of the tower. In the oblique triangle PQT:

- the angle at P is α;
- the angle at Q is 180° − β (it sits beside the angle of elevation β on a straight line);
- the angle at T is therefore 180° − α − (180° − β) = β − α.

**Worked example 3.** From P the angle of elevation to the top of a hypothetical transmission tower is 28°. After walking 50 m straight towards it to Q, the angle is 41°. Find the height of the tower.

In triangle PQT, angle T = 41° − 28° = 13°, and side PQ = 50 is opposite T. The side QT is opposite the angle at P (28°), so by the law of sines

QT = 50 sin 28°/sin 13° ≈ 104.35 m.

QT is the hypotenuse of the right triangle formed by Q, the top, and the base, so the height is

h = QT sin 41° ≈ 68.46 m,

and the horizontal distance from Q to the base is QT cos 41° ≈ 78.75 m.

Two laws in two triangles: the law of sines in the oblique triangle, then right-triangle trigonometry from week 3.

## Triangulation (4.5)

Two stations at the ends of a known baseline each measure the direction to a distant object. The baseline and the two angles give ASA.

**Worked example 4 (locating a fire).** Fire lookouts A and B are 12 km apart, with B due east of A. Smoke is seen from A on a bearing of N 52° E and from B on a bearing of N 25° W. How far is the fire F from each lookout, and how far north of the line AB is it?

Angles inside triangle ABF:

- at A, the angle between the direction east (towards B) and N 52° E is 90° − 52° = 38°;
- at B, the angle between the direction west (towards A) and N 25° W is 90° − 25° = 65°;
- at F, 180° − 38° − 65° = 77°.

By the law of sines, with AB = 12 opposite F:

AF = 12 sin 65°/sin 77° ≈ 11.16 km, BF = 12 sin 38°/sin 77° ≈ 7.58 km.

The distance north of AB is the height from F: AF sin 38° ≈ 6.87 km (check: BF sin 65° ≈ 6.87 km ✓).

## Choosing the right law

Every problem this week reduces to one or two triangles. Sketch, mark what you know, then:

| What the triangle gives you | Tool |
|---|---|
| Two sides and the angle between them (two legs of a course; distance across a lake) | Law of cosines |
| Two angles and a side (triangulation; a tower from two sightings) | Law of sines, after the angle sum |
| Three sides (a plot of land paced out) | Law of cosines for an angle; Heron for area |
| A right angle somewhere (height from a hypotenuse) | Right-triangle ratios |

**Worked example 5 (a three-sided field).** A hypothetical triangular field has sides 120 m, 150 m and 200 m. Its largest angle is opposite 200 m: cos θ = (120² + 150² − 200²)/(2 · 120 · 150) = −3100/36 000, so θ ≈ 94.9°. Its area by Heron: s = 235, area = √(235 · 115 · 85 · 35) ≈ 8967 m².

## Common errors

- **Using the bearing as the interior angle.** A bearing is measured from north; the angle in the triangle almost never equals it. Draw a north line at every vertex.
- **Getting the reverse bearing wrong.** Add or subtract 180°, never 90°.
- **Mislabelling the tower triangle.** The angle at the nearer point is 180° − β, and the angle at the top is β − α. The height is not a side of the oblique triangle.
- **Stopping at the line of sight.** QT is a slant distance; multiply by sin β to get the height.
- **Adding the angle on the wrong side.** When you find the bearing to the end of a course, decide from the sketch whether the angle at the start is added to or subtracted from the first bearing.

## Where this goes next

Week 23 describes a leg of a course as a vector, with a magnitude (distance) and a direction angle, and adds legs by components instead of by the law of cosines. Weeks 24 and 25 use the same pictures for forces, airplane headings in a crosswind and boats crossing a current.

## Self-check

1. Write S 35° E and N 40° W as three-digit bearings, and give the reverse bearing of each.
2. A boat sails 30 nautical miles on 040° and then 18 nautical miles on 115°. Find the interior angle at the turn.
3. From a point C, two trees across a river are 180 m and 240 m away with an angle of 52° between them. Find the distance between the trees.
4. Angles of elevation of 24° and 39° are measured to the top of a cliff from two points 80 m apart on a line towards it. Find the cliff's height.
5. Lookouts 8 km apart on an east–west line see a fire on bearings N 40° E (west lookout) and N 30° W (east lookout). Find the angle at the fire and the distance from the west lookout.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSG-SRT.C.8, HSG-SRT.D.10, HSG-SRT.D.11). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
