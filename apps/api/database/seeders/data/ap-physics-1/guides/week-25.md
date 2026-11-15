# Week 25 · Angular Momentum, Angular Impulse and Their Conservation

**Topics:** 6.3 Angular Momentum and Angular Impulse · 6.4 Conservation of Angular Momentum
**Practices:** 1 (Creating Representations: torque–time graphs and before/after tables), 2 (Mathematical Routines: L = Iω, L = mvr⊥, τΔt = ΔL), 3 (Scientific Questioning and Argumentation: deciding when angular momentum is conserved and arguing what happens to kinetic energy)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 6, Topics 6.3–6.4, learning objectives in our own words
**Spiral:** Weeks 16–18 defined linear momentum, impulse as the area under a force–time graph, and conservation of momentum in collisions; weeks 19–23 gave torque, rotational inertia and τ_net = Iα; week 24 gave rotational kinetic energy. This week builds the exact rotational copy of the momentum story.

## What you need to be able to do

- **6.3** Calculate the angular momentum of a rigid object about a fixed axis, L = Iω, with a sign for the sense of rotation.
- **6.3** Calculate the angular momentum of a point object about a chosen point, L = mvr⊥ = mvr sin θ, including an object moving in a straight line.
- **6.3** Use angular impulse: τΔt = ΔL, and find the angular impulse as the area under a torque–time graph.
- **6.4** Decide whether a system's angular momentum is conserved (net external torque on the system is zero) and apply L_i = L_f.
- **6.4** Explain what happens to angular speed and to rotational kinetic energy when a system changes its rotational inertia (a spinner pulling in their arms) or when objects stick together in a rotational collision.
- **6.4** Choose a system so that the forces that change its parts' angular momentum are internal.

## Key terms

| Term | Meaning |
|---|---|
| Angular momentum L | For a rigid object about a fixed axis, Iω; for a point object about a point, mvr⊥. A vector along the axis; in AP problems a signed quantity (counterclockwise positive). |
| Moment arm r⊥ | The perpendicular distance from the reference point to the line along which an object moves (or a force acts). |
| Angular impulse | The product τΔt of a torque and the time it acts; for a changing torque, the area under the τ–t graph. |
| Angular impulse–momentum theorem | The net external angular impulse on a system equals its change in angular momentum. |
| Conservation of angular momentum | If the net external torque on a system is zero, its total angular momentum does not change. |
| Rotational collision | Objects that collide and turn about a common axis; angular momentum about the axis is conserved, kinetic energy usually is not. |

## Equations

| Relation | Symbols and SI units |
|---|---|
| L = Iω | L angular momentum (kg·m²/s); I rotational inertia about the axis (kg·m²); ω angular velocity (rad/s) |
| L = mvr⊥ = mvr sin θ | m mass (kg); v speed (m/s); r distance from the reference point (m); θ angle between r and v; r⊥ = r sin θ the moment arm (m) |
| ΔL = τ_net Δt | τ_net net external torque (N·m); Δt time interval (s); N·m·s is the same unit as kg·m²/s |
| L_total,i = L_total,f | when the net external torque on the system is zero |
| K = ½Iω² = L²/(2I) | handy when L is fixed: K ∝ 1/I |

Compare with linear momentum: p = mv and FΔt = Δp. Every linear statement from Unit 4 has a rotational twin with I for m, ω for v and τ for F.

## Angular momentum and angular impulse (6.3)

**A spinning object.** A rigid object turning about a fixed axis has angular momentum L = Iω. Two objects can spin at the same ω with very different L if their mass is distributed differently: a hoop has twice the angular momentum of a disk of the same mass and radius at the same ω.

**A moving point object.** An object does not need to go in a circle to have angular momentum about a point. A puck sliding in a straight line has L = mvr⊥ about any point off its path, where r⊥ is the perpendicular distance from the point to the line of motion. As the puck slides, its distance r from the point changes but r sin θ = r⊥ does not, so its angular momentum about that point stays constant. That is the rotational version of Newton's first law: no torque, no change in L.

**Worked example 1: a skateboarder passing a carousel.** A 60 kg skateboarder rolls at a steady 4.0 m/s along a straight path whose closest approach to a carousel's axle is 1.8 m. What is her angular momentum about the axle when she is 3.0 m from the axle? When she is at the closest point?

- At the closest point r⊥ = r = 1.8 m: L = mvr⊥ = (60 kg)(4.0 m/s)(1.8 m) = 432 kg·m²/s.
- At 3.0 m from the axle, r sin θ is still the perpendicular distance 1.8 m, so L is still 432 kg·m²/s. Using r = 3.0 m in mvr would give 720, which is the classic mistake.

**Angular impulse.** A net torque changes angular momentum, just as a net force changes linear momentum: τ_net Δt = ΔL. When the torque varies, the angular impulse is the area under the torque–time graph, found with rectangles and triangles.

**Worked example 2: spinning up a bicycle wheel.** A student spins a bicycle wheel (I = 0.12 kg·m²) that starts at rest on a frictionless axle. The torque she applies is recorded:

| Time (s) | 0 | 0.20 | 0.40 | 0.70 | 1.00 |
|---|---|---|---|---|---|
| Torque (N·m) | 0 | 1.5 | 3.0 | 3.0 | 3.0 |

The torque rises steadily to 3.0 N·m in 0.40 s and then holds for 0.60 s.

- Area of the triangle: ½(0.40 s)(3.0 N·m) = 0.60 N·m·s. Area of the rectangle: (0.60 s)(3.0 N·m) = 1.80 N·m·s.
- ΔL = 2.40 kg·m²/s, so ω = ΔL/I = 2.40 ÷ 0.12 = 20 rad/s.

**Functional dependence:** the same torque history on a wheel with twice the rotational inertia gives the same ΔL (the area does not care about I) but half the final ω.

## Conservation of angular momentum (6.4)

If the net external torque on a system is zero, its total angular momentum is constant. Internal torques, the ones the parts of the system exert on each other, come in equal and opposite pairs and cancel, just as internal forces cancel for linear momentum. Choose the system so that the interaction you do not know (a skater's muscles, the friction between a jumping child and a carousel) is internal.

Two kinds of situation fill the AP exam.

**1. A system changes its own rotational inertia.** A spinner pulling in their arms, a diver tucking, a student on a rotating stool pulling in dumbbells. L = Iω stays fixed, so a smaller I means a larger ω. Kinetic energy is **not** conserved: K = L²/(2I) increases as I decreases. The extra energy comes from the work the person's muscles do pulling the masses inward. If the person stretches out again, K drops back.

**Worked example 3: the rotating stool.** A student sits on a stool that turns with negligible friction, holding dumbbells at arm's length. The rotational inertia of student, stool and dumbbells is 4.8 kg·m² and the system turns at 2.0 rad/s. The student pulls the dumbbells to her chest, reducing the inertia to 1.6 kg·m².

- L_i = (4.8)(2.0) = 9.6 kg·m²/s = L_f, so ω_f = 9.6 ÷ 1.6 = 6.0 rad/s.
- K before and after:

| Quantity | Arms out | Arms in |
|---|---|---|
| I (kg·m²) | 4.8 | 1.6 |
| ω (rad/s) | 2.0 | 6.0 |
| L (kg·m²/s) | 9.6 | 9.6 |
| K_rot (J) | 9.6 | 28.8 |

The kinetic energy triples (I dropped by a factor of 3, and K = L²/2I). The student's arms did 19.2 J of work pulling the dumbbells inward against their tendency to keep moving in a straight line.

**2. Objects stick together (a rotational collision).** A child jumps onto a spinning carousel, clay lands on a turntable, a dart sticks in a rotating board. Angular momentum about the axis is conserved during the brief collision (the axle's force acts at the axis and exerts no torque about it), but kinetic energy is not: like a perfectly inelastic collision in Unit 4, some becomes internal energy.

**Worked example 4: a child jumps onto a carousel.** A carousel (I = 200 kg·m²) turns at 1.2 rad/s. A 30 kg child runs at 3.0 m/s along a line tangent to the rim, in the direction the rim is moving, and jumps on at the rim, 1.6 m from the axle. Find the final angular speed and the change in kinetic energy.

- L_i = Iω + mvR = (200)(1.2) + (30)(3.0)(1.6) = 240 + 144 = 384 kg·m²/s.
- I_f = 200 + (30)(1.6)² = 276.8 kg·m², so ω_f = 384 ÷ 276.8 = 1.39 rad/s.
- K_i = ½(200)(1.2)² + ½(30)(3.0)² = 144 + 135 = 279 J. K_f = ½(276.8)(1.39)² = 266 J. About 13 J becomes internal energy (the child's legs and shoes absorb it).

**Limiting-case checks.** If the child ran at exactly the rim's speed (ωR = 1.92 m/s), the formula gives ω_f = (200(1.2) + 30(1.92)(1.6))/276.8 = 1.2 rad/s: no change, as it must be when nothing slips at the moment of landing. If the child ran the opposite way at 3.0 m/s, her angular momentum would be negative and ω_f = (240 − 144)/276.8 = 0.35 rad/s.

**Linear momentum is not conserved here.** The axle pushes on the carousel during the collision, an external force, so the system's linear momentum changes. But that force acts at the axis and exerts no torque about it, so angular momentum about the axle is conserved. Always say which quantity is conserved, about which axis, and why.

## Common mistakes

- **Using the distance r instead of the moment arm r⊥** for a point object moving in a straight line.
- **Thinking a straight-line mover has no angular momentum.** It has L = mvr⊥ about any point off its line.
- **Conserving kinetic energy when a spinner pulls in their arms.** L is conserved; K increases because the spinner does work.
- **Conserving kinetic energy in a rotational collision** (child on carousel, clay on turntable). K decreases; only L is conserved.
- **Conserving linear momentum for a pivoted system.** The axle exerts an external force; use angular momentum about the axle.
- **Forgetting signs.** Angular momentum in the opposite sense subtracts.
- **Saying gravity spins a diver up.** Gravity acts at the centre of mass and exerts no torque about it; the diver tucks to reduce I.

## Self-check

1. A 0.40 kg ball on a 0.75 m string swings in a horizontal circle at 3.0 m/s. What is its angular momentum about the centre?
2. A constant torque of 0.50 N·m acts on a wheel for 4.0 s. By how much does its angular momentum change?
3. A spinning skater's rotational inertia drops to half. What happens to ω and to K?
4. A 50 g lump of clay is dropped straight down onto the rim of a turntable spinning at 3.5 rad/s. Is the turntable's ω after the clay lands larger, smaller or the same? Is K conserved?
5. A puck slides in a straight line past a peg. Why is its angular momentum about the peg constant even though its distance from the peg changes?
6. Two wheels, one with twice the rotational inertia of the other, start at rest and receive the same angular impulse. Compare their final angular momenta and angular speeds.

*Answers:* 1. L = mvr = (0.40)(3.0)(0.75) = 0.90 kg·m²/s. 2. ΔL = τΔt = 2.0 kg·m²/s. 3. ω doubles (L constant) and K doubles (K = L²/2I), the extra energy from the skater's muscles. 4. Smaller: the clay adds rotational inertia and brings in no angular momentum, so ω drops; K is not conserved (it decreases). 5. No force acts on it in the plane, so no torque about the peg; r sin θ, the perpendicular distance to its line, stays the same. 6. Equal angular momenta (same area under τ–t); the wheel with twice the inertia ends with half the angular speed.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 6, Topics 6.3–6.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
