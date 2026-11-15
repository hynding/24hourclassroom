# Week 23 · Newton's Second Law in Rotational Form

**Topics:** 5.6 Newton's Second Law in Rotational Form
**Practices:** 1 (Creating Representations: free-body diagrams of a pulley and the objects tied to it, drawn as one connected picture), 2 (Mathematical Routines: writing Στ = Iα and ΣF = ma together, eliminating unknowns, and checking limiting cases), 3 (Scientific Questioning and Argumentation: designing a measurement of rotational inertia and interpreting a graph's slope)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 5, Topic 5.6, learning objectives in our own words
**Spiral:** Week 7 used ΣF = ma for a single object and for connected objects; week 19 gave θ, ω and α with the constant-α equations and a_t = rα; week 20 computed torques; week 21 found rotational inertia, including the parallel-axis theorem; week 22 set Στ = 0. This week the net torque is not zero, and it produces an angular acceleration.

## What you need to be able to do

- **5.6** State and apply Στ = Iα: the angular acceleration of a rigid object about a fixed axis is proportional to the net torque about that axis and inversely proportional to the rotational inertia about that axis.
- **5.6** Find α from the torques and I, then use the rotational kinematics of week 19 to predict angles and angular velocities.
- **5.6** Solve connected systems (a block hanging from a pulley with mass, an Atwood machine with a massive pulley, a block on a table pulled over a pulley) by writing one equation per object and linking them with a = rα.
- **5.6** Explain why the tension on either side of a pulley with mass is different, and why a hanging object accelerates at less than g.
- **5.6** Check results with limiting cases (massless pulley, very heavy pulley) and functional dependence (what happens if R, M or m doubles).
- **5.6** Design and analyse an experiment that measures rotational inertia from a graph of torque against angular acceleration.

## Key terms

| Term | Meaning |
|---|---|
| Net torque Στ | The sum of all torques about the axis, with signs for direction (N·m). |
| Rotational inertia I | Resistance to angular acceleration; depends on mass and how far it lies from the axis (kg·m²). |
| Angular acceleration α | Rate of change of angular velocity (rad/s²); the same for every point of a rigid object. |
| Fixed axis | An axle or pivot held in place, so the object can only rotate about it. |
| Non-slip condition | A string that does not slip on a pulley moves with the rim: a = Rα, v = Rω. |
| Massive pulley | A pulley whose rotational inertia matters; the string tension differs on its two sides. |

## Equations

| Relation | Symbols and units |
|---|---|
| α = Στ/I, or Στ = Iα | α in rad/s²; Στ in N·m about the axis; I in kg·m² about the same axis. |
| τ = rF sin θ | r in m, F in N, θ the angle between r and F. |
| a = Rα (string on a rim, no slipping) | a = linear acceleration of the string (m/s²); R = radius where the string leaves the pulley (m). |
| ΣF = ma | For each object that moves without rotating. |
| ω = ω₀ + αt, Δθ = ω₀t + ½αt², ω² = ω₀² + 2αΔθ | Constant α only; ω in rad/s, θ in rad, t in s. |
| I_disk = ½MR², I_hoop = MR², I_rod,end = (1/3)ML² | Values from the equation sheet; M in kg, R and L in m. |

## The law and its meaning (5.6)

Newton's second law says a net force changes an object's velocity, and the larger the mass, the smaller the change. The rotational version has the same shape:

**α = Στ/I.** The net torque about a fixed axis sets the angular acceleration about that axis; the rotational inertia resists it.

Three things to read out of it. First, the angular acceleration points the same way as the net torque (counterclockwise torque, counterclockwise α); it need not point the way the object is spinning, so a friction torque gives an α opposite to ω and the object slows down. Second, doubling the net torque doubles α; doubling I halves it. Third, a net torque changes ω; it does not set ω. A large torque applied for a short time can leave an object turning slowly.

**Worked example 1: pushing a merry-go-round.** A playground merry-go-round has rotational inertia 500 kg·m² and radius 2.0 m. A parent pushes tangentially at the rim with a steady 150 N force, and friction at the axle exerts an opposing torque of 50 N·m. Starting from rest, how fast is it turning after 5.0 s, and through what angle has it turned?

- Net torque: Στ = (2.0 m)(150 N) − 50 N·m = 300 − 50 = 250 N·m.
- α = Στ/I = 250/500 = **0.50 rad/s²**.
- ω = αt = (0.50)(5.0) = **2.5 rad/s**; Δθ = ½αt² = ½(0.50)(5.0)² = **6.25 rad**, about one full turn.

**Check:** if the children climb on and the rotational inertia doubles, the same push gives half the angular acceleration. If friction rose to 300 N·m, the net torque would be zero and the merry-go-round would not start: that is week 22's equilibrium.

## A block hanging from a pulley with mass (5.6)

Most AP problems tie a rotating object to one that moves in a straight line. The method is always the same: a separate free-body diagram and equation for each object, then the non-slip condition to link them.

**Worked example 2: the well bucket.** A 2.0 kg bucket hangs from a light rope wrapped around a solid cylinder (a winch drum) of mass 4.0 kg and radius 0.10 m that turns on a frictionless axle. The bucket is released from rest. Find its acceleration, the rope tension and the drum's angular acceleration.

**FBDs in words.** Bucket: an upward arrow T (rope) and a longer downward arrow F_g = mg = 19.6 N. Drum: a downward arrow T at the rim, 0.10 m from the axle, plus the drum's weight and the axle's force, both acting at the axle (zero lever arm).

- Bucket (down positive): mg − T = ma.
- Drum: TR = Iα = (½MR²)(a/R), so T = ½Ma.
- Add them: mg = (m + ½M)a, so **a = mg/(m + ½M)** = 19.6/(2.0 + 2.0) = **4.9 m/s²**.
- T = ½Ma = ½(4.0)(4.9) = **9.8 N**, half the bucket's weight. α = a/R = 4.9/0.10 = **49 rad/s²**.

**Limiting cases.** If the drum's mass M → 0, a → g: a massless pulley lets the bucket fall freely. If M is huge, a → 0 and the bucket barely moves. Both make sense, which is good evidence the algebra is right. Note too what is **not** in the result: R. A drum of the same mass but twice the radius gives the same linear acceleration (and half the angular acceleration), because the larger lever arm is exactly offset by the larger rotational inertia.

**Why T is less than mg.** If the rope pulled up on the bucket with its full weight, the bucket could not accelerate downward. The bucket accelerates, so T is less than mg; the drum's rotational inertia is what holds the tension above zero.

## Two objects and a massive pulley (5.6)

**Worked example 3: an Atwood machine with a heavy pulley.** Blocks of 5.0 kg and 3.0 kg hang on either side of a solid-disk pulley of mass 4.0 kg. The string does not slip and the axle is frictionless. Find the acceleration and both tensions.

Take the direction in which the 5.0 kg block falls as positive for the whole system.

- 5.0 kg block: m₁g − T₁ = m₁a. 3.0 kg block: T₂ − m₂g = m₂a. Pulley: (T₁ − T₂)R = (½MR²)(a/R), so T₁ − T₂ = ½Ma.
- Adding all three: (m₁ − m₂)g = (m₁ + m₂ + ½M)a, so a = (2.0)(9.8)/(5.0 + 3.0 + 2.0) = **1.96 m/s²**.
- T₁ = m₁(g − a) = 5.0(7.84) = **39.2 N**; T₂ = m₂(g + a) = 3.0(11.76) = **35.3 N**.

The tensions **differ** by ½Ma = 3.92 N. That difference is what produces the net torque on the pulley. With a massless pulley (M = 0) the tensions would be equal and a would be (m₁ − m₂)g/(m₁ + m₂) = 2.45 m/s²: a heavy pulley slows the system, as it should. The rule "the tension is the same all along a string" holds only when the pulley's rotational inertia is negligible.

A useful reading of the result: the numerator is the net driving force, (m₁ − m₂)g, and the denominator is everything that has to be accelerated, with the pulley counting as an "effective mass" of I/R² = ½M.

## The falling rod (5.6)

**Worked example 4: a meter stick tipping over.** A uniform meter stick (L = 1.0 m) is hinged at one end and held horizontal, then released. Find its angular acceleration at the moment of release and the linear acceleration of its free end.

- The only torque about the hinge is from gravity, acting at the centre: τ = Mg(L/2). The hinge force has no lever arm.
- I about the end = (1/3)ML², so α = Mg(L/2)/((1/3)ML²) = **3g/(2L)** = 3(9.8)/(2 × 1.0) = **14.7 rad/s²**.
- Free end: a_t = αL = (3/2)g = **14.7 m/s²**, more than g.

**Functional dependence.** α ∝ 1/L: a longer stick tips with a smaller angular acceleration, which is why it is easier to balance a long pole on your hand than a short pencil. Mass cancels completely. And the tip really does outrun free fall: a coin resting on the far end is left behind as the stick drops away from it.

## Measuring rotational inertia in the lab (5.6)

**Worked example 5: a turntable.** A lab group winds a string around a spool of radius 0.020 m fixed to a turntable, runs it over a light pulley, and hangs a mass m from it. They time the mass falling 0.60 m from rest, for four masses. They compute a = 2h/t², α = a/r and the string tension's torque τ = m(g − a)r. Invented data:

| m (kg) | t (s) | a (m/s²) | α (rad/s²) | τ (N·m) |
|---|---|---|---|---|
| 0.050 | 15.8 | 0.00481 | 0.240 | 0.00980 |
| 0.100 | 11.0 | 0.00992 | 0.496 | 0.0196 |
| 0.150 | 9.1 | 0.0145 | 0.725 | 0.0294 |
| 0.200 | 7.8 | 0.0197 | 0.986 | 0.0391 |

Because τ = Iα, a graph of **τ (vertical) against α (horizontal)** should be a straight line through the origin with **slope I**. The best-fit line has slope ≈ 0.0396 kg·m² and an intercept of only 0.0002 N·m, so **I ≈ 0.040 kg·m²**. A clearly positive intercept would reveal a friction torque in the axle: the hanging mass would have to supply that torque before the turntable accelerated at all. To reduce uncertainty, the group should time several drops for each mass and average, use a longer drop, and check that the string leaves the spool horizontally (so all of the tension is perpendicular to the radius).

## Common mistakes

- **Setting the tension equal to the hanging weight.** A hanging object that accelerates downward has T less than mg.
- **Using the same tension on both sides of a massive pulley.** The difference in tensions is what turns it.
- **Mixing axes:** computing τ about one point and I about another. Both must be about the same axis.
- **Using the wrong I.** A disk is ½MR², a hoop MR², a rod about its end (1/3)ML²; use the parallel-axis theorem for other axes.
- **Confusing α with ω.** A net torque makes ω change; it does not make ω large.
- **Forgetting that a and α are linked only at the radius where the string leaves:** a = Rα with R the spool or rim radius, not some other radius.

## Self-check

1. A grinding wheel (I = 0.40 kg·m²) spinning at 30 rad/s is brought to rest by a constant friction torque in 12 s. What is the friction torque?
2. In worked example 2, the drum is replaced by a thin hoop of the same mass and radius. Find the bucket's acceleration.
3. Which way does α point for a wheel spinning counterclockwise while a brake pad presses on it?
4. In worked example 3, which tension is larger, and why must it be?
5. In worked example 5, what would the graph look like if the axle had a friction torque of 0.002 N·m?
6. A rod hinged at one end is released from horizontal. If its length doubles, what happens to α and to the free end's linear acceleration?

*Answers:* 1. α = 30/12 = 2.5 rad/s², τ = Iα = 0.40 × 2.5 = 1.0 N·m. 2. Now T = Ma (I = MR²), so a = mg/(m + M) = 19.6/6.0 ≈ 3.27 m/s², smaller than 4.9 m/s² because a hoop has more rotational inertia. 3. Clockwise, opposite to ω, because the friction torque is clockwise; the wheel slows. 4. T₁ (on the 5.0 kg side, 39.2 N) is larger: the pulley accelerates in the direction the heavier block falls, so the net torque on it must point that way. 5. Still a straight line with slope I, but shifted up: a vertical intercept of about 0.002 N·m. 6. α = 3g/(2L) halves; the end's acceleration αL = 1.5g stays the same.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 5, Topic 5.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
