<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import AppMainheader from '../AppMainheader.vue';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AppMainheader />
    <AuthBase title="Log in to your account" description="Enter your email and password below to log in"
        title-class="bg-gradient-to-r from-yellow-400 via-orange-400 to-red-500 bg-clip-text text-transparent">

        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email" class="text-orange-300">Email address</Label>
                    <Input id="email" type="email" required autofocus :tabindex="1" autocomplete="email"
                        v-model="form.email" placeholder="email@example.com"
                        class="focus:ring-2 focus:ring-orange-400 border-orange-400/40 text-orange-100 placeholder:text-orange-100" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password" class="text-orange-300">Password</Label>
                        <TextLink v-if="canResetPassword" :href="route('password.request')"
                            class="text-sm text-orange-400 hover:text-orange-300 underline transition-colors"
                            :tabindex="5">
                            Forgot password?
                        </TextLink>
                    </div>
                    <Input id="password" type="password" required :tabindex="2" autocomplete="current-password"
                        v-model="form.password" placeholder="Password"
                        class="focus:ring-2 focus:ring-orange-400 text-orange-100 placeholder:text-orange-100 border-orange-400/40" />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3 text-orange-300">
                        <Checkbox id="remember" v-model="form.remember" :tabindex="3"
                            class="text-orange-500 border-orange-400 focus:ring-orange-400" />
                        <span>Remember me</span>
                    </Label>
                </div>

                <Button type="submit"
                    class="mt-4 w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white"
                    :tabindex="4" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    Log in
                </Button>
            </div>

            <div class="text-center text-sm text-orange-300">
                Don't have an account?
                <TextLink :href="route('register')" class="text-orange-400 hover:text-orange-300" :tabindex="5">Sign up
                </TextLink>
            </div>
        </form>
    </AuthBase>
</template>
