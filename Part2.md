# Part 2/4: Checking a Pull Request

Documentation states the following
```
    ENDPOINT: https://api.supermetrics.com/assignment/register
    METHOD: POST
    PARAMS:
        client_id: ju16a6m81mhid5ue1z3v2g0uh
        email: your@email.address
        name: Your Name

    RETURNS:
        sl_token: This token string should be used in the
                subsequent query. Please note that this token will only
                last 1 hour from when the REGISTER call happens. You will
                need to register and fetch a new token as you need it.
        client_id: returned for informational purposes only
        email: returned for informational purposes only
```
You receive a pull request with the following line of code. Please review the code.
```
<?php
$tokenInfo =
file_get_contents('https://api.supermetrics.com/assignment/register?client
_id=ju16a6m81mhid5ue1z3v2g0uh&email=my@name.com&name=My%20Name')
```

## REVIEW

We should not use `file_get_content` function to execute any API requests.
Even if it can be technically be used for some unauthorized GET type requests this is not secure.
We should use either `curl_*()` functions.
You can find an example [here](https://stackoverflow.com/questions/2138527/php-curl-http-post-sample-code)

Or what I would suggest we should use some library like [Guzzle](https://docs.guzzlephp.org/en/stable/)

Let me know if you need any help to transform your code.
