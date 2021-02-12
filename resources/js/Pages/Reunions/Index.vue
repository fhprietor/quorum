<template>
    <app-layout>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-wrap sm:flex-no-wrap items-center mb-2">
                        <inertia-link
                            v-if="$permissions.can([{name: 'crear reuniones'}])"
                            class="bg-indigo-500 p-2 hover:bg-indigo-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200"
                            :href="route('reunions.create')"
                        >
                            Crear reunion
                        </inertia-link>
                    </div>
                    <div class="bg-white rounded shadow overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                            <tr>
                                <th class="py-2 px-2">Nombre</th>
                                <th class="py-2 px-2">Owner</th>
                                <th class="py-2 px-2">Alta</th>
                                <th class="py-2 px-2">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="reunion in reunions.data" :key="reunion.id">
                                <td class="border-t py-3 px-3">
                                    <a href="" class="text-center font-medium whitespace-no-wrap">
                                        {{ reunion.name }}
                                    </a>
                                </td>
                                <td class="border-t">
                                    <a href="" class="text-center font-medium whitespace-no-wrap">
                                        {{ reunion.user_id }}
                                    </a>
                                </td>
                                <td class="border-t">{{ reunion.created_at }}</td>
                                <td class="border-t w-56">
                                    <div class="flex justify-center items-center">
                                        <inertia-link
                                            :href="route('reunions.show', reunion.id)"
                                            class="disabled text-xs px-4 py-2 rounded-full bg-gray-200 hover:bg-hp-400 hover:text-black text-gray-800 inline-flex items-center"
                                            v-if="!reunion.deleted_at && $permissions.can([{name: 'mostrar reuniones'}, {name: 'show own reunions', owner: reunion.user_id}])"
                                        >
                                            Detalle
                                        </inertia-link>
                                        <inertia-link
                                            :href="route('reunions.edit', reunion.id)"
                                            class="disabled text-xs px-4 py-2 rounded-full bg-gray-200 hover:bg-hp-400 hover:text-black text-gray-800 inline-flex items-center"
                                            v-if="!reunion.deleted_at && $permissions.can([{name: 'actualizar reuniones'}, {name: 'update own reunions', owner: reunion.user_id}])"
                                        >
                                            Editar
                                        </inertia-link>
                                        <button
                                            class="text-xs px-4 py-2 rounded-full bg-red-200 hover:bg-hp-400 hover:text-black text-gray-800 inline-flex items-center"
                                            v-if="!reunion.deleted_at && $permissions.can([{name: 'borrar reuniones'}, {name: 'delete own reunions', owner: reunion.user_id}])"
                                            @click="remove(reunion)"
                                        >
                                            Borrar
                                        </button>
                                        <button
                                            class="text-xs px-4 py-2 rounded-full bg-red-200 hover:bg-hp-400 hover:text-black text-gray-800 inline-flex items-center"
                                            v-if="reunion.deleted_at && $permissions.can([{name: 'restaurar reuniones'}, {name: 'restore own reunions', owner: reunion.user_id}])"
                                            @click="restore(reunion)"
                                        >
                                            Restaurar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </nav>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
export default {
    name: "Reunions",
    components: {AppLayout},
    props: ["reunions"],
    methods: {
        remove(reunion) {
            const formData = new FormData;
            formData.append("_method", "DELETE");
            this.$inertia.post(this.route("reunions.destroy", reunion.id), formData)
                .then(() => {})
        },
        restore(reunion) {
            const formData = new FormData;
            formData.append("_method", "PUT");
            this.$inertia.post(this.route("reunions.restore", reunion.id), formData)
                .then(() => {})
        }
    }
}
</script>
