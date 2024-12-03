<div class="card">
    <div class="card-header">Welcome, {{ Auth::user()->name }}</div>
    <img src="https://via.placeholder.com/100" width="150px" height="150px"
        class="rounded-circle mb-3 card-image-top d-block mx-auto" alt="Profile">
    <ul class="list-group list-group-flush">
        <a href="{{ route('home') }}" class="text-muted">
            <li class="list-group-item"><i class="fas fa-home"></i> Dashboard</li>
        </a>
        <a href="{{ route('wishlist') }}" class="text-muted">
            <li class="list-group-item"><i class="fas fa-heart"></i> Wishlist</li>
        </a>
        <a href="#" class="text-muted">
            <li class="list-group-item"><i class="fas fa-file-alt"></i> My Order</li>
        </a>
        <a href="{{ route('customer.setting') }}" class="text-muted">
            <li class="list-group-item"><i class="fas fa-edit"></i> Setting</li>
        </a>
        <a href="#" class="text-muted">
            <li class="list-group-item"><i class="fab fa-telegram-plane"></i> Open Ticket</li>
        </a>
        <a href="{{ route('user.logout') }}" class="text-muted">
            <li class="list-group-item"><i class="fas fa-sign-out-alt"></i> Logout</li>
        </a>
    </ul>
</div>
