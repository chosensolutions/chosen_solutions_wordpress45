var Datastore = require('nedb');
var users = new Datastore({ filename: '../storage/db/users.db', autoload: true, timestampData: true });

(async function () {
  try {
    let user = await users.insert({ a: 5 });
    console.log(user);
  } catch (err) {
    console.log(err)
  }
})();