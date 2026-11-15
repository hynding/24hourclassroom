# Week 19 · Rotational Kinematics and Connecting Linear and Rotational Motion

**Topics:** 5.1 Rotational Kinematics · 5.2 Connecting Linear and Rotational Motion
**Practices:** 1 (Creating Representations: angular-velocity graphs and tables, sign conventions), 2 (Mathematical Routines: the constant-angular-acceleration equations, converting between revolutions, radians and metres), 3 (Scientific Questioning and Argumentation: predicting how speed and acceleration change with distance from the axis)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 5, Topics 5.1–5.2, learning objectives in our own words
**Spiral:** Weeks 1–3 built the language of displacement, velocity and acceleration and read motion graphs; week 11 described uniform circular motion with a_c = v²/r. This week reuses every one of those tools for objects that spin. The equations are the ones you already know with new letters, and the bridge between the two worlds is a single factor of r.

## What you need to be able to do

- **5.1** Describe the angular displacement, angular velocity and angular acceleration of a rigid object rotating about a fixed axis, with a sign convention (counterclockwise positive).
- **5.1** Use the three constant-angular-acceleration equations to find an unknown angle, angular speed, angular acceleration or time.
- **5.1** Read and draw angle–time and angular-velocity–time graphs: slope of θ–t is ω, slope of ω–t is α, area under ω–t is Δθ.
- **5.1** Convert between revolutions, degrees and radians, and between rpm and rad/s.
- **5.2** Relate the arc length, tangential speed and tangential acceleration of a point to the angular quantities: s = rθ, v = rω, a_T = rα.
- **5.2** Explain why every point on a rigid object shares one ω and one α while points farther from the axis move faster and have larger centripetal acceleration (a_c = ω²r).

## Key terms

| Term | Meaning |
|---|---|
| Rigid object | An object whose parts keep fixed distances from one another, so the whole thing turns through the same angle. |
| Axis of rotation | The line every point circles around; in AP Physics 1 it is fixed in direction. |
| Angular position θ | The angle of a reference line on the object, measured from a chosen zero line, in radians. |
| Angular displacement Δθ | Change in angular position; counterclockwise positive, clockwise negative. |
| Radian | The angle whose arc length equals the radius; 1 rev = 2π rad = 360°. |
| Angular velocity ω | Rate of change of angular position, Δθ/Δt, in rad/s. Its sign gives the direction of spin. |
| Angular acceleration α | Rate of change of angular velocity, Δω/Δt, in rad/s². |
| Tangential speed v | Speed of one point along its circular path, v = rω. |
| Tangential acceleration a_T | Rate of change of a point's speed along its path, a_T = rα. |
| Centripetal acceleration a_c | Acceleration toward the axis that turns a point's velocity, a_c = v²/r = ω²r. |

## Equations

| Relation | Symbols and SI units |
|---|---|
| ω_avg = Δθ/Δt | θ angular position (rad), t time (s), ω angular velocity (rad/s) |
| α_avg = Δω/Δt | α angular acceleration (rad/s²) |
| ω = ω₀ + αt | ω₀ initial angular velocity (rad/s); constant α only |
| θ = θ₀ + ω₀t + ½αt² | θ₀ initial angular position (rad); constant α only |
| ω² = ω₀² + 2α(θ − θ₀) | the time-free equation; constant α only |
| s = rθ | s arc length (m), r distance from the axis (m), θ in radians |
| v = rω | v tangential speed (m/s) |
| a_T = rα | a_T tangential acceleration (m/s²) |
| a_c = v²/r = ω²r | a_c centripetal acceleration (m/s²), toward the axis |

The last four equations work only with angles in **radians**. A radian is a ratio of two lengths, so it has no physical dimension: rad·m becomes m, which is why rω comes out in m/s.

## Rotational kinematics (5.1)

**Describing a spin.** Paint a line from the centre of a spinning record to its edge. The angle that line makes with a fixed zero direction is the record's angular position θ. Because the record is rigid, every painted line turns through the same angle in the same time, so one θ, one ω and one α describe the whole object. That is the whole point of angular variables: a single number replaces a separate speed for every point.

**Sign convention.** Choose counterclockwise (as seen from a stated side) as positive. Then a wheel spinning clockwise has a negative ω. Angular acceleration follows the same rule as in one-dimensional kinematics: if α has the same sign as ω the object speeds up; if the signs are opposite it slows down. A clockwise wheel that is slowing has ω negative and α positive.

**The same equations with new letters.** Under constant α, the translational equations from week 2 carry over term by term: x → θ, v → ω, a → α. Use them exactly as before: list the knowns, pick the equation that leaves out the quantity you neither know nor want.

**Worked example 1: a ceiling fan spinning down.** A ceiling fan turns at 150 rpm when it is switched off. It slows at a constant rate and stops in 12 s. Find its angular acceleration and the number of revolutions it makes while stopping.

- Convert: ω₀ = 150 rev/min × 2π rad/rev ÷ 60 s/min = 15.7 rad/s. Final ω = 0, t = 12 s. Take the fan's spin direction as positive.
- α = (ω − ω₀)/t = (0 − 15.7)/12 = −1.31 rad/s². Negative: opposite to the spin, so the fan slows.
- Δθ = ½(ω₀ + ω)t = ½(15.7 + 0)(12) = 94.2 rad, which is 94.2/(2π) = 15.0 revolutions.
- Check with the time-free equation: ω₀² + 2αΔθ = 246.7 − 2(1.31)(94.2) ≈ 0. Consistent.

**Graphs of rotation.** The graph rules from week 2 carry over unchanged:

- the slope of a θ–t graph is ω (a curve that steepens means speeding up);
- the slope of an ω–t graph is α;
- the area between an ω–t graph and the time axis is Δθ (area below the axis counts as negative, clockwise).

**Worked example 2: a potter's wheel as an ω–t table.** A potter's wheel starts from rest, speeds up steadily for 4 s, turns steadily for 6 s, then slows steadily to rest in 3 s.

| Time (s) | 0 | 4 | 10 | 13 |
|---|---|---|---|---|
| ω (rad/s) | 0 | 6.0 | 6.0 | 0 |

- α in the first stage = 6.0/4 = 1.5 rad/s²; in the middle stage 0; in the last stage −6.0/3 = −2.0 rad/s².
- Δθ = area = ½(4)(6.0) + (6)(6.0) + ½(3)(6.0) = 12 + 36 + 9 = 57 rad, about 9.1 revolutions.
- The θ–t graph matching this table curves upward (steepening) from 0 to 4 s, is a straight line of slope 6.0 rad/s from 4 to 10 s, and curves over to a flat top from 10 to 13 s. It never slopes downward, because ω never becomes negative: the wheel slows but does not reverse.

## Connecting linear and rotational motion (5.2)

**One ω, many speeds.** A point at distance r from the axis travels an arc s = rθ while the object turns through θ radians. Dividing by time gives v = rω, and dividing a change in speed by time gives a_T = rα. So on a spinning rigid object:

- every point shares θ, ω and α;
- a point's arc length, tangential speed and tangential acceleration are proportional to its distance r from the axis;
- a point on the axis (r = 0) does not move at all.

**Two accelerations at once.** A point on a spinning object always has a centripetal acceleration a_c = ω²r toward the axis, because its velocity keeps changing direction (week 11). If the object is also speeding up or slowing down, the point has a tangential acceleration a_T = rα along its path as well. The two are perpendicular, so the size of the total acceleration is √(a_T² + a_c²). A wheel turning at constant ω has a_T = 0 but still has a_c.

**Worked example 3: a bike wheel on a repair stand.** A bike is flipped onto a repair stand and its rear wheel, radius 0.34 m, is cranked from rest to 20 rad/s in 2.5 s at a steady rate.

- α = 20/2.5 = 8.0 rad/s². Tangential acceleration of the valve on the rim: a_T = rα = 0.34 × 8.0 = 2.72 m/s².
- At 20 rad/s the valve's speed is v = rω = 0.34 × 20 = 6.8 m/s, and its centripetal acceleration is a_c = ω²r = 400 × 0.34 = 136 m/s², about 14 times g. That is why mud flies off a fast wheel: the tyre cannot hold on to it.
- A reflector clipped halfway along a spoke (r = 0.17 m) has the same ω but half the speed (3.4 m/s) and half the centripetal acceleration (68 m/s²).

**Worked example 4: functional dependence on a carousel.** Two riders sit on a carousel turning at a steady 0.80 rad/s, one at 1.5 m from the axis and one at 3.0 m.

| Rider | r (m) | ω (rad/s) | v = rω (m/s) | a_c = ω²r (m/s²) |
|---|---|---|---|---|
| Inner | 1.5 | 0.80 | 1.2 | 0.96 |
| Outer | 3.0 | 0.80 | 2.4 | 1.92 |

Doubling r doubles both v and a_c **at fixed ω**. Compare week 11, where a_c = v²/r seemed to say a bigger radius means a smaller acceleration. Both are right: a_c = v²/r holds speed fixed, while a_c = ω²r holds ω fixed. On a rigid carousel the riders share ω, not v, so the ω²r form is the one that predicts the outcome. If instead the carousel's ω doubled, every rider's a_c would quadruple, because a_c depends on ω².

**Limiting case check.** As r → 0, both v and a_c go to zero: a rider at the very centre just turns on the spot. As ω → 0 everything stops. Any expression you derive for a rotating point should pass both checks.

**Belts and chains.** When a belt or chain links two wheels without slipping, every link of the belt moves at one speed, so the rims of both wheels share a **tangential speed**, not an angular speed: r₁ω₁ = r₂ω₂. A small bike sprocket driven by a chain turns faster than the big one that drives it.

## Common mistakes

- **Using degrees or revolutions in s = rθ, v = rω or a_T = rα.** Convert to radians first.
- **Thinking an outer point has a larger angular velocity.** It has a larger speed; ω is the same for every point of a rigid object.
- **Forgetting centripetal acceleration** when ω is constant. Constant ω means a_T = 0, not zero acceleration.
- **Deciding "slowing down" from the sign of α alone.** Compare the signs of α and ω.
- **Applying the constant-α equations to a motion whose α changes**, such as the whole potter's wheel story. Split the motion into stages.
- **Giving gears on a shared axle the same tangential speed.** Wheels on one axle share ω; wheels joined by a belt or chain share rim speed.

## Self-check

1. A drill bit speeds up from rest to 300 rad/s in 0.50 s at a steady rate. What is α, and how many revolutions does it make?
2. A clock's second hand is 0.12 m long. What is the speed of its tip?
3. A merry-go-round turning clockwise (seen from above, counterclockwise positive) is slowing down. Give the signs of ω and α.
4. A point 0.20 m from the axis of a fan blade has speed 4.0 m/s. What is the speed of a point 0.30 m from the axis on the same blade?
5. If a turntable's angular speed triples, by what factor does the centripetal acceleration of a coin on it change?
6. An ω–t graph is a horizontal line at −3.0 rad/s from 0 to 5 s. What is the angular displacement?

*Answers:* 1. α = 600 rad/s²; Δθ = ½(300)(0.50) = 75 rad ≈ 11.9 rev. 2. ω = 2π/60 = 0.105 rad/s, so v = 0.12 × 0.105 ≈ 0.0126 m/s (1.26 cm/s). 3. ω negative, α positive. 4. ω = 4.0/0.20 = 20 rad/s, so v = 0.30 × 20 = 6.0 m/s. 5. It is multiplied by 9 (a_c = ω²r). 6. Δθ = −15 rad, that is 15 rad clockwise.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 5, Topics 5.1–5.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
