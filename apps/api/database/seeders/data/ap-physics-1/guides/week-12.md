# Week 12 · Translational Kinetic Energy and Work

**Topics:** 3.1 Translational Kinetic Energy · 3.2 Work
**Practices:** 1 (Creating Representations: free-body diagrams that show which forces do work, force–position graphs), 2 (Mathematical Routines: K = ½mv², W = Fd cos θ, the work–energy theorem), 3 (Scientific Questioning and Argumentation: predicting how kinetic energy and stopping distance depend on speed and mass)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 3, Topics 3.1–3.2, learning objectives in our own words
**Spiral:** Unit 1 gave you displacement, velocity and v² = v₀² + 2aΔx; Unit 2 gave you forces, free-body diagrams, friction (week 9) and spring forces (week 10). This week asks a new question about the same forces: not "how hard and for how long?" but "over what distance?" The answer is energy, the idea that runs through the rest of the course.

## What you need to be able to do

- **3.1** Calculate the translational kinetic energy of an object, K = ½mv², and explain why it is a scalar that is never negative.
- **3.1** Predict how K changes when mass or speed changes (doubling the speed quadruples K).
- **3.1** Recognise that kinetic energy depends on the reference frame, because speed does.
- **3.2** Calculate the work done on an object by a constant force, W = Fd cos θ, using only the force component parallel to the displacement.
- **3.2** Decide from a free-body diagram whether each force does positive, negative or zero work.
- **3.2** Find work as the area under a force–position graph, including forces that change with position.
- **3.2** Apply the work–energy theorem, W_net = ΔK, to find a speed, a force or a distance.

## Key terms

| Term | Meaning |
|---|---|
| Translational kinetic energy | Energy an object has because its centre of mass is moving: K = ½mv². |
| Work | Energy transferred into or out of a system by a force acting over a displacement. |
| Parallel component | The part of the force along the displacement, F cos θ; only this part does work. |
| Positive work | Force component points along the displacement; energy goes into the object. |
| Negative work | Force component points against the displacement; energy leaves the object. |
| Net work | The sum of the work done by every force, equal to the work done by the net force. |
| Work–energy theorem | The net work done on an object equals its change in kinetic energy. |
| Joule (J) | The SI unit of energy and work: 1 J = 1 N·m = 1 kg·m²/s². |

## Equations

| Relation | Symbols and SI units |
|---|---|
| K = ½mv² | K kinetic energy (J), m mass (kg), v speed (m/s) |
| W = F d cos θ | W work (J), F magnitude of a constant force (N), d magnitude of the displacement (m), θ angle between the force and the displacement |
| W = F_∥ d | F_∥ force component parallel to the displacement (N), positive along it and negative against it |
| W_net = ΔK = K_f − K_i | W_net total work by all forces (J), K_f and K_i final and initial kinetic energy (J) |
| W = area under F_∥ versus x | the area between the graph and the x-axis, counted negative below the axis |

## Translational kinetic energy (3.1)

Kinetic energy is the energy of motion. For an object whose parts all move together (translation, no spin), K = ½mv². Three consequences matter on the exam.

**It is a scalar and never negative.** Velocity has a direction; v² does not. A cart moving east at 3 m/s and one moving west at 3 m/s have the same kinetic energy. You never add kinetic energies as vectors, and a ball's K does not change sign when it turns around.

**It depends on speed squared.** Doubling the mass doubles K; doubling the speed multiplies K by four; tripling the speed multiplies it by nine. Write the ratio: K₂/K₁ = (m₂/m₁)(v₂/v₁)².

**It depends on the reference frame.** A passenger sitting in a moving train has zero kinetic energy in the train's frame and a large one in the ground's frame. Both are correct; pick one frame and stay in it for the whole problem.

**Worked example 1: a skateboarder and functional dependence.** A 55 kg skateboarder (board included) rolls at 4.0 m/s.

K = ½(55 kg)(4.0 m/s)² = ½ · 55 · 16 = 440 J.

If she speeds up to 8.0 m/s, K = 440 J × 2² = 1,760 J. If instead a friend of mass 110 kg rolls at 4.0 m/s, K = 880 J. Speed matters more than mass: the table shows the pattern.

| Mass (kg) | Speed (m/s) | K (J) | K relative to the first row |
|---|---|---|---|
| 55 | 4.0 | 440 | 1 |
| 110 | 4.0 | 880 | 2 |
| 55 | 8.0 | 1,760 | 4 |
| 55 | 2.0 | 110 | ¼ |

## Work (3.2)

A force does work on an object when the object moves while the force acts, and the force has a component along the motion. For a constant force,

W = F d cos θ,

where θ is the angle between the force and the displacement. Think of it as (parallel component of force) × (distance moved).

| Angle θ | cos θ | Work | Example |
|---|---|---|---|
| 0° | 1 | +Fd, the most possible | pushing a cart forward along its motion |
| between 0° and 90° | positive | positive, less than Fd | pulling a wagon by an angled handle |
| 90° | 0 | zero | normal force on a cart rolling on level ground |
| between 90° and 180° | negative | negative | air resistance on a ball rising at an angle |
| 180° | −1 | −Fd | kinetic friction on a sliding box |

Work is a scalar. Positive work transfers energy into the object; negative work transfers it out. A force that is perpendicular to the motion at every instant, like the tension in a string whirling a ball in a horizontal circle, does no work, which is why the ball's speed stays constant in uniform circular motion (week 11).

**Holding is not working.** A student holding a 10 kg box still for a minute feels tired, but the box does not move, so the student's force does no work on the box. Her muscles use chemical energy internally; none of it goes into the box.

**Worked example 2: an angled pull.** A child pulls a wagon 12 m along a level path with a constant 30 N force on the handle, directed 35° above the horizontal.

- **Free-body diagram (in words):** a downward arrow labelled F_g, an upward arrow labelled F_N, an arrow up and to the right at 35° labelled F_T, and a small arrow to the left labelled F_f (rolling resistance). The displacement is to the right.
- **Work by the pull:** W_T = (30 N)(12 m) cos 35° = 360 × 0.819 ≈ 295 J.
- **Work by F_g and F_N:** both are vertical and the displacement is horizontal, so θ = 90° and each does zero work.

A common slip is to use sin 35° (giving about 206 J). Check: the horizontal component is the one along the motion, and the horizontal component of a force at angle θ to the horizontal uses cos θ.

### Work from a force–position graph

When a force changes as the object moves, W = Fd cos θ no longer works directly. Instead, plot the parallel force against position: **the work is the area under the graph.** Areas above the axis are positive work, areas below are negative. This is the same geometry you used for displacement as the area under a velocity–time graph in week 2.

**Worked example 3: a push that ramps up.** A student pushes a 2.0 kg cart, initially at rest on a level, low-friction track. Her horizontal push grows steadily from 0 N to 8.0 N over the first 0.50 m, then stays at 8.0 N for the next 1.0 m.

| Position (m) | 0 | 0.25 | 0.50 | 1.00 | 1.50 |
|---|---|---|---|---|---|
| Push (N) | 0 | 4.0 | 8.0 | 8.0 | 8.0 |

- Triangle from 0 to 0.50 m: ½(0.50 m)(8.0 N) = 2.0 J.
- Rectangle from 0.50 m to 1.50 m: (1.0 m)(8.0 N) = 8.0 J.
- Total work: 10.0 J, all of it positive.

By the work–energy theorem (below), K_f = 10.0 J, so v = √(2K/m) = √(2 · 10.0/2.0) ≈ 3.2 m/s.

### Net work and the work–energy theorem

Add the work done by every force (or multiply the net force by the displacement, which gives the same number). The total is the change in the object's kinetic energy:

W_net = ΔK = ½mv_f² − ½mv_i².

This is Newton's second law and the kinematics equation v² = v₀² + 2aΔx folded together: multiply F_net = ma by Δx and you get F_net Δx = ½mv² − ½mv₀². The theorem is often faster than kinematics, because it never asks for the time.

**Worked example 4: dragging a box with friction.** A student drags a 20 kg box 5.0 m across a level floor with an 80 N horizontal rope. The coefficient of kinetic friction is 0.25. The box starts at rest.

- **Free-body diagram (in words):** F_g down (196 N), F_N up (196 N, since nothing else is vertical), F_T to the right (80 N), F_f to the left (μ_k F_N = 0.25 × 196 = 49 N).
- **Work by each force:** W_T = (80 N)(5.0 m) = +400 J; W_f = −(49 N)(5.0 m) = −245 J; W_g = W_N = 0.
- **Net work:** 400 − 245 = 155 J = ΔK.
- **Final speed:** v = √(2 · 155/20) ≈ 3.9 m/s.

Check with Newton's second law: a = (80 − 49)/20 = 1.55 m/s², and v² = 2(1.55)(5.0) = 15.5, so v ≈ 3.9 m/s. The two routes agree.

**Worked example 5: stopping distance and a limiting case.** A 1,200 kg car moving at 15 m/s brakes to a stop in 25 m on a level road. What is the average braking force, and how far would it take to stop from 30 m/s with the same force?

- W_net = ΔK: −F(25 m) = 0 − ½(1,200 kg)(15 m/s)² = −135,000 J, so F = 5,400 N.
- **Symbolic form:** F d = ½mv², so d = mv²/(2F). Stopping distance grows with the square of the speed. At 30 m/s, d = 25 m × 2² = 100 m.
- **Limiting cases:** if v = 0 the car needs no distance (d = 0, sensible); if the braking force were huge, d would approach zero (also sensible). A heavier car with the same braking force needs more distance, in proportion to m.

That speed-squared rule is why a modest increase in driving speed makes a large difference to stopping distance.

## Common mistakes

- **Using the whole force instead of its parallel component**, or using sin θ where cos θ belongs. Find θ between the force and the displacement, then decide.
- **Thinking every force does work.** Forces perpendicular to the displacement (often F_N and F_g on a level surface) do zero work.
- **Treating work or kinetic energy as vectors.** Both are scalars; signs on work mean "in" or "out", not a direction.
- **Doubling K when the speed doubles.** K grows with v², so it quadruples.
- **Saying a person holding something still does work on it.** No displacement, no work on that object.
- **Forgetting that friction does negative work on a sliding object**, or putting the friction force as mg instead of μ_k F_N.
- **Mixing frames:** measuring one speed relative to a moving train and another relative to the ground in the same work–energy equation.

## Self-check

1. A 0.40 kg soccer ball moves at 15 m/s. What is its kinetic energy?
2. A cart's mass is halved and its speed doubled. By what factor does K change?
3. A suitcase is pulled 20 m by a strap at 40° above the horizontal with a 45 N force. How much work does the strap do?
4. A satellite moves in a circular orbit at constant speed. How much work does gravity do on it during one revolution? Why?
5. A force–position table reads 6 N from x = 0 to 2 m, then −3 N from 2 m to 4 m. What is the net work?
6. A 1.5 kg book slides to rest across a table after being given 2.0 m/s. How much work did friction do?

*Answers:* 1. ½(0.40)(15)² = 45 J. 2. ½ × 2² = 2, so K doubles. 3. (45)(20) cos 40° ≈ 689 J (about 690 J). 4. Zero: gravity points toward the centre, perpendicular to the velocity at every instant, so the speed and K never change. 5. 12 J − 6 J = 6 J. 6. W_f = ΔK = 0 − ½(1.5)(2.0)² = −3.0 J.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 3, Topics 3.1–3.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
