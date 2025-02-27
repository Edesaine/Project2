<title>Infinite Knowledge - Payment</title>
<x-guestLayout>
    @if (session('success'))
        @include('partials.flashMsgSuccess')
    @endif
    {{--alert edit fail--}}

    @if (session('failed'))
        @include('partials.flashMsgFail')
    @endif
    <section id="" class="m-nav">
        <div class="container">
            <div class="row h-auto py-4 g-4">
                <div class="col-12">
                    <div class="">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div class="p-3 bg-primary rounded-circle shadow-sm">
                                <i class="bi bi-bag text-white"></i>
                            </div>
                            <div class="p-3 bg-primary rounded-circle shadow-sm">
                                <i class="bi bi-credit-card text-white"></i>
                            </div>
                            <div class="p-3 bg-primary rounded-circle shadow-sm">
                                <i class="bi bi-check text-white"></i>
                            </div>
                        </div>
                        <div class="progress" style="height: 8px">
                            <div
                                class="progress-bar progress-bar-striped progress-bar-animated"
                                role="progressbar"
                                style="width: 100%;"
                                aria-valuenow="100"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            ></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 load-hidden fade-in">
                    <div class="bg-white p-4 shadow-sm border rounded-3 overflow-x-auto">
                        <div class="my-5 d-flex flex-column justify-content-center align-items-center text-center">
                            <i class="bi bi-check-circle-fill text-success display-1 mb-4"></i>
                            <h4 class="fw-bold mb-4">You have successfully ordered books!</h4>
                            <a href="{{route('Customer.carts.orderHistory')}}" class="btn btn-primary tran-3">View order history</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guestLayout>
