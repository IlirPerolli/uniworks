<div class="col-md-4" id="edit-profile-side">
    <a href="{{route('user.edit')}}">
        <h2 class="edit-profile-side-text">Edito profilin
            @if (Route::is('user.edit*') || Route::is('user.photo*'))

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7" />
            </svg>
                @endif
        </h2>
    </a>

    <!-- <a href="userEditAccount.html">
        <h2 class="edit-profile-side-text">Llogaria juaj</h2>
    </a> -->

    <a href="{{route('user.password.edit')}}">
        <h2 class="edit-profile-side-text">Ndrysho fjalëkalimin
        @if (Route::is('user.password.edit*'))

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7" />
            </svg>
        @endif
        </h2>
    </a>
    <a href="{{route('user.username.edit')}}">
        <h2 class="edit-profile-side-text">Ndrysho usernamin
            @if (Route::is('user.username.edit*'))

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7" />
                </svg>
            @endif
        </h2>
    </a>
    <a href="{{route('user.delete.page')}}">
        <h2 class="edit-profile-side-text">Fshij llogarinë
            @if (Route::is('user.delete*'))

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7" />
                </svg>
            @endif
        </h2>
    </a>
</div>
