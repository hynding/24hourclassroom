# Week 01 · Scalars, Vectors, Displacement, Velocity and Acceleration

**Topics:** 1.1 Scalars and Vectors in One Dimension · 1.2 Displacement, Velocity, and Acceleration
**Practices:** 1 (Creating Representations: number lines, sign conventions, position and velocity tables), 2 (Mathematical Routines: average velocity and average acceleration from data), 3 (Scientific Questioning and Argumentation: deciding whether an object speeds up or slows down, and defending the choice)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 1, Topics 1.1–1.2, learning objectives in our own words
**Spiral:** This is the first week of the course. It leans on algebra (solving a linear equation, ratios, signed numbers) and on units. Everything in Unit 1, and most of the course, is built from the three quantities defined here.

## What you need to be able to do

- **1.1** Sort quantities into scalars (size only) and vectors (size and direction), and say which is which for distance, displacement, speed, velocity, acceleration and time.
- **1.1** Pick a coordinate axis and a positive direction, and describe a one-dimensional vector by a signed number.
- **1.2** Find displacement from initial and final positions, and tell it apart from distance travelled.
- **1.2** Compute average velocity and average speed for a trip, and explain why they can differ.
- **1.2** Compute average acceleration from a change in velocity, and use the signs of velocity and acceleration to decide whether an object is speeding up or slowing down.
- **1.2** Read a table of positions or velocities and extract velocities and accelerations from it.

## Key terms

| Term | Meaning |
|---|---|
| Scalar | A quantity with a size (and unit) only: distance, speed, time, mass. |
| Vector | A quantity with a size and a direction: displacement, velocity, acceleration. |
| Position x | Where an object is, measured from an origin along a chosen axis. |
| Displacement Δx | Change in position, x_f − x_i. Depends only on start and end. |
| Distance | Total length of path travelled. Never negative, never less than \|Δx\|. |
| Average velocity | Displacement divided by the time interval. |
| Average speed | Distance divided by the time interval. |
| Instantaneous velocity | The velocity at one instant; what a speedometer plus a direction would show. |
| Average acceleration | Change in velocity divided by the time interval. |
| Magnitude | The size of a vector, always zero or positive. |

## Equations

- **Displacement:** Δx = x_f − x_i, where x_i and x_f are the initial and final positions (m).
- **Average velocity:** v_avg = Δx/Δt, where Δt = t_f − t_i is the time interval (s); v_avg in m/s.
- **Average speed:** (distance travelled)/Δt, in m/s.
- **Average acceleration:** a_avg = Δv/Δt = (v_f − v_i)/Δt, where v_i and v_f are the initial and final velocities (m/s); a_avg in m/s².
- **Unit conversion you will need often:** 1 m/s = 3.6 km/h, so divide a speed in km/h by 3.6 to get m/s.

## Scalars and vectors in one dimension (1.1)

A **scalar** is fully described by a number and a unit: "the trip took 40 s", "the cart has a mass of 0.50 kg". A **vector** also needs a direction: "the cart moved 2.0 m toward the wall". In one dimension there are only two directions, so we pick an axis, mark an origin, and call one way positive. After that, the sign of a vector component carries its direction.

- A velocity of −3.0 m/s means 3.0 m/s in the direction we chose as negative. It does **not** mean the object is slow, slowing down or going "less than zero fast".
- The **magnitude** of a vector is its size without the sign: the magnitude of −3.0 m/s is 3.0 m/s, which is the speed.
- The choice of positive direction is yours. It changes the signs in your answer, never the physics. State it ("east is positive") and keep it for the whole problem.

**Worked example 1: a walk down the hallway.** Take east as positive and put the origin at a classroom door. A student starts at the door, walks 12 m east to a water fountain, then turns and walks 5 m west to a locker. The whole walk takes 20 s.

| Quantity | Working | Result |
|---|---|---|
| Final position | 0 + 12 − 5 | x_f = +7 m |
| Displacement | Δx = 7 − 0 | +7 m (7 m east) |
| Distance | 12 + 5 | 17 m |
| Average velocity | +7 m / 20 s | +0.35 m/s (east) |
| Average speed | 17 m / 20 s | 0.85 m/s |

The distance counts every metre walked; the displacement only cares where the walk ended. Notice that the displacement is smaller than the distance because the student doubled back. **Check:** if the student had walked 12 m east without turning, distance and displacement would both be 12 m. The magnitude of displacement can equal the distance (straight line, no reversal) but can never exceed it.

## Displacement, velocity and acceleration (1.2)

**Velocity** describes how fast position changes and in which direction. Average velocity uses only the endpoints of an interval: v_avg = Δx/Δt. **Speed** is the magnitude of the instantaneous velocity; average speed is distance over time. Over a trip that doubles back, average speed is larger than the magnitude of average velocity, and over a trip that returns to its start, average velocity is zero however fast the object moved.

**Acceleration** describes how fast velocity changes: a_avg = Δv/Δt. Its unit, m/s², reads "metres per second, per second": an acceleration of 2 m/s² changes the velocity by 2 m/s every second. Acceleration is about change in velocity, not about velocity itself. An object can be moving quickly with zero acceleration (a car on cruise control) or be momentarily at rest with a large acceleration (a ball at the top of its flight).

**Speeding up or slowing down?** Compare the signs:

| Velocity | Acceleration | Motion |
|---|---|---|
| + | + | speeding up, moving in the positive direction |
| + | − | slowing down, moving in the positive direction |
| − | − | speeding up, moving in the negative direction |
| − | + | slowing down, moving in the negative direction |
| any | 0 | constant velocity |

Same signs: speeding up. Opposite signs: slowing down. A "negative acceleration" by itself tells you nothing about speeding up or slowing down until you know the direction of motion.

**Worked example 2: a cyclist braking in the negative direction.** Take north as positive. A cyclist rides south at 6.0 m/s and brakes steadily to 2.0 m/s in 2.5 s.

- v_i = −6.0 m/s, v_f = −2.0 m/s (south is negative).
- a_avg = (v_f − v_i)/Δt = (−2.0 − (−6.0))/2.5 = +4.0/2.5 = **+1.6 m/s²**, that is, 1.6 m/s² north.
- Velocity negative, acceleration positive: opposite signs, so the cyclist is slowing down, which matches the story.

The most common error here is to write a = −1.6 m/s² "because the bike slows down". Slowing down means the acceleration points opposite to the velocity; since the velocity is south, the acceleration is north.

**Worked example 3: extracting velocity and acceleration from a position table.** A lab group releases a cart on a gentle ramp and records its position every second with a motion sensor.

| t (s) | 0 | 1 | 2 | 3 | 4 |
|---|---|---|---|---|---|
| x (m) | 0.00 | 0.40 | 1.60 | 3.60 | 6.40 |

Average velocity over each one-second interval:

| Interval (s) | 0–1 | 1–2 | 2–3 | 3–4 |
|---|---|---|---|---|
| Δx (m) | 0.40 | 1.20 | 2.00 | 2.80 |
| v_avg (m/s) | 0.40 | 1.20 | 2.00 | 2.80 |

The average velocity grows by the same 0.80 m/s each second, so the cart's acceleration is constant at a = 0.80 m/s² ÷ 1 = **0.80 m/s²** in the positive direction. Over the whole run, v_avg = 6.40 m / 4 s = 1.60 m/s. Positions that grow by **equal** steps mean constant velocity; positions whose steps **grow** mean speeding up. This reading of tables becomes the slope reading of graphs in week 2.

**Worked example 4: a round trip with a faster return (functional dependence and a limiting case).** A student walks 60 m from the school door to a bus stop at 1.5 m/s, then jogs back at 3.0 m/s.

- Time out: 60/1.5 = 40 s. Time back: 60/3.0 = 20 s. Total: 60 s.
- Average speed = 120 m / 60 s = **2.0 m/s**, not the 2.25 m/s you would get by averaging 1.5 and 3.0. The student spends twice as long at the slower speed, so the average is pulled toward 1.5 m/s.
- Average velocity = 0 m / 60 s = **0 m/s**: the trip ends where it began.

In symbols, for a distance D out at v₁ and back at v₂: average speed = 2D/(D/v₁ + D/v₂) = 2v₁v₂/(v₁ + v₂). **Limiting-case check:** if v₁ = v₂ = v, this gives 2v²/2v = v, as it must. Notice that D cancels: doubling the length of the walk does not change the average speed. A good habit for every symbolic answer is to try a case you already know the answer to.

## Common mistakes

- **Using distance where displacement is asked**, or the reverse. Displacement uses only the endpoints and carries a sign.
- **Averaging two speeds** to get an average speed. Always use total distance over total time; the simple average only works when equal *times* are spent at each speed.
- **"Negative acceleration means slowing down."** Only if the velocity is positive. Compare signs.
- **Confusing velocity with acceleration**: a large velocity does not mean a large acceleration, and zero velocity does not mean zero acceleration.
- **Changing the positive direction halfway through** a problem, or not stating it at all.
- **Forgetting to convert km/h** to m/s before combining with seconds.

## Self-check

1. A dog runs 9 m west, then 4 m east, in 5.0 s. Taking east as positive, find its displacement, distance, average velocity and average speed.
2. A car's velocity changes from +18 m/s to +6 m/s in 3.0 s. Find its average acceleration. Is it speeding up or slowing down?
3. A swimmer completes two lengths of a 50 m pool, ending at the wall where she started, in 64 s. What are her average speed and average velocity?
4. A ball has a velocity of −4 m/s and an acceleration of −2 m/s². Is it speeding up or slowing down?
5. Convert 90 km/h to m/s.
6. A cart's positions every second are 2.0, 3.5, 5.0, 6.5 m. What is its acceleration?

*Answers:* 1. Δx = −5 m (5 m west); distance 13 m; v_avg = −1.0 m/s; average speed 2.6 m/s. 2. a = (6 − 18)/3.0 = −4.0 m/s²; velocity and acceleration have opposite signs, so it is slowing down. 3. Average speed = 100/64 ≈ 1.6 m/s; average velocity = 0. 4. Speeding up (same signs), moving in the negative direction. 5. 90/3.6 = 25 m/s. 6. Zero: the position grows by an equal 1.5 m each second, so the velocity is a constant 1.5 m/s.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 1, Topics 1.1–1.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
