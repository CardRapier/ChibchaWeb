<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Domains</div>

          <div class="card-body">
            <input type="text" />
            <p>{{status}}</p>
            <button></button>
            <button></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data: function() {
    return {
      status: ""
    };
  },

  mounted() {
    console.log("Component mounted.");

    this.loadQuote();
    console.log(this.status)
    this.fetch()
  },

  methods: {
    loadQuote: function() {
      this.status = "Loading...";
    },

     fetch: function() {
       axios
      .get("http://localhost:8000/v1/bpi/currentprice.json", { useCredentails: true })
      .then(response => (this.status = response))
      .catch(console.log('Error'))
     }
  }
};
</script>
