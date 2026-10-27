# Week 27 · Parametric Functions and Planar Motion

**Topics:** 4.1 Parametric Functions · 4.2 Parametric Functions Modeling Planar Motion · 4.3 Parametric Functions and Rates of Change
**Practices:** 1 (procedural and symbolic fluency), 2 (multiple representations), 3 (communication and reasoning)
**Framework:** AP Precalculus CED, Unit 4, Topics 4.1–4.3, learning objectives in our own words. Unit 4 is not assessed on the AP exam; it is taught here as the rest of a full precalculus course and as preparation for calculus.
**Spiral:** Week 1's idea of two quantities changing in tandem and average rate of change as the slope of a secant; week 13's composition and inverses (eliminating a parameter is substitution); weeks 18–19's coordinates (cos θ, sin θ) on a circle; weeks 25–26, where a polar curve r = f(θ) was already a curve traced out as θ runs. From Algebra 2: solving a linear equation for one variable and the vertex form of a quadratic.

## What you need to be able to do

- **4.1** Describe a parametric function as a pair of functions x(t) and y(t) of one input t, and build a table of (t, x, y) values to sketch the path it traces.
- **4.1** State the direction in which the path is traced as t increases, and mark it with arrows.
- **4.1** Eliminate the parameter in simple cases (solve one equation for t and substitute) to get an equation in x and y, and state any restriction on x or y that the parametrization imposes.
- **4.2** Model motion in the plane with x(t) for horizontal position and y(t) for vertical position, including a projectile with constant horizontal speed and a vertical position that is quadratic in t.
- **4.2** Answer questions about the motion in context: where the object is at a given time, when it reaches a height, when it lands, how far it travels horizontally.
- **4.3** Compute the average rate of change of x with respect to t and of y with respect to t over an interval, with units, and interpret each.
- **4.3** Find the slope of the path between two points as (Δy/Δt)/(Δx/Δt) = Δy/Δx, and decide from x(t) and y(t) whether the object is moving left or right, up or down.

## Key terms

| Term | Meaning |
|---|---|
| Parameter | The input variable t (often time) on which both coordinates depend. |
| Parametric function | A function from t to the point (x(t), y(t)); its two component functions are x(t) and y(t). |
| Path (curve) | The set of points (x(t), y(t)) traced as t runs over its domain. |
| Orientation | The direction the path is traced as t increases; shown with arrows. |
| Eliminating the parameter | Combining x(t) and y(t) into one equation in x and y that the path satisfies. |
| Planar motion | Movement of an object in a flat plane, described by its horizontal and vertical positions over time. |
| Average rate of change of x | (x(b) − x(a))/(b − a), the average horizontal velocity on [a, b]. |
| Slope of the path | Δy/Δx = (Δy/Δt)/(Δx/Δt), the slope of the segment joining two points on the path. |

## Two functions, one input (4.1)

So far a function has usually been y = f(x): one input, one output, drawn as a graph that passes the vertical line test. A **parametric function** uses a third variable t to drive both coordinates at once:

x = x(t), y = y(t), for t in some interval.

Each value of t produces a point (x(t), y(t)). As t runs, the point moves and leaves a trail, the path. Think of t as the clock, x(t) as the shadow of the point on the floor and y(t) as its shadow on a wall.

Three things are different from an ordinary graph:

1. **t does not appear on the picture.** You plot (x, y) and label a few points with their t-values.
2. **The path need not be a function of x.** A parametric path can loop, cross itself or double back; the vertical line test does not apply.
3. **The path has a direction.** Two parametrizations can trace the same curve in opposite directions or at different speeds.

**Worked example.** Sketch the path of x(t) = t² − 1, y(t) = 2t + 1 for −2 ≤ t ≤ 2.

| t | −2 | −1 | 0 | 1 | 2 |
|---|---|---|---|---|---|
| x = t² − 1 | 3 | 0 | −1 | 0 | 3 |
| y = 2t + 1 | −3 | −1 | 1 | 3 | 5 |

Plot (3, −3), (0, −1), (−1, 1), (0, 3), (3, 5) in order of t. The points form a parabola opening to the right with its leftmost point at (−1, 1). As t increases, y = 2t + 1 increases, so the path is traced from the bottom, (3, −3), to the top, (3, 5). Arrows point upward along the curve. Notice x = 0 occurs twice (t = −1 and t = 1): this curve fails the vertical line test, yet it is a perfectly good parametric function.

**Eliminating the parameter.** If one equation is easy to solve for t, solve it and substitute into the other.

From y = 2t + 1: t = (y − 1)/2. Then x = ((y − 1)/2)² − 1, that is, x = (y − 1)²/4 − 1. This is a sideways parabola with vertex (−1, 1), as the table suggested. The t-interval −2 ≤ t ≤ 2 becomes −3 ≤ y ≤ 5, so the path is only the piece of that parabola with −3 ≤ y ≤ 5.

**Worked example.** Eliminate the parameter: x = 3t − 2, y = 6t + 5.

t = (x + 2)/3, so y = 6(x + 2)/3 + 5 = 2(x + 2) + 5 = 2x + 9. The path is the line y = 2x + 9 with slope 2. For every 1 unit t increases, x goes up by 3 and y by 6; the ratio 6/3 = 2 is the slope.

**Worked example.** Eliminate the parameter: x = √t, y = t, t ≥ 0.

From x = √t, t = x², so y = x². But x = √t is never negative, so the path is only the right half of the parabola y = x², starting at (0, 0). Eliminating the parameter can hide a restriction like this; always ask what values x and y can actually take.

**Polar curves were already parametric.** In week 25 a polar curve r = f(θ) was traced as θ ran. In rectangular coordinates its points are x = f(θ) cos θ, y = f(θ) sin θ: a parametric function with θ as the parameter. For the circle r = 4 cos θ this gives x = 4cos²θ, y = 4 cos θ sin θ.

**Try it.**
1. Make a table for x = 2t, y = t² − 3 at t = −2, −1, 0, 1, 2 and describe the path and its direction.
2. Eliminate the parameter: x = t + 4, y = 1 − 2t.
3. Eliminate the parameter: x = eᵗ, y = 2t. State any restriction on x.

*Answers:* 1. Points (−4, 1), (−2, −2), (0, −3), (2, −2), (4, 1): an upward-opening parabola y = x²/4 − 3 traced left to right. 2. t = x − 4, so y = 1 − 2(x − 4) = 9 − 2x. 3. t = ln x, so y = 2 ln x, with x > 0.

## Modelling motion in the plane (4.2)

When t is time, x(t) and y(t) describe where an object is. Each component can be studied on its own: x(t) tells you how the object moves horizontally, y(t) how it moves vertically. Putting them together gives the actual path.

**Projectiles.** Ignoring air resistance, a thrown object moves horizontally at a constant speed, so x(t) is linear. Vertically, gravity makes the height a quadratic in t. In feet and seconds, the vertical position is about

y(t) = h₀ + v₀t − 16t²,

where h₀ is the starting height and v₀ is the starting upward speed. (In metres, −16t² becomes about −4.9t².) If an object is launched at speed s at angle θ above horizontal, its horizontal and vertical starting speeds are s cos θ and s sin θ: the same cosine and sine you used for coordinates on a circle of radius s.

**Worked example.** In a hypothetical model, a ball is thrown from a height of 6 feet with horizontal speed 40 ft/s and initial upward speed 48 ft/s. So x(t) = 40t and y(t) = 6 + 48t − 16t², with t in seconds.

- *Position at t = 1:* (40, 6 + 48 − 16) = (40, 38).
- *Highest point:* y(t) is a downward parabola in t with vertex at t = −48/(2 · (−16)) = 1.5. Then y(1.5) = 6 + 72 − 36 = 42 feet, reached when x = 60 feet.
- *Landing:* solve 6 + 48t − 16t² = 0, or 16t² − 48t − 6 = 0. The quadratic formula gives t = (48 + √2688)/32 ≈ 3.12 seconds (the negative root is before the throw). Horizontal distance x ≈ 40 · 3.12 ≈ 124.8 feet.
- *The path:* eliminating t (t = x/40) gives y = 6 + 1.2x − 0.01x², a parabola in x, as you expect for a thrown ball.

**Worked example.** A hypothetical delivery drone is tracked every 2 seconds (positions in metres from a launch pad).

| t (s) | 0 | 2 | 4 | 6 | 8 |
|---|---|---|---|---|---|
| x(t) (m) | 0 | 6 | 10 | 12 | 12 |
| y(t) (m) | 5 | 9 | 11 | 9 | 4 |

From the table alone: x never decreases, so the drone never moves left; between t = 6 and t = 8 x does not change, so (as far as the table shows) the drone is moving straight down. y rises until about t = 4 and falls afterwards. The drone was highest near t = 4 at about 11 m.

**Try it.**
1. A stone is thrown from a 64-foot cliff with x(t) = 30t and y(t) = 64 + 0t − 16t². When does it land, and how far from the base of the cliff?
2. A ball leaves the ground at 50 ft/s at an angle of π/6 above the horizontal. Write x(t) and y(t).

*Answers:* 1. 64 − 16t² = 0 gives t = 2 s; x(2) = 60 ft. 2. Horizontal speed 50 cos(π/6) = 25√3 ≈ 43.3 ft/s, vertical 50 sin(π/6) = 25 ft/s: x(t) = 25√3 t, y(t) = 25t − 16t².

## Rates of change along a path (4.3)

Because x and y are each functions of t, each has its own average rate of change over an interval [a, b]:

- Δx/Δt = (x(b) − x(a))/(b − a): horizontal change per unit of t (horizontal velocity, if t is time).
- Δy/Δt = (y(b) − y(a))/(b − a): vertical change per unit of t.

Their signs describe the motion:

| Sign | Meaning |
|---|---|
| Δx/Δt > 0 | moving right (x increasing) |
| Δx/Δt < 0 | moving left |
| Δy/Δt > 0 | moving up (y increasing) |
| Δy/Δt < 0 | moving down |

The **slope of the path** between the points at t = a and t = b is the slope of the segment joining them:

Δy/Δx = (Δy/Δt)/(Δx/Δt), provided Δx ≠ 0.

The Δt cancels: the slope only depends on the two points, not on how long the trip took. Over smaller and smaller intervals around a value of t, these average slopes approach the slope of the path at that point, just as in week 1 average rates approached the rate of change at a point. In calculus this becomes dy/dx = (dy/dt)/(dx/dt).

Special cases to recognise:

- If y changes but x does not (Δx/Δt = 0), the segment is vertical: the slope is undefined.
- If x changes but y does not, the segment is horizontal: slope 0.

**Worked example.** For the ball above, x(t) = 40t and y(t) = 6 + 48t − 16t².

| Interval | Δx/Δt | Δy/Δt | Slope of path |
|---|---|---|---|
| [0, 1] | 40 ft/s | (38 − 6)/1 = 32 ft/s | 32/40 = 0.8 |
| [1, 2] | 40 ft/s | (38 − 38)/1 = 0 ft/s | 0 |
| [2, 3] | 40 ft/s | (6 − 38)/1 = −32 ft/s | −0.8 |

Horizontally the ball moves at a steady 40 ft/s. Vertically it rises at an average of 32 ft/s in the first second, then on average not at all between t = 1 and t = 2 (it goes up to 42 and back down to 38), then falls at 32 ft/s. The path rises steeply, levels out over the top and falls symmetrically.

**Worked example.** For the drone table, find the average rate of change of x and of y on [2, 6], and the slope of the path on [0, 4].

On [2, 6]: Δx/Δt = (12 − 6)/4 = 1.5 m/s and Δy/Δt = (9 − 9)/4 = 0 m/s. On average the drone moved right at 1.5 m/s with no net change in height. On [0, 4]: Δx = 10, Δy = 6, so the slope of the path is 6/10 = 0.6; for every metre of horizontal travel the drone rose 0.6 m on average.

**Worked example.** For x(t) = t² − 1, y(t) = 2t + 1, find the slope of the path on [0, 2] and on [−2, 0].

On [0, 2]: Δx = 3 − (−1) = 4, Δy = 5 − 1 = 4, slope 1. On [−2, 0]: Δx = −1 − 3 = −4, Δy = 1 − (−3) = 4, slope −1. On the lower half the point moves left as it rises (negative slope); on the upper half it moves right as it rises.

**Try it.**
1. For x(t) = 2t + 1, y(t) = t³, find Δx/Δt, Δy/Δt and the slope of the path on [1, 3].
2. Using the drone table, on which 2-second interval is the drone moving down most quickly on average?

*Answers:* 1. Δx/Δt = 2, Δy/Δt = (27 − 1)/2 = 13, slope 13/2 = 6.5. 2. [6, 8], where Δy/Δt = (4 − 9)/2 = −2.5 m/s.

## Calculator notes

Put the calculator in parametric mode (often labelled PAR) to enter X₁T and Y₁T. Set Tmin, Tmax and a small Tstep (such as 0.05); the window's x and y settings are separate from the t settings. The trace feature reports t, x and y together, which is the quickest way to read off a landing time or a highest point. Without a calculator, a table of five or six t-values is usually enough to see the shape and the direction.

## Common mistakes

- **Plotting t on an axis.** The picture is x against y; t appears only as labels on points.
- **Forgetting the direction.** A path drawn without arrows is incomplete; check whether x or y increases as t increases.
- **Dropping a restriction when eliminating t.** x = √t, y = t is only the right half of y = x².
- **Dividing in the wrong order for slope.** The slope is Δy/Δx = (Δy/Δt)/(Δx/Δt), not (Δx/Δt)/(Δy/Δt).
- **Using the landing time from the wrong root.** In 16t² − 48t − 6 = 0, the negative root is before the throw.
- **Mixing units.** Rates with respect to t carry units like ft/s; the slope of the path is feet per foot, so it has no units.

## Where this goes next

Week 28 parametrizes circles and line segments exactly (x = h + r cos t, y = k + r sin t) and introduces curves given implicitly by an equation in x and y. Week 29 parametrizes ellipses and hyperbolas. In week 30 the pair (x(t), y(t)) becomes a position vector ⟨x(t), y(t)⟩, and the two rates Δx/Δt and Δy/Δt become the components of an average velocity vector.

## Self-check

1. Make a table for x = 1 − t, y = t² at t = −2, −1, 0, 1, 2; sketch the path and mark its direction.
2. Eliminate the parameter from x = 2t − 3, y = 4t² and state the shape of the path.
3. A ball is kicked from the ground with x(t) = 35t and y(t) = 56t − 16t². Find its maximum height and its horizontal distance at landing.
4. For the ball in question 3, find the slope of the path on [0, 1] and on [2, 3]. What do the signs tell you?
5. Explain why a parametric path can fail the vertical line test even though x(t) and y(t) are both functions.

---

*Original study material for this course, organised around the College Board AP Precalculus Course and Exam Description (Unit 4, Topics 4.1–4.3). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). AP® is a trademark of the College Board, which does not endorse this material.*
