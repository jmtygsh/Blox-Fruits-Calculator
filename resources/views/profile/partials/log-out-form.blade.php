<section>
    
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-danger-button :href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-danger-button>
    </form>
    
</section>
