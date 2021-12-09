# Part 4/4: A question

Would you use a class/library provided by an external framework in your code, why or why not?

## Answer

### Yes I will

Reasons:

- There is no reason to reinvent the wheel. If I need to connect to DB, I'll use some library for that.
  If I need to process HTTP request or response I'll use some existing well known library or framework like [HttpFoundation Component](https://symfony.com/doc/current/components/http_foundation.html).
  By the way that is the library I would recommend to use for part 3/4 of this assignment to dispatch request.
  
- When we use well known libraries and/or framework we can speed up our development without losing a code quality.
- In addition or as an effect of previous reason developer can focus more on the logic and functionality he need to implement reither than to create some tooling functionality which has no direct value for the project.
- Usually such libraries and frameworks are well known by developers and well documented.
  That means we need to spend less time inside the team to explain how to use it and we don't need to spend that much time for knowledge tranfer betweeen developers when there is a rotation inside the team or project. 
- If we use top well known libraries and frameworks we learn some best practices from their code

### No I will not

- There is a security concern. Whenever we use some external dependency there is always a risk that external code is 100% safe.
  That is why not every external library should be recommended but only mature product with best reputation on the market.
- I will probably not recommend to use some external "class". Which is not a library or framework yet.
  If I like the code, I'll probably just rewrite it and adopt for my project. But I won't includee it as dependency for my project.




