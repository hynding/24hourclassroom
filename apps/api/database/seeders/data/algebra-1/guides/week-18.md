# Week 18 · Inverse Functions and Modelling with Functions

**Lessons:** 4.15 Inverse Functions · 4.16 Finding and Interpreting Inverse Functions · 4.17 Writing Inverse Functions to Solve Problems · 4.18 Using Functions to Model Battery Power
**Practices:** MP2 (keep track of which quantity is now the input), MP4 (choose and use a function to model a situation), MP7 (see solving for the other variable as building the inverse)
**Built from:** IM Algebra 1, Unit 4, Lessons 15–18, in our own words
**Spiral:** "Which variable to solve for?" (unit 2, lessons 2.8–2.9) is exactly the algebra of finding an inverse. The domain and range vocabulary of week 17 swaps roles between a function and its inverse. The battery lesson revisits average rate of change and linear models from weeks 13 and 16.

## What you need to be able to do

- **4.15** Explain what the inverse of a function is: the rule that takes the original outputs back to the original inputs, and when such a rule exists.
- **4.16** Find the inverse of a linear function by solving for the input, and interpret the inverse in context.
- **4.17** Use an inverse to answer "what input gives this output?" questions efficiently, including conversions and formulas.
- **4.18** Model a situation such as a draining battery with a function, decide whether it is linear, and use the model and its inverse to answer questions.

## Key terms

| Term | Meaning |
|---|---|
| Inverse function | A function that undoes another: if f(a) = b then the inverse sends b back to a. |
| Swapping roles | For the inverse, the original output becomes the input and the original input becomes the output. |
| Domain and range of the inverse | The domain of the inverse is the range of the original, and the range of the inverse is the domain of the original. |
| Invertible | A function has an inverse function only if each output comes from exactly one input. |

## What an inverse is (4.15)

Suppose C(t) = 15t + 20 gives the cost in dollars of a bike rental lasting t hours. C answers "how much for t hours?" The reverse question, "how many hours can I rent for d dollars?", is answered by the **inverse function**: it takes a cost d and returns the hours t.

A table makes it concrete. If C sends 1 → 35, 2 → 50, 3 → 65, then the inverse sends 35 → 1, 50 → 2, 65 → 3: the same pairs, read the other way.

**When does an inverse function exist?** Only if no output is shared by two inputs. The ball-height function h(t) has the same height at two different times, so "the time at which the height is 20 m" is not a function: there are two answers. A linear function with non-zero slope never repeats an output, so it always has an inverse.

**Worked example.** F(c) = 1.8c + 32 converts Celsius to Fahrenheit. The inverse converts Fahrenheit to Celsius. F(100) = 212, so the inverse sends 212 to 100.

**Try it.** P(n) = 4n is the perimeter of a square of side n. What does the inverse do, and what does it send 36 to?
*Answer:* It gives the side from the perimeter; 36 → 9.

## Finding and interpreting inverses (4.16)

To find the inverse of a linear function, solve the equation for the input.

C(t) = 15t + 20. Write d = 15t + 20, then solve for t: d − 20 = 15t, so t = (d − 20)/15. The inverse is the rule t = (d − 20)/15: subtract the fixed fee, then divide by the hourly rate. Interpretation: for d dollars you get (d − 20)/15 hours.

Check with a pair: C(2) = 50, and (50 − 20)/15 = 2.

**Worked example.** F = 1.8c + 32. Solve for c: F − 32 = 1.8c, so c = (F − 32)/1.8. Check: (212 − 32)/1.8 = 100.

**Worked example.** A function given by a table: x = 2, 4, 6 and g(x) = 7, 11, 15. Write the inverse's table and its rule.
Inverse: 7 → 2, 11 → 4, 15 → 6. The rule for g is g(x) = 2x + 3 (rate 2, starting value 3); solving y = 2x + 3 for x gives x = (y − 3)/2, and (11 − 3)/2 = 4 as required.

**Domain and range swap.** If C has domain 0 ≤ t ≤ 8 (rentals up to 8 hours) and range 20 ≤ C ≤ 140, then the inverse has domain 20 ≤ d ≤ 140 and range 0 ≤ t ≤ 8.

**Try it.** Find the inverse of f(x) = 3x − 7 and use it to find the x with f(x) = 20.
*Answers:* x = (y + 7)/3; (20 + 7)/3 = 9.

## Using inverses to solve problems (4.17)

Any time you must answer "what input gives this output?" repeatedly, build the inverse once instead of solving a new equation each time.

**Worked example.** A charity walk raises R(k) = 12k + 300 dollars when k kilometres are walked. The organisers want a table of how far must be walked for targets of $600, $900 and $1,500.
Inverse: k = (R − 300)/12. Targets: (600 − 300)/12 = 25 km; (900 − 300)/12 = 50 km; (1,500 − 300)/12 = 100 km.

**Worked example.** A recipe scales as S(p) = 0.25p cups of rice for p people. For 3 cups, how many people? Inverse p = S/0.25 = 4S, so 12 people.

**Worked example.** Two conversions: m miles to kilometres, K(m) = 1.6m; kilometres back to miles, m = K/1.6. A 10 km race is 6.25 miles.

**Try it.** A printer charges P(n) = 0.08n + 5 dollars for n pages. Write the inverse and find how many pages $21 buys.
*Answers:* n = (P − 5)/0.08; 200 pages.

## Modelling battery power (4.18)

A phone's battery is at 100% at 8:00 and at 76% at 11:00 with normal use. Is the drain linear? If the percentage fell by the same amount each hour, a linear model is reasonable: the rate is (76 − 100)/3 = −8 percentage points per hour, so B(t) = 100 − 8t with t hours after 8:00.

Questions the model answers:

- **When will the battery be at 20%?** 100 − 8t = 20 gives t = 10, so at 18:00. (Using the inverse t = (100 − B)/8.)
- **When is it empty?** t = 12.5, at 20:30.
- **Domain:** 0 ≤ t ≤ 12.5. **Range:** 0 ≤ B ≤ 100.

If data at 14:00 showed 40% rather than the predicted 52%, the drain was faster in the afternoon (perhaps heavier use) and a single line no longer fits: a piecewise model, one line until 11:00 and a steeper one after, would describe it better. Check a model against every data point you have before trusting it.

**Worked example.** A laptop charges from 15% to 65% in 50 minutes. Model, and find when it reaches 100%.
Rate 50/50 = 1 percentage point per minute: C(m) = 15 + m. C(m) = 100 at m = 85 minutes. (Real charging slows near full, so this is an estimate.)

**Try it.** A tablet goes from 90% to 60% between 9:00 and 13:00. Write a linear model and find when it hits 0%.
*Answers:* Rate −7.5 per hour; B(t) = 90 − 7.5t; 0 at t = 12, that is 21:00.

## Common mistakes

- Thinking the inverse of f(x) = 3x + 2 is "1/(3x + 2)". The inverse undoes the function; it is not a reciprocal.
- Forgetting to undo operations in reverse order: for 3x + 2, subtract 2 first, then divide by 3.
- Mixing up which letter is now the input when writing the inverse in context.
- Claiming every function has an inverse function; a function that repeats outputs does not.
- Fitting a line through two data points and assuming the rate holds without checking other points.

## Where this goes next

The unit 4 exam covers weeks 15 to 18. Unit 5 introduces exponential functions, where outputs multiply rather than add each step; the average rate of change and inverse ideas return there, and the battery model is a template for every modelling task ahead.

## Self-check

1. f(x) = 5x − 10. Find the inverse rule.
2. Using it, find the x for which f(x) = 35.
3. T(h) = 60h + 40 is a tutor's charge for h hours. Interpret the inverse and write it.
4. Why does the function "height of a thrown ball at time t" have no inverse function?
5. A battery is at 80% at noon and 50% at 15:00. Write a linear model and predict when it reaches 10%.

*Answers:* (1) x = (y + 10)/5. (2) 9. (3) Hours bought for a given charge d: h = (d − 40)/60. (4) The same height occurs at two times, so a height does not determine one time. (5) Rate −10 per hour; B(t) = 80 − 10t with t hours after noon; 10% at t = 7, that is 19:00.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 4, Lessons 15–18, https://im.kendallhunt.com/HS/teachers/1/4/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
