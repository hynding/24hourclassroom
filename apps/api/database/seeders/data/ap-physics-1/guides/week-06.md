# Week 06 · Newton's Third Law and Newton's First Law

**Topics:** 2.3 Newton's Third Law · 2.4 Newton's First Law
**Practices:** 1 (Creating Representations: paired free-body diagrams, component tables), 2 (Mathematical Routines: solving equilibrium equations), 3 (Scientific Questioning and Argumentation: identifying interaction pairs, arguing from the net force to the motion and back)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 2, Topics 2.3–2.4, learning objectives in our own words
**Spiral:** Week 5 taught you to pick a system, find its center of mass and draw a free-body diagram. This week gives two laws that read those diagrams. The third law says where forces come from (always in pairs, on two different objects). The first law says what happens when the forces on one object balance: its velocity does not change, whether that velocity is zero or not. Components from week 4 return in every equilibrium problem with angled ropes, and week 3's reference frames tell us where the first law holds.

## What you need to be able to do

- **2.3** State that when object A exerts a force on object B, B exerts a force on A that is equal in magnitude, opposite in direction and of the same type.
- **2.3** Identify the partner of any force, and explain why third-law partners never cancel (they act on different objects).
- **2.3** Distinguish a third-law pair from two forces that happen to balance on one object (such as F_g and F_N on a book).
- **2.4** State that an object's velocity is constant (including zero) if and only if the net external force on it is zero.
- **2.4** Use ΣFₓ = 0 and ΣF_y = 0 to find unknown forces on an object at rest or moving with constant velocity.
- **2.4** Explain what an inertial reference frame is and why the first law describes motion correctly only in one.

## Key terms

| Term | Meaning |
|---|---|
| Interaction | A mutual action between two objects; it always produces two forces, one on each object. |
| Third-law pair | The two forces of one interaction: F(A on B) and F(B on A), equal in size, opposite in direction, same type. |
| Net force (ΣF) | The vector sum of all external forces on an object or system. |
| Translational equilibrium | ΣF = 0: the velocity of the center of mass is constant (at rest, or moving in a straight line at constant speed). |
| Inertia | The tendency of an object to keep its velocity; measured by its mass. |
| Inertial reference frame | A frame that is not accelerating, in which an object with zero net force keeps a constant velocity. |
| Terminal speed | The constant speed reached by a falling object when air resistance grows to equal its weight. |

## Equations

| Relation | Symbols and SI units |
|---|---|
| F(A on B) = −F(B on A) | the two forces of one interaction (N); the minus sign means opposite direction |
| ΣF = 0 ⟺ v constant | ΣF net external force (N); v velocity of the center of mass (m/s) |
| ΣFₓ = 0 and ΣF_y = 0 | the equilibrium condition by components (N) |
| F_g = mg | gravitational force near Earth (N); m in kg; g = 9.8 m/s² |
| Symmetric hanging load: T = mg/(2 sin θ) | T tension in each of two cords (N); θ angle of each cord above the horizontal |

## Newton's third law (2.3)

Week 5 called a force an interaction. The third law makes that exact: **an interaction always produces two forces, one on each object, equal in magnitude and opposite in direction**. When your foot pushes backward on the ground, the ground pushes forward on your foot; that forward push is what moves you. When Earth pulls a falling apple down with 1.0 N, the apple pulls Earth up with 1.0 N.

To name a partner, swap the two objects in the label: the partner of "the rope pulls the sled" is "the sled pulls the rope". Partners are always the **same type** of force (a normal force's partner is a normal force, a gravitational force's partner is gravitational) and they act on **different objects**, so they never appear on the same free-body diagram and never cancel each other.

**Worked example 1: whose force is whose?** A 2.0 kg book rests on a table that stands on the floor. List the forces on the book and the partner of each.

| Force on the book | Size | Its third-law partner |
|---|---|---|
| F_g: Earth pulls book down | 19.6 N | Book pulls Earth up (gravitational), 19.6 N |
| F_N: table pushes book up | 19.6 N | Book pushes table down (normal), 19.6 N |

The two forces on the book are equal and opposite, but they are **not** a third-law pair: they act on the same object, they are different types (one gravitational, one normal), and they are equal only because the book is in equilibrium. Put a hand on the book and press, and F_N grows while F_g stays at 19.6 N; each partner still matches its own force exactly.

**Worked example 2: the car and the truck.** A 1,200 kg car and a 9,000 kg truck collide head-on. During contact the truck exerts a force of 30,000 N on the car. What force does the car exert on the truck? Exactly **30,000 N**, opposite in direction. The forces are equal even though the outcomes are not: the same force on a mass 7.5 times smaller gives the car 7.5 times the change in velocity. (Next week the second law puts numbers on that.) "The bigger object pushes harder" is the most common third-law error; the forces of one interaction are always equal, whatever the masses or speeds.

**Tug of war.** If the forces between the two teams are equal, how does anyone win? Look at each team's FBD: each team is pulled by the rope and pushed by the ground (friction on their shoes). The team whose feet get the larger forward push from the ground (by pushing harder backward on the ground) has a net force toward its side.

## Newton's first law (2.4)

**If the net external force on an object is zero, its velocity does not change**: it stays at rest, or it keeps moving in a straight line at constant speed. And the converse: if the velocity is constant, the net force is zero. Motion does not need a force; *changes* in motion do. A hockey puck slides a long way on ice because almost no horizontal force acts on it, not because a "force of motion" carries it.

That makes "at rest" and "moving at constant velocity" the same problem: **translational equilibrium**, ΣFₓ = 0 and ΣF_y = 0. The routine:

1. Draw the FBD.
2. Choose axes; resolve angled forces.
3. Write ΣFₓ = 0 and ΣF_y = 0 and solve.
4. Check signs and limiting cases.

**Worked example 3: the lamp on two cords (equilibrium with components).** A 3.0 kg lamp hangs from two cords tied to the ceiling. Cord 1 makes 30° with the horizontal, cord 2 makes 60° with the horizontal on the other side. Find both tensions.

FBD in words: F_g = 29.4 N straight down; T₁ up and to the left at 30° above the horizontal; T₂ up and to the right at 60° above the horizontal.

| Force | x (N) | y (N) |
|---|---|---|
| T₁ | −T₁ cos 30° | +T₁ sin 30° |
| T₂ | +T₂ cos 60° | +T₂ sin 60° |
| F_g | 0 | −29.4 |

ΣFₓ = 0 gives T₁ cos 30° = T₂ cos 60°, so T₂ = 1.73 T₁. ΣF_y = 0 gives 0.500 T₁ + 0.866 T₂ = 29.4. Substituting: 0.500 T₁ + 1.50 T₁ = 29.4, so **T₁ = 14.7 N** and **T₂ ≈ 25.5 N**.

*Sense check:* the steeper cord is closer to vertical, so it carries more of the weight, and indeed T₂ is larger. Each tension is less than 29.4 N here, but that is not guaranteed; see the next example.

**Worked example 4: why a clothesline sags (functional dependence).** A load of mass m hangs from the middle of a line, each half making angle θ above the horizontal. By symmetry the two tensions are equal and the vertical balance gives 2T sin θ = mg, so

T = mg/(2 sin θ).

For an 8.0 kg sign with θ = 40°, T = 78.4/(2 · 0.643) ≈ **61 N**. Halve the angle toward flat and the tension climbs: at 15° it is about 151 N. As θ → 0, sin θ → 0 and T grows without limit: no line, however strong, can hold a weight perfectly straight. At θ = 90° (both cords vertical) T = mg/2, each cord holding half, which is the other limit to check.

**Worked example 5: the skydiver (equilibrium while moving).** A 70 kg skydiver falls at a steady 55 m/s. What is the air-resistance force? The velocity is constant, so ΣF = 0: F_air = mg = 70 · 9.8 = **686 N** upward. Notice that the speed did not enter the answer. Before reaching terminal speed, F_air was smaller than 686 N and the skydiver was speeding up; the first law tells you only that **at** constant velocity the forces balance.

### Inertial reference frames

The first law holds in an **inertial reference frame**: one that is not accelerating. The ground is very nearly inertial for everyday motion. Inside a train that is speeding up, a ball on the floor starts rolling toward the back with nothing pushing it: in the train's frame the first law seems to fail. In the ground's frame nothing is odd: no horizontal force acts on the ball, so it keeps its velocity while the train speeds up under it. In AP Physics 1, always analyse forces from an inertial frame. A frame moving at constant velocity relative to the ground (a train cruising smoothly) is also inertial, which links back to week 3: every inertial observer agrees on the forces and on whether the net force is zero.

## Common mistakes

- **Cancelling third-law partners.** They act on different objects; only forces on the same object can be added on an FBD.
- **Calling F_g and F_N a third-law pair.** They act on the same object and are different types; they balance only in special cases.
- **"The heavier or faster object pushes harder."** One interaction, two equal forces, always.
- **"A moving object needs a net force in its direction."** At constant velocity the net force is zero.
- **"At rest means no forces."** It means the forces balance (ΣF = 0), not that there are none.
- **Forgetting the components.** On a sign hung by angled cables, the tension is larger than the vertical support it supplies.

## Self-check

1. A hammer drives a nail with a 500 N force. What force does the nail exert on the hammer?
2. Name the third-law partner of "the floor pushes up on the crate".
3. A 55 kg student rides an elevator moving up at a constant 2.0 m/s. What normal force does the floor exert on her?
4. A 12 kg traffic light hangs from the middle of a cable, each side 10° above the horizontal. Find the tension.
5. A passenger in a bus that brakes suddenly lurches forward. Which reference frame is non-inertial, and what really happened?

*Answers:* 1. 500 N, opposite in direction (back up along the nail). 2. The crate pushes down on the floor (a normal force). 3. Constant velocity, so ΣF = 0: F_N = mg = 539 N. 4. T = 117.6/(2 sin 10°) ≈ 339 N, almost three times the light's weight. 5. The braking bus is non-inertial. In the ground frame the passenger simply kept moving forward at the old velocity while the bus slowed; no forward force acted on her.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 2, Topics 2.3–2.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
