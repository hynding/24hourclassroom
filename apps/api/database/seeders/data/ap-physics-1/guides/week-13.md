# Week 13 · Potential Energy

**Topics:** 3.3 Potential Energy
**Practices:** 1 (Creating Representations: energy bar charts, force–stretch graphs, potential energy versus position graphs), 2 (Mathematical Routines: mgΔy, ½kx², −Gm₁m₂/r, slope and area), 3 (Scientific Questioning and Argumentation: choosing a system and justifying whether it has potential energy)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 3, Topic 3.3, learning objectives in our own words
**Spiral:** Week 8 gave you the gravitational force F_g = Gm₁m₂/r² and the field g near Earth; week 10 gave you Hooke's law, F_s = kΔx; week 12 gave you work as the area under a force–position graph and the work–energy theorem. This week turns the work done by gravity and springs into energy stored in a system.

## What you need to be able to do

- **3.3** Explain why potential energy belongs to a **system** of two or more interacting objects, never to one object alone.
- **3.3** Calculate the change in gravitational potential energy near Earth's surface, ΔU_g = mgΔy, and show that the choice of zero does not change ΔU_g.
- **3.3** Calculate the elastic potential energy of an ideal spring, U_s = ½kx², and find it as the area under a force–stretch graph.
- **3.3** Use U_G = −Gm₁m₂/r for objects far apart, explain the minus sign, and know when mgΔy is a good approximation.
- **3.3** Relate the work done by a conservative force inside a system to the change in potential energy: W = −ΔU.
- **3.3** Read a potential energy versus position graph: the force points toward lower U, and is larger where the graph is steeper.

## Key terms

| Term | Meaning |
|---|---|
| System | The objects you choose to study; everything else is the surroundings. |
| Potential energy | Energy stored in the arrangement (configuration) of a system of interacting objects. |
| Conservative force | A force whose work depends only on the start and end positions, not on the path: gravity, an ideal spring. |
| Nonconservative force | A force whose work depends on the path, such as friction; it has no potential energy. |
| Reference point | The configuration you assign U = 0; only changes in U are physical. |
| Spring constant k | Stiffness of a spring, in N/m: the slope of its force–stretch graph. |
| Gravitational potential energy (general) | U_G = −Gm₁m₂/r, zero when the objects are infinitely far apart. |

## Equations

| Relation | Symbols and SI units |
|---|---|
| ΔU_g = mgΔy | ΔU_g change in gravitational potential energy of an object–Earth system (J), m mass (kg), g = 9.8 N/kg, Δy change in height (m), positive upward |
| U_s = ½kx² | U_s elastic potential energy (J), k spring constant (N/m), x stretch or compression from natural length (m) |
| U_G = −Gm₁m₂/r | U_G gravitational potential energy of two masses (J), G = 6.67 × 10⁻¹¹ N·m²/kg², m₁ and m₂ masses (kg), r centre-to-centre distance (m) |
| W_conservative = −ΔU | work done by a conservative force between objects inside the system (J) |
| F = −(slope of U versus x) | the size of the force is the steepness of the U–x graph (N = J/m); it points downhill |

## Potential energy belongs to a system (3.3)

Lift a book. Has the book gained potential energy? Strictly, no: the **book–Earth system** has. The energy is stored in the separation between the book and Earth, just as the energy of a stretched spring is stored in the spring's changed shape, not in the block attached to it. This matters because the AP exam checks whether you can say what is in your system.

- **System = book and Earth.** Gravity is an internal force. As the book falls, U_g decreases and K increases; no external work is done.
- **System = book alone.** There is no potential energy. Gravity is an external force that does positive work on the falling book, increasing its K.

Both descriptions give the same final speed. They differ only in the bookkeeping. A system of one object can have kinetic energy but never potential energy.

**Only conservative forces have a potential energy.** The work gravity does on a ball moving from a shelf to the floor is mgh whether the ball drops straight down or rolls down a winding ramp. Friction is different: dragging a box around a long path removes more energy than a short one, so no "friction potential energy" can be defined.

The link between the two ideas is W = −ΔU. When gravity does positive work on a falling object, the system's potential energy goes down by that amount.

## Gravitational potential energy near Earth

Near Earth's surface, g is nearly constant, and ΔU_g = mgΔy. Only the **change** has meaning, so you may put y = 0 wherever it is convenient: the floor, a tabletop, the lowest point of the motion.

**Worked example 1: a backpack and the choice of zero.** A student lifts a 6.0 kg backpack from the floor onto a shelf 1.5 m above the floor.

- With the floor as y = 0: U_i = 0, U_f = (6.0)(9.8)(1.5) = 88.2 J, so ΔU_g = +88.2 J.
- With a tabletop 0.75 m above the floor as y = 0: U_i = (6.0)(9.8)(−0.75) = −44.1 J, U_f = +44.1 J, so ΔU_g = +88.2 J.

The values of U change with the reference point; the change does not. A negative U_g just means "below the reference level".

The student's lifting force did +88.2 J of work on the backpack (it starts and ends at rest), while gravity did −88.2 J. If the backpack–Earth system is chosen, the student is external and her 88.2 J is stored as U_g.

## Elastic potential energy of a spring

An ideal spring exerts F_s = kx (week 10). Stretching it from 0 to x takes a force that grows in a straight line, so the work done is the triangular area under the force–stretch graph: ½(x)(kx) = ½kx². That work is stored as U_s = ½kx², for stretch or compression alike.

**Worked example 2: a lab spring, slope and area.** A lab group hangs slotted masses from a spring and records the force and the stretch.

| Stretch x (m) | 0.020 | 0.040 | 0.060 | 0.080 | 0.100 |
|---|---|---|---|---|---|
| Force F (N) | 1.0 | 2.1 | 2.9 | 4.1 | 5.0 |

- **Representation:** a force-versus-stretch graph is a straight line through (very nearly) the origin, so the spring is ideal over this range.
- **Slope:** the best-fit line has slope 50 N/m, so k ≈ 50 N/m. (Using the end points: 5.0 N / 0.100 m = 50 N/m.)
- **Area:** at x = 0.100 m, U_s = ½(50)(0.100)² = 0.25 J, the area of the triangle under the line.
- **Functional dependence:** at x = 0.200 m (if the spring stays ideal), U_s = ½(50)(0.200)² = 1.0 J, four times as much. Doubling the stretch doubles the force but quadruples the stored energy, because both the height and the base of the triangle double.

## Gravitational potential energy far from Earth

When the distance between objects changes by a large amount, g is not constant and mgΔy fails. For two spherical masses, U_G = −Gm₁m₂/r.

- **Why negative?** The zero is chosen at infinite separation. Gravity is attractive, so you must do positive work to pull two objects apart to infinity; they start with less energy than zero.
- **Shape:** as r increases, U_G becomes less negative, so it **increases** toward zero. Moving apart always raises the system's potential energy.
- **Functional dependence:** doubling r halves the magnitude of U_G (it goes from −A to −A/2, an increase).

**Worked example 3: lifting a satellite.** A 500 kg satellite is carried from Earth's surface (r = 6.37 × 10⁶ m) to a circular orbit 400 km up (r = 6.77 × 10⁶ m). Earth's mass is 5.97 × 10²⁴ kg. Find the change in the satellite–Earth system's potential energy and compare it with mgh.

- At the surface: U_i = −GMm/R = −(6.67 × 10⁻¹¹)(5.97 × 10²⁴)(500)/(6.37 × 10⁶) ≈ −3.126 × 10¹⁰ J.
- In orbit: U_f = −GMm/(R + h) ≈ −2.941 × 10¹⁰ J.
- ΔU_G = U_f − U_i ≈ +1.85 × 10⁹ J.
- The near-surface formula gives mgh = (500)(9.8)(4.0 × 10⁵) = 1.96 × 10⁹ J, about 6% too high, because g is smaller at altitude than at the surface. **Limiting case:** for h much less than R, the exact expression GMm(1/R − 1/(R + h)) becomes GMmh/R² = mgh, so the two formulas agree for small lifts, as they must.

## Potential energy graphs

A graph of U versus position is a map of the force. **The force on the object points toward lower U**, like a ball rolling downhill, and **its size is the steepness of the graph**, |ΔU/Δx|. Where the graph is flat, the force is zero; that is an equilibrium position.

**Worked example 4: a cart near a spring bumper.** A cart on a level track approaches a spring bumper at the right end. The potential energy of the cart–spring system is:

| Position x (m) | 0.00 | 0.10 | 0.20 | 0.30 | 0.40 |
|---|---|---|---|---|---|
| U_s (J) | 0 | 0 | 0 | 0.25 | 1.00 |

- From 0 to 0.20 m the graph is flat: no force; the cart rolls at constant speed.
- From 0.20 m to 0.40 m U rises (the spring is compressed by x − 0.20 m, with k = 50 N/m: ½(50)(0.10)² = 0.25 J, ½(50)(0.20)² = 1.00 J). The force points toward lower U, to the left, pushing the cart back.
- Between 0.30 m and 0.40 m the average slope is (1.00 − 0.25)/0.10 = 7.5 J/m, so the average force is 7.5 N, larger than between 0.20 and 0.30 m (2.5 N), as Hooke's law predicts.
- **Preview of week 14:** if the cart's kinetic energy is 0.25 J when it reaches the bumper, it stops where U = 0.25 J, at x = 0.30 m, and comes back.

## Energy bar charts

A bar chart shows each kind of energy at a chosen instant. For a 0.50 kg ball dropped from 2.0 m, with the ball–Earth system and the floor as zero (air resistance negligible):

| State | K | U_g | Total |
|---|---|---|---|
| Released (2.0 m) | 0 | 9.8 J | 9.8 J |
| Halfway (1.0 m) | 4.9 J | 4.9 J | 9.8 J |
| Just before landing | 9.8 J | 0 | 9.8 J |

If you choose the ball alone, the U_g column disappears, and an extra bar, "work done by gravity", shows energy coming in from outside. State your system before you draw.

## Common mistakes

- **Giving potential energy to a single object** ("the ball's potential energy"). Say "the ball–Earth system".
- **Thinking the value of U_g is physical.** Only ΔU_g is; the zero is your choice.
- **Using U_s = kx or ½kx** instead of ½kx², or using the spring's total length instead of its stretch from natural length.
- **Using mgh for large changes in altitude**, or dropping the minus sign in −Gm₁m₂/r and concluding that U decreases as objects separate.
- **Assigning potential energy to friction.** Friction is nonconservative; its work becomes internal (thermal) energy.
- **Reading the force from the value of U** instead of its slope: a large U with a flat graph means zero force.

## Self-check

1. A 2.0 kg cat jumps from the floor onto a 0.90 m counter. What is ΔU_g of the cat–Earth system?
2. A spring with k = 300 N/m is compressed 0.040 m. How much energy does it store? How much at 0.080 m?
3. Why does a system consisting only of a falling apple have no potential energy?
4. Two asteroids move apart until their separation triples. What happens to the magnitude of their gravitational potential energy, and does U increase or decrease?
5. On a U–x graph, U falls steeply from x = 1 m to x = 2 m and is flat from 2 m to 3 m. Where is the force largest, and which way does it point?

*Answers:* 1. (2.0)(9.8)(0.90) ≈ 17.6 J (about 18 J). 2. ½(300)(0.040)² = 0.24 J; four times as much, 0.96 J. 3. Potential energy is stored in the interaction between objects; with Earth outside the system, gravity is an external force doing work, not stored energy. 4. The magnitude drops to one third; because U is negative, it increases (toward zero). 5. Between 1 m and 2 m, pointing toward larger x (downhill on the graph); zero from 2 m to 3 m.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 3, Topic 3.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
