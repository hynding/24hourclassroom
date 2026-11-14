# Week 18 · Periodic Phenomena; Sine, Cosine and Tangent

**Topics:** 3.1 Periodic Phenomena · 3.2 Sine, Cosine, and Tangent
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 3, Topics 3.1–3.2, learning objectives in our own words
**Spiral:** Units 1 and 2 studied functions whose behaviour never repeats: polynomials head off to ±∞, exponentials grow or decay, logarithms creep upward forever. This unit studies functions that come back to where they started. You still use the same tools from week 1: increasing and decreasing intervals, concavity, and the average rate of change as the slope of a secant line. From Algebra 2 and geometry: the Pythagorean theorem, similar triangles, and the right-triangle ratios sine, cosine and tangent.

## What you need to be able to do

- **3.1** Recognise periodic behaviour in a graph, a table or a verbal description, and state the period: the length of the shortest input interval over which the output pattern repeats.
- **3.1** Use periodicity to find outputs far from the given data: if f has period p, then f(x + kp) = f(x) for every whole number k.
- **3.1** Describe one full cycle of a periodic function (where it increases, decreases, is concave up or concave down, and how its average rates of change behave) and explain that the same description holds on every cycle.
- **3.2** Draw an angle in standard position, measure it in radians and in degrees, convert between the two, and find coterminal angles.
- **3.2** Use the radian definition θ = s/r to find arc length s = rθ on a circle of radius r.
- **3.2** Define sine, cosine and tangent of any angle θ using a point (x, y) on the terminal ray at distance r from the origin: sin θ = y/r, cos θ = x/r, tan θ = y/x, and interpret tan θ as the slope of the terminal ray.
- **3.2** Connect these definitions to the right-triangle ratios for acute angles.

## Key terms

| Term | Meaning |
|---|---|
| Periodic function | A function whose outputs repeat over equal-length input intervals: f(x + p) = f(x) for all x, for some positive constant p. |
| Period | The smallest positive p that works. One repetition of the pattern is a cycle. |
| Standard position | An angle with its vertex at the origin and its initial ray along the positive x-axis. |
| Terminal ray | The ray where the angle ends. Counterclockwise rotation gives a positive angle; clockwise gives a negative angle. |
| Radian | The angle that cuts off an arc equal in length to the radius. In general θ (in radians) = arc length ÷ radius. |
| Coterminal angles | Angles in standard position that share a terminal ray, such as π/3, 7π/3 and −5π/3. They differ by a multiple of 2π (or 360°). |
| Arc length | The distance along the circle subtended by angle θ: s = rθ, with θ in radians. |
| Sine, cosine, tangent | For a point (x, y) on the terminal ray at distance r = √(x² + y²) from the origin: sin θ = y/r, cos θ = x/r, tan θ = y/x (x ≠ 0). |

## Periodic phenomena (3.1)

Plenty of quantities rise and fall in a repeating pattern: the height of a pedal on a bicycle that is ridden at a steady pace, the water level at a dock, the number of daylight hours across a year, the voltage in a household circuit. A function that models such a quantity is **periodic**.

Formally, f is periodic if there is a positive number p with f(x + p) = f(x) for every x in the domain. The smallest such p is the **period**. If p works, so do 2p, 3p, and so on, which is why the definition asks for the smallest.

To read the period from a graph, find two points at the same stage of the pattern (two consecutive peaks, two consecutive troughs, or two consecutive places where the graph crosses its middle level going upward) and measure the horizontal distance between them. Two consecutive places where the output takes the same value are not enough: a wave passes through its middle level twice per cycle, once going up and once going down.

Because the pattern repeats, so does every feature of the pattern:

- If f increases on [a, b], it increases on [a + p, b + p], [a + 2p, b + 2p], ….
- If f is concave up on an interval, it is concave up on every shift of that interval by a multiple of p.
- The average rate of change over [a, b] equals the average rate of change over [a + p, b + p], because both outputs shift together.
- Over exactly one full period, the average rate of change is 0: f(a + p) − f(a) = 0.

**Worked example.** A hypothetical model gives the height h(t), in centimetres above the ground, of one bicycle pedal t seconds after a rider starts timing. Values are rounded to the nearest 0.1 cm.

| t (s) | 0 | 0.125 | 0.25 | 0.375 | 0.5 | 0.625 | 0.75 | 0.875 | 1 | 1.125 |
|---|---|---|---|---|---|---|---|---|---|---|
| h(t) (cm) | 30.0 | 35.0 | 47.0 | 59.0 | 64.0 | 59.0 | 47.0 | 35.0 | 30.0 | 35.0 |

(a) State the period. (b) Find h(4.625). (c) Describe how the pedal height changes on [0, 0.25] and what that says about concavity.

(a) The height is 30.0 at t = 0 and first returns to 30.0, at the same stage (the lowest point), at t = 1. The period is 1 second.

(b) 4.625 = 0.625 + 4 · 1, so h(4.625) = h(0.625) = 59.0 cm.

(c) The average rate of change over [0, 0.125] is (35.0 − 30.0)/0.125 = 40 cm/s, and over [0.125, 0.25] it is (47.0 − 35.0)/0.125 = 96 cm/s. The height increases, and the rate of increase grows, so the graph is concave up on that stretch. The same holds on [1, 1.25], [2, 2.25], and every other shift by a whole number of seconds.

**Worked example.** A function g has period 6, and g(2) = 5. Find g(20) and g(−4).

20 = 2 + 3 · 6, so g(20) = g(2) = 5. −4 = 2 − 6, so g(−4) = g(2) = 5. Periodicity works in both directions.

**Try it.**
1. For the pedal table, find h(7.25) and the average rate of change of h over [0.5, 1.5].
2. A periodic function has consecutive maximum points at x = 3 and x = 11. What is the period, and where is the next maximum after x = 11?
3. A function has period 4 and is decreasing on [1, 3]. Name another interval on which it must be decreasing.

*Answers:* 1. h(7.25) = h(0.25) = 47.0 cm; the interval [0.5, 1.5] is one full period, so the average rate of change is (64.0 − 64.0)/1 = 0 cm/s. 2. Period 8; next maximum at x = 19. 3. [5, 7] (or [−3, −1], [9, 11], …).

## Angles in standard position and radian measure (3.2)

Place an angle's vertex at the origin with its **initial ray** on the positive x-axis. Rotate counterclockwise for a positive angle or clockwise for a negative angle; the ray where you stop is the **terminal ray**. The quadrants are numbered counterclockwise from the upper right, I to IV.

Degrees split one full turn into 360 parts, a historical choice. **Radians** measure an angle by the circle itself: draw a circle of any radius r centred at the vertex; if the angle cuts off an arc of length s, then the angle is θ = s/r radians. Because the circumference is 2πr, a full turn is 2πr/r = 2π radians. So

- 2π radians = 360°, π radians = 180°;
- to convert degrees to radians multiply by π/180; to convert radians to degrees multiply by 180/π.

Common angles are worth knowing on sight: 30° = π/6, 45° = π/4, 60° = π/3, 90° = π/2, 180° = π, 270° = 3π/2. One radian is about 57.3°, a bit less than 60°.

Radians are the default from now on. When an angle is written with no degree sign, it is in radians.

**Arc length.** Rearranging θ = s/r gives **s = rθ**, valid only when θ is in radians. The same angle on a bigger circle cuts off a proportionally longer arc.

**Coterminal angles.** Adding or subtracting a full turn lands on the same terminal ray, so θ, θ + 2π, θ − 2π, θ + 4π, … are all coterminal.

**Worked example.** Convert 150° to radians and 7π/4 to degrees. Then find a positive angle less than 2π that is coterminal with −2π/3.

150 · π/180 = 5π/6. (7π/4) · (180/π) = 315°. −2π/3 + 2π = 4π/3.

**Worked example.** A circular garden path has radius 12 m. A walker covers the arc subtended by a central angle of 5π/6. How far does the walker go?

s = rθ = 12 · 5π/6 = 10π ≈ 31.4 m.

**Worked example.** A wheel of radius 0.35 m rolls without slipping until a point on its rim has travelled 2.8 m along the ground. Through what angle has the wheel turned?

θ = s/r = 2.8/0.35 = 8 radians, which is 8/(2π) ≈ 1.27 turns.

**Try it.**
1. Convert 225° to radians and 5π/12 to degrees.
2. In which quadrant does the terminal ray of 11π/6 lie? Of −3π/4?
3. An arc of length 9 cm lies on a circle of radius 4 cm. Find the central angle in radians.

*Answers:* 1. 5π/4; 75°. 2. Quadrant IV; quadrant III. 3. 9/4 = 2.25 radians.

## Sine, cosine and tangent of any angle (3.2)

Pick any point P(x, y), other than the origin, on the terminal ray of θ, and let r = √(x² + y²) be its distance from the origin. Then

- **sin θ = y/r**, the vertical coordinate as a fraction of the distance;
- **cos θ = x/r**, the horizontal coordinate as a fraction of the distance;
- **tan θ = y/x**, the slope of the terminal ray (undefined when x = 0, when the ray is vertical).

Why is it fine to pick *any* point on the ray? Points further out form similar right triangles with the x-axis, so the ratios do not change. Doubling the point (x, y) to (2x, 2y) doubles r too.

On a circle of radius r centred at the origin, the point on the terminal ray is therefore (r cos θ, r sin θ). On the **unit circle**, where r = 1, the point is simply (cos θ, sin θ): cosine is the x-coordinate and sine is the y-coordinate. Next week is all about those coordinates.

The signs come straight from the coordinates. In quadrant II, x < 0 and y > 0, so sine is positive, cosine is negative and tangent (a positive over a negative) is negative. Since r is always positive, sin θ and cos θ always lie between −1 and 1.

Notice also that tan θ = y/x = (y/r)/(x/r) = sin θ/cos θ, and that sin²θ + cos²θ = (y² + x²)/r² = 1. Both facts return in week 19.

**Worked example.** The terminal ray of θ passes through (−3, 4). Find sin θ, cos θ and tan θ.

r = √(9 + 16) = 5. sin θ = 4/5, cos θ = −3/5, tan θ = 4/(−3) = −4/3. The angle is in quadrant II, and the signs agree.

**Worked example.** The terminal ray of θ passes through (5, −12). Find the three values, and the coordinates of the point where the ray meets the circle of radius 26 centred at the origin.

r = 13. sin θ = −12/13, cos θ = 5/13, tan θ = −12/5. On the circle of radius 26: (26 cos θ, 26 sin θ) = (10, −24), which is just (5, −12) doubled.

**Right-triangle connection.** If θ is acute, drop a perpendicular from P to the x-axis. You get a right triangle with hypotenuse r, the side opposite θ of length y and the side adjacent to θ of length x. So the circle definitions agree with the familiar ratios: sin θ = opposite/hypotenuse, cos θ = adjacent/hypotenuse, tan θ = opposite/adjacent. The circle definitions extend those ratios to angles that are not acute, including negative angles and angles past a full turn.

**Worked example.** A ramp rises 0.6 m over a horizontal run of 3.2 m. Find the length of the ramp and the sine, cosine and tangent of the angle θ it makes with the ground.

The ramp's length is √(0.6² + 3.2²) = √10.6 ≈ 3.256 m. tan θ = 0.6/3.2 = 0.1875 (the ramp's slope), sin θ ≈ 0.6/3.256 ≈ 0.184, cos θ ≈ 3.2/3.256 ≈ 0.983.

**Why sine and cosine are periodic.** Adding 2π to θ brings the terminal ray back to the same place, so the point (cos θ, sin θ) is the same: sin(θ + 2π) = sin θ and cos(θ + 2π) = cos θ. As θ runs through one turn, the point travels once round the unit circle, its height rising and falling between −1 and 1. That is exactly the kind of behaviour section 3.1 described, and week 20 turns it into graphs.

**Try it.**
1. The terminal ray of θ passes through (−8, −15). Find sin θ, cos θ and tan θ.
2. The terminal ray of an angle lies along the line y = 2x in quadrant I. Find tan θ and cos θ.
3. A point on a circle of radius 10 centred at the origin is at angle θ, where cos θ = 0.6 and sin θ < 0. Find the point.

*Answers:* 1. r = 17: sin θ = −15/17, cos θ = −8/17, tan θ = 15/8. 2. Use (1, 2): tan θ = 2, r = √5, cos θ = 1/√5 = √5/5. 3. sin θ = −0.8, so the point is (6, −8).

## Calculator notes

Every graphing calculator has a degree mode and a radian mode, and the two give very different answers: sin(30) is 0.5 in degree mode but about −0.988 in radian mode. In this course radian mode is the default. When an AP question is calculator-active and gives an angle with no degree sign, it is in radians. Many items this week need no calculator at all, because the coordinates are given or the ratios come from a 3-4-5 or 5-12-13 triangle.

## Common mistakes

- **Using s = rθ with θ in degrees.** Convert to radians first: an angle of 60° on a circle of radius 6 cuts off 6 · π/3 = 2π, not 360.
- **Reading the period as the distance between two equal outputs.** Two crossings of the middle level are only half a period apart; use two consecutive peaks.
- **Forgetting r.** sin θ is y/r, not y, unless the point is on the unit circle.
- **Swapping sine and cosine.** Cosine goes with x (horizontal), sine with y (vertical). "Co" comes first in the alphabet as x comes first in (x, y).
- **Sign slips by quadrant.** Work out the signs of x and y first, then read off the signs of the ratios.
- **Treating tangent as defined everywhere.** tan(π/2) is undefined: the terminal ray is vertical and has no slope.

## Where this goes next

Week 19 fixes the radius at 1 and computes exact sine and cosine values for the special angles (multiples of π/6 and π/4) using reference angles and the signs by quadrant. Week 20 unwraps the unit circle into the graphs of y = sin θ and y = cos θ, whose period is the 2π you saw here, and weeks 21 and 22 transform those graphs to fit periodic data and study the tangent function.

## Self-check

1. A table shows a quantity at hours 0, 1, 2, … with values 4, 9, 7, 2, 4, 9, 7, 2, 4. State the period and predict the value at hour 41.
2. Convert 330° to radians and 13π/9 to degrees, and give a negative angle coterminal with 5π/6.
3. A circle has radius 15 cm. Find the arc length for a central angle of 2π/5, and the angle for an arc of 21 cm.
4. The terminal ray of θ passes through (7, −24). State sin θ, cos θ, tan θ and the quadrant.
5. Explain, using the definition sin θ = y/r, why sin(θ + 2π) = sin θ for every θ.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 3, Topics 3.1–3.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
