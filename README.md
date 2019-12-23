## Dynamic Suite Time Formatting Library

This library is used to standardize time formats across an instance.

A config may be created at `config/time.json` with the following parameter:

```
{
  "timestamp_format": "m/d/Y \a\t g:i:s A",
  "time_format": "g:i A",
  "date_format": "m/d/Y",
  "empty_time": "N/A"
}
```

If the parameter is not given, a the default (shown above) value will be used.

You can read more about formatting [here](https://www.php.net/manual/en/function.date.php).