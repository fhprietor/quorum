<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crea una nueva pregunta
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <question-form :errors="errors" :form="form" @submit="submit">
                    <template #buttons>
                        <loading-button
                            :loading="processing"
                            class="btn-indigo"
                            type="submit"
                        >
                            Crear pregunta
                        </loading-button>
                    </template>
                </question-form>
            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from "../../Layouts/AppLayout";
import QuestionForm from "../../Components/QuestionForm";
import LoadingButton from "../../Components/LoadingButton";
export default {
    components: {LoadingButton, QuestionForm, AppLayout},
    props: {
        errors: Object,
    },
    data() {
        return {
            processing: false,
            form: {
                name: null,
                status: null,
                content: null,
            }
        }
    },
    methods: {
        submit() {
            this.processing = true;
            this.$inertia.post(this.route('questions.store'), this.form)
                .then(() => this.processing = false);
        }
    }
}
</script>
