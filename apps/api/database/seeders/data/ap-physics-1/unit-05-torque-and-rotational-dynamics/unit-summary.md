# Unit 5 · Torque and Rotational Dynamics · The night-before sheet

**AP exam weight:** 10–15% of the multiple-choice section; rotational dynamics often appears in free response
**Topics:** 5.1 Rotational Kinematics · 5.2 Connecting Linear and Rotational Motion · 5.3 Torque · 5.4 Rotational Inertia · 5.5 Rotational Equilibrium and Newton's First Law in Rotational Form · 5.6 Newton's Second Law in Rotational Form
**Practices:** 1 (Creating Representations), 2 (Mathematical Routines), 3 (Scientific Questioning and Argumentation)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 5, Topics 5.1–5.6, in our own words

## The ideas that generate every question

1. **Rotation has its own kinematics (5.1).** Angular position θ (rad), angular displacement Δθ, angular velocity ω (rad/s) and angular acceleration α (rad/s²), counterclockwise positive. With constant α, the three equations of Unit 1 carry over letter for letter. On a graph of ω against t, the slope is α and the area is Δθ; on θ against t, the slope is ω.
2. **Every point of a rigid object shares θ, ω and α; linear quantities grow with r (5.2).** s = rθ, v = rω, a_t = rα, and a point moving in a circle always has a centripetal acceleration a_c = v²/r = ω²r toward the axis. A string that does not slip on a rim moves with the rim.
3. **Torque is what makes things turn (5.3).** τ = rF sin θ = r⊥F: only the force component perpendicular to r, or equivalently the lever arm r⊥, matters. A force whose line of action passes through the axis exerts no torque. Torques about the same axis add with signs.
4. **Rotational inertia measures how mass is spread about the axis (5.4).** I = Σmr² for point masses; from the equation sheet, a hoop MR², a solid disk ½MR², a rod (1/12)ML² about its centre and (1/3)ML² about an end. The parallel-axis theorem I = I_cm + Md² gives any parallel axis, and I is smallest about the centre of mass.
5. **No net torque, no change in spin (5.5).** Newton's first law in rotational form: if Στ = 0, ω stays constant. Static equilibrium of an extended object needs ΣF = 0 **and** Στ = 0; then the torques balance about every axis, so choose one through an unknown force.
6. **Net torque causes angular acceleration (5.6).** α = Στ/I about a fixed axis. α points the way of the net torque; doubling the torque doubles α, doubling I halves it. Torque changes ω; it does not set it.

## The linear–rotational dictionary

| Translation | Rotation | Link |
|---|---|---|
| Position x (m) | Angle θ (rad) | s = rθ |
| Velocity v (m/s) | Angular velocity ω (rad/s) | v = rω |
| Acceleration a (m/s²) | Angular acceleration α (rad/s²) | a_t = rα |
| Mass m (kg) | Rotational inertia I (kg·m²) | I = Σmr² |
| Force F (N) | Torque τ (N·m) | τ = rF sin θ |
| ΣF = 0 means constant v | Στ = 0 means constant ω | Newton's first law |
| ΣF = ma | Στ = Iα | Newton's second law |

Rotational kinematics for constant α: ω = ω₀ + αt; Δθ = ω₀t + ½αt²; ω² = ω₀² + 2αΔθ; and Δθ = ½(ω₀ + ω)t. Conversions: 1 rev = 2π rad; rpm × 2π/60 = rad/s.

## Representations to know cold

- **Extended free-body diagram (force diagram).** Draw the object's outline and start each force arrow **where it acts**: weight at the centre of mass, normal and support forces at the contact points, tension where the string is tied, hinge forces at the hinge (often as horizontal and vertical components). The AP exam checks the location as well as the direction.
- **ω–t and θ–t graphs or tables.** Slope and area, exactly as in Unit 1. A straight θ–t line means constant ω and α = 0.
- **Connected-object diagrams.** One diagram per object (each block and the pulley), with the same tension symbol only where the tension really is the same. On a pulley with mass, the two sides carry **different** tensions.
- **Linearised lab graphs.** τ against α gives slope I; I against d² (for masses moved along a rod) gives slope 2m and intercept I₀; a balance-point graph gives a mass from a slope.

## The standard problems

| Situation | Key move | Result to recognise |
|---|---|---|
| Seesaw or mobile | Torques about the pivot | m₁d₁ = m₂d₂; g cancels |
| Plank on two supports | Torques about one support, then ΣF = 0 | Nearer support carries more; forces vary linearly with the load's position |
| Tipping plank | Set the far support force to zero | Load torque about the near support = plank's weight torque |
| Hinged beam held by a cable at θ | Torques about the hinge | Only T sin θ has a lever arm; T ∝ 1/sin θ |
| Ladder on a frictionless wall | Torques about the foot | f = N_wall = mg/(2 tan θ) for the ladder alone |
| Block hanging from a disk pulley | mg − T = ma, TR = ½MR²(a/R) | a = mg/(m + ½M); T less than mg; R drops out |
| Atwood with a disk pulley | Three equations, add them | a = (m₁ − m₂)g/(m₁ + m₂ + ½M); T₁ − T₂ = ½Ma |
| Rod hinged at one end, released horizontal | τ = Mg(L/2), I = (1/3)ML² | α = 3g/(2L); free end a = 1.5g, more than g |

## Reasoning moves that earn AP points

- **Name the axis** before writing a torque equation ("taking torques about the hinge, where the hinge force has no lever arm"), and use the same axis for τ and I.
- **Say why a force has no torque:** "its line of action passes through the axis".
- **Check a derived expression with limiting cases.** Pulley mass → 0 should give the massless-pulley answer (a → g for a single hanging block); a load on a support should leave the other support with half the beam's weight; a cable at 90° should carry the smallest tension.
- **Functional dependence in words and symbols:** "α = 3g/(2L), so doubling the length halves α; the mass cancels." "a = mg/(m + ½M) contains no R, so a larger drum of the same mass gives the same linear acceleration."
- **Explain tension differences:** "the pulley speeds up toward the heavier block, so the net torque on it points that way, which requires T₁ greater than T₂."
- **Claim, evidence, reasoning** for equilibrium predictions: claim how a support force changes, cite the change in a lever arm, reason from Στ = 0 and ΣF = 0.

## Common mistakes

- Using cos where sin belongs, or the full distance instead of the lever arm.
- Drawing the weight at a support or an end instead of the centre of mass; forgetting the hinge force in ΣF = 0.
- Assuming support forces are equal because the object is at rest.
- Believing a spinning object needs a net torque to keep spinning.
- Setting a hanging block's tension equal to its weight, or using one tension on both sides of a massive pulley.
- Taking τ about one axis and I about another; using ½MR² for a hoop or (1/12)ML² for a rod swinging about its end.
- Confusing ω and α, or forgetting that a point moving at constant ω still has centripetal acceleration.

## Self-test

1. A wheel slows uniformly from 30 rad/s to 10 rad/s in 4.0 s. Find α and Δθ.
2. A 50 N force acts at 0.40 m from an axis at 30° to the radius. Torque?
3. Two 2.0 kg masses sit 0.50 m from an axis on a light rod. I? Then the masses move to 0.25 m: new I?
4. A uniform 3.0 m, 20 kg plank rests on supports at its ends; a 30 kg box sits 1.0 m from the left. Find both support forces.
5. A 1.0 kg block hangs from a disk pulley of mass 2.0 kg. Find a and T.
6. A uniform rod 2.0 m long is hinged at one end and released from horizontal. Find α.

**Answers.** 1. α = −5.0 rad/s²; Δθ = ½(30 + 10)(4.0) = 80 rad. 2. τ = (0.40)(50) sin 30° = 10 N·m. 3. I = 2(2.0)(0.50)² = 1.0 kg·m²; at 0.25 m, 0.25 kg·m² (one quarter: r is halved and enters squared). 4. Torques about the left end: F_R(3.0) = 196(1.5) + 294(1.0), so F_R = 196 N and F_L = 490 − 196 = 294 N. 5. a = 9.8/(1.0 + 1.0) = 4.9 m/s²; T = ½Ma = 4.9 N. 6. α = 3(9.8)/(2 × 2.0) ≈ 7.35 rad/s².

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 5, Topics 5.1–5.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
