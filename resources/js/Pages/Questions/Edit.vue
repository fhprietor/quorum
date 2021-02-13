<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edita la pregunta {{ question.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <question-form :errors="errors" :form="form" @submit="submit">
                    <template #buttons>
                        <jet-danger-button @click.native="showModal = true" class="ml-3 py-3" :class="{ 'opacity-25': processing }" :disabled="processing">
                            Eliminar
                        </jet-danger-button>
                        <jet-secondary-button
                            :loading="processing"
                            class="ml-3 btn-indigo"
                            type="submit"
                        >
                            Guardar
                        </jet-secondary-button>
                    </template>
                </question-form>
            </div>
        </div>

        <jet-confirmation-modal :show="showModal" @close="showModal = false">
            <template #title>
                Eliminar pregunta
            </template>

            <template #content>
                ¿Estás seguro que quieres eliminar la pregunta?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="showModal = false">
                    Cancelar
                </jet-secondary-button>

                <jet-danger-button @click.native="destroy" class="ml-2" :class="{ 'opacity-25': processing }" :disabled="processing">
                    Eliminar pregunta
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import QuestionForm from "../../Components/QuestionForm";
import LoadingButton from "../../Components/LoadingButton";
import JetConfirmationModal from "../../Jetstream/ConfirmationModal";
import JetSecondaryButton from "../../Jetstream/SecondaryButton";
import JetDangerButton from "../../Jetstream/DangerButton";
export default {
    components: {
        LoadingButton, QuestionForm, AppLayout,
        JetConfirmationModal, JetDangerButton, JetSecondaryButton
    },
    props: {
        question: Object,
        errors: Object,
    },
    data() {
        return {
            processing: false,
            showModal: false,
            form: {
                name: this.question.name,
                status: this.question.status,
                content: this.question.content,
            }
        }
    },
    methods: {
        submit() {
            this.processing = true
            this.$inertia.put(this.route('questions.update', this.question.id), this.form)
                .then(() => this.processing = false)
        },
        destroy() {
            this.processing = true
            this.$inertia.delete(this.route('questions.destroy', this.question.id))
                .then(() => this.processing = false)
        }
    }
}
</script>
