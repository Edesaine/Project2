<!DOCTYPE html>
<html lang="en-US">

<!-- Mirrored from templatekit.jegtheme.com/docbook/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Mar 2024 08:26:30 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <link rel="pingback" href="templatekit.jegtheme.com/docbook/xmlrpc.html" />
    <title>Docbook &#8211; Online Bookstore WooCommerce Elementor Template Kit by Jegtheme</title>
    <meta name='robots' content='max-image-preview:large' />
    <link rel="alternate" type="application/rss+xml" title="Docbook &raquo; Feed" href="templatekit.jegtheme.com/docbook/feed/index.html" />
    <link rel="alternate" type="application/rss+xml" title="Docbook &raquo; Comments Feed" href="templatekit.jegtheme.com/docbook/comments/feed/index.html" />
    <div class="container d-flex align-items-center justify-content-between px-0 mt-5 min-vh-80 overflow-hidden">
    </div>
    <link href="resources/sass/app.scss">
    <link href="resources/js/app.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="row">
    <div class="col-75">
        <div class="container">
            @foreach(\Illuminate\Support\Facades\Session::get('cart') as $book_id => $book)
                <div class="col-25">
                    <div class="container">
                        <h4>Your cart
                            <span class="price" style="color:black">
                                <i class="fa fa-shopping-cart"></i>
                            </span>
                        </h4>
                        <p>
                            <a href="/book/{{$book_id}}">
                                {{$book['name']}}
                            </a>
                            <span class="price">${{$book['price']}}</span>
                            <span class="amount">{{$book['quantity']}}x</span>
                        </p>
                        <hr>
                        <div>
                        <p>Total
                            <span class="price" style="color:black">
                                    @php
                                        $total_items[$book_id] = $book['quantity'];
                                        $amount[$book_id] = $book['price'] * $book['quantity'];
                                    @endphp
                            </span>
                        </p>
                        </div>
                    </div>
                </div>
            @endforeach
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-50">
                        <h3>Checkout Form</h3>
                        <label for="receiver_name"><i class="fa fa-user"></i>Receiver name</label>
                        <input type="text" id="receiver_name" name="receiver_name" value="{{$customer->name}}">
                        <label for="receiver_phone"><i class="fa fa-envelope"></i>Receiver phone</label>
                        <input type="number" id="receiver_phone" name="receiver_phone" value="{{$customer->phone}}">
                        <br>
                        <label for="receiver_address"><i class="fa fa-address-card-o"></i>Receiver address</label>
                        <input type="text" id="receiver_address" name="receiver_address"
                        value="{{$customer->address}}">
                        <br>
                    </div>

                    <div class="col-50">
                        <h3>Payment</h3>
                        <label for="fname">Accepted Cards</label>
                        <div class="icon-container">
                            <i class="fa fa-cc-visa" style="color:navy;"></i>
                            <i class="fa fa-cc-amex" style="color:blue;"></i>
                            <i class="fa fa-cc-mastercard" style="color:red;"></i>
                            <i class="fa fa-cc-discover" style="color:orange;"></i>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-1">
                    <div>
                        Total books: {{array_sum($total_items)}}
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-1">
                    <div>
                        Amount: ${{array_sum($amount)}}
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-1">
                    <div>
                        Shipping: Free
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-1">
                    <div class="fw-bold fs-5">
                        Total: ${{array_sum($amount)}}
                    </div>
                </div>
                <button class="btn">
                    Order
                </button>
            </form>

        </div>
    </div>

</div>
<style>
    body {
        font-family: Arial;
        font-size: 17px;
        padding: 8px;
    }

    * {
        box-sizing: border-box;
    }

    .row {
        display: -ms-flexbox; /* IE10 */
        display: flex;
        -ms-flex-wrap: wrap; /* IE10 */
        flex-wrap: wrap;
        margin: 0 -16px;
    }

    .col-25 {
        -ms-flex: 25%; /* IE10 */
        flex: 25%;
    }

    .col-50 {
        -ms-flex: 50%; /* IE10 */
        flex: 50%;
    }

    .col-75 {
        -ms-flex: 75%; /* IE10 */
        flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
        padding: 0 16px;
    }

    .container {
        background-color: #f2f2f2;
        padding: 5px 20px 15px 20px;
        border: 1px solid lightgrey;
        border-radius: 3px;
    }

    input[type=text] {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    label {
        margin-bottom: 10px;
        display: block;
    }

    .icon-container {
        margin-bottom: 20px;
        padding: 7px 0;
        font-size: 24px;
    }

    .btn {
        background-color: #04AA6D;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 100%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
    }

    .btn:hover {
        background-color: #45a049;
    }

    a {
        color: #2196F3;
    }

    hr {
        border: 1px solid lightgrey;
    }

    span.price {
        float: right;
        color: grey;
    }

    span.amount {
        float: right;
        color: blue;
    }
    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
    @media (max-width: 800px) {
        .row {
            flex-direction: column-reverse;
        }
        .col-25 {
            margin-bottom: 20px;
        }
    }
</style>
</body>
</html>
