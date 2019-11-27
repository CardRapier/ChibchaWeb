@extends('layouts.app')

@section('head')
<script src="https://js.stripe.com/v3/"></script>

<style>
    .StripeElement {
        box-sizing: border-box;

        height: 40px;

        padding: 10px 12px;

        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;

        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <input placeholder="Card Holder" class="form-control" id="card-holder-name" type="text">
                    <div id="card-element" class="mb-3"></div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button class="center mt-2 btn btn-sm btn-primary" id="card-button"
                                data-secret="{{ $intent->client_secret }}">
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('js')
<script>
    window.addEventListener('load', function() {
            const stripe = Stripe('{{env('STRIPE_KEY')}}');
            
            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');
            
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;
            
            cardButton.addEventListener('click', async (e) => {
                const { setupIntent, error } = await stripe.handleCardSetup(
                    clientSecret, cardElement, {
                        payment_method_data: {
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );

                if (error) {
                    alert(error.message);
                    // Display "error.message" to the user...
                } else {
                    // The card has been verified successfully...
                    console.log('handling success', setupIntent.payment_method);
                    axios.post('/hosting/process',{
                        payment_method: setupIntent.payment_method
                    }).then((data)=>{
                        location.replace(data.data.success_url)
                    });
                }
            });
        })




</script>
@endsection