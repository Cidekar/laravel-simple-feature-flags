<p align="center"><img src="https://user-images.githubusercontent.com/4164072/217944372-031c2894-bdc9-4e51-98a2-4908b913df1d.png" width="500" height="262"></p>

# Introduction
Simple Feature Flags provides one approach to securing your Laravel application's features. By assigning our middleware to your application's route, the feature flag middleware receives a flag name argument and verifies the route is ready to receive traffic. An HTTP access denied response is returned is by default.

## Motivation
Feature flags are not novel concept and several packages exist in the market. Simple Feature Flags aims to make securing features via routes dead-simple. Create a flag, add it to your route middleware, and manage it through the CLI - the package will do the rest!
    
## Installation
This package can be installed with Composer:

```$ composer require cidekar/simple-feature-flags:^1.0"```

Publish the migrations (optional):

```$ php artisan vendor:publish -provider="Cidekar\FeatureFlags\FeatureFlagsServiceProvider```


Run the migrations:

```$ php artisan migrate```

Create a feature:
```$ php artisan features:flag registration```

Check for features on a route:
``` Route::resource('/registration', ...)->middleware(['flags:registration']); ```

## Testing
To get started, make sure you have SQLite installed on your system.

``` bash $ sqlite --version 

    # 3.37.0
```

Now, you may run the package's tests:

``` bash
   $ php vendor/bin/testbench package:test

    #   PASS  Cidekar\FeatureFlags\Tests\Commands\CreateFlagCommandTest
    # ✓ it can create via console command
    # ✓ it can create a flag with description option
    # ✓ it can create a flag with active option
    # ✓ it can create a flag with name argument
    # ✓ it can programmatically create a flag
    # ...
```

## Security
Please do not publicly disclose security-related issues, email packages@cidekar.com. Security vulnerabilities will be promptly addressed.

## License
Copyright 2023 Cidekar, LLC. All rights reserved.

[Apache License 2.0](./license.md)