<div class="dashboardLeft">
    <div class="dashboardLinks">
        <p class="text-sm translate-y-5">Hello! {{ auth()->user()->name }}</p>
        <ul class="dashboardLinksCSS">
            <a href="{{ route('manageMyAccount') }}">
                <li>Manage My Account</li>
            </a>
            <a href="{{ route('myReservations') }}">
                <li>My Reservations</li>
            </a>
            <a href="{{ route('mycancellations') }}">
                <li>My Cancellations</li>
            </a>
            <a href="{{ route('myfavourite') }}">
                <li>My Favourite</li>
            </a>
            <a href="{{ route('myNotifications') }}">
                <li>My Notifications</li>
            </a>
            <a href="{{ route('discount.offers') }}">
                <li>Discount Offers</li>
            </a>
            <a href="{{ route('profile.edit') }}">
                <li>Profile Settings</li>
            </a>
        </ul>
    </div>
</div>
