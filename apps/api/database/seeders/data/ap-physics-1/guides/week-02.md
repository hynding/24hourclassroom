# Week 02 · Representing Motion: Graphs, Kinematic Equations and Free Fall

**Topics:** 1.3 Representing Motion
**Practices:** 1 (Creating Representations: position–time, velocity–time and acceleration–time graphs, motion diagrams, tables), 2 (Mathematical Routines: slopes and areas of graphs, the constant-acceleration equations), 3 (Scientific Questioning and Argumentation: checking that a graph, an equation and a description tell the same story)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 1, Topic 1.3, learning objectives in our own words
**Spiral:** Week 1 defined displacement, velocity and acceleration as ratios (Δx/Δt, Δv/Δt) and used signs for direction. This week turns those ratios into the slopes of graphs, turns displacement into an area, and packages constant-acceleration motion into four equations, including objects in free fall.

## What you need to be able to do

- **1.3** Read velocity from the slope of a position–time graph, and tell constant velocity from speeding up or slowing down by whether the graph is straight or curved.
- **1.3** Read acceleration from the slope of a velocity–time graph and displacement from the area between the graph and the time axis (area below the axis counts as negative).
- **1.3** Read the change in velocity from the area under an acceleration–time graph.
- **1.3** Sketch (or describe) any one of the three graphs from another, or from a description of the motion.
- **1.3** Choose and use the constant-acceleration equations, including free fall with a = −9.8 m/s² (up positive).
- **1.3** Predict how a result changes when a quantity is scaled (functional dependence), and check expressions against limiting cases.

## Key terms

| Term | Meaning |
|---|---|
| Position–time (x–t) graph | Position on the vertical axis; its slope at a point is the instantaneous velocity. |
| Velocity–time (v–t) graph | Its slope is the acceleration; the area between it and the time axis is the displacement. |
| Acceleration–time (a–t) graph | The area under it is the change in velocity. |
| Tangent slope | The slope of a straight line touching a curved graph at one point: the instantaneous rate there. |
| Uniformly accelerated motion | Motion with constant acceleration; its v–t graph is a straight line. |
| Free fall | Motion under gravity alone (air resistance negligible); a = 9.8 m/s² downward for every object. |
| Motion diagram | Dots showing an object's position at equal time intervals; growing spacing means speeding up. |

## Equations

For motion along a line with **constant** acceleration a (m/s²), starting at position x₀ (m) with velocity v₀ (m/s) at t = 0; v (m/s) is the velocity at time t (s), and x (m) is the position then:

- v = v₀ + at (no Δx)
- x = x₀ + v₀t + ½at² (no v)
- v² = v₀² + 2a(x − x₀) (no t)
- x − x₀ = ½(v₀ + v)t (no a)

For free fall, use y for the vertical position and a = −g = −9.8 m/s² with up as positive. **Pick the equation that leaves out the quantity you neither know nor want.** These equations only hold while the acceleration is constant; for a trip with several stages, treat each stage separately.

## Graphs of motion (1.3)

The three graphs are linked by two operations you already know from week 1:

| From | Slope gives | Area gives |
|---|---|---|
| x–t graph | velocity | (not used) |
| v–t graph | acceleration | displacement |
| a–t graph | (not used) | change in velocity |

**Reading an x–t graph.** A straight line means constant velocity, its slope the velocity (a downward slope is a negative velocity). A curve means the velocity is changing: if the curve gets steeper, the object is speeding up; if it flattens, it is slowing down. A horizontal tangent (a peak or valley) is an instant of zero velocity, a turnaround.

**Reading a v–t graph.** Where the graph crosses the time axis the object turns around. Height above the axis is motion in the positive direction; below, the negative direction. Moving away from the axis means speeding up, toward the axis means slowing down. The **area** between the graph and the axis is displacement, positive above and negative below; add the areas with their signs for the net displacement, or their sizes for the distance.

**Worked example 1: a car between two stop signs (v–t to everything else).** A car's velocity is recorded as it drives along a straight street:

| t (s) | 0 | 4 | 10 | 13 |
|---|---|---|---|---|
| v (m/s) | 0 | 12 | 12 | 0 |

The graph is three straight segments: up from 0 to 12 m/s over 0–4 s, flat at 12 m/s from 4 to 10 s, and down to 0 from 10 to 13 s.

| Stage | Slope (acceleration) | Area (displacement) |
|---|---|---|
| 0–4 s | 12/4 = +3.0 m/s² | ½ × 4 × 12 = 24 m |
| 4–10 s | 0 | 6 × 12 = 72 m |
| 10–13 s | −12/3 = −4.0 m/s² | ½ × 3 × 12 = 18 m |

Total displacement 24 + 72 + 18 = **114 m**, and average velocity 114/13 ≈ **8.8 m/s**. The matching a–t graph is three flat steps: +3.0, 0 and −4.0 m/s². As a check, the area under the a–t graph is 3.0 × 4 + 0 − 4.0 × 3 = 0, matching the car starting and ending at rest. The x–t graph curves upward (getting steeper) for 0–4 s, is a straight line of slope 12 m/s from 4–10 s, and flattens to horizontal by 13 s. Three representations, one motion: on the AP exam you earn points for showing they agree.

**Motion diagrams.** Dots at equal time intervals that get farther apart show speeding up; closer together, slowing down; evenly spaced, constant velocity. A velocity arrow on each dot and one acceleration arrow (the direction the velocity is changing) complete the diagram.

## The constant-acceleration equations (1.3)

Every equation above comes from the v–t graph of constant acceleration, a straight line from v₀ to v. Its slope is a, so v = v₀ + at. Its area is a trapezoid of width t and parallel sides v₀ and v, so Δx = ½(v₀ + v)t; substituting v gives the other two. You never need calculus for them.

**Worked example 2: stopping distance (functional dependence).** A cyclist moving at 15 m/s brakes with a constant deceleration of 6.0 m/s². How far does she travel while stopping, and how long does it take? Take the direction of motion as positive, so a = −6.0 m/s², v₀ = 15 m/s, v = 0.

- No time is given or needed for the distance, so use v² = v₀² + 2aΔx: 0 = 15² + 2(−6.0)Δx, Δx = 225/12 = **18.75 m ≈ 19 m**.
- Time: v = v₀ + at gives 0 = 15 − 6.0t, t = **2.5 s**. Check with Δx = ½(v₀ + v)t = ½(15)(2.5) = 18.75 m. ✓
- **Functional dependence:** in symbols Δx = v₀²/(2|a|). Doubling the speed to 30 m/s with the same brakes makes the stopping distance 2² = 4 times as long, 75 m, while the stopping time only doubles (5.0 s). This is why speed matters so much near schools.

## Free fall (1.3)

Near Earth's surface, with air resistance negligible, every object accelerates downward at g = 9.8 m/s², whatever its mass, and whether it is moving up, moving down or momentarily at rest at the top. With up as positive, a = −9.8 m/s² for the whole flight.

**Worked example 3: a stone dropped from a footbridge.** A stone is released from rest 20 m above a creek. Take down as positive here (so a = +9.8 m/s²; any consistent choice works).

- Time: 20 = ½(9.8)t², t = √(40/9.8) ≈ **2.0 s**.
- Speed at the water: v² = 2(9.8)(20), v ≈ **19.8 m/s**.
- **Limiting cases and scaling:** t = √(2h/g). A drop from four times the height (80 m) takes only twice as long (about 4.0 s). If g were smaller (on the Moon), t would be larger, as expected. If h = 0, t = 0. Mass does not appear, so a heavier stone lands at the same moment.

**Worked example 4: a ball tossed straight up (a table of the motion).** A student tosses a ball upward at 12 m/s from her hand and catches it at the same height. Up is positive, a = −9.8 m/s².

| t (s) | 0 | 0.5 | 1.0 | 1.22 | 1.5 | 2.0 | 2.45 |
|---|---|---|---|---|---|---|---|
| v (m/s) | +12.0 | +7.1 | +2.2 | 0 | −2.7 | −7.6 | −12.0 |

- Top of the flight: v = 0 at t = 12/9.8 ≈ 1.22 s, height v₀²/(2g) = 144/19.6 ≈ **7.3 m**.
- The v–t graph is a single straight line of slope −9.8 m/s², crossing the axis at the top. The ball comes back at the same speed it left with, after 2 × 1.22 ≈ 2.45 s.
- At the top the velocity is zero but the acceleration is still 9.8 m/s² downward: the slope of the v–t line does not change there.

## Common mistakes

- **Reading the height of an x–t graph as speed**, or the height of a v–t graph as position. Velocity on an x–t graph is the slope.
- **Forgetting that area below the time axis is negative displacement** on a v–t graph.
- **Using the equations when the acceleration changes.** Split the motion into constant-acceleration stages.
- **Dropping the ½** in ½at², or squaring t in v = v₀ + at.
- **"The acceleration is zero at the top."** It is 9.8 m/s² downward throughout the flight.
- **"Heavier objects fall faster."** Without air resistance, all objects have the same acceleration.
- **Mixing sign conventions**: if up is positive, g enters as −9.8 m/s².

## Self-check

1. A v–t graph is a straight line from 4.0 m/s at t = 0 to 10.0 m/s at t = 3.0 s. Find the acceleration and the displacement.
2. An x–t graph is a curve that gets flatter and flatter until it is horizontal. Describe the motion.
3. A cart starts from rest and accelerates at 2.5 m/s² for 4.0 s. How far does it go?
4. A pebble is dropped down a well and hits the water 1.5 s later. How deep is the water surface below the release point?
5. If a car's speed is tripled, by what factor does its braking distance change (same braking acceleration)?
6. A ball is thrown straight up at 9.8 m/s. How long until it is at its highest point?

*Answers:* 1. a = 6.0/3.0 = 2.0 m/s²; Δx = ½(4.0 + 10.0)(3.0) = 21 m. 2. The object is slowing down and comes to rest (the velocity, the slope, decreases to zero). 3. Δx = ½(2.5)(4.0)² = 20 m. 4. ½(9.8)(1.5)² ≈ 11 m. 5. Nine times as long. 6. 1.0 s.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 1, Topic 1.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
