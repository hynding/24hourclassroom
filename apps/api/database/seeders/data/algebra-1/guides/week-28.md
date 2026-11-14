# Week 28 · Quadratic Equations by Reasoning and the Zero Product Property

**Lessons:** 7.1 Finding Unknown Inputs · 7.2 When and Why Do We Write Quadratic Equations? · 7.3 Solving Quadratic Equations by Reasoning · 7.4 Solving Quadratic Equations with the Zero Product Property · 7.5 How Many Solutions?
**Practices:** MP1 (work backwards from a known output), MP2 (write an equation that captures a situation), MP3 (explain why a product being 0 forces a factor to be 0), MP6 (keep both square roots)
**Built from:** IM Algebra 1, Unit 7, Lessons 1–5, in our own words
**Spiral:** Factored form and the zeros it displays (weeks 25 and 26) become a solving tool. Projectile and area functions (week 25) supply the equations. Equations and their solutions (week 5) remind you that a solution is a value that makes the equation true, and domain (week 17) tells you which solutions a situation accepts.

## What you need to be able to do

- **7.1** Recognise when a question asks for an unknown input of a quadratic function, and find it by reasoning, by a table, or by a graph.
- **7.2** Write a quadratic equation for an area, a frame, a projectile or a revenue situation, and explain why a graph gives only approximate solutions.
- **7.3** Solve equations in which a square can be isolated, such as 3x² − 5 = 70 and (x − 1)² = 16, keeping both square roots.
- **7.4** State and use the zero product property, and explain why the equation must have 0 on one side.
- **7.5** Explain why a quadratic equation can have two, one or no solutions, using graphs and the properties of squares.

## Key terms

| Term | Meaning |
|---|---|
| Quadratic equation | An equation that can be written ax² + bx + c = 0 with a ≠ 0. |
| Solution | A value that makes the equation true. |
| Zero product property | If a · b = 0, then a = 0 or b = 0. |
| Square root | A number whose square is the given number; every positive number has two, one positive and one negative. |

## Finding unknown inputs (7.1)

Unit 6 asked for outputs: how high is the ball at t = 2? This unit asks the reverse: when is the ball 36 feet up? The output is known, the input is wanted, and that means solving an equation.

**Working backwards.** h(t) = 100 − 16t² equals 36 when 16t² = 64, so t² = 4 and t = 2. (The other square root, −2, is before the drop.)

**Tables.** A garden 3 metres longer than it is wide has area w(w + 3). For w = 1 to 6 the areas are 4, 10, 18, 28, 40, 54, so an area of 40 needs w = 5. An area of 50 falls between w = 5 and w = 6, and the table cannot say where. Guess-and-check works only when the answer is a value you happen to try.

**Graphs.** Draw y = w(w + 3) and the line y = 50; they cross near w = 5.7. Useful, but approximate.

**Worked example.** A stone dropped from 144 feet has height 144 − 16t². When is it 80 feet up?
144 − 16t² = 80, so 16t² = 64, t² = 4, t = 2 seconds.

**Try it.** For the same stone, when does it land?
*Answer:* 16t² = 144, t² = 9, t = 3 seconds.

## Writing quadratic equations (7.2)

The situations of unit 6 produce equations as soon as an output is fixed.

- **Area.** Garden, width w, length w + 3, area 40: w(w + 3) = 40.
- **Frame.** An 8-by-10 photo with a frame of width x on every side covers (8 + 2x)(10 + 2x) square inches; if that is 168, the equation is (8 + 2x)(10 + 2x) = 168. Each dimension grows by 2x, because the frame runs along both sides.
- **Projectile.** h(t) = 64t − 16t² is on the ground when 64t − 16t² = 0.
- **Revenue.** r(p) = p(200 − 10p) equals 750 when p(200 − 10p) = 750.

Each is quadratic: rearranged, it has the form ax² + bx + c = 0. The rest of the unit is about solving such equations exactly, because graphs and tables give decimals that are only approximately right. x² − 4x − 3 = 0, for instance, has solutions near −0.65 and 4.65 that no table of whole numbers will find.

**Worked example.** A 12-by-16 print has a border of width x and the whole covers 320 square inches. Write the equation and expand it.
(12 + 2x)(16 + 2x) = 320; 192 + 56x + 4x² = 320; 4x² + 56x − 128 = 0; dividing by 4, x² + 14x − 32 = 0.

**Try it.** A square has side s. A rectangle 2 units longer and 2 units wider than the square has area 48. Write an equation.
*Answer:* (s + 2)(s + 2) = 48, or (s + 2)² = 48.

## Solving by reasoning (7.3)

When a square can be isolated, think about what squares to the number.

- x² = 49: two numbers square to 49, so **x = 7 or x = −7**.
- 3x² − 5 = 70: 3x² = 75, x² = 25, x = ±5. Undo the subtraction, then the multiplication, then the square.
- (x − 1)² = 16: the thing being squared is 4 or −4. x − 1 = 4 gives x = 5; x − 1 = −4 gives x = −3.
- (x + 3)² = 100: x + 3 = ±10, x = 7 or x = −13.
- x² = −9: nothing squares to a negative number. No solutions.

The habit to build: **a positive number has two square roots**, and both give solutions unless the situation rejects one.

**Worked example.** Solve 2(x − 5)² = 32.
(x − 5)² = 16; x − 5 = ±4; x = 9 or x = 1.

**Try it.** Solve x² + 11 = 92 and (x + 2)² = 49.
*Answers:* x² = 81, x = ±9; x + 2 = ±7, x = 5 or x = −9.

## The zero product property (7.4)

Multiply two numbers and get 0, and one of them must have been 0: **if a · b = 0, then a = 0 or b = 0**. Nothing like this holds for any other product; 2 · 5, (−1)(−10) and 20 · 0.5 all equal 10.

So an equation written as a product equal to 0 splits into linear equations:

- (x − 3)(x + 7) = 0: x − 3 = 0 or x + 7 = 0, so x = 3 or x = −7.
- x(2x − 5) = 0: x = 0 or 2x = 5, so x = 0 or x = 5/2.
- 3(x + 2)(x − 8) = 0: the 3 is never 0, so x = −2 or x = 8.
- 64t − 16t² = 0: factor, 16t(4 − t) = 0, so t = 0 or t = 4.

**The one condition.** The other side must be 0. (x − 3)(x + 7) = 10 cannot be split into x − 3 = 10 or x + 7 = 10; checking x = 3 gives (0)(10) = 0, not 10. Move everything to one side and factor again: the garden equation w(w + 3) = 40 becomes w² + 3w − 40 = 0, then (w + 8)(w − 5) = 0, so w = 5 (a width cannot be −8).

**Worked example.** Solve x² = 6x.
x² − 6x = 0; x(x − 6) = 0; x = 0 or x = 6. Dividing both sides by x at the start would have lost the solution 0.

**Try it.** Solve (x + 4)(x − 9) = 0 and x² + 14x − 32 = 0.
*Answers:* −4 or 9; (x + 16)(x − 2) = 0, so −16 or 2.

## How many solutions? (7.5)

A quadratic equation can have **two, one or no** solutions.

- x² = 9: two, 3 and −3.
- (x − 4)² = 0: one, since only 0 squares to 0. The two roots coincide.
- x² = −9, or x² + 4 = 0: none, since a square is never negative.

On a graph, the solutions of x² − 4x = 5 are the x-coordinates where y = x² − 4x meets the horizontal line y = 5: at −1 and 5. A horizontal line can cross a parabola twice, touch it once at the vertex, or miss it altogether, which is why there are exactly three possibilities. The equation x² + 4 = 0 asks where y = x² + 4 meets y = 0, and that parabola sits entirely above the axis.

**Worked example.** How many solutions does x² − 6x + 9 = 0 have?
x² − 6x + 9 = (x − 3)², so the equation is (x − 3)² = 0: one solution, x = 3.

**Try it.** How many solutions do (x + 2)² = −1 and x² − 5 = 20 have?
*Answers:* none; two (x = ±5).

## Common mistakes

- Giving only the positive square root: x² = 49 has solutions 7 and −7.
- Taking the square root before isolating the square: 3x² − 5 = 70 is not x = √(70) anything until it is x² = 25.
- Applying the zero product property to a product equal to a non-zero number.
- Dividing both sides by x and losing the solution x = 0.
- Writing (8 + x)(10 + x) for a frame that adds x on every side.
- Keeping a negative width or a time before the launch as an answer.

## Where this goes next

Week 29 is about writing quadratic expressions in factored form so that the zero product property can be used on equations such as x² + 3x − 40 = 0 and 2x² + 7x + 3 = 0. Weeks 30 and 31 add completing the square and the quadratic formula for equations that do not factor.

## Self-check

1. A ball's height is h(t) = 64 − 16t². When is it 48 feet up?
2. A rectangle is 5 cm longer than it is wide and has area 84 cm². Write an equation.
3. Solve (x + 6)² = 25.
4. Solve (2x − 1)(x + 5) = 0.
5. How many solutions does (x − 1)² = −4 have? And x² − 10x + 25 = 0?

*Answers:* (1) 16t² = 16, t = 1 second. (2) w(w + 5) = 84. (3) x + 6 = ±5, so x = −1 or x = −11. (4) x = 1/2 or x = −5. (5) None; one (x = 5, since the left side is (x − 5)²).

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 7, Lessons 1–5, https://im.kendallhunt.com/HS/teachers/1/7/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
