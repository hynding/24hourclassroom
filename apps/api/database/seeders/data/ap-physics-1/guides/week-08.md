# Week 08 · Gravitational Force

**Topics:** 2.6 Gravitational Force
**Practices:** 1 (Creating Representations: force diagrams for pairs of masses, ratio tables), 2 (Mathematical Routines: inverse-square calculations, proportional reasoning, linearising drop data), 3 (Scientific Questioning and Argumentation: explaining weightlessness, arguing from the equivalence of gravitational and inertial mass)
**Framework:** AP Physics 1: Algebra-Based CED (effective fall 2024), Unit 2, Topic 2.6, learning objectives in our own words
**Spiral:** Since week 2 you have used g = 9.8 m/s² as a fact of life, and since week 5 you have drawn F_g = mg on every free-body diagram. This week explains where both come from: one law of universal gravitation, which gives the force between any two masses and, near Earth's surface, reduces to mg. The third law (week 6) says Earth is pulled by you as hard as you are pulled by Earth; the second law (week 7) explains why every object falls with the same acceleration and why an elevator scale can read zero.

## What you need to be able to do

- **2.6** Use Newton's law of universal gravitation, F_g = Gm₁m₂/r², for two objects treated as points or uniform spheres, with r measured between centers.
- **2.6** Predict how the gravitational force changes when either mass or the separation changes (inverse-square functional dependence).
- **2.6** Define the gravitational field g = F_g/m = GM/r² and explain why it is nearly constant near Earth's surface but smaller at greater altitude.
- **2.6** Compute g on another planet or moon from its mass and radius, and find a planet's mass from measured g.
- **2.6** Distinguish weight (the gravitational force) from apparent weight (the normal force or scale reading), and explain apparent weightlessness in free fall.
- **2.6** Explain that gravitational mass and inertial mass are experimentally equal, so all objects have the same free-fall acceleration in the same field.

## Key terms

| Term | Meaning |
|---|---|
| Universal gravitation | Every pair of masses attracts with a force proportional to the product of the masses and inversely proportional to the square of the distance between their centers. |
| G | The universal gravitational constant, 6.67 × 10⁻¹¹ N·m²/kg². |
| Gravitational field g | The gravitational force per unit mass at a location, g = F_g/m, in N/kg (equivalent to m/s²). |
| Weight | The gravitational force exerted on an object by a planet: F_g = mg. |
| Apparent weight | The force a supporting surface or scale exerts on you (the normal force); what you feel. |
| Apparent weightlessness | Zero apparent weight, which happens whenever the only force on you is gravity (free fall). |
| Inertial mass | Mass as resistance to acceleration, from a = ΣF/m. |
| Gravitational mass | Mass as the property that gravity acts on, from F_g = Gm₁m₂/r². Experiments show the two are equal. |

## Equations

| Relation | Symbols and SI units |
|---|---|
| F_g = Gm₁m₂/r² | F_g force on each object (N); m₁, m₂ masses (kg); r center-to-center distance (m); G = 6.67 × 10⁻¹¹ N·m²/kg² |
| g = GM/r² | g field strength (N/kg or m/s²) at distance r from the center of a body of mass M |
| F_g = mg | weight (N) of mass m (kg) where the field is g |
| Earth data used this week | M_E = 5.97 × 10²⁴ kg, R_E = 6.37 × 10⁶ m, which give g ≈ 9.8 N/kg at the surface |

## Newton's law of universal gravitation

Every two objects with mass attract each other. For point masses, or for uniform spheres (planets, to a good approximation), the magnitude of the force is

F_g = Gm₁m₂/r².

The force acts along the line between the centers, pulls each object toward the other, and comes as a **third-law pair**: the force on m₁ and the force on m₂ are equal in size and opposite in direction, even when one mass is a planet and the other a pebble.

Read the equation for its **functional dependence** before you plug in numbers. F_g is proportional to each mass, so doubling either mass doubles the force. F_g is proportional to 1/r², so doubling the distance cuts the force to one quarter, tripling it cuts it to one ninth, and halving it multiplies it by four. On the exam, ratio questions ("by what factor does the force change?") are far more common than full calculations.

| Change | Effect on F_g |
|---|---|
| One mass doubled | × 2 |
| Both masses doubled | × 4 |
| Distance doubled | × 1/4 |
| Distance tripled | × 1/9 |
| Distance halved | × 4 |
| One mass doubled and distance doubled | × 2/4 = × 1/2 |

**Worked example 1: two students (why we never notice).** Two 70 kg students sit with their centers 1.0 m apart. F_g = (6.67 × 10⁻¹¹)(70)(70)/(1.0)² ≈ **3.3 × 10⁻⁷ N**. Each student's weight is 70 · 9.8 = 686 N, about two billion times larger. Gravity between everyday objects is real but tiny because G is so small; it takes a planet-sized mass to make a force we notice.

**Worked example 2: Earth and Moon (third law at planet scale).** With M_E = 5.97 × 10²⁴ kg, M_Moon = 7.35 × 10²² kg and r = 3.84 × 10⁸ m, F_g = (6.67 × 10⁻¹¹)(5.97 × 10²⁴)(7.35 × 10²²)/(3.84 × 10⁸)² ≈ **2.0 × 10²⁰ N**. The Moon pulls Earth with exactly this force too. The two accelerations are very different (the Moon's is about 81 times larger, since Earth's mass is about 81 times the Moon's), which is the same lesson as the car and the truck in week 6.

## The gravitational field

Divide the force on a small object by its mass and you get a property of the location, not of the object: the **gravitational field**,

g = F_g/m = GM/r².

At Earth's surface, r = R_E and g = (6.67 × 10⁻¹¹)(5.97 × 10²⁴)/(6.37 × 10⁶)² ≈ 9.8 N/kg. That is why F_g = mg works. The units N/kg and m/s² are identical, and the second law shows why: in free fall the field strength *is* the acceleration.

Near the surface, a few hundred metres up or down barely changes r compared with 6.37 × 10⁶ m, so g is effectively constant: the "uniform field" model of Unit 1. Far from the surface it is not.

**Worked example 3: the space station (field at altitude, apparent weightlessness).** A space station orbits 4.0 × 10⁵ m above Earth's surface, so r = 6.37 × 10⁶ + 0.40 × 10⁶ = 6.77 × 10⁶ m.

g = (6.67 × 10⁻¹¹)(5.97 × 10²⁴)/(6.77 × 10⁶)² ≈ **8.7 N/kg**, about 89% of the surface value.

So gravity on the astronauts is far from zero. Why do they float? Because the station and everything in it are in **free fall** together: the only force on each is gravity, so each has the same acceleration and nothing presses on anything else. A scale under an astronaut reads zero: apparent weight F_N = 0, although the true weight is 89% of what it is on the ground. (Why the station falls *around* Earth rather than into it is the subject of week 26.) The same thing happens, briefly, in an elevator whose cable has snapped, or at the top of a trampoline bounce.

*Limiting-case check.* As r grows without limit, g = GM/r² goes to zero, as it should far from any mass; at r = R_E it gives the familiar 9.8 N/kg. A formula giving larger g at higher altitude would fail this check.

## Comparing planets: ratio reasoning

Because g = GM/r², a planet's surface field depends on its mass and radius together. Write the ratio to Earth:

g_planet/g_Earth = (M_planet/M_E) · (R_E/R_planet)².

**Worked example 4: an imaginary planet (functional dependence).** A planet has twice Earth's mass and twice Earth's radius. Then g = 9.8 · 2 · (1/2)² = 9.8 · 2/4 = **4.9 N/kg**. A planet with three times the mass and three times the radius has g = 9.8 · 3/9 ≈ 3.3 N/kg. Bigger and more massive does not mean stronger surface gravity: the radius enters squared.

A 60 kg astronaut's mass is 60 kg everywhere. Her weight changes with the field: 588 N on Earth, 60 · 1.62 ≈ 97 N on the Moon, and 294 N on the imaginary planet with g = 4.9 N/kg.

## Measuring g, and the equivalence of the two masses

Why does every object fall with the same acceleration? The second law says a = F_g/m_inertial; the gravitation law says F_g = m_grav · g. So a = (m_grav/m_inertial) g. Every experiment ever done, from dropping balls to precise torsion balances and satellites, finds m_grav = m_inertial to extraordinary precision. So a = g for every object in the same field, regardless of its mass or what it is made of. A hammer and a feather dropped on the airless Moon land together.

**Worked example 5: finding a moon's g and mass from drop data.** A lander on a moon (radius 1.74 × 10⁶ m) drops a sample from rest and records how far it has fallen (invented data):

| t (s) | 0.40 | 0.80 | 1.20 | 1.60 | 2.00 |
|---|---|---|---|---|---|
| t² (s²) | 0.16 | 0.64 | 1.44 | 2.56 | 4.00 |
| d (m) | 0.13 | 0.52 | 1.17 | 2.06 | 3.25 |

From rest, d = ½gt², so d against t² is a straight line through the origin with slope g/2. The best-fit slope is about 0.81 m/s², so **g ≈ 1.62 m/s²**. Then g = GM/R² gives M = gR²/G = 1.62 · (1.74 × 10⁶)²/(6.67 × 10⁻¹¹) ≈ **7.4 × 10²² kg**. Graphing d against t would give a curve; choosing t² is what makes the slope meaningful.

## Common mistakes

- **Measuring r from the surface.** In g = GM/r² and F_g = Gm₁m₂/r², r runs center to center. At altitude h, r = R + h.
- **Forgetting to square r**, or applying the square to a mass. Doubling r quarters the force.
- **"Astronauts float because there is no gravity in space."** Gravity at the station is about 8.7 N/kg; they float because they are in free fall.
- **Confusing mass and weight.** Mass (kg) is the same everywhere; weight (N) depends on g.
- **"Earth pulls the apple harder than the apple pulls Earth."** Third-law partners are equal; only the accelerations differ.
- **"Heavier objects fall faster."** Gravitational and inertial mass are equal, so the mass cancels.

## Self-check

1. The distance between two asteroids triples. By what factor does the gravitational force between them change?
2. Find the force between a 5.0 kg lead sphere and a 0.050 kg sphere whose centers are 0.10 m apart.
3. A planet has half Earth's radius and the same mass. What is g at its surface?
4. What is g at a distance of 2R_E from Earth's center?
5. A student in a falling elevator (cable snapped, no brakes) stands on a scale. What does it read, and what is her weight?

*Answers:* 1. One ninth as large. 2. F_g = (6.67 × 10⁻¹¹)(5.0)(0.050)/(0.10)² ≈ 1.7 × 10⁻⁹ N. 3. g = 9.8 · 1 · 2² ≈ 39 N/kg. 4. One quarter of 9.8: about 2.5 N/kg. 5. The scale reads zero (apparent weightlessness), but her weight is still mg, the same as before.

---

*Original study material for this course, organised around the College Board AP Physics 1: Algebra-Based Course and Exam Description (Unit 2, Topic 2.6). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). All lab data are invented. AP® is a trademark of the College Board, which does not endorse this material.*
