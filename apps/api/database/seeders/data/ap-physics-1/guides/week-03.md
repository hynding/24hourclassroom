# Week 03 · Reference Frames and Relative Motion

**Topics:** 1.4 Reference Frames and Relative Motion
**Practices:** 1 (Creating Representations: velocity-addition diagrams and tables of velocities in two frames), 2 (Mathematical Routines: adding and subtracting relative velocities, right-triangle combinations), 3 (Scientific Questioning and Argumentation: explaining why two observers disagree about velocity but agree about acceleration)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 1, Topic 1.4, learning objectives in our own words
**Spiral:** Week 1 measured position, displacement and velocity from an origin "at rest"; week 2 represented motion with graphs and the constant-acceleration equations. This week asks: at rest relative to what? Every measurement of position and velocity is made in a reference frame, and changing frames changes velocities in a simple, predictable way.

## What you need to be able to do

- **1.4** Explain that position, displacement and velocity are measured relative to a chosen reference frame, and that different frames can give different values.
- **1.4** Combine velocities with v_AC = v_AB + v_BC in one dimension, keeping signs for direction.
- **1.4** Find the velocity of one moving object as seen from another (relative velocity), and use it to find catch-up and meeting times.
- **1.4** Combine perpendicular relative velocities (a boat in a current, a plane in a crosswind) with a right triangle: resultant speed and direction.
- **1.4** Explain why observers in frames moving at constant velocity relative to each other measure the same acceleration, and describe the same motion (a dropped ball on a train) in two frames.

## Key terms

| Term | Meaning |
|---|---|
| Reference frame | A coordinate system (origin, axes, positive directions) attached to an observer, used to measure positions and times. |
| Relative velocity v_AB | The velocity of object A as measured by an observer moving with B. |
| Ground frame | A frame attached to Earth's surface, the usual default. |
| Inertial frame | A frame that is not accelerating; any frame moving at constant velocity relative to another inertial frame is also inertial. |
| Heading | The direction an object points or steers relative to the medium (water, air). |
| Resultant (ground) velocity | The vector sum of the velocity relative to the medium and the medium's velocity relative to the ground. |

## Equations

- **Velocity addition (one or two dimensions):** v_AC = v_AB + v_BC, where v_AB is the velocity of A relative to B, v_BC is the velocity of B relative to C, and v_AC is the velocity of A relative to C (all in m/s, as vectors or signed components).
- **Reversing the order:** v_BA = −v_AB (same size, opposite direction).
- **Perpendicular velocities:** resultant speed v = √(v₁² + v₂²) and angle θ = tan⁻¹(v₂/v₁) measured from v₁ (v in m/s, θ in degrees).
- **Catch-up or meeting time** for objects separated by a gap d (m) and closing at relative speed v_rel (m/s): t = d/v_rel (s).

Read the subscripts like a chain: the inner letters "cancel". v(person, ground) = v(person, walkway) + v(walkway, ground).

## Velocity depends on the frame (1.4)

A passenger sitting on a bus moving at 15 m/s has velocity zero relative to the bus and 15 m/s relative to the road. Neither answer is "the real one". A velocity means nothing until you say who is measuring it. The AP exam expects you to name the frame whenever it is not obvious ("relative to the water", "as measured by the observer on the platform").

**Worked example 1: the airport walkway (one dimension).** A moving walkway 54 m long carries people at 1.2 m/s relative to the floor. A traveller walks on it at 1.5 m/s relative to the walkway, in the same direction. Take the walkway's motion as positive.

| Velocity | Value |
|---|---|
| Traveller relative to walkway | +1.5 m/s |
| Walkway relative to floor | +1.2 m/s |
| Traveller relative to floor | 1.5 + 1.2 = +2.7 m/s |

Time to reach the end: 54/2.7 = **20 s**. If a child walks the wrong way at 1.5 m/s relative to the walkway, her velocity relative to the floor is −1.5 + 1.2 = **−0.3 m/s**: she makes slow progress backward. **Check:** if she walks backward at exactly 1.2 m/s, she stays in place relative to the floor, as anyone who has tried it knows.

**Worked example 2: cars on a highway (relative velocity and catch-up time).** Take east as positive.

- Car A drives east at 25 m/s; car B drives west at 20 m/s toward it. The velocity of B relative to A is v_BA = v_B,ground − v_A,ground = −20 − 25 = **−45 m/s**: to A's driver, B approaches at 45 m/s.
- A car at 28 m/s is 30 m behind a truck at 22 m/s, both east. The car's velocity relative to the truck is 28 − 22 = **6 m/s**, so it closes the 30 m gap in 30/6 = **5.0 s**. In the truck's frame the problem is simple: a car 30 m back creeping forward at 6 m/s. Choosing a clever frame is a legitimate problem-solving move.

## Two dimensions: boats and planes (1.4)

When the medium moves sideways to your heading, add the velocities as vectors. For perpendicular velocities, the sum is the hypotenuse of a right triangle.

**Worked example 3: crossing a river (representation and functional dependence).** A river is 60 m wide and flows east at 3.0 m/s. A rowing boat moves at 4.0 m/s relative to the water and is pointed straight north, across the river.

| Velocity | East component | North component |
|---|---|---|
| Boat relative to water | 0 | 4.0 m/s |
| Water relative to ground | 3.0 m/s | 0 |
| Boat relative to ground | 3.0 m/s | 4.0 m/s |

- Ground speed: √(3.0² + 4.0²) = **5.0 m/s**, at tan⁻¹(3.0/4.0) ≈ **37° east of north** (downstream of straight across).
- Crossing time uses only the northward component: 60/4.0 = **15 s**.
- Downstream drift: 3.0 × 15 = **45 m** east of the point directly opposite.
- **Functional dependence:** the current is perpendicular to the crossing, so a faster current carries the boat farther downstream but does **not** change the crossing time. Doubling the current to 6.0 m/s doubles the drift to 90 m; the crossing still takes 15 s. A faster boat (8.0 m/s) halves both the time and the drift.

**Landing directly opposite.** To arrive straight across, the rower must aim partly upstream so that the upstream part of the boat's velocity cancels the current: 4.0 sin θ = 3.0, θ = sin⁻¹(0.75) ≈ 49° west of north. The remaining northward component is √(4.0² − 3.0²) = √7 ≈ 2.6 m/s, so the crossing now takes 60/2.65 ≈ 23 s, longer than before. **Limiting case:** if the current were 4.0 m/s or faster, no heading could cancel it, and the boat could not land directly opposite at all; the formula signals this because sin θ would have to be 1 or more.

The same picture fits an aircraft in a crosswind: its velocity relative to the air plus the wind's velocity relative to the ground gives its velocity relative to the ground.

## What every inertial frame agrees on (1.4)

Observers moving at **constant velocity** relative to each other disagree about velocities but agree about **accelerations** and about time intervals. If a ball's velocity changes by Δv in the ground frame, its velocity in the bus frame is shifted by the same constant amount at every instant, so the change Δv, and therefore a = Δv/Δt, is identical.

**Worked example 4: a ball dropped on a smoothly moving train.** A train moves along a straight, level track at a steady 10 m/s. A passenger holds a ball 1.2 m above the floor and lets go.

| Question | Train frame | Ground frame |
|---|---|---|
| Initial velocity of ball | 0 | 10 m/s forward |
| Acceleration | 9.8 m/s² down | 9.8 m/s² down |
| Time to reach the floor | √(2 × 1.2/9.8) ≈ 0.49 s | 0.49 s |
| Path | straight down | a curve (parabola), moving forward |
| Horizontal distance moved | 0 | 10 × 0.49 ≈ 4.9 m |
| Lands relative to the release point on the train | directly below | directly below (the floor also moved 4.9 m) |

Both observers predict the same landing spot on the floor and the same fall time, because they agree on the acceleration. They disagree only about the horizontal velocity and so about the shape of the path. This is the bridge to week 4: in the ground frame, the ball's motion is a horizontal constant velocity plus a vertical free fall, which is exactly projectile motion.

If the train were **speeding up**, its frame would be accelerating (not inertial), and the passenger would see the ball land behind the release point. In this course, reference-frame calculations use frames moving at constant velocity.

## Common mistakes

- **Adding speeds when the velocities point in opposite directions.** Use signs: an object moving against a current subtracts.
- **Getting the subscripts backward.** v_BA = −v_AB. Write the chain v_AC = v_AB + v_BC and check that the inner letters match.
- **Adding perpendicular speeds directly** (3.0 + 4.0 = 7.0). Perpendicular velocities combine as a right triangle: 5.0 m/s.
- **Thinking the current lengthens the crossing time** when the boat points straight across. Only the component across the river matters for the time.
- **Saying observers disagree about acceleration.** Frames at constant relative velocity measure the same acceleration.
- **Forgetting to name the frame** when stating a velocity.

## Self-check

1. A swimmer swims at 1.8 m/s relative to the water against a 0.6 m/s current in a straight canal. What is her speed relative to the bank?
2. Two cyclists ride toward each other at 6.0 m/s and 4.0 m/s, starting 200 m apart. How long until they meet?
3. A plane flies north at 80 m/s relative to the air, and the wind blows east at 20 m/s. What is the plane's ground speed?
4. In question 3, how far east of its intended path is the plane after 10 minutes?
5. A ball is thrown straight up by a passenger on a boat moving at constant velocity. Where does it land relative to the passenger, and what path does an observer on the shore see?
6. Car P moves east at 15 m/s and car Q east at 25 m/s. What is Q's velocity relative to P, and P's relative to Q?

*Answers:* 1. 1.8 − 0.6 = 1.2 m/s (upstream). 2. They close at 10 m/s, so 200/10 = 20 s. 3. √(80² + 20²) ≈ 82 m/s (about 14° east of north). 4. 20 m/s × 600 s = 12,000 m = 12 km. 5. Back in the passenger's hand; the shore observer sees an arch-shaped (parabolic) path moving with the boat. 6. Q relative to P: 10 m/s east; P relative to Q: 10 m/s west.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 1, Topic 1.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
