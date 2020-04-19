const EventEmiter = require('events').EventEmitter;

const userHasRegistered = require('./userHasRegistered');

EventEmitter.on('userHasRegistered', userHasRegistered);