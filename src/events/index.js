const events = require('events');

const eventEmitter = new events.EventEmitter();

const userHasRegistered = require('./userHasRegistered');

eventEmitter.on('userHasRegistered', userHasRegistered);