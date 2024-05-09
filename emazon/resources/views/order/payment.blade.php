@extends('template.base')

@section('content')
    <div class="relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true dark:bg-slate-600">

        <div id="rzp_checkout"></div>

    </div>



    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        function paymentOkHandler(response) {
            /**
             * The entire list of Checkout fields is available at
             * https://docs.razorpay.com/docs/checkout-form#checkout-fields
             */
            console.log("Payment was successful");
            paymentData.razorpay_order_id = response.razorpay_order_id;
            paymentData.razorpay_payment_id = response.razorpay_payment_id;
            paymentData.razorpay_signature = response.razorpay_signature;


            console.log(paymentData);

            const url = "/api/v1/payment/store";
            axios.post(url, paymentData).then(paymentSuccessfulHandler).catch(paymentFailureHandler);

        };

        function paymentSuccessfulHandler() {
            // redirect to success page
            window.location = "/order/success";
        }

        function paymentFailureHandler() {
            // redirect to success page
            window.location = "/order/failure";
        }


        const options = @php echo json_encode($data) @endphp;
        const paymentData = {};

        options.handler = paymentOkHandler;

        // $data = [ "key" => "razorpay_key", "amount" => 800000 ];
        // json_encode($data)
        // { "key": "razorpay_key", "amount": 800000 };

        // const rzp = document.querySelector
        const rzp = new Razorpay(options);
        rzp.open();
    </script>
@endSection
