<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import AppMainheader from '../AppMainheader.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AppMainheader />
    <AuthBase title="Create an account" description="Enter your details below to create your account">

        <Head title="Register" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name" class="text-orange-300">Name</Label>
                    <Input id="name" type="text" required autofocus :tabindex="1" autocomplete="name"
                        v-model="form.name" placeholder="Full name"
                        class="focus:ring-2 focus:ring-orange-400 border-orange-400/40 text-orange-100 placeholder:text-orange-100" />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label for="email" class="text-orange-300">Email address</Label>
                    <Input id="email" type="email" required :tabindex="2" autocomplete="email" v-model="form.email"
                        placeholder="email@example.com"
                        class="focus:ring-2 focus:ring-orange-400 border-orange-400/40 text-orange-100 placeholder:text-orange-100" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label for="password" class="text-orange-300">Password</Label>
                    <Input id="password" type="password" required :tabindex="3" autocomplete="new-password"
                        v-model="form.password" placeholder="Password"
                        class="focus:ring-2 focus:ring-orange-400 border-orange-400/40 text-orange-100 placeholder:text-orange-100" />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation" class="text-orange-300">Confirm password</Label>
                    <Input id="password_confirmation" type="password" required :tabindex="4" autocomplete="new-password"
                        v-model="form.password_confirmation" placeholder="Confirm password"
                        class="focus:ring-2 focus:ring-orange-400 border-orange-400/40 text-orange-100 placeholder:text-orange-100" />
                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <Button type="submit"
                    class="mt-4 w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white"
                    tabindex="5" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Create account
                </Button>
            </div>

            <div class="text-center text-sm text-orange-300">
                Already have an account?
                <TextLink :href="route('login')" class="text-orange-400 hover:text-orange-300" :tabindex="6">Log in</TextLink>
            </div>
        </form>
    </AuthBase>
</template>
