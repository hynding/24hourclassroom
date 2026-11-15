# Week 09 · Kinetic and Static Friction

**Topics:** 2.7 Kinetic and Static Friction
**Practices:** 1 (Creating Representations: free-body diagrams with friction, force-sensor graphs), 2 (Mathematical Routines: F_f = μF_N, Newton's second law with friction on flat and tilted surfaces), 3 (Scientific Questioning and Argumentation: deciding whether an object slips, and what friction depends on)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 2, Topic 2.7, learning objectives in our own words
**Spiral:** Week 5 chose systems and drew free-body diagrams; week 6 paired forces by Newton's third law and balanced them by the first law; week 7 used ΣF = ma; week 8 gave the weight F_g = mg. This week adds the force that surfaces exert along their contact, and it is the first force whose size you often cannot write down until you know whether the object moves.

## What you need to be able to do

- **2.7** Explain friction as the component of the contact force parallel to the surface, and the normal force as the component perpendicular to it.
- **2.7** Tell static friction (no sliding between the surfaces) from kinetic friction (sliding), and give the direction of each.
- **2.7** Use F_f,k = μ_k F_N for sliding and F_f,s ≤ μ_s F_N for gripping, knowing that static friction takes whatever value (up to its maximum) the other forces require.
- **2.7** Find the normal force from the perpendicular direction first: it equals mg only on a flat surface with no other vertical forces.
- **2.7** Apply Newton's second law with friction on level surfaces, with angled pulls, and on inclines, and decide whether an object starts to slide.
- **2.7** Read a force-sensor graph (a peak, then a lower steady value) and design an experiment that measures μ_s and μ_k from the slope of a friction-versus-normal-force graph.

## Key terms

| Term | Meaning |
|---|---|
| Normal force F_N | The part of a contact force perpendicular to the surface; it adjusts to stop objects passing through each other. |
| Friction F_f | The part of a contact force parallel to the surface; it opposes relative sliding (or the tendency to slide) between the two surfaces. |
| Static friction | Friction between surfaces that are not sliding relative to each other; any size from 0 up to μ_s F_N. |
| Kinetic friction | Friction between surfaces sliding over each other; size μ_k F_N, roughly independent of speed and contact area. |
| Coefficient of static friction μ_s | Dimensionless ratio of the maximum static friction to the normal force for a pair of surfaces. |
| Coefficient of kinetic friction μ_k | Dimensionless ratio of kinetic friction to the normal force; usually less than μ_s. |
| Impending motion | The instant just before slipping, when static friction is at its maximum μ_s F_N. |

## Equations

| Relation | Symbols and units |
|---|---|
| F_f,k = μ_k F_N | F_f,k kinetic friction (N); μ_k coefficient (no unit); F_N normal force (N) |
| F_f,s ≤ μ_s F_N | F_f,s static friction (N); equality only at the point of slipping |
| ΣF = ma, applied separately along and perpendicular to the surface | m mass (kg); a acceleration (m/s²) |
| On an incline of angle θ: F_g,parallel = mg sin θ, F_g,perpendicular = mg cos θ | θ angle of the incline above horizontal; g = 9.8 m/s² |
| Slipping angle: tan θ = μ_s; constant-speed sliding angle: tan θ = μ_k | holds for a block on an incline with only gravity, normal force and friction |

## Friction is part of the contact force (2.7)

When two surfaces touch, each pushes on the other with one contact force. We split it into two perpendicular components: the **normal force**, perpendicular to the surface, and **friction**, along it. Microscopically, friction comes from the electromagnetic attraction and interlocking of the high points of two surfaces; for this course, the model is two empirical rules.

**Static friction** acts when the surfaces do not slide over each other. It points opposite to the way the object *would* slide if the surface were frictionless, and its size is whatever keeps the surfaces from slipping, up to a maximum: F_f,s ≤ μ_s F_N. Push a heavy bookcase gently with 40 N and the floor pushes back with 40 N of static friction; push with 90 N and, if the maximum is 120 N, friction becomes 90 N. Static friction is a "responsive" force, like the normal force and tension.

**Kinetic friction** acts once the surfaces slide. It points opposite to the velocity of the object *relative to the surface*, and its size is F_f,k = μ_k F_N, independent (to a good approximation) of the speed and of the area in contact. For most pairs μ_k is less than μ_s, so it takes a bigger push to start a box moving than to keep it moving.

Two consequences students miss. First, **friction can point in the direction of motion**: when you walk forward, your foot pushes back on the ground and static friction from the ground pushes you forward; the crate in the bed of an accelerating truck is pushed forward by static friction. Second, both rules use the **normal force**, not the weight. They are equal only on a level surface with no other vertical forces.

**Worked example 1: reading a force-sensor pull.** A lab group ties a 0.40 kg sneaker to a force sensor and pulls horizontally, slowly at first, across a gym floor. The sensor readings:

| Time (s) | 0.0 | 0.5 | 1.0 | 1.5 | 2.0 | 2.5 | 3.0 |
|---|---|---|---|---|---|---|---|
| Force (N) | 0.0 | 1.2 | 2.4 | 3.3 | 2.6 | 2.6 | 2.6 |

The force rises while the sneaker stays put (static friction matching the pull), peaks at 3.3 N at the moment it breaks free, then settles at 2.6 N while it slides at constant velocity (kinetic friction balancing the pull, by the first law). F_N = mg = 0.40 × 9.8 = 3.92 N, so μ_s = 3.3/3.92 ≈ 0.84 and μ_k = 2.6/3.92 ≈ 0.66. At t = 0.5 s, the static friction is 1.2 N, not 3.3 N: the maximum is reached only at the peak.

**Measuring μ_k well.** One pull gives one ratio. A better design adds known masses to the object, measures the constant-velocity pulling force at each total mass, and graphs friction (vertical) against normal force (horizontal). Ideal data fall on a straight line through the origin; the **slope is μ_k**. Several points reduce the effect of random error in any one reading, and a non-zero intercept reveals a systematic error such as a sensor that was not zeroed. Pull parallel to the surface, or the normal force is no longer mg.

## Newton's second law with friction (2.7)

The routine never changes: choose the object, draw its free-body diagram, choose axes along and perpendicular to the surface, and write ΣF = ma for each axis. Find F_N from the perpendicular axis **before** you write any friction.

**Worked example 2: an angled pull.** A traveller pulls an 18 kg suitcase across a level floor with a strap at 40° above horizontal and a tension of 75 N. The coefficient of kinetic friction is 0.30.

*Free-body diagram (in words):* a downward arrow F_g = 176.4 N; an upward arrow F_N; a horizontal arrow F_f pointing backward; an arrow T = 75 N pointing forward and up at 40°.

- Vertical: F_N + T sin 40° − mg = 0, so F_N = 176.4 − 48.2 = 128.2 N. The strap lifts part of the weight, so F_N is less than mg.
- Friction: F_f = μ_k F_N = 0.30 × 128.2 ≈ 38.5 N.
- Horizontal: T cos 40° − F_f = ma, so 57.5 − 38.5 = 18a, a ≈ 1.06 m/s².

Had the traveller pushed down at 40° on a handle instead, the vertical component would add to F_N and friction would grow: pushing down on a box makes it harder to slide.

**Worked example 3: the tilting book.** A phone rests on a hardcover book that a student slowly tilts. The phone starts to slide when the cover makes 24° with the horizontal.

At the point of slipping, along the incline mg sin θ = μ_s F_N and perpendicular F_N = mg cos θ. Dividing, **μ_s = tan θ = tan 24° ≈ 0.45**. Mass cancels: a heavier phone of the same case material slips at the same angle.

If the coefficient of kinetic friction is 0.30, the phone's acceleration once it slides at 24° is a = g(sin θ − μ_k cos θ) = 9.8 × (0.407 − 0.274) ≈ 1.3 m/s² down the cover. *Limiting cases:* with μ_k = 0 this becomes g sin θ (the frictionless ramp); with tan θ = μ_k it gives a = 0, constant-speed sliding; and when θ is 90°, F_N is zero and a = g, free fall alongside a vertical wall.

## Static friction that accelerates things (2.7)

**Worked example 4: the crate in the truck.** A crate sits in the bed of a pickup truck; μ_s between crate and bed is 0.40. What is the largest acceleration the truck can have without the crate sliding?

The only horizontal force on the crate is static friction, which must point **forward** (the bed drags the crate along). Its maximum is μ_s mg, so the crate's largest acceleration is a_max = μ_s mg/m = μ_s g = 0.40 × 9.8 ≈ 3.9 m/s². Functional dependence: the mass cancels, so a full crate and an empty one slip at the same acceleration. As μ_s → 0 the allowed acceleration goes to zero, as it should on ice.

**Worked example 5: stopping distance with locked wheels.** A cyclist moving at 8.0 m/s locks both wheels and skids to a stop on dry pavement with μ_k = 0.60. The only horizontal force is kinetic friction, so a = μ_k g = 5.88 m/s² opposite the motion. From v² = v₀² + 2aΔx: 0 = 64 − 2(5.88)Δx, so Δx ≈ 5.4 m.

| Starting speed (m/s) | 8.0 | 16.0 |
|---|---|---|
| Stopping distance (m) | 5.4 | 21.8 |

Doubling the speed quadruples the distance (Δx = v₀²/(2μ_k g)), and the mass does not appear at all: a loaded bike with the same tyres stops in the same distance.

## Common mistakes

- Writing F_N = mg for an angled pull, a push with a downward component, an incline (F_N = mg cos θ) or an accelerating elevator.
- Setting static friction equal to μ_s F_N when nothing is about to slip. Use the second law to find what friction must be, then check it against the maximum.
- Pointing friction opposite the object's motion when the object moves with the surface: the truck crate and the walker's foot get forward friction.
- Thinking kinetic friction grows with speed or contact area. In this model it depends only on μ_k and F_N.
- Using μ_k before the object slides, or μ_s after it does.
- Putting friction from the floor and friction from the box on the same free-body diagram: they are a third-law pair acting on different objects.

## Self-check

1. A 6.0 kg box sits on a level floor with μ_s = 0.50. A student pushes horizontally with 20 N. What is the friction force?
2. The same box slides with μ_k = 0.35 under a 25 N horizontal push. What is its acceleration?
3. A sled is pulled by a rope angled above the horizontal. Is the normal force greater than, less than or equal to mg?
4. A block slides down a ramp at constant speed when the ramp is at 19°. What is μ_k?
5. Why does a car with anti-lock brakes usually stop in a shorter distance than one whose wheels lock?

*Answers:* 1. The maximum is 0.50 × 58.8 = 29.4 N, more than the push, so the box stays put and static friction is 20 N. 2. F_f = 0.35 × 58.8 = 20.6 N; a = (25 − 20.6)/6.0 ≈ 0.73 m/s². 3. Less: the rope's upward component carries part of the weight. 4. μ_k = tan 19° ≈ 0.34. 5. Rolling tyres grip with static friction, whose maximum μ_s F_N is larger than the kinetic friction μ_k F_N of skidding tyres, so the largest possible deceleration is greater.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 2, Topic 2.7). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
