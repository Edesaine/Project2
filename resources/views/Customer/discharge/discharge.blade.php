<title>Infinite Knowledge - Payment</title>
<x-guestLayout>
    @if (session('success'))
        @include('partials.flashMsgSuccess')
    @endif
    @if (session('failed'))
        @include('partials.flashMsgFail')
    @endif
    <section id="" class="m-nav">
        <div class="container">
            <form class="row h-auto py-4 g-4" method="post" action="{{route('Customer.dischargeProcess')}}">
                @csrf
                <div class="col-12">
                    <div class="">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div class="p-3 bg-primary rounded-circle shadow-sm">
                                <i class="bi bi-bag text-white"></i>
                            </div>
                            <div class="p-3 bg-primary rounded-circle shadow-sm">
                                <i class="bi bi-credit-card text-white"></i>
                            </div>
                            <div class="p-3 border rounded-circle shadow-sm">
                                <i class="bi bi-check text-primary"></i>
                            </div>
                        </div>
                        <div class="progress" style="height: 8px">
                            <div
                                class="progress-bar"
                                role="progressbar"
                                style="width: 50%;"
                                aria-valuenow="50"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            ></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7 col-xl-8 load-hidden fade-in">
                    <div class="p-4 bg-white border shadow-sm rounded-3">
                        <div class="col-12">
                            <h4 class="m-0 text-primary fw-bold">Customer Information</h4>
                            <hr>
                            <div class="row g-4">
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="name">Customer Name <span class="text-danger">*</span></label>
                                    <input required type="text" id="name" name="name" class="form-control" value="{{\Illuminate\Support\Facades\Auth::guard('customer')->user()->name ?? ''}}">
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="email">Customer Email <span class="text-danger">*</span></label>
                                    <input required type="email" id="email" name="email" class="form-control" value="{{\Illuminate\Support\Facades\Auth::guard('customer')->user()->email ?? ''}}">
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                                    <input required type="text" id="phone" name="phone" class="form-control" value="{{\Illuminate\Support\Facades\Auth::guard('customer')->user()->phone ?? ''}}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="note">Note</label>
                                    <textarea id="note" name="note" class="form-control"></textarea>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-12">
                            <a class="btn btn-secondary tran-3" href="{{route('Customer.carts.cart')}}">Return</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-xl-4 load-hidden fade-in">
                    <div class="p-4 bg-white border shadow-sm rounded-3">
                        <div>
                            <h4 class="m-0 text-primary fw-bold">Payment Information</h4>
                            <hr>
                            <table class="table table-striped table-borderless">
                                <tr>
                                    <td class="align-middle">Books</td>
                                    <td>
                                        @foreach($carts as $book)
                                            @if(isset($book['book']))
                                             @else
                                                <p>Books do not exist!</p>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Amount</td>
                                    <td>{{\App\Helpers\AppHelper::vnd_format($totalPrice)}}</td>
                                </tr>
                            </table>
                        </div>
                        <input type="hidden" name="total_price" value="{{$totalPrice}}">
                        <div class="mb-3">
                            <button class="btn btn-secondary w-100 tran-3 mb-1" name="pay_later" value="1" type="submit">Pay later</button>
                            <button class="btn btn-primary w-100 tran-3" name="redirect" type="submit">Pay now !</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-guestLayout>
