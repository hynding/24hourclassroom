# Week 20 · Torque

**Topics:** 5.3 Torque
**Practices:** 1 (Creating Representations: force diagrams that show where each force acts relative to the axis), 2 (Mathematical Routines: τ = rF sin θ and the lever arm r⊥, summing torques with signs), 3 (Scientific Questioning and Argumentation: predicting how a torque changes when the force, its point of application or its angle changes)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 5, Topic 5.3, learning objectives in our own words
**Spiral:** Week 4 resolved vectors into components with sine and cosine; week 5 located the centre of mass and drew free-body diagrams, and weeks 6–11 built the forces themselves; week 19 described rotation with θ, ω and α. This week answers the question week 19 left open: what makes an object start, stop or change its spin? A force does, but how much depends on where and in which direction it acts.

## What you need to be able to do

- **5.3** Identify every force exerted on a rigid object and where it acts, and draw a force diagram that shows each force at its point of application relative to a chosen axis.
- **5.3** Find the lever arm r⊥, the perpendicular distance from the axis to the force's line of action.
- **5.3** Calculate the magnitude of a torque with τ = r⊥F = rF sin θ, where θ is the angle between the position vector r and the force.
- **5.3** Assign each torque a sign (counterclockwise positive) and add the torques on an object to find the net torque.
- **5.3** Explain why a force whose line of action passes through the axis exerts no torque about that axis, and predict how a torque changes when r, F or θ changes.

## Key terms

| Term | Meaning |
|---|---|
| Torque τ | The turning effect of a force about a chosen axis; τ = rF sin θ, in N·m. |
| Axis (pivot) | The point or line the object turns about, or that you choose for computing torques. |
| Position vector r | The arrow from the axis to the point where the force is applied; its length is r. |
| Angle θ | The angle between r and F when the two arrows are placed tail to tail. |
| Line of action | The line through the point of application, drawn along the force's direction, extended both ways. |
| Lever arm r⊥ | Perpendicular distance from the axis to the line of action; r⊥ = r sin θ. |
| Force diagram (extended) | A sketch of the object showing each force as an arrow starting where it acts, not all from one dot. |
| Net torque Στ | The sum of all torques on the object about one axis, with signs. |

## Equations

| Relation | Symbols and SI units |
|---|---|
| τ = rF sin θ | τ torque (N·m), r distance from axis to point of application (m), F force (N), θ angle between r and F |
| τ = r⊥F | r⊥ lever arm (m) |
| r⊥ = r sin θ | the lever arm in terms of r and θ |
| τ = rF⊥ | F⊥ = F sin θ, the component of F perpendicular to r (N) |
| Στ = τ₁ + τ₂ + … | counterclockwise torques positive, clockwise negative |
| τ_gravity = r⊥(Mg) | gravity on a rigid object acts at its centre of mass; M mass (kg), g = 9.8 m/s² |

Torque and work share the unit N·m but are different quantities. Write torque in N·m, never in joules.

## What a torque is (5.3)

Try to open a heavy door by pushing right next to the hinges: almost nothing happens. Push the same amount at the handle and the door swings easily. Push at the handle but straight toward the hinges and again nothing happens. The turning effect of a force depends on three things:

1. **How big the force is** (F).
2. **How far from the axis it acts** (r).
3. **Its direction relative to the line from the axis** (θ). Only the part of the force perpendicular to r turns the object.

Put together, τ = rF sin θ. A force aimed straight at or away from the axis (θ = 0° or 180°) gives sin θ = 0 and no torque. A force perpendicular to r (θ = 90°) gives the largest torque, rF.

**Two ways to read the same formula.** Group it as r(F sin θ): the distance times the perpendicular component of the force. Or group it as (r sin θ)F: the lever arm times the whole force. The lever arm view is often faster: extend the force's line of action, drop a perpendicular from the axis onto it, and measure. If the line of action passes through the axis, the lever arm is zero.

**Worked example 1: a wrench at three angles.** A mechanic pulls with 80 N on the end of a wrench, 0.25 m from the centre of a bolt.

| Angle between wrench and pull | sin θ | τ = rF sin θ (N·m) |
|---|---|---|
| 90° | 1.00 | 20.0 |
| 60° | 0.866 | 17.3 |
| 30° | 0.500 | 10.0 |
| 0° (pulling along the handle) | 0 | 0 |

The torque falls as the pull swings toward the handle's direction. Functional dependence: τ is proportional to r, to F and to sin θ. Slip a pipe over the handle so she pulls 0.50 m from the bolt at 90°, and the same 80 N gives 40 N·m: doubling r doubles τ. That is why a stuck bolt yields to a longer wrench rather than a stronger arm.

**Worked example 2: a door, push and lever arm.** A door is 0.90 m wide. A student pushes perpendicular to the door with 40 N at the handle, 0.80 m from the hinge line: τ = (0.80)(40) = 32 N·m. Pushing perpendicular at 0.20 m from the hinges gives only (0.20)(40) = 8.0 N·m. To match the 32 N·m from that spot she would need 32/0.20 = 160 N. A push straight toward the hinges along the door's surface has a line of action through the axis, so its lever arm and its torque are zero however hard she pushes.

## Representing torques: force diagrams for rigid objects (5.3)

A free-body diagram for a point object (week 5) draws every force from one dot. For rotation that loses the key information, so draw an **extended force diagram**: a sketch of the object with each force arrow starting at the point where it acts, and the axis marked.

Rules for placing the arrows:

- **Gravity** acts at the centre of mass. For a uniform beam that is the middle (week 5).
- A **normal force** acts where the surfaces touch.
- A **string or cable** pulls along its own length, at the point where it is tied.
- A **hinge or pivot** can push in any direction, but it acts at the axis, so about that axis its torque is zero. Choosing the axis at an unknown force removes that force from the torque sum, a trick week 22 relies on.

**Signs.** Imagine the force acting alone on an object free to turn about the axis. If it would turn the object counterclockwise, its torque is positive; clockwise, negative. Then add: Στ = τ₁ + τ₂ + ….

**Worked example 3: a seesaw that does not balance.** A uniform seesaw is pivoted at its centre. A 30 kg child sits 1.8 m to the left of the pivot and a 25 kg child sits 1.5 m to the right. Seen from the side with counterclockwise positive:

- Extended force diagram: a downward arrow F_g1 = (30)(9.8) = 294 N at 1.8 m left of the pivot; a downward arrow F_g2 = (25)(9.8) = 245 N at 1.5 m right; the board's own weight acting at the pivot; an upward force from the pivot at the pivot.
- Left child: τ₁ = +(1.8)(294) = +529 N·m (a downward push on the left side turns the board counterclockwise).
- Right child: τ₂ = −(1.5)(245) = −368 N·m.
- The board's weight and the pivot force both act at the axis: zero torque.
- Στ = 529.2 − 367.5 ≈ +162 N·m, counterclockwise. The left side goes down.

Where should the 25 kg child sit to cancel the net torque? Set (25)(9.8)d = 529 N·m, so d = (30)(1.8)/25 = 2.16 m from the pivot. Notice that g cancels: balance depends on mass times distance, a result week 22 develops as rotational equilibrium.

**Worked example 4: a beam held by a cable, torques only.** A uniform 15 kg beam 2.0 m long sticks straight out from a wall on a hinge. A cable from the far end runs up to the wall, making 30° with the beam. Take the axis at the hinge.

| Force | Acts at (from hinge) | Angle between r and F | Torque about hinge |
|---|---|---|---|
| Gravity, 147 N down | 1.0 m (centre of mass) | 90° | −147 N·m (clockwise) |
| Cable tension T | 2.0 m (far end) | 30° | +T(2.0)(sin 30°) = +(1.0 m)T |
| Hinge force | 0 m | none | 0 |

The cable's lever arm is r⊥ = (2.0 m)(sin 30°) = 1.0 m: the perpendicular distance from the hinge to the cable's line. A steeper cable would have a longer lever arm and could hold the beam with less tension. Limiting case: if the cable ran horizontally into the wall, θ = 0°, its lever arm would be zero and no tension could hold the beam up, which matches everyday experience. Week 22 sets the two torques equal to find T.

## Torque and rotation: what to expect (5.3)

A net torque about an axis changes an object's angular velocity, much as a net force changes velocity. If the net torque is zero the angular velocity stays constant, which may mean staying at rest or spinning steadily. How strongly a given torque speeds up an object depends on its mass and how far that mass is from the axis: next week's rotational inertia. Weeks 22–23 make both statements exact.

Two cautions:

- A **net force of zero does not guarantee zero net torque.** Two equal, opposite forces along different lines (a couple, such as your hands turning a steering wheel) add to zero force but give a net torque that spins the object.
- A **net torque of zero does not guarantee zero net force.** A force through the axis of a wheel can accelerate it without turning it.

## Common mistakes

- **Measuring r to the wrong place.** r runs from the axis to the point where the force acts, not to the object's end or its centre.
- **Using cos θ instead of sin θ.** θ is the angle between r and F; the perpendicular component is F sin θ. If the angle given is between F and the perpendicular to r, use cos of that angle; draw it before choosing.
- **Drawing every force from one dot** on a rotation problem; the location of each force matters.
- **Giving a hinge or pivot force a torque** about that same hinge.
- **Dropping signs**, so that two torques that oppose each other are added.
- **Calling torque "energy" or writing it in joules.**

## Self-check

1. A 60 N force is applied perpendicular to a 0.30 m wrench at its end. What is the torque?
2. The same 60 N force is applied at the end of the wrench at 25° to the handle. What is the torque?
3. A force's line of action passes 0.12 m from a pivot. The force is 50 N. What is its torque about the pivot?
4. A 40 kg student sits 1.2 m left of a seesaw's pivot. Where must a 32 kg student sit for zero net torque?
5. A force through a wheel's axle pushes the wheel. What torque does it exert about the axle, and why?
6. If you double the force and halve the distance from the axis, how does the torque change?

*Answers:* 1. τ = (0.30)(60) = 18 N·m. 2. τ = (0.30)(60)(sin 25°) ≈ 7.6 N·m. 3. τ = (0.12)(50) = 6.0 N·m. 4. (40)(1.2)/32 = 1.5 m right of the pivot. 5. Zero: its line of action passes through the axis, so the lever arm is zero. 6. It stays the same, because τ is proportional to the product rF.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 5, Topic 5.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
