<template>
    <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
        <td class="border-t">
                {{ question.name }}
        </td>
        <td class="border-t">
                {{question.status}}
        </td>
        <td class="border-t w-px">
            <inertia-link
                class="disabled text-xs px-4 py-2 rounded-full bg-blue-200 hover:bg-hp-400 hover:text-black text-gray-800 inline-flex items-center"
                :href="route('questions.edit', question.id)"
                v-if="!question.deleted_at && $permissions.can([{name: 'actualizar questions'} ])"
            >
                Modificar
            </inertia-link>
        </td>
        <td class="border-t w-px">
            <inertia-link
                class="text-xs px-4 py-2 rounded-full bg-gray-200 hover:bg-hp-400 hover:text-black text-gray-800 inline-flex items-center"
                v-if="!question.deleted_at && $permissions.can([{name: 'actualizar questions'} ])"
            >
                Opciones
            </inertia-link>
        </td>
        <td class="border-t w-px">
            <inertia-link
                class="text-xs px-4 py-2 rounded-full bg-red-200 hover:bg-hp-400 hover:text-black text-gray-800 inline-flex items-center"

                v-if="!question.deleted_at && !$permissions.can([{name: 'actualizar questions'} ])"
            >
                Votar
            </inertia-link>
        </td>

    </tr>
</template>

<script>
export default {
    name: "Question",
    props: {
        question: Object,
    }
}
</script>
