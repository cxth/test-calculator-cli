# Calculator CLI App based on Laravel Zero

Repository: https://github.com/cxth/test-calculator-cli

## Goal of this project
* CLI calculator that perform the basic operations
* addition (+)
* subtraction (-)
* multiplication (*)
* division (/)
* square root (sqrt)


## Usage

1. Navigate the calculator-cli directory
```
    cd calculator-cli
```
2. Executing command from cli:
```
    // simple
    php calc solve 1 + 2
    
    // also work without spaces
    php calc solve 1+2

    // multiple operations
    php calc solve 1+2*3/4

    // *note: multiple operations should have no spaces*   

    // command also accepts user input
    php calc solve 
```

3. Executing command using build
```
    cd builds
    php calc-cli solve 1+1
```

4. Running Unit Test:
```
    php ./vendor/bin/pest   
```

## Extension

Additional operation(s) can be added in Calculator class. I can implement an interface for new classes but for simplicity, I keep the application lean.
