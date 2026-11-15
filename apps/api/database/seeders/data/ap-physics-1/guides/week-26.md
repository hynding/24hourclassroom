# Week 26 · Rolling and Orbiting Satellites

**Topics:** 6.5 Rolling · 6.6 Motion of Orbiting Satellites
**Practices:** 1 (Creating Representations: energy tables for rolling objects, speed and distance at points of an orbit), 2 (Mathematical Routines: v = Rω for rolling, the energy split, v = √(GM/r) and T² ∝ r³), 3 (Scientific Questioning and Argumentation: predicting the winner of a rolling race and what is conserved in an elliptical orbit)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 6, Topics 6.5–6.6, learning objectives in our own words
**Spiral:** Week 8 gave Newton's law of gravitation and week 11 circular motion; weeks 12–15 conservation of energy; week 19 v = rω; weeks 24–25 rotational kinetic energy, rotational work and conservation of angular momentum. This week applies all of it to two systems: a ball rolling down a ramp and a satellite moving around a planet.

## What you need to be able to do

- **6.5** State the condition for rolling without slipping (v_cm = Rω) and describe the motion of the contact point (at rest) and the top of the wheel (2v_cm).
- **6.5** Write the total kinetic energy of a rolling object as ½Mv² + ½Iω² and find the fraction that is rotational.
- **6.5** Use conservation of energy to find the speed of an object that rolls without slipping down (or up) an incline, and rank shapes in a rolling race.
- **6.5** Explain why static friction does no work on an object rolling without slipping, and why kinetic friction removes energy when it slips.
- **6.6** Derive v = √(GM/r) and T = 2π√(r³/GM) for a circular orbit from Newton's second law, and predict how they depend on r and M.
- **6.6** Use conservation of angular momentum (mvr at the nearest and farthest points) and of mechanical energy for a satellite in an elliptical orbit.
- **6.6** Use U_g = −GMm/r for the satellite–planet system, including the total energy of a circular orbit and the escape speed.

## Key terms

| Term | Meaning |
|---|---|
| Rolling without slipping | Rolling in which the contact point does not slide on the surface: v_cm = Rω and a_cm = Rα. |
| Contact point | The point of the rolling object touching the surface; with no slipping it is momentarily at rest. |
| Shape factor β | The number in I = βMR²: ½ for a solid disk or cylinder, 2/5 for a solid sphere, 1 for a thin hoop or pipe. |
| Circular orbit | An orbit at constant distance r, in which gravity supplies exactly the centripetal force. |
| Elliptical orbit | An orbit whose distance from the central body changes; the nearest point (perigee for Earth) is fastest, the farthest (apogee) slowest. |
| Escape speed | The minimum launch speed for which an object never returns: total mechanical energy zero. |

## Equations

| Relation | Symbols and SI units |
|---|---|
| v_cm = Rω (no slipping) | v_cm centre-of-mass speed (m/s); R radius (m); ω angular speed (rad/s) |
| K = ½Mv_cm² + ½I_cmω² | M mass (kg); I_cm rotational inertia about the centre of mass (kg·m²) |
| K = ½M(1 + β)v_cm² | when I_cm = βMR² and the object rolls without slipping |
| v = √(2gh/(1 + β)) | rolling from rest through a vertical drop h (m), g = 9.8 m/s² |
| F_g = GMm/r² | G = 6.67 × 10⁻¹¹ N·m²/kg²; M, m masses (kg); r centre-to-centre distance (m) |
| v = √(GM/r), T = 2πr/v = 2π√(r³/GM) | circular orbit of radius r about a central mass M; T period (s) |
| U_g = −GMm/r, E = −GMm/(2r) | system potential energy (zero at infinite separation) and total energy of a circular orbit (J) |
| m v₁r₁ = m v₂r₂ | angular momentum at the nearest and farthest points of an elliptical orbit, where v is perpendicular to r |
| v_esc = √(2GM/R) | escape speed from the surface of a body of radius R |

## Rolling (6.5)

A rolling wheel does two things at once: its centre moves forward at v_cm and it spins at ω. **Rolling without slipping** means the two are locked together: in one turn the wheel moves forward one circumference, so v_cm = Rω. Add the forward motion to the spin and you find the contact point momentarily at rest (v_cm − Rω = 0) and the top moving at 2v_cm. That is why a bicycle's spokes blur at the top and look sharp near the ground.

A rolling object therefore has two kinetic energies: ½Mv² for its centre of mass and ½Iω² for the spin. With I = βMR² and ω = v/R:

K = ½Mv² + ½βMv² = ½M(1 + β)v².

The fraction of the kinetic energy that is rotational is β/(1 + β): 2/7 for a solid sphere, 1/3 for a solid cylinder, 1/2 for a hoop.

**Who does the work?** On an incline a rolling object feels gravity, the normal force and static friction. Friction is what makes it spin, but with no slipping the contact point is at rest, so static friction does **no work**: mechanical energy is conserved. If the object slips (a bowling ball skidding down the lane), kinetic friction acts at a sliding contact and converts mechanical energy into internal energy until the ball starts to roll.

**Worked example 1: the rolling race.** A solid ball, a solid cylinder and a thin-walled pipe are released together from rest at the top of a ramp 1.2 m high, and all roll without slipping. A frictionless block slides down beside them. Rank their speeds at the bottom.

For each shape, Mgh = ½M(1 + β)v², so v = √(2gh/(1 + β)). Mass and radius cancel:

| Object | β | v at the bottom (m/s) | Rotational share of K |
|---|---|---|---|
| Sliding block (no rotation) | 0 | 4.85 | 0 |
| Solid ball | 2/5 | 4.10 | 2/7 |
| Solid cylinder | 1/2 | 3.96 | 1/3 |
| Thin-walled pipe | 1 | 3.43 | 1/2 |

The smaller β, the less energy is tied up in spin and the faster the object moves. A heavy steel ball and a light glass marble tie; a fat cylinder and a thin one tie. Only the shape factor matters. **Limiting case:** β = 0 gives √(2gh), the frictionless-slide result.

**Worked example 2: a bowling ball rolling up a ramp.** A 7.0 kg bowling ball (a solid sphere) rolls without slipping at 5.0 m/s toward the return ramp. How high can it roll? Compare with a block sliding up a frictionless ramp at the same speed.

- K_trans = ½(7.0)(5.0)² = 87.5 J; K_rot = ½(2/5)(7.0)(5.0)² = 35.0 J; total 122.5 J.
- At the highest point the ball is at rest (it rolls back down), so Mgh = 122.5 J and h = 122.5 ÷ (7.0 × 9.8) = 1.79 m.
- The sliding block has only 87.5 J: h = v²/(2g) = 1.28 m.

| Energy (J) | Ball at bottom | Ball at top | Block at bottom | Block at top |
|---|---|---|---|---|
| K_trans | 87.5 | 0 | 87.5 | 0 |
| K_rot | 35.0 | 0 | 0 | 0 |
| U_g | 0 | 122.5 | 0 | 87.5 |

The ball climbs higher because its spinning energy also turns into height, through the static-friction torque that slows its spin on the way up.

## Motion of orbiting satellites (6.6)

**Circular orbits.** For a satellite of mass m in a circular orbit of radius r around a planet of mass M, gravity is the only force and supplies the centripetal force:

GMm/r² = mv²/r, so v = √(GM/r).

The satellite's mass cancels: every object in that orbit moves at the same speed. The period is T = 2πr/v = 2π√(r³/GM), so T² ∝ r³ (Kepler's third law). Higher orbits are slower and take much longer.

**Worked example 3: a satellite 400 km up.** Earth's mass is 5.97 × 10²⁴ kg and its radius 6.37 × 10⁶ m. Find the speed and period of a satellite in a circular orbit 4.0 × 10⁵ m above the surface.

- r is measured from Earth's centre: r = 6.37 × 10⁶ + 0.40 × 10⁶ = 6.77 × 10⁶ m.
- v = √((6.67 × 10⁻¹¹)(5.97 × 10²⁴)/(6.77 × 10⁶)) = 7.67 × 10³ m/s.
- T = 2πr/v = 5.55 × 10³ s ≈ 92 minutes.

**Functional dependence:** an orbit four times as far from the centre has v ∝ 1/√r, half the speed, and T ∝ r^(3/2), eight times the period.

**Energy.** For the satellite–planet system U_g = −GMm/r (zero when they are infinitely far apart, negative everywhere else). In a circular orbit K = ½mv² = GMm/(2r), so the total energy is E = K + U_g = −GMm/(2r). A higher orbit has less kinetic energy but more (less negative) total energy, which is why moving a satellite outward takes a rocket burn even though it ends up slower. If a projectile's total energy reaches zero it never returns; from the surface of a body of radius R that needs v_esc = √(2GM/R), about 11.2 km/s for Earth.

**Elliptical orbits.** Gravity on the satellite always points at the planet's centre, so it exerts no torque about that centre: the satellite's angular momentum about the planet is conserved. At the nearest and farthest points the velocity is perpendicular to r, so m v_near r_near = m v_far r_far. Mechanical energy is conserved too: the satellite trades kinetic for potential energy as it climbs away and gets it back as it falls in.

**Worked example 4: an elliptical orbit.** A satellite's orbit has its nearest point 7.0 × 10⁶ m from Earth's centre, where it moves at 8.71 × 10³ m/s, and its farthest point 1.4 × 10⁷ m from the centre. How fast does it move at the farthest point? Check with energy.

- Angular momentum: v_far = v_near r_near/r_far = (8.71 × 10³)(7.0 × 10⁶)/(1.4 × 10⁷) = 4.35 × 10³ m/s.
- Energy per kilogram, ½v² − GM/r: at the nearest point ½(8.71 × 10³)² − (3.98 × 10¹⁴)/(7.0 × 10⁶) = −1.90 × 10⁷ J/kg; at the farthest point ½(4.35 × 10³)² − (3.98 × 10¹⁴)/(1.4 × 10⁷) = −1.90 × 10⁷ J/kg. The two conservation laws agree.

| Point | r (m) | v (m/s) | L/m = vr (m²/s) |
|---|---|---|---|
| Nearest | 7.0 × 10⁶ | 8.71 × 10³ | 6.1 × 10¹⁰ |
| Farthest | 1.4 × 10⁷ | 4.35 × 10³ | 6.1 × 10¹⁰ |

## Common mistakes

- **Using ½Mv² alone for a rolling object.** Add ½Iω²; for a hoop it is half of the total.
- **Thinking heavier or bigger balls roll down faster.** Only β matters when every object rolls without slipping.
- **Saying friction does negative work on a rolling ball.** Static friction at a non-sliding contact does no work.
- **Measuring the orbit radius from the surface.** r in GMm/r² and √(GM/r) is from the planet's centre.
- **Saying astronauts float because there is no gravity in orbit.** Gravity at 400 km is about 89% of its surface value; they float because they and their station fall together.
- **Thinking a satellite needs a forward force to keep moving.** Gravity is the only force; it bends the path, it does not push the satellite along.
- **Conserving vr at points other than the nearest and farthest.** Elsewhere v is not perpendicular to r; use r sin θ.

## Self-check

1. A solid cylinder rolls without slipping at 2.0 m/s. What fraction of its kinetic energy is rotational?
2. A hoop and a solid sphere race from rest down the same ramp, both rolling without slipping. Which wins, and does their mass matter?
3. Why is the mechanical energy of a ball rolling without slipping down a ramp conserved, even though friction acts on it?
4. Satellite B orbits at twice the orbital radius of satellite A. Compare their speeds and periods.
5. At its nearest point a comet is 0.5 AU from the Sun and moving at 60 km/s; its farthest point is 5.0 AU away. How fast is it moving there?
6. What is the total mechanical energy of a 500 kg satellite in a circular orbit with r = 6.77 × 10⁶ m around Earth?

*Answers:* 1. β/(1 + β) = (½)/(3/2) = 1/3. 2. The sphere (β = 2/5 is smaller than the hoop's 1); mass does not matter. 3. The contact point is at rest, so static friction does no work; only gravity does work, and it is a conservative force inside the ball–Earth system. 4. v_B = v_A/√2 ≈ 0.71 v_A; T_B = 2^(3/2) T_A ≈ 2.8 T_A. 5. v = (60)(0.5)/(5.0) = 6.0 km/s. 6. E = −GMm/(2r) = −(6.67 × 10⁻¹¹)(5.97 × 10²⁴)(500)/(2 × 6.77 × 10⁶) ≈ −1.47 × 10¹⁰ J.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 6, Topics 6.5–6.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
