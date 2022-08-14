var express = require('express');
var config = require('./config').Config;
var client = require('twilio')(config.sid, config.authToken);
var app = express();
app.use(express.bodyParser());

var callMp3 = function ( tonum, mp3url) {
	client.makeCall({
		to: tonum,
		from: config.from,
		url: config.baseUrl + '/mp3twiml?url=' + mp3url
	}, function(err, responseData) {
		console.log('Made call to ' + responseData.to + ' from ' + responseData.from);
	});
};

app.post('/sms', function(req, res){
	console.log('callMp3 ' + req.body.From);
	callMp3(req.body.From, config.mp3Url);
	res.end();
});

var mp3twiml = function(req, res){
	mp3url = req.param('url');
	console.log('MP3 URL: ' + mp3url);
	res.send('<Response><Play>' + mp3url + '</Play></Response>');
};

app.get('/mp3twiml', mp3twiml);
app.post('/mp3twiml', mp3twiml);

app.listen(3000);
console.log("Listening on port 3000");