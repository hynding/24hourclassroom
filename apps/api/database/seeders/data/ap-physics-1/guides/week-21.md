# Week 21 · Rotational Inertia

**Topics:** 5.4 Rotational Inertia
**Practices:** 1 (Creating Representations: describing a mass distribution relative to an axis, tables of contributions), 2 (Mathematical Routines: I = Σmr², adding the rotational inertias of parts, the parallel axis theorem), 3 (Scientific Questioning and Argumentation: ranking objects by rotational inertia, predicting how I changes when mass moves, linearising lab data)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 5, Topic 5.4, learning objectives in our own words
**Spiral:** Week 5 located a system's centre of mass; week 7's second law treated mass as a measure of how hard it is to change an object's velocity; week 19 described rotation and week 20 the torques that change it. This week supplies the rotational partner of mass: a measure of how hard it is to change an object's angular velocity, which depends not only on how much mass there is but on where it sits relative to the axis.

## What you need to be able to do

- **5.4** Explain that rotational inertia measures a rigid object's resistance to changes in its rotation about a given axis, and that it depends on the mass and on how that mass is distributed relative to the axis.
- **5.4** Calculate the rotational inertia of a point mass (I = mr²) and of a system of point masses (I = Σmᵢrᵢ²).
- **5.4** Find the rotational inertia of a system by adding the rotational inertias of its parts about the same axis, using given expressions for shapes such as rods, discs and hoops.
- **5.4** Use the parallel axis theorem, I = I_cm + Md², to find the rotational inertia about an axis parallel to one through the centre of mass.
- **5.4** Rank objects by rotational inertia and predict how I changes when mass is added, removed or moved closer to or farther from the axis.

## Key terms

| Term | Meaning |
|---|---|
| Rotational inertia I | Resistance of an object to a change in its angular velocity about a given axis; in kg·m². Also called moment of inertia. |
| Point mass | An object small compared with its distance from the axis, so all its mass sits at one distance r. |
| Mass distribution | Where the mass of an object is located relative to the axis. |
| Axis through the centre of mass | The axis about which a rigid object has its smallest rotational inertia for that direction. |
| Parallel axis theorem | I about any axis = I about the parallel axis through the centre of mass + Md². |
| d | The perpendicular distance between the two parallel axes. |
| Rigid system | A collection of objects held at fixed distances from one another, which rotate together. |

## Equations

| Relation | Symbols and SI units |
|---|---|
| I = mr² | I rotational inertia (kg·m²), m point mass (kg), r its perpendicular distance from the axis (m) |
| I = Σmᵢrᵢ² | sum over every particle i of the system |
| I_total = I₁ + I₂ + … | rotational inertias of parts add, all about the same axis |
| I = I_cm + Md² | I_cm rotational inertia about a parallel axis through the centre of mass (kg·m²), M total mass (kg), d distance between the axes (m) |
| Hoop or thin ring about its centre: I = MR² | M mass (kg), R radius (m); given on an exam, not memorised |
| Solid disc about its centre: I = ½MR² | given on an exam |
| Uniform rod about its centre: I = (1/12)ML²; about one end: (1/3)ML² | L length (m); given on an exam |

The AP exam supplies the expression for any extended shape you need. What you must know is how to use one, how to add them, and why a hoop's coefficient is larger than a disc's.

## What rotational inertia means (5.4)

Push a shopping cart and a loaded truck with the same force, and the cart's velocity changes much more: the truck has more inertial mass. Rotation has a partner idea. Hold a metre stick at its middle and twist it back and forth: easy. Tape a heavy wrench to each end and twist again: much harder, even though the extra mass is the same whichever way you hold it. Slide the wrenches to the middle and it becomes easy again. **Rotational inertia** depends on the mass *and* on how far that mass is from the axis.

For a single small object at distance r from the axis, I = mr². Distance enters **squared**: a mass twice as far out contributes four times as much. For anything else, split it into pieces, find each piece's mr², and add: I = Σmr². The distance r is always the **perpendicular distance from the axis**, not the distance from some end or from the centre of mass unless the axis is there.

Two consequences follow straight from the sum:

- **The same object has different rotational inertias about different axes.** The question "what is I?" is incomplete until you name the axis.
- **Mass on the axis contributes nothing.** A bead sitting at r = 0 adds mass but no rotational inertia.

**Worked example 1: a dumbbell about two axes.** Two 2.0 kg balls are fixed to the ends of a light rod 0.60 m long. Treat the balls as point masses.

| Axis | r of ball 1 (m) | r of ball 2 (m) | I = Σmr² (kg·m²) |
|---|---|---|---|
| Through the centre, perpendicular to the rod | 0.30 | 0.30 | 2.0(0.30)² + 2.0(0.30)² = 0.36 |
| Through one ball, perpendicular to the rod | 0 | 0.60 | 0 + 2.0(0.60)² = 0.72 |
| Along the rod | 0 | 0 | 0 (point masses on the axis) |

The same 4.0 kg system has three different rotational inertias. Moving the axis from the centre to one end doubles I, because one ball moves twice as far out and its squared distance grows by a factor of 4, while the other drops to zero.

## Adding parts and comparing shapes (5.4)

Because I is a sum, the rotational inertia of a system is the sum of its parts' rotational inertias about the same axis. A merry-go-round with a child on it is "disc + point mass"; a bicycle wheel is roughly "hoop (rim and tyre) + light spokes".

**Worked example 2: a merry-go-round with a rider.** A playground merry-go-round is a solid disc of mass 180 kg and radius 2.0 m (I = ½MR², given). A 40 kg child sits on it.

| Part | Expression | I (kg·m²) |
|---|---|---|
| Disc | ½(180)(2.0)² | 360 |
| Child at the rim (r = 2.0 m) | (40)(2.0)² | 160 |
| Total, child at rim | | 520 |
| Child moved to r = 1.0 m | (40)(1.0)² | 40 |
| Total, child at 1.0 m | | 400 |

Moving the same child halfway in cuts the child's contribution to a quarter and the system's total from 520 to 400 kg·m². Nothing about the mass changed: only its distribution.

**Shapes with the same mass and radius.** A hoop puts all its mass at distance R from the centre, so I = MR². A solid disc of the same mass and radius has much of its mass closer to the centre, so its I is smaller: ½MR². Compare a 2.0 kg hoop and a 2.0 kg solid disc, both 0.30 m in radius:

| Object | Fraction of mass far from axis | I (kg·m²) |
|---|---|---|
| Hoop, I = MR² | all of it | 2.0(0.30)² = 0.18 |
| Solid disc, I = ½MR² | some | 0.09 |
| Point mass 2.0 kg on the axis | none | 0 |

The coefficient in front of MR² is a compact description of the mass distribution: 1 when all the mass is at the rim, smaller the more of it lies near the axis. It can never be more than 1 for an object whose mass all lies within R of the axis.

**Limiting-case checks.** Shrink a hoop's radius toward zero and I = MR² goes to zero: all the mass ends up on the axis. Make a dumbbell's rod longer and I grows with the square of the length. An expression for I that grows when mass moves inward has an error in it.

## The parallel axis theorem (5.4)

Often the rotational inertia you are given is about the centre of mass, but the object turns about some other axis parallel to it: a rod swinging from one end, a door on its hinges, a gymnast circling a bar. The **parallel axis theorem** connects the two:

I = I_cm + Md²,

where M is the object's total mass and d is the distance between the centre-of-mass axis and the new, parallel axis. Since Md² is never negative, **the rotational inertia about the centre of mass is the smallest** for any family of parallel axes.

**Worked example 3: a rod swung from different points.** A uniform rod has mass 1.2 kg and length 0.90 m, and I_cm = (1/12)ML² = (1/12)(1.2)(0.90)² = 0.081 kg·m² about a perpendicular axis through its centre.

- About a parallel axis through one end, d = 0.45 m: I = 0.081 + (1.2)(0.45)² = 0.081 + 0.243 = 0.324 kg·m². That matches the given (1/3)ML² = (1/3)(1.2)(0.81) = 0.324 kg·m², a useful check.
- About a parallel axis 0.20 m from the centre: I = 0.081 + (1.2)(0.20)² = 0.129 kg·m².

The theorem also confirms worked example 1: the dumbbell's I_cm = 0.36 kg·m², M = 4.0 kg, d = 0.30 m to a ball, so I = 0.36 + (4.0)(0.30)² = 0.72 kg·m². The same answer by two routes.

## Measuring rotational inertia: a lab representation (5.4)

**Worked example 4: linearising sliding-mass data.** A lab group mounts a light horizontal rod on a vertical axle with an apparatus that reports the system's rotational inertia. Two 0.25 kg collars slide along the rod; the group places them at equal distances d on either side of the axle and records I.

| d (m) | 0.05 | 0.10 | 0.15 | 0.20 | 0.25 |
|---|---|---|---|---|---|
| d² (m²) | 0.0025 | 0.0100 | 0.0225 | 0.0400 | 0.0625 |
| I (kg·m²) | 0.0134 | 0.0168 | 0.0234 | 0.0318 | 0.0434 |

The model is I = I_apparatus + 2md², so I against d² should be a straight line. A best-fit line has slope 0.50 kg and vertical intercept 0.012 kg·m². The slope should equal 2m = 2(0.25) = 0.50 kg, which it does; the intercept is the rotational inertia of the rod and axle (plus a little from the collars' own width), which the point-mass model leaves out. Graphing I against d instead would give a curve, and its slope would mean nothing simple. Choosing d² is the representational step that earns credit.

**Functional dependence.** If each collar had twice the mass, the slope would double. If the collars were moved from 0.10 m to 0.20 m, their contribution 2md² would quadruple (from 0.0050 to 0.020 kg·m²), even though the total I less than quadruples because of the fixed intercept.

## Why it matters: a preview

Rotational inertia plays the role in rotation that mass plays in translation. A given net torque produces a smaller angular acceleration for an object with a larger I, just as a given net force produces a smaller acceleration for a larger mass. A tightrope walker carries a long pole for this reason: its mass far from her body gives a large rotational inertia, so a small unbalanced torque tips her slowly enough to correct. Week 23 turns this into the rotational form of Newton's second law, and weeks 24–25 put I into rotational kinetic energy and angular momentum.

## Common mistakes

- **Leaving out the axis.** I has no single value for an object; always say "about which axis".
- **Forgetting to square r**, or using a diameter for a radius.
- **Measuring r from the wrong point**: r is the perpendicular distance from the axis to each piece of mass.
- **Adding rotational inertias about different axes.** Move every part's I to the same axis first (parallel axis theorem) and then add.
- **Using the parallel axis theorem from an axis that is not through the centre of mass.** The formula I = I_cm + Md² starts from I_cm only.
- **Thinking more mass always means more rotational inertia.** A lighter object with its mass farther out can have the larger I.

## Self-check

1. A 0.50 kg ball on a light string swings in a circle of radius 0.80 m. What is its rotational inertia about the centre?
2. Three 1.0 kg point masses sit on a light rod at 0.10 m, 0.20 m and 0.30 m from one end. What is I about that end?
3. A 3.0 kg hoop and a 3.0 kg solid disc have the same radius. Which has the larger rotational inertia about its centre, and by what factor?
4. A uniform rod has I_cm = 0.050 kg·m² and mass 0.60 kg. What is I about a parallel axis 0.25 m from its centre?
5. A figure skater pulls her arms in. What happens to her rotational inertia about her spin axis, and why?
6. If every distance in a rigid system is doubled and the masses are unchanged, by what factor does I change?

*Answers:* 1. I = (0.50)(0.80)² = 0.32 kg·m². 2. I = 1.0(0.10² + 0.20² + 0.30²) = 0.14 kg·m². 3. The hoop, twice as large (MR² against ½MR²). 4. I = 0.050 + (0.60)(0.25)² = 0.0875 ≈ 0.088 kg·m². 5. It decreases, because the mass of her arms moves closer to the axis and each piece's mr² shrinks. 6. It becomes 4 times as large, because r enters squared.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 5, Topic 5.4). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
