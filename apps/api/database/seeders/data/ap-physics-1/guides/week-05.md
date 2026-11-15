# Week 05 · Systems, Center of Mass, and Free-Body Diagrams

**Topics:** 2.1 Systems and Center of Mass · 2.2 Forces and Free-Body Diagrams
**Practices:** 1 (Creating Representations: free-body diagrams, component diagrams), 2 (Mathematical Routines: center-of-mass sums, resolving forces into components), 3 (Scientific Questioning and Argumentation: choosing a system and justifying an object model)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 2, Topics 2.1–2.2, learning objectives in our own words
**Spiral:** Unit 1 described motion without asking what causes it: displacement, velocity and acceleration as vectors (weeks 1–2), motion graphs (week 2), reference frames (week 3) and components in two dimensions (week 4). This week starts dynamics. We decide *what* we are analysing (the system), find the one point whose motion stands for the whole system (the center of mass), and draw every force acting on it. The component skills from week 4 come straight back when a force points at an angle.

## What you need to be able to do

- **2.1** Choose a system and say which objects are inside it and which interactions are external to it.
- **2.1** Decide when a system can be modelled as a single object (its internal structure does not matter) and when it cannot.
- **2.1** Locate the center of mass of a set of objects with x_cm = Σ(m·x)/Σm, and reason about where it lies without calculating.
- **2.1** Explain why internal forces cannot change the motion of a system's center of mass.
- **2.2** Describe a force as an interaction between two objects, and classify forces as contact forces or field (long-range) forces.
- **2.2** Draw (or describe in words) a free-body diagram: one dot, every force that acts *on* the object, each arrow labelled and starting at the dot.
- **2.2** Choose convenient axes (tilted along a slope when the motion is along a slope) and resolve angled forces into components.

## Key terms

| Term | Meaning |
|---|---|
| System | The object or collection of objects you choose to analyse. Everything else is the environment. |
| Internal force | A force exerted by one part of the system on another part of the system. |
| External force | A force exerted on the system by something outside it. |
| Object model | Treating a system as a single point with all its mass, valid when its size, shape and internal motion do not matter to the question. |
| Center of mass | The mass-weighted average position of a system; the point that moves as if all the mass and all the external forces acted there. |
| Force | A push or pull exerted by one object on another; a vector, measured in newtons (1 N = 1 kg·m/s²). |
| Contact force | A force that needs touching: normal, tension, friction, spring, air resistance, applied push. |
| Field force | A force that acts at a distance: the gravitational force (in this course). |
| Free-body diagram (FBD) | A representation of one object or system as a dot, with one labelled arrow for every external force on it. |

## Equations

| Relation | Symbols and SI units |
|---|---|
| x_cm = (m₁x₁ + m₂x₂ + …)/(m₁ + m₂ + …) | x_cm center-of-mass position (m); m mass (kg); x position of each object's own center of mass (m) |
| F_g = mg | F_g gravitational force near Earth's surface (N); m mass (kg); g = 9.8 m/s² (equivalently 9.8 N/kg) |
| Fₓ = F cos θ, F_y = F sin θ | components of a force F (N) at angle θ above the +x axis |
| F = √(Fₓ² + F_y²) | magnitude rebuilt from components (N) |
| On a slope at angle θ: F_g∥ = mg sin θ, F_g⊥ = mg cos θ | components of F_g along and perpendicular to the slope (N) |

## Systems and the center of mass (2.1)

Every dynamics problem starts with a choice: **what is the system?** The choice does not change the physics, but it changes which forces count. Take two carts pushed apart by a spring. If the system is "both carts and the spring", the spring's pushes are internal and they appear on no free-body diagram. If the system is "cart 1 alone", the spring's push on cart 1 is external and it is the force that accelerates cart 1.

A system can be treated as an **object** (a single point) when its internal structure does not matter. A car crossing a map is an object. A car whose wheels you are studying is not. A diver whose path through the air you want is an object located at its center of mass; the same diver's somersault needs the internal structure, which Unit 5 handles.

The **center of mass** is the mass-weighted average position. Along one axis:

x_cm = Σ(m·x)/Σm.

Three facts make it useful:

1. It sits closer to the heavier parts. In the limit where one mass is far larger than the rest, x_cm moves to that mass. With two equal masses it is exactly halfway.
2. For a uniform, symmetric object (a meter stick, a ball, a can of soup when the soup is evenly spread) it is at the geometric center. It does not have to be inside the material: the center of mass of a ring or a boomerang is in the empty space.
3. **Internal forces cannot move the center of mass.** Internal forces come in equal and opposite pairs inside the system (you will name this Newton's third law next week), so their effects on the system as a whole cancel. Only an external force changes the velocity of the center of mass.

**Worked example 1: the canoe (center of mass and internal forces).** A 40 kg canoe is 5.0 m long; put x = 0 at its back end, so its own center of mass is at 2.5 m. A 70 kg adult sits at x = 0.50 m and a 30 kg child at x = 4.0 m. The canoe floats at rest; ignore the water's horizontal drag.

- x_cm = (70 · 0.50 + 30 · 4.0 + 40 · 2.5)/(70 + 30 + 40) = (35 + 120 + 100)/140 = 255/140 ≈ **1.82 m** from the back of the canoe. It is nearer the adult, the heaviest object, as it should be.
- Now the adult walks forward to the spot 3.5 m from the back of the canoe. Take the system as adult + child + canoe. The adult's feet push the canoe and the canoe pushes back: internal forces. With no horizontal external force, the system's center of mass stays fixed relative to the shore. If the canoe slides a distance d (positive = forward), every position grows by d, so

  70(3.5 + d) + 30(4.0 + d) + 40(2.5 + d) = 255 → 465 + 140d = 255 → **d = −1.5 m**.

- The canoe slides 1.5 m backward while the adult moves forward. Check: the adult moved 3.0 m forward relative to the canoe but only 1.5 m relative to the shore, and the heavier the canoe, the less it would slide (in the limit of a canoe tied to a dock, d → 0).

**Worked example 2: where is it, without a calculator?** A 0.10 kg uniform meter stick has a 0.20 kg mass hung at the 10 cm mark and a 0.30 kg mass at the 90 cm mark. Before computing, reason: the stick alone balances at 50 cm, and the heavier hanging mass is on the 90 cm side, so x_cm is a bit past 50 cm. The sum: x_cm = (0.10 · 50 + 0.20 · 10 + 0.30 · 90)/0.60 = 34/0.60 ≈ **56.7 cm**. The estimate and the calculation agree.

## Forces and free-body diagrams (2.2)

A **force is an interaction**: every force has an object exerting it and an object it acts on. Say both: "the force exerted by the rope on the sled", "the gravitational force exerted by Earth on the ball". If you cannot name the object exerting a force, the force does not exist. There is no "force of motion" and no "force of the throw" once a ball has left your hand.

Two families appear in this course:

- **Contact forces** need touching: the **normal force** F_N (a surface pushing perpendicular to itself), **tension** F_T (a rope or string pulling along its length), **friction** F_f (a surface pushing parallel to itself, against sliding or attempted sliding; week 9 gives the rules), the **spring force** F_s (week 10), air resistance and any applied push.
- **Field forces** act at a distance. In AP Physics 1 that is the **gravitational force** F_g = mg near Earth's surface (week 8 gives the general law).

**Drawing a free-body diagram.**

1. Choose the object or system. Draw it as a single dot.
2. Find everything touching it; each contact supplies a contact force. Add the gravitational force.
3. Draw each force as an arrow starting at the dot, in the direction the force acts, with length roughly showing its size.
4. Label each with a symbol and, if helpful, who exerts it (F_N,table on book).
5. Do **not** draw velocity, acceleration or a "net force" arrow on the FBD, and do not draw components on top of the original arrow (sketch them separately, dashed, if you need them).

On the AP exam you draw FBDs; in these notes we describe them in words. "A dot with a downward arrow labelled F_g, an upward arrow labelled F_N, and a rightward arrow labelled F_T angled 25° above the horizontal."

**Choosing axes.** Put one axis along the direction the object moves or could move. For an object on a slope, tilt the axes: x along the slope, y perpendicular to it. Then only gravity needs resolving.

**Worked example 3: the sled (FBD and components).** A child pulls a 12 kg sled across level snow with a rope that makes 25° above the horizontal; the tension is 60 N. Ignore friction for now.

FBD in words: a dot with a downward arrow F_g (Earth on sled), an upward arrow F_N (snow on sled) and an arrow F_T (rope on sled) pointing right and 25° up.

| Force | x component (N) | y component (N) |
|---|---|---|
| F_T = 60 N at 25° | 60 cos 25° = +54.4 | 60 sin 25° = +25.4 |
| F_g = 12 · 9.8 = 117.6 N | 0 | −117.6 |
| F_N | 0 | +F_N |

The sled does not leave the snow or sink into it, so the vertical components balance (you will justify this with Newton's first law next week): F_N + 25.4 − 117.6 = 0, so **F_N ≈ 92 N**. Symbolically, F_N = mg − F_T sin θ.

*Limiting-case check.* At θ = 0 the rope pulls straight along the snow and F_N = mg, the familiar value. As θ grows the rope lifts more and F_N shrinks. If F_T sin θ ever equals mg, F_N = 0 and the sled is about to lift off. The normal force is **not** always mg.

**Worked example 4: the block on a ramp (tilted axes).** A 4.0 kg block rests on a smooth ramp inclined at 30°, held by a string parallel to the ramp.

FBD in words: a downward arrow F_g = 39.2 N, an arrow F_N perpendicular to the ramp surface pointing away from it, and an arrow F_T pointing up the ramp along the string.

With x up the slope and y perpendicular to it, the angle between F_g and the −y axis equals the ramp angle θ. So:

| Force | along slope, x (N) | perpendicular, y (N) |
|---|---|---|
| F_g | −mg sin 30° = −19.6 | −mg cos 30° = −33.9 |
| F_N | 0 | +F_N |
| F_T | +F_T | 0 |

The block is at rest, so F_T = 19.6 N and F_N = 33.9 N. *Check the limits:* at θ = 0 (flat), sin θ = 0 and cos θ = 1, so the string has no work to do and F_N = mg; at θ = 90° (a vertical wall) the string holds the full 39.2 N and the wall pushes with zero. If your component formulas give the opposite (string tension largest on a flat floor), you have swapped sin and cos.

## Common mistakes

- **Adding a "force of motion".** An object moving to the right does not need a rightward force; a thrown ball in flight feels only gravity (and air resistance if you include it).
- **Assuming F_N = mg.** It is true only when the surface is level and nothing else pushes or pulls vertically.
- **Swapping sin and cos on a slope.** The component of gravity along the slope is mg sin θ; check with θ = 0.
- **Using mass for weight.** A 4.0 kg block has F_g = 39.2 N, not 4.0 N.
- **Drawing internal forces on a system's FBD.** If both objects are inside the system, the forces between them are left off.
- **Putting the center of mass at the average of the positions.** That is right only for equal masses.

## Self-check

1. Two gliders on an air track: 0.25 kg at x = 0.40 m and 0.75 kg at x = 1.20 m. Where is the center of mass?
2. The gliders in question 1 are pushed apart by a spring between them. What happens to the center of mass of the two-glider system?
3. Describe the FBD of a ball at the top of its flight, ignoring air resistance.
4. A 50 N push is applied downward at 30° below the horizontal on a 10 kg box on a level floor. What is the normal force?
5. Why is a person on a trampoline not well modelled as an object if you want to know how the trampoline stretches?

*Answers:* 1. x_cm = (0.25 · 0.40 + 0.75 · 1.20)/1.00 = 1.00 m. 2. It stays where it was (or keeps its original velocity): the spring forces are internal. 3. A dot with a single downward arrow F_g; there is no upward force at the top, even though the ball is momentarily at rest. 4. F_N = mg + F sin 30° = 98 + 25 = 123 N. 5. The stretch depends on how the person's mass is distributed and how their legs push, which is internal structure the object model throws away.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 2, Topics 2.1–2.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
