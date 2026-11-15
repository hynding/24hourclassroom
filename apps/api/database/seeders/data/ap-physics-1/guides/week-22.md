# Week 22 · Rotational Equilibrium and Newton's First Law in Rotational Form

**Topics:** 5.5 Rotational Equilibrium and Newton's First Law in Rotational Form
**Practices:** 1 (Creating Representations: free-body diagrams of extended objects, with each force drawn where it acts), 2 (Mathematical Routines: writing and solving ΣF = 0 and Στ = 0 together), 3 (Scientific Questioning and Argumentation: predicting how support forces change and justifying the prediction with torques)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 5, Topic 5.5, learning objectives in our own words
**Spiral:** Week 6 met Newton's first law for a point object (no net force, no change in velocity). Weeks 19–21 built the rotational toolkit: angular velocity and acceleration, torque τ = rF sin θ with its lever arm, and rotational inertia. This week puts the pieces together for objects that stay at rest or spin steadily: the net force **and** the net torque are both zero.

## What you need to be able to do

- **5.5** State Newton's first law in rotational form: if the net torque on a rigid object about an axis is zero, its angular velocity about that axis stays constant (zero, if it starts at rest).
- **5.5** Draw a free-body diagram of an extended object with every force at its point of application, and the weight at the centre of mass.
- **5.5** Write both equilibrium conditions, ΣF = 0 (in each direction) and Στ = 0, and solve them for unknown forces or positions.
- **5.5** Choose the axis for the torque sum wisely: through the point where the most unknown forces act.
- **5.5** Predict, and justify with torques, how support forces change when a load moves, including when an object is about to tip.
- **5.5** Recognise a situation in translational equilibrium but not rotational equilibrium (a couple), and one rotating at constant angular velocity (dynamic rotational equilibrium).

## Key terms

| Term | Meaning |
|---|---|
| Rigid object | An object whose shape does not change, so every part turns through the same angle. |
| Translational equilibrium | ΣF = 0: the centre of mass has constant velocity. |
| Rotational equilibrium | Στ = 0 about an axis: the angular velocity about that axis is constant. |
| Static equilibrium | Both conditions hold and the object is at rest. |
| Lever arm | The perpendicular distance from the axis to the line of action of a force. |
| Couple | Two equal and opposite forces whose lines of action do not coincide: zero net force, nonzero net torque. |
| Tipping point | The position of a load at which one support force falls to zero; any farther and the object rotates. |

## Equations

| Relation | Symbols and units |
|---|---|
| ΣFₓ = 0 and ΣF_y = 0 | Forces in newtons (N), resolved into components. |
| Στ = 0 | Net torque in newton-metres (N·m) about any chosen axis; counterclockwise positive, clockwise negative. |
| τ = rF sin θ = r⊥F | r = distance from axis to where the force acts (m); F = force (N); θ = angle between r and F; r⊥ = lever arm (m). |
| F_g = mg | Weight (N) of mass m (kg), acting at the centre of mass; g = 9.8 m/s². |

## Newton's first law in rotational form (5.5)

For a point object, "no net force" means "no change in velocity". The rotational version reads the same way: **if the net torque on a rigid object about an axis is zero, its angular velocity about that axis does not change.** A seesaw balanced at rest stays at rest. A ceiling fan turning at a steady 12 rad/s also has zero net torque: the motor's torque exactly cancels the torque from air drag. The common misconception is that a spinning object needs a net torque to keep spinning. It does not; it needs a net torque only to spin faster or slower.

An extended object can be in one kind of equilibrium without the other. Push the two sides of a steering wheel with equal forces in opposite directions: the net force is zero (the wheel's centre does not move), but both forces turn the wheel the same way, so the net torque is not zero. That pair is a **couple**. Conversely, a bicycle wheel spun on a stand and slowing only because you press the brake on its rim with a steady force has a net torque (it is not in rotational equilibrium) while its centre stays put (it is in translational equilibrium, because the axle pushes back). To call an object in **static equilibrium** you need both conditions and no motion at all.

### Choosing the axis

Because the net force is zero, the net torque is zero about **every** axis, not just a real hinge. That freedom is the main problem-solving tool: put the axis where an unknown force acts, and that force drops out of the torque equation (its lever arm is zero). With two unknown support forces, take torques about one support to find the other, then use ΣF_y = 0 (or a second torque sum) for the first.

**Worked example 1: the seesaw.** A uniform 12 kg plank is balanced on a pivot at its centre. A 28 kg child sits 1.5 m to the left of the pivot. Where must a 35 kg child sit, and how hard does the pivot push up?

- **FBD in words:** the plank feels a downward force of 28g at 1.5 m left, a downward force of 35g at distance x right, its own weight 12g downward at the pivot (its centre of mass), and an upward normal force F_P from the pivot.
- **Torques about the pivot:** the plank's weight and F_P act at the axis, so they exert no torque. Counterclockwise (left child) equals clockwise (right child): 28g(1.5) = 35g·x, so x = 28(1.5)/35 = **1.2 m** right of the pivot. Notice g cancels: balance depends on masses and distances only.
- **Forces:** F_P = (28 + 35 + 12)(9.8) = **735 N** upward.

**Check:** the heavier child sits closer, by the inverse ratio of masses (35/28 = 1.5/1.2 = 1.25). If the two children had equal mass, x would equal 1.5 m, as symmetry demands.

## Supports, loads and tipping (5.5)

**Worked example 2: the painter's scaffold.** A uniform board 4.0 m long with mass 20 kg rests on supports at its two ends. A 70 kg painter stands 1.0 m from the left end. Find the support forces.

**FBD in words:** an upward arrow F_L at the left end; an upward arrow F_R at the right end; a downward arrow labelled F_g,board = 196 N at the centre (2.0 m from the left); a downward arrow labelled F_g,painter = 686 N at 1.0 m from the left. (The painter pushes on the board with a normal force equal to her weight, because she is in equilibrium too.)

- **Torques about the left end** (F_L drops out): F_R(4.0) = 196(2.0) + 686(1.0) = 1078 N·m, so F_R = **269.5 N ≈ 270 N**.
- **Forces:** F_L = 196 + 686 − 269.5 = **612.5 N ≈ 613 N**.

The support nearer the painter carries more of her weight. The table shows the pattern as she walks along the board:

| Painter's distance from left end (m) | 0 | 1.0 | 2.0 | 3.0 | 4.0 |
|---|---|---|---|---|---|
| F_L (N) | 784 | 612.5 | 441 | 269.5 | 98 |
| F_R (N) | 98 | 269.5 | 441 | 612.5 | 784 |

Each support force changes **linearly** with her position, the two always add to 882 N, and at either end the far support holds only half the board's weight (98 N). Those limiting cases are a good check on any algebra you write: with the painter at the left end, the symbolic result F_R = (m_board g L/2 + m_painter g x)/L gives F_R = m_board g/2, exactly as it should.

### When does it tip?

Move a support in from the end and a load past it can tip the board. At the tipping point, the far support force falls to **zero**, and the board pivots about the near support. To find how far a load can go, set the far support force to zero and take torques about the near support: the load's torque on one side must not exceed the board's own weight torque on the other. This is the reasoning behind wide-based ladders, outriggers on cranes and counterweights on tower cranes.

## Forces at angles: hinged beams and cables (5.5)

**Worked example 3: the hanging sign.** A uniform horizontal beam 1.5 m long with mass 6.0 kg is hinged to a wall at its left end. A cable from its right end runs up to the wall at 40° above the horizontal. A 10 kg sign hangs from the right end. Find the cable tension and the force from the hinge.

**FBD in words:** at the hinge, a force with unknown horizontal component H_x (pointing away from the wall) and vertical component H_y; at the centre, a downward weight 6.0g = 58.8 N; at the right end, a downward force 10g = 98 N from the sign's cord and the cable tension T pulling up and to the left at 40° above horizontal.

- **Torques about the hinge** (H_x and H_y drop out). Only T's vertical component, T sin 40°, has a lever arm about the hinge at the beam's end (its horizontal component points along the beam, straight at the hinge):
  T sin 40° (1.5) = 58.8(0.75) + 98(1.5), so T = 191.1/(1.5 · 0.643) = **198 N**.
- **Horizontal forces:** H_x = T cos 40° = **152 N**, pushing the beam away from the wall.
- **Vertical forces:** H_y = 58.8 + 98 − T sin 40° = 156.8 − 127.4 = **29.4 N** upward.

**Functional dependence.** The torque the cable must supply is fixed by the loads, and only T sin θ supplies it, so T ∝ 1/sin θ:

| Cable angle θ | 30° | 40° | 60° | 90° |
|---|---|---|---|---|
| T (N) | 255 | 198 | 147 | 127 |

A shallow cable has to pull very hard; as θ shrinks towards 0, T grows without limit, which is why a cable is never run along the beam. At 90° the cable is vertical, and T = 127 N, only the part of the load the hinge does not carry.

## Equilibrium in the lab (5.5)

**Worked example 4: weighing a meter stick with a pivot.** A lab group has no balance. They hang a 0.100 kg mass at the 5.0 cm mark of a uniform meter stick and slide the stick on a knife-edge until it balances, at the 30.0 cm mark. What is the stick's mass?

- The stick's weight acts at its centre, the 50.0 cm mark, 0.200 m from the pivot. The hanging mass is 0.250 m from the pivot on the other side.
- Στ = 0 about the knife-edge: (0.100)(g)(0.250) = m(g)(0.200), so m = **0.125 kg**.

To reduce uncertainty, the group should repeat with several different hanging masses, record each balance point, and graph the results: with x = the hanging mass's distance from the pivot and d = the stick's centre's distance from the pivot, a graph of the hanging mass M against d/x is a straight line through the origin whose slope is the stick's mass, since M x = m d.

## Common mistakes

- **Leaving out a force, or putting the weight in the wrong place.** The weight of a uniform object acts at its centre, not at a support or an end.
- **Forgetting the pivot or hinge force** in ΣF = 0. It drops out of the torque sum about the pivot, not out of the force sum.
- **Using the full distance instead of the lever arm** for a force at an angle (using cos where sin belongs). Ask which component is perpendicular to r.
- **Assuming each support carries half the load.** Only a load at the centre of a symmetric setup does that.
- **Thinking a spinning object needs a net torque.** Constant angular velocity means zero net torque.
- **Treating ΣF = 0 as enough.** A couple has zero net force and still turns the object.

## Self-check

1. A uniform 2.0 m plank of mass 10 kg pivots at its centre. A 3.0 kg cat sits 0.80 m left of the pivot. Where must a 4.0 kg cat sit for balance?
2. A ceiling fan turns at a constant rate. What is the net torque on its blades? What two torques are acting?
3. In worked example 2, the painter stands 3.0 m from the left end. Find F_L and F_R.
4. Why does the tension in a cable holding a horizontal beam increase as the cable is made more nearly horizontal?
5. A uniform 4.0 m, 12 kg ladder leans against a frictionless wall, making 65° with the floor. How large a friction force must the floor supply?
6. Does the hinge force appear in the torque sum about the hinge? In ΣF = 0?

*Answers:* 1. 3.0(0.80) = 4.0x, so x = 0.60 m right of the pivot (the plank's weight acts at the pivot). 2. Zero: the motor's torque is equal and opposite to the drag torque from the air. 3. F_R = (196 · 2.0 + 686 · 3.0)/4.0 = 612.5 N and F_L = 882 − 612.5 = 269.5 N, the mirror image of the 1.0 m case. 4. Only the cable's perpendicular component, T sin θ, exerts a torque about the hinge, and the required torque is fixed by the loads, so a smaller θ needs a larger T. 5. Torques about the foot: the wall force N_w satisfies N_w L sin 65° = mg(L/2) cos 65°, so N_w = mg/(2 tan 65°) ≈ 27.4 N; the floor's friction balances it, f ≈ 27.4 N. 6. Not in the torque sum (zero lever arm about its own point), but yes in ΣF = 0.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 5, Topic 5.5). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
