# RESTful Node.js: A Structure Approach (Book Application)

[![Build Status](https://travis-ci.com/restful-node/restful-nodejs-app.svg?branch=master)](https://travis-ci.com/restful-node/restful-nodejs-app)

This is the application repository for the book **_[RESTful Node.js: A Structured Approach](https://restfulnode.com)_**.

## Requirements

- Node Version >=12
- Docker
- MongoDB

## Configuration Setup

Make sure to setup the configuration properly in the config directory.

## Starting MongoDB

```
$ npm run mongo:start
```

## Seeding the Database

```
$ npm run db:seed
```

## Install Dependencies

```
$ npm install
```

## Running the Application in dev

```
$ npm run dev
```

It will start at http://localhost:5000

## Running Tests

Make sure you have a local instance of MongoDB Running.

Running Tests on Mac

```
$ npm run test:mac
```

Running Tests on Windows

```
$ npm run test:windows
```
