<template>
  <form action="/subscriptions" method="POST" class="subscription-form">
    <input type="hidden" name="stripeToken" v-model="stripeToken">
    <input type="hidden" name="stripeEmail" v-model="stripeEmail">

    <select name="plan" v-model="plan">
      <option v-for="plan in plans" :value="plan.id">
        {{  plan.name }} &mdash; ${{ plan.price / 100 }}
      </option>
    </select>

    <button type="submit" name="button" @click.prevent="subscribe">Subscribe</button>

    <p class="help is-danger" v-show="status" v-text="status">{{ status }}</p>

  </form>
</template>

<script>
    export default {
        props: ['plans'],

        data() {
          return {
            stripeEmail:'',
            stripeToken:'',
            plan: 1,
            status: false
          }
        },

        created() {
          this.stripe = StripeCheckout.configure({
              key: Laravel.stripeKey,
              image: "https://stripe.com/img/documentation/checkout/marketplace.png",
              locale: "auto",
              panelLabel: "Subscribe For",
              email: AuthUser.email,
              token: (token) => {
                this.stripeToken = token.id;
                this.stripeEmail = token.email;

                axios.post('/subscriptions', this.$data)
                  .then(response => {
                    this.status = response.data.status
                  })
                  .catch(error => {
                    console.log(error)
                  });
                }
            });
        },

        methods: {
          subscribe() {
            let plan = this.findPlanById(this.plan);

            this.stripe.open({
              name: plan.name,
              description: plan.name,
              zipCode: true,
              amount: plan.price
            });

          },

          findPlanById(id) {
            return this.plans.find(plan => plan.id == id);
          }
        }
    }
</script>
