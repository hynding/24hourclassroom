# Week 10 · Spring Forces

**Topics:** 2.8 Spring Forces
**Practices:** 1 (Creating Representations: force-versus-stretch graphs, free-body diagrams with spring forces), 2 (Mathematical Routines: Hooke's law, equivalent spring constants, Newton's second law with springs), 3 (Scientific Questioning and Argumentation: designing and analysing a spring-constant experiment)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 2, Topic 2.8, learning objectives in our own words
**Spiral:** Week 5 drew free-body diagrams; weeks 6 and 7 applied Newton's three laws; week 8 gave weight as mg; week 9 met static friction, another force that adjusts to circumstances. This week's spring force is different: its size is set by how far the spring is stretched or compressed, so a single length measurement tells you the force.

## What you need to be able to do

- **2.8** Use Hooke's law, F_s = k\|Δx\|, for an ideal spring, with the force directed back toward the spring's relaxed length (a restoring force).
- **2.8** Explain what the spring constant k measures and find it as the slope of a force-versus-stretch graph.
- **2.8** Design an experiment with hanging masses to measure k, choosing what to graph so the data fall on a straight line, and interpret slope and intercept.
- **2.8** Find the equivalent spring constant of identical or different springs in parallel (k_eq = k₁ + k₂) and in series (1/k_eq = 1/k₁ + 1/k₂).
- **2.8** Include spring forces in free-body diagrams and Newton's second law, for objects at rest, in accelerating elevators and on horizontal surfaces.
- **2.8** Recognise that an ideal (massless) spring pulls equally hard on whatever is attached at each end.

## Key terms

| Term | Meaning |
|---|---|
| Ideal spring | A massless spring that obeys Hooke's law exactly; it exerts equal-magnitude forces at both ends. |
| Relaxed (natural) length | The length of the spring with no force on it. |
| Displacement from relaxed length Δx | Stretch (positive) or compression (negative) relative to the relaxed length, in m. |
| Spring constant k | Force per unit stretch, in N/m; a stiffer spring has a larger k. |
| Restoring force | A force that always points back toward the equilibrium (relaxed) position. |
| Equilibrium position | The position where the net force on the attached object is zero; for a hanging mass it is below the relaxed length. |
| Elastic limit | The stretch beyond which the spring no longer returns to its original length and Hooke's law fails. |

## Equations

| Relation | Symbols and units |
|---|---|
| F_s = −kΔx (magnitude k\|Δx\|) | F_s spring force on the attached object (N); k spring constant (N/m); Δx displacement from relaxed length (m); the minus sign means the force opposes the displacement |
| Hanging mass at rest: kΔx = mg | m mass (kg); g = 9.8 m/s² |
| Parallel springs: k_eq = k₁ + k₂ | both springs share the load and have the same stretch |
| Series springs: 1/k_eq = 1/k₁ + 1/k₂ | both springs carry the same force; their stretches add |
| Hanging mass in an accelerating elevator: kΔx − mg = ma | a positive upward (m/s²) |

## Hooke's law and the spring constant (2.8)

Pull on a spring and it pulls back; push on it and it pushes back. For an ideal spring, the force is proportional to how far the spring is stretched or compressed from its relaxed length: **F_s = −kΔx**. The minus sign says the spring force points **opposite** the displacement: stretch the spring to the right and it pulls the attached object to the left; compress it to the right and it pushes the object back to the left. That is why the spring force is called a restoring force.

The spring constant k is a property of the spring alone: its material, the thickness of its wire, and its length. A stiff car-suspension spring might have k of tens of thousands of N/m; a soft lab spring might have k = 20 N/m. Two facts matter on the AP exam:

- **k does not depend on what you hang.** Hanging more mass changes the stretch, not k.
- **Δx is measured from the relaxed length**, not from the floor, the ceiling or wherever the spring happens to be now.

Because F_s is proportional to Δx, a graph of the spring force (vertical) against stretch (horizontal) is a straight line through the origin with **slope k**. Doubling the stretch doubles the force; halving it halves the force. The relationship holds only up to the elastic limit: an over-stretched spring stays longer and the graph bends.

**An ideal spring pulls equally at both ends.** If you and a friend pull a spring scale with 50 N each, it reads 50 N, not 100 N and not zero. A spring scale hung from the ceiling holding a 50 N weight is in exactly the same state: the ceiling supplies the other 50 N.

**Worked example 1: measuring k with hanging masses.** A lab group hangs masses from a spring and measures the stretch from the relaxed length with a metre stick (uncertainty about ±0.1 cm):

| Mass (kg) | 0.10 | 0.20 | 0.30 | 0.40 | 0.50 |
|---|---|---|---|---|---|
| Spring force mg (N) | 0.98 | 1.96 | 2.94 | 3.92 | 4.90 |
| Stretch Δx (cm) | 1.3 | 2.4 | 3.7 | 4.9 | 6.1 |

*Why does mg give the spring force?* Each hanging mass is at rest, so its free-body diagram (an upward arrow F_s, a downward arrow F_g) must balance: F_s = mg.

*What to graph:* force on the vertical axis and stretch (in metres) on the horizontal axis. Hooke's law predicts a straight line through the origin with slope k. The best-fit line has slope ≈ 81 N/m and intercept ≈ −0.04 N, close to zero, so the data support Hooke's law and **k ≈ 81 N/m**. Computing k from each row separately (75, 82, 79, 80, 80 N/m) shows the scatter; the first row has the largest relative error because a 1.3 cm stretch is read with the same ±0.1 cm uncertainty as a 6.1 cm one. Using the slope of many points averages out random error, and the intercept would reveal a systematic error such as measuring Δx from the wrong mark.

*An alternative graph:* plotting total spring length L against mass m also gives a straight line, L = L₀ + (g/k)m. Its intercept is the relaxed length L₀ and its slope is g/k, so k = g/slope.

## Combining springs (2.8)

**Parallel:** two springs side by side, both attached to the same load. They have the same stretch, and their forces add: kΔx = k₁Δx + k₂Δx, so **k_eq = k₁ + k₂**. Two identical springs in parallel are twice as stiff as one.

**Series:** two springs hooked end to end. Each carries the full load (the force is the same all along an ideal spring chain), and the stretches add: Δx = F/k₁ + F/k₂, so **1/k_eq = 1/k₁ + 1/k₂**. Two identical springs in series are half as stiff as one. A useful consequence: a spring is like a chain of shorter springs in series, so **cutting a spring in half doubles k** for each half.

**Worked example 2: series and parallel.** Two identical springs each have k = 120 N/m. A 0.60 kg mass (weight 5.88 N) hangs from one spring, from the two in parallel, and from the two in series.

| Arrangement | k_eq (N/m) | Stretch (cm) |
|---|---|---|
| One spring | 120 | 4.9 |
| Two in parallel | 240 | 2.45 |
| Two in series | 60 | 9.8 |

Check the reasoning: in parallel each spring carries half the weight, so each stretches half as much; in series each spring carries the whole weight and stretches 4.9 cm, so together they stretch 9.8 cm.

**Worked example 3: a car's suspension.** A 1200 kg car rests on four identical springs, each with k = 20,000 N/m. The springs act in parallel (they share the load and compress equally), so k_eq = 80,000 N/m, and the car sinks Δx = mg/k_eq = 11,760/80,000 ≈ 0.15 m below the springs' relaxed length. *Functional dependence:* load the car with passengers so its mass grows by 25% and the compression grows by 25% too, because Δx is proportional to m.

## Springs and Newton's second law (2.8)

A spring force goes on a free-body diagram like any other force. When the object accelerates, the spring force is no longer equal to the weight.

**Worked example 4: a spring scale in an elevator.** A 2.0 kg bag hangs from a spring scale (k = 400 N/m) in an elevator that is moving up but slowing down at 1.5 m/s².

*Free-body diagram (in words):* an upward arrow F_s from the scale, a longer downward arrow F_g = 19.6 N. The acceleration is downward (the car is slowing while moving up), so the net force is downward.

Take up as positive: F_s − mg = m(−1.5), so F_s = 2.0 × (9.8 − 1.5) = 16.6 N. The scale reads 16.6 N and its spring is stretched 16.6/400 = 0.0415 m ≈ 4.2 cm, instead of the 4.9 cm it stretches at rest. Notice that only the direction of the **acceleration**, not of the velocity, decides whether the reading goes up or down.

**Worked example 5: a spring launcher.** A 0.25 kg block on a frictionless track is pushed against a spring (k = 300 N/m), compressing it 3.0 cm, and released. At release the spring force is kΔx = 300 × 0.030 = 9.0 N, so a = 9.0/0.25 = 36 m/s² away from the spring. When the spring has expanded to 1.5 cm of compression, the force and the acceleration are half as large: 4.5 N and 18 m/s². The block keeps speeding up while it touches the spring, but less and less quickly; at the relaxed length the force is zero and the block leaves at its greatest speed. The acceleration is not constant, so the constant-acceleration equations from Unit 1 do not apply here (energy methods, in Unit 3, will handle this).

*Limiting case:* if k were very large, a tiny compression would give the same force, and the push would be over almost instantly, like a collision with a hard wall.

## Common mistakes

- Measuring Δx from the floor or from the spring's current length instead of from its relaxed length.
- Thinking k changes with the hanging mass; it is a property of the spring.
- Reading a spring scale pulled by 50 N at each end as 100 N (or zero).
- Swapping the series and parallel rules: parallel springs are stiffer (k₁ + k₂), series springs softer.
- Setting the spring force equal to mg when the object accelerates, for example in an elevator or while bouncing.
- Using the constant-acceleration equations for a block pushed by a spring: the force changes with position.
- Forgetting to convert centimetres to metres before computing k in N/m.

## Self-check

1. A spring stretches 0.050 m when it pulls with 4.0 N. What is k, and what force stretches it 0.080 m?
2. Two springs, 150 N/m and 300 N/m, are hooked in series. What is k_eq?
3. A graph of total spring length (cm) against hanging mass (kg) has slope 20 cm/kg and intercept 15 cm. What are the relaxed length and k?
4. A 1.0 kg mass hangs from a spring (k = 200 N/m) in an elevator accelerating upward at 2.0 m/s². How far is the spring stretched?
5. A spring of k = 60 N/m is cut into two equal halves. What is k for each half?

*Answers:* 1. k = 4.0/0.050 = 80 N/m; F = 80 × 0.080 = 6.4 N. 2. 1/k_eq = 1/150 + 1/300 = 3/300, so k_eq = 100 N/m. 3. L₀ = 15 cm; slope g/k = 0.20 m/kg, so k = 9.8/0.20 = 49 N/m. 4. kΔx = m(g + a) = 11.8 N, so Δx = 0.059 m = 5.9 cm. 5. 120 N/m: two halves in series must give 60 N/m.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 2, Topic 2.8). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
