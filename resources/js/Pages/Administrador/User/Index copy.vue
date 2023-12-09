<script setup>
import LayoutOccoro from '@/Layouts/LayoutOccoro.vue';
import EditModal from '@/Components/Modal.vue';
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import CardPequeno from '@/Components/CardPequeno.vue';

const showEditModal = ref(false);

//const { user } = defineProps(['user']);

const closeEditModal = () => {
    showEditModal.value = false;
};


const openEditModal = () => {
    showEditModal.value = true;
};

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    last_name: props.user.last_name,
    email: props.user.email,
});

const verificationLinkSent = ref(null);

const updateProfileInformation = () => {
    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,

    });
    closeEditModal();

};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};
</script>

<template>
    <LayoutOccoro>
        <CardPequeno>
            <h3>Información del Usuario Logueado</h3>
            <div class="user-info-container" v-if="user">
                <div class="user-info-row">
                    <b>Nombre:</b> {{ user.name }}
                </div>
                <div class="user-info-row">
                    <b>Apellido:</b> {{ user.last_name }}
                </div>
                <div class="user-info-row">
                    <b>Email:</b> {{ user.email }}
                </div>
                <!-- Otros campos del usuario -->
                <button class="bg-gray-500 px-4 py-2 rounded" @click="openEditModal">Editar</button>
            </div>
            <div v-else>
                <p>El usuario no está autenticado.</p>
            </div>
        </CardPequeno>
        <EditModal :show="showEditModal" :closeable="true" @close="closeEditModal" class="edit">
            <template v-slot:content>
                <FormSection @submitted="updateProfileInformation">
                    <template #title>
                        Profile Information
                    </template>

                    <template #description>
                        Update your account's profile information and email address.
                    </template>

                    <template #form>
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="name" value=" Nombre" />
                            <TextInput id="name" v-model="form.name" type="text" class="mt-1 w-full" required
                                autocomplete="name" />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>
                        <!--last_name-->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="last_name" value=" Apellido" />
                            <TextInput id="last_name" v-model="form.last_name" type="text" class="mt-1 w-full" required
                                autocomplete="last_name" />
                            <InputError :message="form.errors.last_name" class="mt-2" />
                        </div>
                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="email" value="Email" />
                            <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required
                                autocomplete="username" />
                            <InputError :message="form.errors.email" class="mt-2" />

                            <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                                <p class="text-sm mt-2">
                                    Your email address is unverified.

                                    <Link :href="route('verification.send')" method="post" as="button"
                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        @click.prevent="sendEmailVerification">
                                    Click here to re-send the verification email.
                                    </Link>
                                </p>

                                <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                                    A new verification link has been sent to your email address.
                                </div>
                            </div>
                        </div>
                    </template>

                    <template #actions>
                        <ActionMessage :on="form.recentlySuccessful" class="me-3">
                            Guardado exitosamente
                        </ActionMessage>

                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Guardar cambios
                        </PrimaryButton>
                    </template>
                </FormSection>
            </template>
        </EditModal>

    </LayoutOccoro>
</template>

<style scoped>
.edit {
    z-index: 9999;
    animation: fadeIn 0.8s; /* Animación de desvanecimiento al abrir el modal */


}
</style>
