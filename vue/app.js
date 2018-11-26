const apiUrl = {
  php: 'http://localhost/api/',
  node: 'http://localhost:3000/api/'
}

new Vue({
  el: '#dynamic-component-demo',
  data: {
    script: 'php',
    result: {
      result1: '',
      result2: '',
      result3: ''
    },
    input1: '',
    input2: '',
    input3: '',
  },
  methods: {
    inputNumber: function (e) {
      const id = (e.target.id)
      if (id == 'input1' || id == 'input3') {
        if (e.key >= 0 && e.key <= 9) {
          return;
        } else {
          e.preventDefault();
        }
      }
    },
    callApi: function (e) {
      const id = (e.target.id)
      if (this['input' + id] == '') {
        alert('Please input number!!');
        return;
      }
      this.result['result' + id] = 'Loding ...';
      const url = apiUrl[this.script] + id + '/' + this['input' + id] + '/';
      var config = {
        headers: {
          'Access-Control-Allow-Origin': '*',
          'Access-Control-Allow-Methods': 'GET'
        }
      };
      axios
        .get(url)
        .then(response => {
          console.log(response)
          this.result['result' + id] = response.data.result;
        })
        .catch(error => {
          console.log(error)
        })
    }
  }
})