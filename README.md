utah_gdg_twilio_challenge
=========================

The Utah Google Developer Group held a Survivor Challenge event in February 2013. The challenge required integration with the Twilio API.  Twilio is a VOIP provider that has some very easy to use APIs for programming SMS texting and voice call placement and response.

The basic gist of the challenge was to accept a text, then call a number and play an MP3 file.  My implementation flows like this:

1. Someone texts CALLME to the Twilio number
2. Twilio sends a REST call to my web server with the text details
3. My web server initiates a voice call from the Twilio number to the number that sent the text
4. Twilio makes a request to my web server for call handling instructions
5. My web server responds with XML telling Twilio to play an MP3 file from a URL

This project is my implementation in two different environments.  I originally worked the challenge using PHP.  To get the PHP version working:
- Point a PHP enabled web server at the php directory (or copy it in)
- Copy keys.php.sample to keys.php and enter values that make sense for you (you'll need a Twilio account and public access to your web server)
- Configure your Twilio number to send text details to <the URL of the PHP project>/sms
- Try it by texting CALLME to your Twilio number

The other implementation is node.js.  To get this version working:
- Run 'npm install' in the project node.js directory.  This pulls down dependencies
- Copy config.js.sample to config.js and enter values that make sense for you (you'll need a Twilio account and public access to the server at port 3000)
- Configure your Twilio number to send text details to http:<server address>:3000/sms
Run 'node server.js' in the project node.js directory.  This starts the node server
Try it by texting CALLME to your Twilio number
