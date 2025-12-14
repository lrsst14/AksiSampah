<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header
            :title="__('Confirm password')"
            :description="__('This is a secure area of the application. Please confirm your password before continuing.')"
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.confirm.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Password')"
                viewable
            />

            <flux:button variant="primary" type="submit" class="w-full" data-test="confirm-password-button">
                {{ __('Confirm') }}
            </flux:button>
        </form>
    </div>
</x-layouts.auth>

<?php

use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';

    public function confirm() {
        $this->validate([
            'password' => 'required|string',
        ]);

        if (! Hash::check($this->password, Auth::user()->password)) {
            $this->addError('password', 'The password is incorrect.');
            return;
        }

        session(['auth.password_confirmed_at' => time()]);

        return redirect()->intended();
    }
}; ?>

<div>
    <flux:field>
        <flux:input wire:model="password" type="password" label="Password" />
    </flux:field>

    <flux:spacer />

    <flux:button wire:click="confirm" variant="primary">Confirm</flux:button>
</div>
