# Week 14 · Conservation of Energy

**Topics:** 3.4 Conservation of Energy
**Practices:** 1 (Creating Representations: energy bar charts at two or more states, choosing and drawing a system boundary), 2 (Mathematical Routines: writing and solving energy equations, linearising lab data), 3 (Scientific Questioning and Argumentation: justifying whether a system's mechanical energy is conserved, predicting functional dependence)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 3, Topic 3.4, learning objectives in our own words
**Spiral:** Week 12 gave you kinetic energy and the work–energy theorem; week 13 gave you potential energy of systems (mgΔy, ½kx², −Gm₁m₂/r). Friction (week 9) and circular motion (week 11) come back in this week's problems. This week puts the pieces together into one bookkeeping rule: energy is never created or destroyed, only transferred or transformed.

## What you need to be able to do

- **3.4** Define a system and classify it as closed (no energy crosses the boundary) or open (external work is done on it).
- **3.4** State when the mechanical energy (K + U) of a system stays constant, and when some of it becomes internal (thermal) energy.
- **3.4** Write and solve E_i + W_ext = E_f, with each energy term named for the chosen system.
- **3.4** Draw energy bar charts (as tables here) for two or more states and check them against the equation.
- **3.4** Calculate the energy converted by friction, ΔE_int = F_f d, and use it to find speeds or distances.
- **3.4** Predict functional dependence ("doubling the compression doubles the launch speed") and test it with limiting cases.
- **3.4** Linearise lab data: choose what to graph so that the result is a straight line, and interpret the slope.

## Key terms

| Term | Meaning |
|---|---|
| Closed (isolated) system | No external work is done on it and no energy crosses its boundary; its total energy is constant. |
| Open system | External forces do work on it, so its total energy changes by W_ext. |
| Mechanical energy | E_mech = K + U_g + U_s: the kinetic and potential energy of the system. |
| Internal (thermal) energy | Energy of the random motion of particles inside the objects; friction converts mechanical energy into it. |
| Conservation of energy | The total energy of a system changes only by the energy transferred across its boundary. |
| Energy bar chart | A chart of K, U_g, U_s, ΔE_int and W_ext at chosen states; the bars must balance. |
| Linearisation | Choosing quantities to plot so that a predicted relationship gives a straight line. |

## Equations

| Relation | Symbols and SI units |
|---|---|
| K_i + U_i + W_ext = K_f + U_f + ΔE_int | K kinetic energy, U potential energy (all kinds), W_ext work done by forces from outside the system, ΔE_int increase in internal energy; all in J |
| K_i + U_i = K_f + U_f | the special case of a closed system with no friction inside it (mechanical energy conserved) |
| ΔE_int = F_f d | F_f kinetic friction force (N), d sliding distance (m), when the surface and the object are both inside the system |
| v = √(2gh) | speed after a drop of height h (m) from rest, any frictionless path, g = 9.8 m/s² |

## The rule and the system (3.4)

**Energy is conserved: the total energy of a system changes only when energy crosses its boundary.** The work you do depends on what you put inside the boundary, so choose first and say it.

| System choice | Gravity | Friction with the floor | Your push |
|---|---|---|---|
| Object alone | external work | external work | external work |
| Object + Earth | internal, U_g | external work | external work |
| Object + Earth + floor | internal, U_g | internal, ΔE_int | external work |

For a ball rolling down a smooth track, the ball–Earth system is closed: no external force does work (the normal force is perpendicular to the motion), so K + U_g is constant. Add friction and the ball–Earth–track system is still closed, but now ΔE_int grows: mechanical energy decreases while total energy does not.

**Worked example 1: a skatepark drop.** A skateboarder starts from rest at the lip of a smooth half-pipe, 3.2 m above its bottom. Friction and air resistance are negligible. How fast is she moving at the bottom?

- **System:** skateboarder + Earth, closed. The normal force is always perpendicular to her motion, so it does no work.
- **Equation:** mgh = ½mv², so v = √(2gh) = √(2 × 9.8 × 3.2) ≈ 7.9 m/s.
- **Functional dependence:** the mass cancels, so a heavier rider reaches the same speed; the shape of the ramp does not appear either. Doubling the height multiplies the speed by √2, not 2.

| State | K | U_g | Total |
|---|---|---|---|
| Top (at rest) | 0 | mgh | mgh |
| Bottom | ½mv² = mgh | 0 | mgh |

## Springs in the energy equation

**Worked example 2: a vertical spring launcher.** A toy launcher's spring (k = 250 N/m) is compressed 0.12 m and released, firing a 0.050 kg ball straight up. Ignoring air resistance, how high above its release point does the ball rise?

- **System:** ball + spring + Earth, closed.
- **Energy stored:** U_s = ½(250)(0.12)² = 1.8 J.
- **At the top:** K = 0 and U_s = 0, so all 1.8 J is U_g: mgh = 1.8 J, h = 1.8/(0.050 × 9.8) ≈ 3.7 m (measured from the compressed position, where U_g = 0).

| State | K | U_g | U_s | Total |
|---|---|---|---|---|
| Compressed, at rest | 0 | 0 | 1.8 J | 1.8 J |
| Leaving the spring | about 1.74 J | about 0.06 J | 0 | 1.8 J |
| Top of flight | 0 | 1.8 J | 0 | 1.8 J |

At the moment it leaves the spring, the ball has risen 0.12 m, so U_g = (0.050)(9.8)(0.12) ≈ 0.06 J and K ≈ 1.74 J. The bars add to the same total at every state: that is the check.

**Limiting case:** a stiffer spring (larger k) or a lighter ball gives a greater height, h = kx²/(2mg), and doubling the compression quadruples the height. If k were zero, h would be zero: no stored energy, no launch.

## When mechanical energy is not conserved

**Worked example 3: a sled on level snow.** A 30 kg sled (rider included) is moving at 8.0 m/s when it reaches a flat stretch of snow, where μ_k = 0.10. How far does it slide before stopping?

- **System:** sled + Earth + snow, closed. Friction is internal and converts K into internal energy.
- **Free-body diagram (in words):** F_g down, F_N up (equal, 294 N), F_f backward (μ_k F_N = 29.4 N).
- **Equation:** ½mv² = ΔE_int = F_f d, so 960 J = (29.4 N)d, d ≈ 32.7 m (about 33 m).
- **Symbolic check:** d = v²/(2μ_k g): mass cancels, and doubling the speed quadruples the distance, as in week 12.

| State | K | ΔE_int | Total |
|---|---|---|---|
| Start of flat stretch | 960 J | 0 | 960 J |
| Stopped | 0 | 960 J | 960 J |

Had you chosen the sled alone, friction would be an external force doing −960 J of work. The equation is the same; only the words change.

**Worked example 4: an open system.** A student pulls a 2.0 kg cart up a smooth ramp inclined at 20°, with a string pulling 15 N parallel to the ramp. The cart starts at rest and travels 1.5 m along the ramp. Find its final speed.

- **System:** cart + Earth. The student's string is outside, so it does external work.
- W_ext = (15 N)(1.5 m) = 22.5 J. The cart rises Δy = 1.5 sin 20° ≈ 0.513 m, so ΔU_g = (2.0)(9.8)(0.513) ≈ 10.1 J.
- 0 + 0 + 22.5 J = ½(2.0)v² + 10.1 J, so ½(2.0)v² ≈ 12.4 J and v ≈ 3.5 m/s.

## Swings and circles

**Worked example 5: a playground swing.** A child on a swing with 2.0 m chains is pulled back until the chains make 40° with the vertical and released from rest. How fast is she moving at the lowest point?

- **Geometry:** the height drop is h = L(1 − cos θ) = 2.0(1 − cos 40°) ≈ 0.468 m.
- **Energy:** v = √(2gh) = √(2 × 9.8 × 0.468) ≈ 3.0 m/s. The chain tension is always perpendicular to the path, so it does no work.
- **Limiting cases:** at θ = 0 there is no drop and no speed; at θ = 90°, h = L and v = √(2gL) ≈ 6.3 m/s, the same as falling 2.0 m straight down.

Energy gives the speed at the bottom; Newton's second law for circular motion (week 11) then gives the tension, which must exceed her weight there because the net force points up, toward the centre.

## Lab: testing energy conservation with a spring launcher

**Worked example 6: linearising spring-launcher data.** A lab group compresses a spring on a level, low-friction track by different amounts x, releases a 0.40 kg cart, and measures its speed v with a photogate.

| Compression x (m) | 0.020 | 0.040 | 0.060 | 0.080 | 0.100 |
|---|---|---|---|---|---|
| Speed v (m/s) | 0.42 | 0.79 | 1.21 | 1.62 | 1.98 |

- **Prediction:** ½kx² = ½mv², so v = x√(k/m). Speed should be proportional to compression.
- **Graph:** plot v against x. The points lie close to a straight line through the origin, which supports the model.
- **Slope:** the best-fit slope is about 19.8 s⁻¹ (the unit is (m/s)/m), and it equals √(k/m).
- **Interpretation:** k = m(slope)² = 0.40 × 19.8² ≈ 156 N/m, about 160 N/m. If the group also measured k directly with hanging masses and got a larger value, the difference would show energy lost to friction in the track.
- **Reducing uncertainty:** repeat each compression three or more times and average; measure x from the spring's natural-length mark; check the track is level so U_g does not change.

## Common mistakes

- **Not naming the system**, then counting gravity twice (as U_g and as work) or not at all.
- **Assuming mechanical energy is always conserved.** Friction, air resistance and deformation inside the system turn it into internal energy; external pushes add or remove energy.
- **Saying energy is "lost" to friction.** It becomes internal energy of the surfaces; the total is conserved.
- **Using the spring's total length** instead of its compression, or forgetting the small U_g gained while the spring extends vertically.
- **Thinking a heavier object reaches the bottom of a smooth ramp faster.** Mass cancels in mgh = ½mv².
- **Doubling the speed when the height doubles.** v grows as √h.
- **Graphing v against h and calling the curve "proportional".** Plot v² against h for a straight line.

## Self-check

1. A 0.30 kg ball is released from rest 5.0 m above the ground. Find its speed just before landing (no air resistance).
2. A 0.20 kg block on a frictionless table is pushed against a spring (k = 500 N/m), compressing it 0.040 m, and released. Find its speed after leaving the spring.
3. In question 2, the compression is doubled. What happens to the launch speed?
4. A 50 kg skier starts from rest and descends 20 m vertically, reaching 16 m/s. How much energy became internal energy?
5. Which system makes friction an internal force, and which makes it an external one?
6. What should a student graph to get a straight line from heights h and speeds v at the bottom of a ramp, and what should the slope be with no friction?

*Answers:* 1. √(2 × 9.8 × 5.0) ≈ 9.9 m/s. 2. ½(500)(0.040)² = 0.40 J = ½(0.20)v², v = 2.0 m/s. 3. It doubles (v ∝ x). 4. (50)(9.8)(20) − ½(50)(16)² = 9,800 − 6,400 = 3,400 J. 5. Including both surfaces (object + floor) makes friction internal, showing up as ΔE_int; leaving the floor out makes it an external force doing negative work. 6. v² against h; slope 2g = 19.6 m/s².

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 3, Topic 3.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
