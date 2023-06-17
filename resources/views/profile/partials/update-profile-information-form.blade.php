<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <select name="gender" id="gender" class="select select-bordered select-sm w-full max-w-xs my-2">
                @if ($user->profile->gender == 1)
                <option value="1">male</option>
                <option value="0">female</option>
                @else
                <option value="0">female</option>
                <option value="1">male</option>
                @endif
            </select>
        </div>

        <div>
            <x-input-label for="signature" :value="__('Signature')" />
            <x-text-input id="signature" name="signature" type="text" class="mt-1 block w-full" class="mt-1 block w-full" :value="old('signature', $user->profile->signature)" required autofocus autocomplete="signature" />
            <x-input-error class="mt-2" :messages="$errors->get('signature')" />
        </div>

        <div>
            <x-input-label for="tel" :value="__('Tel')" />
            <x-text-input id="tel" name="tel" type="text" class="mt-1 block w-full" class="mt-1 block w-full" :value="old('tel', $user->profile->tel)" required autofocus autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('tel')" />
        </div>

        <div>
            <x-input-label for="location" :value="__('Location')" />
            <select name="location" id="location" class="select select-bordered select-sm w-full max-w-xs my-2">
                @if ($user->profile->location == 'south')
                <option value="south">south</option>
                <option value="north">north</option>
                @else
                <option value="north">north</option>
                <option value="south">south</option>
                @endif

            </select>
        </div>

        <div>
            <x-input-label for="notiEmail" :value="__('notiEmail')" />
            <select name="notiEmail" id="notiEmail" class="select select-bordered select-sm w-full max-w-xs my-2">
                @if ($user->profile->notiEmail == 1)
                <option value="1">yes</option>
                <option value="0">no</option>
                @else
                <option value="0">no</option>
                <option value="1">yes</option>
                @endif
            </select>
        </div>

        <div>
            <x-input-label for="notiFollow" :value="__('notiFollow')" />
            <select name="notiFollow" id="notiFollow" class="select select-bordered select-sm w-full max-w-xs my-2">
                @if ($user->profile->notiFollow == 1)
                <option value="1">yes</option>
                <option value="0">no</option>
                @else
                <option value="0">no</option>
                <option value="1">yes</option>
                @endif
            </select>
        </div>

        <div>
            <x-input-label for="birthday" :value="__('Birthday')" />
            <x-text-input type="date" id="birthday" name="birthday" class="mt-1 block w-full" class="mt-1 block w-full" :value="old('birthday', $user->profile->birthday)" required autofocus autocomplete="birthday" />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
