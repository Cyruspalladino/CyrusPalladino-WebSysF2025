1. Explain what each of your classes and methods does, the order in which methods are invoked, and the flow of execution after one of the operation buttons has been clicked.

Add adds two numbers,
Subtract subtracts two numbers,
Multiply multiplies two numbers,
Divide divides two numbers

After the user presses an operation button, the operation class to be called is determined by comparing the POST array and the array of operation names corresponding to each class. After matching, it dynamically puts together the right Class.

getEquation() reads out the operation to be displayed, using operate() to compute the actual value.

2. Also explain how the application would differ if you were to use $\_GET, and why this may or may not be preferable.

Using GET, the inputs of the form would be appended to the URL, which could be a problem if someone tried to multiply two enormous numbers, as it could reach the URL limit. This isn't a problem with POST.

3. Finally, please explain whether or not there might be another (better +/-) way to determine which button has been pressed and take the appropriate action

Rather than check each button using if/else, you can utilize the POST information to dynamically generate the class.

Also, noticed dividing by zero messes the page up
