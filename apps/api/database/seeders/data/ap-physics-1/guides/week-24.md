# Week 24 · Rotational Kinetic Energy and Rotational Work

**Topics:** 6.1 Rotational Kinetic Energy · 6.2 Torque and Work
**Practices:** 1 (Creating Representations: energy bar charts for spinning systems), 2 (Mathematical Routines: K = ½Iω² and W = τΔθ), 3 (Scientific Questioning and Argumentation: predicting how energy depends on mass distribution and angular speed)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 6, Topics 6.1–6.2, learning objectives in our own words
**Spiral:** Weeks 12–15 built translational kinetic energy, work, potential energy and conservation of energy; weeks 19–23 gave angular displacement, velocity and acceleration, v = rω, torque, rotational inertia and τ_net = Iα. This week joins the two: a spinning object stores kinetic energy, and a torque acting through an angle does work on it.

## What you need to be able to do

- **6.1** Calculate the rotational kinetic energy of a rigid object, K = ½Iω², using its rotational inertia about the rotation axis.
- **6.1** Explain why two objects with the same mass and angular speed can have different kinetic energies (mass far from the axis means a larger I).
- **6.1** Include rotational kinetic energy in an energy bar chart and in a conservation-of-energy equation for a system with a spinning part (a pulley, a flywheel, a turntable).
- **6.1** Predict how K changes when ω, M or R changes ("if ω doubles, K quadruples").
- **6.2** Calculate the work done on a rigid object by a constant torque, W = τΔθ, with Δθ in radians.
- **6.2** Use the rotational work–energy theorem: the net work done by external torques equals the change in rotational kinetic energy.
- **6.2** Identify forces that do no rotational work (forces through the axis, forces on an object that does not turn) and torques that do negative work (friction, brakes).

## Key terms

| Term | Meaning |
|---|---|
| Rotational kinetic energy | The kinetic energy of a rigid object due to its rotation about an axis: K = ½Iω². |
| Rotational inertia I | The resistance to a change in rotation; depends on mass and on how far that mass is from the axis. |
| Rigid object | An object whose parts keep fixed distances from each other, so every part has the same ω. |
| Work done by a torque | The energy transferred to a rotating object by a torque acting through an angular displacement: W = τΔθ. |
| Rotational work–energy theorem | Net work done by external torques = ΔK_rot. |
| Energy bar chart | A table (or bar graph) of each energy store at two states, plus energy transferred in or out. |

## Equations

| Relation | Symbols and SI units |
|---|---|
| K = ½Iω² | K rotational kinetic energy (J); I rotational inertia about the axis (kg·m²); ω angular speed (rad/s) |
| I = Σmr² | m mass of each small piece (kg); r its perpendicular distance from the axis (m) |
| I = I_cm + Md² | parallel-axis theorem: I_cm about a parallel axis through the centre of mass; M total mass (kg); d distance between the axes (m) |
| W = τΔθ | W work (J); τ constant torque component along the axis (N·m); Δθ angular displacement (rad) |
| W_net = ΔK = ½Iω_f² − ½Iω_i² | for a rigid object rotating about a fixed axis |
| τ = rF sin θ | r distance from axis to the point the force acts (m); F force (N); θ angle between r and F |
| v = rω | v speed of a point at distance r from the axis (m/s) |

Rotational inertias you will meet (each about the axis named): point mass m at distance r: mr²; thin hoop about its centre: MR²; uniform solid disk or cylinder about its axis: ½MR²; uniform solid sphere about a diameter: (2/5)MR²; uniform thin rod about its centre: (1/12)ML²; about one end: (1/3)ML². Unless a problem gives an inertia, it will tell you the shape.

## Rotational kinetic energy (6.1)

Every particle in a spinning wheel is moving, so the wheel has kinetic energy even though its centre stays put. A particle at distance r from the axis has speed v = rω, so its kinetic energy is ½m(rω)² = ½(mr²)ω². Adding over all the particles gives ½(Σmr²)ω² = ½Iω². That is why rotational kinetic energy depends on the **same** mass distribution that sets rotational inertia: mass far from the axis moves fast and carries most of the energy.

Three facts follow at once:

- **Shape matters.** A hoop and a solid disk with the same mass M, radius R and ω do not have the same energy. The hoop's I = MR² is twice the disk's ½MR², so the hoop stores twice the kinetic energy.
- **Angular speed matters most.** K is proportional to ω². Doubling ω quadruples K; tripling ω multiplies K by 9.
- **Size matters too.** At fixed M and ω, K ∝ R² for any one shape, because I ∝ R².

A system can store kinetic energy in both forms at once. A falling block tied to a string wound on a pulley has translational kinetic energy ½mv², and the pulley has ½Iω². Both appear in the energy accounting, and both appear in the energy bar chart.

**Worked example 1: a potter's wheel.** A potter's wheel is a uniform solid disk of mass 12 kg and radius 0.18 m, spinning at 6.0 rad/s. Find its kinetic energy, then predict what happens to K if the potter doubles the angular speed.

- I = ½MR² = ½(12 kg)(0.18 m)² = 0.194 kg·m².
- K = ½Iω² = ½(0.194 kg·m²)(6.0 rad/s)² = 3.5 J.
- Doubling ω multiplies K by 2² = 4, giving about 14 J. The potter's foot (or the motor) must supply about 10.5 J more, three times the energy it took to get to 6.0 rad/s from rest.

The last point is a functional-dependence argument you should be able to make without numbers: going from ω to 2ω costs ½I(4ω² − ω²) = 3 × ½Iω².

**Worked example 2: a block falling from a massive pulley.** A 1.5 kg block hangs from a light string wound around a pulley that is a uniform disk of mass 2.0 kg and radius 0.10 m, turning without friction on a fixed axle. The block is released from rest. How fast is it moving after it has fallen 0.80 m?

Choose the system block + pulley + Earth. No external work is done (the axle force acts at the axis and does no work), so mechanical energy is conserved. The string does not slip, so the block's speed equals the speed of the pulley's rim: v = Rω.

- Initial: U_g = mgh = (1.5 kg)(9.8 m/s²)(0.80 m) = 11.76 J, nothing moving.
- Final: ½mv² + ½(½MR²)(v/R)² = ½(m + M/2)v².
- Set them equal: v = √(2mgh/(m + M/2)) = √(2(1.5)(9.8)(0.80)/(2.5)) = 3.07 m/s.

| Energy store | Initial (J) | Final (J) |
|---|---|---|
| U_g (block–Earth) | 11.8 | 0 |
| K_trans (block) | 0 | 7.1 |
| K_rot (pulley) | 0 | 4.7 |
| Energy transferred in or out | 0 | 0 |

**Limiting-case check.** Set M = 0 (a massless pulley): v = √(2gh) = 3.96 m/s, the free-fall speed, as it must be. A heavier pulley makes M/2 larger and v smaller, because part of the block–Earth potential energy goes into spinning the pulley. The expression passes both checks, so trust it.

## Torque and work (6.2)

In week 12 a force did work W = FΔx∥ when it acted through a displacement. The rotational version is the same idea. A tangential force F at radius r pushes a point on the rim through an arc length s = rΔθ, so the work is W = Fs = F r Δθ = τΔθ. In general, a constant torque τ acting through an angular displacement Δθ does work W = τΔθ, with Δθ in **radians** (a revolution is 2π rad).

- A torque in the same direction as the rotation does positive work and speeds the object up.
- A torque opposite to the rotation (friction at the axle, a brake pad) does negative work and slows it down.
- A force whose line of action passes through the axis exerts no torque and does no rotational work, however large it is.
- A torque on an object that does not turn (Δθ = 0) does no work, even if it is large: pushing on a locked door transfers no energy to it.

The **rotational work–energy theorem** says the net work done by external torques equals the change in rotational kinetic energy: τ_net Δθ = ½Iω_f² − ½Iω_i². It is the energy version of τ_net = Iα, and it is the faster tool whenever a problem gives an angle (or a number of turns) rather than a time.

**Worked example 3: pushing a playground carousel.** A playground carousel has rotational inertia 180 kg·m² about its axle and starts at rest. A student pushes tangentially on the rim, 1.5 m from the axle, with a constant 40 N force while the carousel turns through 3.0 rad. Ignore friction. What is the final angular speed?

- τ = rF = (1.5 m)(40 N) = 60 N·m.
- W = τΔθ = (60 N·m)(3.0 rad) = 180 J.
- 180 J = ½(180 kg·m²)ω², so ω = √2 rad/s ≈ 1.41 rad/s.

Cross-check with dynamics: α = τ/I = 0.333 rad/s², and ω² = 2αΔθ = 2(0.333)(3.0) = 2.0, giving ω = 1.41 rad/s again. The two routes agree because the work–energy theorem is derived from Newton's second law.

**Worked example 4: braking a bicycle wheel.** A bicycle wheel on a repair stand can be treated as a thin hoop of mass 1.2 kg and radius 0.33 m. It spins at 20 rad/s. A brake pad then exerts a constant frictional torque of 0.65 N·m opposing the rotation. Through how many revolutions does the wheel turn before it stops?

- I = MR² = (1.2 kg)(0.33 m)² = 0.131 kg·m²; K_i = ½(0.131)(20)² = 26.1 J.
- The brake does work −τΔθ = 0 − 26.1 J, so Δθ = 26.1 J ÷ 0.65 N·m = 40.2 rad.
- 40.2 rad ÷ 2π = 6.4 revolutions.

The energy removed by the brake does not vanish: it becomes internal (thermal) energy of the pad and rim. If the wheel and pad are inside your system, write it as an increase in internal energy instead of negative work.

**Functional dependence:** if the wheel spun twice as fast, it would carry four times the energy and, with the same brake torque, turn four times as many revolutions (about 26) before stopping.

## Common mistakes

- **Using revolutions or degrees in W = τΔθ or v = rω.** Convert to radians first: 2.0 rev = 4π rad.
- **Using ½mv² for a spinning object.** Different parts move at different speeds; use ½Iω² with the correct I for the axis.
- **Forgetting the pulley's energy.** If the pulley has mass, the block ends slower than in free fall; a bar chart with only U_g and K_block cannot balance.
- **Choosing the wrong I.** A rod spun about its end has four times the inertia it has about its centre; check where the axis is.
- **Thinking any large force does work.** Only the torque about the axis, acting through an angle, transfers energy to the rotation. A force through the axis does no work.
- **Expecting K to double when ω doubles.** K ∝ ω², so it quadruples.

## Self-check

1. A hoop and a uniform solid disk have the same mass, the same radius and the same angular speed. What is K_hoop/K_disk?
2. A desk-fan rotor has rotational inertia 0.020 kg·m² and spins at 90 rad/s. What is its kinetic energy?
3. A constant torque of 4.0 N·m turns a wheel through 5.0 revolutions. How much work does it do?
4. A flywheel's angular speed increases from ω to 2ω. How does the work needed compare with the work needed to bring it from rest to ω?
5. A mechanic pulls on a wrench along the line of the handle, directly toward the bolt. Explain why no work is done on the bolt.
6. In worked example 2, what final speed would the block have if the pulley were a hoop of the same mass and radius?

*Answers:* 1. 2 (I_hoop = MR² is twice ½MR²). 2. K = ½(0.020)(90)² = 81 J. 3. W = (4.0 N·m)(10π rad) ≈ 126 J. 4. Three times as much: ½I(4ω² − ω²) = 3(½Iω²). 5. A force along the handle passes through the bolt's axis, so its torque is zero and W = τΔθ = 0. 6. v = √(2mgh/(m + M)) = √(2(1.5)(9.8)(0.80)/3.5) ≈ 2.59 m/s: slower, because the hoop stores more energy at the same ω.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 6, Topics 6.1–6.2). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
