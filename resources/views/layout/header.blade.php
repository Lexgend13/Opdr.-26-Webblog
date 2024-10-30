@auth
    <h2>Profile name: {{ auth()->user()->name }}</h2><br>
@endauth

<span class="header">
    <a href='/home'>Home ||</a>
    <a href='/create-article'>Make new article ||</a>

    @guest
    <a href='/register'>Register ||</a>
    <a href="/login">Log in</a>
    @else
        <a href='/my-articles'>My articles ||</a>
        <a href='/buy-Premium'>Buy Premium ||</a>
        <form class="inline-form" method="post" action="/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endguest
</span>
    