function test1(n) {
  n = parseInt(n);
  return Math.pow(2, n) - Math.pow(-1, Math.ceil(n / 3));
}

function test2(n) {
  return n - 24 - 20;
}

function test3(n, ret) {
  n =  parseInt(n);
  if (n <= 1) {
    ret = 5;
    return ret;
  }
  var r = parseInt(test3(n - 1, ret));
  ret += n * Math.pow(10, n - 1) + r;
  return ret;
}

export default {
  test1,
  test2,
  test3
};