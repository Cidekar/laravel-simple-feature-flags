<p align="center"><img src="https://user-images.githubusercontent.com/4164072/217960315-cbb6dcd6-a84a-4222-976e-8e3656e146a2.png" width="500" height="217"></p>

# Introduction
Laravel Simple Feature Flags provides one approach to securing your application's features. By assigning our middleware to your application's route, the feature flag middleware receives a flag name argument and verifies the route is ready to receive traffic. An HTTP access denied response is returned is by default.

## Motivation
Feature flags are not a novel concept and several packages already exist. Laravel Simple Feature Flags aims to make securing features via routes dead-simple. Create a flag, add it to your route middleware, and manage it through the CLI.
    
## Installation
This package can be installed with Composer:

```$ composer require cidekar/laravel-feature-flags:^1.0"```

Publish the migrations (optional):

```$ php artisan vendor:publish -provider="Cidekar\FeatureFlags\FeatureFlagsServiceProvider```


Run the migrations:

```$ php artisan migrate```

Create a feature:

```$ php artisan features:flag registration```

Check for a feature:

``` Route::resource('/registration', ...)->middleware(['flags:registration']);```


## Testing
To get started, make sure you have SQLite installed on your system.

``` bash 
    $ sqlite --version 

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