# DynamicEncryption
Vigenere encryption: static and dynamic. Endless key length.
Encrypt any sort of message.

Built for MatterPHP framework.

Feel free to update it for other frameworks and/or other patterns.

Go to Master app to test it.

Vigenere Encryption
-------------------

This encryption method is 4 centuries old and still working.
You can see how its square logic works here: http://bit.ly/1REHk27

The basic method suggests a static encryption (single layer encryption), no matter its size.

This algorithm leads to encrypt messages both using static and dynamic method.

The dynamic method is simply adding new squares layers with a specific encryption key linking one layer to the previous one.
The generated key is the only way to decrypt the message and shouldn't be displayed!
So store it, and do not hesitate to encrypt it using some extra hash + a salt!

You just need to specify the number of layers when starting the method (4 layers is the default case).
