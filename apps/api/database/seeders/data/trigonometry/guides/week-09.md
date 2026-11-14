# Week 9 · Graphs of Tangent, Cotangent, Secant and Cosecant

**Topics:** 2.5 Graphs of Tangent and Cotangent · 2.6 Graphs of Secant and Cosecant
**Standards:** HSF-TF.A.2, HSF-TF.A.4, HSF-TF.B.5
**Spiral:** Week 5 showed that tan θ, cot θ, sec θ and csc θ are undefined at certain quadrantal angles; this week those gaps become vertical asymptotes. Week 6's quotient and reciprocal identities, tan x = sin x/cos x and sec x = 1/cos x, explain every feature of the four graphs. Weeks 7 and 8 supply the sine and cosine graphs that act as guides, and the same rules for b and for shifts, with one change for tangent and cotangent: their period is π.

## What you need to be able to do

- **2.5** Graph y = tan x and y = cot x: period π, vertical asymptotes, zeros, increasing or decreasing between asymptotes, and odd symmetry.
- **2.5** Find the period π/|b|, the asymptotes and three key points of y = a tan(b(x − h)) + k and the cotangent version.
- **2.6** Graph y = sec x and y = csc x from their guide functions y = cos x and y = sin x, and state their domains and ranges.
- **2.6** Find the period, asymptotes, local maximum and minimum points and range of y = a sec(b(x − h)) + k and y = a csc(b(x − h)) + k.

## Key terms

| Term | Meaning |
|---|---|
| Vertical asymptote | A line x = c that the graph approaches but never meets, where the function's denominator is 0 and its outputs grow without bound. |
| Branch | One unbroken piece of a graph between two consecutive asymptotes. |
| Guide function | The sine or cosine graph whose reciprocal is being drawn: y = a cos(bx) guides y = a sec(bx). |
| Local minimum / maximum | The lowest point of a branch opening upward, or the highest point of a branch opening downward. |
| Period of tan and cot | π: the shortest horizontal length after which the graph repeats. |

## Tangent (2.5)

Since tan x = sin x/cos x, tangent is 0 where sine is 0 (x = kπ) and undefined where cosine is 0 (x = π/2 + kπ). Near x = π/2 from the left, sin x is close to 1 and cos x is a small positive number, so the quotient is huge and positive; from the right, cos x is a small negative number, so the quotient is huge and negative.

| x | −π/2 | −π/3 | −π/4 | 0 | π/4 | π/3 | π/2 |
|---|---|---|---|---|---|---|---|
| tan x | undefined | −√3 | −1 | 0 | 1 | √3 | undefined |

One branch climbs from −∞ to ∞ between x = −π/2 and x = π/2 through (0, 0), and the graph repeats it every π, because x and x + π are opposite points on the unit circle, with both coordinates negated and the same quotient.

## Cotangent (2.5)

cot x = cos x/sin x, so the roles swap: zeros where cosine is 0 (x = π/2 + kπ) and asymptotes where sine is 0 (x = kπ). Each branch falls from ∞ to −∞ between x = 0 and x = π, passing through (π/4, 1), (π/2, 0) and (3π/4, −1).

| Feature | y = tan x | y = cot x |
|---|---|---|
| Domain | x ≠ π/2 + kπ | x ≠ kπ |
| Range | all real numbers | all real numbers |
| Period | π | π |
| Asymptotes | x = π/2 + kπ | x = kπ |
| Zeros | x = kπ | x = π/2 + kπ |
| Direction | increasing on each branch | decreasing on each branch |
| Symmetry | odd | odd |

Neither has an amplitude: there is no maximum or minimum.

## Transforming tangent and cotangent (2.5)

In y = a tan(b(x − h)) + k:

- the **period is π/|b|**;
- asymptotes come where b(x − h) = ±π/2 (then repeat every period); for cotangent, where b(x − h) = 0 or π;
- the centre of a tangent branch, where the inside is 0, has height k, and the two points a quarter period either side have heights k − a and k + a;
- a < 0 reverses the direction of every branch.

**Worked example 1.** Graph one branch of y = 2 tan(x/2).

Period π ÷ (1/2) = 2π. Asymptotes where x/2 = ±π/2: x = −π and x = π. Centre (0, 0). Quarter period π/2 either side: (−π/2, 2 tan(−π/4)) = (−π/2, −2) and (π/2, 2). The branch rises from −∞ to ∞ between x = −π and x = π, and repeats every 2π.

**Worked example 2.** Graph one branch of y = −cot(2x).

Period π/2. Asymptotes where 2x = 0 or π: x = 0 and x = π/2. Zero where 2x = π/2: x = π/4. At x = π/8, −cot(π/4) = −1; at x = 3π/8, −cot(3π/4) = 1. Because a = −1, the branch **rises** from −∞ to ∞, unlike the falling branches of cot x.

**Worked example 3 (a shift).** Find the asymptotes and centre of y = tan(x − π/4) + 1 on the branch containing x = π/4.

Asymptotes where x − π/4 = ±π/2: x = −π/4 and x = 3π/4. Centre at x = π/4, height 1. Check x = π/2: tan(π/4) + 1 = 2.

## Secant and cosecant from their guides (2.6)

Since sec x = 1/cos x, sketch y = cos x lightly and take reciprocals:

- where cos x = 0, sec x has a **vertical asymptote**;
- where cos x = 1, sec x = 1, and where cos x = −1, sec x = −1: the guide's maxima and minima are shared, and become turning points of U-shaped branches;
- where cos x is a small positive number, sec x is a large positive number, so each branch opens **away** from the midline, upward over a hump of the guide and downward under a trough.

So y = sec x has asymptotes at x = π/2 + kπ, local minima (2kπ, 1) and local maxima (π + 2kπ, −1). Its range is (−∞, −1] ∪ [1, ∞): no output strictly between −1 and 1, because the reciprocal of a number between −1 and 1 is never in that interval. The period is 2π, like the guide's. Cosecant works the same way from y = sin x: asymptotes at x = kπ, local minima (π/2 + 2kπ, 1), local maxima (3π/2 + 2kπ, −1), the same range.

| Feature | y = sec x | y = csc x |
|---|---|---|
| Guide | y = cos x | y = sin x |
| Domain | x ≠ π/2 + kπ | x ≠ kπ |
| Range | (−∞, −1] ∪ [1, ∞) | (−∞, −1] ∪ [1, ∞) |
| Period | 2π | 2π |
| Symmetry | even | odd |

**Worked example 4.** Graph y = 3 sec x on [−π/2, 3π/2] and give its range.

Guide y = 3 cos x. Asymptotes at x = −π/2, π/2 and 3π/2, where the guide is 0. Local minimum (0, 3), where the guide peaks; local maximum (π, −3), where it bottoms out. Branches open upward on (−π/2, π/2) and downward on (π/2, 3π/2). Range (−∞, −3] ∪ [3, ∞).

**Worked example 5.** Find the period, asymptotes, turning points and range of y = −2 csc(2x) + 1.

Guide y = −2 sin(2x) + 1, period π, midline y = 1. Asymptotes where sin(2x) = 0: x = kπ/2. At x = π/4 the guide is −2 + 1 = −1, its minimum, so the cosecant branch on (0, π/2) opens **downward** with local maximum (π/4, −1). At x = 3π/4 the guide is 3, so the branch on (π/2, π) opens upward with local minimum (3π/4, 3). Range (−∞, −1] ∪ [3, ∞): nothing strictly between the guide's minimum and maximum.

## Common errors

- **Period 2π/|b| for tangent or cotangent.** It is π/|b|. Only sine, cosine, secant and cosecant use 2π.
- **Swapping asymptotes and zeros.** Tangent's asymptotes are cotangent's zeros, and the other way round.
- **Giving secant a range of [−a, a].** The secant's range is everything outside the open interval between the guide's minimum and maximum.
- **Drawing secant branches through the guide's zeros.** Those x-values are asymptotes.
- **Calculating sec x as cos⁻¹ x.** sec x = 1/cos x; cos⁻¹ is the inverse function from week 11.
- **Forgetting that a < 0 flips direction.** −tan x decreases on every branch.

## Where this goes next

Week 10 returns to sine and cosine to build models of periodic motion. Week 11 restricts the domain of tangent to (−π/2, π/2) to define tan⁻¹, and the branch drawn this week becomes its graph reflected across y = x. Week 12 does the same for cotangent, secant and cosecant. In Unit 3, identities such as 1 + tan²x = sec²x connect these graphs.

## Self-check

1. State the period, asymptotes and zero of y = tan(3x) on (−π/6, π/6).
2. Graph one branch of y = 4 cot(x/2): give the asymptotes and three key points.
3. Find the asymptotes on [0, 2π] and the turning points of y = 2 csc(x − π/4).
4. What is the range of y = −3 sec x + 2?
5. Explain why y = sec x is undefined at x = π/2 and why its outputs are never 0.

---

*Original study material written for this course, organised around the Common Core State Standards for Mathematics (HSF-TF.A.2, HSF-TF.A.4, HSF-TF.B.5); its approach follows the trigonometry lessons of IM 9–12 Math by Illustrative Mathematics (© 2019, CC BY 4.0). © 2026 24 Hour Classroom, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/).*
