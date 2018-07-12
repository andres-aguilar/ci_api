/**
 * Vue definitions
 */
Vue.http.options.emulateJSON = true // web server can't handle requests encoded as application/json
new Vue({
  el: '#chinchilla-app',
  data: {
    nameApp: 'Test app',
    tasks: []
  },
  beforeMount() {
    this.$http.get('')
      .then(response => {console.log(response)})
      .catch(console.log)
  },
  methods: {}
})
