## Dynamic Suite Time Formatting Library

A library to standardize time formats across an instance.

Configure via `config/time.json` with the following parameters:

```
{
  "timestamp_format": "m/d/Y \a\t g:i:s A",
  "time_format": "g:i A",
  "date_format": "m/d/Y",
  "empty_time": "N/A"
}
```

Missing parameters will be replaced with the default (shown above).

You can read more about formatting [here](https://www.php.net/manual/en/function.date.php).

Official documentation [here](https://dynamicsuite.io/official-packages/time).