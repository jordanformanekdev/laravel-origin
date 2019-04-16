<template>
  <form action="/purchases" method="POST" class="checkout-form">
    <input type="hidden" name="stripeToken" v-model="stripeToken">
    <input type="hidden" name="stripeEmail" v-model="stripeEmail">

    <select name="product" v-model="product">
      <option v-for="product in products" :value="product.id">
        {{  product.name }} &mdash; ${{ product.price / 100 }}
      </option>
    </select>

    <button type="submit" name="button" @click.prevent="buy">Buy My Book</button>
  </form>
</template>

<script>
    export default {
        props: ['products'],

        data() {
          return {
            stripeEmail:'',
            stripeToken:'',
            product: 1
          }
        },

        created() {
          console.log("Laravel CSRF ++ ");
          console.log("CHECK2" + Laravel.user);
          this.stripe = StripeCheckout.configure({
              key: Laravel.stripeKey,
              image: "https://stripe.com/img/documentation/checkout/marketplace.png",
              locale: "auto",
              email: AuthUser.email,
              token: (token) => {
                this.stripeToken = token.id;
                this.stripeEmail = token.email;
                console.log("CHECK2" + this.$data);
                axios.post('/purchases', this.$data)
                  .then(response => {
                    alert('Complete! Thanks for your payment!')
                  })
                  .catch(error => {
                    console.log(error)
                  });
                }
            });
        },

        methods: {
          buy() {
            let product = this.findProductById(this.product);


            this.stripe.open({
              name: product.name,
              description: product.description,
              zipCode: true,
              amount: product.price
            });

          },

          findProductById(id) {
            return this.products.find(product => product.id == id);
          }
        }
    }
</script>
