# Week 25 · Forces, Equilibrium and Velocity

**Topics:** 4.10 Forces, Equilibrium and Velocity
**Standards:** HSN-VM.A.3, HSN-VM.B.4, HSG-SRT.D.11
**Spiral:** Everything this week is built from week 23 (vectors from magnitude and direction, bearings to direction angles, adding components) and week 24 (projections, which split a weight into parts along and across a ramp). Week 22's navigation triangles come back as wind and current problems, and the laws of sines and cosines from weeks 20–21 give a second way to check each answer. Week 3's right-triangle trigonometry handles the cases where two vectors meet at 90°.

## What you need to be able to do

- **4.10** Find the resultant (magnitude and direction) of two or more forces acting at a point.
- **4.10** Use the equilibrium condition (the forces add to the zero vector) to find an unknown force or the tensions in cables.
- **4.10** Resolve a weight on an inclined plane into the component along the plane and the component pressing into it.
- **4.10** Distinguish heading and airspeed from course and ground speed, and combine an air velocity with a wind velocity.
- **4.10** Solve river-crossing problems: where a boat lands when aimed straight across, and how to aim it to land directly opposite.

## Key terms

| Term | Meaning |
|---|---|
| Resultant force | The vector sum of all the forces acting on an object; the single force with the same effect. |
| Equilibrium | The state in which the resultant force is the zero vector: every component adds to 0, and the object stays at rest or moves at constant velocity. |
| Equilibrant | The single force that would balance a set of forces: the negative of their resultant. |
| Tension | The pulling force along a cable, rope or chain, directed along it away from the object. |
| Inclined plane | A ramp at angle θ to the horizontal. Weight w splits into w sin θ down the slope and w cos θ into the slope. |
| Heading and airspeed | The direction a plane (or boat) is pointed and its speed relative to the air (or water). |
| Course and ground speed | The direction it actually travels over the ground and its speed relative to the ground: the resultant of the air velocity and the wind. |

All angles in this week are in degrees. "A wind from the west" blows **towards** the east: winds are named for where they come from.

## Resultant forces (4.10)

Forces acting on one point add like any vectors. Write each force as |F|⟨cos θ, sin θ⟩, add the components, then convert back to a magnitude and direction.

**Worked example 1.** Two ropes pull a stuck crate. One pulls with 40 N at direction angle 0°, the other with 60 N at 50°. Find the resultant.

F₁ = ⟨40, 0⟩. F₂ = ⟨60 cos 50°, 60 sin 50°⟩ ≈ ⟨38.567, 45.963⟩. Sum ≈ ⟨78.567, 45.963⟩.

Magnitude √(78.567² + 45.963²) ≈ 91.02 N. Direction tan⁻¹(45.963/78.567) ≈ 30.33° (quadrant I). Check with the law of cosines: the parallelogram angle opposite the diagonal is 180° − 50° = 130°, and 40² + 60² − 2(40)(60) cos 130° ≈ 8285.4, whose square root is 91.02.

The equilibrant, the force that would hold the crate still against both ropes, is the opposite: 91.02 N at 30.33° + 180° = 210.33°.

## Equilibrium and tensions (4.10)

An object at rest has a resultant of zero, so the horizontal components add to 0 **and** the vertical components add to 0. That is two equations, enough for two unknown forces.

**Worked example 2.** A 200 N sign hangs from two cables. The left cable makes 35° with the horizontal ceiling and the right cable makes 50°. Find the tension in each.

Let T₁ be the left tension and T₂ the right. The left cable pulls up and to the left, T₁⟨−cos 35°, sin 35°⟩; the right one pulls up and to the right, T₂⟨cos 50°, sin 50°⟩; the weight is ⟨0, −200⟩.

Horizontal: −T₁ cos 35° + T₂ cos 50° = 0, so T₁ = T₂ cos 50°/cos 35°.
Vertical: T₁ sin 35° + T₂ sin 50° = 200.

Substituting, T₂(cos 50° tan 35° + sin 50°) = 200, so T₂ ≈ 164.46 N and T₁ ≈ 129.05 N.

Check: the horizontal parts are 129.05 cos 35° ≈ 105.71 and 164.46 cos 50° ≈ 105.71, equal, and the vertical parts add to 200. The steeper cable carries more of the load, as you would expect.

**Symmetric cables.** If both cables make the same angle θ with the horizontal, each has tension T = w/(2 sin θ). Shallow cables mean large tensions: at θ = 30°, each cable carries the full weight w; at θ = 5°, almost 6w. That is why a washing line can never be pulled perfectly straight with anything hanging on it.

## Inclined planes (4.10)

On a ramp at angle θ, gravity still pulls straight down with the object's weight w. Project the weight onto the ramp's direction and onto the direction perpendicular to it (week 24):

- component **down the slope**: w sin θ (this is what tends to make the object slide, and the force needed to hold it, ignoring friction);
- component **into the slope**: w cos θ (balanced by the ramp pushing back, the normal force).

The angle between the weight and the perpendicular to the ramp equals the ramp's angle θ, which is why the down-slope part is the sine and not the cosine. A quick check: at θ = 0° (flat) nothing pulls along the surface, and sin 0° = 0.

**Worked example 3.** A 300 lb crate rests on a ramp inclined at 20°. Ignoring friction, what force parallel to the ramp is needed to keep it from sliding, and how hard does the crate press into the ramp?

Down the slope: 300 sin 20° ≈ 102.61 lb, so a force of about 102.61 lb up the ramp holds it. Into the slope: 300 cos 20° ≈ 281.91 lb.

## Airplanes and wind (4.10)

The plane's air velocity (heading, airspeed) plus the wind velocity equals its ground velocity (course, ground speed). Convert each bearing to a direction angle with θ = 90° − bearing, add the components, and convert the sum back to a bearing.

**Worked example 4.** A plane has heading 060° and airspeed 420 mph. A 40 mph wind blows from the north. Find the ground speed and the course.

Air velocity: θ = 30°, so ⟨420 cos 30°, 420 sin 30°⟩ ≈ ⟨363.731, 210⟩. The wind blows towards the south: ⟨0, −40⟩. Ground velocity ≈ ⟨363.731, 170⟩.

Ground speed √(363.731² + 170²) ≈ 401.50 mph. Direction angle tan⁻¹(170/363.731) ≈ 25.05°, so the course is the bearing 90° − 25.05° ≈ 064.95°, about 065.0°. The wind has pushed the plane about 5° clockwise off its heading and slowed it slightly.

**Worked example 5 (choosing a heading).** A pilot wants to fly due east (course 090°) with airspeed 300 mph, but a 50 mph wind blows from the south. What heading should she take, and what will her ground speed be?

The wind pushes north at 50 mph, so the plane must point south of east by an angle α whose northward cancellation is exact: 300 sin α = 50, sin α = 1/6, α ≈ 9.59°. Heading ≈ 090° + 9.59° = 099.6°. The eastward part that is left is the ground speed: 300 cos α = √(300² − 50²) ≈ 295.80 mph.

## Boats and currents (4.10)

A river problem is a wind problem turned sideways. The boat's velocity relative to the water plus the current equals its velocity relative to the bank.

**Worked example 6.** A river 0.5 mi wide flows at 2 mph. A boat moves at 6 mph in still water.

(a) The boat is aimed straight across. Its velocity is 6 mph across plus 2 mph downstream: speed √(36 + 4) = √40 ≈ 6.32 mph, at tan⁻¹(2/6) ≈ 18.43° downstream of straight across. The crossing takes 0.5/6 h = 5 minutes (only the across component matters), and in that time the current carries it 2 · (1/12) = 1/6 mi ≈ 0.17 mi downstream.

(b) To land directly opposite, the boat must aim upstream at angle α with 6 sin α = 2, so α ≈ 19.47°. Its crossing speed is √(36 − 4) = √32 ≈ 5.66 mph, and the trip takes 0.5/5.66 h ≈ 5.30 minutes: longer, because part of the boat's effort cancels the current.

If the current were faster than the boat (sin α > 1), no heading could reach the opposite point.

## Common errors

- **Wind direction.** "From the north" points south. Write the wind vector towards where it blows.
- **Heading versus course.** The heading is where the nose points; the course is where the plane goes. They differ whenever there is a cross-wind.
- **Sine and cosine on a ramp.** Down the slope is w sin θ; into the slope is w cos θ. Check with θ = 0°.
- **Equilibrium with one equation.** Both the horizontal and the vertical sums must be 0; use both.
- **Adding speeds.** 420 mph and 40 mph do not make 460 or 380 mph unless the wind is directly behind or ahead. Add components.
- **Aiming straight to go straight.** A boat aimed straight across drifts downstream; to go straight across it must aim upstream.

## Where this goes next

This completes Unit 4. The unit exam mixes these applications with the laws of sines and cosines from weeks 20–22, so practise deciding whether a problem is a triangle to solve or vectors to add (often both work). Unit 5 begins with polar coordinates, where a point is described exactly as a vector is, by a length and a direction, and later uses parametric equations to follow a projectile whose velocity has horizontal and vertical components v₀ cos θ and v₀ sin θ.

## Self-check

1. Forces of 25 lb at 20° and 35 lb at 75° act on one point. Find the magnitude of the resultant.
2. A 120 N lantern hangs from two cables, each making 30° with the horizontal. Find the tension in each.
3. A 150 lb box sits on a ramp inclined at 25°. Find the force needed to hold it in place, ignoring friction.
4. A plane heads due north at 300 mph in a wind blowing from the west at 40 mph. Find its ground speed and course.
5. A boat that moves at 8 km/h in still water must cross a river whose current is 3 km/h, landing directly opposite. At what angle upstream should it aim?

*Answers:* 1. ⟨32.551, 42.358⟩, magnitude ≈ 53.42 lb. 2. 2T sin 30° = 120, T = 120 N each. 3. 150 sin 25° ≈ 63.39 lb. 4. √(300² + 40²) ≈ 302.65 mph on a course of tan⁻¹(40/300) ≈ 7.6°, bearing 007.6°. 5. sin α = 3/8, α ≈ 22.02°.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSN-VM.A.3, HSN-VM.B.4, HSG-SRT.D.11). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
