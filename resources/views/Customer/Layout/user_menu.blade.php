<div class="text-center">
    Welcome  <br>
    <span class="fs-5">{{$customer->name}}</span>
</div>
<hr>
<div>
    <ul class="horizontal-list">
        <li class="pb-2">
            <a href="{{route('profile')}}" class="text-decoration-none text-dark">
                <i class="bi bi-person me-3 text-warning"></i> My account
            </a>
        </li>
        <li class="py-2">
            <a href="#" class="text-decoration-none text-dark">
                <i class="bi bi-file-text me-3 text-success"></i> Orders history
            </a>
        </li>
        <li class="py-2">
            <a href="#" class="text-decoration-none text-dark">
                <i class="bi bi-shield-lock me-3 text-primary"></i> Change password
            </a>
        </li>
        <li class="py-2">
            <a href="#" class="text-decoration-none text-dark">
                <i class="bi bi-box-arrow-left me-3 text-danger"></i> Sign out
            </a>
        </li>
    </ul>
</div>
<style>
    li:hover {
        text-decoration: underline;
    }

    ul.horizontal-list {
        list-style: none;
        background-color: #48abe0;
        color: white;
        display: inline-block;
        padding: 1rem 2rem;
        margin-top: 1rem;
    }

    ul.horizontal-list li {
        display: inline-block;
        padding: 0 0.5rem;
        min-width: 7rem;
        text-align: center;
        cursor: pointer;
    }

    ul.horizontal-list li:not(:last-child) {
        border-right: 1px solid white;
    }

</style>
