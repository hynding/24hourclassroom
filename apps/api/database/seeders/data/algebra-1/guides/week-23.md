# Week 23 · Comparing Growth and Predicting Populations

**Lessons:** 5.19 Which One Changes Faster? · 5.20 Changes over Equal Intervals · 5.21 Predicting Populations
**Practices:** MP3 (argue which function wins in the long run), MP8 (generalise the equal-interval property), MP4 (model real population data and state the model's limits)
**Built from:** IM Algebra 1, Unit 5, Lessons 19–21, in our own words
**Spiral:** Average rate of change (weeks 16 and 21) decides which function changes faster on an interval. Comparing graphs (week 16) and fitting models to data (weeks 13 and 21) come together in the population lesson. Percent change (week 22) supplies the factors.

## What you need to be able to do

- **5.19** Compare a linear and an exponential function, or two exponential functions, over intervals and in the long run, and explain why exponential growth eventually exceeds any linear growth.
- **5.20** State and use the property that an exponential function is multiplied by the same factor over every interval of the same width, and a linear function changes by the same amount.
- **5.21** Build an exponential model from population data taken at equal intervals, use it to predict, convert between per-decade and per-year factors, and discuss the reliability of predictions.

## Key terms

| Term | Meaning |
|---|---|
| Changes faster | Has the larger average rate of change on the interval in question. |
| Long-run behaviour | What happens as the input grows without bound. |
| Equal intervals | Intervals of the same width anywhere on the input axis. |
| Factor over an interval of width w | bʷ for f(x) = a · bˣ. |
| Doubling time | The interval over which an exponential growth function doubles; the same everywhere on the graph. |

## Which one changes faster? (5.19)

Linear L(t) = 1,000 + 200t and exponential E(t) = 1,000 · 1.1ᵗ.

| t | 0 | 2 | 5 | 10 | 15 | 20 |
|---|---|---|---|---|---|---|
| L(t) | 1,000 | 1,400 | 2,000 | 3,000 | 4,000 | 5,000 |
| E(t) | 1,000 | 1,210 | 1,611 | 2,594 | 4,177 | 6,727 |

From 0 to 5, L changes faster (average rate 200 against about 122). From 10 to 15, E changes faster (about 317 against 200). E passes L between t = 10 and t = 15; checking, at t = 14 L = 3,800 and E ≈ 3,797, at t = 15 E leads. After that E grows ever faster while L plods on at 200 per step.

**The general fact.** An exponential growth function, however small its factor and starting value, eventually exceeds any linear function, because its average rate of change keeps multiplying while the line's stays fixed. The crossing may be far out, but it comes.

**Two exponentials.** 500 · 1.2ᵗ against 100 · 1.5ᵗ: the first starts five times larger, but the second has the larger factor. The ratio of the second to the first is 0.2 · (1.25)ᵗ, which passes 1 when 1.25ᵗ = 5, around t = 7.2. From then on the second is bigger.

**Worked example.** Which changes faster between t = 3 and t = 4: f(t) = 50t or g(t) = 2ᵗ?
f changes by 50. g changes from 8 to 16, by 8. f, on this interval. But between t = 9 and t = 10, g changes by 512 against f's 50.

**Try it.** For h(x) = 100 + 30x and k(x) = 100 · 1.05ˣ, find the average rate of change of each from 0 to 10. Which changed faster?
*Answers:* 30; (162.9 − 100)/10 ≈ 6.3. h, on that interval.

## Changes over equal intervals (5.20)

For a linear function, moving the input by w always adds mw to the output. For an exponential function f(x) = a · bˣ, moving the input by w always multiplies the output by bʷ, no matter where you start:

f(x + w) = a · b^(x + w) = a · bˣ · bʷ = f(x) · bʷ.

So 3ˣ triples over every interval of width 1, multiplies by 9 over every interval of width 2, and by √3 ≈ 1.732 over every interval of width 1/2. A population growing 5% a year grows by 1.05¹⁰ ≈ 1.63, that is 63%, over every decade.

**Using the property.** A quantity is 80 at x = 2 and 120 at x = 5. If it is exponential, the factor over 3 units is 1.5, so at x = 8 it will be 180 and at x = 11 it will be 270, without finding b.

**Doubling time.** If a population doubles in 12 years, it doubles again in the next 12, whatever its size. A culture of 400 that doubles every 3 hours: 800 at 3, 1,600 at 6, 3,200 at 9 hours; N(h) = 400 · 2^(h/3).

**Worked example.** f(x) = 5 · 2ˣ. Show that f(7)/f(4) equals f(12)/f(9).
Both are 2³ = 8: 640/80 and 20,480/2,560.

**Try it.** A quantity is 54 at x = 1 and 162 at x = 3. Find its value at x = 7.
*Answer:* Factor 3 per 2 units; two more intervals: 162 · 9 = 1,458.

## Predicting populations (5.21)

Census data for a city, in thousands: 1990: 240; 2000: 288; 2010: 346; 2020: 415.

1. **Check the ratios:** 288/240 = 1.20; 346/288 ≈ 1.20; 415/346 ≈ 1.20. Constant: exponential, factor 1.2 per decade.
2. **Model:** P(d) = 240 · 1.2ᵈ with d decades after 1990. Per year, the factor is 1.2^(1/10) ≈ 1.0184, about 1.84% a year: P(t) = 240 · 1.0184ᵗ with t in years.
3. **Predict:** 2030 is d = 4: 240 · 1.2⁴ ≈ 498 thousand. 2050 is d = 6: about 717 thousand.
4. **Judge:** The 2030 figure is one step beyond the data and plausible. The 2050 figure assumes 60 years of unbroken 20%-per-decade growth; housing, jobs and land may not allow it. Report it as what the model says, with that caution.

**Linear alternative.** The differences are 48, 58, 69: growing, so a line underestimates. A linear model from the endpoints, 240 + 58.3d, would predict 473 for 2030. When the ratios are constant and the differences grow, the exponential model is the better fit.

**Worked example.** A town had 12,000 people in 2005 and 15,000 in 2015. Assuming exponential growth, predict 2035.
Factor 1.25 per decade; 2035 is three decades after 2005: 12,000 · 1.25³ = 23,437.5, about 23,400.

**Try it.** A bacteria sample is 2,000 at noon and 8,000 at 2 p.m. Assuming exponential growth, what is the count at 5 p.m.?
*Answer:* Factor 4 per 2 hours, so 2 per hour: 2,000 · 2⁵ = 64,000.

## Common mistakes

- Concluding that the linear function "wins" because it is ahead at the start or over one interval.
- Comparing two functions by a single value when the question is about rate of change.
- Dividing the factor by the width instead of taking a root when converting to a shorter interval (1.2 per decade is not 0.12 per year).
- Taking the ratio over several intervals as the per-interval factor.
- Reporting a far-future prediction without any caution about the model's assumptions.

## Where this goes next

The unit 5 exam covers weeks 19 to 23. Unit 6 introduces quadratic functions, a third kind of change in which the differences themselves change by a constant amount; comparing quadratic and exponential growth (lesson 6.4) builds directly on this week.

## Self-check

1. L(t) = 500 + 100t and E(t) = 500 · 1.15ᵗ. Which has the larger average rate of change from 0 to 5? From 10 to 15?
2. f(x) = 4 · 3ˣ. By what factor does f change over any interval of width 2?
3. A quantity is 90 at x = 1 and 10 at x = 3. If exponential, what is it at x = 5?
4. A city had 60,000 people in 2000 and 72,000 in 2010. Predict 2030 with an exponential model.
5. Why should a prediction for 2100 from that model be treated with caution?

*Answers:* (1) L: 100 per step; E: (1,005.7 − 500)/5 ≈ 101, so E, just. From 10 to 15: E ≈ (4,068 − 2,023)/5 ≈ 409 against 100, E. (2) 9. (3) Factor 1/9 per 2 units: 10/9 ≈ 1.11. (4) Factor 1.2 per decade: 60,000 · 1.2³ = 103,680. (5) It assumes a century of unchanged 20%-per-decade growth, far beyond the data.

---

*Adapted from IM 9–12 Math by Illustrative Mathematics (Algebra 1, Unit 5, Lessons 19–21, https://im.kendallhunt.com/HS/teachers/1/5/index.html), © 2019 Illustrative Mathematics, licensed under CC BY 4.0 (https://creativecommons.org/licenses/by/4.0/). Rewritten and extended with original examples and questions for this course. Accessed 2026-10-16.*
