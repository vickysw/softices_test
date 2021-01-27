<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
<!-- 
            <div>
                <x-jet-label value="{{ __('Name') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div> -->

            <div>
                <x-jet-label value="{{ __('First Name') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            </div>

            <div>
                <x-jet-label value="{{ __('Last Name') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
            </div>

            <div>
                <x-jet-label value="{{ __('Date of birth') }}" />
                <x-jet-input class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required autofocus autocomplete="date_of_birth" />
            </div>

            <div>
                <x-jet-label value="{{ __('Phone Number') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="phone_number[]" maxlength="10" :value="old('phone_number')" required autofocus autocomplete="phone_number" />
                <a href="#" class="add_phone">Add</a>

            </div>

            <div>
                <x-jet-label value="{{ __('Gender') }}" />
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">Male</label><br>
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label><br>
                    <input type="radio" id="other" name="gender" value="other">
                    <label for="other">Other</label>
                <!-- <x-jet-input class="block mt-1 w-full" type="text" name="gender" :value="old('gender')" required autofocus autocomplete="gender" /> -->
            </div>

            <div>
                <x-jet-label value="{{ __('Role') }}" />
                <select name="role" id="" class="form-select rounded-md shadow-sm mt-1 block w-full">
                    <option value="" disabled >Select Rol</option>
                    <option value="1">Doctor</option>
                    <option value="0">Patient</option>
                 </select>

                <!-- <x-jet-input class="block mt-1 w-full" type="text" name="role" :value="old('first_name')" required autofocus autocomplete="first_name" /> -->
            </div>


            <div class="mt-4">
                <x-jet-label value="{{ __('Email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Confirm Password') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $('body').on('click','.add_phone',function(){
        var  inpt = $(this);
        var content = ' <input class="block mt-1 w-full " required type="text" name="phone_number[]" maxlength="10"  required autofocus autocomplete="phone_number" /\> <a href="#" class="remove_phone">Remove</a>';
        $(inpt).after(content);
    });

    $('body').on('click','.remove_phone',function(){
        $(this).prev().closest('.block').hide();
        $(this).hide();
    });
});
</script>
</x-guest-layout>
