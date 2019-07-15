<a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
    <span class="glyphicon glyphicon-globe" style="margin-left:150px"></span><span style="color:white">Notifiations</span> <span class="badge text-white">{{count(auth()->user()->unreadNotifications)}}</span>
</a>

<ul class="dropdown-menu" role="menu" style="position: absolute; z-index: 0;" >
    <li>
        @forelse(auth()->user()->unreadNotifications as $notification)
            @include('layouts.notification.'.snake_case(class_basename($notification->type)))
        @empty
            <p>Vous n'avez aucune notification</p>

        @endforelse
    </li>

</ul>
</div>