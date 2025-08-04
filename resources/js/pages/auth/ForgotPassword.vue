<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import AppMainheader from '../AppMainheader.vue';
import AppFooter from '../AppFooter.vue';

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <AppMainheader />
    <AuthLayout title="Forgot password" description="Enter your email to receive a password reset link">

        <Head title="Forgot password" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <div class="space-y-6">
            <form @submit.prevent="submit">
                <div class="grid gap-2">
                    <Label for="email" class="text-orange-300">Email address</Label>
                    <Input id="email" type="email" name="email" autocomplete="off" v-model="form.email" autofocus
                        placeholder="email@example.com"
                        class="focus:ring-2 focus:ring-orange-400 border-orange-400/40 text-orange-100 placeholder:text-orange-100" />

                    <InputError :message="form.errors.email" />
                </div>

                <div class="my-6 flex items-center justify-start">
                    <Button
                        class="mt-4 w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white"
                        :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        Email password reset link
                    </Button>
                </div>
            </form>

            <div class="space-x-1 text-center text-sm text-muted-foreground">
                <span class="text-center text-sm text-orange-300">Or, return to</span>
                <TextLink :href="route('login')" class="text-orange-400 hover:text-orange-300">log in</TextLink>
            </div>
        </div>
    </AuthLayout>
    <AppFooter />
</template>
