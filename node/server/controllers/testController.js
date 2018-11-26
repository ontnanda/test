import testModel from '../models/testModel';
import cached from '../adaptor/memcached';
const testController = {};

testController.get = (req, res) => {
  var calculateResponse = '';
  var memcachedKey = `test_${req.params.id}${req.params.n}`;
  cached.get(memcachedKey, function (err, data) {
    var r = {}
    if (data) {
      r = data;
      r.cached = 1;
    } else {
      switch (parseInt(req.params.id)) {
        case 1:
          calculateResponse = testModel.test1(req.params.n);
          break;
        case 2:
          calculateResponse = testModel.test2((req.params.n));
          break;
        case 3:
          calculateResponse = testModel.test3(req.params.n, calculateResponse);
          break;
        default:
          calculateResponse = testModel.test1(req.params.n);
          break;
      }
      r = {
        status: 1,
        result: calculateResponse,
        cached: 0
      }
      cached.set(memcachedKey, r, 30, function (err) { /* stuff */ });
    }
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.json(r);
  });
};

export default testController;